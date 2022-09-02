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

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h4 mb-0 text-gray"><i class="fas fa-list-ul fa-sm"></i> Most Popular Ideas</h1>
                </div>

                <div>

                    <?php

                    //like php code(start)
                    if (isset($_POST['liked'])) {

                        $idea_id    =  $_POST['idea_id'];
                        $user_id    =  $_POST['user_id'];

                        $query      =  "SELECT * FROM ideas WHERE idea_id= {$idea_id}";
                        $ideaResult =  mysqli_query($connection, $query);
                        $idea       =  mysqli_fetch_array($ideaResult);
                        $likes      =  $idea['idea_likes'];
                        $dislikes   =  $idea['idea_dislikes'];


                        $rating_like_check  =  mysqli_query($connection, "SELECT * FROM rating_info WHERE idea_id = $idea_id AND user_id = $user_id");
                        $row                =  mysqli_fetch_array($rating_like_check);

                        if (mysqli_num_rows($rating_like_check) ==  0) {

                            mysqli_query($connection, "INSERT INTO rating_info(user_id, idea_id, rating) VALUES ($user_id, $idea_id, 'Like')");

                            mysqli_query($connection, "UPDATE ideas SET idea_likes=$likes+1 WHERE idea_id={$idea_id}");

                        }

                        else if (mysqli_num_rows($rating_like_check) == 1 && $row['rating'] == 'Dislike' ) {

                            mysqli_query($connection, "UPDATE ideas SET idea_likes=$likes+1, idea_dislikes=$dislikes-1  WHERE idea_id={$idea_id}");

                            mysqli_query($connection, "UPDATE rating_info SET rating = 'Like' WHERE idea_id= $idea_id AND user_id = $user_id ");

                        }

                        else if (mysqli_num_rows($rating_like_check) == 1 && $row['rating'] == 'Like'){

                            mysqli_query($connection, "UPDATE ideas SET idea_likes=$likes-1 WHERE idea_id= {$idea_id}");

                            mysqli_query($connection, "DELETE FROM rating_info WHERE rating = 'Like'AND idea_id = $idea_id AND user_id = $user_id");

                        }

                        exit();

                    }
                    //like php code (end)
                    ?>

                    <?php

                    //dislike php code(start)

                    if (isset($_POST['unliked'])) {


                        $idea_id  =  $_POST['idea_id'];
                        $user_id  =  $_POST['user_id'];


                        $query      =  "SELECT * FROM ideas WHERE idea_id= {$idea_id}";
                        $ideaResult =  mysqli_query($connection, $query);
                        $idea       =  mysqli_fetch_array($ideaResult);
                        $likes      =  $idea['idea_likes'];
                        $dislikes   =  $idea['idea_dislikes'];




                        $rating_like_check =  mysqli_query($connection, "SELECT * FROM rating_info WHERE idea_id = $idea_id AND user_id = $user_id");
                        $row               =  mysqli_fetch_array($rating_like_check);

                        if (mysqli_num_rows($rating_like_check) == 0) {

                            mysqli_query($connection, "INSERT INTO rating_info(user_id, idea_id, rating) VALUES ($user_id, $idea_id, 'Dislike')");

                            mysqli_query($connection, "UPDATE ideas SET idea_dislikes=$dislikes+1 WHERE idea_id={$idea_id}");

                        }

                        if (mysqli_num_rows($rating_like_check) == 1 && $row['rating'] == 'Like') {

                            mysqli_query($connection, "UPDATE ideas SET idea_dislikes=$dislikes+1, idea_likes=$likes-1  WHERE idea_id={$idea_id}");

                            mysqli_query($connection, "UPDATE rating_info SET rating = 'Dislike' WHERE idea_id= $idea_id AND user_id = $user_id ");

                        }
                        else if(mysqli_num_rows($rating_like_check) == 1 && $row['rating'] == 'Dislike'){

                            mysqli_query($connection, "UPDATE ideas SET idea_dislikes=$dislikes-1 WHERE idea_id= {$idea_id}");

                            mysqli_query($connection, "DELETE FROM rating_info WHERE rating = 'Dislike'AND idea_id = $idea_id AND user_id = $user_id");

                        }

                        exit();


                    }
                    //dislike php code (end)
                    ?>

                    <?php
                    if (isset($_SESSION)){

                        $session_user_id  =  $_SESSION['user_id'];

                    }
                    ?>

                    <?php
                    //page pagination start
                    $per_page  =  5;

                    if (isset($_GET['page'])) {

                        $page  =  $_GET['page'];

                    }

                    else{

                        $page = "";

                    }

                    if($page == "" || $page == 1){

                        $page_1= 0;

                    }

                    else{

                        $page_1=($page * $per_page) - $per_page;

                    }

                    $post_query_count =  "SELECT idea_id FROM ideas";
                    $find_count       =  mysqli_query($connection, $post_query_count);
                    $count            =  mysqli_num_rows($find_count);

                    if($count < 1){

                        echo "<h1 class='text-center'>No Ideas available</h1>";

                    } else {

                        $count        =  ceil($count / $per_page);
                        $ideas_query  =  "SELECT * FROM ideas ORDER BY idea_likes DESC LIMIT $page_1, $per_page";
                        //page paginatin end
                        $select_post  =  mysqli_query($connection, $ideas_query);
                        //crate while function for picking data from dataabase
                        while ($row = mysqli_fetch_assoc($select_post)) {

                            $idea_id            =  $row['idea_id'];
                            $user_idea_id       =  $row['user_id'];
                            $idea_checkbox      =  $row['idea_checkbox'];
                            $idea_date          =  $row['idea_date'];
                            $idea_view_count    =  $row['idea_view_count'];
                            $idea_attachment    =  $row['idea_attachment'];
                            $idea_content       =  substr($row['idea_content'],0,100);
                            $idea_category_id   =  $row['category_id'];
                            $idea_likes         =  $row['idea_likes'];
                            $idea_dislikes      =  $row['idea_dislikes'];
                            $idea_comment_count =  $row['idea_comment_count'];
                            ?>


                            <div class="card">

                                <div class="card-header text-white" style="background-color: #3a4d4d;">
                                    <div class="row">
                                        <!--show anonymouse or real name-->
                                        <div class="col-lg-10 col-md-8 col-sm">
                                            <?php
                                            if ($idea_checkbox == 'anonymous') {

                                                echo " Author Name -" . " Anonymous";

                                            }
                                            else{

                                                $user_query  =  "SELECT * FROM users WHERE user_id = {$user_idea_id}";
                                                $select_user =  mysqli_query($connection, $user_query);

                                                while ($row = mysqli_fetch_assoc($select_user)) {

                                                    echo " Author Name -" . $username = $row['username'];

                                                }
                                            }
                                            ?>

                                        </div>
                                        <!--idea create date-->
                                        <div class="col-lg-2 col-md-4 col-sm"><i class="fas fa-calendar"></i> <?php echo $idea_date; ?> </div>
                                    </div>
                                    <div class="row">
                                        <!--category name-->
                                        <div class="col">
                                            <?php

                                            $category_query        =  "SELECT * FROM category WHERE category_id = {$idea_category_id} ";
                                            $select_category_query =  mysqli_query($connection, $category_query);

                                            while ($row = mysqli_fetch_assoc($select_category_query)) {

                                                echo "Category name - " . $row['category_name'];

                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <!--photos of ideas-->
                                <div class="card-body">
                                    <a href="show_idea_detail.php?i_id=<?php echo $idea_id; ?>">
                                        <?php
                                        if($idea_attachment == ""){

                                            echo "<center> <h4>Photo is not included</h4> </center>";

                                        }
                                        else { ?>

                                            <img  width="500px" height="400px" class="img-fluid img-thumbnail rounded mt-n4 mx-auto d-block" src="../images/<?php echo $idea_attachment ?>" alt="">

                                        <?php }
                                        ?>
                                    </a>
                                    <p class="card-text mt-2"> <?php echo $idea_content; ?><a href="show_idea_detail.php?i_id=<?php echo $idea_id; ?>">.....Read more.....</a> </p>
                                </div>

                                <!--like-dislike, comment view count start-->
                                <div class="card-footer" style="background-color: #C3DBD9;">
                                    <?php
                                    $select_rating    =  mysqli_query($connection, "SELECT * FROM rating_info WHERE user_id = $session_user_id AND idea_id = $idea_id ");
                                    $rating_row       =  mysqli_fetch_array($select_rating);
                                    $rating_num_rows  =  mysqli_num_rows($select_rating);

                                    if ($rating_num_rows>0 && $rating_row['rating'] == 'Like')
                                    {?>

                                        <a class="like" href="" onclick="like_function('<?php echo $idea_id ?>') "><span class="fas fa-thumbs-up fa-lg"></span></a>
                                        <?php echo $idea_likes; ?>&nbsp;

                                        <a class="unlike" href="" onclick="unlike_function('<?php echo $idea_id ?>')"><span class="far fa-thumbs-down fa-lg"></span></a>
                                        <?php echo $idea_dislikes; ?>

                                        <?php
                                    }
                                    else if ($rating_num_rows>0 && $rating_row['rating'] == 'Dislike')
                                    {
                                        ?>

                                        <a class="like" href="" onclick="like_function('<?php echo $idea_id ?>') "><span class="far fa-thumbs-up fa-lg"></span></a>
                                        <?php echo $idea_likes; ?>&nbsp;
                                        <a class="unlike" href="" onclick="unlike_function('<?php echo $idea_id ?>')"><span class="fas fa-thumbs-down fa-lg"></span></a>
                                        <?php echo $idea_dislikes; ?>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>

                                        <a class="like" href="" onclick="like_function('<?php echo $idea_id ?>') "><span class="far fa-thumbs-up fa-lg"></span></a>

                                        <?php echo $idea_likes; ?>&nbsp;

                                        <a class="unlike" href="" onclick="unlike_function('<?php echo $idea_id ?>')"><span class="far fa-thumbs-down fa-lg"></span></a>

                                        <?php echo $idea_dislikes; ?>

                                        <?php
                                    }
                                    ?>

                                    <a href="show_idea_detail.php?i_id=<?php echo $idea_id; ?>">
                                        &nbsp;<i class="fas fa-comments fa-lg"></i>


                                    </a>
                                    <?php echo $idea_comment_count ?>

                                    <div class="float-right">
                                        <i class="fas fa-eye"></i>&nbsp;<?php echo  $idea_view_count; ?>&nbsp;
                                    </div>
                                </div>
                                <!--like-dislike, comment and viewcount  end-->
                            </div>
                            <br>

                            <?php
                        } }
                    ?>
                    <!--bottom bar pagination number-->
                    <center>
                        <ul class="pager" >
                            <?php
                            for ($i=1; $i <= $count ; $i++) {
                                if($i == $page){
                                    echo "<li><a class='active_link' href='popular_ideas.php?page={$i}'>{$i}</a></li> ";
                                }
                                else{
                                    echo "<li><a href='popular_ideas.php?page={$i}'>{$i}</a></li> ";
                                }
                            }
                            ?>
                        </ul>
                    </center>
                </div>
            </div>
        </div>

        <?php include "include/footer.php"; ?>

        <!--css style-->
        <style>

            .pager li{display:inline}.pager li>a,
                                     .pager li>span{display:inline-block;padding:5px 14px;background-color:#fff;border:1px solid #ddd;border-radius:15px}

            .pager li>a:focus,.pager li>a:hover{text-decoration:none;background-color:#eee}

            .pager li .active_link{

                background: #C1F1FF !important;

            }

        </style>

        <!--like and unlike javascript-->
        <script>

            function like_function(id){
                $.ajax({

                    url: "",
                    type: 'post',
                    data: {
                        'liked': 1,
                        'idea_id': id,
                        'user_id': <?php echo $session_user_id ?>
                    }


                })

            }

            function unlike_function(id){

                $.ajax({

                    url: "",
                    type: 'post',
                    data: {
                        'unliked': 1,
                        'idea_id': id,
                        'user_id': <?php echo $session_user_id ?>
                    }

                })
            }
        </script>



