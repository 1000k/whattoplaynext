// Namespace
var App = {
	Models: {},
	Collections: {},
	Views: {},

	run: function() {
		Backbone.emulateHTTP = true;

		this.tunes = new App.Collections.Tunes();
		this.appView = new App.Views.AppView({collection: this.tunes});
		this.configView = new App.Views.ConfigView();

		this.router = new App.Router();
		Backbone.history.start();

		this.router.route('/tunes/view/:id', 'tunesView', function(id) {
			console.info('tunesView');
			console.log('/tunes/view/' + id);
			this.appView.render(id);
		});

		// Expand checkbox.
		$('.checkbox').on('click', function() {
			var $cb = $('input[type=checkbox]', this);
			$cb.prop('checked', !$cb.prop('checked'));
		});

		// Open drawer on window.load(). (Just for development purpose)
		snapper.open('left');
	}
};

//------------------------
// Models
//------------------------
// Config model
//
// To ensure only one Config key exists in local storage,
// Use update() not save().
App.Models.Config = Backbone.Model.extend({
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

App.Models.Tune = Backbone.Model.extend({
	urlRoot: '/next',
	// defaults: {
	// 	Tune: { id: '', name: '' },
	// 	Book: {},
	// 	Sample: {}
	// },

	initialize: function() {
		var self = this;

		this.listenTo(self, 'add', function(model, collection, options) {
			self.set('enabled_books', options.enabled_books);
		});
	},

	// parse: function(response) {
	// 	this.set('Tune.id', response.Tune.id);
	// 	this.set('Tune.name', response.Tune.name);
	// 	this.set('Book', response.Book);
	// 	this.set('Sample', response.Sample);
	// }
});

//------------------------
// Collections
//------------------------
App.Collections.Tunes = Backbone.Collection.extend({
	model: App.Models.Tune
});

//------------------------
// Views
//------------------------
// AppView: Top level view
App.Views.AppView = Backbone.View.extend({
	el: '#content',

	// template: _.template($('#template-tunes').html()),

	events: {
		'click .btn-wpn': 'goNext'
	},

	initialize: function(options) {
		_.bindAll(this, 'goNext', 'render');

		this.$tunes = this.$('#tunes');
		this.template = _.template($('#template-tunes').html());
		this.collection = options.collection;

		// this.listenTo(this.collection, 'sync', this.render);
	},

	goNext: function() {
		$('#home').hide();
		$('#tunes').hide();
		$('.spinner').show();

		var self = this;

		this.collection.once('sync', function(model, response) {
			console.log(model.toJSON());
			self.render(response.Tune.id, model);
		});
		// this.render(id);
		this.collection.create({}, {enabled_books: App.Configs.enabled_books});
	},

	render: function(id, model) {
		console.info('render');
		console.log(id, model);

		if (model) {
			var attrs = model.toJSON();
		} else {
			console.info('model is not set');
		}

		this.$tunes.html(this.template(attrs));
		App.router.navigate('/tunes/view/' + id, {trigger: true});
		document.title = model.get('name') + ' | What to Play Next?';

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
App.Views.ConfigView = Backbone.View.extend({
	el: '.drawers',

	events: {
		'click .checkbox': 'check'
	},

	initialize: function(options) {
		this.model = new App.Models.Config();

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
App.Router = Backbone.Router.extend({
	// routes: {
	// 	'tunes/view/:id': 'tunesView'		// #tunes/view/800
	// },

	// tunesView: function(id) {
	// 	console.info('tunesView');
	// 	console.log('tunes/view/' + id);
	// }

});

$(function() {
	App.run();
});