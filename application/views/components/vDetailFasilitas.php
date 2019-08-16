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
    <script src="https://kit.fontawesome.com/fe225ab5a5.js"></script>

    <?php foreach($detailFasilitas as $row) { $fasilitas = $row['ket_main']; ?>
    <title><?php echo $fasilitas; } ?></title>

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
            <h2 class="display-5"><b><?php echo $fasilitas; ?></b></h2>
            <p>Informasi tempat fasilitas di Kota Malang.</p>
        </div>
    </div>

    <!--Wisata-->
    <div class="wisata m-5">
        <div id="container pl-5">
            <div class="text-left" data-aos="zoom-in">
            <?php foreach($detailFasilitas as $row) { ?>
                <h4 class="display-5"><?php echo $row['ket_main'];?></h4>
                    <p><i class="fa fa-map-marker"></i>
                        <?php $detail = json_decode($row['detail'], true);
                        echo $detail["alamat"][0]["alamat"] . "<br>"; ?>
                    <i class="fas fa-flag"></i> <b>Lattitude:</b> <?php $location = json_decode($detail["alamat"][0]["loc"], true); 
                    echo $location[0] . "|"; ?><b> Longitude: </b><?php echo $location[1]; ?></p>
                <hr>

                <h4 class="display-5"><i class="far fa-image"></i> Galeri</h4>
                <?php $galeri = json_decode($row['img'], true); 
                for($counter = 0; $counter < sizeof($galeri); $counter++) { ?>
                    <img src="<?php echo base_url(); ?>uploads/<?php echo $galeri[$counter]; ?>" alt="<?php echo $row['ket_main']."_galleri"; ?>" width="150px" height="150px">
                <?php } ?>
                <hr>

                <h4 class="display-5"><i class="fas fa-phone"></i> Kontak</h4>
                <?php
                $web = $detail["website"];
                $email = $detail["email"];
                $telp = $detail["tlp"];
                if ($web != null) {
                    echo '<p><i class="fas fa-globe"></i>'."\n".$web.'<br>';
                }
                if ($email != null) {
                    echo '<p><i class="fas fa-envelope"></i>'."\n".$email.'<br>';
                }
                if ($telp != null) {
                    echo '<p><i class="fas fa-phone"></i>'."\n".$telp.'<br></p>';
                }
                ?>
                <hr>

                <h4 class="display-5"><i class="fas fa-align-left"></i> Deskripsi</h4>
                <p><?php echo $detail['ket']; ?></p>
                <hr>

            <?php } ?>
                <h4 class="display-5">Lihat Lainnya</h4>
                <div class="card-columns">
                <?php foreach($fasilitasLain as $row) { 
                    $galeri = json_decode($row['img'], true); ?>
                        <div class="card" width="100px" height="100px">
                            <img class="card-img-top" src="<?php echo base_url(); ?>uploads/<?php echo $galeri[0]; ?>" alt="<?php echo $row['ket_main']; ?>">
                            <div class="card-body">
                            <h5 class="card-title"><a href="<?php echo site_url('cFasilitas/getDetailFasilitas/').$row['id_fasilitas']; ?>"><?php echo $row['ket_main']; ?></a></h5>
                                <p class="card-text"><small class="text-muted"><?php echo "Diupdate : " . $row['time_update'] . " oleh: " . "<b>" .$row['id_admin']; "</b>"?></small>
                                            </p>
                            </div>
                        </div>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>

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