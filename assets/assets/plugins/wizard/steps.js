$(".tab-wizard").steps({
    headerTag: "h6",
    bodyTag: "section",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: {
        finish: "Submit"
    }, 
    onFinished: function (event, currentIndex) {
        var form = $(this);
        // Submit form input
        form.submit();        
    }
});


var form = $(".validation-wizard").show();


$(".validation-wizard").steps({
    headerTag: "h6"
    , bodyTag: "section"
    , transitionEffect: "fade"
    , titleTemplate: '<span class="step">#index#</span> #title#'
    , labels: {
        finish: "Submit"
    }
    , onStepChanging: function (event, currentIndex, newIndex) {
        return currentIndex > newIndex || !(3 === newIndex && Number($("#age-2").val()) < 18) && (currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error").remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form.validate().settings.ignore = ":disabled,:hidden", form.valid())
    }
    , onFinishing: function (event, currentIndex) {
        return form.validate().settings.ignore = ":disabled", form.valid()
    }
    , onFinished: function (event, currentIndex) {
        var pass = $("#pass").val();
        var repass = $("#repass").val();
        console.log(pass);
        console.log(repass);
        
        if(pass == repass){
            if($("#md_checkbox_26").is(":checked")){
                swal("Input Berhasil!", "Selamat Input Anda Berhasil.. Silahkan Lakukan Verifikasi Email Untuk Mangaktifkan Akun Anda.. :)");
                
                window.location.href = "http://localhost:8080/adminpress/main/test_wizard.php";
            }else{
                swal("Input Galat!", "Mohon Konfirmasi Jika Data Anda adalah Data yang Benar..! :(");
            }
        }else{
            swal("Input Galat!", "Mohon Pastikan jika Input Password dan Ulangi Password Adalah Sama.! :(");
        }
        
         
    }
}), $(".validation-wizard").validate({
    ignore: "input[type=hidden]"
    , errorClass: "text-danger"
    , successClass: "text-success"
    , highlight: function (element, errorClass) {
        $(element).removeClass(errorClass)
    }
    , unhighlight: function (element, errorClass) {
        $(element).removeClass(errorClass)
    }
    , errorPlacement: function (error, element) {
        error.insertAfter(element)
    }
    , rules: {
        email: {
            email: !0
        }
    }
})