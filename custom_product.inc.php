<?
class BS_ProductCustomeTools
{
//street name sign start		
		function CustomProductPrefix($product_no)
		{
		$sql="select  name from bs_products_custom_prefix 
		where layout='".mysql_real_escape_string($_REQUEST[layout])."' and active='Y' 
		order by position";
		$result=mysql_query($sql);
		$i=0;
		while($row=mysql_fetch_array($result))
				{
					$prefix[$i]=$row['name'];
					$i++;	
				}		
		return $prefix;
		}		
		function CustomProductSuffix($product_no)
		{
 		$sql="select  name from bs_products_custom_suffix 
		where layout='".mysql_real_escape_string($_REQUEST[layout])."' and active='Y' 
		order by position";
		$result=mysql_query($sql);
		$i=0;
		while($row=mysql_fetch_array($result))
				{
					$suffix[$i]=$row['name'];
					$i++;	
				}		
		return $suffix;
		}		
		function CustomProductLeftArrow($product_no)
		{
		$sql="select  name from bs_products_custom_leftarrow 
		where layout='".mysql_real_escape_string($_REQUEST[layout])."' and active='Y' 
		order by position";
		$result=mysql_query($sql);
		$i=0;
		while($row=mysql_fetch_array($result))
				{
					$prefix[$i]=$row['name'];
					$i++;	
				}		
		return $prefix;
		}
		function CustomProductRightArrow($product_no)
		{
		$sql="select  name from bs_products_custom_rightarrow 
		where layout='".mysql_real_escape_string($_REQUEST[layout])."' and active='Y' 
		order by position";
		$result=mysql_query($sql);
			$i=0;
		while($row=mysql_fetch_array($result))
				{
					$suffix[$i]=$row['name'];
					$i++;	
				}		
		return $suffix;
		}	
		function CustomProductPositionSign($product_no)
		{
 		$sql="select  name from bs_products_custom_position_sign 
		where layout='".mysql_real_escape_string($_REQUEST[layout])."' and active='Y' 
		order by position";
		$result=mysql_query($sql);
		$i=0;
		while($row=mysql_fetch_array($result))
				{
				 $positionsign[$i]=$row['name'];
				 $i++;
				}		
		return $positionsign;
		}		

