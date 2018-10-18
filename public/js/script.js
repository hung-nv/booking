$(function () {
    var inputMainSearch = $('input[name="main-input-search"]');

    inputMainSearch.daterangepicker({
        autoUpdateInput: false
    });

    inputMainSearch.on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });

    var availableTags = [
        "iStay1",
        "iStay2",
        "iStay3",
        "iStay4",
        "iStay5"
    ];

    $("#autocompleteid2").autocomplete({
        source: availableTags,
        minLength: 0
    }).focus(function () {
        // $(this).autocomplete("search");
        $(this).keydown();
    }).autocomplete("instance")._renderItem = function (ul, item) {
        return $("<li>")
            .append("<div><i class='fal fa-map-marker'></i>" + item.value + "</div>")
            .appendTo(ul);
    };

    //   Isotope------------------
    function initIsotope() {
        if ($(".gallery-items").length) {
            var a = $(".gallery-items").isotope({
                singleMode: true,
                columnWidth: ".grid-sizer, .grid-sizer-second, .grid-sizer-three",
                itemSelector: ".gallery-item, .gallery-item-second, .gallery-item-three",
                transformsEnabled: true,
                transitionDuration: "700ms",
                resizable: true
            });
            a.imagesLoaded(function () {
                a.isotope("layout");
            });
        }
    }

    initIsotope();
});