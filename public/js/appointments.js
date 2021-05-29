
$('.editarCita').click(function(e){
    e.preventDefault();
    let id = $(this).data('id');
    showModal(_messagesLocalization.edit_appointment + ' '+ id, '', false, $(this).attr('href') + "/"+ id + "/edit", 'modal-xl',
     true, true, false, null, function() {
         
            $('#saveEditAppointment').submit();
         
    }); 
});

$('.btnAcceptAppointment').click((e) => {
    let id=$(this).data('id');
    
});