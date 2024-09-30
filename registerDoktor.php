<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Klinik Ajwa</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <?php
    // Call file to connect to server
    include("header.php");

    // Initialize variables to avoid undefined variable warnings
    $fn = $l = $s = $p = '';
    $error = array(); // Initialize an error array

    // Has form been submitted?
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Check for a First Name
        if (empty($_POST['FirstName'])) {
            $error['FirstName'] = 'You forgot to enter your first name.';
        } else {
            $fn = mysqli_real_escape_string($connect, trim($_POST['FirstName']));
        }

        // Check for a Last Name
        if (empty($_POST['LastName'])) {
            $error['LastName'] = 'You forgot to enter your last name.';
        } else {
            $l = mysqli_real_escape_string($connect, trim($_POST['LastName']));
        }

        // Check for a Specialization
        if (empty($_POST['Specialization'])) {
            $error['Specialization'] = 'You forgot to enter your specialization.';
        } else {
            $s = mysqli_real_escape_string($connect, trim($_POST['Specialization']));
        }

        // Check for a Password
        if (empty($_POST['Password'])) {
            $error['Password'] = 'You forgot to enter your password.';
        } else {
            $p = mysqli_real_escape_string($connect, trim($_POST['Password']));
        }

        // If no errors, register the user in the database
        if (empty($error)) {
            // Make the query
            $q = "INSERT INTO doktor (ID, FirstName, LastName, Specialization, Password)
                  VALUES ('', '$fn', '$l', '$s', '$p')";

            $result = @mysqli_query($connect, $q); // Run the query

            if ($result) { // If it runs
                echo '<h1>Thank you!</h1>';
                exit();
            } else { // If it did not run
                echo '<h1>System error</h1>';
                // Debugging message
                echo '<p>' . mysqli_error($connect) . '<br><br>Query: ' . $q . '</p>';
            }
            mysqli_close($connect); // Close the database connection
        }
    }
    ?>

    <h2>Register Doktor</h2>
    <h4>* required field</h4>
    <form action="registerDoktor.php" method="post">

        <p><label class="label" for="FirstName"> First Name: *</label>
            <input id="FirstName" type="text" name="FirstName" size="30" maxlength="150"
                value="<?php if (isset($_POST['FirstName'])) echo $_POST['FirstName']; ?>" />
            <!-- Display the error for First Name if it exists -->
            <?php if (isset($error['FirstName'])) echo '<span style="color:red;">' . $error['FirstName'] . '</span>'; ?>
        </p>

        <p><label class="label" for="LastName"> Last Name: *</label>
            <input id="LastName" type="text" name="LastName" size="30" maxlength="60"
                value="<?php if (isset($_POST['LastName'])) echo $_POST['LastName']; ?>" />
            <!-- Display the error for Last Name if it exists -->
            <?php if (isset($error['LastName'])) echo '<span style="color:red;">' . $error['LastName'] . '</span>'; ?>
        </p>

        <p><label class="label" for="Specialization"> Specialization: *</label>
            <input id="Specialization" type="text" name="Specialization" size="12" maxlength="12"
                value="<?php if (isset($_POST['Specialization'])) echo $_POST['Specialization']; ?>" />
            <!-- Display the error for Specialization if it exists -->
            <?php if (isset($error['Specialization'])) echo '<span style="color:red;">' . $error['Specialization'] . '</span>'; ?>
        </p>

        <p><label class="label" for="Password"> Password: *</label>
            <input id="Password" type="password" name="Password" size="12" maxlength="12"
                value="<?php if (isset($_POST['Password'])) echo $_POST['Password']; ?>" />
            <!-- Display the error for Password if it exists -->
            <?php if (isset($error['Password'])) echo '<span style="color:red;">' . $error['Password'] . '</span>'; ?>
        </p>

        <p><input id="submit" type="submit" name="submit" value="Register" />&nbsp;&nbsp;
            <input id="reset" type="reset" name="reset" value="Clear All" />
        </p>
    </form>

    <p>
        <br />
        <br />
        <br />
    </p>
</body>

</html>
