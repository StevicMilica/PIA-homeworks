function submitMovieEdit(id){
    // console.log($("#editMovie").val())
    $("#editMovie-"+id).val(1);
    $("#form-"+id).submit();
}
function deleteMovie(id){
    $("#deleteMovie-"+id).val(1);
    $("#form-"+id).submit();
}

$(".display-mode i").click(function(){
    if(event.target.id == 'list'){
        $(event.target).removeClass('bi-list').addClass('bi-list-ul').addClass('active')
        $("#grid").removeClass('bi-grid-fill').removeClass('active').addClass('bi-grid')
        $('#container').removeClass("content-grid").addClass('content-list');
        $("#content").removeClass("movies-grid").addClass('movies-list');
    }
    if(event.target.id == 'grid'){
        $(event.target).removeClass('bi-grid').addClass('bi-grid-fill').addClass('active')
        $("#list").removeClass('bi-list-ull').removeClass('active').addClass('bi-list')
        $("#container").removeClass('content-list').addClass('content-grid');
        $("#content").removeClass("movies-list").addClass('movies-grid');

    }
})