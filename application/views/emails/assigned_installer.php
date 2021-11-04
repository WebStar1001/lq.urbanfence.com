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

<h3>Hello <?php echo $installer; ?>,</h3>

<h3>You have a new job assigned to you:</h3>

<p>Job ID - <?php echo $job_id; ?></p>

<p>Customer - <?php echo $customer; ?></p>

<p>Job Type - <?php echo $job_type; ?></p>

<h3>Please log in to the system to find more details:</h3>

<a href="<?php echo base_url() . 'Jobs/job_detail?job_id=' . $job_id; ?>"><?php echo base_url() . 'Jobs/job_detail?job_id=' . $job_id; ?>
    <a/>

</body>
</html>