		function CustomProductTextcolor($product_no)
		{
 		$sql="select  color from bs_products_custom_textcolor 
		where layout='".mysql_real_escape_string($_REQUEST[layout])."' and active='Y' 
		order by position";
		$result=mysql_query($sql);
		$i=0;
		while($row=mysql_fetch_array($result))
				{
				 $font[$i]=$row['color'];
				 $i++;
				}		
		return $font;
		}	
		function CustomProductArrowColor($layout)
		{
 		$sql="select color from bs_products_custom_arrowcolor 
		where layout='".mysql_real_escape_string($_REQUEST[layout])."' and active='Y' 
		order by position";
		$result=mysql_query($sql);
		$i=0;
		while($row=mysql_fetch_array($result))
				{
				 $font[$i]=$row['color'];
				 $i++;
				}		
		return $font;
		}
		function CustomProductFont($product_no)
		{
 		$sql="select  name from bs_products_custom_font 
		where layout='".mysql_real_escape_string($_REQUEST[layout])."' and active='Y' 
		order by position";
		$result=mysql_query($sql);
		$i=0;
		while($row=mysql_fetch_array($result))
				{
				 $font[$i]=$row['name'];
				 $i++;
				}		
		return $font;
		}	
		function CustomProductColor($product_no)
		{
 		$sql="select color from bs_product_custom_color 
		where layout='".mysql_real_escape_string($_REQUEST[layout])."' and active='Y' group by color 
		order by position";
		$result=mysql_query($sql);
		$i=0;
		while($row=mysql_fetch_array($result))
				{
				 $color[$i]=$row['color'];
				 $i++;
				}		
		return $color;
		}	
		function CustomProductBackground($product_no)
		{
 		$sql="select name from bs_products_custom_background 
		where layout='".mysql_real_escape_string($_REQUEST[layout])."' and active='Y' 
		order by position";
		$result=mysql_query($sql);
		$i=0;
		while($row=mysql_fetch_array($result))
				{
				 $background[$i]=$row['name'];
				 $i++;
				}		
		return $background;		
		}
		function CustomProductArrow($layout)
		{
 		$sql="select name from bs_products_custom_arrow 
		where layout='".mysql_real_escape_string($_REQUEST[layout])."' and active='Y' 
		order by position";
		$result=mysql_query($sql);
		$i=0;
		while($row=mysql_fetch_array($result))
				{
				 $background[$i]=$row['name'];
				 $i++;
				}		
		return $background;		
		}			
		function CustomProductMountingOption($sku_code)
		{
 		$sql="select  name from bs_products_custom_mounting_option 
		where layout='".mysql_real_escape_string($_REQUEST[layout])."' and active='Y' 
		order by position";
		$result=mysql_query($sql);
		$i=0;
		while($row=mysql_fetch_array($result))
				{
				 $options_font[$i]=$row['name'];
				 $i++;
				}		
		return $options_font;
		}		
		function GetCustomMaterialList($productno,$size)
		{
		$size=$size."''";
		$sql_textsize_detail="select size,sku_code,material_description,material_code,material,freight_shipping,max_chars_upper,absolute_maximum 
		from bs_products_sku_description where product_number='$productno' and active='Y' and size = '".mysql_real_escape_string($size)."' order by position";
		$textsize_result=mysql_query($sql_textsize_detail);
		$textsize_row = array();
		$i=0;
		while($textsize_row=mysql_fetch_array($textsize_result))
			{
			$textsize[$i]['size']=$textsize_row['size'];
			$textsize[$i]['sku_code']=$textsize_row['sku_code'];
			$textsize[$i]['material_description']=$textsize_row['material_description'];
			$textsize[$i]['material_code']=$textsize_row['material_code'];
			$textsize[$i]['material']=$textsize_row['material'];
			$textsize[$i]['freight_shipping']=$textsize_row['freight_shipping'];
			$textsize[$i]['max_chars_upper']=$textsize_row['max_chars_upper'];
			$textsize[$i]['absolute_maximum']=$textsize_row['absolute_maximum'];
			$i++;
			}		
		return $textsize;			
		}
	function GetCustomMaterialListColor($productno,$size,$color)
	{
		if(!strpos($size,"''"))
			$size=$size."''";
		$sql_textsize_detail="select size,sku_code,material_description,material_code,material,freight_shipping,max_chars_upper,absolute_maximum 
		from bs_products_sku_description where product_number='$productno' and active='Y' and color='$color' and size like '".mysql_real_escape_string($size)."%' order by position";
		$textsize_result=mysql_query($sql_textsize_detail);//print $sql_textsize_detail;
		$textsize_row = array();
		$i=0;
		while($textsize_row=mysql_fetch_array($textsize_result))
		{
			$textsize[$i]['size']=$textsize_row['size'];
			$textsize[$i]['sku_code']=$textsize_row['sku_code'];
			$textsize[$i]['material_description']=$textsize_row['material_description'];
			$textsize[$i]['material_code']=$textsize_row['material_code'];
			$textsize[$i]['material']=$textsize_row['material'];
			$textsize[$i]['freight_shipping']=$textsize_row['freight_shipping'];
			$textsize[$i]['max_chars_upper']=$textsize_row['max_chars_upper'];
			$textsize[$i]['absolute_maximum']=$textsize_row['absolute_maximum'];
			$i++;
		}		
	return $textsize;			
	}		
	function uploadcustomfile()
	{
		$message="";
		$previous_file=$_REQUEST['previousfilename'];
		$previous_file_ID=$_REQUEST['previousfileid'];
		$filetype=$_FILES["importcustomfile"]["type"];	
		$filename=$_FILES['importcustomfile']['name'];
		$filesize=$_FILES["importcustomfile"]["size"];
		$extension=end(explode(".",strtolower($filename)));
		$uploadFilePath_perm='upload/'.$filename;
		$uploadFilePath='upload/temp/'.$filename;
		if($filename=='')
			$message= $previous_file_ID.'|  Please select a file to upload.|'.$previous_file;
		else if($extension!='jpg'&&$extension!='pdf'&&$extension!='jpeg'&&$extension!='gif'&&$extension!='png'&&$extension!='tiff'&&$extension!='ai'&&$extension!='cdr'&&$extension!='eps'&&$extension!='psd')
			$message= $previous_file_ID.'|  Only JPG, JPEG, GIF, PNG, TIFF, AI, CDR, PDF, EPS and PSD files are allowed.|'.$previous_file;
		else if($filesize>=2000000)
			$message= $previous_file_ID.'|  Upload file should be under 2MB.If you want to upload over 2MB, please send the file to '.Web_Sales_Email.' .|'.$previous_file;
		else
		{
			if (file_exists($uploadFilePath_perm)||file_exists($uploadFilePath))
			{
			   $typelength=strlen($extension)+1;
			   $purefilename=substr($filename,0,-$typelength);
			   $random_digit=rand(0000,9999);
			   $filename=$purefilename.$random_digit.date('Ynjhis').".".$extension;
			   $uploadFilePath='upload/temp/'.$filename;
			}	
			copy($_FILES['importcustomfile']['tmp_name'], $uploadFilePath);	
			list($width, $height) = getimagesize($uploadFilePath);
			$username=$this->GetCustomerUsername();
			$sql_import_file="insert into bs_customer_file_upload_temp(customer_id,username,file_name,file_size,file_type,export_brimar,create_date) values('$_SESSION[CID]','$username','$filename','$filesize','$filetype','0',NOW())";
			mysql_query($sql_import_file);
			$ID = mysql_insert_id();
			$message= $ID.'|  Your file has been uploaded.|'.$filename.'|'.$width.'|'.$height;
		}
		return $message;
	}		
	function GetCustomerUsername()
	{
		$get_username="";
		$sql_username="select username from bs_customers where customers_id='$_SESSION[CID]'";
		$username_result=mysql_query($sql_username);
		while($username_row=mysql_fetch_array($username_result))
		{
			$get_username=$username_row['username'];
		}		
		return $get_username;		
	}
	function deletecustomfile()
	{
		$fileid=$_REQUEST['fileid'];
		$filename=$_REQUEST['filename'];
		$category=$_REQUEST['category'];
		$subcategory=$_REQUEST['subcategory'];
		$productno=$_REQUEST['productno'];
		$pid=$_REQUEST['pid'];
		$layout=$_REQUEST['layout'];
		$fileatpath='../upload/'.$filename;
		unlink($fileatpath);
		$sql_delete="delete from bs_customer_file_upload_temp where id='$fileid'";
		mysql_query($sql_delete);
		//$path=$website."addtocart.php?category=".urlencode($category)."&subcategory=".urlencode($subcategory)."&productno=".urlencode($productno)."&pid=".urlencode($pid)."&layout=".urlencode($layout);//to be changed
	    //echo $path;			
	}
	function LoadCustomNameSignDetails($shoppingcartid)
	{
		if(isset($_REQUEST['s_id']))
			$shid=$_REQUEST['s_id'];
		else
			$shid=$shoppingcartid;
		$sql_load_detail="select Custom_Copy1,Custom_Copy2,Street_Num,Mounting_Option,Background,Prefix,Suffix,Left_Arrow,Right_Arrow,Position,Color,Font,Font_Color,Custom_Copy1_Size,Custom_Copy2_Size, Arrow, Arrow_Color from bs_shopping_cart_attributes where s_id=$shid order by id ";
		$loadCustomdetail_result=mysql_query($sql_load_detail);
		//print $sql_load_detail;
		while($loadCustomdetail_row=mysql_fetch_array($loadCustomdetail_result))
		{	
			$loadCustomdetail_product[Custom_Copy1]=$loadCustomdetail_row['Custom_Copy1'];
			$loadCustomdetail_product[Custom_Copy2]=$loadCustomdetail_row['Custom_Copy2'];
			$loadCustomdetail_product[Street_Num]=$loadCustomdetail_row['Street_Num'];
			$loadCustomdetail_product[Mounting_Option]=$loadCustomdetail_row['Mounting_Option'];
			$loadCustomdetail_product[Background]=$loadCustomdetail_row['Background'];
			$loadCustomdetail_product[Prefix]=$loadCustomdetail_row['Prefix'];
			$loadCustomdetail_product[Suffix]=$loadCustomdetail_row['Suffix'];
			$loadCustomdetail_product[Left_Arrow]=$loadCustomdetail_row['Left_Arrow'];
			$loadCustomdetail_product[Right_Arrow]=$loadCustomdetail_row['Right_Arrow'];
			$loadCustomdetail_product[Position]=$loadCustomdetail_row['Position'];
			$loadCustomdetail_product[Color]=$loadCustomdetail_row['Color'];
			$loadCustomdetail_product[Font]=$loadCustomdetail_row['Font'];
			$loadCustomdetail_product[Font_Color]=$loadCustomdetail_row['Font_Color'];
			$loadCustomdetail_product[Custom_Copy1_Size]=$loadCustomdetail_row['Custom_Copy1_Size'];
			$loadCustomdetail_product[Custom_Copy2_Size]=$loadCustomdetail_row['Custom_Copy2_Size'];
			$loadCustomdetail_product[Arrow]=$loadCustomdetail_row['Arrow'];	
			$loadCustomdetail_product[Arrow_Color]=$loadCustomdetail_row['Arrow_Color'];					
		}
		return $loadCustomdetail_product;	
	}
	function GetCustomFileName($shoppingcartid)
	{
		$filename[id]="";
		$filename[file_name]="";
		if(isset($_REQUEST['s_id']))
			$shid=$_REQUEST['s_id'];
		else
			$shid=$shoppingcartid;
		$sql_username="select id,file_name from bs_customer_file_upload where s_id='$shid'";
		$username_result=mysql_query($sql_username);
		while($username_row=mysql_fetch_array($username_result))
		{
			$filename[id]=$username_row['id'];
			$filename[file_name]=$username_row['file_name'];
		}
		return $filename;
	}
	function GetCustomFileName_fromtemp($shoppingcartid)
	{
		$filename[id]="";
		$filename[file_name]="";
		if(isset($_REQUEST['s_id']))
			$shid=$_REQUEST['s_id'];
		else
			$shid=$shoppingcartid;
		$sql_username="select id,file_name from bs_customer_file_upload_temp where s_id='$shid'";//print $sql_username;
		$username_result=mysql_query($sql_username);
		while($username_row=mysql_fetch_array($username_result))
		{
			$filename[id]=$username_row['id'];
			$filename[file_name]=$username_row['file_name'];
		}
		return $filename;
	}
	function GetInstruction($productno)
	{
		$sql_skucode="select product_description from bs_products_description where product_number='$productno' and active='Y'";
		$skucode_result=mysql_query($sql_skucode);
		//print $sql_skucode;
		while($skucode_row=mysql_fetch_array($skucode_result))
		{
			$instruction=$skucode_row['product_description'];
		}
		return $instruction;			
	}
	function GetSubGroupitem($gid)
	{
		$sql_skucode="select product_number,product_description,name,heading,image,image2 from bs_sub_group where grouping_id='$gid' and active='Y' order by position asc";
		$skucode_result=mysql_query($sql_skucode);
		//print $sql_skucode;
		while($skucode_row=mysql_fetch_array($skucode_result))
		{
			$instruction[]=$skucode_row;
		}
		return $instruction;
	}
	function GetProductbySubGrouping($product_number)
	{
		$sql_skucode="select product_number,products_id,layout from bs_products where product_number='$product_number' and active='Y' order by position asc";
		$skucode_result=mysql_query($sql_skucode);
		//print $sql_skucode;
		while($skucode_row=mysql_fetch_array($skucode_result))
		{
			$instruction[]=$skucode_row;
		}
		return $instruction;		
	}
	function GetSubCategoryList($mid1,$cid)
	{
			$sql_product="select grouping_id,name,long_description from bs_sub_category 
			where category_id='".$mid1."' and subcategory_id='".$cid."' and active='Y' order by position ";
			$product_result=mysql_query($sql_product);
			$num_items = mysql_num_rows($product_result);
			while($sub_cat_row=mysql_fetch_array($product_result))
			{
			$sub_cat_data[]=$sub_cat_row;
			}
			return $sub_cat_data;	
	}
	function GetstreetsignProductAccessoriesList()
	{
	$sql_accessories="select product_number from bs_landing_accessories 
	where landing_id='".mysql_real_escape_string(urldecode($_REQUEST[subcategory]))."' and active='Y'
	order by position";
	$accessories_result=mysql_query($sql_accessories);
	while($accessories_row=mysql_fetch_array($accessories_result))
			{
			 $accessories[]=$accessories_row;
		}		
	return $accessories;
	}
	function ControlCustomOptions()
	{
		$sql_skucode="select prefix_active,leftarrow_active,suffix_active,rightarrow_active,position_active,font_active,background_active,street_num_active,logo_active,secondline_active,textcolor_active,arrow_active,textdefaultcolor_active,arrowcolor_active,product_links,textsize1,textsize2 from bs_product_custom_control where layout='".mysql_real_escape_string(urldecode($_REQUEST[layout]))."'";
		$skucode_result=mysql_query($sql_skucode);
		//print $sql_skucode;
		while($options_row=mysql_fetch_array($skucode_result))
		{
			$customcontrol[prefix_active]=$options_row['prefix_active'];
			$customcontrol[leftarrow_active]=$options_row['leftarrow_active'];
			$customcontrol[suffix_active]=$options_row['suffix_active'];
			$customcontrol[rightarrow_active]=$options_row['rightarrow_active'];
			$customcontrol[position_active]=$options_row['position_active'];
			$customcontrol[font_active]=$options_row['font_active'];
			$customcontrol[background_active]=$options_row['background_active'];
			$customcontrol[street_num_active]=$options_row['street_num_active'];
			$customcontrol[logo_active]=$options_row['logo_active'];
			$customcontrol[secondline_active]=$options_row['secondline_active'];
			$customcontrol[textcolor_active]=$options_row['textcolor_active'];
			$customcontrol[arrow_active]=$options_row['arrow_active'];
			$customcontrol[textdefaultcolor_active]=$options_row['textdefaultcolor_active'];
			$customcontrol[arrowcolor_active]=$options_row['arrowcolor_active'];
			$customcontrol[product_links]=$options_row['product_links'];
			$customcontrol[textsize1]=$options_row['textsize1'];
			$customcontrol[textsize2]=$options_row['textsize2'];
		}
		return $customcontrol;		
	}
	function GetSizefromsku($skuode)
	{
		$sql_skucode="select size from bs_products_sku_description where sku_code='".mysql_real_escape_string($skuode)."'";
		$skucode_result=mysql_query($sql_skucode);
		while($options_row=mysql_fetch_array($skucode_result))
		{
			$size=$options_row['size'];
		}
		return $size;	
	}
	function createimg()
	{
		$prefix_x="";
		$prefix_y="";
		$suffix_x="";
		$suffix_y="";
		$prefix="";
		$suffix="";
		$streetnum="";
		$streetnum_x="";
		$streetnum_y="";				
		$subfont="";
		$position="";
		$gap=5;	
		$uppercheckbox="";
		$shiftlogo=0;
		$shiftsuffix=0;	
		$customoptions=$this->ControlCustomOptions();
		if(isset($_REQUEST['textupper']))
		{
			$uppercheckbox=$_REQUEST['textupper'];
		}
		if($uppercheckbox=="Y")		
			$text=strtoupper($_REQUEST['line_1']);
		else
			$text=$_REQUEST['line_1'];
		$text2="";
		if(isset($_REQUEST['line_2'])&&$_REQUEST['line_2']!='')
		{
			if($uppercheckbox=="Y")	
				$text2=strtoupper($_REQUEST['line_2']);
			else	
				$text2=$_REQUEST['line_2'];
		}
		$skuode=$_REQUEST['attributes_code'];
		$size=$this->GetSizefromsku($skuode);
		$size=str_replace("'","",$size);
		$size=str_replace(" ","",$size);
		$size_sepa=split("x",$size);
		$color=$_REQUEST['sign_color'];
		$color_Sep=split("/",$color);
		if($size_sepa[1]=="4")
			$size_sepa[1]=6;
		$backgroundimage=$color_Sep[0]."_".$size_sepa[1];
		if($customoptions[logo_active]=="Y"&&$_REQUEST['sign_background']=="")
		{
			$imgname="../images/catlog/product/small/".$backgroundimage."_Logo";//"../images/street-sign-thumbnails/".$backgroundimage."_Logo";
			if($size_sepa[1]==9)
				$shiftlogo=24;
			else if($size_sepa[1]==6)
				$shiftlogo=18;	
		}
	    else if($_REQUEST['sign_background']==""||$_REQUEST['sign_background']=="Plain")
			$imgname="../images/catlog/product/small/".$backgroundimage;//"../images/street-sign-thumbnails/".$backgroundimage;			
		else
			$imgname="../images/catlog/product/small/".$backgroundimage."_".$_REQUEST['sign_background'];//"../images/street-sign-thumbnails/".$backgroundimage."_".$_REQUEST['sign_background'];					
		if($size_sepa[1]==9)
		{
			if($_REQUEST['sign_background']=="Logo")
				$shiftlogo=24;
			else if($_REQUEST['sign_background']=="Left-Pointer")
				$shiftlogo=20;	
			else if($_REQUEST['sign_background']=="Right-Pointer")
				$shiftsuffix=20;
			else if($_REQUEST['sign_background']=="Round")
			{
				$shiftlogo=2;
				$shiftsuffix=2;
			}				
			$fontsize=12;
			$subfont=7;					
			if($text2!="")
				$font2=9;							
		}
		else if($size_sepa[1]==6)
		{
			if($_REQUEST['sign_background']=="Logo")
				$shiftlogo=18;
			else if($_REQUEST['sign_background']=="Left-Pointer")
				$shiftlogo=20;	
			else if($_REQUEST['sign_background']=="Right-Pointer")
				$shiftsuffix=20;
			else if($_REQUEST['sign_background']=="Round")
			{
				$shiftlogo=2;
				$shiftsuffix=2;
			}			
			$fontsize=9;
			$subfont=7;		
			if($text2!="")
				$font2=7;		
		}
		if(isset($_REQUEST['prefix'])&&strpos($_REQUEST['prefix'],"Arrow")&&$_REQUEST['prefix']!="NONE")
		{
			$prefix_Sep=explode(" ",$_REQUEST['prefix']);
			$imgname=$imgname."_".$prefix_Sep[0]."_p";
			$shiftlogo=$shiftlogo+20;
		}
		if(isset($_REQUEST['suffix'])&&strpos($_REQUEST['suffix'],"Arrow")&&$_REQUEST['suffix']!="NONE")
		{
			$suffix_Sep=explode(" ",$_REQUEST['suffix']);
			$imgname=$imgname."_".$suffix_Sep[0]."_s";
			$shiftsuffix=$shiftsuffix+20;	
		}
		if($_REQUEST['prefix']!="NONE"&&strpos($_REQUEST['prefix'],'Arrow')===false)
		{
			if($uppercheckbox=="Y")	
				$prefix=strtoupper($_REQUEST['prefix']);
			else
				$prefix=$_REQUEST['prefix'];
			$position=$_REQUEST['position'];
		}
		if($_REQUEST['suffix']!="NONE"&&strpos($_REQUEST['suffix'],'Arrow')===false)
		{
			if($uppercheckbox=="Y")	
				$suffix=strtoupper($_REQUEST['suffix']);
			else
				$suffix=$_REQUEST['suffix'];
			$position=$_REQUEST['position'];		
		}		
		$imgname=$imgname.".jpg";
		$im = imagecreatefromjpeg($imgname);
		$width=imagesx($im);
		$height=imagesy($im);		
		 //$random_digit=rand(0000,9999);
		 //$filename=$skuode.$random_digit.date('Ynjhis').".jpg";
		$no=date(dy);
		$nodc=date(dy);
		$no.=time();
		$filename=$no.".jpg";		 
		 if($color_Sep[0]=="White")
			$textcolorcode=$this->GetColorCode("Black");
		 else
			$textcolorcode=$this->GetColorCode("White");
		 $textcolor = imagecolorallocate($im, $textcolorcode[0], $textcolorcode[1], $textcolorcode[2]);
		 $colorcode=$this->GetColorCode($color_Sep[0]);
		if(isset($_REQUEST['sign_font'])&&$_REQUEST['sign_font']!="")
			$font = /*"..".$Path_Img_Font_product.$_REQUEST['sign_font'].'.ttf';*/'../content/'.$_REQUEST['sign_font'].'.ttf';
		else
			$font = /*"..".$Path_Img_Font_product.'Highway.ttf';*/'../content/Highway.ttf';
		if(isset($_REQUEST['sign_font'])&&$_REQUEST['sign_font']=="Algerian")
		{
			$text=strtoupper($text);
			$text2=strtoupper($text2);
		}							
		$prefixbox=imagettfbbox($subfont, 0, $font, $prefix);	
		$suffixbox=imagettfbbox($subfont, 0, $font, $suffix);			
		$mainbox = imagettfbbox($fontsize, 0,$font , $text);
		$prefix_width=$prefixbox[2]-$prefixbox[0];
		$prefix_height=$prefixbox[3]-$prefixbox[5];
		$suffix_width=$suffixbox[2]-$suffixbox[0];
		$suffix_height=$suffixbox[3]-$suffixbox[5];
		$suffixtakewidth=$suffix_width;
		$textgap=2;
		$vertextgap=2;
		$addtextgap=0;
		$text2addgap=0;
		$text1addgap=0;
		$bothupper_addgap=0;
		$bothmixed_reduce=0;	
		$lowertext2=0;
		$uppertext1=0;
		$addy=0;
		if($position=="Top")
		{
			if($prefix!="")
				$prefix_y=($height-2*$gap)/3+$gap;
			if($suffix!="")
				$suffix_y=($height-2*$gap)/3+$gap;
		}
		else if($position=="Middle")
		{
			if($prefix!="")
				$prefix_y=($height-2*$gap)*2/3+$gap;
			if($suffix!="")
				$suffix_y=($height-2*$gap)*2/3+$gap;
		}
		else if($position=="Bottom")
		{
			if($prefix!="")
				$prefix_y=$height-$gap;
			if($suffix!="")
				$suffix_y=$height-$gap;
		}
		else
		{
			if($prefix!="")
				$prefix_y=($height-2*$gap)*2/3+$gap;		
		}
		$textwidth=$mainbox[2]-$mainbox[0];
		$textheight=$mainbox[3]-$mainbox[5];
		$heightboundry=$height-$textheight;
		$suffix_x=$width-$gap-$suffix_width-$shiftsuffix;	
		$prefix_x=$gap+$shiftlogo;		
		if(isset($_REQUEST['sidetext']))
		{
			if($uppercheckbox=="Y")	
				$streetnum=strtoupper($_REQUEST['sidetext']);
			else
				$streetnum=$_REQUEST['sidetext'];
			$streetnumbox=imagettfbbox($subfont, 0, $font, $streetnum);	
			$streetnum_width=$streetnumbox[2]-$streetnumbox[0];
			$streetnum_height=$streetnumbox[3]-$streetnumbox[5];	
			$streetnum_y=($height-2*$gap-$vertextgap-$streetnum_height*2)/3+$gap+$streetnum_height;
			$suffix_y=$height-$gap-($height-2*$gap-$vertextgap-$streetnum_height*2)/3;
			if($streetnum_width>$suffix_width)
			{
				$boundary=$width-$prefix_width-$streetnum_width-2*$gap-2*$textgap-$shiftlogo-$shiftsuffix;	
				$streetnum_x=$width-$gap-$streetnum_width-$shiftsuffix;
				$suffix_x=$width-($streetnum_width-$suffix_width)/2-$gap-$suffix_width;
				$suffixtakewidth=$streetnum_width;
			}
			else
			{
				$boundary=$width-$prefix_width-$suffix_width-2*$gap-2*$textgap-$shiftlogo-$shiftsuffix;		
				$streetnum_x=$width-($suffix_width-$streetnum_width)/2-$gap-$streetnum_width;
				$suffixtakewidth=$suffix_width;
			}
		}
		else
			$boundary=$width-$prefix_width-$suffix_width-2*$gap-2*$textgap-$shiftlogo-$shiftsuffix;									
	
		if($text2!="")
		{
			if(strtoupper($text2)==$text2)
			{
				$shrinkp=1;
				if(strtoupper($text)!=$text)
					$text2addgap=1;
				$bothupper_addgap=1;
			}
			else if(strtolower($text2)==$text2)
			{
				$shrinkp=0.8;
				if(strtoupper($text)!=$text)
					$bothmixed_reduce=1;
				else
					$lowertext2=2; 			
			}
			else
			{
				$shrinkp=0.8;
				if(strtoupper($text)!=$text)
					$bothmixed_reduce=1;
			}
			$mainbox2 = imagettfbbox($font2, 0,$font , $text2);
			$textwidth2=$mainbox2[2]-$mainbox2[0];
			$textheight2=$mainbox2[3]-$mainbox2[5];
			if($textwidth2<=$boundary)
			{
				if($prefix!=""&&($suffix!=""||$streetnum!=""))
				{
					$adddistance2=($width-$prefix_width-$suffixtakewidth-2*$gap-2*$textgap-$textwidth2-$shiftlogo-$shiftsuffix)/2;
					$x2=$prefix_width+$gap+$textgap+$adddistance2+$shiftlogo;
				}
				else if($prefix==""&&($suffix!=""||$streetnum!=""))
				{
					$adddistance2=($width-$prefix_width-$suffixtakewidth-2*$gap-$textgap-$textwidth2-$shiftlogo-$shiftsuffix)/2;
					$x2=$prefix_width+$gap+$adddistance2+$shiftlogo;			
				}
				else if($prefix!=""&&($suffix==""&&$streetnum==""))
				{
					$adddistance2=($width-$prefix_width-2*$gap-$textgap-$textwidth2-$shiftlogo-$shiftsuffix)/2;
					$x2=$prefix_width+$gap+$textgap+$adddistance2+$shiftlogo;			
				}
				else if($prefix==""&&($suffix==""&&$streetnum==""))
				{
					$adddistance2=($width-$prefix_width-2*$gap-$textwidth2-$shiftlogo-$shiftsuffix)/2;
					$x2=$prefix_width+$gap+$adddistance2+$shiftlogo;			
				}			
				$y2=($height-$textheight-$textheight2)/2+$textheight+$textheight2+$lowertext2/2;
				$addtextgap=1;	
			}
			else
			{
				$compresstext2="Y";
				$y2=($height-$textheight-$textheight2)/2+$textheight;
				$textimage2 = imagecreate($textwidth2, $textheight2);
				$backgroundcolor2 = imagecolorallocate($textimage2, $colorcode[0], $colorcode[1], $colorcode[2]);
				$textcolor_org2 = imagecolorallocate($textimage2, $textcolorcode[0], $textcolorcode[1], $textcolorcode[2]);
				imagettftext($textimage2,$font2, 0, 0, $textheight2*$shrinkp, $textcolor_org2, $font, $text2);
				imagecopyresampled($im, $textimage2, $prefix_width+$gap+$textgap+$shiftlogo, $y2+$bothupper_addgap+$text2addgap+$lowertext2, 0, 0, $boundary, $textheight2, $textwidth2, $textheight2);					
			}		
		}
		else
		{
			$textwidth2=0;
			$textheight2=0;
		}
		if($text2=="")
		{
			if(strtoupper($text)!=$text)
			{
				if($size_sepa[1]==6)
				{
					if($textheight==11)
					{
						$addy=1;
						$shrinkp=1;
						$compressy=$textheight*$shrinkp-2*$addy;
						$addy=1;				
					}
					else
					{
						$shrinkp=1;
						$compressy=$textheight*$shrinkp;
						$addy=-1;
					}
				}
				else
				{
					if($textheight==16)
					{
						$addy=1;
						$shrinkp=1;
						$compressy=$textheight*$shrinkp-2*$addy;						
					}
					else
					{
						$shrinkp=1;
						$compressy=$textheight*$shrinkp;
						$addy=-1;					
					}
				}		
			}
			else
			{
				$shrinkp=1;
				$compressy=$textheight*$shrinkp-$text1addgap;
			}
		}
		else if(strtoupper($text)==$text)
		{
			$shrinkp=1;
			$compressy=$textheight*$shrinkp-$text1addgap;
			if(isset($_REQUEST['sign_font'])&&$_REQUEST['sign_font']=="Algerian")
				$compressy=$textheight*$shrinkp;
		}
		else if(strtolower($text)==$text)
		{
			$shrinkp=1;
			$text1addgap=2;
			$compressy=$textheight*$shrinkp-$text1addgap;
		}
		else
		{
			$shrinkp=1.2;
			$text1addgap=-2;
			if($size_sepa[1]==6)
			{
				$uppertext1=0.5;	
				if($textheight==11)
				{
					$compressy=$textheight*$shrinkp+$mainbox[5]+$vertextgap-$text1addgap;
					$addy=3;				
				}
				else
				{
					$compressy=$textheight*$shrinkp+$mainbox[5]+$vertextgap+9*$uppertext1-$text1addgap/2;
					$addy=3.0;
				}
			}
			else if($size_sepa[1]==9)
			{
				$uppertext1=0.6;
				if($textheight==16)
				{
					$compressy=$textheight*$shrinkp+$mainbox[5]+$vertextgap+$uppertext1-2*$text1addgap;
					$addy=0;		
				}
				else
				{
					$compressy=$textheight*$shrinkp+$mainbox[5]+$vertextgap+12*$uppertext1-$text1addgap;
					$addy=0.4;
				}
			}
		}
		if($textwidth<=$boundary)
		{
			if($prefix!=""&&($suffix!=""||$streetnum!=""))
			{
				$adddistance=($width-$prefix_width-$suffixtakewidth-2*$gap-2*$textgap-$textwidth-$shiftlogo-$shiftsuffix)/2;
				$x=$prefix_width+$gap+$textgap+$adddistance+$shiftlogo;
			}
			else if($prefix==""&&($suffix!=""||$streetnum!=""))
			{
				$adddistance=($width-$prefix_width-$suffixtakewidth-2*$gap-$textgap-$textwidth-$shiftlogo-$shiftsuffix)/2;
				$x=$prefix_width+$gap+$adddistance+$shiftlogo;
			}
			else if($prefix!=""&&($suffix==""&&$streetnum==""))
			{
				$adddistance=($width-$prefix_width-2*$gap-$textgap-$textwidth-$shiftlogo-$shiftsuffix)/2;
				$x=$prefix_width+$gap+$textgap+$adddistance+$shiftlogo;		
			}
			else if($prefix==""&&($suffix==""&&$streetnum==""))
			{
				$adddistance=($width-$prefix_width-2*$gap-$textwidth-$shiftlogo-$shiftsuffix)/2;
				$x=$prefix_width+$gap+$adddistance+$shiftlogo;				
			}
			$y=($height-$textheight-$textheight2)/2+$textheight-$vertextgap;
		}
		else
		{
			$compresstext="Y";
			$y=($height-$textheight-$textheight2)/2;
			$textimage = imagecreate($textwidth, $textheight);
			$backgroundcolor = imagecolorallocate($textimage, $colorcode[0], $colorcode[1], $colorcode[2]);
			$textcolor_org = imagecolorallocate($textimage, $textcolorcode[0], $textcolorcode[1], $textcolorcode[2]);
			imagettftext($textimage,$fontsize, 0, 0, $compressy, $textcolor_org, $font, $text);			
			imagecopyresampled($im, $textimage, $prefix_width+$gap+$textgap+$shiftlogo, $y-$bothmixed_reduce-$text2addgap-$bothupper_addgap+$text1addgap+$addy, 0, 0, $boundary, $textheight, $textwidth, $textheight);
		}
		if($compresstext!="Y")
			imagettftext($im, $fontsize, 0, $x, $y, $textcolor, $font, $text); 	
		if($text2!=""&&$compresstext2!="Y")
			imagettftext($im, $font2, 0, $x2, $y2, $textcolor, $font, $text2);
		if($prefix_x!=""&&$prefix_y!="")
			imagettftext($im, $subfont, 0, $prefix_x, $prefix_y, $textcolor, $font, $prefix);
		if($suffix_x!=""&&$suffix_y!="")	
			imagettftext($im, $subfont, 0, $suffix_x, $suffix_y, $textcolor, $font, $suffix);
		if($streetnum_x!=""&&$streetnum_y!="")
			imagettftext($im, $subfont, 0, $streetnum_x, $streetnum_y, $textcolor, $font, $streetnum);			
		$imagepath=/*'..'.$Path_Img_Custom_Small_product.$filename;*/'../design/save/previews/small/'.$filename;
		$imagepathpreview=/*'..'.$Path_Img_Custom_Small_product.$filename;*/'../design/save/previews/'.$filename;	
		imagejpeg($im, $imagepath);
		imagejpeg($im, $imagepathpreview);
		return $filename;
	}
	function GetColorCode($color)
	{
		switch($color)
		{
			case 'Orange':
			{
				$colorcode=array(248, 152, 29);//array(248, 152, 29);//array(209, 127, 20);
				break;
			}
			case 'White':
			{
				$colorcode=array(255, 255, 255);
				break;
			}
			case 'Red':
			{
				$colorcode=array(197, 18, 48);//array(180, 18, 48);
				break;
			}
			case 'Brown':
			{
				$colorcode=array(127, 54, 32);//array(126, 53, 31);
				break;
			}
			case 'Blue':
			{
				$colorcode=array(42, 80, 163);///array(1, 104, 179);//array(35, 80, 163);
				break;
			}				
			case 'Green':
			{
				$colorcode=array(0, 134, 83);//array(5, 129, 75);
				break;
			}
			case 'Black':
			{
				$colorcode=array(0, 0, 0);
				break;
			}		
		}
		return $colorcode;
	}
	function PDFexist($imageid)
	{
		$sql_skucode="select pdf_file from bs_products_custom where custom_product_id='".mysql_real_escape_string($imageid)."'";
		$skucode_result=mysql_query($sql_skucode);
		//print $sql_skucode;
		while($options_row=mysql_fetch_array($skucode_result))
		{
			$pdf_file=$options_row['pdf_file'];
		}
		return $pdf_file;			
	}
	function GetCustomImages($color,$size,$layout)
	{
		$sql_skucode="select custom_image from bs_product_custom_color where layout='$layout' and size='".mysql_real_escape_string($size)."' and color='$color' and active='Y'";
		$skucode_result=mysql_query($sql_skucode);
		//print $sql_skucode;
		while($options_row=mysql_fetch_array($skucode_result))
		{
			$customimage=$options_row['custom_image'];
		}
		$imgpath="../images/parking-signs/".$customimage;
		list($width, $height) = getimagesize($imgpath);		
		$design=$this->CustomDesignArguments($layout,$size);
		echo $customimage."|".$width."|".$height."|".$design[textarea1_x]."|".$design[textarea1_y]."|".$design[textarea1_width]."|".$design[textarea1_height]."|".$design[textarea2_x]."|".$design[textarea2_y]."|".$design[textarea2_width]."|".$design[textarea2_height]."|".$design[number_x]."|".$design[number_y]."|".$design[number_width]."|".$design[number_height]."|".$design[image_x]."|".$design[image_y]."|".$design[image_width]."|".$design[image_height]."|".$design[arrow_x]."|".$design[arrow_y]."|".$design[arrow_width]."|".$design[arrow_height];
	}
	function GetCustombackgroundImages($color,$size,$layout)
	{
		$sql_skucode="select custom_image from bs_product_custom_color where layout='$layout' and size='".mysql_real_escape_string($size)."' and color='$color' and active='Y'";
		$skucode_result=mysql_query($sql_skucode);
		//print $sql_skucode;
		while($options_row=mysql_fetch_array($skucode_result))
		{
			$customimage=$options_row['custom_image'];
		}
		return $customimage;;
	}	
	function CustomDesignArguments($layout,$size)
	{
		$sql_skucode="select textarea1_x,textarea1_y,textarea1_width,textarea1_height,textarea2_x,textarea2_y,textarea2_width,textarea2_height,number_x,number_y,number_width,number_height,image_x,image_y_top,image_y_middle,image_y_bottom,image_width,image_height,arrow_x,arrow_y_top,arrow_y_middle,arrow_y_bottom,arrow_width,arrow_height from bs_products_custom_design where layout='".mysql_real_escape_string(urldecode($_REQUEST[layout]))."' and size='".mysql_real_escape_string($size)."' and active='Y'";
		$skucode_result=mysql_query($sql_skucode);
		//print $sql_skucode;
		while($options_row=mysql_fetch_array($skucode_result))
		{
			$customdesign[textarea1_x]=$options_row['textarea1_x'];
			$customdesign[textarea1_y]=$options_row['textarea1_y'];
			$customdesign[textarea1_width]=$options_row['textarea1_width'];
			$customdesign[textarea1_height]=$options_row['textarea1_height'];
			$customdesign[textarea2_x]=$options_row['textarea2_x'];
			$customdesign[textarea2_y]=$options_row['textarea2_y'];
			$customdesign[textarea2_width]=$options_row['textarea2_width'];
			$customdesign[textarea2_height]=$options_row['textarea2_height'];
			$customdesign[number_x]=$options_row['number_x'];
			$customdesign[number_y]=$options_row['number_y'];
			$customdesign[number_width]=$options_row['number_width'];
			$customdesign[number_height]=$options_row['number_height'];
			$customdesign[image_x]=$options_row['image_x'];
			$customdesign[image_y_top]=$options_row['image_y_top'];
			$customdesign[image_y_middle]=$options_row['image_y_middle'];
			$customdesign[image_y_bottom]=$options_row['image_y_bottom'];
			$customdesign[image_width]=$options_row['image_width'];
			$customdesign[image_height]=$options_row['image_height'];
			$customdesign[arrow_x]=$options_row['arrow_x'];
			$customdesign[arrow_y_top]=$options_row['arrow_y_top'];
			$customdesign[arrow_y_middle]=$options_row['arrow_y_middle'];
			$customdesign[arrow_y_bottom]=$options_row['arrow_y_bottom'];
			$customdesign[arrow_width]=$options_row['arrow_width'];
			$customdesign[arrow_height]=$options_row['arrow_height'];		
		}
		return $customdesign;	
	}			
}
?>
