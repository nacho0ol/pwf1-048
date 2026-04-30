<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'qty' => 'required|integer', 
            'price' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:category,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama produk wajib diisi bosku!',
            'name.max' => 'Nama produk nggak boleh lebih dari 255 karakter.',
            'qty.required' => 'Jumlah (stok) produk wajib diisi.',
            'qty.integer' => 'Jumlah produk harus berupa angka bulat.',
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga produk harus berupa angka yang valid.',
            'user_id.required' => 'Pemilik produk wajib dipilih.',

            'category_id.required' => 'Kategori produk wajib dipilih.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid atau tidak ada di database.',
        ];
    }
}