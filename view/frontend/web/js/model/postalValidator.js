/**
 * @copyright Copyright (c) sbdevblog (http://www.sbdevblog.com)
 */

define(
    [
        'jquery',
        'mage/translate',
        'Magento_Ui/js/model/messageList',
        'Magento_Checkout/js/model/quote'
    ],
    function ($,$t, messageList, quote) {
        'use strict';
        return {
            validate: function () {
                if (window.checkoutConfig.pobox_validation_enabled){
                    let isValidated = $.map(quote.shippingAddress().street, function (value, index)
                        {
                            if(/((((p[\s\.]?)\s?[o\s][\.]?)\s?)|(post\s?office\s?)|(postal\s?)|(post\s?))((box|bin|b\.?)?\s?((num|number|no|#)\.?)?\s?\d+)/igm.test(value))
                            {
                                return value;
                            }
                        }
                    )
                    if(isValidated.length > 0){
                        messageList.addErrorMessage({message: $t('We do not ship to PO BOX address.')});
                    }
                    return isValidated.length === 0;
                }
                return true;
            }
        }
    }
);
