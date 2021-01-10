$(document).ready(function () {

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
			let id;
			let arr = [];
			function getIDs(move) {
				$.ajax({
					url: "/app/eventsHandler.php",
					method: "POST",
					dataType: "html",
					data: { action: 'getIDs', move: move },
					success: function (xhr) {
						$('updadm').show();
						$('.button').html("<div class='btn-group'><button class='btn btn-primary dropdown-toggle' type='button' id='about-us' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Select ID<span class='caret'></span></button><ul class='dropdown-menu mod'></ul></div>");
						let data = JSON.parse(xhr);
						$("ul.mod").html(data.html);
						$('.drplist').click(function () {
							id = $(this).text();
							for (let i = 0; i < data.data.length; i++) {
								if (data.data[i].u_ID == id) {
									$('.info').show();

									$('.info label#id').html("ID: " + id);
									$('.info label#name').html("Name: " + data.data[i].u_name);
									$('.info label#sname').html("Second Name: " + data.data[i].u_fname);
									$('.info label#email').html("Email: " + data.data[i].u_login);
								}
							}
						});
					},
					error: function () {
						$('.button').html("<h2>No data found!</h2>");
					}
				});
			};
			$('.expmod').click(function () {

				$('.info').hide();
				$('#exampleModalLabel').html("Add new ADMIN");
				$('.apdadm').html("Update to admin");
				getIDs(1);
				$('.apdadm').click(function () {
					if (id == undefined) {
						swal(
							"Error result",
							"Select ID!",
							"error",
						);
					}
					else {
						$.ajax({
							url: "/app/eventsHandler.php",
							method: "POST",
							dataType: "html",
							data: { action: 'updateU', uid: id },
							success: function (xhr) {
								swal(
									"Success!",
									"User was updated to ADMIN!",
									"success",
								);
								$('#exampleModal').modal('hide');
							},
							error: function () {
								swal(
									"Error!",
									"User was'nt updated to ADMIN!",
									"error",
								);
							}
						});
					}
				});
			});
			$('.remadm').click(function () {
				$('.info').hide();
				getIDs(0);
				$('#exampleModalLabel').html("Remove ADMIN");
				$('.apdadm').html("Delete admin");
				$('.apdadm').click(function () {
					if (id == undefined) {
						swal(
							"Error result",
							"Select ID!",
							"error",
						);
					}
					else {
						$.ajax({
							url: "/app/eventsHandler.php",
							method: "POST",
							dataType: "html",
							data: { action: 'deleteAdm', uid: id },
							success: function (xhr) {
								swal(
									"Success!",
									"User was deleted!",
									"success",
								);
								$('#exampleModal').modal('hide');
							},
							error: function () {
								swal(
									"Error!",
									"User was'nt deleted!",
									"error",
								);
							}
						});
					}
				});
			});
		});
	}

	$('.logout').click(function (e) {
		$.ajax({
			type: 'POST',
			url: '../app/eventsHandler.php',
			data: { 'logout': "need" },
			success: function (xhr) {
				location.href = location.href;
			}
		})
	});

});
setTimeout(function () {
	$('body').addClass('body_visible');
}, 100);