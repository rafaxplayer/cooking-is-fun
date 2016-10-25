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

function restoreImage(imgid) {

    $(imgid).attr("src", "../public/img/recipe_placeholder.png");
}

function errorImage(img) {
    img.onerror = '';
    img.src = "../public/recipe_placeholder.png";

}
