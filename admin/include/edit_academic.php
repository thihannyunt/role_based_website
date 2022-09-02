<?php
if (isset($_POST['update_academic'])){
//for update acedemic year
    $academic_id         =  $_GET['a_id'];
    $academic_year_name  =  $_POST['academic_year_name'];
    $start_date          =  $_POST['start_date'];
    $closure_date        =  $_POST['closure_date'];
    $final_closure_date  =  $_POST['final_closure_date'];

    $sec_start_date         =  strtotime($start_date);
    $sec_closure_date       =  strtotime($closure_date);
    $sec_final_closure_date =  strtotime($final_closure_date);

        if ($sec_start_date > $sec_closure_date){

            echo "<script>alert('Closure Date must be later than Start Date')</script>";

        }
        else if($sec_start_date > $sec_final_closure_date){

            echo "<script>alert('Final closure Date must be later than Start Date')</script>";

        }
        else if($sec_closure_date > $sec_final_closure_date){

            echo "<script>alert('Final Closure Date must be later than Closure Date')</script>";

        }

        else {

            $query  =  "UPDATE academic_year SET 
                        start_date          =  '{$start_date}',
                        closure_date        = '{$closure_date}',
                        final_closure_date  = '{$final_closure_date}',
                        academic_year_name  = '{$academic_year_name}'
                        WHERE academic_id   = '{$academic_id}'";

            $update_academic_query          =  mysqli_query($connection, $query);

                if (!$update_academic_query) {

                    die("QUERY FAILED" . mysqli_error($connection));

                }

            echo "<script>alert('Update Academic Year successful')
                        window.location='academic_year.php'
              </script>";

        }

}



if (isset($_GET['a_id'])){
//get data by get method
    $academic_id  =  $_GET['a_id'];

    $select_academic_query  =  mysqli_query($connection, "SELECT * FROM academic_year WHERE academic_id = $academic_id ");
    $row                    =  mysqli_fetch_array($select_academic_query);

        $academic_year_name  =  $row['academic_year_name'];
        $start_date          =  $row['start_date'];
        $closure_date        =  $row['closure_date'];
        $final_closure_date  =  $row['final_closure_date'];
?>

<h2 class="h5 text-dark mb-3"><i class="fas fa-calendar-alt"></i> Update Academic Year</h2>
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
                    <input type="text" name="academic_year_name" class="form-control" required placeholder="Enter academic year" value = "<?php echo $academic_year_name; ?>">
                </div>
            </div>

            <!-- academic year start date -->
            <div class="row g-3 align-items-center mb-3">
                <div class="col-sm-2">
                    <label for="start_date" class="col-form-label">Start Date</label>
                </div>
                <div class="col-sm-8">
                    <input type="date" name="start_date" id="" class="form-control" required value = "<?php echo $start_date; ?>">
                </div>
            </div>

            <!-- academic year closure date -->
            <div class="row g-3 align-items-center mb-3">
                <div class="col-sm-2">
                    <label for="closure_date" class="col-form-label">Closure Date</label>
                </div>
                <div class="col-sm-8">
                    <input type="date" name="closure_date" id="" class="form-control" required value = "<?php echo $closure_date; ?>">
                </div>
            </div>

            <!-- academic year Final Closure Date -->
            <div class="row g-3 align-items-center mb-3">
                <div class="col-sm-2">
                    <label for="final_closure_date" class="col-form-label">Final Closure Date</label>
                </div>
                <div class="col-sm-8">
                    <input type="date" name="final_closure_date" id="" class="form-control" required value = "<?php echo $final_closure_date; ?>">
                </div>
            </div>


            <div class="col-sm-6 col-sm-offset-4 mt-4 ml-4">

                <input type="submit" name="update_academic" Value="Update Academic Year" class="btn btn-secondary">
            </div>

        </form>
    </div>
</div>

<?php } ?>
