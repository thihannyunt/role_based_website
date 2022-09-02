<div class="text-dark">
<h2 class="h5 text-dark mb-3"><i class="fas fa-user"></i> View All Users</h2>
<table class="table table-bordered table-hover table-responsive text-dark text-center">
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
                <th colspan="2">Option</th>
            </tr>
        </thead>

        <tbody>
            <?php
                global $connection;
                $query        =  "SELECT * FROM users";
                $select_users =  mysqli_query($connection, $query);
                //select data from users table for the table
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

                            echo "<td><a href='user.php?source=edit_user&u_id={$user_id}'> <i class='fas fa-edit'></i> </a> </td>";

                            echo "<td><a href='user.php?delete={$user_id}'> <i class='fas fa-trash'></i> </a> </td>";

                                }

                        echo "</tr>";
                    }
             ?>

        </tbody>

</table>

<?php //delete code

    if (isset($_GET['delete'])) {
        
        $the_user_id = $_GET['delete'];

        $delete_user_query =  mysqli_query($connection, "DELETE FROM users WHERE user_id = {$the_user_id}");

        $delete_ideas      = mysqli_query($connection, "DELETE FROM ideas WHERE user_id = {$the_user_id}");

        echo "<script>window.location.href='user.php'</script>";

    }

 ?>
</div>