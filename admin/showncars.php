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
                        <a href="panel.php"><i class="fa fa-user fa-fw"></i> Main panel</a>
                    </li>
                    <li>
                        <a href="testdrive.php"><i class="fa fa-car fa-fw"></i> Testdrives <?php require '../app/functions.php';
                                                                                $res = getStats();
                                                                                if ($res) {
                                                                                    if ($res['requests'] != 0)
                                                                                        echo '<span class="notify">' . $res['requests'] . '</span>';
                                                                                } ?></a>
                    </li>
                    <li>
                        <a class="active" href="#"><i class="fa fa-edit fa-fw"></i> Visible settings</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-wrench fa-fw"></i> Tables<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="users.php"> Users</a>
                            </li>
                            <li>
                                <a href="testdrives.php"> Testdrives</a>
                            </li>
                            <li>
                                <a href="cars.php"> Cars</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!--Navigator start-->
                <div class="breadcrumb admin">
                    <div class="container-fluid">
                        <div class="breadcrumbs-main">
                            <ol class="breadcrumb admin">
                                <li>
                                    <h5>You are here</h5>
                                </li>
                                <li><a href="panel.php">Admin main</a></li>
                                <li class="active">Shown cars</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!--Navigator end-->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header top">Shown cars</h1>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 test">
                        <div class="panel panel-default">
                            <div class="panel-heading">Need change visible some car?</div>
                            <div class="panel-body">
                            <div class="buttons-shown">
                            <button id="shownall">Shown all</button>  <button id="hideall">Hide all</button>
                            </div>
                                <div class="table-responsive">
                                    <table id="data" class="table table-bordered table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#ID</th>
                                                <th>Image</th>
                                              <!--  <th>Mark</th>
                                                <th>Model</th> -->
                                                <th>Visible</th>
                                            </tr>
                                        </thead>
                                        <tbody class="body"></tbody>
                                    </table>
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