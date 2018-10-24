import PageModule from './PageModule';

import expandValidateRule from '../utilities/validate_rule/rules';
import {confirmBeforeDelete, getParameterByName} from '../utilities/common/helpers';

declare var $;

const ui = {
    metaCsrfToken: 'meta[name="_token"]',
};

export default class Page implements PageModule {
    /**
     * Method construct.
     */
    constructor() {
        // Set from validate.
        this.checkFormValidate();

        // Set update Csrf code for ajax.
        this.setAjaxCsrf();
    }

    public changeLanguage(language) {
        let currentLanguage = getParameterByName('lang');

        if (!currentLanguage) {
            currentLanguage = 'en';
        }

        if (language !== currentLanguage) {
            window.location.href = window.location.protocol + '//' + window.location.hostname + window.location.pathname + '?lang=' + language;
        }
    }

    /**
     * Set from validate.
     */
    private checkFormValidate() {
        // Expand validate rules.
        expandValidateRule();
    }

    /**
     * Set ajax csrf.
     */
    protected setAjaxCsrf() {
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $(ui.metaCsrfToken).attr('content')}
        });
    }

    public confirmBeforeDelete(even) {
        confirmBeforeDelete(event.target, 'Do you want to delete this?');
    }
}

