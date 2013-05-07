// Namespace
var App = App || {};
App.Model = App.Model || {};
App.View = App.View || {};

$(function() {
	Backbone.emulateHTTP = true;
	
	App.Configs = {};

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
			enabled_books: [1, 2, 3]
		},

		localStorage: new Backbone.LocalStorage('Config'),

		// If there is no data in LocalStorage, create new data and save immediately.
		// If there is, extend the id to persist.
		initialize: function() {
			var self = this;

			this.listenTo(self, 'sync', function(model, response, options) {
				if (response.length < 1) {
					self.save(self.defaults);
					return false;
				} 

				// Maybe by the specification of backbone.localStorage.js,
				// `response[0]` is given from after second access.
				// So that unset it manually.
				if (self.isNew() && response[0]) {
					self.set(response[0]);
					self.unset('0');
				}

				App.Configs = self.attributes;
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

		initialize: function() {
			var self = this;

			this.listenTo(self, 'add', function(model, collection, options) {
				self.set('enabled_books', options.enabled_books);
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
			$('#home').hide();
			$('#tunes').hide();
			$('.spinner').show();

			App.Tunes.create({}, {enabled_books: App.Configs.enabled_books});
		},

		render: function() {
			var attrs = App.Tunes.pop().attributes;

			this.$tunes.html(this.template(attrs));

			$('#tunes').show();
			$('#tunes').scrollTop(0);
			$('.spinner').hide();

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
			this.model = new App.Model.Config();

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

		check: function() {
			this.model.save({
				enabled_books: this._getCheckedBoxes()
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
			'tunes/view/:id': 'tunes_view'		// #tunes/view/800
		},

		tunes_view: function(id) {
			console.log('tunes/view/' + id);
		}

	});

	// Start
	App.Router = new Workspace();
	Backbone.history.start();

	App.Tunes = new App.TuneCollection();

	new App.View.AppView();
	new App.View.ConfigView();

	//------------------------
	// Misc
	//------------------------
	// Expand checkbox.
	$('.checkbox').on('click', function() {
		var $cb = $('input[type=checkbox]', this);
		$cb.prop('checked', !$cb.prop('checked'));
	});

	// Open drawer on window.load(). (Just for development purpose)
	// snapper.open('left');
});