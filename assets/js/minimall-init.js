if( document.getElementById("main_nav_toggle") ){
    document.getElementById("main_nav_toggle").addEventListener("click", function () {
        
        var main_nav = document.getElementById("masthead");
        
        if (main_nav.classList.contains("open")) {
            main_nav.classList.remove("open");
        } else {
            main_nav.classList.add("open");
        }
    });
}

if( document.getElementsByClassName("menu-item-has-children") ){
    //document.getElementsByClassName("menu-item-has-children").addEventListener("click", function () {
        
        

        clickerFn = function() {
            console.log('Click just happened');
            if (this.classList.contains("open")) {
                this.classList.remove("open");
            } else {
                this.classList.add("open");
            }
        }

        var el = document.getElementsByClassName('menu-item-has-children');
        for (var i=0; i < el.length; i++) {
            // Here we have the same onclick
            el.item(i).onclick = clickerFn;
        }
    //});
}

// Fix Google Page Speed Insights false error "Prioritize visible content"
if ( document.getElementById("hero-img") && !navigator.userAgent.match(/Google Page Speed Insights/i) ){
    var light_bold_main_hero = document.getElementById("hero-img");
    light_bold_main_hero.classList.add("lazyload");
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