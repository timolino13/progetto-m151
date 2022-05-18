<?php

namespace App\Http\Controllers;

use App\Models\Hike;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        Debugbar::info('HikeController@index');

        $hikes = Hike::all();
        Debugbar::info($hikes);

        return view('hikes.index', compact('hikes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('hikes.create');
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

        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'max:255',
            'rating' => 'integer|min:1|max:5',
        ]);

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
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $hike = Hike::findOrFail($id);

        return view('hikes.edit', compact('hike'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'rating' => 'integer|min:1|max:5',
        ]);

        $hike = Hike::findOrFail($id);

        $hike->update($validated);

        return redirect()->route('hikes.index')
            ->with('success', 'Hike updated successfully');
    }

    /**
     * Soft delete the specified resource in storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
   public function delete(int $id): RedirectResponse
    {
        $hike = Hike::findOrFail($id);

        $hike->delete();

        return redirect()->route('hikes.index')
            ->with('success', 'Hike deleted successfully');
    }
}
