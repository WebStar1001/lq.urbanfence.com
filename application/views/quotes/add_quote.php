<style>
    #right_info_part p {
        width: 150px;
    }

    table tbody {
        border: 1px solid lightgrey;
        overflow-y: scroll;
    }

    table th {
        background-color: #F1F5F8;
        text-align: center;
    }

    .table td {
        padding-top: 0px;
        padding-bottom: 0px;
    }

    table, tr, td {
        border: 1px solid lightgrey;
    }

    table td input {
        width: 100%;
        word-wrap: break-word
    }

    table#miscellaneous td:first-child input, table#adsOn td:first-child input {
        width: inherit;
    }

    table#miscellaneous td, table#adsOn td, table#pre_approved_quotes td, table#final_quote_table td {
        height: 42px;
    }

    table#final_quote_table td {
        text-align: center;
    }

    .table-report:not(.table-report--bordered) {
        border-spacing: 0px;
    }

    select:focus {
        outline: none !important;
    }

    input:focus, .input:focus {
        outline: none !important;
        border-color: #e2e8f0;
        box-shadow: 0 0 10px #e2e8f0;
    }

    #credit_check_body label {
        width: 120px;
    }

    .table-report__action div a:first-child {
        color: white;
        border-radius: 25px;
        padding-left: 7px;
        padding-right: 7px;
        border: 1px solid lightgrey;
        font-weight: bold;
        background-color: grey;
    }

    section#view_quote_section {
    }

    section div#view_quote_section label {
        display: grid;
    }

    section div#view_quote_section {
        min-height: 250px;
    }

    section #cal_quotes_section input {
        width: 8rem;
    }

    .hide_label {
        color: white;
        cursor: unset;
        border-color: white;
        cursor: default;
        pointer-events: none;
    }

    .tab {
        display: none;
    }

    .step {
        cursor: default;
        pointer-events: none;
        color: #718096;
        background-color: #edf2f7;
    }

    .step.active {
        color: white;
        background-color: #1C3FAA;
    }

    /* Mark the steps that are finished and valid: */
    .step.finish {
        background-color: #1C3FAA;
    }

    fieldset {
        border: 1px solid gray;
        margin: 0 auto;
    }

    tbody tr {
        height: 45px;
    }

    #small_quote_table tbody tr {
        height: 30px;
    }

    tbody tr select {
        height: auto;;
    }

    div#examples_wrapper {
        overflow: auto;
    }

    #section_step {
        width: 100%;
    }

    div#steps_line {
        width: 63%;
    }

    @media screen and (max-width: 1315px) {

    }

    @media screen and (max-width: 1024px) {

    }

    @media screen and (max-width: 769px) {
        #right_info_part {
            padding: 0px;
        }

    }

    @media screen and (min-width: 400px) {
        .sm\:px-20 {
            padding-left: 2rem;
            padding-right: 2rem;
        }
    }

    #materials td {
        padding-left: 0px !important;
        padding-right: 0px !important;
    }

    #materials th {
        padding-left: 0px !important;
        padding-right: 0px !important;
    }

    input:invalid {
        box-shadow: none;
    }

    /*.input-total-markup,.input-multiple-markup{
      display: none;
    }*/
</style>
<?php
//$hide_price = false;
$hide_price = false;
if (is_sale()) {
}
?>
<script>
    var catalogs =<?php echo json_encode($catalogs); ?>;
    var categories =<?php echo json_encode($categories); ?>;
    var status = '<?php echo (is_object($quote)) ? $quote->status : 'New';?>';
    var hide_price = <?php echo ($hide_price) ? 1 : 0;?>;
