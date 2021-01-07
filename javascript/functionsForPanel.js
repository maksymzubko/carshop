$(document).ready(function () { 
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
                }
            })
        });
});