
var event_add = document.getElementById("button_add");
event_add.onclick = function(){
	document.getElementById("modal_add").style.display="flex";
}

var event_select = document.getElementById("button_select");
event_select.onclick = function(){
	document.getElementById("modal_select").style.display="flex";
}

var event_edit = document.getElementsByClassName("button_edit");
for (var i = 0; i < event_edit.length; i++ ){
	event_edit[i].onclick = function(){
		document.getElementById("modal_edit").style.display="flex";
	};
}

var event_delete = document.getElementsByClassName("button_delete");
for (var j = 0; j < event_delete.length; j++ ){
	event_delete[j].onclick = function(){
		document.getElementById("modal_delete").style.display="flex";
	};
}

var event_close = document.getElementsByClassName("button_close");
var hide_modal = document.getElementsByClassName("modal_back");
for( var k = 0; k < event_close.length; k++){
	event_close[k].onclick = function(){
		for (var p = 0; p < event_close.length; p++){
			hide_modal[p].style.display="none";
		};
	};
}





