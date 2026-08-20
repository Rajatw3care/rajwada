<?php

namespace App\Http\Controllers;

use App\Models\TimelineItem;
use Illuminate\Http\Request;

class TimelineItemController extends Controller
{
    public function index()
    {
        $timelineItems = TimelineItem::orderBy('sort_order')->get();

        return view('timeline-items.index', compact('timelineItems'));
    }

    public function create()
    {
        return view('timeline-items.create');
    }

    public function store(Request $request)
    {
        TimelineItem::create($this->validated($request));

        return redirect()->route('timeline-items.index')->with('success', 'Timeline item added successfully');
    }

    public function edit(TimelineItem $timelineItem)
    {
        return view('timeline-items.edit', compact('timelineItem'));
    }

    public function update(Request $request, TimelineItem $timelineItem)
    {
        $timelineItem->update($this->validated($request));

        return redirect()->route('timeline-items.index')->with('success', 'Timeline item updated successfully');
    }

    public function destroy(TimelineItem $timelineItem)
    {
        $timelineItem->delete();

        return redirect()->route('timeline-items.index')->with('success', 'Timeline item removed successfully');
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'year' => 'required|string|max:50',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);
    }
}
