$(function () {
    $(".material-item,.labour-item,.miscellaneous-item,.adsOn-item").slideUp(1);
});
$('#quoteForm').keypress(function (e) {
    var key = e.charCode || e.keyCode || 0;
    if (key == 13) {
        e.preventDefault();
    }
})


var currentTab = 0; // Current tab is set to be the first tab (0)

showTab(currentTab); // Display the current tab

function showTab(n) {
    // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    //... and fix the Previous/Next buttons:
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
        $("#nextBtn").removeClass('bg-gray-100 cursor-not-allowed').removeAttr('disabled');
        document.getElementById("nextBtn").innerHTML = "Create Job"
        document.getElementById("nextBtn").setAttribute("onclick", "save_quote()");

    } else {

        if (n == 1) {
            document.getElementById("nextBtn").innerHTML = "Next";
            if ($("#credit-passed").is(':checked')) {
                $("#nextBtn").removeClass('bg-gray-100 cursor-not-allowed').removeAttr('disabled');
            } else {
                $("#nextBtn").addClass('bg-gray-100 cursor-not-allowed quote-approval-btn').prop("disabled", true);
            }
            // $('#materials').find('tr').each(function () {
            //     var mat_rowId = $(this).attr('id');
            //     if (mat_rowId != 'material_thead' && mat_rowId != 'material-item-row0' && mat_rowId != 'material-item-total'){
            //         // $('#mat_modal_tbody').html('<tr>' +
            //         //     '<td></td>')
            //     }
            //         console.log($(this).attr('id'));
            // });

        } else {
            $("#nextBtn").removeClass('bg-gray-100 cursor-not-allowed').removeAttr('disabled');
            document.getElementById("nextBtn").innerHTML = "Next";
        }

        $("#nextBtn").attr("onclick", "nextPrev(1)");
    }
    //... and run a function that will display the correct step indicator:
    fixStepIndicator(n)
}

function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form...
    if (currentTab >= x.length) {

        //window.location.replace("/urbanfence/Jobs/jobs_list");
        /*document.getElementById("regForm").submit()*/
        ;

        return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
}

function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class on the current step:
    x[n].className += " active";
}

$(".set_markup").click(function () {
    let markup_type = $(this).val();
    if (markup_type == "total_markup") {
        $(".input-total-markup").removeClass('bg-gray-100 cursor-not-allowed').removeAttr('disabled');
        $(".input-multiple-markup").addClass('bg-gray-100 cursor-not-allowed').prop("disabled", true);
    } else {
        $(".input-multiple-markup").removeClass('bg-gray-100 cursor-not-allowed').removeAttr('disabled');
        $(".input-total-markup").addClass('bg-gray-100 cursor-not-allowed').prop("disabled", true);
    }
});

$(".add-discount").keyup(function () {
    let discount = $(this).val();
    $(".discount-row,.sub-total2").remove();
    let html = '';
    if (discount) {
        html += `<tr class="discount-row">
                <td class="border-b">Discount</td>
                <td class="border-b">` + discount + `%</td>
                <td class="border-b">4725</td>
                <td class="border-b">3150</td>
            </tr>
            <tr class="sub-total2">
                <td class="border-b">Sub Total 2</td>
                <td class="border-b">15750</td>
                <td class="border-b">18900</td>
                <td class="border-b">3150</td>
            </tr>
            `;
        $(".sub-total1").after(html);
    }

});


$('#credit-passed').click(function () {
    if ($(this).is(':checked')) {
        $(".quote-approval-btn").removeClass('bg-gray-100 cursor-not-allowed').removeAttr('disabled');

    } else {

        $(".quote-approval-btn").addClass('bg-gray-100 cursor-not-allowed').prop("disabled", true);
    }
});


function add_material_item() {

    let html = '';
    let rowId = parseInt($(".material-item").last().attr("row"));
    let nextRow = rowId + 1;
    var firstCatalog = '';
    var catalogOptions = '';
    var matOptions = '';
    var price_per_unit = '';
    for (var i in catalogs) {
        if (i == 0)
            firstCatalog = catalogs[i].product_category;
        catalogOptions += '<option value="' + catalogs[i].product_category + '">' + catalogs[i].product_category + '</option>'
    }
    for (var j in catalogs) {
        if (j == 0) {
            price_per_unit = catalogs[j].price_per_unit_tender;
        }
        if (catalogs[j].product_category == firstCatalog) {
            matOptions += '<option value="' + catalogs[j].mat_code + '">' + catalogs[j].mat_code + '</option>'
        }
    }
    html += `<tr id="material-item-row` + nextRow + `" row="` + nextRow + `" class="intro-x material-item">
                                        <td class="w-40">
                                            <div class="flex">
                                                <select class="input border mr-2" name="material_category[]" onchange="get_cate_code(` + nextRow + `)">
                                                    ` + catalogOptions + `
                                                </select>
                                            </div>
                                        </td>

                                        <td class="w-40">
                                            <div class="flex">
                                                <select class="input border mr-2" name="material_code[]" onchange="chage_mat_code(` + nextRow + `)">
                                                    ` + matOptions + `
                                                </select>
                                            </div>
                                        </td>
                                        <td class="text-center">` + price_per_unit + `</td>
                                        <td class="text-center"><input type="number" name="mat_quantity[]" placeholder="" onchange="change_mat_quantity(` + nextRow + `)"></td>
                                        <td class="text-center"></td>
                                        <td class="table-report__action w-56">
                                            <div class="flex justify-center items-center">

                                              <a style="background-color:unset;border:unset" class="flex items-center mr-3" onclick="delete_material_item(` + nextRow + `)" href="javascript:;" ><i style="font-size: 20px;
    color: red;" class="fa fa-trash" aria-hidden="true"></i></a>
                                            </div>
                                        </td>
                                    </tr>`;
    $("#material-item-row" + rowId).after(html);


}

