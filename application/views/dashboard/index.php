<style type="text/css">
    /*div.status_width{
        width: 50%
    }*/
</style>

<!-- BEGIN: Content -->
<div class="content">
    <!-- BEGIN: Top Bar -->
    <div class="top-bar">
        <!-- BEGIN: Breadcrumb -->
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex"><a href="" class="">Urbanfence</a> <i
                    data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Dashboard</a>
        </div>
        <!-- END: Breadcrumb -->
        <!-- BEGIN: Account Menu -->
        <?php include(APPPATH . "views/inc/account_menu.php") ?>
        <!-- END: Account Menu -->
    </div>
    <!-- END: Top Bar -->
    <div class="grid grid-cols-12 gap-6 mt-5">
        <!-- BEGIN: FAQ Menu -->
        <div href="" class="intro-y col-span-12 sm:col-span-6 lg:col-span-4 box py-10 border-2 border-theme-1">
            <i data-feather="aperture" class="w-12 h-12 text-theme-1 mx-auto"></i>
            <div class="font-medium text-center text-base mt-3">Opportunities</div>
            <div class="text-gray-600 mt-2 w-3/4 text-center mx-auto">
                <ul class="shortcut-box">
                    <!--                    --><?php //if (!is_manager()) { ?>
                    <li><a href="<?php echo base_url("Opportunity/add_customer"); ?>">Add Customer</a>
                    </li>
                    <!--                    --><?php //}if (!is_manager()) { ?>
                    <li><a href="<?php echo base_url("Opportunity/add_opportunity"); ?>">Add Opportunity</a></li>
                    <!--                    --><?php //} ?>
                    <?php if (!is_sale() && !is_user()): ?>
                        <li><a href="<?php echo base_url("Opportunity/opportunity_list?status=New"); ?>">Pending
                                Opportunities</a></li>
                    <?php endif; ?>
                    <li>
                        <a href="<?php echo base_url("Opportunity/opportunity_list"); ?>">View Opportunities</a>
                    </li>
                </ul>
            </div>
        </div>
        <div href="" class="intro-y col-span-12 sm:col-span-6 lg:col-span-4 box py-10 border-2 border-theme-1">
            <i data-feather="user" class="w-12 h-12 text-theme-1 mx-auto"></i>
            <div class="font-medium text-center text-base mt-3">Customer</div>
            <div class="text-gray-600 mt-2 w-3/4 text-center mx-auto">
                <ul class="shortcut-box">
                    <li><a href="<?php echo base_url("Customer/customers_list"); ?>">View Customers</a></li>
                </ul>
            </div>
        </div>
        <?php if (!is_user()): ?>
            <div href="" class="intro-y col-span-12 sm:col-span-6 lg:col-span-4 box py-10 border-2 border-theme-1">
                <i data-feather="twitch" class="w-12 h-12 text-theme-1 mx-auto"></i>
                <div class="font-medium text-center text-base mt-3">Quotes</div>
                <div class="text-gray-600 mt-2 w-3/4 text-center mx-auto">
                    <ul class="shortcut-box">
                        <?php if (!is_sale()): ?>
                            <li><a href="<?php echo base_url("Quotes/quotes_list?status=Approved"); ?>">Quotes to
                                    Review</a>
                            </li>
                        <?php endif; ?>
                        <li><a href="<?php echo base_url("Quotes/quotes_list"); ?>">View Quotes</a></li>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
        <div href="" class="intro-y col-span-12 sm:col-span-6 lg:col-span-4 box py-10 border-2 border-theme-1">
            <i data-feather="award" class="w-12 h-12 text-theme-1 mx-auto"></i>
            <div class="font-medium text-center text-base mt-3">Jobs</div>
            <div class="text-gray-600 mt-2 w-3/4 text-center mx-auto">
                <ul class="shortcut-box">
                    <?php if (!is_sale()): ?>
                        <li><a href="<?php echo base_url("Jobs/job_detail"); ?>">Job Details</a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo base_url("Jobs/jobs_list"); ?>">Jobs View</a></li>
                </ul>
            </div>
        </div>
        <?php
        if (is_admin()):
            ?>
            <div href="" class="intro-y col-span-12 sm:col-span-6 lg:col-span-4 box py-10 border-2 border-theme-1">
                <i data-feather="trending-up" class="w-12 h-12 text-theme-1 mx-auto"></i>
                <div class="font-medium text-center text-base mt-3">Sales</div>
                <div class="text-gray-600 mt-2 w-3/4 text-center mx-auto">
                    <ul class="shortcut-box">
                        <li><a href="<?php echo base_url("Sales/sales_list"); ?>">View Sales</a></li>
                    </ul>
                </div>
            </div>
        <?php
        endif;
        if (is_admin()):
            ?>
            <div href="" class="intro-y col-span-12 sm:col-span-6 lg:col-span-4 box py-10 border-2 border-theme-1">
                <i data-feather="codepen" class="w-12 h-12 text-theme-1 mx-auto"></i>
                <div class="font-medium text-center text-base mt-3">User Management</div>
                <div class="text-gray-600 mt-2 w-3/4 text-center mx-auto">
                    <ul class="shortcut-box">
                        <li><a href="<?php echo base_url("Users/add_user"); ?>">Add User</a></li>
                        <li><a href="<?php echo base_url("Users/users_list"); ?>">Users List</a></li>
                    </ul>
                </div>
            </div>
        <?php
        endif;
        ?>
    </div>
</div>
<!-- END: Content -->

        

