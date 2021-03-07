$(document).ready(function () {

	const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 4000,
		timerProgressBar: true,
		didOpen: (toast) => {
			toast.addEventListener('click', Swal.close)
		  }
	});

	const Toast2 = Swal.mixin({
		toast: true,
		position: 'center',
		showConfirmButton: false,
		timer: 3000,
		timerProgressBar: true,
		didOpen: (toast) => {
			toast.addEventListener('click', Swal.close)
		  }
	});

	result();

	let fav = $('.favourite');
	let but = $('.lookcar');
	let t1 = $('#t1'); let t2 = $('#t2'); let t3 = $('#t3');
	let input = $('input:radio[name="radio"]');
	let priceTest = 0;
	let resultAsync;
	let block;
	let blockText;
	let blockDates = [];
	let id_car;
	let engWords, ruWords, uaWords;

	if (window.location.href.includes('car.php')) {
		id_car = window.location.href.replace(window.location.href.substr(0,window.location.href.indexOf("=")),"").replace("=","").replace("#", "").split('&lang=')[0];
		$.ajax({
			type: 'POST',
			url: 'app/eventsHandler.php',
			data: {
				'action': "getBlock",
				'car_ID': id_car
			}, success: function (xhr) {
				priceTest = parseInt(xhr.tprice);
				if (xhr.dates != undefined) {
					xhr.dates.forEach(element => {
						blockDates.push(element.split(':')[0]);
					});
					block = xhr.block;
					if (block == true)
						blockText = xhr.eq;

				}priceTextRU = (priceTest == 0) ? "Тест драйв этой машини - бесплатен" : "Это будет стоить '" + priceTest + "'грн (оплата по приезду), вы согласны?";
				priceTextENG = (priceTest == 0) ? "Test drive is free" : "It will cost '" + priceTest + "'uan (pay on arrival), do you agree?";
				priceTextUA = (priceTest == 0) ? "Тест драйв цього авто безкоштовний" : "Це буде коштувати '" + priceTest + "'грн (оплата по приїзду), ви згодні?";
				engWords = { "errorMessage": "Error!", "successMessage": "Success!", "questionMessage": "Are you sure?", "btnCancel": "Cancel", "qu1": priceTextENG, "qu2": "Choose date" };
				ruWords = { "errorMessage": "Ошибка!", "successMessage": "Успех!", "questionMessage": "Вы уверены?", "btnCancel": "Отмена", "qu1": priceTextRU, "qu2": "Выберите дату" };
				uaWords = { "errorMessage": "Помилка!", "successMessage": "Успіх!", "questionMessage": "Ви впевнені?", "btnCancel": "Відміна", "qu1": priceTextUA, "qu2": "Виберіть дату" };

			}, error: function (xhr) {
				priceTextRU = (priceTest == 0) ? "Тест драйв этой машини - безплатен" : "Это будет стоить '" + priceTest + "'грн (оплата по приезду), вы согласны?";
				priceTextENG = (priceTest == 0) ? "Test drive is free" : "It will cost '" + priceTest + "'uan (pay on arrival), do you agree?";
				priceTextUA = (priceTest == 0) ? "Тест драйв цього авто безкоштовний" : "Це буде коштувати '" + priceTest + "'грн (оплата по приїзду), ви згодні?";
				engWords = { "errorMessage": "Error!", "successMessage": "Success!", "questionMessage": "Are you sure?", "btnCancel": "Cancel", "qu1": priceTextENG, "qu2": "Choose date" };
				ruWords = { "errorMessage": "Ошибка!", "successMessage": "Успех!", "questionMessage": "Вы уверены?", "btnCancel": "Отмена", "qu1": priceTextRU, "qu2": "Выберите дату" };
				uaWords = { "errorMessage": "Помилка!", "successMessage": "Успіх!", "questionMessage": "Ви впевнені?", "btnCancel": "Відміна", "qu1": priceTextUA, "qu2": "Виберіть дату" };
				blockText = JSON.parse(xhr.responseText).error;
				block = JSON.parse(xhr.responseText).block;
			}
		});
	}
	else {
		engWords = { "errorMessage": "Error!", "successMessage": "Success!", "questionMessage": "Are you sure?", "btnCancel": "Cancel", "qu1": "It will cost '" + priceTest + "'grn (pay on arrival), do you agree?", "qu2": "Choose date" };
		ruWords = { "errorMessage": "Ошибка!", "successMessage": "Успех!", "questionMessage": "Вы уверены?", "btnCancel": "Отмена", "qu1": "Это будет стоить '" + priceTest + "'грн (оплата по приезду), вы согласны?", "qu2": "Выберите дату" };
		uaWords = { "errorMessage": "Помилка!", "successMessage": "Успіх!", "questionMessage": "Ви впевнені?", "btnCancel": "Відміна", "qu1": "Це буде коштувати '" + priceTest + "'грн (оплата по приїзду), ви згодні?", "qu2": "Виберіть дату" };
	}

	let currentLang = getCookie('lang');

	function w(str) {
		return (currentLang == "en") ? engWords[str] : (currentLang == "ru") ? ruWords[str] : uaWords[str];
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
			},
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
			data: { 'email': email, 'pass': pass, 'role': 'admin' },
			success: function (xhr) {
				location.href = window.location.origin + window.location.pathname.replace("/login.php", "/panel.php");
			},
			error: function (xhr, status, error) {
				let d = JSON.parse(xhr.responseText);
				Swal.fire(
					w("errorMessage"),
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
		let link = window.location.origin+"/car.php?id=" + id;
		window.location.href.replace(link);
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
				Toast.fire({
					icon:"success",
					title:xhr.successmsg
			});
				if (need == 0)
					elem.removeClass().addClass('favourite is');
				else
					elem.removeClass().addClass('favourite nope');

				elem.focus();
				elem.blur();

			}, error: function (xhr, status, error) {
				let d = JSON.parse(xhr.responseText);
				Toast.fire({
					icon:"error",
					title:d.error				
				});
			}
		});
	}

	function formatDate(datestr) {
		var date = new Date(datestr);
		date.setHours(date.getHours() - 2);
		var day = date.getDate(); day = day > 9 ? day : "0" + day;
		var month = date.getMonth() + 1; month = month > 9 ? month : "0" + month;
		var full = date.getFullYear() + "-" + month + "-" + day;
		return full;
	}


	$('.testdrive_add').click(function async() {
		if (block == true) {
			Swal.fire(
				w("errorMessage"),
				blockText,
				"error"
			);
		}
		else {
			Swal.fire(
				{
					title: w("questionMessage"),
					text: w("qu1"),
					icon: "question",
					showCancelButton: true,
					cancelButtonText: w("btnCancel")
				}).then(async function name(result) {
					if (result.isConfirmed) {
						Swal.fire(
							{
								title: w("qu2"),
								input: 'text',
								inputPlaceholder: w("qu2"),
								inputAttributes: {
									autofocus: false,
									readonly: true
								},
								inputValidator: (value) => {
									if (!value) {
										return 'You need to write something!'
									}
								}
								, didOpen: function () {
									$('.swal2-input').datetimepicker({
										daysOfWeekDisabled: [6],
										startDate: new Date(),
										minView: 1,
										format: "yyyy-mm-dd hh:00",
										language: currentLang,
										hoursDisabled: [0, 1, 2, 3, 4, 5, 6, 7, 8, 20, 21, 22, 23],
										clearBtn: true,
										onRenderHour: function (date) {
											if ($('.disabled').attr('class') != undefined && $('.disabled').attr('class').includes('active'))
												$('span.disabled').removeClass('active');
											if (blockDates.indexOf(formatDate(date) + " " + date.getUTCHours()) > -1) {
												return ['disabled'];
											}
										},
										onRenderMinute: function (date) {
											if ($('.disabled').attr('class') != undefined && $('.disabled').attr('class').includes('active'))
												$('.disabled').removeClass('active');
											if (blockDates.indexOf(formatDate(date) + " " + date.getUTCHours()) > -1) {
												return ['disabled'];
											}
										}
									});
								}
							}).then((result) => {
								if (result.isConfirmed) {
									$.ajax({
										type: 'POST',
										url: '../app/eventsHandler.php',
										data: {
											'car_ID': id_car,
											'mytest': "ndtst",
											'date': result.value
										}, success: function (xhr) {
											Swal.fire(
												w("succesMessage"),
												xhr.successmsg,
												"success",
											);

										}, error: function (xhr) {
											let d = JSON.parse(xhr.responseText);
											Swal.fire(
												w("errorMessage"),
												d.error,
												"error",
											);
										}
									});
								}
							})
					}
				})
		}
	});
	function phone(elem) {
		$(elem).bind('keydown', function (e) {
			if (e.keyCode == 8) {
				let start = $(this).prop('selectionStart');
				let end = $(this).prop('selectionEnd');
				if ($(this).val().length == 4)
					e.preventDefault();
				else if (start != end)
					e.preventDefault();
				else
					return;
			}
			else if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105)) {
				return;
			}
			else e.preventDefault();
		})
	}
	phone($('.phone'));
	$('.lan').click(function (e) {
		if (window.location.origin + window.location.pathname == "http://carshop.loft/car.php") {
			let link = location.href;
			if (link.includes("&lang=")) {
				link = link.split('&lang=')[0] + '&lang=' + e.target.id;
				if (link.includes('#')) {
					link = link.split('#')[0];
				}
				location.href = link;
			}
			else {
				if (location.href.includes('#')) {
					link = link.split('#')[0];
				}
				location.href = link + "&lang=" + e.target.id;
			}

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
				success: function (xhr) {
					Toast2.fire({
						title:xhr.successmsg,
						icon:"success"
					});
					location.href = window.location.origin + "/account.php";
				},
				error: function (xhr, status, error) {
					let d = JSON.parse(xhr.responseText);
					Toast2.fire({
						title:d.error,
						icon:"error"
					});
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
				Toast2.fire(
					w("succesMessage"),
					xhr.successmsg,
					"success",
				);
				location.href = window.location.origin + "/account.php";
			},
			error: function (xhr, status, error) {
				let d = JSON.parse(xhr.responseText);
				Toast2.fire({
					title:d.error,
					icon:"error"
				});
			}
		})
	});
	$('.logout').click(function (e) {
		$.ajax({
			type: 'POST',
			url: 'app/eventsHandler.php',
			data: { 'logout': "need", "role": "user" },
			success: function (xhr) {
				window.location.href = location.href.replace('#', "");
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
		let reload = true;
			var url = lang();
			if (window.location.pathname == "/testdrives.php") {
				let success = true;
				$('#data').DataTable({
					"processing":true,
					"serverSide": true,
					"bSort": false,
					"language": {
						"url": url
					},
					"ajax": {
						url: "app/eventsHandler.php",
						data: { testdrive: 'getAllTests' },
						type: "POST"	,
						success: (xhr)=>{
							if(reload)
							$('#data').DataTable().ajax.reload();
							reload = false;
						},
						error: (xhr) => {
							$(".data-grid-error").html("");
							$("#data_wrapper").append('<h2 style="text-align:center">No data found in the server<h2>');
							$("#data_processing").css("display", "none");
						}				
					}
				});
			};
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
function lang() {
	if (getCookie('lang') == 'en')
		return "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json";
	else if (getCookie('lang') == 'ukr')
		return "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json";
	else
		return "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json";
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
	let width = 0;
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
		width = $(this).width();
		if (height > min)
			min = height + 1;
	});
	function setDiv(min) {
		$('.zoom-img').css("min-height", min);
	}
	setDiv(min);
}
function result() {
	if (location.href.includes("login.php")) {

	}
	else
	if(getCookie('acc') != undefined)
		$.ajax({
			type: 'POST',
			url: 'app/eventsHandler.php',
			data: {
				'checkAccount': "check",
				'role': "user"
			}, success: function (res) {
				return true;
				resultAsync = true;
			}, error: function (xhr, status, error) {
				let d = JSON.parse(xhr.responseText);
				Swal.fire(
					w("errorMessage"),
					d.error,
					"error",
				);
				location.href = window.location.origin + "/login.php";
				return false;
			}
		});
};

