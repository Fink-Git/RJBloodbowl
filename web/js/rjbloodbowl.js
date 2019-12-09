
$(document).ready(function(){
    //alert($('#match_match')[0].value);
    inforencontre($('#match_match')[0].value)
    $('#match_match').change(function() {
        if(!($('#match_match option:selected').text()).includes('Non Enregistre')){
            alert('Ce match a déja été enregistré.\n si vous le faites a nouveau, \nles anciennes données seront écrasées');
        }

        var idrencontre = $(this)[0].value;
        //alert(window.location.hostname);
        inforencontre(idrencontre);
    });
});

function inforencontre(idrencontre){
    $.ajax({
        type: 'POST',
        //TODO remplacer par app.php
        url: 'http://' + window.location.hostname + '/app_dev.php/Rencontre/info',
        data: {
            'idrencontre': idrencontre
        },
        dataType: 'json'
    })
    .done(function(result){
            if(result.error == false){
                $('#coach1').text('Coach 1 (' + result.rencontre.coach1 + ')');
                $('#coach2').text('Coach 2 (' + result.rencontre.coach2 + ')');
                $('#match_score_coach1').val(result.rencontre.scorecoach1);
                $('#match_score_coach2').val(result.rencontre.scorecoach2);
                $('#match_sorties_coach1').val(result.rencontre.sortiescoach1);
                $('#match_sorties_coach2').val(result.rencontre.sortiescoach2);
            }
    });
}


