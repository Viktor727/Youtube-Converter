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

 jQuery("body").on('click', '[href*="#"]', function (e) {
     var fixed_offset = 20;
     jQuery('html,body').stop().animate({
         scrollTop: jQuery(this.hash).offset().top - fixed_offset
     }, 1000);
     e.preventDefault();
 });

 (function () {
     'use strict';
     window.addEventListener('load', function () {
         // Fetch all the forms we want to apply custom Bootstrap validation styles to
         var forms = document.getElementsByClassName('needs-validation');
         // Loop over them and prevent submission
         var formBtn = this.document.querySelector(".form-btn");
         var validation = Array.prototype.filter.call(forms, function (form) {
             formBtn.addEventListener('click', function (event) {
                 if (form.checkValidity() === false) {
                     event.preventDefault();
                     event.stopPropagation();
                 }
                 form.classList.add('was-validated');
                 let checkValidation = form.querySelectorAll('.group');
                 let arr = [];
                 for (let i = 0; i < checkValidation.length; i++) {
                     let checkProc = checkValidation[i].innerText.replace(checkValidation[i].getElementsByTagName('label')[0].innerText + '\n', '');
                     console.log(checkValidation[i].getElementsByTagName('label')[0].innerText);
                     arr.push(checkProc);
                 }
                 console.log(arr);
                 if (arr.every(x => x === 'Looks good !')) {
                     sendAjaxForm('result_form', 'contact-form', 'process.php');
                 } else {
                     console.log('novalide');
                 }

             }, false);
         });
     }, false);
 })();

 function sendAjaxForm(result_form, form, page_url) {
     $.ajax({
         url: page_url, //page url
         type: "POST", //method of sending
         dataType: "html", //format of the data
         data: $("#" + form).serialize(), // serialize object
         success: function (response) { //the data sending successfull
             swal("Sent!", "Please check email!", "success");
         },
         error: function (response) { // Data was not sending
             console.log("Error! Please try again.");
         }
     });
 }


// window.addEventListener('load', function () {
//      var iframe = document.getElementsByTagName('iframe')[0];
//      console.log(iframe);
//      var iframeDoc = iframe.contentWindow.document;

//      if (iframeDoc.readyState == 'complete') {
//          iframeDoc.body.style.backgroundColor = 'green';
//      }
//      iframe.onload = function () {
//          var iframeDoc = iframe.contentWindow.document;
//          iframeDoc.body.querySelector('.rc-anchor-logo-img').style.backgroundImage = "url('../img/google_recaptcha-icon.png')";
//      };
//  });