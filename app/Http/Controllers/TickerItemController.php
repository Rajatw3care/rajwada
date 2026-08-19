<?php

namespace App\Http\Controllers;

use App\Models\TickerItem;
use Illuminate\Http\Request;

class TickerItemController extends Controller
{
    public function index()
    {
        $tickerItems = TickerItem::orderBy('sort_order')->get();

        return view('ticker-items.index', compact('tickerItems'));
    }

    public function create()
    {
        return view('ticker-items.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'text' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        TickerItem::create($validated);

        return redirect()->route('ticker-items.index')->with('success', 'Ticker item added successfully');
    }

    public function edit(TickerItem $tickerItem)
    {
        return view('ticker-items.edit', compact('tickerItem'));
    }

    public function update(Request $request, TickerItem $tickerItem)
    {
        $validated = $request->validate([
            'text' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $tickerItem->update($validated);

        return redirect()->route('ticker-items.index')->with('success', 'Ticker item updated successfully');
    }

    public function destroy(TickerItem $tickerItem)
    {
        $tickerItem->delete();

        return redirect()->route('ticker-items.index')->with('success', 'Ticker item removed successfully');
    }
}
