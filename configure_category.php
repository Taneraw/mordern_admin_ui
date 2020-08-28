<?php

/*
 *
 *
category
 *
 *
 */

require_once 'connection.php';

class Category
{
  /* Member variables */
  public $id;
  public $name;
  public $masterCategoryId;
  public $addeddate;
  public $image;
  public $status;
  public $con;

  public function Category()
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

    $query = "SELECT name from category where id='$catid' && status='1' && active_status='1' ";

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
    $query =
      "SELECT * FROM category where status=1  and id='" . $this->id . "'";

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
      "SELECT * FROM category where status=1 and active_status='1' and id='" .
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
      "SELECT * FROM category where status=1 and active_status='1' and id='" .
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
    $query = "SELECT * FROM category where status=1 and active_status='1' and id='$this->id'";
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

  //using
  public function getCategoryByMasterId($catid)
  {
    $where = "";

    $query = "SELECT * from category where masterCategoryId='$catid' and status=1 and active_status='1'";

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

    $query = "SELECT * from category where status='1'";

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

    $query = "SELECT * from category where status='1' && active_status='1'";

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
  public function getFeature()
  {
    $where = "";

    $query =
      "SELECT * from category where status='1' && active_status='1' and feature='1'";

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
      "INSERT INTO category(name, image, masterCategoryId,addeddate)
		  VALUES
		  ('" .
      $this->f($this->name) .
      "',  '$this->image',  '$this->masterCategoryId',  '$this->addeddate')";

    $result = mysqli_query($this->con, $sql);
    if ($result) {
      return true;
    }
  }

  public function updateRecord()
  {
    $sql = "update category set name='$this->name', image='$this->image' ,masterCategoryId='$this->masterCategoryId',  addeddate='$this->addeddate' where id='$this->id'";

    //  echo $sql;
    $result = mysqli_query($this->con, $sql);
    if ($result) {
      return true;
    }
  }

  public function deleteRecord()
  {
    $result = mysqli_query(
      $this->con,
      "update category set status=0, addeddate='$this->addeddate' where id='" .
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
      "update category set active_status='$this->active_status', addeddate='$this->addeddate' where id='" .
        $this->id .
        "'"
    );
    if ($result) {
      return true;
    }
  }
  public function change_feature_status()
  {
    $result = mysqli_query(
      $this->con,
      "update category set feature='$this->active_status', addeddate='$this->addeddate' where id='" .
        $this->id .
        "'"
    );
    if ($result) {
      return true;
    }
  }
}