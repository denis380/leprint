$( document ).ready(function(){
    $('#btnExcluir').click(function(e){
        
        if(confirm('Tem certeza que deseja Excluir esse equipamento?')){
            alert('Equipamento excluido com sucesso');
        }else{
            e.preventDefault();
        }
        
    });

});

