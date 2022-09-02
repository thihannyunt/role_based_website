
<form action="" method="post">
    <div class="form-group">        
        
        <?php 
        //get data from category edit table
        if (isset($_GET['edit'])) {

            $category_id  =  $_GET['edit'];

            $idea_query      =  "SELECT * FROM ideas WHERE category_id = $category_id";
            $send_idea_query =  mysqli_query($connection, $idea_query);
            $count           =  mysqli_num_rows($send_idea_query);

                if ($count == NULL) { ?>

                <?php

                $query                      = "SELECT * FROM category WHERE category_id= $category_id";
                $select_categories_id_fEdit =  mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($select_categories_id_fEdit)){

                        $category_id   =  $row['category_id'];
                        $category_name =  $row['category_name'];

                    }?>

                    <label for="cat-title"><i class="fas fa-pen"></i> Edit Category</label>
                    <input value="<?php echo $category_name; ?>" type="text" name=category_name class="form-control" required>

                <?php }

                else{


                    echo "<script>alert('This category name is used in staff ideas')</script>";
                    echo "<script>window.location='categories.php'</script>";

                }} ?>

    <!-- update cateogry -->
    <?php

        if (isset($_POST['update_category'])) {

            $the_category_name  =  $_POST['category_name'];

            $query              =  "UPDATE category SET category_name = '{$the_category_name}' WHERE category_id = '{$category_id}' ";
            $update_query       =  mysqli_query($connection, $query);

                if (!$update_query) {

                    die("QUERY FAILED" . mysqli_error($connection));

                }
                else{
                    echo "<script>window.location.href='./categories.php'</script>";
                }

        }

     ?>

    </div>

    <div class="form-group">
        
        <input class="btn btn-secondary" type="submit" name="update_category" value="Update Category">

    </div>
                        
</form>