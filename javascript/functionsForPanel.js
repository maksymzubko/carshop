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
						showCancelButton: true,
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

				var numbers;
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
						let numberEnter = result.value;
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
											'unique': numberEnter
										},
										success: function (xhr) {
											Toast.fire({
												title: "Модератора #" + numberEnter + " було видалено!",
												icon: "success",
												position: "top"
											});
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
			//actionBlockUser
			$('.blockuser').click(function () {

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
					Swal.fire({
						icon: "question",
						title: 'Заблокувати користувача',
						input: 'select',
						inputOptions: {
							'Номера': numbers

						},
						inputPlaceholder: 'Виберіть користувача',
						confirmButtonText: 'Заблокувати',
						focusConfirm: false,
						showCancelButton: true,
						cancelButtonText: "Закрити",
						allowOutsideClick: false,
						inputValidator: (value) => {
							return new Promise((resolve) => {
								if (!value) {
									resolve('Виберіть користувача');
								}
								else { resolve(); }
							})
						}
					}).then(function (result) {
						let numberEnter = result.value;
						if (result.isConfirmed) {
							Swal.fire({
								title: "Заблокувати користувача",
								confirmButtonText:'Заблокувати',
								showCancelButton: true,
								input: 'text',
								inputPlaceholder: 'Уведіть причину блокування',
								cancelButtonText: "Закрити",
								allowOutsideClick: false,
								inputValidator: (value) => {
									return new Promise((resolve) => {
										if (!value) {
											resolve('Уведіть причину блокування!');
										}
										else if(value.length < 10)
										{
											resolve('Будь-ласка опишіть детальніше!');
										}
										else { resolve(); }
									})
								}
							}).then(function (result){
								if(result.isConfirmed)
								{
									let desc = result.value;
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
													'blockUser': "block",
													'uid': numberEnter,
													'desc':desc
												},
												success: function (xhr) {
													Toast.fire({
														title: "Користувача #" + numberEnter + " було заблоковано! Причина: "+desc+"",
														icon: "success",
														position: "top"
													});
												},
												error: function () {
													Toast.fire({
														title: "Користувача невдалось заблокувати",
														icon: "error",
														position: "top"
													});
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
				}
			})
			//actionEditLinks
			$('.editlinks').click(function () {
				var cars;
				$.ajax({
					type: 'POST',
					url: '../../app/eventsHandler.php',
					data: {
						'getCarsList': "get"
					},
					success: function (xhr) {
						cars = JSON.parse(xhr[0]).IDs;
						swaladd();
					},
					error: function () {
						Swal.fire(
							"Помилка",
							"Жодного авто не знайдено в базі!",
							"error"
						);
					}
				});

				function swaladd(str) {
					Swal.fire({
						icon: "question",
						title: 'Редагувати посилання',
						input: 'select',
						inputOptions: {
							'ID`s': cars

						},
						inputPlaceholder: 'Виберіть авто',
						confirmButtonText: 'Обрати',
						focusConfirm: false,
						showCancelButton: true,
						cancelButtonText: "Закрити",
						allowOutsideClick: false,
						inputValidator: (value) => {
							return new Promise((resolve) => {
								if (!value) {
									resolve('Виберіть авто');
								}
								else { resolve(); }
							})
						}
					}).then(function (result) {
						if (result.isConfirmed) {
							let carid = result.value;
							$.ajax({
								type: 'POST',
								url: '../../app/eventsHandler.php',
								data: {
									'getVideosList': "get",
									'carID': result.value
								},
								success: function (xhr) {
									let arrayOfLinks;

									let newList, oldLinks;

									count = JSON.parse(xhr[0]).count;
									arrayOfLinks = JSON.parse(xhr[0]).links;
									let lVal = Object.values(arrayOfLinks);
									let lKeys = Object.keys(arrayOfLinks);

									let htmlCode = "<div class=multiple-inputs-div>";
									htmlCode += "<div class='main-inputs'>"
									for (let i = 0; i < 10; i++) {
										let data = lVal[i] == undefined ? "" : lVal[i];
										let id = lKeys[i] == undefined ? "a" + i + "" : lKeys[i];

										htmlCode += '<input type="text" id=' + id + '  class="link" class="swal2-input" placeholder="Посилання" value ="' + data + '" maxlength = 300></input>';
									}

									htmlCode += "</div></div>";
									showSwalInputs();
									function showSwalInputs() {
										Swal.fire({
											title: "Редагування посилань",
											html: htmlCode,
											allowOutsideClick: false,
											showCancelButton: true,
											showDenyButton: true,
											denyButtonText: "Назад",
											denyButtonColor: "gray",
											cancelButtonColor: "#E94D6A",
											cancelButtonText: "Закрити",
											confirmButtonText: "Оновити",
											preConfirm: () => {

												let countToEdit = 0;
												var myMapOlds = new Map();
												var myMapNew = new Map();
												$('.link').each(function (index) {
													let itemID = $(this).attr("id");
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

												if (JSON.stringify(newList) == JSON.stringify({})) {
													if (JSON.stringify(arrayOfLinks) === JSON.stringify(oldLinks)) {
														Swal.showValidationMessage("Потрібно змінити або додати хоча-б 1 елемент");
														return;
													}
												}


												$.ajax({
													type: 'POST',
													url: '../../app/eventsHandler.php',
													data: {
														'updateVideosLinks': "upd",
														'linksNew': newList,
														'linksOld': oldLinks,
														'carID': carid,
														'countToEdit': countToEdit
													},
													success: function () {
														Toast.fire({
															title: "Данні змінено!",
															icon: "success",
															timer: 4000,
															position: "top",
														})
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
										}).then(function (result){
											if(result.isDenied)
											{
												swaladd();
											}
										})
									}
								}, error: function () {
									//empty
								}
							})
						}
					})
				}
			})
			//actionEditPhotos
			$('.editphotos').click(function () {
				var cars;
				$.ajax({
					type: 'POST',
					url: '../../app/eventsHandler.php',
					data: {
						'getCarsList': "get"
					},
					success: function (xhr) {
						cars = JSON.parse(xhr[0]).IDs;
						swaladd();
					},
					error: function () {
						Swal.fire(
							"Помилка",
							"Жодного авто не знайдено в базі!",
							"error"
						);
					}
				});

				function swaladd(str) {
					Swal.fire({
						icon: "question",
						title: 'Редагувати фото',
						input: 'select',
						inputOptions: {
							'ID`s': cars

						},
						inputPlaceholder: 'Виберіть авто',
						confirmButtonText: 'Обрати',
						focusConfirm: false,
						showCancelButton: true,
						cancelButtonText: "Закрити",
						allowOutsideClick: false,
						inputValidator: (value) => {
							return new Promise((resolve) => {
								if (!value) {
									resolve('Виберіть авто');
								}
								else { resolve(); }
							})
						}
					}).then(function (result) {
						if (result.isConfirmed) {
							let carid = result.value;
							$.ajax({
								type: 'POST',
								url: '../../app/eventsHandler.php',
								data: {
									'getPhotosList': "get",
									'carID': result.value
								},
								success: function (xhr) {
									let arrayOfLinks;

									let newList, oldLinks;

									count = JSON.parse(xhr[0]).count;
									arrayOfLinks = JSON.parse(xhr[0]).links;
									let lVal = Object.values(arrayOfLinks);
									let lKeys = Object.keys(arrayOfLinks);

									let htmlCode = "<div class=multiple-inputs-div>";
									htmlCode += "<div class='main-inputs'>"
									for (let i = 0; i < 9; i++) {
										let data = lVal[i] == undefined ? "notimage.png" : lVal[i];
										let id = lKeys[i] == undefined ? "a" + i + "" : lKeys[i].replace("'", "").replace("'", "");

										data = (data == "notimage.png") ? data : fileExists("../images/" + data) == true ? data : "notimage.png";

										i == 0 ? firstID = id : "";
										i == 0 ? htmlCode += '<div class="flex" id="' + id + '"><div>Головне зображення:<input type="text" class="link swal2-input" placeholder="Зображення" value ="' + ((data == "notimage.png") ? "" : data) + '" readonly=true maxlength = 300></input> <input type="file" class="fileInput"></input></div><div class="fleximage "><img height="65px" style="margin-left:4px;margin-top:23px" width="115px" src=../images/' + data + '></div></div><hr>' : htmlCode += '<div class="flex" id="' + id + '"><div><input type="text" class="link swal2-input" placeholder="Зображення" value ="' + ((data == "notimage.png") ? "" : data) + '" readonly=true maxlength = 300></input> <input type="file" class="fileInput"></input></div><div class="fleximage ' + ((data == "notimage.png") ? "" : "withcontent") + '"><img height="65px" width="115px" src=../images/' + data + '></div></div>';
									}

									htmlCode += "</div></div>";
									showSwalInputs();
									function showSwalInputs() {
										Swal.fire({
											title: "Редагування зображень",
											html: htmlCode,
											allowOutsideClick: false,
											showCancelButton: true,
											showDenyButton: true,
											denyButtonText: "Назад",
											denyButtonColor: "gray",
											cancelButtonColor: "#E94D6A",
											cancelButtonText: "Закрити",
											confirmButtonText: "Оновити",
											didOpen: () => {

												var tem = Swal.getContainer();
												$(tem).children().css('width', '35em');

												$('.fileInput').change(function (obj) {
													fileHandler(obj.target, Swal, $(this).parent().parent().attr("id"));
												})

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
													url: '../../app/eventsHandler.php',
													data: {
														'updatePhotos': "upd",
														'linksNew': newList,
														'linksOld': oldLinks,
														'carID': carid,
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
										}).then(function (result){
											if(result.isDenied)
											{
												swaladd();
											}
										})
									}
								}, error: function () {
									//empty
								}
							})
						}
					})
				}
			})
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
			function fileHandler(file, Swal, DivID) {

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

				$("#" + DivID + " .link").val(fileInfo.name);
				let image = $("#" + DivID + " .fleximage img");
				image.attr("src", "../images/" + fileInfo.name);
				if (DivID != firstID)
					image.parent().toggleClass("withcontent");
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