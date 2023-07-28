<?php

$conn = mysqli_connect('localhost','root',"",'youtubecrudoperation');

extract($_POST);
 
if(isset($_POST['readRecord'])){
    $data = ' <table class="table table-dark table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>firstname</th>
                        <th>lastname</th>
                        <th>email</th>
                        <th>mobile</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>';
                

    $displayquery = " SELECT * FROM `crudtable` ";
    $result = mysqli_query($conn,$displayquery);
    if (mysqli_num_rows($result) > 0) {
        $number = 1;
        while ($row = mysqli_fetch_array($result)) {
            $data .= '<tr>
                <td>' . $number++ . '</td>
                <td>' . $row['firstname'] . '</td>
                <td>' . $row['lastname'] . '</td>
                <td>' . $row['email'] . '</td>
                <td>' . $row['mobile'] . '</td>
                <td><button class="btn btn-warning" onclick="GetUserDetails(' . $row['id'] . ')">Edit</button></td>
                <td><button class="btn btn-danger" onclick="DeleteUser(' . $row['id'] . ')">Delete</button></td>
            </tr>';
        }
    }

    $data .= '</tbody></table>';
    echo $data;
}  


if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['mobile']) )
{
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $query = "INSERT INTO `crudtable`(`firstname`, `lastname`, `email`, `mobile`) VALUES ('$firstname', '$lastname', '$email', '$mobile') ";
    mysqli_query($conn,$query);
}
///delete user record
if(isset($_POST['deleteid'])){
    $userid = $_POST['deleteid'];
    $deletequery ="DELETE FROM `crudtable` WHERE id = '$userid'";
    mysqli_query($conn,$deletequery);
}
if (isset($_POST['id']) && isset($_POST['id']) != "")
{
    $user_id = $_POST['id'];
    $query = "SELECT * FROM `crudtable` WHERE id = '$user_id'";
    if (!$result = mysqli_query($conn, $query)) {
        exit();
}
$response = array();
if (mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $response = $row;
    }
}
else{
    $response['status']=200;
    $response ['messsage'] = "data not found";
}
echo json_encode ($response);

}
else{
    $response['status'] = 200;
    $response['messsage'] = "invalid request";
}
///update table
if(isset($_POST['hidden_user_idupd'])){
    // print_r($_POST);
    $hidden_user_idupd = $_POST['hidden_user_idupd'];
    $firstnameupd = $_POST['firstnameupd'];
    $lastnameupd = $_POST['lastnameupd'];
    $emailupd = $_POST['emailupd'];
    $mobileupd = $_POST['mobileupd'];

    $query = "UPDATE `crudtable` SET `firstname` = '$firstnameupd', `lastname` = '$lastnameupd', `email` = '$emailupd', `mobile` = '$mobileupd' WHERE id = '$hidden_user_idupd'";
    mysqli_query($conn,$query);
}
?>