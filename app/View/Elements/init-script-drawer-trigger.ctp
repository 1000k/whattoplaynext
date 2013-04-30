var snapper = new Snap({
	element: $('.drawer-swipable')[0]
	, disable: 'right'
	, slideIntent: 15
});

$('.btn-drawer-trigger').click(function() {
	if( snapper.state().state=="left" ){
		snapper.close();
	} else {
		snapper.open('left');
	}
});
