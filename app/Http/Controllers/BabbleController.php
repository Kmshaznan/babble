<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use App\Models\Babble;
use Illuminate\Http\Request;

class BabbleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('index',[
            'babblers' => Babble::with('user')->latest()->get(),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
         $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
 
        $request->user()->babbles()->create($validated);
 
        return redirect(route('babble.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Babble $babble)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Babble $babble)
    {
        //
        $this->authorize('update', $babble);
 
        return view('edit', [
            'babble' => $babble,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Babble $babble)
    {
        //
        $this->authorize('update', $babble);
 
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
 
        $babble->update($validated);
 
        return redirect(route('babble.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Babble $babble)
    {
        //
        $this->authorize('delete', $babble);
 
        $babble->delete();
 
        return redirect(route('babble.index'));
    }
}
