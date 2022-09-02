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
            if(isset($_GET['source'])){

                $source = $_GET['source'];

            }

            else {

                $source = '';

            }
            //creating source condition
            switch ($source){


                case 'view_user_details';
                include "include/view_user_details.php";
                break;


                default:
                include "include/view_all_user.php";
                break;

            }


            ?>

        <?php include "include/footer.php"; ?>



