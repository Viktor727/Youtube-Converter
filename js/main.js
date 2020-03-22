 /* jshint esversion: 6 */
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

     var convertBtn = $('#convert-video');
     if(convertBtn != null)
         convertBtn.click(ConvertBtnClicked);
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

function ConvertBtnClicked() {
    var inputForm = $('#youtube-url-input');
    if(inputForm != null && inputForm.val() != null && inputForm.val() != '' && matchYoutubeUrl(inputForm.val())) {
        var checkedConvertType = $('input[name="convert-type"]:checked');
        if(checkedConvertType != null && checkedConvertType.length == 1)
            GetYoutubeVideo(inputForm.val(),checkedConvertType.val());
        else
            showErrorMessage('Please, Select Convertation Type(mp3 or mp4) Before Submitting.');
    } else {
        showErrorMessage('Please, Provide Valid Youtube Link.');
    }
}

function GetYoutubeVideo(url, convertType) {
    swal({title: 'LOADING...',
                showCancelButton: false,
                showCloseButton: false,
                timerProgressBar: true,
                showConfirmButton: false,
                html: "<div class=\"loading-circle\"></div>"});

    $.ajax({
        url: 'get_video_from_youtube.php', //page url
        type: "POST", //method of sending
        dataType: "json", //format of the data
        data: { 'url':url, 'type': convertType}, // serialize object
        success: function (response) { //the data sending successfull
            swal.close();

            if(response != null) {
                if(response.isOk != null && response.isOk) {
                    setTimeout(function () {

                        swal({icon:"success",
                        title: "Success",
                        text: "Video converted successfully. You will be redirected to download page."});

                        //window.open( response.downloadUrl );
                        /*
                        // force download file (WARNING THIS NOT WORK IN CHROM FROM 2018 BECAUSE Of Cross-Origin...)
                        var a = $("<a>")
                            .attr("href", response.downloadUrl)
                            .attr("download", "test.mp4")
                            .attr("target", "_blank")
                            .appendTo("body");
                        a[0].click();
                        a.remove();
                        */
                        console.log(response.downloadUrl);
                        submit_post_via_hidden_form("download_video.php", { "url": response.downloadUrl, "filename": response.fileName });
                    }, 500);
                } else {
                    if(response.message != null)
                        showErrorMessage(response.message);
                    else 
                        showErrorMessage("Cannot Fetch Data From Server, Please Try Again.");
                }
            } else {
                showErrorMessage("Cannot Fetch Data From Server, Please Try Again.");
            }
        },
        error: function (response) { // Data was not sending
            showErrorMessage("Something went wrong while converting your video. Please, Try again.");
            
        }
   });
}

function showErrorMessage(errmsg) {
    swal.close();
    setTimeout(function () {
        swal({icon:"error",
                    title: "Oops...",
                    text: errmsg});
    }, 500);
}

function submit_post_via_hidden_form(url, params) {
    var f = $("<form target='_blank' method='POST' style='display:none;'></form>").attr({
        action: url
    }).appendTo(document.body);

    for (var i in params) {
        if (params.hasOwnProperty(i)) {
            $('<input type="hidden" />').attr({
                name: i,
                value: params[i]
            }).appendTo(f);
        }
    }

    f.submit();

    f.remove();
}

function matchYoutubeUrl(url) {
    // reg ex to check the following:
    // https://
    // m. or www.
    // youtu.be or youtube.com
    // embed/ or v/ or watch?v= or watch?smth&v=
    // check length of v= property. Must be equal to 11 
    //var p = /^(?:https?:\/\/)?(?:m\.|www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
    
    // new reg ex
    var p = /^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed)\/))([^\?&\"'>]+)/;
    if(url.match(p))
        return url.match(p)[1];
    return false;
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


