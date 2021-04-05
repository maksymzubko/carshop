$(function () {
	var menu_ul = $('.menu_drop > li > ul'),
		menu_a = $('.menu_drop > li > a');

	menu_ul.hide();

	menu_a.click(function (e) {
		e.preventDefault();
		if (!$(this).hasClass('active')) {
			menu_a.removeClass('active');
			menu_ul.filter(':visible').slideUp('normal');
			$(this).addClass('active').next().stop(true, true).slideDown('normal');
		} else {
			$(this).removeClass('active');
			$(this).next().stop(true, true).slideUp('normal');
		}
	});

	mybutton = document.getElementById("myBtn");

	mybutton.addEventListener("click", topFunction);

	window.onscroll = function () { scrollFunction(120) };

	function scrollFunction(numb) {
		if (document.body.scrollTop > numb || document.documentElement.scrollTop > numb) {
			mybutton.style.display = "block";
		} else {
			mybutton.style.display = "none";
		}
	}
	function topFunction() {
		document.body.scrollTop = 0;
		document.documentElement.scrollTop = 0;
	}
});
$(document).ready(() => {
	$('.close_btn').click(() => {
		$('.form-testdrive').toggleClass('hide');
		$('body').toggleClass('overflow-hidden');
	});
	$('body').addClass('visible');
});
$('.filter-ico').click((el) => {
	$(el.target).toggleClass('enabled');
})

$('.contact-with-us>.header').click((e) => {
	if ($(e.target).is("div") && $(e.target).hasClass('header'))
		$(e.target).parent().toggleClass('close');
	else if ($(e.target).is("img"))
		$(e.target).parent().parent().parent().toggleClass('close');
	else
		$(e.target).parent().parent().toggleClass('close');
})
$('.search').click(() => {
	let search = $('.search-input');
	let search_input = $('.search-input input');

	if (search.hasClass('hide-timing')) {
		search.removeClass('hide-timing');
		search_input.focus();
	}
	else {
		search.addClass('hide-timing');
	}

	$(document).mouseup((e) => {
		if (!search.hasClass('hide-timing')) {
			if (!search.is(e.target) && search.has(e.target).length === 0 && !$('.search').is(e.target)) {
				search.addClass('hide-timing');
			}
		}
	})
});
$('.search-input input').keyup((e) => {
	if ($(e.target).val().length > 0) $('.search-input a').removeClass('hide-timing');
	else $('.search-input a').addClass('hide-timing');

	search_func($('.search-input input').val());
})
function search_func(str) {
	$.ajax({
		type: 'POST',
		url: 'app/eventsHandler.php',
		data: {
			'action': "getFiltred",
			'filter': str
		}, success: function (xhr) {
			$('.search_result').html(xhr.html);
		}
	});
}
$('.search-input input').change((e) => {
	if ($(e.target).val().length > 0) $('.search-input a').removeClass('hide-timing');
	else $('.search-input a').addClass('hide-timing');
})
$('.filter-ico').click(() => {
	let filters = $('.filters_list');
	filters.addClass('show');
	$('header').addClass('hide');
	$('body').addClass('overflow-hidden');
	$('.close').click(() => {
		filters.removeClass('show');
		$('header').removeClass('hide');
		$('body').removeClass('overflow-hidden');
	})
});

function toastCloseBtn(swal) {
	let content = swal.getContainer();
	$(content).append('<div class="close"><p>X</p></div>');
	$('.close p').click(() => {
		swal.close();
	})
}

