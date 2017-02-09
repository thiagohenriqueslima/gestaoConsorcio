@extends('app')

@section('content')

<div class="panel">
	<div class="panel-body">
		<h1>Consórcios</h1>

		<div>
			<a href="{{ route('consorcio.create') }}">
				<button type="button" class="btn btn-primary" title="Adicionar Consórcio">
					<i class="fa fa-users" aria-hidden="true"></i>
				</button>
			</a>
		</div>

		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>

		<table class="table table-bordered table-striped" width="100%">
			<thead>
				<tr>
					<th width="10%" class="text-center">ID</th>
					<th>Descrição</th>
					<th width="10%" class="text-center">Participantes</th>
					<th width="15%" class="text-center">Início</th>
					<th width="15%" class="text-center">Fim</th>
					<th width="10%" class="text-center">Ativo</th>
					<th width="3%">&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				@foreach($consorcios as $consorcio)
					<tr>
						<td class="text-center">{{ $consorcio->id }}</td>
						<td><a href="{{ route('consorcio.edit', $consorcio->id) }}" title="Editar Consórcio">{{ $consorcio->descricao }}</a></td>
						<td class="text-center"><a href="{{ route('consorcio.edit', $consorcio->id) }}" title="Editar Consórcio">{{ $consorcio->num_participantes }}</a></td>
						<td class="text-center"><a href="{{ route('consorcio.edit', $consorcio->id) }}" title="Editar Consórcio">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $consorcio->vigencia_ini)->format('d/m/Y') }}</a></td>
						<td class="text-center"><a href="{{ route('consorcio.edit', $consorcio->id) }}" title="Editar Consórcio">{{ Carbon\Carbon::createFromFormat('Y-m-d', $consorcio->vigencia_fim)->format('d/m/Y') }}</a></td>
						<td class="text-center"><a href="{{ route('consorcio.edit', $consorcio->id) }}" title="Editar Consórcio">
							@if ($consorcio->ativo == 'S')
								Sim
							@else
								Não
							@endif
						</a></td>
						<td class="text-center">
							{!! Form::open(['method' => 'DELETE', 'route' => ['consorcio.destroy', $consorcio->id]]) !!}
								<button type="submit" class="btn btn-danger btn-xs">
									<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
								</button>
        					{!! Form::close() !!}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>	
</div>

@stop