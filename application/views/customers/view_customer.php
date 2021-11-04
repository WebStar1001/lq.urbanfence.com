<style type="text/css">

    div#customerTable_paginate {
        margin-bottom: 1%;
    }

    table#customerTable {
        margin-bottom: 1%;
    }

    @media screen and (max-width: 1170px) {
        div#customerTable_wrapper {
            overflow: auto;
        }
    }

    @media screen and (max-width: 850px) {
        button.width_filter {
            width: 4rem;
        }
    }

    @media screen and (max-width: 767px) {
        button.width_filter {
            width: 6rem;
        }
    }

</style>
<!-- BEGIN: Content -->
<div class="content">
    <!-- BEGIN: Top Bar -->
    <div class="top-bar">
        <!-- BEGIN: Breadcrumb -->
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex"><a href="" class="">Urbanfence</a> <i
                    data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Customers
                List</a></div>
        <!-- END: Breadcrumb -->
        <!-- BEGIN: Account Menu -->
        <?php include(APPPATH . "views/inc/account_menu.php") ?>
        <!-- END: Account Menu -->
    </div>
    <!-- BEGIN: Filters -->
    <form id="filterForm">
        <div class="intro-y grid grid-cols-12 p-5 mt-5 gap-2 box">
            <h2 class="col-span-12 font-medium text-base  border-b border-gray-200">Filters</h2>
            <div class="col-span-12 sm:col-span-6 md:col-span-4">
                <div>
                    <label>Customer</label>
                    <div class="mt-1">
                        <input type="text" placeholder="Search" class="input pl-12 border w-full" id="customer">
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 md:col-span-4">
                <div><label>Status</label>
                    <div class="mt-1">
                        <select class="input border w-full" id="status">
                            <option value="0">All</option>
                            <option value="Lead">Lead</option>
                            <option value="Customer">Customer</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="ml-sm-3 col-span-12 sm:col-span-6 md:col-span-4">
                <div class=""><label>Customer ID</label>
                    <div class="mt-1"><input type="text" placeholder="Search" class="input pl-12 border w-full"
                                             id="customer_id">
                    </div>
                </div>
            </div>
            <div class="ml-sm-3 col-span-12 sm:col-span-6 md:col-span-4">
                <div class=""><label>Contact Person</label>
                    <div class="mt-1"><input type="text" placeholder="Search" class="input pl-12 border w-full"
                                             id="contact_person">
                    </div>
                </div>
            </div>
            <div class="ml-sm-3 col-span-12 sm:col-span-6 md:col-span-4">
                <div class=""><label>City</label>
                    <div class="mt-1"><input type="text" placeholder="Search" class="input pl-12 border w-full"
                                             id="city">
                    </div>
                </div>
            </div>
            <div class="ml-sm-3 col-span-12 sm:col-span-6 md:col-span-4">
                <div class=""><label>Phone</label>
                    <div class="mt-1"><input type="text"  placeholder="123-456-7890" class="input pl-12 border w-full"
                                             id="phone">
                    </div>
                </div>
            </div>
            <div class="ml-sm-3 col-span-12 sm:col-span-6 md:col-span-4">
                <div class=""><label>Postal Code</label>
                    <div class="mt-1"><input type="text" placeholder="Search" class="input pl-12 border w-full"
                                             id="postal_code">
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 md:col-span-4">
                <div><label>Last Job Type</label>
                    <div class="mt-1">
                        <select id="last_job_type" class="input w-full border flex-1">
                            <option value="0">All</option>
                            <option value="Fence Repair">Fence Repair</option>
                            <option value="Gate Repair">Gate Repair</option>
                            <option value="Fence and Gate Repair">Fence and Gate Repair</option>
                            <option value="New Fence">New Fence</option>
                            <option value="New Gate">New Gate</option>
                            <option value="New Fence and Gate c/w Operator">New Fence and Gate c/w Operator</option>
                            <option value="Gate Operator Service">Gate Operator Service</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 md:col-span-4">
                <div><label>Last Sales Rep</label>
                    <div class="mt-1">
                        <select class="select2 w-full" id="last_sale_rep">
                            <option value="0">All</option>
                            <?php
                            foreach ($users as $user) {
                                echo '<option value="' . $user->id . '">' . $user->name . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 md:col-span-4">
                <div><label>Last Quote ID</label>
                    <div class="mt-1"><input type="text" placeholder="Search" class="input pl-12 border w-full" id="last_quote_id">
                    </div>
                </div>
            </div>
            <?php if (is_admin()): ?>
                <div class="col-span-12 sm:col-span-6 md:col-span-4">
                    <div><label>Quoting Company</label>
                        <div class="mt-1">
                            <select class="input border w-full" id="company_id">
                                <option value="0">All</option>
                                <?php
                                foreach ($companies as $company) {
                                    echo '<option value="' . $company->id . '">' . $company->name . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="col-span-12 sm:col-span-6 md:col-span-4 flex items-end">
                <div>
                    <button class="button w-24 mr-1  bg-theme-1 text-white" id="clearFilter">Clear filter</button>
                    <button class="button w-24 mr-1  bg-theme-6 text-white width_filter" id="applyFilter">filter
                    </button>
                </div>
            </div>
        </div>
    </form>
    <!-- END: Filters -->

    <!-- BEGIN: Datatable -->
    <div class="intro-y box p-5 mt-5" id="table_main_div">

        <table id="customerTable" class="display text-center" style="width:100%;">
            <thead>
            <tr>
                <th>Additional Info</th>
                <th>Id</th>
                <th>Status</th>
                <th>Customer</th>
                <th>Contact Person</th>
                <th>Phone1</th>
                <th>Email</th>
                <th>City</th>
                <!--                <th>Recent Sale Rep</th>-->
                <!--  <th>Recent Job Type</th> -->
                <th>Edit</th>
                <th>Create Oppor.</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
<!-- END: Content -->


<script type="text/javascript">
    function format(d) {
        var hide_filed = (is_admin) ? '' : 'display:none';
        /*console.log(d.JobCity);*/
        // `d` is the original data object for the row
        return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px; text-align:left;width: 100%;">' +
            '<tr>' +

            '<td style="width:14%;font-weight: bold;">Address:</td>' +
            '<td style="width:20%;">' + d.address + '</td>' +
            '<td style="width:12%;font-weight: bold;">Phone2:</td>' +
            '<td style="width:15%;">' + d.phone2 + '</td>' +
            '<td style="width:15%;font-weight: bold;">Last Oppor.ID:</td>' +
            '<td style="width:18%;">' + d.last_oppor_id + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="font-weight: bold;">Postal Code:</td>' +
            '<td>' + d.postal_code + '</td>' +
            '<td style="font-weight: bold;">Fax:</td>' +
            '<td>' + d.fax + '</td>' +
            '<td style="font-weight: bold;">Last Quote ID:</td>' +
            '<td>' + d.last_quote_id + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="font-weight: bold;">Recent Job Type:</td>' +
            '<td>' + d.last_job_type + '</td>' +
            '<td style="font-weight: bold;">Created By:</td>' +
            '<td style="">' + d.created_by + '</td>' +
            '<td style="font-weight: bold;' + hide_filed + ';">Quoting Company:</td>' +
            '<td style="' + hide_filed + '">' + d.company + '</td>' +
            '</tr>' +
            '</table>';
    }

    $(document).ready(function () {
        var table = $('#customerTable').DataTable({
            "pageLength": 50,
            "searching": false,
            "ajax": {
                url: '<?php echo base_url("Customer/get_customers");?>',
                type: 'GET',
                data: function (data) {
                    data.customer = $('#customer').val();
                    data.company_id = $('#company_id').val();
                    data.customer_id = $('#customer_id').val();
                    data.status = $('#status').val();
                    data.contact_person = $('#contact_person').val();
                    data.city = $('#city').val();
                    data.phone = $('#phone').val();
                    data.postal_code = $('#postal_code').val();
                    data.last_job_type = $('#last_job_type').val();
                    data.last_sale_rep = $('#last_sale_rep').val();
                    data.last_quote_id = $('#last_quote_id').val();
                },
                // type:'JSON'
            },
            "columnDefs": [
                {className: "whitespace-no-wrap", "targets": [5]}
            ],
            "columns": [
                {
                    "className": 'details-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": ''
                },
                {"data": "id"},
                {"data": "status"},
                {"data": "customer"},
                {"data": "contact_person"},
                {"data": "phone1"},
                {"data": "email"},
                {"data": "city"},

                {
                    "data": null, render: function (data) {
                        return "<a href='<?php echo base_url('Opportunity/add_customer?customer_id=');?>" + data.id + "'><i class='fa fa-pencil' aria-hidden='true'></i></a>"
                    }
                },

                {
                    "data": null, render: function (data) {
                        return "<a href='<?php echo base_url('Opportunity/add_opportunity?customer_id=');?>" + data.id + "'><i class='fa fa-external-link' aria-hidden='true'></i></a>"
                    }
                }
            ],
            "order": [[0, 'asc']]
        });

        // Add event listener for opening and closing details
        $('#customerTable tbody').on('click', 'td.details-control', function () {
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
        $('#filterForm').on('submit', function () {
            event.preventDefault();
        });
        $('#applyFilter').click(function () {
            if(isNaN($('#customer_id').val())){
                showNotification('Customer ID should be number');
                return;
            }
            table.ajax.reload(null, false);
        });
        $('#clearFilter').click(function () {
            $('#filterForm').trigger('reset');
            $('#last_sale_rep').val(0).trigger('change');
            table.ajax.reload(null, false);
        })
    });
</script>