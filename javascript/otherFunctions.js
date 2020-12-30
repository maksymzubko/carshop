$(document).ready(function () {
	function setActive(){
		if(window.location.pathname == "/index.php")
		$('#first').removeClass().addClass('grid active');
		else if(window.location.pathname == "/cars.php")
		$('#second').removeClass().addClass('grid active');
		else if(window.location.pathname == "/blog.php")
		$('#third').removeClass().addClass('grid active');
		else if(window.location.pathname == "/contact.php")
		$('#fouth').removeClass().addClass('grid active');
	}
	setActive();
	var elem = $(".product").children("div");
	$('input:radio[id="t1"]').change(function () {
		if ($(this).is(':checked')) {
			elem.removeClass().addClass('col-xs-6 col-sm-6 col-lg-6 col-md-6 product-left p-left');
		}
	});
	$('input:radio[id="t2"]').change(function () {
		if ($(this).is(':checked')) {
			elem.removeClass().addClass('col-xs-12 col-sm-12 col-lg-12 col-md-12 product-left p-left');
		}
	});
	$('.favourite').click(function () {
		var elem = $(this);
		if (elem.attr('class') == "favourite nope") { elem.removeClass().addClass('favourite is'); }
		else { elem.removeClass().addClass('favourite nope'); }

		elem.focus();
		elem.blur();
	});
		$('.lan').click(function(e) {
				location.href = window.location.origin + window.location.pathname + "?lang=" + e.target.id;
		   });
	$.getScript("/javascript/resize.js", function () {
		new ResizeSensor(jQuery(elem), function () {
			elem.css({ 'transition-duration': '0.4s' });
		});
		$(window).resize(function () {
			let element = $("#change1");
			let width = document.documentElement.clientWidth;
			if (width < 768) {
				element.css('display', 'none');
			} else {
				element.css('display', 'block');
			}
		});
		$(window).load(function () {
			let element = $("#change1");
			let width = document.documentElement.clientWidth;
			if (width < 768) {
				element.css('display', 'none');
			} else {
				element.css('display', 'block');
			}
		});
	});
});
setTimeout(function () {
	$('body').addClass('body_visible');
}, 100);