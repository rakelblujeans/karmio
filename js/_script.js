

/* to toggle deal description */

function toggle(showHideDiv, switchImgTag) {

        var ele = document.getElementById(showHideDiv);

        var imageEle = document.getElementById(switchImgTag);

        if(ele.style.display == "block") {

                ele.style.display = "none";

		imageEle.innerHTML = '<img src="images/plus.png" alt="" />';

        }

        else {

                ele.style.display = "block";

                imageEle.innerHTML = '<img src="images/minus.png" alt="" />';

        }

} 



function togglefunc(showHideDiv, switchImgTag) {

        var ele = document.getElementById(showHideDiv);

        var imageEle = document.getElementById(switchImgTag);

        if(ele.style.display == "block") {

                ele.style.display = "none";

        }

        else {

                ele.style.display = "block";

        }

} 



/* toggle login form */

function toggle2(showHideDiv, switchImgTag) {

        var ele = document.getElementById(showHideDiv);

        var imageEle = document.getElementById(switchImgTag);

        if(ele.style.display == "block") {

                ele.style.display = "none";

        }

        else {

                ele.style.display = "block";

        }

}



/* hide buy button and display quantity box */

function buyQty(myId, price) {

	var buy = document.getElementById('buyBtn'+myId);

	var qtyBox = document.getElementById('qtyBox'+myId);

	buy.className = "hide";

	qtyBox.className = "identifier";



	updQtyTtl(myId, '-1000', price);

}



/* change quantity */

function updQtyTtl(myId, inc, price) {

	inc 		= parseInt(inc);

	price		= parseFloat(price);

	var qtyV	= document.getElementById('qtyV'+myId);

	var qty		= document.getElementById('qty'+myId);

	var total	= document.getElementById('total'+myId);

	//var total2	= document.getElementById('total2'+myId);

	var val		= parseInt(qtyV.value);



	val += inc;

	if(val < 1) val = 1;
	if(val > 3) val = 3;

	qtyV.value = val;

	

	if(val <= 3) qty.innerHTML = '0'+val;

	else qty.innerHTML = val;



	total.innerHTML = '$'+val*price;

	//total2.innerHTML = val*price;

}



/* ajax submit form for cart */

function updCart(myId)

{

	var urlF = document.getElementById('cartForm'+myId);

	urlP = urlF.action;

	



	$.ajax({

  	type: 'POST',

  	url: urlP,

  	data: $("#cartForm"+myId).serialize(),

  	success: function(data){

				$("#buyMain"+myId).html(data);

			}

	});



}



/* ajax submit remove for cart */

function remCart(myId)

{

	var urlF = document.getElementById('remCartForm'+myId);

	urlP = urlF.action;

	



	$.ajax({

  	type: 'POST',

  	url: urlP,

  	data: $("#remCartForm"+myId).serialize(),

  	success: function(data){

				$("#buyMain"+myId).html(data);

			}

	});



}



/* update store list after fancy box */

function updStoreList(urlP)

{

	$.ajax({

		type	: "POST",

		cache	: false,

		url		: urlP,

		success	: function(data) {

					$("#storePlace").html(data);

				},

		error	: function() {

					alert("error");

				}

	});

}



/* sticky login */

function stickyLogin()

{

	$("#login-form").show();

	$("#hiddenLogin").fancybox({

								'enableEscapeButton'	: false,

								'showCloseButton'		: true,

								'hideOnOverlayClick'	: false,

								'centerOnScroll'		: false,

								'onComplete'			: updateWidthFancy()

							}).trigger('click');

}



/* sticky store */

function stickyStore(url)

{
	//alert('asdf');

	jQuery.fancybox({

								'enableEscapeButton'	: false,

								'showCloseButton'		: false,

								'hideOnOverlayClick'	: false,

								'centerOnScroll'		: true,

								'href'					: url,

								'onComplete'			: updateWidthFancy()

							}).trigger('click');

}



function signupFancy(url)

