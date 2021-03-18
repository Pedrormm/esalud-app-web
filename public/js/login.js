$('.remember_password').on('click', function(e){
    e.preventDefault();

    showModal('Contraseña olvidada ', '', false, $(this).attr('href'), 'modal-xl', true, true, false, null, function() {

        // $('#rememberForgotten').submit();
        // $.post( PublicURL +"user/loginForgotten", $( "#rememberForgotten" ).serialize() );


        $.post( PublicURL +"user/loginForgotten", $( "#rememberForgotten" ).serialize() , function(res) {
                // console.log( "success",res );
                // $("#infoSession").text(res.message);
                if (res.status == 0){
                    $('<div />').addClass("alert alert-success").text(res.message).insertAfter( $( ".rememberme" ) );
                }
                else if (res.status == 1){
                    $('<div />').addClass("alert alert-danger").text(res.message).insertAfter( $( ".rememberme" ) );
                }
                else{
                    $('<div />').addClass("alert alert-danger").text("Unexpected error").insertAfter( $( ".rememberme" ) );
                }

          })
            .fail(function() {
                // console.log( "error" );
            })
            .always(function() {
                // console.log( "finished" );
            });

    }, "Volver", "Solicitar"); 

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
