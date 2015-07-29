function getFormValue() //взаимодействет с формой ввода логина и пароля
	{
	$(function()
		{
		///////////////////////////////
		$('#auth_button').click(send);
		function send()
			{
			var login = document.getElementById("login").value;
			var password = document.getElementById("password").value;
			//alert(login);
			//alert(password);
			$.ajax({
		    type: "GET",
		    url: "/tj/ajaxpages/autorisation.php",
		    data: "login="+login+"&password="+password,
		    success: function(msg){window.location="/tj/"}
		    });
			}
		
		
		//console.log(login);
		//////////////////////////////
		})
	}
function getFormConfirmed()
	{
	$(function()
		{
		$('#logoff_button').click(logoff);
		function logoff()
			{
			//alert(1);
			$.ajax
				({
				type: "GET",
				url: "/tj/ajaxpages/logoff.php",
				success: function(msg)
					{
					window.location="/tj/";
					}
				});
			}
		})
	}
function save_project_position ()//сохраняет в куках позицию проекта при выборе, заменяет поле причин блокировки
	{
	$(function()
		{
		function set_cookie_project_sel(sel_proj_value)
			{
			document.cookie = "sel_proj_value="+sel_proj_value;
			};
		function set_reasons_list(project_value)
			{
			$.ajax({
		    type: "GET",
		    url: "/tj/ajaxpages/reason_input.php",
		    data: "project_num="+project_value,
		    success: function(msg){$('#select_reasons').html(msg)}
		    });
			};
		$('#select_projects').change(function(){set_cookie_project_sel(this.value);set_reasons_list(this.value)});
		})
	}
function submit_form ()
	{
	$(function()
		{
		$("#add_form").submit(function() 
			{
			var form_data = $("#add_form").serialize();
			$.ajax({
		    type: "GET",
		    url: "/tj/ajaxpages/create_add_notes.php",
		    data: form_data,
		    success: function(msg){add_notes(msg)}
		    });
			});
		})
	}
function add_notes()//добавляет список блокировок
	{
	$.ajax({
	type: "GET",
		    url: "/tj/ajaxpages/block_list_menu.php",
		    success: function(msg){$('#notes_block').html(msg);equip_search_form();}
		    });
	
	}
function equip_search_form () //оснащает функционалом форму поиска
	{
	turn.add_turn_button_auth();
	turn.add_turn_button_addform();
	//turn.add_turn_button_searchform();
	function set_value_reason()//создает спосок выбора причины блокировки в зависимости от выбранного раздела
		{
	var reason_select_value = $('#search_form_project_select').val();
	$.ajax({
	type: "GET",
		    url: "/tj/ajaxpages/get_list_reasons.php",
			data:'num_project='+reason_select_value,
		    success: function(msg){$('#search_form_reason_select').html(msg);equip_select_project();active_delbutton();_correct.equip()}
		    });
		}
	function equip_select_project()
		{
		$('#search_form_project_select').change(function(){set_value_reason()});
		}
	function equip_search_submit()//вешает функцию перезагрузки списка блокировок на кнопку отправки формы
	{
	$(function()
		{
		$("#search_form").submit(function(){reload_notes_list ()});
		})
	}

	equip_search_submit();
	set_value_reason();
	}
function active_delbutton()//делает действующей кнопку удаления записи
		{
		$('.del_button').click(function(){sumbit_delnore_request(this.getAttribute('string_id'))});
		};
function sumbit_delnore_request(note_id)//посылает запрос на удаление записи
	{
	$.ajax({
	type: "POST",
	url: "/tj/ajaxpages/del_note.php",
	data: "note_id="+note_id,
	success: function(msg){reload_notes_list ()}
	});
	}
function reload_notes_list ()//перезагружает блок списка блокировок
			{
			var form_data = $("#search_form").serialize();
			$.ajax({
		    type: "GET",
		    url: "/tj/ajaxpages/block_list.php",
		    data: form_data,
		    success: function(msg){$('#notes_body').html(msg);active_delbutton();_correct.equip()}
		    });
			}
