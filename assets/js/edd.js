jQuery(document).ready(function($){
	
	$('.minimall-tabs a').click(function(event){

        event.preventDefault();

        

        var tab_id = $(this).attr('href');
        
        // Change URL
        window.history.pushState(null, null, tab_id);

		$('.minimall-tabs a').removeClass('active');
		$('.tab-pane').removeClass('active');

		$(this).addClass('active');
		$(tab_id).addClass('active');
	})

})

// Detect open tab
if( window.location.hash ) {
    // Open the right tab
    var active_tab = jQuery( '.minimall-tabs a[data-tab="'+ window.location.hash + '"]' ).first();
    var active_panel = jQuery(window.location.hash);

    
    if( active_tab.length ){
        // Reset Tabs
        jQuery('.minimall-tabs a').removeClass("active");

        // Set the active tab
        active_tab.addClass('active');

        // Reset panel
        jQuery('.tab-pane').removeClass("active");
        
        // Set the active panel
        jQuery(active_panel).addClass('active');
    }
}