@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Edit Produk</h1>

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="company_id">ID Perusahaan</label>
            <input type="number" name="company_id" id="company_id" class="form-control" value="{{ $product->company_id }}" required>
        </div>
        <div class="form-group">
            <label for="category_id">ID Kategori</label>
            <input type="number" name="category_id" id="category_id" class="form-control" value="{{ $product->category_id }}" required>
        </div>
        <div class="form-group">
            <label for="name">Nama Produk</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" class="form-control" rows="4" required>{{ $product->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="price">Harga</label>
            <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ $product->price }}" required>
        </div>
        <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i> Simpan Perubahan
        </button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