_correct = 
	{
	comment_input: function (target) //вызваете поле редактирования содержимого по двойному клику
		{
		var target_html = target.innerHTML;
		if (target.trigger!=true)
		{
		target.trigger=true;
		target.innerHTML=('<textarea colrow="1" onBlur="_correct.comment_write(this)"  class="tmp_input" value="'+target_html+'">'+target_html+'</textarea>');
		var in_put=target.childNodes[0];
		in_put.focus();
		}
		},
	comment_write: function (target)//сохраняет содержимое при потере фокуса
		{
		target.parentElement.trigger=false;
		var update_comm_id = target.parentElement.id.substr(8);
		var update_comm_text = target.value;
		target.parentElement.innerHTML=target.value;
		$.ajax({
		type: "POST",
		url: "/tj/ajaxpages/update_note.php",
		data: "comment_id="+update_comm_id+"&comment_text="+update_comm_text,
		success: function(msg){console.log(msg)}
		});
		
		
		
		},
	comment_equip: function() //оснащает поля коментариев инструментом корректировка значений
		{
		$('.block_list_comment').dblclick(function(){_correct.comment_input(this)});
		},
	equip: function ()
		{
		this.comment_equip();
		}
		
	};
turn = //добавляет кнопки свенуть/развернуть к блокам
{
add_turn_button_auth:function ()
	{
	$('.auth_block').append('<img id="turn_button_auth" class="turn_button" src="/tj/img/minus.gif"></img>');
	if (getCookie("turn_auth")!=1)
		{
		this.turn_auth_on();
		}
		else
		{
		this.turn_auth_off();
		}
	},
add_turn_button_addform: function ()
	{
	$('.create_block').append('<img id="turn_addform_auth" class="turn_button" src="/tj/img/minus.gif"></img>');
	if (getCookie("turn_addform")!=1)
		{
		this.turn_addform_on();
		}
		else
		{
		this.turn_addform_off();
		}
	},
add_turn_button_searchform:function()
	{
	//$('#notes_block').append('<img class="turn_button" src="/tj/img/minus.gif"></img>');
	},
turn_auth_on:function()
	{
	$("#turn_button_auth").each(function(){this.src='/tj/img/minus.gif'});
	$('#turn_button_auth').click(function(){turn.turn_auth_off()});
	$('.auth_block').css('overflow','visible');
	$('.auth_block').css('height','35px');
	document.cookie="turn_auth=0";

	},
turn_auth_off:function()
	{
	$("#turn_button_auth").each(function(){this.src='/tj/img/plus.gif'});
	$('#turn_button_auth').click(function(){turn.turn_auth_on()});
	$('.auth_block').css('overflow','hidden');
	$('.auth_block').css('height','9px');
	document.cookie="turn_auth=1";
	},
turn_addform_on:function()
	{
	$("#turn_addform_auth").each(function(){this.src='/tj/img/minus.gif'});
	$('#turn_addform_auth').click(function(){turn.turn_addform_off()});
	$('.create_block').css('overflow','visible');
	$('.create_block').css('height','');
	//document.cookie="turn_addform=0";
	deleteCookie("turn_addform");
	},
turn_addform_off:function()
	{
	$("#turn_addform_auth").each(function(){this.src='/tj/img/plus.gif'});
	$('#turn_addform_auth').click(function(){turn.turn_addform_on()});
	$('.create_block').css('overflow','hidden');
	$('.create_block').css('height','9px');
	document.cookie="turn_addform=1";
	}

}
	
	
	
	
	
	

add_notes ();
submit_form ();
getFormValue();
getFormConfirmed();
save_project_position ();
//get
//alert ('a');
/* --- Swazz Javascript Calendar ---
/* --- v 1.0 3rd November 2006
By Oliver Bryant
http://calendar.swazz.org

Update:
Gene Bechtold
http://www.bechtold.biz
12/11/2011

C помощью разных добрых людей:
tullin
 */

function getObj(objID)
{
    if (document.getElementById) {return document.getElementById(objID);}
    else if (document.all) {return document.all[objID];}
    else if (document.layers) {return document.layers[objID];}
}

function checkClick(e) {
	e?evt=e:evt=event;
	CSE=evt.target?evt.target:evt.srcElement;
	if (CSE.tagName!='SPAN')
	if (getObj('fc'))
		if (!isChild(CSE,getObj('fc')))
			getObj('fc').style.display='none';
}

function isChild(s,d) {
	while(s) {
		if (s==d)
			return true;
		s=s.parentNode;
	}
	return false;
}

