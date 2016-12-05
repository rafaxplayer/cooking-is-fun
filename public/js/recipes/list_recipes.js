
function onChangeCat(id){

	var token=$('meta[name="csrf-token"]').attr('content');
	var parametros={'id' : id,'_token':token};

	$.post('http://localhost/cooking-is-fun/recipes/category',parametros ,function(data){
			
		$( "#list_recipes" ).html(data);
	})
}

function search(pattern){
	
	var token = $('meta[name="csrf-token"]').attr('content');
	var parametros = {'pattern':pattern,'_token':token};

	$.post('http://localhost/cooking-is-fun/recipes/search', parametros, function(data){
		$( "#list_recipes" ).html(data);
	})
}
