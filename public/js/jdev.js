function waitBusy(container, color, text) {
	$('#'+container+'').waitMe({
		effect : 'stretch',
		text : text,
		bg : 'rgba(255,255,255,0.7)',
		color : (color != undefined) ? color : '#f7b133',
		maxSize : "",
		waitTime : -1,
		textPos: 'vertical'
	});
}

function showPassword() {

	var key_attr = $('#password').attr('type');

	if(key_attr != 'text') {
		$('.checkbox').addClass('show');
		$('#password').attr('type', 'text');
	} else {
		$('.checkbox').removeClass('show');
		$('#password').attr('type', 'password');
	}
}

$(document).ready(function() {
	$(".btn-pref .btn").click(function () {
		$(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
		$(this).removeClass("btn-default").addClass("btn-primary");
	});
});