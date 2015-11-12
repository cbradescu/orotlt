define([
    'underscore',
    'backbone',
    'jquery.validate'
], function(_, Backbone) {
    'use strict';

    var $ = Backbone.$;

    /**
     * @export  tlt/service/view
     * @class   tlt.service.View
     * @extends Backbone.View
     */
    return Backbone.View.extend({
        events: {
            'change': 'selectionChanged'
        },

        /**
         * Constructor
         *
         * @param options {Object}
         */
        initialize: function(options) {
            this.target = $(options.target);

            this.template = _.template($('#service-chooser-template').html());

            this.listenTo(this.collection, 'reset', this.render);
        },

        /**
         * onChange event listener
         *
         * @param e {Object}
         */
        selectionChanged: function(e) {
            if ($(e.currentTarget).val()) {
                var serviceTypeId = $(e.currentTarget).val();
                this.collection.setServiceTypeId(serviceTypeId);
                this.collection.fetch({reset: true});
            } else {
                this.collection.reset([]);
            }
        },

        render: function() {
            this.target.find('option[value!=""]').remove();

            if (this.collection.models.length > 0) {
                this.target.append(this.template({services: this.collection.models}));
            }

            this.target.val(this.target.data('selected-data') || '').trigger('change');
        }
    });
});
