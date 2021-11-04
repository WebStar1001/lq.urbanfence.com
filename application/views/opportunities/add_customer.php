<style>
    #choose_label {
        width: 115px;
    }

    label.width6 {
        width: 7rem;
    }

    .status_width {
        width: 16%;
        border: 1px solid;
    }

    label#label_status {
        color: white;
    }

    label.label_choose_width {
        width: 20%;
    }

    @media screen and (max-width: 1000px) {
        .status_width {
            width: 50%;
        }

    }

    @media screen and (max-width: 639px) {
        .status_width {
            width: 25%;
        }

        label#label_status {
            display: none;
        }

        label.label_choose_width {
            width: auto;
        }

        .set_extra_mg {
            margin-top: -5%;
        }

        label.width6 {
            width: auto;
        }
    }
</style>
<!-- BEGIN: Content -->
<div class="content">
    <!-- BEGIN: Top Bar -->
    <div class="top-bar">
        <!-- BEGIN: Breadcrumb -->
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex"><a href="" class="">Urbanfence</a> <i
                    data-feather="chevron-right" class="breadcrumb__icon"></i> <a class="breadcrumb--active">Add New
                Customer</a></div>
        <!-- END: Breadcrumb -->
        <!-- BEGIN: Account Menu -->
        <?php include(APPPATH . "views/inc/account_menu.php") ?>
        <!-- END: Account Menu -->
    </div>
    <form name="customerForm" method="post" action="save_customer" id="customerForm">
        <div class="grid grid-cols-12 gap-6 box mt-5 p-5 md:p-10">
            <div class="col-span-12">
                <div class="preview">
                    <?php if (is_admin()): ?>
                        <div class="intro-y flex flex-col sm:flex-row mt-2">
                            <label class="w-full w-full sm:w-1/3 md:w-1/4 lg:w-1/6 mb-2 sm:mb-0 md:mr-2"> Choose Quoting
                                Company</label>
                            <select name="company_id" class="select2 w-full sm:w-2/6" tabindex="0">
                                <?php
                                foreach ($company as $com) {
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
                    <?php endif; ?>
                    <div class="intro-y flex flex-col sm:flex-row mt-2">
                        <label class="w-full w-full sm:w-1/3 md:w-1/4 lg:w-1/6 mb-2 sm:mb-0 md:mr-2" id="label_status">
                            Choose Quoting Company</label>
                        <fieldset class="p-2 sm:p-3 status_width fieldset_bd_color">
                            <legend class="legend_spacing"> Status</legend>
                            <p> Lead </p>
                        </fieldset>

                    </div>
                </div>
            </div>

            <!-- <div class="col-span-12 sm:col-span-6 md:col-span-6">
                <div class="intro-y flex flex-col sm:flex-row items-center">
                        <label  class="sm:text-center pl-3" id="choose_label">Choose Quoting Company</label>
                        <select class="select2 w-full ">
                        <option>Urban Fence</option>
                   </select>
                    </div>
            </div> -->
            <div class="col-span-12 sm:col-span-6 md:col-span-6 set_extra_mg">
                <div class="preview">

                    <div class="intro-y flex flex-col sm:flex-row mt-2">
                        <label class="w-full width6 md:mr-5 pt-1 sm:pt-3"> Customer*</label>
                        <input type="text" name="customer" class="input w-full border mt-2 flex-1" required
                               id="customer"
                               value="<?php echo (is_object($customer)) ? $customer->customer : ''; ?>" tabindex="1">
                        <input type="button" value="Check Customer" style="float: right;" id="check_customer"
                               class="button bg-theme-1 text-white mt-5 p-2 ml-2"/>
                    </div>
                    <!-- <div class="intro-y flex flex-col sm:flex-row items-center mt-2">
                        <label class="w-full sm:w-20 sm:text-center sm:mr-5">Company</label>
                        <input type="text" class="input w-full border mt-2 flex-1">
                    </div> -->

                    <div class="intro-y flex flex-col sm:flex-row mt-3">
                        <label class="w-full width6 md:mr-5 pt-1 sm:pt-3">Phone 1*</label>
                        <input type="text" name="phone1" class="input w-full border mt-2 flex-1" required
                               value="<?php echo (is_object($customer)) ? $customer->phone1 : ''; ?>" tabindex="3">
                    </div>
                    <div class="intro-y flex flex-col sm:flex-row mt-3">
                        <label class="w-full width6 md:mr-5 pt-1 sm:pt-3">Email *</label>
                        <input type="text" name="email" class="input w-full border mt-2 flex-1" required
                               value="<?php echo (is_object($customer)) ? $customer->email : ''; ?>" tabindex="5">
                    </div>


                    <div class="intro-y flex flex-col sm:flex-row mt-3">
                        <label class="w-full width6 md:mr-5 pt-1 sm:pt-3">Billing Address*</label>
                        <input type="text" name="address" class="input w-full border mt-2 flex-1" required
                               value="<?php echo (is_object($customer)) ? $customer->address : ''; ?>" tabindex="7">
                    </div>
                    <div class="intro-y flex flex-col sm:flex-row mt-3">
                        <label class="w-full width6 md:mr-5 pt-1 sm:pt-3">Postal Code*</label>
                        <input type="text" name="postal_code" class="input w-full border mt-2 flex-1"
                               value="<?php echo (is_object($customer)) ? $customer->postal_code : ''; ?>"
                               tabindex="9" required/>
                    </div>

                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 sm:mr-4 md:col-span-6 set_extra_mg">
                <div class="preview">
                    <!-- <div class="intro-y flex flex-col sm:flex-row items-center">
                        <label class="w-full sm:text-center sm:w-20 sm:mr-5">Time</label>
                        <input  type="text" class=" input w-full border mt-2 flex-1">
                    </div> -->
                    <div class="intro-y flex flex-col sm:flex-row mt-2">
                        <label class="w-full width6 md:mr-5 pt-1 sm:pt-3">Contact Person*</label>
                        <input type="text" name="contact_person" class="input w-full border mt-2 flex-1" required
                               value="<?php echo (is_object($customer)) ? $customer->contact_person : ''; ?>"
                               tabindex="2">
                        <input type="button" value="Use Same Name" style="float: right;" id="copy_from_customer"
                               class="button bg-theme-1 text-white mt-5 p-2 ml-2"/>
                    </div>
                    <div class="intro-y flex flex-col sm:flex-row mt-3">
                        <label class="w-full width6 md:mr-5 pt-1 sm:pt-3">Phone 2</label>
                        <input type="text" name="phone2" class="input w-full border mt-2 flex-1"
                               value="<?php echo (is_object($customer)) ? $customer->phone2 : ''; ?>" tabindex="4"/>
                    </div>
                    <div class="intro-y flex flex-col sm:flex-row mt-3">
                        <label class="w-full width6 md:mr-5 pt-1 sm:pt-3">Fax</label>
                        <input type="text" name="fax" class="input w-full border mt-2 flex-1"
                               value="<?php echo (is_object($customer)) ? $customer->fax : ''; ?>" tabindex="6"/>
                    </div>
                    <div class="intro-y flex flex-col sm:flex-row mt-3">
                        <label class="w-full width6 md:mr-5 pt-1 sm:pt-3">City*</label>
                        <input type="text" name="city" class="input w-full border mt-2 flex-1" required
                               value="<?php echo (is_object($customer)) ? $customer->city : ''; ?>" tabindex="8"/>
                    </div>
                    <div class="preview">
                        <input type="submit" value="Save" style="float: right;" name="save"
                               class="button bg-theme-1 text-white mt-5 p-2 ml-5" tabindex="10"
                               onclick="submitForm();"/>
                        <input type="submit" value="Continue to Opportunity" style="float: right;" name="save"
                               class="button bg-theme-1 text-white mt-5 p-2" onclick="submitForm();" tabindex="11"/>
                    </div>

                </div>
            </div>
            <input type="hidden" name="customer_id" value="<?php echo (is_object($customer)) ? $customer->id : ''; ?>"/>
        </div>
    </form>
</div>
<div class="modal" id="confirm-modal">
    <div class="modal__content modal__content--lg p-5 text-center">
        <div class="flex items-center py-5 sm:py-3 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">Notification</h2>
        </div>
        <div class="overflow-x-auto">
            <p>The provided name already has an existing Customer with exact same name.</p>
            <p>Please ensure the current customer has different details than the following:</p>
            <p>Customer Name: <span id="nameSpan"></span></p>
            <p>Telephone: <span id="phoneSpan"></span></p>
            <p>Address: <span id="addressSpan"></span></p>
            <p>City: <span id="citySpan"></span></p>
            <p>Postal Code: <span id="postalSpan"></span></p>
        </div>
        <input type="hidden" id="cancel_payment_id"/>
        <input type="hidden" id="cancel_payment_amount"/>
        <div class=" py-3 text-right border-t border-gray-200">
            <button type="button" data-dismiss="modal" class="button w-100 bg-theme-1 text-white" id="OkayBtn">Continue create different
                Customer
            </button>
            <a href="<?php echo base_url().'Customer/customers_list';?>" class="button w-20 bg-theme-6 text-white">Cancel
                creation, Customer exists
            </a>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#copy_from_customer').click(function () {
        $('input[name="contact_person"]').val($('input[name="customer"]').val());
    });
    $('#check_customer').click(function () {
        if($('#customer').val() == '')
            return;
        $.ajax('check_customer', {
            type: 'GET',  // http method
            data: {
                customer: $('#customer').val(),
            },  // data to submit
            dataType: 'json',
            success: function (data, status, xhr) {
                if(data != null){
                    $('#confirm-modal').find('#nameSpan').html(data.customer);
                    $('#confirm-modal').find('#phoneSpan').html(data.phone1);
                    $('#confirm-modal').find('#addressSpan').html(data.address);
                    $('#confirm-modal').find('#citySpan').html(data.city);
                    $('#confirm-modal').find('#postalSpan').html(data.postal_code);
                    $('#confirm-modal').modal('show');
                }else{
                    showNotification('Customer is not found in the system');
                }
            },
            error: function (jqXhr, textStatus, errorMessage) {
                console.log(errorMessage);
            }
        });
    })
    function submitForm() {
        // event.preventDefault();
    }
</script>
<!-- END: Content -->



                