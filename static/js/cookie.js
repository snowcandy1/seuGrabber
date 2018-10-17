function setCookie(name,value) { 
    var exp = new Date(); 
    exp.setTime(exp.getTime() + 36000); 
    document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString(); 
} 
function getCookie(name) { 
    var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
    if(arr=document.cookie.match(reg))
        return unescape(arr[2]); 
    else 
        return 0; 
} 
function clearCookie(){ 
	var keys=document.cookie.match(/[^ =;]+(?=\=)/g); 
	if (keys) { 
	for (var i = keys.length; i--;) 
	document.cookie=keys[i]+'=0;expires=' + new Date( 0).toUTCString() 
	} location.reload();
} 
