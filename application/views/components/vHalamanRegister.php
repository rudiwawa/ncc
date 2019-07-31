<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="<?php echo base_url(); ?>css/index.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/animation.css">

    <title>Register</title>
</head>

<body background="bg-light align-items-center">
    <!--Header-->
    <header class="py-3 bg-light slide-bottom sticky-top">
        <div class="row flex-nowrap justify-content-around align-items-center">
            <div class="col-4 jusitfy-content-start pl-5">
                <a class="p-2 text-muted" href="<?php echo base_url(); ?>">Beranda</a>
            </div>
            <div class="col-4 text-center">
                <a class="text-dark" href="<?php echo base_url(); ?>"><b>APELMAS</b> Kota Malang</a>
            </div>
            <div class="col-4 d-flex justify-content-end align-items-center pr-5">
                <a class="btn btn-sm btn-outline-secondary" data-toggle="popover" data-placement="left" href="<?php echo site_url('cLogin/index'); ?>">Login</a>
            </div>
        </div>
    </header>

    <div class="py-0 p-3">
        <b style="font-size: 20pt">Register</b><br />
        <p>Silahkan register pada halaman di bawah ini: </p>
        <div class="background">
            <form>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Masukkan nama" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"
                        required>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <br />
            <p>Kembali ke <a href="<?php echo site_url('cLogin/index'); ?>">halaman login</a>.</p>
        </div>
    </div>

       <!--Footer-->
       <footer class="bg-dark text-white py-5" data-aos="fade-up">
        <div class="container">
            <div class="row separated">
                <div class="col-lg-6 py-5">
                    <div class="row">
                        <div class="col-md-8">
                            <p><b>APELMAS</b> adalah <b>A</b>plikasi <b>PEL</b>ayanan <b>MAS</b>yarakat yang dikelola
                                oleh Pemerintah Kota Malang. </p>
                        </div>
                    </div>
                </div>
            </div>
            <p class="pb-3 text-left"><b>NCC</b> Squad 2019.</p>
        </div>
    </footer>
</body>

</html>