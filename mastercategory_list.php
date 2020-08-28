<?php
include 'sessioncheck.php';
include 'header.php';
include 'configure_mastercategory.php';
?>

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />

    <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />

    <!-- Custom styles -->
    <link rel="stylesheet" href="css/fullcalendar.css">
    <link href="css/widgets.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
    <link href="css/xcharts.min.css" rel=" stylesheet">
    <link href="css/jquery-ui-1.10.4.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
      <script src="js/lte-ie7.js"></script>
    <![endif]-->
    </head>
    <style>
        .no-link {
            text-decoration: none;
            font-weight: 600;
            color: #2cc466;
        }
        
        .no-link:hover {
            text-decoration: none;
            font-weight: 600;
            color: #2ebd65;
        }
        
        .no-link-down {
            text-decoration: none;
            color: #e24343;
            font-weight: 600;
        }
        
        .no-link-down:hover {
            text-decoration: none;
            color: #ca2e2e;
            font-weight: 600;
        }
        
        .custom-btn-green {
            width: 80px;
            margin: 0 10px;
            border-radius: 5px;
            color: #0f8d40;
            font-weight: 800;
            text-decoration: none;
            background-color: #2ebd6562;
        }
        
        .custom-btn-green:hover {
            width: 80px;
            margin: 0 10px;
            border-radius: 5px;
            color: #0f8d40;
            font-weight: 800;
            text-decoration: none;
            background-color: #2ebd6562;
        }
        
        .custom-btn-red {
            width: 80px;
            margin: 0 10px;
            border-radius: 5px;
            color: #ca2e2e;
            font-weight: 800;
            text-decoration: none;
            background-color: #ca2e2e41
        }
        
        .custom-btn-red:hover {
            width: 80px;
            margin: 0 10px;
            border-radius: 5px;
            color: #ca2e2e;
            font-weight: 800;
            text-decoration: none;
            background-color: #ca2e2e41
        }
        
        #dataTables-example_filter input {
            margin: 4px;
            outline: none;
            color: #000;
            width: 220px;
        }
    </style>

    <body>
        <!-- container section start -->
        <section id="container" class="">

            <?php
        include 'siteheader.php';

        include 'sidebar.php';
        ?>

                <!--main content start-->
                <section id="main-content">
                    <section class="wrapper">
                        <!--overview start-->
                        <div class="row" style="margin-top: 1em;">
                            <div class="col-lg-12">
                                <ol class="breadcrumb" style="border-radius: 5px;background-color: #fff;">
                                    <li><i class=" fa fa-home "></i>
                                        <a href="mastercategory_list.php ">
                                            <span style="color: #000;font-weight: 800; ">
                                Master Category List
                                </span>
                                        </a>
                                    </li>
                                    <li style="float:right; "><i class="fa fa-laptop "></i>
                                        <a href="mastercategory.php ">
                                            <span style="color: #000;font-weight: 800; ">
                                            Add Master Category
                                        </span>
                                        </a>
                                    </li>
                                </ol>
                            </div>
                        </div>


                        <!-- project team & activity end -->

                        <div class="row ">
                            <div class="col-lg-12 ">
                                <section class="panel " style="border-radius: 5px; ">
                                    <header>
                                        <?php if (!empty($_SESSION['msg'])) {
                                  echo "<span class='no-link' style=';margin-left:1em'>" . $_SESSION['msg'] . "
                                    </span>"; $_SESSION['msg'] = ''; } ?>
                                    </header>

                                    <table style="border-radius: 5px;" class="table table-striped table-advance table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th style="color: rgb(153, 145, 158);font-weight: 800" style="text-align: center;">ID</th>
                                                <th style="color: #5B0492;font-weight: 800" style="text-align: center;">Name</th>
                                                <th style="color: #5B0492;font-weight: 800" style="text-align: center;">Position</th>
                                                <th style="color: #5B0492;font-weight: 800" style="text-align: center;">Active Status</th>
                                                <th style="color: #5B0492;font-weight: 800;" style="text-align: center;"><i class="icon_cogs"></i> Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                    $inbox_object = new MasterCategory();
                                    $row = $inbox_object->getData();

                                    if ($row == false) {
                                      $count = 0;
                                    } else {
                                      $count = count($row);
                                    }
                                    $i = 0;
                                    while ($i < $count) { ?>
                                                <tr>
                                                    <td style="text-align: center;">
                                                        <?php echo $row[$i]['id']; ?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php echo $row[$i]['name']; ?>
                                                    </td style="text-align: center;">
                                                    <td style="text-align: center;">

                                                        <?php if (
                                              $row[$i]['position'] == 1
                                            ) {
                                              echo "<a class='no-link-down' href='category_position_status_change.php?id=" .
                                                $row[$i]['id'] .
                                                "&status=0' >Down</a>";
                                            } else {
                                              echo "<a class='no-link' href='category_position_status_change.php?id=" .
                                                $row[$i]['id'] .
                                                "&status=1' >Up</a>";
                                            } ?>
                                                    </td>
                                                    <td style="text-align: center;">

                                                        <?php if (
                                              $row[$i]['active_status'] == 1
                                            ) {
                                              echo "<a class='no-link' href='mastercategory_active_status_change.php?id=" .
                                                $row[$i]['id'] .
                                                "&status=0' >ON</a>";
                                            } else {
                                              echo "<a class='no-link-down' href='mastercategory_active_status_change.php?id=" .
                                                $row[$i]['id'] .
                                                "&status=1' >OFF</a>";
                                            } ?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <div>
                                                            <a class="btn custom-btn-green" href="mastercategory.php?id=<?php echo $row[
                                                  $i
                                                ]['id']; ?>">Edit</a>
                                                            <a class='btn custom-btn-red' onclick='deleterecord' (<?php echo $row[ $i ][ 'id']; ?>)">Delete</a>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <?php $i++;}
                                    ?>

                                        </tbody>
                                    </table>
                                </section>
                            </div>
                        </div>

                    </section>
                </section>
                <!--main content end-->
        </section>
        <!-- container section start -->



        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>

        <!-- nice scroll -->
        <script src="js/jquery.scrollTo.min.js"></script>
        <script src="js/jquery.nicescroll.js" type="text/javascript"></script>

        <!-- jquery ui -->
        <script src="js/jquery-ui-1.9.2.custom.min.js"></script>

        <!--custom checkbox & radio-->
        <script type="text/javascript" src="js/ga.js"></script>
        <!--custom switch-->
        <script src="js/bootstrap-switch.js"></script>
        <!--custom tagsinput-->
        <script src="js/jquery.tagsinput.js"></script>



        <!-- custome script for all page -->
        <script src="js/scripts.js"></script>

        <script src="assets/js/dataTables/jquery.dataTables.js"></script>
        <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function() {
                $('#dataTables-example').dataTable({
                    "order": [
                        [0, "desc"]
                    ],
                    "pageLength": 50
                });
            });

            function deleterecord(id) {
                var res = confirm("Are you Sure ? \n Do you want to delete Record : " + id);

                if (res == true) {
                    window.location = "delete_mastercategory.php?id=" + id;
                }
            }
        </script>


        <?php include 'footer.php'; ?>
    </body>

    </html>