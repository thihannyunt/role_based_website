<form action="" method="post">
    <div class="form-group">       

        <?php 
//get data by using get method
        if (isset($_GET['edit'])) {

            $dept_id =  $_GET['edit'];

            $query                      =  "SELECT * FROM department WHERE dept_id= $dept_id";
            $select_department_id_fEdit =  mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_department_id_fEdit)){

                    $dept_id    =  $row['dept_id'];
                    $dept_name  =  $row['dept_name'];

                }?>

            <input value="<?php   echo $dept_name; ?>" type="text" name=dept_name class="form-control" required>

        <?php } ?>

        <!-- update department -->
        <?php 
            //update department
            if (isset($_POST['update_department'])) {
               
                $the_department_name  =  $_POST['dept_name'];

                $query        =  "UPDATE department SET dept_name = '{$the_department_name}' WHERE dept_id = '{$dept_id}' ";
                $update_query =  mysqli_query($connection, $query);

                    if (!$update_query) {

                        die("QUERY FAILED" . mysqli_error($connection));

                    }
                    else{

                        echo "<script>window.location.href='./department.php'</script>";

                    }

            }

         ?>

    </div>

    <div class="form-group">
        
        <input class="btn btn-secondary" type="submit" name="update_department" value="Update Department">

    </div>
                        
</form>