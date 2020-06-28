$(document).ready(function() {
	
	// Expand Panel
	$("#open").click(function(){
		$("div#panel").slideDown("slow");
	
	});	
	
	$("#open2").click(function(){
		$("div#panel").slideDown("slow");
	});	
	
	$("#open3").click(function(){
		$("div#panel").slideDown("slow");
	});	
	
	$("#open4").click(function(){
		$("div#panel").slideDown("slow");
	});	
	
	$("#open5").click(function(){
		$("div#panel").slideDown("slow");
	});	
	// Collapse Panel
	$("#close").click(function(){
		$("div#panel").slideUp("slow");	
	});		
	
	// Collapse Panel
	$("#close2").click(function(){
		$("div#panel").slideUp("slow");	
	});	
	// Collapse Panel
	$("#close3").click(function(){
		$("div#panel").slideUp("slow");	
	});	
	// Collapse Panel
	$("#close4").click(function(){
		$("div#panel").slideUp("slow");	
	});	
	$("#close5").click(function(){
		$("div#panel").slideUp("slow");	
	});
	// Switch buttons from "Log In | Register" to "Close Panel" on click
	$("#toggle a").click(function () {
		$("#toggle a").toggle();
	});		
		
});