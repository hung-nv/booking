import Page from "../systems/page";

import {slugify, doException} from "../utilities/common/helpers";
import {initInputMultiImage, newInputMultiImage} from "../utilities/image/image";

declare let $;
declare let viewData;
declare let toastr;

const ui = {
    inputImage: '#product_image',
    inputOldImage: '#old_product_image',
    urlDeleteImage: '/api/product/delete-image',
    modalAttribute: '#modalAttribute',
    urlAddAttribute: '/api/add-attribute',
    blockUpdateAttribute: '#multi-append-',
    urlUpdateBladeAttribute: '/api/get-attribute/',
    modalEvent: '#modalEvent'
};

export default class Product extends Page {
    public masterAttributeName: string = '';

    public masterAttributeId: number = 0;

    public attributeName: string = '';

    public productName: string = viewData.oldName;

    public productSlug: string = viewData.oldSlug;

    public showProductImages: boolean = false;

    /**
     * An object where keys are expressions to watch and values are the corresponding callbacks.
     * @type {{postName: (newValue, oldValue) => void}}
     */
    watch = {
        productName: function (newValue, oldValue) {
            this.productSlug = slugify(newValue);
        }
    };

    public setUp() {
        this.setInitImage();
    }

    public openPopupEvent(event) {
        let productId = $(event.target).data('id');

        // $('#id_product_event').val(productId);

        $(ui.modalEvent).modal('show');
    }

    /**
     * Show list product images.
     */
    public changeCoverImage(event) {
        let wrapImages = $(event.target).parents('.td-product-img').find('.product-image-thumb');
        if (wrapImages.is(":visible")) {
            wrapImages.hide();
        } else {
            wrapImages.show();
        }
    }

    /**
     * Update product cover image.
     * @param event
     */
    public updateCoverImage(event) {
        let self = $(event.target);

        let coverImg = self.data('img'),
            productId = self.data('id'),
            srcImg = self.attr('src');

        if (coverImg === undefined || srcImg === undefined) {
            return;
        }

        $.ajax({
            type: "post",
            url: '/api/set-cover-product',
            data: {
                image: coverImg,
                product_id: productId
            }
        }).done(respon => {
            toastr.info(respon.message);

            let currentImg = self.parents('.td-product-img').find('.backend-img').children();
            let wrapImages = self.parents('.td-product-img').find('.product-image-thumb');
            wrapImages.hide();
            currentImg.attr('src', srcImg);
        }).fail(xhr => {
            doException(xhr);
        });
    }

    /**
     * Set image input preview.
     */
    public setInitImage() {
        if ($(ui.inputOldImage).length) {
            // update product.
            initInputMultiImage(ui.inputOldImage, ui.inputImage, ui.urlDeleteImage);
        } else {
            if ($(ui.inputImage).length) {
                // create product.
                newInputMultiImage(ui.inputImage);
            }
        }
    }

    /**
     * Open popup to add attribute.
     * @param even
     */
    public openPopupAttribute(even) {
        this.masterAttributeName = $(even.target).data('attribute-name');

        this.masterAttributeId = $(even.target).data('attribute-id');

        $(ui.modalAttribute).modal('show');
    }

    /**
     * Add attribute.
     */
    public addAttribute() {
        if (this.attributeName == '') {
            return;
        }

        $.ajax({
            url: ui.urlAddAttribute,
            type: 'post',
            data: {
                attr_value: this.attributeName,
                attribute_id: this.masterAttributeId
            }
        }).done(respon => {
            toastr.info(respon.message);

            // re render attribute after add attribute.
            $(ui.blockUpdateAttribute + this.masterAttributeName).load(ui.urlUpdateBladeAttribute + this.masterAttributeId);

            // empty attribute name.
            this.attributeName = '';
        }).fail(xhr => {
            doException(xhr, {elementShowError: '.alert-error'});
        });

        setTimeout(function () {
            $('.alert-danger').remove();
        }, 3000);
    }

    /**
     * prevent default submit form.
     * @param event
     */
    public enterAddAttribute(event) {
        if (event.keyCode === 13) {
            this.addAttribute();
        }

        // preven submit form.
        event.preventDefault();
    }
}