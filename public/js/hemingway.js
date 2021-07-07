$(document).ready(function () {
    $(".dropdown-toggle").click('click', function() {
        if ($(".dropdown-toggle").hasClass('w--open')) {
            $(".dropdown-list").removeClass('w--open');
            $(".dropdown-toggle").removeClasss('w--open');
            return;
        } 

        $(".dropdown-toggle").addClass('w--open');
        $(".dropdown-list").addClass('w--open');
    });

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

    $(".cart-button").click(function () {
        $(".cart-wrapper").css({opacity: 1, display: "block"});
    });
    $(".close-button ").click(function () {
        $(".cart-wrapper").css({opacity: 0, display: "none"});
    });
    $(".remove-cart-product").click(function () {

        const cartItemId = $(this).parent().parent().attr('id');
        const id = cartItemId.replace('cart-product-', '');
        $('#' + cartItemId).hide();

        $.post('/remove-cart-item/' + id, {}, function (data, error) {
            if (data.amount || data.amount === 0) {
                $('#totalAmount').text(data.amount + ' RSD');
            }
        })
    });
    $(".remove-checkout-product").click(function () {
        const cartItemId = $(this).parent().parent().attr('id');
        const id = cartItemId.replace('checkout-product-', '');
        $('#' + cartItemId).hide();
        $.post('/remove-cart-item/' + id, {}, function (data, error) {
            if (data.amount || data.amount === 0) {
                const intAmount = data.amount;
                const amount = data.amount + ' RSD';
                $('#sum').text(amount);
                $('#middleSum').text(amount);
                let deliveryAmount = 0;
                let totalAmount = intAmount;
                if (intAmount <= 5000) {
                    totalAmount += 250;
                    deliveryAmount = 250;
                }
                $('#deliveryCheckoutAmount').text(deliveryAmount + ' RSD');
                $('#totalCheckoutAmount').text(totalAmount + ' RSD');
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
    $(".male-fotke").click(function () {
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

    if (!/^[A-Za-z0-9 ŠČĆĐŽ]*$/.test(personalisation)) {
        document.getElementById('personalisation-error').style.display = 'block';
        return;
    }

    personalisation = personalisation.replace(/\s/g, "");
    if (personalisation.length > 6) {
        document.getElementById('personalisation-error').style.display = 'block';
    } else {
        form.submit();
    }
}
