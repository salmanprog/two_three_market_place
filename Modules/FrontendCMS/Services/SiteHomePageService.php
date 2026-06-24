<?php

namespace Modules\FrontendCMS\Services;

use App\Traits\ImageStore;
use Illuminate\Support\Facades\File;

class SiteHomePageService
{
    use ImageStore;

    protected string $storagePath;

    public function __construct()
    {
        $this->storagePath = storage_path('app/site_settings/home_page.json');
    }

    public function getRaw(): ?array
    {
        if (!File::exists($this->storagePath)) {
            return null;
        }

        $data = json_decode(File::get($this->storagePath), true);

        return is_array($data) ? $data : null;
    }

    public function getForAdmin(): array
    {
        $saved = $this->getRaw();

        return [
            'marketplace' => $saved['marketplace'] ?? $this->defaultMarketplace(),
            'location_artists' => $saved['location_artists'] ?? $this->defaultLocationArtists(),
        ];
    }

    public function getMarketplace(): array
    {
        $saved = $this->getRaw();

        if ($saved && !empty($saved['marketplace'])) {
            return $this->formatMarketplace($saved['marketplace']);
        }

        return $this->formatMarketplace($this->defaultMarketplace());
    }

    public function getLocationArtists(): array
    {
        $saved = $this->getRaw();

        if ($saved && !empty($saved['location_artists'])) {
            return $this->formatLocationArtists($saved['location_artists']);
        }

        return $this->formatLocationArtists($this->defaultLocationArtists());
    }

