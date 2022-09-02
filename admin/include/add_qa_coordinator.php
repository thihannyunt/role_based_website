
<?php



if (isset($_POST['create_user'])) {

    if (isset($_POST['user_gender']) == "") {

        echo "<script>alert('All options must choose')</script>";

    }
    else if (isset($_POST['role_type']) == "") {

        echo "<script>alert('All options must choose')</script>";

    }
    else if (isset($_POST['dept_name']) == "") {

        echo "<script>alert('All options must choose')</script>";

    }

    else if($_POST['role_type'] == 7){
        $the_dept_id =  $_POST['dept_name'];

        $select_users   =  mysqli_query($connection, "SELECT * FROM users WHERE role_id = 7 AND dept_id = $the_dept_id");
        $user_row_count =  mysqli_num_rows($select_users);

            if ($user_row_count > 0){

                echo "<script>alert('Each department must have only one QA Coordinator')</script>";

            } else{

                $username       =  $_POST['username'];
                $user_dob       =  $_POST['user_dob'];
                $user_gender    =  $_POST['user_gender'];
                $user_phone     =  $_POST['user_phone'];
                $user_address   =  $_POST['user_address'];
                $user_email     =  $_POST['user_email'];
                $user_password  =  $_POST['user_password'];
                $role_id        =  $_POST['role_type'];
                $dept_id        =  $_POST['dept_name'];


                $query             =  "INSERT INTO users(username, user_dob, user_gender, user_phone, user_address, user_email, user_password, role_id, dept_id)
                                       VALUES ('{$username}', '{$user_dob}','{$user_gender}','{$user_phone}','{$user_address}','{$user_email}', '{$user_password}', '{$role_id}', '{$dept_id}' )";
                $create_user_query =  mysqli_query($connection, $query);

                    if (!$create_user_query) {
                        die("QUERY FAILED" . mysqli_error($connection));
                    }

                echo "<script>alert('QA Coordinator added Successfully')
                           window.location.href='user.php?source=view_qa_coordinator'
                      </script>";
            }

    }

}

?>

<?php
$select_academic_id =  mysqli_query($connection, "SELECT academic_id FROM academic_year");
$academic_num_rows  =  mysqli_num_rows($select_academic_id);

    if ($academic_num_rows == 0){

        echo"<center><h4> Hey admin, add Academic Year First </h4></center>";
        ?>
        <center> <a href="academic_year.php?source=add_academic"><i class="fas fa-plus-circle fa-lg"></i></a> Academic Year</center>
        <?php

    }

else{
?>

    <div class="text-dark" >
    <h2 class="h5 text-dark mb-3"><i class="fas fa-user-edit"></i> Registration</h2>
    <div class="card">
        <div class="card-header text-white" style="background-color: #3a4d4d;">
            <i class="fas fa-pen"></i>
            &nbsp;Fill info
        </div>
        <div class="card-body">
            <form action="" method="post" class="text-dark">

            <!-- username -->
            <div class="row g-3 align-items-center mb-3">
                <div class="col-sm-2">
                    <label for="username" class="col-form-label">Username</label>
                </div>
                <div class="col-sm-8">
                    <input type="text" name="username" id="" class="form-control" required placeholder="Enter your name">
                </div>
            </div>

            <!-- user date of birth -->
            <div class="row g-3 align-items-center mb-3">
                <div class="col-sm-2">
                    <label for="date_of_birth" class="col-form-label">Date Of Birth</label>
                </div>
                <div class="col-sm-8">
                    <input type="date" name="user_dob" id="" class="form-control" required>
                </div>
            </div>

            <!-- user gender -->
            <div class="row g-3 align-items-center mb-3">
                <div class="col-sm-2">
                    <label for="gender" class="col-form-label">Gender</label>
                </div>
                <div class="col-sm-8">
                    <select name="user_gender" id="" class="form-control">

                        <option disabled selected>Please Select Gender</option>
                        <option name="user_gender" value="male">Male</option>
                        <option name="user_gender" value="female">Female</option>
                        <option name="user_gender" value="other">Other</option>

                    </select>
                </div>
            </div>

            <!-- user phone -->
            <div class="row g-3 align-items-center mb-3">
                <div class="col-sm-2">
                    <label for="phone" class="col-form-label">Phone</label>
                </div>
                <div class="col-sm-8">
                    <input type="text" name="user_phone" id="" class="form-control" required placeholder="Enter your phone">
                </div>
            </div>

            <!-- user address -->
            <div class="row g-3 align-items-center mb-3">
                <div class="col-sm-2">
                    <label for="address" class="col-form-label">Address</label>
                </div>
                <div class="col-sm-8">
                                                <textarea name="user_address" id="" cols="" rows="3"
                                                          class="form-control" required placeholder="Enter your address"></textarea>
                </div>
            </div>

            <!-- user email -->
            <div class="row g-3 align-items-center mb-3">
                <div class="col-sm-2">
                    <label for="email" class="col-form-label">Email</label>
                </div>
                <div class="col-sm-8">
                    <input type="email" name="user_email" id="" class="form-control" required placeholder="example@email.com">
                </div>
            </div>

            <!-- user password -->
            <div class="row g-3 align-items-center mb-3">
                <div class="col-sm-2">
                    <label for="password" class="col-form-label">Password</label>
                </div>
                <div class="col-sm-8">
                    <input type="password" name="user_password" id="" required class="form-control" placeholder="XXXXXXX">
                </div>
            </div>

            <!-- user role -->
            <div class="row g-3 align-items-center mb-3">

                <div class="col-sm-2">
                    <label for="role" class="col-form-label">Role</label>
                </div>

                <div class="col-sm-8">
                    <?php //role type ko add post mhr pw chin loz tone tk hr

                        global $connection;
                        $query        =  "SELECT * FROM roles WHERE role_id = 7";
                        $select_roles =  mysqli_query($connection, $query);
                        $row          =  mysqli_fetch_array($select_roles);

                        $role_id      =  $row['role_id'];
                        $role_type    =  $row['role_type'];

                    ?>

                    <select name="role_type" id="" class="form-control">
                        <?php //role type ko add post mhr pw chin loz tone tk hr

                        global $connection;
                        $query        =  "SELECT * FROM roles WHERE role_id = 7";
                        $select_roles =  mysqli_query($connection, $query);

                        $row = mysqli_fetch_assoc($select_roles);

                            $role_id   =  $row['role_id'];
                            $role_type =  $row['role_type'];

                            echo "<option value='$role_id'>{$role_type}</option>";

                        ?>

                    </select>

                </div>

            </div>

            <!-- user department id -->

            <div class="row g-3 align-items-center mb-3">

                <div class="col-sm-2">
                    <label for="role" class="col-form-label">Department</label>
                </div>

                <div class="col-sm-8">

                    <select name="dept_name" id="" class="form-control">
                        <?php //department type ko add post mhr pw chin loz tone tk hr

                        global $connection;
                        $query        =  "SELECT * FROM department";
                        $select_roles =  mysqli_query($connection, $query);

                        echo "<option disabled selected>Please Select Department</option>";

                        while ($row = mysqli_fetch_assoc($select_roles)) {

                            $dept_id   =  $row['dept_id'];
                            $dept_name =  $row['dept_name'];

                            echo "<option value='$dept_id'>{$dept_name}</option>";

                        }

                        ?>

                    </select>

                </div>

            </div>

            <div class="col-sm-6 col-sm-offset-4">

                <input type="submit" name="create_user" Value="Create User" class="btn btn-info">

            </div>

        </form>
    </div>
</div>
<?php } ?>