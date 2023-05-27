/**
 * @copyright Copyright (c) sbdevblog (http://www.sbdevblog.com)
 */
define([
    'jquery',
], function ($) {
    'use strict';

    return function (validator) {

        validator.addRule(
            'pobox-validation',
            function (value) {
                let isValidPoBox = /((((p[\s\.]?)\s?[o\s][\.]?)\s?)|(post\s?office\s?)|(postal\s?)|(post\s?))((box|bin|b\.?)?\s?((num|number|no|#)\.?)?\s?\d+)/igm.test(value);
                return !isValidPoBox;
            },
            $.mage.__("PO BOX address not allowed")
        );

        return validator;
    };
});
