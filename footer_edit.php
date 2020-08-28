<?php
date_default_timezone_set("Asia/Kolkata");
include 'sessioncheck.php';
include 'header.php';
include 'configure_footer.php';

$tc = $privacy = $address = $number = $email = $company = "";

$id = 0;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $id = $_POST['id'];

  //Creating Object of Userrole Class
  $mario_footer = new Footer();
  //Adding Data into Object
  $mario_footer->id = $id;
  $mario_footer->tc = $_POST['tc'];
  $mario_footer->privacy = $_POST['privacy'];
  $mario_footer->address = $_POST['address'];
  $mario_footer->number = $_POST['number'];
  $mario_footer->email = $_POST['email'];
  $mario_footer->company = $_POST['company'];

  if ($id == 0) {
    //Calling add Function to add data into database
    $mario_footer->addRecord();
    $_SESSION['msg'] = "1  record added";
  } else {
    $mario_footer->UpdateRecord();
    $_SESSION['msg'] = "1  record Updated";
  }

  //calling connection close function
  $mario_footer->closeconnection();

  header("Location: footer_list.php");
  exit();
} else {
  if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $mario_footer = new Footer();

    //Adding Data into Object
    $mario_footer->id = $id;

    $row = $mario_footer->getRecordById();

    $count = count($row);

    if ($count < 1) {
      echo "Error in fetching record";
      exit();
    }

    $tc = $row[0]['tc'];
    $privacy = $row[0]['privacy'];
    $address = $row[0]['address'];
    $number = $row[0]['number'];
    $email = $row[0]['email'];
    $company = $row[0]['company'];
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
                            <li><i class="fa fa-home"></i><a href="footer_list.php">Footer</a>
                            </li>
                            <li><i class="fa fa-laptop"></i>Add/Edit Footer</li>
                        </ol>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-12 portlets">
                        <div class="panel panel-default">
                            <div class="panel-Name">
                                <div class="pull-left">Add/Edit Footer</div>

                                <?php if (!empty($_SESSION['msg'])) {
                                  echo "<p style='color:red;'>" .
                                    $_SESSION['msg'] .
                                    "</p>";
                                  $_SESSION['msg'] = '';
                                } ?>
                                <div class="widget-icons pull-right">
                                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <div class="padd">

                                    <div class="form quick-post">
                                        <!-- Edit Course -->
                                        <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                                            <!-- Title -->
                                            <div class="form-group">
                                                <label class="control-label col-lg-1" for="id">ID</label>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control" name="id" id="id" readonly
                                                        value="<?php echo $id; ?>">
                                                </div>
                                            </div>

                                            <!-- Title -->
                                            <div class="form-group">
                                                <label class="control-label col-lg-1" for="Name">Terms &
                                                    Condition</label>
                                                <div class="col-lg-10">
                                                    <textarea type="text" class="form-control" name="tc"
                                                        id="tc"><?php echo $tc; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-1" for="Name">Privacy Policy</label>
                                                <div class="col-lg-10">
                                                    <textarea type="text" class="form-control" name="privacy"
                                                        id="privacy"><?php echo $privacy; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-1" for="Name">Address</label>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control" name="address" id="address"
                                                        value="<?php echo $address; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-1" for="Name">Number </label>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control" name="number" id="number"
                                                        value="<?php echo $number; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-1" for="Name">Emaial </label>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control" name="email" id="email"
                                                        value="<?php echo $email; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-1" for="Name">Company</label>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control" name="company" id="company"
                                                        value="<?php echo $company; ?>">
                                                </div>
                                            </div>


                                            <!--IMAGE-->


                                            <!-- Buttons -->
                                            <div class="form-group">
                                                <!-- Buttons -->
                                                <div class="col-lg-offset-2 col-lg-9">
                                                    <button type="submit" class="btn btn-primary">SAVE</button>
                                                    <button type="reset" class="btn btn-default">Reset</button>
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