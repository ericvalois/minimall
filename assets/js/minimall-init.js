document.getElementById("main_nav_toggle").addEventListener("click", function () {

    var main_nav = document.getElementById("masthead");
    
    if (main_nav.classList.contains("open")) {
        main_nav.classList.remove("open");
    } else {
        main_nav.classList.add("open");
    }
});

var sub_menu_toggle = function ( event ) {

    var toggle = event.target.nextSibling;
    var button = event.target;

    if (toggle.classList.contains("open")) {
        toggle.classList.remove("open");
        button.classList.remove("menu-open");
        
    } else {
        toggle.classList.add("open");
        button.classList.add("menu-open");
    }

};

var sub_menu_btn = document.querySelectorAll(".sub-menu-toggle");
for (var i = 0; i < sub_menu_btn.length; i++) {
  sub_menu_btn[i].addEventListener( 'click', sub_menu_toggle, false );
}

// Sticky menu
/*
document.addEventListener("touchmove", stop_toggleHeaderFloating, false);
document.addEventListener("scroll", stop_toggleHeaderFloating, false);

var rafTimer;
function stop_toggleHeaderFloating(event) {
  cancelAnimationFrame(rafTimer);
  rafTimer = requestAnimationFrame(toggleHeaderFloating);
}

var main_nav = document.getElementById("masthead");
function toggleHeaderFloating() {
  if (window.scrollY > 80) {
    main_nav.classList.add("active");
  } else {
    main_nav.classList.remove("active");
  }
}*/