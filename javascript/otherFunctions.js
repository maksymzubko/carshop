$(document).ready(function () {

	filterData();

	$('.color').click(function(){
		$(this).toggleClass('actived');
	});

	function filterData(){
		$('.maincar').html('<div id="load" style=""></div>');
		var action = 'fetch_data';
		var brand = get_filter('brand');
		var category = get_filter('category');
		var color = get_filter('color');

		$.ajax({
			url:"/app/eventsHandler.php",
			method:"POST",
			dataType: "html",
			data:{action:action, brand:brand, category:category, color:color},
			success:function(xhr){
				$('.maincar').html(xhr);
				if(xhr=='<div class="text-center"><h3 class="none">No Data Found</h3></div>')
				{
					$('#change1').css('display','none');
				}
				sameDivs();
			}
		});
	}

	function get_filter(class_name)
	{
		var filter = [];
		if(class_name=="color")
		{
			$(".actived").each(function(){
				filter.push($(this).attr("id"));
			});
		}
		else
		{		
		$('.'+class_name+':checked').each(function(){
			filter.push($(this).val());
		});
		}
		return filter;
	}

	$('.common_selector').click(function(){
		filterData();
	});

	function setActive(value) {
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
	$('input:radio[id="t1"]').change(function () {
		if ($(this).is(':checked')) {
			elem.removeClass().addClass('col-xs-12 col-sm-12 col-lg-6 col-md-6 product-left p-left');
		}
	});
	$('input:radio[id="t2"]').change(function () {
		if ($(this).is(':checked')) {
			elem.removeClass().addClass('col-xs-12 col-sm-12 col-lg-12 col-md-12 product-left p-left');
		}
	});
	$('input:radio[id="t3"]').change(function () {
		if ($(this).is(':checked')) {
			elem.removeClass().addClass('col-xs-12 col-sm-12 col-lg-4 col-md-4 product-left p-left');
		}
	});

	$('input:radio[name="radio"]').change(function () {
		sameDivs();
	})
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
	$('.testdrive_add').click(function () {
		var id_car = window.location.href.replace("http://carshop.loft/car.php?id=", "").replace("#", "");
		$.ajax({
			type: 'POST',
			url: 'app/eventsHandler.php',
			data: {
				'car_ID': id_car,
				'mytest': "ndtst"
			}, success: function (result) {
				swal(
					"Успешно!",
					"Вы успешно добавили машину! С вами свяжется наш сотрудник.",
					"success",
				);

			}, error: function (xhr, status, error) {
				let d = JSON.parse(xhr.responseText);
				swal(
					"Ошибка!",
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
					d.error,
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
	$('.logout').click(function (e) {
		$.ajax({
			type: 'POST',
			url: 'app/eventsHandler.php',
			data: { 'logout': "need" },
			success: function (response) {
				swal(
					"Отлично!",
					"Пользователь успешно вышел!",
					"success",
				);
				location.href = location.href;
			}
		})
	});
	$('.lookcar').click(function (e) {
		let id = $(this).parent().parent().parent().attr("id");
		location.href = window.location.origin + "/car.php?id=" + id;
		$.ajax({
			type: 'POST',
			url: 'app/eventsHandler.php',
			data: {
				'addLookCount': ""
			}
		});
	});
	$('.link').click(function () {
		window.location.href = '/admin/login.php';
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
				if(!tempElem)
				{
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
				if(!tempElem)
				{
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

	$(document).ready(function () {

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
						title: "Ошибка!",
						text: d.error,
						type: "error",
					});
					location.href = window.location.origin + "/login.php";
					return false;
				}
			});
		};

		if (result()) {
			var url;

			function lang() {
				var temp = $('.memenu').attr("class");
				if (temp.includes("memenu en"))
					url = "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json";
				else if (temp.includes("memenu ukr"))
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
		};
	});
	function sameDivs() {
		let min = 0;
		function del() {
			$('.zoom-img').each(function () {
				$(this).css("min-height", "");
			});
		}
		del();
		$('.zoom-img').each(function () {
			let height = $(this).height();
			console.log(height);
			if (height > min)
				min = height+1;
		});
		function setDiv(min) {
			$('.zoom-img').css("min-height", min);
		}
		setDiv(min);
	}
});
setTimeout(function () {
	$('body').addClass('body_visible');
}, 100);