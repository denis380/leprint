$('.printers-on').hide();
$('.printers-off').hide();
$(document).ready(function(e){

    $('#btnPrintersOn').click(function(){
        $('.printers-off').hide();
        $('.printers-on').show();
    });
    $('#btnPrintersOff').click(function(){
        $('.printers-on').hide();
        $('.printers-off').show();
    });

    
    
});