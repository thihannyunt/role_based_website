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
            <?php


            global $connection;
            //get the data from session and start the process
            $the_user_id   =  $_SESSION['user_id'];

            $query         =  "SELECT * FROM users WHERE user_id = $the_user_id";
            $select_users  =  mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_users)) {

                    $user_id        =  $row['user_id'];
                    $username       =  $row['username'];
                    $user_dob       =  $row['user_dob'];
                    $user_gender    =  $row['user_gender'];
                    $user_phone     =  $row['user_phone'];
                    $user_address   =  $row['user_address'];
                    $user_email     =  $row['user_email'];
                    $user_password  =  $row['user_password'];
                    $user_role_id   =  $row['role_id'];
                    $user_dept_id   =  $row['dept_id'];

                }

            ?>

            <div class="container-fluid" >
            <h2 class="h5 text-dark mb-3"><i class="fas fa-user"></i> Profile</h2>
            <div class="card">
                <div class="card-header text-white" style="background-color: #3a4d4d;">
                    <i class="fas fa-user-lock"></i>
                    User Information
                </div>
                <div class="card-body">
                    <form action="" method="post" class="text-dark">

                        <!-- username -->
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-sm-2">
                                <label for="username" class="col-form-label">Username</label>
                            </div>
                            <div class="col-sm-8">

                                <?php echo $username; ?>

                            </div>
                        </div>

                        <!-- user date of birth -->
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-sm-2">
                                <label for="date_of_birth" class="col-form-label">Date Of Birth</label>
                            </div>
                            <div class="col-sm-8">

                                <?php echo $user_dob; ?>

                            </div>
                        </div>

                        <!-- user gender -->
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-sm-2">
                                <label for="gender" class="col-form-label">Gender</label>
                            </div>
                            <div class="col-sm-8">

                                <?php echo $user_gender; ?>

                            </div>
                        </div>

                        <!-- user phone -->
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-sm-2">
                                <label for="phone" class="col-form-label">Phone</label>
                            </div>
                            <div class="col-sm-8">

                                <?php echo $user_phone; ?>

                            </div>
                        </div>

                        <!-- user address -->
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-sm-2">
                                <label for="address" class="col-form-label">Address</label>
                            </div>
                            <div class="col-sm-8">

                                <?php echo $user_address; ?>

                            </div>
                        </div>

                        <!-- user email -->
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-sm-2">
                                <label for="email" class="col-form-label">Email</label>
                            </div>
                            <div class="col-sm-8">

                                <?php echo $user_email; ?>

                            </div>
                        </div>




                        <!-- user role -->
                        <div class="row g-3 align-items-center mb-3">

                            <div class="col-sm-2">
                                <label for="role" class="col-form-label">Role</label>
                            </div>

                            <div class="col-sm-8">

                                <?php

                                $select_role  =  mysqli_query($connection, "SELECT * FROM roles WHERE role_id =$user_role_id");
                                $row          =  mysqli_fetch_array($select_role);

                                    echo $row['role_type'];

                                ?>

                            </div>

                        </div>

                        <!-- user department id -->

                        <div class="row g-3 align-items-center mb-3">

                            <div class="col-sm-2">
                                <label for="role" class="col-form-label">Department</label>
                            </div>

                            <div class="col-sm-8">
                                <?php

                                $select_department =  mysqli_query($connection, "SELECT * FROM department WHERE dept_id =$user_dept_id");
                                $row               =  mysqli_fetch_array($select_department);

                                    echo $row['dept_name'];

                                ?>

                            </div>

                        </div>

                    </form>
                </div>
            </div>
            </div>

            <?php include "include/footer.php"; ?>






















