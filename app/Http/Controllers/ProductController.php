<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // Menampilkan semua produk
    public function index()
    {
        $query = '
            SELECT products.*, companies.name AS company_name, categories.name AS category_name, units.name AS unit_name
            FROM products
            LEFT JOIN companies ON products.company_id = companies.id
            LEFT JOIN categories ON products.category_id = categories.id
            LEFT JOIN units ON products.unit_id = units.id
            WHERE products.deleted_at IS NULL
            ORDER BY products.id DESC LIMIT 10
        ';

        $products = DB::select($query);

        return view('products.index', compact('products'));
    }

    // Menampilkan form untuk membuat produk baru
    public function create()
    {
        $companies = DB::table('companies')->get();
        $categories = DB::table('categories')->get();
        $units = DB::table('units')->get();

        return view('products.create', compact('companies', 'categories', 'units'));
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'cost' => 'required|numeric',
            'cost_average' => 'nullable|numeric',
            'company_id' => 'required|integer',
            'category_id' => 'required|integer',
            'unit_id' => 'required|integer',
        ]);

        DB::table('products')->insert([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'cost' => $request->input('cost'),
            'cost_average' => $request->input('cost_average'),
            'company_id' => $request->input('company_id'),
            'category_id' => $request->input('category_id'),
            'unit_id' => $request->input('unit_id'),
            'created_at' => now(),
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil dibuat.');
    }

    // Menampilkan form untuk mengedit produk
    public function edit($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Produk tidak ditemukan.');
        }

        $companies = DB::table('companies')->get();
        $categories = DB::table('categories')->get();
        $units = DB::table('units')->get();

        return view('products.edit', compact('product', 'companies', 'categories', 'units'));
    }

    // Mengupdate produk yang ada
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'cost' => 'required|numeric',
            'cost_average' => 'nullable|numeric',
            'company_id' => 'required|integer',
            'category_id' => 'required|integer',
            'unit_id' => 'required|integer',
        ]);

        DB::table('products')
            ->where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'cost' => $request->input('cost'),
                'cost_average' => $request->input('cost_average'),
                'company_id' => $request->input('company_id'),
                'category_id' => $request->input('category_id'),
                'unit_id' => $request->input('unit_id'),
                'updated_at' => now(),
            ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    // Menghapus produk
    public function destroy($id)
    {
        $updated = DB::update(
            'UPDATE products SET deleted_at = ? WHERE id = ?',
            [now(), $id]
        );

        if ($updated) {
            return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
        } else {
            return redirect()->route('products.index')->with('error', 'Produk tidak ditemukan.');
        }
    }
}
