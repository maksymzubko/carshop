$(document).ready(function () {

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

	result();

	$('#side-menu').metisMenu();

	if (window.location.href.includes("testdrive.php")) {
		var dataTable = $('#data').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				url: "../app/eventsHandler.php",
				data: { action: 'getAllTests' },
				type: "POST",
				error: function () {
					$("div.row").eq(2).hide();
					$("#data tbody").eq(4).html("");
					$("div.row").eq(4).prepend('<h1 class="text-center">No data found in the server</h1>');
					$("#data_processing").css("display", "none");
				}
			},
			onSuccess: function (data, textStatus, jqXHR) {

				$('#data').DataTable().ajax.reload();
			},
			onFail: function () {  // error handling
				$(".data-grid-error").html("");
				$("#data").append('<table class="data-grid-error"><tr><th colspan="3">No data found in the server</th></tr></table>');
				$("#data_processing").css("display", "none");
			}
		});

		$('#data').on('draw.dt', function () {
			$('#data').Tabledit({
				url: '../app/eventsHandler.php',
				deleteButton: false,
				hideIdentifier: true,
				columns: {
					identifier: [0, 'd_ID'],
					editable: [[7, 'status', '{"2":"Success","3":"Denied"}']]
				},
				restoreButton: false,
				onSuccess: function (data, textStatus, jqXHR) {
					if (data.action == 'edit') {
						let tr = $('#data tr#' + data.d_ID);
						tr.remove();
						$('#data').DataTable().ajax.reload();
						let number = $('.notify').text();
						number = parseInt(number) - 1;
						if (parseInt(number) == 0) {
							$('.notify').remove();
							$('div.row').eq(4).find('div').remove();
						}
						else {
							$('.notify').text(number);
						}
					}
				},
				onFail: function () {
					$(".data-grid-error").html("");
					$("#data").append('<table class="data-grid-error"><tr><th colspan="3">No data found in the server</th></tr></table>');
					$("#data_processing").css("display", "none");
				}
			});
		});
	}
	else if (window.location.href.includes("showncars.php")) {
		var dataTable = $('#data').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				url: "../app/eventsHandler.php",
				data: { action: 'getVisible' },
				type: "POST",
				error: function () {
					$('div.buttons-shown').hide();
					$("div.row").eq(2).hide();
					$("#data tbody").eq(4).html("");
					$("div.row").eq(4).prepend('<h1 class="text-center">No data found in the server</h1>');
					$("#data_processing").css("display", "none");
				}
			}
		});

		$('#data').on('draw.dt', function () {
			$('#data').Tabledit({
				url: '../app/eventsHandler.php',
				dataType: 'json',
				columns: {
					identifier: [0, 'a_ID'],
					editable: [[4, 'visible', '{"1":"Enabled","2":"Disabled"}']]
				},
				onSuccess: function (data, textStatus, jqXHR) {
					if (data.action == 'edit')
						$('#data').DataTable().ajax.reload();

				},
				error: function () {  // error handling
					$(".data-grid-error").html("");
					$("#data").append('<table class="data-grid-error"><tr><th colspan="3">No data found in the server</th></tr></table>');
					$("#data_processing").css("display", "none");
				},
				restoreButton: false,
				deleteButton: false,
			});
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
	} else if (window.location.href.includes("users.php")) {
		var dataTable = $('#data').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				url: "../app/eventsHandler.php",
				data: { action: 'getUsers' },
				type: "POST",
				error: function () {
					$("div.row").eq(2).hide();
					$("#data tbody").eq(4).html("");
					$("div.row").eq(4).prepend('<h1 class="text-center">No data found in the server</h1>');
					$("#data_processing").css("display", "none");
				}
			}
		});
	} else if (window.location.href.includes("testdrives.php")) {
		var dataTable = $('#data').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				url: "../app/eventsHandler.php",
				data: { action: 'getAllTests2' },
				type: "POST",
				error: function () {
					$("div.row").eq(2).hide();
					$("#data tbody").eq(4).html("");
					$("div.row").eq(4).prepend('<h1 class="text-center">No data found in the server</h1>');
					$("#data_processing").css("display", "none");
				}
			}
		});
	} else if (window.location.href.includes("cars.php")) {
		var dataTable = $('#data').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				url: "../app/eventsHandler.php",
				data: { action: 'getAuto' },
				type: "POST",
				error: function () {
					$("div.row").eq(2).hide();
					$("#data tbody").eq(4).html("");
					$("div.row").eq(4).prepend('<h1 class="text-center">No data found in the server</h1>');
					$("#data_processing").css("display", "none");
				}
			}
		});
	}
	else if (window.location.href.includes("panel.php")) {
		$(document).ready(function () {

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
						showCancelButton: true,
						cancelButtonText: "Закрити",
						preConfirm: () => {
							const unique = Swal.getPopup().querySelector('#unique').value
							if (!unique) {
								Swal.showValidationMessage(`Будь-ласка уведіть унікальний номер юзера`)
							}
							else
								if (unique.length != 6) {
									Swal.showValidationMessage(`Унікальний номер = 6 чисел`)
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
													Swal.fire({
														icon: "info",
														title: 'Дані користувача',
														html: "<div class='usermain'><div class='userinfo'><label>Ун.номер: <input id='uniq' readonly=true value =" + uniqtext + "></input></label><label>Логін: <input id='login' readonly=true value =" + logintext + "></input></label><label>Пароль: <input id='pass' readonly=true value =" + passtext + "></input></label></div><div class='copy'></div></div>",
														confirmButtonText: 'Закрити',
														allowOutsideClick: false,
														didOpen: () => {
															$('.copy').click(function () {
																let text = "";
																text += uniqtext + ":";
																text += logintext + ":";
																text += passtext + ";";
																copyUserData(text);
															})
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
						allowOutsideClick: false
					}).then((result) => {
						if (result.isConfirmed) {

						}
					})

				}
				swaladd(isExist);
			})
			//actionRemoveModerator
			$('.remadm').click(function () {

				var numbers, numbersObject;
				$.ajax({
					type: 'POST',
					url: '../../app/eventsHandler.php',
					data: {
						'listOfModers': "get"
					},
					success: function (xhr) {
						let temp = JSON.parse(xhr.data);
						numbers = temp.uniq;
						swaladd();
					},
					error: function () {
						Swal.fire(
							"Дивно",
							"Жодного модератора не знайдено в базі!",
							"error"
						);
					}
				})

				function swaladd(str) {
					Swal.fire({
						icon: "question",
						title: 'Видалити модератора',
						input: 'select',
						inputOptions: {
							'Номера': numbers

						},
						inputPlaceholder: 'Виберіть модератора',
						confirmButtonText: 'Видалити',
						focusConfirm: false,
						showCancelButton: true,
						cancelButtonText: "Закрити",
						allowOutsideClick: false,
						inputValidator: (value) => {
							return new Promise((resolve) => {
								if (!value) {
									resolve('Виберіть модератора');
								}
								else { resolve(); }
							})
						}
					}).then(function (result) {
						if (result.isConfirmed) {
							Swal.fire({
								icon: "question",
								title: 'Ви впевнені?',
								confirmButtonText: 'Так',
								focusConfirm: false,
								showCancelButton: true,
								cancelButtonText: "Назад"
							}).then(function (result) {
								if (result.isConfirmed) {
									$.ajax({
										type: 'POST',
										url: '../../app/eventsHandler.php',
										data: {
											'action': "deleteAdm",
											'unique': result.value
										},
										success: function (xhr) {
											Swal.fire(
												"Успіх",
												"Модератора #" + result.value + " було видалено!",
												"success"
											);
										},
										error: function () {
											//empty
										}
									})
								}
								else {
									swaladd();
								}
							})
						}
					})
				}
			})
			//copy to clipboard
			function copyUserData(text) {
				const el = document.createElement('input');
				el.value = text;
				el.setAttribute('readonly', '');
				el.style.position = 'absolute';
				el.style.left = '-9999px';
				document.body.appendChild(el);
				el.select();
				document.execCommand('copy');
				document.body.removeChild(el);

				Swal.fire(
					"Успіх",
					"Данні користувача #" + uniqtext + " успішно скопійовані до буферу обміну!",
					"success"
				);
			}
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