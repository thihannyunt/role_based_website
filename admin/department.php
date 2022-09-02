<?php include "include/header.php"; ?>



<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "include/sidebar.php"; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column" >

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include "include/topbar.php"; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="row">

                        <div class="col-lg-6">
                        
                            <div class="col-xs-6">


                                <?php 
                                //inserting data into database my clicking submit button
                                    if (isset($_POST['submit'])) 
                                    {
                                        $dept_name = $_POST['dept_name'];

                                        $query                   =  "INSERT INTO department(dept_name) VALUE ('{$dept_name}')";
                                        $create_department_query =  mysqli_query($connection, $query);

                                            if (!$create_department_query) {
                                                                        
                                            die('QUERY FAILED' . mysqli_error($connection));

                                            }

                                    }


                                 ?>
                                 <!-- category add tk form -->
                                <form action="" method="post"> 
                                    <div class="form-group">
                                        
                                        <label for="categoryname"><i class="fas fa-plus-circle"></i> Add Department</label>
                                        <input type="text" name=dept_name class="form-control" required>

                                    </div>

                                    <div class="form-group">
                                        
                                        <input class="btn btn-secondary" type="submit" name=submit value="Add Department">

                                    </div>
                                                        
                                </form> 

                            </div>

                            <?php 

                            if (isset($_GET['edit'])) {
                                    
                                    $dept_id  =  $_GET['edit'];
                                    include "include/update_department.php";

                                }

                             ?>


                            <div class="col-xs-6">

                                <table class="table table-bordered table-hover text-center text-dark">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Id</th>
                                            <th>Department Name</th>
                                            <th colspan='2'>Option</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php 
                                        global $connection;

                                        $query             =  "SELECT * FROM department";
                                        $select_department =  mysqli_query($connection, $query);
                                        //select from the database
                                            while($row = mysqli_fetch_assoc($select_department)){
                                                                            
                                                $dept_id   =  $row['dept_id'];
                                                $dept_name =  $row['dept_name'];

                                                echo "<tr>";
                                                    echo "<td> {$dept_id} </td>";
                                                    echo "<td> {$dept_name} </td>";
                                                    echo "<td> <a href='department.php?edit={$dept_id}'> <i class='fas fa-edit'></i> </a> </td>";
                                                    echo "<td> <a href='department.php?delete={$dept_id}'> <i class='fas fa-trash'></i> </a> </td>";
                                                echo "</tr>";
                                            }

                                         ?>


                                        <?php
                                        //department delete code
                                        if (isset($_GET['delete'])) {

                                            $delete_department_id = $_GET['delete'];

                                            $idea_query    =  "SELECT * FROM users WHERE dept_id = {$delete_department_id}";
                                            $select_ideas  =  mysqli_query($connection, $idea_query);

                                                while ($row =mysqli_fetch_assoc($select_ideas)) {

                                                     $user_user_id = $row['user_id'];

                                                }

                                                    if (mysqli_num_rows($select_ideas) == 0) {

                                                        $query         =  "DELETE FROM department WHERE dept_id = {$delete_department_id}";
                                                        $delete_query  =  mysqli_query($connection, $query);

                                                        echo "<script>window.location.href='department.php'</script>";
                                                    }

                                                    else
                                                    {
                                                         echo "<script>alert('This department name is used to create user account')</script>";
                                                         echo "<script>window.location='department.php'</script>";
                                                    }

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
      

            