function get_cate_code(rowId) {
    var selectedCatalog = event.target.value;
    var matOptions = '';
    var price_per_unit = '';
    var first = 0;
    for (var j in catalogs) {
        if (catalogs[j].product_category == selectedCatalog) {
            if (first == 0)
                price_per_unit = catalogs[j].price_per_unit_tender;

            matOptions += '<option value="' + catalogs[j].mat_code + '">' + catalogs[j].mat_code + '</option>';
            first++;
        }
    }
    $('#material-item-row' + rowId).children().eq(1).find('select').html(matOptions);
    $('#material-item-row' + rowId).children().eq(2).html(price_per_unit);
    var quantity = $('#material-item-row' + rowId).children().eq(3).find('input').val();
    if (quantity != '') {
        $('#material-item-row' + rowId).children().eq(4).html(quantity * price_per_unit);
    }
}

function change_mat_code(rowId) {
    var selected_category = $('#material-item-row' + rowId).children().eq(0).find('select').val();
    var selected_mat_code = $('#material-item-row' + rowId).children().eq(1).find('select').val();
    var price_per_unit = '';
    for (var j in catalogs) {
        if (catalogs[j].product_category == selected_category) {
            if (catalogs[j].mat_code == selected_mat_code)
                price_per_unit = catalogs[j].price_per_unit_tender;
        }
    }
    $('#material-item-row' + rowId).children().eq(2).html(price_per_unit);
    var quantity = $('#material-item-row' + rowId).children().eq(3).find('input').val();
    if (quantity != '') {
        $('#material-item-row' + rowId).children().eq(4).html(quantity * price_per_unit);
    }
}

function change_mat_quantity(rowId) {
    var price_per_unit = $('#material-item-row' + rowId).children().eq(2).html();
    var quantity = $('#material-item-row' + rowId).children().eq(3).find('input').val();
    if (quantity != '' && price_per_unit != '') {
        $('#material-item-row' + rowId).children().eq(4).html(quantity * price_per_unit);
    }
}

function delete_material_item(rowId) {
    $("#material-item-row" + rowId).remove();
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
    html += `<tr id="labour-item-row` + nextRow + `" row="` + nextRow + `" class="intro-x labour-item">
                                       <td class="w-40">
                                           <div class="flex">
                                               <select class="input border mr-2" name="labor_desc[]">
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
                                               </select>
                                           </div>
                                       </td>

                                       <td class="text-center"><input type="number" name="labor_quantity[]" ></td>
                                       <td></td>
                                       <td class="table-report__action w-56">
                                           <div class="flex justify-center items-center">

                                              <a style="background-color:unset;border:unset" class="flex items-center mr-3" onclick="delete_labour_item(` + nextRow + `)" href="javascript:;" ><i style="font-size: 20px;
    color: red;" class="fa fa-trash" aria-hidden="true"></i></a>
                                            </div>
                                       </td>
                                   </tr>`;
    $("#labour-item-row" + rowId).after(html);

}


function delete_labour_item(rowId) {
    $("#labour-item-row" + rowId).remove();
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
                                       <td class="w-40 text-center">` + nextRow + `</td>
                                       <td class="text-center"><input type="text" name="misc_desc[]" placeholder="" value=""></td>
                                       <td class="text-center"><input type="number" name="misc_unit_price[]" placeholder="" onchange="set_mis_price(` + nextRow + `)"></td>
                                       <td class="text-center"><input type="number" name="misc_quantity[]" placeholder="" onchange="set_mis_price(` + nextRow + `)"></td>
                                       <td class="text-center"><label></label></td>
                                       <td class="table-report__action w-56">
                                           <div class="flex justify-center items-center">
                                              <a style="background-color:unset;border:unset" class="flex items-center mr-3" onclick="delete_miscellaneous_item(` + nextRow + `)" href="javascript:;" ><i style="font-size: 20px;
    color: red;" class="fa fa-trash" aria-hidden="true"></i></a>
                                            </div>
                                       </td>
                                   </tr>`;
    $("#miscellaneous-item-row" + rowId).after(html);

}

function set_mis_price(rowId) {
    var price_per_unit = $('#miscellaneous-item-row' + rowId).children().eq(2).find('input').val();
    var quantity = $('#miscellaneous-item-row' + rowId).children().eq(3).find('input').val();
    if (quantity != '' && price_per_unit != '') {
        $('#miscellaneous-item-row' + rowId).children().eq(4).html(quantity * price_per_unit);
    }
}

function delete_miscellaneous_item(rowId) {
    $("#miscellaneous-item-row" + rowId).remove();
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
                                       <td class="text-center"><input type="number" name="addon_unit_price[]" placeholder="" onchange="set_adsOn_price(` + nextRow + `)"></td>
                                       <td class="text-center"><input type="number" name="addon_quantity[]" placeholder="" onchange="set_adsOn_price(` + nextRow + `)"></td>
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

function set_adsOn_price(rowId) {
    var price_per_unit = $('#adsOn-item-row' + rowId).children().eq(1).find('input').val();
    var quantity = $('#adsOn-item-row' + rowId).children().eq(2).find('input').val();
    if (quantity != '' && price_per_unit != '') {
        $('#adsOn-item-row' + rowId).children().eq(3).html(quantity * price_per_unit);
    }
}


function delete_adsOn_item(rowId) {
    $("#adsOn-item-row" + rowId).remove();
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

function save_quote() {
    $('#quoteForm').submit();
}