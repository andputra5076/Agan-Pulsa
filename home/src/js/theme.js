
(function () {
  "use strict";

  /**
   * ------------------------------------------------------------------------
   * Variables
   * ------------------------------------------------------------------------
   */
  const navi = document.querySelector(".fixed-top");
  if ( navi != null) {
    var header_offset =90;
  } else {
    var header_offset = 0;
  }

  /**
   * ------------------------------------------------------------------------
   * Functions
   * ------------------------------------------------------------------------
   */

  // AOS JS
  const myAos = function () {
    AOS.init({
      offset: 100,
      duration:700,
      easing:"ease-out-quad",
      once:!0
    });
    window.addEventListener('load', AOS.refresh);
  }

  // Jarallax
  const myJarallax = function () {
    jarallax(document.querySelectorAll('.jarallax'), {
      speed: 0.2
    });
  }

  // Typed Js
  const myTyped = function () {
    var x = document.querySelectorAll('[data-toggle="typed"]');
    "undefined"!=typeof Typed&&x&&[]
    .forEach.call( x, function(x){
      !function(x){
        var typo = x.dataset.options;
        typo = typo?JSON.parse(typo):{};
        var object = Object.assign({
          typeSpeed:100,
          backSpeed:100,
          backDelay:1e3,
          loop:!0
        },typo);
        new Typed(x,object)
      }(x)
    });
  }
  
  // Counter js
  const myCounters = function () {
    var counterUp = window.counterUp["default"]; // import counterUp from "counterup2"
    var el = document.querySelectorAll(".counter");
    var _loop = function _loop(i) {
      new Waypoint({
        element: el[i],
        handler: function handler() {
          counterUp(el[i], {
            duration: 2000,
            delay: 20
          });
          this.destroy();
        },
        offset: "bottom-in-view"
      });
    };

    for (var i = 0; i < el.length; i++) {
      _loop(i);
    }
    
    // refresh waypoint 
    var way_id = document.querySelectorAll('.way-refresh');
    if ( way_id != null) {
      var _loop = function _loop(c) {
        document.addEventListener('scroll', function(e) {
          if (window.scrollY >= way_id[c].getBoundingClientRect().top) {
            Waypoint.refreshAll();
          }
        });
      }
      for (var c = 0; c < way_id.length; c++) {
        _loop(c);
      }
    }
  }
  
  // Isotope Filter
  const myIsotope_filter = function () {
    window.addEventListener('load', function () {
      var oe = document.querySelector('.grid');
      if ( oe !=null) {
        var iso = new Isotope( '.grid', {
          itemSelector: '.portfolio-item',
          layoutMode: 'fitRows'
        });

        // hash of functions that match data-filter values
        var filterFns = {
          // show if number is greater than 50
          numberGreaterThan50: function( itemElem ) {
            // use itemElem argument for item element
            var number = itemElem.querySelector('.number').textContent;
            return parseInt( number, 10 ) > 50;
          },
          // show if name ends with -ium
          ium: function( itemElem ) {
            var number = itemElem.querySelector('.name').textContent;
            return name.match( /ium$/ );
          }
        };

        // bind filter button click
        var filtersElem = document.querySelector('.filters-button-group');
        filtersElem.addEventListener( 'click', function( event ) {
          // only work with buttons
          if ( !matchesSelector( event.target, 'button' ) ) {
            return;
          }
          var filterValue = event.target.getAttribute('data-filter');
          // use matching filter function
          filterValue = filterFns[ filterValue ] || filterValue;
          iso.arrange({ filter: filterValue });
        });

        // change is-checked class on buttons
        var buttonGroups = document.querySelectorAll('.button-group');
        for ( var i=0, len = buttonGroups.length; i < len; i++ ) {
          var buttonGroup = buttonGroups[i];
          radioButtonGroup( buttonGroup );
        }

        function radioButtonGroup( buttonGroup ) {
          buttonGroup.addEventListener( 'click', function( event ) {
            // only work with buttons
            if ( !matchesSelector( event.target, 'button' ) ) {
              return;
            }
            buttonGroup.querySelector('.active').classList.remove('active');
            event.target.classList.add('active');
          });
        }

      }
    });
  }
  
  // Light Gallery
  const myLightgallery = function () {
    // Call lightgallery
    var lgt = document.querySelectorAll('.lightgallery-thumbnail');
    if ( lgt != null) {
      var _loop = function _loop(x) {
        lightGallery( lgt[x], {
          thumbnail:true,
          animateThumb: false,
          showThumbByDefault: false
        });
      }
      for (var x = 0; x < lgt.length; x++) {
        _loop(x);
      }
    }

    // Call lightgallery with slider
    var lgs = document.querySelectorAll('.lightgallery-slider');
    if ( lgs != null) {
      var _loop = function _loop(y) {
        lightGallery( lgs[y], {
          selector: '.slider-item',
          thumbnail:true,
          animateThumb: false,
          showThumbByDefault: false
        });
      }
      for (var y = 0; y < lgs.length; y++) {
        _loop(y);
      }
    }
  }

  // Smooth Scroll Anchor
  const mySmooth = function () {
    var scroll = new SmoothScroll('a[href*="#"]', {
      offset : header_offset,
      speed: 1200,
      speedAsDuration: true
    });
  }

  // progress bar top
  const myProgress = function () {
    var xy = document.querySelector(".progress-one, .progress-two, .progress-three");

    function myFunction() {
      var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
      var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
      var scrolled = (winScroll / height) * 100;
      document.querySelector(".progress-one, .progress-two, .progress-three").setAttribute("value", scrolled);
    }
  
    if ( xy != null) {
      window.addEventListener('load', function () {
        myFunction()
      });
      window.addEventListener('scroll', function () {
        myFunction()
      });
    }
  }

  // Progress Bar
  const myProgressBar = function () {

    // progress line
    const progressLine = function progressLine() {
      var el = document.querySelectorAll(".progress-line-trigger");
      var _loopz = function _loopz(x) {
        new Waypoint({
          element: el[x],
          offset: "bottom-in-view",
          handler: function handler() {
            var pBar = document.querySelectorAll(".progress-bar");

            var _loop = function _loop(i) {
              var percent = Number(pBar[i].getAttribute("data-percent"));
              var counter = 1;
              var id = setInterval(frame, 20);

              function frame() {
                if (counter >= percent) {
                  clearInterval(id);
                  
                } else {
                  counter += percent / 100;
                  pBar[i].style.width = percent + "%";
                  pBar[i].setAttribute("data-percent", Math.floor(counter));
                }
              }
            };

            for (var i = 0; i < pBar.length; i++) {
              _loop(i);
            }

            this.destroy();
          }
        });
      };

      for (var x = 0; x < el.length; x++) {
        _loopz(x);
      }
    }; 

    // progress vertical
    const progressVertical = function progressVertical() {
      var el = document.querySelectorAll(".progress-vertical-trigger");
      var _loopz = function _loopz(x) {
        new Waypoint({
          element: el[x],
          offset: "bottom-in-view",
          handler: function handler() {
            var pBar = document.querySelectorAll(".progress-vertical-line");

            var _loop2 = function _loop2(i) {
              var percent = Number(pBar[i].getAttribute("data-percent"));
              var counter = 1;
              var id = setInterval(frame, 20);

              function frame() {
                if (counter >= percent) {
                  clearInterval(id);
                } else {
                  counter += percent / 100;
                  pBar[i].style.height = percent + "%";
                  pBar[i].classList.add("text-white");
                  pBar[i].setAttribute("data-percent", Math.floor(counter));
                }
              }
            };

            for (var i = 0; i < pBar.length; i++) {
              _loop2(i);
            }

            this.destroy();
          }
        });
      };

      for (var x = 0; x < el.length; x++) {
        _loopz(x);
      }
    };
    
    // if this progress id available
    window.addEventListener('load', function () {
      var ab = document.querySelector(".progress-line-trigger");
      var cd = document.querySelector(".progress-vertical-trigger");
      if ( ab != null) {
        progressLine();
      }
      if ( cd != null) {
        progressVertical();
      }
    });
  }
  
  // Back to top button
  const myBacktotop = function () {
    // browser window scroll 
    var offset = 300,
      offset_opacity = 1200,
      back_to_top = document.querySelector(".back-top"),
      scrollpos = window.scrollY;

    var add_class_back_scroll = function add_class_back_scroll() {
      return back_to_top.classList.add("backtop-is-visible");
    };

    var add_class_offset_scroll = function add_class_offset_scroll() {
      return back_to_top.classList.add("backtop-fade-out");
    };

    var remove_class_back_scroll = function remove_class_back_scroll() {
      return back_to_top.classList.remove("backtop-is-visible","backtop-fade-out");
    };

    window.addEventListener('scroll', function () {
      scrollpos = window.scrollY;
      if (scrollpos > offset) {
        add_class_back_scroll();
      } else {
        remove_class_back_scroll();
      }
      if (scrollpos > offset_opacity) {
        add_class_offset_scroll();
      }
    });
  }
  
  // Navbar if scroll down
  const myNavigation = function () {
    var scrollpos = document.body.scrollTop || document.documentElement.scrollTop;
    var nav_dark = document.querySelector(".dark-to-light");
    var nav_light = document.querySelector(".light-to-dark");
    var nav_one = document.querySelector(".main-nav");

    // navbar on scroll
    var add_class_on_scroll = function add_class_on_scroll() {
      return nav_dark.classList.add("navbar-scrolled","navbar-light-dark"),
            nav_dark.classList.remove("navbar-dark");
    };
    var remove_class_on_scroll = function remove_class_on_scroll() {
      return nav_dark.classList.remove("navbar-scrolled","navbar-light-dark"),
             nav_dark.classList.add("navbar-dark");
    };
    var add_class_on_scroll2 = function add_class_on_scroll2() {
      return nav_light.classList.add("navbar-scrolled","navbar-dark-light"),
            nav_light.classList.remove("navbar-light");
    };
    var remove_class_on_scroll2 = function remove_class_on_scroll2() {
      return nav_light.classList.remove("navbar-scrolled","navbar-dark-light"),
             nav_light.classList.add("navbar-light");
    };
    var add_class_on_scroll3 = function add_class_on_scroll3() {
      return nav_one.classList.add("navbar-scrolled");
    };
    var remove_class_on_scroll3 = function remove_class_on_scroll3() {
      return nav_one.classList.remove("navbar-scrolled");
    };

    var navCustom = function navCustom() {
      if ( nav_dark !=null) {
        var nav_dark_height = nav_dark.offsetHeight;
      } else {
        var nav_dark_height = header_offset;
      }
      scrollpos = document.body.scrollTop || document.documentElement.scrollTop;
      if (scrollpos >= nav_dark_height) {
        add_class_on_scroll();
      } else {
        remove_class_on_scroll();
      }
    }

    var navCustom2 = function navCustom2() {
      if ( nav_light !=null) {
        var nav_light_height = nav_light.offsetHeight;
      } else {
        var nav_light_height = header_offset;
      }
      scrollpos = document.body.scrollTop || document.documentElement.scrollTop;
      if (scrollpos >= nav_light_height) {
        add_class_on_scroll2();
      } else {
        remove_class_on_scroll2();
      }
    }

    var navCustom3 = function navCustom3() {
      if ( nav_one !=null) {
        var nav_one_height = nav_one.offsetHeight;
      } else {
        var nav_one_height = header_offset;
      }
      scrollpos = document.body.scrollTop || document.documentElement.scrollTop;
      if (scrollpos >= nav_one_height) {
        add_class_on_scroll3();
      } else {
        remove_class_on_scroll3();
      }
    }
    
    if ( nav_dark !=null) {
      // if nav start not in top and not scroll
      window.addEventListener('load', function () {
        navCustom();
      });

      // if nav scroll
      window.addEventListener('scroll', function () {
        navCustom();
      });
    } else if ( nav_light !=null) {
      // if nav start not in top and not scroll
      window.addEventListener('load', function () {
        navCustom2();
      });

      // if nav scroll
      window.addEventListener('scroll', function () {
        navCustom2();
      });
    } else if ( nav_one !=null) {
      // if nav start not in top and not scroll
      window.addEventListener('load', function () {
        navCustom3();
      });

      // if nav scroll
      window.addEventListener('scroll', function () {
        navCustom3();
      });
    }
  }

  // Sub Dropdown
  const sub_dropdown_js = function () {
    // submenu
    const onekit_submenu = function onekit_submenu() {
      var onekit_toggle = document.querySelectorAll(".dropdown-menu a.dropdown-toggle");
      var _loop = function _loop(i) {
        onekit_toggle[i].addEventListener("click", function (event) {
          event.stopPropagation();
          event.preventDefault();

          onekit_toggle[i].nextElementSibling.classList.toggle("show");
          onekit_toggle[i].parentNode.classList.toggle("show");
         });
        window.addEventListener("mouseup", function (event) {
          if (event.target != onekit_toggle[i].nextElementSibling && event.target.parentNode != onekit_toggle[i].nextElementSibling && event.target.classList.contains("dropdown-toggle") != true) {
            onekit_toggle[i].nextElementSibling.classList.remove("show");
            onekit_toggle[i].parentNode.classList.remove("show");
          }
        });
      };

      for (var i = 0; i < onekit_toggle.length; i++) {
        _loop(i);
      }
    };

    // close if dropdown click
    const close_all_submenu = function close_all_submenu() {
      var dropdown_x = document.querySelectorAll(".navbar-nav > .dropdown");
      var dropdown_submenu_x = document.querySelectorAll(".dropdown-menu li .dropdown-menu");

      var _loop2 = function _loop2(i) {
        dropdown_x[i].addEventListener('hide.bs.dropdown', function () {
          for (var j = 0; j < dropdown_submenu_x.length; j++) {
            if (i != j) {
              dropdown_submenu_x[j].classList.remove("show");
              dropdown_submenu_x[j].parentNode.classList.remove("show");
            }
          }
        });
      };

      for (var i = 0; i < dropdown_x.length; i++) {
        _loop2(i);
      }
    };

    // close submenu
    const close_submenu = function close_submenu() {
      var dropdown_a = document.querySelectorAll(".navbar-nav > .dropdown > .dropdown-menu > .dropdown-submenu > .dropdown-toggle");
      var dropdownMenu_a = document.querySelectorAll(".navbar-nav > .dropdown > .dropdown-menu > li > .dropdown-menu");
      var dropdownSubMenu_a = document.querySelectorAll(".navbar-nav > .dropdown > .dropdown-menu > li > .dropdown-menu > li > .dropdown-menu");

      var _loop2 = function _loop2(i) {
        dropdown_a[i].addEventListener("click", function () {
          for (var j = 0; j < dropdownMenu_a.length; j++) {
            if (i != j) {
              dropdownMenu_a[j].parentNode.classList.remove("show");
              dropdownMenu_a[j].classList.remove("show");
              if (dropdownSubMenu_a[j] === undefined) {} else {
                dropdownSubMenu_a[j].parentNode.classList.remove("show");
                dropdownSubMenu_a[j].classList.remove("show");
              }
            }
          }
        });
      };

      for (var i = 0; i < dropdown_a.length; i++) {
        _loop2(i);
      }
    }; 

    // close child submenu & dropdown reverse
    const close_child_submenu = function close_child_submenu() {
      var dropdown_b = document.querySelectorAll(".navbar-nav > .dropdown > .dropdown-menu > li > .dropdown-menu > li > .dropdown-toggle");
      var dropdownMenu_b = document.querySelectorAll(".navbar-nav > .dropdown > .dropdown-menu > li > .dropdown-menu > li > .dropdown-menu");

      var _loop3 = function _loop3(i) {
        dropdown_b[i].addEventListener("click", function () {
          for (var j = 0; j < dropdownMenu_b.length; j++) {
            if (i != j) {
              if (dropdownMenu_b[j] === undefined) {} else {
                dropdownMenu_b[j].parentNode.classList.remove("show");
                dropdownMenu_b[j].classList.remove("show");
              }
            }
          }
        });

        // dropdown reverse
        dropdown_b[i].addEventListener("mouseenter", function () {
          for (var j = 0; j < dropdownMenu_b.length; j++) {
            var elm = dropdownMenu_b[j];
            var rect = elm.getBoundingClientRect();
            var l = rect.left;
            var w = elm.offsetWidth;
            var docW = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
            var isEntirelyVisible = l + w;

            if (isEntirelyVisible > docW) {
              elm.classList.add('dropdown-reverse');
            }
          }
        });
      };

      for (var i = 0; i < dropdown_b.length; i++) {
        _loop3(i);
      }
    };

    var ef = document.querySelector(".dropdown-submenu");
    if ( ef != null) {
      onekit_submenu();
      close_all_submenu();
      close_submenu();
      close_child_submenu();
    }
  }
  
  // Switch Price
  const myPricing = function () {
    var x = document.querySelector(".js-checkbox");
    var navSwitch = function navSwitch() {
      if (document.querySelector(".js-checkbox").checked == true) {
        var months = document.querySelectorAll('.js-monthly');
        for (var i = 0; i < months.length; i++) {
            months[i].classList.add('d-none');
            months[i].classList.remove('d-block');
        }
        var years = document.querySelectorAll('.js-yearly');
        for (var i = 0; i < years.length; i++) {
            years[i].classList.add('d-block');
            years[i].classList.remove('d-none');
        }
        var afters = document.querySelectorAll('.afterinput','beforeinput');
        for (var i = 0; i < afters.length; i++) {
            afters[i].classList.add('text-active');
        }
      } else {
        var months = document.querySelectorAll('.js-monthly');
        for (var i = 0; i < months.length; i++) {
            months[i].classList.add('d-block');
            months[i].classList.remove('d-none');
        }
        var years = document.querySelectorAll('.js-yearly');
        for (var i = 0; i < years.length; i++) {
            years[i].classList.add('d-none');
            years[i].classList.remove('d-block');
        }
        var afters = document.querySelectorAll('.afterinput','beforeinput');
        for (var i = 0; i < afters.length; i++) {
            afters[i].classList.add('text-active');
        }
      }
    }
    if ( x !=null) {
      x.addEventListener("change", function() {
        navSwitch();
      });
    }
  }

  // Mobile menu close
  const myMobile = function () {
    var x = document.querySelectorAll(".back-menu");
    if ( x != null) {
      for (var v = 0; v < x.length; v++) {
        x[v].addEventListener("click", function(){
          var y = document.getElementsByClassName("push");
          for (var i = 0; i < y.length; i++) {
            y[i].classList.remove('push-open');
          }

          var b = document.querySelectorAll(".mobile-side");
          for (var i = 0; i < b.length; i++) {
            b[i].classList.remove('sidenav-body-open');
          }
        });
      }
    }
  }

  // Mobile menu open
  const myOpen = function () {
    var x = document.querySelectorAll(".sidebar-menu-trigger");
    if ( x != null) {
      for (var z = 0; z < x.length; z++) {
        x[z].addEventListener("click", function(){
          var y = document.getElementsByClassName("push");
          for (var i = 0; i < y.length; i++) {
              y[i].classList.add('push-open');
          }

          var b = document.querySelectorAll(".mobile-side");
          for (var i = 0; i < b.length; i++) {
              b[i].classList.add('sidenav-body-open');
          }
        });
      }
    }
  }

  // Preloader
  const myPreloader = function () {
    var xpre = document.querySelector(".preloader");
    if ( xpre != null) {
      window.addEventListener('load',function(){
        document.querySelector('body').classList.add("loaded-success")  
      });
    }
  }

  // Lazy load images
  const myLazyload = function () {  
    // lazy load in all
    var lazys = document.querySelector('.lazy');
    if ( lazys !=null) {
      var lazyLoadInstance = new LazyLoad({
        elements_selector: ".lazy",
        callback_reveal: function (el) {
          if ( el.complete && el.naturalWidth !== 0 ) {
            el.classList.remove('loading'),
            el.classList.add('loaded');
          }
        }
      });
      lazyLoadInstance.update();
    }
  }

  // Sticky element
  const mySticky = function () {
    // sticky
    var stickys = document.querySelectorAll('.sticky');
    if ( stickys !=null) {
      for (var i = 0; i < stickys.length; i++) {
        new hcSticky(stickys[i], {
          stickTo: stickys[i].parentNode,
          top: header_offset,
          bottomEnd: 0
        });
      }
    }
  }

  // rotate if scroll
  const myRotate = function () {
    var scroll_el = document.querySelectorAll('.scroll-rotate');

    function scrollRotate() {
      for (var i = 0; i < scroll_el.length; i++) {
        scroll_el[i].style.transform = "rotate(" + window.pageYOffset/2 + "deg)";
      }
    }

    window.onscroll = function () {
      if ( scroll_el !=null) {
        scrollRotate();
      }
    };
  }

  // Bootstrap JS
  const myBootstrap = function () {
    // Tooltip
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    if ( tooltipTriggerList != null) {
      tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
      });
    }

    // validation
    const formsx = document.querySelectorAll('.needs-validation')
    if ( formsx != null) {
      // Loop over them and prevent submission
      Array.prototype.slice.call(formsx)
      .forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }

          form.classList.add('was-validated')
        }, false)
      });
    }

    // popovers
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    if ( popoverTriggerList != null) {
      popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
      });
    }

    const toastElList = [].slice.call(document.querySelectorAll('.toast'));
    if ( toastElList != null) {
      toastElList.map(function (toastEl) {
        return new bootstrap.Toast(toastEl, option)
      });
    }
  }

  // Custom JS
  const myCustom = function () {
    
    // insert your javascript in here

  }

  /**
   * ------------------------------------------------------------------------
   * Launch Functions
   * ------------------------------------------------------------------------
   */
   
  myJarallax();
  myAos();
  myTyped();
  myCounters();
  myIsotope_filter();
  myLightgallery();
  mySmooth();
  myProgress();
  myProgressBar();
  myBacktotop();
  myNavigation();
  sub_dropdown_js();
  myPricing();
  myMobile();
  myOpen();
  myPreloader();
  mySticky();
  myLazyload();
  myRotate();
  myBootstrap();
  myCustom();

})();