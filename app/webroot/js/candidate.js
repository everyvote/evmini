$(function(){
    $('.add-comment').click(function() {
        $('#add-comment-hover textarea[name="comment"]').val('');
        $('#add-comment-hover').modal('show');
    });

    $('#save-comment').click(function() {
        $('#add-comment-form').submit();
    });

    $('.show-comments').click(function(){
        $("#votes").hide();
        $("#comments").fadeIn();
    });
    $('.show-votes').click(function(){
        $('.support, .oppose').hide();
        $('#comments').hide();
        $('#votes').show();

        var id = $(this).attr('id');

        if (id == 'show-supporters') {
            $('.support').fadeIn();
        } else if (id == 'show-opposers') {
            $('.oppose').fadeIn();
        } else {
            $('.oppose, .support').fadeIn();
        }
    });
});