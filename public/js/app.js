var imgPlaceholderRecipe =  window.location.protocol + "//"+window.location.hostname+"/cooking-is-fun/public/img/recipe_placeholder.png";
var imgPlaceholderUser = window.location.protocol + "//"+window.location.hostname+"/cooking-is-fun/public/img/user.png";

function readURL(input,inputurl,imgid) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $(imgid).css("background-size", "cover")
                .attr('src', e.target.result);
            $(inputurl).val("");

        };

        reader.readAsDataURL(input.files[0]);
    }
}
function readUrlNoFile(input,imageid) {
    
    if ($(input).val() != "") {

        $(imageid).attr("src", $(input).val());
    }

}
function errorImage(img,imgtype) {

    img.onerror = '';
    img.src = imgtype==1?imgPlaceholderRecipe:imgPlaceholderUser;

}
function restoreImage(imgid,imgtype) {

    $(imgid).attr("src", imgtype==1?imgPlaceholderRecipe:imgPlaceholderUser);
}
$(window).scroll(function() {

    if ($(this).scrollTop()>0)
     {
        $('.fab').fadeIn();
     }
    else
     {
      $('.fab').fadeOut();
     }
 });
$(document).on('ready',function(){

  $('.fab').css('display','none');
  
	$('.closebut,#but_menu,#ioMenu a').click(function(){
		$('#ioMenu').toggleClass('menu_close');
		
	});
	//timeout para los mensages
	window.setTimeout(function() {
	    $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
	        $(this).remove(); 
	    });
	}, 6000);
	//check if location is home or not , if true scroll to content
	if(document.location.href.indexOf('home')==-1){
		$.scrollTo('.container-fluid',800,{
			margin:true,
			offset: {
				top:-80,left:0
			}
		});
	}
});