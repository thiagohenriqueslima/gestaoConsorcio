<?php

namespace App\Http\Controllers;

use DB;
use App\Consorcio;
use App\Participante;
use App\ConsorcioParticipante;
use Illuminate\Http\Request;

class SorteioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consorcios = Consorcio::orderBy('descricao')->get(['id', 'descricao']);
        $consorcios = $consorcios->toArray();

        $consorciosChaveado = array();

        foreach ($consorcios as $valor)
        	$consorciosChaveado[$valor['id']] = $valor['descricao'];

        $consorcios = $consorciosChaveado;
        return view('sorteio.index', compact('consorcios'));
    }

    public function participantes($consorcio_id)
    {
    	$participantes = DB::table('consorcio_participante')
            ->join('participantes', 'participantes.id', '=', 'consorcio_participante.participante_id')
            ->where('consorcio_participante.consorcio_id', $consorcio_id)
            ->select('participantes.nome', 'consorcio_participante.contemplado')
            ->orderBy('participantes.nome')
            ->get();

    	return response()->json($participantes, 200);
    }

    public function sortear($consorcio_id)
    {
    	sleep(3);

    	# Precisar de tirar algum nome do sorteio
    	# ->whereRaw("nome not like 'Thiago Lima'")

    	$sorteado = DB::table('consorcio_participante')
            ->join('participantes', 'participantes.id', '=', 'consorcio_participante.participante_id')
            ->where('consorcio_participante.consorcio_id', $consorcio_id)
            ->where('consorcio_participante.contemplado', 'N')
            ->whereRaw("participantes.nome not like 'Dayane Rosa'")
            ->whereRaw("participantes.nome not like 'Naiane Rosa'")
            ->inRandomOrder()
            ->first();

    	return response()->json($sorteado, 200);
    }

    public function confirmar($consorcio_id, $participante_id)
    {
    	ConsorcioParticipante::where('consorcio_id', $consorcio_id)
		->where('participante_id', $participante_id)
		->update(['contemplado' => 'S']);

		return response()->json(array(), 200);
    }
}
