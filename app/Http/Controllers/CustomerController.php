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

    public function update(Request $request, Customer $customer)
    {
        $customer->update($request->only('name', 'email'));
        $customer->addresses()->update($request->input('addresses.0'));

        return redirect()->route('customers.index');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index');
    }
}
