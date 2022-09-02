<?php include "include/header.php"; ?>



<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "include/sidebar.php"; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include "include/topbar.php"; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid" >

                    <div class="row">

                        <div class="col-lg-6">
                        
                            <div class="col-xs-6">

                                <?php 
                                    //submit button for inserting into database
                                    if (isset($_POST['submit'])) 
                                    {
                                        $category_name  =  $_POST['category_name'];

                                        $query                 =  "INSERT INTO category(category_name) VALUE ('{$category_name}')";
                                        $create_category_query =  mysqli_query($connection, $query);

                                            if (!$create_category_query) {
                                                                        
                                            die('QUERY FAILED' . mysqli_error($connection));

                                            }

                                    }
                                 ?>

                                 <!-- category add form -->
                                <form action="" method="post"> 
                                    <div class="form-group">
                                        
                                        <label for="categoryname"><i class="fas fa-plus-circle"></i> Add Category</label>
                                        <input type="text" name=category_name class="form-control" required>

                                    </div>

                                    <div class="form-group">
                                        
                                        <input class="btn btn-secondary" type="submit" name=submit value="Add Category">

                                    </div>
                                                        
                                </form> 

                                <?php 
                                //category edit link code
                                if (isset($_GET['edit'])) {
                                    
                                    $cat_id  =  $_GET['edit'];
                                    include "include/update_categories.php";

                                }

                                ?>
                       
                            </div>


                            <div class="col-xs-6">
<!--                                cateogyr table code-->
                                <table class="table table-bordered table-hover text-center text-dark">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Id</th>
                                            <th>Category Title</th>
                                            <th colspan="2">Option</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php 

                                        global $connection;

                                        $query          =  "SELECT * FROM category";
                                        $select_category=  mysqli_query($connection, $query);

                                            while($row = mysqli_fetch_assoc($select_category)){
                                                                            
                                                $category_id   =  $row['category_id'];
                                                $category_name =  $row['category_name'];

                                                    echo "<tr>";
                                                        echo "<td> {$category_id} </td>";
                                                        echo "<td> {$category_name} </td>";
                                                        echo "<td> <a href='categories.php?edit={$category_id}'> <i class='fas fa-edit'></i> </a> </td>";
                                                        echo "<td> <a href='categories.php?delete={$category_id}'> <i class='fas fa-trash'></i> </a> </td>";
                                                    echo "</tr>";
                                            }

                                         ?>

                                        <?php
                                        //category delete code
                                        if (isset($_GET['delete'])) {

                                            $delete_cateogyr_id  =  $_GET['delete'];

                                            $idea_query  =  "SELECT * FROM ideas WHERE category_id = $delete_cateogyr_id";
                                            $select_idea =  mysqli_query($connection, $idea_query);

                                                while ($row =mysqli_fetch_assoc($select_idea)) {

                                                    $idea_category_id  =  $row['category_id'];
                                                    
                                                }

                                                if ($delete_cateogyr_id == $idea_category_id) {
                                                    
                                                    echo "<script>alert('This category name is used in staff ideas')</script>";
                                                    echo "<script>window.location='categories.php'</script>";

                                                }

                                                else
                                                {
                                                    
                                                    $query = "DELETE FROM category WHERE category_id = {$delete_cateogyr_id}";
                                                    $delete_query = mysqli_query($connection, $query);

                                                    echo "<script>window.location.href='categories.php'</script>"; //lo chin tk page ko refresh lote py lite tk hr
                                                }

                                        }

                                         ?>

                                    </tbody>

                                </table>

                            </div>

                        </div>
                
                    </div>

                </div>

            </div>

<?php include "include/footer.php"; ?>
      

            