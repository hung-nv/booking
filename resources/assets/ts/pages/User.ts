import Page from "../systems/page";

declare let $;

const ui = {
    tablePages: '#datatable-users'
};

export default class User extends Page {

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