@extends('app')

@section('content')

<div class="panel">
	<div class="panel-body">
		<h1>Editar Consórcio</h1>

		<div>
			<ul id="myTabs" class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active">
					<a href="#form" aria-controls="form" role="tab" data-toggle="tab">Cadastro</a>
				</li>

				<li role="presentation" class="">
					<a href="#participantes" aria-controls="participantes" role="tab" data-toggle="tab">Participantes</a>
				</li>
			</ul>

			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="form">
					<div class="panel panel-default" style="border-top: none;">
  						<div class="panel-body">
							<ul>
								@foreach($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
							{!! Form::open(array('method' => 'PUT', 'route' => ['consorcio.update', $consorcio->id], 'class' => 'form-horizontal')) !!}
								<div class="form-group">
									{!! Form::label('descricao', 'Descrição', array('class' => 'col-sm-2 control-label')) !!}
									<div class="col-md-6">
										{!! Form::text('descricao', $consorcio->descricao, array('required', 'class' => 'form-control', 'placeholder' => 'Informe a descrição para o consórcio')) !!}
									</div>
								</div>

								<div class="form-group">
									{!! Form::label('num_participantes', 'Quant. Participantes', array('class' => 'col-sm-2 control-label')) !!}
									<div class="col-md-2">
										{!! Form::number('num_participantes', $consorcio->num_participantes, array('class' => 'form-control')) !!}
									</div>
								</div>

								<div class="form-group">
									{!! Form::label('vigencia_ini', 'Data Início', array('class' => 'col-sm-2 control-label')) !!}
									<div class="col-md-2">
										{!! Form::date('vigencia_ini', \Carbon\Carbon::createFromFormat('Y-m-d', $consorcio->vigencia_ini)->format('d/m/Y'), array('class' => 'form-control')) !!}
									</div>
								</div>

								<div class="form-group">
									{!! Form::label('vigencia_fim', 'Data Fim', array('class' => 'col-sm-2 control-label')) !!}
									<div class="col-md-2">
										{!! Form::date('vigencia_fim', \Carbon\Carbon::createFromFormat('Y-m-d', $consorcio->vigencia_fim)->format('d/m/Y'), array('class' => 'form-control')) !!}
									</div>
								</div>

								<div class="form-group">
									{!! Form::label('ativo', 'Ativo', array('class' => 'col-sm-2 control-label')) !!}
									<div class="col-md-6">
										@if ($consorcio->ativo == 'S')
											{!! Form::checkbox('ativo', 'S', true) !!}
										@else
											{!! Form::checkbox('ativo', 'S') !!}
										@endif
									</div>
								</div>
							</div>

							<div class="panel-footer text-center">
								{!! Form::submit('Salvar', array('class' => 'btn btn-primary')) !!}
							</div>
							{!! Form::close() !!}
						</div>
					</div>

					<div role="tabpanel" class="tab-pane" id="participantes">
						<div class="panel panel-default" style="border-top: none;">
  							<div class="panel-body">

	  							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#participantes-modal" title="Adicionar Participante">
	  								<i class="fa fa-user-plus" aria-hidden="true"></i>
								</button>

								@component('consorcio.modal')
									<table class="table table-bordered table-striped table-condensed">
										<tbody>
											@foreach ($participantes as $participante)
												<tr>
													<td>{{ $participante->nome }}</td>
													<td width="5%">
														<button type="button" class="btn btn-primary btn-xs text-center" onclick="Consorcio.addParticipante({{ $consorcio->id }}, {{ $participante->id }})">
															<i class="fa fa-plus" aria-hidden="true"></i>
														</button>
													</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								@endcomponent

								<br /><br />

								<table id="participantes-consorcio" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th class="text-center" width="10%">ID</th>
											<th>Nome</th>
											<th class="text-center" width="10%">Contemplado</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($participantesConsorcio as $participante)
											<tr id="{{ $participante->participante_id }}">
												<td class="text-center">{{ $participante->participante_id }}</td>
												<td>{{ $participante->nome }}</td>
												<td class="text-center">
													@if ($participante->contemplado == 'S')
														Sim
													@else
														Não
													@endif
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<script src="{{asset('js/consorcio.js')}}"></script>

@stop