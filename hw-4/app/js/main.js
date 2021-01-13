function submitMovieEdit(id){
    // console.log($("#editMovie").val())
    $("#editMovie-"+id).val(1);
    $("#form-"+id).submit();
}
function deleteMovie(id){
    $("#deleteMovie-"+id).val(1);
    $("#form-"+id).submit();
}