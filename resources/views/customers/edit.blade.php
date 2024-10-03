<!-- resources/views/edit_customer_modal.blade.php -->
<div class="modal fade" id="editCustomerModal" tabindex="-1" role="dialog" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCustomerModalLabel">Edit Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Pass the customer ID to the route -->
            <form id="editCustomerForm" action="{{ route('customers.update', $customer->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Use PUT method for updating -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4"><label for="customerName"><strong>Customer Name:</strong></label></div>
                        <div class="col-md-8"><input type="text" class="form-control" id="customerName" name="customerName" value="{{ $customer->name }}" required></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><label for="company"><strong>Company:</strong></label></div>
                        <div class="col-md-8"><input type="text" class="form-control" id="company" name="company" value="{{ $customer->company }}" required></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><label for="contactPhone"><strong>Contact Phone:</strong></label></div>
                        <div class="col-md-8"><input type="text" class="form-control" id="contactPhone" name="contactPhone" value="{{ $customer->contact_phone }}" required></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><label for="email"><strong>Email:</strong></label></div>
                        <div class="col-md-8"><input type="email" class="form-control" id="email" name="email" value="{{ $customer->email }}" required></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><label for="country"><strong>Country:</strong></label></div>
                        <div class="col-md-8"><input type="text" class="form-control" id="country" name="country" value="{{ $customer->country }}" required></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><label for="addressDetail"><strong>Address Detail:</strong></label></div>
                        <div class="col-md-8"><input type="text" class="form-control" id="addressDetail" name="addressDetail" value="{{ $customer->address_detail }}" required></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Customer</button>
                </div>
            </form>
        </div>
    </div>
</div>
