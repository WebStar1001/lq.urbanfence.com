<div class="intro-x dropdown w-8 h-8 relative">
    <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
        <img alt="Midone Tailwind HTML Admin Template" src="<?php echo base_url(); ?>assets/images/profile-12.jpg">
    </div>
    <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
        <div class="dropdown-box__content box bg-theme-38 text-white">
            <div class="p-4 border-b border-theme-40">
                <div class="font-medium"><?php echo logged_user_name(); ?></div>
                <div class="text-xs text-theme-41"><?php echo user_access_level(); ?></div>
            </div>
<!--            <div class="p-2">-->
<!--                <a href=""-->
<!--                   class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md">-->
<!--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"-->
<!--                         stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"-->
<!--                         class="feather feather-user w-4 h-4 mr-2">-->
<!--                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>-->
<!--                        <circle cx="12" cy="7" r="4"></circle>-->
<!--                    </svg>-->
<!--                    Profile </a>-->
<!--                <a href=""-->
<!--                   class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md">-->
<!--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"-->
<!--                         stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"-->
<!--                         class="feather feather-lock w-4 h-4 mr-2">-->
<!--                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>-->
<!--                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>-->
<!--                    </svg>-->
<!--                    Reset Password </a>-->
<!--            </div>-->
            <div class="p-2 border-t border-theme-40">
                <a href="<?php echo base_url().'Login/do_logout' ?>"
                   class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-toggle-right w-4 h-4 mr-2">
                        <rect x="1" y="5" width="22" height="14" rx="7" ry="7"></rect>
                        <circle cx="16" cy="12" r="3"></circle>
                    </svg>
                    Logout </a>
            </div>
        </div>
    </div>
</div>