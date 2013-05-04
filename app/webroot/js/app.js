$(function() {
	console.log("Hello backbone!");

	// Views
	var AppView = Backbone.View.extend({
		el: $('body'),
		
		initialize: function() {
			_.bindAll(this, 'render');
			this.render();
		},

		render: function() {
			console.log('render');
			// $(this.el).append('<div>mojamojamojamoja</div>');
		}
	});

	// Start
	new AppView();
});