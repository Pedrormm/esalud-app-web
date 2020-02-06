$(function() {

});

function asyncCall(endpoint, jQselector) {
    $.ajax(_PUBLIC_URL + endpoint, {
        method:'get',
        dataType:'html',
        async:true,
    }).success(function(res, st, xhr) {

        //console.log("success arguments", arguments);
        if($(jQselector).length) {
            $(jQselector).html(res);
            $(jQselector).show();
        }
        else {
            console.warn("Destiantion layer", jQselector, "not found");
        }
    }).fail(function(xhr, status, error) {
        console.log("fail arguments", arguments);
    });
}