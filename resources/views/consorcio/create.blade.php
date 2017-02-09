@extends('app')

@section('content')

<div class="panel">
	<div class="panel-body">
		<h1>Inserir Consórcio</h1>
		<div class="panel panel-default">
  			<div class="panel-body">
				<ul>
					@foreach($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>

				{!! Form::open(array('route' => 'consorcio.store', 'class' => 'form-horizontal')) !!}
				<div class="form-group">
					{!! Form::label('descricao', 'Descrição', array('class' => 'col-sm-2 control-label')) !!}
					<div class="col-md-6">
						{!! Form::text('descricao', null, array('required', 'class' => 'form-control', 'placeholder' => 'Insira a descrição para o consórcio')) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('num_participantes', 'Quant. Participantes', array('class' => 'col-sm-2 control-label')) !!}
					<div class="col-md-2">
						{!! Form::number('num_participantes', null, array('class' => 'form-control')) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('vigencia_ini', 'Data Início', array('class' => 'col-sm-2 control-label')) !!}
					<div class="col-md-2">
						{!! Form::date('vigencia_ini', \Carbon\Carbon::now()->format('d/m/Y'), array('class' => 'form-control')) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('vigencia_fim', 'Data Fim', array('class' => 'col-sm-2 control-label')) !!}
					<div class="col-md-2">
						{!! Form::date('vigencia_fim', \Carbon\Carbon::now()->format('d/m/Y'), array('class' => 'form-control')) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('ativo', 'Ativo', array('class' => 'col-sm-2 control-label')) !!}
					<div class="col-md-6">
						{!! Form::checkbox('ativo', 'S', true) !!}
					</div>
				</div>
			</div>

			<div class="panel-footer text-center">
				{!! Form::submit('Salvar', array('class' => 'btn btn-primary')) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>	
</div>

@stop