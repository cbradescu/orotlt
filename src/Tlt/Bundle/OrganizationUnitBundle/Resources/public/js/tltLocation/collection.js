define([
    'backbone',
    'routing',
    'tltorganizationunit/js/tltLocation/model',
    'underscore'
], function(Backbone, routing, TltLocationModel, _) {
    'use strict';

    /**
     * @export  tltorganizationunit/js/tltLocation/collection
     * @class   tltorganizationunit.tltLocation.Collection
     * @extends Backbone.Collection
     */
    return Backbone.Collection.extend({
        defaultOptions: {
            route: 'tlt_api_business_unit_get_tltlocations'
        },
        url: null,
        model: TltLocationModel,

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
        setBusinessUnitId: function(id) {
            this.url = routing.generate(this.options.route, {businessUnit: id});
        }
    });
});
