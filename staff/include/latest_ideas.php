

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Latest Ideas</h1>                        
                    </div>

                    <div>  




                        <?php

                        $per_page = 3;

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

                                //p1 =  

                            }

                            $post_query_count = "SELECT idea_id FROM ideas";
                            $find_count= mysqli_query($connection, $post_query_count);
                            $count = mysqli_num_rows($find_count);
                            
                            if($count < 1){

                                echo "<h1 class='text-center'>NO Ideas available</h1>";

                            } else {



                            

                             $count = ceil($count / $per_page);



                            $ideas_query = "SELECT * FROM ideas ORDER BY idea_id DESC LIMIT $page_1, $per_page";
                            $select_post = mysqli_query($connection, $ideas_query);
                            while ($row = mysqli_fetch_assoc($select_post)) {

                                    $idea_id = $row['idea_id'];
                                    $user_idea_id = $row['user_id'];
                                    $idea_checkbox = $row['idea_checkbox'];
                                    $idea_date = $row['idea_date'];
                                    $idea_view_count = $row['idea_view_count'];
                                    $idea_attachment = $row['idea_attachment'];
                                    $idea_content = $row['idea_content'];
                                    $idea_category_id = $row['category_id'];
                        ?>


                        <div class="card">

                            <div class="card-header bg-primary text-white">
                                
                                
                                <?php   
                                    if ($idea_checkbox == 'anonymous') {
                                        echo " Author Name -" . " Anonymous";  
                                    }
                                    else{

                                        $user_query = "SELECT * FROM users WHERE user_id = {$user_idea_id}";
                                        $select_user = mysqli_query($connection, $user_query);
                                        while ($row = mysqli_fetch_assoc($select_user)) {

                                            echo " Author Name -" . $username = $row['username'];
                                            
                                        }
                                    }
                                ?>

                                <div >


                                    <?php 
                                        $category_query ="SELECT * FROM category WHERE category_id = {$idea_category_id} ";
                                        $select_category_query= mysqli_query($connection, $category_query);
                                        while ($row = mysqli_fetch_assoc($select_category_query)) {
                                            
                                            echo "Category name - " . $row['category_name'];
                                    // echo $idea_category_id;

                                        }

                                     ?>
                                    
                                </div>
                                
                                <div> <?php echo "Date - " .  $idea_date; ?> </div>

                                <div> <?php echo "View Count - " .  $idea_view_count; ?> </div>

                            </div>
                            <br>

                            <div>  
                                <a href="show_idea_detail.php?i_id=<?php echo $idea_id; ?>">
                                    <center>
                                    <img width="500px" height="500px"  src="img/<?php echo $idea_attachment ?>" alt="">
                                    </center>
                                </a>

                            </div>

                            <br>

                            <div>
                                
                                <p> <?php echo $idea_content; ?> </p>

                            </div>

                            
                                
                            <div>
                                <a href="show_idea_detail.php?i_id=<?php echo $idea_id; ?>">
                                    <input type="submit" value="Comment" class="btn btn-info"/>
                                </a>
                               
                            </div>
                                
                            <hr>
                            

                            <?php
                            } }
                            ?>
                        <center>   
                          <ul class="pager" >
                    
                        <?php 

                            for ($i=1; $i <= $count ; $i++) { 

                                if($i == $page){

                                    echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";

                                }

                                else{

                                    echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";

                                }
                       
                      
                            }

                        ?>

                    </ul>  
                    </center>  



                        </div>



                    



                            

                             

                    </div>  

                    
                

<style>
    
.pager li{display:inline}.pager li>a,
.pager li>span{display:inline-block;padding:5px 14px;background-color:#fff;border:1px solid #ddd;border-radius:15px}

.pager li>a:focus,.pager li>a:hover{text-decoration:none;background-color:#eee}

.pager li .active_link{

    background: #C1F1FF !important;

}

</style>
      

            