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
                        if(isset($_GET['source'])){

                            $source = $_GET['source'];

                        }

                        else {

                            $source = '';

                        }

                        switch ($source){

                            case 'add_user';
                            include "include/add_user.php";
                            break;

                            case 'edit_user';
                            include "include/edit_user.php";
                            break;

                            case 'view_qa_coordinator';
                                include "include/view_qa_coordinator.php";
                                break;

                            case 'add_qa_coordinator';
                                include "include/add_qa_coordinator.php";
                                break;


                            default:

                            include "include/view_all_users.php";

                            break;

                        }


                     ?>


                    
                    
                </div>

            </div>

<?php include "include/footer.php"; ?>
      

            