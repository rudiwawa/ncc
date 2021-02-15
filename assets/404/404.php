<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="../../css/index.css">
    <link rel="stylesheet" href="../../css/animation.css">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <title>404. Halaman Tidak Ditemukan :)</title>
</head>

<body background="bg-light align-items-center">
    <script>AOS.init();</script>
    <!--Header-->
    <header class="py-3 bg-light slide-bottom sticky-top">
        <div class="row flex-nowrap justify-content-around align-items-center">
            <div class="col-4 jusitfy-content-start pl-5">
                <a class="p-2 text-muted" href="#">Beranda</a>
                <a class="p-2 text-muted" href="#TentangAPELMAS">Tentang <b>APELMAS</b></a>
            </div>
            <div class="col-4 text-center">
                <a class="text-dark" href="#"><b>APELMAS</b> Kota Malang</a>
            </div>
            <div class="col-4 d-flex justify-content-end align-items-center pr-5">
                <a class="btn btn-sm btn-outline-secondary" data-toggle="popover" data-placement="left">Login</a>

                <script>
                    $(document).ready(function () {
                        $('[data-toggle="popover"]').popover({
                            container: 'body',
                            title: 'Login',
                            html: true,
                            placement: 'left',
                            sanitize: false,
                            content: function () {
                                return $("#popover-content").html();
                            }
                        });
                    });
                </script>

                <div id="popover-content" aria-hidden="true" style="display: none">
                    <p>Login hanya dilakukan oleh <b>petugas.</b></p>
                    <form>
                        <!-- my form -->
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                                else.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1"
                                placeholder="Password">
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <div id="popover-footer" aria-hidden="true" style="display: none">
                    <button type="button" class="btn btn-default">Button</button>
                </div>
            </div>
        </div>
    </header>

    <div class="text-center py-0 p-3">
        <b style="font-size: 40pt">404</b><br />
        <p>Halaman Tidak Ditemukan.</p>
        <div class="background">
            <img src="cloud-1.svg" class="animation cloudMo" id="img1" width="10%" height="10%" hidden="true" />
            <img class="background-malang" src="background.svg" id="img2" alt="background-kota-malang" width="80%"
                height="80%" hidden="true">

                <svg width="100%" height="100%">
                    <rect x="25%" y="25%" width="50%" height="50%" style="fill: dodgerblue;" />
                    <svg x="25%" y="25%" width="50%" height="50%">
                        <rect x="25%" y="25%" width="50%" height="50%" style="fill: tomato;" />
                    </svg>
                </svg>

            <!--<svg version="1.1" xmlns="http://www.w3.org/2000/svg">
                <img src="cloud-1.svg" class="cloudMo" width="10%" height="10%" />
            </svg>-->
        </div>
    </div>

    <footer class="bg-dark text-white py-0" data-aos="fade-up">
        <div class="container">
            <div class="row separated">
                <div class="col-lg-6 py-10">
                    <div class="row">
                        <div class="col-md-8">
                            <p><b>APELMAS</b> adalah <b>A</b>plikasi <b>PEL</b>ayanan <b>MAS</b>yarakat yang dikelola
                                oleh Pemerintah Kota Malang. </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <h4 class="eyebrow mb-3">Quick Links</h4>
                            <ul class="list-group list-group-columns">
                                <li class="list-group-item"><a href="about.html">About</a></li>
                                <li class="list-group-item"><a href="contact.html">Contact Us</a></li>
                                <li class="list-group-item"><a href="faq.html">FAQ</a></li>
                                <li class="list-group-item"><a href="blog.html">Blog</a></li>
                                <li class="list-group-item"><a href="text.html">Terms of Use</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 py-10">
                    <div class="row justify-content-end">
                        <div class="col-lg-10">
                            <h4 class="eyebrow mb-3">Subscribe</h4>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-lg" placeholder="Email"
                                    aria-label="Subscribe" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-white" type="button" id="button-addon2">Subscribe</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-lg-10">
                            <h4 class="eyebrow mb-3">Follow us</h4>
                            <nav class="nav nav-icons">
                                <a class="nav-link" href="#!"><i class="icon-facebook-o"></i></a>
                                <a class="nav-link" href="#!"><i class="icon-twitter-o"></i></a>
                                <a class="nav-link" href="#!"><i class="icon-youtube-o"></i></a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <p class="p-3 text-center"><b>NCC</b> Squad 2019.</p>
        </div>
    </footer>
</body>

</html>