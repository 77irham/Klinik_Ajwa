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
    $n = $l = $i = $d = '';
    $error = array(); // Initialize an error array

    // Has form been submitted?
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Check for a First Name
        if (empty($_POST['FirstName_P'])) {
            $error['FirstName_P'] = 'You forgot to enter your first name.';
        } else {
            $n = mysqli_real_escape_string($connect, trim($_POST['FirstName_P']));
        }

        // Check for a Last Name
        if (empty($_POST['LastName_P'])) {
            $error['LastName_P'] = 'You forgot to enter your last name.';
        } else {
            $l = mysqli_real_escape_string($connect, trim($_POST['LastName_P']));
        }

        // Check for an Insurance Number
        if (empty($_POST['Insurance_Number'])) {
            $error['Insurance_Number'] = 'You forgot to enter your Insurance Number.';
        } else {
            $i = mysqli_real_escape_string($connect, trim($_POST['Insurance_Number']));
        }

        // Check for a Diagnose
        if (empty($_POST['Diagnose'])) {
            $error['Diagnose'] = 'You forgot to enter your diagnose.';
        } else {
            $d = mysqli_real_escape_string($connect, trim($_POST['Diagnose']));
        }

        // If no errors, register the user in the database
        if (empty($error)) {
            // Make the query
            $q = "INSERT INTO pesakit (ID_P, FirstName_P, LastName_P, Insurance_Number, Diagnose) 
                  VALUES ('', '$n', '$l', '$i', '$d')";
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

    <h2>Register</h2>
    <h4>* required field</h4>
    <form action="register.php" method="post">

        <p><label class="label" for="FirstName_P"> First Name: *</label>
            <input id="FirstName_P" type="text" name="FirstName_P" size="30" maxlength="150"
                value="<?php if (isset($_POST['FirstName_P'])) echo $_POST['FirstName_P']; ?>" />
            <!-- Display the error for First Name if it exists -->
            <?php if (isset($error['FirstName_P'])) echo '<span style="color:red;">' . $error['FirstName_P'] . '</span>'; ?>
        </p>

        <p><label class="label" for="LastName_P"> Last Name: *</label>
            <input id="LastName_P" type="text" name="LastName_P" size="30" maxlength="60"
                value="<?php if (isset($_POST['LastName_P'])) echo $_POST['LastName_P']; ?>" />
            <!-- Display the error for Last Name if it exists -->
            <?php if (isset($error['LastName_P'])) echo '<span style="color:red;">' . $error['LastName_P'] . '</span>'; ?>
        </p>

        <p><label class="label" for="Insurance_Number"> Insurance Number: *</label>
            <input id="Insurance_Number" type="text" name="Insurance_Number" size="12" maxlength="12"
                value="<?php if (isset($_POST['Insurance_Number'])) echo $_POST['Insurance_Number']; ?>" />
            <!-- Display the error for Insurance Number if it exists -->
            <?php if (isset($error['Insurance_Number'])) echo '<span style="color:red;">' . $error['Insurance_Number'] . '</span>'; ?>
        </p>

        <p><label class="label" for="Diagnose"> Diagnose: </label></p>
        <textarea name="Diagnose" rows="5" cols="40"><?php if (isset($_POST['Diagnose'])) echo $_POST['Diagnose']; ?></textarea>
        <!-- Display the error for Diagnose if it exists -->
        <?php if (isset($error['Diagnose'])) echo '<span style="color:red;">' . $error['Diagnose'] . '</span>'; ?>

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