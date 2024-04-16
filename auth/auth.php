<?php



// echo phpinfo();

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




    if(isset($_POST['submitUser'])){
        $first_name = sanitize($_POST['firstName']);
        $last_name = sanitize($_POST['lastName']);
        $user_email = sanitize($_POST['userEmail']);
        $mobile_number = sanitize($_POST['telephone']);
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
        header('Location: login.php');	

    }
    if ($errors){
        foreach ($errors as $error){
            echo "<p style='color:red; text-align:center;'><strong>$error</strong></p>";
        }
    }
    mysqli_stmt_close($stmt);

}	



//log in user

if(isset($_POST["login_btn"])){
    $loginEmail =sanitize($_POST["login_email"]);
    $loginPassword = sanitize($_POST["login_password"]);


    if(empty($loginEmail)){
       echo $errors['noEmailErr'];
    }

    if(empty($loginPassword)){
        echo $errors['passwordErr'];
    }

    $stmt = mysqli_prepare($conn, "SELECT id , firstName, lastName, userPassword FROM user WHERE userEmail = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, "s", $loginEmail);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $userid, $first_name, $last_name, $password_db);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

        // Check if email is exist 
        if (empty($userid)){
            $errors['emailNotExistsErr'] ='We cannot find an account with that email address';
        }

        // if(empty($errors)){
        //     $stmt = mysqli_prepare($conn, "SELECT userPassword FROM user WHERE ");

            // Check if passwords match
        if (password_verify($loginPassword, $password_db)) {
            // Verification success! User has logged-in!
                // 
            //create session to remember user

            session_start();
            session_regenerate_id();
                $_SESSION['logged_in'] = TRUE;
                $_SESSION['id'] = $userid;
                $_SESSION['firstname'] = $first_name;
                $_SESSION['full_name'] = $first_name . " " . $last_name;
                header('Location: home.php');
            
        }else{
                // Incorrect password
            $errors['namepassErr'] = 'Incorrect Password! Try Again.';
}
if ($errors){
    foreach ($errors as $error){
        echo "<h2 class='text-danger text-center'><strong>$error</strong></h2>";
    }
}

}