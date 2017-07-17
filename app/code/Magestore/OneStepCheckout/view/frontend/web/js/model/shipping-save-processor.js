/*
 * *
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *  
 */
/*jshint browser:true*/
/*global define*/
define(
    [
        'Magestore_OneStepCheckout/js/model/shipping-save-processor/default'
    ],
    function(defaultProcessor) {
        'use strict';
        var processors = [];
        processors['default'] =  defaultProcessor;

        return {
            registerProcessor: function(type, processor) {
                processors[type] = processor;
            },
            saveShippingInformation: function (type) {
                var rates = [];
                if (processors[type]) {
                    rates = processors[type].saveShippingInformation();
                } else {
                    rates = processors['default'].saveShippingInformation();
                }
                return rates;
            }
        }
    }
);
