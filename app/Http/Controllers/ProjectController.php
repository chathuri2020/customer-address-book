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


    public function edit(Project $project)
    {
        $customers = Customer::with('addresses')->get();
        return view('projects.edit', compact('project', 'customers'));
    }

    public function update(Request $request, $id)
{

    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'customers' => 'required|array',
        'customers.*' => 'exists:customers,id',
    ]);

    $project = Project::findOrFail($id);
    $project->update([
        'name' => $validatedData['name'],
        'description' => $validatedData['description'],
    ]);

    $project->customers()->sync($validatedData['customers']);

    return redirect()->back()->with('success', 'Project updated and customers updated successfully!');
}


    public function destroy(Project $Project)
    {
        $Project->delete();
        return redirect()->route('projects.index');
    }
}
