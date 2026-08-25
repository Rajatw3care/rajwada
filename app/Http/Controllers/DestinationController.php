<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesImageUploads;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    use HandlesImageUploads;

    public function index()
    {
        $destinations = Destination::orderBy('sort_order')->paginate(15);

        return view('destinations.index', compact('destinations'));
    }

    public function create()
    {
        return view('destinations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|max:4096',
            'name' => 'required|string|max:255',
            'count_label' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['image'] = $this->storeImage($request->file('image'), 'site/destinations');

        Destination::create($validated);

        return redirect()->route('destinations.index')->with('success', 'Destination created successfully');
    }

    public function edit(Destination $destination)
    {
        return view('destinations.edit', compact('destination'));
    }

    public function update(Request $request, Destination $destination)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|max:4096',
            'name' => 'required|string|max:255',
            'count_label' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $validated['image'] = $this->storeImage($request->file('image'), 'site/destinations', $destination->image);
        }

        $destination->update($validated);

        return redirect()->route('destinations.index')->with('success', 'Destination updated successfully');
    }

    public function destroy(Destination $destination)
    {
        $destination->delete();

        return redirect()->route('destinations.index')->with('success', 'Destination deleted successfully');
    }
}
