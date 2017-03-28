$('.mdl-card').click(function(){
    if($(this).hasClass('expanded'))
    {
        $(this).height('auto');
        $(this).removeClass('expanded');
    } else {
        $(this).height(500);
        $(this).addClass('expanded');
    }
});