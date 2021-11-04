<!DOCTYPE html>

<html lang="en">
<!-- BEGIN: Head -->
<head>
    <meta charset="utf-8">
    <link href="<?php echo base_url(); ?>assets/images/logo.png?>" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords"
          content="admin template, Midone admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    <title>Login - Linkunfence</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/app.css"/>
    <!-- END: CSS Assets-->
</head>
<body class="login">
<form name="login" action="Login/do_login" method="post">
    <div class="container">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Login Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5" style="justify-content: center;">
                    <!--<img alt="Midone Tailwind HTML Admin Template" class="w-7" style="width: 30%;"
                         src="<?php echo base_url(); ?>assets/images/logo.png">-->
                    <!-- <span class="text-white text-lg ml-3"> Mid<span class="font-medium">One</span> </span> -->
                </a>
                <a href="" class="-intro-x flex items-center pt-5" style="justify-content: center;">
                    <!--<img alt="Midone Tailwind HTML Admin Template" class="w-7" style="width: 30%;"
                         src="<?php echo base_url(); ?>assets/images/city-fence-logo.png">-->
                    <img alt="Midone Tailwind HTML Admin Template" class="w-7 ml-2" style="width: 30%;"
                         src="<?php echo base_url(); ?>assets/images/linkun-logo.png">
                    <!-- <span class="text-white text-lg ml-3"> Mid<span class="font-medium">One</span> </span> -->
                </a>
                <div class="my-auto">
                    <img alt="Midone Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16"
                         src="<?php echo base_url(); ?>assets/images/illustration.svg">
                    <!-- <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                        A few more clicks to
                        <br>
                        sign in to your account.
                    </div> -->
                    <div class="-intro-x mt-5 text-lg text-white">Manage all your qoutes in one place</div>
                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <div class="intro-x flex text-gray-700 text-xs sm:text-sm mt-4">
                        <div class="flex items-center mr-auto">
                            <?php
                            $error_message = $this->session->userdata('error_message');
                            if (isset($error_message)) {
                                ?>
                                <div style="color:red;">
                                    <?php echo $error_message ?>
                                </div>
                                <?php
                                $this->session->unset_userdata('error_message');
                            }
                            ?>
                        </div>
                    </div>
                    <div class="intro-x mt-8">
                        <input type="text" class="intro-x login__input input input--lg border border-gray-300 block"
                               name="username"
                               placeholder="Email" required>
                        <input type="password" name="password"
                               class="intro-x login__input input input--lg border border-gray-300 block mt-4"
                               placeholder="Password" required>
                    </div>
<!--                    <div class="intro-x flex text-gray-700 text-xs sm:text-sm mt-4">-->
<!--                        <div class="flex items-center mr-auto">-->
<!--                            <input type="checkbox" class="input border mr-2" id="remember-me">-->
<!--                            <label class="cursor-pointer select-none" for="remember-me">Remember me</label>-->
<!--                        </div>-->
<!--                        <a href="">Forgot Password?</a>-->
<!--                    </div>-->
                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                        <button type="submit" class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3">
                            Login
                        </button>
                    </div>
<!--                    <div class="intro-x mt-10 xl:mt-24 text-gray-700 text-center xl:text-left">-->
<!--                        <a class="text-theme-1" href="">Terms and Conditions</a> & <a class="text-theme-1" href="">Privacy-->
<!--                            Policy</a>-->
<!--                    </div>-->
                </div>
            </div>
            <!-- END: Login Form -->
        </div>
    </div>
</form>
<!-- BEGIN: JS Assets-->
<!--        <script src="--><?php //echo base_url();?><!--assets/js/app.js"></script>-->
<!-- END: JS Assets-->
</body>
</html>

