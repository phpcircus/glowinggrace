<?php

namespace App\Services\Customer;

use PerfectOblivion\ActionServiceResponder\Validation\ValidationService\ValidationService;

class CreateCustomerValidationService extends ValidationService
{
    /**
     * Get the validation rules that apply to the data.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'phone' => ['nullable', 'string'],
            'email' => ['required', 'email'],
            'address' => ['nullable', 'required_if:deliveryType,shipped', 'string'],
            'city' => ['nullable', 'required_if:deliveryType,shipped', 'string'],
            'state' => ['nullable', 'required_if:deliveryType,shipped', 'string'],
            'zip' => ['required', 'int'],
            'deliveryType' => ['required', 'in:shipped,pickup'],
            'pickupLocation' => ['nullable', 'required_if:deliveryType,pickup', 'in:irving,senatobia'],
            'token' => ['required', 'string'],
        ];
    }

    /**
     * Get the sanitization filters that apply to the data.
     *
     * @return array
     */
    public function filters()
    {
        return [
            'name' => ['trim','strip_tags'],
            'phone' => ['trim','strip_tags'],
            'email' => ['trim','strip_tags'],
            'address' => ['trim','strip_tags'],
            'city' => ['trim','strip_tags'],
            'state' => ['trim','strip_tags'],
            'deliveryType' => ['trim','strip_tags'],
            'pickupLocation' => ['trim','strip_tags'],
        ];
    }

    public function messages()
    {
        return [
            'token' => ['required' => 'There was a problem with this transaction. Please try again.'],
        ];
    }
}
