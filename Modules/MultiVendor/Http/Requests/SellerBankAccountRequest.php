<?php

namespace Modules\MultiVendor\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellerBankAccountRequest extends FormRequest
{
    public const US_ACCOUNT_NUMBER_MIN = 4;
    public const US_ACCOUNT_NUMBER_MAX = 17;
    public const US_ROUTING_NUMBER_LENGTH = 9;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'bank_title' => 'required|max:255',
            'bank_account_number' => 'required|digits_between:' . self::US_ACCOUNT_NUMBER_MIN . ',' . self::US_ACCOUNT_NUMBER_MAX,
            'bank_name' => 'required|max:255',
            'branch_name' => 'required|max:255',
            'routing_number' => 'required|digits:' . self::US_ROUTING_NUMBER_LENGTH,
            'ibn' => 'required|max:255',
        ];
    }

    protected function prepareForValidation()
    {
        if (!$this->filled('ibn')) {
            $this->merge(['ibn' => '-']);
        }

        if ($this->has('bank_account_number')) {
            $this->merge([
                'bank_account_number' => preg_replace('/\D/', '', (string) $this->bank_account_number),
            ]);
        }

        if ($this->has('routing_number')) {
            $this->merge([
                'routing_number' => preg_replace('/\D/', '', (string) $this->routing_number),
            ]);
        }
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $routingNumber = $this->input('routing_number');

            if ($routingNumber && !$this->isValidUsRoutingNumber($routingNumber)) {
                $validator->errors()->add(
                    'routing_number',
                    __('common.invalid_routing_number')
                );
            }
        });
    }

    public function messages()
    {
        return [
            'bank_account_number.required' => __('validation.required', ['attribute' => __('common.account_number')]),
            'bank_account_number.digits_between' => __('common.us_account_number_digits_between', [
                'min' => self::US_ACCOUNT_NUMBER_MIN,
                'max' => self::US_ACCOUNT_NUMBER_MAX,
            ]),
            'routing_number.required' => __('validation.required', ['attribute' => __('common.routing_number')]),
            'routing_number.digits' => __('common.us_routing_number_digits', [
                'digits' => self::US_ROUTING_NUMBER_LENGTH,
            ]),
        ];
    }

    /**
     * Validate US ABA routing number using the standard checksum algorithm.
     */
    protected function isValidUsRoutingNumber(string $routingNumber): bool
    {
        if (!preg_match('/^\d{9}$/', $routingNumber)) {
            return false;
        }

        $weights = [3, 7, 1, 3, 7, 1, 3, 7, 1];
        $sum = 0;

        for ($index = 0; $index < 9; $index++) {
            $sum += ((int) $routingNumber[$index]) * $weights[$index];
        }

        return $sum % 10 === 0;
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
}
