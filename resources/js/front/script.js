$(function() {

    $('.toast').toast('show');

    $('.nav-item.dropdown').mouseenter(function() {
        $(this).addClass('show');
        $(this).children('.dropdown-menu').addClass('show');
        $(this).children('.dropdown-toggle').attr('aria-expanded', 'true');
    }).mouseleave(function() {
        $(this).removeClass('show');
        $(this).children('.dropdown-menu').removeClass('show');
        $(this).children('.dropdown-toggle').attr('aria-expanded', 'false');
    });

    $('.img-small').on('mouseenter click', function() {
        var src = $(this).data('src');
        $('.img-large').css("background-image", "url('"+src+"')");
    });

    var imgLarge = $('.img-large');

    imgLarge.mousemove(function(event) {
        var relX = event.pageX - $(this).offset().left;
        var relY = event.pageY - $(this).offset().top;
        var width = $(this).width();
        var height = $(this).height();
        var x = (relX / width) * 100;
        var y = (relY / height) * 100;
        $(this).css("background-position", x+"% "+y+"%");
    });

    imgLarge.mouseout(function() {
        $(this).css("background-position", "center");
    });

    $( window ).resize(function() {
        setImgLarge();
        setImgSmall();
    });

    setImgLarge();
    setImgSmall();

    $('.add-to-cart').click(function (){
        let base = $('base').attr('href');
        let id = $(this).data('id');
        let url = base+'/cart/'+id;
        let token = $('meta[name=csrf_token]').attr('content');

        if($('#qty').length){
            url += '/'+$('#qty').val();
        }

        $.post(url, {_token: token}).done(function (resp){
            location.reload();
        }).fail(function (resp){

        });

    });

});

function setImgLarge() {
    var imgLarge = $('.img-large');
    var width = imgLarge.width();
    imgLarge.height(width * 2/3);
}

function setImgSmall() {
    var imgSmall = $('.img-small');
    var width = imgSmall.width();
    imgSmall.height(width);
}
