@extends('app')

@section('content')

<div class="panel">
	<div class="panel-body">
		<h1>Sorteio</h1>

		<div class="form-horizontal">
			<div class="form-group">
				{!! Form::label('consorcio', 'Consórcio', array('class' => 'col-sm-1 control-label')) !!}
				<div class="col-md-4">
					{!! Form::select('consorcio', $consorcios, null, ['class' => 'form-control', 'placeholder' => 'Selecione', 'onchange' => 'Sorteio.getParticipantes()']) !!}
				</div>

				{!! Form::button('Realizar Sorteio', array('class' => 'btn btn-primary', 'onclick' => 'Sorteio.sortear()', 'title' => 'Realizar Sorteio')) !!}
			</div>
		</div>

		<div id="info-sorteio" class="panel panel-default" style="display: none;">
			<div class="panel-body">

				<ul id="lista-participantes" class="list-group" style="width: 50%;float: left;">
					
				</ul>

				<div class="panel panel-success" style="width: 45%;float: right;">
					<div class="panel-heading"><h1 class="panel-title">Sorteado</h1></div>
					<div id="nome-sorteado" class="panel-body">
						<div id="loading" class="text-center" style="display: none;">
							<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
							<span class="sr-only">Loading...</span>
						</div>
					</div>
				</div>

			</div>
		</div>		
	</div>	
</div>

<script src="{{asset('js/ajax-sorteio.js')}}"></script>

@stop