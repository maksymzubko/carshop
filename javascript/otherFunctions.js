$(document).ready(function () {
	
	let fav = $('.favourite');
	let but = $('.lookcar');
	let t1 = $('#t1'); let t2 = $('#t2'); let t3 = $('#t3');
	let input = $('input:radio[name="radio"]');

	let currentLang = getCookie('lang');
	let errorMessage; let succesMessage;
	if (currentLang == "en") {
		errorMessage = "Error!";
		succesMessage = "Success!";
	}
	else if (currentLang == "ukr") {
		errorMessage = "Помилка!";
		succesMessage = "Успіх!";
	}
	else {
		errorMessage = "Ошибка!";
		succesMessage = "Успех!";
	}

	function filterData() {
		$('.maincar').html('<div id="load" style=""></div>');
		var action = 'fetch_data';
		var brand = get_filter('brand');
		var category = get_filter('category');
		var color = get_filter('color');

		$.ajax({
			url: "/app/eventsHandler.php",
			method: "POST",
			dataType: "html",
			data: { action: action, brand: brand, category: category, color: color },
			success: function (xhr) {	
				$('.maincar').html(xhr);

				if (xhr.includes('none')) {
					$('#change1').css('display', 'none');
				}
				else {
					$('#change1').css('display', 'block');
					elem = $(".product").children("div");
				}
				t1 = $('#t1'); t2 = $('#t2'); t3 = $('#t3');
				input = $('input:radio[name="radio"]');
				fav = $('img.favourite');
				but = $('a.lookcar');
				but.click(button);
				fav.click(favourite);
				sameDivs();
			}
		});
	 
	}

	$('.navbar-toggle-sidebar').click(function () {
		$('.navbar-nav').toggleClass('slide-in');
		$('.side-body').toggleClass('body-slide-in');
		$('#search').removeClass('in').addClass('collapse').slideUp(200);
	});

	$('#search-trigger').click(function () {
		$('.navbar-nav').removeClass('slide-in');
		$('.side-body').removeClass('body-slide-in');
		$('.search-input').focus();
	});

   $('#admin').submit(function (e) {
        e.preventDefault();
        var email = $('#inputEmail').val();
        var pass = $('#inputPassword').val();
            $.ajax({
                type: 'POST',
                url: '../app/eventsHandler.php',
                data: {'email':email, 'pass':pass, 'loginAdmin': 'yes'},
                success: function (xhr) {
                    location.href = window.location.origin + window.location.pathname.replace("/login.php","/panel.php");
                },
                error: function (xhr, status, error) {
					let d = JSON.parse(xhr.responseText);
					swal(
						errorMessage,
						d.error,
						"error",
					);
                }
            })
        });

	if (window.location.pathname == "/cars.php") {
		filterData();
	}

	function setActive() {
		if (window.location.pathname == "/index.php") {
			$('#first').removeClass().addClass('grid active');
			$('#first2').removeClass().addClass('grid active');
		}
		else if (window.location.pathname == "/cars.php") {
			$('#second').removeClass().addClass('grid active');
			$('#second2').removeClass().addClass('grid active');
		}
		else if (window.location.pathname == "/blog.php") {
			$('#third').removeClass().addClass('grid active');
			$('#third2').removeClass().addClass('grid active');
		}
		else if (window.location.pathname == "/contact.php") {
			$('#fourh').removeClass().addClass('grid active');
			$('#fourh2').removeClass().addClass('grid active');
		}
	}
	setActive();
	var elem = $(".product").children("div");
	t1.change(function () {
		if ($(this).is(':checked')) {
			elem.removeClass().addClass('col-xs-12 col-sm-12 col-lg-6 col-md-6 product-left p-left');
		}
	});
	t2.change(function () {
		if ($(this).is(':checked')) {
			elem.removeClass().addClass('col-xs-12 col-sm-12 col-lg-12 col-md-12 product-left p-left');
		}
	});
	t3.change(function () {
		if ($(this).is(':checked')) {
			elem.removeClass().addClass('col-xs-12 col-sm-12 col-lg-4 col-md-4 product-left p-left');
		}
	});

	$('.color').click(function () {
		$(this).toggleClass('actived');
	});

	$('.common_selector').click(function () {
		filterData();
	});
	input.change(function () {
		sameDivs();
	});

	but.click(button);
	$('.link').click(function () {
		window.location.href = '/admin/login.php';
	});
	fav.click(favourite);

	function button() {
		let id = $(this).parent().parent().parent().attr("id");
		location.href = window.location.origin + "/car.php?id=" + id;
		$.ajax({
			type: 'POST',
			url: 'app/eventsHandler.php',
			data: {
				'addLookCount': ""
			}
		});
	};
	function favourite() {
		var elem = $(this);
		let need;
		if (elem.attr('class') == "favourite nope") { need = "0"; }
		else { need = "1"; }

		var id_car = $(this).parent().parent().parent().parent().attr('id');
		$.ajax({
			type: 'POST',
			url: 'app/eventsHandler.php',
			dataType: "json",
			data: {
				'car_ID': id_car,
				'need': need
			}, success: function (xhr) {
				swal(
					succesMessage,
					xhr.successmsg,
					"success",
				);
				if (need == 0)
					elem.removeClass().addClass('favourite is');
				else
					elem.removeClass().addClass('favourite nope');

				elem.focus();
				elem.blur();

			}, error: function (xhr, status, error) {
				let d = JSON.parse(xhr.responseText);
				swal(
					errorMessage,
					d.error,
					"error",
				);
			}
		});
	}

	$('.testdrive_add').click(function () {
		var id_car = window.location.href.replace("http://carshop.loft/car.php?id=", "").replace("#", "");
		$.ajax({
			type: 'POST',
			url: 'app/eventsHandler.php',
			data: {
				'car_ID': id_car,
				'mytest': "ndtst"
			}, success: function (xhr) {
				swal(
					succesMessage,
					xhr.successmsg,
					"success",
				);

			}, error: function (xhr, status, error) {
				let d = JSON.parse(xhr.responseText);
				swal(
					errorMessage,
					d.error,
					"error",
				);
			}
		});
	});
	$('.phone').mask('+380 (00) 000 0000', { placeholder: "+___ (__) ___ ____" });
	$('.lan').click(function (e) {
		if (window.location.origin + window.location.pathname == "http://carshop.loft/car.php") {
			if (location.href.includes("&lang=")) {
				location.href = location.href.split('&lang=')[0] + '&lang=' + e.target.id;
			}
			else
				location.href = location.href + "&lang=" + e.target.id;
		}
		else
			location.href = window.location.origin + window.location.pathname + "?lang=" + e.target.id;
	});
	$('#register').submit(function (e) {
		var data = new FormData(this);
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: 'app/eventsHandler.php',
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			success: function (response) {
				swal(
					succesMessage,
					xhr.successmsg,
					"success",
				);
				location.href = window.location.origin + "/account.php";
			},
			error: function (xhr, status, error) {
				let d = JSON.parse(xhr.responseText);
				swal(
					errorMessage,
					d.error,
					"error",
				);
			}
		})
	});
	$('#login').submit(function (e) {
		var data = new FormData(this);
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: 'app/eventsHandler.php',
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			success: function (xhr) {
				swal(
					succesMessage,
					xhr.successmsg,
					"success",
				);
				location.href = window.location.origin + "/account.php";
			},
			error: function (xhr, status, error) {
				let d = JSON.parse(xhr.responseText);
				swal(
					errorMessage,
					d.error,
					"error",
				);
			}
		})
	});
	$('.logout').click(function (e) {
		$.ajax({
			type: 'POST',
			url: 'app/eventsHandler.php',
			data: { 'logout': "need" },
			success: function (xhr) {
				location.href = location.href;
			}
		})
	});
	$.getScript("/javascript/resize.js", function () {
		new ResizeSensor(jQuery(elem), function () {
		});
		$(window).resize(function () {
			let element = $("#change1");
			let width = document.documentElement.clientWidth;
			if (window.location.pathname == "/favourite.php") {
				if (width < 1183) {
					element.css('display', 'none');
				} else {
					element.css('display', 'block');
				}
			}
			else {
				let tempElem = $(".none");
				if (!tempElem) {
					if (width < 768) {
						element.css('display', 'none');
					} else {
						element.css('display', 'block');
					}
				}
			}
			sameDivs();

			let element1 = $(".header1");
			let element2 = $(".header-bottom");

			if (width < 952) {

				element1.hide();
				element2.show();

				setActive();
			}
			else {
				element1.show();
				element2.hide();
			}
		});
	});

	if (getCookie('acc') != undefined) {
		if (result()) {
			var url;

			lang(url);
			if (window.location.pathname == "/testdrives.php") {
				$('#data').DataTable({
					"processing": true,
					"serverSide": true,
					"bSort": false,
					"language": {
						"url": url
					},
					"ajax": {
						url: "app/eventsHandler.php",
						data: { testdrive: 'getTest' },
						type: "POST"
					},
					success: function (data, textStatus, jqXHR) {
						$('#data').DataTable().ajax.reload();
					},
					error: function () {  // error handling
						$(".data-grid-error").html("");
						$("#data").append('<table class="data-grid-error"><tr><th colspan="3">No data found in the server</th></tr></table>');
						$("#data_processing").css("display", "none");
					}
				});
			};
		}
	};
});
setTimeout(function () {
	$('body').addClass('body_visible');
}, 100);
$(window).load(function () {
	let element = $("#change1");
	let width = document.documentElement.clientWidth;
	if (window.location.pathname == "/favourite.php") {
		if (width < 1183) {
			element.css('display', 'none');
		} else {
			element.css('display', 'block');
		}
	}
	else {
		let tempElem = $(".none");
		if (!tempElem) {
			if (width < 768) {
				element.css('display', 'none');
			} else {
				element.css('display', 'block');
			}
		}
	}
	sameDivs();

	let element1 = $(".header1");
	let element2 = $(".header-bottom");

	if (width < 952) {

		element1.hide();
		element2.show();

		setActive();
	}
	else {
		element1.show();
		element2.hide();
	}
});
function getCookie(name) {
	let matches = document.cookie.match(new RegExp(
		"(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
	));
	return matches ? decodeURIComponent(matches[1]) : undefined;
}
function lang(value) {
	if (getCookie('lang') == 'en')
		value = "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json";
	else if (getCookie('lang') == 'ukr')
		value = "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json";
	else
		value = "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json";
};
function get_filter(class_name) {
	var filter = [];
	if (class_name == "color") {
		$(".actived").each(function () {
			filter.push($(this).attr("id"));
		});
	}
	else {
		$('.' + class_name + ':checked').each(function () {
			filter.push($(this).val());
		});
	}
	return filter;
}
function sameDivs() {
	let min = 0;
	let arr = [];
	function del() {
		$('.zoom-img').each(function () {
			$(this).css("min-height", "");
		});
	}
	del();
	$('.zoom-img').each(function () {
		let height = $(this).height();
		arr.push($(this).height());
		if (height > min)
			min = height + 1;
	});
	function setDiv(min) {
		$('.zoom-img').css("min-height", min);
	}
	setDiv(min);
}
function result() {
	$.ajax({
		type: 'POST',
		url: 'app/eventsHandler.php',
		data: {
			'checkAccount': "check"
		}, success: function (res) {
			return true;
		}, error: function (xhr, status, error) {
			let d = JSON.parse(xhr.responseText);
			swal({
				title: errorMessage,
				text: d.error,
				type: "error",
			});
			location.href = window.location.origin + "/login.php";
			return false;
		}
	});
};

