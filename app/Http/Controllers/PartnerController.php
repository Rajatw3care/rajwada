<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesImageUploads;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    use HandlesImageUploads;

    public function index()
    {
        $partners = Partner::orderBy('sort_order')->get();

        return view('partners.index', compact('partners'));
    }

    public function create()
    {
        return view('partners.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $this->storeImage($request->file('logo'), 'site/partners');
        }

        Partner::create($validated);

        return redirect()->route('partners.index')->with('success', 'Partner added successfully');
    }

    public function edit(Partner $partner)
    {
        return view('partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $validated = $this->validated($request);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $this->storeImage($request->file('logo'), 'site/partners', $partner->logo);
        }

        $partner->update($validated);

        return redirect()->route('partners.index')->with('success', 'Partner updated successfully');
    }

    public function destroy(Partner $partner)
    {
        $partner->delete();

        return redirect()->route('partners.index')->with('success', 'Partner removed successfully');
    }

    protected function validated(Request $request): array
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'sort_order' => 'nullable|integer',
        ]);
        $validated['is_active'] = $request->boolean('is_active');

        return $validated;
    }
}
