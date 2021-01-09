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