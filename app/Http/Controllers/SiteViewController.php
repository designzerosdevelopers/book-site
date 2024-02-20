<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homepage;
use App\Models\Item;
class SiteViewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $latestItems = Item::latest()->take(3)->get();
        $heroData = Homepage::first();
        return view('clientpages.index', ['heroData'=>$heroData, 'items'=>$latestItems]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function shop()
    {
        $Items = Item::get();
        return view('clientpages.shop', ['allitems' => $Items]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
