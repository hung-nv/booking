import Page from "../systems/page";

import {initInputImage, newInputImage} from "../utilities/image/image";

declare let $;

const ui = {
    inputFavico: '#favico',
    inputOldFavico: '#old_favico',
    inputLogo: '#company_logo',
    inputOldLogo: '#old_company_logo',
    inputPromotionBg: '#promotion_background',
    inputOldPromotionBg: '#old_promotion_background',
    inputSearchBg: '#search_background',
    inputOldSearchBg: '#old_search_background',
    urlDeleteFileSetting: '/api/delete-file-setting'
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

                $(ui.inputFavico).on('fileclear', function (event) {
                    let input = $(this).parents('.file-input').find('.kv-file-remove');

                    input.trigger("click");
                });
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

                $(ui.inputOldLogo).on('fileclear', function (event) {
                    let input = $(this).parents('.file-input').find('.kv-file-remove');

                    input.trigger("click");
                });
            } else {
                newInputImage(ui.inputLogo);
            }
        }

        // init promotion background.
        if ($(ui.inputPromotionBg).length) {
            if ($(ui.inputOldPromotionBg).length) {
                initInputImage(
                    ui.inputOldPromotionBg,
                    ui.inputPromotionBg,
                    ui.urlDeleteFileSetting,
                    {extractName: 'promotion_background'}
                );

                $(ui.inputPromotionBg).on('fileclear', function (event) {
                    let input = $(this).parents('.file-input').find('.kv-file-remove');

                    input.trigger("click");
                });
            } else {
                newInputImage(ui.inputPromotionBg);
            }
        }

        // init search background.
        if ($(ui.inputSearchBg).length) {
            if ($(ui.inputOldSearchBg).length) {
                initInputImage(
                    ui.inputOldSearchBg,
                    ui.inputSearchBg,
                    ui.urlDeleteFileSetting,
                    {extractName: 'search_background'}
                );

                $(ui.inputSearchBg).on('fileclear', function (event) {
                    let input = $(this).parents('.file-input').find('.kv-file-remove');

                    input.trigger("click");
                });
            } else {
                newInputImage(ui.inputSearchBg);
            }
        }
    }
}