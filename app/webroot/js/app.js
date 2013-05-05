var app = app || {};

$(function() {
	//------------------------
	// Models
	//------------------------
	app.Config = Backbone.Model.extend({
		defaults: {
			checked: false
		}
	});

	//------------------------
	// Collections
	//------------------------
	app.ConfigCollection = Backbone.Collection.extend({
		model: app.Config,
		localStorage: new Backbone.LocalStorage("ConfigCollection")
	});

	//------------------------
	// Views
	//------------------------
	// AppView: Top level view
	app.AppView = Backbone.View.extend({
		el: $('body'),
		events: {
			'click .btn-wpn': 'next'
		},

		next: function() {
			console.log('.btn-wpn clicked.');
			$('#home').hide('slow');
			$('#tunes').show('slow');
		}
	});

	// Config view
	app.ConfigView = Backbone.View.extend({
		el:  $('.drawers'),

		initialize: function() {
			_.bindAll(this, 'render');

			this.checkBoxes = this.$('#ConfigIndexForm')[0]

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

	//------------------------
	// Router
	//------------------------
	var Workspace = Backbone.Router.extend({
		routes: {
			'next': 'next'
		},

		next: function() {
			console.log('next route');

		}
	});

	// Start
	app.Router = new Workspace();
	Backbone.history.start();

	new app.AppView();
});