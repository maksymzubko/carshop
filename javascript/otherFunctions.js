$(document).ready(function () {
	function setActive() {
		if (window.location.pathname == "/index.php")
			$('#first').removeClass().addClass('grid active');
		else if (window.location.pathname == "/cars.php")
			$('#second').removeClass().addClass('grid active');
		else if (window.location.pathname == "/blog.php")
			$('#third').removeClass().addClass('grid active');
		else if (window.location.pathname == "/contact.php")
			$('#fourh').removeClass().addClass('grid active');

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
	$('input:radio[id="t3"]').change(function () {
		if ($(this).is(':checked')) {
			elem.removeClass().addClass('col-xs-4 col-sm-4 col-lg-4 col-md-4 product-left p-left');
		}
	});
	$('.favourite').click(function () {
		var elem = $(this);
		let need;
		if (elem.attr('class') == "favourite nope") { need = "0"; }
		else { need = "1"; }

		var id_car = $(this).parent().parent().parent().parent().attr('id');
		$.ajax({
			type: 'POST',
			url: 'app/eventsHandler.php',
			data: {
				'car_ID': id_car,
				'need': need
			}, success: function (result) {
				if (need == 0)
					elem.removeClass().addClass('favourite is');
				else
					elem.removeClass().addClass('favourite nope');

				elem.focus();
				elem.blur();

			}, error: function (xhr, status, error) {
				swal(
					"Ошибка!",
					"Необходимо быть зарегистрированым!",
					"error",
				);
			}
		});
	});
	$('.phone').mask('+380 (00) 000 0000', { placeholder: "+___ (__) ___ ____" });
	$('.lan').click(function (e) {
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
					"Отлично!",
					"Пользователь успешно зарегистрирован!",
					"success",
				);
				location.href = window.location.origin + "/account.php";
			},
			error: function (xhr, status, error) {
				let d = JSON.parse(xhr.responseText);
				swal(
					"Жаль!",
					d.errors[0].email,
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
			success: function (response) {
				swal(
					"Отлично!",
					"Пользователь успешно авторизирован!",
					"success",
				);
				location.href = window.location.origin + "/account.php";
			},
			error: function (xhr, status, error) {
				let d = JSON.parse(xhr.responseText);
				swal(
					"Жаль!",
					d.errors[0].login,
					"error",
				);
			}
		})
	});
	$('#logout').submit(function (e) {
		var data = new FormData(this);
		$.ajax({
			type: 'POST',
			url: 'app/eventsHandler.php',
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			success: function (response) {
				swal(
					"Отлично!",
					"Пользователь успешно вышел!",
					"success",
				);
				location.href = window.location.origin + "/account.php";
			}
		})
	});
	$('.link').click(function () {
		window.location.href = '/admin/login.php';
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

	$(document).ready(function () {
	var url;

	function lang()
	{
		var temp = $('.memenu').attr("class");
		if(temp.includes("en"))
		url = "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json";
		else if(temp.includes("ukr"))
		url = "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json";
		else 
		url = "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json";
	};
		lang();

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
	});
});

setTimeout(function () {
	$('body').addClass('body_visible');
}, 100);