function Left(obj)
{
	var curleft = 0;
	if (obj.offsetParent)
	{
		while (obj.offsetParent)
		{
			curleft += obj.offsetLeft
			obj = obj.offsetParent;
		}
	}
	else if (obj.x)
		curleft += obj.x;
	return curleft;
}

function Top(obj)
{
	var curtop = 0;
	if (obj.offsetParent)
	{
		while (obj.offsetParent)
		{
			curtop += obj.offsetTop
			obj = obj.offsetParent;
		}
	}
	else if (obj.y)
		curtop += obj.y;
	return curtop;
}

// Calendar script
var now = new Date;
var sccd=now.getDate();
var sccm=now.getMonth();
var sccy=now.getFullYear();
var ccm=now.getMonth();
var ccy=now.getFullYear();

// For current selected date
var selectedd, selectedm, selectedy;

document.write('<table id="fc" style="z-index:1;position:absolute;border-collapse:collapse;background:#FFFFFF;border:1px solid #FFD088;display:none;-moz-user-select:none;-khtml-user-select:none;user-select:none;" cellpadding="2">');
document.write('<tr style="font:bold 13px Arial" onselectstart="return false"><td style="cursor:pointer;font-size:15px" onclick="upmonth(-1)">&laquo;</td><td colspan="5" id="mns" align="center"></td><td align="right" style="cursor:pointer;font-size:15px" onclick="upmonth(1)">&raquo;</td></tr>');
document.write('<tr style="background:#FF9900;font:12px Arial;color:#FFFFFF"><td align=center>П</td><td align=center>В</td><td align=center>С</td><td align=center>Ч</td><td align=center>П</td><td align=center>С</td><td align=center>В</td></tr>');
for(var kk=1;kk<=6;kk++) {
	document.write('<tr>');
	for(var tt=1;tt<=7;tt++) {
		num=7 * (kk-1) - (-tt);
		document.write('<td id="cv' + num + '" style="width:18px;height:18px">&nbsp;</td>');
	}
	document.write('</tr>');
}
document.write('<tr><td colspan="7" align="center" style="cursor:pointer;font:13px Arial;background:#FFC266" onclick="today()">Сегодня: '+addnull(sccd,sccm+1,sccy)+'</td></tr>');
document.write('</table>');

document.all?document.attachEvent('onclick',checkClick):document.addEventListener('click',checkClick,false);




var updobj;
function lcs(ielem) {
	updobj=ielem;
	getObj('fc').style.left=Left(ielem)+'px';
	getObj('fc').style.top=Top(ielem)+ielem.offsetHeight+'px';
	getObj('fc').style.display='';

	// First check date is valid
	curdt=ielem.value;
	curdtarr=curdt.split('-');
	isdt=true;
	for(var k=0;k<curdtarr.length;k++) {
		if (isNaN(curdtarr[k]))
			isdt=false;
	}
	if (isdt&(curdtarr.length==3)) {
		ccm=curdtarr[1]-1;
		ccy=curdtarr[2];

		selectedd=parseInt ( curdtarr[0], 10 );
		selectedm=parseInt ( curdtarr[1]-1, 10 );
		selectedy=parseInt ( curdtarr[2], 10 );

		prepcalendar(curdtarr[0],curdtarr[1]-1,curdtarr[2]);
	}

}

function evtTgt(e){
	var el;
	if(e.target)el=e.target;
	else if(e.srcElement)el=e.srcElement;
	if(el.nodeType==3)el=el.parentNode; // defeat Safari bug
	return el;
}
function EvtObj(e){if(!e)e=window.event;return e;}
function cs_over(e) {
	evtTgt(EvtObj(e)).style.background='#FFEBCC';
}
function cs_out(e) {
	evtTgt(EvtObj(e)).style.background='#FFFFFF';
}
function cs_click(e) {
	updobj.value=calvalarr[evtTgt(EvtObj(e)).id.substring(2,evtTgt(EvtObj(e)).id.length)];
	getObj('fc').style.display='none';
}

var mn=new Array('Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентрябрь','Октябрь','Ноябрь','Декабрь');
var mnn=new Array('31','28','31','30','31','30','31','31','30','31','30','31');
var mnl=new Array('31','29','31','30','31','30','31','31','30','31','30','31');
var calvalarr=new Array(42);

