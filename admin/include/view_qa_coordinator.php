<div class="text-dark">
<h2 class="h5 text-dark mb-3"><i class="fas fa-user"></i> View QA Coordinator</h2>
<table class="table table-bordered table-hover table-responsive-sm text-dark text-center">
    <thead class="thead-light">
        <tr>
            <th>Username</th>
            <th>Department Name</th>
            <th>Role Type</th>
            <th colspan="2">Option</th>
        </tr>

    </thead>

    <tbody>
        <?php
        //select data from databasae for the table
        $select_something  =  mysqli_query($connection, "SELECT u.username,u.user_id, u.role_id, u.dept_id, d.dept_name, r.role_type 
                                                            FROM users AS u 
                                                            LEFT JOIN department AS d 
                                                            ON u.dept_id = d.dept_id 
                                                            LEFT JOIN roles AS r
                                                            ON u.role_id = r.role_id WHERE r.role_id =7");

            while ($row = mysqli_fetch_array($select_something)){

                $user_id   =  $row['user_id'];
                $username  =  $row['username'];
                $dept_name =  $row['dept_name'];
                $role_type =  $row['role_type'];

                echo "<tr>";
                    echo "<td>{$username}</td>";
                    echo "<td>{$dept_name}</td>";
                    echo "<td>{$role_type}</td>";

                    echo "<td><a href='user.php?source=edit_user&u_id={$user_id}'> <i class='fas fa-edit'></i> </a> </td>";
                    echo "<td><a href='user.php?source=view_qa_coordinator&delete={$user_id}'> <i class='fas fa-trash'></i> </a> </td>";
                echo "</tr>";
            }
        ?>

    </tbody>

</table>
<div>
    <center> <a href="user.php?source=add_qa_coordinator"><i class="fas fa-plus-circle fa-lg"></i></a> QA Coordnator</center>
</div>

<?php //delete code

if (isset($_GET['delete'])) {

    echo $the_user_id  =  $_GET['delete'];

    $query              =  "DELETE FROM users WHERE user_id = {$the_user_id}";
    $delete_user_query  =  mysqli_query($connection, $query);

    echo "<script>window.location.href='user.php?source=view_qa_coordinator'</script>";

}

?>

</div>