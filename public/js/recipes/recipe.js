
$('#modalconfirm').on('show.bs.modal', function (event) {
  var a = $(event.relatedTarget);
  var recipename = a.data('name');
  var id= a.data('id') ; 

  var modal = $(this);
  modal.find('#message').text('¿Seguro quieres eliminar la receta ' + recipename+'?');
  
});
