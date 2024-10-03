<!-- resources/views/customer_modal.blade.php -->
<div class="modal fade" id="addCustomerModal" tabindex="-1" role="dialog" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCustomerModalLabel">Add New Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addCustomerForm" action="{{ route('customers.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="customerName">Customer Name</label>
                        <input type="text" class="form-control" id="customerName" name="customerName" required>
                    </div>
                    <div class="form-group">
                        <label for="company">Company</label>
                        <input type="text" class="form-control" id="company" name="company" required>
                    </div>
                    <div class="form-group">
                        <label for="contactPhone">Contact Phone</label>
                        <input type="text" class="form-control" id="contactPhone" name="contactPhone" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" class="form-control" id="country" name="country" required>
                    </div>

                    <h6>Address Details</h6>
                    <div id="addressContainer">
                        <div class="address-group mb-2 d-flex align-items-start">
                            <input type="text" class="form-control me-2" name="address_line_1[]" required placeholder="Address Line 1">
                            <input type="text" class="form-control me-2" name="address_line_2[]" placeholder="Address Line 2">
                            <input type="text" class="form-control me-2" name="city[]" required placeholder="City">
                            <input type="text" class="form-control me-2" name="state[]" required placeholder="State">
                            <input type="text" class="form-control me-2" name="zip_code[]" required placeholder="ZIP Code">
                            <button type="button" class="btn btn-danger remove-address">Remove</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success" id="addAddress">Add Address</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Customer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('addAddress').addEventListener('click', function() {
        const addressContainer = document.getElementById('addressContainer');
        const addressGroup = document.createElement('div');
        addressGroup.className = 'address-group mb-2 d-flex align-items-start';
        addressGroup.innerHTML = `
            <input type="text" class="form-control me-2" name="address_line_1[]" required placeholder="Address Line 1">
            <input type="text" class="form-control me-2" name="address_line_2[]" placeholder="Address Line 2">
            <input type="text" class="form-control me-2" name="city[]" required placeholder="City">
            <input type="text" class="form-control me-2" name="state[]" required placeholder="State">
            <input type="text" class="form-control me-2" name="zip_code[]" required placeholder="ZIP Code">
            <button type="button" class="btn btn-danger remove-address">Remove</button>
        `;
        addressContainer.appendChild(addressGroup);
    });

    document.getElementById('addressContainer').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-address')) {
            e.target.parentElement.remove();
        }
    });
</script>
