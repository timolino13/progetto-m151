<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Hike;
use App\Models\User;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class GroupController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $groups = auth()->user()->groups()->get();

        Debugbar::info($groups);

        return view('groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {

        $request->request->add(['user_id' => Auth::id()]);

        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'max:255',
            'user_id' => 'required|integer',
        ]);

        $group = Group::create($validated);

        $group->users()->attach(Auth::id());

        return redirect()->route('groups.index')
            ->with('success', 'Group created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Group $group
     * @return View
     */
    public function show(Group $group): View
    {
        // Get all the hikes in the group
        $hikes = $group->hikes()->get();

        return view('groups.show', compact('group', 'hikes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Group $group
     * @return View
     */
    public function edit(Group $group): View
    {
        Debugbar::info($group);
        return view('groups.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Group $group
     * @return RedirectResponse
     */
    public function update(Request $request, Group $group): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'max:255',
        ]);

        $group->update($validated);

        return redirect()->route('groups.index')
            ->with('success', 'Group updated successfully');
    }

    /**
     * Soft delete the specified resource in storage.
     *
     * @param Group $group
     * @return RedirectResponse
     */
    public function destroy(Group $group): RedirectResponse
    {
        $group->delete();

        return redirect()->route('groups.index')
            ->with('success', 'Group deleted successfully');
    }

    /**
     * Add the current user to a group
     *
     * @param Group $group
     * @return RedirectResponse
     */
    public function join(Group $group): RedirectResponse
    {
        $group->users()->attach(Auth::id());

        return redirect()->route('groups.index')
            ->with('success', 'User added to group successfully');
    }
}
