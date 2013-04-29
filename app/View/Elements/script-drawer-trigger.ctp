<script>
$(document).ready(function(){
	var snapper = new Snap({
		element: $('#content')[0]
		, disable: 'right'
	});

	$('.btn-drawer-trigger').click(function() {
		if( snapper.state().state=="left" ){
			snapper.close();
		} else {
			snapper.open('left');
		}
	});
});
</script>