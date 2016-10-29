$(document).on('ready',function(){

	$('.closebut,#but_menu,#ioMenu a').click(function(){
		$('#ioMenu').toggleClass('menu_close');
		
	});
	//timeout para los mensages
	window.setTimeout(function() {
	    $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
	        $(this).remove(); 
	    });
	}, 6000);
});