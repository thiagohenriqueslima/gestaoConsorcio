<?php

namespace App\Http\Controllers;

use App\Participante;
use Illuminate\Http\Request;
use App\Http\Requests\ParticipanteRequest;

class ParticipanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $participantes = Participante::all();
        return view('participante.index', compact('participantes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('participante.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParticipanteRequest $request)
    {
        Participante::create($request->all());
        $participantes = Participante::all();

        return redirect()->route('participante.index', compact('participantes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $participante = Participante::findOrFail($id);
        return view('participante.edit', compact('participante'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ParticipanteRequest $request, $id)
    {
        $participante = Participante::findOrFail($id);
        $participante->fill($request->all())->save();

        $participantes = Participante::all();
        return redirect()->route('participante.index', compact('participantes'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $participante = Participante::findOrFail($id);
        $participante->delete();

        $participantes = Participante::all();
        return redirect()->route('participante.index', compact('participantes'));
    }
}
