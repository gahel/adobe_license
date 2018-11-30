		<div class="col-lg-4 col-md-6">

			<div class="panel panel-default">

				<div class="panel-heading">

					<h3 class="panel-title"><i class="fa fa-lock"></i>
					    <span data-i18n="Adobe License">Adobe License Expiring</span>
					    <list-link data-url="/show/listing/adobe_license/adobe_license"></list-link>
					</h3>

				</div>

				<div class="panel-body text-center">


					<a id="adobe_license-Active2" class="btn btn-success hide">
						<span class="adobe_license-count bigger-150"></span><br>
						<span class="adobe_license-label">Adobe Federated Sign-ins</span>
						<span data-i18n="activeS"></span>
					</a>
					<a id="adobe_license-Disabled" class="btn btn-danger hide">
						<span class="adobe_license-count bigger-150"></span><br>
						<span class="adobe_license-label">Expiring</span>
						<span data-i18n="disabledS"></span>
					</a>

          <span id="adobe_license-nodata" data-i18n="no_clients"></span>

				</div>

			</div><!-- /panel -->

		</div><!-- /col -->

<script>
$(document).on('appUpdate', function(e, lang) {

    $.getJSON( appUrl + '/module/adobe_license/get_license_stats', function( data ) {
	    
	if(data.error){
    		//alert(data.error);
    		return;
    	}

	// Set URLs. TODO - once filtered update this to deep link
	var url = appUrl + '/show/listing/adobe_license/adobe_license'
	$('#adobe_license-Disabled').attr('href', url)
	$('#adobe_license-Active').attr('href', url)

        // Show no clients span
        $('#adobe_license-nodata').removeClass('hide');

        $.each(data.stats, function(prop, val){
            if(val >= 0)
            {
                $('#adobe_license-' + prop).removeClass('hide');
                $('#adobe_license-' + prop + '>span.adobe_license-count').text(val);

                // Hide no clients span
                $('#adobe_license-nodata').addClass('hide');
            }
            else
            {
                $('#adobe_license-' + prop).addClass('hide');
            }
        });
    });
});


</script>
