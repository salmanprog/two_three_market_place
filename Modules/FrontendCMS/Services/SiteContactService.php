<?php

namespace Modules\FrontendCMS\Services;

use App\Traits\ImageStore;
use Illuminate\Support\Facades\File;

class SiteContactService
{
    use ImageStore;

    protected string $storagePath;

    public function __construct()
    {
        $this->storagePath = storage_path('app/site_settings/contact_profiles.json');
    }

    public function get(): array
    {
        if (!File::exists($this->storagePath)) {
            return $this->defaults();
        }

        $data = json_decode(File::get($this->storagePath), true);

        if (!is_array($data) || empty($data['profiles'])) {
            return $this->defaults();
        }

        return $data;
    }

    public function update(array $data, $request): array
    {
        $profiles = [];
        $existing = $this->get();

        foreach ($data['profiles'] as $index => $profile) {
            $image = $profile['existing_image'] ?? ($existing['profiles'][$index]['image'] ?? '');

            if ($request->hasFile("profiles.$index.image")) {
                if ($image) {
                    $this->deleteImage($image);
                }
                $image = ImageStore::saveImage($request->file("profiles.$index.image"), 200, 200);
            }

            $profiles[] = [
                'name' => $profile['name'],
                'phone' => $profile['phone'],
                'email' => $profile['email'],
                'image' => $image,
            ];
        }

        $payload = [
            'title' => $data['title'] ?? 'Connect with us',
            'profiles' => $profiles,
        ];

        $directory = dirname($this->storagePath);
        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        File::put($this->storagePath, json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return $payload;
    }

    public function formatProfilesForDisplay(array $profiles): array
    {
        return array_map(function ($profile) {
            return [
                'name' => $profile['name'] ?? '',
                'phone' => $profile['phone'] ?? '',
                'email' => $profile['email'] ?? '',
                'image' => $profile['image'] ?? '',
                'image_url' => showImage($profile['image'] ?? null),
            ];
        }, $profiles);
    }

    protected function defaults(): array
    {
        return [
            'title' => 'Connect with us',
            'profiles' => [
                [
                    'name' => 'Alex Grove',
                    'phone' => '954 850 0145',
                    'email' => 'alexgrove.23ld@gmail.com',
                    'image' => 'public/uploads/all/68530cdb43d0e.png',
                ],
                [
                    'name' => 'Devin Pughsley',
                    'phone' => '205 777 8284',
                    'email' => 'devinpughsley.23ld@gmail.com',
                    'image' => 'public/uploads/all/68530cde80b1c.png',
                ],
            ],
        ];
    }
}
