</div>
<div class="modal" id="alert-modal">
    <div class="modal__content modal__content--lg p-5 text-center">
        <div class="flex items-center py-5 sm:py-3 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">Notification</h2>
        </div>
        <div class="overflow-x-auto">
            <p>Customer must pass credit check in order to get a quote.</p>
        </div>
        <div class=" py-3 text-right border-t border-gray-200">
            <button data-dismiss="modal" type="button" class="button w-20 bg-theme-6 text-white">OK</button>
        </div>
    </div>
</div>

<!-- BEGIN: JS Assets-->
<script src="<?php echo base_url(); ?>assets/js/app.js"></script>

<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script> <!-- for mobile navbar -->

<link rel="stylesheet" type="text/css"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- END: JS Assets-->
</body>
</html>
<script type="text/javascript">
    function showNotification(message){
        $('#alert-modal').find('p').html(message);
        $('#alert-modal').modal('show');
    }
    function showConfirm(message){
        $('#confirm-modal').find('p').html(message);
        $('#confirm-modal').modal('show');
    }
</script>