<!DOCTYPE html>

<head>
    <?php require_once 'head.php' ?>
</head>
<title>Головна</title>

<body>
    <?php require_once 'header.php' ?>
    <div id="wrapper">
        <!-- Navigation -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a class="active" href="#"><i class="fa fa-user fa-fw"></i> Головна</a>
                    </li>
                    <li>
                        <a href="testdrive.php"><i class="fa fa-car fa-fw"></i> Тест-драйви <?php require '../app/functions.php';
                                                                                            $res = getStats();
                                                                                            if ($res) {
                                                                                                if ($res['requests'] != 0)
                                                                                                    echo '<span class="notify">' . $res['requests'] . '</span>';
                                                                                            } ?></a>
                        </a>
                    </li>
                    <li>
                        <a href="showncars.php"><i class="fa fa-edit fa-fw"></i> Налаштування відображення</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-wrench fa-fw"></i> Таблиці<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="users.php"> Користувачі</a>
                            </li>
                            <li>
                                <a href="testdrives.php"> Тест-драйви</a>
                            </li>
                            <li>
                                <a href="cars.php"> Автівки</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!--Navigator start-->
                <div class="breadcrumb ">
                    <div class="container-fluid">
                        <div class="breadcrumbs-main">
                            <ol class="breadcrumb admin">
                                <li>
                                    <h5>Ви тут</h5>
                                </li>
                                <li class="active">Адмін головна</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!--Navigator end-->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header top">Панель</h1>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $res['alldreq'] ?></div>
                                        <div>Всього тест-драйвів</div>
                                    </div>
                                </div>
                            </div>
                            <a href="testdrives.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Детальніше</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-car fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $res['cars'] ?></div>
                                        <div>Автівок в системі</div>
                                    </div>
                                </div>
                            </div>
                            <a href="cars.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Детальніше</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-bell fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php $res = $res['requests']; echo $res; ?></div>
                                        <?php if($res != 0) 
                                        {echo '<div>Нові тест драйви!</div>'; }
                                            ?>
                                    </div>
                                </div>
                            </div>
                            <a href="testdrive.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Детальніше</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header top">Кнопки швидкого доступу</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2 col-md-3 col-xs-6">
                        <div class="panel panel-primary addNewAdmin">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user-plus fa-5x"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="expmod pointer">
                                <div class="panel-footer">
                                    <span class="pull-left">Додати нового модератора</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-xs-6">
                        <div class="panel panel-primary removeAdmin">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user-times fa-5x"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="remadm pointer">
                                <div class="panel-footer">
                                    <span class="pull-left">Видалити модератора</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-xs-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-youtube fa-5x"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="editlinks pointer">
                                <div class="panel-footer">
                                    <span class="pull-left">Редактор посилань</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-3 col-xs-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-picture-o fa-5x"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="editphotos pointer">
                                <div class="panel-footer">
                                    <span class="pull-left">Редактор зображень</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-xs-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-ban fa-5x"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="blockuser pointer">
                                <div class="panel-footer">
                                    <span class="pull-left">Заблокувати користувача</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once 'scripts.php' ?>
</body>

</html>
?>