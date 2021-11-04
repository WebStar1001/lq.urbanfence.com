<html>
<head>
    <style type='text/css'>
        body {
            background-color: #CCD9F9;
            font-family: Verdana, Geneva, sans-serif
        }

        h3 {
            color: #4C628D
        }

        p {
            font-weight: bold
        }
    </style>
</head>
<body>

<h3>Hello <?php echo $oppor->sale_rep; ?>,</h3>

<h3>You have a new opportunity assigned to you:</h3>

<p>Opportunity ID - <?php echo $oppor->id; ?></p>

<p>Customer - <?php echo $oppor->customer_name; ?></p>

<p>Job Type - <?php echo $oppor->job_type; ?></p>

<h3>Please log in to the system to find more details:</h3>

<a href="<?php echo base_url() . 'Opportunity/opportunity_list'; ?>"><?php echo base_url() . 'Opportunity/opportunity_list'; ?>
    <a/>

</body>
</html>