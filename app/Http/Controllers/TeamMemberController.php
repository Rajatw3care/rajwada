<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesImageUploads;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    use HandlesImageUploads;

    public function index()
    {
        $teamMembers = TeamMember::orderBy('sort_order')->get();

        return view('team-members.index', compact('teamMembers'));
    }

    public function create()
    {
        return view('team-members.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $this->storeImage($request->file('photo'), 'site/team');
        }

        TeamMember::create($validated);

        return redirect()->route('team-members.index')->with('success', 'Team member added successfully');
    }

    public function edit(TeamMember $teamMember)
    {
        return view('team-members.edit', compact('teamMember'));
    }

    public function update(Request $request, TeamMember $teamMember)
    {
        $validated = $this->validated($request);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $this->storeImage($request->file('photo'), 'site/team', $teamMember->photo);
        }

        $teamMember->update($validated);

        return redirect()->route('team-members.index')->with('success', 'Team member updated successfully');
    }

    public function destroy(TeamMember $teamMember)
    {
        $teamMember->delete();

        return redirect()->route('team-members.index')->with('success', 'Team member removed successfully');
    }

    protected function validated(Request $request): array
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'sort_order' => 'nullable|integer',
        ]);
        $validated['is_active'] = $request->boolean('is_active');

        return $validated;
    }
}