{

	$(".signup").fancybox({

							'enableEscapeButton'	: true,

							'showCloseButton'		: true,

							'hideOnOverlayClick'	: true,

							'href'					: url,

							'onComplete'			: updateWidthFancy()

						});

}



/* ajax load a page for signup*/

function fancyLoad(url, loadInto)

{
//alert(loadInto);
	$.ajax({

  	url: url,

  	success: function(data){

				$("#"+loadInto).replaceWith(data);

				updateWidthFancy();

				//alert(data);

				//$(".signup").fancybox(data);

			}

	});

}



/* ajax submit form signup */

function signupFancySubmit(url)

{

	$.ajax({

  	type: 'POST',

  	url: url,

  	data: $("#cartForm"+myId).serialize(),

  	success: function(data){

				$("#buyMain"+myId).html(data);

				updateWidthFancy();

			}

	});



}



/* update fancybox with after ajax call */

function updateWidthFancy()

{

	var myWidth = 0;

	myWidth = $('#fancybox-content').width();

	$('#fancybox-content').find('div').each(function(){

			if(myWidth < $(this).width())

				myWidth = $(this).width();

	});

	$('#fancybox-content').width(myWidth);

	myWidth += 20;

	$('#fancybox-wrap').width(myWidth);

	//alert(myWidth);

	//$.fancybox.resize();

}



/* update dates */

function updateProductDate(fld, id, val, compareto)
{
	if(fld  == 'to' && $("#"+compareto).val()!= 'mm/dd/yy')
	{
		date1 = new Date($("#"+compareto).val());
		date2 = new Date(val);
		if(date1 > date2)
		//if($("#"+compareto).val() > val)
		{
			alert('Select a date greater than start date!');
			$("#"+id).val('mm/dd/yy')
		}
	}
	else if(fld  == 'frm' && $("#"+compareto).val()!= 'mm/dd/yy')
	{
		date1 = new Date($("#"+compareto).val());
		date2 = new Date(val);
		if(date1 < date2)
		//if($("#"+compareto).val() < val)
		{
			alert('Select a date less than end date!');
			$("#"+id).val('mm/dd/yy')
		}
	}
	else
	{
		
		var months=new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"); // condensed array
		val = val.split('-');
		//adjust month value for array;
		val[1] -= 1;
		// some errors..
		$("#"+fld+'Month').html(months[val[1]]);
		$("#"+fld+'Day').html(val[2]+'<br /><span>'+val[0]+'</span>');
		//alert(fld+' '+val);
	}
	// add a check that FROM date must be less than TO date
	//if publish date
/*
	if(fld == 'frm')
	{
		var curTime = new Date();
		var pubTime = new Date($("#publishDate").val());
		//var dat=Date.parse(date);
		//var theDate = new Date(dat); 
		//alert(curTime+':'+curTime.getTime()+' '+$("#publishDate").val()+':'+oldTime.getTime());
		if(curTime.getTime() >= pubTime.getTime())
		{
			$("#frmMonth").focus();
			alert('helo');
			$("#publishDate").trigger("focus");
		}
	}
*/
}

/* update organization details while creating a deal */

function updOrgId(orgName, orgId)

{

	$("#orgId").val(parseInt(orgId));

	$("#orgName").val(orgName);

	$.fancybox.close();

}



/* change visibility of pledge amount field */

function switchPledgeFields(a, b, x)

{

	// make active a and deactivate b

	$("#"+a).removeClass('pInactive');

	$("#"+b).addClass('pInactive');



	//

	$("#p-active").val(x);

	$("#pledge-amount").val('').focus();

	

}

function Previewdeal()

{

	$("#preview").show();/*

	$(".preview").fancybox({

								'enableEscapeButton'	: true,

								'showCloseButton'		: true,

								'hideOnOverlayClick'	: true,

								'centerOnScroll'		: true,

								'onComplete'			: updateWidthFancy()

							}).trigger('click');*/

}