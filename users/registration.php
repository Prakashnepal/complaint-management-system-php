<?php
require_once('include/config.php');
// error_reporting(0);
if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $contactno = $_POST['contactno'];
    $status = 1;

    $select = mysqli_query($con, "SELECT * FROM users WHERE 'email' ='$email' AND password = '$password' ") or die ('query failed');

    if(mysqli_num_rows($select) > 0){
        $message[] = 'User Already Exist';
    }else{
        $query = mysqli_query($con, "INSERT INTO users(fullName,userEmail,password,contactNo,userImage,status) VALUES('$fullname','$email','$password','$contactno','images/default.png','$status')")  or die ('query failed');
        if ($query) {
            $message[] = "Registered Successfully !!";
            header('location:user-login.php');

          } else {
            $message[] = "Registered Failled !!";
          }
    }

   
    // $msg = "Registration successfull. Now You can login !";
    echo "<script>alert('Registration successfull. Now You can login');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="asserts/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <script>
        function userAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_availability.php",
                data: 'email=' + $("#email").val(),
                type: "POST",
                success: function(data) {
                    $("#user-availability-status1").html(data);
                    $("#loaderIcon").hide();
                },
                error: function() {}
            });
        }
    </script>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                          
                            <form class="user" method="POST">
<?php 
if(isset($message)){
    foreach($message as $message){
        echo '<div class="message">'.$message.'</div>';
    }
}
?>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-9 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" placeholder="Full Name" name="fullname" required="required" autofocus>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" placeholder="Email" id="email" onBlur="userAvailability()" name="email" required="required">
                                    <span id="user-availability-status1" style="font-size:12px;"></span>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" maxlength="10" name="contactno" placeholder="Contact no" required="required" autofocus>

                                </div>
                                <div class="form-group ">
                                    <input type="password" class="form-control form-control-user" required="required" name="password" placeholder="Password">
                                </div>


                                <button class="btn btn-primary btn-user btn-block " type="submit" name="submit" id="submit">
                                    Register Account
                                </button>
                                <hr>

                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="user-login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/jquery/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

</body>

</html>