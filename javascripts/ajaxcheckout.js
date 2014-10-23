/* The following function creates an XMLHttpRequest object... */
function createDeleteRequestObject(){
	var delete_request_o; 
	var browser = navigator.appName;
	if(browser == "Microsoft Internet Explorer"){
		delete_request_o = new ActiveXObject("Microsoft.XMLHTTP");
	}else{
		delete_request_o = new XMLHttpRequest();
	}
	return delete_request_o; 
}
var http = createDeleteRequestObject(); 

function setChangeShipMethod(shipping_method,shipping_rate)
{
	for (var i = 0; i < document.formcheckout.tax_exempt_status.length; i++) 
	{
	  if (document.formcheckout.tax_exempt_status[i].checked) 
		{
            break;
        }
    }
tax_exempt_status=document.formcheckout.tax_exempt_status[i].value;	
document.formcheckout.shipping_method.value='';
document.formcheckout.shipping_rate.value='';
//document.formcheckout.couponcode.value='';
document.formcheckout.shipping_method.value=shipping_method;
document.formcheckout.shipping_rate.value=shipping_rate;
http.open('get', 'process/get_shipping_rate_checkout.php?shipzip='+ document.formcheckout.shipzip.value+'&shipping_method='+ document.formcheckout.shipping_method.value+'&tax_exempt_status='+ document.formcheckout.tax_exempt_status[i].value+'&shipping_rate='+ document.formcheckout.shipping_rate.value);
http.onreadystatechange=updateShipMethodChanged 
http.send(null)
}

function setSaleTax(tax_exempt_status)
{
var tax_exempt;
tax_exempt=tax_exempt_status;

for (var i = 0; i < document.formcheckout.tax_exempt_status.length; i++) 
	{
	  if (document.formcheckout.tax_exempt_status[i].checked) 
		{
            break;
        }
    }
	
/*Add new sript*/
check_shipping_method=document.formcheckout.shipping_method.value;	
	if(check_shipping_method=='')
	{
	alert('Please choose a shipping method first');		
	}
	else
	{
if(tax_exempt=='Y')
	{
document.getElementById("sales_tax_new").innerHTML='$0.00';
document.getElementById("sales_tax_new_hide").innerHTML='';
http.open('get', 'process/get_shipping_rate.php?shipzip='+ document.formcheckout.shipzip.value+'&shipping_method='+ document.formcheckout.shipping_method.value+'&tax_exempt_status='+ document.formcheckout.tax_exempt_status[i].value+'&shipping_rate='+ document.formcheckout.shipping_rate.value);
http.onreadystatechange=updateSaleTaxChanged 
http.send(null)
	}
if(tax_exempt=='N')
	{
http.open('get', 'process/get_shipping_rate.php?shipzip='+ document.formcheckout.shipzip.value+'&shipping_method='+ document.formcheckout.shipping_method.value+'&tax_exempt_status='+ document.formcheckout.tax_exempt_status[i].value+'&shipping_rate='+ document.formcheckout.shipping_rate.value);
http.onreadystatechange=updateSaleTaxChanged 
http.send(null)
	}
	}//end of else condition
	
}


function updateShipMethodChanged() 
{ 
if(http.readyState==4)
 { 
	var response_update = http.responseText;
//	alert(response_update);
	document.getElementById("txttotal").innerHTML='$'+response_update;
	document.getElementById("shipping_rate").innerHTML='$'+document.formcheckout.shipping_rate.value;
	document.getElementById("shipping_method").innerHTML=document.formcheckout.shipping_method.value+':';
	document.getElementById("shipping").innerHTML='';
	for (var i = 0; i < document.formcheckout.tax_exempt_status.length; i++) 
	{
	  if (document.formcheckout.tax_exempt_status[i].checked) 
		{
            break;
        }
    }
	if((document.formcheckout.sstate[document.formcheckout.sstate.selectedIndex].value=='NJ') 
	&& (document.formcheckout.tax_exempt_status[i].value=='N'))
	{
	var sub_total,shipping_rate,sub_total,sales_tax,sales_total;
	sub_total=document.formcheckout.sub_total.value;
	shipping_rate=document.formcheckout.shipping_rate.value;
	coupon_amount=document.formcheckout.coupon_rate.value;
	if(coupon_amount=='')
	{
	coupon_amount="0.00";	
	}
	else
	{
	coupon_amount;	
	}
	
	sub_total=(parseFloat(sub_total)+parseFloat(shipping_rate)-parseFloat(coupon_amount));
	sales_tax=(parseFloat(sub_total)/100*7);
	sales_total=sales_tax.toFixed(2);
    document.getElementById("sales_tax_new").innerHTML='$'+sales_total;
	document.getElementById("sales_tax_new_hide").innerHTML='';
	}
	if((document.formcheckout.sstate[document.formcheckout.sstate.selectedIndex].value!='NJ'))
	{
	document.getElementById("sales_tax_new").innerHTML='$0.00';
	document.getElementById("sales_tax_new_hide").innerHTML='';
	}
	document.getElementById("shipping_rate_hide").innerHTML='';
	document.getElementById("totalamounthide").innerHTML='';
 } 
}

