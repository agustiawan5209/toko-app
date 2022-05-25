<?php

namespace App\Http\Controllers;

use App\Models\pesan;
use App\Http\Requests\StorepesanRequest;
use App\Http\Requests\UpdatepesanRequest;

class PesanController extends Controller
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
     * @param  \App\Http\Requests\StorepesanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepesanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pesan  $pesan
     * @return \Illuminate\Http\Response
     */
    public function show(pesan $pesan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pesan  $pesan
     * @return \Illuminate\Http\Response
     */
    public function edit(pesan $pesan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepesanRequest  $request
     * @param  \App\Models\pesan  $pesan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepesanRequest $request, pesan $pesan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pesan  $pesan
     * @return \Illuminate\Http\Response
     */
    public function destroy(pesan $pesan)
    {
        //
    }
}
