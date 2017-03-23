$(function() {
    $( '#sort-list' ).sortable({
        stop: function () {
            var inputs = $('input.currentposition');
            var nbElems = inputs.length;
            $('input.currentposition').each(function(idx) {
                $(this).val(idx);
                alert($(this).val());
            });
        }
    });
});