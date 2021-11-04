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

<h3>Hello <?php echo $manager; ?>,</h3>

<h3>Please note a new Quote has been submitted for approval in the system:</h3>

<p>Quote ID - <?php echo $quote_id; ?></p>

<p>Customer - <?php echo $customer; ?></p>

<p>Job Type - <?php echo $job_type; ?></p>

<h3>Please log in to the system to find more details:</h3>

<a href="<?php echo base_url() . 'Quotes/quotes_list?status=Pending'; ?>"><?php echo base_url() . 'Quotes/quotes_list?status=Pending'; ?>
    <a/>

</body>
</html>