<!DOCTYPE html>
<html lang="en">
<!-- BEGIN: Head -->
<head>
    <meta charset="utf-8">
    <link href="<?php echo base_url(); ?>assets/images/logo.png?>" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords"
          content="admin template, Midone admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    <title>Urbanfence</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/app.css"/>
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.5.1.js"></script>

    <!-- datatable error show on console: -->
    <!--  <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/
     jquery.dataTables.min.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/js/dataTables.min.js"></script>

    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>


    <style type="text/css">
        /*::-webkit-scrollbar {*/
        /*    width: 10px !important;*/
        /*}*/

        /* Track */
        /*::-webkit-scrollbar-track {*/
        /*    box-shadow: inset 0 0 5px grey;*/
        /*    border-radius: 10px;*/
        /*}*/

        /*!* Handle *!*/
        /*::-webkit-scrollbar-thumb {*/
        /*    background: #dee7ef;*/
        /*    border-radius: 10px;*/
        /*}*/

        /*scroll close*/

        td.details-control {
            background: url('<?php echo base_url("/assets/images/plus.png")?>') no-repeat center center;
            cursor: pointer;
        }

        tr.shown td.details-control {
            background: url('<?php echo base_url("/assets/images/up.png")?>') no-repeat center center;
            cursor: pointer;
            background-size: 20px 20px;
        }

        table td select {
            height: 30px;
        }

        p {
            color: #2d3748;
        }

        div#table_main_div {
            display: grid;
        }

        .fieldset_bd_color {
            border: 2px solid !important;
            border-color: #1C3FAA !important;
        }

        .legend_spacing {
            letter-spacing: 2px;
            font-weight: bold;
            padding: 2% !important;
        }

        .quote_legend_spacing {
            letter-spacing: 2px;
            font-weight: bold;
            padding: 1% !important;
        }
    </style>
    <script type="text/javascript">
        var is_admin = <?php echo is_admin() ? 1 : 0?>;
        var is_manager = <?php echo is_manager() ? 1 : 0?>;
        var is_sale = <?php echo is_sale() ? 1 : 0?>;
        var is_user = <?php echo is_user() ? 1 : 0?>;
    </script>
</head>


<body class="app">

<?php include(APPPATH . "views/inc/sidebar_nav_mobile.php") ?>
<div class="flex">
    <?php include(APPPATH . "views/inc/sidebar_nav.php") ?>
    
