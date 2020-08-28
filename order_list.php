<?php

include 'sessioncheck.php';
include 'header.php';
include 'configure_order.php';
include 'configure_product.php';
$mario_product = new Product();

$mario_order = new Order();
$order_data = $mario_order->getData();
if ($order_data == false) {
  $order_count = 0;
} else {
  $order_count = count($order_data);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <?php
    include 'siteheader.php';

    include 'sidebar.php';
    ?>


    <!--main content start-->
    <section id="main-content">
        <section class="wrapper" style="margin-top: 100px;">
            <?php for ($i = 0; $i < $order_count; $i++) { ?>
            <div class="container">
                <div style="background-color: #fff; border-radius: 20px;"
                    style="border: 1px;border-style: solid; border-color: #868585;margin: 2em;">
                    <div class="d-flex "
                        style="justify-content: space-between;background-color: #dbdbdb; border-radius: 15px; padding: .3em;">
                        <p style="margin: 1em; ">Order Placed on: <?php echo $order_data[
                          $i
                        ]['addeddate']; ?></p>
                        <p style="margin: 1em ">Order Id: <?php echo $order_data[
                          $i
                        ]['order_id']; ?></p>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <p style="margin: 1em "><?php echo $order_data[$i][
                              'name'
                            ]; ?> - customer Id: <?php echo $order_data[$i][
   'cust_id'
 ]; ?> </p>
                            <div class="d-flex">

                                <p style="margin: .5em;color: #868585;">Quantity x Product - Size - price - discount
                                </p>
                            </div>
                            <?php
                            $product_size = explode(
                              ',',
                              substr(
                                $order_data[$i]['size'],
                                0,
                                strlen($order_data[$i]['size']) - 1
                              )
                            );
                            $product_price = explode(
                              ',',
                              substr(
                                $order_data[$i]['price'],
                                0,
                                strlen($order_data[$i]['price']) - 1
                              )
                            );
                            $product_discount = explode(
                              ',',
                              substr(
                                $order_data[$i]['discount'],
                                0,
                                strlen($order_data[$i]['discount']) - 1
                              )
                            );
                            $product_id = explode(
                              ',',
                              substr(
                                $order_data[$i]['product_id'],
                                0,
                                strlen($order_data[$i]['product_id']) - 1
                              )
                            );
                            $product_quantity = explode(
                              ',',
                              substr(
                                $order_data[$i]['quantity'],
                                0,
                                strlen($order_data[$i]['quantity']) - 1
                              )
                            );

                            for ($j = 0; $j < count($product_size); $j++) { ?>
                            <div class="d-flex">

                                <p style="margin: .5em;color: #868585;"> <?php echo $product_quantity[
                                  $j
                                ] .
                                  " X " .
                                  $mario_product->getProductName(
                                    $product_id[$j]
                                  ) .
                                  " - " .
                                  $product_size[$j] .
                                  " - " .
                                  $product_price[$j] .
                                  " - " .
                                  $product_discount[$j]; ?> </p>
                            </div>
                            <?php }
                            ?>
                        </div>
                        <div class="col-md-4">
                            <p style="margin: 1em;color: #868585;"><b>Delivery Details</b></p>
                            <p style="margin: .15em;color: rgb(36, 183, 219);"><?php echo $order_data[
                              $i
                            ]['name']; ?></p>

                            <p style="margin: .15em;color: rgb(36, 183, 219);"><?php echo $order_data[
                              $i
                            ]['phonenumber']; ?></p>
                            <p style="margin: .15em;color: rgb(36, 183, 219);"><?php echo $order_data[
                              $i
                            ]['street']; ?></p>
                            <p style="margin: .15em;color: rgb(36, 183, 219);"><?php echo $order_data[
                              $i
                            ]['state']; ?> - <?php echo $order_data[$i][
   'city'
 ]; ?> - <?php echo $order_data[$i]['postcode']; ?> </p>
                            <!-- <p style="margin: .15em;color: rgb(36, 183, 219);">john.smith@globoforce.com</p> -->
                        </div>
                    </div>

                    <hr style="height: 1px;color: #868585;">
                    <div style="padding: .5em;">
                        <strong style="margin: 1em;">
                            Order total: INR <?php echo $order_data[$i][
                              'total'
                            ]; ?>
                        </strong>
                        <strong style="margin: 1em;">
                            Delivery: INR <?php echo $order_data[$i][
                              'delivery'
                            ]; ?>
                        </strong>
                        <?php if ($order_data[$i]['paymentType'] == 0) { ?>
                        <strong style="margin: 1em;">
                            Paytm
                        </strong>
                        <?php } else { ?>
                        <strong style="margin: 1em;">
                            Cash on delivery
                        </strong>
                        <?php } ?>
                        <?php if ($order_data[$i]['paid_status'] == 1) { ?>
                        <strong style=" color: green; margin: 1em;">
                            Paid
                        </strong>
                        <?php } else { ?>
                        <strong style="color: red; margin: 1em;">
                            Not Paid (Pending)
                        </strong>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php } ?>

        </section>
    </section>


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
            window.location = "delete_category.php?id=" + id;
        }
    }
    </script>

    <?php include 'footer.php'; ?>
</body>

</html>