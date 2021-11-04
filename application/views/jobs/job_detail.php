<style type="text/css">

    div#jobDetailTable_wrapper {
        overflow: auto;
    }

    .border_color {
        border: 1px solid #2d3748;
    }

    .job_setting_child_width {
        width: 25%;
    }

    .info_spacing {
        letter-spacing: 1.5px;
    }

    .display_info_block {
        display: inline-flex;
        background-color: #cccccc !important;
    }

    /*@media screen and (max-width: 650px) {*/
    /*    select {*/
    /*        text-align-last: center;*/
    /*    }*/
    /*}*/

    /*@media screen and (max-width: 640px) {*/
    /*    .display_info_block {*/
    /*        display: inline-block;*/
    /*        background-color: #cccccc !important;*/
    /*    }*/
    /*}*/

    /*@media screen and (max-width: 450px) {*/
    /*    select {*/
    /*        text-align-last: left;*/
    /*    }*/
    /*}*/

    #material-detailed table {
        border: 1px solid black;
    }

    #material-detailed th {
        border: 1px solid black;
    }

    #material-detailed td {
        border: 1px solid black;
    }

    @media print {
        /*label{*/
        /*    display:block;*/
        /*}*/
    }

</style>
<!-- BEGIN: Content -->

<div class="content">
    <!-- BEGIN: Top Bar -->
    <div class="top-bar">
        <!-- BEGIN: Breadcrumb -->
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex"><a href="" class="">Urbanfence</a> <i
                    data-feather="chevron-right" class="breadcrumb__icon"></i> <span class="breadcrumb--active">Jobs Detail</span>
        </div>
        <!-- END: Breadcrumb -->
        <!-- BEGIN: Account Menu -->
        <?php include(APPPATH . "views/inc/account_menu.php") ?>
        <!-- END: Account Menu -->
    </div>
    <!-- BEGIN: Filters -->
    <fieldset class="p-2 mb-3 w-full fieldset_bd_color">
        <legend class="legend_spacing">Job #<?php echo ($job) ? $job->id : ''; ?></legend>
        <div class="intro-y grid grid-cols-12 p-5 gap-2 ">
            <!-- <h2 class="col-span-12 font-medium text-base  border-b border-gray-200">Filters</h2> -->
            <div class="col-span-12 m-auto">
                <div class="w-full">
                    <form method="get" action="job_detail">
                        <input type="text" placeholder="Search Job" class="input pl-12 border"
                               id="search_job" name="job_id" value="<?php echo ($job) ? $job->id : ''; ?>">
                        <button class="button w-24 mr-1  bg-theme-1 text-white" id="searchBtn">Search</button>
                    </form>
                    </button>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-12 box m-auto w-full lg:w-5/6 p-5 fieldset_bd_color display_info_block mt-3"
                 style="position: relative;right: 12px;background-color:#1C3FAA !important;">
                <div class="w-full md:w-4/5 lg:w-1/2 border_color p-1 fieldset_bd_color mr-1 sm:mr-2 md:mr-5 mb-2 sm:mb-0"
                     style="background-color: white">
                    <table style="margin-top:5px;margin-left: auto;margin-right:auto;" cellpadding="5">
                        <tr>
                            <td>
                                <b class="info_spacing">Customer Name:</b>
                            </td>
                            <td>
                                <?php echo ($customer) ? $customer->customer : ''; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b class="info_spacing">Contact
                                    Person:</b>
                            </td>
                            <td>
                                <?php echo ($customer) ? $customer->contact_person : ''; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b class="info_spacing">Phone:</b>
                            </td>
                            <td>
                                <?php echo ($customer) ? $customer->phone1 : ''; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b class="info_spacing">Email:</b>
                            </td>
                            <td>
                                <?php echo ($customer) ? $customer->email : ''; ?>
                            </td>
                        </tr>
                    </table>
                </div>


                <div class="w-full md:w-4/5 lg:w-1/2 border_color p-1 fieldset_bd_color"
                     style="background-color: white">
                    <table style="margin-top:5px;margin-left: auto;margin-right:auto;" cellpadding="5">
                        <tr>
                            <td><b class="info_spacing">Job Type:</b></td>
                            <td><?php echo ($oppor) ? $oppor->site_address : ''; ?></td>
                        </tr>
                        <tr>
                            <td><b class="info_spacing">Site Address:</b></td>
                            <td><?php echo ($oppor) ? $oppor->job_type : ''; ?></td>
                        </tr>
                        <tr>
                            <td><b class="info_spacing">Site City:</b></td>
                            <td><?php echo ($oppor) ? $oppor->site_city : ''; ?></td>
                        </tr>
                        <tr>
                            <td><b class="info_spacing">Payment Terms are:</b></td>
                            <td><?php echo ($quote) ? $quote->payment_term : ''; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>


        <div class="intro-y grid grid-cols-12 p-5 mt-5 gap-2">
            <div class="col-span-12 lg:col-span-6 lg:mr-5">
                <fieldset class="p-2 pt-5 pb-4 w-full fieldset_bd_color box">
                    <legend class="legend_spacing">Materials Settings</legend>

                    <div class="mt-1 mb-5 float-left w-1/2">
                        <input type="checkbox" class="input border mr-2" id="vertical-remember-me" disabled
                            <?php echo ($job && $job->status == 'MAT Missing in Stock') ? 'checked' : '' ?>/>
                        <label class="cursor-pointer select-none" for="vertical-remember-me" style="width: auto;">Need
                            to order Material</label>
                    </div>
                    <div class="float-right w-1/2 mb-5">
                        <div class="mt-1 mb-2">
                            <input type="checkbox" class="input border mr-2" id="vertical-remember-me_r1"
                                <?php echo ($job && $job->status != 'MAT Missing in Stock' && $job->status != 'New') ? 'checked' : '' ?>
                                   disabled/>
                            <label class="cursor-pointer select-none" for="vertical-remember-me_r1"
                                   style="width: auto;">Materials in stock</label>
                        </div>
                        <div class="mt-1 mb-2">
                            <input type="checkbox" class="input border mr-2" id="vertical-remember-me_r2"
                                <?php echo ($job && $job->status != 'MAT Missing in Stock' && $job->status != 'New') ? 'checked' : '' ?>
                                   disabled/>
                            <label class="cursor-pointer select-none" for="vertical-remember-me_r2"
                                   style="width: auto;">Materials Collected</label>
                        </div>
                        <div class="mt-1 mb-4">
                            <input type="checkbox" class="input border mr-2" id="vertical-remember-me_r3"
                                <?php echo ($job && ($job->status == 'In progress' || $job->status == 'Completed' || $job->status == 'Completed and Paid')) ? 'checked' : '' ?>
                                   disabled>
                            <label class="cursor-pointer select-none" for="vertical-remember-me_r3"
                                   style="width: auto;">Materials Delivered</label>
                        </div>

                    </div>
                </fieldset>
            </div>

            <div class="col-span-12 lg:col-span-6 text-right" id="date_area">
                <fieldset class="p-1 fieldset_bd_color box pr-5">
                    <legend class="legend_spacing text-left">Job Settings</legend>
                    <div class="mt-1 mb-2">
                        <label class="mr-1">Assign Installer </label>
                        <select class="input border mr-0 w-1/3 lg:w-2/3" id="installer">
                            <option value="0">Choose</option>
                            <?php
                            foreach ($installers as $installer) {
                                $selected = '';
                                if ($job) {
                                    if ($installer->id == $job->installer) {
                                        $selected = 'selected';
                                    }
                                }
                                echo '<option value="' . $installer->id . '" ' . $selected . '>' . $installer->name . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mt-1 mb-2">
                        <label class="mr-1">Start Date</label>
                        <input type="date" class="input w-1/3 lg:w-2/3 border col-span-4" id="start_date"
                               value="<?php echo ($job) ? $job->start_date : ''; ?>"/>
                    </div>
                    <div class="mt-1 mb-2">
                        <label class="mr-1">Completion Date</label>
                        <input type="date" class="input w-1/3 lg:w-2/3 border col-span-4" id="end_date"
                               value="<?php echo ($job) ? $job->end_date : ''; ?>" <?php echo ($job && $job->status != 'In progress') ? 'readonly disabled' : ''; ?>/>
                    </div>
                    <div class="mt-1 mb-2">
                        <button class="button bg-theme-1 text-white" id="job_setting_btn">Save</button>
                    </div>
                </fieldset>
            </div>
        </div>

        <div class="intro-y grid grid-cols-12 p-5 mt-5 gap-2">
            <div class="col-span-4">
                <div class="p-5">
                    <a data-target="#material-detailed" data-toggle="modal" class="button  bg-theme-1 text-white"
                       data-backdrop="static" data-keyboard="false">Materials Tracking</a>
                </div>
                <div class="p-5">
                    <a data-target="#installation_summary" data-toggle="modal"
                       class="button  bg-theme-1 text-white"
                       data-backdrop="static" data-keyboard="false">Installation Summary</a>
                </div>
            </div>

            <div class="col-span-4">
                <fieldset class="p-2 mb-3 w-2/4 sm:w-2/5 lg:w-1/2 fieldset_bd_color box">
                    <legend class="legend_spacing">Status</legend>
                    <p class="w-full p-2" id="status_filed"><?php echo ($job) ? $job->status : ''; ?></p>
                </fieldset>
            </div>
            <?php
            if (!is_user()):
                ?>
                <div class="col-span-4">
                    <fieldset class="p-2 mb-3 w-full fieldset_bd_color box">
                        <legend class="legend_spacing">Office Notes</legend>
                        <p class="w-full p-2"
                           id="status_filed"><?php echo ($job) ? $quote->additional_office_notes : ''; ?></p>
                    </fieldset>
                </div>
            <?php
            endif;
            ?>
        </div>
        <?php if (!is_user()): ?>
            <fieldset class="p-1 status_width fieldset_bd_color" style="margin-top: 3%;">
                <legend class="legend_spacing">Credits-Debits Tracking</legend>
                <div class="intro-y grid grid-cols-12 box" style="margin-top: 2%;">
                    <div class="col-span-12 p-5">
                        <div class="w-full lg:w-1/6 float-left text-left m-auto">
                            <p><b>Generate Invoice</b></p>
                        </div>
                        <div class="w-full sm:w-1/2 lg:w-1/5 lg:mr-3 float-left mb-2 md:mb-0 p-2 lg:p-0 sm:text-left">
                            <div class="sm:w-full">
                                <label class="w-full text-left">Invoice#</label>
                                <input type="text" class="input w-full border flex-1 md:text-center"
                                       id="invoice_id">
                            </div>
                        </div>
                        <div class="w-full sm:w-1/2 lg:w-1/5 lg:mr-3 float-left mb-2 md:mb-0 p-2 lg:p-0 sm:text-left ">
                            <div class="sm:w-full">
                                <label class="w-full sm:w-1/3 text-left">Invoice Amount</label>
                                <input type="text" class="input w-full border flex-1 md:text-center"
                                       id="invoice_amount">
                            </div>
                        </div>
                        <div class="w-full sm:w-1/2 lg:w-1/5 lg:mr-3 float-left mb-2 md:mb-0 p-2 lg:p-0 sm:text-left">
                            <div class="sm:w-full">
                                <label class="w-full text-left">Invoice Due-Date</label>
                                <input type="text" class="input w-full border flex-1 md:text-center"
                                       id="invoice_due_date">
                            </div>
                        </div>
                        <div class="w-full sm:w-1/2 lg:w-1/6 float-left ml-5 sm:mt-2 p-2 lg:p-0  pt-5 lg:mt-2">
                            <button class="button bg-theme-1 text-white mt-3" id="generate_invoice">Generate Invoice
                            </button>
                        </div>
                    </div>
                </div>
                <div class="intro-y grid grid-cols-12 box">
                    <div class="col-span-12 float-left text-left ml-5">
                        <p><b>Take Payment</b></p>
                    </div>
                    <div class="col-span-12 p-5 box">
                        <div class="w-full sm:w-1/2 lg:w-1/6 lg:mr-3 float-left mb-2 md:mb-0 p-2 lg:p-0 sm:text-left ">
                            <div class="sm:w-full">
                                <label class="w-full sm:w-1/3 text-left">Invoice #</label>
                                <input type="text" class="input w-full border flex-1 md:text-center"
                                       id="invoice_number">
                            </div>
                        </div>

                        <div class="w-full sm:w-1/2 lg:w-1/5 lg:mr-3 float-left mb-2 md:mb-0 p-2 lg:p-0 sm:text-left">
                            <div class="sm:w-full">
                                <label class="w-full text-left">Payment amount</label>
                                <input type="text" class="input w-full border flex-1 md:text-center"
                                       id="payment_amount">
                            </div>
                        </div>
                        <div class="w-full sm:w-1/2 lg:w-1/5 lg:mr-3 float-left mb-2 md:mb-0 p-2 lg:p-0 sm:text-left">
                            <div class="sm:w-full">
                                <label class="w-full text-left">Reference #</label>
                                <input type="text" class="input w-full border flex-1 md:text-center"
                                       id="reference">
                            </div>
                        </div>

                        <div class="w-full sm:w-1/2 lg:w-1/5 lg:mr-3 float-left mb-2 md:mb-0 p-2 lg:p-0 sm:text-left">
                            <div class="sm:w-full">
                                <label class="w-full text-left">Payment Method</label>
                                <select class="input w-full border flex-1" id="payment_method">
                                    <option value="0">Choose</option>
                                    <option>Visa</option>
                                    <option>Mater-Card</option>
                                    <option>Amex</option>
                                    <option>Cash</option>
                                    <option>Cheque</option>
                                </select>
                            </div>
                        </div>

                        <div class="w-full sm:w-1/2 lg:w-1/6 float-left sm:mt-2 p-2 lg:p-0  pt-5 lg:mt-5">
                            <button class="button bg-theme-1 text-white" id="create_payment">Create Payment</button>
                        </div>
                    </div>

                </div>

                <!-- BEGIN: Datatable -->
                <div class="intro-y box p-5 mt-5" id="table_main_div">
                    <table id="jobDetailTable" class="display"
                           style="width:100%;text-align: center; margin-bottom: 5px;">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Invoice ID</th>
                            <th>Payment ID</th>
                            <th>Debits</th>
                            <th>Credit</th>
                            <th>Due Date</th>
                            <th>Account Balance</th>
                            <th>Job Balance</th>
                            <th>Note</th>
                        </tr>
                        <tr style="background-color:">
                            <td colspan="6"></td>
                            <td>0</td>
                            <td><?php echo ($job) ? $job->job_balance : ''; ?></td>
                            <td></td>
                        </tr>
                        </thead>
                    </table>

                </div>
                <!-- END: Datatable -->
            </fieldset>
        <?php endif; ?>


    </fieldset>
    <!-- END: Datatable -->
</div>
<!-- END: Content -->

<div class="modal" id="material-detailed">
    <div class="modal__content modal__content--lg p-5 text-center" style="width: 75%;">
        <div class="flex items-center py-5 sm:py-3 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">Materials Tracking</h2>
        </div>
        <form id="item_collect_form" method="post" action="set_mat_collect">
            <div class="overflow-x-auto">
                <table class="table" id="material-setting-table">
                    <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="whitespace-no-wrap">Category</th>
                        <th class="whitespace-no-wrap">MAT Description</th>
                        <th class="whitespace-no-wrap">Quantity</th>
                        <th class="whitespace-no-wrap">Items Collected for job</th>
                        <th class="whitespace-no-wrap">Missing in stock</th>
                        <th class="whitespace-no-wrap">In stock</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $quantity_total = 0;
                    $items_collected_total = 0;
                    $missing_stock_total = 0;
                    if ($mat_info):
                        foreach ($mat_info as $mat):
                            $quantity_total += $mat->quantity;
                            $items_collected_total += $mat->items_collected_for_job;
                            echo '<tr id="items_collected' . $mat->id . '">
                                <td class="border-b">' . $mat->mat_category . '</td>
                                <td class="border-b">' . $mat->mat_description . '</td>
                                <td class="border-b">' . $mat->quantity . '</td>
                                <td class="border-b">
                                <input type="hidden" name="mat_id[]" value="' . $mat->id . '"/>
                                <input type="number" name="collected_quantity[]" onfocus="this.oldvalue = this.value;" originalValue="' . $mat->items_collected_for_job . '" max="' . $mat->quantity . '"
                                value="' . $mat->items_collected_for_job . '" class="w-full" style="height:30px;" onchange="change_item_collect(' . $mat->id . ');this.oldvalue = this.value;">
                                </td>';
                            if ($mat->quantity == $mat->items_collected_for_job) {
                                echo '
                                <td class="border-b"><i class="fa fa-minus" style="color:green;"/></td>
                                <td class="border-b"><i class="fa fa-check" style="color:green;"/></td>';
                            } else {
                                echo '
                                <td style="color: red" class="border-b">' . ($mat->quantity - $mat->items_collected_for_job) . '</td>
                                <td style="color: red" class="border-b"><i class="fa fa-minus"/></td>';
                                $missing_stock_total += $mat->quantity - $mat->items_collected_for_job;
                            }
                            echo '</tr>';
                        endforeach;
                    endif;
                    ?>
                    <tr id="items_collected_total" style="font-weight:bold;">
                        <td class="border-b">Total</td>
                        <td class="border-b"></td>
                        <td class="border-b"><?php echo $quantity_total; ?></td>
                        <td class="border-b"><?php echo ($items_collected_total == 0) ? '' : $items_collected_total; ?></td>
                        <td class="border-b"><?php echo ($missing_stock_total == 0) ? '' : $missing_stock_total; ?></td>
                        <td class="border-b"><?php echo ($missing_stock_total == 0) ? '<i class="fa fa-check" style="color:green;"/>' : '<i class="fa fa-minus" style="color:red;"/>'; ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-1 mb-5">
                <input style="float:left;" type="checkbox" class="input border mr-2" id="vertical-remember-me"
                    <?php echo ($missing_stock_total != 0) ? 'checked' : '' ?> disabled/>
                <label style="float:left;" class="cursor-pointer select-none" for="vertical-remember-me">Need to order
                    Material</label>
            </div>
            <div class="mt-1 mb-2" style="text-align: right;position: relative;right: 10px;">
                <input type="checkbox" class="input border mr-2" id="vertical-remember-me_r1"
                    <?php echo ($missing_stock_total == 0) ? 'checked' : '' ?> disabled/>
                <label class="cursor-pointer select-none" for="vertical-remember-me_r1">Materials in stock</label>
            </div>
            <div class="mt-1 mb-2" style="text-align: right;">
                <input type="checkbox" class="input border mr-2" id="vertical-remember-me_r2"
                    <?php echo ($missing_stock_total == 0) ? 'checked' : '' ?> disabled/>
                <label class="cursor-pointer select-none" for="vertical-remember-me_r2">Materials Collected</label>
            </div>
            <div class=" py-3 text-right border-t border-gray-200">
                <button data-dismiss="modal" class="button w-30 bg-theme-1 text-white">Save & Close
                </button>
                <button data-dismiss="modal" class="button w-30 bg-theme-6 text-white" id="closeModalBtn"
                        onclick="javascript:event.preventDefault();">Close
                </button>
            </div>
            <input type="hidden" name="job_id" value="<?php echo ($job) ? $job->id : ''; ?>"/>
        </form>
    </div>

</div>
<div class="modal" id="installation_summary">
    <div class="modal__content modal__content--lg p-5 text-center" id="installation_modal_content" style="width: 75%;">
        <div class="flex items-center py-5 sm:py-3 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">Installation Summary</h2>
        </div>
        <div class="intro-y flex flex-col sm:flex-row mt-3"><h2><b>Customer Info: </b></h2></div>
        <div class="grid grid-cols-12 gap-6" id="customer_detail">
            <div class="col-span-6" style="padding: 1em;text-align: left;">
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 100px;">Customer:</label>
                    <label><?php echo $customer->customer; ?></label>
                </div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 100px;"> Address:</label>
                    <label><?php echo $customer->address; ?></label>
                </div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 100px;"> City:</label>
                    <label><?php echo $customer->city; ?></label>
                </div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 100px;"> Job Type:</label>
                    <label><?php echo $oppor->job_type; ?></label>
                </div>
            </div>
            <div class="col-span-6" style="padding: 1em;text-align: left;">
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 150px;">Contact Person:</label>
                    <label><?php echo $customer->contact_person; ?></label>
                </div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 150px;"> Phone:</label>
                    <label><?php echo $customer->phone1; ?></label>
                </div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 150px;"> Postal Code:</label>
                    <label><?php echo $customer->postal_code; ?></label>
                </div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 150px;"> City:</label>
                    <label><?php echo $oppor->sale_rep; ?></label>
                </div>
            </div>
        </div>
        <hr>
        <div class="intro-y flex flex-col sm:flex-row mt-3"><h2><b>Quote Notes: </b></h2></div>
        <div class="grid grid-cols-12 gap-1" id="quote_notes">
            <?php
            if ($oppor->job_type == 'New Fence' || $oppor->job_type == 'New Fence and Gate c/w Operator') {
                ?>
                <div class="col-span-6" style="padding: 1em;text-align: left;">
                    <div class="intro-y flex sm:flex-row mt-1">
                        <label style="width: 350px;">FENCE - Including Fabric,
                            Top Rail, Line Posts & Fittings:</label>
                        <label><?php echo $quote->additional_col_1; ?></label>
                    </div>
                    <div class="intro-y flex sm:flex-row mt-1">
                        <label style="width: 350px;"> END POSTS:</label>
                        <label><?php echo $quote->additional_col_2; ?></label>
                    </div>
                    <div class="intro-y flex sm:flex-row mt-1">
                        <label style="width: 350px;"> GATE POSTS:
                        </label>
                        <label><?php echo $quote->additional_col_3; ?></label>
                    </div>
                    <div class="intro-y flex sm:flex-row mt-1">
                        <label style="width: 350px;"> CORNER POSTS:</label>
                        <label><?php echo $quote->additional_col_4; ?></label>
                    </div>
                </div>
                <div class="col-span-4" style="padding: 1em;text-align: left;">
                    <div class="intro-y flex sm:flex-row mt-1">
                        <label style="width: 200px;">STRAINING POSTS:</label>
                        <label><?php echo $quote->additional_col_5; ?></label>
                    </div>
                    <div class="intro-y flex sm:flex-row mt-1">
                        <label style="width: 200px;"> FITTINGS:</label>
                        <label><?php echo $quote->additional_col_6; ?></label>
                    </div>
                    <div class="intro-y flex sm:flex-row mt-1">
                        <label style="width: 200px;"> GATES:</label>
                        <label><?php echo $quote->additional_col_7; ?></label>
                    </div>

                </div>
                <div class="col-span-12">
                    <div class="intro-y flex sm:flex-row mt-1">
                        * Erection of Fence & Gates: All line posts set <?php echo $quote->additional_select_1; ?>
                    </div>
                    <div class="intro-y flex sm:flex-row mt-1">
                        <?php if ($quote->additional_select_1 == '' || $quote->additional_select_1 == 'IN CONCRETE') { ?>
                            (In normal soil & on cleared line marked by customer with survey
                            bars)
                        <?php } elseif ($quote->additional_select_1 == 'ON FLANGES') { ?>
                            On normal concrete slab cleared of all obstacles 72" radius.
                        <?php } elseif ($quote->additional_select_1 == 'COREDRILLED') { ?>
                            (Radar Scan / X-Ray services and / or location of embedded objects
                            not included in this quotation.)
                        <?php } ?>
                    </div>
                    <div class="intro-y flex sm:flex-row mt-1">
                        * Terminal posts installed <?php echo $quote->additional_select_2; ?>
                    </div>
                    <div class="intro-y flex sm:flex-row mt-1 mb-2">
                        <?php if ($quote->additional_select_2 == '' || $quote->additional_select_2 == 'IN CONCRETE') { ?>
                            (In normal soil & on cleared line marked by customer with survey
                            bars)
                        <?php } elseif ($quote->additional_select_2 == 'ON FLANGES') { ?>
                            On normal concrete slab cleared of all obstacles 72" radius.
                        <?php } elseif ($quote->additional_select_2 == 'COREDRILLED') { ?>
                            (Radar Scan / X-Ray services and / or location of embedded objects
                            not included in this quotation.)
                        <?php } ?>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="intro-y flex sm:flex-row mt-1">
                    <?php echo nl2br($quote->additional_notes); ?>
                </div>
            <?php } ?>
        </div>
        <hr>
        <div class="intro-y flex sm:flex-row mt-3"><h2><b>Installation Details: </b></h2></div>
        <div class="grid grid-cols-12 gap-6" id="installation_detail">
            <div class="col-span-4" style="text-align: left;padding: 1em;">
                <div class="intro-y flex sm:flex-row mt-1"><h3><b>Specifications: </b></h3></div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <span style="width: 100px;"> Mesh:</span>
                    <span><?php echo $quote->installation_detail_1; ?></span>
                </div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 100px;"> Line Post:</label>
                    <label><?php echo $quote->installation_detail_2; ?></label>
                </div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 100px;"> Top Rail:</label>
                    <label><?php echo $quote->installation_detail_3; ?></label>
                </div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 100px;"> Main Post:</label>
                    <label><?php echo $quote->installation_detail_4; ?></label>
                </div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 100px;"> Holes Thru: </label>
                    <label><?php echo $quote->installation_detail_5; ?></label>
                </div>
                <div class="intro-y flex sm:flex-row mt-1"><h3><b>Specifications: </b></h3></div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 100px;"> Mains : </label>
                    <label><?php echo $quote->installation_detail_6; ?></label>
                </div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 100px;"> Lines : </label>
                    <label><?php echo $quote->installation_detail_7; ?></label>
                </div>
                <div class="intro-y flex sm:flex-row mt-1"><h3><b>Footing Diameter: </b></h3></div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 100px;"> Bottom : </label>
                    <label><?php echo $quote->installation_detail_8; ?></label>
                </div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 100px;"> Centre : </label>
                    <label><?php echo $quote->installation_detail_9; ?></label>
                </div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 100px;"> Braces : </label>
                    <label><?php echo $quote->installation_detail_10; ?></label>
                </div>
            </div>
            <div class="col-span-4" style="padding: 1em;">
                <div class="intro-y flex sm:flex-row mt-1"><h3><b>Locate Fence By: </b></h3></div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 100px;"> Stakes:</label>
                    <label><?php echo $quote->installation_detail_11; ?></label>
                </div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 100px;"> Ex Fence:</label>
                    <label><?php echo $quote->installation_detail_12; ?></label>
                </div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 100px;"> Sales Rep:</label>
                    <label><?php echo $quote->installation_detail_13; ?></label>
                </div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 100px;"> Customer:</label>
                    <label><?php echo $quote->installation_detail_14; ?></label>
                </div>
                <div class="intro-y flex sm:flex-row mt-1"><h3><b>Keep Fence: </b></h3></div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 100px;"> On Line : </label>
                    <label><?php echo $quote->installation_detail_15; ?></label>
                </div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 100px;"> Inside Line : </label>
                    <label><?php echo $quote->installation_detail_16; ?></label>
                </div>
                <div class="intro-y flex sm:flex-row mt-1"><h3><b>Main Post Set: </b></h3></div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 100px;"> Concrete : </label>
                    <label><?php echo $quote->installation_detail_17; ?></label>
                </div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 100px;"> Driven : </label>
                    <label><?php echo $quote->installation_detail_18; ?></label>
                </div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 100px;"> Flanged : </label>
                    <label><?php echo $quote->installation_detail_19; ?></label>
                </div>
            </div>
            <div class="col-span-4" style="padding: 1em;">
                <div class="intro-y flex sm:flex-row mt-1"><h3><b>Footing Depth: </b></h3></div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 100px;"> Mains:</label>
                    <label><?php echo $quote->installation_detail_20; ?></label>
                </div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 100px;"> Lines:</label>
                    <label><?php echo $quote->installation_detail_21; ?></label>
                </div>
                <div class="intro-y flex sm:flex-row mt-1"><h3><b>Barbwire: </b></h3></div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 100px;"> None : </label>
                    <label><?php echo $quote->installation_detail_22; ?></label>
                </div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 100px;"> In : </label>
                    <label><?php echo $quote->installation_detail_23; ?></label>
                </div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 100px;"> Out : </label>
                    <label><?php echo $quote->installation_detail_24; ?></label>
                </div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 100px;"> Vertical : </label>
                    <label><?php echo $quote->installation_detail_25; ?></label>
                </div>
                <div class="intro-y flex sm:flex-row mt-1"><h3><b>Existing Fence: </b></h3></div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 100px;"> None : </label>
                    <label><?php echo $quote->installation_detail_26; ?></label>
                </div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 100px;"> Remove : </label>
                    <label><?php echo $quote->installation_detail_27; ?></label>
                </div>
                <div class="intro-y flex sm:flex-row mt-1">
                    <label style="width: 100px;"> Haul Away : </label>
                    <label><?php echo $quote->installation_detail_28; ?></label>
                </div>
            </div>

        </div>
        <div class="col-span-4 text-left mt-2">
            <div class="intro-y flex sm:flex-row">
                <label style="width: 200px;"> Contact Called : </label>
                <label>____________</label>
            </div>
            <div class="intro-y flex sm:flex-row mt-2">
                <label style="width: 200px;"> Stake Out Reports : </label>
                <label>____________</label>
            </div>
            <div class="intro-y flex sm:flex-row mt-2">
                <label style="width: 200px;"> Fence Line Cleared : </label>
                <label>____________</label>
            </div>
        </div>
        <div class="intro-y col-span-12 mt-3 text-left"><h2><b>Before leaving the yard make sure you have all
                    the tools and materials to do the job </b></h2></div>
        <div class="intro-y col-span-12 mt-1 text-left"><b>
                Do not dig a hole until you have the cable locates for all utilities in you hand and you have read and
                understand them</b></div>
        <div class="intro-y  col-span-12 mt-1 text-left"><b>
                Installers must provide a drawing for all completed jobs</b></div>
        <div class="col-span-12 text-left mt-3">
            <div class="intro-y flex sm:flex-row mt-1">
                <label style="width: 230px;"> Job reviewed Crew Forman : </label>
                <label>____________</label>
            </div>
            <div class="intro-y flex sm:flex-row mt-1">
                <label style="width: 230px;"> Job inspected by Sales Rep : </label>
                <label>____________</label>
            </div>
            <div class="intro-y flex sm:flex-row mt-1">
                <label style="width: 230px;"> Job Completed as per instructions : </label>
                <label>____________</label>
            </div>
        </div>
        <div class=" py-3 text-right border-t border-gray-200" id="installation_button_div">
            <button class="button w-24 bg-theme-1 text-white"
                    onclick="print_installation_detail();">
                Print
            </button>
            <button data-dismiss="modal" class="button w-24 bg-theme-6 text-white" id="closeModalBtn">Close</button>
        </div>
    </div>
</div>
<div class="modal" id="cancel-payment-modal">
    <div class="modal__content modal__content--lg p-5 text-center">
        <div class="flex items-center py-5 sm:py-3 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">Notification</h2>
        </div>
        <div class="overflow-x-auto">
            <p>Do you want to cancel this payment</p>
        </div>
        <input type="hidden" id="cancel_payment_id"/>
        <input type="hidden" id="cancel_payment_amount"/>
        <div class=" py-3 text-right border-t border-gray-200">
            <button type="button" class="button w-20 bg-theme-6 text-white" id="OkayBtn">OK
            </button>
            <button data-dismiss="modal" type="button" class="button w-20 bg-theme-6 text-white" id="CancelBtn">Cancel
            </button>
        </div>
    </div>
</div>
<div class="modal" id="cancel-invoice-modal">
    <div class="modal__content modal__content--lg p-5 text-center">
        <div class="flex items-center py-5 sm:py-3 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">Notification</h2>
        </div>
        <div class="overflow-x-auto">
            <p>Do you want to cancel this invoice</p>
        </div>
        <input type="hidden" id="cancel_invoice_id"/>
        <input type="hidden" id="cancel_invoice_amount"/>
        <div class=" py-3 text-right border-t border-gray-200">
            <button type="button" class="button w-20 bg-theme-6 text-white" id="OkayBtn">OK
            </button>
            <button data-dismiss="modal" type="button" class="button w-20 bg-theme-6 text-white" id="CancelBtn">Cancel
            </button>
        </div>
    </div>
</div>
<script type="text/javascript">
    var job_id = '<?php echo ($job) ? $job->id : ""?>';
    var customer_id = '<?php echo ($job) ? $job->customer_id : ""?>';
    var company_id = '<?php echo ($job) ? $job->company_id : ""?>';
    var status = '<?php echo ($job) ? $job->status : ""?>';
    var job_balance = '<?php echo ($job) ? $job->job_balance : 0?>';
    var invoice_amount = '<?php echo $invoice_amount; ?>';
    var pay_amount = '<?php echo $pay_amount; ?>';
    var table;

    function format(d) {
        /*console.log(d.JobCity);*/
        // `d` is the original data object for the row
        if (d.type == "payment") {
            return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px; text-align:left;width: 100%;">' +
                '<tr style="background-color:deepskyblue;text-align:left">' +
                '<td>Trans. Date:</td>' +
                '<td>' + d.payment_date + '</td>' +
                '<td>Paymen Method:</td>' +
                '<td>' + d.payment_method + '</td>' +
                '<td><button class="button  bg-theme-6 text-white" onclick="cancel_payment(' + d.payment_id + ',' + d.credit * 1 + ')">Cancel Payment</button></td>' +
                '</tr></table>';
        } else {
            if (d.has_payment != '0') {
                return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px; text-align:left;width: 100%;">' +
                    '<tr style="background-color:deepskyblue;text-align:left">' +
                    '<td width="150px">Trans. Date:</td>' +
                    '<td>' + d.due_date + '</td>' +
                    '<td> </td>' +
                    '<td> </td>' +
                    '<td></td>' +
                    '</tr></table>';
            } else {
                return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px; text-align:left;width: 100%;">' +
                    '<tr style="background-color:deepskyblue;text-align:left">' +
                    '<td width="150px">Trans. Date:</td>' +
                    '<td>' + d.due_date + '</td>' +
                    '<td> </td>' +
                    '<td> </td>' +
                    '<td><button class="button  bg-theme-6 text-white" onclick="cancel_invoice(' + d.invoice_id + ',' + d.debit * 1 + ')">Cancel Invoice</button></td>' +
                    '</tr></table>';
            }
        }
    }

    function print_installation_detail() {
        var originalContents = $('body').html();
        $('#installation_button_div').remove();
        var printContents = $('#installation_modal_content').html();
        $('body').html(printContents);
        $('body').css('overflow', 'auto');
        setTimeout(function () {
            window.print()
            $('body').html(originalContents);
        }, 2000);
    }

    function change_item_collect(rowId) {
        var quantity = $('#items_collected' + rowId).children().eq(2).html() * 1
        var total_missing_stock = $('#items_collected_total').children().eq(4).html() * 1
        var total_items_collected = $('#items_collected_total').children().eq(3).html() * 1
        var oldValue = event.target.oldvalue * 1;
        var nValue = event.target.value * 1;
        if (nValue < 0) {
            $('#items_collected' + rowId).children().eq(3).find('input').val('');
            showNotification('Number of collected items cannot be smaller than 0');
            nValue = 0;
        } else if (quantity < nValue) {
            $('#items_collected' + rowId).children().eq(3).find('input').val('');
            showNotification('Number of collected items cannot be greater than required quantity amount');
            nValue = 0;
        }

        $('#items_collected_total').children().eq(3).html(total_items_collected - oldValue + nValue);
        $('#items_collected_total').children().eq(4).html(total_missing_stock + oldValue - nValue);
        if (total_missing_stock + oldValue - nValue == 0) {
            $('#items_collected_total').children().eq(5).html('<i class="fa fa-check" style="color:green;"/>');
            status = 'MAT Collected';
        } else {
            status = 'MAT Missing in Stock';
            $('#items_collected_total').children().eq(5).html('<i class="fa fa-minus" style="color:red;"/>');
        }


        if (quantity == nValue) {
            $('#items_collected' + rowId).children().eq(4).html('<i class="fa fa-check" style="color:green;"/>')
            $('#items_collected' + rowId).children().eq(5).html('<i class="fa fa-minus" style="color:green;"/>')
        } else if (quantity > nValue) {
            $('#items_collected' + rowId).children().eq(4).html(quantity - nValue);
            $('#items_collected' + rowId).children().eq(5).html('<i class="fa fa-minus" style="color:red;"/>')
        }
    }

    $(document).ready(function () {
        $('#material-detailed').modal({
            backdrop: 'static',
            keyboard: false
        });
        var materialSettingTable = $('#material-setting-table').html();

        $('#closeModalBtn').click(function () {
            $('#material-setting-table').html(materialSettingTable);
        })

        $.fn.dataTable.ext.errMode = 'throw';

        table = $('#jobDetailTable').DataTable({
            "pageLength": 50,
            "searching": false,
            "ajax": {
                url: '<?php echo base_url("Jobs/credits_debits_tracking");?>',
                type: 'GET',
                data: function (data) {
                    data.job_id = job_id;
                },
                // type:'JSON'
            },
            "columns": [
                {
                    "className": 'details-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": ''
                },
                {"data": "invoice_id"},
                {"data": "payment_id"},
                {"data": "debit"},
                {"data": "credit"},
                {"data": "due_date", 'width': '15%'},
                {"data": "account_balance"},
                {"data": "job_balance"},
                {"data": "notes", "width": "15%"},
            ],
            "order": [[0, 'asc']]
        });
        $('#invoice_due_date').daterangepicker({
            "showDropdowns": true,
            "minYear": 2010,
            "singleDatePicker": true,
        });
        $('#invoice_due_date').val('');
        // Add event listener for opening and closing details
        $('#jobDetailTable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(format(row.data())).show();
                tr.addClass('shown');
            }
        });
        $('#create_payment').click(function () {
            var available_payment_amount = Math.round((job_balance * 1 - pay_amount * 1) * 110) / 100;
            if ($('#invoice_number').val() == '' || $('#payment_amount').val() == '' || $('#payment_method').val() == ''
                || $('#reference').val() == '') {
                showNotification('You need to input all information for creating payment');
                return;
            } else if ($('#payment_amount').val() * 1 < 0) {
                showNotification('Payment amount must be bigger than 0');
                $('#payment_amount').select();
                return;
            }
                // else if ($('#payment_amount').val() * 1 > available_payment_amount) {
                //     showNotification('Payment amount cannot exceed ' + available_payment_amount);
                //     $('#payment_amount').select();
                //     return;
            // }
            else if ($('#invoice_number').val()) {

                $.ajax('check_available_invoice', {
                    type: 'POST',  // http method
                    data: {
                        invoice_number: $('#invoice_number').val(),
                        job_id: job_id,
                    },  // data to submit
                    success: function (data, status, xhr) {
                        if (data == 'not_exist') {
                            showNotification('The set Invoice #' + $('#invoice_number').val() + ' is not found for Job ID ' + job_id);
                            $('#invoice_number').select();
                            return;
                        } else {
                            $.ajax('create_payment', {
                                type: 'POST',  // http method
                                data: {
                                    invoice_number: $('#invoice_number').val(),
                                    payment_amount: $('#payment_amount').val(),
                                    payment_method: $('#payment_method').val(),
                                    reference: $('#reference').val(),
                                    job_id: job_id,
                                    customer_id: customer_id
                                },  // data to submit
                                success: function (data, status, xhr) {
                                    table.ajax.reload(null, false);
                                    pay_amount += $('#payment_amount').val() * 1;
                                    $('#invoice_number').val('');
                                    $('#payment_amount').val('');
                                    $('#payment_method').val('');
                                    $('#reference').val('');
                                    if (data != 'not_completed_paid') {
                                        $('#status_filed').html(data);
                                    }
                                },
                                error: function (jqXhr, textStatus, errorMessage) {
                                    console.log(errorMessage);
                                }
                            });
                        }
                    },
                    error: function (jqXhr, textStatus, errorMessage) {
                        console.log(errorMessage);
                    }
                });
            }

        });
        $('#generate_invoice').click(function () {
            var available_invoice_amount = Math.round((job_balance * 1 - invoice_amount * 1) * 110) / 100;

            if ($('#invoice_id').val() == '' || $('#invoice_amount').val() == '' || $('#invoice_due_date').val() == '') {
                showNotification('You need to input all information for generating invoice');
                return;
            } else if ($('#invoice_amount').val() * 1 < 0) {
                showNotification('Invoice amount must be bigger than 0.');
                $('#invoice_amount').select();
                return;
            }
                // else if ($('#invoice_amount').val() * 1 > available_invoice_amount) {
                //     showNotification('Invoice amount can not be bigger than ' + available_invoice_amount);
                //     $('#invoice_amount').select();
                //     return;
            // }
            else {
                $.ajax('check_available_invoice', {
                    type: 'POST',  // http method
                    data: {
                        invoice_number: $('#invoice_id').val()
                    },
                    success: function (data, status, xhr) {
                        var invoice_number = $('#invoice_id').val();
                        if (data == 'exist') {
                            showNotification('Invoice ID # ' + invoice_number + ' already exists in the system.');
                            return;
                        }
                        $.ajax('generate_invoice', {
                            type: 'POST',  // http method
                            data: {
                                invoice_id: $('#invoice_id').val(),
                                invoice_amount: $('#invoice_amount').val(),
                                invoice_due_date: $('#invoice_due_date').val(),
                                job_id: job_id,
                                customer_id: customer_id,
                                company_id: company_id
                            },
                            success: function (data, status, xhr) {
                                table.ajax.reload(null, false);
                                invoice_amount += $('#invoice_amount').val() * 1;
                                $('#invoice_id').val('');
                                $('#invoice_amount').val('');
                                $('#invoice_due_date').val('');
                            },
                            error: function (jqXhr, textStatus, errorMessage) {
                                console.log(errorMessage);
                            }
                        });
                    },
                    error: function (jqXhr, textStatus, errorMessage) {
                        console.log(errorMessage);
                    }
                });
            }
        });
        $('#cancel-payment-modal').on('click', '#OkayBtn', function () {
            var payment_id = $('#cancel_payment_id').val();
            var payment_amount = $('#cancel_payment_amount').val() * 1;
            $.ajax('cancel_payment', {
                type: 'POST',  // http method
                data: {payment_id: payment_id, job_id: job_id},  // data to submit
                success: function (data) {
                    pay_amount -= payment_amount;
                    table.ajax.reload(null, false);
                    $('#status_filed').html(data);
                    $('#cancel-payment-modal').modal('hide');
                },
                error: function (jqXhr, textStatus, errorMessage) {
                    console.log(errorMessage);
                }
            });
        });
        $('#cancel-invoice-modal').on('click', '#OkayBtn', function () {
            var invoice_id = $('#cancel_invoice_id').val();
            var invoice_amount = $('#cancel_invoice_amount').val() * 1;
            $.ajax('cancel_invoice', {
                type: 'POST',  // http method
                data: {invoice_id: invoice_id, job_id: job_id},  // data to submit
                success: function (data) {
                    invoice_amount -= invoice_amount;
                    table.ajax.reload(null, false);
                    $('#cancel-invoice-modal').modal('hide');
                },
                error: function (jqXhr, textStatus, errorMessage) {
                    console.log(errorMessage);
                }
            });
        });
    })
    ;
    $('#job_setting_btn').click(function () {
        $.ajax('set_job_settings', {
            type: 'POST',  // http method
            data: {
                installer: $('#installer').val(),
                start_date: $('#start_date').val(),
                end_date: $('#end_date').val(),
                job_id: job_id,
            },
            success: function (data, status, xhr) {
                status = data;
                if (status == 'In progress') {
                    $('#end_date').attr('readonly', false);
                    $('#end_date').attr('disabled', false);
                    $('#vertical-remember-me_r3').attr('checked', true);
                }
                $('#status_filed').html(status);
            },
            error: function (jqXhr, textStatus, errorMessage) {
                console.log(errorMessage);
            }
        });
    });

    function set_item_collect(mat_id) {
        event.preventDefault();
        return;
    }

    function cancel_payment(payment_id, payment_amount) {
        $("#cancel-payment-modal").modal('show');
        $('#cancel_payment_id').val(payment_id);
        $('#cancel_payment_amount').val(payment_amount);


    }

    function cancel_invoice(invoice_id, invoice_amount) {
        $("#cancel-invoice-modal").modal('show');
        $('#cancel_invoice_id').val(invoice_id);
        $('#cancel_invoice_amount').val(invoice_amount);


    }
</script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>