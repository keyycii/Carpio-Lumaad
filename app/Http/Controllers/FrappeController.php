<?php

namespace App\Http\Controllers;

use App\Models\Frappe;
use Illuminate\Http\Request;

class FrappeController extends Controller
{
    // show all frappes
    public function index()
    {
        $frappes = Frappe::all();
        return view('frappes.index', compact('frappes'));
    }

    // show create form
    public function create()
    {
        return view('frappes.create');
    }

    // save new frappe with image upload
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'size' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('frappes', 'public');
        }

        Frappe::create($data);

        return redirect()->route('frappes.index')->with('success', 'Frappe added successfully!');
    }

    // show edit form
    public function edit(Frappe $frappe)
    {
        return view('frappes.edit', compact('frappe'));
    }

    // show delete confirmation form
    public function showDeleteConfirmation(Frappe $frappe)
    {
        return view('frappes.delete', compact('frappe'));
    }

    // update frappe with image upload
    public function update(Request $request, Frappe $frappe)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'size' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('frappes', 'public');
        }

        $frappe->update($data);

        return redirect()->route('frappes.index')->with('success', 'Frappe updated successfully!');
    }

    // delete frappe
    public function destroy(Frappe $frappe)
    {
        $frappe->delete();
        return redirect()->route('frappes.index')->with('success', 'Frappe deleted successfully!');
    }
}
