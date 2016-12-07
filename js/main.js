/**
 * Created by satriabagus on 11/27/16.
 */
$(document).ready(function($) {

    $('.img-review').click(function (event) {
        var id = $(this).attr('val');
        $('#buku-'+id).click();

    });


    $('#btn-add-review').click(function (e) {
        var date = $('#tanggal_review').attr("value");
        var book_id_user =  $('#book_id_review').attr("value");
        var user_id_user =  $('#user_id_review').attr("value");
        var comment_user = $('#comment').val();


        e.preventDefault();
        $.post('./_app/function/function.php', {perintah: 'add-review',book_id: book_id_user, user_id: user_id_user,tanggal: date,comment: comment_user}).done(function(){
            window.location.reload();
            return true;

        })

    })

});
