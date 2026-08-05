<?php

namespace Modules\Product\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class CreateProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (isModuleActive('FrontendMultiLang')) {
            $code = auth()->user()->lang_code;
            return [
                'product_name.'. $code =>'required|max:255',
                'product_type' => 'required',
                'category_ids' => 'required',
                'minimum_order_qty' => 'nullable',
                'tags' => 'required',
                'discount' => 'required',
                'weight' => 'nullable',
                'length' => 'nullable',
                'breadth' => 'nullable',
                'height' => 'nullable',
                'subtitle_1' => 'nullable|max:190',
                'subtitle_2' => 'nullable|max:190',
                'location' => 'nullable|string|max:500',
                'city' => 'nullable|string|max:191',
                'state' => 'nullable|string|max:191',
                'zip_code' => 'nullable|string|max:32',
                'latitude' => 'nullable|numeric|between:-90,90',
                'longitude' => 'nullable|numeric|between:-180,180',
                'auction_product'=> 'nullable',
                'pdf_file'=> 'nullable|mimes:pdf',
                'date_range'=> 'nullable',
                'variant_sku_prefix'=> 'nullable|required_if:product_type,==,2',
                'sku.*' => ['required_if:product_type,==,2',Rule::unique('product_sku', 'sku')->where(function($q){
                    return $q->where('product_id','!=',$this->id);
                })],
                'product_sku.'. $code => ['nullable', UniqueTranslationRule::for('product_sku', 'sku')->ignore($this->id)],
            ];
        }else{
            return [
                'product_name' =>'required|max:255',
                'product_type' => 'required',
                'category_ids' => 'required',
                'minimum_order_qty' => 'nullable',
                'tags' => 'required',
                'discount' => 'required',
                'weight' => 'nullable',
                'length' => 'nullable',
                'breadth' => 'nullable',
                'height' => 'nullable',
                'subtitle_1' => 'nullable|max:190',
                'subtitle_2' => 'nullable|max:190',
                'location' => 'nullable|string|max:500',
                'city' => 'nullable|string|max:191',
                'state' => 'nullable|string|max:191',
                'zip_code' => 'nullable|string|max:32',
                'latitude' => 'nullable|numeric|between:-90,90',
                'longitude' => 'nullable|numeric|between:-180,180',
                'auction_product'=> 'nullable',
                'date_range'=> 'nullable',
                'variant_sku_prefix'=> 'nullable|required_if:product_type,==,2',
                'sku.*' => ['required_if:product_type,==,2',Rule::unique('product_sku', 'sku')->where(function($q){
                    return $q->where('product_id','!=',$this->id);
                })],
                'product_sku' => ['nullable',Rule::unique('product_sku', 'sku')->where(function($q){
                    return $q->where('product_id','!=',$this->id);
                })]
            ];
        }
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $user = auth()->user();
        if (! $user || ! $user->role || $user->role->type !== 'seller') {
            return;
        }

        // Artists cannot enter SKU fields; auto-assign a prefix for variant products.
        if ((int) $this->input('product_type') === 2 && ! $this->filled('variant_sku_prefix')) {
            $sellerId = function_exists('getParentSellerId') ? (getParentSellerId() ?: $user->id) : $user->id;
            $this->merge([
                'variant_sku_prefix' => 'ART-' . $sellerId,
            ]);
        }
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if ((int) $this->input('stock_manage') !== 1) {
                return;
            }

            $minimumOrderQty = (int) ($this->input('minimum_order_qty') ?: 1);

            if ((int) $this->input('product_type') === 1) {
                $stock = (int) ($this->input('single_stock') ?? 0);
                if ($minimumOrderQty > $stock) {
                    $validator->errors()->add(
                        'minimum_order_qty',
                        __('Minimum order quantity cannot be greater than product stock.')
                    );
                }
            }

            if ((int) $this->input('product_type') === 2 && is_array($this->input('sku_stock'))) {
                foreach ($this->input('sku_stock') as $index => $skuStock) {
                    if ($minimumOrderQty > (int) $skuStock) {
                        $validator->errors()->add(
                            'minimum_order_qty',
                            __('Minimum order quantity cannot be greater than variant stock.')
                        );
                        break;
                    }
                }
            }
        });
    }
}
