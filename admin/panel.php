<!DOCTYPE html>

<head>
    <?php require_once 'head.php' ?>
</head>
<title>Main panel</title>

<body>
    <?php require_once 'header.php' ?>
    <div id="wrapper">
        <!-- Navigation -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a class="active" href="#"><i class="fa fa-user fa-fw"></i> Main panel</a>
                    </li>
                    <li>
                        <a href="testdrive.php"><i class="fa fa-car fa-fw"></i> Testdrives <?php require '../app/functions.php';
                                                                                            $res = getStats();
                                                                                            if ($res) {
                                                                                                if ($res['requests'] != 0)
                                                                                                    echo '<span class="notify">' . $res['requests'] . '</span>';
                                                                                            } ?></a>
                        </a>
                    </li>
                    <li>
                        <a href="showncars.php"><i class="fa fa-edit fa-fw"></i> Visible settings</a>
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
                <div class="breadcrumb ">
                    <div class="container-fluid">
                        <div class="breadcrumbs-main">
                            <ol class="breadcrumb admin">
                                <li>
                                    <h5>You are here</h5>
                                </li>
                                <li class="active">Admin main</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!--Navigator end-->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header top">Dashboard</h1>
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
                                        <div>Total testdrives order</div>
                                    </div>
                                </div>
                            </div>
                            <a href="testdrives.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
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
                                        <div>Cars in system</div>
                                    </div>
                                </div>
                            </div>
                            <a href="cars.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
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
                                        <div class="huge"><?php echo $res['requests'] ?></div>
                                        <div>New testdrives!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="testdrive.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header top">Quick buttons</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2 col-md-3 col-xs-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user-plus fa-5x"></i>
                                    </div>
                                </div>
                            </div>
                            <a href="" class="expmod" data-toggle="modal" data-target="#exampleModal">
                                <div class="panel-footer">
                                    <span class="pull-left">Add new Admin</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-xs-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user-times fa-5x"></i>
                                    </div>
                                </div>
                            </div>
                            <a href="" class="remadm" data-toggle="modal" data-target="#exampleModal">
                                <div class="panel-footer">
                                    <span class="pull-left">Remove Admin</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>
                                </div>
                            </a>
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
                            <a href="cars.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Edit video links</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>
                                </div>
                            </a>
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
                            <a href="cars.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Edit images</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update to ADMIN</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="modalcontent">
                                    <div class="button">
                                        <div class="btn-group">
                                            <button class="btn btn-primary dropdown-toggle" type="button" id="about-us" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Select ID
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu mod">
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="info" style="display: none;">
                                        <div>

                                        </div>
                                        <label id="id"></label><label id="name"></label><label id="sname"></label><label id="email"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary apdadm">Update to Admin</button>
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