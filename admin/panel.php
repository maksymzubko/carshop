<!DOCTYPE html>

<head>
  <?php require_once 'head.php' ?>
</head>
<title>Головна</title>

<body>
  <?php require_once "header.php" ?>
  <section class="main_content admin w-100">
    <div class="container">
      <div class="top text-start">
        <h2 class="m-0">Панель</h2>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <div class="row">
                <div class="col-3 d-flex align-items-center justify-content-center">
                  <i class="fas fa-5x fa-tasks"></i>
                </div>
                <div class="col-9 text-right">
                  <div class="huge"><?php echo $res['alldreq'] ?></div>
                  <div>Всього тест-драйвів</div>
                </div>
              </div>
            </div>
            <a href="testdrives.php">
              <div class="panel-footer">
                <span class="pull-left">Детальніше</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              </div>
            </a>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="panel panel-green">
            <div class="panel-heading">
              <div class="row">
                <div class="col-3 d-flex align-items-center justify-content-center">
                  <i class="fas fa-5x fa-car"></i>
                </div>
                <div class="col-9 text-right">
                  <div class="huge"><?php echo $res['cars'] ?></div>
                  <div>Автівок в системі</div>
                </div>
              </div>
            </div>
            <a href="cars.php">
              <div class="panel-footer">
                <span class="pull-left">Детальніше</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              </div>
            </a>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="panel panel-yellow">
            <div class="panel-heading">
              <div class="row">
                <div class="col-3 d-flex align-items-center justify-content-center">
                  <i class="far fa-5x fa-plus-square"></i>
                </div>
                <div class="col-9 text-right">
                  <div class="huge"><?php $res = $res['requests'];
                                    echo $res; ?></div>
                  <?php if ($res != 0) {
                    echo '<div>Нові тест драйви!</div>';
                  }
                  ?>
                </div>
              </div>
            </div>
            <a href="testdrive.php">
              <div class="panel-footer">
                <span class="pull-left">Детальніше</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              </div>
            </a>
          </div>
        </div>
      </div>
      <div class="top text-start">
        <h2 class="m-0">Швидкі команди</h2>
      </div>
      <div class="row">
        <div class="col-xl-4 col-lg-6 col-md-6 col-6">
          <div class="panel panel-primary addNewAdmin">
            <div class="panel-heading">
              <div class="row">
                <div class="col-3">
                  <i class="fa fa-user-plus fa-5x"></i>
                </div>
              </div>
            </div>
            <div class="expmod pointer">
              <div class="panel-footer">
                <span class="pull-left">Додати нового модератора</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-6">
          <div class="panel panel-green">
            <div class="panel-heading">
              <div class="row">
                <div class="col-3">
                  <i class="fas fa-plus-circle fa-5x"></i>
                </div>
              </div>
            </div>
            <div class="addcar pointer">
              <div class="panel-footer">
                <span class="pull-left">Додати авто</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-6">
          <div class="panel panel-yellow">
            <div class="panel-heading">
              <div class="row">
                <div class="col-3">
                  <i class="fas fa-car-side fa-5x"></i>
                </div>
              </div>
            </div>
            <div class="newtestdrive pointer">
              <div class="panel-footer">
                <span class="pull-left">Оформлення нового тест-драйву</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>

  <?php require_once 'footer.php' ?>
  <?php require_once "scripts.php" ?>
</body>
</html>