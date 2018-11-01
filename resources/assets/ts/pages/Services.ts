import Page from "../systems/page";

declare let $;

const ui = {
    tableCategory: '#datatable-services'
};

export default class Services extends Page {

    public setUp() {
        this.setDatatable();
    }

    /**
     * Datatable for category.
     */
    public setDatatable() {
        if ($(ui.tableCategory).length) {
            $(ui.tableCategory).dataTable({
                ordering: false,
                order: [[0, 'desc']],
                bLengthChange: true,
                bFilter: true
            });
        }
    }
}