<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

?>
    <script language="javascript" type="text/javascript">
        function f2() {
            window.close();
        }
        ser

        function f3() {
            window.print();
        }
    </script>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>User Profile</title>
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
        <script language="javascript" type="text/javascript">
            var popUpWin = 0;

            function popUpWindow(URLStr, left, top, width, height) {
                if (popUpWin) {
                    if (!popUpWin.closed) popUpWin.close();
                }
                popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width=' + 500 + ',height=' + 600 + ',left=' + left + ', top=' + top + ',screenX=' + left + ',screenY=' + top + '');
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

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800"><?php echo $row['fullName']; ?>'s profile</h1>
                            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                        </div>

                        <!-- Content Row -->
                        <div class="row">
                            <form name="updateticket" id="updateticket" method="post">
                                <table class="table table-hover datatable-1 table table-bordered table-striped display" width="100%">

                                    <tbody>

                                        <?php

                                        $ret1 = mysqli_query($con, "select * FROM users where id='" . $_GET['uid'] . "'");
                                        while ($row = mysqli_fetch_array($ret1)) {
                                        ?>
                                            <tr>
                                                <td><b>Complaint Number</b></td>
                                                <td><?php echo $row['complaintNumber']; ?></td>
                                                <td><b>Complainant Name</b></td>
                                                <td> <?php echo $row['name']; ?></td>
                                                <td><b>Reg Date</b></td>
                                                <td><?php echo $row['regDate']; ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><b>Category </b></td>
                                                <td><?php echo $row['catname']; ?></td>
                                                <td><b>SubCategory</b></td>
                                                <td> <?php echo $row['subcategory']; ?></td>
                                                <td><b>Complaint Type</b></td>
                                                <td><?php echo $row['complaintType']; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>State </b></td>
                                                <td><?php echo $row['state']; ?></td>
                                                <td><b>Nature of Complaint</b></td>
                                                <td colspan="3"> <?php echo $row['noc']; ?></td>

                                            </tr>
                                            <tr>
                                                <td><b>Complaint Details </b></td>

                                                <td colspan="5"> <?php echo $row['complaintDetails']; ?></td>

                                            </tr>

                                            </tr>
                                            <tr>
                                                <td><b>File(if any) </b></td>

                                                <td colspan="5"> <?php $cfile = $row['complaintFile'];
                                                                    if ($cfile == "" || $cfile == "NULL") {
                                                                        echo "File NA";
                                                                    } else { ?>
                                                        <a href="complaintdocs/<?php echo $row['complaintFile']; ?>" ?> View File</a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php $ret = mysqli_query($con, "select complaintremark.remark as remark,complaintremark.status as sstatus,complaintremark.remarkDate as rdate from complaintremark join tblcomplaints on tblcomplaints.complaintNumber=complaintremark.complaintNumber where complaintremark.complaintNumber='" . $_GET['cid'] . "'");
                                            while ($rw = mysqli_fetch_array($ret)) {
                                            ?>
                                                <tr>
                                                    <td><b>Remark</b></td>
                                                    <td colspan="5"><?php echo  $rw['remark']; ?> <b>Remark Date <?php echo  $rw['rdate']; ?></b></td>
                                                </tr>

                                                <tr>
                                                    <td><b>Status</b></td>
                                                    <td colspan="5"><?php echo  $rw['sstatus']; ?></td>
                                                </tr>
                                            <?php } ?>

                                            <tr>
                                                <td><b>Final Status</b></td>

                                                <td colspan="5"><?php if ($row['status'] == "") {
                                                                    echo "Not Process Yet";
                                                                } else {
                                                                    echo $row['status'];
                                                                } ?></td>

                                            </tr>



                                            <tr>
                                                <td><b>Action</b></td>

                                                <td>
                                                    <?php if ($row['status'] == "closed") {
                                                    } else { ?>
                                                        <a href="javascript:void(0);" onClick="popUpWindow('updatecomplaint.php?cid=<?php echo $row['complaintNumber']; ?>');" title="Update order">
                                                            <button type="button" class="btn btn-primary">Take Action</button>
                                                </td>
                                                </a><?php } ?></td>
                                            <td colspan="4">
                                                <a href="javascript:void(0);" onClick="popUpWindow('userprofile.php?uid=<?php echo $row['userId']; ?>');" title="Update order">
                                                    <button type="button" class="btn btn-primary">View User Detials</button></a>
                                            </td>

                                            </tr>
                                        <?php  } ?>

                                </table>
                            </form>
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


    </body>

    </html>
<?php } ?>