</script>
<div class="content">
    <!-- BEGIN: Top Bar -->
    <div class="top-bar">
        <!-- BEGIN: Breadcrumb -->
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex"><a href="" class="">Urbanfence</a> <i
                    data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Add
                Quote</a></div>
        <!-- END: Breadcrumb -->
        <!-- BEGIN: Account Menu -->
        <?php include(APPPATH . "views/inc/account_menu.php") ?>
        <!-- END: Account Menu -->
    </div>
    <!-- END: Top Bar -->

    <!-- BEGIN: Wizard Layout -->
    <div class="intro-y box">

        <form id="quoteForm" method="post" action="save_quote">
            <!-- qoute info start-->
            <div class="intro-y grid grid-cols-12 sm:grid-cols-8 p-5 gap-2">
                <div class="col-span-4" style="margin-right: 5%;">
                    <fieldset class=" p-2 sm:p-3  fieldset_bd_color">
                        <legend class="legend_spacing">Quote
                            #<?php echo (is_object($quote)) ? $quote->id : ''; ?></legend>
                        <p><b>
                                Customer
                                Name: <?php echo (is_object($opportunity)) ? $opportunity->customer_name : ''; ?>
                                <br>
                                Quote Type: <?php echo (is_object($opportunity)) ? $opportunity->job_type : ''; ?>
                                <br>
                                Address: <?php echo (is_object($opportunity)) ? $opportunity->site_address : ''; ?>
                                <br>
                                Payment Terms are: <span id="payment_terms_span"></span>
                            </b></p>
                    </fieldset>
                </div>
                <div class="col-span-12 sm:col-span-6 md:col-span-4 sm:pl-3 ml-5 lg:m-auto" id="right_info_part">
                    <div class="w-full sm:w-full m-auto" style="display:flex;">
                        <p classs="">Set Calc Mode</p>
                        <select class="input border mr-2" name="calc_mode" id="calc_mode">
                            <?php
                            $calc_mode = array('Contractor', 'Tender');
                            foreach ($calc_mode as $key => $val) {
                                if (is_object($quote)) {
                                    if ($quote->calc_mode == $val) {
                                        echo '<option value="' . $val . '" selected>' . $val . '</option>';
                                    } else {
                                        echo '<option value="' . $val . '">' . $val . '</option>';
                                    }
                                } else {
                                    echo '<option value="' . $val . '">' . $val . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="w-full sm:w-full m-auto mb-2" style="display:flex;">
                        <label class="w-full width6 md:mr-5 pt-1 sm:pt-3">Set Payment Terms * </label>
                    </div>
                    <div class="w-full sm:w-full m-auto mb-2" style="display:flex;">
                        <select class="input border mr-2 w-full" name="payment_term" required>
                            <?php
                            $payment_terms = array('C.O.D', 'Net 30 Days', 'Net 45 Days', 'Net 60 Days', 'Master-Card', 'AMEX'
                            , '30% Deposit - 70% Due 30 days from job Completion', '50% Deposit - 50% Due 30 days from job Completion',
                                '50% Deposit - 50% Due at job Completion');
                            foreach ($payment_terms as $val) {
                                if (is_object($quote)) {
                                    if ($quote->payment_term == $val) {
                                        echo '<option value="' . $val . '" selected>' . $val . '</option>';
                                    } else {
                                        echo '<option value="' . $val . '">' . $val . '</option>';
                                    }
                                } else {
                                    echo '<option value="' . $val . '">' . $val . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <!--quote info close-->

            <!--table section start-->
            <fieldset class="p-1 w-full fieldset_bd_color">
                <legend class="quote_legend_spacing">Materials</legend>
                <div class="grid grid-cols-12 gap-6 mt-5">

                    <!-- BEGIN: materials -->
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">


                        <table class="table table-report -mt-2 mb-5" id="materials">
                            <thead>
                            <tr id="material_thead">
                                <th class="whitespace-no-wrap">Category</th>
                                <th class="whitespace-no-wrap">Sub Category</th>
                                <th class="whitespace-no-wrap">Code</th>
                                <th class="text-center" style="max-width: 60px;">
                                    Price per unit
                                </th>
                                <th class="text-center" style="max-width: 60px;">Quantity</th>
                                <th class="text-center" style="max-width: 70px;">
                                    Total price
                                </th>
                                <th class="text-center">ACTIONS</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr id="material-item-row0" row="0" class="intro-x material-item">
                                <td <?php echo ($hide_price) ? 'colspan="3"' : 'colspan="6"' ?>></td>
                                <td class="table-report__action" style="max-width: 40px;">
                                    <div class="flex justify-center items-center">
                                        <a class="flex items-center add_detail_row" onclick="add_material_item()"
                                           href="javascript:;">+</a>

                                    </div>
                                </td>
                            </tr>
                            <?php
                            $mat_total_quantity = 0;
                            $mat_total_price = 0;
                            if (is_object($quote)):
                                if (sizeof($mat_info) > 0):
                                    for ($i = 0;
                                         $i < sizeof($mat_info);
                                         $i++):
                                        $nextRow = $i + 1;
                                        $mat_total_quantity += $mat_info[$i]->quantity;
                                        ?>
                                        <tr id="material-item-row<?php echo $nextRow; ?>" row="<?php echo $nextRow; ?>"
                                            class="intro-x material-item">
                                            <td style="width: 100px;">
                                                <select class="input border" name="material_category[]"
                                                        onchange="get_mat_sub_category(<?php echo $nextRow; ?>)">
                                                    <option value=""></option>
                                                    <?php
                                                    foreach ($categories as $category) {
                                                        if ($category->product_category == $mat_info[$i]->mat_category) {
                                                            echo '<option selected>' . $category->product_category . '</option>';
                                                        } else {
                                                            echo '<option>' . $category->product_category . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </td>

                                            <td style="width: 100px;">
                                                <select class="input border" name="sub_categories[]"
                                                        onchange="get_cate_code(<?php echo $nextRow; ?>)">
                                                    <option></option>
                                                    <?php
                                                    $price_per_unit = 0;
                                                    foreach ($catalogs[$mat_info[$i]->mat_category] as $sub_category => $codes) {
                                                        if ($sub_category == $mat_info[$i]->sub_category) {
                                                            echo '<option value="' . $sub_category . '" selected>' . $sub_category . '</option>';
                                                        } else {
                                                            echo '<option value="' . $sub_category . '">' . $sub_category . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td style="width: 100px;">
                                                <select class="input border" name="material_code[]"
                                                        onchange="change_mat_code(<?php echo $nextRow; ?>)">
                                                    <option></option>
                                                    <?php
                                                    $price_per_unit = 0;
                                                    foreach ($catalogs[$mat_info[$i]->mat_category][$mat_info[$i]->sub_category] as $code => $values) {
                                                        if ($code == $mat_info[$i]->code) {
                                                            $price_per_unit = round($values['price_per_unit_contractor'] * 1.32, 2);
                                                            if ($quote->calc_mode == 'Tender') {
                                                                $price_per_unit = round($values['price_per_unit_tender'] * 1.32, 2);
                                                            }
                                                            echo '<option value="' . $code . '" selected>' . $values['mat_description'] . '</option>';
                                                        } else {
                                                            echo '<option value="' . $code . '">' . $values['mat_description'] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td class="text-center" <?php echo ($hide_price) ? 'style="display:none;"' : '' ?>>
                                                <?php echo $price_per_unit; ?></td>
                                            <td class="text-center" style="width: 8%;"><input type="number"
                                                                                              name="mat_quantity[]"
                                                                                              class="text-center"
                                                                                              onfocus="this.oldvalue = this.value;"
                                                                                              style="width: 100%;"
                                                                                              value="<?php echo $mat_info[$i]->quantity; ?>"
                                                                                              onchange="change_mat_quantity(<?php echo $nextRow; ?>);this.oldvalue = this.value;">
                                            </td>
                                            <td class="text-center" <?php echo ($hide_price) ? 'style="display:none;"' : '' ?>>
                                                <?php
                                                $mat_total_price += $mat_info[$i]->quantity * $price_per_unit;
                                                echo $price_per_unit * $mat_info[$i]->quantity;
                                                ?>
                                            </td>
                                            <td class="table-report__action text-center">
                                                <a style="background-color:unset;border:unset;"
                                                   class="items-center delete_detail_row text-center"
                                                   onclick="delete_material_item(<?php echo $nextRow; ?>)"
                                                   href="javascript:;"><i style="font-size: 20px;
    color: red;" class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                    endfor;
                                endif;
                            endif;
                            ?>
                            <tr id="material-item-total" class="intro-x">
                                <td <?php echo ($hide_price) ? 'colspan="2"' : 'colspan="4"' ?>
                                        class="w-40 text-center">Total
                                </td>

                                <td class="text-center"><?php echo $mat_total_quantity; ?></td>
                                <td class="text-center"><?php echo $mat_total_price; ?></td>
                                <td class="table-report__action text-center">

                                    <i style="font-size: 20px;cursor: pointer;"
                                       onclick="toogle_material_item(this)"
                                       class="fa fa-angle-down toggle-action"></i>
                                </td>
                            </tr>


                            </tbody>
                        </table>

                    </div>
                    <!-- END: materials -->
                </div>
            </fieldset>


            <fieldset class="p-1 mt-2 w-full fieldset_bd_color">
                <legend class="quote_legend_spacing">Labor</legend>
                <div class="grid grid-cols-12 gap-6 mt-5">

                    <!-- BEGIN: labour -->
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                        <table class="table table-report -mt-2 mb-5" id="labour">
                            <thead>
                            <tr id="labour_thead">
                                <th class="whitespace-no-wrap">Labor desc</th>
                                <th class="whitespace-no-wrap"># of Man Day</th>
                                <th class="text-center whitespace-no-wrap" <?php echo ($hide_price) ? 'style="display:none;"' : '' ?>>
                                    Total price
                                </th>
                                <th class="text-center whitespace-no-wrap">ACTIONS</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr id="labour-item-row0" row="0" class="intro-x labour-item">
                                <td <?php echo ($hide_price) ? 'colspan="2"' : 'colspan="3"' ?> ></td>
                                <td class="table-report__action w-56">
                                    <div class="flex justify-center items-center add_detail_row">
                                        <a class="flex items-center mr-3" onclick="add_labour_item()"
                                           href="javascript:;">+</a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            $lab_total_days = 0;
                            $lab_total_prices = 0;
                            if (is_object($quote)):
                                if (sizeof($lab_info) > 0):
                                    for ($i = 0;
                                         $i < sizeof($lab_info);
                                         $i++):
                                        $nextRow = $i + 1;
                                        $lab_total_days += $lab_info[$i]->total_days;
                                        ?>
                                        <tr id="labour-item-row<?php echo $nextRow; ?>" row="<?php echo $nextRow; ?>"
                                            class="intro-x labour-item">
                                            <td class="w-40">
                                                <div class="flex">
                                                    <select class="input border mr-2" name="labor_type[]">
                                                        <option></option>
                                                        <option <?php echo ($lab_info[$i]->labour_type == 'Man Day with Digger') ? 'selected' : ''; ?>>
                                                            Man Day with Digger
                                                        </option>
                                                        <option <?php echo ($lab_info[$i]->labour_type == 'Man Day Set Posts') ? 'selected' : ''; ?>>
                                                            Man Day Set Posts
                                                        </option>
                                                        <option <?php echo ($lab_info[$i]->labour_type == 'Man Day Drive Posts') ? 'selected' : ''; ?>>
                                                            Man Day Drive Posts
                                                        </option>
                                                        <option <?php echo ($lab_info[$i]->labour_type == 'Man Day Clean Dirt') ? 'selected' : ''; ?>>
                                                            Man Day Clean Dirt
                                                        </option>
                                                        <option <?php echo ($lab_info[$i]->labour_type == 'Man Day Frame and Mesh') ? 'selected' : ''; ?>>
                                                            Man Day Frame and Mesh
                                                        </option>
                                                        <option <?php echo ($lab_info[$i]->labour_type == 'Man Day Frame') ? 'selected' : ''; ?>>
                                                            Man Day Frame
                                                        </option>
                                                        <option <?php echo ($lab_info[$i]->labour_type == 'Man Day Mesh') ? 'selected' : ''; ?>>
                                                            Man Day Mesh
                                                        </option>
                                                        <option <?php echo ($lab_info[$i]->labour_type == 'Man Day Tying Fence') ? 'selected' : ''; ?>>
                                                            Man Day Tying Fence
                                                        </option>
                                                        <option <?php echo ($lab_info[$i]->labour_type == 'Man Day Hang Gates') ? 'selected' : ''; ?>>
                                                            Man Day Hang Gates
                                                        </option>
                                                        <option <?php echo ($lab_info[$i]->labour_type == 'Man Day Removal') ? 'selected' : ''; ?>>
                                                            Man Day Removal
                                                        </option>
                                                        <option <?php echo ($lab_info[$i]->labour_type == 'Man Day Cut Brush') ? 'selected' : ''; ?>>
                                                            Man Day Cut Brush
                                                        </option>
                                                        <option <?php echo ($lab_info[$i]->labour_type == 'Man Day Travel') ? 'selected' : ''; ?>>
                                                            Man Day Travel
                                                        </option>
                                                        <option <?php echo ($lab_info[$i]->labour_type == 'Man Day Stretch Mesh') ? 'selected' : ''; ?>>
                                                            Man Day Stretch Mesh
                                                        </option>
                                                        <option <?php echo ($lab_info[$i]->labour_type == 'Man Day Welding') ? 'selected' : ''; ?>>
                                                            Man Day Welding
                                                        </option>
                                                        <option <?php echo ($lab_info[$i]->labour_type == 'Man Day Room And Board') ? 'selected' : ''; ?>>
                                                            Man Day Room And Board
                                                        </option>
                                                    </select>
                                                </div>
                                            </td>

                                            <td class="text-center">
                                                <input type="number" step="0.01" name="labor_total_days[]"
                                                       onfocus="this.oldvalue = this.value;"
                                                       value="<?php echo $lab_info[$i]->total_days; ?>"
                                                       onchange="set_labour_price(<?php echo $nextRow; ?>);this.oldvalue = this.value;">
                                            </td>
                                            <td <?php echo ($hide_price) ? 'style="display:none;"' : '' ?>>
                                                <?php
                                                if ($quote->calc_mode == 'Tender') {
                                                    $lab_total_prices += $lab_info[$i]->total_days * 1095.85;
                                                    echo $lab_info[$i]->total_days * 1095.85;
                                                } else {
                                                    $lab_total_prices += $lab_info[$i]->total_days * 1148.88;
                                                    echo $lab_info[$i]->total_days * 1148.88;
                                                }
                                                ?>
                                            </td>
                                            <td class="table-report__action w-56">
                                                <div class="flex justify-center items-center">

                                                    <a style="background-color:unset;border:unset"
                                                       class="flex items-center mr-3 delete_detail_row"
                                                       onclick="delete_labour_item(<?php echo $nextRow; ?>)"
                                                       href="javascript:;"><i style="font-size: 20px;
    color: red;" class="fa fa-trash" aria-hidden="true"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    endfor;
                                endif;
                            endif;
                            ?>
                            <tr id="labour-item-total" class="intro-x">
                                <td class="w-40 text-center">
                                    Total Man Day
                                </td>

                                <td><?php echo $lab_total_days; ?></td>
                                <td>
                                    <?php
                                    echo round($lab_total_prices, 2);
                                    ?>
                                </td>
                                <td class="table-report__action w-56">
                                    <div class="flex justify-center items-center">

                                        <i style="font-size: 20px;cursor: pointer;"
                                           onclick="toogle_labour_item(this)"
                                           class="fa fa-angle-down toggle-action"></i>
                                    </div>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <!-- END: labour -->
                </div>
            </fieldset>


            <fieldset class="p-1 mt-2 w-full fieldset_bd_color">
                <legend class="quote_legend_spacing">Miscellaneous</legend>
                <div class="grid grid-cols-12 gap-6 mt-5">

                    <!-- BEGIN: miscellaneous -->
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                        <table class="table table-report -mt-2 mb-5" id="miscellaneous">
                            <thead>
                            <tr id="miscellaneous_thead">
                                <th class="whitespace-no-wrap w-5">Misc #</th>
                                <th class="whitespace-no-wrap">Misc desc</th>
                                <th class="text-center whitespace-no-wrap w-10">Price per unit</th>
                                <th class="text-center whitespace-no-wrap w-10">Quantity</th>
                                <th class="text-center whitespace-no-wrap w-10">Total price</th>

                                <th class="text-center whitespace-no-wrap w-10">ACTIONS</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr id="miscellaneous-item-row0" row="0" class="intro-x miscellaneous-item">
                                <td colspan="5"></td>

                                <td class="table-report__action w-56">
                                    <div class="flex justify-center items-center add_detail_row">
                                        <a class="flex items-center mr-3" onclick="add_miscellaneous_item()"
                                           href="javascript:;">+</a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            $misc_total_quantity = 0;
                            $misc_total_price = 0;
                            if (is_object($quote)):
                                if (sizeof($misc_info) > 0):
                                    for ($i = 0;
                                         $i < sizeof($misc_info);
                                         $i++):
                                        $nextRow = $i + 1;
                                        $misc_total_quantity += $misc_info[$i]->quantity;
                                        $misc_total_price += $misc_info[$i]->quantity * $misc_info[$i]->price_per_unit;
                                        ?>
                                        <tr id="miscellaneous-item-row<?php echo $nextRow; ?>"
                                            row="<?php echo $nextRow; ?>" class="intro-x miscellaneous-item">
                                            <td class="text-center"><?php echo $nextRow; ?></td>
                                            <td class="text-center"><input type="text" name="misc_desc[]" placeholder=""
                                                                           value="<?php echo $misc_info[$i]->misc_description; ?>">
                                            </td>
                                            <td class="text-center"><input type="number" name="misc_unit_price[]"
                                                                           placeholder=""
                                                                           value="<?php echo $misc_info[$i]->price_per_unit; ?>"
                                                                           onchange="change_mis_unit(<?php echo $nextRow; ?>)">
                                            </td>
                                            <td class="text-center"><input type="number" name="misc_quantity[]"
                                                                           onfocus="this.oldvalue = this.value;"
                                                                           placeholder=""
                                                                           value="<?php echo $misc_info[$i]->quantity; ?>"
                                                                           onchange="change_mis_quantity(<?php echo $nextRow; ?>);this.oldvalue = this.value;">
                                            </td>
                                            <td class="text-center"><?php echo $misc_info[$i]->quantity * $misc_info[$i]->price_per_unit; ?></td>
                                            <td class="table-report__action">
                                                <div class="flex justify-center items-center">
                                                    <a style="background-color:unset;border:unset"
                                                       class="flex items-center mr-3 delete_detail_row"
                                                       onclick="delete_miscellaneous_item(<?php echo $nextRow; ?>)"
                                                       href="javascript:;"><i style="font-size: 20px;
    color: red;" class="fa fa-trash" aria-hidden="true"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    endfor;
                                endif;
                            endif;
                            ?>
                            <tr id="miscellaneous-item-total" class="intro-x">
                                <td colspan="3" class="w-40 text-center">Total Miscellaneous</td>
                                <td><?php echo $misc_total_quantity; ?></td>
                                <td><?php echo $misc_total_price; ?></td>
                                <td class="table-report__action w-56">
                                    <div class="flex justify-center items-center">
                                        <i style="font-size: 20px;cursor: pointer;"
                                           onclick="toogle_miscellaneous_item(this)"
                                           class="fa fa-angle-down toggle-action"></i>
                                    </div>
                                </td>
                            </tr>


                            </tbody>
                        </table>
                    </div>
                    <!-- END: miscellaneous -->
                </div>
            </fieldset>


            <fieldset class="p-1 mt-2 w-full fieldset_bd_color">
                <legend class="quote_legend_spacing">Add-On</legend>
                <div class="grid grid-cols-12 gap-6 mt-5">

                    <!-- BEGIN: Ads-On -->
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                        <table class="table table-report -mt-2" id="adsOn">
                            <thead>
                            <tr>
                                <th class="whitespace-no-wrap">Add-On desc</th>
                                <th class="text-center whitespace-no-wrap">Price per unit</th>
                                <th class="text-center whitespace-no-wrap">Quantity</th>
                                <th class="text-center whitespace-no-wrap">Total price</th>
                                <th class="text-center whitespace-no-wrap">ACTIONS</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr id="adsOn-item-row0" row="0" class="intro-x adsOn-item">
                                <td colspan="4"></td>
                                <td class="table-report__action w-56">
                                    <div class="flex justify-center items-center">
                                        <a class="flex items-center mr-3 add_detail_row" onclick="add_adsOn_item()"
                                           href="javascript:;">+</a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            $add_on_total_quantity = 0;
                            $add_on_total_price = 0;
                            if (is_object($quote)):
                                if (sizeof($add_on_info) > 0):
                                    for ($i = 0;
                                         $i < sizeof($add_on_info);
                                         $i++):
                                        $nextRow = $i + 1;
                                        $add_on_total_quantity += $add_on_info[$i]->quantity;
                                        $add_on_total_price += $add_on_info[$i]->quantity * $add_on_info[$i]->net_price_per_unit;
                                        ?>
                                        <tr id="adsOn-item-row<?php echo $nextRow; ?>" row="<?php echo $nextRow; ?>"
                                            class="intro-x adsOn-item">
                                            <td class="text-center"><input type="text" name="addon_desc[]"
                                                                           value="<?php echo $add_on_info[$i]->add_on_description; ?>">
                                            </td>
                                            <td class="text-center"><input type="number" name="addon_unit_price[]"
                                                                           value="<?php echo $add_on_info[$i]->net_price_per_unit; ?>"
                                                                           onchange="change_adsOn_unit(<?php echo $nextRow; ?>)">
                                            </td>
                                            <td class="text-center"><input type="number" name="addon_quantity[]"
                                                                           value="<?php echo $add_on_info[$i]->quantity; ?>"
                                                                           onfocus="this.oldvalue = this.value;"
                                                                           onchange="change_adsOn_quantity(<?php echo $nextRow; ?>);this.oldvalue = this.value;">
                                            </td>
                                            <td class="text-center"><?php echo $add_on_info[$i]->quantity * $add_on_info[$i]->net_price_per_unit; ?></td>
                                            <td class="table-report__action w-56">
                                                <div class="flex justify-center items-center">
                                                    <a style="background-color:unset;border:unset"
                                                       class="flex items-center mr-3 delete_detail_row"
                                                       onclick="delete_adsOn_item(<?php echo $nextRow; ?>)"
                                                       href="javascript:;"><i
                                                                style="font-size: 20px;
    color: red;" class="fa fa-trash" aria-hidden="true"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    endfor;
                                endif;
                            endif;
                            ?>
                            <tr id="adsOn-item-total" class="intro-x">
                                <td colspan="2" class="text-center">Total Add-Ons</td>

                                <td><?php echo $add_on_total_quantity; ?></td>
                                <td><?php echo $add_on_total_price; ?></td>
                                <td class="table-report__action w-56">
                                    <div class="flex justify-center items-center">

                                        <i style="font-size: 20px;cursor: pointer;"
                                           onclick="toogle_adsOn_item(this)"
                                           class="fa fa-angle-down toggle-action"></i>
                                    </div>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <!-- END: Ads-On -->
                </div>
            </fieldset>
            <?php if ((is_object($quote) && $quote->status == 'New') || !is_object($quote)): ?>
                <div class="grid grid-cols-12 gap-6 mt-5" id="final_quote_section">
                    <div class="intro-y col-span-12 lg:col-span-6">
                        <!-- BEGIN: Input -->
                        <div class="intro-y box">
                            <div class="p-5" id="input">
                                <div class="preview">
                                    <div class="overflow-x-auto">

                                        <table class="table" style="" id="final_quote_table">
                                            <thead>
                                            <tr class="bg-gray-200 text-gray-700">
                                                <th class="whitespace-no-wrap">Items</th>
                                                <th class="whitespace-no-wrap">Costs</th>
                                                <th class="whitespace-no-wrap">Selling Numbers</th>
                                                <th class="whitespace-no-wrap">Profit</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="border-b">Material</td>
                                                <td class="border-b"><a></a>
                                                </td>
                                                <td class="border-b"></td>
                                                <td class="border-b"></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b">Labour</td>
                                                <td class="border-b"><a></a>
                                                </td>
                                                <td class="border-b"></td>
                                                <td class="border-b"></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b">Misc</td>
                                                <td class="border-b"><a></a>
                                                <td class="border-b"></td>
                                                <td class="border-b"></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b">Add-On</td>
                                                <td class="border-b"></td>
                                                <td class="border-b"></td>
                                                <td class="border-b"></td>
                                            </tr>
                                            <tr class="sub-total1">
                                                <td class="border-b">Sub Total 1</td>
                                                <td class="border-b"></td>
                                                <td class="border-b"></td>
                                                <td class="border-b"></td>
                                            </tr>
                                            <tr class="discount-row">
                                                <td class="border-b">Discount</td>
                                                <td class="border-b"></td>
                                                <td class="border-b"></td>
                                                <td class="border-b"></td>
                                            </tr>
                                            <tr class="sub-total2">
                                                <td class="border-b">Sub Total 2</td>
                                                <td class="border-b"></td>
                                                <td class="border-b"></td>
                                                <td class="border-b"></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b">HST</td>
                                                <td class="border-b">13%</td>
                                                <td class="border-b"></td>
                                                <td class="border-b"></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b">Total</td>
                                                <td class="border-b"></td>
                                                <td class="border-b"></td>
                                                <td class="border-b"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                </div>
                                <div class="source-code hidden">
                                    <button data-target="#copy-input"
                                            class="copy-code button button--sm border flex items-center text-gray-700">
                                        <i
                                                data-feather="file" class="w-4 h-4 mr-2"></i> Copy code
                                    </button>

                                </div>
                            </div>
                        </div>
                        <!-- END: Input -->
                    </div>

                    <div class="intro-y col-span-12 lg:col-span-6">
                        <!-- BEGIN: Vertical Form -->
                        <div class="intro-y box">
                            <div class="p-5" id="vertical-form">
                                <div class="preview">
                                    <div class="overflow-x-auto">
                                        <div class="mt-1 mb-5" style="text-align-last: end">
                                            <label class="float-left" style="margin-right: 8px;">Set Markup
                                                rate</label>
                                            <?php
                                            $material_markup_percent = (is_object($quote) && $quote->mat_factor != 0) ? ($quote->mat_factor - 1) * 100 : '';
                                            $labor_markup_percent = (is_object($quote) && $quote->lab_factor != 0) ? ($quote->lab_factor - 1) * 100 : '';
                                            $misc_markup_percent = (is_object($quote) && $quote->misc_factor != 0) ? ($quote->misc_factor - 1) * 100 : '';
                                            $adson_markup_percent = (is_object($quote) && $quote->ads_on_factor != 0) ? ($quote->ads_on_factor - 1) * 100 : '';

                                            $total_amount = (is_object($quote)) ?
                                                (($quote->calc_mode == 'Contractor') ? $quote->mat_net * $quote->mat_factor + $quote->mat_net * 0.32 : $quote->mat_factor * $quote->mat_net)
                                                + $quote->labour_net * $quote->lab_factor
                                                + $quote->misc_net * $quote->misc_factor + $quote->ads_on_net * $quote->ads_on_factor : 0;

                                            $total_markup_amount = (is_object($quote)) ? $total_amount - $quote->mat_net - $quote->labour_net - $quote->misc_net - $quote->ads_on_net : 0;

                                            $is_total_markup = (is_object($quote)) ? $quote->mat_factor == $quote->lab_factor && $quote->mat_factor == $quote->misc_factor
                                                && $quote->mat_factor == $quote->ads_on_factor : !(is_object($quote)); ?>
                                            <input type="radio" class="input border mr-2 float-left set_markup"
                                                   id="horizontal-radio-chris-evans"
                                                   name="horizontal_radio_button" <?php echo ($is_total_markup) ? 'checked' : ''; ?>>
                                            <label class="cursor-pointer select-none float-left"
                                                   for="horizontal-radio-chris-evans">Total Markup</label>

                                            <input type="number"
                                                   class="input-total-markup input border"
                                                   placeholder="%" style="width:15%" name="total_markup_percent"
                                                <?php echo ($is_total_markup) ? 'value="' . (($material_markup_percent != '') ? $material_markup_percent : '10') . '"' : 'disabled'; ?>
                                                   id="total_markup_percent"/>
                                            <input type="number"
                                                   class="input-total-markup input border"
                                                   placeholder="Amount" style="width:20%" name="total_markup_amount"
                                                <?php echo ($is_total_markup) ? 'value="' . $total_markup_amount . '"' : 'disabled'; ?>
                                                   id="total_markup_amount"/>
                                        </div>


                                        <div class="mt-1 mb-5" style="display: inline-block;">
                                            <label class="float-left"
                                                   style="margin-right: 8px; visibility: hidden;">Set
                                                Markup rate</label>
                                            <input type="radio" class="input border mr-2 float-left set_markup"
                                                   id="horizontal-radio-chris-evans2"
                                                   name="horizontal_radio_button" <?php echo ($is_total_markup) ? '' : 'checked'; ?>>
                                            <label class="cursor-pointer select-none mr-2 float-left"
                                                   for="horizontal-radio-chris-evans2">Multiple Markups</label>
                                        </div>

                                        <div class="mt-1 mb-5 " style="text-align-last: end;">

                                            <label class="mr-5">Material Markup</label>
                                            <input placeholder="%" type="number"
                                                   class="input-multiple-markup input border single_markup"
                                                   style="width:15%" name="material_markup_percent"
                                                   id="material_markup_percent"
                                                <?php echo (!$is_total_markup) ? 'value="' . $material_markup_percent . '"' : 'disabled'; ?>/>
                                            <input placeholder="Amount" type="number"
                                                   class="input-multiple-markup input border single_markup"
                                                   style="width:20%" name="material_markup_amount"
                                                   id="material_markup_amount"
                                                <?php if ($is_total_markup) {
                                                    echo 'disabled';
                                                } elseif (is_object($quote)) {
                                                    echo 'value="' . round($material_markup_percent * $quote->mat_net / 100, 2) . '"';
                                                }
                                                ?>
                                            />
                                        </div>

                                        <div class="mt-1 mb-5 " style="text-align-last: end;">

                                            <label class="mr-5">Labor Markup</label>
                                            <input placeholder="%" type="number"
                                                   class="input-multiple-markup input border single_markup"
                                                   style="width:15%" name="labor_markup_percent"
                                                   id="labor_markup_percent"
                                                <?php echo (!$is_total_markup) ? 'value="' . $labor_markup_percent . '"' : 'disabled'; ?>>
                                            <input placeholder="Amount" type="number"
                                                   class="input-multiple-markup input border single_markup"
                                                   style="width:20%" name="labor_markup_amount"
                                                   id="labor_markup_amount"
                                                <?php if ($is_total_markup) {
                                                    echo 'disabled';
                                                } elseif (is_object($quote)) {
                                                    echo 'value="' . round($labor_markup_percent * $quote->labour_net / 100, 2) . '"';
                                                }
                                                ?>
                                            />
                                        </div>


                                        <div class="mt-1 mb-5" style="text-align-last: end;">
                                            <label class=" mr-5">Misc Markup</label>
                                            <input type="number" placeholder="%"
                                                   class="input-multiple-markup input border ml-1 single_markup"
                                                   style="width:15%" name="misc_markup_percent"
                                                   id="misc_markup_percent"
                                                <?php echo (!$is_total_markup) ? 'value="' . $misc_markup_percent . '"' : 'disabled'; ?>>
                                            <input placeholder="Amount" type="number"
                                                   class="input-multiple-markup input border single_markup"
                                                   style="width:20%" name="misc_markup_amount"
                                                   id="misc_markup_amount"
                                                <?php if ($is_total_markup) {
                                                    echo 'disabled';
                                                } elseif (is_object($quote)) {
                                                    echo 'value="' . round($misc_markup_percent * $quote->misc_net / 100, 2) . '"';
                                                }
                                                ?>
                                            />
                                        </div>


                                        <div class="mt-1 mb-5" style="text-align-last: end;">
                                            <label class=" mr-5">Add-On Markup</label>
                                            <input placeholder="%" type="number"
                                                   class="input-multiple-markup input border single_markup"
                                                   style="width:15%" name="adson_markup_percent"
                                                   id="adson_markup_percent"
                                                <?php echo (!$is_total_markup) ? 'value="' . $adson_markup_percent . '"' : 'disabled'; ?>>
                                            <input placeholder="Amount" type="number"
                                                   class="input-multiple-markup input border single_markup"
                                                   style="width:20%" name="adson_markup_amount"
                                                   id="adson_markup_amount"
                                                <?php if ($is_total_markup) {
                                                    echo 'disabled';
                                                } elseif (is_object($quote)) {
                                                    echo 'value="' . round($adson_markup_percent * $quote->ads_on_net / 100, 2) . '"';
                                                }
                                                ?>
                                            />
                                        </div>
                                        <div class="mt-10">
                                            <?php

                                            $discount_amount = (is_object($quote)) ? round($total_amount * $quote->discount_set / 100, 2) : '';
                                            $discount_percent = (is_object($quote)) ? $quote->discount_set : '';
                                            ?>
                                            <label class="mr-5">Add Discount</label>
                                            <input type="number"
                                                   class="add-discount input w-25 border col-span-4"
                                                   placeholder="%" style="width:15%" name="discount_percent"
                                                   value="<?php echo $discount_percent; ?>">
                                            <input placeholder="Amount" type="number"
                                                   class="add-discount input w-25 border col-span-4"
                                                   style="width:20%"
                                                   name="discount_amount"
                                                   value="<?php echo $discount_amount; ?>">

                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- END: Vertical Form -->
                    </div>
                </div>
            <?php
            endif;
            if ((is_object($quote) && $quote->status == 'Pending') || (is_object($quote) && $quote->status == 'Approved')):
                ?>
                <div class="grid grid-cols-12 gap-6 mt-5" id="final_quote_section">
                    <div class="intro-y col-span-12 lg:col-span-5">
                        <!-- BEGIN: Input -->
                        <div class="intro-y box">
                            <div class="p-5" id="input">
                                <div class="preview">
                                    <div class="overflow-x-auto">
                                        <?php
                                        $total_amount1 = (($quote->calc_mode == 'Contractor') ? $quote->mat_net * $quote->mat_factor + $quote->mat_net * 0.32 : $quote->mat_factor * $quote->mat_net)
                                            + $quote->labour_net * $quote->lab_factor
                                            + $quote->misc_net * $quote->misc_factor + $quote->ads_on_net * $quote->ads_on_factor;
                                        $discount_amount = round($total_amount1 * $quote->discount_set / 100, 2);
                                        $discount_percent = $quote->discount_set;
                                        $total_amount2 = $total_amount1 - $discount_amount;
                                        $total_amount = $total_amount2 + $total_amount2 * 0.13;
                                        ?>
                                        <table class="table" style="text-align: center;" id="small_quote_table">
                                            <thead>
                                            <tr class="bg-gray-200 text-gray-700">
                                                <th class="whitespace-no-wrap">Items</th>
                                                <th class="whitespace-no-wrap">Selling Numbers</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="border-b">Material</td>
                                                <td class="border-b">
                                                    <a><?php echo round(($quote->calc_mode == 'Contractor') ? $quote->mat_net + $quote->mat_net / 1.32 * ($quote->mat_factor - 1) : $quote->mat_factor * $quote->mat_net, 2) ?></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b">Labour</td>
                                                <td class="border-b">
                                                    <a><?php echo round($quote->labour_net * $quote->lab_factor, 2); ?></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b">Misc</td>
                                                <td class="border-b">
                                                    <a><?php echo round($quote->misc_net * $quote->misc_factor, 2); ?></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b">Add-On</td>
                                                <td class="border-b"><?php echo round($quote->ads_on_net * $quote->ads_on_factor, 2); ?></td>
                                            </tr>
                                            <tr class="sub-total1">
                                                <td class="border-b">Sub Total 1</td>
                                                <td class="border-b"><?php echo round($total_amount1, 2); ?></td>
                                            </tr>
                                            <tr class="discount-row">
                                                <td class="border-b">Discount (<span
                                                            id="discount_span"><?php echo ($quote->discount_set == 0) ? '' : $quote->discount_set; ?></span>%)
                                                </td>
                                                <td class="border-b"><?php echo $discount_amount ?></td>
                                            </tr>
                                            <tr class="sub-total2">
                                                <td class="border-b">Sub Total 2</td>
                                                <td class="border-b"><?php echo round($total_amount2, 2); ?></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b">HST</td>
                                                <td class="border-b">13%</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b">Total</td>
                                                <td class="border-b"><?php echo round($total_amount, 2); ?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                </div>

                            </div>
                        </div>
                        <?php if ($opportunity->job_type == 'New Fence' || $opportunity->job_type == 'New Fence and Gate c/w Operator') { ?>
                            <div class="intro-y box">
                                <div class="p-5" id="input">
                                    <div class="preview">
                                        <div>
                                            <div style="width: 40%;display: inline-block;">
                                                <a class="button bg-gray-200 text-gray-600 mr-5"
                                                   href="generate_ia?quote_id=<?php echo $quote->id; ?>" target="_blank"
                                                   style="float: inherit;">
                                                    Generate IA
                                                </a>
                                            </div>
                                            <div style="width: 50%;display: inline;">
                                                <input type="checkbox" class="input border  mr-2" id="ia_signed"
                                                       name="ia_signed"
                                                       value="1" <?php echo ($quote->ia_signed == 1) ? 'checked' : ''; ?>><label>IA
                                                    is
                                                    signed</label>
                                            </div>
                                        </div>
                                        <div class="mt-5">
                                            <div style="width: 40%;display: inline-block;">
                                                <button class="button bg-gray-200 text-gray-600" style="float: inherit;"
                                                        id="generate_qa_form_button" target="_blank"
                                                        onclick="generate_form();">
                                                    Generate Form
                                                </button>
                                            </div>
                                            <div style="width: 50%;display: inline;">
                                                <input type="checkbox" class="input border mr-2" id="form_signed"
                                                       name="form_signed"
                                                       value="1" <?php echo ($quote->form_signed == 1) ? 'checked' : ''; ?>><label>Quote
                                                    Form is
                                                    signed</label>
                                            </div>
                                        </div>
                                        <div>
                                            <div style="width: 40%;display: inline-block;visibility: hidden;">
                                                <a class="button bg-gray-200 text-gray-600" style="float: inherit;"
                                                   href="generate_qa_blank?quote_id=<?php echo $quote->id; ?>"
                                                   target="_blank">
                                                    Generate
                                                    Blank Form
                                                </a>
                                            </div>
                                            <div style="width: 50%;display: inline;">
                                                <input type="checkbox" class="input border" id="credit_passed"
                                                       name="credit_passed"
                                                       value="1" <?php echo ($quote->credit_passed == 1) ? 'checked' : ''; ?>>
                                                <label class="cursor-pointer select-none" for="credit_passed"
                                                       style="width: auto;">Customer passed Credit-Check</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        } ?>
                        <!-- END: Input -->
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-7">
                        <div class="intro-y col-span-12 ml-2" id="additional_info_div">
                            <fieldset class="p-1 mt-2 w-full fieldset_bd_color">
                                <legend class="quote_legend_spacing">Quote Notes</legend>
                                <?php if ($opportunity->job_type == 'New Fence' || $opportunity->job_type == 'New Fence and Gate c/w Operator') { ?>
                                    <div class="preview" style="padding: 1em;">
                                        <div class="intro-y flex flex-col sm:flex-row mt-1">
                                            <label class="md:mr-5 pt-1 sm:pt-3" style="width: 200px;">FENCE - Including
                                                Fabric,<br>
                                                Top Rail, Line Posts & Fittings:</label>
                                            <input type="text" id="additional_col_1" name="additional_col_1"
                                                   class="input w-100 border mt-1" style="height: 30px;"
                                                   value="<?php echo $quote->additional_col_1; ?>" tabindex="1">
                                        </div>
                                        <div class="intro-y flex flex-col sm:flex-row mt-1">
                                            <label class="md:mr-5 pt-1 sm:pt-3" style="width: 200px;">END POSTS:</label>
                                            <input type="text" id="additional_col_2" name="additional_col_2"
                                                   class="input border mt-1" style="height: 30px;"
                                                   value="<?php echo $quote->additional_col_2; ?>" tabindex="2">
                                        </div>
                                        <div class="intro-y flex flex-col sm:flex-row mt-1">
                                            <label class="md:mr-5 pt-1 sm:pt-3" style="width: 200px;">GATE
                                                POSTS:</label>
                                            <input type="text" id="additional_col_3" name="additional_col_3"
                                                   class="input border mt-1" style="height: 30px;"
                                                   value="<?php echo $quote->additional_col_3; ?>" tabindex="3">
                                        </div>
                                        <div class="intro-y flex flex-col sm:flex-row mt-1">
                                            <label class="md:mr-5 pt-1 sm:pt-3" style="width: 200px;">CORNER
                                                POSTS:</label>
                                            <input type="text" id="additional_col_4" name="additional_col_4"
                                                   class="input border mt-1" style="height: 30px;"
                                                   value="<?php echo $quote->additional_col_4; ?>" tabindex="4">
                                        </div>
                                        <div class="intro-y flex flex-col sm:flex-row mt-1">
                                            <label class="md:mr-5 pt-1 sm:pt-3" style="width: 200px;">STRAINING
                                                POSTS: </label>
                                            <input type="text" id="additional_col_5" name="additional_col_5"
                                                   class="input border mt-1" style="height: 30px;"
                                                   value="<?php echo $quote->additional_col_5; ?>" tabindex="5">
                                        </div>
                                        <div class="intro-y flex flex-col sm:flex-row mt-1">
                                            <label class="md:mr-5 pt-1 sm:pt-3" style="width: 200px;">FITTINGS: </label>
                                            <input type="text" id="additional_col_6" name="additional_col_6"
                                                   class="input border mt-1" style="height: 30px;"
                                                   value="<?php echo $quote->additional_col_6; ?>" tabindex="6">
                                        </div>
                                        <div class="intro-y flex flex-col sm:flex-row mt-1">
                                            <label class="md:mr-5 pt-1 sm:pt-3" style="width: 200px;">GATES: </label>
                                            <input type="text" id="additional_col_7" name="additional_col_7"
                                                   class="input border mt-1" style="height: 30px;"
                                                   value="<?php echo $quote->additional_col_7; ?>" tabindex="7"/>
                                        </div>
                                        <div class="intro-y flex flex-col sm:flex-row mt-1">
                                            <p>* Erection of Fence & Gates: All line posts set
                                                <select name="additional_select_1" class="input border" tabindex="8">
                                                    <option <?php echo ($quote->additional_select_1 == 'IN CONCRETE') ? 'selected' : ''; ?>>
                                                        IN CONCRETE
                                                    </option>
                                                    <option <?php echo ($quote->additional_select_1 == 'ON FLANGES') ? 'selected' : ''; ?>>
                                                        ON FLANGES
                                                    </option>
                                                    <option <?php echo ($quote->additional_select_1 == 'COREDRILLED') ? 'selected' : ''; ?>>
                                                        COREDRILLED
                                                    </option>
                                                </select>
                                            </p>
                                        </div>
                                        <div class="intro-y flex flex-col sm:flex-row mt-1"
                                             id="additional_select_comment1">
                                            <?php if ($quote->additional_select_1 == '' || $quote->additional_select_1 == 'IN CONCRETE') { ?>
                                                <p>(In normal soil & on cleared line marked by customer with survey
                                                    bars)</p>
                                            <?php } elseif ($quote->additional_select_1 == 'ON FLANGES') { ?>
                                                <p>On normal concrete slab cleared of all obstacles 72" radius.</p>
                                            <?php } elseif ($quote->additional_select_1 == 'COREDRILLED') { ?>
                                                <p>(Radar Scan / X-Ray services and / or location of embedded objects
                                                    not included in this quotation.)</p>
                                            <?php } ?>
                                        </div>
                                        <div class="intro-y flex flex-col sm:flex-row mt-1">
                                            <p>* Terminal posts installed
                                                <select name="additional_select_2" class="input border" tabindex="9">
                                                    <option <?php echo ($quote->additional_select_2 == 'IN CONCRETE') ? 'selected' : ''; ?>>
                                                        IN CONCRETE
                                                    </option>
                                                    <option <?php echo ($quote->additional_select_2 == 'ON FLANGES') ? 'selected' : ''; ?>>
                                                        ON FLANGES
                                                    </option>
                                                    <option <?php echo ($quote->additional_select_2 == 'COREDRILLED') ? 'selected' : ''; ?>>
                                                        COREDRILLED
                                                    </option>
                                                </select></p>
                                        </div>
                                        <div class="intro-y flex flex-col sm:flex-row mt-1"
                                             id="additional_select_comment2">
                                            <?php if ($quote->additional_select_2 == '' || $quote->additional_select_2 == 'IN CONCRETE') { ?>
                                                <p>(In normal soil & on cleared line marked by customer with survey
                                                    bars)</p>
                                            <?php } elseif ($quote->additional_select_2 == 'ON FLANGES') { ?>
                                                <p>On normal concrete slab cleared of all obstacles 72" radius.</p>
                                            <?php } elseif ($quote->additional_select_2 == 'COREDRILLED') { ?>
                                                <p>(Radar Scan / X-Ray services and / or location of embedded objects
                                                    not included in this quotation.)</p>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php
                                } else { ?>
                                    <div class="intro-y flex flex-col sm:flex-row mt-1">
                                        <textarea id="additional_notes" name="additional_notes" style="width: 100%"
                                                  class="input w-100 border mt-1"
                                                  tabindex="1"><?php echo $quote->additional_notes; ?></textarea>
                                    </div>
                                    <?php
                                } ?>
                            </fieldset>
                        </div>
                        <?php if ($opportunity->job_type != 'New Fence' || $opportunity->job_type != 'New Fence and Gate c/w Operator') { ?>
                            <div class="intro-y col-span-12 ml-2" id="additional_info_div">
                                <fieldset class="p-1 mt-2 w-full fieldset_bd_color">
                                    <legend class="quote_legend_spacing">Office Notes</legend>
                                    <div class="intro-y flex flex-col sm:flex-row mt-1">
                                        <textarea id="additional_office_notes" name="additional_office_notes"
                                                  style="width: 100%;height: 30px;"
                                                  class="input w-100 border"
                                                  tabindex="1"><?php echo $quote->additional_office_notes; ?></textarea>
                                    </div>
                                </fieldset>
                            </div>
                        <?php }
                        if ($opportunity->job_type != 'New Fence' && $opportunity->job_type != 'New Fence and Gate c/w Operator') { ?>
                            <div class="intro-y box">
                                <div class="p-5" id="input">
                                    <div class="preview">
                                        <div>
                                            <div style="width: 40%;display: inline-block;">
                                                <a class="button bg-gray-200 text-gray-600 mr-5"
                                                   href="generate_ia?quote_id=<?php echo $quote->id; ?>" target="_blank"
                                                   style="float: inherit;">
                                                    Generate IA
                                                </a>
                                            </div>
                                            <div style="width: 50%;display: inline;">
                                                <input type="checkbox" class="input border  mr-2" id="ia_signed"
                                                       name="ia_signed"
                                                       value="1" <?php echo ($quote->ia_signed == 1) ? 'checked' : ''; ?>><label>IA
                                                    is
                                                    signed</label>
                                            </div>
                                        </div>
                                        <div class="mt-5">
                                            <div style="width: 40%;display: inline-block;">
                                                <button class="button bg-gray-200 text-gray-600" style="float: inherit;"
                                                        id="generate_qa_form_button" target="_blank"
                                                        onclick="generate_form();">
                                                    Generate Form
                                                </button>
                                            </div>
                                            <div style="width: 50%;display: inline;">
                                                <input type="checkbox" class="input border mr-2" id="form_signed"
                                                       name="form_signed"
                                                       value="1" <?php echo ($quote->form_signed == 1) ? 'checked' : ''; ?>><label>Quote
                                                    Form is
                                                    signed</label>
                                            </div>
                                        </div>
                                        <div class="mt-5">

                                            <div style="width: 40%;display: inline-block;visibility: hidden;">
                                                <a class="button bg-gray-200 text-gray-600" style="float: inherit;"
                                                   href="generate_qa_blank?quote_id=<?php echo $quote->id; ?>"
                                                   target="_blank">
                                                    Generate
                                                    Blank Form
                                                </a>
                                            </div>
                                            <div style="width: 50%;display: inline;">
                                                <input type="checkbox" class="input border" id="credit_passed"
                                                       name="credit_passed"
                                                       value="1" <?php echo ($quote->credit_passed == 1) ? 'checked' : ''; ?>>
                                                <label class="cursor-pointer select-none" for="credit_passed"
                                                       style="width: auto;">Customer passed Credit-Check</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        } ?>
                    </div>
                </div>

                <fieldset class="p-1 mt-2 w-full fieldset_bd_color intro-y installation_detail">
                    <legend class="quote_legend_spacing">Installation Details</legend>
                    <div class="grid grid-cols-12 mt-5">
                        <div class="col-span-4" style="padding: 1em;">
                            <h3><b>Specifications: </b></h3>
                            <div class="intro-y flex flex-col sm:flex-row mt-1">
                                <label class="md:mr-5 pt-1 sm:pt-3" style="width: 150px;">* Mesh:</label>
                                <input type="text" id="installation_detail_1" name="installation_detail_1"
                                       class="input w-50 border mt-1" style="width: 120px;height:30px;"
                                       value="<?php echo $quote->installation_detail_1; ?>" tabindex="10">
                            </div>
                            <div class="intro-y flex flex-col sm:flex-row mt-1">
                                <label class="md:mr-5 pt-1 sm:pt-3" style="width: 150px;">* Line Post:</label>
                                <input type="text" id="installation_detail_2" name="installation_detail_2"
                                       class="input border mt-1" style="width: 120px;height:30px;"
                                       value="<?php echo $quote->installation_detail_2; ?>" tabindex="12">
                            </div>
                            <div class="intro-y flex flex-col sm:flex-row mt-1">
                                <label class="md:mr-5 pt-1 sm:pt-3" style="width: 150px;">* Top Rail:</label>
                                <input type="text" id="installation_detail_3" name="installation_detail_3"
                                       class="input border mt-1" style="width: 120px;height:30px;"
                                       value="<?php echo $quote->installation_detail_3; ?>" tabindex="12">
                            </div>
                            <div class="intro-y flex flex-col sm:flex-row mt-1">
                                <label class="md:mr-5 pt-1 sm:pt-3" style="width: 150px;">* Main Post:</label>
                                <input type="text" id="installation_detail_4" name="installation_detail_4"
                                       class="input border mt-1" style="width: 120px;height:30px;"
                                       value="<?php echo $quote->installation_detail_4; ?>" tabindex="13">
                            </div>
                            <div class="intro-y flex flex-col sm:flex-row mt-1">
                                <label class="md:mr-5 pt-1 sm:pt-3" style="width: 150px;">* Holes Thru: </label>
                                <input type="text" id="installation_detail_5" name="installation_detail_5"
                                       class="input border mt-1" style="width: 120px;height:30px;"
                                       value="<?php echo $quote->installation_detail_5; ?>" tabindex="14">
                            </div>
                        </div>
                        <div class="col-span-4" style="padding: 1em;">
                            <h3><b>Locate Fence By: </b></h3>
                            <div class="intro-y flex flex-col sm:flex-row mt-1">
                                <label class="md:mr-5 pt-1 sm:pt-3" style="width: 150px;">* Stakes:</label>
                                <input type="text" id="installation_detail_11" name="installation_detail_11"
                                       class="input w-100 border mt-1" style="width: 120px;height:30px;"
                                       value="<?php echo $quote->installation_detail_11; ?>" tabindex="16">
                            </div>
                            <div class="intro-y flex flex-col sm:flex-row mt-1">
                                <label class="md:mr-5 pt-1 sm:pt-3" style="width: 150px;">* Ex Fence:</label>
                                <input type="text" id="installation_detail_12" name="installation_detail_12"
                                       class="input border mt-1" style="width: 120px;height:30px;"
                                       value="<?php echo $quote->installation_detail_12; ?>" tabindex="16">
                            </div>
                            <div class="intro-y flex flex-col sm:flex-row mt-1">
                                <label class="md:mr-5 pt-1 sm:pt-3" style="width: 150px;">* Sales Rep:</label>
                                <input type="text" id="installation_detail_13" name="installation_detail_13"
                                       class="input border mt-1" style="width: 120px;height:30px;"
                                       value="<?php echo $quote->installation_detail_13; ?>" tabindex="17">
                            </div>
                            <div class="intro-y flex flex-col sm:flex-row mt-1">
                                <label class="md:mr-5 pt-1 sm:pt-3" style="width: 150px;">* Customer:</label>
                                <input type="text" id="installation_detail_14" name="installation_detail_14"
                                       class="input border mt-1" style="width: 120px;height:30px;"
                                       value="<?php echo $quote->installation_detail_14; ?>" tabindex="18">
                            </div>
                        </div>
                        <div class="col-span-4" style="padding: 1em;">
                            <h3><b>Barbwire: </b></h3>
                            <div class="intro-y flex flex-col sm:flex-row mt-1">
                                <label class="md:mr-5 pt-1 sm:pt-3" style="width: 150px;">* None : </label>
                                <input type="text" id="installation_detail_22" name="installation_detail_22"
                                       class="input border mt-1" style="width: 120px;height:30px;"
                                       value="<?php echo $quote->installation_detail_22; ?>" tabindex="19">
                            </div>
                            <div class="intro-y flex flex-col sm:flex-row mt-1">
                                <label class="md:mr-5 pt-1 sm:pt-3" style="width: 150px;">* In : </label>
                                <input type="text" id="installation_detail_23" name="installation_detail_23"
                                       class="input border mt-1" style="width: 120px;height:30px;"
                                       value="<?php echo $quote->installation_detail_23; ?>" tabindex="20">
                            </div>
                            <div class="intro-y flex flex-col sm:flex-row mt-1">
                                <label class="md:mr-5 pt-1 sm:pt-3" style="width: 150px;">* Out : </label>
                                <input type="text" id="installation_detail_24" name="installation_detail_24"
                                       class="input border mt-1" style="width: 120px;height:30px;"
                                       value="<?php echo $quote->installation_detail_24; ?>" tabindex="21">
                            </div>
                            <div class="intro-y flex flex-col sm:flex-row mt-1">
                                <label class="md:mr-5 pt-1 sm:pt-3" style="width: 150px;">* Vertical : </label>
                                <input type="text" id="installation_detail_25" name="installation_detail_25"
                                       class="input border mt-1" style="width: 120px;height:30px;"
                                       value="<?php echo $quote->installation_detail_25; ?>" tabindex="22">
                            </div>
                        </div>

                        <div class="col-span-4" style="padding: 1em;">
                            <h3><b>Rails: </b></h3>
                            <div class="intro-y flex flex-col sm:flex-row mt-1">
                                <label class="md:mr-5 pt-1 sm:pt-3" style="width: 150px;">* Bottom : </label>
                                <input type="text" id="installation_detail_8" name="installation_detail_8"
                                       class="input border mt-1" style="width: 120px;height:30px;"
                                       value="<?php echo $quote->installation_detail_8; ?>" tabindex="23">
                            </div>
                            <div class="intro-y flex flex-col sm:flex-row mt-1">
                                <label class="md:mr-5 pt-1 sm:pt-3" style="width: 150px;">* Centre : </label>
                                <input type="text" id="installation_detail_9" name="installation_detail_9"
                                       class="input border mt-1" style="width: 120px;height:30px;"
                                       value="<?php echo $quote->installation_detail_9; ?>" tabindex="24">
                            </div>
                            <div class="intro-y flex flex-col sm:flex-row mt-1">
                                <label class="md:mr-5 pt-1 sm:pt-3" style="width: 150px;">* Braces : </label>
                                <input type="text" id="installation_detail_10" name="installation_detail_10"
                                       class="input border mt-1" style="width: 120px;height:30px;"
                                       value="<?php echo $quote->installation_detail_10; ?>" tabindex="25">
                            </div>
                        </div>
                        <div class="col-span-4" style="padding: 1em;">
                            <h3><b>Main Post Set: </b></h3>
                            <div class="intro-y flex flex-col sm:flex-row mt-1">
                                <label class="md:mr-5 pt-1 sm:pt-3" style="width: 150px;">* Concrete : </label>
                                <input type="text" id="installation_detail_17" name="installation_detail_17"
                                       class="input border mt-1" style="width: 120px;height:30px;"
                                       value="<?php echo $quote->installation_detail_17; ?>" tabindex="26">
                            </div>
                            <div class="intro-y flex flex-col sm:flex-row mt-1">
                                <label class="md:mr-5 pt-1 sm:pt-3" style="width: 150px;">* Driven : </label>
                                <input type="text" id="installation_detail_18" name="installation_detail_18"
                                       class="input border mt-1" style="width: 120px;height:30px;"
                                       value="<?php echo $quote->installation_detail_18; ?>" tabindex="27">
                            </div>
                            <div class="intro-y flex flex-col sm:flex-row mt-1">
                                <label class="md:mr-5 pt-1 sm:pt-3" style="width: 150px;">* Flanged : </label>
                                <input type="text" id="installation_detail_19" name="installation_detail_19"
                                       class="input border mt-1" style="width: 120px;height:30px;"
                                       value="<?php echo $quote->installation_detail_19; ?>" tabindex="28">
                            </div>
                        </div>
                        <div class="col-span-4" style="padding: 1em;">
                            <h3><b>Existing Fence: </b></h3>
                            <div class="intro-y flex flex-col sm:flex-row mt-1">
                                <label class="md:mr-5 pt-1 sm:pt-3" style="width: 150px;">* None : </label>
                                <input type="text" id="installation_detail_26" name="installation_detail_26"
                                       class="input border mt-1" style="width: 120px;height:30px;"
                                       value="<?php echo $quote->installation_detail_26; ?>" tabindex="29">
                            </div>
                            <div class="intro-y flex flex-col sm:flex-row mt-1">
                                <label class="md:mr-5 pt-1 sm:pt-3" style="width: 150px;">* Remove : </label>
                                <input type="text" id="installation_detail_27" name="installation_detail_27"
                                       class="input border mt-1" style="width: 120px;height:30px;"
                                       value="<?php echo $quote->installation_detail_27; ?>" tabindex="30">
                            </div>
                            <div class="intro-y flex flex-col sm:flex-row mt-1">
                                <label class="md:mr-5 pt-1 sm:pt-3" style="width: 150px;">* Haul Away : </label>
                                <input type="text" id="installation_detail_28" name="installation_detail_28"
                                       class="input border mt-1" style="width: 120px;height:30px;"
                                       value="<?php echo $quote->installation_detail_28; ?>" tabindex="31">
                            </div>
                        </div>
                        <div class="col-span-4" style="padding: 1em;">
                            <h3><b>Keep Fence: </b></h3>
                            <div class="intro-y flex flex-col sm:flex-row mt-1">
                                <label class="md:mr-5 pt-1 sm:pt-3" style="width: 150px;">* On Line : </label>
                                <input type="text" id="installation_detail_15" name="installation_detail_15"
                                       class="input border mt-1" style="width: 120px;height:30px;"
                                       value="<?php echo $quote->installation_detail_15; ?>" tabindex="32">
                            </div>
                            <div class="intro-y flex flex-col sm:flex-row mt-1">
                                <label class="md:mr-5 pt-1 sm:pt-3" style="width: 150px;">* Inside Line : </label>
                                <input type="text" id="installation_detail_16" name="installation_detail_16"
                                       class="input border mt-1" style="width: 120px;height:30px;"
                                       value="<?php echo $quote->installation_detail_16; ?>" tabindex="33">
                            </div>
                        </div>
                        <div class="col-span-4" style="padding: 1em;">
                            <h3><b>Footing Diameter: </b></h3>
                            <div class="intro-y flex flex-col sm:flex-row mt-1">
                                <label class="md:mr-5 pt-1 sm:pt-3" style="width: 150px;">* Mains : </label>
                                <input type="text" id="installation_detail_6" name="installation_detail_6"
                                       class="input border mt-1" style="width: 120px;height:30px;"
                                       value="<?php echo $quote->installation_detail_6; ?>" tabindex="34">
                            </div>
                            <div class="intro-y flex flex-col sm:flex-row mt-1">
                                <label class="md:mr-5 pt-1 sm:pt-3" style="width: 150px;">* Lines : </label>
                                <input type="text" id="installation_detail_7" name="installation_detail_7"
                                       class="input border mt-1" style="width: 120px;height:30px;"
                                       value="<?php echo $quote->installation_detail_7; ?>" tabindex="35">
                            </div>
                        </div>

                        <div class="col-span-4" style="padding: 1em;">
                            <h3><b>Footing Depth: </b></h3>
                            <div class="intro-y flex flex-col sm:flex-row mt-1">
                                <label class="md:mr-5 pt-1 sm:pt-3" style="width: 150px;">* Mains:</label>
                                <input type="text" id="installation_detail_20" name="installation_detail_20"
                                       class="input w-100 border mt-1" style="width: 120px;height:30px;"
                                       value="<?php echo $quote->installation_detail_20; ?>" tabindex="36">
                            </div>
                            <div class="intro-y flex flex-col sm:flex-row mt-1">
                                <label class="md:mr-5 pt-1 sm:pt-3" style="width: 150px;">* Lines:</label>
                                <input type="text" id="installation_detail_21" name="installation_detail_21"
                                       class="input border mt-1" style="width: 120px;height:30px;"
                                       value="<?php echo $quote->installation_detail_21; ?>" tabindex="37">
                            </div>
                        </div>


                    </div>
                </fieldset>
            <?php
            endif;
            if (is_object($quote) && $quote->status == 'Job'):
            ?>
            <div class="grid grid-cols-12 mt-5" id="final_quote_section">
                <div class="intro-y col-span-12 lg:col-span-6" id="additional_info_div">
                    <fieldset class="p-1 mt-2 w-full fieldset_bd_color">
                        <legend class="quote_legend_spacing">Quote Notes</legend>
                        <?php if ($opportunity->job_type == 'New Fence' || $opportunity->job_type == 'New Fence and Gate c/w Operator') { ?>
                            <div class="preview" style="padding: 1em;">
                                <div class="intro-y flex flex-col sm:flex-row mt-1">
                                    <label class="md:mr-5 pt-1 sm:pt-3" style="width: 200px;">FENCE - Including
                                        Fabric,<br>
                                        Top Rail, Line Posts & Fittings:</label>
                                    <input type="text" id="additional_col_1" name="additional_col_1"
                                           class="input border mt-1" style="width:30%;height:40px;"
                                           value="<?php echo $quote->additional_col_1; ?>" tabindex="3">
                                </div>
                                <div class="intro-y flex flex-col sm:flex-row mt-1">
                                    <label class="md:mr-5 pt-1 sm:pt-3" style="width: 200px;">END POSTS:</label>
                                    <input type="text" id="additional_col_2" name="additional_col_2"
                                           class="input border mt-1" style="width:30%;"
                                           value="<?php echo $quote->additional_col_2; ?>" tabindex="3">
                                </div>
                                <div class="intro-y flex flex-col sm:flex-row mt-1">
                                    <label class="md:mr-5 pt-1 sm:pt-3" style="width: 200px;">GATE
                                        POSTS:</label>
                                    <input type="text" id="additional_col_3" name="additional_col_3"
                                           class="input border mt-1" style="width:30%;"
                                           value="<?php echo $quote->additional_col_3; ?>" tabindex="3">
                                </div>
                                <div class="intro-y flex flex-col sm:flex-row mt-1">
                                    <label class="md:mr-5 pt-1 sm:pt-3" style="width: 200px;">CORNER
                                        POSTS:</label>
                                    <input type="text" id="additional_col_4" name="additional_col_4"
                                           class="input border mt-1" style="width:30%;"
                                           value="<?php echo $quote->additional_col_4; ?>" tabindex="3">
                                </div>
                                <div class="intro-y flex flex-col sm:flex-row mt-1">
                                    <label class="md:mr-5 pt-1 sm:pt-3" style="width: 200px;">STRAINING
                                        POSTS: </label>
                                    <input type="text" id="additional_col_5" name="additional_col_5"
                                           class="input border mt-1" style="width:30%;"
                                           value="<?php echo $quote->additional_col_5; ?>" tabindex="3">
                                </div>
                                <div class="intro-y flex flex-col sm:flex-row mt-1">
                                    <label class="md:mr-5 pt-1 sm:pt-3" style="width: 200px;">FITTINGS: </label>
                                    <input type="text" id="additional_col_6" name="additional_col_6"
                                           class="input border mt-1" style="width:30%;"
                                           value="<?php echo $quote->additional_col_6; ?>" tabindex="3">
                                </div>
                                <div class="intro-y flex flex-col sm:flex-row mt-1">
                                    <label class="md:mr-5 pt-1 sm:pt-3" style="width: 200px;">GATES: </label>
                                    <input type="text" id="additional_col_7" name="additional_col_7"
                                           class="input border mt-1" style="width:30%;"
                                           value="<?php echo $quote->additional_col_7; ?>" tabindex="3">
                                </div>
                                <div class="intro-y flex flex-col sm:flex-row mt-1">
                                    <p>* Erection of Fence & Gates: All line posts set
                                        <select name="additional_select_1" class="input border">
                                            <option <?php echo ($quote->additional_select_1 == 'IN CONCRETE') ? 'selected' : ''; ?>>
                                                IN CONCRETE
                                            </option>
                                            <option <?php echo ($quote->additional_select_1 == 'ON FLANGES') ? 'selected' : ''; ?>>
                                                ON FLANGES
                                            </option>
                                            <option <?php echo ($quote->additional_select_1 == 'COREDRILLED') ? 'selected' : ''; ?>>
                                                COREDRILLED
                                            </option>
                                        </select>
                                    </p>
                                </div>
                                <div class="intro-y flex flex-col sm:flex-row mt-1" id="additional_select_comment1">
                                    <?php if ($quote->additional_select_1 == '' || $quote->additional_select_1 == 'IN CONCRETE') { ?>
                                        <p>(In normal soil & on cleared line marked by customer with survey
                                            bars)</p>
                                    <?php } elseif ($quote->additional_select_1 == 'ON FLANGES') { ?>
                                        <p>On normal concrete slab cleared of all obstacles 72" radius.</p>
                                    <?php } elseif ($quote->additional_select_1 == 'COREDRILLED') { ?>
                                        <p>(Radar Scan / X-Ray services and / or location of embedded objects
                                            not included in this quotation.)</p>
                                    <?php } ?>
                                </div>
                                <div class="intro-y flex flex-col sm:flex-row mt-1">
                                    <p>* Terminal posts installed
                                        <select name="additional_select_2" class="input border">
                                            <option <?php echo ($quote->additional_select_2 == 'IN CONCRETE') ? 'selected' : ''; ?>>
                                                IN CONCRETE
                                            </option>
                                            <option <?php echo ($quote->additional_select_2 == 'ON FLANGES') ? 'selected' : ''; ?>>
                                                ON FLANGES
                                            </option>
                                            <option <?php echo ($quote->additional_select_2 == 'COREDRILLED') ? 'selected' : ''; ?>>
                                                COREDRILLED
                                            </option>
                                        </select></p>
                                </div>
                                <div class="intro-y flex flex-col sm:flex-row mt-1" id="additional_select_comment2">
                                    <?php if ($quote->additional_select_2 == '' || $quote->additional_select_2 == 'IN CONCRETE') { ?>
                                        <p>(In normal soil & on cleared line marked by customer with survey
                                            bars)</p>
                                    <?php } elseif ($quote->additional_select_2 == 'ON FLANGES') { ?>
                                        <p>On normal concrete slab cleared of all obstacles 72" radius.</p>
                                    <?php } elseif ($quote->additional_select_2 == 'COREDRILLED') { ?>
                                        <p>(Radar Scan / X-Ray services and / or location of embedded objects
                                            not included in this quotation.)</p>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php
                        } else { ?>
                            <div class="intro-y flex flex-col sm:flex-row mt-1">
                                        <textarea id="additional_notes" name="additional_notes" style="width: 100%"
                                                  class="input w-100 border mt-1"
                                                  tabindex="3"><?php echo $quote->additional_notes; ?></textarea>
                            </div>
                            <?php
                        } ?>
                    </fieldset>
                </div>
                <div class="intro-y col-span-12 lg:col-span-6" style="padding: 0.5em;">
                    <!-- BEGIN: Input -->
                    <div class="intro-y box">
                        <div id="input">
                            <div class="preview">
                                <div>
                                    <div style="width: 35%;display: inline-block;">
                                        <a class="button bg-gray-200 text-gray-600 mr-5"
                                           href="generate_ia?quote_id=<?php echo $quote->id; ?>" target="_blank"
                                           style="float: inherit;">
                                            Generate IA
                                        </a>
                                    </div>
                                    <div style="width: 50%;display: inline;">
                                        <input type="checkbox" class="input border  mr-2" id="ia_signed"
                                               name="ia_signed"
                                               value="1" <?php echo ($quote->ia_signed == 1) ? 'checked' : ''; ?>><label>IA
                                            is
                                            signed</label>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <div style="width: 35%;display: inline-block;">
                                        <button class="button bg-gray-200 text-gray-600" style="float: inherit;"
                                                id="generate_qa_form_button" target="_blank" onclick="generate_form();">
                                            Generate Form
                                        </button>
                                    </div>
                                    <div style="width: 50%;display: inline;">
                                        <input type="checkbox" class="input border mr-2" id="form_signed"
                                               name="form_signed"
                                               value="1" <?php echo ($quote->form_signed == 1) ? 'checked' : ''; ?>><label>Quote
                                            Form is
                                            signed</label>
                                    </div>
                                </div>
                                <div>

                                    <div style="width: 35%;display: inline-block;visibility: hidden;">
                                        <a class="button bg-gray-200 text-gray-600" style="float: inherit;"
                                           href="generate_qa_blank?quote_id=<?php echo $quote->id; ?>" target="_blank">
                                            Generate
                                            Blank Form
                                        </a>
                                    </div>
                                    <div style="width: 50%;display: inline;">
                                        <input type="checkbox" class="input border" id="credit_passed"
                                               name="credit_passed"
                                               value="1" <?php echo ($quote->credit_passed == 1) ? 'checked' : ''; ?>>
                                        <label class="cursor-pointer select-none" for="credit_passed"
                                               style="width: auto;">Customer passed Credit-Check</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Input -->
                </div>
                <?php
                endif;
                ?>

                <input type="hidden" name="opportunity_id"
                       value="<?php echo (is_object($opportunity)) ? $opportunity->id : ''; ?>">
                <input type="hidden" name="customer_id"
                       value="<?php echo (is_object($opportunity)) ? $opportunity->customer_id : ''; ?>">
                <input type="hidden" name="quote_id"
                       value="<?php echo (is_object($quote)) ? $quote->id : ''; ?>">
                <input type="hidden" name="status"
                       value="<?php echo (is_object($quote)) ? $quote->status : ''; ?>">
                <input type="hidden" name="action" id="action" value="">
                <input type="hidden" name="mat_net" id="mat_net"/>
                <input type="hidden" name="labour_net" id="labour_net"/>
                <input type="hidden" name="misc_net" id="misc_net"/>
                <input type="hidden" name="add_on_net" id="add_on_net"/>
                <input type="hidden" name="mat_factor" id="mat_factor"/>
                <input type="hidden" name="lab_factor" id="lab_factor"/>
                <input type="hidden" name="misc_factor" id="misc_factor"/>
                <input type="hidden" name="ads_on_factor" id="ads_on_factor"/>
                <input type="hidden" name="hst" id="hst_amount"/>
            </div>
        </form>
        <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
            <?php
            if (!is_object($quote)):
                ?>
                <button class="button w-24 justify-center block bg-theme-1 text-white" id="save_new_quote"
                        onclick="save_new_quote();">Save
                </button>
                <button class="button w-24 justify-center block bg-theme-1 text-white ml-2 mr-3"
                        id="submit_new_quote"
                        onclick="submit_new_quote();">Next
                </button>
            <?php
            endif;
            if (is_object($quote)):
                if ($quote->status == 'New'):
                    ?>
                    <button class="button w-24 justify-center block bg-theme-1 text-white" id="save_new_quote"
                            onclick="save_new_quote();">Save
                    </button>
                    <button class="button w-24 justify-center block bg-theme-1 text-white ml-2 mr-3"
                            id="submit_new_quote"
                            onclick="submit_new_quote();">Next
                    </button>
                <?php
                endif;
            endif;
            if (is_object($quote)):
                if ($quote->status == 'Pending'):
                    ?>
                    <button class="button w-24 justify-center block bg-theme-1 text-white" id="reject_pending_quote"
                            onclick="reject_pending_quote();">Back
                    </button>
                    <button class="button w-24 justify-center block bg-theme-1 text-white ml-2 mr-3"
                            id="save_pending_quote"
                            onclick="save_pending_quote();">Save
                    </button>
                    <button class="button w-24 justify-center block bg-theme-1 text-white ml-2 mr-3"
                            id="approve_pending_quote"
                            onclick="submit_pending_quote();">Submit
                    </button>
                <?php
                endif;
            endif;
            if (is_object($quote)):
                if ($quote->status == 'Approved'):
                    ?>
                    <button class="button w-24 justify-center block bg-theme-1 text-white"
                            id="reject_approved_quote"
                            onclick="reject_approved_quote();">Reject
                    </button>
                    <button class="button w-50 justify-center block bg-theme-1 text-white ml-2 mr-3"
                            id="create_job"
                            onclick="create_job();">Create Job
                    </button>
                <?php
                endif;
            endif;
            ?>
        </div>
    </div>

    <!-- End Modal -->
    <!--    <script type="text/javascript" src="--><?php //echo base_url();
    ?><!--assets/js/add_quote.js"/>-->
    <script>
        $(function () {
            $('#payment_terms_span').html($('select[name="payment_term"]').val());
            $('select[name="payment_term"]').change(function () {
                $('#payment_terms_span').html($(this).val());
            });
            if (status != '') {
                $('.toggle-action').removeClass("fa-angle-up");
                $('.toggle-action').addClass("fa-angle-down");
                $(".material-item").slideUp();
                $(".labour-item").slideUp();
                $(".miscellaneous-item").slideUp();
                $(".adsOn-item").slideUp();
            }
            if (status == 'New') {

                var mat_total = $('#material-item-total').find('td').eq(2).html() * 1;
                $('#final_quote_table').find('tr').eq(1).children().eq(1).find('a').html(!is_sale ? Math.round(mat_total / 1.32 * 100) / 100 : mat_total);
                if (mat_total == 0) {
                    $('#material_markup_percent').attr('disabled', true);
                    $('#material_markup_amount').attr('disabled', true);
                }


                var labour_total = $('#labour-item-total').find('td').eq(2).html() * 1;
                if (labour_total == 0) {
                    $('#labor_markup_percent').attr('disabled', true);
                    $('#labor_markup_amount').attr('disabled', true);
                }
                $('#final_quote_table').find('tr').eq(2).children().eq(1).find('a').html(labour_total);


                var mis_total = $('#miscellaneous-item-total').find('td').eq(2).html() * 1;
                $('#final_quote_table').find('tr').eq(3).children().eq(1).find('a').html(mis_total);
                if (mis_total == 0) {
                    $('#misc_markup_percent').attr('disabled', true);
                    $('#misc_markup_amount').attr('disabled', true);
                }

                var addon_total = $('#adsOn-item-total').find('td').eq(2).html() * 1;
                $('#final_quote_table').find('tr').eq(4).children().eq(1).html(addon_total);

                if (addon_total == 0) {
                    $('#adson_markup_percent').attr('disabled', true);
                    $('#adson_markup_amount').attr('disabled', true);
                }

                if ($('#total_markup_percent').val() == '10' && $('#total_markup_amount').val() == '0') {
                    var total_profit = (mat_total + labour_total + mis_total + addon_total) * 0.1;
                    $('#total_markup_amount').val(Math.round(total_profit * 100) / 100);
                }

                calculate_sale_table();
            }
            if (status == 'Pending' || status == 'Approved') {

                $('fieldset').find('input').attr('readonly', true);
                $('fieldset').find('select').attr('disabled', true);
                $('fieldset').find('textarea').attr('readonly', true);
                if (status == 'Pending') {
                    $('#additional_info_div').find('input').attr('readonly', false);
                    $('#additional_info_div').find('select').attr('disabled', false);
                    $('.installation_detail').find('input').attr('readonly', false);
                    $('fieldset').find('textarea').attr('readonly', false);
                } else {
                    $('.installation_detail').find('input').attr('readonly', false);
                    $('input[type="checkbox"]').attr('disabled', true);
                }
                $('.delete_detail_row').hide();
                $('.add_detail_row').hide();

            } else if (status == 'Job') {
                $('body').find('input').attr('readonly', true);
                $('body').find('input:checkbox').attr('disabled', true);
                $('body').find('select').attr('disabled', true);
                $('.delete_detail_row').hide();
                $('.add_detail_row').hide();
            }
        });
        $('#quoteForm').keypress(function (e) {
            var $targ = $(e.target);
            var key = e.charCode || e.keyCode || 0;
            if (key == 13 && !$targ.is("textarea")) {
                e.preventDefault();
            }
        });
        $('#calc_mode').change(function () {
            var calc_mode = $('#calc_mode').val();
            var material_total = 0;
            $('#materials').find('tr').each(function (index) {
                if ($(this).attr('id') != 'material-item-row0' && $(this).attr('id') != 'material-item-total' && $(this).attr('id') != 'material_thead') {
                    var row_category = $(this).children().eq(0).find('select').val();
                    var sub_category = $(this).children().eq(1).find('select').val();
                    var row_code = $(this).children().eq(2).find('select').val();
                    var price_per_unit = catalogs[row_category][sub_category][row_code].price_per_unit_contractor * 1.32;
                    if (calc_mode == 'Tender') {
                        price_per_unit = catalogs[row_category][sub_category][row_code].price_per_unit_tender * 1.32;
                    }
                    $(this).children().eq(3).html(Math.round(price_per_unit * 100) / 100)
                    var quantity = $(this).children().eq(4).find('input').val() * 1
                    var row_total = quantity * price_per_unit;
                    $(this).children().eq(5).html(Math.round(row_total * 100) / 100)
                    material_total += row_total;
                }
            });
            $('#material-item-total').children().eq(2).html(Math.round(material_total * 100) / 100);
            $('#final_quote_table').find('tr').eq(1).children().eq(1).find('a').html(is_sale ? Math.round(material_total * 100) / 100 : Math.round(material_total / 1.32 * 100) / 100);

            var labour_total = 0;
            $('#labour').find('tr').each(function (index) {
                if ($(this).attr('id') != 'labour-item-row0' && $(this).attr('id') != 'labour-item-total' && $(this).attr('id') != 'labour_thead') {
                    var quantity = $(this).children().eq(1).find('input').val() * 1

                    var row_total = quantity * 1148.88;

                    if (calc_mode == 'Tender') {
                        row_total = quantity * 1095.85;
                    }
                    $(this).children().eq(2).html(Math.round(row_total * 100) / 100)

                    labour_total += row_total;
                }
            });
            $('#labour-item-total').children().eq(2).html(Math.round(labour_total * 100) / 100);
            $('#final_quote_table').find('tr').eq(2).children().eq(1).find('a').html(Math.round(labour_total * 100) / 100);
            calculate_sale_table();
        })


        $(".set_markup").click(function () {
            let markup_type = $(this).attr('id');
            if (markup_type == "horizontal-radio-chris-evans") {
                $(".input-total-markup").removeClass('bg-gray-100 cursor-not-allowed').removeAttr('disabled');
                $(".input-multiple-markup").addClass('bg-gray-100 cursor-not-allowed').prop("disabled", true);
                $(".input-multiple-markup").val('');
            } else {
                $(".input-multiple-markup").removeClass('bg-gray-100 cursor-not-allowed').removeAttr('disabled');
                $(".input-total-markup").addClass('bg-gray-100 cursor-not-allowed').prop("disabled", true);
                $(".input-total-markup").val('');
            }
        });
        $('select[name="additional_select_1"]').change(function () {
            if (this.value == 'IN CONCRETE') {
                $('#additional_select_comment1').html('<p>(In normal soil & on cleared line marked by customer with survey bars.)</p>')
            } else if (this.value == 'ON FLANGES') {
                $('#additional_select_comment1').html('<p>(On normal concrete slab cleared of all obstacles 72" radius.)</p>')
            } else if (this.value == 'COREDRILLED') {
                $('#additional_select_comment1').html('<p>(Radar Scan / X-Ray services and / or location of embadded objects not included in this quotation.)</p>')
            }
        });
        $('select[name="additional_select_2"]').change(function () {
            if (this.value == 'IN CONCRETE') {
                $('#additional_select_comment2').html('<p>(In normal soil & on cleared line marked by customer with survey bars.)</p>')
            } else if (this.value == 'ON FLANGES') {
                $('#additional_select_comment2').html('<p>(On normal concrete slab cleared of all obstacles 72" radius.)</p>')
            } else if (this.value == 'COREDRILLED') {
                $('#additional_select_comment2').html('<p>(Radar Scan / X-Ray services and / or location of embadded objects not included in this quotation.)</p>')
            }
        });

        function calculate_sale_table() {

            var mat_cost = $('#final_quote_table').find('tr').eq(1).children().eq(1).find('a').html() * 1;

            var labour_cost = $('#final_quote_table').find('tr').eq(2).children().eq(1).find('a').html() * 1;

            var misc_cost = $('#final_quote_table').find('tr').eq(3).children().eq(1).find('a').html() * 1;

            var adson_cost = $('#final_quote_table').find('tr').eq(4).children().eq(1).html() * 1;


            var subtotal_cost1 = mat_cost + labour_cost + misc_cost + adson_cost;

            var material_markup_percent = $('#material_markup_percent').val() * 1;
            var labour_markup_percent = $('#labor_markup_percent').val() * 1;
            var misc_markup_percent = $('#misc_markup_percent').val() * 1;
            var adson_markup_percent = $('#adson_markup_percent').val() * 1;
            if ($('#horizontal-radio-chris-evans').is(':checked')) {
                material_markup_percent = $('#total_markup_percent').val() * 1;
                labour_markup_percent = $('#total_markup_percent').val() * 1;
                misc_markup_percent = $('#total_markup_percent').val() * 1;
                adson_markup_percent = $('#total_markup_percent').val() * 1;
            } else {
                if (mat_cost != 0) {
                    $('#material_markup_percent').attr('disabled', false);
                    $('#material_markup_amount').attr('disabled', false);
                }
                if (labour_cost != 0) {
                    $('#labor_markup_percent').attr('disabled', false);
                    $('#labor_markup_amount').attr('disabled', false);
                }
                if (misc_cost != 0) {
                    $('#misc_markup_percent').attr('disabled', false);
                    $('#misc_markup_amount').attr('disabled', false);
                }
                if (adson_cost != 0) {
                    $('#adson_markup_percent').attr('disabled', false);
                    $('#adson_markup_amount').attr('disabled', false);
                }
            }
            var discount_percent = $('input[name="discount_percent"]').val() * 1;


            var mat_profit = (is_sale) ? mat_cost / 1.32 * material_markup_percent / 100 : (mat_cost * material_markup_percent / 100 + mat_cost * 0.32);
            var labour_profit = (labour_cost * labour_markup_percent / 100);
            var misc_profit = (misc_cost * misc_markup_percent / 100);
            var adson_profit = (adson_cost * adson_markup_percent / 100);

            var subtotal_selling1 = subtotal_cost1 + mat_profit + labour_profit + misc_profit + adson_profit;

            var discount_selling = (subtotal_selling1 * discount_percent / 100);

            var subtotal_selling2 = subtotal_selling1 - discount_selling;

            var HST = subtotal_selling2 * 13 / 100;

            var total_selling = subtotal_selling2 + HST;

            var total_profit1 = mat_profit + labour_profit + misc_profit + adson_profit;

            if ($('#horizontal-radio-chris-evans').is(':checked')) {
                if (subtotal_cost1 != 0 && $('#total_markup_percent').val() * 1 != 0) {
                    $('#total_markup_amount').val(Math.round(total_profit1 * 100) / 100);
                }
            }

            $('#final_quote_table').find('tr').eq(1).children().eq(2).html(Math.round((mat_cost + mat_profit) * 100) / 100);
            $('#final_quote_table').find('tr').eq(1).children().eq(3).html(Math.round(mat_profit * 100) / 100);
            $('#final_quote_table').find('tr').eq(2).children().eq(2).html(Math.round((labour_cost + labour_profit) * 100) / 100);
            $('#final_quote_table').find('tr').eq(2).children().eq(3).html(Math.round(labour_profit * 100) / 100);
            $('#final_quote_table').find('tr').eq(3).children().eq(2).html(Math.round((misc_cost + misc_profit) * 100) / 100);
            $('#final_quote_table').find('tr').eq(3).children().eq(3).html(Math.round(misc_profit * 100) / 100);
            $('#final_quote_table').find('tr').eq(4).children().eq(2).html(Math.round((adson_cost + adson_profit) * 100) / 100);
            $('#final_quote_table').find('tr').eq(4).children().eq(3).html(Math.round(adson_profit * 100) / 100);

            $('#final_quote_table').find('tr').eq(5).children().eq(1).html(Math.round(subtotal_cost1 * 100) / 100);
            $('#final_quote_table').find('tr').eq(5).children().eq(2).html(Math.round(subtotal_selling1 * 100) / 100);
            $('#final_quote_table').find('tr').eq(5).children().eq(3).html(Math.round(total_profit1 * 100) / 100);

            $('#final_quote_table').find('tr').eq(6).children().eq(1).html(discount_percent + '%');
            $('#final_quote_table').find('tr').eq(6).children().eq(2).html(Math.round(discount_selling * 100) / 100);

            $('#final_quote_table').find('tr').eq(7).children().eq(2).html(Math.round(subtotal_selling2 * 100) / 100);

            $('#final_quote_table').find('tr').eq(8).children().eq(2).html(Math.round(HST * 100) / 100);
            $('#final_quote_table').find('tr').eq(9).children().eq(2).html(Math.round(total_selling * 100) / 100);

            $('#mat_net').val(mat_cost);
            $('#labour_net').val(labour_cost);
            $('#misc_net').val(misc_cost);
            $('#add_on_net').val(adson_cost);
            $('#mat_factor').val(material_markup_percent / 100 + 1)
            $('#lab_factor').val(labour_markup_percent / 100 + 1)
            $('#misc_factor').val(misc_markup_percent / 100 + 1)
            $('#ads_on_factor').val(adson_markup_percent / 100 + 1)
            $('#hst_amount').val(HST)

        }

        $(".add-discount").keyup(function () {
            var discount_percent = 0;
            var discount_amount = 0;
            var sub_total1 = $('#final_quote_table').find('tr').eq(5).children().eq(2).html() * 1;
            if ($(this).val() < 0) {
                $(this).val('');
                showNotification('Discount input can’t be negative values.');
                $(this).focus();
                return;
            }
            if ($(this).attr('name') == 'discount_percent') {
                if ($(this).val() > 21 && is_sale) {
                    $(this).val('');
                    showNotification('Discount input can’t be bigger than 21.');
                    $(this).focus();
                    return;
                }
                discount_percent = $(this).val() * 1;
                discount_amount = sub_total1 * discount_percent / 100;
                $('input[name="discount_amount"]').val(Math.round(discount_amount * 100) / 100);
            } else {
                discount_amount = $(this).val() * 1;
                discount_percent = (discount_amount / sub_total1) * 100;
                if (discount_percent > 21 && is_sale) {
                    $(this).val('');
                    showNotification('Discount input can’t be bigger than 21.');
                    $(this).focus();
                    return;
                }
                $('input[name="discount_percent"]').val(Math.round(discount_percent * 100) / 100);
            }
            calculate_sale_table();
        });
        $('#total_markup_percent, #total_markup_amount').keyup(function () {
            var total_percent = 0;
            var total_amount = 0;
            if ($(this).val() * 1 < 0) {
                $(this).val('');
                showNotification('Markups input can’t be negative values.');
                $(this).focus();
                return;
            }
            var sub_total1 = $('#final_quote_table').find('tr').eq(5).children().eq(1).html() * 1;
            if ($(this).attr('id') == 'total_markup_percent') {
                total_percent = $(this).val() * 1;
                total_amount = sub_total1 * total_percent / 100;
                $('#total_markup_amount').val(Math.round(total_amount * 100) / 100);
            } else {
                total_amount = $(this).val() * 1;
                total_percent = (total_amount / sub_total1) * 100;
                $('#total_markup_percent').val(Math.round(total_percent * 10000) / 10000);
            }
            calculate_sale_table();
        });
        $('.single_markup').keyup(function () {
            var mat_percent = 0;
            var mat_amount = 0;
            var labour_percent = 0;
            var labour_amount = 0;
            var mis_percent = 0;
            var mis_amount = 0;
            var adson_percent = 0;
            var adson_amount = 0;
            var mat_cost = $('#final_quote_table').find('tr').eq(1).children().eq(1).find('a').html() * 1;
            if ($(this).val() * 1 < 0) {
                $(this).val('');
                showNotification('Markups input can’t be negative values.');
                $(this).focus();
                return;
            }
            if ($(this).attr('id') == 'material_markup_percent') {
                if ($(this).val() == '') {
                    $('#material_markup_amount').val('');
                } else {
                    mat_percent = $(this).val() * 1;
                    mat_amount = mat_cost * mat_percent / 100;
                    $('#material_markup_amount').val(Math.round(mat_amount * 100) / 100);
                }
            } else if ($(this).attr('id') == 'material_markup_amount') {
                if ($(this).val() == '') {
                    $('#material_markup_percent').val('');
                } else {
                    mat_amount = $(this).val() * 1;
                    mat_percent = mat_amount / mat_cost * 100;
                    $('#material_markup_percent').val(Math.round(mat_percent * 10000) / 10000);
                }
            }
            var labour_cost = $('#final_quote_table').find('tr').eq(2).children().eq(1).find('a').html() * 1;
            if ($(this).attr('id') == 'labor_markup_percent') {
                if ($(this).val() == '') {
                    $('#labor_markup_amount').val('');
                } else {
                    labour_percent = $(this).val() * 1;
                    labour_amount = labour_cost * labour_percent / 100;
                    $('#labor_markup_amount').val(Math.round(labour_amount * 100) / 100);
                }
            } else if ($(this).attr('id') == 'labor_markup_amount') {
                if ($(this).val() == '') {
                    $('#labor_markup_percent').val('');
                } else {
                    labour_amount = $(this).val() * 1;
                    labour_percent = (labour_amount / labour_cost) * 100;
                    $('#labor_markup_percent').val(Math.round(labour_percent * 10000) / 10000);
                }
            }

            var mis_cost = $('#final_quote_table').find('tr').eq(3).children().eq(1).find('a').html() * 1;

            if ($(this).attr('id') == 'misc_markup_percent') {
                if ($(this).val() == '') {
                    $('#misc_markup_amount').val('');
                } else {
                    mis_percent = $(this).val() * 1;
                    mis_amount = mis_cost * mis_percent / 100;
                    $('#misc_markup_amount').val(Math.round(mis_amount * 100) / 100);
                }
            } else if ($(this).attr('id') == 'misc_markup_amount') {
                if ($(this).val() == '') {
                    $('#misc_markup_percent').val('')
                } else {
                    mis_amount = $(this).val() * 1;
                    mis_percent = (mis_amount / mis_cost) * 100;
                    $('#misc_markup_percent').val(Math.round(mis_percent * 10000) / 10000);
                }
            }

            var adson_cost = $('#final_quote_table').find('tr').eq(4).children().eq(1).html() * 1;

            if ($(this).attr('id') == 'adson_markup_percent') {
                if ($(this).val() == '') {
                    $('#adson_markup_amount').val('')
                } else {
                    adson_percent = $(this).val() * 1;
                    adson_amount = adson_cost * adson_percent / 100;
                    $('#adson_markup_amount').val(Math.round(adson_amount * 100) / 100);
                }
            } else if ($(this).attr('id') == 'adson_markup_amount') {
                if ($(this).val() == '') {
                    $('#adson_markup_percent').val('');
                } else {
                    adson_amount = $(this).val() * 1;
                    adson_percent = (adson_amount / adson_cost) * 100;
                    $('#adson_markup_percent').val(Math.round(adson_percent * 10000) / 10000);
                }
            }

            calculate_sale_table();

        });

        function add_material_item() {

            let html = '';
            let rowId = parseInt($(".material-item").last().attr("row"));
            let nextRow = rowId + 1;
            var catalogOptions = '';
            var matOptions = '';
            var price_per_unit = '';
            for (var i in categories) {
                catalogOptions += '<option value="' + categories[i].product_category + '">' + categories[i].product_category + '</option>'
            }
            var none_price = (hide_price) ? 'style="display:none"' : '';

            html += `<tr id="material-item-row` + nextRow + `" row="` + nextRow + `" class="intro-x material-item">
                                        <td>
                                            <div class="flex">
                                                <select class="input border mr-2" name="material_category[]" onchange="get_mat_sub_category(` + nextRow + `)">
                                                    <option value=""></option>
                                                    ` + catalogOptions + `
                                                </select>
                                            </div>
                                        </td>

                                        <td>
                                            <select class="input border mr-2" name="sub_categories[]" onchange="get_cate_code(` + nextRow + `)">
                                            </select>
                                        </td>
                                        <td>
                                            <select class="input border mr-2" name="material_code[]" onchange="change_mat_code(` + nextRow + `)">
                                            </select>
                                        </td>
                                        <td class="text-center">` + price_per_unit + `</td>
                                        <td class="text-center"><input type="number" name="mat_quantity[]" style="text-align: center;max-width: 40px;" onfocus="this.oldvalue = this.value;" onchange="change_mat_quantity(` + nextRow + `);this.oldvalue = this.value;"></td>
                                        <td class="text-center" ` + none_price + `></td>
                                        <td class="table-report__action">
                                            <div class="flex justify-center items-center">

                                              <a style="background-color:unset;border:unset" class="flex items-center mr-3" onclick="delete_material_item(` + nextRow + `)" href="javascript:;" ><i style="font-size: 20px;
    color: red;" class="fa fa-trash" aria-hidden="true"></i></a>
                                            </div>
                                        </td>
                                    </tr>`;
            $("#material-item-row" + rowId).after(html);


        }

        function get_mat_sub_category(rowId) {
            var selectedCatalog = event.target.value;
            var subOptions = '';
            var first = 0;
            var sub_catalogs = catalogs[selectedCatalog];

            Object.keys(sub_catalogs).forEach(function (key) {
                var codes = Object.keys(sub_catalogs[key]);
                if (first == 0) {
                    if ($('#calc_mode').val() == 'Contractor') {
                        price_per_unit = Math.round(sub_catalogs[key][codes[0]].price_per_unit_contractor * 1.32 * 10000) / 10000;
                    } else {
                        price_per_unit = Math.round(sub_catalogs[key][codes[0]].price_per_unit_tender * 1.32 * 10000) / 10000;
                    }
                }
                subOptions += '<option value="' + key + '">' + key + '</option>';
                first++;
            });
            $('#material-item-row' + rowId).children().eq(1).find('select').html(subOptions);
            $('#material-item-row' + rowId).children().eq(3).html(Math.round(price_per_unit * 100) / 100);
            var quantity = $('#material-item-row' + rowId).children().eq(4).find('input').val();
            var total_price = $('#material-item-total').children().eq(2).html() * 1;
            var original_price = $('#material-item-row' + rowId).children().eq(5).html() * 1;
            if (quantity != '') {
                $('#material-item-row' + rowId).children().eq(5).html(Math.round(quantity * price_per_unit * 100) / 100);
                $('#material-item-total').children().eq(2).html(Math.round((total_price - original_price + quantity * price_per_unit) * 100) / 100);
            }
            $('#final_quote_table').find('tr').eq(1).children().eq(1).find('a').html(is_sale ? Math.round((total_price - original_price + quantity * price_per_unit) * 100) / 100 : Math.round((total_price - original_price + quantity * price_per_unit) / 1.32 * 100) / 100);
            get_cate_code(rowId);
            calculate_sale_table();
        }

        function get_cate_code(rowId) {
            var selectedCatalog = $('#material-item-row' + rowId).children().eq(0).find('select').val();
            var selectedSubCatalog = $('#material-item-row' + rowId).children().eq(1).find('select').val();
            var codes = catalogs[selectedCatalog][selectedSubCatalog];
            var codeOptions = '';
            var price_per_unit = '';
            var first = 0;
            for (var j in codes) {
                if (first == 0) {
                    if ($('#calc_mode').val() == 'Contractor') {
                        price_per_unit = Math.round(codes[j].price_per_unit_contractor * 1.32 * 10000) / 10000;
                    } else {
                        price_per_unit = Math.round(codes[j].price_per_unit_tender * 1.32 * 10000) / 10000;
                    }
                }
                codeOptions += '<option value="' + j + '">' + codes[j].mat_description + '</option>';
                first++;
            }
            $('#material-item-row' + rowId).children().eq(2).find('select').html(codeOptions);
            $('#material-item-row' + rowId).children().eq(3).html(Math.round(price_per_unit * 100) / 100);
            var quantity = $('#material-item-row' + rowId).children().eq(4).find('input').val();
            var total_price = $('#material-item-total').children().eq(2).html() * 1;
            var original_price = $('#material-item-row' + rowId).children().eq(5).html() * 1;
            if (quantity != '') {
                $('#material-item-row' + rowId).children().eq(5).html(Math.round(quantity * price_per_unit * 100) / 100);
                $('#material-item-total').children().eq(2).html(Math.round((total_price - original_price + quantity * price_per_unit) * 100) / 100);
            }
            $('#final_quote_table').find('tr').eq(1).children().eq(1).find('a').html(is_sale ? Math.round((total_price - original_price + quantity * price_per_unit) * 100) / 100 : Math.round((total_price - original_price + quantity * price_per_unit) / 1.32 * 100) / 100);
            calculate_sale_table();
        }

        function change_mat_code(rowId) {
            var selected_category = $('#material-item-row' + rowId).children().eq(0).find('select').val();
            var selected_sub_category = $('#material-item-row' + rowId).children().eq(1).find('select').val();
            var selected_mat_code = $('#material-item-row' + rowId).children().eq(2).find('select').val();
            var price_per_unit = '';
            if ($('#calc_mode').val() == 'Contractor') {
                price_per_unit = Math.round(catalogs[selected_category][selected_sub_category][selected_mat_code].price_per_unit_contractor * 1.32 * 10000) / 10000;
            } else {
                price_per_unit = Math.round(catalogs[selected_category][selected_sub_category][selected_mat_code].price_per_unit_tender * 1.32 * 10000) / 10000;
            }
            $('#material-item-row' + rowId).children().eq(3).html(Math.round(price_per_unit * 100) / 100);
            var quantity = $('#material-item-row' + rowId).children().eq(4).find('input').val();
            var total_price = $('#material-item-total').children().eq(2).html() * 1;
            var original_price = $('#material-item-row' + rowId).children().eq(5).html() * 1;

            if (quantity != '') {
                $('#material-item-row' + rowId).children().eq(5).html(Math.round(quantity * price_per_unit * 100) / 100);
                $('#material-item-total').children().eq(2).html(Math.round((total_price - original_price + quantity * price_per_unit) * 100) / 100);
            }
            $('#final_quote_table').find('tr').eq(1).children().eq(1).find('a').html(is_sale ? Math.round((total_price - original_price + quantity * price_per_unit) * 100) / 100 : Math.round((total_price - original_price + quantity * price_per_unit) / 1.32 * 100) / 100);
            calculate_sale_table();
        }

        function change_mat_quantity(rowId) {

            var price_per_unit = $('#material-item-row' + rowId).children().eq(3).html();
            var quantity = $('#material-item-row' + rowId).children().eq(4).find('input').val();
            if (quantity < 0) {
                $('#material-item-row' + rowId).children().eq(4).find('input').val('');
                $('#material-item-row' + rowId).children().eq(4).find('input').focus();
                showNotification('Quantity must be bigger than 0');
                return;
            }
            var total_price = $('#material-item-total').children().eq(2).html() * 1;
            var original_price = $('#material-item-row' + rowId).children().eq(5).html() * 1;
            var total_quantity = $('#material-item-total').children().eq(1).html() * 1;
            var original_quantity = event.target.oldvalue * 1;
            if (quantity != '' && price_per_unit != '') {
                $('#material-item-row' + rowId).children().eq(5).html(Math.round(quantity * price_per_unit * 100) / 100);
                $('#material-item-total').children().eq(2).html(Math.round((total_price - original_price + quantity * price_per_unit) * 100) / 100)
            }

            $('#material-item-total').children().eq(1).html(Math.round((total_quantity - original_quantity + quantity * 1) * 100) / 100);

            $('#final_quote_table').find('tr').eq(1).children().eq(1).find('a').html(is_sale ? Math.round((total_price - original_price + quantity * price_per_unit) * 100) / 100 : Math.round((total_price - original_price + quantity * price_per_unit) / 1.32 * 100) / 100);
            calculate_sale_table();
        }

        function delete_material_item(rowId) {
            var total_price = $('#material-item-total').children().eq(2).html() * 1;
            var original_price = $('#material-item-row' + rowId).children().eq(5).html() * 1;
            var total_quantity = $('#material-item-total').children().eq(1).html() * 1;
            var original_quantity = $('#material-item-row' + rowId).children().eq(4).find('input').val() * 1;
            $('#material-item-total').children().eq(1).html(Math.round((total_quantity - original_quantity) * 100) / 100);
            $('#material-item-total').children().eq(2).html(Math.round((total_price - original_price) * 100) / 100);
            $("#material-item-row" + rowId).remove();
            $('#final_quote_table').find('tr').eq(1).children().eq(1).find('a').html(is_sale ? Math.round((total_price - original_price) * 100) / 100 : Math.round((total_price - original_price) / 1.32 * 100) / 100);
            calculate_sale_table();
        }


        function toogle_material_item(obj) {

            if ($(obj).hasClass("fa-angle-up")) {
                $(obj).removeClass("fa-angle-up");
                $(obj).addClass("fa-angle-down");
                $(".material-item").slideUp();
            } else {
                $(obj).removeClass("fa-angle-down");
                $(obj).addClass("fa-angle-up");
                $(".material-item").slideDown();
            }
        }


        //////////////labour

        function add_labour_item() {

            let html = '';
            let rowId = parseInt($(".labour-item").last().attr("row"));
            let nextRow = rowId + 1;
            var none_price = (hide_price) ? 'style="display:none"' : '';
            html += `<tr id="labour-item-row` + nextRow + `" row="` + nextRow + `" class="intro-x labour-item">
                                       <td class="w-40">
                                           <div class="flex">
                                               <select class="input border mr-2" name="labor_type[]">
                                                  <option></option>
                                                  <option>Man Day with Digger</option>
                                                  <option>Man Day Set Posts</option>
                                                  <option>Man Day Drive Posts</option>
                                                  <option>Man Day Clean Dirt</option>
                                                  <option>Man Day Frame and Mesh</option>
                                                  <option>Man Day Frame</option>
                                                  <option>Man Day Mesh</option>
                                                  <option>Man Day Tying Fence</option>
                                                  <option>Man Day Hang Gates</option>
                                                  <option>Man Day Removal</option>
                                                  <option>Man Day Cut Brush</option>
                                                  <option>Man Day Travel</option>
                                                  <option>Man Day Stretch Mesh</option>
                                                  <option>Man Day Welding</option>
                                                  <option>Man Day Room And Board</option>
                                               </select>
                                           </div>
                                       </td>

                                       <td class="text-center"><input type="number" name="labor_total_days[]"  onfocus="this.oldvalue = this.value;" onchange="set_labour_price(` + nextRow + `);this.oldvalue = this.value;"></td>
                                       <td ` + none_price + `></td>
                                       <td class="table-report__action w-56">
                                           <div class="flex justify-center items-center">

                                              <a style="background-color:unset;border:unset" class="flex items-center mr-3" onclick="delete_labour_item(` + nextRow + `)" href="javascript:;" ><i style="font-size: 20px;
    color: red;" class="fa fa-trash" aria-hidden="true"></i></a>
                                            </div>
                                       </td>
                                   </tr>`;
            $("#labour-item-row" + rowId).after(html);

        }

        function set_labour_price(rowId) {
            var total_price = $('#labour-item-total').children().eq(2).html() * 1;
            var original_price = $('#labour-item-row' + rowId).children().eq(2).html() * 1;
            var quantity = $('#labour-item-row' + rowId).children().eq(1).find('input').val();
            if (quantity < 0) {
                $('#labour-item-row' + rowId).children().eq(1).find('input').val('');
                $('#labour-item-row' + rowId).children().eq(1).find('input').focus();
                showNotification('# of Man Day must be bigger than 0');
                return;
            }
            var total_quantity = $('#labour-item-total').children().eq(1).html() * 1;
            var original_quantity = event.target.oldvalue * 1;
            var labor_row_price;
            if (quantity != '') {
                if ($('#calc_mode').val() == 'Contractor') {
                    labor_row_price = Math.round(quantity * 1148.88 * 100) / 100;
                    $('#labour-item-row' + rowId).children().eq(2).html(labor_row_price);
                    $('#labour-item-total').children().eq(2).html(Math.round((total_price - original_price + labor_row_price) * 100) / 100)
                    $('#final_quote_table').find('tr').eq(2).children().eq(1).find('a').html(Math.round((total_price - original_price + labor_row_price) * 100) / 100);
                } else {
                    labor_row_price = Math.round(quantity * 1095.85 * 100) / 100;
                    $('#labour-item-row' + rowId).children().eq(2).html(labor_row_price);
                    $('#labour-item-total').children().eq(2).html(Math.round((total_price - original_price + labor_row_price) * 100) / 100)
                    $('#final_quote_table').find('tr').eq(2).children().eq(1).find('a').html(Math.round((total_price - original_price + labor_row_price) * 100) / 100);
                }
            }
            $('#labour-item-total').children().eq(1).html(Math.round((total_quantity - original_quantity + quantity * 1) * 100) / 100);
            if (status == 'New') {
                calculate_sale_table();
            }
        }


        function delete_labour_item(rowId) {
            var total_price = $('#labour-item-total').children().eq(2).html() * 1;
            var original_price = $('#labour-item-row' + rowId).children().eq(2).html() * 1;
            $('#labour-item-total').children().eq(2).html(Math.round((total_price - original_price) * 100) / 100);
            var total_quantity = $('#labour-item-total').children().eq(1).html() * 1;
            var original_quantity = $('#labour-item-row' + rowId).children().eq(1).find('input').val() * 1;
            $('#labour-item-total').children().eq(1).html(Math.round((total_quantity - original_quantity) * 100) / 100);
            $("#labour-item-row" + rowId).remove();
            if (status == 'New') {
                $('#final_quote_table').find('tr').eq(2).children().eq(1).find('a').html(Math.round((total_price - original_price) * 100) / 100);
                calculate_sale_table();
            }
        }


        function toogle_labour_item(obj) {

            if ($(obj).hasClass("fa-angle-up")) {
                $(obj).removeClass("fa-angle-up");
                $(obj).addClass("fa-angle-down");
                $(".labour-item").slideUp();
            } else {
                $(obj).removeClass("fa-angle-down");
                $(obj).addClass("fa-angle-up");
                $(".labour-item").slideDown();
            }
        }


        //////////////miscellaneous

        function add_miscellaneous_item() {

            let html = '';
            let rowId = parseInt($(".miscellaneous-item").last().attr("row"));
            let nextRow = rowId + 1;
            html += `<tr id="miscellaneous-item-row` + nextRow + `" row="` + nextRow + `" class="intro-x miscellaneous-item">
                                       <td class="text-center">` + nextRow + `</td>
                                       <td class="text-center"><input type="text" name="misc_desc[]" placeholder="" value=""></td>
                                       <td class="text-center"><input type="number" name="misc_unit_price[]" placeholder="" onchange="change_mis_unit(` + nextRow + `)"></td>
                                       <td class="text-center"><input type="number" name="misc_quantity[]" onfocus="this.oldvalue = this.value;" placeholder="" onchange="change_mis_quantity(` + nextRow + `);;this.oldvalue = this.value;"></td>
                                       <td class="text-center"></td>
                                       <td class="table-report__action">
                                           <div class="flex justify-center items-center">
                                              <a style="background-color:unset;border:unset" class="flex items-center mr-3" onclick="delete_miscellaneous_item(` + nextRow + `)" href="javascript:;" ><i style="font-size: 20px;
    color: red;" class="fa fa-trash" aria-hidden="true"></i></a>
                                            </div>
                                       </td>
                                   </tr>`;
            $("#miscellaneous-item-row" + rowId).after(html);

        }

        function change_mis_unit(rowId) {
            var total_price = $('#miscellaneous-item-total').children().eq(2).html() * 1;
            var original_price = $('#miscellaneous-item-row' + rowId).children().eq(4).html() * 1;
            var price_per_unit = $('#miscellaneous-item-row' + rowId).children().eq(2).find('input').val();
            var quantity = $('#miscellaneous-item-row' + rowId).children().eq(3).find('input').val();
            var mis_row_price = Math.round(quantity * price_per_unit * 100) / 100
            if (price_per_unit < 0) {
                $('#miscellaneous-item-row' + rowId).children().eq(2).find('input').val('');
                $('#miscellaneous-item-row' + rowId).children().eq(2).find('input').focus();
                showNotification('Price per unit must be bigger than 0');
                return;
            }
            if (quantity != '' && price_per_unit != '') {
                $('#miscellaneous-item-row' + rowId).children().eq(4).html(mis_row_price);
                $('#miscellaneous-item-total').children().eq(2).html(Math.round((total_price - original_price + mis_row_price) * 100) / 100)
            }
            if (status == 'New') {
                $('#final_quote_table').find('tr').eq(3).children().eq(1).find('a').html(Math.round((total_price - original_price + mis_row_price) * 100) / 100);
                calculate_sale_table();
            }
        }

        function change_mis_quantity(rowId) {
            var total_price = $('#miscellaneous-item-total').children().eq(2).html() * 1;
            var original_price = $('#miscellaneous-item-row' + rowId).children().eq(4).html() * 1;
            var price_per_unit = $('#miscellaneous-item-row' + rowId).children().eq(2).find('input').val();
            var quantity = $('#miscellaneous-item-row' + rowId).children().eq(3).find('input').val();
            var total_quantity = $('#miscellaneous-item-total').children().eq(1).html() * 1;
            var original_quantity = event.target.oldvalue * 1;
            var mis_row_price = Math.round(quantity * price_per_unit * 100) / 100
            if (quantity < 0) {
                $('#miscellaneous-item-row' + rowId).children().eq(3).find('input').val('');
                $('#miscellaneous-item-row' + rowId).children().eq(3).find('input').focus();
                showNotification('Quantity must be bigger than 0');
                return;
            }
            if (quantity != '' && price_per_unit != '') {
                $('#miscellaneous-item-row' + rowId).children().eq(4).html(mis_row_price);
                $('#miscellaneous-item-total').children().eq(2).html(Math.round((total_price - original_price + mis_row_price) * 100) / 100)
            }
            $('#miscellaneous-item-total').children().eq(1).html(Math.round((total_quantity - original_quantity + quantity * 1) * 100) / 100);
            if (status == 'New') {
                $('#final_quote_table').find('tr').eq(3).children().eq(1).find('a').html(Math.round((total_price - original_price + mis_row_price) * 100) / 100);
                calculate_sale_table();
            }
        }

        function delete_miscellaneous_item(rowId) {
            var total_price = $('#miscellaneous-item-total').children().eq(2).html() * 1;
            var original_price = $('#miscellaneous-item-row' + rowId).children().eq(4).html() * 1;
            $('#miscellaneous-item-total').children().eq(2).html(Math.round((total_price - original_price) * 100) / 100);
            var total_quantity = $('#miscellaneous-item-total').children().eq(1).html() * 1;
            var original_quantity = $('#miscellaneous-item-row' + rowId).children().eq(3).find('input').val() * 1;
            $('#miscellaneous-item-total').children().eq(1).html(Math.round((total_quantity - original_quantity) * 100) / 100);
            $("#miscellaneous-item-row" + rowId).remove();
            if (status == 'New') {
                $('#final_quote_table').find('tr').eq(3).children().eq(1).find('a').html(Math.round((total_price - original_price) * 100) / 100);
                calculate_sale_table();
            }
        }


        function toogle_miscellaneous_item(obj) {

            if ($(obj).hasClass("fa-angle-up")) {
                $(obj).removeClass("fa-angle-up");
                $(obj).addClass("fa-angle-down");
                $(".miscellaneous-item").slideUp();
            } else {
                $(obj).removeClass("fa-angle-down");
                $(obj).addClass("fa-angle-up");
                $(".miscellaneous-item").slideDown();
            }
        }


        //////////////adsOn

        function add_adsOn_item() {

            let html = '';
            let rowId = parseInt($(".adsOn-item").last().attr("row"));
            let nextRow = rowId + 1;
            html += `<tr id="adsOn-item-row` + nextRow + `" row="` + nextRow + `" class="intro-x adsOn-item">
                                       <td class="text-center"><input type="text" name="addon_desc[]" placeholder=""></td>
                                       <td class="text-center"><input type="number" name="addon_unit_price[]" placeholder="" onchange="change_adsOn_unit(` + nextRow + `)"></td>
                                       <td class="text-center"><input type="number" name="addon_quantity[]" placeholder="" onfocus="this.oldvalue = this.value;" onchange="change_adsOn_quantity(` + nextRow + `);this.oldvalue = this.value;"></td>
                                       <td class="text-center"></td>
                                       <td class="table-report__action w-56">
                                           <div class="flex justify-center items-center">
                                               <a style="background-color:unset;border:unset" class="flex items-center mr-3" onclick="delete_adsOn_item(` + nextRow + `)" href="javascript:;" ><i style="font-size: 20px;
    color: red;" class="fa fa-trash" aria-hidden="true"></i></a>
                                           </div>
                                       </td>
                                   </tr>`;
            $("#adsOn-item-row" + rowId).after(html);

        }

        function change_adsOn_unit(rowId) {
            var total_price = $('#adsOn-item-total').children().eq(2).html() * 1;
            var original_price = $('#adsOn-item-row' + rowId).children().eq(3).html() * 1;
            var price_per_unit = $('#adsOn-item-row' + rowId).children().eq(1).find('input').val();
            var quantity = $('#adsOn-item-row' + rowId).children().eq(2).find('input').val();
            var addon_row_price = Math.round(quantity * price_per_unit * 100) / 100
            if (price_per_unit < 0) {
                $('#adsOn-item-row' + rowId).children().eq(1).find('input').val('');
                $('#adsOn-item-row' + rowId).children().eq(1).find('input').focus();
                showNotification('Price per unit must be bigger than 0');
                return;
            }
            if (quantity != '' && price_per_unit != '') {
                $('#adsOn-item-row' + rowId).children().eq(3).html(addon_row_price);
                $('#adsOn-item-total').children().eq(2).html(Math.round((total_price - original_price + addon_row_price) * 100) / 100)
            }
            if (status == 'New') {
                $('#final_quote_table').find('tr').eq(4).children().eq(1).html(Math.round((total_price - original_price + addon_row_price) * 100) / 100);
                calculate_sale_table();
            }
        }

        function change_adsOn_quantity(rowId) {
            var total_price = $('#adsOn-item-total').children().eq(2).html() * 1;
            var original_price = $('#adsOn-item-row' + rowId).children().eq(3).html() * 1;
            var price_per_unit = $('#adsOn-item-row' + rowId).children().eq(1).find('input').val();
            var quantity = $('#adsOn-item-row' + rowId).children().eq(2).find('input').val();
            var total_quantity = $('#adsOn-item-total').children().eq(1).html() * 1;
            var original_quantity = event.target.oldvalue * 1;
            var addon_row_price = Math.round(quantity * price_per_unit * 100) / 100
            if (quantity < 0) {
                $('#adsOn-item-row' + rowId).children().eq(2).find('input').val('');
                $('#adsOn-item-row' + rowId).children().eq(2).find('input').focus();
                showNotification('Quantity must be bigger than 0');
                return;
            }
            if (quantity != '' && price_per_unit != '') {
                $('#adsOn-item-row' + rowId).children().eq(3).html(addon_row_price);
                $('#adsOn-item-total').children().eq(2).html(Math.round((total_price - original_price + addon_row_price) * 100) / 100)
            }
            $('#adsOn-item-total').children().eq(1).html(Math.round((total_quantity - original_quantity + quantity * 1) * 100) / 100);
            if (status == 'New') {
                $('#final_quote_table').find('tr').eq(4).children().eq(1).html(Math.round((total_price - original_price + addon_row_price) * 100) / 100);
                calculate_sale_table();
            }
        }


        function delete_adsOn_item(rowId) {
            var total_price = $('#adsOn-item-total').children().eq(2).html() * 1;
            var original_price = $('#adsOn-item-row' + rowId).children().eq(3).html() * 1;
            $('#adsOn-item-total').children().eq(2).html(Math.round((total_price - original_price) * 100) / 100);
            var total_quantity = $('#adsOn-item-total').children().eq(1).html() * 1;
            var original_quantity = $('#adsOn-item-row' + rowId).children().eq(2).find('input').val() * 1;
            $('#adsOn-item-total').children().eq(1).html(Math.round((total_quantity - original_quantity) * 100) / 100);

            $("#adsOn-item-row" + rowId).remove();
            if (status == 'New') {
                $('#final_quote_table').find('tr').eq(4).children().eq(1).html(Math.round((total_price - original_price) * 100) / 100);
                calculate_sale_table();
            }
        }


        function toogle_adsOn_item(obj) {

            if ($(obj).hasClass("fa-angle-up")) {
                $(obj).removeClass("fa-angle-up");
                $(obj).addClass("fa-angle-down");
                $(".adsOn-item").slideUp();
            } else {
                $(obj).removeClass("fa-angle-down");
                $(obj).addClass("fa-angle-up");
                $(".adsOn-item").slideDown();
            }
        }

        function save_new_quote() {
            $('#quoteForm').attr('target', '_self');
            $('#action').val('save_new_quote');
            $('#quoteForm').submit();
        }

        function submit_new_quote() {
            $('#quoteForm').attr('target', '_self');
            $('#action').val('submit_new_quote');
            $('#quoteForm').submit();
        }

        function reject_pending_quote() {
            $('#quoteForm').attr('target', '_self');
            $('#action').val('reject_pending_quote');
            $('#quoteForm').submit();
        }

        function save_pending_quote() {
            $('#quoteForm').attr('target', '_self');
            $('#action').val('save_pending_quote');
            $('#quoteForm').submit();
        }

        function submit_pending_quote() {
            $('#quoteForm').attr('target', '_self');
            $('#action').val('submit_pending_quote');
            if (!$("#ia_signed").is(':checked') || !$("#form_signed").is(':checked') || !$('#credit_passed').is(':checked')) {
                showNotification('Customer must pass credit check and sign both IA and Quote form in order to proceed to the job');
                $('#ia_signed').focus();
                return;
            } else {
                $('#quoteForm').submit();
            }
            $('#quoteForm').submit();

        }

        function reject_approved_quote() {
            $('#quoteForm').attr('target', '_self');
            $('#action').val('reject_approved_quote');
            $('#quoteForm').submit();
        }

        function create_job() {
            $('#quoteForm').attr('target', '_self');
            $('#action').val('create_job');
            if (!$("#ia_signed").is(':checked') || !$("#form_signed").is(':checked') || !$('#credit_passed').is(':checked')) {
                showNotification('Customer must pass credit check and sign both IA and Quote form in order to proceed to the job');
                $('#ia_signed').focus();
                return;
            } else {
                $('#quoteForm').submit();
            }
        }

        function generate_form() {
            $('#action').val('generate_form');
            $('#quoteForm').attr('target', '_blank');
            $('#quoteForm').submit();
        }

        function save_quote() {
            $('#quoteForm').attr('target', '_self');
            if (!$("#ia_signed").is(':checked') || !$("#form_signed").is(':checked')) {
                showNotification('Customer must sign both IA and Quote form in order to proceed to the job');
                $('#ia_signed').focus();
                return;
            } else {
                $('#quoteForm').submit();
            }
        }
    </script>