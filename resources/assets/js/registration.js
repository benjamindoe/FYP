$(function() {
	$(".attendance-code").keypress(function(e){
		nextRegistrationInput($(this));
	});
	$('.attendance-code').keydown(function(e) {
		var code = e.keyCode || e.which;
		if (code == '9') {
			if(e.shiftKey) {
				prevRegistrationInput($(this));
			} else {
				nextRegistrationInput($(this));
			}
			return false;
		}
	});
});
function nextRegistrationInput($this)
{
	$this.parents('tr').next().find('.attendance-code[classperiod='+ $this.attr('classperiod')+']').focus();
}
function prevRegistrationInput($this)
{
	$this.parents('tr').prev().find('.attendance-code[classperiod='+ $this.attr('classperiod')+']').focus();
}
