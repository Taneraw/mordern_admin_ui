<?php ob_start(); ?>

<?php
date_default_timezone_set("Asia/Kolkata");
include 'sessioncheck.php';
include 'configure_mastercategory.php';
if (!isset($_GET['id']) || !isset($_GET['status'])) {
  exit();
} else {
  $mario_mastercategory = new MasterCategory();
  $mario_mastercategory->id = $_GET['id'];
  $mario_mastercategory->active_status = $_GET['status'];
  $mario_mastercategory->addeddate = date("Y-m-d H:i:s");
  $result = $mario_mastercategory->change_position_status();
  if ($_GET['active_status'] == 1) {
    $_SESSION['msg'] =
      "Master category id: " . $_GET[id] . " status changed to ON";
  } else {
    $_SESSION['msg'] =
      "Master Category id: " . $_GET[id] . " status changed to OFF";
  }
  header('Location: mastercategory_list.php');
}
?>
<?php ob_flush(); ?>