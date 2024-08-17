<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
    {
        // Fetch all customers
        $customers = DB::select(
            'SELECT customers.id, customers.name, customers.phone, customers.address, customers.description, companies.name AS company_name
            FROM customers
            LEFT JOIN companies ON customers.company_id = companies.id
            WHERE customers.deleted_at IS NULL
            ORDER BY customers.id DESC'
        );
    
        return view('customers.index', compact('customers'));
    }
    

    public function show($id)
    {
        // Fetch a customer by ID
        $customer = DB::select('SELECT * FROM customers WHERE id = ?', [$id]);

        if (empty($customer)) {
            return redirect()->route('customers.index')->with('error', 'Customer not found');
        }

        return view('customers.show', ['customer' => $customer[0]]);
    }

    public function create()
    {
        $companies = DB::select('SELECT id, name FROM companies WHERE deleted_at IS NULL');
        return view('customers.create', ['companies' => $companies]);
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'company_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Insert the new customer into the database
        DB::insert(
            'INSERT INTO customers (company_id, name, phone, address, description, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?)',
            [
                $validated['company_id'],
                $validated['name'],
                $validated['phone'],
                $validated['address'],
                $validated['description'],
                now(),
                now(),
            ]
        );

        return redirect()->route('customers.index')->with('message', 'Customer created successfully');
    }

    public function edit($id)
    {
        // Fetch a customer by ID for editing
        $customer = DB::select('SELECT * FROM customers WHERE id = ?', [$id]);

        if (empty($customer)) {
            return redirect()->route('customers.index')->with('error', 'Customer not found');
        }

        $companies = DB::select('SELECT id, name FROM companies WHERE deleted_at IS NULL');
        
        return view('customers.edit', [
            'customer' => $customer[0],
            'companies' => $companies
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'company_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Update the customer in the database
        $updated = DB::update(
            'UPDATE customers SET company_id = ?, name = ?, phone = ?, address = ?, description = ?, updated_at = ? WHERE id = ?',
            [
                $validated['company_id'],
                $validated['name'],
                $validated['phone'],
                $validated['address'],
                $validated['description'],
                now(),
                $id
            ]
        );

        if ($updated) {
            return redirect()->route('customers.index')->with('message', "Customer dengan ID $id berhasil di update");
        } else {
            return redirect()->route('customers.index')->with('error', "Customer with ID $id not found");
        }
    }

    public function destroy($id)
    {
        // Soft delete the customer by setting the deleted_at timestamp
        $deleted = DB::update(
            'UPDATE customers SET deleted_at = ? WHERE id = ?',
            [now(), $id]
        );

        if ($deleted) {
            return redirect()->route('customers.index')->with('message', 'Customer deleted successfully');
        } else {
            return redirect()->route('customers.index')->with('error', "Customer with ID $id not found");
        }
    }
}