    public function update(array $data, $request): array
    {
        $existing = $this->getForAdmin();
        $payload = $this->getRaw() ?? [];

        $payload['marketplace'] = $this->buildMarketplacePayload($data['marketplace'], $existing['marketplace'], $request);
        $payload['location_artists'] = $this->buildLocationPayload($data['location_artists'], $existing['location_artists'], $request);

        $directory = dirname($this->storagePath);
        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        File::put($this->storagePath, json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return [
            'marketplace' => $this->formatMarketplace($payload['marketplace']),
            'location_artists' => $this->formatLocationArtists($payload['location_artists']),
        ];
    }

    protected function buildMarketplacePayload(array $data, array $existing, $request): array
    {
        $cards = [];

        foreach ($data['cards'] as $index => $card) {
            $image = $card['existing_image'] ?? ($existing['cards'][$index]['image'] ?? '');

            if ($request->hasFile("marketplace.cards.$index.image")) {
                if ($image) {
                    $this->deleteImage($image);
                }
                $image = ImageStore::saveImage($request->file("marketplace.cards.$index.image"), 800, 600);
            }

            $cards[] = [
                'title' => $card['title'],
                'description' => $card['description'],
                'button_text' => $card['button_text'],
                'button_url' => $card['button_url'] ?? '',
                'image' => $image,
            ];
        }

        return [
            'heading' => $data['heading'],
            'intro' => $data['intro'],
            'cards' => $cards,
        ];
    }

    protected function buildLocationPayload(array $data, array $existing, $request): array
    {
        $items = [];

        foreach ($data['items'] as $index => $item) {
            $numberImage = $item['existing_number_image'] ?? ($existing['items'][$index]['number_image'] ?? '');
            $iconImage = $item['existing_icon_image'] ?? ($existing['items'][$index]['icon_image'] ?? '');

            if ($request->hasFile("location_artists.items.$index.number_image")) {
                if ($numberImage) {
                    $this->deleteImage($numberImage);
                }
                $numberImage = ImageStore::saveImage($request->file("location_artists.items.$index.number_image"), 280, 280);
            }

            if ($request->hasFile("location_artists.items.$index.icon_image")) {
                if ($iconImage) {
                    $this->deleteImage($iconImage);
                }
                $iconImage = ImageStore::saveImage($request->file("location_artists.items.$index.icon_image"), 80, 80);
            }

            $items[] = [
                'title' => $item['title'],
                'description' => $item['description'],
                'button_text' => $item['button_text'] ?? '',
                'button_url' => $item['button_url'] ?? '',
                'number_image' => $numberImage,
                'icon_image' => $iconImage,
            ];
        }

        return [
            'heading' => $data['heading'],
            'items' => $items,
        ];
    }

    protected function formatMarketplace(array $data): array
    {
        return [
            'heading' => $data['heading'] ?? '',
            'intro' => $data['intro'] ?? '',
            'cards' => array_map(function ($card) {
                return [
                    'title' => $card['title'] ?? '',
                    'description' => $card['description'] ?? '',
                    'button_text' => $card['button_text'] ?? '',
                    'button_url' => $card['button_url'] ?? '',
                    'image' => $card['image'] ?? '',
                    'image_url' => showImage($card['image'] ?? null),
                ];
            }, $data['cards'] ?? []),
        ];
    }

    protected function formatLocationArtists(array $data): array
    {
        return [
            'heading' => $data['heading'] ?? '',
            'items' => array_map(function ($item) {
                return [
                    'title' => $item['title'] ?? '',
                    'description' => $item['description'] ?? '',
                    'button_text' => $item['button_text'] ?? '',
                    'button_url' => $item['button_url'] ?? '',
                    'number_image' => $item['number_image'] ?? '',
                    'icon_image' => $item['icon_image'] ?? '',
                    'number_image_url' => showImage($item['number_image'] ?? null),
                    'icon_image_url' => showImage($item['icon_image'] ?? null),
                ];
            }, $data['items'] ?? []),
        ];
    }

    protected function defaultMarketplace(): array
    {
        return [
            'heading' => '23LD MARKETPLACE',
            'intro' => 'Find your next work of art or design piece and connect with the community of 23LD buyers and sellers.',
            'cards' => [
                [
                    'title' => 'Collect',
                    'description' => 'Buy local art',
                    'button_text' => 'Sign up as a Buyer',
                    'button_url' => route('frontend.buyer.signup'),
                    'image' => 'public/uploads/all/68530cd031e6b.png',
                ],
                [
                    'title' => 'Sell',
                    'description' => 'Join our artist community',
                    'button_text' => 'Sign up as a Artist',
                    'button_url' => route('frontend.merchant-register', 'subscription'),
                    'image' => 'public/uploads/all/68530cd031e6b.png',
                ],
                [
                    'title' => 'Service',
                    'description' => 'Art Services in your Neighborhood',
                    'button_text' => 'Art Services',
                    'button_url' => url('art-gallery-register/subscription'),
                    'image' => 'public/uploads/all/68530cd031e6b.png',
                ],
            ],
        ];
    }

    protected function defaultLocationArtists(): array
    {
        return [
            'heading' => 'Connect Your Location with Local Artists',
            'items' => [
                [
                    'title' => 'Walk Through',
                    'description' => 'During our in-person discovery, we’ll learn about the vision for your business and put together a plan that connects your space with local art that helps you achieve your desired aesthetic.',
                    'button_text' => '',
                    'button_url' => '',
                    'number_image' => 'public/uploads/all/685340c7f1013.png',
                    'icon_image' => 'public/uploads/all/685340c7ec6fb.png',
                ],
                [
                    'title' => 'Fine Art Matching & Acquisition',
                    'description' => 'We’ll connect you with artists best suited to meet your needs.',
                    'button_text' => '',
                    'button_url' => '',
                    'number_image' => 'public/uploads/all/685340c820468.png',
                    'icon_image' => 'public/uploads/all/685340c82af6e.png',
                ],
                [
                    'title' => 'Installation',
                    'description' => 'Our team will configure all the pieces in your space for a flat rate. including identifying art labels and desired light fixtures.',
                    'button_text' => 'View More',
                    'button_url' => url('art-gallery-register/subscription'),
                    'number_image' => 'public/uploads/all/685340c81c9f6.png',
                    'icon_image' => 'public/uploads/all/685340c9eec89.png',
                ],
            ],
        ];
    }
}
