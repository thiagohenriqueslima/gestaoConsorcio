@extends('app')

@section('content')

<div class="panel">
	<div class="panel-body">
		<h1>Editar Participante</h1>

		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>

		{!! Form::open(array('method' => 'PUT', 'route' => ['participante.update', $participante->id], 'class' => 'form')) !!}
		<div class="form-group">
			{!! Form::label('nome', 'Nome') !!}
			{!! Form::text('nome', $participante->nome, array('required', 'class' => 'form-control', 'placeholder' => 'Insira o nome')) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Salvar', array('class' => 'btn btn-primary')) !!}
		</div>
		{!! Form::close() !!}
	</div>	
</div>

@stop