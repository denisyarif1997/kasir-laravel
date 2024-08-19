@extends('layouts.app')

@section('title', 'Customer Details')

@section('content')
<div class="container">
    <h1>Customer Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Name: {{ $customer->name }}</h5>
            <p class="card-text"><strong>Phone:</strong> {{ $customer->phone }}</p>
            <p class="card-text"><strong>Address:</strong> {{ $customer->address }}</p>
            <p class="card-text"><strong>Description:</strong> {{ $customer->description }}</p>
            <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('customers.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
@endsection
