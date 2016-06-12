$(function () {
	$('.numbersOnly').keyup(function () {
	    if (this.value != this.value.replace(/[^0-9\.]/g, '')) {
	       this.value = this.value.replace(/[^0-9\.]/g, '');
	    }
	});
	
	$('.subnavbar').find ('li').each (function (i) {
	
		var mod = i % 3;
		
		if (mod === 2) {
			$(this).addClass ('subnavbar-open-right');
		}
		
	});
	
	function createAutoClosingAlert(selector, delay) {
	   var alert = $(selector).alert();
	   window.setTimeout(function() { alert.alert('close') }, delay);
	}
	
	//createAutoClosingAlert(".alert", 10000);
});