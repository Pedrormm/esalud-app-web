$('.remember_password').on('click', function(e){
    e.preventDefault();
    showModal('Contraseña olvidada ', '', false, $(this).attr('href'), 'modal-xl', true, true, false, null, null, "Volver", "Solicitar"); 
});

$('.center, .icon-center').on('click', function(e){
    $(".icon-center").css("opacity", "0");
});

$( ".container-fluid" ).hover(
    () => { //hover
        $(".icon-center").css("opacity", "0");
    }, 
    () => { //out
      $(".icon-center").css("opacity", "1");
    }
);
