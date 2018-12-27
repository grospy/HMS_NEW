

"use strict";
function ProductRegistrationService() {
    var self = this;

    self.getProductStatus = function(callback) {
        jQuery.ajax({
            url: registrationConstants.webroot + '/interface/product_registration/product_registration_controller.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                _genericAjaxSuccessHandler(response, callback);
            },
            error: function(jqXHR) {
                _genericAjaxFailureHandler(jqXHR, callback);
            }
        });
    };

    self.submitRegistration = function(email, callback) {
        jQuery.ajax({
            url: registrationConstants.webroot + '/interface/product_registration/product_registration_controller.php',
            type: 'POST',
            dataType: 'json',
            data: {
                email: email
            },
            success: function(response) {
                _genericAjaxSuccessHandler(response, callback);
            },
            error: function(jqXHR) {
                _genericAjaxFailureHandler(jqXHR, callback);
            }
        });
    };

    var _genericAjaxSuccessHandler = function(response, callback) {
        if (response) {
            return callback(null, response);
        }

        return callback(registrationTranslations.genericError, null);
    };

    var _genericAjaxFailureHandler = function(jqXHR, callback) {
        if (jqXHR && jqXHR.hasOwnProperty('responseText')) {
            try {
                var rawErrorObject = jqXHR.responseText;
                var parsedErrorObject = JSON.parse(rawErrorObject);

                if (parsedErrorObject && parsedErrorObject.hasOwnProperty('message')) {
                    callback(parsedErrorObject.message, null);
                }
            } catch (jsonParseException) {
                callback(registrationTranslations.genericError, null);
            }
        } else {
            callback(registrationTranslations.genericError, null);
        }
    };
}
