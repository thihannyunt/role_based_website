<?php

    if(isset($_POST['add_academic'])){
        //select data for if statement

        $academic_year_name      =  $_POST['academic_year_name'];
        $start_date              =  $_POST['start_date'];
        $closure_date            =  $_POST['closure_date'];
        $final_closure_date      =  $_POST['final_closure_date'];

        $sec_start_date          =  strtotime($start_date);
        $sec_closure_date        =  strtotime($closure_date);
        $sec_final_closure_date  =  strtotime($final_closure_date);
        $today_date              =  strtotime("now");

            if ($sec_start_date > $sec_closure_date){

                echo "<script>alert('Closure Date must be later than Start Date')</script>";

            }
            else if($sec_start_date > $sec_final_closure_date){

                echo "<script>alert('Final closure Date must be later than Start Date')</script>";

            }
            else if($sec_closure_date > $sec_final_closure_date){

                echo "<script>alert('Final Closure Date must be later than Closure Date')</script>";

            }
            else if($sec_closure_date < $today_date){

                echo "<script>alert('Closure Date must be earlier than Today date')</script>";

            }
            else if($sec_final_closure_date < $today_date){

                echo "<script>alert('Final Closure Date must be earlier than Today date')</script>";

            }



            else{
                //when this condition run, start insert data into academic year table
                $select_action    =  mysqli_query($connection, "SELECT * FROM academic_year WHERE action = 'active'");
                $select_num_rows  =  mysqli_num_rows($select_action);

                    if ($select_num_rows == 0){

                    $query               =  "INSERT INTO academic_year(start_date, closure_date, final_closure_date, academic_year_name, action)
                                             VALUES ( '{$start_date}','{$closure_date}', '{$final_closure_date}','{$academic_year_name}','active')";

                    $add_academic_query  =   mysqli_query($connection, $query);

                        if(!$add_academic_query){

                            die("QUERY FAILED" . mysqli_error($connection));

                        }

                        echo"<script>alert('Academic Year is successfully added')
                                    window.location='academic_year.php'
                            </script>";

                        }

                        else{

                            $query               =  "INSERT INTO academic_year(start_date, closure_date, final_closure_date, academic_year_name )
                                                    VALUES ( '{$start_date}','{$closure_date}', '{$final_closure_date}','{$academic_year_name}')";

                            $add_academic_query  =   mysqli_query($connection, $query);

                                if(!$add_academic_query){

                                    die("QUERY FAILED" . mysqli_error($connection));

                                }

                            echo"<script>alert('Academic Year is successfully added')
                                    window.location='academic_year.php'
                            </script>";

                        }

            }

    }

?>


<h2 class="h5 text-dark mb-3"><i class="fas fa-calendar-alt"></i> Add Academic Year</h2>
    <div class="card">
        <div class="card-header text-white" style="background-color: #3a4d4d;">
        <i class="fas fa-pen"></i>
            &nbsp;Fill info
        </div>
        <div class="card-body">
            <form action="" method="post" class="text-dark">

                <!-- academic year name -->
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-sm-2">
                        <label for="academic_year_name" class="col-form-label">Academic Year</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="academic_year_name" id="" class="form-control" required placeholder="Enter academic year">
                    </div>
                </div>

                <!-- academic year start date -->
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-sm-2">
                        <label for="start_date" class="col-form-label">Start Date</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="date" name="start_date" id="" class="form-control" required>
                    </div>
                </div>

                <!-- academic year closure date -->
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-sm-2">
                        <label for="closure_date" class="col-form-label">Closure Date</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="date" name="closure_date" id="" class="form-control" required>
                    </div>
                </div>

                <!-- academic year Final Closure Date -->
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-sm-2">
                        <label for="final_closure_date" class="col-form-label">Final Closure Date</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="date" name="final_closure_date" id="" class="form-control" required>
                    </div>
                </div>


                <div class="col-sm-6 col-sm-offset-4 mt-4 ml-4">

                    <input type="submit" name="add_academic" Value="Add Academic Year" class="btn btn-secondary">
                </div>

            </form>
        </div>
    </div>