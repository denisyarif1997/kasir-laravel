<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    // public function index()
    // {
    //     $companies = DB::table('companies')->get();
    //     return view('companies.index', compact('companies'));
    // }

    public function index()
    {
        // Menulis query SQL mentah dengan pengurutan
        $query = '
            SELECT *
            FROM 
            companies WHERE deleted_at is NULL 
            ORDER BY id ASC LIMIT 10
        ';
    
        // Menjalankan query SQL mentah
        $companies = DB::select($query);

        return view('companies.index', compact('companies'));
    }

    public function show($id)
    {
        $company = DB::table('companies')->where('id', $id)->first();
        if (!$company) {
            return abort(404, 'Company not found');
        }
        return view('companies.show', compact('company'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
        ]);

        DB::table('companies')->insert($validated);

        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }

    public function edit($id)
    {
        $company = DB::table('companies')->where('id', $id)->first();
        if (!$company) {
            return abort(404, 'Company not found');
        }
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
        ]);

        $affected = DB::table('companies')
            ->where('id', $id)
            ->update($validated);

        if ($affected === 0) {
            return abort(404, 'Company not found');
        }

        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    public function destroy($id)
    {
        // Get the current timestamp
        $now = now();
    
        // Update the 'deleted_at' column instead of deleting the record
        $query = DB::statement('
            UPDATE companies
            SET deleted_at = ?
            WHERE id = ? AND deleted_at IS NULL
        ', [$now, $id]);
    
        if ($query === 0) {
            return abort(404, 'Company not found');
        }
    
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
    
}
