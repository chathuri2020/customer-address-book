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
        // Validate the customer data
        $validatedData = $request->validate([
            'customerName' => 'required|string|max:255',
            'company'      => 'required|string|max:255',
            'contactPhone' => 'required|string|max:15',
            'email'        => 'required|email|max:255',
          //  'addresses.*.country' => 'required|string|max:255',
            //'addresses.*.addressDetail' => 'required|string|max:500',
        ]);

        // Create the customer
        //$customer =
         Customer::create([
            'name'         => $validatedData['customerName'],
            'company'      => $validatedData['company'],
            'contact_phone'=> $validatedData['contactPhone'],
            'email'        => $validatedData['email'],
        ]);

        // Save multiple addresses
        //foreach ($validatedData['addresses'] as $address) {
          //  $customer->addresses()->create([
           //     'country' => $address['country'],
            //    'address_detail' => $address['addressDetail'],
            //]);
        //}

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
        // Uncomment if you are using addresses
        // 'addresses.*.country' => 'required|string|max:255',
        // 'addresses.*.addressDetail' => 'required|string|max:500',
    ]);

    // Find the customer by ID
    $customer = Customer::findOrFail($id);

    // Update the customer details
    $customer->name = $validatedData['customerName'];
    $customer->company = $validatedData['company'];
    $customer->contact_phone = $validatedData['contactPhone'];
    $customer->email = $validatedData['email'];

    // Save the updated customer
    $customer->save();

    // Uncomment if you are updating addresses
    // if (isset($validatedData['addresses'])) {
    //     foreach ($validatedData['addresses'] as $address) {
    //         $customer->addresses()->updateOrCreate(
    //             ['id' => $address['id']], // Assuming you have an ID for the address to update
    //             [
    //                 'country' => $address['country'],
    //                 'address_detail' => $address['addressDetail'],
    //             ]
    //         );
    //     }
    // }

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Customer updated successfully!');
}


    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index');
    }
}
