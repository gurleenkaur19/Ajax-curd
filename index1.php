<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
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
                                <input type="text" name="" id="firstname" class="form-control" placeholder="First Name" value="abc">
                            </div>
                            <div class="form-group">
                                <label>Lastname: </label>
                                <input type="text" name="" id="lastname" class="form-control" placeholder="Last Name" value="abc">
                            </div>
                            <div class="form-group">
                                <label>Email Id: </label>
                                <input type="email" name="" id="email" class="form-control" placeholder="Email" value="abc">
                            </div>
                            <div class="form-group">
                                <label>mobile: </label>
                                <input type="text" name="" id="mobile" class="form-control" placeholder="Mobile number" value="1234">
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
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
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
                    readrecord: readRecord
                },
                success: function(data, status) {
                    $('#records_contant').html(data);
                }
            })
        }

        function addRecord() {
            var firstname = $("#firstname").val();
            var lastname = $("#lastname").val();
            var email = $("#email").val();
            var mobile = $("#mobile").val();

            console.log("hello");
            $.ajax({
                url: "backend1.php",
                type: "POST",
                data: {
                    fname: firstname,
                    lastname: lastname,
                    email: email,
                    mobile: mobile
                },
                success: function(data, status) {
                    // $('#records_contant').html(data);
                    console.log("Done");
                }
            });
        }
    </script>
</body>

</html>