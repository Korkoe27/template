

<?php

include ('auth.php');
session_start();
if (isset($_SESSION['logged_in'])) {
  // User is already logged in, redirect to homepage
  header("Location: home.php");
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.tailwindcss.com">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
          crossorigin="anonymous">
          

    <style>
        .login{
            background-color: beige;
        }

        .text-danger{
            color: red;
        }

        #message {
            display: none;
            margin-top: 10px;
            font-weight: bold;
        }
        #message.success {
            color: green;
        }
        #message.error {
            color: red;
        }
    </style>
    <title>Register</title>
</head>
<body class="h-screen font-sans login bg-cover" >
<div class="container mx-auto h-full flex flex-1 justify-center items-center">
    <div class="w-full max-w-lg">
        <div class="leading-loose">
            <form class="max-w-xl m-4 p-10 bg-white rounded shadow-xl" id="auth" method="POST" action="signup.php">
                
                <p class="text-gray-800 font-medium text-center">Register</p>
                <div class="">
                    <label class="block text-sm text-gray-00" for="cus_name"> First Name</label>
                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="cus_name" name="firstName" type="text" required placeholder="First Name" aria-label="First Name">
                </div>
                <div class="">
                    <label class="block text-sm text-gray-00" for="lastName"> Last Name</label>
                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="lastName" name="lastName" type="text" required placeholder="Last Name" aria-label="Last Name">
                </div>
                <div class="mt-2">
                    <label class="block text-sm text-gray-600" for="userEmail">Email</label>
                    <input class="w-full px-5  py-4 text-gray-700 bg-gray-200 rounded" id="userEmail" name="userEmail" type="email" required placeholder="Your Email" aria-label="Email">
                </div>
                <div class="mt-2">
                    <label class=" block text-sm text-gray-600" for="cus_email">Telephone Number</label>
                    <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="telephone" name="telephone" type="text" required placeholder="Phone Number" aria-label="Phone">
                </div>
                <div class="mt-2">
                    <label class="text-sm block text-gray-600" for="userPassword">Password</label>
                    <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" minlength="8" id="userPassword" name="userPassword" id="userPassword" type="password" required placeholder="Create a Password" aria-label="Password">
                </div>
                <div class="mt-2">
                    <label class="block text-sm text-gray-600" for="confirmPwd">Confirm Password</label>
                    <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="confirmPwd" name="confirmPwd" type="password" oninput="pwdCheck()" required placeholder="Confirm your Password" aria-label="Confirm Password">
                </div>
                <div id="message"></div>
                <!-- <div class="inline-block mt-2 -mx-1 pl-1 w-1/2">
                    <label class="block text-sm text-gray-600" for="cus_email">Zip</label>
                    <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="cus_email"  name="cus_email" type="text" required="" placeholder="Zip" aria-label="Email">
                </div> -->

                <div class="mt-4 flex justify-center">
                    <button class="px-4 py-1  text-white font-light tracking-wider bg-gray-900 rounded" name="submitUser" id="submitUser"  type="submit">Register</button>
                    
                </div>
                <div class="mt-4 flex justify-center">
                <a class="inline-block align-baseline font-bold text-sm text-center text-500 hover:text-blue-800" href="login.php">
                    Already have an account? Log In.
                </a>
                </div>

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
</body>
</html>