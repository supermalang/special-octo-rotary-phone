$(document).ready(function () {
    var $reservationsummarytag = $('.sar-reservation-price-summary-start-tag');

    $reservationsummarytag.parent().parent().parent().after('<div class="col-12 sar-reservaton-price-summary"></div>');
    
    $('.sar-reservaton-price-summary').append(
        "<div class='ml-auto' style='width: fit-content'>\
            okay            \
        </div>"
    )

    /*$markdownInputs.on('keyup', function (e) {
        var html = snarkdown(e.target.value);
        e.target.nextElementSibling.innerHTML = html;
    });
    $markdownInputs.trigger('keyup');*/
});