@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Product List</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Biaya</th>
                <th>Rata-rata Biaya</th>
                <th>Perusahaan</th>
                <th>Kategori</th>
                <th>Unit</th>
                <th>Di Buat</th>
                <th>Di Update</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->cost }}</td>
                    <td>{{ $product->cost_average }}</td>
                    <td>{{ $product->company_name }}</td>
                    <td>{{ $product->category_name }}</td>
                    <td>{{ $product->unit_name }}</td>
                    <td>{{ $product->created_at }}</td>
                    <td>{{ $product->updated_at }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus produk ini?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="12">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
