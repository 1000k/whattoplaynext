var WPN = function(){};

WPN.prototype.next = function(){
	$.ajax({
		url: '/next.json',
		success: function(data, textStatus){
			if (data.result === 'OK') {
				location.href = data.url;
			}
		}
	});
};