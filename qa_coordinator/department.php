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

                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h5 mb-0 text-gray-800"><i class="fas fa-pen"></i> Edit Department</h1>
                </div>

                <div class="row">

                    <div class="col-lg-6">

                        <div class="col-xs-6">


                            <?php
                                if (isset($_SESSION['dept_id'])) {

                                    $session_dept_id = $_SESSION['dept_id'];
                                }
                            ?>

                            <!-- category add tk form -->


                        </div>

                        <?php

                        if (isset($_GET['edit'])) {

                            $dept_id = $_GET['edit'];
                            include "include/update_department.php";

                        }

                        ?>


                        <div class="col-xs-6">


                            <table class="table table-bordered table-hover text-center text-dark">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Id</th>
                                        <th>Department Name</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>

                                <tbody>

                                <?php
                                global $connection;
                                $query = "SELECT * FROM department where dept_id = $session_dept_id";
                                $select_department = mysqli_query($connection, $query);


                                while ($row = mysqli_fetch_assoc($select_department)) {

                                    $dept_id = $row['dept_id'];
                                    $dept_name = $row['dept_name'];

                                    echo "<tr>";
                                    echo "<td> {$dept_id} </td>";
                                    echo "<td> {$dept_name} </td>";

                                    echo "<td> <a href='department.php?edit={$dept_id}'> <i class='fas fa-edit'></i> </a> </td>";

                                    echo "</tr>";
                                }

                                ?>


                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <?php include "include/footer.php"; ?>



