<!-- resources/views/show_customer_modal.blade.php -->
<div class="modal fade" id="showCustomerModal" tabindex="-1" role="dialog" aria-labelledby="showCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showCustomerModalLabel">Customer Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Display customer details in two columns -->
                <div class="row">
                    <div class="col-md-4"><strong>Customer Name:</strong></div>
                    <div class="col-md-8">{{ $customer->name }}</div>
                </div>
                <div class="row">
                    <div class="col-md-4"><strong>Company:</strong></div>
                    <div class="col-md-8">{{ $customer->company }}</div>
                </div>
                <div class="row">
                    <div class="col-md-4"><strong>Contact Phone:</strong></div>
                    <div class="col-md-8">{{ $customer->contact_phone }}</div>
                </div>
                <div class="row">
                    <div class="col-md-4"><strong>Email:</strong></div>
                    <div class="col-md-8">{{ $customer->email }}</div>
                </div>
                <div class="row">
                    <div class="col-md-4"><strong>Country:</strong></div>
                    <div class="col-md-8">{{ $customer->country }}</div>
                </div>
                <div class="row">
                    <div class="col-md-4"><strong>Address Detail:</strong></div>
                    <div class="col-md-8">{{ $customer->address_detail }}</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
