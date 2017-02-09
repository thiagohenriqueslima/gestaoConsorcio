@extends('app')

@section('content')

<div class="panel">
	<div class="panel-body">
		<h1>Participantes</h1>

		<div>
			<a href="{{ route('participante.create') }}">
				<button type="button" class="btn btn-primary" title="Adicionar Participante">
					<i class="fa fa-user-plus" aria-hidden="true"></i>
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
					<th>Nome</th>
					<th width="3%">&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				@foreach($participantes as $participante)
					<tr>
						<td class="text-center">{{ $participante->id }}</td>
						<td><a href="{{ route('participante.edit', $participante->id) }}" title="Editar Participante">{{ $participante->nome }}</a></td>
						<td class="text-center">
							{!! Form::open(['method' => 'DELETE', 'route' => ['participante.destroy', $participante->id]]) !!}
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