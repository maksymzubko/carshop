<!DOCTYPE html>

<head>
    <?php require_once 'head.php' ?>
    <title>Shown cars</title>
</head>

<body>
    <?php require_once 'header.php' ?>
    <div id="wrapper">
        <!-- Navigation -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a  href="panel.php"><i class="fa fa-user fa-fw"></i> Головна</a>
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
                    <li class="active" >
                        <a href="#"><i class="fas fa-table fa-fw"></i> Таблиці<i class="arrow"></i></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="active"  href="users.php"> Користувачі</a>
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
                                <li><a href="panel.php">Адмін головна</a></li>
                                <li class="active">Таблиці</li>
                                <li class="active">Користувачі</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!--Navigator end-->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header top">Користувачі</h1>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 test">
                        <div class="panel panel-default">
                            <div class="panel-body">
                            <div class="switch_test text-center"><button id="0" class="active">Користувачі</button><button id="2" >Заблоковані користувачі</button><button class="" id="1">Модераторы</button></div>
                                <div class="table-responsive data1">
                                    <table id="data" class="table table-bordered table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#ID</th>
                                                <th>Ім'я</th>
                                                <th>Прізвище</th>
                                                <th>Пошта</th>
                                                <th>Пароль</th>
                                                <th>Телефон</th>
                                                <th>Стать</th>
                                                <th>Функція</th>
                                            </tr>
                                        </thead>
                                        <tbody class="body"></tbody>
                                    </table>
                                    <h1 class="text-center error">Інформація відсутня</h1>
                                </div>
                                <div class="table-responsive data2">
                                    <table id="data2" class="table table-bordered table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#ID</th>
                                                <th>Унікальний код</th>
                                                <th>Логін</th>
                                                <th>Пароль</th>
                                                <th>Функція</th>
                                            </tr>
                                        </thead>
                                        <tbody class="body"></tbody>
                                    </table>
                                    <h1 class="text-center error">Інформація відсутня</h1>
                                </div>
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