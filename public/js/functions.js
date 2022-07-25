function funPopulaSelect(classe,funcao,placeholder) {
    $(classe).select2({
		ajax: {
			url: '../../app/controllers/sisController.php?function='+funcao,
			dataType: 'json',
			type: "post",

			data: function (params) {
				return {
					searchTerm: params.term // search term
				};
			},
			processResults: function (response) {
				return {
					results: response
				};
			},
		},
		placeholder: placeholder
	});
}