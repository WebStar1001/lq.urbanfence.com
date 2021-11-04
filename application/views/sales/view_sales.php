<style type="text/css">

    #jobTable_paginate {
        margin-bottom: 1%;
    }

    div#jobTable_wrapper {
        overflow: auto;
    }

    @media screen and (max-width: 859px) {
        button.width_filter {
            width: 4rem;
        }
    }

    @media screen and (max-width: 767px) {
        button.width_filter {
            width: 6rem;
        }
    }
    table.dataTable thead th, table.dataTable thead td {
        padding: 0 0 !important;
    }
</style>
<!-- BEGIN: Content -->
<div class="content">
    <!-- BEGIN: Top Bar -->
    <div class="top-bar">
        <!-- BEGIN: Breadcrumb -->
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex"><a href="" class="">Urbanfence</a> <i
                    data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Jobs
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
            <div class="col-span-12 sm:col-span-6 md:col-span-4">
                <div><label>Sale Source</label>
                    <div class="mt-1">
                        <select class="input border w-full" id="sale_source">
                            <option value="0">All</option>
                            <option value="Returned Customer">Returned Customer</option>
                            <option value="Yellow Pages">Yellow Pages</option>
                            <option value="Facebook">Facebook</option>
                            <option value="Google Ad">Google Ad</option>
                            <option value="Friend's Referral">Friend's Referral</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="ml-sm-3 col-span-12 sm:col-span-6 md:col-span-4">
                <div class=""><label>Customer</label>
                    <div class="mt-1"><input type="text" placeholder="Search" class="input pl-12 border w-full"
                                             id="customer">
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 md:col-span-4">
                <div><label>Oppor. Per Month</label>
                    <div class="mt-1">
                        <select class="select2 w-full" id="job_per_month">
                            <option value="0">All</option>
                            <?php
                            $months = array(1 => 'Jan.', 2 => 'Feb.', 3 => 'Mar.', 4 => 'Apr.', 5 => 'May', 6 => 'Jun.', 7 => 'Jul.',
                                8 => 'Aug.', 9 => 'Sep.', 10 => 'Oct.', 11 => 'Nov.', 12 => 'Dec');
                            foreach ($months as $key => $value) {
                                echo '<option value="' . $key . '">' . $value . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 md:col-span-4">
                <div><label>Job Total > </label>
                    <div class="mt-1">
                        <input type="number" placeholder="Search" class="input pl-12 border w-full"
                               id="job_balance">
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 md:col-span-4">
                <div><label>Profit > </label>
                    <div class="mt-1">
                        <input type="number" placeholder="Search" class="input pl-12 border w-full"
                               id="profit">
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 md:col-span-4">
                <div><label>Jobs per Date</label>
                    <div class="mt-1">
                        <input data-daterange="true" class="input pl-12 border w-full" id="start_date">
                    </div>
                </div>
            </div>
            <div class="ml-sm-3 col-span-12 sm:col-span-6 md:col-span-4">
                <div class=""><label>Sales Rep</label>
                    <div class="mt-1">
                        <select class="select2 w-full" id="sale_rep">
                            <option value="0">All</option>
                            <?php
                            foreach ($sales as $user) {
                                echo '<option value="' . $user->id . '">' . $user->name . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 md:col-span-4">
                <div><label>Installer</label>
                    <div class="mt-1">
                        <select class="select2 w-full" id="installer">
                            <option value="0">All</option>
                            <?php
                            foreach ($installers as $installer) {
                                echo '<option value="' . $installer->id . '">' . $installer->name . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 md:col-span-4">
                <div><label>Site City</label>
                    <div class="mt-1">
                        <input type="text" placeholder="Search" class="input pl-12 border w-full"
                               id="site_city">
                    </div>
                </div>
            </div>
            <div class="ml-sm-3 col-span-12 sm:col-span-6 md:col-span-4">
                <div class=""><label>Job Type</label>
                    <div class="mt-1">
                        <select class="input border w-full" id="job_type">
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
            <div class="col-span-12 sm:col-span-6 md:col-span-4 flex items-end">
                <div>
                    <button class="button w-24 mr-1  bg-theme-1 text-white" id="clearFilter">Clear filter</button>
                    <button class="button w-24 mr-1 width_filter bg-theme-6 text-white" id="applyFilter">filter
                    </button>
                </div>
            </div>
        </div>
    </form>
    <!-- END: Filters -->

    <!-- BEGIN: Datatable -->
    <div class="intro-y box p-5 mt-5" id="table_main_div">
        <table id="jobTable" class="display" style="width:100%;text-align: center;">
            <thead>
            <tr>
                <th>Additional Info</th>
                <th>Company</th>
                <th>Job Id</th>
                <th>Date</th>
                <th>Customer</th>
                <th>Sales Source</th>
                <th>Job Balance</th>
                <th>Job Total</th>
                <th>Profit</th>
            </tr>
            </thead>
        </table>

    </div>
    <!-- END: Datatable -->
</div>
<!-- END: Content -->

<!-- END: Content -->
<script type="text/javascript">
    function format(d) {
        /*console.log(d.JobCity);*/
        // `d` is the original data object for the row
        return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px; text-align:left;width: 100%;">' +
            '<tr>' +
            '<td style="font-weight: bold;width: 11%">Status:</td>' +
            '<td style="width: 19%">' + d.status + '</td>' +
            '<td style="font-weight: bold;width: 11%">Site City:</td>' +
            '<td style="width: 25%">' + d.site_city + '</td>' +
            '<td style="font-weight: bold;width: 11%">Job Type:</td>' +
            '<td style="width: 10%">' + d.job_type + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="font-weight: bold;">Sales Rep:</td>' +
            '<td>' + d.sale_rep + '</td>' +
            '<td style="font-weight: bold;">Installer:</td>' +
            '<td>' + d.installer + '</td>' +
            '<td style="font-weight: bold;">Oppor ID:</td>' +
            '<td>' + d.quote_id + '</td>' +
            '</tr>' +
            '</table>';
    }

    $(document).ready(function () {
        $('#start_date').daterangepicker({
            "showDropdowns": true,
            "minYear": 2010,
            "singleDatePicker": true,
            // "linkedCalendars": false
        });
        $('#start_date').val('');
        $.fn.dataTable.ext.errMode = 'throw';
        var table = $('#jobTable').DataTable({
            "pageLength": 50,
            "searching": false,
            "ajax": {
                url: '<?php echo base_url("Sales/get_sales");?>',
                type: 'GET',
                data: function (data) {
                    data.company_id = $('#company_id').val();
                    data.sale_source = $('#sale_source').val();
                    data.customer = $('#customer').val();
                    data.job_per_month = $('#job_per_month').val();
                    data.installer = $('#installer').val();
                    data.job_balance = $('#job_balance').val();
                    data.profit = $('#profit').val();
                    data.start_date = $('#start_date').val();
                    data.sale_rep = $('#sale_rep').val();
                    data.site_city = $('#site_city').val();
                    data.job_type = $('#job_type').val();
                }
            },
            "columns": [
                {
                    "className": 'details-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": ''
                },
                {"data": "company"},
                {"data": "id"},
                {"data": "start_date"},
                {"data": "customer"},
                {"data": "sale_source"},
                {"data": "job_balance"},
                {"data": "job_total"},
                {"data": "profit"},
            ],
            "order":
                [[0, 'asc']]
        });

        // Add event listener for opening and closing details
        $('#jobTable tbody').on('click', 'td.details-control', function () {
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
            table.ajax.reload(null, false);
        });
        $('#clearFilter').click(function () {
            $('#job_per_month').val(0).trigger('change');
            $('#installer').val(0).trigger('change');
            $('#sale_rep').val(0).trigger('change');
            $('#filterForm').trigger('reset');
            table.ajax.reload(null, false);
        })
    })
    ;
</script>