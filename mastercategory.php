<?php
date_default_timezone_set("Asia/Kolkata");
include 'sessioncheck.php';
include 'header.php';
include 'configure_mastercategory.php';

$name = $addeddate = $status = $attachments = "";

$id = 0;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $id = $_POST['id'];

  //Creating Object of Userrole Class
  $mario_mastercategory = new MasterCategory();
  //Adding Data into Object
  $mario_mastercategory->id = $id;
  $mario_mastercategory->name = $_POST['name'];
  $mario_mastercategory->addeddate = date("Y-m-d H:i:s");

  if ($id == 0) {
    //Calling add Function to add data into database
    $mario_mastercategory->addRecord();
    $_SESSION['msg'] = "1 category record added";
  } else {
    $mario_mastercategory->UpdateRecord();
    $_SESSION['msg'] = "1 category record Updated";
  }

  //calling connection close function
  $mario_mastercategory->closeconnection();

  header("Location: mastercategory_list.php");
  exit();
} else {
  if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $mario_mastercategory = new MasterCategory();

    //Adding Data into Object
    $mario_mastercategory->id = $id;

    $row = $mario_mastercategory->getrecordbyid();

    $count = count($row);

    if ($count < 1) {
      echo "Error in fetching record";
      exit();
    }

    $name = $row[0]['name'];
  }
}
?>
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />

    <!-- Custom styles -->
    <link rel="stylesheet" href="css/fullcalendar.css">
    <link href="css/widgets.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
    <link href="css/xcharts.min.css" rel=" stylesheet">
    <link href="css/jquery-ui-1.10.4.min.css" rel="stylesheet">
    <script src="//cdn.ckeditor.com/4.7.1/full/ckeditor.js"></script>

    <link rel="stylesheet" href="assets/ckeditor/samples/css/samples.css">
    </head>

    <style>
        .btn-blue {
            width: 80px;
            margin: 0 10px;
            border-radius: 5px;
            color: #0f98d8;
            font-weight: 800;
            text-decoration: none;
            background-color: #0d63d442;
        }
        
        .btn-blue:hover {
            width: 80px;
            margin: 0 10px;
            border-radius: 5px;
            color: #0f98d8;
            font-weight: 800;
            text-decoration: none;
            background-color: #0d63d442;
        }
        
        .btn-orange {
            width: 80px;
            margin: 0 10px;
            border-radius: 5px;
            color: #d8700f;
            font-weight: 800;
            text-decoration: none;
            background-color: #d49f0d42;
        }
        
        .btn-orange:hover {
            width: 80px;
            margin: 0 10px;
            border-radius: 5px;
            color: #d8700f;
            font-weight: 800;
            text-decoration: none;
            background-color: #d49f0d42;
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
                                    <li><i class="fa fa-home"></i>
                                        <a href="mastercategory_list.php">
                                            <span style="color: #000;font-weight: 800;">
                                        Master Category List
                                    </span>
                                        </a>
                                    </li>
                                    <li><i class="fa fa-laptop"></i> <span style="color: #000;font-weight: 800; "> Add/Edit Master Category </span></li>
                                </ol>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12 portlets">
                                <div class="panel panel-default" style="border-radius: 5px;">
                                    <div class="panel-Name">
                                        <div class="pull-left" style="margin-left: 1em;margin-top: .5em;">Add/Edit Category</div>

                                        <?php if (!empty($_SESSION['msg'])) {
                                  echo "<p style='color:red;'>" .
                                    $_SESSION['msg'] .
                                    "</p>";
                                  $_SESSION['msg'] = '';
                                } ?>
                                    </div>
                                    <div class="panel-body" style="border-radius: 5px;">
                                        <div class="padd">

                                            <div class="form quick-post">
                                                <!-- Edit Course -->
                                                <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                                                    <!-- Title -->
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-1" for="id">ID</label>
                                                        <div class="col-lg-10">
                                                            <input type="text" class="form-control" name="id" id="id" readonly value="<?php echo $id; ?>">
                                                        </div>
                                                    </div>

                                                    <!-- Title -->
                                                    <div class="form-group col-lg-6">
                                                        <label class="control-label col-lg-2" for="Name">Name</label>
                                                        <div class="col-lg-10">
                                                            <input type="text" class="form-control" name="name" id="name" value="<?php echo $name; ?>">
                                                        </div>
                                                    </div>


                                                    <!--IMAGE-->


                                                    <!-- Buttons -->
                                                    <div class="form-group">
                                                        <!-- Buttons -->
                                                        <div class="col-lg-offset-2 col-lg-9">
                                                            <button type="submit" class="btn btn-blue">Save</button>
                                                            <button type="reset" class="btn btn-orange">Reset</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>


                                        </div>
                                        <div class="widget-foot">
                                            <!-- Footer goes here -->
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <!-- project team & activity end -->

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

        <!-- colorpicker -->

        <!-- bootstrap-wysiwyg -->
        <script src="js/jquery.hotkeys.js"></script>
        <script src="js/bootstrap-wysiwyg.js"></script>
        <script src="js/bootstrap-wysiwyg-custom.js"></script>

        <!-- custom form component script for this page-->
        <script src="js/form-component.js"></script>
        <!-- custome script for all page -->
        <script src="js/scripts.js"></script>



        <?php include 'footer.php'; ?>
    </body>

    </html>