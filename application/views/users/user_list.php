<style>
    #user_table_body tr td:nth-child(8) {
        color: orange;
    }

    #user_table_body tr td:nth-child(9), #user_table_body tr td:last-child {
        color: red;
    }


    div#table_main_div {
        overflow: auto;
    }


</style>
<!-- BEGIN: Content -->
<div class="content">
    <!-- BEGIN: Top Bar -->
    <div class="top-bar">
        <!-- BEGIN: Breadcrumb -->
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex"><a href="" class="">Urbanfence</a> <i
                    data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Users
                List</a></div>
        <!-- END: Breadcrumb -->
        <!-- BEGIN: Account Menu -->
        <?php include(APPPATH . "views/inc/account_menu.php") ?>
        <!-- END: Account Menu -->
    </div>


    <!-- BEGIN: Datatable -->
    <div class="intro-y box p-5 mt-5" id="table_main_div">
        <table class="display" style="margin-bottom: 1%;text-align: center;" id="userTable">
            <thead>
            <tr>
                <th class="border-b-2">User-ID</th>
                <th class="border-b-2 text-center">Username</th>
                <th class="border-b-2 text-center">Password</th>
                <th class="border-b-2 text-center">Name</th>
                <th class="border-b-2 text-center">Access Level</th>
                <th class="border-b-2 text-center">Status</th>
                <th class="border-b-2 text-center">Edit</th>
                <th class="border-b-2 text-center">Reset Password</th>
                <th class="border-b-2 text-center">Disable user</th>
                <th class="border-b-2 text-center">Delete</th>
            </tr>
            </thead>

        </table>
        <div class="text-right sm:p-1 md:p-2 lg:p-4">
            <a href="<?php echo base_url(); ?>Users/add_user">
                <span>Add User</span>
                <i style="font-size: 40px;" class="fa fa-user-plus" aria-hidden="true"></i>
            </a>
        </div>
    </div>
    <!-- END: Datatable -->

</div>
<div class="modal" id="reset-modal">
    <div class="modal__content modal__content--lg p-5 text-center">
        <div class="flex items-center py-5 sm:py-3 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">Password Reset</h2>
        </div>
        <div class="overflow-x-auto">
            <label>New Password : </label>
            <input type="password" id="reset_password" class="input w-250 border mt-5 mb-3 flex-1"/>
        </div>
        <input type="hidden" id="reset_user_id"/>
        <div class=" py-3 text-right border-t border-gray-200">
            <button type="button" class="button w-100 bg-theme-1 text-white" id="passwordResetBtn">Reset
            </button>
        </div>
    </div>
</div>
<div class="modal" id="delete-modal">
    <div class="modal__content modal__content--lg p-5 text-center">
        <div class="flex items-center py-5 sm:py-3 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">Notification</h2>
        </div>
        <div class="overflow-x-auto">
            <p>Are you sure you want to delete all user details?</p>
        </div>
        <input type="hidden" id="delete_user_id"/>
        <div class=" py-3 text-right border-t border-gray-200">
            <button type="button" class="button w-20 bg-theme-6 text-white" id="deleteUserBtn">Yes
            </button>
            <button data-dismiss="modal" type="button" class="button w-20 bg-theme-6 text-white" id="CancelBtn">Cancel
            </button>
        </div>
    </div>
</div>
<!-- END: Content -->
<script type="text/javascript">
    var table;
    $(document).ready(function () {
        table = $('#userTable').DataTable({
            "pageLength": 50,
            "searching": false,
            "ajax": {
                url: '<?php echo base_url("Users/get_userlist");?>',
            },
            "columns": [
                {"data": "id"},
                {"data": "username", "width": "15%"},
                {
                    "data": null, render: function (data) {
                        return '******';
                    }, "width": "17%"
                },
                {"data": "name", "width": "15%"},
                {"data": "access_level", "width": "18%"},
                {"data": "status"},
                {
                    "data": null, render: function (data) {
                        return '<a href="add_user?user_id=' + data.id + '">' +
                            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"\n' +
                            '                             stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"\n' +
                            '                             class="feather feather-edit mx-auto">\n' +
                            '                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>\n' +
                            '                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>\n' +
                            '                            </svg>' +
                            '</a>';
                    }
                },
                {
                    "data": null, render: function (data) {
                        return '<a href="javascript:reset_password(' + data.id + ')"><i style="font-size: 24px;color:#ffb204;" class="fa fa-exclamation-triangle"aria-hidden="true"></i></a>'
                    }
                },
                {
                    "data": null, render: function (data) {
                        return '<a href="javascript:disable_status(' + data.id + ')"><i style="font-size: 24px;color:gray;" class="fa fa-ban" aria-hidden="true"></i></a>';
                    }
                },
                {
                    "data": null, render: function (data) {
                        return '<a href="javascript:delete_user(' + data.id + ')"><i style="font-size: 24px;color:red;" class="fa fa-trash" aria-hidden="true"></i></a>';
                    }
                }
            ],
            "order": [[0, 'asc']]
        });
        $('#passwordResetBtn').click(function () {
            if ($('#reset_password').val() == '') {
                showNotification('Please input new password for reset.')
                return;
            }
            $.ajax('reset_password', {
                type: 'POST',  // http method
                data: {
                    user_id: $('#reset_user_id').val(), new_password: $('#reset_password').val()
                },  // data to submit
                success: function (data, status, xhr) {
                    $('#reset-modal').modal('hide');
                    table.ajax.reload(null, false);
                },
                error: function (jqXhr, textStatus, errorMessage) {
                    console.log(errorMessage);
                }
            });
        });
        $('#deleteUserBtn').click(function () {
            $.ajax('delete_user', {
                type: 'POST',  // http method
                data: {
                    user_id: $('#delete_user_id').val()
                },  // data to submit
                success: function (data, status, xhr) {
                    $('#delete-modal').modal('hide');
                    table.ajax.reload(null, false);
                },
                error: function (jqXhr, textStatus, errorMessage) {
                    console.log(errorMessage);
                }
            });
        });
    })

    function reset_password(user_id) {
        $('#reset_password').val('');
        $('#reset_user_id').val(user_id);
        $('#reset-modal').modal('show');
    }

    function disable_status(user_id) {
        $.ajax('disable_user', {
            type: 'POST',  // http method
            data: {
                user_id: user_id
            },  // data to submit
            success: function (data, status, xhr) {
                table.ajax.reload(null, false);
            },
            error: function (jqXhr, textStatus, errorMessage) {
                console.log(errorMessage);
            }
        });
    }

    function delete_user(user_id) {
        $('#delete_user_id').val(user_id);
        $('#delete-modal').modal('show');
    }
</script>