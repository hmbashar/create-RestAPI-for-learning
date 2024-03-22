<?php 

include 'db.php';

header("content-type: application/json");

$request = $_SERVER['REQUEST_METHOD'];

switch ($request) {

    case 'GET':
        getmethod($connection);
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        postMethod($data, $connection);
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        putMethod($data, $connection);
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        deleteMethod($data, $connection);
        break;

    default:
        echo '{"message": "Hello World From Default Request"}';
        break;

}

//data read method
function getmethod($connection) {

    $sql = "SELECT * FROM bashar";

    $result = mysqli_query($connection, $sql);

    if(mysqli_num_rows($result) > 0) {
        $rows = array();
        while($r = mysqli_fetch_assoc($result)) {
            $rows[] = $r;
        }
        echo json_encode($rows);
    }else {
        echo "0 results";
    }

}


//data insert method
function postMethod($data, $connection) {

    $name = $data['name'];
    $email = $data['email'];

 
     $sql = "INSERT INTO bashar (name, email, created_date) VALUES ('".$name."', '".$email."', NOW())";

    if (mysqli_query($connection, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }

}

//data edit method
function putMethod($data, $connection) {


    $name = $data["name"];
    $email = $data["email"];
    $id = $data["id"];


    $sql = "UPDATE bashar SET name = '$name', email = '$email', created_date = NOW() WHERE id = $id";

    if (mysqli_query($connection, $sql)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($connection);
    }

}

//data delete method
function deleteMethod($data, $connection) {

    $id = $data["id"];

    $sql = "DELETE FROM bashar WHERE id = $id";

    if (mysqli_query($connection, $sql)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($connection);
    }

}