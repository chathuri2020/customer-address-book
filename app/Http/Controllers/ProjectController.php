<?php

namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\Customer;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //
    public function index()
    {
        $customers = Customer::with('addresses')->get();
        $projects = Project::all(); // Just fetch all projects
        return view('projects.index', compact('projects','customers'));
    }

    public function create()
    {
        $customers = Customer::with('addresses')->get();
        return view('projects.create', compact('customers'));
    }

    public function store(Request $request)
    {
        // Validate the Project data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description'      => 'required|string|max:255',
        ]);

        // Create the Project
        //$Project =
         Project::create([
            'name'         => $validatedData['name'],
            'description'      => $validatedData['description'],

        ]);

        // Save multiple addresses
        //foreach ($validatedData['addresses'] as $address) {
          //  $Project->addresses()->create([
           //     'country' => $address['country'],
            //    'address_detail' => $address['addressDetail'],
            //]);
        //}

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Project and addresses added successfully!');
    }


    public function edit(Project $Project)
    {
        return view('projects.edit', compact('Project'));
    }

    public function update(Request $request, Project $Project)
    {
        $Project->update($request->only('name', 'email'));
        $Project->addresses()->update($request->input('addresses.0'));

        return redirect()->route('projects.index');
    }

    public function destroy(Project $Project)
    {
        $Project->delete();
        return redirect()->route('projects.index');
    }
}
