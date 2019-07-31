<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="<?php echo base_url(); ?>css/index.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/animation.css">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <?php foreach($ket_jenis as $row) { 
    $judul = $row['ket_jenis'];
    ?>
    <title><?php echo $judul; } ?></title>
</head>

<body>
    <script>AOS.init();</script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/index.js">
    </script>

    <!--Header-->
    <header class="py-3 bg-light slide-bottom">
        <div class="row flex-nowrap justify-content-around align-items-center">
            <div class="col-4 jusitfy-content-start pl-5">
                <a class="text-muted" href="<?php echo base_url(); ?>">Beranda</a>
            </div>
            <div class="col-4 text-center">
                <a class="text-dark" href="<?php echo base_url(); ?>"><b>APELMAS</b> Kota Malang</a>
            </div>
            <div class="col-4 d-flex justify-content-end align-items-center pr-5">
                <a class="btn btn-sm btn-outline-secondary" data-toggle="popover" data-placement="left" href="<?php echo site_url('cLogin/index'); ?>">Login</a>
            </div>
    </header>

    <!--Tentang APELMAS-->
    <div class="jumbotron jumbotron-fluid parallax">
        <div class="container text-right">
            <h2 class="display-5"><b><?php echo $judul; ?></b></h2>
            <p><b><?php echo $judul; ?></b> di Kota Malang.</p>
        </div>
    </div>

    <!--Wisata-->
    <div class="wisata m-5">
        <div id="container pl-5">
            <div class="text-left" data-aos="zoom-in">
                <h4 class="display-5"><?php echo $judul; ?></h4>
            </div>

            <div class="bd-example">
                <div class="row">
                    <div class="col-4">
                        <h4 class="eyebrow mb-3">Pilih Kategori</h4>
                        <?php foreach($subdaftarWisata as $row) { ?>
                        <div id="list-example" class="list-group">
                            <a class="list-group-item list-group-item-action" href="<?php echo '#'.preg_replace('/\s+/', '', strtolower($row['ket_sub_jenis'])); ?>"><?php echo $row['ket_sub_jenis']; ?></a>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="col-8">
                        <h4 class="eyebrow mb-3">DESKRIPSI</h4>
                        <div data-spy="scroll" data-target="#list-example" data-offset="0" class="scrollspy-example">
                        <?php foreach($subdaftarWisata as $row) { ?>
                            <div id="<?php echo preg_replace('/\s+/', '', strtolower($row['ket_sub_jenis'])); ?>">
                                <!--Judul-->
                                <h4><?php echo $row['ket_sub_jenis']; ?></h4>

                                <!--Subjenis-->
                                <div class="card-deck">
                                    <div class="card">
                                        <img class="card-img-top" src="<?php echo base_url(); ?>assets/index.jpg" alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text"><small class="text-muted">Last updated 3 mins
                                                    ago</small>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <img class="card-img-top" src="<?php echo base_url(); ?>assets/index.jpg" alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text"><small class="text-muted">Last updated 3 mins
                                                    ago</small>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <img class="card-img-top" src="<?php echo base_url(); ?>assets/index.jpg" alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text"><small class="text-muted">Last updated 3 mins
                                                    ago</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!--Buttons-->
                                <div class="col text-right m-2">
                                    <a href="<?php echo site_url('cPariwisata/getDetailPariwisata/'.$row['id_sub']); ?>" class="btn btn-outline-primary">Detail</a>
                                </div>

                                <hr>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
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