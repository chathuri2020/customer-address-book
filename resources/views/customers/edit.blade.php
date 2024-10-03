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

                    <!-- Addresses Section -->
                    <div class="row">
                        <div class="col-md-4"><strong>Addresses:</strong></div>
                        <div class="col-md-8">
                            <div id="addressList">
                                @foreach($customer->addresses as $index => $address)
                                <div class="address-group mb-2">
                                    <input type="text" class="form-control mb-1" name="addresses[{{ $index }}][address_line_1]" placeholder="Address Line 1" value="{{ $address->address_line_1 }}" required>
                                    <input type="text" class="form-control mb-1" name="addresses[{{ $index }}][address_line_2]" placeholder="Address Line 2" value="{{ $address->address_line_2 }}">
                                    <input type="text" class="form-control mb-1" name="addresses[{{ $index }}][city]" placeholder="City" value="{{ $address->city }}" required>
                                    <input type="text" class="form-control mb-1" name="addresses[{{ $index }}][state]" placeholder="State" value="{{ $address->state }}" required>
                                    <input type="text" class="form-control mb-1" name="addresses[{{ $index }}][zip_code]" placeholder="Zip Code" value="{{ $address->zip_code }}" required>
                                    <button type="button" class="btn btn-danger remove-address">Remove</button>
                                </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-secondary add-address">Add Address</button>
                        </div>
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

<script>
    // Script to handle adding and removing address fields
    document.addEventListener('DOMContentLoaded', function() {
        let addressIndex = {{ count($customer->addresses) }};

        document.querySelector('.add-address').addEventListener('click', function() {
            const addressGroup = document.createElement('div');
            addressGroup.className = 'address-group mb-2';
            addressGroup.innerHTML = `
                <input type="text" class="form-control mb-1" name="addresses[${addressIndex}][address_line_1]" placeholder="Address Line 1" required>
                <input type="text" class="form-control mb-1" name="addresses[${addressIndex}][address_line_2]" placeholder="Address Line 2">
                <input type="text" class="form-control mb-1" name="addresses[${addressIndex}][city]" placeholder="City" required>
                <input type="text" class="form-control mb-1" name="addresses[${addressIndex}][state]" placeholder="State" required>
                <input type="text" class="form-control mb-1" name="addresses[${addressIndex}][zip_code]" placeholder="Zip Code" required>
                <button type="button" class="btn btn-danger remove-address">Remove</button>
            `;
            document.getElementById('addressList').appendChild(addressGroup);
            addressIndex++;
        });

        document.getElementById('addressList').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-address')) {
                e.target.closest('.address-group').remove();
            }
        });
    });
</script>
