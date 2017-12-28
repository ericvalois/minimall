window.addEventListener("load", function() {

    // store tabs variable
    var myTabs = document.querySelectorAll(".minimall-tabs a");

    function myTabClicks(tabClickEvent) {

        for (var i = 0; i < myTabs.length; i++) {
            myTabs[i].classList.remove("active");
        }

        var clickedTab = tabClickEvent.currentTarget; 

        clickedTab.classList.add("active");

        tabClickEvent.preventDefault();

        // Change URL
        var tab_url = jQuery(this).attr("data-tab");
        window.history.pushState(null, null, tab_url);

        var myContentPanes = document.querySelectorAll(".tab-pane");

        for (i = 0; i < myContentPanes.length; i++) {
            myContentPanes[i].classList.remove("active");
        }

        var anchorReference = tabClickEvent.target;
        var activePaneId = anchorReference.getAttribute("href");
        var activePane = document.querySelector(activePaneId);

        activePane.classList.add("active");

    }

    for (i = 0; i < myTabs.length; i++) {
        myTabs[i].addEventListener("click", myTabClicks)
    }
});

// Detect open tab
if( window.location.hash ) {
    // Open the right tab
    var active_tab = jQuery( '.minimall-tabs a[data-tab="'+ window.location.hash + '"]' ).first();
    var active_panel = jQuery( '.minimall-tabs a[data-tab="'+ window.location.hash + '"]' ).first().attr('href');

    if( active_tab ){
        // Reset Tabs
        jQuery('.minimall-tabs a').removeClass("active");

        // Set the right tab
        active_tab.addClass('active');

        // Reset panel
        jQuery('.tab-pane').removeClass("active");
        
        // Set the right panel
        jQuery(active_panel).addClass('active');
    }
}