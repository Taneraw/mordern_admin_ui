<?php
date_default_timezone_set("Asia/Kolkata");
include 'sessioncheck.php';
include 'header.php';
include 'configureSlider.php';
$page = "slider";
$title = $description = $addeddate = $status = $attachments = $attachment = "";

$id = 0;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $id = $_POST['id'];

  if (isset($_POST['attachment'])) {
    $attachment = $_POST['attachment'];

    if ($_FILES['file1']['name'] != "") {
      include "image_single.php";

      $file = $_SERVER['DOCUMENT_ROOT'] . "/upload/" . $_POST['attachment'];
      if (!unlink($file)) {
        echo "Error deleting $file";
      }
    }
  } else {
    if ($_FILES['file1']['name'] == "") {
      $_SESSION['msg'] =
        "Image file is required. Please attach a file and try again to insert crop";
      header("Location: slider_list.php");
      exit();
    } else {
      include "image_single.php";
    }
  }

  if (isset($_POST['attachments'])) {
    $attachments = $_POST['attachments'];
  }
  // include("image_`.php");

  //Creating Object of Userrole Class
  $mario_slider = new Slider();
  //Adding Data into Object
  $mario_slider->id = $id;
  $mario_slider->title = $_POST['title'];
  $mario_slider->description = $_POST['description'];
  $mario_slider->image = $attachment;
  $mario_slider->addeddate = date("Y-m-d H:i:s");

  if ($id == 0) {
    //Calling add Function to add data into database
    $mario_slider->addRecord();
    $_SESSION['msg'] = "1 slider record added";
  } else {
    $mario_slider->UpdateRecord();
    $_SESSION['msg'] = "1 slider record Updated";
  }

  if (isset($_POST['todelete']) && $_POST['todelete'] != "") {
    $file_text = explode(
      ",",
      substr($_POST['todelete'], 0, strlen($_POST['todelete']) - 1)
    );

    foreach ($file_text as $js) {
      $file = $_SERVER['DOCUMENT_ROOT'] . "upload/" . $js;
      if (!unlink($file)) {
        echo "Error deleting $file";
      }
    }
  }
  //calling connection close function
  $mario_slider->closeconnection();

  header("Location: slider_list.php");
  exit();
} else {
  if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $mario_slider = new slider();

    //Adding Data into Object
    $mario_slider->id = $id;

    $row = $mario_slider->getrecordbyid();

    $count = count($row);

    if ($count < 1) {
      echo "Error in fetching record";
      exit();
    }
    $description = $row[0]['description'];
    $title = $row[0]['title'];
    $attachment = $row[0]['image'];
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
<!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
<!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
      <script src="js/lte-ie7.js"></script>
    <![endif]-->
<!--<script src="assets/ckeditor/ckeditor.js"></script>-->

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
                            <li><i class="fa fa-home"></i><a href="slider_list.php">Slider List</a></li>
                            <li><i class="fa fa-laptop"></i>Add/Edit Slider</li>
                        </ol>
                    </div>
                </div>



                <div class="row">

                    <div class="col-md-12 portlets">
                        <div class="panel panel-default">
                            <div class="panel-Name">
                                <div class="pull-left">Add/Edit slider</div>

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
                                                <label class="control-label col-lg-1" for="Title">Title</label>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control" name="title" id="title"
                                                        value="<?php echo $title; ?>">
                                                </div>
                                            </div>

                                            <!-- Description -->
                                            <div class="form-group">
                                                <label class="control-label col-lg-1" for="Title">Description</label>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control" name="description"
                                                        id="title" value="<?php echo $description; ?>">
                                                </div>
                                            </div>




                                            <!--IMAGE-->
                                            <div class="clearfix"></div>

                                            <div class="form-group">
                                                <label class="control-label col-lg-1" for="image">Thumb Image</label>
                                                <div class="col-lg-10">

                                                    <input type="file" class="form-control" name="file1" id="file1">

                                                    <?php if ($id != 0) { ?>
                                                    <input type="hidden" name="attachment" id="attachment"
                                                        value="<?php echo $attachment; ?>">

                                                    Attachment: <br>
                                                    <div>
                                                        <img style="width:200px; height:auto; margin:10px;"
                                                            src="upload/<?php echo $attachment; ?>">
                                                    </div>
                                                    <?php } ?>


                                                </div>
                                            </div>

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


    <script>
    function deleteimage(imagetext, div) {
        var original = $("#attachments").val();
        original = original.replace(imagetext + ",", "");
        $("#attachments").val(original);
        $("#" + div).remove();

        var newtext = $("#todelete").val();
        newtext = newtext + imagetext + ",";
        $("#todelete").val(newtext);
    }
    </script>

    <?php include 'footer.php'; ?>
</body>

</html>