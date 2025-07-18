
// document.addEventListener("DOMContentLoaded", function () {
//   const selected = document.getElementById("selected-option");
//   const options = document.getElementById("options-list");
//   const hiddenInput = document.getElementById("language-select");
//   const optionItems = options.querySelectorAll(".option");

//   // Toggle dropdown
//   selected.addEventListener("click", () => {
//     options.style.display = options.style.display === "block" ? "none" : "block";
//   });

//   // Close dropdown if clicked outside
//   document.addEventListener("click", function (e) {
//     if (!e.target.closest(".custom-select-wrapper")) {
//       options.style.display = "none";
//     }
//   });

//   // Handle option selection
//   optionItems.forEach(option => {
//     option.addEventListener("click", () => {
//       selected.innerHTML = option.innerHTML;
//       hiddenInput.value = option.getAttribute("data-value");
//       options.style.display = "none";
//     });
//   });
// });

jQuery('.homeSlider').slick({
  dots: false,
  infinite: true,
  speed: 500,
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: true,
  autoplay: true,
  autoplaySpeed: 7000  
});




function proSearchtabFunc(evt, tabName) {
  var i, tabcontent, tablinks;

  tabcontent = document.getElementsByClassName("proSearchtabCont");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}

jQuery('.homeSlider2').slick({
  dots: false,
  infinite: true,
  speed: 500,
  slidesToShow: 6,
  slidesToScroll: 1,
  arrows: true,
  autoplay: true,
  autoplaySpeed: 7000,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 4,
      }
    },
    {
      breakpoint: 800,
      settings: {
        slidesToShow: 3,
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2,
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
})
.on('setPosition', function (event, slick) {
    slick.$slides.css('height', slick.$slideTrack.height() + 'px');
});


jQuery('.saleSlider').slick({
  dots: true,
  infinite: true,
  speed: 500,
  slidesToShow: 4,         // Number of columns
  slidesToScroll: 1,
  arrows: false,
  autoplay: true,
  autoplaySpeed: 7000,
  rows: 4,                 // Number of rows
  slidesPerRow: 1,        // 1 slide per row in each column
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        rows: 3,
        dots: true
      }
    },
    {
      breakpoint: 800,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        rows: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        rows: 3
      }
    }
  ]
});

function setEqualHeight() {
  var maxHeight = 0;
  jQuery('.saleSlider .productBox').css('height', 'auto').each(function () {
    var thisHeight = jQuery(this).outerHeight();
    if (thisHeight > maxHeight) maxHeight = thisHeight;
  });
  jQuery('.saleSlider .productBox').css('height', maxHeight + 'px');
}

jQuery(window).on('load resize', function () {
  setTimeout(setEqualHeight, 100); // Wait for Slick to finish rendering
});




$(document).ready(function(){
  $('.slider-for').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    fade: true,
    asNavFor: '.slider-nav'
  });

  $('.slider-nav').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    asNavFor: '.slider-for',
    dots: false,
    arrows: true,
    centerMode: false,
    focusOnSelect: true,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 4,
        }
      },
    {
      breakpoint: 576,
      settings: {
        slidesToShow: 3,
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2,
      }
    }
    ]
  });
});


jQuery('.proReatedSlider').slick({
  dots: false,
  infinite: true,
  speed: 500,
  slidesToShow: 4,
  slidesToScroll: 1,
  arrows: true,
  autoplay: true,
  autoplaySpeed: 7000,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
      }
    },
    {
      breakpoint: 767,
      settings: {
        slidesToShow: 2,
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2,
      }
    },
    {
      breakpoint: 460,
      settings: {
        slidesToShow: 1,
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
})
.on('setPosition', function (event, slick) {
    slick.$slides.css('height', slick.$slideTrack.height() + 'px');
});



// Product category left list start...

document.querySelectorAll('.category-menu li > a').forEach(anchor => {
    anchor.addEventListener('click', e => {
      const parentLi = anchor.parentElement;
      const subUl = anchor.nextElementSibling;

      if (subUl && subUl.tagName === 'UL') {
        e.preventDefault(); // Prevent link if submenu exists

        parentLi.classList.toggle('open');

        // Optional: Close others at same level (accordion effect)
        parentLi.parentElement.querySelectorAll(':scope > li').forEach(sibling => {
          if (sibling !== parentLi) {
            sibling.classList.remove('open');
          }
        });
      }
    });
});
  

// Mobile menu start..
 jQuery( ".burger" ).click(function(e) {
    e.preventDefault();
    jQuery( this ).toggleClass('active');
    jQuery( ".mobile_nav" ).toggleClass('open');
}); 
 
 
 