<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'qty' => 'sometimes|required|integer',
            'price' => 'sometimes|required|numeric',
            'user_id' => 'sometimes|required|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama produk nggak boleh dikosongin saat di-edit.',
            'qty.required' => 'Jumlah produk nggak boleh kosong.',
            'qty.integer' => 'Jumlah produk harus angka.',
            'price.required' => 'Harga produk nggak boleh kosong.',
            'price.numeric' => 'Harga produk harus berupa angka.',
        ];
    }
}