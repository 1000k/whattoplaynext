// Namespace
var App = App || {};
App.Model = App.Model || {};
App.View = App.View || {};

$(function() {
	//------------------------
	// Models
	//------------------------
	// Config model
	//
	// To ensure only one Config key exists in local storage,
	// Use update() not save().
	App.Model.Config = Backbone.Model.extend({
		defaults: {
			// FIXME This values should be synced with server-side ones.
			enabled_books: [1, 2, 3],
			modified: new Date().getTime()
		},

		localStorage: new Backbone.LocalStorage('Config'),

		// If there is no data in LocalStorage, create new data and save immediately.
		// If there is, extend the id to persist.
		initialize: function() {
			console.log('App.Model.Config.initialize()');
			var self = this;

			this.listenTo(self, 'sync', function(model, response, options) {
				console.info('ConfigModel synced!');
				console.log('self.isNew(): ' + self.isNew());

				if (response.length < 1) {
					console.info('There is no Config in local storage. Now save defaults.');
					self.save(self.defaults);
					return false;
				} 

				if (self.isNew() && response[0]) {
					console.info('This model does not have id yet, so that set now.');
					self.set(response[0]);
					self.unset('0');
				}

				console.log(self.toJSON());
			});

			self.fetch();
		}
	});

	App.Model.Tune = Backbone.Model.extend({
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
	// App.ConfigCollection = Backbone.Collection.extend({
	// 	model: App.Model.Config,

	// 	initialize: function() {
	// 		console.log('ConfigCollection.initialize()');

	// 		if (!this.models.length) {
	// 			console.info('ConfigCollection is empty so added new model.');
	// 			this.add(new App.Model.Config());
	// 		} else {
	// 			console.info('ConfigCollection has models.');
	// 			// console.log(this.models.length);
	// 		}

	// 		// console.log(this.models);
	// 	}

	// });

	App.TuneCollection = Backbone.Collection.extend({
		model: App.Model.Tune
	});

	//------------------------
	// Views
	//------------------------
	// AppView: Top level view
	App.View.AppView = Backbone.View.extend({
		el: $('#content'),

		template: _.template($('#template-tunes').html()),

		events: {
			'click .btn-wpn': 'goNext'
		},

		initialize: function() {
			this.$tunes = this.$('#tunes');

			this.listenTo(App.Tunes, 'sync', this.render);
		},

		goNext: function() {
			App.Tunes.create();
		},

		render: function() {
			var attrs = App.Tunes.pop().attributes;

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
	App.View.ConfigView = Backbone.View.extend({
		el: $('.drawers'),

		events: {
			'click .checkbox': 'check'
		},

		initialize: function(options) {
			console.info('App.ConfigView.initialize()');

			this.model = new App.Model.Config();

			this.listenTo(this.model, 'all', this.mojamoja);

			_.bindAll(this, 'render');

			this.render();
		},

		_getCheckedBoxes: function() {
			return _.toArray(
				$('input[name="data[Config][enabled_books][]"]:checked')
				.map(function() {
					return parseInt(this.value);
				})
			);
		},

		mojamoja: function(eventName) {
			console.info('ConfigView.model: ' + eventName);
		},

		check: function() {
			// console.log(this.model.attributes);

			this.model.save({
				enabled_books: this._getCheckedBoxes(),
				modified: new Date().getTime()
			});

		},

		render: function() {
			_(this.model.get('enabled_books')).each(function(num, key) {
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
	App.Router = new Workspace();
	Backbone.history.start();

	App.Tunes = new App.TuneCollection();

	new App.View.AppView();
	new App.View.ConfigView();


	// Etc
	$('.checkbox').on('click', function() {
		var $cb = $('input[type=checkbox]', this);
		$cb.prop('checked', !$cb.prop('checked'));
	});

	snapper.open('left');
});