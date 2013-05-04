(function() {
	var ConfigList = Backbone.Collection.extend({
		model: app.Config,
		localStorage: new Store('configs-backbone'),
		checked: function() {
			return this.filter(function(config) {
				return config.get('checked');
			});
		}
	});
}());