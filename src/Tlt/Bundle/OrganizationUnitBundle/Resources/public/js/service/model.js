define([
    'backbone'
], function(Backbone) {
    'use strict';

    /**
     * @export  tltorganizationunit/js/service/model
     * @class   tltorganizationunit.service.Model
     * @extends Backbone.Model
     */
    return Backbone.Model.extend({
        defaults: {
            id: '',
            name: ''
        }
    });
});
