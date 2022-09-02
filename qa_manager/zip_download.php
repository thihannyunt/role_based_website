
<?php
include "../include/db.php";
//select data from academic year table for if statement
    $select_academic_year     =  mysqli_query($connection, "SELECT * FROM academic_year WHERE action='active'");
    $row                      =  mysqli_fetch_array($select_academic_year);

    $academic_start_date      =  $row['start_date'];
    $academic_closure_date    =  $row['closure_date'];
    $academic_f_closure_date  =  strtotime($row['final_closure_date']);
    $today_date               =  strtotime("now");

        if($today_date<$academic_f_closure_date){

            echo "<script>alert('You cannot download data before the final closure date ')
                            window.location.href='download_data.php'</script>";

        } else {

        // Get real path for our folder
            $rootPath = realpath('../images/');

            // Initialize archive object
            $zip = new ZipArchive();
            $zip->open('idea_attachment.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

            // Create recursive directory iterator
            /** @var SplFileInfo[] $files */
            $files = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($rootPath),
                RecursiveIteratorIterator::LEAVES_ONLY
            );

            foreach ($files as $name => $file)
            {
                // Skip directories (they would be added automatically)
                if (!$file->isDir())
                {
                    // Get real and relative path for current file
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($rootPath) + 1);

                    // Add current file to archive
                    $zip->addFile($filePath, $relativePath);

                }

            }

            // Zip archive will be created only after closing object
            $zip->close();

            $file = 'idea_attachment.zip';

            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=$file");

            readfile($file);
            exit();

        }

?>




