import Page from "../systems/page";
declare let $;

const ui = {
    tablePages: '#datatable-attributes'
};

export default class Attribute extends Page {
    public setUp() {
        this.setDatatable();
    }

    public setDatatable() {
        if ($(ui.tablePages).length) {
            $(ui.tablePages).dataTable({
                ordering: false,
                order: [[0, 'desc']],
                bLengthChange: true,
                bFilter: true
            });
        }
    }
}