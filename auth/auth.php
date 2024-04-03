<?php


ini_set ('display_errors', 'on');
ini_set ('log_errors', 'on');
ini_set ('display_startup_errors', 'on');
ini_set ('error_reporting', E_ALL);


require_once "config.php";


$errors = array();

// sanitize value from form
function sanitize(String $value)
{	
    // bring the global db connect object into function
    global $conn;

    $val = trim($value); // remove empty space sorrounding string
    $val = mysqli_real_escape_string($conn, $value);
    $val = stripslashes($value);
    $val = htmlspecialchars($val);

    return $val;
}


function validate_mobile($mobile)
{
    return preg_match('/^[0-9]{10}+$/', $mobile);
}


    if(isset($_POST['submitUser'])){
        $first_name = sanitize($_POST['firstName']);
        $last_name = sanitize($_POST['lastName']);
        $user_email = sanitize($_POST['userEmail']);
        $mobile_number = validate_mobile($_POST['telephone']);
        $password = sanitize($_POST['userPassword']);
        $confirm_pwd = sanitize($_POST['confirmPwd']);


        if(empty($first_name)){
            $errors['firstNameErr'] = 'Please provide your first name.';
        }
        if(empty($last_name)){
            $errors['lasttNameErr'] = 'Please provide your last name(surname).';
        }
        if(empty($user_email)){
            $errors['noEmailErr'] = 'You must provide your email.';
        }
        if(empty($mobile_number)){
            $errors['phoneNumberErr'] = 'Enter your phone number';
        }
        if(empty($password)){
            $errors['passwordErr'] = 'Please provide a password';
        }
        if(empty($confirm_pwd)){
            $errors['pwdConfirmErr'] = 'We need you to confirm your password!!';
        }


        if ($password != $confirm_pwd) { $errors['passwordMismatch'] = "The two passwords do not match";}
    if (!preg_match('/^[-a-zA-Z]+$/', $first_name)) {
		$errors['firstnameErr'] = "Please enter a valid first name";
    }
    if (!preg_match('/^[-a-zA-Z]+$/', $last_name)) {
		$errors['lastnameErr'] = "Please enter a valid last name";
    }

    if (!preg_match('/^[A-z0-9_\-]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z.]{2,4}$/', $user_email)) { $errors['emailInvalidErr'] = 'This email is invlaid. Please enter a valid email!';
    }


        // Ensure that no user is registered twice. Email should be unique 
        $stmt = mysqli_prepare($conn, "SELECT id FROM user WHERE userEmail=? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "s", $user_email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id);
        // $stmt->store_result();
        $member = mysqli_stmt_fetch($stmt);
    
        if ($member) {
            // Username already exists
            $errors['existsErr'] = 'Email already exists!';	
        }
     // register user if there are no errors in the form
     if (count($errors) == 0) {
        //encrypt the password before saving in the database
		$hashPassword = password_hash($password, PASSWORD_DEFAULT);

        // // create slug
        // $slug_id = uniqid();
        // $full_name = $first_name." ".$last_name;
        // $slug = slugify($full_name)."-{$slug_id}";

        // // create activation code
        // $activation_code = uniqid();

        $stmt = mysqli_prepare($conn, "INSERT INTO user (firstName, lastName, userEmail, telephone, userPassword, created_at) VALUES(?, ?, ?, ?, ?, CURRENT_TIMESTAMP)");
        mysqli_stmt_bind_param($stmt, "sssss", $first_name, $last_name, $user_email, $mobile_number, $hashPassword);
        mysqli_stmt_execute($stmt);
       

        // //get id of created user
        // $member_id = mysqli_insert_id($conn); 

        // Add password to Auth table
        // $stmt = mysqli_prepare($conn, "INSERT INTO auth (member_id, password) values(?,?)");
        // mysqli_stmt_bind_param($stmt, "is", $member_id, $password);
        // mysqli_stmt_execute($stmt);

        //Send email address verification email
        // require_once '../utilities/mail_setup.php';       

        // $_SESSION['activate_message'] = "Kindly check your email and activate your account";
        header('Location: home.php');	

    }
    if ($errors){
        foreach ($errors as $error){
            echo "<p class='text-danger text-center'><strong>$error</strong></p>";
        }
    }
    mysqli_stmt_close($stmt);

}	



