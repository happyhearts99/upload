<?php 
class Shoppingcart
{
	    function PmSaveShoppingcardList()
		{ 
			$sql_customer_list="select pm_shopping_cart.quote_status,pm_shopping_cart.cart_name,pm_shopping_cart.id,pm_shopping_cart.save_cart_name,pm_customer_shipping_address.shipping_company,pm_shopping_cart.created_date from pm_shopping_cart left join pm_customer_shipping_address on pm_shopping_cart.customers_shipping_id=pm_customer_shipping_address.shipping_id where pm_shopping_cart.shopping_save='Y' and pm_shopping_cart.customers_id=$_SESSION[CID] group by pm_shopping_cart.cart_name order by pm_shopping_cart.id desc";

			$customer_result=mysql_query($sql_customer_list);
			while($customer_row=mysql_fetch_array($customer_result))
			{
				$customer[]=$customer_row;
			}
			return $customer;		
		}
	    function PmSaveShoppingcardQuoteList()
		{
			$sql_customer_list="select pm_shopping_cart.quote_status, pm_shopping_cart.cart_name,pm_shopping_cart.id,pm_shopping_cart.quote_name,pm_customer_shipping_address.shipping_company,
			 pm_shopping_cart.created_date  
			from pm_shopping_cart,pm_customer_shipping_address where pm_shopping_cart.shopping_save='Q' and pm_shopping_cart.customers_shipping_id=pm_customer_shipping_address.shipping_id and pm_shopping_cart.customers_id=$_SESSION[CID] group by pm_shopping_cart.cart_name order by pm_shopping_cart.id desc";
			
			$customer_result=mysql_query($sql_customer_list);
			while($customer_row=mysql_fetch_array($customer_result))
			{
				$customer[]=$customer_row;
			}
			return $customer;		
		}
	    function PmSaveShoppingSessionList()
		{  
			$sql_customer_list="select session_id from pm_shopping_cart where shopping_save='N' group by session_id order by created_date desc";
			$customer_result=mysql_query($sql_customer_list);
			while($customer_row=mysql_fetch_array($customer_result))
			{
				$customer[]=$customer_row;
			}
			return $customer;		
		}
		function getquotecartinfo($type)
		{
			$passID=base64_decode($_REQUEST[ID]);
			if($type=='savecart')
			{
					$sql_shoppingcart_list="select customers_id,cart_name,
					save_cart_name,quote_name,created_date
					 from pm_shopping_cart where cart_name='$passID' and shopping_save='Y' and customers_id=$_SESSION[CID]" ;
			}
			else if($type=='savequote')
			{
					$sql_shoppingcart_list="select customers_id,cart_name,
					save_cart_name,quote_name,created_date
					from pm_shopping_cart where cart_name='$passID' and shopping_save='Q' and customers_id=$_SESSION[CID]" ;
			}
			$i=0;
			$cart_result=mysql_query($sql_shoppingcart_list);
			while($cart_row=mysql_fetch_array($cart_result))
			{
			$i++;
			$cart[customers_id]=$cart_row['customers_id'];
			$cart[cart_name]=$cart_row['cart_name'];
			$cart[save_cart_name]=$cart_row['save_cart_name'];
			$cart[quote_name]=$cart_row['quote_name'];
			$cart[created_date]=$cart_row['created_date'];
			$cart[customers_shipping_id]=$cart_row['customers_shipping_id'];	
			$cart[numberofitems]=$i;
			}
			return $cart;		
		}
		function shoppingcartaddressinfo()
		{
			$sql_shippingaddr_list="select billing_first_name,billing_last_name,billing_street_address,
			billing_suburb,billing_postcode,billing_city,billing_phone,billing_state,billing_company
			 from pm_customer_billing_address where customers_id=$_SESSION[CID] and ccNumSave='Y'";	
			 
			//$sql_shippingaddr_list="select shipping_first_name,shipping_last_name,shipping_street_address,
			//shipping_suburb,shipping_postcode,shipping_city,shipping_phone,shipping_state,shipping_company
			 //from pm_customer_shipping_address where shipping_id=$customers_shipping_id";	

			$shippingaddr_result=mysql_query($sql_shippingaddr_list);
			while($shipping_row=mysql_fetch_array($shippingaddr_result))
			{
				//print $shipping_row['shipping_first_name'].'firstname';
				$shipping[shipping_first_name]=$shipping_row['billing_first_name'];
				$shipping[shipping_last_name]=$shipping_row['billing_last_name'];
				$shipping[shipping_street_address]=$shipping_row['billing_street_address'];
				$shipping[shipping_suburb]=$shipping_row['billing_suburb'];
				$shipping[shipping_postcode]=$shipping_row['billing_postcode'];
				$shipping[shipping_city]=$shipping_row['billing_city'];
				$shipping[shipping_phone]=$shipping_row['billing_phone'];			
				$shipping[shipping_state]=$shipping_row['billing_state'];
				$shipping[shipping_company]=$shipping_row['billing_company'];
			}
			return $shipping;
		}
		function getinfoforquoteorcart($type)
		{
			$passID=base64_decode($_REQUEST[ID]);
			if($type=='savecart')
			{
					$sql_shoppingcart="select id,products_id,producttype,sku_code
				,sku_name,quantity,price,total,new_price,new_total,sku_id,customer_price,customer_total,stock_custom,custom_text,tag_configuration,mounting_option,make_fit,background_color from pm_shopping_cart where cart_name='$passID' and shopping_save='Y' and customers_id=$_SESSION[CID] order by id asc";	
			}
			else if($type=='savequote')
			{
					$sql_shoppingcart="select id,products_id,producttype,sku_code
				,sku_name,quantity,price,total,new_price,new_total,sku_id,customer_price,customer_total,stock_custom,custom_text,tag_configuration,mounting_option,make_fit,background_color from pm_shopping_cart where cart_name='$passID' and shopping_save='Q' and customers_id=$_SESSION[CID] order by id asc";	
			}
			$shoppingcart_result=mysql_query($sql_shoppingcart);	
			while($shopping_row=mysql_fetch_array($shoppingcart_result))
			{
				$shopping[]=$shopping_row;
			}	
			//print $sql_shoppingcart;
			return $shopping;
		}
		function getproductsku_list($sku_id)
		{
			$sql_productsku_list="select addtocart_heading from pm_products_sku_description where sku_id=$sku_id and active='Y'";
						
			$productsku_result=mysql_query($sql_productsku_list);
			while($productsku_row=mysql_fetch_array($productsku_result))
			{
				$productsku[addtocart_heading]=$productsku_row['addtocart_heading'];			
			}		
			return $productsku[addtocart_heading];
		}
		function getproductnumber_list($products_id)
		{
			 $sql_product="select product_number from pm_products where products_id=$products_id";
			 $product_result=mysql_query($sql_product);	
			 while($product_row=mysql_fetch_array($product_result))
			 {
			 	$product['product_number']=$product_row['product_number']; 		 
			 }
			 return $product['product_number'];
		}
		function PmSavecreateShoppingCardCsv($type)
		{	
			$file = 'pipemakercart.csv';
			//$passID=base64_decode($_REQUEST[ID]);

			$cart=$this->getquotecartinfo($type);
	
			$count=$cart[numberofitems];
			if($_SESSION[user_type]=='R')
			{
				  $shipping=$this->shoppingcartaddressinfo();
				  if($shipping[shipping_company]!='')			 
					  $customers_name= $shipping[shipping_first_name]." ".$shipping[shipping_last_name].", ".$shipping[shipping_company];
				  else
					  $customers_name= $shipping[shipping_first_name]." ".$shipping[shipping_last_name];
		  
				  if($shipping[shipping_street_address]!='')
				  {
					  if($shipping[shipping_city]!='')
						  $shipping[shipping_city]=", ".$shipping[shipping_city];
					  if($shipping[shipping_state]!='')
						  $shipping[shipping_state]=", ".$shipping[shipping_state];
					  
					  if($shipping[shipping_phone]=='')
					  {
						  $shipping_address= $shipping[shipping_street_address]." ".$shipping[shipping_suburb].$shipping[shipping_city].$shipping[shipping_state]." ".$shipping[shipping_postcode];			
					  }
					  else
					  {
						  $shipping_address= $shipping[shipping_street_address]." ".$shipping[shipping_suburb].$shipping[shipping_city].$shipping[shipping_state]." ".$shipping[shipping_postcode]."    |    Phone: ".$shipping[shipping_phone];			
					  }
				  }
				  else
				  {
					  if($shipping[shipping_state]!='')
						  $shipping[shipping_state]=", ".$shipping[shipping_state];
						  
					  if($shipping[shipping_phone]=='')
					  {					
						  if($shipping[shipping_suburb]!='')
						  {	
							  if($shipping[shipping_city]!='')
								  $shipping[shipping_city]=", ".$shipping[shipping_city];
							  
							  $shipping_address= $shipping[shipping_suburb].$shipping[shipping_city].$shipping[shipping_state]." ".$shipping[shipping_postcode];
						  }
						  else
							  $shipping_address= $shipping[shipping_city].$shipping[shipping_state]." ".$shipping[shipping_postcode];
					  }
					  else
					  {
						  if($shipping[shipping_suburb]!='')
						  {
							  if($shipping[shipping_city]!='')
								  $shipping[shipping_city]=", ".$shipping[shipping_city];
								  
							  $shipping_address= $shipping[shipping_suburb].$shipping[shipping_city].$shipping[shipping_state]." ".$shipping[shipping_postcode]."    |    Phone: ".$shipping[shipping_phone];
						  }
						  else
							  $shipping_address= $shipping[shipping_city].$shipping[shipping_state]." ".$shipping[shipping_postcode]."    |    Phone: ".$shipping[shipping_phone];
					  }			
				  }
			}
		//if($_SESSION[user_type]=='R')
		
			if($type=='savecart')
			{
				$shoppingcardinfo = array(array('Website:','Pipemarker.com'),array('Shopping Cart Name:',$cart[save_cart_name]),
				/*array('Customer Name:', $customers_name),array('Ship to Address:', $shipping_address),*/
				array('date Created:',$cart[created_date]),
				array('Number of Items:',$count),
				array('',''),array('',''));
			}
			else //if($type=='savequote')
			{
				$shoppingcardinfo = array(array('Website:','Pipemarker.com'),array('Quote #:',$cart[quote_name]),
				array('Customer Name:', $customers_name),array('Ship to Address:', $shipping_address),
				array('date Created:',$cart[created_date]),
				array('Number of Items:',$count),
				array('',''),array('',''));
			}
		//print_r($shoppingcardinfo);
		/*else
		{
			//$shipping_address='P.O. Box 467 / 64 Outwater Lane, Garfield NJ 07026 | Phone:800-274-6271';
			if($type=='savecart')
			{
				$shoppingcardinfo = array(array('Website:','Pipemarker.com'),array('Shopping Cart Name:',$cart[save_cart_name]),
				array('Customer Name:', $customers_name),array('Ship to Address:', $shipping_address),
				array('date Created:',$cart[created_date]),
				array('Number of Items:',$count),
				array('',''),array('',''));
			}
			else //if($type=='savequote')
			{
				$shoppingcardinfo = array(array('Website:','Pipemarker.com'),array('Quote #:',$cart[quote_name]),
				array('Customer Name:', $customers_name),array('Ship to Address:', $shipping_address),
				array('date Created:',$cart[created_date]),
				array('Number of Items:',$count),
				array('',''),array('',''));
			}			
		}*/
		if($_SESSION[user_type]=='R')
		{
			$unitheading='Net Price(-30%)';
			$shoppingcardheading = array(array('Product', 'Item Number', 'Item Description And Size','Quantity','List Price','Subtotal',$unitheading,'Subtotal','Customer Price','Subtotal'));
		}
		else
		{
			$shoppingcardheading = array(array('Product', 'Item Number', 'Item Description And Size','Quantity','Unit Price','Subtotal'));
		}
		//$shoppingcardheading = array(array('Product', 'Item Number', 'Item Description And Size','Quantity',$unitheading,'Total Price','Special Price','Special Total'));
		
		$fp = fopen($file, 'w');
		foreach ($shoppingcardinfo as $fields) 
		{
				fputcsv($fp, $fields);
		}
	
		foreach ($shoppingcardheading as $fields) 
		{
				fputcsv($fp, $fields);
		}						

			$list_total=0;
		    $total=0;			
			$shoppingcart_info=$this->getinfoforquoteorcart($type);
			if(count($shoppingcart_info)>0)
			{
				foreach($shoppingcart_info as $key => $row)
				{
					$shopping[products_id]=$row['products_id'];
					$shopping[sku_id]=$row['sku_id'];
					$twodigit_list_price = $this->numberround($row['price'], 2);
					$twodigit_list_price=number_format($twodigit_list_price,2);
					$twodigit_customer_price=$this->numberround($row['customer_price'], 2);	
					$twodigit_customer_price=number_format($twodigit_customer_price,2);
					$twodigit_new_price=$this->numberround($row['new_price'], 2);
					$twodigit_new_price=number_format($twodigit_new_price,2);
					$twodigit_new_total=$this->numberround($row['new_total'], 2);
					$twodigit_new_total=number_format($twodigit_new_total,2);
					$list_total=$list_total+$row['total'];					
					$total=$total+$row['new_total'];					
					$special_total=$special_total+$row['customer_total'];							
					$productsku[addtocart_heading]=$this->getproductsku_list($shopping[sku_id]);
					$product['product_number']=$this->getproductnumber_list($shopping[products_id]);
					$additional_charge_info=$this->getAdditionalchargeinfo($row['sku_code']);
					$printadditionaltext='';
					if(count($additional_charge_info)>0)
					{
						foreach($additional_charge_info as $key=> $addinfo)
						{
							if($addinfo['additional_charge']!='')
							{
								$printadditionaltext = ';'.$addinfo['surcharges_message'];
							}
							if($addinfo['min_quantity_below']>$row['quantity'])
							{
								$printadditionaltext = ';'.$addinfo['surcharges_message'];
							}
						}
					}
					if($row['stock_custom']=="C")
					{
						$customproduct_shopping_cart=$this->PMsaveLoadCustomNameplateDetails($row['id']);
						if($row['text_line']!='')
						{
							$printadditionaltext.=';'.Textsize_Label.':'.$row['text_line']; 		
						}
						if($row['tag_configuration']=='S')
						{
							$printadditionaltext.= ";Single: Range"; 		
						}
						if($row['tag_configuration']=='R')
						{
							$printadditionaltext.= ";Multiple: Range"; 		
						}
						$colorlabel=Color_Label;
						$filelabel=File_Label;
						$mountingoptionlabel=Mountingoption_Label;
						if($row['mounting_option']!='')
							$printadditionaltext.= ';'.$mountingoptionlabel.':'.$row['mounting_option']; 
						if($row['background_color']!='')
							$printadditionaltext.= ';'.$colorlabel.':'.$row['background_color']; 
						if($row['make_fit']=='Y')
							$printadditionaltext.= ';Copy to fit:Active'; 
						if(sizeof($customproduct_shopping_cart)>0)
						{	
						   foreach($customproduct_shopping_cart  as $key => $customproduct_att_value)
						   {
							if($customproduct_att_value['option_label1']!=''&& $customproduct_att_value['option_value1']!='')
							  $printadditionaltext.= ';'.$customproduct_att_value['option_label1'].':'.$customproduct_att_value['option_value1'];      
							if($customproduct_att_value['option_label2']!=''&& $customproduct_att_value['option_value2']!=''&&$row['make_fit']!='Y')
							  $printadditionaltext.= ';'.$customproduct_att_value['option_label2'].':'.$customproduct_att_value['option_value2'];    
							if($customproduct_att_value['option_label3']!=''&& $customproduct_att_value['option_value3']!='')
							  $printadditionaltext.= ';'.$customproduct_att_value['option_label3'].':'.$customproduct_att_value['option_value3'];
							if($customproduct_att_value['option_label4']!=''&& $customproduct_att_value['option_value4'][0]!='')
							  $printadditionaltext.= ';'.$customproduct_att_value['option_label4'].':'.$customproduct_att_value['option_value4']; 
						   }// end of foreach loop
						}//end of size of condition								
					}
					if($_SESSION[user_type]=='R')
						$shoppingcartdetail=array(array($productsku[addtocart_heading], $row['sku_code'], $row['sku_name'].$printadditionaltext, $row['quantity'], '$'.$twodigit_list_price,'$'.$row['total'],'$'.$twodigit_new_price, '$'.$twodigit_new_total,'$'.$twodigit_customer_price,'$'.$row['customer_total']));				
					else
						$shoppingcartdetail=array(array($productsku[addtocart_heading], $row['sku_code'], $row['sku_name'].$printadditionaltext, $row['quantity'], '$'.$twodigit_new_price,'$'.$twodigit_new_total));										
					foreach ($shoppingcartdetail as $fields) 
					{
						fputcsv($fp, $fields);
					}
				}	
			}
			$list_total=number_format($list_total,2);
			$total=number_format($total,2);
			$special_total=number_format($special_total,2);
				if($_SESSION[user_type]=='R')
					$shoppingcardfooter = array(array('', '', '* Total does not include shipping and/or taxes.','Total:*','','$'.$list_total,'','$'.$total,'','$'.$special_total));
				else
					$shoppingcardfooter = array(array('', '', '* Total does not includ shipping and/or taxes.','Total:*','','$'.$total));
				foreach ($shoppingcardfooter as $fields) 
				{
					fputcsv($fp, $fields);
				}
			fclose($fp);
			if(file_exists($file)) 
			{
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.$file);
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			ob_clean();
			flush();
			readfile($file);
			exit;
			}
		}//end of function	
		function PmSaveShoppingCardPrintpagebasicinfo($type)
		{  
			$passID=base64_decode($_REQUEST[ID]);
			if($type=='savecart')
			{
				$sql_customer_list="select s.save_cart_name ,c.company_logo
				from pm_shopping_cart s, pm_customers c where s.customers_id=c.customers_id and s.customers_id=$_SESSION[CID] and s.cart_name='$passID' and s.shopping_save='Y'";
			}
			else if($type=='savequote')
			{
				$sql_customer_list="select s.quote_name ,c.company_logo
				from pm_shopping_cart s, pm_customers c where s.customers_id=c.customers_id and s.customers_id=$_SESSION[CID] and s.cart_name='$passID' and s.shopping_save='Q' ";				
			}
			//print $sql_customer_list;
			$customer_result=mysql_query($sql_customer_list);
			while($customer_row=mysql_fetch_array($customer_result))
			{
				if($type=='savecart')
					$customer[quotecartname]=$customer_row['save_cart_name'];
				else
					$customer[quotecartname]=$customer_row['quote_name'];
				$customer[company_logo]=$customer_row['company_logo'];
			}
			return $customer;				
		}
		function PmSaveShoppingCardPrintpage($type)
		{   
			$passID=base64_decode($_REQUEST[ID]);
			if($type=='savecart')
			{
				$sql_customer_list="select s.id,s.save_cart_name,c.company_logo, s.shoppingcart_image,s.quantity,s.new_price,
		s.new_total,s.customer_price,s.customer_total,s.stock_custom,s.sku_code,s.sku_name,s.producttype,p.addtocart_heading,p.surcharges_message,p.additional_charge,s.custom_color_status,s.background_color,s.text_line,s.tag_configuration,s.mounting_option,s.make_fit,r.min_quantity_below
				from pm_shopping_cart s, pm_products_sku_description p, pm_customers c,pm_products_price r where s.customers_id=c.customers_id and p.sku_id=s.sku_id and s.cart_name='$passID' and s.shopping_save='Y' and s.customers_id=$_SESSION[CID] and p.active='Y' and r.active='Y' and r.user_type=s.user_type and r.material_code=p.material_code and r.producttype=s.producttype and r.min_quantity=r.quantity order by s.id asc";			
			}
			else if($type=='savequote')
			{	
				$sql_customer_list="select s.id,s.quote_name,c.company_logo, s.shoppingcart_image,s.quantity,s.new_price,s.new_total,s.customer_price,s.customer_total,s.stock_custom,s.sku_code,s.sku_name,s.producttype,p.addtocart_heading,p.surcharges_message,p.additional_charge,s.custom_color_status,s.background_color,s.text_line,s.tag_configuration,s.mounting_option,s.make_fit,r.min_quantity_below from pm_shopping_cart s, pm_products_sku_description p, pm_customers c,pm_products_price r where s.customers_id=c.customers_id and p.sku_id=s.sku_id and s.cart_name='$passID' and s.shopping_save='Q' and s.customers_id=$_SESSION[CID] and p.active='Y' and r.active='Y' and r.user_type=s.user_type and r.material_code=p.material_code and r.producttype=s.producttype and r.min_quantity=r.quantity and r.rep_special='$_SESSION[rep_special]' order by s.id asc";	
			}
			else if($type=='session')
			{	
				$sql_customer_list="select p.material_code,s.id,s.shoppingcart_image,s.quantity,s.new_price,
				s.new_total,s.customer_price,s.customer_total,s.stock_custom,s.sku_code,s.sku_name,s.producttype,p.addtocart_heading,p.surcharges_message,p.additional_charge,s.custom_color_status,s.background_color,s.text_line,s.tag_configuration,s.mounting_option,s.make_fit,r.min_quantity_below
				from pm_shopping_cart s, pm_products_sku_description p,pm_products_price r where p.sku_id=s.sku_id and s.session_id='".mysql_real_escape_string(session_id())."'  and s.shopping_save='N' and s.customers_id=$_SESSION[CID] and p.active='Y' and r.active='Y' and r.user_type=s.user_type and r.material_code=p.material_code and r.producttype=s.producttype and r.min_quantity=r.quantity order by s.id asc";				
				//print $sql_customer_list;
			}
			//print $sql_customer_list;			
			$customer_result=mysql_query($sql_customer_list);
			while($customer_row=mysql_fetch_array($customer_result))
			{
			$customer[]=$customer_row;
			}
			return $customer;				
		}
		function PmSavedelete($type)
		{
			if($type=='savecart')
			{
			$condition="Y";
			$this->PmDeleteCartAttributes($condition);
			$this->PmDeleteCustomFile($condition);
			$sql_delete="delete from pm_shopping_cart where cart_name ='$_REQUEST[delete]' and shopping_save='Y' and customers_id=$_SESSION[CID]";
			mysql_query($sql_delete);	
			}
			else if($type=='savequote')
			{
			$condition="Q";
			$this->PmDeleteCustomFile($condition);
			$this->PmDeleteCartAttributes($condition);	
			$sql_delete="delete from pm_shopping_cart where cart_name ='$_REQUEST[delete]' and shopping_save='Q' and customers_id=$_SESSION[CID]";	
			mysql_query($sql_delete);		
			//print $sql_delete;
			}
							
		}
	    
		function PmDeleteCartAttributes($condition)
		{
				$sql_cart_att="select * from pm_shopping_cart where cart_name='$_REQUEST[delete]' 
				and shopping_save='$condition' and customers_id=$_SESSION[CID]";
				$att_cart_result=mysql_query($sql_cart_att);
				while($att_row=mysql_fetch_array($att_cart_result))
				{				
				$sql_cart_delete_att="delete from pm_shopping_cart_attributes where s_id='".$att_row[id]."'";
 				$result=mysql_query($sql_cart_delete_att);
				}
		}
		function PmDeleteCustomFile($condition)
		{
				$sql_cart_att="select * from pm_shopping_cart where cart_name='$_REQUEST[delete]' 
				and shopping_save='$condition' and customers_id=$_SESSION[CID]";
				$att_cart_result=mysql_query($sql_cart_att);
				while($att_row=mysql_fetch_array($att_cart_result))
				{				
				$sql_cart_delete_att="delete from pm_customer_file_upload where s_id='".$att_row[id]."' and customer_id=$_SESSION[CID]";
 				$result=mysql_query($sql_cart_delete_att);
				}
		}		
		
		function PmSaveCompanyLogoList()
		{ 
			$sql_logo_list="select company_logo from pm_customers where customers_id = $_SESSION[CID]";
			
			$logo_result=mysql_query($sql_logo_list);
			while($logo_row=mysql_fetch_array($logo_result))
			{
				$logo=$logo_row['company_logo'];
			}
			return $logo;		
		}
		function uploadcompanylogo()
		{
			$width="";
			$height="";

				$error = "";
				$msg = "";
				$fileElementName = 'fileToUpload';
				

				if(!empty($_FILES[$fileElementName]['error']))
				{
					switch($_FILES[$fileElementName]['error'])
					{
			
						case '1':
							$error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
							break;
						case '2':
							$error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
							break;
						case '3':
							$error = 'The uploaded file was only partially uploaded';
							break;
						case '4':
							$error = 'No file was uploaded.';
							break;
			
						case '6':
							$error = 'Missing a temporary folder';
							break;
						case '7':
							$error = 'Failed to write file to disk';
							break;
						case '8':
							$error = 'File upload stopped by extension';
							break;
						case '999':
						default:
							$error = 'No error code avaiable';
					}
				}elseif(empty($_FILES['fileToUpload']['tmp_name']) || $_FILES['fileToUpload']['tmp_name'] == 'none')
				{
					$error = 'No file was uploaded..';
				}else 
				{
						$msg .= " File Name: " . $_FILES['fileToUpload']['name'] . ", ";
						$msg .= " File Size: " . @filesize($_FILES['fileToUpload']['tmp_name']);
						
						//for security reason, we force to remove all uploaded file
						 $filetype=$_FILES["fileToUpload"]["type"];	
						 $filename=$_FILES['fileToUpload']['name'];
									$typelength=strlen($filetype)-5;
									$imagetype=substr($filetype,6);		
						 $tempfilename=$_FILES['fileToUpload']['tmp_name'];
						 
						 //$uploadFilePath = WebSite.PathTemplatesCompanylogo.$filename;
						 $uploadFilePath = PathTemplatesCompanylogo.$filename;
						 list($width, $height,$type) = getimagesize($tempfilename);
						//$uploadFilePath='../images/companylogo/'.$filename;
						$uploadFilePath='../'.PathTemplatesCompanylogo.$filename;
						if ((($_FILES["fileToUpload"]["type"] == "image/gif")||($_FILES["fileToUpload"]["type"] == "image/pjpeg")||($_FILES["fileToUpload"]["type"] == "image/jpeg")||($_FILES["fileToUpload"]["type"] == "image/jpg")||($_FILES["fileToUpload"]["type"] == "image/png")||($_FILES["fileToUpload"]["type"] == "image/x-png")||($_FILES["fileToUpload"]["type"] == "image/x-citrix-png")||($_FILES["fileToUpload"]["type"] == "images/x-citrix-jpeg"))&&$width<=800 &&$height<=101)
						
						 //if(substr($filetype,0,5)=='image'&& $width<=800 &&$height<=101)
						 {
							 if($_FILES["fileToUpload"]["type"] == "image/pjpeg"||$_FILES["fileToUpload"]["type"] == "image/x-citrix-jpeg")
								//$uploadFilePath = WebSite.PathTemplatesCompanylogo.substr($filename, 0, strlen($filename)-5).'jpeg';
								$uploadFilePath = PathTemplatesCompanylogo.substr($filename, 0, strlen($filename)-5).'jpeg';
							 else if($_FILES["fileToUpload"]["type"] == "image/x-png"||$_FILES["fileToUpload"]["type"] == "image/x-citrix-png")
							 	//$uploadFilePath = WebSite.PathTemplatesCompanylogo.substr($filename, 0, strlen($filename)-5).'png';
								$uploadFilePath = PathTemplatesCompanylogo.substr($filename, 0, strlen($filename)-5).'png';
										   if (file_exists($uploadFilePath))
										   {
											  $purefilename=substr($filename,0,-$typelength);
											  $random_digit=rand(0000,9999);
											  $filename=$purefilename.$random_digit.date('Ynjhis').".".$imagetype;
										   }
	
					
						 $uploadFilePath='../'.PathTemplatesCompanylogo.$filename;
						  copy($_FILES['fileToUpload']['tmp_name'], $uploadFilePath);

						  //$msg=$filename;
						  $uploadFilePathorg=PathTemplatesCompanylogo.$filename;

								$this->updatecompanylogotofile($filename);	
						 
										if($height>40)
										{
											$new_height=40;
											$new_width=$width*40/$height;
										}							
										else if($width>239)
										 {
											 $new_width=239;
											 $new_height=$height*239/$width;
										 }
										else
										{
											$new_height=$height;
											$new_width=$width;
										}

						  }
						  else
						  {
						  	$error='E';
							$uploadFilePathorg='';
							$new_width='';
							$new_height='';
						  }
				}		
				echo "{";			
				echo				"logopath: '" . $uploadFilePathorg . "',\n";
				echo				"error: '" . $error . "',\n";
				echo				"width: '" . $new_width . "',\n";
				echo				"height: '" . $new_height . "'\n";
				
			echo "}";						

		}
	function updatecompanylogotofile($filename)
	{
		   $sql="update pm_customers set company_logo='$filename' where customers_id=$_SESSION[CID]";	
		    mysql_query($sql);		
	}
	function PmSavecreatepdfusingpdflib($type)
	{	
		$i=-1;
		$detail=$this->PmSaveShoppingCardPrintpage($type);
		$rowcount=count($detail);
		if($rowcount>0)
		{
			foreach($detail as $key => $detail_data)
			{
				$i++;
				if($detail_data['shoppingcart_image']!='')
					$multitable[$i][shoppingcart_image]= PathImgProductSkuShoppingCart.$detail_data['shoppingcart_image'];
				else
					$multitable[$i][shoppingcart_image]='';
				$multitable[$i][sku_code]= $detail_data['sku_code'];
				$multitable[$i][sku_name]= $detail_data['sku_name'];
				$multitable[$i][quantity]= $detail_data['quantity'];				
				$multitable[$i][new_price]= $detail_data['new_price'];
				$multitable[$i][new_total]= $detail_data['new_total'];
				$multitable[$i][addtocart_heading]= $detail_data['addtocart_heading'];
				$multitable[$i][company_logo]= $detail_data['company_logo'];
				$multitable[$i][background_color]= $detail_data['background_color'];
				$multitable[$i][stock_custom]= $detail_data['stock_custom'];
				$multitable[$i][customer_price]= $detail_data['customer_price'];
				$multitable[$i][customer_total]= $detail_data['customer_total'];
				$multitable[$i][mounting_option]= $detail_data['mounting_option'];
				$multitable[$i][make_fit]= $detail_data['make_fit'];
				$multitable[$i][additional_charge]= $detail_data['additional_charge'];
				$multitable[$i][surcharges_message]= $detail_data['surcharges_message'];
				$multitable[$i][min_quantity_below]= $detail_data['min_quantity_below'];
				$multitable[$i][id]= $detail_data['id'];
				if($multitable[$i][stock_custom]=='C')
				{
					if($detail_data['custom_color_status']=='Y')
					{
						$custom_image=$this->PMGetSearchCustomColorImage($detail_data['sku_code'],$detail_data['background_color']);
						$multitable[$i][shoppingcart_image]=PathImgProductSkuShoppingCart.$custom_image;
					}
				}
				$multitable[$i][text_line]= $detail_data['text_line'];
				$multitable[$i][tag_configuration]= $detail_data['tag_configuration'];				
			}	
		}

$searchpath = dirname(dirname(__FILE__)).'/data';

$imagefile = PathTemplatesCompanylogo.$multitable[0][company_logo];
$outfilename = "";
$tf=0; $tbl=0;
$rowmax = 150; $colmax = 5;
$llx= 45; //$lly=0; 
$urx=550; $ury=750;$lly=60;//$lly=40;//position and width height
$headertext = "Table header (centered across all columns)";

try {
    $p = new PDFlib();

    $p->set_parameter("errorpolicy", "return");

    $p->set_parameter("hypertextencoding", "winansi");

    $p->set_parameter("SearchPath", $searchpath);

    $p->set_parameter("textformat", "bytes");
	$p->set_parameter( "license", "L800202-010500-736644-HCY9G2-DQCS62" );
    if ($p->begin_document($outfilename, "") == 0) 
	{
		die("Error: " . $p->get_errmsg());
    } 
	$font = $p->load_font("Helvetica-Bold", "unicode", "");

	$optlist1 = "colwidth=30% rowheight=20 fittextline={font=" . $font . " fontsize=9.5 fillcolor={#003e71}}";//000666
	$optlist2 = "colwidth=40% fittextline={font=" . $font . " fontsize=9.5 fillcolor={#003e71}}";
	$optlist3 = "colwidth=9% fittextline={font=" . $font . " fontsize=9.5 fillcolor={#003e71}}";
	$optlist4 = "colwidth=10% fittextline={font=" . $font . " fontsize=9.5 fillcolor={#003e71}}";
	$optlist5 = "colwidth=11% fittextline={font=" . $font . " fontsize=9.5 fillcolor={#003e71}} ";
	$row=1;
	$tbl = $p->add_table_cell($tbl, 1, $row, 'Product Image', $optlist1);
	$tbl = $p->add_table_cell($tbl, 2, $row, ' Item Description And Size', $optlist2);
	$tbl = $p->add_table_cell($tbl, 3, $row, 'Quantity', $optlist3);
	$tbl = $p->add_table_cell($tbl, 4, $row, 'Unit Price', $optlist4);
	$tbl = $p->add_table_cell($tbl, 5, $row, 'Total Price', $optlist5);
	
	$font = $p->load_font("Helvetica", "unicode", "");
	$row=2;
	$firstcolo=25;
	$secondcolo=45;
   for ($row=2; $row <=($rowcount*2+1); $row++) 
   {
	   if($row%2==0)
	   {
		$userow=$row/2-1;
		$oddrowheight=36;
		for ($col = 1; $col <= $colmax; $col++) 
		{
			if($col==1)
			{				
															
								$imagefile1=$multitable[$userow][shoppingcart_image];
								if (file_exists($imagefile1))
								{
									$image = $p->load_image("auto", $imagefile1, "");
									if ($image == 0) 
									{
										die("Couldn't load $image: " . $p->get_errmsg());
									}
									$optlist = "image=" . $image." margin=3 fittextline={font=" . $font . " fontsize=9} ";																	
								}
									$num='';
									$tbl = $p->add_table_cell($tbl, $col, $row, $num, $optlist);						
					if ($tbl == 0) {
					die("Error: " . $p->get_errmsg());
					}	
			}
			else if($col==2)
			{
				 $tf=0;		
					$optlist = "charref fontname=Helvetica encoding=unicode fontsize=9 ";
					$printadditionaltext='';
					$printadditionalchargetext='';
					if($multitable[$userow][additional_charge]!='')
					{
						  $printadditionalchargetext = "\n".$multitable[$userow][surcharges_message];
					}
					if($multitable[$userow][min_quantity_below]>$multitable[$userow][quantity])
					{
						$printadditionalchargetext = "\n".$multitable[$userow][surcharges_message];
					}
					if($multitable[$userow][stock_custom]=="C")
					{
						$customproduct_shopping_cart=$this->PMsaveLoadCustomNameplateDetails($multitable[$userow][id]);
						if($multitable[$userow][text_line]!='')
						{
							$printadditionaltext.="\n".Textsize_Label.":".$multitable[$userow][text_line]; 		
						}
						if($multitable[$userow][tag_configuration]=='S')
						{
							$printadditionaltext.= "\n"."Single: Range"; 		
						}
						if($multitable[$userow][tag_configuration]=='R')
						{
							$printadditionaltext.= "\n"."Multiple: Range"; 		
						}
						$colorlabel=Color_Label;
						$mountingoptionlabel=Mountingoption_Label;
						if($multitable[$userow][mounting_option]!='')
							$printadditionaltext.= "\n".$mountingoptionlabel.":".$multitable[$userow][mounting_option]; 
						if($multitable[$userow][background_color]!='')
							$printadditionaltext.= "\n".$colorlabel.":".$multitable[$userow][background_color]; 
						if($multitable[$userow][make_fit]=='Y')
							$printadditionaltext.= "\n"."Copy to fit:Active"; 
						if(sizeof($customproduct_shopping_cart)>0)
						{	
						   foreach($customproduct_shopping_cart  as $key => $customproduct_att_value)
						   {
							if($customproduct_att_value['option_label1']!=''&& $customproduct_att_value['option_value1']!='')
							  $printadditionaltext.= "\n".$customproduct_att_value['option_label1'].":".$customproduct_att_value['option_value1'];      
							if($customproduct_att_value['option_label2']!=''&& $customproduct_att_value['option_value2']!=''&&$multitable[$userow][make_fit]!='Y')
							  $printadditionaltext.= "\n".$customproduct_att_value['option_label2'].":".$customproduct_att_value['option_value2'];    
							if($customproduct_att_value['option_label3']!=''&& $customproduct_att_value['option_value3']!='')
							  $printadditionaltext.= "\n".$customproduct_att_value['option_label3'].":".$customproduct_att_value['option_value3'];
							if($customproduct_att_value['option_label4']!=''&& $customproduct_att_value['option_value4'][0]!='')
							  $printadditionaltext.= "\n".$customproduct_att_value['option_label4'].":".$customproduct_att_value['option_value4']; 
						   }// end of foreach loop
						}//end of size of condition						
					}
					$tf = $p->add_textflow($tf, $multitable[$userow][sku_code]."\n", $optlist);
					$tf = $p->add_textflow($tf, $multitable[$userow][sku_name], $optlist);
					$optlistaddcharge='charref fontname=Helvetica encoding=unicode fontsize=9 fillcolor={rgb 1 0 0}';
					$tf = $p->add_textflow($tf, $printadditionalchargetext, $optlistaddcharge);
					$optlist = "charref fontname=Helvetica encoding=unicode fontsize=9 fillcolor={#010101}";
					$tf = $p->add_textflow($tf, $printadditionaltext, $optlist);

					if ($tf == 0) {
					die("Error: " . $p->get_errmsg());
					}
				
					$optlist = "colwidth=".$secondcolo."% rowheight=14 margin=4 rowspan=2 textflow=" . $tf;
				
					$tbl = $p->add_table_cell($tbl, $col, $row, "", $optlist);
					if ($tbl == 0) {
					die("Error: " . $p->get_errmsg());
					}					
			}
			else if($col==3)
			{
					$num= $multitable[$userow][quantity];
					$optlist = "colwidth=9% rowheight=".$oddrowheight." rowspan=2 fittextline={font=" . $font . " fontsize=9 position={center}}";
				
					$tbl = $p->add_table_cell($tbl, $col, $row, $num, $optlist);
					if ($tbl == 0) {
					die("Error: " . $p->get_errmsg());
					}
				
			}
			else if($col==4)
			{
					if($_SESSION[user_type]=='R')
						$num= $multitable[$userow][customer_price];
					else
						$num= $multitable[$userow][new_price];
					$num=$this->numberround($num,2);
					$num=number_format($num,2);
					$optlist = "colwidth=10% rowheight=".$oddrowheight." rowspan=2 fittextline={font=" . $font . " fontsize=9}";		
				
					$tbl = $p->add_table_cell($tbl, $col, $row, '$'.$num, $optlist);
					if ($tbl == 0) {
					die("Error: " . $p->get_errmsg());
					}
			}
			else
			{
								if($_SESSION[user_type]=='R')
								{
									$num= $multitable[$userow][customer_total];
									$totalprice=$totalprice+$multitable[$userow][customer_total];
								}
								else
								{
									$num= $multitable[$userow][new_total];
									$totalprice=$totalprice+$multitable[$userow][new_total];
								}
								$num=$this->numberround($num,2);
								$num=number_format($num,2);
								$optlist = "colwidth=11% rowheight=".$oddrowheight." rowspan=2 fittextline={font=" . $font . " fontsize=9}";	
				
					$tbl = $p->add_table_cell($tbl, $col, $row, '$'.$num, $optlist);
					if ($tbl == 0) {
					die("Error: " . $p->get_errmsg());
					}
			}
		}
   	  }
	  else
	  {
		$userow=($row-1)/2-1;
		for ($col = 1; $col <= $colmax; $col++) 
		{
			if($col==1)
			{
				 $tf=0;
					if ($font == 0) {
					die("Error: " . $p->get_errmsg());
					}
				
					$optlist = "charref fontname=Helvetica encoding=unicode fontsize=9";
				
					$tf = $p->add_textflow($tf, $multitable[$userow][addtocart_heading], $optlist);	
	
					if ($tf == 0) {
					die("Error: " . $p->get_errmsg());
					}
				
					$optlist = "colwidth=".$firstcolo."% margin=4 textflow=" . $tf;
				
					$tbl = $p->add_table_cell($tbl, $col, $row, "", $optlist);
					if ($tbl == 0) {
					die("Error: " . $p->get_errmsg());
					}							
			}
		}
	  	
	  }
   }
					$optlist = "rowheight=36 colspan=2 margin=4 fittextline={font=" . $font . " fontsize=9.5 }";		
					$tbl = $p->add_table_cell($tbl, 1, ($rowcount*2+2), '*Subtotal does not include shipping or tax', $optlist);
					if ($tbl == 0) {
					die("Error: " . $p->get_errmsg());
					}   
   						$subtotalfont = $p->load_font("Helvetica-Bold", "unicode", "");
								$totalprice=$this->numberround($totalprice,2);
								$totalprice=number_format($totalprice,2);
					$optlist = "rowheight=36 colspan=3 margin=4 fittextline={font=" . $subtotalfont . " fontsize=11}";		
			$optlist=$optlist." matchbox={innerbox borderwidth=1 strokecolor={#0099ff} "."linecap=projecting}";
					$tbl = $p->add_table_cell($tbl,3, ($rowcount*2+2), '*Subtotal items:$'.$totalprice, $optlist);
					if ($tbl == 0) {
					die("Error: " . $p->get_errmsg());
					}

	
	
		$tf=0;
	
		$p->begin_page_ext(0, 0, "width=a4.width height=a4.height");
		
		$cart=$this->getquotecartinfo($type);//can replace
		if($_SESSION[user_type]=='R')
		{
			  $shipping=$this->shoppingcartaddressinfo();
	  		  if(count($shipping)>0)
			  {
				  if($shipping[shipping_street_address]!='')
				  {
					  if($shipping[shipping_city]!='')
						  $shipping[shipping_city]=", ".$shipping[shipping_city];
					  if($shipping[shipping_state]!='')
						  $shipping[shipping_state]=", ".$shipping[shipping_state];
					  
					  if($shipping[shipping_phone]=='')
					  {
						  $shipping_address= $shipping[shipping_street_address]." ".$shipping[shipping_suburb].$shipping[shipping_city].$shipping[shipping_state]." ".$shipping[shipping_postcode];			
					  }
					  else
					  {
						  $shipping_address= $shipping[shipping_street_address]." ".$shipping[shipping_suburb].$shipping[shipping_city].$shipping[shipping_state]." ".$shipping[shipping_postcode]."    |    Phone: ".$shipping[shipping_phone];			
					  }
				  }
				  else
				  {
					  if($shipping[shipping_state]!='')
						  $shipping[shipping_state]=", ".$shipping[shipping_state];
						  
					  if($shipping[shipping_phone]=='')
					  {					
						  if($shipping[shipping_suburb]!='')
						  {	
							  if($shipping[shipping_city]!='')
								  $shipping[shipping_city]=", ".$shipping[shipping_city];
							  
							  $shipping_address= $shipping[shipping_suburb].$shipping[shipping_city].$shipping[shipping_state]." ".$shipping[shipping_postcode];
						  }
						  else
							  $shipping_address= $shipping[shipping_city].$shipping[shipping_state]." ".$shipping[shipping_postcode];
					  }
					  else
					  {
						  if($shipping[shipping_suburb]!='')
						  {
							  if($shipping[shipping_city]!='')
								  $shipping[shipping_city]=", ".$shipping[shipping_city];
								  
							  $shipping_address= $shipping[shipping_suburb].$shipping[shipping_city].$shipping[shipping_state]." ".$shipping[shipping_postcode]."    |    Phone: ".$shipping[shipping_phone];
						  }
						  else
							  $shipping_address= $shipping[shipping_city].$shipping[shipping_state]." ".$shipping[shipping_postcode]."    |    Phone: ".$shipping[shipping_phone];
					  }			
				  }				  	
			  }
		}
	  if($_SESSION[user_type]=='R')
	  {
			  if($multitable[0][company_logo]!='')
			  {
				$imagefile = PathTemplatesCompanylogo.$multitable[0][company_logo];
			  }
			  else
			  {
				 $imagefile = PathTemplatesCompanylogo."PipeLogo.gif";
			  }
			  $move=0;
			  if (file_exists($imagefile))
			  {
					 $image = $p->load_image("auto", $imagefile, "");
						list($width,$height)=getimagesize($imagefile);
						if ($image == 0) {
						die("Error: " .  $p->get_errmsg());
						}
						$p->setfont($font, 12);
						$startx=48;
						if($width>500)
						{
							$bw=500;
							$bh=$height*500/$width;
							if($bh>70)
							{
								//$bw=$bw*70/$bh;
								//$bh=70;
								$move=$bh-70;
							   $lly=$lly-$move;
							   $ury=$ury-$move;		
							}
						}
						else if($height>70)
						{
							//$bh=70;
							//$bw=$width*70/$height;
							$move=$height-70;
						  $lly=$lly-$move;
						  $ury=$ury-$move;					
						}
						else 
						{
							$bw=$width;
							$bh=$height;
						}
					$p->fit_image($image, $startx, 768-$move, "boxsize={" . $bw . " " . $bh . "} position={top} fitmethod=entire");
					//$p->fit_image($image, $startx, 760, "boxsize={" . "20" . " " . "20" . "} position={top} fitmethod=entire");
			  }
	 
		  if($type=='savequote')
		  {
			  $infofont = $p->load_font("Helvetica-Bold", "unicode", "");
			  $p->setfont($infofont, 9.5);
			  if($shipping[shipping_company]!=''&&$shipping_address!=' ')//one white space
			  {
				  //$p->fit_textline($shipping[shipping_company]."    |    ".$shipping_address, $startx, 748-$move, "fillcolor={#003e71} ");			  
				  $shipping_address=$shipping[shipping_company]."    |    ".$shipping_address;
				  $addresslength=strlen($shipping_address);
				  $startx=$startx-($addresslength*0.125+10.125);
				  $p->fit_textline($shipping_address, $startx, 758-$move, "position={center} fillcolor={#003e71} boxsize={550 10}");//48
				 
				  $lly=$lly-20;
				  $ury=$ury-20;
			  }
			  else if($shipping[shipping_company]!='')
			  {
				  $p->fit_textline($shipping[shipping_company], $startx, 735-$move, "fillcolor={#003e71} position={center}");			  
				  //$p->fit_textline($shipping_address, $startx, 723, "");
				  $lly=$lly-25;
				  $ury=$ury-25;				  
			  }
			  else if($shipping_address!=' ')//one white space
			  {
				  //$p->fit_textline($shipping[shipping_company], $startx, 740, "");			  
				  $p->fit_textline($shipping_address, $startx, 735-$move, "fillcolor={#003e71} ");
				  $lly=$lly-25;
				  $ury=$ury-25;				  	
			  }
			  else
			  {
				  $lly=$lly-8;
				  $ury=$ury-8;					  
			  }
			  $titlefont = $p->load_font("Helvetica-Bold", "unicode", "");
			  $p->setfont($titlefont, 19);
			  $quotetext="Quote#:".$cart[quote_name];
			  //$quotelength=strlen($quotetext);
			  $startx=250-$quotelength;
			  $p->fit_textline($quotetext, $startx, 740-$move, "position={left} fillcolor={#003e71} boxsize={550 10}");			  		  
		  }
	  }
	  else//user
	  {
	  	   $imagefile = PathTemplatesCompanylogo."PipeLogo.gif";
		   $move=0;
			  if (file_exists($imagefile))
			  {
					 $image = $p->load_image("auto", $imagefile, "");
						list($width,$height)=getimagesize($imagefile);
						if ($image == 0) {
						die("Error: " .  $p->get_errmsg());
						}
					$p->setfont($font, 12);
						$startx=48;
						
						if($width>550)
						{
							$bw=550;
							$bh=$height*550/$width;
							if($bh>70)
							{
								$move=$bh-70;
							   $lly=$lly-$move;
							   $ury=$ury-$move;								
							}
						}
						else if($height>70)
						{
								$move=$height-70;
							   $lly=$lly-$move;
							   $ury=$ury-$move;		
						}
						else 
						{
							$bw=$width;
							$bh=$height;	
						}
					$p->fit_image($image, $startx, 760-$move, "boxsize={" . $bw . " " . $bh . "} position={top} fitmethod=entire");
			  }
			   if($type=='savecart')
			   {
				  $titlefont = $p->load_font("Helvetica-Bold", "unicode", "");
				  $p->setfont($titlefont, 9.5);
				  //$quotetext=" Shopping Cart Name:".$cart[save_cart_name];
				  //$p->fit_textline($quotetext, $startx, 746, "fillcolor={#003e71} ");
				  $p->fit_textline(' P.O. Box 467 / 64 Outwater Lane, Garfield NJ 07026', $startx+138, 749-$move, "fillcolor={#003e71} ");
				  $p->fit_textline(' 9:00 a.m. to 5:00 p.m. EST                  |                 Phone: 800.274.6271                 |                 Fax No: 800.279.6897', $startx, 731-$move, "fillcolor={#003e71} ");
				  $lly=$lly-28;
				  $ury=$ury-28;				   
			   }
	  }
	$optlist = "header=0 fill={{area=row1 fillcolor={#f2f2f2 }}} " ."stroke={{line=hor0 strokecolor={#ebebeb} linewidth=0.5} ";
	for ($k=1;$k<=($rowcount*2+1);$k+=2)
	{
		$optlist=$optlist."{line=hor".$k." strokecolor={#ebebeb} linewidth=0.5} ";//gray 0.9
	}
	$k=$k-1;
	$optlist=$optlist."{line=hor".$k." strokecolor={#ebebeb} linewidth=0.5} ";
	
	$optlist=$optlist."{line=vertother strokecolor={#ebebeb} linewidth=0.5}}";
/*$row=$rowcount*2+2;
for ($row++; $row <= $rowmax; $row++) {
	for ($col = 1; $col <= $colmax; $col++) {
	    $num = "Col " . $col . "/Row " . $row;
		
		if($col%5==1)
		{
		    //$optlist = "colwidth=30% fittextline={font=" . $font . " fontsize=10}";
		}
		else if($col%5==2)
			$optlist1 = "colwidth=40% fittextline={font=" . $font . " fontsize=10}";
	    else if($col%5==3)
			$optlist1 = "colwidth=9% fittextline={font=" . $font . " fontsize=10}";
	    else if($col%5==4)
			$optlist1 = "colwidth=10% fittextline={font=" . $font . " fontsize=10}";			
	    else
			$optlist1 = "colwidth=11% fittextline={font=" . $font . " fontsize=10}";	
			
		$tbl = $p->add_table_cell($tbl, $col, $row, $num, $optlist1);
	    if ($tbl == 0) {
		die("Error: " . $p->get_errmsg());
	    }
	}
    }*/
	//$result = $p->fit_table($tbl, $llx, $lly, $urx, $ury, $optlist);
	$result = $p->fit_table($tbl, $llx, $lly, $urx, $ury, $optlist);
	if ($result ==  "_error") 
	{
	    die("Couldn't place table: " . $p->get_errmsg());
	}
	
	if($result == "_boxfull")
    do {
			$p->end_page_ext("");
			$p->begin_page_ext(0, 0, "width=a4.width height=a4.height");




			$llx= 45; $lly=50; $urx=550; $ury=800;
			$result = $p->fit_table($tbl, $llx, $lly, $urx, $ury, $optlist);
			if ($result ==  "_error") 
			{
				die("Couldn't place table: " . $p->get_errmsg());
			}


    } while ($result == "_boxfull");
	//$font = $p->load_font("Helvetica", "unicode", "");	
 	$p->end_page_ext(""); 
    if ($result != "_stop") 
	{		
		if ($result ==  "_error") 
		{
	    	die("Error when placing table: " . $p->get_errmsg());
		} 
		else 
		{
	    	die("User return found in Textflow");
		}
    }

    $p->delete_table($tbl, "");

    $p->end_document("");
	

    $buf = $p->get_buffer();
    $len = strlen($buf);

	header("Content-type: application/pdf");
    header("Content-Length: $len");
	header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Content-Disposition: inline; filename=starter_table.pdf");
	ob_end_clean();
    print $buf;
	$p->PDF_delete();

}
catch (PDFlibException $e) {
    die("PDFlib exception occurred in starter_table sample:\n" .
	"[" . $e->get_errnum() . "] " . $e->get_apiname() . ": " .
	$e->get_errmsg() . "\n");
}
catch (Exception $e) {
    die($e);
}



	}
	function getusernamefromcustomer()
	{
		  $sql_email_list="select username from pm_customers where customers_id=$_SESSION[CID]";			
		  $email_result=mysql_query($sql_email_list);
		  while($email_row=mysql_fetch_array($email_result))
		  {
			  $email[username]=$email_row['username'];
		  }	
		  return $email[username];
	}
	function PmSavecreateShoppingCardemailPDFusingpdflib($type,$to,$from,$subject,$message,$recipient_name,$sender_name)
	{
			$passID=base64_decode($_REQUEST[ID]);		
			
			/*$sql_email_list="select username from pm_customers where customers_id=$_SESSION[CID]";			
			$email_result=mysql_query($sql_email_list);
			while($email_row=mysql_fetch_array($email_result))
			{
				$email[username]=$email_row['username'];
			}*/
			
			//$to = $this->getusernamefromcustomer();
			$eol = PHP_EOL;
			//$from=Web_Sales_Email;	
			if($type!='session')
			{
				$i=-1;
				$detail=$this->PmSaveShoppingCardPrintpage($type);
				$rowcount=count($detail);
				if($rowcount>0)
				{
					foreach($detail as $key => $detail_data)
					{
						$i++;
						if($detail_data['shoppingcart_image']!='')
							$multitable[$i][shoppingcart_image]= PathImgProductSkuShoppingCart.$detail_data['shoppingcart_image'];
						else
							$multitable[$i][shoppingcart_image]='';
						$multitable[$i][sku_code]= $detail_data['sku_code'];
						$multitable[$i][sku_name]= $detail_data['sku_name'];
						$multitable[$i][quantity]= $detail_data['quantity'];				
						$multitable[$i][new_price]= $detail_data['new_price'];
						$multitable[$i][new_total]= $detail_data['new_total'];
						$multitable[$i][addtocart_heading]= $detail_data['addtocart_heading'];
						$multitable[$i][company_logo]= $detail_data['company_logo'];
						$multitable[$i][background_color]= $detail_data['background_color'];
						$multitable[$i][stock_custom]= $detail_data['stock_custom'];
						$multitable[$i][customer_price]= $detail_data['customer_price'];
						$multitable[$i][customer_total]= $detail_data['customer_total'];
						$multitable[$i][mounting_option]= $detail_data['mounting_option'];
						$multitable[$i][make_fit]= $detail_data['make_fit'];
						$multitable[$i][additional_charge]= $detail_data['additional_charge'];
						$multitable[$i][surcharges_message]= $detail_data['surcharges_message'];
						$multitable[$i][min_quantity_below]= $detail_data['min_quantity_below'];
						$multitable[$i][id]= $detail_data['id'];
						if($multitable[$i][stock_custom]=='C')
						{
							if($detail_data['custom_color_status']=='Y')
							{
								$custom_image=$this->PMGetSearchCustomColorImage($detail_data['sku_code'],$detail_data['background_color']);
								$multitable[$i][shoppingcart_image]=PathImgProductSkuShoppingCart.$custom_image;
							}
						}
						$multitable[$i][text_line]= $detail_data['text_line'];
						$multitable[$i][tag_configuration]= $detail_data['tag_configuration'];				
					}	
				}
		
		$searchpath = dirname(dirname(__FILE__)).'/data';
		
		$imagefile = PathTemplatesCompanylogo.$multitable[0][company_logo];
		$outfilename = "";
		
		$tf=0; $tbl=0;
		$rowmax = 150; $colmax = 5;
		
		$llx= 45;$urx=550; $ury=750;$lly=60;//position and width height
		$headertext = "Table header (centered across all columns)";
		
		try {
			$p = new PDFlib();
		
			$p->set_parameter("errorpolicy", "return");
		
			$p->set_parameter("hypertextencoding", "winansi");
		
		
			$p->set_parameter("SearchPath", $searchpath);
		
			$p->set_parameter("textformat", "bytes");
			$p->set_parameter( "license", "L800202-010500-736644-HCY9G2-DQCS62" );
			if ($p->begin_document($outfilename, "") == 0) 
			{
				die("Error: " . $p->get_errmsg());
			}
			 
			$font = $p->load_font("Helvetica-Bold", "unicode", "");
			
			$optlist1 = "colwidth=30% rowheight=20 fittextline={font=" . $font . " fontsize=9.5 fillcolor={#003e71}}";//000666
			$optlist2 = "colwidth=40% fittextline={font=" . $font . " fontsize=9.5 fillcolor={#003e71}}";
			$optlist3 = "colwidth=9% fittextline={font=" . $font . " fontsize=9.5 fillcolor={#003e71}}";
			$optlist4 = "colwidth=10% fittextline={font=" . $font . " fontsize=9.5 fillcolor={#003e71}}";
			$optlist5 = "colwidth=11% fittextline={font=" . $font . " fontsize=9.5 fillcolor={#003e71}} ";
			$row=1;
			$tbl = $p->add_table_cell($tbl, 1, $row, 'Product Image', $optlist1);
			$tbl = $p->add_table_cell($tbl, 2, $row, ' Item Description And Size', $optlist2);
			$tbl = $p->add_table_cell($tbl, 3, $row, 'Quantity', $optlist3);
			$tbl = $p->add_table_cell($tbl, 4, $row, 'Unit Price', $optlist4);
			$tbl = $p->add_table_cell($tbl, 5, $row, 'Total Price', $optlist5);
			
			$font = $p->load_font("Helvetica", "unicode", "");
			$row=2;
		
	$firstcolo=25;
	$secondcolo=45;
   for ($row=2; $row <=($rowcount*2+1); $row++) 
   {
	   if($row%2==0)
	   {
		$userow=$row/2-1;
		$oddrowheight=36;
		for ($col = 1; $col <= $colmax; $col++) 
		{
			if($col==1)
			{																	
					$imagefile1=$multitable[$userow][shoppingcart_image];
					if (file_exists($imagefile1))
					{
						$image = $p->load_image("auto", $imagefile1, "");
						if ($image == 0) 
						{
							die("Couldn't load $image: " . $p->get_errmsg());
						}
						$optlist = "image=" . $image." margin=3 fittextline={font=" . $font . " fontsize=9} ";																	
					}
						$num='';
									$tbl = $p->add_table_cell($tbl, $col, $row, $num, $optlist);						
					if ($tbl == 0) {
					die("Error: " . $p->get_errmsg());
					}	
			}
			else if($col==2)
			{
				 $tf=0;
					$optlist = "charref fontname=Helvetica encoding=unicode fontsize=9 ";
					$printadditionaltext='';
					$printadditionalchargetext='';
					if($multitable[$userow][additional_charge]!='')
					{
						  $printadditionalchargetext = "\n".$multitable[$userow][surcharges_message];
					}
					if($multitable[$userow][min_quantity_below]>$multitable[$userow][quantity])
					{
						$printadditionalchargetext = "\n".$multitable[$userow][surcharges_message];
					}
					if($multitable[$userow][stock_custom]=="C")
					{
						$customproduct_shopping_cart=$this->PMsaveLoadCustomNameplateDetails($multitable[$userow][id]);
						if($multitable[$userow][text_line]!='')
						{
							$printadditionaltext.="\n".Textsize_Label.":".$multitable[$userow][text_line]; 		
						}
						if($multitable[$userow][tag_configuration]=='S')
						{
							$printadditionaltext.= "\n"."Single: Range"; 		
						}
						if($multitable[$userow][tag_configuration]=='R')
						{
							$printadditionaltext.= "\n"."Multiple: Range"; 		
						}
						$colorlabel=Color_Label;
						$mountingoptionlabel=Mountingoption_Label;
						if($multitable[$userow][mounting_option]!='')
							$printadditionaltext.= "\n".$mountingoptionlabel.":".$multitable[$userow][mounting_option]; 
						if($multitable[$userow][background_color]!='')
							$printadditionaltext.= "\n".$colorlabel.":".$multitable[$userow][background_color]; 
						if($multitable[$userow][make_fit]=='Y')
							$printadditionaltext.= "\n"."Copy to fit:Active"; 
						if(sizeof($customproduct_shopping_cart)>0)
						{	
						   foreach($customproduct_shopping_cart  as $key => $customproduct_att_value)
						   {
							if($customproduct_att_value['option_label1']!=''&& $customproduct_att_value['option_value1']!='')
							  $printadditionaltext.= "\n".$customproduct_att_value['option_label1'].":".$customproduct_att_value['option_value1'];      
							if($customproduct_att_value['option_label2']!=''&& $customproduct_att_value['option_value2']!=''&&$multitable[$userow][make_fit]!='Y')
							  $printadditionaltext.= "\n".$customproduct_att_value['option_label2'].":".$customproduct_att_value['option_value2'];    
							if($customproduct_att_value['option_label3']!=''&& $customproduct_att_value['option_value3']!='')
							  $printadditionaltext.= "\n".$customproduct_att_value['option_label3'].":".$customproduct_att_value['option_value3'];
							if($customproduct_att_value['option_label4']!=''&& $customproduct_att_value['option_value4'][0]!='')
							  $printadditionaltext.= "\n".$customproduct_att_value['option_label4'].":".$customproduct_att_value['option_value4']; 
						   }// end of foreach loop
						}//end of size of condition						
					}
					$tf = $p->add_textflow($tf, $multitable[$userow][sku_code]."\n", $optlist);
					$tf = $p->add_textflow($tf, $multitable[$userow][sku_name], $optlist);
					$optlistaddcharge='charref fontname=Helvetica encoding=unicode fontsize=9 fillcolor={rgb 1 0 0}';
					//"fontname=Helvetica-Bold fontsize=14 encoding=unicode fillcolor={rgb 1 0 0} charref";
					$tf = $p->add_textflow($tf, $printadditionalchargetext, $optlistaddcharge);
					$optlist = "charref fontname=Helvetica encoding=unicode fontsize=9 fillcolor={#010101}";
					$tf = $p->add_textflow($tf, $printadditionaltext, $optlist);

					if ($tf == 0) {
					die("Error: " . $p->get_errmsg());
					}
				
					$optlist = "colwidth=".$secondcolo."% rowheight=14 margin=4 rowspan=2 textflow=" . $tf;
				
					$tbl = $p->add_table_cell($tbl, $col, $row, "", $optlist);
					if ($tbl == 0) {
					die("Error: " . $p->get_errmsg());
					}				
			}
			else if($col==3)
			{
					  $num= $multitable[$userow][quantity];
					  $optlist = "colwidth=9% rowheight=".$oddrowheight." rowspan=2 fittextline={font=" . $font . " fontsize=9 position={center}}";
				
					$tbl = $p->add_table_cell($tbl, $col, $row, $num, $optlist);
					if ($tbl == 0) {
					die("Error: " . $p->get_errmsg());
					}
				
			}
			else if($col==4)
			{
								if($_SESSION[user_type]=='R')
									$num= $multitable[$userow][customer_price];
								else
									$num= $multitable[$userow][new_price];
								$num=$this->numberround($num,2);
								$num=number_format($num,2);
								$optlist = "colwidth=10% rowheight=".$oddrowheight." rowspan=2 fittextline={font=" . $font . " fontsize=9}";		
				
					$tbl = $p->add_table_cell($tbl, $col, $row, '$'.$num, $optlist);
					if ($tbl == 0) {
					die("Error: " . $p->get_errmsg());
					}
			}
			else
			{
								if($_SESSION[user_type]=='R')
								{
									$num= $multitable[$userow][customer_total];
									$totalprice=$totalprice+$multitable[$userow][customer_total];
								}
								else
								{
									$num= $multitable[$userow][new_total];
									$totalprice=$totalprice+$multitable[$userow][new_total];
								}
								$num=$this->numberround($num,2);
								$num=number_format($num,2);
								$optlist = "colwidth=11% rowheight=".$oddrowheight." rowspan=2 fittextline={font=" . $font . " fontsize=9}";	
				
					$tbl = $p->add_table_cell($tbl, $col, $row, '$'.$num, $optlist);
					if ($tbl == 0) {
					die("Error: " . $p->get_errmsg());
					}
			}
		}
   	  }
	  else
	  {
		$userow=($row-1)/2-1;
		for ($col = 1; $col <= $colmax; $col++) 
		{
			if($col==1)
			{
				 $tf=0;
					//$font = $p->load_font("Helvetica", "unicode", "");
					$optlist = "charref fontname=Helvetica encoding=unicode fontsize=9";
				
					$tf = $p->add_textflow($tf, $multitable[$userow][addtocart_heading], $optlist);	
	
					if ($tf == 0) {
					die("Error: " . $p->get_errmsg());
					}
				
					$optlist = "colwidth=".$firstcolo."% rowheight=14 margin=4 textflow=" . $tf;
				
					$tbl = $p->add_table_cell($tbl, $col, $row, "", $optlist);
					if ($tbl == 0) {
					die("Error: " . $p->get_errmsg());
					}				
			}
		}
	  	
	  }
   }
							$optlist = "rowheight=36 colspan=2 margin=4 fittextline={font=" . $font . " fontsize=9.5 }";		
					
							$tbl = $p->add_table_cell($tbl, 1, ($rowcount*2+2), '*Subtotal does not include shipping or tax', $optlist);
							if ($tbl == 0) {
							die("Error: " . $p->get_errmsg());
							}   
								$subtotalfont = $p->load_font("Helvetica-Bold", "unicode", "");
										$totalprice=$this->numberround($totalprice,2);	
										$totalprice=number_format($totalprice,2);
							$optlist = "rowheight=36 colspan=3 margin=4 fittextline={font=" . $subtotalfont . " fontsize=11}";		
					$optlist=$optlist." matchbox={innerbox borderwidth=1 strokecolor={#0099ff} "."linecap=projecting}";
							$tbl = $p->add_table_cell($tbl,3, ($rowcount*2+2), '*Subtotal items:$'.$totalprice, $optlist);
							if ($tbl == 0) {
							die("Error: " . $p->get_errmsg());
							}
		
			
			
				$tf=0;
			
				$p->begin_page_ext(0, 0, "width=a4.width height=a4.height");
		
		$cart=$this->getquotecartinfo($type);
		if($_SESSION[user_type]=='R')
		{
			$shipping=$this->shoppingcartaddressinfo();
			if(count($shipping)>0)
			{
				if($shipping[shipping_street_address]!='')
				{
					if($shipping[shipping_city]!='')
						$shipping[shipping_city]=", ".$shipping[shipping_city];
					if($shipping[shipping_state]!='')
						$shipping[shipping_state]=", ".$shipping[shipping_state];
					
					if($shipping[shipping_phone]=='')
					{
						$shipping_address= $shipping[shipping_street_address]." ".$shipping[shipping_suburb].$shipping[shipping_city].$shipping[shipping_state]." ".$shipping[shipping_postcode];			
					}
					else
					{
						$shipping_address= $shipping[shipping_street_address]." ".$shipping[shipping_suburb].$shipping[shipping_city].$shipping[shipping_state]." ".$shipping[shipping_postcode]."    |    Phone: ".$shipping[shipping_phone];			
					}
				}
				else
				{
					if($shipping[shipping_state]!='')
						$shipping[shipping_state]=", ".$shipping[shipping_state];
						
					if($shipping[shipping_phone]=='')
					{					
						if($shipping[shipping_suburb]!='')
						{	
							if($shipping[shipping_city]!='')
								$shipping[shipping_city]=", ".$shipping[shipping_city];
							
							$shipping_address= $shipping[shipping_suburb].$shipping[shipping_city].$shipping[shipping_state]." ".$shipping[shipping_postcode];
						}
						else
							$shipping_address= $shipping[shipping_city].$shipping[shipping_state]." ".$shipping[shipping_postcode];
					}
					else
					{
						if($shipping[shipping_suburb]!='')
						{
							if($shipping[shipping_city]!='')
								$shipping[shipping_city]=", ".$shipping[shipping_city];
								
							$shipping_address= $shipping[shipping_suburb].$shipping[shipping_city].$shipping[shipping_state]." ".$shipping[shipping_postcode]."    |    Phone: ".$shipping[shipping_phone];
						}
						else
							$shipping_address= $shipping[shipping_city].$shipping[shipping_state]." ".$shipping[shipping_postcode]."    |    Phone: ".$shipping[shipping_phone];
					}			
				}
			}
		}
	  if($_SESSION[user_type]=='R')
	  {
			  if($multitable[0][company_logo]!='')
			  {
				$imagefile = PathTemplatesCompanylogo.$multitable[0][company_logo];
			  }
			  else
			  {
				 $imagefile = PathTemplatesCompanylogo."PipeLogo.gif";
			  }
			  $move=0;
			  if (file_exists($imagefile))
			  {
					 $image = $p->load_image("auto", $imagefile, "");
						list($width,$height)=getimagesize($imagefile);
						if ($image == 0) {
						die("Error: " .  $p->get_errmsg());
						}
						$p->setfont($font, 12);
						$startx=48;
						if($width>500)
						{
							$bw=500;
							$bh=$height*500/$width;
							if($bh>70)
							{
								//$bw=$bw*70/$bh;
								//$bh=70;
								$move=$bh-70;
							   $lly=$lly-$move;
							   $ury=$ury-$move;		
							}
						}
						else if($height>70)
						{
							//$bh=70;
							//$bw=$width*70/$height;
							$move=$height-70;
						  $lly=$lly-$move;
						  $ury=$ury-$move;					
						}
						else 
						{
							$bw=$width;
							$bh=$height;
						}
					$p->fit_image($image, $startx, 768-$move, "boxsize={" . $bw . " " . $bh . "} position={top} fitmethod=entire");
					//$p->fit_image($image, $startx, 760, "boxsize={" . "20" . " " . "20" . "} position={top} fitmethod=entire");
			  }
	 
		  if($type=='savequote')
		  {
			  $infofont = $p->load_font("Helvetica-Bold", "unicode", "");
			  $p->setfont($infofont, 9.5);
			  if($shipping[shipping_company]!=''&&$shipping_address!=' ')//one white space
			  {
				  //$p->fit_textline($shipping[shipping_company]."    |    ".$shipping_address, $startx, 748-$move, "fillcolor={#003e71} ");			  
				  $shipping_address=$shipping[shipping_company]."    |    ".$shipping_address;
				  $addresslength=strlen($shipping_address);
				  //if($addresslength>70)
				  	//$startx=$startx-10;
				  //$startx=$urx-6.23*$addresslength;
				  $startx=$startx-($addresslength*0.125+10.125);
				  $p->fit_textline($shipping_address, $startx, 758-$move, "position={center} fillcolor={#003e71} boxsize={550 10}");//48
				 
				  $lly=$lly-20;
				  $ury=$ury-20;
			  }
			  else if($shipping[shipping_company]!='')
			  {
				  $p->fit_textline($shipping[shipping_company], $startx, 735-$move, "fillcolor={#003e71} position={center}");			  
				  //$p->fit_textline($shipping_address, $startx, 723, "");
				  $lly=$lly-25;
				  $ury=$ury-25;				  
			  }
			  else if($shipping_address!=' ')//one white space
			  {
				  //$p->fit_textline($shipping[shipping_company], $startx, 740, "");			  
				  $p->fit_textline($shipping_address, $startx, 735-$move, "fillcolor={#003e71} ");
				  $lly=$lly-25;
				  $ury=$ury-25;				  	
			  }
			  else
			  {
				  $lly=$lly-8;
				  $ury=$ury-8;					  
			  }
			  $titlefont = $p->load_font("Helvetica-Bold", "unicode", "");
			  $p->setfont($titlefont, 19);
			  $quotetext="Quote#:".$cart[quote_name];
			  //$quotelength=strlen($quotetext);
			  $startx=250-$quotelength;
			  $p->fit_textline($quotetext, $startx, 740-$move, "position={left} fillcolor={#003e71} boxsize={550 10}");			  		  
		  }
	  }
	  else//user
	  {
	  	   $imagefile = PathTemplatesCompanylogo."PipeLogo.gif";
		   $move=0;
			  if (file_exists($imagefile))
			  {
					 $image = $p->load_image("auto", $imagefile, "");
						list($width,$height)=getimagesize($imagefile);
						if ($image == 0) {
						die("Error: " .  $p->get_errmsg());
						}
					$p->setfont($font, 12);
						$startx=48;
						
						if($width>550)
						{
							$bw=550;
							$bh=$height*550/$width;
							if($bh>70)
							{
								$move=$bh-70;
							   $lly=$lly-$move;
							   $ury=$ury-$move;								
							}
						}
						else if($height>70)
						{
								$move=$height-70;
							   $lly=$lly-$move;
							   $ury=$ury-$move;		
						}
						else 
						{
							$bw=$width;
							$bh=$height;	
						}
					$p->fit_image($image, $startx, 760-$move, "boxsize={" . $bw . " " . $bh . "} position={top} fitmethod=entire");
			  }
			   if($type=='savecart')
			   {
				  $titlefont = $p->load_font("Helvetica-Bold", "unicode", "");
				  $p->setfont($titlefont, 9.5);
				  //$quotetext=" Shopping Cart Name:".$cart[save_cart_name];
				  //$p->fit_textline($quotetext, $startx, 746, "fillcolor={#003e71} ");
				  $p->fit_textline(' P.O. Box 467 / 64 Outwater Lane, Garfield NJ 07026', $startx+138, 749-$move, "fillcolor={#003e71} ");
				  $p->fit_textline(' 9:00 a.m. to 5:00 p.m. EST                  |                 Phone: 800.274.6271                 |                 Fax No: 800.279.6897', $startx, 731-$move, "fillcolor={#003e71} ");
				  $lly=$lly-28;
				  $ury=$ury-28;				   
			   }
	  }
				$optlist = "header=0 fill={{area=row1 fillcolor={#f2f2f2 }}} " ."stroke={{line=hor0 strokecolor={#ebebeb} linewidth=0.5} ";
			
			for ($k=1;$k<=($rowcount*2+1);$k+=2)
			{
				$optlist=$optlist."{line=hor".$k." strokecolor={#ebebeb} linewidth=0.5} ";//gray 0.9
			}
			$k=$k-1;
			$optlist=$optlist."{line=hor".$k." strokecolor={#ebebeb} linewidth=0.5} ";
			
			$optlist=$optlist."{line=vertother strokecolor={#ebebeb} linewidth=0.5}}";
		
		/*$row=$rowcount*2+2;
		for ($row++; $row <= $rowmax; $row++) {
			for ($col = 1; $col <= $colmax; $col++) {
				$num = "Col " . $col . "/Row " . $row;
				
				if($col%5==1)
				{
					//$optlist = "colwidth=30% fittextline={font=" . $font . " fontsize=10}";
				}
				else if($col%5==2)
					$optlist1 = "colwidth=40% fittextline={font=" . $font . " fontsize=10}";
				else if($col%5==3)
					$optlist1 = "colwidth=9% fittextline={font=" . $font . " fontsize=10}";
				else if($col%5==4)
					$optlist1 = "colwidth=10% fittextline={font=" . $font . " fontsize=10}";			
				else
					$optlist1 = "colwidth=11% fittextline={font=" . $font . " fontsize=10}";	
					
				$tbl = $p->add_table_cell($tbl, $col, $row, $num, $optlist1);
				if ($tbl == 0) {
				die("Error: " . $p->get_errmsg());
				}
			}
			}*/
		
			$result = $p->fit_table($tbl, $llx, $lly, $urx, $ury, $optlist);
			if ($result ==  "_error") 
			{
				die("Couldn't place table: " . $p->get_errmsg());
			}
			
			if($result == "_boxfull")
			do {
					$p->end_page_ext("");
					$p->begin_page_ext(0, 0, "width=a4.width height=a4.height");
		
		
		
		
					$llx= 45; $lly=50; $urx=550; $ury=800;
					$result = $p->fit_table($tbl, $llx, $lly, $urx, $ury, $optlist);
					if ($result ==  "_error") 
					{
						die("Couldn't place table: " . $p->get_errmsg());
					}
		
		
			} while ($result == "_boxfull");
			//$font = $p->load_font("Helvetica", "unicode", "");
		
			
			
			$p->end_page_ext(""); 
			if ($result != "_stop") 
			{		
				if ($result ==  "_error") 
				{
					die("Error when placing table: " . $p->get_errmsg());
				} 
				else 
				{
					die("User return found in Textflow");
				}
			}
		
			$p->delete_table($tbl, "");
		
			$p->end_document("");
			
		
			$buf = $p->get_buffer();
			//print $buf.'buf';
			$len = strlen($buf);
			//$name='testpdf.pdf';
			//print $len;
			
			/*if($type=='savecart')
				$subject = "Save Shopping Cart PDF Request";
			else if($type=='savequote')
				$subject = "Quote Shopping Cart PDF Request";*/
			//$message = "";
			$separator = md5(time()); 			
			
			$filename = $passID.".pdf";

			//ob_end_clean();
    		$pdfdoc = $buf;			
		
				
			//$pdfdoc = $pdf->Output("", "S");

			$sendfrom=$sender_name."<".$from.">".$eol;
			$sendto=$recipient_name."<".$to.">".$eol;
			$to=$recipient_name."<".$to.">";
			$attachment = chunk_split(base64_encode($pdfdoc));
			$headers = "From: ".$sendfrom;
			$headers .= "MIME-Version: 1.0".$eol;
			$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"".$eol.$eol;
			$headers .= "Content-Transfer-Encoding: 7bit".$eol;
			$headers .= "This is a MIME encoded message.".$eol.$eol;
			// message
			$headers .= "--".$separator.$eol;
			$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
			$headers .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
			$headers .= $message.$eol.$eol;
			
			$headers .= "--".$separator.$eol;
			$headers .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol;
			$headers .= "Content-Transfer-Encoding: base64".$eol;
			$headers .= "Content-Disposition: attachment".$eol.$eol;
			$headers .= $attachment.$eol.$eol;
			$headers .= "--".$separator."--";
			mail($to, $subject, $message, $headers); 	
		
		}
		catch (PDFlibException $e) {
			die("PDFlib exception occurred in starter_table sample:\n" .
			"[" . $e->get_errnum() . "] " . $e->get_apiname() . ": " .
			$e->get_errmsg() . "\n");
		}
		catch (Exception $e) {
			die($e);
			}	
	
		}
		
		else
		{
			$total=0;
			$shoppingcartprinto=$this->PmSaveShoppingCardPrintpage($type);
			$subject="Shopping cart Email Request";
			
			$headers ="MIME-Version: 1.0 \r\n";
			$headers .="Content-type: text/html; charset=iso-8859-1 \r\n";
			$headers .= "From: ".$from.$eol;
			$message="<div><table border='1'>
			 <thead><tr><th> Product Image</th>
			<th>Item Description and Size</th>
			<th> Quantity</th>
			<th> Unit Price</th>
			<th>Total Price</th>
			</tr></thead><tbody>";
			if(count($shoppingcartprinto)>0)
			{
				 foreach($shoppingcartprinto as $key => $reps_data)
				 {
					$total=$total+$reps_data['new_total']; 
					if($reps_data['stock_custom']=='S')
					{
						$image=$reps_data['shoppingcart_image'];
					}
					//$message.="<tr><td><input name='' type='image' src='".WebSite.PathImgProductSkuShoppingCart.$image."'/><br/>".$reps_data['addtocart_heading'].$width."width"."</td><td>".$reps_data['sku_name']."<br/>".$reps_data['sku_code']."</td><td align='center'>".$reps_data['quantity']."</td><td>$".$reps_data['new_price']."</td><td>$".$reps_data['new_total']."</td></tr>";	
					$message.="<tr><td><input name='' type='image' src='".PathImgProductSkuShoppingCart.$image."'/><br/>".$reps_data['addtocart_heading'].$width."width"."</td><td>".$reps_data['sku_name']."<br/>".$reps_data['sku_code']."</td><td align='center'>".$reps_data['quantity']."</td><td>$".$reps_data['new_price']."</td><td>$".$reps_data['new_total']."</td></tr>";	
				 }
			}
			$message.="<tr><td colspan='2'>*Total does not include shipping or tax</td><td colspan='3' align='right'>
			*Subtotal items:$".$total."</td></tr></tbody></table></div>";
			
			mail($to,$subject,$message,$headers);			
		}
	}
	function process_deletecompanylogo()
	{
		  $sql_companylogo="update pm_customers set company_logo='' where customers_id=$_SESSION[CID]";	  
		  mysql_query($sql_companylogo);
		  echo "The company's logo is currently not uploaded.";
	}
	function numberround($number, $precision)
	{
		$precision = ($precision == 0 ? 1 : $precision);   
		$pow = pow(10, $precision);
		$ceil = ceil($number * $pow)/$pow;
		$floor = floor($number * $pow)/$pow;
		$pow = pow(10, $precision+1);
		$diffCeil     = $pow*($ceil-$number);
		$diffFloor     = $pow*($number-$floor)+($number < 0 ? -1 : 1);
		if($diffCeil >= $diffFloor) return $floor;
		else return $ceil;
	} 
	function PMGetSearchCustomColorImage($sku_code,$color)
	{
	$sql_custom_image="select custom_image from pm_product_custom_color_images 
	where sku_code='".mysql_real_escape_string($sku_code)."' and
	color='".mysql_real_escape_string($color)."'";
	//print $sql_custom_image;
	$custom_result=mysql_query($sql_custom_image);
	$custom_image_new=mysql_fetch_array($custom_result);
	$custom_image=$custom_image_new[custom_image];
	return $custom_image;
	}
	function getAdditionalchargeinfo($sku_code)
	{
		$sql_additionalcharge_list="select s.additional_charge,s.surcharges_message,p.min_quantity_below from pm_products_sku_description s,pm_products_price p 
		where s.sku_code='$sku_code' and s.active='Y' and p.active='Y' and p.material_code=s.material_code";
		$additional_result=mysql_query($sql_additionalcharge_list);
		while($additional_row=mysql_fetch_array($additional_result))
		{
		   $additional[]=$additional_row;
		}		
		return $additional;		
	}
	function PMsaveLoadCustomNameplateDetails($shoppingcartid)
	{
		if($_REQUEST['sh_id']!='')
			$shid=$_REQUEST['sh_id'];
		else
			$shid=$shoppingcartid;
		$sql_load_detail="select option_label1,option_value1,option_label2,option_value2,option_label3,option_value3,option_label4,option_value4,compression_rate from pm_shopping_cart_attributes where s_id=$shid order by id ";
		$loadCustomdetail_result=mysql_query($sql_load_detail);
		//print $sql_load_detail;
		while($loadCustomdetail_row=mysql_fetch_array($loadCustomdetail_result))
		{	
			$loadCustomdetail_product[]=$loadCustomdetail_row;
		}
		return $loadCustomdetail_product;	
	}
} //end of class
?>
