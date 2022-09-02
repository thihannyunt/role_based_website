
                <?php 
                    if (isset($_SESSION)) {

                        $user_id  = $_SESSION['user_id'];
                        $username = $_SESSION['username'];
                            
                    }

                    if (isset($_POST['create_idea'])) {
                        


                        if (isset($_POST['category_name']) == ""  ) {

                            echo "<script>alert('Related Category must be choose')</script>";

                        } else if(isset($_POST['academic_name']) == "" ) {

                            echo "<script>alert('Related Academic Year Name must be choose')</script>";

                        }

                        else{

                            $the_user_id = $user_id;

                            $the_academic_id = $_POST['academic_name'];
                            $the_idea_checkbox = $_POST['idea_checkbox'];
                            $the_category_id   = $_POST['category_name'];

                            //////////attachmetn code

                            $the_idea_attachment=$_FILES['idea_attachment']['name'];
                            $the_idea_attachment_temp = $_FILES['idea_attachment']['tmp_name'];

                            move_uploaded_file($the_idea_attachment_temp,"img/$the_idea_attachment");
                          

                            //attachemtn code kyn
                            $the_idea_content = mysqli_real_escape_string($connection, $_POST['idea_content']);


                            // closure date check
                            $academic_query = "SELECT * FROM academic_year WHERE academic_id = {$the_academic_id}";
                            $select_academic_query = mysqli_query($connection, $academic_query);
                            $row = mysqli_fetch_array($select_academic_query);

                                $academic_start_date = strtotime($row['start_date']);
                                $academic_closure_date = strtotime($row['closure_date']);
                                $academic_final_closure_date = strtotime($row['final_closure_date']);
                                $today_date = strtotime("now");

                                if ($today_date >= $academic_start_date && $today_date <= $academic_closure_date){

                                    $query = "INSERT INTO ideas(idea_checkbox, idea_content, idea_attachment, user_id, category_id, academic_id, idea_date) VALUES ('{$the_idea_checkbox}', '{$the_idea_content}', '{$the_idea_attachment}', '{$the_user_id}', '{$the_category_id}','{$the_academic_id}',now() )";
                                    $create_post_query = mysqli_query($connection, $query);

                                    if (!$create_post_query) {

                                        die("QUERY FAILED" . mysqli_error($connection));

                                    }

                                    $the_idea_id = mysqli_insert_id($connection);

                                    echo "Posted <a href='show_idea_detail.php?i_id={$the_idea_id}'> View Post </a> ";

                                }

                                else{

                                    echo "<script>alert('You cannot post the ideas after Closure Date But you can still comment on the ideas until final closure date ')</script>";



                                }

                        }

                    }


                 ?>

                    <!-- Page Heading -->
                    <h2 class="h3 text-dark">Ideas</h2>
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                Tell us about your ideas
                            </div>
                            <div class="card-body">
                                <form action="" method="post" class="text-dark" enctype="multipart/form-data">
                                    <!-- username and anonymouse -->
                                    <div class="row g-3 align-items-center mb-3">
                                            <div class="col-sm-8">
                                                <label for="username" class="col-form-label" value= <?php echo $user_id;  ?> > <?php echo $username;  ?>, </label>
                                            </div>   

                                            <div class="col-sm-8">
                                                <input type="hidden" value="" name="idea_checkbox">
                                                <input type="checkbox" for="anonymous" value="anonymous" name="idea_checkbox">
                                                <label for="">If you want to post as anonymous, click that box.</label>

                                            </div>                                         
                                    </div>

                                    <hr>

                                    <!-- for category -->
                                    <div class="row g-3 align-items-center mb-3">
                                        <div class="col-sm-1">
                                            <label for="category" class="col-form-label">Category</label>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="col-sm-8">
                                                <select name="category_name" id="" class="form-control" required>
                                                    <?php //role type ko add post mhr pw chin loz tone tk hr

                                                    global $connection;
                                                    $query = "SELECT * FROM category";
                                                    $select_category = mysqli_query($connection, $query);
                                                    ?>

                                                            <option disabled selected>Choose the related category for your ideas</option>";
                                                    <?php
                                                    while ($row = mysqli_fetch_assoc($select_category)) {

                                                        $category_id = $row['category_id'];
                                                        $category_name = $row['category_name'];

                                                            
                                                            echo "<option value='{$category_id}'>{$category_name}</option>";                                                
                                                        }
                                                    ?>
                                                        

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- for academic year -->
                                    <div class="row g-3 align-items-center mb-3">
                                        <div class="col-sm-1">
                                            <label for="category" class="col-form-label">Academic Year Name</label>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="col-sm-8">
                                                <select name="academic_name" id="" class="form-control" required>
                                                    <?php

                                                    global $connection;
                                                    $query = "SELECT * FROM academic_year";
                                                    $select_academic = mysqli_query($connection, $query);
                                                    ?>

                                                    <option disabled selected>Choose the related category for your ideas</option>";
                                                    <?php
                                                    while ($row = mysqli_fetch_assoc($select_academic)) {

                                                        $academic_id = $row['academic_id'];
                                                        $academic_year_name = $row['academic_year_name'];


                                                        echo "<option value='{$academic_id}'>{$academic_year_name}</option>";
                                                    }
                                                    ?>


                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-3 align-items-center mb-3">
                                        <div class="col-sm-2">
                                            <label for="attach" class="col-form-label">Attach doccuments:</label>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="col-sm-2">
                                               <input type="file" name="idea_attachment" id="">
                                            </div>
                                        </div>
                                    </div>

                                    

                                    <div class="row g-3 align-items-center mb-3">
                                        <div class="col-sm-1">
                                            <label for="content" class="col-form-label">Content</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <textarea name="idea_content" id="" cols="" rows="3"
                                                      class="form-control" required placeholder="Write your ideas"></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6 col-sm-offset-4">
                                            
                                            <input type="submit" name="create_idea" Value="Post" class="btn btn-info">
                                    </div>
                                    







                                </form>
                            </div>
                        </div>
                    
               

            

            