import Page from "../systems/page";

import {initInputImage, newInputImage} from "../utilities/image/image";

declare let $;

const ui = {
    inputFavico: '#favico',
    inputOldFavico: '#old_favico',
    inputLogo: '#company_logo',
    inputOldLogo: '#old_company_logo',
    inputWidgetImage1: '#banner_image_1',
    inputOldWidgetImage1: '#old_banner_image_1',
    inputWidgetImage2: '#banner_image_2',
    inputOldWidgetImage2: '#old_banner_image_2',
    inputWidgetImage3: '#banner_image_3',
    inputOldWidgetImage3: '#old_banner_image_3',
    inputWidgetImage4: '#banner_image_4',
    inputOldWidgetImage4: '#old_banner_image_4',
    urlDeleteFileSetting: '/api/delete-file-setting',
    inputRemoveInitPreview: '.kv-file-remove'
};

export default class Setting extends Page {

    public setUp() {
        this.setInputImage();
    }

    /**
     * Set input image preview.
     */
    public setInputImage() {
        // init favico.
        if ($(ui.inputFavico).length) {
            if ($(ui.inputOldFavico).length) {
                initInputImage(
                    ui.inputOldFavico,
                    ui.inputFavico,
                    ui.urlDeleteFileSetting,
                    {extractName: 'favico'}
                );
            } else {
                newInputImage(ui.inputFavico);
            }
        }

        // init logo.
        if ($(ui.inputLogo).length) {
            if ($(ui.inputOldLogo).length) {
                initInputImage(
                    ui.inputOldLogo,
                    ui.inputLogo,
                    ui.urlDeleteFileSetting,
                    {extractName: 'company_logo'}
                );
            } else {
                newInputImage(ui.inputLogo);
            }
        }

        // init logo.
        if ($(ui.inputWidgetImage1).length) {
            if ($(ui.inputOldWidgetImage1).length) {
                initInputImage(
                    ui.inputOldWidgetImage1,
                    ui.inputWidgetImage1,
                    ui.urlDeleteFileSetting,
                    {extractName: 'banner_image_1'}
                );
            } else {
                newInputImage(ui.inputWidgetImage1);
            }
        }

        if ($(ui.inputWidgetImage2).length) {
            if ($(ui.inputOldWidgetImage2).length) {
                initInputImage(
                    ui.inputOldWidgetImage2,
                    ui.inputWidgetImage2,
                    ui.urlDeleteFileSetting,
                    {extractName: 'banner_image_2'}
                );
            } else {
                newInputImage(ui.inputWidgetImage2);
            }
        }

        if ($(ui.inputWidgetImage3).length) {
            if ($(ui.inputOldWidgetImage3).length) {
                initInputImage(
                    ui.inputOldWidgetImage3,
                    ui.inputWidgetImage3,
                    ui.urlDeleteFileSetting,
                    {extractName: 'banner_image_3'}
                );
            } else {
                newInputImage(ui.inputWidgetImage3);
            }
        }

        if ($(ui.inputWidgetImage4).length) {
            if ($(ui.inputOldWidgetImage4).length) {
                initInputImage(
                    ui.inputOldWidgetImage4,
                    ui.inputWidgetImage4,
                    ui.urlDeleteFileSetting,
                    {extractName: 'banner_image_4'}
                );
            } else {
                newInputImage(ui.inputWidgetImage4);
            }
        }

        $(ui.inputFavico).on('fileclear', function (event) {
            $(ui.inputRemoveInitPreview).trigger("click");
        });
    }
}