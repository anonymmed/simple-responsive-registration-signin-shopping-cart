$(function(){


    $('.star').on('mouseover', function(){
        var indexAtual = $('.star').index(this);
        for(var i=0; i<= indexAtual; i++){
            $(this).closest('.star-rating').find('.star').eq(i).addClass('full');
        }
    });
    $('.star').on('mouseout', function(){
        $('.star').removeClass('full');
    });

    $('.star').on('click', function(){
        var idArticle = $('.article').attr('data-id');
        var voto = $(this).attr('data-vote');
        $.post('sys/votar.php', {votar: 'sim', artigo: idArticle, ponto: voto}, function(retorno){
            avaliacao(retorno.average);
            $('.votos span').html(retorno.votos);
        }, 'jSON');
    });
});