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
                                <a href="#"> Cars</a>
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
                                <li class="active">Test</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!--Navigator end-->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header top">Test</h1>
                    </div>
                </div>
                <!-- /.row -->
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary expmod" data-toggle="modal" data-target="#exampleModal">
                    Launch demo modal
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
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
                                                <li class="drplist">Our Story</li>
                                                <li>Our Team</li>
                                                <li>Contact Us</li>
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
    </div>
    </div>
    </div>
    </div>
    <?php require_once 'scripts.php' ?>
</body>

</html>
?>