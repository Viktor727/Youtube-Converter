<?php
define('SITE_KEY', '6LcMs-IUAAAAAKuHnc6QS-BBzgoWGDp-nlVFRqsy');
define('SECRET_KEY', '6LcMs-IUAAAAANyY6y865EPluc4yIZ0Xnt8oJ_e7');

if ($_POST) {
    function getCaptcha($SecretKey)
    {
        $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . SECRET_KEY . "&response={$SecretKey}");
        $Return = json_decode($Response);
        return $Return;
    }
    $Return = getCaptcha($_POST['g-recaptcha-response']);
    //var_dump($Return);
    if ($Return->success == true && $Return->score > 0.5) {
        echo "Succes!";
    } else {
        echo "You are a Robot!!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="shortcut icon" sizes="108*108" href="favicon.png" type="images/x-icon"> -->

    <script src='https://www.google.com/recaptcha/api.js?render=<?php echo SITE_KEY; ?>'></script>

    <title> Youtube to MP3, MP4 subtitle converter </title>
</head>

<body>
    <header class="header-wrapper d-flex flex-column justify-content-between">
        <!-- <div class="img-overlay"></div> -->

        <nav class="navbar navbar-expand-xl navbar-dark pt-2">
            <div class="container">
                <div class="container-fluid d-flex flex-wrap align-items-center justify-content-between">

                    <a class="navbar-brand" href="index.php">
                        <img src="img/youtube.png" alt="youtube logo">
                        Mp3 Converter
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse flex-wrap" id="navbarSupportedContent">
                        <ul class="navbar-nav m-lg-auto align-items-start pt-4 pt-xl-0">
                            <li class="nav-item">
                                <a class="nav-link active" href="#home">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#how-does-it-work">How does it work?</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#about-product">About product</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#contact">Constact us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <section class="meeting-wrapper d-flex align-items-center">
            <div class="container text-center text-xl-left pb-5 pt-5 form-container">
                <h1 class="site-title text-white text-uppercase text-center mb-3" id="home">
                    Youtube to MP3, MP4 subtitle converter
                </h1>
                <h5 class="subtitle text-white text-center pb-xl-4">
                    Just paste the youtube link and be happy !
                </h5>
                <form method="POST" class="seach-form row" novalidate>

                    <div class="col-12 d-flex">
                        <div class='swith-row d-flex justify-content-center'>
                            <div class="switch">
                                <input type="radio" class="switch-input user_radio_btn" name="convert-type" value="mp3" id="one" checked>
                                <label for="one" class="switch-label switch-label-off">
                                    <span>Mp3</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" id="OutLine1" viewBox="0 0 512 512" width="36px" height="36px">
                                        <g>
                                            <path d="M349.657,18.343A8,8,0,0,0,344,16H120A56.064,56.064,0,0,0,64,72V440a56.064,56.064,0,0,0,56,56H392a56.063,56.063,0,0,0,56-56V120a8,8,0,0,0-2.343-5.657ZM352,43.313,420.687,112H392a40.045,40.045,0,0,1-40-40ZM120,32H336V72a56.063,56.063,0,0,0,56,56h40V352H80V72A40.045,40.045,0,0,1,120,32ZM392,480H120a40.045,40.045,0,0,1-40-40V368H432v72A40.045,40.045,0,0,1,392,480Z" data-original="#000000" class="active-path" data-old_color="#000000" />
                                            <path d="M216,384a7.976,7.976,0,0,0-5.661,2.347L192,404.687l-18.343-18.344A8,8,0,0,0,160,392v64a8,8,0,0,0,16,0V411.313l10.343,10.344a8,8,0,0,0,11.314,0L208,411.313V456a8,8,0,0,0,16,0V392A8,8,0,0,0,216,384Z" data-original="#000000" class="active-path" data-old_color="#000000" />
                                            <path d="M264,384H248a8,8,0,0,0-8,8v64a8,8,0,0,0,16,0V432h8a24,24,0,0,0,0-48Zm0,32h-8V400h8a8,8,0,0,1,0,16Z" data-original="#000000" class="active-path" data-old_color="#000000" />
                                            <path d="M328,384H312a8,8,0,0,0,0,16h16a8,8,0,0,1,0,16H312a8,8,0,0,0,0,16h16a8,8,0,0,1,0,16H312a8,8,0,0,0,0,16h16a23.984,23.984,0,0,0,17.869-40A23.984,23.984,0,0,0,328,384Z" data-original="#000000" class="active-path" data-old_color="#000000" />
                                            <path d="M184,304a40.045,40.045,0,0,0,40-40V174.938l96-13.714v54.8A39.985,39.985,0,1,0,336,248V120a8,8,0,0,0-9.132-7.919l-112,16A8,8,0,0,0,208,136v96.022A39.993,39.993,0,1,0,184,304Zm112-32a24,24,0,1,1,24-24A24.028,24.028,0,0,1,296,272Zm24-142.776v15.838l-96,13.714V142.938ZM184,240a24,24,0,1,1-24,24A24.028,24.028,0,0,1,184,240Z" data-original="#000000" class="active-path" data-old_color="#000000" />
                                        </g>
                                    </svg>
                                </label>
                                <input type="radio" class="switch-input admin_radio_btn" name="convert-type" value="mp4" id="two">
                                <label for="two" class="switch-label switch-label-on">
                                    <span>Mp4</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" id="OutLine2" viewBox="0 0 512 512" width="36px" height="36px" class="">
                                        <g>
                                            <path d="M349.657,18.343A8,8,0,0,0,344,16H120A56.063,56.063,0,0,0,64,72V440a56.063,56.063,0,0,0,56,56H392a56.063,56.063,0,0,0,56-56V120a8,8,0,0,0-2.343-5.657ZM352,43.313,420.687,112H392a40.045,40.045,0,0,1-40-40ZM120,32H336V72a56.063,56.063,0,0,0,56,56h40V352H80V72A40.045,40.045,0,0,1,120,32ZM392,480H120a40.045,40.045,0,0,1-40-40V368H432v72A40.045,40.045,0,0,1,392,480Z" data-original="#000000" class="active-path" data-old_color="#000000" />
                                            <path d="M216,384a7.979,7.979,0,0,0-5.657,2.343h0L192,404.687l-18.343-18.344A8,8,0,0,0,160,392v64a8,8,0,0,0,16,0V411.313l10.343,10.344a8,8,0,0,0,11.314,0L208,411.314V456a8,8,0,0,0,16,0V392A8,8,0,0,0,216,384Z" data-original="#000000" class="active-path" data-old_color="#000000" />
                                            <path d="M264,384H248a8,8,0,0,0-8,8v64a8,8,0,0,0,16,0V432h8a24,24,0,0,0,0-48Zm0,32h-8V400h8a8,8,0,0,1,0,16Z" data-original="#000000" class="active-path" data-old_color="#000000" />
                                            <path d="M344,384a8,8,0,0,0-8,8v24H320V392a8,8,0,0,0-16,0v32a8,8,0,0,0,8,8h24v24a8,8,0,0,0,16,0V392A8,8,0,0,0,344,384Z" data-original="#000000" class="active-path" data-old_color="#000000" />
                                            <path d="M256,304A104,104,0,1,0,152,200,104.118,104.118,0,0,0,256,304Zm0-192a88,88,0,1,1-88,88A88.1,88.1,0,0,1,256,112Z" data-original="#000000" class="active-path" data-old_color="#000000" />
                                            <path d="M227.794,238.805a8,8,0,0,0,7.784.35l64-32a8,8,0,0,0,0-14.31l-64-32A8,8,0,0,0,224,168v64A8,8,0,0,0,227.794,238.805ZM240,180.944,278.111,200,240,219.056Z" data-original="#000000" class="active-path" data-old_color="#000000" />
                                        </g>
                                    </svg>
                                </label>
                                <span class="slider2"></span>
                            </div>
                        </div>
                    </div>


                    <div class="col-12 d-flex search-block mt-3">
                        <input class="form-control search-input" name="url" type="text" placeholder="Youtube URL" aria-label="Search" id="youtube-url-input">
                        <button type="button" class="search-btn btn text-uppercase" id="convert-video">
                            <span class="d-none d-sm-block">Convert</span>
                            <img src="img/svg/arrow.svg" class="d-block d-sm-none" alt="arrow">
                        </button>
                    </div>
                </form>
            </div>
        </section>
        <div></div>
    </header>
    <section class="how-to-use-wrapper d-flex justify-content-center w-100">
        <div class="container how-to-use-block pt-5 pb-5">
            <div class="pr-5 pl-5">
                <div class="mt-4 mt-lg-0">
                    <h2 class="text-center title" id="how-does-it-work">How does it work ?</h2>
                    <div class="row mt-5">
                        <div class="col-md-4 text-center">
                            <div class="img-block">
                                <img src="img/svg/path.svg" alt="path">
                            </div>
                            <h5 class="how-to-use__title title mb-0">Choose</h5>
                            <p class="how-to-use__text">Choose from the two types of format you need</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="img-block">
                                <img src="img/svg/domain.svg" alt="domain">
                            </div>
                            <h5 class="how-to-use__title title mb-0">Insert</h5>
                            <p class="how-to-use__text">Find the link, which you want and paste in the text box</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="img-block">
                                <img src="img/svg/tap.svg" alt="tap">
                            </div>
                            <h5 class="how-to-use__title title mb-0">Click</h5>
                            <p class="how-to-use__text">Click on "convert" button and get the files</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-product-wrapper pb-5">
        <div class="container">
            <h2 class="title text-center mt-5 pb-4" id="about-product">About product</h2>
            <div class="row">
                <div class="col-lg-6 d-flex align-items-center">
                    <img src="img/about-product-wrapper.jpg" class="img-fluid d-block m-auto rounded" alt="about-product image">
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0">
                    <p>
                        By using our converter you can easily convert YouTube videos to mp3 (audio) or mp4 (video) files
                        and download them for free - this service works for computers, tablets and mobile devices.
                        <br> <br>
                        The videos are always converted in the highest available quality. Please note that we can only
                        convert videos up to a length of 1 hour - the limitation is necessary, so the conversion of any
                        video will not take more than a couple of minutes.
                        <br> <br>
                        Our service is for free and does not require any software or registration. By using our service
                        you are accepting our terms of use.
                        <br> <br>
                        To convert a video, copy the YouTube video URL into our converter, choose a format and click the
                        convert button. As soon as the conversion is finished you can download the file by clicking on
                        the download button.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="question-wrapper mb-5">
        <div class="container text-center">
            <h2 class="title">Do you have a question?</h2>
            <a href="#contact" class="btn btn-question mt-3 pl-5 pr-5 pt-2 pb-2">Ask a question</a>
        </div>
    </section>

    <section class="slider-wrapper mb-5">
        <div class="container">
            <h2 class="title pl-4 pr-4 pr-md-0 pl-md-0 text-center">What Do Customers Say About This Product?</h2>
            <div class="row">
                <div class="owl-carousel owl-theme card-deck" id="owl-carousel-nav">
                    <div class="card p-3">
                        <img src="img/slider1.jpg" class="d-block m-auto slider-img pt-3 pl-3 pr-3" alt="person image">
                        <div class="card-body">
                            <h5 class="card-title block-title mb-3">Wilhelm Dowall</h5>
                            <h6 class="card-subtitle text-uppercase">CEO</h6>
                            <p class="card-text font-weight-lighter mt-4">We use "Youtube Conventer" every day.
                                Personally, I download music from YouTube, it is also very convenient, which also pulls
                                up "subtitle". Thank you to the developers for their good work and easy site to download
                                in mp3 format</p>
                        </div>
                    </div>
                    <div class="card p-3">
                        <img src="img/slider2.jpg" class="d-block m-auto slider-img pt-3 pl-3 pr-3" alt="person image">
                        <div class="card-body">
                            <h5 class="card-title block-title mb-3">Alberto Raya</h5>
                            <h6 class="card-subtitle text-uppercase">Backend Developer</h6>
                            <p class="card-text font-weight-lighter mt-4">We use "Youtube Conventer" every day.
                                Personally, I download music from YouTube, it is also very convenient, which also pulls
                                up "subtitle". Thank you to the developers for their good work and easy site to download
                                in mp3 format</p>
                        </div>
                    </div>
                    <div class="card p-3">
                        <img src="img/slider3.jpg" class="d-block m-auto slider-img pt-3 pl-3 pr-3" alt="person image">
                        <div class="card-body">
                            <h5 class="card-title block-title mb-3">Uruewa Himona</h5>
                            <h6 class="card-subtitle text-uppercase">Manager</h6>
                            <p class="card-text font-weight-lighter mt-4">We use "Youtube Conventer" every day.
                                Personally, I download music from YouTube, it is also very convenient, which also pulls
                                up "subtitle". Thank you to the developers for their good work and easy site to download
                                in mp3 format</p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>

    <section class="contact-wrapper" id="contact">
        <div class="container shadow rounded">
            <div class="row">
                <div class="col-lg-7 bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="title mb-0 mt-3 text-center text-lg-left">Send a message</h2>
                        <a class="contact-mail d-inline" href="mailto:469834223@qq.com">
                            <img src="img/svg/mail.svg" alt="mail">
                        </a>
                    </div>

                    <!-- <h3 class="subtitle text-center text-lg-left mb-5">Send a message</h3> -->
                    <form class="needs-validation contact-form" id="contact-form" method="post" novalidate>
                        <div class="row">
                            <div class="group col-6">
                                <input type="text" class="form-input" id="first-name" name="firstName" minlength="3" required>
                                <label for="first-name">First Name</label>

                                <div class="valid-feedback">
                                    Looks good !
                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid first name.
                                </div>
                            </div>
                            <div class="group col-6">
                                <input type="text" class="form-input" id="last-name" name="lastName" minlength="3" required>
                                <label for="last-name">Last name</label>

                                <div class="valid-feedback">
                                    Looks good !
                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid second name.
                                </div>
                            </div>


                            <div class="group col-12">
                                <input type="email" class="form-input" id="email" name="email" required>
                                <label for="email">Email address</label>

                                <div class="valid-feedback">
                                    Looks good !
                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid email adress.
                                </div>
                            </div>

                            <div class="group col-12">
                                <input type="text" id="theme" class="form-input" name="theme" autocomplete="off" minlength="3" required>
                                <label for="theme">Theme</label>

                                <div class="valid-feedback">
                                    Looks good !
                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid theme.
                                </div>
                            </div>

                            <div class="group col-12">
                                <textarea id="message" class="form-input" name="message" rows="1" autocomplete="off" minlength="10" required></textarea>
                                <label for="message">How can we help?</label>
                                <div class="textarea-hr">

                                </div>
                                <div class="valid-feedback">
                                    Looks good !
                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid message.
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />
                            <button type="button" class="form-btn btn pl-4 pr-4 pt-2 pb-2">
                                <img src="img/svg/send.svg" alt="send">
                                <span class="align-middle pl-2">
                                    Submit
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-5 contact-info-side">
                    <h2 class="title text-white mb-0 mt-3 text-center text-lg-left">Contact Info</h2>

                    <div class="d-flex align-items-center justify-content-center justify-content-lg-start pl-lg-5">
                        <img src="img/svg/social/phone.svg" alt="phone">
                        <a href="#" class="contact-info-link pl-3">
                            +1 (585) 902-8531
                        </a>
                    </div>

                    <div class="d-flex align-items-center justify-content-center justify-content-lg-start pl-lg-5 mt-4">
                        <img src="img/svg/social/email.svg" alt="email">
                        <a href="mailto:469834223@qq.com" class="contact-info-link pl-3">
                            469834223@qq.com
                        </a>
                    </div>

                    <div class="social-icon d-flex justify-content-center justify-content-lg-start pl-lg-5 mt-5 mb-5">
                        <a href="#" class="social-icon-link d-flex justify-content-center">
                            <!-- <img src="img/svg/social/facebook.svg" class="img-fluid social-icon-img" alt="facebook"> -->
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" width="21px" height="21px" fill="#273238" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M288,176v-64c0-17.664,14.336-32,32-32h32V0h-64c-53.024,0-96,42.976-96,96v80h-64v80h64v256h96V256h64l32-80H288z" />
                                    </g>
                                </g>
                            </svg>
                        </a>
                        <a href="#" class="social-icon-link d-flex justify-content-center">
                            <!-- <img src="img/svg/social/twitter.svg" class="img-fluid social-icon-img" alt="twitter"> -->
                            <svg viewBox="0 -47 512.00203 512" xmlns="http://www.w3.org/2000/svg" width="21px" height="21px" fill="#273238">
                                <path d="m191.011719 419.042969c-22.140625 0-44.929688-1.792969-67.855469-5.386719-40.378906-6.335938-81.253906-27.457031-92.820312-33.78125l-30.335938-16.585938 32.84375-10.800781c35.902344-11.804687 57.742188-19.128906 84.777344-30.597656-27.070313-13.109375-47.933594-36.691406-57.976563-67.175781l-7.640625-23.195313 6.265625.957031c-5.941406-5.988281-10.632812-12.066406-14.269531-17.59375-12.933594-19.644531-19.78125-43.648437-18.324219-64.21875l1.4375-20.246093 12.121094 4.695312c-5.113281-9.65625-8.808594-19.96875-10.980469-30.777343-5.292968-26.359376-.863281-54.363282 12.476563-78.851563l10.558593-19.382813 14.121094 16.960938c44.660156 53.648438 101.226563 85.472656 168.363282 94.789062-2.742188-18.902343-.6875-37.144531 6.113281-53.496093 7.917969-19.039063 22.003906-35.183594 40.722656-46.691407 20.789063-12.777343 46-18.96875 70.988281-17.433593 26.511719 1.628906 50.582032 11.5625 69.699219 28.746093 9.335937-2.425781 16.214844-5.015624 25.511719-8.515624 5.59375-2.105469 11.9375-4.496094 19.875-7.230469l29.25-10.078125-19.074219 54.476562c1.257813-.105468 2.554687-.195312 3.910156-.253906l31.234375-1.414062-18.460937 25.230468c-1.058594 1.445313-1.328125 1.855469-1.703125 2.421875-1.488282 2.242188-3.339844 5.03125-28.679688 38.867188-6.34375 8.472656-9.511718 19.507812-8.921875 31.078125 2.246094 43.96875-3.148437 83.75-16.042969 118.234375-12.195312 32.625-31.09375 60.617187-56.164062 83.199219-31.023438 27.9375-70.582031 47.066406-117.582031 56.847656-23.054688 4.796875-47.8125 7.203125-73.4375 7.203125zm0 0" />
                            </svg>

                        </a>
                        <a href="#" class="social-icon-link d-flex justify-content-center">
                            <!-- <img src="img/svg/social/instagram.svg" class="img-fluid social-icon-img" alt="instagram"> -->
                            <svg version="1.1" id="Capa_2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" width="21px" height="21px" fill="#273238" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M352,0H160C71.648,0,0,71.648,0,160v192c0,88.352,71.648,160,160,160h192c88.352,0,160-71.648,160-160V160
			                            C512,71.648,440.352,0,352,0z M464,352c0,61.76-50.24,112-112,112H160c-61.76,0-112-50.24-112-112V160C48,98.24,98.24,48,160,48
			                            h192c61.76,0,112,50.24,112,112V352z" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path d="M256,128c-70.688,0-128,57.312-128,128s57.312,128,128,128s128-57.312,128-128S326.688,128,256,128z M256,336
			                            c-44.096,0-80-35.904-80-80c0-44.128,35.904-80,80-80s80,35.872,80,80C336,300.096,300.096,336,256,336z" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <circle cx="393.6" cy="118.4" r="17.056" />
                                    </g>
                                </g>
                            </svg>
                        </a>
                        <a href="#" class="social-icon-link d-flex justify-content-center">
                            <!-- <img src="img/svg/social/youtube.svg" class="img-fluid social-icon-img" alt="youtube"> -->
                            <svg version="1.1" id="Capa_3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="21px" height="21px" viewBox="0 0 90.677 90.677" fill="#273238" style="enable-background:new 0 0 90.677 90.677;" xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M82.287,45.907c-0.937-4.071-4.267-7.074-8.275-7.521c-9.489-1.06-19.098-1.065-28.66-1.06
                                            c-9.566-0.005-19.173,0-28.665,1.06c-4.006,0.448-7.334,3.451-8.27,7.521c-1.334,5.797-1.35,12.125-1.35,18.094
                                            c0,5.969,0,12.296,1.334,18.093c0.936,4.07,4.264,7.073,8.272,7.521c9.49,1.061,19.097,1.065,28.662,1.061
                                            c9.566,0.005,19.171,0,28.664-1.061c4.006-0.448,7.336-3.451,8.272-7.521c1.333-5.797,1.34-12.124,1.34-18.093
                                            C83.61,58.031,83.62,51.704,82.287,45.907z M28.9,50.4h-5.54v29.438h-5.146V50.4h-5.439v-4.822H28.9V50.4z M42.877,79.839h-4.629
                                            v-2.785c-1.839,2.108-3.585,3.136-5.286,3.136c-1.491,0-2.517-0.604-2.98-1.897c-0.252-0.772-0.408-1.994-0.408-3.796V54.311
                                            h4.625v18.795c0,1.084,0,1.647,0.042,1.799c0.111,0.718,0.462,1.082,1.082,1.082c0.928,0,1.898-0.715,2.924-2.166v-19.51h4.629
                                            L42.877,79.839L42.877,79.839z M60.45,72.177c0,2.361-0.159,4.062-0.468,5.144c-0.618,1.899-1.855,2.869-3.695,2.869
                                            c-1.646,0-3.234-0.914-4.781-2.824v2.474h-4.625V45.578h4.625v11.189c1.494-1.839,3.08-2.769,4.781-2.769
                                            c1.84,0,3.078,0.969,3.695,2.88c0.311,1.027,0.468,2.715,0.468,5.132V72.177z M77.907,67.918h-9.251v4.525
                                            c0,2.363,0.773,3.543,2.363,3.543c1.139,0,1.802-0.619,2.066-1.855c0.043-0.251,0.104-1.279,0.104-3.134h4.719v0.675
                                            c0,1.491-0.057,2.518-0.099,2.98c-0.155,1.024-0.519,1.953-1.08,2.771c-1.281,1.854-3.179,2.768-5.595,2.768
                                            c-2.42,0-4.262-0.871-5.599-2.614c-0.981-1.278-1.485-3.29-1.485-6.003v-8.941c0-2.729,0.447-4.725,1.43-6.015
                                            c1.336-1.747,3.177-2.617,5.54-2.617c2.321,0,4.161,0.87,5.457,2.617c0.969,1.29,1.432,3.286,1.432,6.015v5.285H77.907z" />
                                        <path d="M70.978,58.163c-1.546,0-2.321,1.181-2.321,3.541v2.362h4.625v-2.362C73.281,59.344,72.508,58.163,70.978,58.163z" />
                                        <path d="M53.812,58.163c-0.762,0-1.534,0.36-2.307,1.125v15.559c0.772,0.774,1.545,1.14,2.307,1.14
			                                c1.334,0,2.012-1.14,2.012-3.445V61.646C55.824,59.344,55.146,58.163,53.812,58.163z" />
                                        <path d="M56.396,34.973c1.705,0,3.479-1.036,5.34-3.168v2.814h4.675V8.82h-4.675v19.718c-1.036,1.464-2.018,2.188-2.953,2.188
			                                c-0.626,0-0.994-0.37-1.096-1.095c-0.057-0.153-0.057-0.722-0.057-1.817V8.82h-4.66v20.4c0,1.822,0.156,3.055,0.414,3.836
			                                C53.854,34.363,54.891,34.973,56.396,34.973z" />
                                        <path d="M23.851,20.598v14.021h5.184V20.598L35.271,0h-5.242l-3.537,13.595L22.812,0h-5.455c1.093,3.209,2.23,6.434,3.323,9.646
			                                C22.343,14.474,23.381,18.114,23.851,20.598z" />
                                        <path d="M42.219,34.973c2.342,0,4.162-0.881,5.453-2.641c0.981-1.291,1.451-3.325,1.451-6.067v-9.034
			                                c0-2.758-0.469-4.774-1.451-6.077c-1.291-1.765-3.11-2.646-5.453-2.646c-2.33,0-4.149,0.881-5.443,2.646
			                                c-0.993,1.303-1.463,3.319-1.463,6.077v9.034c0,2.742,0.47,4.776,1.463,6.067C38.069,34.092,39.889,34.973,42.219,34.973z
			                                M39.988,16.294c0-2.387,0.724-3.577,2.231-3.577c1.507,0,2.229,1.189,2.229,3.577v10.852c0,2.387-0.722,3.581-2.229,3.581
			                                c-1.507,0-2.231-1.194-2.231-3.581V16.294z" />
                                    </g>
                                </g>
                            </svg>
                        </a>
                    </div>
                    <img src="img/support.png" class="support-img d-none d-lg-block" alt="support">
                </div>
            </div>
        </div>
    </section>
    <footer class="footer-wrapper">
        <div class="footer-copyright text-center py-3">© 2020 Copyright:
            <a href="index.php"> Youtube converter</a>
        </div>
    </footer>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('<?php echo SITE_KEY; ?>', {
                    action: 'homepage'
                })
                .then(function(token) {
                    //console.log(token);
                    document.getElementById('g-recaptcha-response').value = token;
                });
        });
    </script>

    <script src="js/main.js"></script>
</body>

</html>