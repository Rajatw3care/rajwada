<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesImageUploads;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use HandlesImageUploads;

    public function index()
    {
        $services = Service::orderBy('sort_order')->paginate(15);

        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);

        if ($request->hasFile('icon')) {
            $validated['icon'] = $this->storeImage($request->file('icon'), 'site/services');
        }

        Service::create($validated);

        return redirect()->route('services.index')->with('success', 'Service created successfully');
    }

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $this->validated($request);

        if ($request->hasFile('icon')) {
            $validated['icon'] = $this->storeImage($request->file('icon'), 'site/services', $service->icon);
        }

        $service->update($validated);

        return redirect()->route('services.index')->with('success', 'Service updated successfully');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index')->with('success', 'Service deleted successfully');
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
