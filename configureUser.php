<?php

/*
 *
 *
Admin
 *
 *
 */

require_once 'connection.php';

class User
{
  /* Member variables */
  public $id;
  public $name;
  public $phoneNumber;
  public $password;
  public $con;

  public function User()
  {
    $this->con = connectionDb();
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
    $i = 0;
    while ($row = mysqli_fetch_array($result)) {
      if ($row) {
        $returnArray[$i++] = $row;
      }
    }
    return $returnArray;
  }

  public function loginCheck()
  {
    $query =
      "SELECT * FROM users where phoneNumber='" .
      $this->phoneNumber .
      "' and password='" .
      $this->password .
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
  public function PhoneNumber()
  {
    $query =
      "SELECT * FROM users where phoneNumber='" . $this->phoneNumber . "' ";

    $list = $this->query_list($query);
    if (count($list) == 0) {
      return false;
      exit();
    } else {
      return $list;
      exit();
    }
  }

  public function getRecordById()
  {
    $query =
      "SELECT * FROM users where phoneNumber='" . $this->phoneNumber . "'";

    $list = $this->query_list($query);
    if (count($list) == 0) {
      return false;
      exit();
    } else {
      return $list;
      exit();
    }
  }

  public function getData($start, $records)
  {
    $start--;

    $start = $start * 10;

    $query =
      "SELECT * FROM users where username like '%" . $this->username . "%'  ";

    $list = $this->query_list($query);
    if (count($list) == 0) {
      return false;
      exit();
    } else {
      return $list;
      exit();
    }
  }
  public function getDataAdmin()
  {
    $query = "SELECT * FROM users ";

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
      "SELECT count(id) count FROM users where  username like '%" .
      $this->username .
      "%' ";

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
      "INSERT INTO users (name,phoneNumber,password)
		VALUES
		('" .
      $this->f($this->name) .
      "',
      '$this->phoneNumber',
		'$this->password'
		)";

    $result = mysqli_query($this->con, $sql);
    if ($result) {
      return true;
    }
  }

  public function updateRecord()
  {
    $sql =
      "update users set
		name ='" .
      $this->f($this->name) .
      "',
      phoneNumber = '$this->phoneNumber',
		password ='$this->password',
		where
		id = '$this->id' ";

    $result = mysqli_query($this->con, $sql);
    if ($result) {
      return true;
    }
  }

  public function updatePassword()
  {
    $sql = "update users set
		password ='$this->password'
		where
		phoneNumber = '$this->phoneNumber' ";

    $result = mysqli_query($this->con, $sql);
    if ($result) {
      return true;
    }
  }

  public function deleteRecord()
  {
    $result = mysqli_query(
      $this->con,
      "update users set status=0 where id='" . $this->id . "'"
    );
    if ($result) {
      return true;
    }
  }
}