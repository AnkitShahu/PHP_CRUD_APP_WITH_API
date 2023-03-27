<?php

$conn = mysqli_connect("localhost", "root", "", "students");

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
// else{
//     echo "connect Success";
// }
?>