<?php include "include/header.php"; ?>



<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php include "include/sidebar.php"; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php include "include/topbar.php"; ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <div>

                    <?php

                        //select from the following data form database to make the header text.
                        $select_academic_year    =  mysqli_query($connection, "SELECT * FROM academic_year WHERE action='active'");
                        $row                     =  mysqli_fetch_array($select_academic_year);

                        $academic_start_date     =  $row['start_date'];
                        $academic_closure_date   =  $row['closure_date'];
                        $academic_f_closure_date =  $row['final_closure_date'];
                        $today_date              =  strtotime("now");

                    ?>

                    <div class="text-center h5">
                        <i class="fas fa-file-export"></i>
                        You can download all the data after <strong> <?php echo $academic_f_closure_date ?></strong>
                    </div>
                    <br>
                </div>

                <div>

                    <table class="table table-striped text-center ">
                        <thead class="table-dark">
                            <tr>
                                <th>Title</th>
                                <th>Download</th>
                            </tr>
                        </thead>


                    <tbody>
                    <tr>
                        <td>Attachment Files</td>
                        <td><a href="zip_download.php"><i class="fas fa-file-download fa-lg"></i> </a></td>

                    </tr>

                    <tr>
                        <td>Academic Year</td>
                        <td><a href="csv_download.php?data=academic_year"><i class="fas fa-file-download fa-lg"></i></a></td>
                    </tr>

                    <tr>
                        <td>Category</td>
                        <td><a href="csv_download.php?data=category"><i class="fas fa-file-download fa-lg"></i></a></td>
                    </tr>

                    <tr>
                        <td>Comments</td>
                        <td><a href="csv_download.php?data=comments"><i class="fas fa-file-download fa-lg"></i></a></td>
                    </tr>

                    <tr>
                        <td>Department</td>
                        <td><a href="csv_download.php?data=department"><i class="fas fa-file-download fa-lg"></i></a></td>
                    </tr>

                    <tr>
                        <td>Ideas</td>
                        <td><a href="csv_download.php?data=ideas"><i class="fas fa-file-download fa-lg"></i></a></td>
                    </tr>

                    <tr>
                        <td>Rating Info</td>
                        <td><a href="csv_download.php?data=rating_info"><i class="fas fa-file-download fa-lg"></i></a></td>
                    </tr>

                    <tr>
                        <td>Roles</td>
                        <td><a href="csv_download.php?data=roles"><i class="fas fa-file-download fa-lg"></i></a></td>
                    </tr>

                    <tr>
                        <td>Users</td>
                        <td><a href="csv_download.php?data=users"><i class="fas fa-file-download fa-lg"></i></a></td>
                    </tr>


                    </tbody>
                    </table>

                </div>

            </div>

        </div>

        <?php include "include/footer.php"; ?>




