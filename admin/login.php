<html>
    <head>

    <link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/style.css">

<!-- Import javascript -->
<script type="text/javascript" src="../javascript/jquery.js"></script>
<script src="../javascript/sweetalert2.min.js"></script>
<script type="text/javascript" src="../javascript/otherFunctions.js"></script>
  </head>
  <?php 
      if(isset($_COOKIE['accAdm']))
      {
          header('Location: /admin/panel.php');
          exit;
      }
      ?>

  <body class="text-center">
    <div class="container h-100 signin d-flex align-items-center">
    <form class="form-signin w-100" id="admin" method="post">
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

</body>
</html>