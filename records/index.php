<?php include('../db.php'); 
header('Content-Type-application/json');
header('Acess-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if(isset($_GET['id']) && !empty($_GET['id'])){
        //$data = json_decode(file_get_contents("php://input"), true);
        //$id = $_GET['id'];
        $student_id = $_GET['id'];
        $sql = "SELECT * FROM `students` WHERE `sno` = {$student_id}";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if($count>0){
            while($row=mysqli_fetch_assoc($res)){
                $arr[]=$row;
            }
            echo json_encode(['status'=>true, 'data'=>$arr, 'result'=>'found']);
        }
        else{
            echo json_encode(['status'=>true, 'data'=>'No data found', 'result'=>'not found']);
        }
    }
    else{
    $sql = "SELECT * FROM `students`";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if($count>0){
        while($row=mysqli_fetch_assoc($res)){
            $arr[]=$row;
        }
        echo json_encode(['status'=>true, 'data'=>$arr, 'result'=>'found']);
    }
    else{
        echo json_encode(['status'=>true, 'data'=>'No data found', 'result'=>'not found']);
    }
}
}

// if(isset($_GET['id']) && !empty($_GET['id'])){
//     //$data = json_decode(file_get_contents("php://input"), true);
//     //$id = $_GET['id'];
//     $student_id = $_GET['id'];
//     echo $student_id;
//     $sql = "SELECT * FROM `students` WHERE `sno` = {$student_id}";
    
//     $res = mysqli_query($conn, $sql);
//     $count = mysqli_num_rows($res);
//     if($count>0){
//         while($row=mysqli_fetch_assoc($res)){
//             $arr[]=$row;
//         }
//         echo json_encode(['status'=>true, 'data'=>$arr, 'result'=>'found']);
//     }
//     else{
//         echo json_encode(['status'=>true, 'data'=>'No data found', 'result'=>'not found']);
//     }
// }

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $data = json_decode(file_get_contents("php://input"), true);
    $name = $data['name'];
    $email = $data['email'];
    $rollno = $data['rollno'];
    $subject = $data['subjects'];

    $sql = "INSERT INTO `students` (`name`, `email`, `rollno`, `subjects`) VALUES ('$name', '$email', '$rollno', '$subject')";

    $res = mysqli_query($conn, $sql);

    if($res){
        echo json_encode(['status'=>true, 'data'=>'Student Record Inserted', 'result'=>'not found']);
    }
    else{
        echo json_encode(['status'=>true, 'data'=>'Student Record Not Inserted', 'result'=>'not found']);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true);
    $sno = $data['sno'];
    $name = $data['name'];
    $email = $data['email'];
    $rollno = $data['rollno'];
    $subject = $data['subjects'];

    //$sql = "INSERT INTO `students` (`name`, `email`, `rollno`, `subjects`) VALUES ('$name', '$email', '$rollno', '$subject')";

    $sql = "UPDATE `students` SET `name` = '$name' , `email` = '$email', `rollno` = '$rollno', `subjects` = '$subject' WHERE `students`.`sno` = $sno";
    $res = mysqli_query($conn, $sql);

    if($res){
        echo json_encode(['status'=>true, 'data'=>'Student Record Updated', 'result'=>'not found']);
    }
    else{
        echo json_encode(['status'=>true, 'data'=>'Student Record Not Updated', 'result'=>'not found']);
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

    //if you want to pass json data on body 
    //$data = json_decode(file_get_contents("php://input"), true);
    //$student_id = $data['sno'];

    // if you want it direct using get request
    $student_id = $_GET['id'];
    $sql = "DELETE FROM `students` WHERE `sno` = {$student_id}";
    $res = mysqli_query($conn, $sql);
    // $count = mysqli_num_rows($res);

    if($res){
        echo json_encode(['status'=>true, 'data'=>'Stuent Record Deleted', 'result'=>'found']);
    }
    else{
        echo json_encode(['status'=>true, 'data'=>'Stuent Record Not Deleted', 'result'=>'not found']);
    }
}

?>