$(document).ready(function () {

	const Toast = Swal.mixin({
		toast: true,
		position: 'center',
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

	let but = $('.car_btn');
	let block;
	let blockText;
	let blockDates = [];
	let id_car;
	let engWords, ruWords, uaWords;

	if (window.location.href.includes('car.php')) {
		let priceTest;
		id_car = window.location.href.replace(window.location.href.substr(0, window.location.href.indexOf("=")), "").replace("=", "").replace("#", "").split('&lang=')[0];
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

				}
				engWords = { "errorMessage": "Error!", "denied": "Denied", "wait": "Waiting", "success": "Success", "successMessage": "Success!", "questionMessage": "Are you sure?", "btnCancel": "Cancel", "catalog": "Go to catalog" };
				ruWords = { "errorMessage": "Ошибка!", "denied": "Отказано", "wait": "Обрабатывается", "success": "Принято", "successMessage": "Успех!", "questionMessage": "Вы уверены?", "btnCancel": "Отмена", "catalog": "Перейти в каталог" };
				uaWords = { "errorMessage": "Помилка!", "denied": "Відказано", "wait": "Обробляється", "success": "Прийнято", "successMessage": "Успіх!", "questionMessage": "Ви впевнені?", "btnCancel": "Відміна", "catalog": "Перейти в каталог" };

			}, error: function (xhr) {

				engWords = { "errorMessage": "Error!", "denied": "Denied", "wait": "Waiting", "success": "Success", "successMessage": "Success!", "questionMessage": "Are you sure?", "btnCancel": "Cancel", "catalog": "Go to catalog" };
				ruWords = { "errorMessage": "Ошибка!", "denied": "Отказано", "wait": "Обрабатывается", "success": "Принято", "successMessage": "Успех!", "questionMessage": "Вы уверены?", "btnCancel": "Отмена", "catalog": "Перейти в каталог" };
				uaWords = { "errorMessage": "Помилка!", "denied": "Відказано", "wait": "Обробляється", "success": "Прийнято", "successMessage": "Успіх!", "questionMessage": "Ви впевнені?", "btnCancel": "Відміна", "catalog": "Перейти в каталог" };
				blockText = JSON.parse(xhr.responseText).error;
				block = JSON.parse(xhr.responseText).block;
			}
		});
	}
	else {
		engWords = { "errorMessage": "Error!", "denied": "Denied", "wait": "Waiting", "success": "Success", "successMessage": "Success!", "questionMessage": "Are you sure?", "btnCancel": "Cancel", "catalog": "Go to catalog" };
				ruWords = { "errorMessage": "Ошибка!", "denied": "Отказано", "wait": "Обрабатывается", "success": "Принято", "successMessage": "Успех!", "questionMessage": "Вы уверены?", "btnCancel": "Отмена", "catalog": "Перейти в каталог" };
				uaWords = { "errorMessage": "Помилка!", "denied": "Відказано", "wait": "Обробляється", "success": "Прийнято", "successMessage": "Успіх!", "questionMessage": "Ви впевнені?", "btnCancel": "Відміна", "catalog": "Перейти в каталог" };
	}

	let currentLang = getCookie('lang');

	function w(str) {
		return (currentLang == "en") ? engWords[str] : (currentLang == "ru") ? ruWords[str] : uaWords[str];
	}

	function filterData(id) {
		$('.car-profile').html('<div id="load" style=""></div>');
		var action = 'fetch_data';
		if (id == 0) {
			var brand = get_filter('brand');
			var category = get_filter('category');
			var color = get_filter('color');

			$.ajax({
				url: "/app/eventsHandler.php",
				method: "POST",
				dataType: "html",
				data: { action: action, brand: brand, category: category, color: color },
				success: function (xhr) {
					$('.car-profile').html(xhr);
					but = $('a.car_btn');
					but.click(button);
				},
			});
		}
		else {

			let filter = getParams('filter');
			$('.search-input input').val(filter);
			search_func($('.search-input input').val());

			$.ajax({
				url: "/app/eventsHandler.php",
				method: "POST",
				dataType: "html",
				data: { action: action, filter: filter },
				success: function (xhr) {
					$('.car-profile').html(xhr);
					but = $('a.car_btn');
					but.click(button);
				},
			});
		}
	}

	if (window.location.pathname == "/cars.php") {
		if (window.location.href.includes('filter'))
			filterData(1);
		else
			filterData(0);
	}

	function setActive() {
		if (window.location.pathname == "/index.php") {
			$('#first').toggleClass('active');
		}
		else if (window.location.pathname == "/cars.php") {
			$('#second').toggleClass('active');
		}
		else if (window.location.pathname == "/contacts.php") {
			$('#third').toggleClass('active');
		}
	}
	setActive();

	$('.color').click(function () {
		$(this).parent().toggleClass('actived');
		$(this).toggleClass('actived');
	});

	$('.common_selector').click(function () {
		filterData(0);
	});

	but.click(button);

	function button() {
		let id = $(this).parent().parent().parent().parent().attr("id");
		let link = window.location.origin + "/car.php?id=" + id;
		window.location.href = link;
	};
	function formatDate(datestr) {
		var date = new Date(datestr);
		date.setHours(date.getHours() - 2);
		var day = date.getDate(); day = day > 9 ? day : "0" + day;
		var month = date.getMonth() + 1; month = month > 9 ? month : "0" + month;
		var full = date.getFullYear() + "-" + month + "-" + day;
		return full;
	}

	$('.test').click(function async() {
		if (block == true) {
			Swal.fire({
				title: blockText,
				icon: "info"
			}
			);
		}
		else {
			$('body').toggleClass('overflow-hidden');
			let s = $('.pricecheck');
			if (s.is(':checked'))
				s.prop("checked", false);

			s.change(() => {
				if (s.is(':checked') && $('.datetime').val() != "")
					$('.form-testdrive button').removeClass('disable');
				else
					$('.form-testdrive button').removeClass('disable').addClass('disable');
			})

			$('.form-testdrive button').removeClass('disable').addClass('disable');
			$('.form-testdrive .datetime').val("");

			$('.form-testdrive').toggleClass('hide');
			$('.datetime').datetimepicker({
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
			$(".datetime").on("change", function (e) {
				if (s.is(':checked') && $('.datetime').val() != "")
					$('.form-testdrive button').removeClass('disable');
				else
					$('.form-testdrive button').removeClass('disable').addClass('disable');
				$('.datetime').datetimepicker('hide');
			});
			$('.datetime').datetimepicker('hide');
			$('.order').click(() => {
				$.ajax({
					type: 'POST',
					url: '../app/eventsHandler.php',
					data: {
						'car_ID': getParams('id'),
						'mytest': "ndtst",
						'date': $('.datetime').val()
					}, success: function (xhr) {
						$('.form-testdrive').toggleClass('hide');
						Swal.fire(
							{
								title: w("succesMessage"),
								text: xhr.successmsg,
								icon: "success",
								showConfirmButton: true,
								showCancelButton: false,
								confirmButtonText: w("catalog")
							}



						).then((result) => {
							if (result.isConfirmed) {
								window.location.href = "/cars.php";
							}
						});

					}, error: function (xhr) {
						let d = JSON.parse(xhr.responseText);
						$('.form-testdrive').toggleClass('hide');
						Swal.fire(
							w("errorMessage"),
							d.error,
							"error",
						);
					}
				});
			})
		}
	});

	function phone(elem) {
		$(elem).bind('keydown', function (e) {
			if (e.keyCode == 8) {
				let start = $(this).prop('selectionStart');
				let end = $(this).prop('selectionEnd');
				if ($(this).val().length == 5)
					e.preventDefault();
				else if (start != end)
					e.preventDefault();
				else
					return;
			}
			else if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105)) {
				if ($(this).val().length == 7)
					$(this).val($(this).val() + " ");

				if ($(this).val().length == 11)
					$(this).val($(this).val() + " ");

				return;
			}
			else e.preventDefault();
		})
	}
	phone($('.phone'));
	$('.lan').click(function (e) {
		if (window.location.origin + window.location.pathname == "http://carshop.loft/car.php") {
			let link = location.href;
			if (getParams("&lang=")) {
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
		$('input.error').removeClass('error');
		$('.alert').addClass('hide');
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: 'app/eventsHandler.php',
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			success: function (xhr) {
				$('input.error').removeClass('error');
				$('.alert').addClass('hide');
				Toast2.fire({
					title: xhr.successmsg,
					icon: "success"
				});
				setTimeout(() => { location.href = window.location.origin + "/login.php"; }, 2000)
			},
			error: function (xhr, status, error) {
				let d = JSON.parse(xhr.responseText);

				$('input.error').removeClass('error');
				$('.alert').addClass('hide');

				if (d['error'] == undefined) {
					d.errorArr.forEach((elem) => {
						$(".alert." + elem.errorTarget).removeClass('hide');
						$(".alert." + elem.errorTarget + " p").html(elem.error);
						$(".alert." + elem.errorTarget).prev('input').addClass('error');
					})
				}
				else {
					$(".alert." + d.errorTarget).removeClass('hide');
					$(".alert." + d.errorTarget + " p").html(d.error);
					$(".alert." + d.errorTarget).prev('input').addClass('error');
				}
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
				location.href = window.location.origin + "/login.php";
			},
			error: function (xhr, status, error) {
				let d = JSON.parse(xhr.responseText);
				Toast2.fire({
					title: d.error,
					icon: "error"
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
	function ChangeStateTable(table, error, footer, station) {
		if (station == "disable") {
			table.hide();
			error.show();
			footer.hide();
		}
		else {
			table.show();
			error.hide();
			footer.show();
		}
	}
	if (getCookie('acc') != undefined) {
		let reload = true;
		var url = lang();
		if (window.location.pathname == "/testdrives.php") {
			let success = true;
			var data = $('#data').DataTable({
				"processing": true,
				"serverSide": true,
				"language": {
					"url": url
				},
				"order": [],
				"ajax": {
					url: "../app/eventsHandler.php",
					data: { action: 'getAllTests5' },
					type: "POST",
					"processing": false,
					error: function () {
						let error = $('.error');
						let table = $('table');
						let footer = $('#data_wrapper .row:nth-child(3)');

						ChangeStateTable(table, error, footer, "disable");

						$("#data_processing").css("display", "none");
					}
				}
			});

			$('#data').on('draw.dt', function () {
				let error = $('.error');
				let table = $('table');
				let footer = $('#data_wrapper .row:nth-child(3)');
				($('table tr:not(:first)').length > 0)
				{
					$('tbody tr td:last-child').each((index, val) => {
						if ($(val).html() == "Denied")
							$(val).html(w("denied"));
						else if ($(val).html() == "Success")
							$(val).html(w("success"));
						else if ($(val).html() == "Waiting")
						$(val).html(w("wait"));
					})
					ChangeStateTable(table, error, footer, "enable");

					$("#data_processing").css("display", "none");
				}

			})
		};
	};
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
function result() {
	if (location.href.includes("login.php")) {

	}
	else
		if (getCookie('acc') != undefined)
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

function getParams(filterStr) {
	let url = new URL(window.location.href);
	let searchParams = new URLSearchParams(url.search);
	let filter = searchParams.get(filterStr);
	return filter;
}
