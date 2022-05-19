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

class HikeController extends Controller
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
        // Get all hikes the user created
        $hikes = Hike::query()
            ->where('user_id', Auth::id())
            ->get();

        return view('hikes.index', compact('hikes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $groups = Group::all();
        return view('hikes.create', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        Debugbar::info('HikeController@store');
        Debugbar::info($request);

        $request->request->add(['user_id' => Auth::id()]);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'max:255',
            'rating' => 'min:1|max:5',
            'user_id' => 'required|integer',
        ]);

        Debugbar::info($validated);

        Hike::create($validated);

        return redirect()->route('hikes.index')
            ->with('success', 'Hike created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Hike $hike
     * @return View
     */
    public function show(Hike $hike): View
    {
        return view('hikes.show', compact('hike'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Hike $hike
     * @return View
     */
    public function edit(Hike $hike): View
    {
        Debugbar::info($hike);
        $groups = Group::all();
        return view('hikes.edit', compact('hike', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Hike $hike
     * @return RedirectResponse
     */
    public function update(Request $request, Hike $hike): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'max:255',
            'rating' => 'min:1|max:5',
        ]);

        $hike->update($validated);

        return redirect()->route('hikes.index')
            ->with('success', 'Hike updated successfully');
    }

    /**
     * Soft delete the specified resource in storage.
     *
     * @param Hike $hike
     * @return RedirectResponse
     */
    public function destroy(Hike $hike): RedirectResponse
    {
        $hike->delete();

        return redirect()->route('hikes.index')
            ->with('success', 'Hike deleted successfully');
    }
}
