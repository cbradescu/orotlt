define([
    'backbone'
], function(Backbone) {
    'use strict';

    /**
     * @export  tltorganizationunit/js/tltLocation/model
     * @class   tltorganizationunit.tltLocation.Model
     * @extends Backbone.Model
     */
    return Backbone.Model.extend({
        defaults: {
            id: '',
            generalLocation: ''
        }
    });
});
