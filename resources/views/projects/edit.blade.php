<!-- resources/views/edit_customer_modal.blade.php -->
<div class="modal fade" id="editCustomerModal" tabindex="-1" role="dialog" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCustomerModalLabel">Edit Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Pass the project ID to the route -->
            <form id="editCustomerForm" action="{{ route('projects.update', $project->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Use PUT method for updating -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Project Name</label>
                        <!-- Pre-populate the project name -->
                        <input type="text" class="form-control" id="name" name="name" value="{{ $project->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <!-- Pre-populate the description -->
                        <textarea class="form-control" id="description" name="description" required>{{ $project->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="customers">Select Customers</label>
                        <select class="form-control" id="customers" name="customers[]" multiple>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}"
                                    @if (in_array($customer->id, $project->customers->pluck('id')->toArray())) selected @endif>
                                    {{ $customer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Project</button>
                </div>
            </form>
        </div>
    </div>
</div>
