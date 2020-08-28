<?php

/*
*
*
	footer
*
*
*/

require_once 'connection.php';

class Footer
{
  /* Member variables */
  var $id;
  var $name;
  var $addeddate;
  var $status;
  var $con;
  var $company;
  var $email;
  var $number;
  var $address;
  var $privacy;
  var $tc;

  function Footer()
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

    $query = "SELECT name from footer where id='$catid' && status='1' && active_status='1' ";

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
    $query = "SELECT * FROM footer where    id='" . $this->id . "'";

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
      "SELECT * FROM footer where status=1 and active_status='1' and id='" .
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
      "SELECT * FROM footer where status=1 and active_status='1' and id='" .
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
    $query = "SELECT * FROM footer where status=1 and active_status='1' and id='$this->id'";
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

    $query = "SELECT * from footer where id='$catid' and status=1 and active_status='1'";

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

    $query = "SELECT * from footer ";

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

    $query = "SELECT * from footer where status='1' && active_status='1'";

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
      "SELECT * from footer where position=1 and  status='1' && active_status='1'";

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
      "SELECT * from footer where position=0 and  status='1' && active_status='1'";

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
    $sql = "INSERT INTO footer(tc,privacy,address,number,email,company) 
		  VALUES 
		  (
            '$this->tc',
            '$this->privacy',
            '$this->address',
            '$this->number',
            '$this->email',
            '$this->company'
          )";

    $result = mysqli_query($this->con, $sql);
    if ($result) {
      return true;
    }
  }

  function updateRecord()
  {
    $sql = "update footer set tc='$this->tc', privacy='$this->privacy' ,
     address='$this->address', number='$this->number', email='$this->email',
      company='$this->company' where id='$this->id'";

    $result = mysqli_query($this->con, $sql);
    if ($result) {
      return true;
    }
  }

  function deleteRecord()
  {
    $result = mysqli_query(
      $this->con,
      "update footer set status=0, addeddate='$this->addeddate' where id='" .
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
      "update footer set active_status='$this->active_status', addeddate='$this->addeddate' where id='" .
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
      "update footer set position='$this->active_status', addeddate='$this->addeddate' where id='" .
        $this->id .
        "'"
    );
    if ($result) {
      return true;
    }
  }
} ?>