$(document).ready(function() {
	var agent = navigator.userAgent.toLowerCase();
	if (agent.indexOf("ftzmall_app") >= 0) {
		$("header").remove();
		$("footer").remove();
		$("section").children().first().css("margin-top", "0px");
	}
	if(agent.indexOf("android") >= 0){
		$("body").append("<input id='channelType' value='Android'>");
	}else if(agent.indexOf("mac os x") >= 0 && agent.indexOf("mobile") >= 0){
		$("body").append("<input id='channelType' value='ios'>");
	}
});