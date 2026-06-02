<?php

namespace Modules\Attendance\Repositories;

use App\Traits\GenerateSlug;
use App\Traits\ImageStore;
use Modules\Attendance\Entities\ArtGallery;

class ArtGalleryRepository implements ArtGalleryRepositoryInterface
{
    use ImageStore, GenerateSlug;

    public function all()
    {
        if (auth()->user()->role->type != 'admin') {
            return ArtGallery::latest()->where('user_id', auth()->user()->id)->with('user')->get();
        }

        return ArtGallery::latest()->with('user')->get();
    }

    public function create(array $data)
    {
        $artGallery = new ArtGallery();
        if (!empty($data['image'])) {
            $artGallery->image = $this->saveImage($data['image'], 1920, 500);
        }
        $artGallery->user_id = $data['user_id'] ?? auth()->user()->id;
        $artGallery->slug = $this->resolveUniqueSlug($data['slug'] ?? null, $data['title']);
        $artGallery->title = $data['title'];
        $artGallery->description = $data['description'] ?? '';
        $artGallery->status = $data['status'] ?? 1;
        $artGallery->save();

        return $artGallery;
    }

    public function find($id)
    {
        return ArtGallery::with('user')->findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $artGallery = ArtGallery::findOrFail($id);

        if (!empty($data['image'])) {
            if ($artGallery->image) {
                $this->deleteImage($artGallery->image);
            }
            $artGallery->image = $this->saveImage($data['image'], 1920, 500);
        }

        $artGallery->title = $data['title'];
        if ($artGallery->title !== $data['title']) {
            $artGallery->slug = $this->resolveUniqueSlug(null, $data['title'], $id);
        }
        $artGallery->description = $data['description'] ?? '';
        $artGallery->status = $data['status'] ?? $artGallery->status;
        $artGallery->save();

        return $artGallery;
    }

    protected function resolveUniqueSlug(?string $slug, string $title, ?int $exceptId = null): string
    {
        $base = $this->productSlug($slug ?: $title);
        if ($base === '') {
            $base = 'art-gallery';
        }

        $candidate = $base;
        $counter = 1;

        while ($this->slugExists($candidate, $exceptId)) {
            $candidate = $base . '-' . $counter;
            $counter++;
        }

        return $candidate;
    }

    protected function slugExists(string $slug, ?int $exceptId = null): bool
    {
        $query = ArtGallery::where('slug', $slug);

        if ($exceptId) {
            $query->where('id', '!=', $exceptId);
        }

        return $query->exists();
    }

    public function delete($id)
    {
        $artGallery = ArtGallery::findOrFail($id);
        if ($artGallery->image) {
            $this->deleteImage($artGallery->image);
        }
        $artGallery->delete();

        return true;
    }
}
