 $(document).ready(function () {
     if (document.getElementById('owl-carousel-nav')) {
         $("#owl-carousel-nav").owlCarousel({
             loop: true,
             margin: 10,
             nav: true,
             navText: ["<img src='img/svg/arrow-left.svg' class='img-fluid d-block m-auto' alt='arrow left'>",
                 "<img src='img/svg/arrow-right.svg' class='img-fluid d-block m-auto' alt='arrow right'>"
             ],
             responsive: {
                 0: {
                     items: 1
                 },
                 768: {
                     items: 2
                 },
                 998: {
                     items: 3
                 }
             }
         });
     }
 });