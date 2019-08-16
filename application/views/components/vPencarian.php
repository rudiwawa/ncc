<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/user/index.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/user/animation.css">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <title>Pencarian</title>
</head>
<body>
    
<script>AOS.init();</script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/user/index.js">
    </script>

    <!--Header-->
    <header class="py-3 bg-light slide-bottom">
        <div class="row flex-nowrap justify-content-around align-items-center">
            <div class="col-4 text-center">
                <a class="text-dark" href="<?php echo base_url(); ?>"><b>APELMAS</b> Kota Malang</a>
            </div>
    </header>

    <!--Tentang APELMAS-->
    <div class="jumbotron jumbotron-fluid parallax">
        <div class="container text-right">
            <h2 class="display-5"><b>Pencarian</b></h2>
        </div>
    </div>

    <div class="m-5">
        <div id="container pl-5">
            <h4 class="display-5"><b>Pencarian</b></h4>
                <form method="GET" action="<?php echo site_url('cPencarian/getDataPencarian') ?>" >
                <p>Pilih kategori:<br>
                    <input type="radio" name="kategori" value="pariwisata" required> Pariwisata
                    <input type="radio" name="kategori" value="fasilitas" required> Fasilitas<br></p>
                <p><input type="text" name="pencarian" placeholder="Cari..." required></p>
                <!--Buttons-->
                <div class="text-left">
                    <input type="submit" name="submit" value="Cari">
                </div>
                </form>
        </div>
    </div>

    <div class="m-5">
    <?php 
    if ($cariPariwisata != null) {
        foreach($cariPariwisata as $row) { 
    } ?>
    <p><?php echo "Hasil Pencarian: " . $row["ket_main"]; ?></p>
    <?php } ?>
    </div>

    <!--Footer-->
    <footer class="py-0">
        <div class="container">
            <div class="row separated">
                <div class="col-lg-6 py-10">
                    <div class="row">
                        <div class="col-md-8">
                            <p><b>APELMAS</b> adalah <b>A</b>plikasi <b>PEL</b>ayanan <b>MAS</b>yarakat yang dikelola
                                oleh Pemerintah Kota Malang. </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 py-10">
                    <div class="row justify-content-end">
                        <div class="col-lg-10">
                        <h4 class="eyebrow mb-3">Quick Links</h4>
                            <ul class="list-group list-group-columns">
                                <li class="list-group-item"><a href="<?php echo site_url('CPariwisata/getDaftarPariwisata'); ?>">Halaman Pariwisata</a></li>
                                <li class="list-group-item"><a href="<?php echo site_url('CFasilitas/getDaftarFasilitas'); ?>">Halaman Fasilitas</a></li>
                                <li class="list-group-item"><a href="<?php echo site_url('CPencarian/getPencarian'); ?>">Pencarian</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

</body>
</html>