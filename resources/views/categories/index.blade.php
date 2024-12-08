@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Kategori</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Tambah Kategori</a>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Perusahaan</th>
                <th>Di Buat</th>
                <th>Di Update</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>{{ $category->company_name }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>{{ $category->updated_at }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Manual -->
    <div class="d-flex justify-content-between">
        @if ($page > 1)
            <a href="{{ route('categories.index', ['page' => $page - 1]) }}" class="btn btn-secondary">Sebelumnya</a>
        @endif

        @if ($page < $totalPages)
            <a href="{{ route('categories.index', ['page' => $page + 1]) }}" class="btn btn-secondary">Selanjutnya</a>
        @endif
    </div>
</div>

@endsection
