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

    <link rel="stylesheet" href="sass/style.css">
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
                            <span class="d-none d-sm-block">Test now!</span>
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
            <div class="row pr-5 pl-5">
                <div class="col-12 mt-4 mt-lg-0">
                    <h2 class="how-use-title text-center">How to use ?</h2>
                    <p class="why-wat-text text-left">Your website might not load for you, but there is always a chance
                        it is
                        because of your internet service provider, browser or other local problems. Also, your website
                        might be unavailable only in the region you live in. Use our website availability tool to get
                        detailed information about the health of your website from 11 checkpoints on 6 continents.</p>
                </div>
            </div>
        </div>
    </section>






























    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
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