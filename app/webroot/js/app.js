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
		// snapper.open('left');
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
	urlRoot: '/tunes/view'
});

App.Models.RandomTune = Backbone.Model.extend({
	urlRoot: '/next'
});

//------------------------
// Collections
//------------------------
App.Collections.Tunes = Backbone.Collection.extend({
	url: '/tunes/view',
	model: App.Models.Tune
});

//------------------------
// Views
//------------------------
// AppView: Top level view
App.Views.AppView = Backbone.View.extend({
	el: '#content',

	initialize: function(options) {
		_.bindAll(this, '_goNext', 'render', 'showContent');

		this.$home = this.$('#home');
		this.$tunes = this.$('#tunes');
		this.template = _.template($('#template-tunes').html());
		this.randomTune = new App.Models.RandomTune();
		this.tunes = options.collection;

		var self = this;

		this.listenTo(this.randomTune, 'sync', function(model, response) {
			App.router.navigate('/tunes/view/' + model.get('tune_id'), {trigger: true, replace: true});
		});

		// this.listenTo(this.randomTune, 'all', function(type, model, collection, response) {
		// 	console.info('RandomTune event fired.');
		// 	console.log(type);
		// 	console.log(model);
		// 	console.log(collection);
		// 	console.log(response);
		// });

		// this.listenTo(this.tunes, 'all', function(type, model, collection, response) {
		// 	console.info('tunes event fired.');
		// 	console.log(type);
		// 	console.log(model);
		// 	console.log(collection);
		// 	console.log(response);
		// });

		this.listenTo(this.tunes, 'add', function(model, response, options) {
			self._afterFetchTune(model, response);
		});
	},

	showContent: function(content, options) {
		switch (content) {
			case 'home':
				this.$home.show();
				this.$tunes.hide();
				document.title = 'What To Play Next?';
				break;

			case 'next':
				this.$home.hide();
				$('#tunes').hide().html('');
				$('.spinner').show();

				this._goNext();

				break;

			case 'tunesView':
				this.tunes.fetch({
					url: this.collection.url + '/' + options.tune_id,
					data: {id: options.tune_id},
					type: 'post'
				});
				break;

			default:
				break;
			
			return this;
		}
	},

	_afterFetchTune: function(model, response) {
		var tune = model.attributes.Tune;

		this.$tunes.html(this.template(model.toJSON()));

		App.router.navigate('/tunes/view/' + tune.id, {trigger: true, replace: true});

		this.$home.hide();
		this.$tunes.show();
		this.$tunes.scrollTop(0);

		$('.spinner').hide();
		$(".m-carousel").carousel();
		$(".html5lightbox").html5lightbox({
			overlayopacity: 0.8
		});

		document.title = tune.name + ' | What To Play Next?';
	},

	_goNext: function() {
		this.randomTune.fetch({
			data: {enabled_books: App.Configs.enabled_books},
			type: 'post'
		});
	}

});

// Config view
App.Views.ConfigView = Backbone.View.extend({
	el: '.drawers',

	events: {
		'click .checkbox': 'onCheck'
	},

	initialize: function() {
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

	onCheck: function() {
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
		'': 'homeRoute',
		'next': 'nextRoute',
		'tunes/view/:id': 'tunesView'
	},

	initialize: function() {
		var preventDefaultElems = '.btn-wpn';
		var isPushStateSupported = !!(window.history && window.history.pushState);

		// Use pushState on supported browsers, and not supported,
		// use full-load transitions (prevent to use hashbang).
		Backbone.history.start({pushState: true, hashChange: false});
		
		if (isPushStateSupported) {
			$(document).on('click', preventDefaultElems, function (e) {
				var href = $(this).attr('href');
				var protocol = this.protocol + '//';
				if (href.slice(protocol.length) !== protocol) {
					e.preventDefault();
					App.router.navigate(href, {trigger: true});
				}
			});
		}
	},

	homeRoute: function() {
		// console.info('App.router.homeRoute');
		App.appView.showContent('home');
	},

	nextRoute: function() {
		// console.info('App.router.nextRoute');
		App.appView.showContent('next');
	},

	tunesView: function(id) {
		// console.info('App.router.tunesView ... id: ' + id);
		App.appView.showContent('tunesView', {tune_id: id});
	}

});

$(function() {
	App.run();
});