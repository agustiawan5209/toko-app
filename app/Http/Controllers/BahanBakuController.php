<?php

namespace App\Http\Controllers;

use App\Models\bahan_baku;
use App\Http\Requests\Storebahan_bakuRequest;
use App\Http\Requests\Updatebahan_bakuRequest;

class BahanBakuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Storebahan_bakuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storebahan_bakuRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\bahan_baku  $bahan_baku
     * @return \Illuminate\Http\Response
     */
    public function show(bahan_baku $bahan_baku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\bahan_baku  $bahan_baku
     * @return \Illuminate\Http\Response
     */
    public function edit(bahan_baku $bahan_baku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatebahan_bakuRequest  $request
     * @param  \App\Models\bahan_baku  $bahan_baku
     * @return \Illuminate\Http\Response
     */
    public function update(Updatebahan_bakuRequest $request, bahan_baku $bahan_baku)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\bahan_baku  $bahan_baku
     * @return \Illuminate\Http\Response
     */
    public function destroy(bahan_baku $bahan_baku)
    {
        //
    }
}
