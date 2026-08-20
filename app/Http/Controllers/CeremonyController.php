<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesImageUploads;
use App\Models\Ceremony;
use Illuminate\Http\Request;

class CeremonyController extends Controller
{
    use HandlesImageUploads;

    public function index()
    {
        $ceremonies = Ceremony::orderBy('sort_order')->get();

        return view('ceremonies.index', compact('ceremonies'));
    }

    public function create()
    {
        return view('ceremonies.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);

        if ($request->hasFile('icon')) {
            $validated['icon'] = $this->storeImage($request->file('icon'), 'site/services');
        }

        Ceremony::create($validated);

        return redirect()->route('ceremonies.index')->with('success', 'Ceremony added successfully');
    }

    public function edit(Ceremony $ceremony)
    {
        return view('ceremonies.edit', compact('ceremony'));
    }

    public function update(Request $request, Ceremony $ceremony)
    {
        $validated = $this->validated($request);

        if ($request->hasFile('icon')) {
            $validated['icon'] = $this->storeImage($request->file('icon'), 'site/services', $ceremony->icon);
        }

        $ceremony->update($validated);

        return redirect()->route('ceremonies.index')->with('success', 'Ceremony updated successfully');
    }

    public function destroy(Ceremony $ceremony)
    {
        $ceremony->delete();

        return redirect()->route('ceremonies.index')->with('success', 'Ceremony removed successfully');
    }

    protected function validated(Request $request): array
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|image|max:2048',
            'sort_order' => 'nullable|integer',
        ]);
        $validated['is_active'] = $request->boolean('is_active');

        return $validated;
    }
}
