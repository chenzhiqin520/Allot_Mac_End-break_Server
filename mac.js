    function QueryMacInfo(str)
    {
        if (str=="")
        {
            document.getElementById("MacInfoTxtHint").innerHTML="";
            return;
        } 
        if (window.XMLHttpRequest)
        {
            // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
            xmlhttp=new XMLHttpRequest();
        }
        else
        {
            // IE6, IE5 浏览器执行代码
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                document.getElementById("MacInfoTxtHint").innerHTML=xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","macinfo.php?q="+str,true);
        xmlhttp.send();
    }

    function QueryOneMacInfo(str)
    {
        if (str=="")
        {
            document.getElementById("OneMacInfoTxtHint").innerHTML="";
            return;
        } 
        if (window.XMLHttpRequest)
        {
            // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
            xmlhttp=new XMLHttpRequest();
        }
        else
        {
            // IE6, IE5 浏览器执行代码
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                document.getElementById("OneMacInfoTxtHint").innerHTML=xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","onemacinfo.php?q="+str,true);
        xmlhttp.send();
    }

    function QueryAddMac(str)
    {
        if (str=="")
        {
            document.getElementById("AddMacTxtHint").innerHTML="";
            return;
        } 
        if (window.XMLHttpRequest)
        {
            // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
            xmlhttp=new XMLHttpRequest();
        }
        else
        {
            // IE6, IE5 浏览器执行代码
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                document.getElementById("AddMacTxtHint").innerHTML=xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","macadd.php?q="+str,true);
        xmlhttp.send();
    }

    function QueryAddMacRange(str1,str2)
    {
        if (str1=="")
        {
            document.getElementById("MacInfoRangeTxtHint").innerHTML="";
            return;
        } 

        if (str2=="")
        {
            document.getElementById("MacInfoRangeTxtHint").innerHTML="";
            return;
        } 

        if (window.XMLHttpRequest)
        {
            // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
            xmlhttp=new XMLHttpRequest();
        }
        else
        {
            // IE6, IE5 浏览器执行代码
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                document.getElementById("MacInfoRangeTxtHint").innerHTML=xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","macaddrange.php?q="+str1+"&p="+str2,true);
        xmlhttp.send();
    }

    function CheckAddMacRange(macstart,macend)
    {
        var temp = /[A-Fa-f0-9]{2}:[A-Fa-f0-9]{2}:[A-Fa-f0-9]{2}:[A-Fa-f0-9]{2}:[A-Fa-f0-9]{2}:[A-Fa-f0-9]{2}/;
        if(!temp.test(macstart))
        {
            window.alert("输入的添加MAC格式验证失败，请输入正确的MAC格式！");
            return false;
        }
        if(!temp.test(macend))
        {
            window.alert("输入的添加MAC格式验证失败，请输入正确的MAC格式！");
            return false;
        }

        var minmacstart = macstart.toLowerCase();
        var minmacend = macend.toLowerCase();

        var arrmacstart = minmacstart.split(":");
        var arrmacend = minmacend.split(":");

        console.log(arrmacstart);
        console.log(arrmacend);

        var cmp_flag=0;
        var intarrmacstart=0;
        var intarrmacend=0; 
        for(var i=0;i<arrmacstart.length;i++)
        {
            intarrmacstart=arrmacstart[i];
            intarrmacend=arrmacend[i];

            console.log(intarrmacstart);
            console.log(intarrmacend);

            if(intarrmacstart>intarrmacend)
            {
                cmp_flag=1;
                break;
            }
            else if(intarrmacstart == intarrmacend)
            {
                continue;
            }
            else if(intarrmacstart<intarrmacend)
            {
                cmp_flag=0;
                break;
            }
        }

        console.log(cmp_flag);
        if(cmp_flag == 1)
        {
            window.alert("输入MAC段范围错误,后面必须大于前面，请输入正确的MAC段格式！");
            return false;
        }

        if(minmacstart == minmacend)
        {
            window.alert("输入MAC段范围错误,后面必须大于前面，请输入正确的MAC段格式！");
            return false;
        }else
        {
            QueryAddMacRange(minmacstart,minmacend);
        }
    }

    function CheckAddMac(addmacstr)
    {  
		var temp = /[A-Fa-f0-9]{2}:[A-Fa-f0-9]{2}:[A-Fa-f0-9]{2}:[A-Fa-f0-9]{2}:[A-Fa-f0-9]{2}:[A-Fa-f0-9]{2}/;
        if(!temp.test(addmacstr))
        {
			window.alert("输入的添加MAC格式验证失败，请输入正确的MAC格式！");
			return false;
        }
		else
		{	
            //document.getElementById("AddMacTxtHint").innerHTML=addmacstr;
            var minaddmacstr = addmacstr.toLowerCase();
            QueryAddMac(minaddmacstr);
			return true;
		}
    }

	function CheckOneMacInfo(oneaddmacstr)
	{
		var temp1 = /[A-Fa-f0-9]{2}:[A-Fa-f0-9]{2}:[A-Fa-f0-9]{2}:[A-Fa-f0-9]{2}:[A-Fa-f0-9]{2}:[A-Fa-f0-9]{2}/;
        if(!temp1.test(oneaddmacstr))
        {
            window.alert("输入的查询MAC格式验证失败，请输入正确的MAC格式！");
            return false;
        }
        else
        {   
            var minonemacstr = oneaddmacstr.toLowerCase();
            QueryOneMacInfo(minonemacstr);
            return true;
        }
    }