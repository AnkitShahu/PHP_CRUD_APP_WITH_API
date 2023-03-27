<?php 

$insert = false;
$update = false;
$delete = false;

include('../db.php');

if(isset($_GET['delete'])){
    $sno = $_GET['delete'];
    $delete = true;
    $sql = "DELETE FROM `students` WHERE `sno` = $sno";
    $result = mysqli_query($conn, $sql);
  }

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  if (isset( $_POST['snoEdit'])){
        // Update the record
      $sno = $_POST["snoEdit"];
      $name = $_POST["name"];
      $email = $_POST["email"];
      $rollno = $_POST["rollno"];
      $subject = $_POST["subject"];

    $sql = "UPDATE `students` SET `name` = '$name' , `email` = '$email', `rollno` = '$rollno', `subjects` = '$subject' WHERE `students`.`sno` = $sno";
    $result = mysqli_query($conn, $sql);
    if($result){
      $update = true;
  }
  else{
      //echo "We could not update the record successfully";
  }
  }
    $name = $_POST["name"];
    $email = $_POST["email"];
    $rollno = $_POST["rollno"];
    $subject = $_POST["subject"];

    // Sql query to be executed
    $sql = "INSERT INTO `students` (`name`, `email`, `rollno`, `subjects`) VALUES ('$name', '$email', '$rollno', '$subject')";
    $result = mysqli_query($conn, $sql);
    if($result){ 
        $insert = true;
    }
    else{
        echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
    } 
}
?> 


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Datatable</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit this Student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/crudapp/index.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
            <label for="exampleFormControlInput1" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name"
                                placeholder="Your Name">
            </div>
            <div class="form-group">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email"
                                placeholder="name@example.com" name="email">
            </div>
            <div class="form-group">
            <label for="exampleFormControlInput1" class="form-label">Roll No.</label>
                            <input type="text" class="form-control" id="rollno"
                                placeholder="Roll No." name="rollno">
            </div>

            <div class="form-group">
                            <label for="exampleFormControlTextarea1" class="form-label">Subjects</label>
                            <textarea class="form-control" name="subject" id="subject" rows="3"></textarea>
            </div> 
          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<!-- Main Form -->
    <div class="container my-3" >
        <div class="row">
<div class="notification">
            
  <?php
  if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been inserted successfully
    <button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been deleted successfully
    <button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been updated successfully
    <button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  </div>
            <div>
                <h1>Students Table</h1>
            </div>
            <div class="mb-3">
                <form action="/crudapp/index.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Your Name">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email"
                                placeholder="name@example.com" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Roll No.</label>
                            <input type="text" class="form-control" id="rollno"
                                placeholder="Roll No." name="rollno">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Subjects</label>
                            <textarea class="form-control" name="subject" id="subject" rows="3"></textarea>
                        </div>
                        <input type="submit" value="Submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
            <div>
                <h2>Students Data</h2>
            </div>
            <table class="table"  id="myTable">
                <thead>
                    <tr>
                        <th scope="col">Sr. No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Roll No</th>
                        <th scope="col">Subjects</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
          $sql = "SELECT * FROM `students`";
          $result = mysqli_query($conn, $sql);
          $sno = 0;
          while($row = mysqli_fetch_assoc($result)){
            $sno = $sno + 1;
            echo "<tr>
            <td scope='row'>". $sno . "</td>
            <td>". $row['name'] . "</td>
            <td>". $row['email'] . "</td>
            <td>". $row['rollno'] . "</td>
            <td>". $row['subjects'] . "</td>
            <td> <button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button>  </td>
          </tr>";
        } 
          ?>
                </tbody>
            </table>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>


<script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        name = tr.getElementsByTagName("td")[0].innerText;
        email = tr.getElementsByTagName("td")[1].innerText;
        roll = tr.getElementsByTagName("td")[2].innerText;
        sub = tr.getElementsByTagName("td")[3].innerText;
        name.value = name;
        console.log("mytile", name)
        email.value = email;
        rollno.value = roll;
        subject.value = sub;
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `/crudapp/index.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
  </script>
</body>

</html>