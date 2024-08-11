<?php
include('include/config.php');
session_start();
$user_id = $_SESSION['user_id'];



if (isset($_POST['submit'])) {
    $fname = $_POST['fullname'];
    $contactno = $_POST['contactno'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $district = $_POST['district'];
    $municipal = $_POST['municipal'];
    $wardno = $_POST['wardno'];
    $tole = $_POST['tole'];
    $pincode = $_POST['pincode'];
    $file_name = $_FILES['user_img']['name'];
    $tempname = $_FILES['user_img']['tmp_name'];
    $folder = 'assets/images/' . $file_name; // Added a trailing slash

    $query = mysqli_query($con, "UPDATE users SET fullName='$fname',contactNo='$contactno',country='$country',State='$state',districtName='$district',userImage='$file_name',municipalName='$municipal',wardno='$wardno',address='$tole',pincode='$pincode' where id = '$user_id'");

    if ($query) {
        if (move_uploaded_file($tempname, $folder)) {
            $successmsg = "Profile Successfully updated!!";
        } else {
            $errormsg = "Profile not updated, failed to move uploaded file!";
        }
    } else {
        $errormsg = "Profile not updated, database query failed!";
    }
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

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include('include/sidebar.php'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include('include/navbar.php'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">



                    <!-- Content Row -->
                    <div class="row">
                        <!-- [ form-element ] start -->
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Profile</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-10">


                                            <?php

                                            $select = mysqli_query($con, "select * FROM users where id='$user_id'");
                                            if (mysqli_num_rows($select) > 0) {
                                                $get = mysqli_fetch_assoc($select);
                                            }
                                            ?>
                                            <br />

                                            <form method="post" name="profile" enctype="multipart/form-data">
                                                <div class="form-group row">
                                                    <div class="col-md-5">

                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="exampleInputEmail1">Photo </label>
                                                        <img src="assets/images/<?= $get['userImage'] ?>" id="preview"  width="200" height="200" alt="">

                                                        <input type="file" name="user_img"id="upload" class=" form-control" required>
                                                    </div>
                                                    <div class="col-md-5">

                                                    </div>
                                                </div>
                                                <hr>

                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Full Name</label>
                                                        <input type="text" name="fullname" value="<?php echo  $get['fullName']; ?>" class=" form-control" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">UserEmail</label>
                                                        <input type="text" name="useremail" value="<?php echo $get['userEmail'] ?>" class=" form-control" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Contact No</label>
                                                        <input type="text" name="contactno" value="<?php echo $get['contactNo'] ?>" class=" form-control" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">

                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Country</label>
                                                        <input type="text" placeholder="Enter Name" value="<?php echo $get['country'] ?>" name="country" class=" form-control" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Province Name</label>
                                                        <input type="text" placeholder="Enter  Name" value="<?php echo $get['State'] ?>" name="state" class=" form-control" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">District </label>
                                                        <input type="text" name="district" value="<?php echo $get['districtName'] ?>" class=" form-control" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">

                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Municipality</label>
                                                        <input type="text" placeholder="Enter Name" value="<?php echo $get['municipalName'] ?>" name="municipal" class=" form-control" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Ward No</label>
                                                        <input type="text" placeholder="Enter  Name" value="<?php echo $get['wardNo'] ?>" name="wardno" class=" form-control" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Tole</label>
                                                        <input type="text" placeholder="Enter  Name" value="<?php echo $get['address'] ?>" name="tole" class=" form-control" required>
                                                    </div>


                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Pin Code</label>
                                                        <input type="text" placeholder="Enter  Name" value="<?php echo $get['pincode'] ?>" name="pincode" class=" form-control" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">RegDate</label>
                                                        <input type="text" placeholder="Enter  Name" value="<?php echo $get['regDate'] ?>" name="regdates" class=" form-control" required>
                                                    </div>
                                                    <div class="col-md-4">

                                                    </div>



                                                </div>



                                                <button type="submit" class="btn  btn-primary" name="submit">Update Profile</button>

                                            </form>
                                        </div>


                                    </div>
                                    <hr>


                                </div>
                            </div>

                        </div>
                        <!-- [ form-element ] end -->
                    </div>

                    <!-- Content Row -->



                    <!-- Content Row -->


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../index.php">Logout</a>
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

    <!-- Page level plugins -->
    <script src="assets/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js/demo/chart-area-demo.js"></script>
    <script src="assets/js/demo/chart-pie-demo.js"></script>
    <script>
        $(document).ready(function() {
            $('.datatable-1').dataTable();
            $('.dataTables_paginate').addClass("btn-group datatable-pagination");
            $('.dataTables_paginate > a').wrapInner('<span />');
            $('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
            $('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
        });
    </script>
    <script>
  document.getElementById('upload').addEventListener('change', function(event) {
    var file = event.target.files[0];
    var reader = new FileReader();

    reader.onload = function(event) {
      var img = new Image();
      img.src = event.target.result;
      img.onload = function() {
        var preview = document.getElementById('preview');
        preview.innerHTML = '';
        preview.appendChild(img);
      };
    };

    reader.readAsDataURL(file);
  });
</script>

</body>

</html>