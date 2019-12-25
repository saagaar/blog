;(function($){
    "use strict"


    var nav_offset_top = $('header').height() + 50; 
/*-------------------------------------------------------------------------------
Navbar 
-------------------------------------------------------------------------------*/

//* Navbar Fixed  
function navbarFixed(){
    if ( $('.header_area').length ){ 
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();   
            if (scroll >= nav_offset_top ) {
                $(".header_area").addClass("navbar_fixed");
            } else {
                $(".header_area").removeClass("navbar_fixed");
            }
        });
    };
};
navbarFixed();





/*----------------------------------------------------*/
/*  Parallax Effect js
/*----------------------------------------------------*/
// function parallaxEffect() {
//     $('.bg-parallax').parallax();
// }
// parallaxEffect();

if(document.getElementById("number-section")){
    $('.counter').counterUp({
        delay: 10,
        time: 1000
    });
}

//------- Owl Carusel  js --------//

$(document).ready(function() {

$('.play-video').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });

// Search Toggle

$("#search").on("click", function () {
  
    // $("#search_input_box").slideToggle();
    // $("#search_input").focus();
});
$("#close_search").on("click", function () {
    $('#search_input_box').slideUp(500);
});

});


// Header scroll class
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('#header').addClass('header-scrolled');
        } else {
            $('#header').removeClass('header-scrolled');
        }
    });

//-------- Counter js --------//
$(window).on("load", function() {

    $('.portfolio-filter ul li').on('click', function () {
        $('.portfolio-filter ul li').removeClass('active');
        $(this).addClass('active');

        var data = $(this).attr('data-filter');
        $workGrid.isotope({
            filter: data
        });
    });

    if (document.getElementById('portfolio')) {
        var $workGrid = $('.portfolio-grid').isotope({
            itemSelector: '.all',
            percentPosition: true,
            masonry: {
                columnWidth: '.grid-sizer'
            }
        });
    }
});



})(jQuery)


  $(function() {
        // if($('#sidebar').length>0)
        // {
        //         var top = $('#sidebar').offset().top - parseFloat($('#sidebar').css('marginTop').replace(/auto/, 0));
        //         var footTop = $('#footer').offset().top - parseFloat($('#footer').css('marginTop').replace(/auto/, 0));
        //         var maxY = footTop - $('#sidebar').outerHeight();
        //         $(window).scroll(function(evt) {
        //             var y = $(this).scrollTop();
        //             if (y > top) {
                        
        //                 if (y < maxY) {
        //                     $('#sidebar').addClass('fixed').removeAttr('style');
        //                 } else {
        //                     $('#sidebar').removeClass('fixed').css({
        //                         position: 'absolute',
        //                         top: (maxY - top) + 'px'
        //                     });
        //                 }
        //             } else {
        //                 $('#sidebar').removeClass('fixed');
        //             }
        //         }); 
        // }
    
});

    $(function() 
    {
     if($('#sidebar2').length>0)
    {
        var top = $('#sidebar2').offset().top - parseFloat($('#sidebar2').css('marginTop').replace(/auto/, 0));
        var footTop = $('#footer').offset().top - parseFloat($('#footer').css('marginTop').replace(/auto/, 0));

        var maxY = footTop - $('#sidebar2').outerHeight();

        $(window).scroll(function(evt) {
            var y = $(this).scrollTop();
            if (y > top) {
                
            //Quand scroll, ajoute une classe ".fixed" et supprime le Css existant 
                if (y < maxY) {
                    $('#sidebar2').addClass('fixed').removeAttr('style');
                } else {
                    
            //Quand la sidebar arrive au footer, supprime la classe "fixed" précèdement ajouté
                    $('#sidebar2').removeClass('fixed').css({
                        position: 'absolute',
                        top: (maxY - top) + 'px'
                    });
                }
            } else {
                $('#sidebar2').removeClass('fixed');
            }
        });
    }
});

$(function(){
    var top = $('#chat-block').offset().top - parseFloat($('#chat-block').css('marginTop').replace(/auto/, 0));
    var footTop = $('#footer').offset().top - parseFloat($('#footer').css('marginTop').replace(/auto/, 0));
    var maxY = footTop - $('#chat-block').outerHeight();
    $(window).scroll(function(evt) {
        var y = $(this).scrollTop();
        if (y > top) {
            //Quand scroll, ajoute une classe ".fixed" et supprime le Css existant 
            if (y < maxY) {
                $('#chat-block').addClass('fixed').removeAttr('style');
            } else {
            //Quand la sidebar arrive au footer, supprime la classe "fixed" précèdement ajouté
                $('#chat-block').removeClass('fixed').css({
                    position: 'absolute',
                    top: (maxY - top) + 'px'
                });
            }
        } 
        else {
            $('#chat-block').removeClass('fixed');
        }
    });


});

$(document).ready(function() {
  var lazyloadImages;    

  if ("IntersectionObserver" in window) {
    lazyloadImages = document.querySelectorAll(".blur");
    var imageObserver = new IntersectionObserver(function(entries, observer) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          var image = entry.target;
          image.src = image.dataset.src;
          image.classList.remove("blur");
           image.classList.remove("plain-bg");
          imageObserver.unobserve(image);
        }
      });
    });

    lazyloadImages.forEach(function(image) {
      imageObserver.observe(image);
    });
  } else {  
    var lazyloadThrottleTimeout;
    lazyloadImages = $(".blur");
    
    function lazyload () {
      if(lazyloadThrottleTimeout) {
        clearTimeout(lazyloadThrottleTimeout);
      }    

      lazyloadThrottleTimeout = setTimeout(function() {
          var scrollTop = $(window).scrollTop();
          lazyloadImages.each(function() {
              var el = $(this);
              if(el.offset().top - scrollTop < window.innerHeight) {
                var url = el.attr("data-src");
                el.attr("src", url);
                el.removeClass("blur");
                lazyloadImages = $(".blur");
              }
          });
          if(lazyloadImages.length == 0) { 
            $(document).off("scroll");
            $(window).off("resize");
          }
      }, 20);
    }

    $(document).on("scroll", lazyload);
    $(window).on("resize", lazyload);
  }
})

$(document).ready(function() {
  var lazyloadImages;    

  if ("IntersectionObserver" in window) {
    lazyloadImages = document.querySelectorAll(".plain-bg");
    var imageObserver = new IntersectionObserver(function(entries, observer) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          var image = entry.target;
          image.src = image.dataset.src;
          image.classList.remove("plain-bg");

          imageObserver.unobserve(image);
        }
      });
    });

    lazyloadImages.forEach(function(image) {
     $(image).parents('.bg-color').removeClass('bg-color');
      imageObserver.observe(image);
    });
  } else {  
    var lazyloadThrottleTimeout;
    lazyloadImages = $(".plain-bg");
    
    function lazyload () {
      if(lazyloadThrottleTimeout) {
        clearTimeout(lazyloadThrottleTimeout);
      }    

      lazyloadThrottleTimeout = setTimeout(function() {
          var scrollTop = $(window).scrollTop();
          lazyloadImages.each(function() {
              var el = $(this);
              if(el.offset().top - scrollTop < window.innerHeight) {
                var url = el.attr("data-src");
                el.attr("src", url);
                el.removeClass("plain-bg");
                lazyloadImages = $(".plain-bg");
              }
          });
          if(lazyloadImages.length == 0) { 
            $(document).off("scroll");
            $(window).off("resize");
          }
      }, 20);
    }

    $(document).on("scroll", lazyload);
    $(window).on("resize", lazyload);
  }
})