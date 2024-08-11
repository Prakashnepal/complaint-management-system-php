<?php
include('include/config.php');
session_start();
$user_id = $_SESSION['user_id'];

// if (!isset($user_id)) {
//     header('location:user-login.php');
// }
if (isset($_POST['submit'])) {
    $uid = $_SESSION['user_id'];
    $category = $_POST['category'];
    $subcategory = $_POST['subcategory'];
    $complaintype = $_POST['complaintype'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $district = $_POST['district'];
    $municipal = $_POST['municipal'];
    $wardno = $_POST['wardno'];
    $tole = $_POST['tole'];
    $noc = $_POST['noc'];
    $complaintdetials = $_POST['complaindetails'];

    $file_name = $_FILES['file_name']['name'];
    $tempname = $_FILES['file_name']['tmp_name'];
    $folder = 'complaintdocs/' . $file_name; // Added a trailing slash

    $query = mysqli_query($con, "INSERT INTO tblcomplaints(userId,category,subcategory,complaintType,country,state,district,municipal,wardno,tole,noc,complaintDetails,complaintFile) values('$uid','$category','$subcategory','$complaintype','$country','$state','$district','$municipal','$wardno','$tole','$noc','$complaintdetials','$file_name')");
 if ($query) {
        if (move_uploaded_file($tempname, $folder)) {
            $successmsg = "Profile Successfully updated!!";
        } else {
            $errormsg = "Profile not updated, failed to move uploaded file!";
        }
    } else {
        $errormsg = "Profile not updated, database query failed!";
    }
    $sql = mysqli_query($con, "select complaintNumber from tblcomplaints  order by complaintNumber desc limit 1");
    while ($row = mysqli_fetch_array($sql)) {
        $cmpn = $row['complaintNumber'];
    }
    $complainno = $cmpn;
    echo '<script> alert("Your complain has been successfully filled and your complaintno is  "+"' . $complainno . '")</script>';
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
    <script>
        function getCat(val) {
            //alert('val');

            $.ajax({
                type: "POST",
                url: "getsubcat.php",
                data: 'catid=' + val,
                success: function(data) {
                    $("#subcategory").html(data);

                }
            });
        }
    </script>


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
                                    <h5>Register Complaint</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-10">
                                            

                                            <br />

                                            <form method="post" name="profile" enctype="multipart/form-data">


                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <label for="exampleInputEmail1">Category</label>
                                                        <select name="category" id="category" class="form-control" onChange="getCat(this.value);" required="">
                                                            <option value="">Select Category</option>
                                                            <?php $sql = mysqli_query($con, "select id,categoryName from category ");
                                                            while ($rw = mysqli_fetch_array($sql)) {
                                                            ?>
                                                                <option value="<?php echo ($rw['id']); ?>"><?php echo ($rw['categoryName']); ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="exampleInputEmail1">SubCategory</label>
                                                        <select name="subcategory" id="subcategory" class="form-control">
                                                            <option value="">Select Subcategory</option>
                                                        </select>

                                                    </div>

                                                </div>
                                                <div class="form-group row">

                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Country</label>
                                                        <input type="text" placeholder="Enter Name" name="country" class=" form-control" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Province Name</label>
                                                        <input type="text" placeholder="Enter  Name" name="state" class=" form-control" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">District </label>
                                                        <input type="text" name="district" class=" form-control" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">

                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Municipality</label>
                                                        <input type="text" placeholder="Enter Name" name="municipal" class=" form-control" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Ward No</label>
                                                        <input type="text" placeholder="Enter  Name" name="wardno" class=" form-control" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Tole</label>
                                                        <input type="text" placeholder="Enter  Name" name="tole" class=" form-control" required>
                                                    </div>


                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Complaint Type</label>
                                                        <select name="complaintype" class="form-control" required="">
                                                            <option value=" Complaint"> Complaint</option>
                                                            <option value="General Query">General Query</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Nature of Complaint</label>
                                                        <input type="text" name="noc" required="required" value="" required="" class="form-control">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Complaint Related Doc(if any) </label>
                                                        <input type="file" name="file_name" class="form-control" value="">
                                                    </div>

                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                    <label for="exampleInputEmail1">Complaint Details (max 2000 words) </label>
                                                    <textarea name="complaindetails" required="required" cols="10" rows="10" class="form-control" maxlength="2000"></textarea>
                                                    </div>
                                                </div>



                                                <button type="submit" class="btn  btn-primary" name="submit">Submit Complaint</button>

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

</body>

</html>