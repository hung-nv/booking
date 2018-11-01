import Page from "../systems/page";

import {slugify, changeLanguage} from "../utilities/common/helpers";
import {initInputImage} from "../utilities/image/image";

declare let $;
declare let viewData;

const ui = {
    inputImage: '#avatar',
    inputOldImage: '#old-avatar',
    urlDeleteImage: '/api/comment/delete-image',
    tableCategory: '#datatable-comment'
};

export default class Comment extends Page {

    public setUp() {
        this.setDatatable();

        this.setInputImage();

        this.setFocus();
    }

    /**
     * Set focus to first input if create category.
     */
    public setFocus() {
        if ($(ui.inputImage).length) {
            $('#comment-name').focus();
        }
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

    /**
     * Set input image preview.
     */
    public setInputImage() {
        if ($(ui.inputImage).length) {
            if ($(ui.inputOldImage).length) {
                initInputImage(
                    ui.inputOldImage,
                    ui.inputImage,
                    ui.urlDeleteImage
                );
            } else {
                $(ui.inputImage).fileinput({
                    allowedFileExtensions: ["jpg", "png"],
                    browseLabel: "Select Image",
                    showCaption: false,
                    autoReplace: true,
                    maxFileCount: 1,
                    maxFileSize: 1024,
                    showClose: false
                });
            }
        }
    }
}