define([
    'backbone',
    'routing',
    'tltorganizationunit/js/service/model',
    'underscore'
], function(Backbone, routing, ServiceModel, _) {
    'use strict';

    /**
     * @export  tltorganizationunit/js/service/collection
     * @class   tltorganizationunit.service.Collection
     * @extends Backbone.Collection
     */
    return Backbone.Collection.extend({
        defaultOptions: {
            route: 'tlt_api_service_type_get_services'
        },
        url: null,
        model: ServiceModel,

        /**
         * Constructor
         */
        initialize: function(models, options) {
            this.options = _.extend({}, this.defaultOptions, options);
            this.url = routing.generate(this.options.route);
        },

        /**
         * Regenerate route for selected service type
         *
         * @param id {string}
         */
        setServiceTypeId: function(id) {
            this.url = routing.generate(this.options.route, {serviceType: id});
        }
    });
});
