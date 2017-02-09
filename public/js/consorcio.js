var Consorcio = {

	addParticipante:function(consorcio_id, participante_id)
	{
		$.ajax({
			type: "GET",
			url: "/consorcio/participante/" + consorcio_id + "/" + participante_id,
			success: function(data) {
				var contemplado = 'Não';

				if (data.contemplado == 'S')
					contemplado = 'Sim';

				$('table#participantes-consorcio').find('tbody tr#' + data.participante_id).remove();
				$('table#participantes-consorcio').find('tbody').append('<tr id="'+ data.participante_id +'"><td class="text-center">'+ data.participante_id +'</td><td>'+ data.nome +'</td><td class="text-center">'+ contemplado +'</td></tr>');
			}
		});
	}
}