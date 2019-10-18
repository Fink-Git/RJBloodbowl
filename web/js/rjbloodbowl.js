
$(document).ready(function(){
    $('#match_match').change(function(){
        if(!($('#match_match option:selected').text()).includes('Non Enregistre')){
            alert('Ce match a déja été enregistré.\n si vous le faites a nouveau, \nles anciennes données seront écrasées');
        }
    });
});