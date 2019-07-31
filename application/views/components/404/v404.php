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

    <title>404. Halaman Tidak Ditemukan :)</title>
</head>

<body background="bg-light align-items-center">
    <script>AOS.init();</script>
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

    <div class="text-center py-0 p-3">
        <b style="font-size: 40pt">404</b><br />
        <p>Halaman Tidak Ditemukan.</p>
        <div class="background" style="font-size: 150pt;">

        <svg viewBox="0 0 1320 300">
<!--pattern-->
	<defs>
    <pattern id="GPattern" x="0" y="0" width="20" height="20"
             patternUnits="userSpaceOnUse"
             patternTransform="rotate(35)" >
      <animateTransform attributeType="xml"
                        attributeName="patternTransform"
                        type="rotate" 
												from="35" 
												to="395" 
												begin="0"
                        dur="160s" repeatCount="indefinite"/>
			<circle cx="10" cy="10" r="10" stroke="none" fill="yellow">
			 <animate attributeName="r"
                      type="xml"
                      from="1" to="1"
								values="1; 10; 1"
                      begin="0s" dur="2s"
                      repeatCount="indefinite"
            />
			</circle>
    </pattern>
  </defs>
	
  <!-- Symbol -->
  <symbol id="s-text">
    <text text-anchor="middle"
          x="35%" y="50%" dy=".35em" width="100%" height="100%">
      4
    </text>
  </symbol>  
 <symbol id="v-text">
    <text text-anchor="middle"
          x="50%" y="50%" dy=".35em">
      0
    </text>
	  </symbol> 
	<symbol id="g-text">
    <text text-anchor="middle"
          x="65%" y="50%" dy=".35em">
      4
    </text>
	  </symbol> 
  <!-- Duplicate symbols -->
  <use xlink:href="#s-text" class="text"
       ></use>
  <use xlink:href="#s-text" class="text"
       ></use>
  <use xlink:href="#s-text" class="text"
       ></use>
  <use xlink:href="#s-text" class="text"
       ></use>
  <use xlink:href="#s-text" class="text"
       ></use>
  <use xlink:href="#v-text" class="text1">
	
	</use>
	<use xlink:href="#v-text" class="text1"
       ></use>
	<use xlink:href="#v-text" class="text1"
       ></use>
	 
	
	  <use id="g-usetag" xlink:href="#g-text" class="text2" style="fill: url(#GPattern)"/></use>
	
</svg>
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