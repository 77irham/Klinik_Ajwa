<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Delete Record</title>
</head>

<body>
    <?php
    include("header.php"); ?>

    <h2>Delete a Record</h2>

    <?php
    //look for a valid id, either through GET or POST
    if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
        $id = $_GET['id'];
    } elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
        $id = $_POST['id'];
    } else {
        echo '<p class="error">This page has been accessed in error.</p>';
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($_POST['sure'] == 'Yes') {
            //Make The Query
            $q = "DELETE FROM doktor WHERE ID = $id LIMIT 1";
            $result = @mysqli_query($connect, $q);

            if (mysqli_affected_rows($connect) == 1) {
                //Display Message
                echo '<h3>The record has been deleted.</h3>';
            } else {
                // Display errror message
                echo '<p class="error">The record could not be deleted due to a system error.</p>';
                //Debugging Messaging
                echo '<p>' . mysqli_error($connect) . '<br/>Query: ' . $q . '</p>';
            }
        } else {
            echo '<h3>The record has not been deleted.</h3>';
        }
    } else {
        // Display the form
        //Retrieve the member's data
        $q = "SELECT * FROM doktor WHERE ID = $id";
        $result = @mysqli_query($connect, $q);

        if (mysqli_num_rows($result) == 1) {
            // Get the member's data
            $row = mysqli_fetch_array($result, MYSQLI_NUM);
            echo "<h3>Are you sure you want to permanently delete $row[1]? </h3>"; // Use the correct column name from your database table
            echo '<form action="delete_doktor.php" method="post">
                    <input type="submit" name="sure" value="Yes" />
                    <input type="submit" name="sure" value="No" />
                    <input type="hidden" name="id" value="' . $id . '" />
                  </form>';
        } else {
            echo '<p class="error">This page has been accessed in error.</p>';
            echo '<p>&nbsp;</p>';
        }
    }
    // Close the database connection
    mysqli_close($connect);

    ?>
</body>

</html>