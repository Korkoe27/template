

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
                <div class="my-2">
                    <label class="block text-base text-gray-00" for="cus_name"> First Name</label>

                    <div class="flex justify-center  items-center border px-2 rounded border-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                    <input class="w-full px-5 py-4 text-gray-700 focus:outline-none  rounded" id="cus_name" name="firstName" type="text" required placeholder="First Name" aria-label="First Name">
                </div>
                    
                </div>
                <div class="my-2">
                    <label class="block text-base text-gray-00" for="lastName"> Last Name</label>

                    <div class="flex justify-center items-center border px-2 rounded border-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                    <input class="w-full px-5 py-4 focus:outline-none text-gray-700  rounded" id="lastName" name="lastName" type="text" required placeholder="Last Name" aria-label="Last Name">
                    </div>
                    
                </div>
                <div class="my-2">
                    <label class="block text-base text-gray-600" for="userEmail">Email</label>

                    <div class="flex justify-center items-center border px-2 rounded border-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                    <input class="w-full px-5  py-4 text-gray-700 focus:outline-none rounded" id="userEmail" name="userEmail" type="email" required placeholder="Your Email" aria-label="Email">

                    </div>
                </div>
                <div class="my-2">
                    <label class=" block text-base text-gray-600" for="cus_email">Telephone Number</label>
                    <div class="flex justify-center items-center border p-2 rounded border-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                    </svg>
                    <input class="w-full px-2 py-2 text-gray-700 focus:outline-none rounded" id="telephone" name="telephone" type="text" required placeholder="Phone Number" aria-label="Phone">
                </div>
                    
                </div>
                <div class="my-2">
                    <label class="text-base block text-gray-600" for="userPassword">Password</label>

                    <div class="flex justify-center items-center border p-2 rounded border-gray-900">


                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" onclick="" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                    <input class="w-full pwd px-5 focus:outline-none py-1 text-gray-700 rounded" minlength="8" id="userPassword" name="userPassword" id="userPassword" type="password" required placeholder="Create a Password" aria-label="Password">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" id="showPwd" stroke="currentColor" class="size-6 showPwd cursor-pointer" title="Show Password">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" id="hidePwd" class="size-6 hidePwd cursor-pointer hidden">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                    </div>
                    
                </div>
                <div class="my-2">
                    <label class="block text-base text-gray-600" for="confirmPwd">Confirm Password</label>


                    <div class="flex justify-center items-center border p-2 rounded border-gray-900">


                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" onclick="" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>

                        <input class="w-full pwd px-5 focus:outline-none py-1 text-gray-700 rounded" id="confirmPwd" name="confirmPwd" type="password" oninput="pwdCheck()" required placeholder="Confirm your Password" aria-label="Confirm Password">
                    </div>


                    
                    
                </div>
                <div id="message"></div>


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