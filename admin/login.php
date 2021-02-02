<html>
    <head>

    <link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/all.css">
<link rel="stylesheet" href="../css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../css/sweetalert2.min.css">
<!-- Import javascript -->
<script type="text/javascript" src="../javascript/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="../javascript/bootstrap.min.js"></script>
<script src="../javascript/sweetalert2.min.js"></script>
<script type="text/javascript" src="../javascript/metisMenu.min.js"></script>
<script type="text/javascript" src="../javascript/all.js"></script>
<script type="text/javascript" src="../javascript/otherFunctions.js"></script>
<script type="text/javascript" src="../javascript/jquery.mask.js"></script>'
  </head>
  <?php 
      if(isset($_COOKIE['accAdm']))
      {
          header('Location: /admin/panel.php');
          exit;
      }
      ?>

  <body class="text-center">
    <div class="container signin">
    <form class="form-signin" id="admin" method="post">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">Login</label>
      <input type="text" id="inputEmail" name="email" class="form-control" placeholder="Email address" required="" autofocus="">
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Password" required="">
      <div class="checkbox mb-3">
      </div>
      <button class="btn btn-lg btn-primary btn-block" name = "buttonadmin" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">Carshop © 2020</p>
    </form>
    </div>

    <script></script>
</body>
</html>