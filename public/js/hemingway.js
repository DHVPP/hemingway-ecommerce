$(document).ready(function(){
    $(".menu").css("top", $(".announcement").css('height'));
    $(window).resize(function () {
        $(".menu").css("top", $(".announcement").css('height'));

        let menu = $(".menu").css('height');
        let announcement = $(".announcement").css('height');

        const menuSize = menu.replace('px', '');
        const announcementSize = announcement.replace('px', '');

        const size = parseInt(menuSize) + parseInt(announcementSize);
        $(".naslov").css("margin-top", size + "px");
        $(".contact-section.legal-notice").css("margin-top", size + "px");
        $(".special-section").css("margin-top", size + "px");
    });
    $(".menu").css("top", $(".announcement").css('height'));

    let menu = $(".menu").css('height');
    let announcement = $(".announcement").css('height');

    const menuSize = menu.replace('px', '');
    const announcementSize = announcement.replace('px', '');

    const size = parseInt(menuSize) + parseInt(announcementSize);
    $(".naslov").css("margin-top", size + "px");
    $(".contact-section.legal-notice").css("margin-top", size + "px");
    $(".special-section").css("margin-top", size + "px");

    $(".cart-button").click(function() {
        $(".cart-wrapper").css({opacity: 1, display: "block"});
    });
    $(".close-button ").click(function() {
        $(".cart-wrapper").css({opacity: 0, display: "none"});
    });
    $(".remove-cart-product").click(function() {
        console.log('123');
        const cartItemId = $(this).parent().parent().attr('id');
        const id = cartItemId.replace('cart-product-', '');
        $('#' + cartItemId).hide();
        console.log(123);
        $.post('/remove-cart-item/' + id, {}, function (data, error) {
            console.log(data);
            if (data.amount || data.amount === 0) {
                $('#totalAmount').text(data.amount + ' RSD');
            }
        })
    });
    $(".remove-checkout-product").click(function() {
        const cartItemId = $(this).parent().parent().attr('id');
        const id = cartItemId.replace('checkout-product-', '');
        $('#' + cartItemId).hide();
        $.post('/remove-cart-item/' + id, {}, function (data, error) {
            if (data.amount || data.amount === 0) {
                const amount = data.amount + ' RSD';
                $('#sum').text(amount);
                $('#middleSum').text(amount);
            }
        })
    });
    $(".kruzici-boja").click(function () {
        const value = $(this).data('value');
        const image = $(this).data('image');
        $(".kruzici-boja").css({border: '0px'});
        $(this).css({border: '3px solid #ccc'});
        document.getElementById('color').value = value;
        $(".fotka").attr("src", image);
    });
    $(".male-fotke").click(function (){
        const src = $(this).attr('src');
        $('.fotka').attr('src', src);
        $('#link-image-open').attr('href', src);
    });
});

function validatePersonalisation() {
    let personalisation = document.getElementsByName("personalisation")[0].value;
    let form = document.getElementById('add-cart-form');

    if (personalisation.length === 0) {
        form.submit();
    }
    personalisation = personalisation.replace(/\s/g, "");
    if (personalisation.length > 10) {
        document.getElementById('personalisation-error').style.display = 'block';
    } else {
        form.submit();
    }
}
