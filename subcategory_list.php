<?php
include 'sessioncheck.php';
include 'header.php';
include 'configure_subcategory.php';
include_once 'configure_mastercategory.php';
$mario_mastercategory = new MasterCategory();
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
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li><i class="fa fa-home"></i><a href="subcategory_list.php">Sub Category List</a>
                            </li>
                            <li style="float:right;"><i class="fa fa-laptop"></i><a href="subcategory.php">Add
                                    Sub Category</a>
                            </li>
                        </ol>
                    </div>
                </div>


                <!-- project team & activity end -->

                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Available Records
                                <?php if (!empty($_SESSION['msg'])) {
                                  echo "<span style='color:red;'>" .
                                    $_SESSION['msg'] .
                                    "</span>";
                                  $_SESSION['msg'] = '';
                                } ?>
                            </header>

                            <table class="table table-striped table-advance table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th><i class="icon_profile"></i> ID</th>
                                        <th><i class="icon_profile"></i> Name</th>
                                        <th><i class="icon_profile"></i> Master category</th>
                                        <th><i class="icon_profile"></i> Active Status</th>
                                        <th><i class="icon_cogs"></i> Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $mario_subcategory = new SubCategory();
                                    $row = $mario_subcategory->getData();

                                    if ($row == false) {
                                      $count = 0;
                                    } else {
                                      $count = count($row);
                                    }
                                    $i = 0;
                                    while ($i < $count) { ?>
                                    <tr>
                                        <td><?php echo $row[$i]['id']; ?></td>
                                        <td><?php echo $row[$i]['name']; ?></td>
                                        <?php
                                        $mario_mastercategory->id =
                                          $row[$i]['masterCategoryId'];
                                        $mastercategotyname = $mario_mastercategory->getRecordById();
                                        ?>
                                        <td><?php echo $mastercategotyname[0][
                                          'name'
                                        ]; ?></td>
                                        <td>

                                            <?php if (
                                              $row[$i]['active_status'] == 1
                                            ) {
                                              echo "<a href='subcategory_active_status_change.php?id=" .
                                                $row[$i]['id'] .
                                                "&status=0' >ON</a>";
                                            } else {
                                              echo "<a href='subcategory_active_status_change.php?id=" .
                                                $row[$i]['id'] .
                                                "&status=1' >OFF</a>";
                                            } ?>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-success" href="subcategory.php?id=<?php echo $row[
                                                  $i
                                                ]['id']; ?>">Edit</a>
                                                <a class="btn btn-success" onclick="deleterecord(<?php echo $row[
                                                  $i
                                                ]['id']; ?>)">Delete</a>
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
            window.location = "delete_subcategory.php?id=" + id;
        }
    }
    </script>

    <?php include 'footer.php'; ?>
</body>

</html>