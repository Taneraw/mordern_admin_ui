<?php
function connectionDb()
{
  return mysqli_connect("localhost", "root", "", "krishnamdb");
  //return mysqli_connect("localhost", "root", "", "database");
}
?>