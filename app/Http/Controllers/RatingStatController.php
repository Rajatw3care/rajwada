<?php

namespace App\Http\Controllers;

use App\Models\RatingStat;
use Illuminate\Http\Request;

class RatingStatController extends Controller
{
    public function index()
    {
        $ratingStats = RatingStat::orderBy('sort_order')->paginate(15);

        return view('rating-stats.index', compact('ratingStats'));
    }

    public function create()
    {
        return view('rating-stats.create');
    }

    public function store(Request $request)
    {
        RatingStat::create($this->validated($request));

        return redirect()->route('rating-stats.index')->with('success', 'Rating stat created successfully');
    }

    public function edit(RatingStat $ratingStat)
    {
        return view('rating-stats.edit', compact('ratingStat'));
    }

    public function update(Request $request, RatingStat $ratingStat)
    {
        $ratingStat->update($this->validated($request));

        return redirect()->route('rating-stats.index')->with('success', 'Rating stat updated successfully');
    }

    public function destroy(RatingStat $ratingStat)
    {
        $ratingStat->delete();

        return redirect()->route('rating-stats.index')->with('success', 'Rating stat deleted successfully');
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'icon' => 'nullable|string|max:10',
            'number' => 'required|string|max:50',
            'label' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);
    }
}