function f_cps(obj) {
	obj.style.background='#FFFFFF';
	obj.style.font='10px Arial';
	obj.style.color='#333333';
	obj.style.textAlign='center';
	obj.style.textDecoration='none';
	obj.style.border='1px solid #FFD088';//'1px solid #606060';
	obj.style.cursor='pointer';
}

function f_cpps(obj) {
	obj.style.background='#C4D3EA';
	obj.style.font='10px Arial';
	obj.style.color='#FF9900';
	obj.style.textAlign='center';
	obj.style.textDecoration='line-through';
	obj.style.border='1px solid #6487AE';
	obj.style.cursor='default';
}

function f_hds(obj) {
	obj.style.background='#FFF799';
	obj.style.font='bold 10px Arial';
	obj.style.color='#333333';
	obj.style.textAlign='center';
	obj.style.border='1px solid #6487AE';
	obj.style.cursor='pointer';
}

// day selected
function prepcalendar(hd,cm,cy) {
	now=new Date();
	sd=now.getDate();
	td=new Date();
	td.setDate(1);
	td.setFullYear(cy);
	td.setMonth(cm);
	cd=td.getDay();
	if (cd==0)cd=6; else cd--;
	getObj('mns').innerHTML=mn[cm]+'&nbsp;<span style="cursor:pointer" onclick="upmonth(-12)">&lt;</span>'+cy+'<span style="cursor:pointer" onclick="upmonth(12)">&gt;</span>';
	marr=((cy%4)==0)?mnl:mnn;
	for(var d=1;d<=42;d++) {
		cv=getObj('cv'+parseInt(d));
		f_cps(cv);
		if ((d >= (cd -(-1)))&&(d<=cd-(-marr[cm]))) {
			dip=((d-cd < sd)&&(cm==sccm)&&(cy==sccy));
			htd=((hd!='')&&(d-cd==hd));

			cv.onmouseover=cs_over;
			cv.onmouseout=cs_out;
			cv.onclick=cs_click;

			// if today
			if (sccm == cm && sccd == (d-cd) && sccy == cy)
				cv.style.color='#FF9900';

			// if selected date
			if (cm == selectedm && cy == selectedy && selectedd == (d-cd) )
			{
				cv.style.background='#FFEBCC';
				//cv.style.color='#e0d0c0';
				//cv.style.fontSize='1.1em';
				//cv.style.fontStyle='italic';
				//cv.style.fontWeight='bold';

				// when use style.background
				cv.onmouseout=null;
			}

			cv.innerHTML=d-cd;

			calvalarr[d]=addnull(d-cd,cm-(-1),cy);
		}
		else {
			cv.innerHTML='&nbsp;';
			cv.onmouseover=null;
			cv.onmouseout=null;
			cv.onclick=null;
			cv.style.cursor='default';
			}
	}
}

prepcalendar('',ccm,ccy);

function upmonth(s)
{
	marr=((ccy%4)==0)?mnl:mnn;

	ccm+=s;
	if (ccm>=12)
	{
		ccm-=12;
		ccy++;
	}
	else if(ccm<0)
	{
		ccm+=12;
		ccy--;
	}
	prepcalendar('',ccm,ccy);
}

function today() {
	updobj.value=addnull(now.getDate(),now.getMonth()+1,now.getFullYear());
	getObj('fc').style.display='none';
	prepcalendar('',sccm,sccy);
}

function addnull(d,m,y)
{
	var d0='',m0='';
	if (d<10)d0='0';
	if (m<10)m0='0';

	return ''+d0+d+'-'+m0+m+'-'+y;
}

//////////////////////////////////////////////// конец календаря
function getCookie(name) {
  var matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}
function deleteCookie(name) {
  setCookie(name, "", {
    expires: -1
  })
}
function setCookie(name, value, options) {
  options = options || {};

  var expires = options.expires;

  if (typeof expires == "number" && expires) {
    var d = new Date();
    d.setTime(d.getTime() + expires * 1000);
    expires = options.expires = d;
  }
  if (expires && expires.toUTCString) {
    options.expires = expires.toUTCString();
  }

  value = encodeURIComponent(value);

  var updatedCookie = name + "=" + value;

  for (var propName in options) {
    updatedCookie += "; " + propName;
    var propValue = options[propName];
    if (propValue !== true) {
      updatedCookie += "=" + propValue;
    }
  }

  document.cookie = updatedCookie;
}