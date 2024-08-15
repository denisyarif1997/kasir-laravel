@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Kategori</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description">{{ $category->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="company_id" class="form-label">Company ID</label>
            <input type="number" class="form-control" id="company_id" name="company_id" value="{{ $category->company_id }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
