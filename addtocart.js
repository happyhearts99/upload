
$(document).ready(function () {
	//validation
	function productForm() {
		$('form.product-form').validate({
	
			invalidHandler: function (e, validator, form) {
				var errors = validator.numberOfInvalids();
				if (errors) {
					$(this).addClass("error");
	
				} else {
					$(this).removeClass("error");
				}
			},
	
			rules: {
				"item_number[]": {required: true},
				
				item_number: {required: true},
	
				"quanity[]": {
					required: true,
					number: true
				},
				
				quanity: {
					required: true,
					number: true
				}
			},
	
			messages: {
				item_number: "Please select a product first",
				"item_number[]": "Please select a product first",
				"quanity[]": "Please enter a quantity"
	
			},
	
			focusCleanup: true,
	
			submitHandler: function (form) {
				$(form).ajaxSubmit({
					dataType: 'json',
					beforeSubmit: function(){
						if ($("body").is("#stock-valve-tag"))
						{
							$("#master-quanity-input button[type=submit]").attr("disabled", "disabled");
							$("#master-quanity-input input.master-quanity-input").bind("keypress", function(e) {
							  if (e.keyCode == 13) return false;
							});						
						}
						else
						{
							$("#pricing-table button[type=submit]").attr("disabled", "disabled");
							$("#main-product-quantity-input").bind("keypress", function(e) {
							  if (e.keyCode == 13) return false;
							});							
						}				
						//$('#displayprocessing').toggle();
						//$('#displayprocessing').show().activity({segments: 8, steps: 3, opacity: 0.3, width: 4, space: 0, length: 5, padding: 20, speed: 1.5});
					},					
					success: addToCartResponse,
					resetForm: false
				});
			}
		});
	}
	
	function accessoryForm() {

		$('form.accesories-form').ajaxForm({
			dataType: 'json',
			success: accessoryaddToCartResponse,
			resetForm: true
		});	
	}
	
	productForm();
	accessoryForm();
	

	/*! New Pricing Function */

	function calculatePrice(getPrices, choiceContainer) {
	
		var rev2_quantity_range = [];
		var rev2_item_pricing = [];
	
		var product_container = choiceContainer;
		$(getPrices).each(function (index) {
			var quantityBreak = $(this).find("span.quantity-break").text().replace(/\+/g, '');
			var quantityBreak = parseFloat(quantityBreak);
			var quantityBreak = quantityBreak;
			rev2_quantity_range.push(quantityBreak);
			var pricePerUnit = $(this).find("span.price-per-unit").text().replace(/\$/g, '');
			var pricePerUnit = parseFloat(pricePerUnit);
			rev2_item_pricing.push(pricePerUnit);
		});

		function changePricing() {
			filled_inputs = [];
			var visible_inputs = $(product_container).find("input.main-quanity-input");
			var currentQuantity = 0;
			$(visible_inputs).each(function (i) {
				current_value = $(this).val();
				filled_inputs.push(current_value);
			});

			for (var i = 0; i < filled_inputs.length; i++) {
				var thisVal = parseInt(filled_inputs[i]);
				if (!isNaN(thisVal)) {
					currentQuantity += thisVal;
				}
			};

			if (currentQuantity != "") {
				for (i = 0; i < rev2_quantity_range.length; i++) {
					if (currentQuantity >= rev2_quantity_range[i]) {
						var currentPrice = currentQuantity * rev2_item_pricing[i];
						var originalPrice = currentQuantity * rev2_item_pricing[0];
						var originalCostPerUnit = rev2_item_pricing[0];
						var costPerUnit = rev2_item_pricing[i];
					
						var percentSaved = ((originalPrice - currentPrice) / originalPrice) * 100;
						var yourSavings = Math.round(percentSaved * 100) / 100;
							
						$("#unit-cost span.price").text("$" + costPerUnit.toFixed(2) + " ");
						$("#total-cost p").text("$" + currentPrice.toFixed(2));
						$("#percentage-saved p").text(yourSavings + "%");
						if (yourSavings !== 0) {
						
							if ($("#percentage-saved").is(":visible")){
								//do nothing 
							} else if(user.type !== "rep") {
							
							$("#percentage-saved").fadeIn("fast");
							}
							
							$("#unit-cost strike.crossed-out").text("$" + originalCostPerUnit.toFixed(2));
							$("#total-cost strike.crossed-out").text("$" + originalPrice.toFixed(2));

						} else {
							$("#unit-cost strike.crossed-out").text(" ");
							$("#total-cost strike.crossed-out").text(" ");
							
						}
					}
				}

			} else {

				resetPricing();
			}
		}

		changePricing();

		$(product_container).find("input.main-quanity-input").bind('keyup click', function (evt) {

			changePricing();
		});
	}; //End calculatePricing
	
	/*! Initiate Pricing Function on Page Load */
	calculatePrice();

	function resetPricing() {
		$("#unit-cost strike.crossed-out").text("");
		$("#total-cost strike.crossed-out").text("");
		$("#total-cost p").text("$0.00");
		$("#percentage-saved").fadeOut("fast");
		$("#percentage-saved p").text(" ");
	 
	};

function checkMessages(){
	var productMessages = $("section#product-messages").html();
	$("section#product-messages").hide();
	
	if (productMessages != 0){
		$("section#product-messages").show();
	} else{
		$("section#product-messages").hide();
	}
}

checkMessages();

/*Assign Odd and Even Classes to Product Containter to facilitate pricing table placement */
$(".product-choice-container div.product-choice:odd").addClass("odd");
	function fullresetPricing() {
		$("#unit-cost strike.crossed-out").text("");
		$("#total-cost strike.crossed-out").text("");
		$("#total-cost p").text("$0.00");
		$("#percentage-saved").fadeOut("fast");
		$("#percentage-saved p").text("");
		
		/*if ($("body").is(".pipe-markers")) {
			buildPipemarkers();	
		};*/	
	};

function removeSequence(sequence_range) {

	$(sequence_range).find("a.delete").bind("delete", function (evt) {
		$(evt.target).closest("dl").slideUp().remove();
	}).click(function () {
		$(this).trigger("delete");
		calculatePrice();
	});
}

function addSequence(value, item_number) {

	var visible_inputs = $("#sequence-container dl.added-to-sequence").length;
	var assign_id = visible_inputs + 1;
	var sequence_range = $("<dl id='range_" + assign_id + "' class='added-to-sequence grid_2'><dt>" + value + "</dt><dd><input name='quanity[]' type='number' value='0' class='main-quanity-input'></dd><dd><a class='button red delete' href='#close'><span class='icon-set'>K</span></a></dd><input name='item_number[]' type='hidden' value='" + item_number + "' /> </dl>");
	$("#sequence-container").append(sequence_range);
	
	calculatePrice();
	removeSequence(sequence_range);
}

	/*!Add To Cart Form Response */
function updateitemnumber(itemnumber)
{
	var itemq_container = $("#mini-cart");
	itemq_container.find("#item-count").html(itemnumber+' items');
	//var itemq_containerfloat = $("#top-shopping-cart");
	//itemq_containerfloat.find("#item-count").html(itemnumber+' items');
	var itemp_container = $("#cart-controls");
	itemp_container.find("#item-count").html(itemnumber+' items');
}
function addToCartResponse(data, $form) {

if ($("body").is("#stock-valve-tag")){
	/* This function is located in scripts/rw/add_to_cart_stock.js 
	to find search add_to_cart_response: function() in your IDE.
	*/
	$("#master-quanity-input button[type=submit]").attr("disabled", "");
	$("#master-quanity-input input.master-quanity-input").unbind("keypress");
	pipemarker_stock.stock.valve_tag.add_to_cart_response();

}//END IF
$("#main-product-quantity-input").unbind("keypress");
$("#pricing-table button[type=submit]").attr("disabled", "");		
//Temporary Multi Select Add to Cart Response		
if ($("body").is("#multi-select")){
	$("#you-pay").trigger("hide_pricing");
};
	updateitemnumber(data.current_item_number);	
	updatecartpreviewshow();
	$(".product-form").removeClass("error");
	
	$("#cartresponseTemplate").tmpl(data, {
	changeMarkerStylePunc: function() {
		return this.data.marker_type.toLowerCase().replace(/ /g, '-');
	},
	changeMarkerTypePunc: function() {
		return this.data.select_style.toLowerCase().replace(/-/g, '').replace(/ /g, '_');
	},
	changeMarkerColorPunc: function() {
		return this.data.marker_color.toLowerCase().replace(/\//g, '_');
	}
	}).appendTo("#item-added");
	$("#item-added").slideDown("fast");
	
	$("a.continue-shopping").click(function(event){
		event.preventDefault();	
	});
	//$('#displayprocessing').toggle();
	//$('#displayprocessing').hide();
	$("body").one('close-cart-response', function () {
		$("#item-added").fadeOut("fast", function () {
			$(this).html("");
			
		});
		fullresetPricing();
		});
	
		$("body").click(function () {
		$(this).trigger('close-cart-response');	
		});
		
		$("body").keyup(function (e) {
		if (e.keyCode == 27) {
			$(this).trigger('close-cart-response');
		}
	});
}
//Cynthia start
function accessoryaddToCartResponse(data, $form) {

	updateitemnumber(data.current_item_number);
	updatecartpreviewshow();
	//$(".accesories-form").removeClass("error");

	$("#cartresponseTemplate").tmpl(data).appendTo("#item-added");
	$("#item-added").slideDown("fast");
	
	$("body").bind('close-cart-response', function () {
	$("#item-added").fadeOut("fast", function () {
		$(this).html("");
		
	});
	//fullresetPricing();
	});
	
	$("body").one('click',function () {
		$(this).trigger('close-cart-response');
	
	});
	
	$("body").keyup(function (e) {
	if (e.keyCode == 27) {
		$(this).trigger('close-cart-response');
	}
});
}
$(".accessory-quantity-class").keyup(function()
{	
	var Id = $(this).attr("id");
	
});
//Cynthia

function updatecartpreviewshow()
{
//$("#cart-preview-overlay").html('');
$(".cart-preview-overlay").load("/shoppingcartpreview.php",function()
{
	$("a.cart-close-button").click(
		function () {	
		$(".cart-preview-overlay").slideUp("fast");
		});	
});
}

/*custom non sequential valve tag start*/
$(".calnonseq").click(function(){
	var element = $(this);
	var Id = element.attr("id");
	var startno=$('#startno'+Id).val();
	var endno=$('#endno'+Id).val();
	
	var tagrange=$('input[name=tag_type]:checked').val();
	if(tagrange=="S")
	{
	alert("please select Valve Tag with Variable Information range");
		
	}
	
	if(tagrange=="R")
	{
	if(startno=='')
	{
	alert('please enter start number');	
	}
	else if(endno=='')
	{
	alert('please enter end number');	
	}
	else
	{
	$.get("/process/customproductqty.php", {'startno' :startno ,'endno' : endno},
	function(data)
	{
	msg = jQuery.trim(data);
	var response=msg;
	var splitresult = response.split("|");
	if(splitresult[0]=='Y')
	{
//	alert("Y Condition true");
$("#one-of-a-kind").hide();
	$("div#custom-quantity-input-wrap").show();
	$("#calculate-inst").hide(); 
	var qtyvalue=splitresult[1];
	var qty=$('#main-product-quantity-input').val(qtyvalue);
	}
	if(splitresult[0]=="N")
	{
//	alert("N Condition true");	
$("#one-of-a-kind").hide();
	$("div#custom-quantity-input-wrap").show();
	$("#calculate-inst").hide(); 
	var qtyvalue=splitresult[1];
	var qty=$('#main-product-quantity-input').val(qtyvalue);
	}

	if(splitresult[0]=="Q")
	{
//	alert("Q Condition true");
	$("div#custom-quantity-input-wrap").show();
	$("#calculate-inst").hide(); 
	alert("The system can only calculate consecutive numerical values and/or alphanumerical values with the same alpha characters.");
	
	var qtyvalue='';
	var qty=$('#main-product-quantity-input').val(qtyvalue);	
	}
	});
	}//end of tagrange
	}
});

	
	
	$(".tagtype").click(function()
	{
	var tagrange=$('input[name=tag_type]:checked').val();

	if(tagrange=="R")
	{
	$("#one-of-a-kind").hide();
	$("#variable-info").show();
	$("div#custom-quantity-input-wrap").hide();	
	$("#calculate-inst").show();						   
	}
	if(tagrange=="S")
	{
	$("#one-of-a-kind").show();
	$("#variable-info").hide();
	$("div#custom-quantity-input-wrap").show();
	$("#calculate-inst").hide(); 							   
	}
	
   });


	function hidenonsequentialtagrange()
	{
	var tagrange=$('input[name=tag_type]:checked').val();
	if(tagrange=="R")
	{
	$("#one-of-a-kind").hide();
	$("#variable-info").show();
	$("div#custom-quantity-input-wrap").hide();
	$("#calculate-inst").show();

	}else if(tagrange=="S"){
		$("#variable-info").hide();
		$("#one-of-a-kind").show();
		$("#calculate-inst").hide(); 
	}
	else{
		$("body.valve-tags div#custom-quantity-input-wrap").hide();
	}
	}
	
	hidenonsequentialtagrange();



	function hidesequentialtagrange()
	{
	var tagrange=$('input[name=tag_type]:checked').val();
	if(tagrange=="R")
	{
		$("#one-of-a-kind").hide();
	$("#variable-info").show();
	$("div#custom-quantity-input-wrap").hide();
	$("#calculate-inst").show();
	
	}else if(tagrange=="S"){
		$("#variable-info").hide();
		$("#one-of-a-kind").show();
		$("#calculate-inst").hide(); 
		
	}else{
		$("body.valve-tags div#custom-quantity-input-wrap").hide();
	}
	}
	
	hidesequentialtagrange();

	/*custom non sequential valve tag start*/
$(".calseq").click(function(){
	var element = $(this);
	var Id = element.attr("id");
	var startno=$('#startno'+Id).val();
	var endno=$('#endno'+Id).val();
	var tagrange=$('#tag-type').val();
	
//	var tagrange = $('input#tag-type').val();
//	alert(tagrange);	
	if(tagrange=="R")
	{
	
	//$(startno).numeric({});
	if(startno=='')
	{
	alert('please enter start number');	
	}
	
	else if(endno=='')
	{
	alert('please enter end number');	
	}
	else
	{
	$.get("/process/customproductqty.php", {'startno' :startno ,'endno' : endno},
	function(data)
	{
	msg = jQuery.trim(data);
	var response=msg;
	var splitresult = response.split("|");
	if(splitresult[0]=='Y')
	{
//	alert("Y Condition true");\
	$("div#custom-quantity-input-wrap").show();
	$("#calculate-inst").hide(); 
	var qtyvalue=splitresult[1];
	var qty=$('#main-product-quantity-input').val(qtyvalue);
	}
	if(splitresult[0]=="N")
	{
//	alert("N Condition true");	
	$("div#custom-quantity-input-wrap").show();
	$("#calculate-inst").hide(); 
	var qtyvalue=splitresult[1];
	var qty=$('#main-product-quantity-input').val(qtyvalue);
	}

	if(splitresult[0]=="Q")
	{
//	alert("Q Condition true");
	$("div#custom-quantity-input-wrap").show();
	$("#calculate-inst").hide(); 
	alert("The system can only calculate consecutive numerical values and/or alphanumerical values with the same alpha characters.");
	
	var qtyvalue='';
	var qty=$('#main-product-quantity-input').val(qtyvalue);	
	}
	});
	}//end of tagrange
	}
});
    $("#delete_file").click(function(){
		var processv=$("#processfolder").val();	
		var fileid=$("#uploadfileid").val();
		var filename=$("#uploadfilename").val();
		var sh_id=$("#sh_id").val();
		$("#uploadfilename").val("");
		$("#uploadfileid").val("");
		$("#previousfilename").val("");
		$("#previousfileid").val("");
		$.get(processv,{'action':11,'fileid' : fileid,'filename':filename,'sh_id':sh_id},
		function(data)
		{
			$("#deleteresult").html("The file is deleted");
			$("#delete_file").addClass("collapsed");
			$("#uploadnessage").html(data);
		});									 
	})
	$(".numericonly").keypress(function(event) {
										
  // Backspace, tab, enter, end, home, left, right
  // We don't support the del key in Opera because del == . == 46.
  var controlKeys = [8, 9, 13, 35, 36, 37, 39];
  // IE doesn't support indexOf
  var isControlKey = controlKeys.join(",").match(new RegExp(event.which));
  // Some browsers just don't raise events for control keys. Easy.
  // e.g. Safari backspace.
  if (!event.which || // Control keys in most browsers. e.g. Firefox tab is 0
      (48 <= event.which && event.which <= 57) 
	  //|| // Always 1 through 9
      //(48 == event.which && $(this).attr("value"))
	  || // No 0 first digit
      isControlKey) { // Opera assigns values for control keys.
    return;
  } else {
    event.preventDefault();
  }
});
});
