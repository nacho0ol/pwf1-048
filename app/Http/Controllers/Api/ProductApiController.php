<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductApiController extends Controller
{
    // GET: Menampilkan semua produk
    public function index()
    {
        try {
            $products = Product::with(['category', 'user'])->get();
            return response()->json([
                'message' => 'Berhasil mengambil semua data produk',
                'data' => $products
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Error get products API: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan server'], 500);
        }
    }

    // POST: Menyimpan data (Dari Modul)
    public function store(StoreProductRequest $request)
    {
        try {
            $validated = $request->validated();
            $validated['user_id'] = Auth::id();
            
            $product = Product::create($validated);

            Log::info('Menambah data produk', [
                'list' => $product
            ]);

            return response()->json([
                'message' => 'Produk berhasil ditambahkan!!',
                'data' => $product,
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Error saat menambah product', [
                'message' => $e->getMessage(),
            ]);
            return response()->json(['message' => 'Gagal menambah produk'], 500);
        }
    }

    // GET: Menampilkan data by ID (Dari Modul)
    public function show(int $id)
    {
        try {
            $product = Product::with('category')->find($id);

            if (!$product) {
                return response()->json([
                    'message' => 'Product tidak ditemukan',
                ], 404);
            }

            return response()->json([
                'message' => 'Product retrieved successfully',
                'data' => $product
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data produk', [
                'message' => $e->getMessage(),
            ]);
            return response()->json(['message' => 'Gagal mengambil data produk'], 500);
        }
    }

    // PUT/PATCH: Mengupdate produk
    public function update(Request $request, $id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json(['message' => 'Produk tidak ditemukan'], 404);
            }

            $validated = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'qty' => 'sometimes|required|integer',
                'price' => 'sometimes|required|numeric',
                'category_id' => 'sometimes|required|exists:category,id',
            ]);

            $product->update($validated);

            return response()->json([
                'message' => 'Produk berhasil diupdate!',
                'data' => $product
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Error update product API: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengupdate produk'], 500);
        }
    }

    // DELETE: Menghapus produk
    public function destroy($id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json(['message' => 'Produk tidak ditemukan'], 404);
            }

            $product->delete();

            return response()->json([
                'message' => 'Produk berhasil dihapus!'
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Error delete product API: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal menghapus produk'], 500);
        }
    }
}