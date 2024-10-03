@extends('layouts.app')

@section('content')
    <h1>Edit Customer</h1>
    <form action="{{ route('projects.update', $customer) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $customer->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" value="{{ $customer->email }}" required>
        </div>
        <h5>Address</h5>
        @foreach ($customer->addresses as $address)
            <div class="form-group">
                <label for="address_line_1">Address Line 1</label>
                <input type="text" class="form-control" name="addresses[0][address_line_1]" value="{{ $address->address_line_1 }}" required>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" class="form-control" name="addresses[0][city]" value="{{ $address->city }}" required>
            </div>
            <div class="form-group">
                <label for="state">State</label>
                <input type="text" class="form-control" name="addresses[0][state]" value="{{ $address->state }}" required>
            </div>
            <div class="form-group">
                <label for="zip_code">Zip Code</label>
                <input type="text" class="form-control" name="addresses[0][zip_code]" value="{{ $address->zip_code }}" required>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Update Customer</button>
    </form>
    <a href="{{ route('projects.index') }}" class="btn btn-secondary mt-3">Back to Customers</a>
@endsection
