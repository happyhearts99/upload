$(document).ready(function () {	

	function fontTestx6(){
		var classList = $("#custom-product-images").attr('class').split(/\s+/);
				  
		for (i = 0; i < classList.length; i++) {
			   if(classList[i].length > 0){
				
				   switch (classList[i]) {
					case "Algerian": var textComp = 1.5; break;
					case "Arial": var textComp = 1.1; break;
					case "Brush": var textComp = 1.2; break;
					case "Century": var textComp = 1.05; break;
					case "Clarendon": var textComp = 1.05; break;
					case "Futura": var textComp = 1.05; break;
					case "Highway": var textComp = 1.2; break;
					case "Swiss": var textComp = 1; break;
					case "Tekton": var textComp = 1.2; break;
					case "Times_New_Roman": var textComp = 1.2; break;
					case "Zapf": var textComp = 1; break;
					} 
			   }
		 }
		return textComp;
	}
	
	function fontTest2linex6(){
		var classList = $("#custom-product-images").attr('class').split(/\s+/);
				  
		for (i = 0; i < classList.length; i++) {
			   if(classList[i].length > 0){
				   switch (classList[i]) {
					case "Algerian": var textComp = 3; break;
					case "Arial": var textComp = 1; break;
					case "Brush": var textComp = 1.05; break;
					case "Century": var textComp = 1.05; break;
					case "Clarendon": var textComp = 1.05; break;
					case "Futura": var textComp = 1; break;
					case "Highway": var textComp = 1; break;
					case "Swiss": var textComp = 1; break;
					case "Tekton": var textComp = 1; break;
					case "Times_New_Roman": var textComp = 1; break;
					case "Zapf": var textComp = 1; break;
					} 
			   }
		 }
		return textComp;
	}
	
	function fontTestx6Upper(){
		var classList = $("#custom-product-images").attr('class').split(/\s+/);
				   
		for (i = 0; i < classList.length; i++) {
			   if(classList[i].length > 0){
				   
				   switch (classList[i]) {
					case "Algerian": var textComp = 1.05; break;
					case "Arial": var textComp = 1; break;
					case "Brush": var textComp = 1.05; break;
					case "Century": var textComp = 1.05; break;
					case "Clarendon": var textComp = 1.05; break;
					case "Futura": var textComp = 1; break;
					case "Highway": var textComp = 1; break;
					case "Swiss": var textComp = 1; break;
					case "Tekton": var textComp = 1; break;
					case "Times_New_Roman": var textComp = 1; break;
					case "Zapf": var textComp = 1; break;
					} 
			   }
		 }
		return textComp;
	}
	
	function fontTestx9(){
		var classList = $("#custom-product-images").attr('class').split(/\s+/);
				   
		for (i = 0; i < classList.length; i++) {
			   if(classList[i].length > 0){
				   
				   switch (classList[i]) {
					case "Algerian": var textComp = 1.5; break;
					case "Arial": var textComp = 1.1; break;
					case "Brush": var textComp = 1.2; break;
					case "Century": var textComp = 1.05; break;
					case "Clarendon": var textComp = 1.05; break;
					case "Futura": var textComp = 1.05; break;
					case "Highway": var textComp = 1.2; break;
					case "Swiss": var textComp = 1; break;
					case "Tekton": var textComp = 1.2; break;
					case "Times_New_Roman": var textComp = 1.2; break;
					case "Zapf": var textComp = 1; break;
					} 
			   }
		 } 
		return textComp;
	}
	
	function fontTestx9Upper(){
		var classList = $("#custom-product-images").attr('class').split(/\s+/);
				   
		for (i = 0; i < classList.length; i++) {
			   if(classList[i].length > 0){
				   
				   switch (classList[i]) {
					case "Algerian": var textComp = 1.05; break;
					case "Arial": var textComp = 1; break;
					case "Brush": var textComp = 1.05; break;
					case "Century": var textComp = 1.05; break;
					case "Clarendon": var textComp = 1.05; break;
					case "Futura": var textComp = 1; break;
					case "Highway": var textComp = 1; break;
					case "Swiss": var textComp = 1; break;
					case "Tekton": var textComp = 1; break;
					case "Times_New_Roman": var textComp = 1; break;
					case "Zapf": var textComp = 1; break;
					} 
			   }
		 } 
		return textComp;
	}

	$('#fontList li').click(
    function(){
        var chosen = $(this).index();
        $('#sign_font option:selected')
            .removeAttr('selected');
        $('#sign_font option')
            .eq(chosen)
            .attr('selected',true);
        $('.selected').removeClass('selected');
        $(this).addClass('selected');
		updateclass();
		
		var text1boundry = $("#preview-image").find(".vertically-aligned-copy1");
		var text1counter = $("#preview-image").find(".line_1 span.copy");
		var text1container = $("#preview-image").find(".line_1");
		var text2boundry = $("#preview-image").find(".vertically-aligned-copy2");
		var text2counter = $("#preview-image").find(".line_2 span.copy");
		var text2container = $("#preview-image").find(".line_2");
		//compress_text(text1counter, text1boundry, text1container, text1counter.html()); 
		compress_text(text1counter, text1boundry, text1container, text1counter.html());
		compress_text(text2counter, text2boundry, text2container, text2counter.html());	
		
		var copyS = $("#suffix_selector").val();
		var textScounter = $("#preview-image #suffix p");
		var textScontainer = $("#preview-image #suffix");
		var textSboundry = $("#preview-image #suffix");
		compress_text_suffix(textScounter, textSboundry, textScontainer, copyS);
		
		var copyNum = $("#sidetext").val();
		var textNumcounter = $("#preview-image #streetnum p");
		var textNumcontainer = $("#preview-image #streetnum");
		var textNumboundry = $("#preview-image #streetnum");
		compress_text_streetnum(textNumcounter, textNumboundry, textNumcontainer, copyNum);
    });
	
	
	
   //var product_no=$("#productno").val();
   //$("#custom-product-images.custom_parking_signs").css("background-image"," url(../images/parking-signs/parkingsign"+product_no+".png)");
  //$("#custom-product-images.custom_parking_signs").css( "background-size","120px 100px");
   checkupload();
   function checkupload()
   {
	   var uploadid=$("#uploadfileid").val();
	   if($("#uploadlogo").length>0&&uploadid!="")
	   {
		   var imagename=$("#uploadfilename").val();		   
		   var image_x=parseInt($("#image_x").val());
		   if($("#image_y").length>0)
		   		var image_y=parseInt($("#image_y").val());
		   else
		   {
		   		var image_y_top=parseInt($("#image_y_top").val());
				var image_y_middle=parseInt($("#image_y_middle").val());
				var image_y_bottom=parseInt($("#image_y_bottom").val());
		   }		   	 	
		   var image_width=parseInt($("#image_width").val());
		   var image_height=parseInt($("#image_height").val());
		   var newImg = new Image();
			newImg.src = "../upload/temp/"+imagename;
			var curWidth = $("#uploadfilewidth").val();//console.log(curHeight+"px"+newImg.clientWidth);
			var curHeight = $("#uploadfileheight").val();//newImg.width;console.log("A"+curWidth);
			curWidth=parseInt(curWidth);
			curHeight=parseInt(curHeight);
			if(curWidth>image_width)
			{
				var newcurWidth_c=image_width;
				var newcurHeight_c=curHeight*newcurWidth_c/curWidth;
			}
			else
			{
				newcurWidth_c=curWidth;
				newcurHeight_c=curHeight;
			}
			if(newcurHeight_c>image_height)
			{
				var newcurHeight=image_height;
				var newcurWidth=newcurWidth_c*newcurHeight/newcurHeight_c;
			}
			else
			{
				var newcurWidth=newcurWidth_c;
				var newcurHeight=newcurHeight_c;
			}
			var resize=newcurWidth+"px "+newcurHeight+"px";
			//var x=(144-newcurWidth)/2+200;
			var x=(image_width-newcurWidth)/2;
			var y=(image_height-newcurHeight)/2;
			var position=x+"px "+y+"px";
			var left=(image_x+201)+"px";
		   //$("#uploadlogo").height(100);console.log("B"+resize);
		   $("#uploadlogo").css("left",left).css("top",image_y).css("width",image_width).css("height",image_height).css("background-image"," url(../upload/temp/"+imagename+")").css("background-repeat","no-repeat").css("background-position",position).css("background-size",resize);
		   /*var imagename=$("#uploadfilename").val();
		   var newImg = new Image();
			newImg.src = "../upload/temp/"+imagename;
			var curWidth = $("#uploadfilewidth").val();//console.log(curHeight+"px"+newImg.clientWidth);
			var curHeight = $("#uploadfileheight").val();//newImg.width;console.log("A"+curWidth);
			curWidth=parseInt(curWidth);
			curHeight=parseInt(curHeight);
			if(curWidth>120)
			{
				var newcurWidth_c=120;
				var newcurHeight_c=curHeight*newcurWidth_c/curWidth;
			}
			else
			{
				newcurWidth_c=curWidth;
				newcurHeight_c=curHeight;
			}
			if(newcurHeight_c>88)
			{
				var newcurHeight=88;
				var newcurWidth=newcurWidth_c*newcurHeight/newcurHeight_c;
			}
			else
			{
				var newcurWidth=newcurWidth_c;
				var newcurHeight=newcurHeight_c;
			}
			var resize=newcurWidth+"px "+newcurHeight+"px";
			var x=(144-newcurWidth)/2+200;
			var position=x+"px "+"12px";
		   $("#uploadlogo").height(100);console.log("B"+resize);
		   $("#uploadlogo").css("background-image"," url(../upload/temp/"+imagename+")");
		   $("#uploadlogo").css( "background-repeat","no-repeat");
		   $("#uploadlogo").css( "background-position",position);
		   $("#uploadlogo").css( "background-size",resize);	*/	   
   	   }
   }
   function compress_text(element_to_compress, boundry,textcontainer,text)
   {
		var a1= element_to_compress.width();
		var a2=textWidth(textcontainer,text);
		if(a1>a2)
			var a=a1;
		else
			var a=a2;
		var b =boundry.width();
		var c = b/a;
		if(c>=1)
		{
			c=1;
			textcontainer.css("position","relative"); 
			element_to_compress.css("position","relative"); 		
		}
		else
		{
			c=Math.round(c * 100)/100;
			textcontainer.css("position","absolute"); 
			element_to_compress.css("position","absolute"); 
		}
		
		if($(".compress_1").length>0&&textcontainer.hasClass("line_1"))
		{
			$(".compress_1").val(c);
		}
		if($(".compress_2").length>0&&textcontainer.hasClass("line_2"))
		{
			$(".compress_2").val(c);
		}		
		element_to_compress.css({
		scaleX: c,
		origin: [0, 0]
		
		});
	}
	
	 function compress_textLine1(element_to_compress, boundry,textcontainer,text)
   {
		var a1= element_to_compress.width();
		var a2=textWidthLine1(textcontainer,text);
		if(a1>a2)
			var a=a1;
		else
			var a=a2;
		var b =boundry.width();
		var c = b/a;
		if(c>=1)
		{
			c=1;
			textcontainer.css("position","relative"); 
			element_to_compress.css("position","relative"); 		
		}
		else
		{
			c=Math.round(c * 100)/100;
			textcontainer.css("position","absolute"); 
			element_to_compress.css("position","absolute"); 
		}
		
		if($(".compress_1").length>0&&textcontainer.hasClass("line_1"))
		{
			$(".compress_1").val(c);
		}
		if($(".compress_2").length>0&&textcontainer.hasClass("line_2"))
		{
			$(".compress_2").val(c);
		}		
		element_to_compress.css({
		scaleX: c,
		origin: [0, 0]
		
		});
	}
	
	function textWidth(textcontainer,text){  
		var calc = '<span id="tempspan" style="display:none">' + text + '</span>';  
		textcontainer.append(calc);  
		
		var widthOriginal = textcontainer.find('span:last').width();
		var x6 = $("#custom-product-images").hasClass("x6");
		var x4 = $("#custom-product-images").hasClass("x4");
		var x9 = $("#custom-product-images").hasClass("x9");
		var line2x6 = $("#custom-product-images").hasClass("twoline");
		var line2content = $("#preview-image .line_2 span").html();
		var textUpper = $("#custom-product-images").hasClass("textupper");
		var test = $("#preview-image").find(".line_1");
		var test2 = $("#preview-image").find(".line_2");
		
		if ($.support.cssFloat != true) {
			if (x6 == true || x4 == true){
				if (textUpper != true){
					
						var compressRate = fontTestx6();
					
				}else {
					var compressRate = fontTestx6Upper();
				}
			
			}else if (x9 == true){
				if (textUpper != true){
					var compressRate = fontTestx9();
				}else {
					var compressRate = fontTestx9Upper();
				}
			}
				
		}else {var compressRate = 1;}
		
		var width = widthOriginal * compressRate;

		textcontainer.find('span:last').remove();
		return width; 
	}; 	
	
	function textWidthLine1(textcontainer,text){  
		var calc = '<span id="tempspan" style="display:none">' + text + '</span>';  
		textcontainer.append(calc);  
		
		var widthOriginal = textcontainer.find('span:last').width();
		var x6 = $("#custom-product-images").hasClass("x6");
		var x4 = $("#custom-product-images").hasClass("x4");
		var x9 = $("#custom-product-images").hasClass("x9");
		var line2x6 = $("#custom-product-images").hasClass("twoline");
		var line2content = $("#preview-image .line_2 span").html();
		var textUpper = $("#custom-product-images").hasClass("textupper");
		var test = $("#preview-image").find(".line_1");
		var test2 = $("#preview-image").find(".line_2");
		
		if ($.support.cssFloat != true) {
			if (x6 == true || x4 == true){
				if (textUpper != true){
					
						var compressRate = fontTest2linex6();
					
				}else {
					var compressRate = fontTestx6Upper();
				}
			
			}else if (x9 == true){
				if (textUpper != true){
					var compressRate = fontTestx9();
				}else {
					var compressRate = fontTestx9Upper();
				}
			}
				
		}else {var compressRate = 1;}
		
		var width = widthOriginal * compressRate;

		textcontainer.find('span:last').remove();
		return width; 
	}; 	
	
	
	$("#sign_color").change(function(){
		var color=$(this).val();
		$(".vcolor").val(color);
		if($("#customproduct").length>0)
		{
			var custom_product=$("#customproduct").val();
			var layout=$("#layout").val();
			var size_v=$("#sign_size").val();
			var size_sepa=size_v.split("|");
			var size_value=size_sepa[0];	
			//size_value=size_value.substring(1);
			//var sepavalue=size_value.split("x");
			//var size_o=sepavalue[0]+"x "+sepavalue[1]+"''";	
			var layout=$("#layout").val();
			var productno=$("#productno").val();
			var p_id=$("#p_id").val();
			var loadpath=$("#loadpath").val();	
			if ($("#position_selector").length > 0) 
				var position=$("#position_selector").val();
			else var position=""; 
			if ($("#sign_font").length > 0) 
				var font=$("#sign_font").val(); 
			else 
				var font="";
			if($("#text_colorddl").length > 0)
			var textcolor=$("#text_colorddl").val();
			else
				var textcolor="";
			if($("#arrow_selector").length > 0)
				var arrow=$("#arrow_selector").val();
			else
				var arrow="";
			if($("#arrowcolor_selector").length > 0)
				var arrowcolor=$("#arrowcolor_selector").val();
			else
				var arrowcolor="";	
			var mounting=$("#mounting_option").val();	
			var filename=$("#uploadfilename").val();
			var fileid=$("#uploadfileid").val();
			if($("#.line-containers #textarea_1").length > 0) 
				var copy1 = $(".line-containers #textarea_1").val();
			var copy2="";
			if($("#.line-containers #textarea_2").length > 0)
				var copy2 = $(".line-containers #textarea_2").val();	
			if($("#line_1_textsize").length>0)
				var textsize=$("#line_1_textsize").val();	
			else
				var textsize="";
			if($("#line_2_textsize").length>0)
				var textsize2=$("#line_2_textsize").val();	
			else
				var textsize2="";																
			var special_comment=$("#special-instructions-text").val();
			$.get("../process/process_quickbuy.php",{'action':2,'color' : color,'size':size_value,'layout':layout},
			function(data)
			{
				data=jQuery.trim(data);
				var datasepa=data.split("|");
				$("#custom-product-images.custom_parking_signs").css("background-image"," url(../images/parking-signs/"+datasepa[0]+")");
				$("#custom-product-images.custom_parking_signs").css("background-position","200px 0px");				
				
			});
			$(".viewmaterial").load(loadpath, {'product_no': productno,'size':size_value,'pid':p_id,'line_1':copy1,'line_2':copy2,'position':position,'color':color,'font':font,'mounting':mounting,'filename':filename,'fileid':fileid,'layout':layout, 'textcolor':textcolor,'arrow':arrow,'arrowcolor':arrowcolor,'textsize':textsize,'textsize2':textsize2,'special_comment':special_comment,'custom_product':custom_product}, function(value){
				 
			$('.add-to-cart-confirmation a.continue-shopping').click(function(){
			$('.add-to-cart-confirmation.showme').fadeOut("fast");
			return false; 
			});
			$('table tr.data-row').mouseover(function(){$(this).addClass("over");}).mouseout(function(){$(this).removeClass("over");}); 
			addtocartform(); 
			
			}); 			
			if($("#text_colorddl").length>0)
			{
				if($("#textcolordiv").length>0)
				{
					var color_sepa=color.split(" ");
					color=color_sepa[0];
					if(color=="Black")
						$("#textcolordiv").html("<select id='text_colorddl' name='text_colorddl' class='customoption'><option value='"+color+"'>"+color+"</option></select>");
					else	
						$("#textcolordiv").html("<select id='text_colorddl' name='text_colorddl' class='customoption'><option value='"+color+"'>"+color+"</option><option value='Black'>Black</option></select>");
					$("#text_colorddl").val(color);
					$(".vtextcolor").val(color);
					$("#text_colorddl").change(function(){
						updateclass();
						var textcolor=$(this).val();
						$(".vtextcolor").val(textcolor);	
					})
				}
			}
		}
		updateclass();
	});
	$("#text_colorddl").change(function(){
		updateclass();
		var textcolor=$(this).val();
		$(".vtextcolor").val(textcolor);	
	})	
	$("#mounting_option").change(function(){
		var mounting=$(this).val();
		$(".vmounting").val(mounting);	
		});	
	$("#prefix_selector").change(function(){
		var prefix=$("#prefix_selector").val();
		if(prefix=='NONE')
		{
			if($("#suffix_selector").length>0)
			{	
				var suffix=$("#suffix_selector").val();
				if(!(suffix.indexOf("Arrow") != -1))		
					$("#position_selector_container").show();
				if(suffix=='NONE')
					$("#suffix p").html("");
				else if(!(suffix.indexOf("Arrow") != -1))
					$("#suffix p").html(suffix);	
			}
			$("#prefix p").html("");
		}
		else if(prefix.indexOf("Arrow") != -1)
		{
			if($("#suffix_selector").length>0)
			{
				$("#suffix_selector").val("NONE");
				$(".vsuffix").val("NONE");				
				$("#suffix p").html("");
			}
			$("#position_selector_container").hide();
			$("#prefix p").html("");
		}
		else
		{	
			if($("#suffix_selector").length>0)
			{
				var suffix=$("#suffix_selector").val();
				if(suffix.indexOf("Arrow")!=-1)
				{
					$("#suffix_selector").val("NONE");
					$("#suffix p").html("");
					$(".vsuffix").val("NONE");	
				}
				else if(suffix=='NONE')
					$("#suffix p").html("");
				else
					$("#suffix p").html(suffix);	
			}
			$("#position_selector_container").show();
			$("#prefix p").html(prefix);			
		}
		updateclass();
		if($("#line_1").length>0)
		{
			var copy1=$("#line_1").val();
			var text1boundry = $("#preview-image").find(".vertically-aligned-copy1");
			var text1counter = $("#preview-image").find(".line_1 span.copy");
			var text1container = $("#preview-image").find(".line_1");
			compress_text(text1counter, text1boundry, text1container, copy1);
		}
		if($("#line_2").length>0)
		{
			var copy2=$("#line_2").val();	
			var text2boundry = $("#preview-image").find(".vertically-aligned-copy2");
			var text2counter = $("#preview-image").find(".line_2 span.copy");	
			var text2container = $("#preview-image").find(".line_2");
			compress_text(text2counter, text2boundry, text2container,copy2);
		}	
		$(".vprefix").val(prefix);
		});		
	$("#suffix_selector").change(function(){
		var suffix=$("#suffix_selector").val();
		if(suffix=='NONE')
		{
			if($("#prefix_selector").length>0)	
			{
				var prefix=$("#prefix_selector").val();
				if(!(prefix.indexOf("Arrow") != -1))
					$("#position_selector_container").show();
				if(prefix=='NONE')
					$("#prefix p").html("");
				else if(!(prefix.indexOf("Arrow") != -1))
					$("#prefix p").html(prefix);			
			}
			$("#suffix p").html("");	
		}
		else if(suffix.indexOf("Arrow") != -1)
		{
			if($("#prefix_selector").length>0)	
			{
				$("#prefix_selector").val("NONE");	
				$(".vprefix").val("NONE");			
				$("#prefix p").html("");
			}
			$("#position_selector_container").hide();	
			$("#suffix p").html("");
		}
		else
		{	
			if($("#prefix_selector").length>0)	
			{	
				var prefix=$("#prefix_selector").val();
				if(prefix.indexOf("Arrow")!=-1)
				{
					$("#prefix_selector").val("NONE");
					$("#prefix p").html("");
					$(".vprefix").val("NONE");	
				}
				if(prefix=='NONE')
					$("#prefix p").html("");
				else
					$("#prefix p").html(prefix);				
			}
			$("#position_selector_container").show();
			$("#suffix p").html(suffix);				
		}
		updateclass();
		if($("#line_1").length>0)
		{
			var copy1=$("#line_1").val();
			var text1boundry = $("#preview-image").find(".vertically-aligned-copy1");
			var text1counter = $("#preview-image").find(".line_1 span.copy");
			var text1container = $("#preview-image").find(".line_1");
			
				compress_text(text1counter, text1boundry, text1container, copy1);
		}
		if($("#line_2").length>0)
		{
			var copy2=$("#line_2").val();	
			var text2boundry = $("#preview-image").find(".vertically-aligned-copy2");
			var text2counter = $("#preview-image").find(".line_2 span.copy");	
			var text2container = $("#preview-image").find(".line_2");
			compress_text(text2counter, text2boundry, text2container,copy2);
		}
		var copyS = $("#suffix_selector").val();
		var textScounter = $("#preview-image #suffix p");
		var textScontainer = $("#preview-image #suffix");
		var textSboundry = $("#preview-image #suffix");
		compress_text_suffix(textScounter, textSboundry, textScontainer, copyS);
		
				
		$(".vsuffix").val(suffix);
		});		
	$("#position_selector").change(function(){
		updateclass();
		var position=$(this).val();
		$(".vposition").val(position);	
		});	
	$("#sign_font").change(function(){
		updateclass();
		var font=$(this).val();
		$(".vfont").val(font);
		if($("#line_1").length>0)
		{
			var line1=$("#line_1").val();
			var text1boundry = $("#preview-image").find(".vertically-aligned-copy1");
			var text1counter = $("#preview-image").find(".line_1 span.copy");
			var text1container = $("#preview-image").find(".line_1");
			compress_text(text1counter, text1boundry, text1container, line1);
			
		}
		else if($("#textarea_1").length>0)
		{
			var textsizecontainer=$("#line_1_textsize");
			var text1container = $("#preview-image").find(".line_1");
			var counter1 = $("#line-1-container").find("span.current-characters");
			var copy1 = $("#textarea_1").val();
			var text1boundry = $("#preview-image").find("#product_text1");			
			updatepreview(text1container,text1counter,copy1,text1boundry,textsizecontainer);	
		}
		if($("#line_2").length>0)
		{
			var line2=$("#line_2").val();
			var text2boundry = $("#preview-image").find(".vertically-aligned-copy2");
			var text2counter = $("#preview-image").find(".line_2 span.copy");
			var text2container = $("#preview-image").find(".line_2");	
			compress_text(text2counter, text2boundry, text2container, line2);	
		}
		else if($("#textarea_2").length>0)
		{
			var textsizecontainer=$("#line_2_textsize");
			var text2container = $("#preview-image").find(".line_2");
			var counter2 = $("#line-1-container").find("span.current-characters");
			var copy2 = $("#textarea_2").val();
			var text2boundry = $("#preview-image").find("#product_text2");			
			updatepreview(text2container,text2counter,copy2,text2boundry,textsizecontainer);	
		}
		if($("#suffix_selector").length>0)
		{
		var copy1 = $("#suffix_selector").val();
		var text1counter = $("#preview-image #suffix p");
		var text1container = $("#preview-image #suffix");
		var text1boundry = $("#preview-image #suffix");
		compress_text_suffix(text1counter, text1boundry, text1container, copy1);
		}
		if($("#sidetext").length>0)
		{
		var copyNum = $("#sidetext").val();
		var textNumcounter = $("#preview-image #streetnum p");
		var textNumcontainer = $("#preview-image #streetnum");
		var textNumboundry = $("#preview-image #streetnum");
		compress_text_streetnum(textNumcounter, textNumboundry, textNumcontainer, copyNum);	
		}
					
		});
	$("#arrow_selector").change(function(){
		updateclass();
		var arrow=$(this).val();
		$(".varrow").val(arrow);	
	})		
	$("#arrowcolor_selector").change(function(){
		updateclass();
		var arrowcolor=$(this).val();
		$(".varrowcolor").val(arrowcolor);	
	})		
	$("#sign_background").change(function(){
			var background=$(this).val();
			$(".vbackground").val(background);
			if(background=='Logo')
			{
				if($("#uploadshow").length>0)
				{
					if($("#uploadfileid").val()!="")
						$("#delete_file1").show();
					$("#uploadshow").show();
					$("#buttonmessage").html("");
				}
				if ($("#prefix_selector").length > 0)
				{
					var prefixoptioncontainer=$("#prefix_selector option");
					prefixoptioncontainer.each(function(index) 
					{
						var optionvalue=$(this).val();
						if(optionvalue.indexOf("Arrow") != -1)
							$(this).removeAttr('disabled');
					});			
				}	
				if ($("#suffix_selector").length > 0)
				{
					var suffixoptioncontainer=$("#suffix_selector option");
					suffixoptioncontainer.each(function(index) 
					{
						var optionvalue=$(this).val();
						if(optionvalue.indexOf("Arrow") != -1)
							$(this).removeAttr('disabled');
					});			
				}							
			}
			else
			{
				if($("#uploadshow").length>0)
				{
					$("#delete_file1").hide();
					$("#uploadshow").hide();
					$("#uploadnessage").html("");
					if($("#uploadnessage").hasClass("success"))
						$("#uploadnessage").removeClass("success");
					else if($("#uploadnessage").hasClass("error"))
						$("#uploadnessage").removeClass("error");
					$("#buttonmessage").html("To upload custom file, please select background option to logo.");
				}
				if(background=='Left-Pointer')
				{
					if ($("#prefix_selector").length > 0)
					{
						var prefix=$("#prefix_selector").val();
						if(prefix.indexOf("Arrow") != -1)
						{
							$("#prefix_selector").val("NONE");
							$(".vprefix").val("NONE");
						}
						var prefixoptioncontainer=$("#prefix_selector option");
						prefixoptioncontainer.each(function(index) 
						{
							var optionvalue=$(this).val();
							if(optionvalue.indexOf("Arrow") != -1)
								$(this).attr("disabled","disabled");
						});
					}
					if ($("#suffix_selector").length > 0)
					{
						var suffixoptioncontainer=$("#suffix_selector option");
						suffixoptioncontainer.each(function(index) 
						{
							var optionvalue=$(this).val();
							if(optionvalue.indexOf("Arrow") != -1)
								$(this).removeAttr('disabled');
						});			
					}
				}
				else if(background=='Right-Pointer')
				{
					if ($("#suffix_selector").length > 0)
					{
						var suffix=$("#suffix_selector").val();
						if(suffix.indexOf("Arrow") != -1)
						{
							$("#suffix_selector").val("NONE");
							$(".vsuffix").val("NONE");
						}
						var suffixoptioncontainer=$("#suffix_selector option");
						suffixoptioncontainer.each(function(index) 
						{
							var optionvalue=$(this).val();
							if(optionvalue.indexOf("Arrow") != -1)
								$(this).attr("disabled","disabled");
						});
					}
					if ($("#prefix_selector").length > 0)
					{
						var prefixoptioncontainer=$("#prefix_selector option");
						prefixoptioncontainer.each(function(index) 
						{
							var prefixoptionvalue=$(this).val();
							if(prefixoptionvalue.indexOf("Arrow") != -1)
								$(this).removeAttr('disabled');
						});			
					}					
				}
				else
				{
					if ($("#prefix_selector").length > 0)
					{
						var prefixoptioncontainer=$("#prefix_selector option");
						prefixoptioncontainer.each(function(index) 
						{
							var optionvalue=$(this).val();
							if(optionvalue.indexOf("Arrow") != -1)
								$(this).removeAttr('disabled');
						});			
					}	
					if ($("#suffix_selector").length > 0)
					{
						var suffixoptioncontainer=$("#suffix_selector option");
						suffixoptioncontainer.each(function(index) 
						{
							var optionvalue=$(this).val();
							if(optionvalue.indexOf("Arrow") != -1)
								$(this).removeAttr('disabled');
						});			
					}				
				}
			}
			updateclass();
			if($("#line_1").length>0)
			{
				var copy1=$("#line_1").val();
				var text1boundry = $("#preview-image").find(".vertically-aligned-copy1");
				var text1counter = $("#preview-image").find(".line_1 span.copy");
				var text1container = $("#preview-image").find(".line_1");
				compress_text(text1counter, text1boundry, text1container, copy1);
			}
			if($("#line_2").length>0)
			{
				var copy2=$("#line_2").val();	
				var text2boundry = $("#preview-image").find(".vertically-aligned-copy2");
				var text2counter = $("#preview-image").find(".line_2 span.copy");	
				var text2container = $("#preview-image").find(".line_2");
				compress_text(text2counter, text2boundry, text2container,copy2);
			}					
		});
		function updatepreviewchangetextsize(textcontainer,textcounter,text,boundarycontainer,textsizecontainer){ 
			//var textsizechange=true;
			var orgcopy=textcontainer.html();
			textcontainer.html("");
			if(textsizecontainer.length>0)
				var fontsizev=textsizecontainer.val();
			var boundaryheight=boundarycontainer.height();
			var boundary=boundarycontainer.width();
			//var numberofchars = text.length; 
			text=text.replace(/</g,"&lt;").replace(/>/g, "&gt;");
			var textcontainerid=textcontainer.attr("id");
			if(text.indexOf("\n") != -1)
			{
				var copysepa=text.split("\n");
				var arraycount=copysepa.length;
				var i;	
				for(i=0;i<=arraycount;i++)
				{
					if(i!=arraycount)
					{
						if(i==0)
							textcontainer.append("<span class='copy' id='"+textcontainerid+"tx"+i+"' name='"+textcontainerid+"tx"+i+"'>"+copysepa[i]+"</span>");
						else
							textcontainer.append("<br/><span class='copy' id='"+textcontainerid+"tx"+i+"' name='"+textcontainerid+"tx"+i+"'>"+copysepa[i]+"</span>");
						if(textsizecontainer.length>0)
						{
							var textcounter = textcontainer.find("span.copy");
							textcounter.css("font-size",fontsizev+"pt");
							textcounter.css("line-height",fontsizev+"pt");
						}	
						var lastline=textcontainer.find("span:last-child");	
						if(lastline.width()>boundary)
						{
							fontsizev=parseInt(fontsizev);
							fontsizev=fontsizev-1;
							$("#line_1_textsize").val(fontsizev);
							textcontainer.html(orgcopy);
							//textsizechange=false;
							break;
						}
					}
					else
					{
						textcontainer.find("span:last-child").html(copysepa[i]);
						if(textsizecontainer.length>0)
						{
							var fontsizev=textsizecontainer.val();
							var textcounter = textcontainer.find("span.copy");
							textcounter.css("font-size",fontsizev+"pt");
							textcounter.css("line-height",fontsizev+"pt");											
						}						
					}
					var textcounterlastrow = textcontainer.find("span:last-child.copy");	
					if(textcontainer.height()>boundaryheight)
					{
						fontsizev=parseInt(fontsizev);
						fontsizev=fontsizev-1;
						textsizecontainer.val(fontsizev);
						//textcounter.css("font-size",fontsizev+"pt");
						//textcounter.css("line-height",fontsizev+"pt");	
						textcontainer.html(orgcopy);
						//textsizechange=false;				
						break;
					}
				}
			}
			else
			{
				textcontainer.append("<span class='copy' id='"+textcontainerid+"tx0"+"' name='"+textcontainerid+"tx0"+"'>"+text+"</span>");
				var textcounterlastrow = textcontainer.find("span:last-child.copy");	
				if(textsizecontainer.length>0)
				{
					var textcounter = textcontainer.find("span.copy");
					textcounter.css("font-size",fontsizev+"pt");	
					textcounter.css("line-height",fontsizev+"pt");							
				}						
				var textwidth=textcounterlastrow.width();
				var i=0;
				while(textwidth>boundary)
				{
					var c;
					var lastrow=textcounterlastrow.html();
					var numberofchars = lastrow.length; 
					for(c=0;c<numberofchars;c++)
					{
						var reducetext=lastrow.substring(0,numberofchars-c);
						textcounterlastrow.html(reducetext);
						var newtextwidth=textcounterlastrow.width();
						if(newtextwidth<=boundary)
						{
							var lastrowtext=lastrow.substring(numberofchars-c);
							textcontainer.append("<br/><span class='copy' id='"+textcontainerid+"tx"+i+"' name='"+textcontainerid+"tx"+i+"'>"+lastrowtext+"</span>");
							if(textsizecontainer.length>0)
							{
								var textcounter = textcontainer.find("span.copy");
								textcounter.css("font-size",fontsizev+"pt");	
								textcounter.css("line-height",fontsizev+"pt");							
							}			
							break;
						}
					}
					textcounterlastrow = textcontainer.find("span:last-child.copy");
					textwidth=textcounterlastrow.width();
					if(textcontainer.height()>boundaryheight)
					{
						fontsizev=parseInt(fontsizev);
						fontsizev=fontsizev-1;
						textsizecontainer.val(fontsizev);
						textcounter.css("font-size",fontsizev+"pt");
						textcounter.css("line-height",fontsizev+"pt");						
						//textcounterlastrow.hide();
						textcontainer.html(orgcopy);
						//textsizechange=false;
						//textwidth=textcounterlastrow.width()
						break;
					}					
				}	
			}
			if(textcontainerid=="1")
				$(".vline_1preview").val(textcontainer.html());
			else if(textcontainerid=="2")
				$(".vline_2preview").val(textcontainer.html());
			if($(".textarea1_shrink").length>0&&$(".textarea1_shrink").val()=="Y"&&textcontainerid=="1"&&textsizecontainer.val()>$(".v_textarea1_orgsize").val())
				$(".textarea1_shrink").val("N");				
		};
		function updatepreviewsignsize(textcontainer,textcounter,text,boundarycontainer,textsizecontainer){ 
			var returnshrink=true;
			var orgcopy=textcontainer.html();
			textcontainer.html("");
			//if(textsizecontainer.length>0)
			var orgfontsizev=textsizecontainer.val();
			var fontsizev=orgfontsizev;
			var boundaryheight=boundarycontainer.height();
			var boundary=boundarycontainer.width();
			//var numberofchars = text.length; 
			text=text.replace(/</g,"&lt;").replace(/>/g, "&gt;");
			var textcontainerid=textcontainer.attr("id");
			if(text.indexOf("\n") != -1)//there is enter
			{
				var copysepa=text.split("\n");
				var arraycount=copysepa.length;
				var i;
				var loopbreak=false;	
				for(i=0;i<=arraycount;i++)
				{
					if(i!=arraycount)
					{
						if(i==0)
							textcontainer.append("<span class='copy' id='"+textcontainerid+"tx"+i+"' name='"+textcontainerid+"tx"+i+"'>"+copysepa[i]+"</span>");
						else
							textcontainer.append("<br/><span class='copy' id='"+textcontainerid+"tx"+i+"' name='"+textcontainerid+"tx"+i+"'>"+copysepa[i]+"</span>");
						if(textsizecontainer.length>0)
						{
							var textcounter = textcontainer.find("span.copy");
							textcounter.css("font-size",fontsizev+"pt");
							textcounter.css("line-height",fontsizev+"pt");
						}
						var lastline=textcontainer.find("span:last-child");	
						while(lastline.width()>boundary)
						{
							fontsizev=parseInt(fontsizev);
							fontsizev=fontsizev-1;
							if(fontsizev>=6)
							{
								textsizecontainer.val(fontsizev);
								textcounter.css("font-size",fontsizev+"pt");
								textcounter.css("line-height",fontsizev+"pt");
							}
							else 
							{
								/*var j;
								var linelength=copysepa[i].length;																	
								for(j=0;j<copysepa[i].length;j++)
								{
									var subcopy=copysepa[i].substr(0,linelength-j);
									lastline.html(subcopy);
									if(textsizecontainer.length>0)
									{
										var textcounter = textcontainer.find("span.copy");
										textcounter.css("font-size",fontsizev+"pt");
										textcounter.css("line-height",fontsizev+"pt");
									}
									if(lastline.width()<=boundary)
									{
										i++;
										textcontainer.append("<br/><span class='copy' id='"+textcontainerid+"tx"+i+"' name='"+textcontainerid+"tx"+i+"'>"+copysepa[i].substr(linelength-j+1,j)+"</span>");
										loopbreak=true;
										break;
									}							
								}*/						
								textcontainer.html(orgcopy);
								textsizecontainer.val(orgfontsizev);
								returnshrink=false;
								loopbreak=true;
								break;							
							}
						}
						if(loopbreak)
							break;
					}
					else
					{
						textcontainer.find("span:last-child").html(copysepa[i]);
						if(textsizecontainer.length>0)
						{
							var fontsizev=textsizecontainer.val();
							var textcounter = textcontainer.find("span.copy");
							textcounter.css("font-size",fontsizev+"pt");
							textcounter.css("line-height",fontsizev+"pt");											
						}						
					}
					var textcounterlastrow = textcontainer.find("span:last-child.copy");	
					while(textcontainer.height()>boundaryheight)
					{
						fontsizev=parseInt(fontsizev);
						fontsizev=fontsizev-1;
						if(fontsizev>=6)
						{
							textsizecontainer.val(fontsizev);
							textcounter.css("font-size",fontsizev+"pt");
							textcounter.css("line-height",fontsizev+"pt");
						}
						else
						{
							textcontainer.html(orgcopy);
							textsizecontainer.val(orgfontsizev);
							//updatemaxlength(textcontainerid);
							returnshrink=false;
							break;
						}
					}
				}
			}
			else
			{
				textcontainer.append("<span class='copy' id='"+textcontainerid+"tx0"+"' name='"+textcontainerid+"tx0"+"'>"+text+"</span>");
				var textcounterlastrow = textcontainer.find("span:last-child.copy");	
				if(textsizecontainer.length>0)
				{
					var textcounter = textcontainer.find("span.copy");
					textcounter.css("font-size",fontsizev+"pt");	
					textcounter.css("line-height",fontsizev+"pt");							
				}						
				var textwidth=textcounterlastrow.width();
				var i=1;
				while(textwidth>boundary)
				{
					var c;
					var lastrow=textcounterlastrow.html();
					var numberofchars = lastrow.length; 
					for(c=0;c<numberofchars;c++)
					{
						var reducetext=lastrow.substring(0,numberofchars-c);
						textcounterlastrow.html(reducetext);
						var newtextwidth=textcounterlastrow.width();
						if(newtextwidth<=boundary)
						{
							var lastrowtext=lastrow.substring(numberofchars-c);
							textcontainer.append("<br/><span class='copy' id='"+textcontainerid+"tx"+i+"' name='"+textcontainerid+"tx"+i+"'>"+lastrowtext+"</span>");
							i++;
							if(textsizecontainer.length>0)
							{
								var textcounter = textcontainer.find("span.copy");
								textcounter.css("font-size",fontsizev+"pt");	
								textcounter.css("line-height",fontsizev+"pt");							
							}			
							break;
						}
					}
					textcounterlastrow = textcontainer.find("span:last-child.copy");
					textwidth=textcounterlastrow.width();//console.log(textcontainer.height()+":"+boundaryheight);
					//while(textcontainer.height()>boundaryheight)
					if(textcontainer.height()>boundaryheight)
					{
						fontsizev=parseInt(fontsizev);
						fontsizev=fontsizev-1;
						if(fontsizev>=6)
						{
							textsizecontainer.val(fontsizev);
							textcounter.css("font-size",fontsizev+"pt");
							textcounter.css("line-height",fontsizev+"pt");							
							updatepreviewsignsize(textcontainer,textcounter,text,boundarycontainer,textsizecontainer);		
						}
						else
						{
							textcontainer.html(orgcopy);
							textsizecontainer.val(orgfontsizev);
							//updatemaxlength(textcontainerid);
							returnshrink=false;
							break;
						}										
					}					
				}	
			}
			if(textcontainerid=="1")
				$(".vline_1preview").val(textcontainer.html());
			else if(textcontainerid=="2")
				$(".vline_2preview").val(textcontainer.html());	
			return  returnshrink;
		};  		  		
		function updatepreview(textcontainer,textcounter,text,boundarycontainer,textsizecontainer){ 
			var orgcopy=textcontainer.html();
			textcontainer.html("");
			var orgfontsizev=textsizecontainer.val();
			var fontsizev=orgfontsizev;
			var boundaryheight=boundarycontainer.height();
			var boundary=boundarycontainer.width();
			text=text.replace(/</g,"&lt;").replace(/>/g, "&gt;");
			var textcontainerid=textcontainer.attr("id");
			if(text.indexOf("\n") != -1)//there is enter
			{
				var copysepa=text.split("\n");
				var arraycount=copysepa.length;
				var i;
				var loopbreak=false;	
				for(i=0;i<=arraycount;i++)
				{
					if(i!=arraycount)
					{
						if(i==0)
							textcontainer.append("<span class='copy' id='"+textcontainerid+"tx"+i+"' name='"+textcontainerid+"tx"+i+"'>"+copysepa[i]+"</span>");
						else
							textcontainer.append("<br/><span class='copy' id='"+textcontainerid+"tx"+i+"' name='"+textcontainerid+"tx"+i+"'>"+copysepa[i]+"</span>");
						if(textsizecontainer.length>0)
						{
							var textcounter = textcontainer.find("span.copy");
							textcounter.css("font-size",fontsizev+"pt");
							textcounter.css("line-height",fontsizev+"pt");
						}
						var lastline=textcontainer.find("span:last-child");	
						while(lastline.width()>boundary)
						{
							fontsizev=parseInt(fontsizev);
							fontsizev=fontsizev-1;
							if(fontsizev>=6)
							{
								textsizecontainer.val(fontsizev);
								textcounter.css("font-size",fontsizev+"pt");
								textcounter.css("line-height",fontsizev+"pt");
							}
							else 
							{
								textcontainer.html(orgcopy);
								textsizecontainer.val(orgfontsizev);							
								if(orgcopy!="")
									updatemaxlength(textcontainerid);
								else
								{
									$("#line-"+textcontainerid+"-container").find("span.current-characters").html("0");
									$("#textarea_"+textcontainerid).val("");
								}
								loopbreak=true;
								break;								
							}
						}
						if(loopbreak)
							break;
					}
					else
					{
						textcontainer.find("span:last-child").html(copysepa[i]);
						if(textsizecontainer.length>0)
						{
							var fontsizev=textsizecontainer.val();
							var textcounter = textcontainer.find("span.copy");
							textcounter.css("font-size",fontsizev+"pt");
							textcounter.css("line-height",fontsizev+"pt");											
						}						
					}
					var textcounterlastrow = textcontainer.find("span:last-child.copy");	
					while(textcontainer.height()>boundaryheight)
					{
						fontsizev=parseInt(fontsizev);
						fontsizev=fontsizev-1;
						if(fontsizev>=6)
						{
							textsizecontainer.val(fontsizev);
							textcounter.css("font-size",fontsizev+"pt");
							textcounter.css("line-height",fontsizev+"pt");
						}
						else
						{
							textcontainer.html(orgcopy);
							textsizecontainer.val(orgfontsizev);							
							if(orgcopy!="")
								updatemaxlength(textcontainerid);
							else
							{
								$("#line-"+textcontainerid+"-container").find("span.current-characters").html("0");
								$("#textarea_"+textcontainerid).val("");
							}
							break;
						}
					}
				}
			}
			else
			{
				textcontainer.append("<span class='copy' id='"+textcontainerid+"tx0"+"' name='"+textcontainerid+"tx0"+"'>"+text+"</span>");
				var textcounterlastrow = textcontainer.find("span:last-child.copy");	
				if(textsizecontainer.length>0)
				{
					var textcounter = textcontainer.find("span.copy");
					textcounter.css("font-size",fontsizev+"pt");	
					textcounter.css("line-height",fontsizev+"pt");							
				}						
				var textwidth=textcounterlastrow.width();
				var i=1;
				while(textwidth>boundary)
				{
					var c;
					var lastrow=textcounterlastrow.html();
					var numberofchars = lastrow.length; 
					for(c=0;c<numberofchars;c++)
					{
						var reducetext=lastrow.substring(0,numberofchars-c);
						textcounterlastrow.html(reducetext);
						var newtextwidth=textcounterlastrow.width();
						if(newtextwidth<=boundary)
						{
							var lastrowtext=lastrow.substring(numberofchars-c);
							textcontainer.append("<br/><span class='copy' id='"+textcontainerid+"tx"+i+"' name='"+textcontainerid+"tx"+i+"'>"+lastrowtext+"</span>");
							i++;
							if(textsizecontainer.length>0)
							{
								var textcounter = textcontainer.find("span.copy");
								textcounter.css("font-size",fontsizev+"pt");	
								textcounter.css("line-height",fontsizev+"pt");							
							}			
							break;
						}
					}
					textcounterlastrow = textcontainer.find("span:last-child.copy");
					textwidth=textcounterlastrow.width();//console.log(textcontainer.height()+":"+boundaryheight);
					if(textcontainer.height()>boundaryheight)
					{
						fontsizev=parseInt(fontsizev);
						fontsizev=fontsizev-1;
						if(fontsizev>=6)
						{
							textsizecontainer.val(fontsizev);
							textcounter.css("font-size",fontsizev+"pt");
							textcounter.css("line-height",fontsizev+"pt");							
							updatepreview(textcontainer,textcounter,text,boundarycontainer,textsizecontainer);		
						}
						else
						{
							textcontainer.html(orgcopy);
							textsizecontainer.val(orgfontsizev);							
							if(orgcopy!="")
								updatemaxlength(textcontainerid);
							else
							{
								$("#line-"+textcontainerid+"-container").find("span.current-characters").html("0");
								$("#textarea_"+textcontainerid).val("");
							}
							break;
						}										
					}										
				}					
			}
			$(".vline_"+textcontainerid+"preview").val(textcontainer.html());
			//return returnshrink;		 
		};  
		function updatepreviewshrink(textcontainer,textcounter,text,boundarycontainer,textsizecontainer){ 
			var orgcopy=textcontainer.html();
			textcontainer.html("");
			var orgfontsizev=textsizecontainer.val();
			var fontsizev=orgfontsizev;
			var boundaryheight=boundarycontainer.height();
			var boundary=boundarycontainer.width();
			text=text.replace(/</g,"&lt;").replace(/>/g, "&gt;");
			var textcontainerid=textcontainer.attr("id");
			if(text.indexOf("\n") != -1)//there is enter
			{
				var copysepa=text.split("\n");
				var arraycount=copysepa.length;
				var i;
				var loopbreak=false;	
				for(i=0;i<=arraycount;i++)
				{
					if(i!=arraycount)
					{
						if(i==0)
							textcontainer.append("<span class='copy' id='"+textcontainerid+"tx"+i+"' name='"+textcontainerid+"tx"+i+"'>"+copysepa[i]+"</span>");
						else
							textcontainer.append("<br/><span class='copy' id='"+textcontainerid+"tx"+i+"' name='"+textcontainerid+"tx"+i+"'>"+copysepa[i]+"</span>");
						if(textsizecontainer.length>0)
						{
							var textcounter = textcontainer.find("span.copy");
							textcounter.css("font-size",fontsizev+"pt");
							textcounter.css("line-height",fontsizev+"pt");
						}
						var lastline=textcontainer.find("span:last-child");	
						while(lastline.width()>boundary)
						{
							fontsizev=parseInt(fontsizev);
							fontsizev=fontsizev-1;
							if(fontsizev>=6)
							{
								textsizecontainer.val(fontsizev);
								textcounter.css("font-size",fontsizev+"pt");
								textcounter.css("line-height",fontsizev+"pt");
							}
							else 
							{
								textcontainer.html(orgcopy);
								textsizecontainer.val(orgfontsizev);							
								if(orgcopy!="")
									updatemaxlength(textcontainerid);
								else
								{
									$("#line-"+textcontainerid+"-container").find("span.current-characters").html("0");
									$("#textarea_"+textcontainerid).val("");
								}
								loopbreak=true;
								break;								
							}
						}
						if(loopbreak)
							break;
					}
					else
					{
						textcontainer.find("span:last-child").html(copysepa[i]);
						if(textsizecontainer.length>0)
						{
							var fontsizev=textsizecontainer.val();
							var textcounter = textcontainer.find("span.copy");
							textcounter.css("font-size",fontsizev+"pt");
							textcounter.css("line-height",fontsizev+"pt");											
						}						
					}
					var textcounterlastrow = textcontainer.find("span:last-child.copy");	
					while(textcontainer.height()>boundaryheight)
					{
						fontsizev=parseInt(fontsizev);
						fontsizev=fontsizev-1;
						if(fontsizev>=6)
						{
							textsizecontainer.val(fontsizev);
							textcounter.css("font-size",fontsizev+"pt");
							textcounter.css("line-height",fontsizev+"pt");
						}
						else
						{
							textcontainer.html(orgcopy);
							textsizecontainer.val(orgfontsizev);							
							if(orgcopy!="")
								updatemaxlength(textcontainerid);
							else
							{
								$("#line-"+textcontainerid+"-container").find("span.current-characters").html("0");
								$("#textarea_"+textcontainerid).val("");
							}
							break;
						}
					}
				}
			}
			else
			{
				textcontainer.append("<span class='copy' id='"+textcontainerid+"tx0"+"' name='"+textcontainerid+"tx0"+"'>"+text+"</span>");
				var textcounterlastrow = textcontainer.find("span:last-child.copy");	
				if(textsizecontainer.length>0)
				{
					var textcounter = textcontainer.find("span.copy");
					textcounter.css("font-size",fontsizev+"pt");	
					textcounter.css("line-height",fontsizev+"pt");							
				}						
				var textwidth=textcounterlastrow.width();
				var i=1;
				while(textwidth>boundary)
				{
					var c;
					var lastrow=textcounterlastrow.html();
					var numberofchars = lastrow.length; 
					for(c=0;c<numberofchars;c++)
					{
						var reducetext=lastrow.substring(0,numberofchars-c);
						textcounterlastrow.html(reducetext);
						var newtextwidth=textcounterlastrow.width();
						if(newtextwidth<=boundary)
						{
							var lastrowtext=lastrow.substring(numberofchars-c);
							textcontainer.append("<br/><span class='copy' id='"+textcontainerid+"tx"+i+"' name='"+textcontainerid+"tx"+i+"'>"+lastrowtext+"</span>");
							i++;
							if(textsizecontainer.length>0)
							{
								var textcounter = textcontainer.find("span.copy");
								textcounter.css("font-size",fontsizev+"pt");	
								textcounter.css("line-height",fontsizev+"pt");							
							}			
							break;
						}
					}
					textcounterlastrow = textcontainer.find("span:last-child.copy");
					textwidth=textcounterlastrow.width();//console.log(textcontainer.height()+":"+boundaryheight);				
				}
				if(textcontainer.height()>boundaryheight)
				{
					fontsizev=parseInt(fontsizev);
					fontsizev=fontsizev-1;
					if(fontsizev>=6)
					{
						textsizecontainer.val(fontsizev);
						textcounter.css("font-size",fontsizev+"pt");
						textcounter.css("line-height",fontsizev+"pt");					
						updatepreview(textcontainer,textcounter,text,boundarycontainer,textsizecontainer);		
					}
					else
					{
						textcontainer.html(orgcopy);
						textsizecontainer.val(orgfontsizev);							
						if(orgcopy!="")
							updatemaxlength(textcontainerid);
						else
						{
							$("#line-"+textcontainerid+"-container").find("span.current-characters").html("0");
							$("#textarea_"+textcontainerid).val("");
						}
					}										
				}							
			}
			if(textcontainerid=="1")
				$(".vline_1preview").val(textcontainer.html());
			else if(textcontainerid=="2")
				$(".vline_2preview").val(textcontainer.html());	
			//return returnshrink;		 
		};  		
	$("#textarea_1").keyup(function() {
		if($("#textarea1cantresize").length>0&&$("#textarea1cantresize").is(":visible"))
			$("#textarea1cantresize").hide();
		if($("#signcantresize").length>0&&$("#signcantresize").is(":visible"))
			$("#signcantresize").hide();		
		var copy2 = $("#textarea_2").val();
		var copy1 = $(this).val();
		if($("#textarea1_shrink_height").length>0)
		{
			var textarea1_newheight=$("#textarea1_shrink_height").val();
			var textarea1_org_height=$("#textarea1_org_height").val();
			if(copy2!=""&&copy1!="")
			{
				$("#product_text1").css("height",textarea1_newheight);
			}
		}		
		var counter1 = $("#line-1-container").find("span.current-characters");
		if(copy1.indexOf("\n") != -1)
		{
			var numberofchars1 = copy1.length;
			//var maxleng=$("#textarea_1").attr("maxlength");//remove max length
			//console.log(copy1.substr(numberofchars1-1)+":"+copy1.substr(numberofchars1-2));
			var copysepa=copy1.split("\n");
			var arraycount=copysepa.length;//console.log(numberofchars1+":"+copysepa[arraycount-2]+":"+copysepa[arraycount-1]);
			var orgtext=copy1.substr(0,numberofchars1-1);      	     
			var maxchar=$("#line_1_maxabs").val();
			maxchar=parseInt(maxchar);
			maxchar=maxchar+arraycount-1;
			//$("#textarea_1").attr("maxlength",maxchar);//remove max length
			numberofchars1=numberofchars1-arraycount+1;
		}	
		else
		{
			var numberofchars1 = copy1.length;
			var maxchar=$("#line_1_maxabs").val();
			//$("#textarea_1").attr("maxlength",maxchar);
			var orgtext=copy1.substr(0,numberofchars1-1);
		}
		counter1.html(numberofchars1);
		var text1counter = $("#preview-image").find(".line_1 span.copy");
		var text1container = $("#preview-image").find(".line_1");
		var max_abs=$("#line_1_maxabs").val();
		var text1boundry = $("#preview-image").find("#product_text1");
		var textsizecontainer=$("#line_1_textsize");
		updatepreview(text1container,text1counter,copy1,text1boundry,textsizecontainer);
		$(".vline_1").val(copy1);
		//if($(".textarea1_shrink").val()=="Y")
			//$(".textarea1_shrink").val("N");
	});	
	$(".line-containers #textarea_2").keyup(function() {
		if($("#signcantresize").length>0&&$("#signcantresize").is(":visible"))
			$("#signcantresize").hide();	
		var copy1 = $("#textarea_1").val();
		var counter2 = $("#line-2-container").find("span.current-characters");
		var copy2 = $(this).val();
		if($("#textarea1_shrink_height").length>0)
		{
			var textarea1_newheight=$("#textarea1_shrink_height").val();
			var textarea1_org_height=$("#textarea1_org_height").val();
			if(copy2!=""&&copy1!="")
			{				
				var orgheight=$("#product_text1").css("height");
				$("#product_text1").css("height",textarea1_newheight);
				var text1counter = $("#preview-image").find(".line_1 span.copy");
				var text1container = $("#preview-image").find(".line_1");
				var orgtextarea1preview=text1container.html();
				var max_abs=$("#line_1_maxabs").val();
				var text1boundry = $("#preview-image").find("#product_text1");
				var textsizecontainer=$("#line_1_textsize");
				if(text1container.height()>text1boundry.height())
				{
					var orgtextarea1size=textsizecontainer.val();
					$(".v_textarea1_orgsize").val(orgtextarea1size);
					updatepreviewshrink(text1container,text1counter,copy1,text1boundry,textsizecontainer);
					if(text1container.height()>textarea1_newheight)
					{
						$("#product_text1").css("height",orgheight);
						textsizecontainer.val(orgtextarea1size);
						text1container.html(orgtextarea1preview);
						copy2="";
						$(this).val("");
						$("#textarea1cantresize").show();
						$("#textarea_1").focus();
					}
					else
						$(".textarea1_shrink").val("Y");	
				}		
			}
			else if(copy2=="")
			{
				$("#product_text1").css("height",textarea1_org_height);
				if($(".textarea1_shrink").val()=="Y")
				{
					$(".textarea1_shrink").val("N");
					var orgtext1size=$(".v_textarea1_orgsize").val();
					var orgtextarea1size=$(".v_textarea1_orgsize").val();
					var text1counter = $("#preview-image").find(".line_1 span.copy");
					var text1container = $("#preview-image").find(".line_1");
					var text1boundry = $("#preview-image").find("#product_text1");
					var textsizecontainer=$("#line_1_textsize");
					textsizecontainer.val(orgtext1size);
					updatepreview(text1container,text1counter,copy1,text1boundry,textsizecontainer);				
				}
			}	
		}
		if(copy2.indexOf("\n") != -1)
		{
			var numberofchars2 = copy2.length;
			//var maxleng=$("#textarea_2").attr("maxlength");
			var copysepa=copy2.split("\n");
			var arraycount=copysepa.length;//console.log(numberofchars1+":"+copysepa[arraycount-2]+":"+copysepa[arraycount-1]);
			var orgtext=copy2.substr(0,numberofchars2-1);      	     
			var maxchar=$("#line_2_maxabs").val();
			maxchar=parseInt(maxchar);
			maxchar=maxchar+arraycount-1;
			//$("#textarea_2").attr("maxlength",maxchar);
			numberofchars2=numberofchars2-arraycount+1;
		}	
		else
		{
			var numberofchars2 = copy2.length;
			var maxchar=$("#line_2_maxabs").val();
			//$("#textarea_2").attr("maxlength",maxchar);
			var orgtext=copy2.substr(0,numberofchars2-1);
		}
		counter2.html(numberofchars2);
		var text2counter = $("#preview-image").find(".line_2 span.copy");
		var text2container = $("#preview-image").find(".line_2");
		var max_abs=$("#line_2_maxabs").val();
		var text2boundry = $("#preview-image").find("#product_text2");
		var textsizecontainer=$("#line_2_textsize");
		updatepreview(text2container,text2counter,copy2,text2boundry,textsizecontainer);
		$(".vline_2").val(copy2);
	});	
	function updatemaxlength(id)
	{	
		var counter1 = $("#line-1-container").find("span.current-characters");
		var lineid=$(".line_1").find("span:last-child").attr("id");
		var spannum_sepa=lineid.split("x");		
		var spannum=parseInt(spannum_sepa[1]);
		var orgtext="";
		for (var i=0;i<=spannum;i++)
		{
			var spanid="1tx"+i;
			if(i!=spannum)
			{
				orgtext=orgtext+$('span#'+spanid).html()+"\n";
			}
			else
			{
				orgtext=orgtext+$('span#'+spanid).html();
			}
		}				
		$("#textarea_1").val(orgtext);
		if(orgtext.indexOf("\n") != -1)
		{
			var textlength=orgtext.length;
			var copysepa=orgtext.split("\n");
			var arraycount=copysepa.length;
			textlength=textlength-arraycount+1;	
			counter1.html(textlength);
		}
		else
		{
			var textlength=orgtext.length;
			counter1.html(textlength);
		}		
		if(id=="1"&&$(".line_1").html()!="")
		{
			var counter1 = $("#line-1-container").find("span.current-characters");
			var lineid=$(".line_1").find("span:last-child").attr("id");
			var spannum_sepa=lineid.split("x");		
			var spannum=parseInt(spannum_sepa[1]);
			var orgtext="";
			for (var i=0;i<=spannum;i++)
			{
				var spanid="1tx"+i;
				if(i!=spannum)
				{
					orgtext=orgtext+$('span#'+spanid).html()+"\n";
				}
				else
				{
					orgtext=orgtext+$('span#'+spanid).html();
				}
			}				
			$("#textarea_1").val(orgtext);
			if(orgtext.indexOf("\n") != -1)
			{
				var textlength=orgtext.length;
				var copysepa=orgtext.split("\n");
				var arraycount=copysepa.length;
				textlength=textlength-arraycount+1;	
				counter1.html(textlength);
			}
			else
			{
				var textlength=orgtext.length;
				counter1.html(textlength);
			}
		}
		else if(id=="2"&&$(".line_2").html()!="")
		{
			var counter2 = $("#line-2-container").find("span.current-characters");
			var lineid=$(".line_2").find("span:last-child").attr("id");
			var spannum_sepa=lineid.split("x");		
			var spannum=parseInt(spannum_sepa[1]);
			var orgtext="";
			for (var i=0;i<=spannum;i++)
			{
				var spanid="2tx"+i;
				if(i!=spannum)
				{
					orgtext=orgtext+$('span#'+spanid).html()+"\n";
				}
				else
				{
					orgtext=orgtext+$('span#'+spanid).html();
				}
			}	
			if(orgtext.indexOf("\n") != -1)
			{
				$("#textarea_2").val(orgtext);
				var textlength=orgtext.length;
				var copysepa=orgtext.split("\n");
				var arraycount=copysepa.length;
				textlength=textlength-arraycount+1;	
				counter2.html(textlength);
			}
			else
			{
				textlength=textlength-arraycount+1;	
				counter2.html(textlength);			
			}
		}
	}
	$(".line-containers #line_1").keyup(function() {
		var counter1 = $("#line-1-container").find("span.current-characters");
		var copy1 = $(this).val();
		if($("#line_2").length)
		{
		var copy2 = $(".line-containers #line_2").val();	
		var numberofchars2 = copy2.length;
		}
		else
			var numberofchars2=0;
		var numberofchars1 = copy1.length;		
		counter1.html(numberofchars1);
		var text1counter = $("#preview-image").find(".line_1 span.copy");
		var text1container = $("#preview-image").find(".line_1");
		//var text1counter = $("#preview-image").find(".line_1");
		var max_char_display=$("#line-1-container").find("span.max-characters");
		text1counter.html(copy1);
		var max_recomm=$("#line_1_maxrecom").val();
		var max_abs=$("#line_1_maxabs").val();
		if(numberofchars1>max_recomm)
		{
			if( !$("#over-max").is(":visible"))
				$("#over-max").show("fast");
			counter1.addClass("over-max");
			max_char_display.html(max_abs);				
		}
		else
		{
			if( $("#over-max").is(":visible")&&numberofchars2<=max_recomm)
				$("#over-max").hide("fast");
			counter1.removeClass("over-max");
			max_char_display.html(max_recomm);		
		}
		if($("#overmaximum").is(":visible")&&numberofchars1<=max_abs&&numberofchars2<=max_abs)
		{
			$("#overmaximum").hide();
		}
		else if($("#overmaximum").is(":visible")&&numberofchars1<=max_abs&&numberofchars2>max_abs)
		{
			$("#lineovermax").html("Line 2's text is");	
		}		
		var text1boundry = $("#preview-image").find(".product_text");
		$(".vline_1").val(copy1);
		
		compress_text(text1counter, text1boundry, text1container, copy1);
	});	
	//focus_events($("#line2outer"));
	//focus_events($("#line1outer"));
	$(".line-containers #line_2").keyup(function() {		
		var counter2 = $("#line-2-container").find("span.current-characters");
		var text2container = $("#preview-image").find(".line_2");
		var copy2 = $(this).val();
		var copy1 = $(".line-containers #line_1").val(); 
		var numberofchars2 = copy2.length;
		var numberofchars1 = copy1.length;	
		counter2.html(numberofchars2);
		var text2counter = $("#preview-image").find(".line_2 span.copy");
		var max_char_display=$("#line-2-container").find("span.max-characters");
		text2counter.html(copy2);
		var max_recomm=$("#line_1_maxrecom").val();
		var max_abs=$("#line_1_maxabs").val();	
		if(numberofchars2>max_recomm)
		{
			if( !$("#over-max").is(":visible"))
				$("#over-max").show("fast");
			counter2.addClass("over-max");
			max_char_display.html(max_abs);				
		}
		else
		{
			if( $("#over-max").is(":visible")&&numberofchars1<=max_recomm)
				$("#over-max").hide("fast");
			counter2.removeClass("over-max");
			max_char_display.html(max_recomm);		
		}
		if($("#overmaximum").is(":visible")&&numberofchars2<=max_abs&&numberofchars1<=max_abs)
		{
			$("#overmaximum").hide();
		}
		else if($("#overmaximum").is(":visible")&&numberofchars2<=max_abs&&numberofchars1>max_abs)
		{
			$("#lineovermax").html("Line 1's text is");	
		}		
		var text2boundry = $("#preview-image").find(".product_text");
		var text1boundry = $("#preview-image").find(".product_text");
		var text1counter = $("#preview-image").find(".line_1 span.copy");
		var text1container = $("#preview-image").find(".line_1");
		
		
		$(".vline_2").val(copy2);
		//var linewidth=text2counter.width();
		//$("#line2_width").val(linewidth);		
		if(copy2!="")
		{
			$("#lineclass").val("twoline"); 
			updateclass();
		}
		else
		{
			$("#lineclass").val("oneline"); 
			updateclass();	
				
		}
		compress_text(text1counter, text1boundry, text1container, copy1);
		compress_text(text2counter, text2boundry, text2container, copy2);				
	});
	$(".line-containers #sidetext").keyup(function() {
		var counter2 = $("#line-2-container").find("span.current-characters");
		var copy2 = $(this).val();
		var numberofchars2 = copy2.length;
		counter2.html(numberofchars2);
		//var text2counter = $("#preview-image").find(".line_2 span.copy");
		var text2counter = $("#preview-image").find("#streetnum p");
		text2counter.html(copy2);	
		//var text2boundry = $("#preview-image").find(".vertically-aligned-copy2");
		$(".vsidetext").val(copy2);		
		
		var copyNum = $("#sidetext").val();
		var textNumcounter = $("#preview-image #streetnum p");
		var textNumcontainer = $("#preview-image #streetnum");
		var textNumboundry = $("#preview-image #streetnum");
		compress_text_streetnum(textNumcounter, textNumboundry, textNumcontainer, copyNum);
		
	
	});
	$("#sign_size").change(function(){
		updateclass(); 
			if($('#text_upper').length>0)
			{
				var checkboxv=$('#text_upper').val();
				
				if(checkboxv=="Y")
				{
					$("#custom-product-images p").addClass("capitalize");
					var x4 = $("#custom-product-images").hasClass("x4");
					var x6 = $("#custom-product-images").hasClass("x6");
						var x9 = $("#custom-product-images").hasClass("x9");
					if (x6 == true || x4 == true){
						$("#custom-product-images p.line_1").addClass("capitalizeSizex6");
						$("#custom-product-images p.line_2").addClass("capitalizeSizex6");
						$("#custom-product-images p.line_1").removeClass("capitalizeSizex9");
						$("#custom-product-images p.line_2").removeClass("capitalizeSizex9");
					}else if (x9 == true){
						$("#custom-product-images p.line_1").addClass("capitalizeSizex9");
						$("#custom-product-images p.line_2").addClass("capitalizeSizex9");
						$("#custom-product-images p.line_1").removeClass("capitalizeSizex6");
						$("#custom-product-images p.line_2").removeClass("capitalizeSizex6");
					}
					if($("#line_1").length>0)
					{
						var copy1=$("#line_1").val();
						var text1boundry = $("#preview-image").find(".vertically-aligned-copy1");
						var text1counter = $("#preview-image").find(".line_1 span.copy");
						var text1container = $("#preview-image").find(".line_1");
						compress_text(text1counter, text1boundry, text1container, copy1);
					}
					if($("#line_2").length>0)
					{
						var copy2=$("#line_2").val();	
						var text2boundry = $("#preview-image").find(".vertically-aligned-copy2");
						var text2counter = $("#preview-image").find(".line_2 span.copy");	
						var text2container = $("#preview-image").find(".line_2");
						compress_text(text2counter, text2boundry, text2container,copy2);
					}	
					if($("#suffix_selector").length>0)
					{
					var copy1 = $("#suffix_selector").val();
					var text1counter = $("#preview-image #suffix p");
					var text1container = $("#preview-image #suffix");
					var text1boundry = $("#preview-image #suffix");
					compress_text_suffix(text1counter, text1boundry, text1container, copy1);
					}
					if($("#sidetext").length>0)
					{
					var copyNum = $("#sidetext").val();
					var textNumcounter = $("#preview-image #streetnum p");
					var textNumcontainer = $("#preview-image #streetnum");
					var textNumboundry = $("#preview-image #streetnum");
					compress_text_streetnum(textNumcounter, textNumboundry, textNumcontainer, copyNum);
					}
				}
			}
		var layout=$("#layout").val();
		var size=$("#sign_size").val();
		var size_sepa=size.split("|");
		var size_value=size_sepa[0];
		if(!$("#customproduct").length>0)
		{	
			size_value=size_value.substring(1);
			var sepavalue=size_value.split("x");
			var size_o=sepavalue[0]+"x "+sepavalue[1]+"''";	
		}
		else
			var size_o=size_value;
	
		var color=$("#sign_color").val();
		var max_char=size_sepa[1];
		var max_absolute=size_sepa[2];
		if(max_char=="")
			max_char=max_absolute;	
		if($("#line_1_maxrecom").length > 0)
			$("#line_1_maxrecom").val(max_char);
		$("#line_1_maxabs").val(max_absolute);
		if ($("#.line-containers #line_1").length > 0) 
		{
			var copy1 = $(".line-containers #line_1").val();
			var text1boundry = $("#preview-image").find(".vertically-aligned-copy1");
			var text1counter = $("#preview-image").find(".line_1 span.copy");
			var text1container = $("#preview-image").find(".line_1");
			compress_text(text1counter, text1boundry, text1container, copy1);	
		}
		var copy2="";
		if ($("#.line-containers #line_2").length > 0)	
		{
			var copy2 = $(".line-containers #line_2").val();
			var text2boundry = $("#preview-image").find(".vertically-aligned-copy2");
			var text2counter = $("#preview-image").find(".line_2 span.copy");
			var text2container = $("#preview-image").find(".line_2");
			compress_text(text2counter, text2boundry, text2container, copy2); 		
		}
		var productno=$("#productno").val();
		var p_id=$("#p_id").val();
		var loadpath=$("#loadpath").val();
		/*if ($("#.line-containers #line_1").length > 0) 
			var line_1=$("#line_1").val();
		if($("#.line-containers #line_2").length > 0) 
			var line_2=$("#line_2").val();
		else
			var line_2="";*/
		if ($("#prefix_selector").length > 0) 
			var prefix=$("#prefix_selector").val();
		else var prefix="";
		if ($("#suffix_selector").length > 0) 
		{
			var suffix=$("#suffix_selector").val(); 
			var suffixcounter = $("#preview-image #suffix p");
			var suffixcontainer = $("#preview-image #suffix");
			var suffixboundry = $("#preview-image #suffix");
			compress_text_suffix(suffixcounter, suffixboundry, suffixcontainer, suffix);			
		}
		else var suffix=""; 
		if ($("#position_selector").length > 0) 
			var position=$("#position_selector").val();
		else var position=""; 
		if ($("#sign_background").length > 0) 
			var background=$("#sign_background").val();
		else var background=""; 
		if ($("#sign_font").length > 0) 
			var font=$("#sign_font").val(); 
		else 
			var font="";
		if($("#text_colorddl").length > 0)
			var textcolor=$("#text_colorddl").val();
		else
			var textcolor="";
		if($("#arrow_selector").length > 0)
			var arrow=$("#arrow_selector").val();
		else
			var arrow="";
		if($("#arrowcolor_selector").length > 0)
			var arrowcolor=$("#arrowcolor_selector").val();
		else
			var arrowcolor="";		
		if($("#text_upper").length>0)
			var textupper=$("#text_upper").val();
		else
			var textupper="";
		var mounting=$("#mounting_option").val();
		var filename=$("#uploadfilename").val();
		var fileid=$("#uploadfileid").val();		
		if($("#line_1_textsize").length>0)
			var textsize=$("#line_1_textsize").val();	
		else
			var textsize="";
		if($("#line_2_textsize").length>0)
			var textsize2=$("#line_2_textsize").val();	
		else
			var textsize2="";
		var special_comment=$("#special-instructions-text").val();			 	
		if($("#customproduct").length>0)
		{
			var changesize=true;
			var custom_product=$("#customproduct").val();
			if($("#.line-containers #textarea_1").length > 0) 
				var copy1 = $(".line-containers #textarea_1").val();
			if($("#.line-containers #textarea_2").length > 0)
				var copy2 = $(".line-containers #textarea_2").val();		
			$.get("../process/process_quickbuy.php",{'action':2,'color' : color,'size':size_o,'layout':layout},
			function(data)
			{
				data=jQuery.trim(data);
				var datasepa=data.split("|");
				/*if($("#textarea1_shrink_height").length>0&&$("#textarea2").val()!="")
				{				
					var newtextarea1height=$("#textarea1_shrink_height").val();
					$("#product_text1").css("height",newtextarea1height);//asume height doesn't change by size
				}
				else
					$("#product_text1").css("height",datasepa[6]);*/	
				var orgbgdimg=$("#custom-product-images.custom_parking_signs").css("background-image");
				var orgbgdposition=$("#custom-product-images.custom_parking_signs").css("background-position");		
				$("#custom-product-images.custom_parking_signs").css("background-image"," url(../images/parking-signs/"+datasepa[0]+")");
				var orgwidth1=$("#product_text1").css("width");
				var orgleft1=$("#product_text1").css("left");
				var orgtop1=$("#product_text1").css("top");
				$("#product_text1").css("width",datasepa[5]).css("left",datasepa[3]+201).css("top",datasepa[4]);		
				if(datasepa[7]!=0)
				{
					var orgwidth2=$("#product_text2").css("width");
					var orgleft2=$("#product_text2").css("left");
					var orgtop2=$("#product_text2").css("top");					
					$("#product_text2").css("width",datasepa[9]).css("left",datasepa[7]+201).css("top",datasepa[8]).css("height",datasepa[10]);	
				}
				$("#custom-product-images.custom_parking_signs").css("background-position","200px 0px");
				var text1counter = $("#preview-image").find(".line_1 span.copy");
				var text1container = $("#preview-image").find(".line_1");
				var text1boundry = $("#preview-image").find("#product_text1");
				var textsizecontainer=$("#line_1_textsize");
				if(!updatepreviewsignsize(text1container,text1counter,copy1,text1boundry,textsizecontainer))
					changesize=false;
				var text2counter = $("#preview-image").find(".line_2 span.copy");
				var text2container = $("#preview-image").find(".line_2");
				var text2boundry = $("#preview-image").find("#product_text2");
				var textsizecontainer2=$("#line_2_textsize");
				if(!updatepreviewsignsize(text2container,text2counter,copy2,text2boundry,textsizecontainer2))
					changesize=false;
				if(!changesize)
				{
					$("#custom-product-images.custom_parking_signs").css("background-image",orgbgdimg).css("background-position",orgbgdposition);	
					$("#product_text1").css("width",orgwidth1).css("left",orgleft1).css("top",orgtop1);
					if(datasepa[7]!=0)
						$("#product_text2").css("width",orgwidth2).css("left",orgleft2).css("top",orgtop2);					
					var orgsize=$("#size_value_pre").val();
					$("#signcantresize").show();
					$("#sign_size").val(orgsize);
					var orgsize_sepa=orgsize.split("|");
					size_value=orgsize_sepa[0];
				}
				else
					$("#size_value_pre").val(size);	
				$(".viewmaterial").load(loadpath, {'product_no': productno,'size':size_value,'pid':p_id,'line_1':copy1,'line_2':copy2,'prefix':prefix,'suffix':suffix,'position':position,'color':color,'font':font,'mounting':mounting,'filename':filename,'fileid':fileid,'layout':layout, 'textupper':textupper,'textcolor':textcolor,'arrow':arrow,'arrowcolor':arrowcolor,'textsize':textsize,'textsize2':textsize2,'background':background,'special_comment':special_comment,'custom_product':custom_product}, function(value){ 
				$('.add-to-cart-confirmation a.continue-shopping').click(function(){
				$('.add-to-cart-confirmation.showme').fadeOut("fast");
				return false; 
				});
				$('table tr.data-row').mouseover(function(){$(this).addClass("over");}).mouseout(function(){$(this).removeClass("over");}); 
				addtocartform(); 
				
				}); 															
			});
		}
		else
			var custom_product="";	
		var counter1 = $("#line-1-container").find("span.current-characters");
		var counter2 = $("#line-2-container").find("span.current-characters");
		var max_counter1=$("#line-1-container .max-characters");
		if(!($("#sidetext").length > 0))
			var max_counter2=$("#line-2-container .max-characters");
		if(!(!changesize&&$("#customproduct").length>0))
		{	
			if($("#.line-containers #textarea_1").length > 0) 
			{
				if(copy1.indexOf("\n") != -1)
				{
					var numberofchars1 = copy1.length;
					var copysepa=copy1.split("\n");
					var arraycount=copysepa.length;
					max_absolute=parseInt(max_absolute);
					//var max_absolute_ac=max_absolute+arraycount-1;
					//$("#textarea_1").attr("maxlength",max_absolute_ac);
					$("#line_1_maxabs").val(max_absolute_ac);
				}		
			}
			if($("#.line-containers #textarea_2").length > 0)
			{ 
				if(copy2.indexOf("\n") != -1)
				{
					var numberofchars2 = copy2.length;
					var copysepa2=copy2.split("\n");
					var arraycount2=copysepa.length;
					max_absolute=parseInt(max_absolute);
					//var max_absolute_ac=max_absolute+arraycount2-1;
					//$("#textarea_2").attr("maxlength",max_absolute_ac);
					$("#line_2_maxabs").val(max_absolute_ac);
				}			
			}					
			if(copy1.length>max_char&&!counter1.hasClass('over-max'))//check gulu
			{
				counter1.addClass("over-max");
				max_counter1.html(max_absolute);
			}
			else if(copy1.length>max_char)
			{
				max_counter1.html(max_absolute);
			}
			else if(copy1.length<=max_char&&counter1.hasClass('over-max'))
			{
				counter1.removeClass("over-max");
				max_counter1.html(max_char);
			}
			else if(copy1.length<=max_char)
			{
				max_counter1.html(max_char);
			}
			if($(".vsize").length>0)
				$(".vsize").val(size_o);
		}
		if(!($("#sidetext").length > 0)&&$("#.line-containers #line_2").length > 0)
		{
			if(copy2.length>max_char&&!counter2.hasClass('over-max'))//check gulu
			{
				counter2.addClass("over-max");
				max_counter2.html(max_absolute);
			}
			else if(copy2.length>max_char)
			{
				max_counter2.html(max_absolute);
			}
			else if(copy2.length<=max_char&&counter2.hasClass('over-max'))
			{
				counter2.removeClass("over-max");
				max_counter2.html(max_char);
			}
			else if(copy2.length<=max_char)
			{
				max_counter2.html(max_char);
			}
		}
		if($("#over-max").is(":visible")&&!counter1.hasClass('over-max')&&!counter2.hasClass('over-max'))
			$("#over-max").hide("fast");
		else if(!$("#over-max").is(":visible")&&(counter1.hasClass('over-max')||counter2.hasClass('over-max')))
			$("#over-max").show("fast");
		$("#line_1").attr("maxlength", max_absolute);
		if($("#.line-containers #line_2").length > 0)
			$("#line_2").attr("maxlength", max_absolute);
		if(copy1.length>max_absolute||copy2.length>max_absolute)
		{
			if(copy1.length>max_absolute&&copy2.length<=max_absolute)
				$("#lineovermax").html("Line 1's text is");
			else if(copy2.length>max_absolute&&copy1.length<=max_absolute)
				$("#lineovermax").html("2");
			else if(copy1.length>max_absolute&&copy2.length>max_absolute)
				$("#lineovermax").html("Line 1 & Line 2's texts are"); 
			$("#maximumallow").html(max_absolute);
			$("#overmaximum").show(); 
		}
		else if(copy1.length<=max_absolute&&copy2.length<=max_absolute)
			$("#overmaximum").hide();
		if(!$("#customproduct").length>0)
		{			
			if($("#sidetext").length > 0)
			{ 
				var sidetext=$("#sidetext").val();
				$(".viewmaterial").load(loadpath, {'product_no': productno,'size':size_value,'pid':p_id,'line_1':copy1,'line_2':copy2,'prefix':prefix,'suffix':suffix,'position':position,'color':color,'font':font,'mounting':mounting,'filename':filename,'fileid':fileid,'layout':layout,'textupper':textupper,'sidetext':sidetext,'background':background,'special_comment':special_comment,'custom_product':custom_product}, function(value){ 
				$('.add-to-cart-confirmation a.continue-shopping').click(function(){
				$('.add-to-cart-confirmation.showme').fadeOut("fast");
				return false; 
				});
				$('table tr.data-row').mouseover(function(){$(this).addClass("over");}).mouseout(function(){$(this).removeClass("over");}); 
				addtocartform();    
				}); 
				var copyNum = $("#sidetext").val();
				var textNumcounter = $("#preview-image #streetnum p");
				var textNumcontainer = $("#preview-image #streetnum");
				var textNumboundry = $("#preview-image #streetnum");
				compress_text_streetnum(textNumcounter, textNumboundry, textNumcontainer, copyNum);	
			}
			else 
			{ 
				$(".viewmaterial").load(loadpath, {'product_no': productno,'size':size_value,'pid':p_id,'line_1':copy1,'line_2':copy2,'prefix':prefix,'suffix':suffix,'position':position,'color':color,'font':font,'mounting':mounting,'filename':filename,'fileid':fileid,'layout':layout, 'textupper':textupper,'textcolor':textcolor,'arrow':arrow,'arrowcolor':arrowcolor,'textsize':textsize,'textsize2':textsize2,'background':background,'special_comment':special_comment,'custom_product':custom_product}, function(value){ 
				$('.add-to-cart-confirmation a.continue-shopping').click(function(){
				$('.add-to-cart-confirmation.showme').fadeOut("fast");
				return false; 
				});
				$('table tr.data-row').mouseover(function(){$(this).addClass("over");}).mouseout(function(){$(this).removeClass("over");}); 
				addtocartform(); 
				
				}); 
				var copyNum = $("#sidetext").val();
				var textNumcounter = $("#preview-image #streetnum p");
				var textNumcontainer = $("#preview-image #streetnum");
				var textNumboundry = $("#preview-image #streetnum");
				compress_text_streetnum(textNumcounter, textNumboundry, textNumcontainer, copyNum);	
			}
		}
	}); 

	$("#special-instructions-text").bind('keyup', function() {
	  		var special_comment=$(this).val();
			$(".vspecial_comment").val(special_comment);
	});
		  


	/*$("#addline").click(function(){
		$("#addline").hide();
		$("#line-2-container").show();
		
			var text1boundry = $("#preview-image").find(".vertically-aligned-copy1");
			var text1counter = $("#preview-image").find(".line_1 span.copy");
			var text1container = $("#preview-image").find(".line_1");
			if($("#adddeleteshow").length>0)
				$(".vadddeleteshow").val("Y");
			compress_text(text1counter, text1boundry, text1container, text1counter.html());
	})	
	$("#deleteline").click(function(){
		$("#addline").show();
		$("#lineclass").val("oneline");
		updateclass();
		var max_recomm=$("#line_1_maxrecom").val();
		var counter2 = $("#line-2-container").find("span.current-characters");
		$("#line-2-container .current-characters").html("0");
		$("#line-2-container .max-characters").html(max_recomm);
		var max_char_display=$("#line-2-container").find("span.max-characters");
		var text2counter = $("#preview-image").find(".line_2 span.copy");
		text2counter.html("");	
		$("#line_2").val("");
		$(".vline_2").val(""); 
		$("#line-2-container").hide();
		var text1boundry = $("#preview-image").find(".vertically-aligned-copy1");
		var text1counter = $("#preview-image").find(".line_1 span.copy");
		var text1container = $("#preview-image").find(".line_1")
		var copy1 = $(".line-containers #line_1").val();
		compress_text(text1counter, text1boundry, text1container, copy1);		
		var numberofchars1 = copy1.length;	
		if($("#over-max").is(":visible"))
		{
			if(numberofchars1<=max_recomm)
			{
				$("#over-max").hide("fast");
			}
			counter2.removeClass("over-max");
		}
		if($("#adddeleteshow").length>0)
			$(".vadddeleteshow").val("N");		
		if($("#overmaximum").is(":visible")&&numberofchars1<=max_recomm)
			$("#overmaximum").hide();
		else if($("#overmaximum").is(":visible")&&numberofchars1>max_recomm)
			$("#lineovermax").html("Line 1's text is");
	})*/		
	 function updateclass()
	{
		if ($("#sign_size").length > 0&&!($("#customproduct").length > 0))
		{
			var size=$("#sign_size").val();
			var size_sepa=size.split("|");
			var size_value=" "+size_sepa[0];
		}
		else
			var size_value="";		
		if ($("#customproduct").length > 0)
			var custom_v=" "+$("#customproduct").val();
		else
			var custom_v="";
		var logoclass=$("#logoclass").val();	
		var color_v=$("#sign_color").val();
		var color_sepa=color_v.split("/");
		var color=color_sepa[0];
		if ($("#text_colorddl").length > 0)
		{
			var textcolor_v=$("#text_colorddl").val();
			var textcolor=" "+textcolor_v+"-t";
		}
		else
			var textcolor="";
		var class_arrow="";
		var class_prefix="";
		var class_suffix="";	
		if ($("#position_selector").length > 0)
		{
			var position_v=$("#position_selector").val();
			var position=" "+position_v.substring(0,1);
		}
		else
			var position="";
		if ($("#sign_font").length > 0)	
		{
			var font_v=$("#sign_font").val();
			var font=" "+font_v.replace(/ /g,'_');
		}
		else var font=" Highway";
		if ($("#numclass").length > 0)
		{
			var numclass=" None-p "+$("#numclass").val();
		}
		else
		{
			var numclass="";
		}		
		if ($("#prefix_selector").length > 0)
		{	
			var prefix=$("#prefix_selector").val();
			if(prefix.indexOf("Arrow") != -1)
			{
				var prefix_sepa=prefix.split(" ");
				var class_arrow=" "+prefix_sepa[1]+"-"+prefix_sepa[0].substring(0,1)+"-p";
				//if(prefix=='NONE')
					//class_prefix=" None"+"-p";						
			}
			else if(prefix=='NONE')
			{
				if(numclass=="")
					class_prefix=" None"+"-p";
				else
					class_prefix="";
			}
			else
			{
				if ($("#numclass").length > 0)
					var numclass=" "+$("#numclass").val();
				else
					var numclass="";	
			}				
		}
		if ($("#arrow_selector").length > 0)
		{
			var arrow=$("#arrow_selector").val();
			if(arrow=="NONE")
				var signarrow_v=" none-a";
			else
				var signarrow_v=" "+arrow.replace(/ /g,'_');
		}
		else
			var signarrow_v="";
		if ($("#arrowcolor_selector").length > 0)
			var arrowcolorclass=" a-"+$("#arrowcolor_selector").val();
		else
			var arrowcolorclass="";		
		if ($("#suffix_selector").length > 0)	
		{
			var suffix=$("#suffix_selector").val();
			if(suffix.indexOf("Arrow") != -1)
			{
				var suffix_sepa=suffix.split(" ");
				var class_arrow=" "+suffix_sepa[1]+"-"+suffix_sepa[0].substring(0,1)+"-s";
				//if(suffix=='NONE')
					//class_suffix=" None"+"-s";			
			}
			else if(suffix=='NONE')
			{
				class_suffix=" None"+"-s";
			}
		}	
		if ($("#lineclass").length > 0)
		{
			var lineclass=" "+$("#lineclass").val();
		}
		else
		{
			var lineclass="";
		}	
		if ($("#sign_background").length > 0)	
			var class_background=" "+$("#sign_background").val();
		else var class_background="";
		if($("#text_upper").length>0)
		{
			var checkbxv=$("#text_upper").val();
			if(checkbxv=="Y")
				var uppertext=" textupper";
			else
				var uppertext="";
		}
		else
			var uppertext="";
			
		var array_of_attributes =logoclass+custom_v+size_value+" "+color+textcolor+signarrow_v+position+font/*+fontsizeclass*/+class_prefix+class_suffix+class_arrow+arrowcolorclass+numclass+class_background+lineclass+uppertext;		
		$('#custom-product-images').attr("class", array_of_attributes);
	}
	
	
	function showAddConfirm(responseText, statusText, xhr, $form) { 
		
		var form = $form;//here there was an error
		var formParent = $(form).parent();
		$(formParent).removeClass("loading");
		$(formParent).find("div.adding").remove();
		//$(form).find(".add-to-cart-button").attr("disabled","");
		$(form).find(".add-to-cart-button").removeAttr('disabled');
	  $(".add-to-cart-confirmation.showme").fadeIn("fast");
		var updateTop = responseText.split("|");
	  $("div#items-in-your-cart-header dl").effect("highlight", {}, 1000);
	  $("span#totalhide").text(" " + updateTop[2]);
	  $("span#carthide").text(updateTop[1]);  
	  $(this).resetForm();
	   $('.clearable').clearField({ blurClass: 'blurredinput', activeClass: 'activeinput' });
	}
	function htmlvalidate(formData, jqForm, options) { 
		var returnv=true;	
		$(".add-to-cart-confirmation.showme").removeClass("showme");
		$("tr.data-row.over .add-to-cart-requiretext.showme").removeClass("showme");
		var form = jqForm[0];
		var formParent = $(form).parent();
		if($("#line_1").val()=="")
		{
			$("tr.data-row.over .add-to-cart-requiretext").addClass("showme");
			$("tr.data-row.over .add-to-cart-requiretext.showme").fadeIn("fast");
			 $(form).find("input:last-child").remove();			
			returnv= false;
		}
		if($("#overmaximum").length>0)
		{
			if($("#overmaximum").is(':visible'))
				returnv=false;
		}			
		if (!form.qtyField.value||form.qtyField.value=='0' ) { //hsinyi modify
			returnv= false;					
		} 
		if(!returnv)
			return returnv;
		else	
		{
		$(form).find(".add-to-cart-button").attr("disabled","disabled");
		$("<div/>", {
		"class": "adding",
		text: "Adding...."
		}).appendTo(formParent);
		
		}
		
		var currentquanity = $('tr.data-row.over input[name=qtyField]').fieldValue();
		var currentmaterial = $('#mounting_option').val();
		
		$("tr.data-row.over .add-to-cart-confirmation span.qty").text(currentquanity +'')
		$("tr.data-row.over .add-to-cart-confirmation span.mounting").text(currentmaterial+'')
		$("tr.data-row.over .add-to-cart-confirmation").addClass("showme");
		//$("div.has-material").fadeOut("fast");
	}	
	$("#waive_maximum").change(function(){
		if($("#mustclick").is(":visible")&&$(this).is(':checked'))
		{
			$("#mustclick").hide();
			$(".understand_check div:first-child").removeClass("span-3")
		}
		else if(!$("#mustclick").is(":visible")&&!$(this).is(':checked'))
		{
			$("#mustclick").show();
			$(".understand_check div:first-child").addClass("span-3")
		}
	})
	function addtocartform()
	{
		$('form.addtocart.htmlcustom:not(.has-number-input)').ajaxForm({
		
		beforeSerialize: function($form, options) { 
			  $("<input type='hidden' name='submit_type' value='ajax_submit' />").appendTo($form)         
		},
		beforeSubmit: htmlvalidate,
		resetForm: true,
		success: showAddConfirm	
		});
	}	
	/*$("#delete_file").click(function(){
		var processv=$("#processpath").val();
		var fileid=$("#uploadfileid").val();
		var filename=$("#uploadfilename").val();
		var category=$("#category").val();
		var subcategory=$("#subcategory").val();
		var pid=$("#pid").val();
		var productno=$("#productno").val();
		var layout=$("#layout").val();
		$("#uploadfilename").val("");
		$("#uploadfileid").val("");
		$("#previousfilename").val("");
		$("#previousfileid").val("");
		$.get(processv,{'action':1,'fileid' : fileid,'filename':filename,'category':category,'subcategory':subcategory,'productno':productno,'pid':pid,'layout':layout},
		function(data)
		{
			msg = jQuery.trim(data);
			location.href=msg;
		});
	})*/	
	function focus_events($form_parent) {
			$form_parent.live("focusin",function(){
				$("#line1outer").addClass("focused");
				$("#line2outer").addClass("focused");
			});
			
			$form_parent.live("focusout",function(){
				$("#line1outer").removeClass("focused");
				$("#line2outer").removeClass("focused");
			});	
	}
	
	$("#show-inst a").click(function(){
		$("#upload-instructions").show();
		$("#show-inst").hide();
	});
	$("#hide-inst a").click(function(){
		$("#upload-instructions").hide();
		$("#show-inst").show();
	
	});
	$("a.subgroup_content").fancybox({
	'imageScale': true,
	'overlayShow' : true,
	'zoomSpeedIn' : 500,
	'zoomSpeedOut' : 500,
	'autoDimensions' : false,
	'width' : 330,
	'height' : '30%'
	});
	$("#upload-div .choose-file").fancybox({
	'imageScale': true,
	'overlayShow' : true,
	'zoomSpeedIn' : 500,
	'zoomSpeedOut' : 500,
	'autoDimensions' : false,
	'width' : 400,
	'height' : 200		
	});
	$("#textsmaller").click(function(){
		var textsize=$("#line_1_textsize").val();
		textsize=parseInt(textsize);
		if((textsize-1)>=6)
		{
			textsize=textsize-1;
			$("#line_1_textsize").val(textsize);
			$(".vfontsize").val(textsize);
		}
		var text1container=$("#preview-image").find(".line_1");	
		var text1counter=$("#preview-image").find(".line_1 span.copy");
		var copy1=$("#textarea_1").val();;
		var text1boundry=$("#preview-image").find("#product_text1");
		updatepreviewchangetextsize(text1container,text1counter,copy1,text1boundry,$("#line_1_textsize"));	
		if($(".textarea1_shrink").length>0&&$(".textarea1_shrink").val()=="Y"&&textsizecontainer.val()<$(".v_textarea1_orgsize").val())
			$(".textarea1_shrink").val("N");					
		updateclass();	
	});   	
	$("#textlarger").click(function(){
		var textsize=$("#line_1_textsize").val();
		textsize=parseInt(textsize);
		if((textsize+1)<=70)
		{
			textsize=textsize+1;
			$("#line_1_textsize").val(textsize);
			$(".vfontsize").val(textsize);
		}
		var text1container=$("#preview-image").find(".line_1");	
		var text1counter=$("#preview-image").find(".line_1 span.copy");
		var copy1=$("#textarea_1").val();;
		var text1boundry=$("#preview-image").find("#product_text1");
		updatepreviewchangetextsize(text1container,text1counter,copy1,text1boundry,$("#line_1_textsize"));
		updateclass();			
	});
	$("#textsmaller2").click(function(){
		var textsize=$("#line_2_textsize").val();
		textsize=parseInt(textsize);
		if((textsize-1)>=6)
		{
			textsize=textsize-1;
			$("#line_2_textsize").val(textsize);
			$(".vfontsize2").val(textsize);
		}
		var text2container=$("#preview-image").find(".line_2");	
		var text2counter=$("#preview-image").find(".line_2 span.copy");
		var copy2=$("#textarea_2").val();;
		var text2boundry=$("#preview-image").find("#product_text2");
		updatepreviewchangetextsize(text2container,text2counter,copy2,text2boundry,$("#line_2_textsize"));		
		updateclass();	
	});   	
	$("#textlarger2").click(function(){
		var textsize=$("#line_2_textsize").val();
		textsize=parseInt(textsize);
		if((textsize+1)<=70)
		{
			textsize=textsize+1;
			$("#line_2_textsize").val(textsize);
			$(".vfontsize2").val(textsize);
		}
		var text2container=$("#preview-image").find(".line_2");	
		var text2counter=$("#preview-image").find(".line_2 span.copy");
		var copy2=$("#textarea_2").val();;
		var text2boundry=$("#preview-image").find("#product_text2");
		updatepreviewchangetextsize(text2container,text2counter,copy2,text2boundry,$("#line_2_textsize"));
		updateclass();			
	});	
	$('#text_upper').click(function()
	{
		var checkboxv=$(this).val();
		
		
		if(checkboxv=="N")
		{
			
			$(this).val("Y");
			$(".vtextupper").val("Y");
			updateclass();
				
			$("#custom-product-images p").addClass("capitalize");
			var x4 = $("#custom-product-images").hasClass("x4");
			var x6 = $("#custom-product-images").hasClass("x6");
				var x9 = $("#custom-product-images").hasClass("x9");
			if (x6 == true || x4 == true){
				$("#custom-product-images p.line_1").addClass("capitalizeSizex6");
				$("#custom-product-images p.line_2").addClass("capitalizeSizex6");
			}else if (x9 == true){
				$("#custom-product-images p.line_1").addClass("capitalizeSizex9");
				$("#custom-product-images p.line_2").addClass("capitalizeSizex9");
			}
			
			if($("#line_1").length>0)
			{
				var copy1=$("#line_1").val();
				var text1boundry = $("#preview-image").find(".vertically-aligned-copy1");
				var text1counter = $("#preview-image").find(".line_1 span.copy");
				var text1container = $("#preview-image").find(".line_1");
				compress_text(text1counter, text1boundry, text1container, copy1);
			}
			if($("#line_2").length>0)
			{
				var copy2=$("#line_2").val();	
				var text2boundry = $("#preview-image").find(".vertically-aligned-copy2");
				var text2counter = $("#preview-image").find(".line_2 span.copy");	
				var text2container = $("#preview-image").find(".line_2");
				compress_text(text2counter, text2boundry, text2container,copy2);
			}	
			
			var copy1 = $("#suffix_selector").val();
			var text1counter = $("#preview-image #suffix p");
			var text1container = $("#preview-image #suffix");
			var text1boundry = $("#preview-image #suffix");
			compress_text_suffix(text1counter, text1boundry, text1container, copy1);	
			
			var copyNum = $("#sidetext").val();
			var textNumcounter = $("#preview-image #streetnum p");
			var textNumcontainer = $("#preview-image #streetnum");
			var textNumboundry = $("#preview-image #streetnum");
			compress_text_streetnum(textNumcounter, textNumboundry, textNumcontainer, copyNum);	
			
		}
		else
		{
			$(this).val("N");
			$(".vtextupper").val("N");
			updateclass();

			$("#custom-product-images p").removeClass("capitalize");
			var x4 = $("#custom-product-images").hasClass("x4");
			var x6 = $("#custom-product-images").hasClass("x6");
				var x9 = $("#custom-product-images").hasClass("x9");
			if (x6 == true || x4 == true){
				$("#custom-product-images p.line_1").removeClass("capitalizeSizex6");
				$("#custom-product-images p.line_2").removeClass("capitalizeSizex6");
			}else if (x9 == true){
				$("#custom-product-images p.line_1").removeClass("capitalizeSizex9");
				$("#custom-product-images p.line_2").removeClass("capitalizeSizex9");
			}
			
			if($("#line_1").length>0)
			{
				var copy1=$("#line_1").val();
				var text1boundry = $("#preview-image").find(".vertically-aligned-copy1");
				var text1counter = $("#preview-image").find(".line_1 span.copy");
				var text1container = $("#preview-image").find(".line_1");
				compress_text(text1counter, text1boundry, text1container, copy1);
			}
			if($("#line_2").length>0)
			{
				var copy2=$("#line_2").val();	
				var text2boundry = $("#preview-image").find(".vertically-aligned-copy2");
				var text2counter = $("#preview-image").find(".line_2 span.copy");	
				var text2container = $("#preview-image").find(".line_2");
				compress_text(text2counter, text2boundry, text2container,copy2);
			}	
			
			var copy1 = $("#suffix_selector").val();
			var text1counter = $("#preview-image #suffix p");
			var text1container = $("#preview-image #suffix");
			var text1boundry = $("#preview-image #suffix");
			compress_text_suffix(text1counter, text1boundry, text1container, copy1);	
			
			var copyNum = $("#sidetext").val();
			var textNumcounter = $("#preview-image #streetnum p");
			var textNumcontainer = $("#preview-image #streetnum");
			var textNumboundry = $("#preview-image #streetnum");
			compress_text_streetnum(textNumcounter, textNumboundry, textNumcontainer, copyNum);			
			
		}
		
	});
	
	$(".x4 #prefix p").css({
		scaleX: .5,
		origin: [0, 0]
		
		}).css("position","absolute");
		
	$(".x6 #prefix p").css({
		scaleX: .5,
		origin: [0, 0]
		
		}).css("position","absolute");

		
	$(".x9 #prefix p").css({
		scaleX: .5,
		origin: [0, 0]
		
		}).css("position","absolute");
		
	
	
	
	function fontTestIEx6Suf(){
		var classList = $("#custom-product-images").attr('class').split(/\s+/);
				   
		for (i = 0; i < classList.length; i++) {
			   if(classList[i].length > 0){
				   
				   switch (classList[i]) {
					case "Algerian": var textComp = 5.5; break;
					case "Arial": var textComp = 5; break;
					case "Brush": var textComp = 6; break;
					case "Century": var textComp = 5; break;
					case "Clarendon": var textComp = 5.5; break;
					case "Futura": var textComp = 5; break;
					case "Highway": var textComp = 3.5; break;
					case "Swiss": var textComp = 4.5; break;
					case "Tekton": var textComp = 4.5; break;
					case "Times_New_Roman": var textComp = 4.85; break;
					case "Zapf": var textComp = 4.5; break;
					} 
			   }
		 }
		return textComp;
	}
	
	function fontTestIEx6SufUpper(){
		var classList = $("#custom-product-images").attr('class').split(/\s+/);
				   
		for (i = 0; i < classList.length; i++) {
			   if(classList[i].length > 0){
				   
				   switch (classList[i]) {
					case "Algerian": var textComp = 5.5; break;
					case "Arial": var textComp = 5.5; break;
					case "Brush": var textComp = 7; break;
					case "Century": var textComp = 5.5; break;
					case "Clarendon": var textComp = 6; break;
					case "Futura": var textComp = 5; break;
					case "Highway": var textComp = 3.5; break;
					case "Swiss": var textComp = 4.5; break;
					case "Tekton": var textComp = 4.5; break;
					case "Times_New_Roman": var textComp = 5.25; break;
					case "Zapf": var textComp = 4.5; break;
					} 
			   }
		 }
		return textComp;
	}
	
	function fontTestIEx9Suf(){
		var classList = $("#custom-product-images").attr('class').split(/\s+/);
				   
		for (i = 0; i < classList.length; i++) {
			   if(classList[i].length > 0){
				   
				   switch (classList[i]) {
					case "Algerian": var textComp = 5.5; break;
					case "Arial": var textComp = 5; break;
					case "Brush": var textComp = 6; break;
					case "Century": var textComp = 5; break;
					case "Clarendon": var textComp = 5.5; break;
					case "Futura": var textComp = 5; break;
					case "Highway": var textComp = 3.65; break;
					case "Swiss": var textComp = 4.5; break;
					case "Tekton": var textComp = 4.5; break;
					case "Times_New_Roman": var textComp = 4.85; break;
					case "Zapf": var textComp = 4.5; break;
					} 
			   }
		 } 
		return textComp;
	}
	
	function fontTestIEx9SufUpper(){
		var classList = $("#custom-product-images").attr('class').split(/\s+/);
				   
		for (i = 0; i < classList.length; i++) {
			   if(classList[i].length > 0){
				   
				   switch (classList[i]) {
					case "Algerian": var textComp = 5.5; break;
					case "Arial": var textComp = 5.5; break;
					case "Brush": var textComp = 7; break;
					case "Century": var textComp = 5.5; break;
					case "Clarendon": var textComp = 6; break;
					case "Futura": var textComp = 5; break;
					case "Highway": var textComp = 3.95; break;
					case "Swiss": var textComp = 4.5; break;
					case "Tekton": var textComp = 4.5; break;
					case "Times_New_Roman": var textComp = 5.25; break;
					case "Zapf": var textComp = 4.5; break;
					} 
			   }
		 } 
		 
		 
		return textComp;
	}
	
	
	
	
	function textWidthSuffix(textcontainer,text){  
        
        var calc = '<span id="tempspan" style="display:none">' + text + '</span>';  
        textcontainer.append(calc);  
        var widthOriginal = textcontainer.find('span:last').width();
        var x6 = $("#custom-product-images").hasClass("x6");
        var x4 = $("#custom-product-images").hasClass("x4");
        var x9 = $("#custom-product-images").hasClass("x9");
        var textUpper = $("#custom-product-images").hasClass("textupper");
        
        if ($.support.cssFloat != true) {
            if (x6 == true || x4 == true){
                if (textUpper != true){
                    var compressRate = fontTestIEx6Suf();
                }else {
                    var compressRate = fontTestIEx6SufUpper();
                }
            
            }else if (x9 == true){
                if (textUpper != true){
                    var compressRate = fontTestIEx9Suf();
                }else {
                    var compressRate = fontTestIEx9SufUpper();
                }
            }
                
        }else {if (x6 == true || x4 == true){var compressRate = 3; }
				else{var compressRate = 2;}
			
		}

        
        var width = widthOriginal * compressRate;
        
        textcontainer.find('span:last').remove(); 
        return width; 
    };         
	
	function compress_text_suffix(element_to_compress, boundry,textcontainer,text)
   {
	   
		
		var a1= element_to_compress.width();
		var a2=textWidthSuffix(textcontainer,text);
		if(a1>a2)
			var a=a1;
		else
			var a=a2;
		var b =boundry.width();
		var c = b/a;
		if(c>=1)
		{
			c=1;
			
			textcontainer.css("position","absolute");
			element_to_compress.css("position","absolute");
			element_to_compress.css({
				scaleX: 1,
				origin: [0, 0]
			}); 
			
			
		}
		else
		{
			c=Math.round(c * 100)/100;
			textcontainer.css("position","absolute"); 
			element_to_compress.css("position","absolute");
			element_to_compress.css({
				scaleX: c,
				origin: [0, 0]
				
			});
		}
		$(".compress_suffix").val(c);
	//console.log(b+":"+c);
		
		
	};
	
	function textWidthStreetnum(textcontainer,text){  
	
		var calc = '<span id="tempspan" style="display:none">' + text + '</span>';  
		textcontainer.append(calc);  
		/*var widthOriginal = textcontainer.find('span:last').width();
		
		if ($.support.cssFloat != true) {
			var x4 = $("#custom-product-images").hasClass("x4");
			var x6 = $("#custom-product-images").hasClass("x6");
			var x9 = $("#custom-product-images").hasClass("x9");
			
			if (x6 == true || x4 == true){
					var textUpper = $("#custom-product-images").hasClass("textupper");
					if (textUpper != true){var width = widthOriginal * 2.6;}
					else {var width = widthOriginal * 2.95;}
			}else if (x9 == true){
					var textUpper = $("#custom-product-images").hasClass("textupper");
					if (textUpper != true){var width = widthOriginal * 4;}
					else {var width = widthOriginal * 4.5;}
					
				
			}else{
				if (x6 != true || x4 != true){
			var width = widthOriginal * 4; }
			else{width = widthOriginal * 1.75;}
				}
				
		}else {
			if (x6 != true || x4 != true){
			var width = widthOriginal * 4; }
			else{width = widthOriginal * 1.75;}
		
		}*/
		var widthOriginal = textcontainer.find('span:last').width();
		var x6 = $("#custom-product-images").hasClass("x6");
		var x4 = $("#custom-product-images").hasClass("x4");
		var x9 = $("#custom-product-images").hasClass("x9");
		var textUpper = $("#custom-product-images").hasClass("textupper");
		
		if ($.support.cssFloat != true) {
			if (x6 == true || x4 == true){
				if (textUpper != true){
					var compressRate = fontTestIEx6Suf();
				}else {
					var compressRate = fontTestIEx6SufUpper();
				}
			
			}else if (x9 == true){
				if (textUpper != true){
					var compressRate = fontTestIEx9Suf();
				}else {
					var compressRate = fontTestIEx9SufUpper();
				}
			}
				
		}else {var compressRate = 2;}
		
		var width = widthOriginal * compressRate;
		
		textcontainer.find('span:last').remove(); 
		
		return width; 
	}; 	
		
		
	
	
	function compress_text_streetnum(element_to_compress, boundry,textcontainer,text){
	   	var a1= element_to_compress.width();
		var a2=textWidthStreetnum(textcontainer,text);
		if(a1>a2)
			var a=a1;
		else
			var a=a2;
		var b =boundry.width();
		var c = b/a;
		if(c>=1)
		{
			c=1;
			
			textcontainer.css("position","absolute");
			element_to_compress.css({
				scaleX: 1,
				origin: [0, 0]
			}); 
			element_to_compress.css("position","absolute");
			
		}
		else
		{
			c=Math.round(c * 100)/100;
			textcontainer.css("position","absolute"); 
			element_to_compress.css("position","absolute");
			element_to_compress.css({
				scaleX: c,
				origin: [0, 0]
				
			});
		}
		$(".compress_streetnum").val(c);
	}
	function compress_text_initialsuffix(element_to_compress, boundry,textcontainer,text)
   {
		var c;
		
		if($(".compress_suffix").length>0)
		{
			c=$(".compress_suffix").val();
		}
		if(c<1)
		{
			element_to_compress.css("position","absolute");
			textcontainer.css("position", "absolute");
		}
		element_to_compress.css({
		scaleX: c,
		origin: [0, 0]
		
		});
	}
	function compress_text_initialStreetNum(element_to_compress, boundry,textcontainer,text)
   {
		var c;
		
		if($(".compress_streetnum").length>0)
		{
			c=$(".compress_streetnum").val();
		}
		if(c<1)
		{
			element_to_compress.css("position","absolute");
			textcontainer.css("position", "absolute");
		}
		element_to_compress.css({
		scaleX: c,
		origin: [0, 0]
		
		});
	}		
	function compress_text_initialline(element_to_compress, boundry,textcontainer,text)
   {
		var c;
		
		if($(".compress_1").length>0&&textcontainer.hasClass("line_1"))
		{
			c=$(".compress_1").val();
		}
		if($(".compress_2").length>0&&textcontainer.hasClass("line_2"))
		{
			c=$(".compress_2").val();
		}
		if(c<1)
		{
			element_to_compress.css("position","absolute");
			textcontainer.css("position", "absolute");
		}
		element_to_compress.css({
		scaleX: c,
		origin: [0, 0]
		
		});
	}
	function initialLineoneWidth() {
		var copy1 = $("#line_1").val();
		var text1counter = $("#preview-image").find(".line_1 span.copy");
		var text1container = $("#preview-image").find(".line_1");	
		var text1boundry = $("#preview-image").find(".product_text");
	  compress_text_initialline(text1counter, text1boundry, text1container, copy1);
  };
  function initialLinetwoWidth() {
	  var copy2 = $("#line_2").val();
	  var text2counter = $("#preview-image").find(".line_2 span.copy");
	  var text2container = $("#preview-image").find(".line_2");	
	  var text2boundry = $("#preview-image").find(".product_text");
	  compress_text_initialline(text2counter, text2boundry, text2container, copy2);
  };
  function initialSuffixWidth() {
	  var copy1 = $("#suffix_selector").val();
		var text1counter = $("#preview-image #suffix p");
		var text1container = $("#preview-image #suffix");
		var text1boundry = $("#preview-image #suffix");
		compress_text_suffix(text1counter, text1boundry, text1container, copy1);
		
		
		var copyNum = $("#sidetext").val();
		var textNumcounter = $("#preview-image #streetnum p");
		var textNumcontainer = $("#preview-image #streetnum");
		var textNumboundry = $("#preview-image #streetnum");
		compress_text_streetnum(textNumcounter, textNumboundry, textNumcontainer, copyNum);	
	};		
	function initialSuffixWidthupload() {
		var copy1 = $("#suffix_selector").val();
		var text1counter = $("#preview-image #suffix p");
		var text1container = $("#preview-image #suffix");
		var text1boundry = $("#preview-image #suffix");
		compress_text_initialsuffix(text1counter, text1boundry, text1container, copy1);
		var copyNum = $("#sidetext").val();
		var textNumcounter = $("#preview-image #streetnum p");
		var textNumcontainer = $("#preview-image #streetnum");
		var textNumboundry = $("#preview-image #streetnum");
		compress_text_initialStreetNum(textNumcounter, textNumboundry, textNumcontainer, copyNum);
	};
	if($("#uploadinitial").val()=="Y")
	{
		$("#uploadinitial").val("N");
		if($('#text_upper').val()=="Y")
		{			
			$("#custom-product-images p").addClass("capitalize");
			var x4 = $("#custom-product-images").hasClass("x4");
			var x6 = $("#custom-product-images").hasClass("x6");
				var x9 = $("#custom-product-images").hasClass("x9");
			if (x6 == true || x4 == true){
				$("#custom-product-images p.line_1").addClass("capitalizeSizex6");
				$("#custom-product-images p.line_2").addClass("capitalizeSizex6");
			}else if (x9 == true){
				$("#custom-product-images p.line_1").addClass("capitalizeSizex9");
				$("#custom-product-images p.line_2").addClass("capitalizeSizex9");
			}
		}
		
		initialSuffixWidthupload();
		initialLineoneWidth();	
		initialLinetwoWidth(); 
	}
	else
		initialSuffixWidth();
	
	
	
});
