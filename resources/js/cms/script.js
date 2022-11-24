jQuery(document).ready(function ($) {
    $('.toast').toast('show');

    $('.editor').trumbowyg({
        svgPath: $('base').attr('href') + '/icons.svg'
    });

    $('.delete').click(function (e) {
        e.preventDefault();
        if (confirm('Are you sure you want to delete this item?')) {
            $(this).parent('form').submit();
        }
    });

    $('.delete-image').click(function (e){
        e.preventDefault();
        let url = $(this).attr('href');
        if (confirm('Are you sure you want to delete this image?')) {
            location.href = url;
        }
    });

    $('#images').change(function (e){
        let files = e.target.files;

        $('#img-preview').html('');

        for(let file of files){
            let fr = new FileReader();
            fr.readAsDataURL(file);
            fr.onload = function (ev){
                $('#img-preview').append('<div class="col-4 mt-3"><img src="' + ev.target.result +'" class="img-fluid" /></div>')
            }
        }
    });
})
