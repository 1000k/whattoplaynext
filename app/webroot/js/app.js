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

	app.Tune = Backbone.Model.extend({
		urlRoot: '/next',
		defaults: {
			id: '',
			name: '',
			Book: [],
			Sample: []
		},

		initialize: function() {
			this.on('sync', function(model) {
				console.info('Synced.');
				console.log(model.get('name'));
			});
		},

		parse: function(response) {
			this.set('id', response.Tune.id);
			this.set('name', response.Tune.name);
			this.set('Book', response.Book);
			this.set('Sample', response.Sample);
		}
	});

	//------------------------
	// Collections
	//------------------------
	var ConfigCollection = Backbone.Collection.extend({
		model: app.Config,
		localStorage: new Backbone.LocalStorage("ConfigCollection")
	});

	var TuneCollection = Backbone.Collection.extend({
		model: app.Tune
	});

	//------------------------
	// Views
	//------------------------
	// AppView: Top level view
	app.AppView = Backbone.View.extend({
		el: $('#content'),

		template: _.template($('#template-tunes').html()),

		events: {
			'click .btn-wpn': 'goNext'
		},

		initialize: function() {
			this.$tunes = this.$('#tunes');

			this.listenTo(app.Tunes, 'sync', this.render);
		},

		goNext: function() {
			app.Tunes.create();
		},

		render: function() {
			var attrs = app.Tunes.pop().attributes;
			console.log(attrs);

			$('#home').hide();
			this.$tunes.html(this.template(attrs));
			$('#tunes').show();

			// Attach triggers on elements.
			$(".m-carousel").carousel();
			$(".html5lightbox").html5lightbox();

			return this;
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
			'next': 'next'		// #next
		},

		next: function() {
			console.log('next route');

		}
	});

	// Start
	app.Router = new Workspace();
	Backbone.history.start();

	app.Tunes = new TuneCollection();
	new app.AppView();
});