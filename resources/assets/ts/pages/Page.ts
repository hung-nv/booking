import Page from "../systems/page";

import {slugify, doException} from "../utilities/common/helpers";
import {initInputImage} from "../utilities/image/image";

declare let $;
declare let viewData;
declare let toastr;

const ui = {
    inputImage: '#image',
    inputOldImage: '#old-image',
    urlDeleteImage: '/api/post/delete-image',
    inputRemoveInitPreview: '.kv-file-remove',
    tablePages: '#datatable-page'
};

export default class Post extends Page {
    public postName: string = viewData.oldName;

    public postSlug: string = viewData.oldSlug;

    /**
     * An object where keys are expressions to watch and values are the corresponding callbacks.
     * @type {{postName: (newValue, oldValue) => void}}
     */
    watch = {
        postName: function (newValue, oldValue) {
            this.postSlug = slugify(newValue);
        }
    };

    public setUp() {
        this.setDatatable();

        this.setInputImage();
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

        $(ui.inputImage).on('fileclear', function (event) {
            $(ui.inputRemoveInitPreview).trigger("click");
        });
    }
}