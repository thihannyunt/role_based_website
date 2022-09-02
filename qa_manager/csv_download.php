<?php include "../include/db.php"; ?>

<?php

    //select from dataabase to make a condition to ensure that data can be downloaded after final closure date.
    $select_academic_year    =  mysqli_query($connection, "SELECT * FROM academic_year WHERE action='active'");
    $row                     =  mysqli_fetch_array($select_academic_year);

    $academic_start_date     =  $row['start_date'];
    $academic_closure_date   =  $row['closure_date'];
    $academic_f_closure_date =  strtotime($row['final_closure_date']);
    $today_date              =  strtotime("now");

        if($today_date<$academic_f_closure_date){

            echo "<script>alert('You cannot download data before the final closure date ')
                            window.location.href='download_data.php'</script>";

        } else {

            if (isset($_GET['data'])) {

                $data = $_GET['data'];

            }

            $column_names = array();

            if ($data == 'department') {

                $column_names = array('dept_id', 'dept_name');

            } else if ($data == 'academic_year') {

                $column_names = array('academic_id', 'start_date', 'closure_date', 'final_closure_date', 'academic_year_name');

            } else if ($data == 'category') {

                $column_names = array('category_id', 'category_name');

            } else if ($data == 'comments') {

                $column_names = array('comment_id', 'comment_content', 'comment_checkbox', 'user_id', 'idea_id', 'comment_date');

            } else if ($data == 'ideas') {

                $column_names = array('idea_id', 'idea_comment_checkbox', 'idea_content', 'idea_attachment', 'user_id', 'category_id', 'academic_id', 'idea_date', 'idea_likes', 'idea_dislikes', 'idea_comment_count', 'idea_view_count, dept_id');

            } else if ($data == 'rating_info') {

                $column_names = array('id', 'user_id', 'idea_id', 'rating');

            } else if ($data == 'roles') {

                $column_names = array('role_id', 'role_type');

            } else if ($data == 'users') {

                $column_names = array('user_id', 'username', 'user_dob', 'user_gender', 'user_phone', 'user_address', 'user_email', 'user_password', 'role_id', 'dept_id');

            }

            $select_data  =  mysqli_query($connection, "SELECT * FROM $data");
            $data_row     =  mysqli_fetch_all($select_data);

        //function
            function csv_create($row_name, $file_name)
            {

                global $column_names;
                $list  =  array($row_name);
                $fp    =  fopen($file_name, 'w');
                fputcsv($fp, $column_names);
                foreach ($list as $fields) {

                    foreach ($fields as $field) {

                        fputcsv($fp, $field);
                    }

                }

                fclose($fp);

            }

            csv_create($data_row, $data . '.csv');

        //csv create and donwload

            $file = $data . '.csv';

            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=$file");

            readfile($file);
            exit();

        }


?>




