<?php

/*
 *
 *
orders
 *
 *
 */

require_once 'connection.php';

class Order
{
  /* Member variables */
  public $id;
  public $name;
  public $state;
  public $street;
  public $city;
  public $postcode;
  public $phonenumber;
  public $cust_id;
  public $product_id;
  public $order_id;
  public $price;
  public $extra;
  public $size;
  public $quantity;
  public $total;
  public $paid_status;
  public $addeddate;
  public $status;
  public $con;
  public $txn_amount;
  public $finalorder_id;
  public $paymentType;

  public function Order()
  {
    //$this->con=mysqli_connect("localhost","mykt_icar-nrcss","+zfEe7ptcka3","mykt_icar-nrcss");
    $this->con = connectionDb();

    mysqli_set_charset($this->con, 'utf8');
  }
  public function f($val)
  {
    return mysqli_real_escape_string($this->con, $val);
  }
  public function closeConnection()
  {
    mysqli_close($this->con);
  }

  public function query_list($qry)
  {
    $result = mysqli_query($this->con, $qry);

    $returnArray = [];

    if (mysqli_num_rows($result) > 0) {
      $returnArray = [];
      $i = 0;
      while ($row = mysqli_fetch_array($result)) {
        if ($row) {
          $returnArray[$i++] = $row;
        }
      }
    }
    return $returnArray;
  }
  public function getCategoryName($catid)
  {
    $where = "";

    $query = "SELECT name from orders where id='$catid' && status='1' && active_status='1' ";

    //echo $query;

    $list = $this->query_list($query);
    if (count($list) == 0) {
      return false;
      exit();
    } else {
      return $list[0][0];
      exit();
    }
  }
  public function getRecordById()
  {
    $query = "SELECT * FROM orders where status=1  and id='" . $this->id . "'";

    $list = $this->query_list($query);
    if (count($list) == 0) {
      return false;
      exit();
    } else {
      return $list;
      exit();
    }
  }
  public function getRecordByIdUser()
  {
    $query =
      "SELECT * FROM orders where status=1 and active_status='1' and id='" .
      $this->id .
      "'";

    $list = $this->query_list($query);
    if (count($list) == 0) {
      return false;
      exit();
    } else {
      return $list;
      exit();
    }
  }

  public function getCategory($catid)
  {
    $query =
      "SELECT * FROM orders where status=1 and active_status='1' and id='" .
      $catid .
      "'";
    //echo $query;
    $list = $this->query_list($query);
    if (count($list) == 0) {
      return false;
      exit();
    } else {
      return $list;
      exit();
    }
  }
  public function getCategoryData($catid)
  {
    $query = "SELECT * FROM orders where status=1 and active_status='1' and id='$this->id'";
    //echo $query;
    $list = $this->query_list($query);
    if (count($list) == 0) {
      return false;
      exit();
    } else {
      return $list;
      exit();
    }
  }
  public function getDataIdUser($orderid)
  {
    $where = "";

    $query = "SELECT * from orders where order_id='$orderid'  and paid_status='1'";

    //echo $query;

    $list = $this->query_list($query);
    if (count($list) == 0) {
      return false;
      exit();
    } else {
      return $list;
      exit();
    }
  }
  public function getData()
  {
    $where = "";

    $query = "SELECT * from orders ";

    //echo $query;

    $list = $this->query_list($query);
    if (count($list) == 0) {
      return false;
      exit();
    } else {
      return $list;
      exit();
    }
  }

  public function getDataUser($id)
  {
    $where = "";

    $query = "SELECT * from orders where cust_id='" . $id . "'";

    //echo $query;

    $list = $this->query_list($query);
    if (count($list) == 0) {
      return false;
      exit();
    } else {
      return $list;
      exit();
    }
  }

  public function countData()
  {
    $query =
      "SELECT count(id) count FROM members where status=1  and active_status='1'";

    $list = $this->query_list($query);
    if (count($list) == 0) {
      return false;
      exit();
    } else {
      return $list;
      exit();
    }
  }

  public function addRecord()
  {
    $sql =
      "INSERT INTO orders(name,cust_id,street,postcode,city,phonenumber,total,order_id,product_id,quantity,size,addeddate,paymentType,discount,price,extra)
		  VALUES
		  (
              '" .
      $this->f($this->name) .
      "',
        '$this->cust_id',
        '$this->street',
        '$this->postcode',
        '$this->city',
        '$this->phonenumber',
        '$this->total',
        '$this->order_id',
        '$this->product_id',
        '$this->quantity',
        '$this->size',
        '$this->addeddate',
        '$this->paymentType',
        '$this->discount',
        '$this->price',
        '$this->extra'
         )";

    // exit($sql);

    $result = mysqli_query($this->con, $sql);
    if ($result) {
      return true;
    }
  }
  public function addOrder()
  {
    $sql = "INSERT INTO finalorder(order_id,txn_amount)
		  VALUES
		  (
        '$this->finalorder_id',
        '$this->txn_amount'
       ) ";

    $result = mysqli_query($this->con, $sql);
    if ($result) {
      return true;
    }
  }

  public function paidStatus($id)
  {
    $sql = "update orders set paid_status='1'  where order_id='$id'";

    $result = mysqli_query($this->con, $sql);
    if ($result) {
      return true;
    }
  }

  public function deleteRecord()
  {
    $result = mysqli_query(
      $this->con,
      "update orders set status=0, addeddate='$this->addeddate' where id='" .
        $this->id .
        "'"
    );
    if ($result) {
      return true;
    }
  }

  public function change_active_status()
  {
    $result = mysqli_query(
      $this->con,
      "update orders set active_status='$this->active_status', addeddate='$this->addeddate' where id='" .
        $this->id .
        "'"
    );
    if ($result) {
      return true;
    }
  }
  public function updatecod()
  {
    $result = mysqli_query(
      $this->con,
      "update orders set extra='$this->extra',  total='$this->total' where order_id='" .
        $this->order_id .
        "'"
    );
    if ($result) {
      return true;
    }
  }
}