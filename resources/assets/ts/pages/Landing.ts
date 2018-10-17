import Page from "../systems/page";

import {slugify, doException} from "../utilities/common/helpers";
import {initInputImage} from "../utilities/image/image";

declare let $;
declare let viewData;

const ui = {
    inputImage: '#feature1-image',
    nameImage: 'feature1-image',
    inputImage2: '#feature2-image',
    nameImage2: 'feature2-image',
    inputImage3: '#feature3-image',
    nameImage3: 'feature3-image',
    inputOldImage: '#old-feature1-image',
    inputOldImage2: '#old-feature2-image',
    inputOldImage3: '#old-feature3-image',
    urlDeleteImage: '/api/landing/delete-image',
    inputRemoveInitPreview: '.kv-file-remove',
    tablePages: '#datatable-page'
};

export default class Landing extends Page {
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
                    ui.urlDeleteImage,
                    {extractName: ui.nameImage}
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

        if ($(ui.inputImage2).length) {
            if ($(ui.inputOldImage2).length) {
                initInputImage(
                    ui.inputOldImage2,
                    ui.inputImage2,
                    ui.urlDeleteImage,
                    {extractName: ui.nameImage2}
                );
            } else {
                $(ui.inputImage2).fileinput({
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

        if ($(ui.inputImage3).length) {
            if ($(ui.inputOldImage3).length) {
                initInputImage(
                    ui.inputOldImage3,
                    ui.inputImage3,
                    ui.urlDeleteImage,
                    {extractName: ui.nameImage3}
                );
            } else {
                $(ui.inputImage3).fileinput({
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