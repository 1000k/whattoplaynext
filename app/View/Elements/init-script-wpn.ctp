var wpn = new WPN();

$('.btn-wpn').on('click', function(e){
	e.preventDefault();
	wpn.next();
	return false;
});