<?php ob_start(); ?>
<?php
date_default_timezone_set("Asia/Kolkata");
include 'sessioncheck.php';
include 'configure_subcategory.php';
if (!isset($_GET['id']) || !isset($_GET['status'])) {
  exit();
} else {
  $mario_category = new SubCategory();
  $mario_category->id = $_GET['id'];
  $mario_category->active_status = $_GET['status'];
  $mario_category->addeddate = date("Y-m-d H:i:s");
  $result = $mario_category->change_active_status();
  if ($_GET['active_status'] == 1) {
    $_SESSION['msg'] = "Subcategory id: " . $_GET[id] . " status changed to ON";
  } else {
    $_SESSION['msg'] =
      "Subcategory id: " . $_GET[id] . " status changed to OFF";
  }
  header('Location: subcategory_list.php');
}
?>
<?php ob_flush(); ?>
