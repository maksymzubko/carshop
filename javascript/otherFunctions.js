$(document).ready(function(){
	var elem = $(".product").children("div");
		$('input:radio[id="t1"]').change(function(){
    if($(this).is(':checked')){
		elem.removeClass().addClass('col-xs-6 col-sm-6 col-lg-6 col-md-6 product-left p-left');
	}	
});
$('input:radio[id="t2"]').change(function(){
    if($(this).is(':checked')){
		elem.removeClass().addClass('col-xs-12 col-sm-12 col-lg-12 col-md-12 product-left p-left');
    }
});
$.getScript("/javascript/resize.js", function(){
	new ResizeSensor(jQuery(elem), function(){ 
		elem.css({'transition-duration':'0.4s'});
});
$(window).resize(function(){
	let element = $("#change1");
	let width = document.documentElement.clientWidth;
	if(width < 768) {		
		element.css('display','none');
   }else
   {
	element.css('display','block');
   }	
  });
$(window).load(function () {
	let element = $("#change1");
let width = document.documentElement.clientWidth;
if(width < 768) {		
	element.css('display','none');
}else
{
element.css('display','block');
}	});
});
});