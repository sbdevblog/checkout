define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/additional-validators',
        'SbDevBlog_Checkout/js/model/postalValidator'
    ],
    function (Component, additionalValidators, postalValidator) {
        'use strict';
        additionalValidators.registerValidator(postalValidator);
        return Component.extend({});
    }
);
