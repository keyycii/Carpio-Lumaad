<?php

namespace App\Http\Controllers;

use App\Models\Donut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonutController extends Controller
{
    // Show index page with donuts
    public function index()
    {
        $donuts = Donut::with('user')->get(); // Eager load the user relationship
        return view('donuts.index', compact('donuts'));
    }

    // Show create form
    public function create()
    {
        return view('donuts.create');
    }

    // Store donut with image upload
    public function store(Request $request)
    {
        $request->validate([
            'flavor' => 'required|string|max:255',
            'price'  => 'required|numeric|min:0',
            'stock'  => 'required|integer|min:0',
            'image'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id(); // Assign current authenticated user

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('donuts', 'public');
        }

        Donut::create($data);

        return redirect()->route('donuts.index')->with('success', 'Donut added successfully!');
    }

    // Show edit form
    public function edit(Donut $donut)
    {
        return view('donuts.edit', compact('donut'));
    }

    // Show delete confirmation form
    public function showDeleteConfirmation(Donut $donut)
    {
        return view('donuts.delete', compact('donut'));
    }

    // Update donut with image upload
    public function update(Request $request, Donut $donut)
    {
        $request->validate([
            'flavor' => 'required|string|max:255',
            'price'  => 'required|numeric|min:0',
            'stock'  => 'required|integer|min:0',
            'image'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('donuts', 'public');
        }

        $donut->update($data);

        return redirect()->route('donuts.index')->with('success', 'Donut updated successfully!');
    }

    // Delete donut
    public function destroy(Donut $donut)
    {
        $donut->delete();
        return redirect()->route('donuts.index')->with('success', 'Donut deleted successfully!');
    }
}
