<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h1 class="text-primary text-uppercase text-center"> AJAX CRUD OPERATION</h1>
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Open modal</button>
        </div>
        <h2 class="text-danger">All Records </h2>
        <div id="records_contant"></div>


        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <form id="addform">
                    <div class="modal-content">
    
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">AJAX CRUD OPERATION</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
    
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Firstname: </label>
                                <input type="text" name="" id="firstname" class="form-control" placeholder="First Name" value = "ewf">
                            </div>
                            <div class="form-group">
                                <label>Lastname: </label>
                                <input type="text" name="" id="lastname" class="form-control" placeholder="Last Name" value = "ewf">
                            </div>
                            <div class="form-group">
                                <label>Email Id: </label>
                                <input type="email" name="" id="email" class="form-control" placeholder="Email" value = "ewf">
                            </div>
                            <div class="form-group">
                                <label>mobile: </label>
                                <input type="text" name="" id="mobile" class="form-control" placeholder="Mobile number" value = "345">
                            </div>
                        </div>
    
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="addRecord()">SAVE</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
    
                    </div>
                </form> 
            </div>
        </div>

        <!-- update model -->
        <div class="modal" id="update_user_modal">
            <div class="modal-dialog">
                <form id="addform">
                    <div class="modal-content">
    
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">AJAX CRUD OPERATION</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
    
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="form-group">
                                <label for = "update_firstname"> update_Firstname: </label>
                                <input type="text" id="update_firstname" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for = "update_lastname"> update_Lastname: </label>
                                <input type="text" id="update_lastname" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for = "update_email"> update_Email: </label>
                                <input type="email" id="update_email" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for = "update_mobile"> update_Mobile: </label>
                                <input type="text" id="update_mobile" class="form-control" >
                            </div>
                        </div>
    
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="updateuserdetail()">SAVE</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <input type="hidden" name ="" id = "hidden_user_id">
                        </div>
    
                    </div>
                </form> 
            </div>
        </div>
    </div>
        <script>
        $(document).ready(function() {
            readRecords();
        });
        function readRecords() {
            var readRecord = "readRecord";
            $.ajax({
                url: "backend1.php",
                type: "POST",
                data: {
                    readRecord:readRecord,
                },
                success: function(data, status) {
                    $('#records_contant').html(data);
                    // console.log(data);
                }
            })
        }

        function addRecord() {
            var firstname = $("#firstname").val();
            var lastname = $("#lastname").val();
            var email = $("#email").val();
            var mobile = $("#mobile").val();

            $.ajax({
                url: "backend1.php",
                type: "POST",
                data: {
                    firstname: firstname,
                    lastname: lastname,
                    email: email,
                    mobile: mobile,
        
                },
                success: function(data, status) {
                    addRecord();
                    // $('#records_contant').html(data);
                    // console.log(data);
                }
            });
        }
        //// delete record call
        function DeleteUser(deleteid){
            var conf = confirm("Are you sure you want to delete this record?");
            if(conf == true){
                $.ajax({
                    url:"backend1.php",
                    type: "POST",
                    data: {
                        deleteid: deleteid
                    },
                    success:function(data,status){
                        readRecords();
                    }
                });
            }
        }
        function GetUserDetails(id){
            $('#_hidden_user_id').val(id);
            $.post("backend1.php",{
                id:id
            },function(data,status){
                // console.log(data);
                $("#hidden_user_id").val(id);
                var user = JSON.parse(data);
                $('#update_firstname').val(user.firstname);
                $('#update_lastname').val(user.lastname);
                $('#update_email').val(user.email);
                $('#update_mobile').val(user.mobile);
            }
            );
        $('#update_user_modal').modal("show");
        }
        function updateuserdetail(){
            var firstnameupd = $("#update_firstname").val();
            var lastnameupd = $("#update_lastname").val();
            var emailupd = $("#update_email").val();
            var mobileupd = $("#update_mobile").val();
            var hidden_user_idupd = $("#hidden_user_id").val();
            console.log(hidden_user_idupd);
            $.post("backend1.php",{
                hidden_user_idupd:hidden_user_idupd,
                firstnameupd:firstnameupd,
                lastnameupd:lastnameupd,
                emailupd:emailupd,
                mobileupd:mobileupd
            },
            function(data,status){
                $('#update_user_modal').modal("hide");
                readRecords();
            }
            );
        }
    </script>
</body>

</html>