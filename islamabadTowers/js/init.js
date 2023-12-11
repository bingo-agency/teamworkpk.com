(function($){
  $(function(){

    $('.sidenav').sidenav();
    $('.parallax').parallax();
    $('.dropdown-trigger').dropdown({'coverTrigger':false, 'closeOnClick':false});
    // document.addEventListener('DOMContentLoaded', function() {
    //   var elems = document.querySelectorAll('.dropdown-trigger');
    //   var instances = M.Dropdown.init(elems, {});
    // });
  
    


  }); // end of document ready
})(jQuery); // end of jQuery name space

$(window).scroll(function() {    
  var scroll = $(window).scrollTop();

  if (scroll >= 80) {
// console.log('change to white');
       $("nav").addClass("black");
       $("nav").removeClass("transparent");


       //yeh
       $("nav").addClass("noBorderBottom");
       $("nav").removeClass("navborderbottom");
  } else {
    // console.log('change to trasnparent');

       $("nav").removeClass("white");
       $("nav").removeClass("black");
       $("nav").addClass("transparent");
       //////yeh
       $("nav").removeClass("navborderbottom");
       $("nav").addClass("noBorderBottom");
  }
});

$(document).ready(function(){
  $('.modal').modal();
});

document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.modal');
  var instances = M.Modal.init(elems);
  var input = document.getElementById('dropdown1');
  input.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
      event.preventDefault();
      var modalInstance = M.Modal.getInstance(document.getElementById('modal1'));
      modalInstance.open();
    }
  });
});
              //  small screen dropdown
document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.modal');
  var instances = M.Modal.init(elems);
  var input = document.getElementById('dropdown2');
  input.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
      event.preventDefault();
      var modalInstance = M.Modal.getInstance(document.getElementById('modal1'));
      modalInstance.open();
    }
  });
});

  
const heroBanner = document.querySelector('.hero-image');
const windowWidth = window.innerWidth / 5;
const windowHeight = window.innerHeight / 5;

// heroBanner.addEventListener('mousemove', (e) => {
  $(document).mousemove(function(e){
    console.log(heroBanner + "this is hero");
    const mouseX = e.clientX / windowWidth;
    const mouseY = e.clientY / windowHeight;
  
    heroBanner.style.transform = `translate3d(-${mouseX}%, -${mouseY}%, 0)`;

  })
// });

        // Aminities 1  //

  // JavaScript code to handle the slider functionality
  var images = document.querySelectorAll('.slider img');
  var dots = document.querySelectorAll('.dot');
  var currentImage = 0;

  // Function to show the current image
  function showImage(n) {
    // Hide all images
    for (var i = 0; i < images.length; i++) {
      images[i].classList.remove('active');
    }

    // Remove active class from all dots
    for (var i = 0; i < dots.length; i++) {
      dots[i].classList.remove('active');
    }

    // Show the desired image and dot
    images[n].classList.add('active');
    dots[n].classList.add('active');
    currentImage = n;
  }

  // Event listeners for the dots
  dots.forEach(function (dot, index) {
    dot.addEventListener('click', function () {
      showImage(index);
    });
  });

  // Automatic image slideshow
  setInterval(function () {
    currentImage = (currentImage + 1) % images.length;
    showImage(currentImage);
  }, 3000);
      
                // END //