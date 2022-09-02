<div class="container-fluid">



    <?php
    //get data from session
    if($_SESSION['dept_id']){

        $session_dept_id  =  $_SESSION['dept_id'];
        $session_role_id  =  $_SESSION['role_id'];
    }

    $select_department  =  mysqli_query($connection, "SELECT * FROM department WHERE dept_id = $session_dept_id ");
    $row                =  mysqli_fetch_array($select_department);
    $session_dept_name  =  $row['dept_name'];

    ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h5 mb-0 text-gray-800"><i class="fas fa-user"></i> Staff from <?php echo $session_dept_name; ?> </h1>
    </div>


    <table class="table table-bordered table-hover table-responsive-xl text-dark text-center">
        <thead class="thead-light">

            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Email</th>
                <th>Role</th>
                <th>Department</th>
                <th>Option</th>

            </tr>

        </thead>

        <tbody>
        <?php
        //select from users table to show
        global $connection;
        $query         =  "SELECT * FROM users WHERE dept_id = $session_dept_id AND role_id = 8";
        $select_users  =  mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_users)){

                $user_id        =  $row['user_id'];
                $username       =  $row['username'];
                $user_dob       =  $row['user_dob'];
                $user_gender    =  $row['user_gender'];
                $user_phone     =  $row['user_phone'];
                $user_address   =  $row['user_address'];
                $user_email     =  $row['user_email'];
                $user_password  =  $row['user_password'];
                $role_id        =  $row['role_id'];
                $dept_id        =  $row['dept_id'];

                    echo "<tr>";

                        echo "<td> $user_id </td>";
                        echo "<td> $username </td>";
                        echo "<td> $user_dob </td>";
                        echo "<td> $user_gender </td>";
                        echo "<td> $user_phone </td>";
                        echo "<td> $user_address </td>";
                        echo "<td> $user_email </td>";

                $query        =  "SELECT * FROM roles WHERE role_id= {$role_id}";
                $select_roles =  mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($select_roles)){

                        $role_id   =  $row['role_id'];
                        $role_type =  $row['role_type'];

                        echo "<td>{$role_type} </td>";

                    }

                $query        =  "SELECT * FROM department WHERE dept_id= {$dept_id}";
                $select_roles =  mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($select_roles)){

                        $dept_id   =  $row['dept_id'];
                        $dept_name =  $row['dept_name'];

                        echo "<td> $dept_name </td>";
                        echo "<td><a href='user.php?source=view_user_details&u_id={$user_id}'> <i class='fas fa-eye'></i> </a> </td>";

                    }

                    echo "</tr>";

            }
        ?>

        </tbody>

    </table>

</div>


