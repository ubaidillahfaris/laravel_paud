<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostAsesmenCeklis;
use App\Models\AsesmenCeklis;
use Illuminate\Http\Request;

class AsesmenCeklisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostAsesmenCeklis $request)
    {
        $request->validate();

        try {
            AsesmenCeklis::create($request);
            return response()->json(['message' => 'Berhasil membuat data asesmen ceklis.']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Gagal membuat data asesmen ceklis.'],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AsesmenCeklis $asesmenCeklis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AsesmenCeklis $asesmenCeklis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AsesmenCeklis $asesmenCeklis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AsesmenCeklis $asesmenCeklis)
    {
        //
    }
}
