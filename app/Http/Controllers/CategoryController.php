<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    // Mendapatkan semua kategori
    public function index(Request $request)
    {
        $perPage = 10; // Item per halaman
        $page = $request->get('page', 1); // Mengambil halaman dari query string, default ke halaman 1
        $offset = ($page - 1) * $perPage;
    
        // Menulis query SQL mentah dengan LIMIT dan OFFSET untuk pagination
        $query = '
            SELECT categories.id, categories.name, categories.description, companies.name AS company_name, categories.created_at, categories.updated_at
            FROM categories
            LEFT JOIN companies ON categories.company_id = companies.id
            WHERE categories.deleted_at IS NULL
            ORDER BY categories.id DESC
            LIMIT :limit OFFSET :offset
        ';
    
        // Menjalankan query SQL dengan parameter untuk menghindari SQL Injection
        $categories = DB::select($query, [
            'limit' => $perPage,
            'offset' => $offset,
        ]);
    
        // Hitung jumlah total data untuk keperluan navigasi halaman
        $total = DB::table('categories')
            ->leftJoin('companies', 'categories.company_id', '=', 'companies.id')
            ->whereNull('categories.deleted_at')
            ->count();
    
        // Buat variabel untuk mengatur total halaman
        $totalPages = ceil($total / $perPage);
    
        return view('categories.index', compact('categories', 'totalPages', 'page'));
    }
    

    // Mendapatkan kategori berdasarkan ID
    public function show($id)
    {
        $category = DB::table('categories')->where('id', $id)->first();

        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Kategori tidak ditemukan');
        }

        return view('categories.show', ['category' => $category]);
    }

    // Menampilkan form untuk membuat kategori baru
    public function create()
    {
        $companies = DB::table('companies')->get();
        return view('categories.create', compact('companies'));    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'company_id' => 'required|integer',
        ]);

        DB::table('categories')->insert([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'company_id' => $request->input('company_id'),
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dibuat.');
    }

    // Menampilkan form untuk mengedit kategori
    public function edit($id)
    {
        // Retrieve the category by ID
        $category = DB::table('categories')->where('id', $id)->first();
    
        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Kategori tidak ditemukan');
        }
    
        // Retrieve all companies
        $companies = DB::table('companies')->get();
    
        // Pass both the category and companies to the view
        return view('categories.edit', [
            'category' => $category,
            'companies' => $companies
        ]);
    }

    // Mengupdate kategori yang ada
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'company_id' => 'required|integer',
        ]);

        DB::table('categories')
            ->where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'company_id' => $request->input('company_id'),
                'updated_at' => now(),
            ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diupdate.');
    }

    // Menghapus kategori
   public function destroy($id)
{
    // Perform a soft delete by setting the deleted_at timestamp
    $updated = DB::update(
        'UPDATE categories SET deleted_at = ? WHERE id = ?',
        [now(), $id]
    );

    if ($updated) {
        return redirect()->route('categories.index')->with('success', 'Category successfully deleted.');
    } else {
        return redirect()->route('categories.index')->with('error', 'Category not found.');
    }
}


    
}
