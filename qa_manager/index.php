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

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h4 mb-0 text-dark font-weight-bold" ><i class="fas fa-home"></i> Dashboard</h1>
                    </div>

                    <div>
                        <?php
                        //select academic year for the header
                        $select_academic_year    =  mysqli_query($connection, "SELECT * FROM academic_year WHERE action='active'");
                        $row                     =  mysqli_fetch_array($select_academic_year);

                        $academic_closure_date   =  $row['start_date'];
                        $academic_closure_date   =  $row['closure_date'];
                        $academic_f_closure_date =  $row['final_closure_date'];

                        ?>
                        <div class="text-center h4">
                            Staff can post ideas before <strong> &nbsp;<i class="fas fa-calendar-alt"></i> <?php echo $academic_closure_date ?></strong>
                            but comments can be made on the ideas until <strong> &nbsp;<i class="fas fa-calendar-alt"></i> <?php echo $academic_f_closure_date ?></strong>
                        </div>
                        <br>

                    </div>
                    <?php
                    $select_ideas  =  mysqli_query($connection, "SELECT idea_id FROM ideas");
                    $idea_num_rows =  mysqli_num_rows($select_ideas);

                        if ($idea_num_rows == 0){

                            echo "<center><h4>There is no ideas right now</h4></center>";

                        }
                    else{

                    ?>
                    <!--table for ideas count, ideas percentage and ideas contributed by each department-->
                    <table class="table table-bordered table-hover table-responsive-sm text-dark text-center">
                        <thead class="thead-light">
                            <tr>

                                <th>Department Name</th>
                                <th>Ideas Count</th>
                                <th>Ideas Percentage</th>
                                <th>Ideas Contributer</th>

                            </tr>
                        </thead>

                        <tbody>

<?php
    // coding for getting ideas count, ideas percentage and ideas contributer

    $temp_user_id       =  null;
    $total_user_count   =  null;

    $select_all_ideas   =  mysqli_query($connection,"SELECT * FROM ideas");
    $total_ideas_count  =  mysqli_num_rows($select_all_ideas);
    $select_dept        =  mysqli_query($connection, "SELECT * FROM department");

        while($row = mysqli_fetch_array($select_dept)){

            $row_dept_id    =  $row['dept_id'];
            $row_dept_name  =  $row['dept_name'];

            $select_dept_ideas  =  mysqli_query($connection,"SELECT ideas.dept_id, ideas.idea_likes, ideas.idea_comment_count, ideas.user_id, department.dept_id, department.dept_name 
                                                                    FROM ideas 
                                                                    LEFT JOIN department 
                                                                    ON ideas.dept_id = department.dept_id 
                                                                    WHERE department.dept_id = $row_dept_id");



                while($user_row  =  mysqli_fetch_array($select_dept_ideas)){

                    global $temp_user_id;
                    global $total_user_count;

                    $user_id  =  $user_row['user_id'];

                        if ($total_user_count  ==  null){

                            ++$total_user_count;

                        }
                        if (is_null($temp_user_id)){

                            $temp_user_id  =  $user_id;

                        }
                        if($user_id !=  $temp_user_id){

                            ++$total_user_count;
                            $user_id  =  $temp_user_id;

                        }
                }

                if(is_null(mysqli_num_rows($select_dept_ideas))){

                    $zero =  0;

                }

                else{

                    $zero =  mysqli_num_rows($select_dept_ideas);

                }

                $percentage =  ($zero*100)/$total_ideas_count;
                $percentage =  (round($percentage,2));



            echo "<tr>";

                echo "<td>{$row_dept_name}</td>";
                echo "<td>{$zero}</td>";
                echo "<td>{$percentage}%</td>";
                echo "<td> {$total_user_count} </td>";

            echo "</tr>";

        $total_user_count  =  0;
        $temp_user_id      =  null;

    }
?>
                      </tbody>

                    </table>
                    <?php } ?>
                </div>

            </div>

<?php include "include/footer.php"; ?>
      

            