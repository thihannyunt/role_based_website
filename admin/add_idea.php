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
            <div class="container-fluid">

                <?php
                //get data from session
                if (isset($_SESSION)) {

                    $user_id   =  $_SESSION['user_id'];
                    $username  =  $_SESSION['username'];
                    $dept_id   =  $_SESSION['dept_id'];

                }
                //if condition for blank
                if (isset($_POST['create_idea'])) {


                    if (isset($_POST['category_name']) == "") {

                        echo "<script>alert('Related Category must be choose')</script>";

                    } else if (isset($_POST['academic_name']) == "") {

                        echo "<script>alert('Related Academic Year Name must be choose')</script>";

                    } else if (!isset($_POST['checkbox'])) {

                        echo "<script>alert('Please agree Terms & Conditions')</script>";
                        echo "<script>window.location='idea.php?source=add_idea'</script>";

                    } else {

                        $the_user_id               =  $user_id;
                        $the_academic_id           =  $_POST['academic_name'];
                        $the_idea_checkbox         =  $_POST['idea_checkbox'];
                        $the_category_id           =  $_POST['category_name'];

                        $the_idea_attachment       =  $_FILES['idea_attachment']['name'];
                        $the_idea_attachment_temp  =  $_FILES['idea_attachment']['tmp_name'];

                            move_uploaded_file($the_idea_attachment_temp, "../images/$the_idea_attachment");

                        $the_idea_content          =  mysqli_real_escape_string($connection, $_POST['idea_content']);


                        // closure date check
                        $academic_query         =  "SELECT * FROM academic_year WHERE academic_id = {$the_academic_id}";
                        $select_academic_query  =  mysqli_query($connection, $academic_query);
                        $row                    =  mysqli_fetch_array($select_academic_query);

                            $academic_start_date          =  strtotime($row['start_date']);
                            $academic_closure_date        =  strtotime($row['closure_date']);
                            $academic_final_closure_date  =  strtotime($row['final_closure_date']);
                            $today_date                   =  strtotime("now");

                            if ($today_date >= $academic_start_date && $today_date <= $academic_closure_date) {

                                $query             =  "INSERT INTO ideas(idea_checkbox, idea_content, idea_attachment, user_id, category_id, academic_id, idea_date, dept_id)
                                                       VALUES ('{$the_idea_checkbox}', '{$the_idea_content}', '{$the_idea_attachment}', '{$the_user_id}', '{$the_category_id}','{$the_academic_id}',now(), '{$dept_id}' )";
                                $create_post_query =  mysqli_query($connection, $query);

                                    if (!$create_post_query) {

                                        die("QUERY FAILED" . mysqli_error($connection));

                                    }
                                $the_idea_id  =  mysqli_insert_id($connection);

                                //select data for sending mail
                                $select_department_id =  mysqli_query($connection, "SELECT * FROM users WHERE user_id = $the_user_id");
                                $row                  =  mysqli_fetch_array($select_department_id);
                                $the_department_id    =  $row['dept_id'];

                                $select_department    =  mysqli_query($connection, "SELECT * FROM department WHERE dept_id = $the_department_id");
                                $row                  =  mysqli_fetch_array($select_department);
                                $the_department_name  =  $row['dept_name'];

                                $select_role          =  mysqli_query ($connection, "SELECT * FROM roles WHERE role_type = 'qa_coordinator'");
                                $row                  =  mysqli_fetch_array($select_role);
                                $the_role_id          =  $row['role_id'];

                                $select_user          =  mysqli_query($connection,"SELECT * FROM users WHERE role_id = 7 AND dept_id = $the_department_id");
                                $user_row             =  mysqli_fetch_array($select_user);

                                $user_num_row         =  mysqli_num_rows($select_user);

                                    if($user_num_row > 0){

                                        $username    =  $user_row['username'];
                                        $user_email  =  $user_row['user_email'];

        //                        mail function start
                                        $subject     =  "Post Idea Notification";
                                        $body        =  "Dear QA Coordinator, one of the staff from your" . " " . "$the_department_name". " " . "posted an ideas";

                                            mail($user_email,$subject,$body);

        //                        mail function end
                                        echo "<center>
                                        Posted <a href='show_idea_detail.php?i_id={$the_idea_id}'><i class='fas fa-arrow-circle-right'></i> View Post </a></center> ";

                                    } else{

                                        echo "<center>
                                        Posted <a href='show_idea_detail.php?i_id={$the_idea_id}'><i class='fas fa-arrow-circle-right'></i> View Post </a></center> ";

                                    }

                            }else if($today_date < $academic_start_date){

                                echo "<script>alert('You cannot post the ideas before the Start Date')</script>";

                            }
                            else {

                                echo "<script>alert('You cannot post the ideas after Closure Date But you can still comment on the ideas until final closure date ')</script>";

                            }

                    }

                }

                $select_academic_id = mysqli_query($connection, "SELECT academic_id FROM academic_year");
                $academic_num_rows = mysqli_num_rows($select_academic_id);

                if ($academic_num_rows == 0){

                    echo"<center><h4> Hey admin, add Academic Year First </h4></center>";
                    ?>
                    <center> <a href="academic_year.php?source=add_academic"><i class="fas fa-plus-circle fa-lg"></i></a> Academic Year</center>
                    <?php

                }

                else{




                $select_closure_date  =  mysqli_query($connection, "SELECT * FROM academic_year WHERE action='active'");
                $row                  =  mysqli_fetch_array($select_closure_date);

                    $academic_closure_date  =  $row['closure_date'];
                ?>

                <div class="h4 text-dark text-center mb-3"><i class="fas fa-laugh-wink"></i> You can post the ideas before <i class="fas fa-calendar-alt"></i> <?php echo $academic_closure_date ?></div>

                <!-- Page Heading -->
                <h2 class="h4 text-dark"><i class="fas fa-list-alt"></i> Post Ideas</h2>
                <div class="card text-dark">
                    <div class="card-header  text-white" style="background-color: #3a4d4d;">
                        <i class="fas fa-paper-plane"></i>&nbsp;
                        Tell us about your ideas
                    </div>
                    <div class="card-body">
                        <form action="" method="post" class="text-dark" enctype="multipart/form-data">
                            <!-- username and anonymouse -->
                            <div class="form-group">
                                <div class="col-sm-8">
                                    <label for="username" class="col-form-label"
                                           value= <?php echo $user_id; ?>> <?php echo $username; ?>, </label>
                                </div>

                                <div class="col-sm-8 form-check">
                                    <input type="hidden" class="form-control" value="" name="idea_checkbox">
                                    <input type="checkbox" class="form-check-input"  for="anonymous" value="anonymous" name="idea_checkbox">
                                    <label for="">If you want to post as anonymous, click that box.</label>

                                </div>
                            </div>

                            <hr>

                            <!-- for category -->
                         
                                <div class="form-group">
                                        <label for="exampleFormControlSelect1">Category :</label>
                                        <select class="custom-select" name="category_name" id="exampleFormControlSelect1" required>
                                            <?php //role type ko add post mhr pw chin loz tone tk hr

                                            global $connection;
                                            $query            =  "SELECT * FROM category";
                                            $select_category  =  mysqli_query($connection, $query);
                                            ?>

                                                <option disabled selected>Choose the related category for your ideas</option>
                                            
                                            <?php
                                            while ($row = mysqli_fetch_assoc($select_category)) {

                                                $category_id    =  $row['category_id'];
                                                $category_name  =  $row['category_name'];

                                                echo "<option value='{$category_id}'>{$category_name}</option>";

                                            }

                                            ?>
                                        </select>                      
                                </div>
<!--                            for acdemic year-->
                                <div class="form-group">
                                    <label for="academic" class="form-label">Academic Year Name:</label>
                                        <select name="academic_name" id="academic" class="form-control" required>
                                            <?php
                                            global $connection;
                                            $query            =  "SELECT * FROM academic_year WHERE action='active'";
                                            $select_academic  =  mysqli_query($connection, $query);

                                                while ($row =  mysqli_fetch_assoc($select_academic)) {

                                                    $academic_id        =  $row['academic_id'];
                                                    $academic_year_name =  $row['academic_year_name'];

                                                    echo "<option value='{$academic_id}'>{$academic_year_name}</option>";

                                                }
                                            ?>
                                        </select>                                 
                                </div>
<!--                            for attach documents-->
                              <div class="form-group">
                                  <label for="exampleInputFile">Attach documents:</label>
                                  <input type="file" id="exampleInputFile" name="idea_attachment">
                                  
                              </div>

                            <div class="form-group">
                                
                                    <label for="content" class="col-form-label">Content:</label>
                           
                                    <textarea name="idea_content" id="" cols="" rows="3" class="form-control" required placeholder="Write your ideas"></textarea>
                                
                            </div>
<!--                            for terms and conditions-->
                            <div class="form-group">
                                <div class="form-check">            
                                    <input type="checkbox" name="checkbox" class="form-check-input">
                                     I agree <a class="" style="cursor: pointer;" data-toggle="modal" data-target="#exampleModal">Terms & Conditions</a>

                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Terms and Conditions</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p >Please review our Terms and Conditions and Privacy Notice, which also govern your visit to our site.<br>
                                                    Your participation in the Discussion Forums constitutes your acknowledgment of and agreement to the following terms and conditions:
                                                </p>
                                                <hr>
                                                <p >
                                                    (1) The University Administration does not review messages posted by participants of the Discussion Forums, nor does it attempt to screen or verify any statements made in the forums.<br>
                                                    (2) The University Administration reserves the right to edit or delete any posted message it considers inappropriate, and/or to deny access to the Discussion Forums to anyone who violates these terms and conditions.<br>
                                                    (3) Discussion forum communications do not constitute legal advice, nor do they create a lawyer-client relationship. <br>
                                                    (4) Discussion Forum communications are not confidential and cannot be used to disqualify a participant from representing an adverse party.<br>
                                                    (5) The opinions expressed by Discussion Forum participants do not necessarily reflect those of the University Administration, its Sections, or Committees. <br>
                                                    (6) All messages and information posted or accessed in the Discussion Forums are offered "as is" without any endorsements, guarantees, or warranties by the University Administration. <br>
                                                    (7) You must not post or transmit any unlawful, threatening, abusive, libelous, defamatory, obscene, pornographic, profane, or otherwise objectionable information of any kind, including without limitation any transmissions constituting or encouraging conduct that would constitute a criminal offense, give rise to civil liability, or otherwise violate any local, state, national or international law.<br>
                                                    (8) You must not post or transmit any information or software that contains a virus or other harmful component. <br>
                                                    (9) Discussion Forums cannot be used to exchange information, services, materials, or software in return for payment of any kind (trade of like items, special discounts, cash, etc.). <br>
                                                    (10) You must not post any message or information that violates the copyright, trademark, trade secret, privacy, or publicity rights of any third party. <br>
                                                    (11) You should know that any information you disclose in a Discussion Forum can be obtained by any other registered user of that forum or persons to whom the information is forwarded. This may result in unsolicited emails or mail sent to you. The University Administration cannot control this occurrence, and you are encouraged to consider this when posting information. <br>
                                                    (12) By participating in a Discussion Forum, you are agreeing that all messages posted or accessed will be used only for informational, educational, or professional purposes. There may be no commercial or other unauthorized use of the Discussion Forum participant lists. <br>
                                                    (13) By posting a message to a Discussion Forum, you grant the University Administration a non-exclusive license to copy and distribute the posting. Your redistribution, electronically or otherwise, of messages or information posted by other participants, is not permitted without the express written permission of that participant. <br>
                                                </p>
                                                <hr>
                                                <h5>Contact Us</h5>
                                                <p>
                                                    If you have any questions about these terms and conditions, the practices of this site, or your dealings with this site, please contact us here:
                                                    <a href="mailto:tcompass311@gmail.com">tcompass311@gmail.com</a>
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-dark" data-dismiss="modal">Understand</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                                            
                            <div class="col-sm-6 col-sm-offset-4 mt-3">

                                <input type="submit" name="create_idea" Value="Post" class="btn btn-secondary">
                            </div>
                            
                        </form>
                        
                    </div>
                    
                </div>
                <?php } ?>

            </div>

        </div>

        <?php include "include/footer.php"; ?>
        
