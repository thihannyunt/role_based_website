<!-- this is for login page -->
<?php require_once "include/header.php"; ?>


<?php

if (isset($_POST['login'])) {


    //when  click the login button the following condition start working
    $the_user_email    =  mysqli_real_escape_string($connection, $_POST['user_email']);
    $the_user_password =  mysqli_real_escape_string($connection, $_POST['password']);


    $query             =  "SELECT * FROM users WHERE user_email = '{$the_user_email} ' AND user_password = '{$the_user_password}' ";
    $check_user_query  =  mysqli_query($connection, $query);
    $count_user_row    =  mysqli_num_rows($check_user_query);

    if ($count_user_row > 0) {

        while ($row = mysqli_fetch_array($check_user_query)) {

            $db_user_id       =  $row['user_id'];
            $db_username      =  $row['username'];
            $db_user_email    =  $row['user_email'];
            $db_user_password =  $row['user_password'];
            $db_role_id       =  $row['role_id'];
            $db_dept_id       =  $row['dept_id'];


            $query            =  "SELECT * FROM roles WHERE role_id = {$db_role_id}";
            $check_role_query =  mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($check_role_query)) {

                $role_type = $row['role_type'];

            }


            if ($role_type === 'admin') {

                $_SESSION['user_id']     =  $db_user_id;
                $_SESSION['username']    =  $db_username;
                $_SESSION['user_email']  =  $db_user_email;
                $_SESSION['role_id']     =  $db_role_id;
                $_SESSION['dept_id']     =  $db_dept_id;

                echo "<script>alert('Hello Admin')</script>";
                echo "<script>window.location='admin/index.php'</script>";

            }

            else if($role_type === 'qa_manager')
            {

                $_SESSION['user_id']     =  $db_user_id;
                $_SESSION['username']    =  $db_username;
                $_SESSION['user_email']  =  $db_user_email;
                $_SESSION['role_id']     =  $db_role_id;
                $_SESSION['dept_id']     =  $db_dept_id;


                echo "<script>alert('Hello QA Manager')</script>";
                echo "<script>window.location='qa_manager/index.php'</script>";

            }

            else if($role_type === 'qa_coordinator')
            {

                $_SESSION['user_id']     =  $db_user_id;
                $_SESSION['username']    =  $db_username;
                $_SESSION['user_email']  =  $db_user_email;
                $_SESSION['role_id']     =  $db_role_id;
                $_SESSION['dept_id']     =  $db_dept_id;


                echo "<script>alert('Hello QA Coordinator')</script>";
                echo "<script>window.location='qa_coordinator/index.php'</script>";

            }

            else
            {

                $_SESSION['user_id']     =  $db_user_id;
                $_SESSION['username']    =  $db_username;
                $_SESSION['user_email']  =  $db_user_email;
                $_SESSION['role_id']     =  $db_role_id;
                $_SESSION['dept_id']     =  $db_dept_id;

                echo "<script>alert('Hello Staff')</script>";
                echo "<script>window.location='staff/index.php'</script>";

            }

        }

    }
    else{

        echo "<script>alert('Username or Password is wrong')</script>";
        echo "<script>window.location='index.php'</script>";

    }

}

?>


<!--html form for login box-->
<body class="" style="background-color: #395B64;">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center mt-5">

        <div class="col-xl-10 col-lg-12 col-md-9 mt-5">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block" style="background-image: url('img/tc.png'); background-position:center; background-size:cover;"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-800 mb-4">Welcome!</h1>
                                </div>
                                <form action="index.php" method="post" class="user">
                                    <div class="form-group">
                                        <input name="user_email" type="email" class="form-control form-control-user"
                                               id="exampleInputName" aria-describedby=""
                                               placeholder="Enter Your Email..." required>
                                    </div>
                                    <div class="form-group">
                                        <input name="password" type="password" class="form-control form-control-user"
                                               id="exampleInputPassword" placeholder="Password" required>
                                    </div>
                                    <hr>
                                    <div>

                                        <button name="login"  class="btn btn-primary btn-user btn-block">Login</button>

                                    </div>

                                </form>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- Footer -->

<?php require_once "include/footer.php"; ?>