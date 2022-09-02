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

                    <?php
                    //get source data
                        if(isset($_GET['source'])){

                            $source = $_GET['source'];

                        }

                        else {

                            $source = '';

                        }
                        //switch statement
                        switch ($source){

                            case 'add_academic';
                            include "include/add_academic.php";
                            break;

                            case 'edit_academic';
                            include "include/edit_academic.php";
                            break;

                            default:
                            include "include/view_all_academic.php";
                            break;

                        }

                     ?>

                </div>

            </div>

<?php include "include/footer.php"; ?>


