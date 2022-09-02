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

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h5 mb-0 text-gray-800"><i class="fas fa-comment"></i> Latest Comments</h1>
                </div>

                <?php
                $per_page = 10;

                if (isset($_GET['page'])) {

                    $page = $_GET['page'];

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

                    $post_query_count  =  "SELECT comment_id FROM comments";
                    $find_count        =  mysqli_query($connection, $post_query_count);
                    $count             =  mysqli_num_rows($find_count);

                if($count < 1){

                    echo "<h4 class='text-center'><i class='fas fa-grin-beam-sweat'></i> No Comments available</h4>";

                } else {

                    $count = ceil($count / $per_page);

                    $select_comments = mysqli_query($connection, "SELECT * FROM comments ORDER BY comment_id DESC LIMIT $page_1, $per_page");
                    while($row = mysqli_fetch_array($select_comments)){

                        $comment_content  =  $row['comment_content'];
                        $comment_checkbox =  $row['comment_checkbox'];
                        $comment_user_id  =  $row['user_id'];
                        $comment_idea_id  =  $row['idea_id'];
                        $comment_date     =  $row['comment_date'];

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

                                                    echo $username =  $row['username'];
                                                }
                                            }
                                            ?>
                                        </div>
                                        <div class="col-sm-2 small"><?php echo $comment_date; ?></div>
                                    </div>
                                </h1>
                                <div class="card-text"><?php echo $comment_content; ?></div>
                            </div>
                            <div class="card-footer">
                                <a href="show_idea_detail.php?i_id=<?php echo $comment_idea_id; ?>" style="text-decoration: none;">
                                    <i class="fas fa-arrow-circle-right"></i> View Ideas</a>
                            </div>
                        </div>
                <?php }} ?>
                <center>
                    <ul class="pager" >

                        <?php

                        for ($i=1; $i <= $count ; $i++) {

                            if($i == $page){

                                echo "<li><a class='active_link' href='latest_comments.php?page={$i}'>{$i}</a></li>";

                            }

                            else{

                                echo "<li><a href='latest_comments.php?page={$i}'>{$i}</a></li>";

                            }

                        }

                        ?>

                    </ul>
                </center>

            </div>

        </div>

        <?php include "include/footer.php"; ?>

        <style>

            .pager li{display:inline}.pager li>a,
                                     .pager li>span{display:inline-block;padding:5px 14px;background-color:#fff;border:1px solid #ddd;border-radius:15px}

            .pager li>a:focus,.pager li>a:hover{text-decoration:none;background-color:#eee}

            .pager li .active_link{

                background: #C1F1FF !important;

            }

        </style>


