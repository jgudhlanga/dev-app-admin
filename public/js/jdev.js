function waitBusy(container, effect, text, color, bg) {
	$('#'+container+'').waitMe({
		effect : (effect != undefined) ? effect : 'win8_linear',
		text : text,
		bg : (bg != undefined) ? bg : 'rgba(255,255,255,0.7)',
		color : (color != undefined) ? color : '#f7b133',
		maxSize : "",
		waitTime : -1,
		textPos: 'horizontal'
	});
}
