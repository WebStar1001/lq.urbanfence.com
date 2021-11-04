<style>
    #choosecustomer_label {
        width: 110px;
        text-align: center;
    }

    label.select_label_width {
        width: 11rem;
    }

    label.width6 {
        width: 6rem;
    }

    #address_div_mg {
        margin-top: -0.75rem;
    }

    .add_icon_width {
        width: 40px;
    }

    div.status_width {
        width: 50%;
    }

    @media screen and (max-width: 769px) {
        #address_div_mg {
            margin-top: -2%;
        }

        label.width6 {
            width: 6rem;
        }
    }

    @media screen and (max-width: 639px) {
        .status_width {
            width: 45%;
        }

        label.width6 {
            width: auto;
        }

        .add_icon_width {
            display: none;
        }

        #add_opppor_left_info, #add_opppor_right_info {
            margin-top: -0.75rem;
        }
    }
</style>


<!-- BEGIN: Content -->
<div class="content">
    <!-- BEGIN: Top Bar -->
    <div class="top-bar">
        <!-- BEGIN: Breadcrumb -->
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex"><a href="" class="">Urbanfence</a> <i
                    data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Add
                New Opportunity</a></div>
        <!-- END: Breadcrumb -->
        <!-- BEGIN: Account Menu -->
        <?php include(APPPATH . "views/inc/account_menu.php") ?>
        <!-- END: Account Menu -->
    </div>
    <?php
    $job_type = array('',
        'Fence Repair', 'Gate Repair', 'Fence and Gate Repair', 'New Fence', 'New Gate', 'New Fence and Gate c/w Operator',
        'Gate Operator Service');
    $sale_source = array('', 'Returned Customer', 'Yellow Pages', 'Facebook', 'Google Ad', "Friend's Referral");
    $status = array('New', 'Assigned');
    $urgency = array('Normal', 'Urgent');
    ?>
    <form name="opporForm" method="post" action="save_opportunity">
        <div class="grid grid-cols-12 gap-6 box mt-5 md:p-10 sm:p-5 p-5">
            <div class="col-span-12">
                <div class="preview">
                    <div class="intro-y flex flex-col sm:flex-row">
                        <div class="col-span- w-full" style="display:none;">
                            <fieldset class="p-2 mb-3 sm:mb-0 sm:p-3 status_width fieldset_bd_color"
                                      style="width: 300px!important;">
                                <legend class="legend_spacing">Customer</legend>
                                <p>Customer Name : <span
                                            id="customer_name_span"><?php echo (is_object($customer)) ? $customer->customer : ''; ?></span>
											
                                    <br>Address: <span
                                            id="customer_address_span"><?php echo (is_object($customer)) ? $customer->address : ''; ?></span>
                                </p>
                            </fieldset>
                        </div>
                        <div class="col-span-4 w-full">
                            <div class="sm:w-ful col-span-12 sm:m-auto sm:pl-4 sm:pr-4 mt-3 sm:mt-0 mb-3 sm:mb-0">
                                <label class="w-full text-left sm:pt-3">Search Customer *</label>
                                <select name="customer_id" class="select2 w-full col-span-10" id="search_customer"
                                        tabindex="1">
                                    <?php
                                    if (is_object($customer)) {
                                        echo '<option value="' . $customer->id . '">' . $customer->customer . '</option>';
                                    }
                                    ?>

                                </select>
                            </div>

                        </div>
                        <?php if (!is_object($customer)) { ?>
                            <div class="col-span-4 w-full">
                                <label class="w-full w-1/3 text-left sm:pt-3 mr-3 sm:mr-0">Create New Customer</label>
                                <a href="#add_customer_modal" data-toggle="modal" data-target="#add_customer_modal"><i
                                            style="font-size: 30px;"
                                            class="w-full fa fa-user-plus"
                                            aria-hidden="true" tabindex="2"></i></a>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>

            <div class="col-span-12 sm:col-span-6 md:col-span-6 md:ml-3" id="add_opppor_left_info">
                <div class="preview">
                    <div class="intro-y flex flex-col sm:flex-row">
                        <label class="w-full sm:text-left md:mr-5 width6 pt-1 sm:pt-3">Customer Name</label>
                        <input type="text" name="ccustomer" id="ccustomer" tabindex="4"
                               class=" input w-full sm:w-1/2 md:w-1/2 border mt-2 flex-1"
                               value="<?php if (is_object($opportunity)) echo $opportunity->ccustomer; else if (is_object($customer)) echo $customer->customer; else echo '';  ?>">
                    </div>	
                    <div class="intro-y flex flex-col sm:flex-row">
                        <label class="w-full sm:text-left md:mr-5 width6 pt-1 sm:pt-3">Phone</label>
                        <input type="text" name="cphone1" id="cphone1" tabindex="6"
                               class=" input w-full sm:w-1/2 md:w-1/2 border mt-2 flex-1"
                               value="<?php if (is_object($opportunity)) echo $opportunity->cphone1; else if (is_object($customer)) echo $customer->phone1; else echo '';  ?>">
                    </div>					
                    <div class="intro-y flex flex-col sm:flex-row mb-3 sm:mb-0">
                        <label class="w-full sm:text-left md:mr-5 width6 pt-1 sm:pt-3 ">Address</label>
                        <input type="text" tabindex="8" name="caddress" id="caddress"
                               class="input w-full sm:w-1/2 md:w-1/2 border mt-2 flex-1"
                               value="<?php if (is_object($opportunity)) echo $opportunity->caddress; else if (is_object($customer)) echo $customer->address; else echo '';  ?>">
                    </div>
                    <div class="intro-y flex flex-col sm:flex-row mb-3 sm:mb-0">
                        <label class="w-full sm:text-left md:mr-5 width6 pt-1 sm:pt-3 ">Postal Code</label>
                        <input type="text" tabindex="10" name="cpostalcode" id="cpostalcode"
                               class="input w-full sm:w-1/2 md:w-1/2 border mt-2 flex-1"
                               value="<?php if (is_object($opportunity)) echo $opportunity->cpostalcode; else if (is_object($customer)) echo $customer->postal_code; else echo '';  ?>">
                    </div>					
                    <div class="intro-y flex flex-col sm:flex-row">
                        <label class="w-full sm:text-left md:mr-5 width6 pt-1 sm:pt-3">Status</label>
                        <input type="text" name="status" readonly tabindex="12"
                               class="bg-gray-100 cursor-not-allowed input w-full sm:w-1/2 md:w-1/2 border mt-2 flex-1"
                               value="<?php echo (is_object($opportunity)) ? $opportunity->status : 'New'; ?>">
                    </div>
                    <div class="intro-y flex flex-col sm:flex-row mt-3">
                        <label class="w-full sm:text-left md:mr-5 width6 pt-1 sm:pt-3">Date </label>
                        <input type="Date" name="date" class="input w-full sm:w-1/2 md:w-1/2 border mt-2 flex-1"
                               tabindex="14"
                               value="<?php echo (is_object($opportunity)) ? $opportunity->date : date('Y-m-d'); ?>"
                               readonly>
                    </div>
                    <div class="intro-y flex flex-col sm:flex-row mt-3">
                        <label class="w-full sm:text-left md:mr-5 width6 pt-1 sm:pt-3">Job Type * </label>
                        <select name="job_type" class="input w-full border mt-2 flex-1" required tabindex="16">
                            <?php
                            foreach ($job_type as $key => $value) {
                                if (is_object($opportunity)) {
                                    if ($opportunity->job_type == $value) {
                                        echo '<option value="' . $value . '" selected>' . $value . '</option>';
                                    } else {
                                        echo '<option value="' . $value . '">' . $value . '</option>';
                                    }
                                } else {
                                    echo '<option value="' . $value . '">' . $value . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="intro-y flex flex-col sm:flex-row mt-3">
                        <label class="w-full sm:text-left md:mr-5 width6 pt-1 sm:pt-3">Urgency</label>
                        <select name="urgency" class="input w-full border mt-2 flex-1" tabindex="18">
                            <?php
                            foreach ($urgency as $key => $value) {
                                if (is_object($opportunity)) {
                                    if ($opportunity->urgency == $value) {
                                        echo '<option value="' . $value . '" selected>' . $value . '</option>';
                                    } else {
                                        echo '<option value="' . $value . '">' . $value . '</option>';
                                    }
                                } else {
                                    echo '<option value="' . $value . '">' . $value . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>


                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 md:col-span-6 md:mr-3" id="add_opppor_right_info">
                <div class="preview">
                    <div class="intro-y flex flex-col sm:flex-row mb-3 sm:mb-0">
                        <label class="w-full sm:text-left md:mr-5 width6 pt-1 sm:pt-3 ">Contact Person</label>
                        <input type="text" tabindex="5" name="ccontact_person" id="ccontact_person"
                               class="input w-full sm:w-1/2 md:w-1/2 border mt-2 flex-1"
                               value="<?php if (is_object($opportunity)) echo $opportunity->ccontact_person; else if (is_object($customer)) echo $customer->contact_person; else echo '';  ?>">
                               
                    </div>	
                    <div class="intro-y flex flex-col sm:flex-row mb-3 sm:mb-0">
                        <label class="w-full sm:text-left md:mr-5 width6 pt-1 sm:pt-3 ">Email</label>
                        <input type="text" tabindex="7" name="cemail" id="cemail"
                               class="input w-full sm:w-1/2 md:w-1/2 border mt-2 flex-1"
                               value="<?php if (is_object($opportunity)) echo $opportunity->cemail; else if (is_object($customer)) echo $customer->email; else echo '';  ?>">
                               
                    </div>	
                    <div class="intro-y flex flex-col sm:flex-row mb-3 sm:mb-0">
                        <label class="w-full sm:text-left md:mr-5 width6 pt-1 sm:pt-3 ">City</label>
                        <input type="text" tabindex="9" name="ccity" id="ccity"
                               class="input w-full sm:w-1/2 md:w-1/2 border mt-2 flex-1"
                               value="<?php if (is_object($opportunity)) echo $opportunity->ccity; else if (is_object($customer)) echo $customer->city; else echo '';  ?>">
                               
                    </div>						
                    <div class="intro-y flex flex-col sm:flex-row mb-3 sm:mb-0">
                        <label class="w-full sm:text-left md:mr-5 width6 pt-1 sm:pt-3 ">Created By</label>
                        <input type="text" tabindex="11"
                               class="bg-gray-100 cursor-not-allowed input w-full sm:w-1/2 md:w-1/2 border mt-2 flex-1"
                               value="<?php echo (is_object($opportunity)) ? $opportunity->created_by : user_name(); ?>"
                               readonly>
                    </div>
                    <div class="intro-y flex flex-col sm:flex-row mb-3 sm:mb-0 mt-3">
                        <label class="w-full sm:text-left md:mr-5 width6 pt-1 sm:pt-3 ">Time</label>
                        <input type="text" name="time" class="input w-full border mt-2 flex-1" tabindex="13"
                               value="<?php echo (is_object($opportunity)) ? $opportunity->time : date('H:i:s'); ?>"
                               readonly>
                    </div>
                    <div class="intro-y flex flex-col sm:flex-row mt-3">
                        <label class="w-full sm:text-left md:mr-5 width6 pt-1 sm:pt-3">Sales Source *</label>

                        <?php
                        if (is_object($customer)) {
                            if ($customer->status == 'User') {
                                echo '<select class="input w-full border mt-2 flex-1" name="sale_source" disabled  tabindex="15">
                                        <option value="Returned Customer">Returned Customer</option></select>';
                            } else {
                                echo '<select class="input w-full border mt-2 flex-1" name="sale_source" required tabindex="15">';
                                foreach ($sale_source as $key => $value) {
                                    if (is_object($opportunity)) {
                                        if ($opportunity->sale_source == $value) {
                                            echo '<option value="' . $value . '" selected>' . $value . '</option>';
                                        } else {
                                            echo '<option value="' . $value . '">' . $value . '</option>';
                                        }
                                    } else {
                                        echo '<option value="' . $value . '">' . $value . '</option>';
                                    }
                                }
                                echo '</select>';
                            }
                        } else {
                            echo '<select class="input w-full border mt-2 flex-1" name="sale_source" required tabindex="15">';
                            foreach ($sale_source as $key => $value) {
                                if (is_object($opportunity)) {
                                    if ($opportunity->sale_source == $value) {
                                        echo '<option value="' . $value . '" selected>' . $value . '</option>';
                                    } else {
                                        echo '<option value="' . $value . '">' . $value . '</option>';
                                    }
                                } else {
                                    echo '<option value="' . $value . '">' . $value . '</option>';
                                }
                            }
                            echo '</select>';
                        }
                        ?>
                        </select>
                    </div>

                    <div class="intro-y flex flex-col sm:flex-row mt-3">
                        <label class="w-full sm:text-left md:mr-5 width6 pt-1 sm:pt-3">Contact onsite</label>
                        <input type="text" name="contact_onsite" class="input w-full border mt-2 flex-1" tabindex="17"
                               value="<?php echo (is_object($opportunity)) ? $opportunity->contact_onsite : '' ?>">
                    </div>
                </div>
            </div>
            <fieldset class="fieldset_bd_color w-full col-span-12">
                <legend class="legend_spacing">Job Site</legend>
                <div class="grid grid-cols-12 gap-6 box sm:p-5 p-5">
                    <div class="col-span-12 sm:col-span-6 md:col-span-6 md:ml-3" id="add_opppor_left_info">
                        <div class="preview">
                            <div class="intro-y flex flex-col sm:flex-row mb-3 sm:mb-0">
                                <label class="w-full sm:text-left md:mr-5 width6 pt-1 sm:pt-3">Site City *</label>
                                <input type="text" name="site_city" id="site_city" class="input border mt-2 flex-1" required
                                       tabindex="19"
                                       value="<?php echo (is_object($opportunity)) ? $opportunity->site_city : ''; ?>">
                            </div>
                        </div>
                        <div class="intro-y flex flex-col sm:flex-row mb-3 sm:mb-0">
                            <label class="w-full sm:text-left md:mr-5 width6 pt-1 sm:pt-3">Site Address *</label>
                            <input type="text" name="site_address" id="site_address" class="input border mt-2 flex-1" required
                                   tabindex="21"
                                   value="<?php echo (is_object($opportunity)) ? $opportunity->site_address : '' ?>">
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 md:col-span-6 md:mr-3" id="add_opppor_right_info">
                        <div class="preview">
                            <div class="intro-y flex flex-col sm:flex-row mb-3 sm:mb-0">
                                <label class="w-full sm:text-left md:mr-5 width6 pt-1 sm:pt-3">Site Postal Code
                                    *</label>
                                <input type="text" name="site_postal_code" id="site_postal_code" class="input border mt-2 flex-1" required
                                       tabindex="20"
                                       value="<?php echo (is_object($opportunity)) ? $opportunity->site_postal_code : '' ?>">
                            </div>
                            <input type="button" value="Use Customer Info" style="float: right;"
                                   id="copy_from_customer"
                                   class="button bg-theme-1 text-white mt-5 p-2 ml-2" tabindex="22"/>
                        </div>
                    </div>
                </div>
            </fieldset>
            <div class="col-span-12 md:pl-3 md:pr-3" id="address_div_mg">
                <div class="preview">
                    <div class="intro-y flex flex-col sm:flex-row">
                        <label class="w-full sm:text-left md:mr-5 width6 pt-1 sm:pt-3"> Details</label>
                        <textarea class="input w-full border mt-2" name="details" tabindex="23"
                                  placeholder=""><?php echo (is_object($opportunity)) ? $opportunity->details : ''; ?></textarea>
                    </div>
                </div>
            </div>

            <input type="hidden" name="opportunity_id"
                   value="<?php echo (is_object($opportunity)) ? $opportunity->id : ''; ?>"/>
            <div class="col-span-12">
                <div class="preview">
                    <?php if(!is_user()):?>
                    <input type="submit" value="Proceed to Quote" name="proceed_to_quote"
                           style="float: right;" class="button bg-theme-1 text-white mt-5  ml-2 sm:p-2" tabindex="24"/>
                    <?php endif;?>
                    <input type="submit" value="Save Opportunity" name="save_opper"
                           style="float: right;" class="button bg-theme-1 text-white mt-5 sm:p-2" tabindex="24"/>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal" id="add_customer_modal">
    <div class="modal__content modal__content--xl p-5 text-center">
        <div class="flex items-center py-5 sm:py-3 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">Create New Customer</h2>
        </div>
        <div class="overflow-x-auto">
            <form id="add_customer_form">
                <div class="grid grid-cols-12 gap-6 box mt-5 p-5 md:p-10">
                    <?php if (is_admin()): ?>
                        <div class="col-span-12">
                            <div class="preview">
                                <div class="intro-y flex flex-col sm:flex-row mt-2">
                                    <label class="mb-2 sm:mb-0 md:mr-2 mt-2"> Choose Quoting
                                        Company</label>
                                    <select id="company_id" class="select2 w-full sm:w-2/6">
                                        <?php
                                        foreach ($companies as $com) {
                                            if (is_object($customer)) {
                                                if ($customer->company_id == $com->id) {
                                                    echo '<option value="' . $com->id . '" selected>' . $com->name . '</option>';
                                                } else {
                                                    echo '<option value="' . $com->id . '">' . $com->name . '</option>';
                                                }
                                            } else {
                                                echo '<option value="' . $com->id . '">' . $com->name . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="col-span-12 sm:col-span-6 md:col-span-6 set_extra_mg">
                        <div class="preview">

                            <div class="intro-y flex flex-col sm:flex-row mt-2">
                                <label class="w-full width6 md:mr-5 pt-1 sm:pt-3"> Customer*</label>
                                <input type="text" id="customer" class="input w-full border mt-2 flex-1" value="">
                            </div>

                            <div class="intro-y flex flex-col sm:flex-row mt-3">
                                <label class="w-full width6 md:mr-5 pt-1 sm:pt-3">Phone 1*</label>
                                <input type="text" id="phone1" class="input w-full border mt-2 flex-1" value="">
                            </div>
                            <div class="intro-y flex flex-col sm:flex-row mt-3">
                                <label class="w-full width6 md:mr-5 pt-1 sm:pt-3">Email *</label>
                                <input type="text" id="email" class="input w-full border mt-2 flex-1" value="">
                            </div>


                            <div class="intro-y flex flex-col sm:flex-row mt-3">
                                <label class="w-full width6 md:mr-5 pt-1 sm:pt-3">Billing Address*</label>
                                <input type="text" id="address" class="input w-full border mt-2 flex-1" value="">
                            </div>
                            <div class="intro-y flex flex-col sm:flex-row mt-3">
                                <label class="w-full width6 md:mr-5 pt-1 sm:pt-3">Postal Code</label>
                                <input type="text" id="postal_code" class="input w-full border mt-2 flex-1"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 sm:mr-4 md:col-span-6 set_extra_mg">
                        <div class="preview">
                            <div class="intro-y flex flex-col sm:flex-row mt-2">
                                <label class="w-full width6 md:mr-5 pt-1 sm:pt-3">Contact Person*</label>
                                <input type="text" id="contact_person" class="input w-full border mt-2 flex-1" value="">
                                <input type="button" value="Use Same Name" style="float: right;" id="use_same_name"
                                       class="button bg-theme-1 text-white mt-5 p-2 ml-2"/>
                            </div>
                            <div class="intro-y flex flex-col sm:flex-row mt-3">
                                <label class="w-full width6 md:mr-5 pt-1 sm:pt-3">Phone 2</label>
                                <input type="text" id="phone2" class="input w-full border mt-2 flex-1" value=""/>
                            </div>
                            <div class="intro-y flex flex-col sm:flex-row mt-3">
                                <label class="w-full width6 md:mr-5 pt-1 sm:pt-3">Fax</label>
                                <input type="text" id="fax" class="input w-full border mt-2 flex-1" value=""/>
                            </div>
                            <div class="intro-y flex flex-col sm:flex-row mt-3">
                                <label class="w-full width6 md:mr-5 pt-1 sm:pt-3">City*</label>
                                <input type="text" id="city" class="input w-full border mt-2 flex-1" value=""/>
                            </div>

                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-12 sm:mr-4 md:col-span-12"
                         style="margin-bottom: 2%;margin-left: 1%;">
                        <div class="preview">
                            <input type="submit" value="Create Customer" style="float: right;"
                                   id="create_customer_btn"
                                   class="button bg-theme-1 text-white mt-5 p-2"/>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class=" py-3 text-right border-t border-gray-200">
            <button data-dismiss="modal" type="button" class="button w-20 bg-theme-6 text-white">Close</button>
        </div>
    </div>

</div>
<script type="text/javascript">
    var customer_address = '<?php echo (is_object($customer)) ? $customer->address : '';?>';
    $('#use_same_name').click(function () {
        $('#contact_person').val($('#customer').val());
    })
    $(document).ready(function () {
        $('#copy_from_customer').click(function () {
			
			$('#site_address').val($('#caddress').val());
			$('#site_city').val($('#ccity').val());
			$('#site_postal_code').val($('#cpostalcode').val());
            /*var customer_id = $('#search_customer').val();
            if (customer_id != '') {
                $.ajax('get_customer', {
                    type: 'GET',  // http method
                    data: {
                        customer_id: customer_id,
                    },
                    dataType: 'json',
                    success: function (data, status, xhr) {
                        $('input[name="site_address"]').val(data.address);
                        $('input[name="site_city"]').val(data.city);
                        $('input[name="site_postal_code"]').val(data.postal_code);
                    },
                    error: function (jqXhr, textStatus, errorMessage) {
                        console.log(errorMessage);
                    }
                });
            }*/

        })
        $('#search_customer').select2({
            tags: true,
            minimumInputLength: 3,
            ajax: {
                url: 'get_search_customer',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    var query = {
                        search: params.term,
                    }
                    return query;
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
        $('#search_customer').on('change', function () {
            $.ajax('get_customer', {
                type: 'GET',  // http method
                data: {
                    customer_id: this.value,
                },
                dataType: 'json',
                success: function (data, status, xhr) {
                    $('#customer_name_span').html(data.customer);
                    $('#customer_address_span').html(data.address);
					
					$('#ccustomer').val(data.customer);
					$('#caddress').val(data.address);
					$('#cphone1').val(data.phone1);
					$('#cemail').val(data.email);
					$('#ccontact_person').val(data.contact_person);
					$('#ccity').val(data.city);
					$('#cpostalcode').val(data.postal_code);
					
                },
                error: function (jqXhr, textStatus, errorMessage) {
                    console.log(errorMessage);
                }
            });
        })
        $('#add_customer_form').on('submit', function () {
            event.preventDefault();
            $.ajax('create_customer', {
                type: 'POST',  // http method
                data: {
                    company_id: $('#add_customer_modal').find('#company_id').val(),
                    customer: $('#add_customer_modal').find('#customer').val(),
                    contact_person: $('#add_customer_modal').find('#contact_person').val(),
                    phone1: $('#add_customer_modal').find('#phone1').val(),
                    phone2: $('#add_customer_modal').find('#phone2').val(),
                    address: $('#add_customer_modal').find('#address').val(),
                    postal_code: $('#add_customer_modal').find('#postal_code').val(),
                    email: $('#add_customer_modal').find('#email').val(),
                    fax: $('#add_customer_modal').find('#fax').val(),
                    city: $('#add_customer_modal').find('#city').val()
                },
                success: function (data, status, xhr) {
                    var customer_id = data;
                    $('#search_customer').append('<option value="' + customer_id + '">' + $('#add_customer_modal').find('#customer').val() + '</option>');
                    $('#add_customer_modal').modal('hide');
                    $('#customer_name_span').html($('#add_customer_modal').find('#customer').val());
                    $('#customer_address_span').html($('#add_customer_modal').find('#address').val());
                },
                error: function (jqXhr, textStatus, errorMessage) {
                    console.log(errorMessage);
                }
            });
        })
        // $('#create_customer_btn').click
    })
</script>
<!-- END: Content -->
 


                