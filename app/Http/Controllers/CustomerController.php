<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Address;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with('addresses')->get();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        // Validate the customer data along with the dynamic addresses
        $validatedData = $request->validate([
            'customerName' => 'required|string|max:255',
            'company'      => 'required|string|max:255',
            'contactPhone' => 'required|string|max:15',
            'email'        => 'required|email|max:255',
            'address_line_1.*' => 'required|string|max:500', // Validating address line 1
            'address_line_2.*' => 'nullable|string|max:500', // Validating address line 2 (optional)
            'city.*'            => 'required|string|max:255', // Validating city
            'state.*'           => 'required|string|max:255', // Validating state
            'zip_code.*'       => 'required|string|max:20', // Validating zip code
        ]);

        // Create the customer
        $customer = Customer::create([
            'name'         => $validatedData['customerName'],
            'company'      => $validatedData['company'],
            'contact_phone' => $validatedData['contactPhone'],
            'email'        => $validatedData['email'],
        ]);

        // Check if there are addresses provided and save them
        if (isset($validatedData['address_line_1'])) {
            foreach ($validatedData['address_line_1'] as $index => $addressLine1) {
                $customer->addresses()->create([
                    'address_line_1' => $addressLine1,
                    'address_line_2' => $validatedData['address_line_2'][$index] ?? null,
                    'city'           => $validatedData['city'][$index],
                    'state'          => $validatedData['state'][$index],
                    'zip_code'       => $validatedData['zip_code'][$index],
                ]);
            }
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Customer and addresses added successfully!');
    }



    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        // Validate the customer data
        $validatedData = $request->validate([
            'customerName' => 'required|string|max:255',
            'company'      => 'required|string|max:255',
            'contactPhone' => 'required|string|max:15',
            'email'        => 'required|email|max:255',
            'addresses.*.address_line_1' => 'required|string|max:500',
            'addresses.*.address_line_2' => 'nullable|string|max:500',
            'addresses.*.city' => 'required|string|max:255',
            'addresses.*.state' => 'required|string|max:255',
            'addresses.*.zip_code' => 'required|string|max:20',
        ]);

        // Update the customer
        $customer = Customer::findOrFail($id);
        $customer->update([
            'name'         => $validatedData['customerName'],
            'company'      => $validatedData['company'],
            'contact_phone'=> $validatedData['contactPhone'],
            'email'        => $validatedData['email'],
        ]);

        // Update addresses
        $customer->addresses()->delete(); // Remove existing addresses
        foreach ($validatedData['addresses'] as $addressData) {
            $customer->addresses()->create($addressData);
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Customer and addresses updated successfully!');
    }



    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index');
    }
}
