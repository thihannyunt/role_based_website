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
<!--            create table-->
            <div class="container-fluid">
                <h2 class="h5 text-dark mb-3"><i class="fas fa-list-alt"></i> View All Ideas</h2>
                <table class="table table-bordered table-hover text-dark text-center table-responsive">
                    <thead class="thead-light">

                        <tr>

                            <th>Id</th>
                            <th>Username</th>
                            <th>Content</th>
                            <th>Attachment</th>
                            <th>Category</th>
                            <th>Department</th>
                            <th>Date</th>
                            <th>Like</th>
                            <th>Dislike</th>
                            <th>Comment</th>
                            <th colspan="2">Option</th>

                        </tr>

                    </thead>
                    <tbody>

                        <?php
                            //select data from ideas table for view all ideas
                            global $connection;
                            $idea_query  =  mysqli_query($connection, "SELECT * FROM ideas");

                                while($row=mysqli_fetch_array($idea_query)){

                                    $idea_id             =  $row['idea_id'];
                                    $user_id             =  $row['user_id'];
                                    $idea_content        =  substr($row['idea_content'],0,30);
                                    $idea_attachment     =  $row['idea_attachment'];
                                    $category_id         =  $row['category_id'];
                                    $dept_id             =  $row['dept_id'];
                                    $idea_date           =  $row['idea_date'];
                                    $idea_likes          =  $row['idea_likes'];
                                    $idea_dislikes       =  $row['idea_dislikes'];
                                    $idea_comment_count  =  $row['idea_comment_count'];

                                        echo "<tr>";

                                            echo "<td>$idea_id</td>";

                                            $select_user    =  mysqli_query($connection, "SELECT * FROM users WHERE user_id = $user_id");
                                            $user_row       =  mysqli_fetch_array($select_user);
                                            $user_username  =  $user_row['username'];

                                            echo "<td>$user_username</td>";



                                            echo "<td>$idea_content... <a href='show_idea_detail.php?i_id={$idea_id}'>Read more</a> </td>";

                                            //show image for idea attachemnet
                                            if($idea_attachment == ""){

                                                echo "<td>No Photos</td>";

                                            } else {

                                                echo "<td> <img width='100'  src='../images/$idea_attachment' alt='image'> </td>";

                                            }

                                            $select_category  =  mysqli_query($connection, "SELECT * FROM category WHERE category_id = $category_id");
                                            $category_row     =  mysqli_fetch_array($select_category);
                                            $category_name    =  $category_row['category_name'];

                                            echo "<td>$category_name</td>";

                                            $select_department  =  mysqli_query($connection, "SELECT * FROM department WHERE dept_id = $dept_id");
                                            $department_row     =  mysqli_fetch_array($select_department);
                                            $dept_name          =  $department_row['dept_name'];

                                            echo "<td>$dept_name</td>";
                                            echo "<td>$idea_date</td>";
                                            echo "<td>$idea_likes</td>";
                                            echo "<td>$idea_dislikes</td>";
                                            echo "<td>$idea_comment_count</td>";

                                            echo "<td><a href='show_idea_detail.php?i_id={$idea_id}'> <i class='fas fa-eye'></i> </a> </td>";

                                            echo "<td><a href='view_all_ideas.php?delete={$idea_id}'> <i class='fas fa-trash'></i> </a> </td>";

                                        echo "</tr>";

                                }
                        ?>
                    </tbody>

                </table >


            </div>

        </div>

        <?php include "include/footer.php"; ?>

<?php //delete idea

if (isset($_GET['delete'])) {

    $the_idea_id=$_GET['delete'];

        $query                 =  "DELETE FROM ideas WHERE idea_id = {$the_idea_id}";
        $delete_ideas_query    =  mysqli_query($connection, $query);
        $delete_comment_query  =  mysqli_query($connection, "DELETE FROM comments WHERE idea_id = {$the_idea_id}");

        echo "<script>window.location.href='view_all_ideas.php'</script>";

}
?>


