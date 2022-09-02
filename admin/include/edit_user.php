<?php 

    
    //post.php mhr shi tk view button mhr link ko id nae twel pee htae htr tl
    //ak d kg ko get (super global) method nae hlan u lite tl
    if (isset($_GET['u_id'])) {
        
        global $connection; //database tone m ya mhr soe loz global htr lite tl

        $the_user_id = ($_GET['u_id']);

        $query = "SELECT * FROM users WHERE user_id = $the_user_id";
        $select_users= mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_users)){
                                        
            $user_id= $row['user_id'];
            $username= $row['username'];
            $user_dob= $row['user_dob'];
            $user_gender= $row['user_gender'];
            $user_phone= $row['user_phone'];
            $user_address= $row['user_address'];                                        
            $user_email= $row['user_email'];
            $user_password= $row['user_password'];
            $user_role_id= $row['role_id'];
            $user_dept_id= $row['dept_id'];

        }

    }

 ?>

 <?php 

    

    if (isset($_POST['update_user'])) {
        

        $the_username= $_POST['username'];
        $the_user_dob= $_POST['user_dob'];
        $the_user_gender= $_POST['user_gender'];
        $the_user_phone= $_POST['user_phone'];
        $the_user_address= $_POST['user_address'];
        $the_user_email= $_POST['user_email'];
        $the_user_password= $_POST['user_password'];
        $the_role_id= $_POST['role_type'];
        $the_dept_id= $_POST['dept_name'];
      
        
        $query= "UPDATE users SET
                username      = '{$the_username}',
                user_dob      = '{$the_user_dob}', 
                user_gender   = '{$the_user_gender}',
                user_phone    = '{$the_user_phone}',
                user_address  = '{$the_user_address}',
                user_email    = '{$the_user_email}',
                user_password = '{$the_user_password}',
                role_id       = '{$the_role_id}',
                dept_id       = '{$the_dept_id}'

                WHERE user_id = '{$the_user_id}'";


        $create_user_update_query =mysqli_query($connection, $query);
        
            if (!$create_user_update_query) {
                die("QUERY FAILED" . mysqli_error($connection));
            }

        echo "<script>window.location.href='user.php?source=edit_user&u_id={$the_user_id}'</script>";
        

        echo "User Edited: " . " " . " <a href='user.php'>View Users<a/> ";

    }

 ?>

<div class="text-dark">
<h2 class="h5 text-dark mb-3"><i class="fas fa-user-edit"></i> User Information</h2>
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
                        <input value=<?php echo $username; ?>   type="text" name="username" id="" class="form-control" required placeholder="Enter your name">
                    </div>
                </div>

                <!-- user date of birth -->
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-sm-2">
                        <label for="date_of_birth" class="col-form-label">Date Of Birth</label>
                    </div>
                    <div class="col-sm-8">
                        <input value=<?php echo $user_dob; ?> type="date" name="user_dob" id="" class="form-control" required>
                    </div>
                </div>

                <!-- user gender -->
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-sm-2">
                        <label for="gender" class="col-form-label">Gender</label>
                    </div>
                    <div class="col-sm-8">
                        <select name="user_gender" id="" class="form-control">
                            <!-- value mhr ll php tag pwint pee yay lite tl, pee tot option mhr selected value pw chin loz echo nae pya tl -->
                            <option value= <?php echo $user_gender; ?> > <?php echo $user_gender; ?> </option> 
                            <?php 

                                if ($user_gender == 'male') {

                                    echo "<option value='female'>female</option>";
                                    echo "<option value='other'>other</option>";
                                }

                                else if ($user_gender == 'female') {

                                    echo "<option value='male'>male</option>";
                                    echo "<option value='other'>other</option>";
                                }
                                else {

                                    echo "<option value='male'>male</option>";
                                    echo "<option value='female'>female</option>";
                                }

                            ?>

                        </select>
                    </div>
                </div>

                <!-- user phone -->
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-sm-2">
                        <label for="phone" class="col-form-label">Phone</label>
                    </div>
                    <div class="col-sm-8">
                        <input value=<?php echo $user_phone; ?> type="text" name="user_phone" id="" class="form-control" required placeholder="Enter your phone">
                    </div>
                </div>

                <!-- user address -->
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-sm-2">
                        <label for="address" class="col-form-label">Address</label>
                    </div>
                    <div class="col-sm-8">
                        <textarea name="user_address" id="" cols="" rows="3"
                                  class="form-control" required placeholder="Enter your address"><?php echo $user_address; ?></textarea>
                    </div>
                </div>

                <!-- user email -->
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-sm-2">
                        <label for="email" class="col-form-label">Email</label>
                    </div>
                    <div class="col-sm-8">
                        <input value=<?php echo $user_email; ?> type="email" name="user_email" id="" class="form-control" required placeholder="example@email.com">
                    </div>
                </div>

                <!-- user password -->
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-sm-2">
                        <label for="password" class="col-form-label">Password</label>
                    </div>
                    <div class="col-sm-8">
                        <input value=<?php echo $user_password; ?> type="password" name="user_password" id="" required class="form-control" placeholder="XXXXXXX">
                    </div>
                </div>

                <!-- user role -->
                <div class="row g-3 align-items-center mb-3">

                    <div class="col-sm-2">
                        <label for="role" class="col-form-label">Role</label>
                    </div>

                    <div class="col-sm-8">

                    <select name="role_type" id="" class="form-control">
                        <?php //role type ko add post mhr pw chin loz tone tk hr

                        global $connection;
                        $query = "SELECT * FROM roles";
                        $select_roles = mysqli_query($connection, $query);


                        while ($row = mysqli_fetch_assoc($select_roles)) {

                            $role_id = $row['role_id'];
                            $role_type = $row['role_type'];

                            if ($role_id == $user_role_id) {

                                echo "<option selected value='$role_id'>{$role_type}</option>";

                            }

                            else{

                                echo "<option value='{$role_id}'>{$role_type}</option>";

                            }

                                
                            
                        }

                        ?>
                            }

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
                        <?php //department name ko add post mhr pw chin loz tone tk hr

                        global $connection;
                        $query = "SELECT * FROM department";
                        $select_department = mysqli_query($connection, $query);


                        while ($row = mysqli_fetch_assoc($select_department)) {

                            $dept_id = $row['dept_id'];
                            $dept_name = $row['dept_name'];

                            if ($dept_id == $user_dept_id) {

                                echo "<option selected value='$dept_id'>{$dept_name}</option>";

                            }

                            else{

                                echo "<option value='{$dept_id}'>{$dept_name}</option>";

                            }

                                
                            
                        }

                        ?>
                            }

                    </select>

                    </div>

                </div>
                
                <div class="col-sm-6 col-sm-offset-4 mt-4 ml-4">
                    
                    <input type="submit" name="update_user" Value="Update User" class="btn btn-secondary">
                </div>

            </form>
        </div>
    </div>                                                           
                                




</div>