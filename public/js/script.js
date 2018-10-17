$(function () {
    $('input[name="main-input-search"]').daterangepicker({
        autoUpdateInput: false
    });

    $('input[name="main-input-search"]').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });
});