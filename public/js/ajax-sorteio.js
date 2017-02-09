var Sorteio = {

	getParticipantes:function()
	{
		var consorcio_id = $('select#consorcio').val();

		$.ajax({
			type: "GET",
			url: "/sorteio/participantes/" + consorcio_id,
			success: function (data) {
				$('#info-sorteio').show();
				$('#lista-participantes').html('');
				$('#lista-participantes').append('<li class="list-group-item active">Participantes do Consórcio</li>');
				$(data).each(function(i) {
					if (data[i].contemplado == 'S')
						$('#lista-participantes').append('<li class="list-group-item list-group-item-info">' + data[i].nome + '</li>');
					else
						$('#lista-participantes').append('<li class="list-group-item">' + data[i].nome + '</li>');

					$('#nome-sorteado').html('');
				})
			}
		});
	},

	sortear:function()
	{
		var consorcio_id = $('select#consorcio').val();

		if (!consorcio_id) {
			alert("Selecione o consórcio antes de realizar o sorteio!");
			return false;
		}

		$.ajax({
			type: "GET",
			url: "/sorteio/sortear/" + consorcio_id,
			beforeSend: function() {
				$('#nome-sorteado').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span></div>');
			},
			success: function(data) {
				$('#nome-sorteado').html('');
				$('#nome-sorteado').append('<h2 style="float: left;">' + data.nome + '</h2>');
				$('#nome-sorteado').append('<button type="button" class="btn btn-success" style="float: right; margin-top: 18px;" title="Confirmar Sorteio" onclick="Sorteio.confirmar('+ consorcio_id +', '+ data.id +')"><i class="fa fa-check" aria-hidden="true"></i></button>');
			}
		});
	},

	confirmar:function(consorcio_id, participante_id)
	{
		$.ajax({
			type: "GET",
			url: "/sorteio/confirmar/" + consorcio_id + "/" + participante_id,
			success: function(data) {
				Sorteio.getParticipantes();
			}
		});
	}
}