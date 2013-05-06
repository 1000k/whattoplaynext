// Namespace
var app = app || {};

$(function() {
	//------------------------
	// Models
	//------------------------
	// Config model
	//
	// To ensure only one Config key exists in local storage,
	// Use update() not save().
	app.Config = Backbone.Model.extend({
		defaults: {
			// FIXME This values should be synced with server-side ones.
			enabled_books: [1, 2, 3],
			modified: new Date().getTime()
		},

		localStorage: new Backbone.LocalStorage('Config'),

		initialize: function() {
			console.log('app.Config.initialize()');
			console.log(this.localStorage.records);

			if (this.localStorage.records.length < 1) {
				console.info('There is no Config in local storage so added new one.');
				this.save(this.defaults);
				console.log(this.get('Config'));
			}
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
	// ConfigCollection acts as Singleton to store only one Config model.
	app.ConfigCollection = Backbone.Collection.extend({
		model: app.Config,

		initialize: function() {
			console.log('ConfigCollection.initialize()');

			if (!this.models.length) {
				console.info('ConfigCollection is empty so added new model.');
				this.add(new app.Config());
			}

			console.log(this.models);
		}

	});

	app.TuneCollection = Backbone.Collection.extend({
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
		el: $('.drawers'),

		events: {
			'click .checkbox': 'check'
		},

		initialize: function(options) {
			console.info('app.ConfigView.initialize()');

			this.collection = app.Configs;

			this.listenTo(this.collection, 'change', this.mojamoja);

			_.bindAll(this, 'render');

			console.log(this.collection.last());

			// this.checkBoxes = this.$("input[type=checkbox]").filter(function() { return this.id.match(/ConfigEnabledBooks/); });
			this.render();
		},

		mojamoja: function() {
			console.info('ConfigView.collection is changed!');
		},

		check: function() {
			console.log('uhouho');

			var books = _.toArray(
				$('input[name="data[Config][enabled_books][]"]:checked')
				.map(function() { return parseInt(this.value); })
			);

			this.model.save({
				enabled_books: books,
				modified: new Date().getTime()

			});
			// this.model.save();
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

	app.Configs = new app.ConfigCollection();
	app.Tunes = new app.TuneCollection();

	new app.AppView();
	new app.ConfigView();
});