var app = app || {};

(function() {
	app.Config = Backbone.Model.extend({
		defaults: {
			checked: false
		}
		, toggle: function() {
			this.save({
				checked: !this.get('checked')
			});
		}
	});
}());