function updateSaleTaxChanged() 
{ 
if(http.readyState==4)
 { 
	var response_update = http.responseText;
	//alert(response_update);
	
	for (var i = 0; i < document.formcheckout.tax_exempt_status.length; i++) 
	{
	  if (document.formcheckout.tax_exempt_status[i].checked) 
		{
            break;
        }
    }    
	tax_exempt_status=document.formcheckout.tax_exempt_status[i].value;	
	if((document.formcheckout.sstate[document.formcheckout.sstate.selectedIndex].value=='NJ') 
	&& (tax_exempt_status=='N'))
	{
	var sub_total,shipping_rate,sub_total,sales_tax,sales_total,invoice_total,coupon_amount;
	sub_total=document.formcheckout.sub_total.value;
	shipping_rate=document.formcheckout.shipping_rate.value;
	coupon_amount=document.formcheckout.coupon_rate.value;
	if(coupon_amount=='')
	{
	coupon_amount="0.00";	
	}
	else
	{
	coupon_amount;	
	}
	var response_update_new=response_update.replace(/,/g,'');    //now without comma
	sub_total=parseFloat(sub_total)+parseFloat(shipping_rate)-parseFloat(coupon_amount);

	sales_tax=((parseFloat(sub_total)/100*7));
	sales_total=sales_tax.toFixed(2);
//	invoice_total=response_update_new.toFixed(2);
	invoice_total=response_update;
	document.getElementById("sales_tax_new").innerHTML='$'+sales_total;
	document.getElementById("sales_tax_new_hide").innerHTML='';
	document.getElementById("totalamounthide").innerHTML='';	
	document.getElementById("txttotal").innerHTML='$'+invoice_total;
	}
	
	if((document.formcheckout.sstate[document.formcheckout.sstate.selectedIndex].value=='NJ') 
	&& (tax_exempt_status=='Y'))
	{
	coupon_amount=document.formcheckout.coupon_rate.value;
	if(coupon_amount=='')
	{
	coupon_amount="0.00";	
	}
	else
	{
	coupon_amount;	
	}
	var response_update_new=response_update.replace(/,/g,'');    //now without comma
	invoice_total=(parseFloat(response_update_new))-(parseFloat(coupon_amount));
	invoice_total=response_update;
	document.getElementById("txttotal").innerHTML='$'+invoice_total;
	document.getElementById("shipping_rate").innerHTML='$'+document.formcheckout.shipping_rate.value;
	document.getElementById("shipping_rate_hide").innerHTML='';
	document.getElementById("totalhide").innerHTML='';
	document.getElementById("totalamounthide").innerHTML='';
	} //end of NJ and status Y
	 } 
}


function VerifyStateChange(state)
{
	if(state=='PR')
	{
	document.formcheckout.shipcountry.value="PR";	
	}
}



function verifyShippingAddress(shipping)
{
if(document.formcheckout.shipcountry.value=='US')
	{
var shipaddress1,shipaddress2,shipcity,sstate,shipzip,shipcountry;
http.open('get','process/get_address_validation_checkout.php?shipaddress1='+document.formcheckout.shipaddress1.value+'&shipaddress2='+document.formcheckout.shipaddress2.value+'&shipcompany='+document.formcheckout.shipcompany.value+'&shipcity='+document.formcheckout.shipcity.value+'&sstate='+ document.formcheckout.sstate.value+'&shipzip='+ document.formcheckout.shipzip.value+'&shipcountry='+ document.formcheckout.shipcountry.value);
http.onreadystatechange=updateAddressValidationChanged
http.send(null)
	}
else
	{
alert('Address Verification is Only Applicable to US Territories');	
	}
}

function updateAddressValidationChanged() 
{ 
if(http.readyState==4)
 { 
	var response_update = http.responseText;
	document.getElementById("verifyaddress").innerHTML=http.responseText;
/*$("#verifyaddress").overlay({ 
	top: "25%",
	expose: { 
	
	color: '#000', 
	
	loadSpeed: 200, 
	
	opacity: 0.5 
	}, 
	api: true 
	}).load(); */
	
 } 
}


function changeShippingAddress(shipaddress)
{
var shipaddress1,shipaddress2,shipcity,sstate,shipzip;
var ShipAddressResult = shipaddress.split("|");
shipaddress1=ShipAddressResult[0];
shipaddress2=ShipAddressResult[1];
shipcity=ShipAddressResult[2];
sstate=ShipAddressResult[3];
shipzip=ShipAddressResult[4];

document.formcheckout.shipaddress1.value=shipaddress1;
document.formcheckout.shipaddress2.value=shipaddress2;
document.formcheckout.shipcity.value=shipcity;
document.formcheckout.sstate.value=sstate;
document.formcheckout.shipzip.value=shipzip;
document.getElementById("verifyaddress").innerHTML='';
}


