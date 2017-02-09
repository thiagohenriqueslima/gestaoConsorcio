<?php

namespace App\Http\Controllers;

use DB;
use App\Consorcio;
use App\Participante;
use App\ConsorcioParticipante;
use Illuminate\Http\Request;
use App\Http\Requests\ConsorcioRequest;

class ConsorcioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consorcios = Consorcio::all();
        return view('consorcio.index', compact('consorcios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('consorcio.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConsorcioRequest $request)
    {
        $dados = $request->all();

        $arrDtIni = explode('/', $dados['vigencia_ini']);
        $dados['vigencia_ini'] = \Carbon\Carbon::createFromDate($arrDtIni[2], $arrDtIni[1], $arrDtIni[0])->toDateString();

        $arrDtFim = explode('/', $dados['vigencia_fim']);
        $dados['vigencia_fim'] = \Carbon\Carbon::createFromDate($arrDtFim[2], $arrDtFim[1], $arrDtFim[0])->toDateString();

        if (!isset($dados['ativo'])) $dados['ativo'] = 'N';

        Consorcio::create($dados);
        $consorcios = Consorcio::all();

        return redirect()->route('consorcio.index', compact('consorcios'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $consorcio = Consorcio::findOrFail($id);
        $participantes = Participante::orderBy('nome')->get();

        $participantesConsorcio = DB::table('consorcio_participante')
            ->join('participantes', 'participantes.id', '=', 'consorcio_participante.participante_id')
            ->where('consorcio_participante.consorcio_id', $id)
            ->select('consorcio_participante.participante_id', 'participantes.nome', 'consorcio_participante.contemplado')
            ->orderBy('participantes.nome')
            ->get();

        return view('consorcio.edit', compact('consorcio', 'participantes', 'participantesConsorcio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConsorcioRequest $request, $id)
    {
        $consorcio = Consorcio::findOrFail($id);

        $dados = $request->all();

        $arrDtIni = explode('/', $dados['vigencia_ini']);
        $dados['vigencia_ini'] = \Carbon\Carbon::createFromDate($arrDtIni[2], $arrDtIni[1], $arrDtIni[0])->toDateString();

        $arrDtFim = explode('/', $dados['vigencia_fim']);
        $dados['vigencia_fim'] = \Carbon\Carbon::createFromDate($arrDtFim[2], $arrDtFim[1], $arrDtFim[0])->toDateString();

        if (!isset($dados['ativo'])) $dados['ativo'] = 'N';

        $consorcio->fill($dados)->save();

        $consorcios = Consorcio::all();
        return redirect()->route('consorcio.index', compact('consorcios'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $consorcio = Consorcio::findOrFail($id);
        $consorcio->delete();

        $consorcios = Consorcio::all();
        return redirect()->route('consorcio.index', compact('consorcios'));
    }

    public function addParticipante($consorcio_id, $participante_id)
    {
        $count = ConsorcioParticipante::where('consorcio_id', $consorcio_id)
        ->where('participante_id', $participante_id)
        ->count();

        if ($count == 0)
        {
            $participanteConsorcio = new ConsorcioParticipante;        
            $participanteConsorcio->consorcio_id = $consorcio_id;
            $participanteConsorcio->participante_id = $participante_id;
            $participanteConsorcio->contemplado = 'N';
            $participanteConsorcio->save();
        }

        $participante = DB::table('consorcio_participante')
            ->join('participantes', 'participantes.id', '=', 'consorcio_participante.participante_id')
            ->where('consorcio_participante.consorcio_id', $consorcio_id)
            ->where('consorcio_participante.participante_id', $participante_id)
            ->select('consorcio_participante.participante_id', 'participantes.nome', 'consorcio_participante.contemplado')
            ->first();

        return response()->json($participante, 200);
    }
}
