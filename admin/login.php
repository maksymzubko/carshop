<html>
    <head>

    <link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/style.css">

<!-- Import javascript -->
<script type="text/javascript" src="../javascript/jquery.js"></script>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="../css/sweetalert2.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="../images/logo-mini.png">
<title>Admin Login</title>
  </head>
  <?php 
      if(isset($_COOKIE['accAdm']))
      {
          header('Location: /admin/panel.php');
          exit;
      }
      ?>

  <body class="text-center visible">
    <div class="container h-100 signin d-flex align-items-center justify-content-center">
    <form class="form-signin w-50" id="admin" method="post">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">Login</label>
      <input type="text" id="inputEmail" name="email" class="form-control" placeholder="Login" required="" autofocus="">
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Password" required="">
      <div class="checkbox mb-3">
      </div>
      <button class="btn btn-lg btn-primary btn-block" name = "buttonadmin" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">Carshop © 2020</p>
    </form>
    </div>
    <script src="../javascript/sweetalert2.min.js"></script>
    <script>
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
					"Помилка",
					d.error,
					"error",
				);
			}
		})
	});
    </script>
</body>
</html>