<?php
session_start();
if (isset($_SESSION['logged_in'])) {
  // User is already logged in, redirect to homepage
  header("Location: home.php");
  exit();
}
include("auth.php");




?>



<!doctype html>
<html lang="en">

<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdn.tailwindcss.com"></script>  
  <link rel="stylesheet" href="https://cdn.tailwindcss.com">
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
    crossorigin="anonymous">
  <style>
  .login{
    background-color: beige;
  }
  </style> 
  
</head>



<body class="h-screen font-sans login bg-cover">
<div class="container mx-auto h-full flex flex-1 justify-center items-center">
  <div class="w-full max-w-lg">
    <div class="leading-loose">
      <form class="max-w-xl m-4 p-10 bg-white rounded shadow-xl" id="loginForm" method="POST" action="login.php">
        <p class="text-gray-800 font-medium text-center text-lg font-bold">Login</p>
        <div class="">
          <label class="block text-sm text-gray-00" for="login_email">Email</label>
          <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="login_email" name="login_email" type="email" required placeholder="Email" aria-label="email">
        </div>
        <div class="mt-2">
          <label class="block text-sm text-gray-600" for="login_password">Password</label>
          <input class="w-full px-5  py-1 text-gray-700 bg-gray-200 rounded" id="login_password" name="login_password" type="password" required placeholder="Password.." aria-label="password">
        </div>
        <div class="mt-4 items-center justify-between">
          <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" name="login_btn" id="signIn" type="submit">Login</button>
          <a class="inline-block right-0 align-baseline  font-bold text-sm text-500 hover:text-blue-800" href="#">
            Forgot Password?
          </a>
        </div>
        <a class="inline-block right-0 align-baseline font-bold text-sm text-500 hover:text-blue-800" href="signup.php">
          Not registered? Sign Up!
        </a>
        <div>
        <?php if($errors): ?>
        <?php foreach($errors as $error): ?>
                    <p id="errors" class="text-red-800 font-medium text-center">
                      <?= $error ?>
                    </p>

                    <?php endforeach;?>
                    <?php endif;?>
                </div>
      </form>

    </div>
  </div>
</div>


<script src="auth.js"></script>
<script>









</script>



</body>

</html>
