/*jslint browser: true, node : true*/
/*jslint devel : true*/
/*global $, document, this*/
$(document).ready(function(){
	$('.datepicker').pickadate({
		selectMonths: true,
		selectYears: 100
	});
});