<?php include "include/header.php"; ?>


<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php include "include/sidebar.php"; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column" >

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php include "include/topbar.php"; ?>
            <!-- End of Topbar -->

            <?php

            //like php code(start)

            if (isset($_POST['liked'])) {

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

                        mysqli_query($connection, "INSERT INTO rating_info(user_id, idea_id, rating) VALUES ($user_id, $idea_id, 'Like')");

                        mysqli_query($connection, "UPDATE ideas SET idea_likes=$likes+1 WHERE idea_id={$idea_id}");

                    }

                    if (mysqli_num_rows($rating_like_check) == 1 && $row['rating'] == 'Dislike') {


                        mysqli_query($connection, "UPDATE ideas SET idea_likes=$likes+1, idea_dislikes=$dislikes-1  WHERE idea_id={$idea_id}");

                        mysqli_query($connection, "UPDATE rating_info SET rating = 'Like' WHERE idea_id= $idea_id AND user_id = $user_id ");

                    } else if (mysqli_num_rows($rating_like_check) == 1 && $row['rating'] == 'Like') {

                        mysqli_query($connection, "UPDATE ideas SET idea_likes=$likes-1 WHERE idea_id= {$idea_id}");

                        mysqli_query($connection, "DELETE FROM rating_info WHERE rating = 'Like'AND idea_id = $idea_id AND user_id = $user_id");

                    }

                exit();

            }//like php code (end)
            ?>

            <?php

            //dislike php code(start)

            if (isset($_POST['unliked'])) {


                $idea_id  =  $_POST['idea_id'];
                $user_id  =  $_POST['user_id'];

                $query       =  "SELECT * FROM ideas WHERE idea_id= {$idea_id}";
                $ideaResult  =  mysqli_query($connection, $query);
                $idea        =  mysqli_fetch_array($ideaResult);
                $likes       =  $idea['idea_likes'];
                $dislikes    =  $idea['idea_dislikes'];

                $rating_like_check  =  mysqli_query($connection, "SELECT * FROM rating_info WHERE idea_id = $idea_id AND user_id = $user_id");
                $row                =  mysqli_fetch_array($rating_like_check);

                    if (mysqli_num_rows($rating_like_check) == 0) {

                        mysqli_query($connection, "INSERT INTO rating_info(user_id, idea_id, rating) VALUES ($user_id, $idea_id, 'Dislike')");

                        mysqli_query($connection, "UPDATE ideas SET idea_dislikes=$dislikes+1 WHERE idea_id={$idea_id}");

                    }

                    if (mysqli_num_rows($rating_like_check) == 1 && $row['rating'] == 'Like') {


                        mysqli_query($connection, "UPDATE ideas SET idea_dislikes=$dislikes+1, idea_likes=$likes-1  WHERE idea_id={$idea_id}");

                        mysqli_query($connection, "UPDATE rating_info SET rating = 'Dislike' WHERE idea_id= $idea_id AND user_id = $user_id ");

                    } else if (mysqli_num_rows($rating_like_check) == 1 && $row['rating'] == 'Dislike') {

                        mysqli_query($connection, "UPDATE ideas SET idea_dislikes=$dislikes-1 WHERE idea_id= {$idea_id}");

                        mysqli_query($connection, "DELETE FROM rating_info WHERE rating = 'Dislike'AND idea_id = $idea_id AND user_id = $user_id");

                    }

                exit();

            }//dislike php code (end)
            ?>

            <?php
            if (isset($_SESSION['user_id'])) {

                $session_user_id = $_SESSION['user_id'];
                $session_username = $_SESSION['username'];

            }
            //get idea id and start the process
            if (isset($_GET['i_id'])) {

                $the_idea_id  =  $_GET['i_id'];

                if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

                    $view_query  =  "UPDATE ideas SET idea_view_count = idea_view_count + 1 WHERE idea_id = {$the_idea_id}";
                    $send_query  =  mysqli_query($connection, $view_query);
                        if (!$view_query) {

                            die("QUERY FAILED");

                        }
                }

            $query              =  "SELECT * FROM ideas WHERE idea_id = $the_idea_id";
            $select_idea_query  =  mysqli_query($connection, $query);
                //select from idea table for show idea details
                while ($row = mysqli_fetch_assoc($select_idea_query)) {

                    $idea_id             =  $row['idea_id'];
                    $user_idea_id        =  $row['user_id'];
                    $idea_category_id    =  $row['category_id'];
                    $idea_checkbox       =  $row['idea_checkbox'];
                    $idea_date           =  $row['idea_date'];
                    $idea_view_count     =  $row['idea_view_count'];
                    $idea_attachment     =  $row['idea_attachment'];
                    $idea_content        =  $row['idea_content'];
                    $idea_likes          =  $row['idea_likes'];
                    $idea_dislikes       =  $row['idea_dislikes'];
                    $idea_comment_count  =  $row['idea_comment_count'];
                    $idea_academic_id    =  $row['academic_id'];

                    $select_f_closure_date   =  mysqli_query($connection, "SELECT * FROM academic_year WHERE academic_id = $idea_academic_id");
                    $row                     =  mysqli_fetch_array($select_f_closure_date);
                    $academic_f_closure_date =  $row['final_closure_date'];
            ?>

                <div class="container-fluid" >
                    <div class="text-center h5 mt-3 mb-3"><i class="fas fa-laugh-wink"></i> You can comment on the ideas before <i class="fas fa-calendar-alt"></i> <?php echo $academic_f_closure_date ?> </div>

                    <div class="card">

                        <div class="card-header text-white" style="background-color: #3a4d4d;">
                            <div class="row">
                                <div class="col-lg-10 col-md-8 col-sm">
                                    <?php
                                    //condition for anonymous or not
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
                                <div class="col-lg-2 col-md-4 col-sm"><i class="fas fa-calendar"></i> <?php echo $idea_date; ?> </div>
                            </div>
                            <div class="row">
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

                        <div class="card-body">

                            <?php
                            //show image for idea attachemnet
                            if($idea_attachment == ""){

                                echo "<center> <h4>Photo is not included in this ideas</h4> </center>";

                            } else { ?>

                                <img  width="500px" height="400px" class="img-fluid img-thumbnail rounded mt-n4 mx-auto d-block" src="../images/<?php echo $idea_attachment ?>" alt="">

                            <?php }
                            ?>

                            <p class="card-text mt-2"> <?php echo $idea_content; ?> </p>
                        </div>
                        <div class="card-footer" style="background-color: #C3DBD9;">
                            <?php
                            //like unlike button
                            $select_rating    =  mysqli_query($connection, "SELECT * FROM rating_info WHERE user_id = $session_user_id AND idea_id = $idea_id ");
                            $rating_row       =  mysqli_fetch_array($select_rating);
                            $rating_num_rows  =  mysqli_num_rows($select_rating);

                                if ($rating_num_rows>0 && $rating_row['rating'] == 'Like') {?>

                                    <a class="like" href="" onclick="like_function('<?php echo $idea_id ?>') "><span class="fas fa-thumbs-up fa-lg"></span></a>
                                    <?php echo $idea_likes; ?>&nbsp;

                                    <a class="unlike" href="" onclick="unlike_function('<?php echo $idea_id ?>')"><span class="far fa-thumbs-down fa-lg"></span></a>
                                    <?php echo $idea_dislikes; ?>

                                    <?php
                                } else if ($rating_num_rows>0 && $rating_row['rating'] == 'Dislike') { ?>

                                    <a class="like" href="" onclick="like_function('<?php echo $idea_id ?>') "><span class="far fa-thumbs-up fa-lg"></span></a>
                                    <?php echo $idea_likes; ?>&nbsp;
                                    <a class="unlike" href="" onclick="unlike_function('<?php echo $idea_id ?>')"><span class="fas fa-thumbs-down fa-lg"></span></a>
                                    <?php echo $idea_dislikes; ?>
                                    <?php
                                } else { ?>

                                    <a class="like" href="" onclick="like_function('<?php echo $idea_id ?>') "><span class="far fa-thumbs-up fa-lg"></span></a>

                                    <?php echo $idea_likes; ?>&nbsp;

                                    <a class="unlike" href="" onclick="unlike_function('<?php echo $idea_id ?>')"><span class="far fa-thumbs-down fa-lg"></span></a>

                                    <?php echo $idea_dislikes; ?>

                            <?php   } ?>

                            <i class="fas fa-comments fa-lg"></i>

                            <?php echo $idea_comment_count; ?>

                            <div class="float-right">

<!--                                show delete ideas button if the user account is the owner of the ideas-->
                                <?php if($session_user_id == $user_idea_id) { ?>

                                    <div class="float-right">
                                        <i class="fas fa-eye"></i>&nbsp;<?php echo  $idea_view_count; ?>&nbsp;
                                        <a href="" data-toggle="modal" data-target="#staticBackdrop"><i class="fas fa-trash"></i>
                                            <div class="modal fade text-dark" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">

                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <div class="modal-text">Are you sure to delete this idea?</div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" aria-label="Close">No</button>
                                                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" onclick="location.href='include/show_idea_delete.php?i_id=<?php echo $idea_id; ?> '";>Yes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                <?php } ?>

                            </div>
                        </div>
                    </div>

                    <br>


                <?php }

            } //end if isset get i_id

            else {

                echo "<script>window.location.alert('staff/index.php')</script>";

            } ?>


                <?php

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    if (isset($_POST['idea_comment_create'])) {

                        $the_idea_id = $_GET['i_id'];

                        $session_user_id    =  $_SESSION['user_id'];
                        $comment_content    =  $_POST['idea_comment_content'];
                        $comment_checkbox   =  $_POST['comment_checkbox'];


                        $select_idea        =  mysqli_query($connection, "SELECT * FROM ideas WHERE idea_id = {$the_idea_id}");
                        $row                =  mysqli_fetch_array($select_idea);
                        $idea_academic_id   =  $row['academic_id'];

                        $select_academic    =  mysqli_query($connection, "SELECT * FROM academic_year WHERE academic_id = {$idea_academic_id}");
                        $row                =  mysqli_fetch_array($select_academic);
                        $final_closure_date =  strtotime($row['final_closure_date']);
                        $today              =  strtotime("now");

                            if ($today < $final_closure_date){

                                $comment_query         =  "INSERT INTO comments(comment_content, comment_checkbox, user_id, idea_id, comment_date)
                                                          VALUES ('{$comment_content}', '{$comment_checkbox}', $session_user_id, $the_idea_id, now())";
                                $create_comment_query  =  mysqli_query($connection, $comment_query);
                                $comment_count_query   =  mysqli_query($connection, "UPDATE ideas SET idea_comment_count = idea_comment_count + 1 WHERE idea_id = {$the_idea_id} ");

                                    if (!$create_comment_query) {

                                        die('QUERY FAILED' . mysqli_error($connection));

                                    }

                                $select_idea_info  =  mysqli_query($connection, "SELECT * FROM ideas WHERE idea_id = $the_idea_id");
                                $idea_row          =  mysqli_fetch_array($select_idea_info);
                                $idea_user_id      =  $idea_row['user_id'];

                                $select_user_info  =  mysqli_query($connection, "SELECT * FROM users WHERE user_id = $idea_user_id");
                                $user_row          =  mysqli_fetch_array($select_user_info);

                                $user_email        =  $user_row['user_email'];
                                $user_username     =  $user_row['username'];

    //                        mail function start

                                $subject  = "Comment Notification";
                                $body     = "Dear" . " " . $user_username . "," . "your ideas got comment";
                                mail($user_email,$subject,$body);

    //                        mail function end

                            } else{

                                echo "<script>alert('You cannot comment after the final closure date')</script>";

                            }

                    }

                }//end request medthod

                    echo "<script>window.location.alert('/tc/staff/idea.php?i_id=$the_idea_id')</script>";

                ?>


                <form action="" method="post">

                    <div class="col-sm-4">
                                <textarea name="idea_comment_content" id="" cols="" rows="2"
                                          class="form-control" required placeholder="Write your comment"></textarea>
                    </div>
                    <br>


                    <div class="col-sm-8">
                        <input type="hidden" value="" name="comment_checkbox">
                        <input type="checkbox" for="anonymous" value="anonymous" name="comment_checkbox">
                        <label for="">If you want to comment as anonymous, click that box.</label>

                    </div>


                    <div class="col-sm-4">

                        <input type="submit" name="idea_comment_create" Value="Post Comment" class="btn btn-secondary">

                    </div>

                </form>


                <?php

                //    show-comment
                $show_comment        =  "SELECT * FROM comments WHERE idea_id = $the_idea_id";
                $show_comment_query  =  mysqli_query($connection, $show_comment);

                    while ($row = mysqli_fetch_assoc($show_comment_query)) {

                        $comment_content   =  $row['comment_content'];
                        $comment_checkbox  =  $row['comment_checkbox'];
                        $comment_user_id   =  $row['user_id'];
                        $comment_idea_id   =  $row['idea_id'];
                        $comment_date      =  $row['comment_date'];
                        ?>

                        <div class="card mb-2 mt-2 border-left-info border-info text-dark ml-2">
                            <div class="card-body">
                                <h1 class="h5 card-title">
                                    <div class="row">
                                        <div class="col-10 font-weight-bold">
                                            <?php
                                            if ($comment_checkbox === 'anonymous') {

                                                echo "Anonymous";

                                            } else {

                                                $select_user       =  "SELECT * FROM users WHERE user_id = {$comment_user_id}";
                                                $select_user_query =  mysqli_query($connection, $select_user);

                                                    while ($row = mysqli_fetch_assoc($select_user_query)) {

                                                        echo $username = $row['username'];

                                                    }

                                            }
                                            ?>
                                        </div>

                                        <div class="col-sm-2 small"><?php echo $comment_date; ?></div>

                                    </div>

                                </h1>
                                <?php echo $comment_content; ?>
                            </div>
                        </div>
                    <?php } ?>

            </div>

            <!-- </div> -->


            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->


            </div>


        </div>
        <?php include "include/footer.php"; ?>
<!--        javascript function for like and unlike-->
        <script>
            $(document).ready(function () {

                var idea_id = <?php echo $the_idea_id ?>

                var user_id = <?php echo $session_user_id ?>

                    //like (start)
                    $('.like').click(function () {


                        $.ajax({

                            url: "",
                            type: 'post',
                            data: {
                                'liked': 1,
                                'idea_id': idea_id,
                                'user_id': user_id
                            }


                        })

                    });

                //like (end)

                //unlike(start)
                $('.unlike').click(function () {


                    $.ajax({

                        url: "",
                        type: 'post',
                        data: {
                            'unliked': 1,
                            'idea_id': idea_id,
                            'user_id': user_id
                        }


                    })

                });


            });


        </script>
