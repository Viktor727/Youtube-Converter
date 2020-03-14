<?php
define('SITE_KEY', '');
define('SECRET_KEY', '');
if ($_POST) {
    function getCaptcha($SecretKey)
    {
        $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . SECRET_KEY . "&response={$SecretKey}");
        $Return = json_decode($Response);
        return $Return;
    }
    $Return = getCaptcha($_POST['g-recaptcha-response']);
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
                                <a class="nav-link" href="index.html">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">How does it work?</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">About product</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Constact us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <section class="meeting-wrapper d-flex align-items-center">
            <div class="container text-center text-xl-left pb-5 pt-5 form-container">
                <h1 class="site-title text-white text-uppercase text-center mb-3">
                    Youtube to MP3, MP4 subtitle converter
                </h1>
                <h5 class="subtitle text-white text-center pb-xl-4">
                    Just paste the youtube link and be happy !
                </h5>
                <form action="#" class="seach-form row" novalidate>

                    <div class="col-12 d-flex">
                        <div class='swith-row d-flex justify-content-center'>
                            <div class="switch">
                                <input type="radio" class="switch-input user_radio_btn" name="type" value="user" id="one" checked>
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
                                <input type="radio" class="switch-input admin_radio_btn" name="type" value="admin" id="two">
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
                        <input class="form-control search-input" type="text" placeholder="Youtube URL" aria-label="Search">
                        <button type="submit" class="search-btn btn text-uppercase">
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
                    <h2 class="text-center title">How does it work ?</h2>
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
            <h2 class="title text-center pt-5 pb-4">About product</h2>
            <div class="row">
                <div class="col-md-6 d-flex align-items-center">
                    <img src="img/about-product-wrapper.jpg" class="img-fluid d-block m-auto rounded" alt="about-product image">
                </div>
                <div class="col-md-6">
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
            <a href="#" class="btn btn-question mt-3 pl-5 pr-5 pt-2 pb-2">Ask a question</a>
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
                            <p class="card-text font-weight-lighter mt-4">We use Uptimia to monitor our pet pharmacy
                                e-commerce store and
                                could not be happier. We are particularly satisfied with
                                their speed monitoring service. They saved us from trouble many times.</p>
                        </div>
                    </div>
                    <div class="card p-3">
                        <img src="img/slider2.jpg" class="d-block m-auto slider-img pt-3 pl-3 pr-3" alt="person image">
                        <div class="card-body">
                            <h5 class="card-title block-title mb-3">Alberto Raya</h5>
                            <h6 class="card-subtitle text-uppercase">Backend Developer</h6>
                            <p class="card-text font-weight-lighter mt-4">We use Uptimia to monitor our pet pharmacy
                                e-commerce store and
                                could not be happier. We are particularly satisfied with
                                their speed monitoring service. They saved us from trouble many times.</p>
                        </div>
                    </div>
                    <div class="card p-3">
                        <img src="img/slider3.jpg" class="d-block m-auto slider-img pt-3 pl-3 pr-3" alt="person image">
                        <div class="card-body">
                            <h5 class="card-title block-title mb-3">Uruewa Himona</h5>
                            <h6 class="card-subtitle text-uppercase">Manager</h6>
                            <p class="card-text font-weight-lighter mt-4">We use Uptimia to monitor our pet pharmacy
                                e-commerce store and
                                could not be happier. We are particularly satisfied with
                                their speed monitoring service. They saved us from trouble many times.</p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>

    <section class="contact-wrapper" id="contact">
        <div class="container shadow rounded">
            <div class="row pt-4 pb-4">
                <div class="col-lg-8 bg-white">
                    <h2 class="title mb-0 mt-3 text-center text-lg-left">Send a message</h2>
                    <!-- <h3 class="subtitle text-center text-lg-left mb-5">Send a message</h3> -->
                    <form class="needs-validation form" id="form" method="post" novalidate>
                        <div class="row">
                            <div class="group col-6">
                                <input type="text" id="first-name" name="first-name" minlength="3" required>
                                <label for="first-name">First Name</label>

                                <div class="valid-feedback">
                                    Looks good !
                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid name.
                                </div>
                            </div>
                            <div class="group col-6">
                                <input type="text" id="last-name" name="last-name" minlength="3" required>
                                <label for="last-name">Last name</label>

                                <div class="valid-feedback">
                                    Looks good !
                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid name.
                                </div>
                            </div>


                            <div class="group col-12">
                                <input type="email" id="email" name="email" required>
                                <label for="email">Email address</label>

                                <div class="valid-feedback">
                                    Looks good !
                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid email adress.
                                </div>
                            </div>

                            <div class="group col-12">
                                <input type="text" id="theme" name="theme" autocomplete="off" minlength="3" required>
                                <label for="theme">Theme</label>

                                <div class="valid-feedback">
                                    Looks good !
                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid theme.
                                </div>
                            </div>

                            <div class="group col-12">
                                <textarea id="message" name="message" rows="1" autocomplete="off" minlength="10" required></textarea>
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
                            <button type="submit" class="form-btn btn pl-4 pr-4 pt-2 pb-2">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4"></div>
            </div>
        </div>
        </div>
    </section>






















    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('<?php echo SITE_KEY; ?>', {
                    action: 'homepage'
                })
                .then(function(token) {
                    document.getElementById('g-recaptcha-response').value = token;
                });
        });
    </script>

    <script src="js/main.js"></script>
</body>

</html>