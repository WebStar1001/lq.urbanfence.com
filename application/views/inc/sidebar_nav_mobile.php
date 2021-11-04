<style> 

@media only screen and (max-width: 768px){
    #logo_on_mobile{
        max-width:50%;
    }
}
</style>
        <!-- create FOR: Mobile Menu -->
    <div class="mobile-menu md:hidden">
        <div class="mobile-menu-bar">
            <a href="<?php echo base_url("Dashboard");?>" class="flex mr-auto">
                <img alt="Midone Tailwind HTML Admin Template" id="logo_on_mobile" class="w-7 img-fluid" src="<?php echo base_url();?>assets/images/logo.png">
            </a>
            <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
        </div>
            <ul class="border-t border-theme-24 py-5 hidden">
                <li>
                    <a href="<?php echo base_url("Dashboard");?>" class="menu menu--active">
                        <div class="menu__icon"> <i data-feather="home"></i> </div>
                        <div class="menu__title"> Dashboard </div>
                    </a>
                </li>

                <li>
                    <a href="javascript:;" class="menu">
                        <div class="menu__icon"> <i data-feather="box"></i> </div>
                        <div class="menu__title">Opportunities<i data-feather="chevron-down" class="menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="<?php echo base_url("Opportunity/add_customer");?>" class="menu">
                                <div class="menu__icon"> <i class="fa fa-user-plus" aria-hidden="true"></i></div>
                                <div class="menu__title"> Add Customer </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url("Opportunity/add_opportunity");?>" class="menu">
                                <div class="menu__icon"> <i class="fa fa-plus" aria-hidden="true"></i></div>
                                <div class="menu__title"> Add Opportunity</div>
                            </a>
                        </li>
                     <!--    <li>
                            <a href="<?php echo base_url("Opportunity/opportunity_list");?>" class="menu">
                                <div class="menu__icon"> <i class="fa fa-clock-o" aria-hidden="true"></i></div>
                                <div class="menu__title"> Pending Assignment </div>
                            </a>
                        </li> -->
                        <li>
                            <a href="<?php echo base_url("Opportunity/opportunity_list");?>" class="menu">
                                <div class="menu__icon"> <i class="fa fa-list" aria-hidden="true"></i></div>
                                <div class="menu__title"> View Assignment </div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:;" class="menu">
                        <div class="menu__icon"> <i data-feather="user"></i> </div>
                        <div class="menu__title">Customer<i data-feather="chevron-down" class="menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="<?php echo base_url("Customer/customers_list");?>" class="menu">
                                <div class="menu__icon"> <i class="fa fa-users" aria-hidden="true"></i></div>
                                <div class="menu__title">View Customer </div>
                            </a>
                        </li>
                        
                    </ul>
                </li>

                <li>
                    <a href="javascript:;" class="menu">
                        <div class="menu__icon"> <i data-feather="twitch"></i> </div>
                        <div class="menu__title">Quotes<i data-feather="chevron-down" class="menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                    <li>
                            <a href="<?php echo base_url("Quotes/add_quote");?>" class="menu">
                                <div class="menu__icon"><i data-feather="edit"></i></div>
                                <div class="menu__title">Create New Quotes </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url("Quotes/quotes_list");?>" class="menu">
                                <div class="menu__icon"> <i data-feather="eye"></i>  </div>
                                <div class="menu__title">View Previous Quotes </div>
                            </a>
                        </li>
                        
                    </ul>
                </li>
                
                <li>
                    <a href="javascript:;" class="menu">
                        <div class="menu__icon"> <i data-feather="award"></i> </div>
                        <div class="menu__title">Jobs<i data-feather="chevron-down" class="menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                         <li>
                            <a href="<?php echo base_url("Jobs/job_detail");?>" class="menu">
                                <div class="menu__icon"> <i data-feather="edit"></i>  </div>
                                <div class="menu__title">Job Details</div>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url("Jobs/jobs_list");?>" class="menu">
                                <div class="menu__icon"> <i data-feather="eye"></i>  </div>
                                <div class="menu__title">View Jobs </div>
                            </a>
                        </li>
                        
                    </ul>
                </li>

                <li>
                    <a href="javascript:;" class="menu">
                        <div class="menu__icon"> <i data-feather="trending-up"></i> </div>
                        <div class="menu__title">Sales<i data-feather="chevron-down" class="menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                    <li>
                            <a href="<?php echo base_url("Sales/sales_list");?>" class="menu">
                                <div class="menu__icon"> <i data-feather="eye"></i> </div>
                                <div class="menu__title">View Sales</div>
                            </a>
                        </li>
                        
                    </ul>
                </li>

                <li>
                    <a href="javascript:;" class="menu">
                        <div class="menu__icon"> <i data-feather="codepen"></i> </div>
                        <div class="menu__title">Users Management<i data-feather="chevron-down" class="menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                    <li>
                            <a href="<?php echo base_url("Users/add_user");?>" class="menu">
                                <div class="menu__icon"> <i class="fa fa-user-plus" aria-hidden="true"></i></div>
                                <div class="menu__title">Add User </div>
                            </a>
                    </li>
                    <li>
                            <a href="<?php echo base_url("Users/users_list");?>" class="menu">
                                <div class="menu__icon"> <i class="fa fa-users" aria-hidden="true"></i></div>
                                <div class="menu__title">List User </div>
                            </a>
                    </li>
                        
                    </ul>
                </li>
            </ul>
    </div>
        <!-- END: Mobile Menu -->
      



