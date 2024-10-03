@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center">Projects</h1>
        <div id="app">
            <div class="row">
                <div class="col-md-12">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addCustomerModal">Add
                        Projects</a>
                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Project Name</th>
                                <th>Description</th>
                                <th>Customers</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                                <tr>
                                    <td>{{ $project->id }}</td>
                                    <td>{{ $project->name }}</td>
                                    <td>{{ $project->description }}</td>
                                    <td>
                                        <ul>
                                            @foreach ($project->customers as $customer)
                                                <li>{{ $customer->name }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <!-- View Button -->
                                        <a href="{{ route('projects.show', $project->id) }}" class="btn btn-info btn-sm">
                                            View
                                        </a>

                                        <!-- Edit Button -->
                                        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <!-- Delete Button (Form with POST method for deleting) -->
                                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
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
    @include('projects.create')

    <!-- Bootstrap & jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
