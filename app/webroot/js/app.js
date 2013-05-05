var app = app || {};

$(function() {
	// Models
	app.Config = Backbone.Model.extend({
		defaults: {
			checked: false
		}
	});

	// Collections
	app.ConfigCollection = Backbone.Collection.extend({
		model: app.Config,
		localStorage: new Backbone.LocalStorage("ConfigCollection")
	});

	// Views
	app.AppView = Backbone.View.extend({
		el: $('.drawers'),
		
		initialize: function() {
			_.bindAll(this, 'render');

			this.enabled_books = [1, 2, 3];
			this.collection = new app.ConfigCollection();

			this.render();
		},

		render: function() {
			_(this.enabled_books).each(function(num, key) {
				$('#ConfigEnabledBooks' + num).attr('checked', 'checked');
			});
		}
	});

	// Start
	new app.AppView();
});