<?php

/*
*
*
	subcategory
*
*
*/

require_once 'connection.php';

class SubCategory
{
  /* Member variables */
  var $id;
  var $name;
  var $addeddate;
  var $status;
  var $con;
  var $masterCategoryId;

  function SubCategory()
  {
    //$this->con=mysqli_connect("localhost","mykt_icar-nrcss","+zfEe7ptcka3","mykt_icar-nrcss");
    $this->con = connectionDb();

    mysqli_set_charset($this->con, 'utf8');
  }
  function f($val)
  {
    return mysqli_real_escape_string($this->con, $val);
  }
  function closeConnection()
  {
    mysqli_close($this->con);
  }

  function query_list($qry)
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
  function getCategoryName($catid)
  {
    $where = "";

    $query = "SELECT name from subcategory where id='$catid' && status='1' && active_status='1' ";

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
  function getRecordById()
  {
    $query =
      "SELECT * FROM subcategory where status=1  and id='" . $this->id . "'";

    $list = $this->query_list($query);
    if (count($list) == 0) {
      return false;
      exit();
    } else {
      return $list;
      exit();
    }
  }
  function getRecordByIdUser()
  {
    $query =
      "SELECT * FROM subcategory where status=1 and active_status='1' and id='" .
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

  function getCategory($catid)
  {
    $query =
      "SELECT * FROM subcategory where status=1 and active_status='1' and id='" .
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
  function getCategoryData($catid)
  {
    $query = "SELECT * FROM subcategory where status=1 and active_status='1' and id='$this->id'";
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
  function getCategoryData1($catid)
  {
    $where = "";

    $query = "SELECT * from subcategory where id='$catid' and status=1 and active_status='1'";

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

    $query = "SELECT * from subcategory where masterCategoryId='$catid' and status=1 and active_status='1'";

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
  function getData()
  {
    $where = "";

    $query = "SELECT * from subcategory where status='1'";

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

  function getDataUser()
  {
    $where = "";

    $query = "SELECT * from subcategory where status='1' && active_status='1'";

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
  function getDataDown()
  {
    $where = "";

    $query =
      "SELECT * from subcategory where position=1 and  status='1' && active_status='1'";

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
  function getDataUp()
  {
    $where = "";

    $query =
      "SELECT * from subcategory where position=0 and  status='1' && active_status='1'";

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

  function countData()
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
  function addRecord()
  {
    $sql =
      "INSERT INTO subcategory(name,masterCategoryId,addeddate) 
		  VALUES 
		  ('" .
      $this->f($this->name) .
      "',
      '$this->masterCategoryId',
      '" .
      $this->f($this->addeddate) .
      "')";

    $result = mysqli_query($this->con, $sql);
    if ($result) {
      return true;
    }
  }

  function updateRecord()
  {
    $sql = "update subcategory set name='$this->name', masterCategoryId='$this->masterCategoryId', addeddate='$this->addeddate' where id='$this->id'";

    $result = mysqli_query($this->con, $sql);
    if ($result) {
      return true;
    }
  }

  function deleteRecord()
  {
    $result = mysqli_query(
      $this->con,
      "update subcategory set status=0, addeddate='$this->addeddate' where id='" .
        $this->id .
        "'"
    );
    if ($result) {
      return true;
    }
  }

  function change_active_status()
  {
    $result = mysqli_query(
      $this->con,
      "update subcategory set active_status='$this->active_status', addeddate='$this->addeddate' where id='" .
        $this->id .
        "'"
    );
    if ($result) {
      return true;
    }
  }
  function change_position_status()
  {
    $result = mysqli_query(
      $this->con,
      "update subcategory set position='$this->active_status', addeddate='$this->addeddate' where id='" .
        $this->id .
        "'"
    );
    if ($result) {
      return true;
    }
  }
} ?>