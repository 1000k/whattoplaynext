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
	
	initialize: function() {
		var self = this;

		this.listenTo(self, 'add', function(model, collection, options) {
			self.set('enabled_books', options.enabled_books);
		});
	}
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
			self.render(response.Tune.id, model);
		});

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
		document.title = model.attributes.Tune.name + ' | What to Play Next?';

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
	routes: {
		'next': 'next',
		'tunes/view/:id': 'tunesView'
	},

	initialize: function() {
		Backbone.history.start({pushState: true});

		// Prevent default behavior on all internal links
		// and give IE fallback.
		$(document).on('click', 'a[href^="/"]', function(e) {
			var href = $(e.currentTarget).attr('href');

			// (?) chain 'or's for other black list routes.
			var passThrough = href.indexOf('sign_out') >= 0;

			// Allow shift+click for new tabs, etc.
			if (!passThrough && !event.altKey && !event.ctrlKey && !event.metaKey) {
				event.preventDefault();
			}

			// Remove leading slashes and hash bangs (backward compatibility)
			var url = href.replace(/^\//, '').replace('\#\!/', '');
			App.router.navigate(url, {trigger: true});
		});
	},

	next: function() {
		console.info('next');
	},

	tunesView: function(id) {
		console.info('tunesView');
		console.log('tunes/view/' + id);
		// App.appView.render(id);
	}

});

$(function() {
	App.run();
});