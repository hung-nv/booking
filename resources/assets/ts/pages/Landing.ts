import Page from "../systems/page";

import {slugify, doException} from "../utilities/common/helpers";
import {initInputImage} from "../utilities/image/image";

declare let $;
declare let viewData;

const ui = {
    inputThumbnail: '#image',
    nameThumbnail: 'image',
    inputOldThumbnail: '#old-image',
    urlDeleteThumbnailLanding: '/api/post/delete-image',
    inputImage: '#gallery-image-1',
    nameImage: 'gallery-image-1',
    inputImage2: '#gallery-image-2',
    nameImage2: 'gallery-image-2',
    inputImage3: '#gallery-image-3',
    nameImage3: 'gallery-image-3',
    inputImage4: '#gallery-image-4',
    nameImage4: 'gallery-image-4',
    inputImage5: '#gallery-image-5',
    nameImage5: 'gallery-image-5',
    inputImage6: '#gallery-image-6',
    nameImage6: 'gallery-image-6',
    inputOldImage: '#old-gallery-image-1',
    inputOldImage2: '#old-gallery-image-2',
    inputOldImage3: '#old-gallery-image-3',
    inputOldImage4: '#old-gallery-image-4',
    inputOldImage5: '#old-gallery-image-5',
    inputOldImage6: '#old-gallery-image-6',
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
        if ($(ui.inputThumbnail).length) {
            if ($(ui.inputOldThumbnail).length) {
                initInputImage(
                    ui.inputOldThumbnail,
                    ui.inputThumbnail,
                    ui.urlDeleteThumbnailLanding,
                    {extractName: ui.nameThumbnail}
                );

                $(ui.inputThumbnail).on('fileclear', function (event) {
                    let input = $(this).parents('.file-input').find('.kv-file-remove');

                    input.trigger("click");
                });
            } else {
                $(ui.inputThumbnail).fileinput({
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

        if ($(ui.inputImage).length) {
            if ($(ui.inputOldImage).length) {
                initInputImage(
                    ui.inputOldImage,
                    ui.inputImage,
                    ui.urlDeleteImage,
                    {extractName: ui.nameImage}
                );

                $(ui.inputImage).on('fileclear', function (event) {
                    let input = $(this).parents('.file-input').find('.kv-file-remove');

                    input.trigger("click");
                });
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

                $(ui.inputImage2).on('fileclear', function (event) {
                    let input = $(this).parents('.file-input').find('.kv-file-remove');

                    input.trigger("click");
                });
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

                $(ui.inputImage3).on('fileclear', function (event) {
                    let input = $(this).parents('.file-input').find('.kv-file-remove');

                    input.trigger("click");
                });
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

        if ($(ui.inputImage4).length) {
            if ($(ui.inputOldImage4).length) {
                initInputImage(
                    ui.inputOldImage4,
                    ui.inputImage4,
                    ui.urlDeleteImage,
                    {extractName: ui.nameImage4}
                );

                $(ui.inputImage4).on('fileclear', function (event) {
                    let input = $(this).parents('.file-input').find('.kv-file-remove');

                    input.trigger("click");
                });
            } else {
                $(ui.inputImage4).fileinput({
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

        if ($(ui.inputImage5).length) {
            if ($(ui.inputOldImage5).length) {
                initInputImage(
                    ui.inputOldImage5,
                    ui.inputImage5,
                    ui.urlDeleteImage,
                    {extractName: ui.nameImage5}
                );

                $(ui.inputImage5).on('fileclear', function (event) {
                    let input = $(this).parents('.file-input').find('.kv-file-remove');

                    input.trigger("click");
                });
            } else {
                $(ui.inputImage5).fileinput({
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

        if ($(ui.inputImage6).length) {
            if ($(ui.inputOldImage6).length) {
                initInputImage(
                    ui.inputOldImage6,
                    ui.inputImage6,
                    ui.urlDeleteImage,
                    {extractName: ui.nameImage6}
                );

                $(ui.inputImage6).on('fileclear', function (event) {
                    let input = $(this).parents('.file-input').find('.kv-file-remove');

                    input.trigger("click");
                });
            } else {
                $(ui.inputImage6).fileinput({
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