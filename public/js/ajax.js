/*
---------Paginacija-----------
$(document).ready(function () {
    $('.paginacija').on('click','.pagination a', function (e) {
        e.preventDefault();
        var page=$(this).attr('href').split('page=')[1];
        smestaji(page);
    });
     function smestaji(page){
         $.ajax({
             url: url+"/ajax?page="+page
         }).done(function(res){
             $('.smestaji').html(res);
         });

     }

});*/
function anketa(id) {
    $.ajax({
        url: url+"anketa/"+id
    }).done(function(res){
        $('#odgovori').html(res);
    });
}