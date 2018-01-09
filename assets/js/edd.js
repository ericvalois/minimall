jQuery(document).ready(function($){
	
	$('.minimall-tabs li a').click(function(event){

        event.preventDefault();

        var tab_id = $(this).attr('href');

		$('.minimall-tabs a').removeClass('active');
		$('.tab-pane').removeClass('active');

		$(this).addClass('active');
		$(tab_id).addClass('active');
	})

})
