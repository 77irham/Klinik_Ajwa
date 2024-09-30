<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Klinik Ajwa</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>

    <?php
    // Include file to connect to the server (My Website)
    include("header.php");

    // This section processes submissions from the login form
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Validate the ID
        if (!empty($_POST['ID'])) {
            $un = mysqli_real_escape_string($connect, $_POST['ID']);
        } else {
            $un = FALSE;
            echo '<p class="error">You forgot to enter your ID.</p>';
        }

        // Validate the password
        if (!empty($_POST['Password'])) {
            $p = mysqli_real_escape_string($connect, $_POST['Password']);
        } else {
            $p = FALSE;
            echo '<p class="error">You forgot to enter your password.</p>';
        }

        // If no validation errors
        if ($un && $p) {
            // Query to retrieve the user information
            $q = "SELECT ID, FirstName, LastName, Specialization, Password FROM Doktor WHERE ID = '$un' AND Password = '$p'";

            // Execute the query
            $result = mysqli_query($connect, $q);

            // Check if there is a match
            if (mysqli_num_rows($result) == 1) {
                // Start session and store the user data in $_SESSION
                session_start();
                $_SESSION = mysqli_fetch_array($result, MYSQLI_ASSOC);

                echo '<p>Login successful. Welcome!</p>';
            } else {
                echo '<p class="error">The username and password entered do not match our records. Perhaps you need to register, just click the Register button.</p>';
            }

            // Free the result and close the connection
            mysqli_free_result($result);
            mysqli_close($connect);
        } else {
            echo '<p class="error">Please try again.</p>';
        }
    }
    ?>

    <h2 align="center">LOGIN</h2>

    <form action="login.php" method="post">
        <p>
            <label class="label" for="ID">ID: </label>
            <input id="ID" type="text" name="ID" size="4" maxlength="6" value="<?php if (isset($_POST['ID'])) echo $_POST['ID']; ?>" />
        </p>

        <p>
            <label class="label" for="Password">Password: </label>
            <input id="Password" type="password" name="Password" size="15" maxlength="60" value="<?php if (isset($_POST['Password'])) echo $_POST['Password']; ?>" />
        </p>

        &nbsp;
        <p align="left">
            <input id="submit" type="submit" name="submit" value="login" />&nbsp;
            <input id="reset" type="reset" name="reset" value="reset" />
        </p>
    </form>

    <p align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Don't have an account?
        <a href="registerDoktor.php">Sign up</a>
    </p>

</body>

</html>