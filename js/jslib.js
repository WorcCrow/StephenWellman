//Specify root directory. This configuration are good for making multi project on the same server.
var webroot = "/AdminLTEJobSheet/";

function rand(min, max) {
	//return random value, supply min and max value
	if (min==null && max==null)
		return 0;
	if (max == null) {
		max = min;
		min = 0;
	}
	return min + Math.floor(Math.random() * (max - min + 1));
}

function number_format(number) {
	return number.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
}

function numericOnly(event){
	//Prevent user from entering alphabet character on the input field
	//Use on keypress event
	var x = event.which || event.keyCode;
	if(isNaN(String.fromCharCode(x))){
		if(x != 8){
			event.preventDefault();
		}
	}
}

function IsJsonString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

function isNotEmptyJSON(data){
	var json = Object.values(data)
	for(x=0;x<json.length;x++){
		if(json[x] != ""){
			return true
		}
	}
	return false
}

function TimeConvertion(timestamp){
	var sec = parseInt(timestamp)
	if(sec < 0){
		return '00h:00m:00s'
	}
		
	var day = Math.floor(sec / 86400)
	day = day!=0?day + 'd ':''
	sec %= 86400
	
	var hour = Math.floor(sec / 3600)
	hour = hour!=0?hour + 'h:':'0h:'
	sec %= 3600
	
	var min = Math.floor(sec / 60)
	min = min!=0?min + 'm:':'0m:'
	sec %= 60
	
	sec = sec!=0?sec + 's':'0s'
	return day+hour+min+sec
}

function SendPOST(param){
	//{url, data, callback}
	var xhttp = new XMLHttpRequest();
	if(param.url === undefined){
		alert("Function Error!. URL parameter for SendPost should no be empty.")
		return
	}
	data = (param.data === undefined) ? "" : param.data;
	
	xhttp.onreadystatechange = function() {
		if(this.readyState == 4 && this.status == 200) {
			if(typeof param.callback === "function"){
				param.callback(this.responseText)
			}
		}
	};
	xhttp.open("POST", param.url, true);
	xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhttp.send(data);
}

function SendGET(param){
	//{url, callback}
	var xhttp = new XMLHttpRequest();
	if(param.url === undefined){
		alert("Function Error!. URL parameter for SendGET should no be empty.")
		return
	}
	
	xhttp.onreadystatechange = function() {
		if(this.readyState == 4 && this.status == 200) {
			if(typeof param.callback === "function"){
				param.callback(this.responseText)
			}
		}
	};
	xhttp.open("GET", param.url, true);
	xhttp.send();
}

function GenTpl(Obj){
	//{
	//	template:#Variable name of Template String#. ex: UserProfile,
	//	data:#Array of Object#. ex: [{name:"John",age:'12',waller:'200'}]
	//	format:#Array of Strings matched in the key of data#. ex: ['name','type','token','time','poster','dealerID']
	//	Dont use special name "index"
	//}
	temp = ""
	for(x=0;x<Obj.data.length;x++){
		temp2 = Obj.template
		for(y=0;y<Obj.format.length;y++){
			temp2 = temp2.replace(eval("/{{"+Obj.format[y]+"}}/g"),eval("Obj.data[x]." + Obj.format[y]))
		}
		temp2 = temp2.replace(/{{index}}/g,x)
		temp += temp2
	}
	return temp
}

function LocalJSON(name){
	
	this.name = name
	this.set = function(){
		return name
	}
}