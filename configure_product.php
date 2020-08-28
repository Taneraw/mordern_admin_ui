<?php

/*
 *
 *
product
 *
 *
 */

require_once 'connection.php';

class Product
{
  /* Member variables */
  public $id;
  public $name;
  public $image;
  public $images;
  public $categoryId;
  public $description;
  public $manufactureTitle;
  public $manufactureDescription;
  public $price;
  public $discount;
  public $addeddate;
  public $status;
  public $review;
  public $active_status;
  public $active_price;
  public $size;
  public $quantity;
  public $con;

  public function Product()
  {
    $this->con = connectionDb();

    mysqli_set_charset($this->con, 'utf8');
  }

  public function closeConnection()
  {
    mysqli_close($this->con);
  }
  public function f($val)
  {
    return mysqli_real_escape_string($this->con, $val);
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

  public function getRecordById()
  {
    $query = "SELECT * FROM product where status=1 and id='" . $this->id . "'";

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
      "SELECT * FROM product where status=1 and active_status ='1'and id='" .
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
  public function getCategoryData()
  {
    $sql =
      "Select product . *,category.name categoryname from category, product where category.id=product.categoryid && product.status=1";
    $sql =
      "Select users.*,category.name category name from category, users where category.id=users.categoryid";

    $result = mysqli_query($this->con, $sql);
    if ($result) {
      return true;
    }
  }
  public function getData()
  {
    $where = "";

    $query = "SELECT * from product where status=1 order by id";

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
  public function getDataUser()
  {
    $where = "";

    $query =
      "SELECT * from product where status=1 && active_status='1' order by id";

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
  public function getProducts($catid)
  {
    $query =
      "SELECT * FROM product where status=1 and active_status ='1' and categoryId='" .
      $catid .
      "'";

    // exit($query);

    $list = $this->query_list($query);
    if (count($list) == 0) {
      return false;
      exit();
    } else {
      return $list;
      exit();
    }
  }
  public function getProductName($catid)
  {
    $query =
      "SELECT name FROM product where status=1 and active_status ='1' and id='" .
      $catid .
      "'";

    // exit($query);

    $list = $this->query_list($query);
    if (count($list) == 0) {
      return false;
      exit();
    } else {
      return $list[0][0];
      exit();
    }
  }
  public function getProducts1($id)
  {
    $query =
      "SELECT * FROM product where status=1 and active_status ='1' and id='" .
      $id .
      "'";

    // exit($query);

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
      "SELECT count(id) count FROM product where status=1 and active_status ='1'";

    $list = $this->query_list($query);
    if (count($list) == 0) {
      return false;
      exit();
    } else {
      return $list;
      exit();
    }
  }
  public function getSearch($q)
  {
    $query =
      "select * from product where name like '%" .
      $q .
      "%'  and status=1 and active_status='1'";

    //  echo $query;
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
      "INSERT INTO product (categoryId,name,description,image,images,price,discount,manufactureTitle,manufactureDescription,addeddate,size,quantity,review)
		VALUES
		(
		'$this->categoryId',
		'" .
      $this->f($this->name) .
      "',
		'" .
      $this->f($this->description) .
      "',
		'$this->image',
		'$this->images',
		'$this->price',
		'$this->discount',
		'$this->manufactureTitle',
		'$this->manufactureDescription',
		'$this->addeddate',
		'$this->size',
		'$this->quantity',
		'$this->review'
		)";
    //     exit($sql);
    $result = mysqli_query($this->con, $sql);
    if ($result) {
      return true;
    }
  }

  public function updateRecord()
  {
    $sql =
      "update product set categoryId ='$this->categoryId',
	  name ='" .
      $this->f($this->name) .
      "',
	  description ='" .
      $this->f($this->description) .
      "',
	  images ='$this->images',
	  image = '$this->image',
	 discount =  '$this->discount' ,
	  price ='$this->price',manufactureTitle ='$this->manufactureTitle' , size='$this->size', quantity='$this->quantity' ,manufactureDescription='$this->manufactureDescription',addeddate ='$this->addeddate' , review='$this->review' where id = '$this->id' ";

    //  echo $sql;
    $result = mysqli_query($this->con, $sql);
    if ($result) {
      return true;
    }
  }
  public function updateQuantity($id, $quant)
  {
    $sql = "update product set quantity = quantity - '$quant' where id = '$id'  ";

    $result = mysqli_query($this->con, $sql);
    //echo $sql;
    if ($result) {
      return true;
    }
  }
  public function deleteRecord()
  {
    $result = mysqli_query(
      $this->con,
      "update product set status=0, addeddate='$this->addeddate' where id='" .
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
      "update product set active_status='$this->active_status', addeddate='$this->addeddate' where id='" .
        $this->id .
        "'"
    );
    if ($result) {
      return true;
    }
  }

  public function price_change_active_status()
  {
    $result = mysqli_query(
      $this->con,
      "update product set active_price='$this->active_price',addeddate='$this->addeddate' where id='" .
        $this->id .
        "'"
    );
    if ($result) {
      return true;
    }
  }
  // function price_change_active_status()
  // {
  //  $result = mysqli_query($this->con,"update product set active_price=0, addeddate='$this->addeddate' where id='".$this->id."'");
  //  if($result)
  // return true;
  // }
}