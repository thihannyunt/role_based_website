<div class="text-dark">
    <h2 class="h5 text-dark mb-3"><i class="fas fa-calendar-alt"></i> View All Academic Year</h2>
    <table class="table table-bordered table-hover text-center text-dark table-responsive-sm table-responsive-xl">
        <thead class="thead-light">
            <tr>
                <th>Academic Id</th>
                <th>Academic Year Name</th>
                <th>Start Date</th>
                <th>Closure Date</th>
                <th>Final Closure Date</th>
                <th colspan="2">Action</th>
                <th colspan="2">Option</th>

            </tr>
        </thead>

        <tbody>

        <?php
        global $connection;
        //select data from academic year table for show

        $query            =  "SELECT * FROM academic_year";
        $select_academic  =  mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_academic)) {

            $academic_id         =  $row['academic_id'];
            $start_date          =  $row['start_date'];
            $closure_date        =  $row['closure_date'];
            $final_closure_date  =  $row['final_closure_date'];
            $academic_year_name  =  $row['academic_year_name'];
            $action              =  $row['action'];

            echo "<tr>";

                echo "<td> $academic_id </td>";
                echo "<td> $academic_year_name </td>";
                echo "<td> $start_date </td>";
                echo "<td> $closure_date </td>";
                echo "<td> $final_closure_date </td>";
                echo "<td><a href='academic_year.php?action={$academic_id}'><i class='fas fa-check-circle'></i></a></td>";
                echo "<td> $action </td>";

                echo "<td><a href='academic_year.php?source=edit_academic&a_id={$academic_id}'><i class='fas fa-edit'></i></a></td>";

                echo "<td><a href='academic_year.php?delete={$academic_id}'> <i class='fas fa-trash'></i> </a> </td>";

            echo "</tr>";

        }
        ?>

        </tbody>

    </table>

    <?php
    //delete acdemic year code
    if (isset($_GET['delete'])) {

        $the_academic_id  =  $_GET['delete'];

        $select_academic  =  mysqli_query($connection, "SELECT * FROM academic_year WHERE academic_id = {$the_academic_id}");
        $row              =  mysqli_fetch_array($select_academic);

        $select_ideas     = mysqli_query($connection, "SELECT * FROM ideas WHERE academic_id = {$the_academic_id}");
        $select_ideas_rows = mysqli_num_rows($select_ideas);


        echo $action           =  $row['action'];

            if($action == 'active'){

                echo "<script>alert('You cannot delete the active academic year')</script>";
                echo "<script>window.location='academic_year.php?source=view_all_academic'</script>";

            }else if($select_ideas_rows > 0){

                echo "<script>alert('You cannot delete academic year which is used in ideas')</script>";
                echo "<script>window.location='academic_year.php?source=view_all_academic'</script>";

            }

            else{

                $query        =  "DELETE FROM academic_year WHERE academic_id = {$the_academic_id}";
                $delete_query =  mysqli_query($connection, $query);

                echo "<script>window.location.href='academic_year.php?source=view_all_academic'</script>";

            }

    }

    // update action button

    if (isset($_GET['action'])) {
        //get from action button
        $action_academic_id  =  $_GET['action'];


        //select to know current active academic year
        $select_academic_action  =  mysqli_query($connection, "SELECT * FROM academic_year WHERE action = 'active'");
        $action_row              =  mysqli_fetch_array($select_academic_action);
        $active_academic_id  =  $action_row['academic_id'];

//        $action_num_rows         =  mysqli_num_rows($select_academic_action);
////        $select_idea_academic    =  mysqli_query($connection, "SELECT * FROM ideas WHERE academic_id = {$action_academic_id}");

        $select_final_closure_date = mysqli_query($connection, "SELECT final_closure_date FROM academic_year WHERE academic_id = $action_academic_id");
        $f_c_row = mysqli_fetch_array($select_final_closure_date);

        $final_closure_date =  strtotime($f_c_row['final_closure_date']);
        $today              =  strtotime("now");

            if ($today>$final_closure_date){

                echo "<script>alert('You cannot active the academic year which final closure data is earlier than today date')</script>";

            }
            else{

                $change_active       =  mysqli_query($connection, "UPDATE academic_year SET action='' WHERE academic_id=$active_academic_id ");
                $update_active       =  mysqli_query($connection, "UPDATE academic_year SET action= 'active' WHERE academic_id=$action_academic_id ");
//
                echo "<script>window.location.href='academic_year.php?source=view_all_academic'</script>";

            }





    }

    ?>


</div>