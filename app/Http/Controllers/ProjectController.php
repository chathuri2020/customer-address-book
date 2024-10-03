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
        $projects = Project::with('customers')->get();// Just fetch all projects
        return view('projects.index', compact('projects', 'customers'));
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
            'customers' => 'required|array', // Ensure that customers are sent as an array
            'customers.*' => 'exists:customers,id',
        ]);


        $project = Project::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
        ]);

        // Attach the customers to the project
        $project->customers()->attach($validatedData['customers']);

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
