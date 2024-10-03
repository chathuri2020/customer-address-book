@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center">Customer Address Book</h1>
        <div id="app">
            <div class="row">
                <div class="col-md-12">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addCustomerModal">Add
                        Customer</a>
                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $customer->id }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>
                                        <!-- View Button -->
                                        <a href="#" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#showCustomerModal" data-customer-name="{{ $customer->name }}"
                                            data-company="{{ $customer->company }}"
                                            data-contact-phone="{{ $customer->contactPhone }}"
                                            data-email="{{ $customer->email }}" data-country="{{ $customer->country }}"
                                            data-address-detail="{{ $customer->addressDetail }}">
                                            View
                                        </a>

                                        <!-- Edit Button -->
                                        <a href="{{ route('customers.edit', $customer->id) }}"
                                            class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <!-- Delete Button (Form with POST method for deleting) -->
                                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this customer?');">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Customer Modal -->
    @include('customers.create')
    @include('customers.show')
    <!-- Bootstrap & jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
