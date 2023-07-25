<?php

$conn = mysqli_connect('localhost','root',"",'youtubecrudoperation');

print_r($_POST);
if(isset($_POST['readRecord'])){
    $data = '<table class ="table table_bordered table-scriped">
                <tr>
                    <th>No.</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email Address</th>
                    <th>Mobile Number</th>
                    <th>Edit Action</th>
                    <th>Delete Action</th>
                </tr>';

    $displayquery = " SELECT * FROM `crudtable` ";
    $result = mysqli_query($conn,$displayquery);
    if (mysqli_num_rows($results)){
        $number = 1;
    }
}  


if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['mobile']) )
{
    $query = "INSERT INTO `crudtable`(`firstname`, `lastname`, `email`, `mobile`) VALUES ('$firstname', '$lastname', '$email', '$mobile') ";
    mysqli_query($conn,$query);
}