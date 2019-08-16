//document.addEventListener('contextmenu', event => event.preventDefault());

// Detect request animation frame
/*window.addEventListener('scroll', function() {
  console.log("Scrollin'");
});

var scroll = window.requestAnimationFrame ||
             // IE Fallback
             function(callback){ window.setTimeout(callback, 1000/60)};
var elementsToShow = document.querySelectorAll('.show-on-scroll'); 

function loop() {

    Array.prototype.forEach.call(elementsToShow, function(element){
      if (isElementInViewport(element)) {
        element.classList.add('is-visible');
      } else {
        element.classList.remove('is-visible');
      }
    });

    scroll(loop);
}

// Call the loop for the first time
loop();

// Helper function from: http://stackoverflow.com/a/7557433/274826
function isElementInViewport(el) {
  // special bonus for those using jQuery
  if (typeof jQuery === "function" && el instanceof jQuery) {
    el = el[0];
  }
  var rect = el.getBoundingClientRect();
  return (
    (rect.top <= 0
      && rect.bottom >= 0)
    ||
    (rect.bottom >= (window.innerHeight || document.documentElement.clientHeight) &&
      rect.top <= (window.innerHeight || document.documentElement.clientHeight))
    ||
    (rect.top >= 0 &&
      rect.bottom <= (window.innerHeight || document.documentElement.clientHeight))
  );
}

const callback = function(entries) {
  entries.forEach(entry => {
    entry.target.classList.toggle("is-visible");
  });
};

const observer = new IntersectionObserver(callback);

const targets = document.querySelectorAll(".show-on-scroll");
targets.forEach(function(target) {
  observer.observe(target);
});*/

/*Resize Class*/
$(window).on('resize', function() {
  console.log('Width: ' + $(window).width() + ',' + "Height: " + $(window).height());

  var pilih_kategori = document.getElementById("pilih_kategori");
  var deskripsi = document.getElementById("deskripsi");

  console.log(pilih_kategori);

  /*if ($(window).width() <=1000) {
    Ganti kelas
    $('#pilih_kategori').removeClass('col-4');
    $('#deskripsi').removeClass('col-8');
    
    $('#pilih_kategori').addClass('col pb-2');
    $('#pilih_kategori').one(append('</div><div class="row">'));

    $('#deskripsi').addClass('pb-2');
    $('#deskripsi').one(append('</div>'));
  
  } else {
    /*Ganti Kelas
    $('#pilih_kategori').removeClass('col pb-2');
    $('#deskripsi').removeClass('col');

    $('#pilih_kategori').addClass('col-4');
    $('#deskripsi').addClass('col-8');
  }*/

  if ($(window).width() <= 900) {

    $('#pilih_kategori').removeClass('col-4');
    $('#pilih_kategori').addClass('col');
    
    $('#deskripsi').css({
      "box-sizing": "content-box"
    });

    $('#deskripsi').removeClass('col-8');
    $('#deskripsi').addClass('row p-4');

  }
  else {

    $('#pilih_kategori').removeClass('col');
    $('#pilih_kategori').addClass('col-4');
    
    $('#deskripsi').css({
      "box-sizing": "border-box"
    });

    $('#deskripsi').removeClass('row p-4');
    $('#deskripsi').addClass('col-8');
  
  }
});
