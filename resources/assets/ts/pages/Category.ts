import Page from "../systems/page";

import {slugify, changeLanguage} from "../utilities/common/helpers";
import {initInputImage} from "../utilities/image/image";

declare let $;
declare let viewData;

const ui = {
    inputImage: '#image',
    inputOldImage: '#old-image',
    urlDeleteImage: '/api/category/delete-image',
    tableCategory: '#datatable-category'
};

export default class Category extends Page {
    public categoryName: string = viewData.oldName;

    public categorySlug: string = viewData.oldSlug;

    /**
     * An object where keys are expressions to watch and values are the corresponding callbacks.
     * @type {{categoryName: (newValue, oldValue) => void}}
     */
    watch = {
        categoryName: function (newValue, oldValue) {
            this.categorySlug = slugify(newValue);
        }
    };

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
            $('#category-name').focus();
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