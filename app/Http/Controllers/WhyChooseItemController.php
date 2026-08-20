<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesImageUploads;
use App\Models\WhyChooseItem;
use Illuminate\Http\Request;

class WhyChooseItemController extends Controller
{
    use HandlesImageUploads;

    public function index()
    {
        $whyChooseItems = WhyChooseItem::orderBy('sort_order')->get();

        return view('why-choose-items.index', compact('whyChooseItems'));
    }

    public function create()
    {
        return view('why-choose-items.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);

        if ($request->hasFile('icon')) {
            $validated['icon'] = $this->storeImage($request->file('icon'), 'site/why-choose');
        }

        WhyChooseItem::create($validated);

        return redirect()->route('why-choose-items.index')->with('success', 'Item added successfully');
    }

    public function edit(WhyChooseItem $whyChooseItem)
    {
        return view('why-choose-items.edit', compact('whyChooseItem'));
    }

    public function update(Request $request, WhyChooseItem $whyChooseItem)
    {
        $validated = $this->validated($request);

        if ($request->hasFile('icon')) {
            $validated['icon'] = $this->storeImage($request->file('icon'), 'site/why-choose', $whyChooseItem->icon);
        }

        $whyChooseItem->update($validated);

        return redirect()->route('why-choose-items.index')->with('success', 'Item updated successfully');
    }

    public function destroy(WhyChooseItem $whyChooseItem)
    {
        $whyChooseItem->delete();

        return redirect()->route('why-choose-items.index')->with('success', 'Item removed successfully');
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
