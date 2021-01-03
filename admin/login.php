<html>
    <head>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/style.css" rel="stylesheet">

    <script src="../javascript/jquery-1.11.0.min.js"></script>

  </head>
  <?php 
      if(isset($_COOKIE['acc_admin']))
      {
          header('Location: /panel.php');
          exit;
      }
      ?>

  <body class="text-center">
    <div class="container signin">
    <form class="form-signin" id="admin" method="post">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">Login</label>
      <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required="" autofocus="">
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Password" required="">
      <div class="checkbox mb-3">
      </div>
      <button class="btn btn-lg btn-primary btn-block" name = "buttonadmin" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">Carshop © 2020</p>
    </form>
    </div>

    <script>$('#admin').submit(function (e) {
    var email = $('#inputEmail').val();
    var pass = $('#inputPassword').val();
		$.ajax({
			type: 'POST',
			url: '../app/eventsHandler.php',
			data: {'email':email, 'pass':pass, 'loginAdmin': 'yes'},
			success: function (response) {
				swal(
					"Отлично!",
					"Вы успешно вошли!",
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
	});</script>
</body>
</html>