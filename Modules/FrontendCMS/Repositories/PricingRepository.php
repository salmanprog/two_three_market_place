<?php

namespace Modules\FrontendCMS\Repositories;
use App\Traits\ImageStore;
use Modules\FrontendCMS\Entities\Pricing;

class PricingRepository {

    protected $pricing;
    public function __construct(Pricing $pricing){
        $this->pricing = $pricing;
    }
    public function getAll()
    {
        return $this->pricing::all();
    }
    public function getAllActive()
    {
        return $this->pricing::with('activeFeatures')->where('status',1)->get();
    }
    public function save($data)
    {
        $image = null;
        if (!empty($data['image'])) {
            $image = ImageStore::saveImage($data['image'], 165, 165);
        }
        $pricing = Pricing::create([
            'name' => $data['name'],
            'plan_price' => $data['plan_price'],
            'monthly_cost' => isset($data['monthly_cost'])?$data['monthly_cost']:$data['plan_price'],
            'yearly_cost' => isset($data['yearly_cost'])?$data['yearly_cost']:$data['plan_price'],
            'team_size' => $data['team_size'],
            'stock_limit' => $data['stock_limit'],
            'category_limit' => $data['category_limit'],
            'transaction_fee' => $data['transaction_fee'],
            'best_for' => $data['best_for'],
            'status' => $data['status'],
            'image' => $image,
            'expire_in' => $data['expire_in'],
            'is_featured' => isset($data['is_featured']) ? 1 : 0,
            'gst_tax_id' => !empty($data['gst_id']) ? $data['gst_id'] : null,
            'discount_type' => $this->resolveDiscountType($data),
            'discount' => $this->resolveDiscount($data),
        ]);
        $this->syncFeatures($pricing, $data);
        return $pricing;
    }
    public function update($data)
    {
        $image = isset($data['old_image']) ? $data['old_image']:'';
        if (!empty($data['image'])) {
            $image = ImageStore::saveImage($data['image'], 165, 165);
        }

        $updated = $this->pricing::where('id',$data['id'])->update([
            'name' => $data['name'],
            'plan_price' => $data['plan_price'],
            'monthly_cost' => isset($data['monthly_cost'])?$data['monthly_cost']:$data['plan_price'],
            'yearly_cost' => isset($data['yearly_cost'])?$data['yearly_cost']:$data['plan_price'],
            'team_size' => $data['team_size'],
            'stock_limit' => $data['stock_limit'],
            'category_limit' => $data['category_limit'],
            'transaction_fee' => $data['transaction_fee'],
            'best_for' => $data['best_for'],
            'status' => $data['status'],
            'image' => $image,
            'expire_in' => $data['expire_in'],
            'is_featured' => isset($data['is_featured']) ? 1 : 0,
            'gst_tax_id' => !empty($data['gst_id']) ? $data['gst_id'] : null,
            'discount_type' => $this->resolveDiscountType($data),
            'discount' => $this->resolveDiscount($data),
        ]);

        $pricing = $this->pricing->findOrFail($data['id']);
        $this->syncFeatures($pricing, $data);

        return $updated;
    }
    public function delete($id){
        $pricing = $this->pricing->findOrFail($id);
        $pricing->delete();
        return $pricing;
    }
    public function show($id){
        $pricing = $this->pricing->with('features')->findOrFail($id);
        return $pricing;
    }
    public function edit($id){
        $pricing = $this->pricing->with('features')->findOrFail($id);
        return $pricing;
    }
    public function statusUpdate($data, $id){
        return $this->pricing::where('id',$id)->update([
            'status' => $data['status']
        ]);
    }

    private function resolveDiscountType(array $data): int
    {
        if (!array_key_exists('discount_type', $data) || $data['discount_type'] === '' || $data['discount_type'] === null) {
            return 0;
        }

        return (int) $data['discount_type'];
    }

    private function resolveDiscount(array $data)
    {
        if (!array_key_exists('discount', $data) || $data['discount'] === '' || $data['discount'] === null) {
            return 0;
        }

        return $data['discount'];
    }

    private function syncFeatures(Pricing $pricing, array $data): void
    {
        if (!array_key_exists('features_sync', $data)) {
            return;
        }

        $pricing->features()->delete();

        $features = (isset($data['features']) && is_array($data['features'])) ? $data['features'] : [];

        foreach ($features as $index => $feature) {
            if (!is_array($feature)) {
                continue;
            }

            $title = trim((string) ($feature['title'] ?? ''));
            if ($title === '') {
                continue;
            }

            $pricing->features()->create([
                'title' => $title,
                'icon' => trim((string) ($feature['icon'] ?? '')) ?: 'fas fa-check',
                'sort_order' => isset($feature['sort_order']) ? (int) $feature['sort_order'] : $index,
                'status' => array_key_exists('status', $feature) ? (int) (bool) $feature['status'] : 1,
            ]);
        }
    }
}
