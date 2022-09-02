<?php include "../../include/db.php"; ?>

<?php



if (isset($_GET['i_id'])) {




    $the_idea_id=$_GET['i_id'];

    $delete_ideas_query = mysqli_query($connection, "DELETE FROM ideas WHERE idea_id = {$the_idea_id}");



    $delete_comment_query = mysqli_query($connection, "DELETE FROM comments WHERE idea_id = {$the_idea_id}");

    echo "<script>window.location.href='../forum.php'</script>";

}
?>
