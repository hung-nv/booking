"use strict";

$(function () {
    var wrapProducts, url, domain;
    wrapProducts = $('#data-products');
    url = window.location;

    if(url.port) {
        domain = url.protocol + '//' + url.hostname + ':' + url.port
    } else {
        domain = url.protocol + '//' + url.hostname;
    }

    if(wrapProducts.length) {
        // open popup for add product to event
        wrapProducts.on('click', '#open-popup-event', function () {
            var productId, modalEvent;

            modalEvent = $('#add-event');
            productId = $(this).data('id');

            $('#id_product_event').val(productId);
            modalEvent.modal('show');
        });

        // add product to event
        $('#add-event').on('click', '#add-to-event', function () {
            var productId, eventId;
            productId = $('#id_product_event').val();
            eventId = $('#id_event').val();
            if(productId === undefined || eventId === undefined) {
                return;
            }

            $.ajax({
                type: "post",
                dataType: "json",
                url: domain + '/api/add-product-event',
                data: {product_id: productId, event_id: eventId},
                success: function (result) {
                    toastr.info(result.message);
                },
                error: function (xhr) {
                    // errorProcess(xhr);
                },
                complete: function () {
                    $('#add-event').modal('hide');
                }
            })
        });
    }
});