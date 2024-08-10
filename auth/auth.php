<?php


// echo phpinfo();

ini_set ('display_errors', 'on');
ini_set ('log_errors', 'on');
ini_set ('display_startup_errors', 'on');
ini_set ('error_reporting', E_ALL);

$errors = array();

require_once "config.php";

// global $conn;


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


        if (preg_match('/\s/', $password)) {

            $errors[] = "Password should NOT contain spaces.";
        
        }         
            if (strlen($password) < '8') {
                $errors[] = "Your Password Must Contain At Least 8 Characters!";
            } 
            if(!preg_match("#[0-9]+#", $password)) {
                $errors[] = "Your Password Must Contain Numbers!";
            } 
            if(!preg_match("#[A-Z]+#", $password)) {
                $errors[] = "Your Password Must Contain Capital Letters!";
            } 
            if(!preg_match("#[a-z]+#", $password)) {
                $errors[] = "Your Password Must Contain Lowercase Letters!";
            }


        if(empty($first_name)){
            $errors[] = 'Please provide your first name.';
        }
        if(empty($last_name)){
            $errors[] = 'Please provide your last name(surname).';
        }
        if(empty($user_email)){
            $errors[] = 'You must provide your email.';
        }
        if(empty($mobile_number)){
            $errors[] = 'Enter your phone number';
        }
        if(empty($password)){
            $errors[] = 'Please provide a password';
        }
        if(empty($confirm_pwd)){
            $errors[] = 'We need you to confirm your password!!';
        }


        if ($password != $confirm_pwd) { $errors[] = "The two passwords do not match";}
    if (!preg_match('/^[-a-zA-Z]+$/', $first_name)) {
		$errors[] = "Please enter a valid first name";
    }
    if (!preg_match('/^[-a-zA-Z]+$/', $last_name)) {
		$errors[] = "Please enter a valid last name";
    }

    if (!preg_match('/^[A-z0-9_\-]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z.]{2,4}$/', $user_email)) { $errors[] = 'This email is invlaid. Please enter a valid email!';
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
            $errors[] = 'Email already exists! Log In';	
        }
     // register user if there are no errors in the form
     if (count($errors) == 0) {
        //encrypt the password before saving in the database
		$hashPassword = password_hash($password, PASSWORD_DEFAULT);




        $stmt = mysqli_prepare($conn, "INSERT INTO user (firstName, lastName, userEmail, telephone, userPassword, created_at) VALUES(?, ?, ?, ?, ?, CURRENT_TIMESTAMP)");
        mysqli_stmt_bind_param($stmt, "sssss", $first_name, $last_name, $user_email, $mobile_number, $hashPassword);
        mysqli_stmt_execute($stmt);
       
        header('Location: login.php');	

        } 
    mysqli_stmt_close($stmt);

}	




if ($_SERVER['REQUEST_METHOD'] === 'POST' &&(isset($_POST["login_btn"]))){

    
    $loginEmail =sanitize($_POST["login_email"]);
    $loginPassword = sanitize($_POST["login_password"]);
  
  
    if(empty($loginEmail)){
       echo $errors['You must provide your email.'];
    }
  
    if(empty($loginPassword)){
        echo $errors['Please provide a password'];
    }
  
    $stmt = mysqli_prepare($conn, "SELECT id , firstName, lastName, userPassword FROM user WHERE userEmail = ? LIMIT 1");
    
    mysqli_stmt_bind_param($stmt, "s", $loginEmail);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $userid, $first_name, $last_name, $password_db);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
  
        // Check if email is exist 
        if (empty($userid)){
            $errors[] ='No such account exists. Sign Up!';
        }else{
  
        
  
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
            $errors[] = 'Incorrect Password! Try Again.';
            
  }
  
        }
  
  }