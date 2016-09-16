$(function(){
    $("#add-novo-endereco").click( function(){
        var currentCount = $('#cliente fieldset > fieldset').length;
        var template = $('#cliente fieldset > span').data('template');
        template = template.replace(/__index__/g, currentCount);
        $('#cliente > div > fieldset').append(template);
        return false;
    });
});