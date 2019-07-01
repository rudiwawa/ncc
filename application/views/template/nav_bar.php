<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-127655187-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-127655187-1');
</script>
<nav id="navbar" class="navbar navbar-expand-md navbar-dark fixed-top shadow-sm shadow-none py-1">
    <a class="navbar-brand mr-0" href="#">
        <img id="logo-brand" src="<?=base_url()?>assets/img/transparant-hitam-putih.png" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link text-light" href="<?=base_url()?>">Kampung Budaya</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Info
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Pengumuman</a>
                    <div class="dropdown-divider"></div>
                    <!-- <a class="dropdown-item" href="#">Something else here</a> -->
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Acara
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <!-- <a class="dropdown-item" href="#">Something else here</a> -->
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="<?=base_url()?>post/berita/">Berita</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="<?=base_url()?>post/selendangsekar/">Selendang Sekar</a>
            </li>
                        <li class="nav-item">
                <a class="nav-link text-light" href="<?=base_url()?>pricingfontkb">Pricing</a>
            </li>
        </ul>
        <form class="form-inline my-1 mx-md-1">
           <!--  <a href="http://kb.tempemenjes.com/pribadi/sena/user_authentication/index" class="btn btn-outline-light btn-block btn-sm" >Masuk</a> -->
        </form>
<!--         <div class="list-inline">
            <div class="btn-group w-100" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-outline-light w-50">Daftar</button>
                <button type="button" class="btn btn-outline-light w-50">Masuk</button>
            </div>
        </div> -->
    </div>
</nav>