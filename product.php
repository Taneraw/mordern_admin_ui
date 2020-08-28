<?php
date_default_timezone_set("Asia/Kolkata");
include 'sessioncheck.php';
include 'configure_product.php';
include 'configure_subcategory.php';
include 'configure_category.php';
include 'configure_mastercategory.php';

$mario_category = new Category();
$mario_mastercategory = new MasterCategory();

$mario_subcategory = new SubCategory();
$categorylist = $mario_category->getData();
if ($categorylist == false) {
  $categorylistcount = 0;
} else {
  $categorylistcount = count($categorylist);
}
//$mario_subcategory->closeconnection();

$page_products = "products";
$name = "";
$categoryId = "";
$description = "";
$attachment = "";
$attachments = "";
$price = "";
$discount = "";
$manufactureTitle = "";
$manufactureDescription = "";
$addeddate = "";
$quantity = "";
$review = "";
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
      header("Location: product_list.php");
      exit();
    } else {
      include "image_single.php";
    }
  }

  if (isset($_POST['attachments'])) {
    $attachments = $_POST['attachments'];
  }

  include "image_generals.php";
  //Creating Object of Userrole Class
  $mario_product = new Product();
  //Adding Data into Object
  $size = "";
  foreach ($_POST['size'] as $selectedOption) {
    $size .= $selectedOption . ',';
  }
  // exit($size);
  $mario_product->name = $_POST['name'];
  $mario_product->categoryId = $_POST['categoryId'];
  $mario_product->description = $_POST['description'];
  $mario_product->image = $attachment;
  $mario_product->images = $attachments;
  $mario_product->id = $_POST['id'];
  $mario_product->price = $_POST['price'];
  $mario_product->manufactureTitle = $_POST['manufactureTitle'];
  $mario_product->manufactureDescription = $_POST['manufactureDescription'];
  $mario_product->discount = $_POST['discount'];
  $mario_product->review = $_POST['review'];
  $mario_product->size = $size;
  $mario_product->quantity = $_POST['quantity'];
  /*$mario_product->status = $_POST['status'];
    $mario_product->active_status = $_POST['active_status'];
    $mario_product->active_price = $_POST['active_price'];*/
  $mario_product->addeddate = date("Y-m-d H:i:s");

  if ($id == 0) {
    //Calling add Function to add data into database
    $mario_product->addRecord();
    $_SESSION['msg'] = "1 Product record added";
  } else {
    $mario_product->UpdateRecord();
    $_SESSION['msg'] = "1 Product record Updated";
  }

  if (isset($_POST['todelete']) && $_POST['todelete'] != "") {
    $file_text = explode(
      ",",
      substr($_POST['todelete'], 0, strlen($_POST['todelete']) - 1)
    );

    foreach ($file_text as $js) {
      $file = $_SERVER['DOCUMENT_ROOT'] . "/upload/" . $js;
      if (!unlink($file)) {
        echo "Error deleting $file";
      }
    }
  }
  //calling connection close function
  $mario_product->closeconnection();

  header("Location: product_list.php");
  exit();
} else {
  if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $mario_product = new Product();

    //Adding Data into Object
    $mario_product->id = $id;

    $row = $mario_product->getrecordbyid();

    $count = count($row);

    if ($count < 1) {
      echo "Error in fetching record";
      exit();
    }

    $name = $row[0]['name'];
    $description = $row[0]['description'];
    $attachment = $row[0]['image'];
    $attachments = $row[0]['images'];
    $price = $row[0]['price'];
    $discount = $row[0]['discount'];
    $manufactureTitle = $row[0]['manufactureTitle'];
    $manufactureDescription = $row[0]['manufactureDescription'];
    $addeddate = $row[0]['addeddate'];
    $quantity = $row[0]['quantity'];
    $categoryId = $row[0]['categoryId'];
    $review = $row[0]['review'];
  }
}
?>
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <!--external css-->
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />

    <!-- Custom styles -->
    <link rel="stylesheet" href="product.css">
    <link rel="stylesheet" href="css/fullcalendar.css">
    <link href="css/widgets.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
    <link href="css/xcharts.min.css" rel=" stylesheet">
    <link href="css/jquery-ui-1.10.4.min.css" rel="stylesheet">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
      <script src="js/lte-ie7.js"></script>
    <![endif]-->
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
                                        <a href="product_list.php">
                                            <span style="color: #000;">
                            Product List
                            </span>
                                        </a>
                                    </li>
                                    <li><i class="fa fa-laptop"></i>
                                        <span style="color: #000;">
                                      Add/Edit Product
                                      </span>
                                    </li>
                                </ol>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-12 portlets">
                                <div class="panel panel-default">
                                    <div class="panel-name">
                                        <div class="pull-left" style="margin-left: 1em;margin-top: .5em;">Add/Edit Product</div>

                                        <?php if (!empty($_SESSION['msg'])) {
                                  echo "<p style='color:red;'>" .
                                    $_SESSION['msg'] .
                                    "</p>";
                                  $_SESSION['msg'] = '';
                                } ?>

                                        <!-- <div class="widget-icons pull-right">
                                            <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                                            <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                                        </div> -->
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
                                                            <input type="text" class="form-control" name="id" id="id" readonly value="<?php echo $id; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-lg-12">
                                                        <label class="control-label col-lg-1" for="categoryid">Category
                                                    ID</label>
                                                        <div class="col-lg-10">
                                                            <select name="categoryId" id="dates-field2" class="form-control">
                                                        <option value=" 0">Select Category Id</option>
                                                        <?php for (
                                                          $i = 0;
                                                          $i <
                                                          $categorylistcount;
                                                          $i++
                                                        ) { ?>
                                                        <option value="<?php echo $categorylist[
                                                          $i
                                                        ]['id']; ?>" <?php if (
  $categorylist[$i]['id'] == $categoryId
) {
  echo "Selected";
} else {
  echo "";
} ?>>
                                                            <?php
                                                            $mario_subcategory->id =
                                                              $categorylist[$i][
                                                                'masterCategoryId'
                                                              ];
                                                            $subcategotyname = $mario_subcategory->getRecordById();

                                                            $mario_mastercategory->id =
                                                              $subcategotyname[0][
                                                                'masterCategoryId'
                                                              ];
                                                            $mastercategotyname = $mario_mastercategory->getRecordById();

                                                            echo $categorylist[
                                                              $i
                                                            ]['name'] .
                                                              "--" .
                                                              $subcategotyname[0][
                                                                'name'
                                                              ] .
                                                              "--" .
                                                              $mastercategotyname[0][
                                                                'name'
                                                              ];
                                                            ?>

                                                        </option>
                                                        <?php } ?>
                                                        </option>
                                                    </select>
                                                        </div>
                                                    </div>
                                                    <!-- Title -->
                                                    <div class="form-group col-lg-12">
                                                        <label class="control-label col-lg-1" for="name">Name</label>
                                                        <div class="col-lg-10">
                                                            <input type="text" class="form-control" name="name" id="name" value="<?php echo $name; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <label class="control-label col-lg-1" for="name">Review</label>
                                                        <div class="col-lg-10">
                                                            <input type="text" class="form-control" name="review" id="review" value="<?php echo $review; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-lg-12">
                                                        <label class="control-label col-lg-1" for="id">Description</label>
                                                        <div class="col-lg-10">

                                                            <input type="text" class="form-control" name="description" id="description" value="<?php echo $description; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <label class="control-label col-lg-1" for="id">Manfacture Title</label>
                                                        <div class="col-lg-10">

                                                            <input type="text" class="form-control" name="manufactureTitle" id="manufactureTitle" value="<?php echo $manufactureTitle; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <label class="control-label col-lg-1" for="id">manufacture
                                                    Description</label>
                                                        <div class="col-lg-10">

                                                            <input type="text" class="form-control" name="manufactureDescription" id="manufactureDescription" value="<?php echo $manufactureDescription; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">

                                                        <label class="control-label col-lg-1" for="image">Image</label>
                                                        <div class="col-lg-10">

                                                            <input type="file" class="form-control" name="file1" id="file1">

                                                            <?php if ($id != 0) { ?>
                                                            <input type="hidden" name="attachment" id="attachment" value="<?php echo $attachment; ?>"> Attachment: <br>
                                                            <div>
                                                                <img style="width:200px; height:auto; margin:10px;" src="upload/<?php echo $attachment; ?>">
                                                            </div>
                                                            <?php } ?>


                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label col-lg-1" for="description">Attachment</label>
                                                        <div class="col-lg-10">

                                                            <input type="file" class="form-control" name="files[]" id="files" multiple>

                                                            <?php if ($id != 0) { ?>
                                                            <input type="hidden" name="attachments" id="attachments" value="<?php echo $attachments; ?>">
                                                            <input type="hidden" name="todelete" id="todelete" value=""> Attachments: <br>
                                                            <?php
                                                    $files_text = $attachments;
                                                    if ($files_text != "") {
                                                      $files_array = explode(
                                                        ',',
                                                        substr(
                                                          $files_text,
                                                          0,
                                                          strlen($files_text) -
                                                            1
                                                        )
                                                      );
                                                      $ctr = 1;
                                                      foreach (
                                                        $files_array
                                                        as $tmp
                                                      ) { ?>
                                                                <div class="col-md-3" id="image<?php echo $ctr; ?>" style="position:relative; border:1px solid green; padding:2px; margin:10px 25px; height:230px; border-radius:10%;">
                                                                    <center><img style="width:180px; height:auto; margin:5px;" src="upload/<?php echo $tmp; ?>"></center>
                                                                    <input type="hidden" name="image<?php echo $ctr; ?>">
                                                                    <center><a style="background-color:red; position: absolute; top:-5px; right:-5px; border:1px solid red; padding:2px; cursor:pointer;color:white; border-radius:50%; width:25px;" onclick="deleteimage('<?php echo $tmp; ?>','image'+<?php echo $ctr; ?>)">X</a>
                                                                    </center>
                                                                </div>
                                                                <?php $ctr++;}
                                                    }
                                                    } ?>


                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label class="control-label col-lg-2" for="title">Price</label>
                                                        <div class="col-lg-10">
                                                            <input type="number" class="form-control" name="price" id="price" value="<?php echo $price; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-lg-6">
                                                        <label class="control-label col-lg-2" for="title">Discount</label>
                                                        <div class="col-lg-10">
                                                            <input type="number" class="form-control" name="discount" id="discount" value="<?php echo $discount; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label class="control-label col-lg-2" for="title">Quantity</label>
                                                        <div class="col-lg-10">
                                                            <input type="number" class="form-control" name="quantity" id="quantity" value="<?php echo $quantity; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form- col-lg-6">
                                                        <label class="col-lg-2 control-label" for="rolename">Role Name</label>
                                                        <div class="col-lg-10">
                                                            <select name="size[]" class="form-control" multiple>
                                                        <option value="Small">Small</option>
                                                        <option value="Medium">Medium</option>
                                                        <option value="Large">Large</option>
                                                        <option value="ExtraLarge">Extra Large</option>
                                                    </select>
                                                        </div>
                                                    </div>
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
        <script src="product.js"></script>


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
        <script type="text/javascript">
            $(function() {
                $('.multiselect-ui').multiselect({
                    includeSelectAllOption: true
                });
            });
        </script>
    </body>

    </html>