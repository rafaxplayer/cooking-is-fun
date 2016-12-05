$('.edit_user').on('click',function(e){
		e.preventDefault();
		var url = window.location.href;
		var id = $(this).attr('id');
		var finalurl = url.replace('users','user/'+id);
		console.log(finalurl);
		$.ajax({
                data:  [],
                url:   finalurl,
                type:  'get',
                beforeSend: function () {
                        $(".users").html("Procesando, espere por favor...");
                },
                success:  function (data) {
                    
                    $(".users").html(data);
                }
        });
});

$('#modal_admin_confirm').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  // Button that triggered the modal
  var username = button.data('user'); 
  var $form = button.prev();
  var modal = $(this);

  modal.find('#myModalLabel').text('Eliminar Ususario')
  modal.find('#message').text("¿Seguro quieres eliminar el usuario "+username);

  $('#delete-btn').on('click',function(){
  	$form.submit();
  	
  }); 
})

$('#manten').change(function(){
  var token = $('meta[name="csrf-token"]').attr('content');
  var bool=$(this).prop('checked')?1:0;
  var parametros={'manten' : bool,'_token':token};
  $.post('http://localhost/cooking-is-fun/admin/manten',parametros,function(data){
    
  });

});
