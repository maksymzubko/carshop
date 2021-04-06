$(document).ready(function () {



	if ($('.notify').html() == "0")
		$('.notify').hide();

	$('body').addClass('visible');

	let block;
	let blockText;
	let blockDates = [];

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

	function result() {
		$.ajax({
			type: 'POST',
			url: '../app/eventsHandler.php',
			data: {
				'checkAccount': "check",
				'role': "admin"
			}, success: function (res) {
				return true;
			}, error: function (xhr, status, error) {
				let d = JSON.parse(xhr.responseText);
				Swal.fire(
					"Помилка!",
					d.error,
					"error",
				);
				location.href = window.location.origin + "/login.php";
				return false;
			}
		});
	};

	function deleteCloseBtn(swal)
	{
		$(swal).find('.close').remove()
}
	function toastCloseBtn(swal) {
		let content = swal.getPopup();
		$(content).append('<div class="close"><p>X</p></div>');
		$('.close p').click(() => {
			swal.close();
		})
	}

	result();

	let fileName = "";
	//actionondeletephoto
	function deletephoto() {
		$('.withcontent').click(function (e) {
			if (e.offsetX > 115) {
				let element = $(e.target).parents().eq(0).attr("id");
				$("div#" + element + " .fileInput").val('');
				$("div#" + element + " .link").val('');
				let image = $("#" + element + " .fleximage img");
				image.attr("src", "../images/notimage.png");
				image.parent().toggleClass("withcontent");
			}
		})
	}

	//func for check isFileExist
	function fileExists(url) {
		if (url) {
			var req = new XMLHttpRequest();
			req.open('GET', url, false);
			req.send();
			if (req.status == 200)
				return true
			else
				return false;
		} else {
			return false;
		}
	}
	//func for work with files
	async function fileHandler(file, Swal, DivID) {

		Swal.resetValidationMessage();

		let fileInfo = file.files[0];
		const path = '../images/' + fileInfo.name;

		if (fileInfo.size > 10000000) {
			$("#" + DivID + " .fileInput").val('');
			return Swal.showValidationMessage("Файл " + fileInfo.name + " перевищує допустимий розмір (10МБ)");
		}

		if (!fileInfo.name.includes('.jpg') && !fileInfo.name.includes('.png')) {
			$("#" + DivID + " .fileInput").val('');
			return Swal.showValidationMessage("Файл повинен бути формату 'jpg' або 'png'");
		}

		if (!fileExists(path)) {
			$("#" + DivID + " .fileInput").val('');
			return Swal.showValidationMessage("Файл " + fileInfo.name + " не було знайдено!");
		}

		let boolIal = true;
		const result = await $.ajax({
			type: 'POST',
			url: '../app/eventsHandler.php',
			data: {
				'getImageSize': "get",
				'image': fileInfo.name
			},
			success: (xhr) => {
				boolIal = false;
			},
			error: function (xhr) {
				boolIal = false;
				return Swal.showValidationMessage("Файл " + fileInfo.name + " має недопустимі розміри!");
			}
		}).done(() => {
			if (!boolIal) {
				$("#" + DivID + " .link").val(fileInfo.name);
				$("#" + DivID + " .link").attr("value", fileInfo.name);
				let image = $("#" + DivID + " .fleximage img");
				image.attr("src", "../images/" + fileInfo.name);
				Swal.resetValidationMessage();
				image.parent().toggleClass("withcontent");
				deletephoto();
			}
		})

	}

	function formatDate(datestr) {
		var date = new Date(datestr);
		date.setHours(date.getHours() - 2);
		var day = date.getDate(); day = day > 9 ? day : "0" + day;
		var month = date.getMonth() + 1; month = month > 9 ? month : "0" + month;
		var full = date.getFullYear() + "-" + month + "-" + day;
		return full;
	}
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

	function toggleLoader(id) {
		$(`#${id} .load`).toggleClass('hide');
		$(`#${id} .test_button	`).toggleClass('pointer-none');
	}
	if (window.location.href.includes("testdrive.php")) {
		$('.nav-link').eq(1).toggleClass('active');
		var dataTable = $('#data').DataTable({
			"processing": true,
			"serverSide": true,
			"language": {
				"url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
			},
			"order": [],
			"ajax": {
				url: "../app/eventsHandler.php",
				data: { action: 'getAllTests' },
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


		let exist = false;
		$('#data').on('draw.dt', function () {

			if ($('thead tr th:last-child').html() == "Дата")
				$('thead tr').append("<th>Зміна статусу</th>");

			$('tbody tr td:last-child').each((i, el) => {
				let idTest = $(el).parent().find('td:first-child').html();
				$("<td class='button' id=" + idTest + "><div class='td__button'><div  class='test_button edit test cursor'></div><img class='load hide'></div></td>").insertAfter($(el));
			});

			$('.test_button').click((el) => {
				let idTest = $(el.target).parent().parent().attr("id");
				buttonHandler(idTest);
			})

			let error = $('.error');
			let table = $('table');
			let footer = $('#data_wrapper .row:nth-child(3)');
			($('table tr:not(:first)').length > 0)
			{
				ChangeStateTable(table, error, footer, "enable");

				$("#data_processing").css("display", "none");
			}

			function buttonHandler(id) {
				Swal.fire({
					title: "Зміна статусу тест-драйву",
					icon: "question",
					text: "Підтвердити цей тест-драйв?",
					confirmButtonText: "Так",
					showCancelButton: false,
					cancelButtonText: "Вийти",
					showDenyButton: true,
					denyButtonText: "Ні",
					allowOutsideClick: false,
					didOpen: () => {
						$('.swal2-confirm').css('width','20%');
						toastCloseBtn(Swal);
					}
				}).then((result) => {
					if (result.isConfirmed) {
						$.ajax({
							url: "../app/eventsHandler.php",
							data: { action: 'edit', d_ID: id, status: "Success" },
							type: "POST",
							beforeSend: () => {
								toggleLoader(id);
							},
							success: () => {
								setTimeout(() => {
									toggleLoader(id);
									Toast.fire({ title: `Тестдрайв #${id} успішно прийнятий!`, icon: "success" });
									$('.notify').html(parseInt($('.notify').html()) - 1);
									if ($('.notify').html() == "0")
										$('.notify').hide();

									dataTable.ajax.reload();
								}, 1600);
							},
							error: function () {
								setTimeout(() => {
									Toast.fire({ title: `Тестдрайв #${id} не вдалось змінити!`, icon: "error" });
								}, 1600);
							}
						})
					}
					else if (result.isDenied) {
						$.ajax({
							url: "../app/eventsHandler.php",
							data: { action: 'edit', d_ID: id, status: "Denied" },
							type: "POST",
							beforeSend: () => {
								toggleLoader(id);
							},
							success: () => {
								setTimeout(() => {
									toggleLoader(id);
									Toast.fire({ title: `Тестдрайв #${id} відмовлено!`, icon: "success" });
									$('.notify').html(parseInt($('.notify').html()) - 1);
									if ($('.notify').html() == "0")
										$('.notify').hide();

									dataTable.ajax.reload();
								}, 1600);

							},
							error: function () {
								setTimeout(() => {
									Toast.fire({ title: `Тестдрайв #${id} не вдалось змінити!`, icon: "error" });
								}, 1600);
							}
						})
					}
				})

			}
		});
	}
	else if (window.location.href.includes("showncars.php")) {
		$('.nav-link').eq(2).toggleClass('active');
		var dataTable = $('#data').DataTable({
			"processing": true,
			"serverSide": true,
			"language": {
				"url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
			},
			"order": [],
			"ajax": {
				url: "../app/eventsHandler.php",
				data: { action: 'getVisible' },
				type: "POST",
				error: function () {
					let error = $('.error');
					let table = $('table');
					let footer = $('#data_wrapper .row:nth-child(3)');
					let data = $("#data_length");
					table.hide();
					error.show();
					footer.hide();
					$("#data_processing").css("display", "none");
				}
			}
		});
		let isConsist = false;
		$('#data').on('draw.dt', function () {

			$('img.auto').click((el) => {
				let isExist = $(el.target).hasClass('show-img');
				$('.show-img').removeClass('show-img');
				isExist ? $(el.target).removeClass('show-img') : $(el.target).addClass('show-img');
			})

			$('tbody tr td').each((index, element) => {
				if ($(element).html() == "Disabled")
					$(element).html("Не відображається");

				if ($(element).html() == "Enabled")
					$(element).html("Відображається");
			})

			isProccessing = false;

			let error = $('.error');
			let table = $('table');
			let footer = $('#data_wrapper .row:nth-child(3)');
			let data = $("#data_length");
			($('table tr:not(:first)').length > 0)
			{
				table.show();
				error.hide();
				footer.show();
			}
			if (!isConsist) {
				$('thead tr').append("<th>Статус</th>");
				isConsist = true;
			}

			$('.body tr td:last-child').each((i, el) => {
				let idCar = $(el).parent().find('td:first').text();
				$(el).html() == "Відображається" ? $("<td id=" + idCar + "><div class='td__button'><div class='test_button hiden cursor'></div><img class='load hide'></div></td>").insertAfter($(el)) : $("<td id=" + idCar + "><div class='td__button'><div class='test_button cursor show'></div><img class='load hide'></div></td>").insertAfter($(el));
			})

			$('.test_button').click((el) => {
				let _action = $(el.target).hasClass('show') ? "Enabled" : "Disabled";
				buttonHandler($(el.target).parent().parent().attr("id"), _action);
			})

			function buttonHandler(id, action) {
				$.ajax({
					url: "../app/eventsHandler.php",
					data: { action: "edit", visible: action, ID: id },
					beforeSend: () => {
						toggleLoader(id);
					},
					type: "POST",
					error: function () {
						Toast.fire({
							title: "Щось пішло не так!",
							icon: "error"
						})
						setTimeout(() => {
							toggleLoader(id);
						}, 1600);
					},
					success: () => {
						setTimeout(() => {
							toggleLoader(id);
							_btn = $(`td#${id} .test_button`);
							_btn.toggleClass("show hiden");

							let tr = _btn.parent().parent().parent().find('td').eq(-2);
							tr.html() == "Відображається" ? tr.html("Не відображається") : tr.html("Відображається");
						}, 1600);


					}
				})
			}
		});

		$('#shownall').click(function (e) {
			$.ajax({
				type: 'POST',
				url: '../app/eventsHandler.php',
				data: { 'visible': "Enabled", 'action': 'edit' },
				success: function (xhr) {
					$('#data').DataTable().ajax.reload();
				}
			})
		});

		$('#hideall').click(function (e) {
			$.ajax({
				type: 'POST',
				url: '../app/eventsHandler.php',
				data: { 'visible': "Disabled", 'action': 'edit' },
				success: function (xhr) {
					$('#data').DataTable().ajax.reload();
				}
			})
		});
	}
	else if (window.location.href.includes("users.php")) {
		$('.dropdown .dropdown-item').eq(0).toggleClass('active');
		function checkAdminRole() {
			$.ajax({
				type: 'POST',
				url: '../../app/eventsHandler.php',
				data: {
					'adminRole': "check"
				},
				error: function (xhr) {
					$('button#1').attr('disabled', 'disabled');
				}
			})
		}

		checkAdminRole();

		let dataTable, dataTable2;

		const first = {
			"processing": true,
			"serverSide": true,
			"bDestroy": true,
			"order": [],
			"language": {
				"url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
			},
			"ajax": {
				url: "../app/eventsHandler.php",
				data: { action: 'getUsers' },
				type: "POST",
				error: function () {
					let error = $('.error');
					let table = $('table');
					let footer = $('#data_wrapper .row:nth-child(3)');

					ChangeStateTable(table, error, footer, "disable");

					$("#data_processing").css("display", "none");
				}
			}
		};

		const third = {
			"processing": true,
			"serverSide": true,
			"bDestroy": true,
			"language": {
				"url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
			},
			"order": [],
			"ajax": {
				url: "../app/eventsHandler.php",
				data: { action: 'getBlockedUsers' },
				type: "POST",
				error: function () {
					let error = $('.error');
					let table = $('table');
					let footer = $('#data_wrapper .row:nth-child(3)');

					ChangeStateTable(table, error, footer, "disable");

					$("#data_processing").css("display", "none");
				}
			}
		};

		const second = {
			"processing": true,
			"serverSide": true,
			"processing": false,
			"bDestroy": true,
			"language": {
				"url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
			},
			"order": [],
			"ajax": {
				url: "../app/eventsHandler.php",
				data: { action: 'getModers' },
				type: "POST",
				error: function () {
					let error = $('.error');
					let table = $('table');
					let footer = $('#data2_wrapper .row:nth-child(3)');

					ChangeStateTable(table, error, footer, "disable");

					$("#data_processing").css("display", "none");
				}
			}
		};

		$('.data1').hide();
		$('.data2').hide();

		$('.switch_test button').click((el) => {

			let pressedBtn = $(el.target);

			if (pressedBtn.attr("id") == $("button.active").attr("id")) {
				return;
			}
			else {
				$('button.active').toggleClass('active');

				$(el.target).toggleClass('active');

				let id = $(el.target).attr('id');

				changeData(id);
			}
		});
		let isEx = true;
		changeData($('button.active').attr('id'));

		function changeData(id) {

			if (id == "0") {
				$('.data1').show();
				$('.data2').hide();
				dataTable = $('#data').DataTable(first);
			}
			else if (id == "1") {
				$('.data1').hide();
				$('.data2').show();
				dataTable2.destroy();
				dataTable2 = $('#data2').DataTable(second);
				isEx = false;
			}
			else if (id == "2") {
				$('.data1').show();
				$('.data2').hide();

				dataTable.clear();

				dataTable = $('#data').DataTable(third);
			}

			(isEx == true) ? dataTable2 = $('#data2').DataTable(second) : "";
		}

		dataTable.on('draw', function () {


			$('tbody tr td').each((index, element) => {
				if ($(element).html() == "Male")
					$(element).html("Чоловіча");

				if ($(element).html() == "Female")
					$(element).html("Жіноча");
			})

			$('.data1 thead th:last-child').removeClass('sorting').unbind("click");

			if ($('button.active').attr('id') == "2") {
				if ($('.data1 tbody tr td:last-child').hasClass('block'))
					$('.data1 tbody tr td:last-child').remove();
			}

			let error = $('.error');
			let table = $('table');
			let footer = $('#data_wrapper .row:nth-child(3)');

			if ($('.data1 tr:not(:first)').length > 0) {
				ChangeStateTable(table, error, footer, "enable");

				if ($('.data1 thead th:last-child').html() != "Заблокувати")
					$('.data1 thead th:last-child').html("Заблокувати");

				if ($('button.active').attr('id') == "0") {

					$('.block').click((el) => {
						let elem = $(el.target).parent().attr("id");
						buttonHandler(elem);
					})

					function buttonHandler(idUser) {
						Swal.fire({
							title: "Заблокувати користувача",
							confirmButtonText: 'Заблокувати',
							showCancelButton: false,
							input: 'text',
							inputPlaceholder: 'Уведіть причину блокування',
							cancelButtonText: "Закрити",
							allowOutsideClick: false,
							didOpen: () => {
								$('.swal2-confirm').css('width', '75%');
								toastCloseBtn(Swal);
							},
							inputValidator: (value) => {
								return new Promise((resolve) => {
									if (!value) {
										resolve('Уведіть причину блокування!');
									}
									else if (value.length < 10) {
										resolve('Будь-ласка опишіть детальніше!');
									}
									else { resolve(); }
								})
							}
						}).then(function (result) {
							if (result.isConfirmed) {
								let desc = result.value;
								Swal.fire({
									icon: "question",
									title: 'Ви впевнені?',
									confirmButtonText: 'Так',
									focusConfirm: false,
									showCancelButton: false,
									showDenyButton: true,
									denyButtonText: "Назад"
								}).then(function (result) {
									if (result.isConfirmed) {
										toggleLoader(idUser);
										$.ajax({
											type: 'POST',
											url: '../../app/eventsHandler.php',
											data: {
												'blockUser': "block",
												'uid': idUser,
												'desc': desc
											},
											success: function (xhr) {
												setTimeout(() => {
													toggleLoader(idUser);
													Toast.fire({
														title: "Користувача #" + idUser + " було заблоковано! Причина: " + desc + "",
														icon: "success",
														position: "top"
													});
													dataTable.ajax.reload();
												}, 1600);
											},
											error: function () {
												setTimeout(() => {
													toggleLoader(idUser);
													Toast.fire({
														title: "Користувача невдалось заблокувати",
														icon: "error",
														position: "top"
													});
												}, 1600);
											}
										})
									}
									else if (result.isDenied) {
										buttonHandler(idUser);
									}
								})
							}
						})
					}
				}
				else {
					if ($('.data1 thead th:last-child').html() == "Заблокувати")
						$('.data1 thead th:last-child').html("Причина");
				}
			}
		})

		dataTable2.on('draw', function () {

			$('.data2 thead th:last-child').removeClass('sorting').unbind('click');

			if ($('.data2 tbody tr td:last-child').hasClass('block'))
				$('.data2 tbody tr td:last-child').remove();

			let error = $('.error:nth-child(2)');
			let table = $('.data2');
			let footer = $('#data_wrapper:nth-child(2) .row:nth-child(3)');

			if ($('table:nth-child(2) tr:not(:first)').length > 0) {
				ChangeStateTable(table, error, footer, "enable");
			}

			$('.delete').click((el) => {
				let idModer = $(el.target).parent().attr("id");
				buttonHandler(idModer);
			})

			function buttonHandler(id) {
				Swal.fire({
					title: "Видалення модератора",
					icon: "question",
					text: "Підтвердити видалення?",
					confirmButtonText: "Так",
					showCancelButton: false,
					cancelButtonText: "Ні",
					allowOutsideClick: false,
					didOpen: () => {
						$('.swal2-confirm').css('width','75%');
						toastCloseBtn(Swal);
					}
				}).then((result) => {
					if (result.isConfirmed) {
						$.ajax({
							type: 'POST',
							url: '../app/eventsHandler.php',
							data: {
								'action': "deleteAdm",
								'unique': id
							},
							beforeSend: () => {
								toggleLoader(id);
							},
							success: () => {
								setTimeout(() => {
									toggleLoader(id);
									Toast.fire({
										title: "Модератора #" + id + " було видалено!",
										icon: "success",
										position: "top"
									});
									dataTable2.ajax.reload();
								}, 1600);
							},
							error: function () {
								setTimeout(() => {
									toggleLoader(id);
									Toast.fire({ title: `Модератора #${id} не вдалось видалити!`, icon: "error" });
								}, 1600);
							}
						})
					}
				})

			}
		});

	} else if (window.location.href.includes("testdrives.php")) {
		$('.dropdown .dropdown-item').eq(1).toggleClass('active');
		$('.switch_test button').click((el) => {

			let pressedBtn = $(el.target);

			if (pressedBtn.attr("id") == $("button.active").attr("id")) {
				return;
			}
			else {
				$('button.active').toggleClass('active');
				pressedBtn.toggleClass('active');

				let _length = $('tbody tr:first td').length;
				if (_length > 10) {
					let el = $('.body tr td:last');
					el.remove();
				}

				changeData($('button.active').attr("id"));
			}
		})

		let dataTable;

		const first = {
			"processing": true,
			"bDestroy": true,
			"serverSide": true,
			"searching": true,
			"language": {
				"url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
			},
			"order": [],
			"ajax": {
				url: "../app/eventsHandler.php",
				data: { action: 'getAllTests3' },
				type: "POST",
				error: function () {
					let error = $('.error');
					let table = $('table');
					let footer = $('#data_wrapper .row:nth-child(3)');

					ChangeStateTable(table, error, footer, "disable");

					$("#data_processing").css("display", "none");
				}
			}
		};

		const second = {
			"processing": true,
			"serverSide": true,
			"bDestroy": true,
			"searching": true,
			"language": {
				"url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
			},
			"order": [],
			"ajax": {
				url: "../app/eventsHandler.php",
				data: { action: 'getAllTests4' },
				type: "POST",
				error: function () {

					let error = $('.error');
					let table = $('table');
					let footer = $('#data_wrapper .row:nth-child(3)');

					ChangeStateTable(table, error, footer, "disable");

					$("#data_processing").css("display", "none");
				}
			}
		};

		const third = {
			"processing": true,
			"serverSide": true,
			"bDestroy": true,
			"searching": true,
			"language": {
				"url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
			},
			"order": [],
			"ajax": {
				url: "../app/eventsHandler.php",
				data: { action: 'getAllTests2' },
				type: "POST",
				error: function () {
					let error = $('.error');
					let table = $('table');
					let footer = $('#data_wrapper .row:nth-child(3)');

					ChangeStateTable(table, error, footer, "disable");

					$("#data_processing").css("display", "none");
				}
			}
		};

		function changeData(id) {
			if (id == 0) {
				dataTable.clear();
				dataTable = $('#data').DataTable(third);
			}
			else if (id == 1) {
				dataTable.clear();
				dataTable = $('#data').DataTable(second);
			}
			else if (id == 2) {
				dataTable.clear();
				dataTable = $('#data').DataTable(first);
			}

		}

		dataTable = $('#data').DataTable(first);

		dataTable.on('draw', function () {

			if ($('button.active').attr("id") != "2") {
				$('tbody tr td').each((index, elem) => {
					($(elem).children().length > 0) ? $(elem).remove() : "";
				})
			}

			$('tbody tr td').each((index, element) => {
				if ($(element).html() == "Denied")
					$(element).html("Відмова");

				if ($(element).html() == "Success")
					$(element).html("Прийнято");

				if ($(element).html() == "Yes")
					$(element).html("Так");

				if ($(element).html() == "No")
					$(element).html("Ні");
			})


			if ($('button.active').attr("id") == "2")
				$('thead tr th').each((index, element) => {
					if ($(element).html() == "Прибув?") $(element).removeClass('sorting').unbind("click")
				});

			let error = $('.error');
			let table = $('table');
			let footer = $('#data_wrapper .row:nth-child(3)');
			($('table tr:not(:first)').length > 0)
			{
				ChangeStateTable(table, error, footer, "enable");
			}

			if ($('button.active').attr("id") == 2) {

				if ($('thead tr th:last-child').html() != "Дата")
					$('thead tr').append("<th>Дата</th>");

				$('.body tr td:last-child').each((i, el) => {
					let idCar = $(el).parent().find('td:first').html();
					$(el).html("<div class='td__button'><div  class='test_button edit arrived cursor'></div><img class='load hide'></div>");
					$(el).attr("id", idCar);
					$(el).addClass("button");
					$(el).parent().append("<td class='button' id=" + (i + 0) + "><div class='td__button'><div  class='test_button edit date cursor'></div><img class='load hide'></div></td>");
				})


				$('.arrived').click((el) => {
					let elem = $(el.target).parent().parent().parent().find('td').eq(-5);
					buttonHandler($(el.target).parent().parent().parent().find('td:first').html(), elem.html(), "1");
				})

				$('.date').click((el) => {
					let elem = $(el.target).parent().parent().parent().find('td').eq(-4);
					buttonHandler($(el.target).parent().parent().parent().find('td:first').html(), elem.html(), "2");
				})

				function buttonHandler(id, data, event) {

					
					let _action;
					let dateNow = new Date(Date.now());
					let dateCurrent = new Date(data.split("-").reverse().join("-"));
					if (event == "1") {
						if (dateNow >= dateCurrent) {
							Swal.fire({
								icon: "question",
								title: 'Клієнт приїхав?',
								confirmButtonText: 'Так',
								focusConfirm: false,
								showCancelButton: false,
								cancelButtonText: "Закрити",
								allowOutsideClick: false,
								denyButtonText: "Ні",
								denyButtonColor: "#757575",
								cancelButtonColor: "#d14529",
								showDenyButton: true,
								didOpen: () => {
									$('.swal2-confirm').css('width','20%');
									toastCloseBtn(Swal);
								}
							}).then((result) => {
								if (result.isDenied) {
									_action = "No";
									let data = { action: "edit", isarrived: _action, ID: id };
									ajaxReq(data, id);
								}
								else if (result.isConfirmed) {
									_action = "Yes";
									let data = { action: "edit", isarrived: _action, ID: id };
									ajaxReq(data, id);
								}
								else _action = "Cancel";
							});
						}
						else {
							Toast.fire({
								title: "Дата клієнта ще не пройшла!",
								icon: "error",
								position: "center"
							})
						}
					}
					else if (event == "2") {
						let carID = $(`td#${id}`).parent().find('td:nth-child(5)').html();
						let userID = $(`td#${id}`).parent().find('td:nth-child(2)').html();
						let valueDate;
						Swal.fire({
							title: "Зміна дати тестдрайву",
							allowOutsideClick: false,
							input: "text",
							inputValidator: (value) => {
								if (!value)
									return 'Вам потрібно обрати дату!';
								if (new Date(value) < dateCurrent)
									return 'Дата повина бути більшою за попередню!';
								else
									valueDate = value;
							},
							inputPlaceholder: "Виберіть дату",
							inputAttributes: {
								"readonly": true
							},
							showCancelButton: false,
							cancelButtonText: "Закрити",
							confirmButtonText: "Змінити",
							didOpen: () => {

								Swal.showLoading();
								let title = $(Swal.getHeader()).find('.swal2-title');
								title.html('Загрузка');
								$('.swal2-confirm').css('display', 'none');
								$('.swal2-input').css('display', 'none');
								$.ajax({
									type: 'POST',
									url: '../app/eventsHandler.php',
									data: {
										'action': "getBlockB",
										'car_ID': carID,
										'userID': userID
									}, success: function (xhr) {
										setTimeout(changeStation, 2000);
										function changeStation() {
											Swal.hideLoading();
											toastCloseBtn(Swal);
											let title = $(Swal.getHeader()).find('.swal2-title');
											title.html('Зміна дати тестдрайву');
											$('.swal2-input').css('display', 'block');
											$('.swal2-confirm').css('display', 'block');
											$('.swal2-input').prop('disabled', false);
										}

										if (xhr.dates != undefined) {
											xhr.dates.forEach(element => {
												blockDates.push(element.split(':')[0]);
											});
											block = xhr.block;
											if (block == true)
												blockText = xhr.error;
										}
									}
								});


								$('.swal2-input').datetimepicker({
									daysOfWeekDisabled: [6],
									startDate: new Date(),
									minView: 1,
									format: "yyyy-mm-dd hh:00",
									language: "ua",
									hoursDisabled: [0, 1, 2, 3, 4, 5, 6, 7, 8, 20, 21, 22, 23],
									clearBtn: true,

									onHide: () => {
										$('swal2-input').blur();
									},
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
								$('.swal2-input').change(() => {
									$('.swal2-input').datetimepicker('hide');
								});
							}
						}).then((result) => {
							if (result.isConfirmed) {
								data = { action: "edit", date: valueDate, id: id }
								ajaxReq(data, toggleLoader($(`td#${id}`).parent().find('td:last-child').attr("id")));
							}
						})
					}
					function ajaxReq(data, ID) {
						$.ajax({
							url: "../app/eventsHandler.php",
							data: data,
							beforeSend: () => {
								toggleLoader(ID);
							},
							type: "POST",
							error: function () {
								Toast.fire({
									title: "Что-то пошло не так!",
									icon: "error"
								})
								toggleLoader(ID);
							},
							success: () => {
								setTimeout(() => {
									toggleLoader(ID);
									$('#data').DataTable().ajax.reload();
								}, 1600);


							}
						})
					}
				}
			}
		});

	} else if (window.location.href.includes("cars.php")) {
		$('.dropdown .dropdown-item').eq(2).toggleClass('active');
		var dataTable = $('#data').DataTable({
			"processing": true,
			"serverSide": true,
			"language": {
				"url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
			},
			"order": [],
			"ajax": {
				url: "../app/eventsHandler.php",
				data: { action: 'getAuto' },
				type: "POST",
				error: function () {

					let error = $('.error');
					let table = $('table');
					let footer = $('#data_wrapper .row:nth-child(3)');

					ChangeStateTable(table, error, footer, "disable");

					$("#data_processing").css("display", "none");
				}
			}
		});

		dataTable.on('draw', function () {
			$('img.auto').click((el) => {
				let isExist = $(el.target).hasClass('show-img');
				$('.show-img').removeClass('show-img');
				isExist ? $(el.target).removeClass('show-img') : $(el.target).addClass('show-img');
			})

			$('.price').click((el) => {
				let idCar = $(el.target).parent().parent().parent().find('td:first-child').html();
				let oldPrice = $(el.target).parent().parent().parent().find('td').eq(-3).html();

				buttonHandler(idCar, oldPrice, 0);
			})

			$('.photo').click((el) => {
				let idCar = $(el.target).parent().parent().parent().find('td:first-child').html();

				buttonHandler(idCar, 0, 2);
			})


			function buttonHandler(id, old, action) {
				function ajaxRequest(data) {
					$.ajax({
						url: "../app/eventsHandler.php",
						data: data,
						beforeSend: () => {
							toggleLoader(id);
						},
						type: "POST",
						error: function () {
							setTimeout(() => {
								toggleLoader(id);
								Toast.fire({
									title: "Щось пішло не так!",
									position: "center",
									icon: "error"
								})
							}, 1600);
						},
						success: () => {
							setTimeout(() => {
								toggleLoader(id);
								Toast.fire({
									title: "Успішно змінено!",
									position: "center",
									icon: "success"
								});
								dataTable.ajax.reload();
							}, 1600);


						}
					})
				}

				if (action == 0) {
					Swal.fire({
						title: `Зміна ціни для авто №${id}`,
						input: 'text',
						inputPlaceholder: "Уведіть ціну",
						inputAttributes:{
							maxlength: 7,
						},
						inputValidator: (value) => {
							if (value == old)
								return 'Уведіть нову ціну!';
							else if (!value)
								return 'Поле не може бути порожнім!'
							else if (parseInt(value) == isNaN)
								return 'Формат не вірний!';
						}
						,
						confirmButtonText: "Змінити",
						showCancelButton: false,
						allowOutsideClick: false,
						cancelButtonText: "Вийти",
						didOpen: () => {
							$('.swal2-input').keypress((e)=>{
								if ((e.which != 46 || $(this).val().indexOf('.') != -1) && (e.which < 48 || e.which > 57)) {
									e.preventDefault();
								}
							})
							$('.swal2-confirm').css('width', "75%");
							toastCloseBtn(Swal);
						}
					}).then((result) => {
						if (result.isConfirmed) {
							ajaxRequest({ action: "edit", price: result.value, ID: id });
						}
					})
				}
				else if (action == 2) {
					$.ajax({
						type: 'POST',
						url: '../../app/eventsHandler.php',
						data: {
							'getPhotosList': "get",
							'carID': id
						},
						success: function (xhr) {
							let arrayOfLinks;

							let newList, oldLinks;

							count = JSON.parse(xhr[0]).count;
							arrayOfLinks = JSON.parse(xhr[0]).links;
							let lVal = Object.values(arrayOfLinks);
							let lKeys = Object.keys(arrayOfLinks);

							let htmlCode = "<div class=multiple-inputs-div>";
							htmlCode += "<div class='main-inputs'><div class='row d-flex'><div class='col-6'>"
							for (let i = 0; i < 9; i++) {
								let data = lVal[i] == undefined ? "notimage.png" : lVal[i];
								let id = lKeys[i] == undefined ? "a" + i + "" : lKeys[i].replace("'", "").replace("'", "");

								data = (data == "notimage.png") ? data : fileExists("../images/" + data) == true ? data : "notimage.png";

								i == 0 ? firstID = id : "";
								if (i == 5)
									htmlCode += "</div><div class='col-6 mt-4'>";

								i == 0 ? htmlCode += '<div class="flex" id="' + id + '"><div><b>Головне зображення:</b><input type="text" class="link swal2-input" placeholder="Зображення" value ="' + ((data == "notimage.png") ? "" : data) + '" readonly=true maxlength = 300></input> <input type="file" class="fileInput"></input></div><div class="fleximage "><img height="65px"  width="115px" src=../images/' + data + '></div></div>' : htmlCode += '<div class="flex" id="' + id + '"><div><input type="text" class="link swal2-input" placeholder="Зображення" value ="' + ((data == "notimage.png") ? "" : data) + '" readonly=true maxlength = 300></input> <input type="file" class="fileInput"></input></div><div class="fleximage ' + ((data == "notimage.png") ? "" : "withcontent") + '"><img height="65px" width="115px" src=../images/' + data + '></div></div>';
							}

							htmlCode += "</div></div></div>";
							showSwalInputs();
							function showSwalInputs() {
								Swal.fire({
									title: "Редагування зображень для авто #" + id,
									html: htmlCode,
									allowOutsideClick: false,
									showCancelButton: false,
									showDenyButton: true,
									denyButtonText: "Назад",
									denyButtonColor: "gray",
									cancelButtonColor: "#E94D6A",
									cancelButtonText: "Закрити",
									confirmButtonText: "Оновити",
									didOpen: () => {
										toastCloseBtn(Swal);
										var tem = Swal.getContainer();
										$(tem).children().css('width', '85%');

										$('.fileInput').change(function (obj) {
											fileHandler(obj.target, Swal, $(this).parent().parent().attr("id"));
										})

										deletephoto();
									},
									preConfirm: () => {
										let countToEdit = 0;
										var myMapOlds = new Map();
										var myMapNew = new Map();
										$('.link').each(function (index) {
											let itemID = $(this).parent().parent().attr("id");
											let itemValue = $(this).val();

											if (itemID.includes('a')) {
												if (itemValue != "") {
													myMapNew.set(index, itemValue);
													countToEdit++;
												}
											}
											else {
												myMapOlds.set(itemID, itemValue);
												countToEdit++;
											}
										})

										newList = Object.fromEntries(myMapNew);
										oldLinks = Object.fromEntries(myMapOlds);
										if (JSON.stringify(newList) === JSON.stringify({})) {
											if (JSON.stringify(arrayOfLinks) === JSON.stringify(oldLinks)) {
												Swal.showValidationMessage("Потрібно змінити або додати хоча-б 1 елемент");
												return;
											}
										}

										$.ajax({
											type: 'POST',
											url: '../app/eventsHandler.php',
											data: {
												'updatePhotos': "upd",
												'linksNew': newList,
												'linksOld': oldLinks,
												'carID': id,
												'countToEdit': countToEdit
											},
											success: function (xhr) {
												Toast.fire({
													title: "Данні змінено!",
													icon: "success",
													timer: 4000,
													position: "top"
												});
											},
											error: function () {
												Swal.fire({
													icon: "error",
													title: 'На жаль, щось пішло не за планом. Спробувати ще раз?',
													confirmButtonText: 'Так',
													focusConfirm: false,
													showCancelButton: true,
													cancelButtonText: "Ні",
													allowOutsideClick: false
												}).then(function (result) {
													if (result.isConfirmed) {
														showSwalInputs();
													}
												})
											}
										})
									}
								})
							}
						}
					})

				}
			}

			let error = $('.error');
			let table = $('table');
			let footer = $('#data_wrapper .row:nth-child(3)');

			ChangeStateTable(table, error, footer, "enable");

			$("#data_processing").css("display", "none");

		});
	}
	else if (window.location.href.includes("panel.php")) {
		$('.nav-link').eq(0).toggleClass('active');
		$(document).ready(function () {
			let fileName = "";
			function checkAdminRole() {
				$.ajax({
					type: 'POST',
					url: '../../app/eventsHandler.php',
					data: {
						'adminRole': "check"
					},
					error: function (xhr) {
						$('.addNewAdmin').removeClass('panel-primary').addClass('panel-disabled');
						$('.removeAdmin').removeClass('panel-primary').addClass('panel-disabled');
					}
				})
			}
			checkAdminRole();

			let uniqtext, logintext, passtext;
			let firstID;
			//actionAddNewModerator
			$(".expmod").click(function () {
				let isExist = false;
				function swaladd(str) {
					Swal.fire({
						icon: "question",
						title: 'Реєстрація',
						html: `<input type="text" id="unique" class="swal2-input" placeholder="Унікальний номер" maxlength = 6>`,
						confirmButtonText: 'Зареєструвати нового модера',
						focusConfirm: false,
						showCancelButton: false,
						cancelButtonText: "Закрити",
						preConfirm: () => {
							const unique = Swal.getPopup().querySelector('#unique').value
							if (!unique) {
								Swal.showValidationMessage(`Будь-ласка уведіть унікальний номер юзера`)
							}
							else
								if (unique.length != 6) {
									Swal.showValidationMessage(`Унікальний номер повинен бути з 6 цифр`)
								}
								else
									if (unique) {
										return new Promise(function (resolve) {
											$.ajax({
												type: 'POST',
												url: '../../app/eventsHandler.php',
												data: {
													'action': "updateU",
													'unique': unique
												},
												success: function (xhr) {
													uniqtext = xhr.uniq; logintext = xhr.login; passtext = xhr.pass;
													Toast.fire({
														title: "Користувача зареєстровано!",
														icon: "success",
														timer: 2000,
														position: "top",
														didClose: () => {
															Swal.fire({
																icon: "info",
																title: 'Дані користувача',
																html: "<div class='usermain'><div class='userinfo'><label>Ун.номер: <input id='uniq' readonly=true value =" + uniqtext + "></input></label><label>Логін: <input id='login' readonly=true value =" + logintext + "></input></label><label>Пароль: <input id='pass' readonly=true value =" + passtext + "></input></label></div><div data-tooltip='Скопіювати' class='copy'></div></div>",
																confirmButtonText: 'Закрити',
																allowOutsideClick: false,
																customClass: {
																	validationMessage: 'swal2-confirm-message'
																},
																didOpen: () => {
																	$('.copy').click(function () {
																		let text = "";
																		text += uniqtext + ":";
																		text += logintext + ":";
																		text += passtext + ";";
																		copyUserData(text, Swal);
																	})
																}
															});
														}
													});

												},
												error: function (xhr) {
													Swal.fire({
														icon: "error",
														title: 'Помилка',
														text: 'Такий унікальний номер вже зареєcтровано! Бажаєте спробувати ще раз?',
														showCancelButton: true,
														confirmButtonText: 'Так',
														cancelButtonText: 'Ні',
														allowOutsideClick: false
													}).then((result) => { if (result.isConfirmed) { swaladd(isExist); } })
												}
											})
										})
									}
							return { unique: unique }
						},
						didOpen: () => {
							toastCloseBtn(Swal);
						},
						allowOutsideClick: false
					}).then((result) => {
						if (result.isConfirmed) {

						}
					})

				}
				swaladd(isExist);
			})

			//actionNewTestDrive
			$('.newtestdrive').click(function () {
				var numbers;
				$.ajax({
					type: 'POST',
					url: '../../app/eventsHandler.php',
					data: {
						'listOfUsers': "get"
					},
					success: function (xhr) {
						let temp = JSON.parse(xhr.data);
						numbers = temp.ids;
						swaladd();
					},
					error: function () {
						Swal.fire(
							"Дивно",
							"Жодного користувача не знайдено в базі!",
							"error"
						);
					}
				})

				function swaladd(str) {

					let htmlCode = "<div class='flex'><div class='newUser'><h3>Зареєструвати нового</h3><input placeholder='Ім`я' class='name swal2-input custom'><input placeholder='Прізвище' class='fname swal2-input custom'><input placeholder='Номер телефону' type='tel' value='+380 ' maxlength=16 class='phone swal2-input custom'></div><div class='selectUser'><h3>Вибрати існуючого</h3><select class='swal2-select custom'><option id='phone' value='' disabled selected>Виберіть користувача</option><optgroup label='Користувачі'>";
					Object.entries(numbers).forEach(([key, value]) => {
						htmlCode += "<option value = " + key + ">" + value + "</option>"
					})
					htmlCode += "</optgroup></select></div></div>";

					Swal.fire({
						title: 'Виберіть користувача',
						html: htmlCode,
						confirmButtonText: 'Обрати',
						focusConfirm: false,
						showCancelButton: false,
						cancelButtonText: "Закрити",
						allowOutsideClick: false,
						didOpen: () => {
							$('.swal2-confirm').css('width', "75%");
							toastCloseBtn(Swal);
							var tem = Swal.getContainer();
							$(tem).children().css('width', '60em');
							changeInput([$('.name'), $('.fname'), $('.phone')]);
							phone($('.phone'));
							names([$('.name'), $('.fname')]);

						},
						preConfirm: () => {
							const content = Swal.getContent();
							const select = $(content).find($('select.custom')).eq(0);
							const inputs = $(content).find($('input.custom'));
							let isRegistred = true;
							let val = select.val();
							let needRegister = true;
							if (select.val() == null) {
								let failed = 0; let failedPhone = false;

								$(inputs).each(function (index) {
									if ($(this).val() == "") {
										isRegistred = false;
										return false;
									} else
										if ($(this).val().length < 2 && index != 2) {
											isRegistred = false;
											failed++;
											return false;
										} else
											if (index == 2 && $(this).val().length != 13) {
												isRegistred = false;
												failedPhone = true;
												return false;
											}
								})
								if (!isRegistred && failed == 0 && !failedPhone) {
									Swal.showValidationMessage('Ви повинні або обрати, або зареєструвати користувача!');
								}
								else if (failed > 0) {
									Swal.showValidationMessage('Уведіть коректні данні!');
								}
								else if (!isRegistred && failed == 0 && failedPhone) {
									Swal.showValidationMessage('Телефон складається з 13 цифр!');
								}
							}
							else
								needRegister = false;
							if (isRegistred) {

								let userData = [$(inputs).eq(0).val(), $(inputs).eq(1).val(), $(inputs).eq(2).val()];

								//inputs
								let timer;
								let userID = select.val();
								if (!needRegister)
									newTestDrive();
								else
									regnew();

								function newTestDrive() {
									let carslist;

									$.ajax({
										type: 'POST',
										url: '../app/eventsHandler.php',
										data: {
											'getCarsList': "get"
										}, success: function (xhr) {
											carslist = JSON.parse(xhr[0]).IDs;
											continueFunc();
										},
										error: function () {
											Swal.fire(
												"Помилка",
												"Жодного авто не знайдено в базі!",
												"error"
											);
										}

									});

									function continueFunc() {
										let htmlCode = "<div class='main'><select style='width:100%' class='swal2-select car'><option value='' selected disabled>Виберіть авто</option><optgroup label='Авто'>";
										Object.entries(carslist).forEach(([key, value]) => {
											htmlCode += "<option value = " + key + ">" + value + "</option>";
										})
										htmlCode += "</optgroup></select><input class='swal2-input data' placeholder = 'Виберіть дату' readonly disabled></div>";
										Swal.fire({
											title: "Реєєстрація тест-драйва",
											allowOutsideClick: false,
											html: htmlCode,
											showCancelButton: false,
											showDenyButton: true,
											denyButtonText: "Назад",
											denyButtonColor: "gray",
											cancelButtonColor: "#E94D6A",
											confirmButtonText: "Замовити",
											didOpen: () => {
												toastCloseBtn(Swal);
												let carID;
												let data;
												$('.car').change((e) => {
													if ($('.car').val() != "") {
														carID = $('.car').val();
														$('.main').css('display', 'none');
														Swal.resetValidationMessage();
														deleteCloseBtn(Swal);
														Swal.showLoading();
														let title = $(Swal.getHeader()).find('.swal2-title');
														title.html('Загрузка');
														$('.swal2-actions button').each((index, value) => {
															$(value).css('display', 'none')
														});
														$.ajax({
															type: 'POST',
															url: '../app/eventsHandler.php',
															data: {
																'action': "getBlockA",
																'car_ID': carID,
																'userID': userID
															}, success: function (xhr) {
																setTimeout(changeStation, 2000)
																function changeStation() {
																	Swal.hideLoading();
																	toastCloseBtn(Swal);
																	$('.main').css('display', 'block');
																	let title = $(Swal.getHeader()).find('.swal2-title');
																	title.html('Реєєстрація тест-драйва');
																	$('.swal2-actions button').each((index, value) => { $(value).css('display', 'flex') });
																	$('.data').prop('disabled', false);
																	$('.data').css('border', '2px solid red');
																}

																if (xhr.dates != undefined) {
																	xhr.dates.forEach(element => {
																		blockDates.push(element.split(':')[0]);
																	});
																	block = xhr.block;
																	if (block == true)
																		blockText = xhr.error;
																}
															}, error: (xhr) => {
																setTimeout(changeStation, 2000);
																function changeStation() {
																	$('.main').css('display', 'block');
																	let title = $(Swal.getHeader()).find('.swal2-title');
																	title.html('Реєєстрація тест-драйва');
																	$('.car').val('');
																	$('.swal2-actions button').each((index, value) => { $(value).css('display', 'flex') });
																	Swal.showValidationMessage(JSON.parse(xhr.responseText).error);
																	Swal.hideLoading();
																	toastCloseBtn(Swal);
																	$('.data').prop('disabled', true);
																	$('.data').css('border', '1px solid #d9d9d9');
																}
															}
														});

														$('.data').datetimepicker({
															daysOfWeekDisabled: [6],
															startDate: new Date(),
															minView: 1,
															format: "yyyy-mm-dd hh:00",
															language: "ua",
															hoursDisabled: [0, 1, 2, 3, 4, 5, 6, 7, 8, 20, 21, 22, 23],
															clearBtn: true,
															onHide: () => {
																$('swal2-input').blur();
															},

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
														$('.swal2-input').change(() => {
															$('.swal2-input').datetimepicker('hide');
														});
													}
												})
											},
											preConfirm: (value) => {
												data = $('.data').val();
												carID = $('.car').val();
												if (carID == null)
													Swal.showValidationMessage('Виберіть авто!');
												else if (data == "")
													Swal.showValidationMessage('Виберіть дату!');
												return value;
											}
										}).then((result) => {
											if (result.isDenied) {
												swaladd();
											}
											else
												if (result.isConfirmed) {
													Swal.mixin({
														toast: true,
														position: "center",
														didOpen: () => {
															Swal.showLoading();
														}
													});
													$.ajax({
														type: 'POST',
														url: '../app/eventsHandler.php',
														data: {
															'car_ID': carID,
															'createnNewTest': "create",
															'date': data,
															'userID': userID
														}, success: function (xhr) {
															Swal.hideLoading();
															Toast.fire({
																title: "Тест-драйв створено!",
																icon: "success",
																timer: 2000,
																position: "center"
															});
															$('.notify').html(parseInt($('.notify').html()) + 1);
															$('.notify').show();
															$('.testdrivecounter').html(parseInt($('.testdrivecounter').html()) + 1);
															if ($('.testdrivecounter').html() == "1")
																$('.testdrivecounter').parent().append('<div class="newtest">Нові тест драйви!</div>');
														}, error: function (xhr, status, error) {
															Toast.fire({
																title: "Щось пішло не так!",
																icon: "error",
																timer: 2000,
																position: "center"
															})
														}
													});
												}
										})
									}
								}
								function regnew() {
									Swal.fire({
										title: "Реєстрація нового користувача",
										allowOutsideClick: false,
										showCancelButton: false,
										didOpen: () => {
											toastCloseBtn(Swal);
											Swal.showLoading();
											let counter = 0;
											let content = $('.swal2-title');
											timer = setInterval(() => {
												if (counter == 3) {
													$(content).text($(content).text().slice(0, -3));
													counter = 0;
												}
												$(content).text($(content).text() + '.');
												counter++;
											}, 400);

											$.ajax({
												type: 'POST',
												url: '../app/eventsHandler.php',
												data: {
													'registerNewUser': "register",
													'name': userData[0],
													'fname': userData[1],
													'phone': userData[2]
												},
												success: function (xhr) {
													userID = xhr.data;
													setTimeout(newTestDrive, 5000);
												},
												error: function (xhr) {
													let response = JSON.parse(xhr.responseText);
													if (response != "null")
														Swal.fire({
															icon: "error",
															title: "Цей юзер був заблокований!",
															html: "<div style=' margin:25px 0;'><label style='text-align:justify;'><b>Причина: <i>'" + response.data + "'</i></b></label><hr><label style='text-align:center'>Подальша робота з цим клієнтом неможлива!</label><div>"
														});
													else
														Swal.fire({
															icon: "error",
															title: "На жаль, щось пішло не так! Спробуйте ще раз!"
														});
												}
											})
										},
										willClose: () => {
											clearInterval(timer);
										}
									})
								}
							}
						}
					})
				}
			})
			function changeInput(names) {
				names.forEach((element) => {
					$(element).bind('keydown', function (e) {
						if (e.keyCode) {
							Swal.resetValidationMessage();
							$('#phone').attr('selected');
							$('select').val('');
						}
					})
					$('select').change(() => {
						names.forEach((element, index) => {
							if (index == 2)
								element.val('+380');
							else
								element.val('');

							Swal.resetValidationMessage();
						})
					});
				})
			}
			//actionwithphoneinput
			function names(elem) {
				elem.forEach((element) => {
					$(element).bind('keydown', function (e) {
						if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105)) {
							e.preventDefault();
						}
						else return;
					})
				})
			}
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

			//copy to clipboard
			function copyUserData(text, Swal) {
				const el = document.createElement('input');
				el.value = text;
				el.setAttribute('readonly', '');
				el.style.position = 'absolute';
				el.style.left = '-9999px';
				document.body.appendChild(el);
				el.select();
				document.execCommand('copy');
				document.body.removeChild(el);

				Swal.showValidationMessage("<i class='fa fa-check-circle'></i> Данні скопійовані до буферу обміну!");
				let msg = $('.swal2-validation-message');
				msg.show();
				msg.toggleClass('swal2-validation-message');

				setTimeout(() => msg.hide(), 4000);

				//Toast.fire({
				//	title:"Данні користувача #" + uniqtext + " успішно скопійовані до буферу обміну!",
				//	icon:"success"
				//});
			}
			//func addcar
			$('.addcar').click(async () => {

				let htmlCode = '<div class="main">'
					+ '<div style="text-align:justify; margin:25px 0" class="attention"><p><font color="red">*</font> - обов`язкові для заповнення</p></div>'
					+ '<div class="marka">'
					+ '<div class="required"><select class="swal2-select "><option value="" disabled selected>Виберіть марку авто</option><optgroup label="Марки"></optgroup></select></div></div>'
					+ '<div class="aboutcar hide"><div class="required"><select  class="swal2-select "><option value="" disabled selected>Виберіть модель авто</option><optgroup label="Моделі"></optgroup></select></div>'
					+ '<div class="required"><select  class="swal2-select"><option value="" disabled selected>Виберіть колір авто</option>><optgroup label="Кольори"><option value="Белый">Білий</option><option value="Черный">Чорний</option><option value="Синий">Синій</option><option value="Красный">Червоний</option><option value="Желтый">Жовтий</option><option value="Зеленый">Зелений</option></optgroup></select></div>'
					+ '<div class="required"><select  class="swal2-select"><option value="" disabled selected>Виберіть рік авто</option><optgroup label="Роки">';


				for (let i = 0; i < 21; i++) {
					let value = 2021 - i;
					htmlCode += '<option value=' + value + '>' + value + '</option>';
				}
				htmlCode += '</optgroup></select></div>'
					+ '<div class="required"><select class="swal2-select"><option disabled value="">Виберіть категорію</option><optgroup label="Категорії"><option value="1">Для родини</option><option value="2">Спорткар</option><option value="3">Позашляховик</option><option value="4">Кросовер</option></optgroup></select></div>'
					+ '<input placeholder = "Ціна за тест драйв" class="swal2-input price"></div>';

				const steps = ['Данні', 'Фото'];
				const values = [];
				let currentStep;

				const swalQueueStep = Swal.mixin({
					confirmButtonText: 'Далі',
					showDenyButton: true,
					denyButtonText: 'Назад',
					progressSteps: steps,
					showCancelButton: true,
					progressSteps: ['Данні', 'Фото'],
					allowOutsideClick: false
				})

				isLoaded = false;
				let marks = new Map(), models = new Map();

				let first = {
					title: 'Заповніть данні щодо авто',
					showDenyButton: false,
					cancelButtonText: "Закрити",
					showCancelButton: false,
					html: htmlCode,
					currentProgressStep: 0,
					didOpen: () => {



						$('.swal2-confirm').css('width', "75%");
						$('.swal2-progress-step').css("width", "4em");
						if (!isLoaded) {
							function ToggleAll(boolian) {
								$('div.main').toggleClass('hide');
								$('.swal2-confirm').toggleClass('hide');
								if (boolian) {
									let title = $(Swal.getHeader()).find('.swal2-title');
									title.html('Загрузка');
									Swal.showLoading();
								}
								else {
									toastCloseBtn(Swal);
									let title = $(Swal.getHeader()).find('.swal2-title');
									title.html('Заповніть данні щодо авто');
									Swal.hideLoading();
								}
							}

							ToggleAll(true);

							$.ajax({
								type: 'POST',
								url: '../app/eventsHandler.php',
								data: {
									'getMarksModels': "get"
								},
								success: function (xhr) {
									function Alert() {
										ToggleAll(false);
										let data = xhr.data;
										Object.entries(data).forEach(([key, value]) => {
											let id = Object.values(value)[0];
											let modelsList = Object.values(value)[1];
											models.set(id, modelsList);
											let marksd = $('div.marka select optgroup');
											$(marksd).append($('<option>', {
												value: id,
												text: key
											}));
										});

									}
									setTimeout(Alert, 2000);
									isLoaded = true;
								},
								error: function (xhr) {
									Toast.fire({
										icon: "error",
										title: xhr.error,
										position: "top"
									})
								}
							})
						}

						$('div.marka select').change((e) => {
							let tempValue = $(e.target).val();
							if (tempValue != null) {
								Swal.resetValidationMessage();
								models.forEach((value, key) => {
									if (key == tempValue) {
										let model = $('div.aboutcar select optgroup').eq(0);
										if (Object.values(value) == "") {
											Swal.showValidationMessage('На жаль, в базі поки що немає моделей цього авто!');
											$('.aboutcar').removeClass('hide').addClass('hide');
											$(e.target).val("");
											return;
										}
										else {
											$(model).html('');
											Object.entries(value).forEach(([key, value]) => {
												$(model).append($('<option>', {
													value: key,
													text: value
												}));
											})
											$('div.aboutcar select').val('');
											$('.aboutcar').removeClass('hide');
										}
									}
								})

							}
							else
								$('div main div.aboutcar').toggleClass('hide');
						})

						if (values.length != 0) {
							const content = Swal.getContent();
							const inputs = $(content).find('div.required select');
							let valuesTemp;
							inputs.each((index, value) => {
								$(value).val(values[index]);
							});
							const input = $(content).find('div input.price');
							$(input).val(values[values.length - 1]);
						}
					},
					preConfirm: () => {
						const content = Swal.getContent();
						const inputs = $(content).find('div.required select');
						let valuesTemp = [];
						inputs.each((index, value) => {
							let vl = $(value).val();
							if (vl != null)
								valuesTemp.push(vl);
							else {
								valuesTemp = [];
								Swal.showValidationMessage('Потрібно обрати всі поля!');
								return false;
							}
						});
						const input = $(content).find('div input.price');
						if (valuesTemp.length != 0) {
							values.length = 0;
							valuesTemp.forEach((value, index) => {
								values.push(valuesTemp[index]);
							})
							values.push(input.val());
							htmlCode = "<div class='main'>" + $('.main').html() + "</div>";
						}
					}
				};

				let htmlSecond = "<div class='main-inputs'>" + '<div id=0 class="flex"><div><input type="text" class="link swal2-input" placeholder="Зображення" value ="" readonly=true maxlength = 300></input> <input type="file" class="fileInput"></input></div><div class="fleximage big"><img height="85px" width="135px" src=../images/notimage.png></div></div>';

				let second = {
					title: 'Виберіть фото авто',
					showDenyButton: true,
					showCancelButton: false,
					html: htmlSecond,
					currentProgressStep: 1,
					didOpen: () => {
						fileName != "" ? $('.link').val(fileName) : $('.swal-input').val();
						toastCloseBtn(Swal);
						$('.swal2-progress-step').css("width", "4em");
						$('.swal2-popup').css("width", "35em");
						$('.fileInput').change(function (obj) {
							fileHandler(obj.target, Swal, 0);
						})
						deletephoto();
					},
					preConfirm: () => {
						htmlSecond = "<div class='main-inputs'>" + $('.main-inputs').html() + "</div>";
						fileName = $('.link').val();

					},
					preDeny: () => {
						htmlSecond = "<div class='main-inputs'>" + $('.main-inputs').html() + "</div>";
						fileName = $('.link').val();
					}
				}

				for (currentStep = 0; currentStep < steps.length;) {

					first["html"] = htmlCode;
					second["html"] = htmlSecond;
					const result = currentStep == 0 ? await swalQueueStep.fire(first) : await swalQueueStep.fire(second);

					if (result.value) {
						if (currentStep == 0) {
							currentStep++;
						} else
							if (currentStep == 1) {
								Swal.fire({
									title: "Додаємо авто",
									showCancelButton: true,
									didOpen: () => {
										if (values.length == 6 && fileName != "") {
											$('swal2-actions').find('button').eq(0).toggleClass('hide');
											let title = $(Swal.getHeader()).find('.swal2-title');
											let _text = 'Додаємо авто';
											let counter = 0;
											Swal.showLoading();
											function _temp() {
												if (counter == 3) {
													_text = "Додаємо авто";
													title.html(_text);
													counter = 0;
												}
												_text += ".";
												title.html(_text);
												counter++;
											}
											const interval = setInterval(_temp, 300);

											$.ajax({
												type: 'POST',
												url: '../app/eventsHandler.php',
												data: {
													'registerNewCar': "reg",
													'color': values[2],
													'category': values[4],
													'year': values[3],
													'model': values[1],
													'price': values[5],
													'photo': fileName
												},
												success: function (xhr) {
													function Alert() {
														Toast.fire({
															icon: "success",
															title: "Авто успішно додано!",
															position: "top"
														});
													}
													setTimeout(Alert, 2000);
												},
												error: function (xhr) {
													Toast.fire({
														icon: "error",
														title: JSON.parse(xhr.responseText).error,
														position: "top"
													});
												}
											})
										}
									}
								});
								break;
							}
					}
					else if (result.isDenied) {
						currentStep--;
					}
					else {
						break;
					}
				}
			})
		});
	}

	$('.logout').click(function (e) {
		$.ajax({
			type: 'POST',
			url: '../app/eventsHandler.php',
			data: { 'logout': "need", role: "admin" },
			success: function (xhr) {
				location.href = location.href;
			}
		})
	});

});
setTimeout(function () {
	$('body').addClass('body_visible');
}, 100);