function CouponCheck()
{
	check_shipping_method=document.formcheckout.shipping_method.value;	
	if(check_shipping_method=='')
	{
	alert('Please select shipping method  before applying coupon');		
	}
	else
	{
	if(document.formcheckout.couponcode.value!='')
	{
	http.open('get', 'process/get_coupon_checkout.php?sstate='+document.formcheckout.sstate.value+'&couponcode='+ document.formcheckout.couponcode.value);
	http.onreadystatechange=updateCouponChanged 
	http.send(null)	
	}//end of if
	}//end of else condition check 
}
	
	
	
function updateCouponChanged() 
{ 
if(http.readyState==4)
 { 
	var tot_amount,coupon_amount;
	var countitem = http.responseText;
//	alert(countitem);
	var mySplitResult = countitem.split("|");
	
	for (var i = 0; i < document.formcheckout.tax_exempt_status.length; i++) 
	{
	  if (document.formcheckout.tax_exempt_status[i].checked) 
		{
            break;
        }
    }
	//coupon_amount=document.formcheckout.coupon_rate.value;
	if(mySplitResult[5]=="Y")
	{
	coupon_amount=mySplitResult[1];
	tot_amount=mySplitResult[4];
	tot_amount_comma=mySplitResult[6];
	tax_exempt_status=document.formcheckout.tax_exempt_status[i].value;
	document.getElementById("coupon_active").style.display="block";
	/*Condition check state is NJ and tax status N*/
	if((document.formcheckout.sstate[document.formcheckout.sstate.selectedIndex].value=='NJ') 
	&& (tax_exempt_status=='N'))
	{
	

	var sub_total,shipping_rate,sub_total,sales_tax,sales_total,invoice_total;
	sub_total=document.formcheckout.sub_total.value;
	shipping_rate=document.formcheckout.shipping_rate.value;
	sub_total=(parseFloat(sub_total)+parseFloat(shipping_rate)-parseFloat(coupon_amount));
	sales_tax=(parseFloat(sub_total)/100*7);
	sales_total=sales_tax.toFixed(2);
    invoice_total=(parseFloat(tot_amount));
	invoice_total=invoice_total.toFixed(2);
	
/*	var withouttax;	
	withouttax=tot_amount_comma-mySplitResult[2];	
	tot_amount_comma=withouttax.toFixed(2);
*/	
//	document.getElementById("sales_tax_new").innerHTML='$'+sales_total;
	document.getElementById("sales_tax_new").innerHTML='$'+sales_total;
	document.getElementById("sales_tax_new_hide").innerHTML='';
	document.getElementById("totalamounthide").innerHTML='';	
	document.getElementById("txttotal").innerHTML='$ '+ tot_amount_comma;
	}//end of NJ and status N
	/*Condition check state is NJ and tax status Y*/
	else if((document.formcheckout.sstate[document.formcheckout.sstate.selectedIndex].value=='NJ') 
	&& (tax_exempt_status=='Y'))
	{
	var withouttax;	
	withouttax=tot_amount_comma-mySplitResult[2];	
	tot_amount_comma=withouttax.toFixed(2);
	
	document.getElementById("txttotal").innerHTML='$ '+ tot_amount_comma;
	document.getElementById("shipping_rate").innerHTML='$'+document.formcheckout.shipping_rate.value;
	document.getElementById("shipping_rate_hide").innerHTML='';
	document.getElementById("totalhide").innerHTML='';
	}
	else
	{
	document.getElementById("txttotal").innerHTML='$ '+ mySplitResult[4];
	document.getElementById("totalamounthide").innerHTML='';
	}
	document.getElementById("coupon_rate").innerHTML='-$'+mySplitResult[1];
	document.formcheckout.coupon_rate.value=mySplitResult[1];
	document.getElementById("shipping_rate").innerHTML=mySplitResult[3];
	document.getElementById("coupon_rate_hide").innerHTML='';
	document.getElementById("shipping_rate_hide").innerHTML='';
	}//end of NJ and status Y

	if(mySplitResult[1]!='0.00')
	{
	document.getElementById("coupon_message_error").innerHTML='';
	document.getElementById("coupon_message").innerHTML="<span style='padding:10px;'>Your coupon code has been applied.</span>";
	}
	else
	{
	document.getElementById("coupon_message").innerHTML='';		
	document.getElementById("coupon_message_error").innerHTML="<span style='padding:10px;'>Your coupon code has expired or was entered incorrectly. Please check it and try again.</span>";
	}

 }
}
