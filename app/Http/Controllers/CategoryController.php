<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Menampilkan daftar kategori & jumlah produknya
    public function index()
    {
        $categories = Category::withCount('products')->get(); 
        return view('category.index', compact('categories'));
    }

    // Menampilkan form tambah kategori
    public function create()
    {
        return view('category.create');
    }

    // Menyimpan kategori baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:category,name',
        ], [
            'name.required' => 'Nama kategori wajib diisi!',
            'name.unique' => 'Kategori ini sudah ada di database.',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('category.index')->with('success', 'Kategori berhasil ditambahkan!');
    }
}