<?
class ProductCustomeTools
{
	function getlegendbyproductno($productno)
	{	
		$sql="select by_legend,products_id from pm_products where product_number='".$productno."' and active='Y' ";
		$legend_result=mysql_query($sql);
		while($legend_row=mysql_fetch_array($legend_result))
		{
		 	$getlegend[by_legend]=$legend_row['by_legend'];
			$getlegend[products_id]=$legend_row['products_id'];
		}		
		return $getlegend;		
	}
	function checkrelatedlegend($productno)
	{
			$legend=$this->getlegendbyproductno($productno);			
			$sql_searchlegend_list="select product_number,products_id,category_name,subcategory_name,image1_thumbnail,long_description from pm_products,pm_category where pm_products.subcategory_id=pm_category.category_id and by_legend='$legend[by_legend]' and pm_products.active='Y' and pm_category.active='Y' and products_id<>'$legend[products_id]'  order by products_id";	
			//print $sql_searchlegend_list;
			$searchlegend_result=mysql_query($sql_searchlegend_list);
			while($legend_row=mysql_fetch_array($searchlegend_result))
			{
				$relatedlegend[]=$legend_row;
			}			
			return $relatedlegend;		
	}
	function getproductsbyaccesories($sku_code) 
	{		
			$sql_productno_list="select product_number from pm_products_accessories where sku_code='$sku_code' and active='Y' order by position";
			//print $sql_productno_list;
			$productno_result=mysql_query($sql_productno_list);
			while($productno_row=mysql_fetch_array($productno_result))
			{
				$productno[]=$productno_row;
			}
			return $productno;				
	}
	function getproductsdetails($product_number)
	{
			$sql_products_list="select s.material_code,p.product_number,p.image1_thumbnail,p.product_nickname,p.accessories_description from pm_products_sku_description s,pm_products p where p.product_number='$product_number' and s.product_number=p.product_number and s.active='Y' and p.active='Y' and s.productno_filter='Y' group by sku_code order by s.position";	//accessories products details
			$products_result=mysql_query($sql_products_list); 
			//print $sql_products_list;
			while($products_row=mysql_fetch_array($products_result))
			{
				$productsdetail[]=$products_row;
			}
			return $productsdetail;
	}
	function getmaterialcodeinfo($product_number)
	{
		  $sql_materialcode_list="select material_code from pm_products_sku_description where product_number='$product_number' and active='Y'";	//select material_code, sku_code too
		  $materialcode_result=mysql_query($sql_materialcode_list);
		  while($materialcode_row=mysql_fetch_array($materialcode_result))
		  {
			  $materialcode[]=$materialcode_row;
		  }
		  return $materialcode;	
	}
	function getquantitytype($materialcode)
	{
		if($_SESSION[user_type]=='R')
		    $sql_quantitytype_list="select quantity from pm_products_price where material_code='$materialcode' and user_type='$_SESSION[user_type]' and rep_special='$_SESSION[rep_special]' and active='Y' order by quantity asc ";	//select material_code, sku_code too
		else
			$sql_quantitytype_list="select quantity from pm_products_price where material_code='$materialcode' and user_type='$_SESSION[user_type]' and active='Y' order by quantity asc ";
		  //print $sql_quantitytype_list;
		  $quantitytype_result=mysql_query($sql_quantitytype_list);
		  while($quantitytype_row=mysql_fetch_array($quantitytype_result))
		  {
			  $quantitytypeetails[]=$quantitytype_row;
		  }
		  return $quantitytypeetails;
	}	
	function getfromdescriptioninfo($product_number,$material_code)
	{
		$sql_material_list="select material_description,sku_code from pm_products_sku_description where product_number='$product_number' and active='Y' and material_code='$material_code'";	
		//print $sql_material_list;
		$material_result=mysql_query($sql_material_list);
		$i=0;
		while($material_row=mysql_fetch_array($material_result))
		{
			$materialcode[material_description][$i]=$material_row['material_description'];
			$materialcode[sku_code][$i]=$material_row['sku_code'];
			$i++;
		}
		return $materialcode;
	}
	function APcheckfromproducttoinsert($product_number)
	{
		$sql_product_list="select s.material_code,p.products_id,p.stock_custom,p.product_number,p.ez_pipe_markers,p.background_color,p.image2 from pm_products p,pm_products_sku_description s where s.product_number='".$product_number."' and s.product_number=p.product_number and p.active='Y' and s.active='Y' group by s.material_code";//one record
		//print $sql_product_list;
		 $product_result=mysql_query($sql_product_list);
		 while($product_row=mysql_fetch_array($product_result))
		 {
			 $product[material_code]=$product_row['material_code'];
			 $product[products_id]=$product_row['products_id'];
			 $product[stock_custom]=$product_row['stock_custom'];
			 $product[product_number]=$product_row['product_number'];
			 $product[ez_pipe_markers]=$product_row['ez_pipe_markers'];
			 $product[background_color]=$product_row['background_color'];
			 $product[image2]=$product_row['image2'];
		 }
		 return $product;
	}
	function APcheckdescriptiontable($skucodeinput)
	{
		  $sql_skucode_list="select sku_id,sku_code,product_number,material_code,material_description,freight_shipping,shoppingcart_image,ab_tape_class,ab_tape,ab_sku_code,ez_arrow_class,ez_arrow,ez_sku_code,addtocart_heading from pm_products_sku_description where sku_code = '$skucodeinput' and active='Y'";  
		  //print $sql_skucode_list;
		  $skucode_result=mysql_query($sql_skucode_list);//only one records
		  
		  if(mysql_num_rows($skucode_result)>0)
		  {
			  while($skucode_row=mysql_fetch_array($skucode_result))
			  {
				  $skucodeget[sku_id]=$skucode_row['sku_id'];
				  $skucodeget[product_number]=$skucode_row['product_number'];
				  $skucodeget[sku_code]=$skucode_row['sku_code'];
				  $skucodeget[material_code]=$skucode_row['material_code'];
				  $skucodeget[freight_shipping]=$skucode_row['freight_shipping'];
				  $skucodeget[shoppingcart_image]=$skucode_row['shoppingcart_image'];
				  $skucodeget[material_description]=$skucode_row['material_description'];
				  $skucodeget[ab_tape_class]=$skucode_row['ab_tape_class'];
				  $skucodeget[ab_tape]=$skucode_row['ab_tape'];
				  $skucodeget[ab_sku_code]=$skucode_row['ab_sku_code'];
				  $skucodeget[ez_arrow_class]=$skucode_row['ez_arrow_class'];
				  $skucodeget[ez_arrow]=$skucode_row['ez_arrow'];
				  $skucodeget[ez_sku_code]=$skucode_row['ez_sku_code'];
				  $skucodeget[addtocart_heading]=$skucode_row['addtocart_heading'];
			  }
		  }
		  return $skucodeget;
	}
	function APquantitytypefromprice($material_code)
	{
		if($_SESSION[user_type]=='R')
			$sql_pricequantitytype_list="select producttype,quantity,price,min_quantity_charge,min_quantity_below from pm_products_price where material_code='$material_code' and user_type='$_SESSION[user_type]' and rep_special='$_SESSION[rep_special]' and active='Y' group by quantity";
		else
		    $sql_pricequantitytype_list="select producttype,quantity,price,min_quantity_charge,min_quantity_below from pm_products_price where material_code='$material_code' and user_type='$_SESSION[user_type]' and active='Y' group by quantity";
		  //print $sql_pricequantitytype_list;
		  $pricequantitytype_result=mysql_query($sql_pricequantitytype_list);
		  while($quantitytype_row=mysql_fetch_array($pricequantitytype_result))
		  {
			  $quantitytype[]=$quantitytype_row;
		  }
		 return $quantitytype;
	}	
	function APgetinfofromprice($material_code,$quantityinput)
	{
		if($_SESSION[user_type]=='R')
		   $sql_price_list="select user_type,price,producttype,weight,number_pkgs,dim_weight,dim_charges,min_quantity_charge,min_quantity_below from pm_products_price where material_code='$material_code' and user_type='$_SESSION[user_type]' and rep_special='$_SESSION[rep_special]' and quantity=$quantityinput and active='Y'";
		else
			$sql_price_list="select user_type,price,producttype,weight,number_pkgs,dim_weight,dim_charges,min_quantity_charge,min_quantity_below from pm_products_price where material_code='$material_code' and user_type='$_SESSION[user_type]' and quantity=$quantityinput and active='Y'";
		    //print $sql_price_list;
			$price_result=mysql_query($sql_price_list);
			while($price_row=mysql_fetch_array($price_result))
			{					  
				if($_SESSION[user_type]=='R')
				{
					$price[price]=$price_row['price']*(100-$_SESSION['discount_data'])/100;
				}
				else
				{
					$price[price]=$price_row['price'];
				}
				$price[producttype]=$price_row['producttype'];
				$price[weight]=$price_row['weight'];
				$price[dim_weight]=$price_row['dim_weight'];
				$price[dim_charges]=$price_row['dim_charges'];
				$price[min_quantity_charge]=$price_row['min_quantity_charge'];
				$price[min_quantity_below]=$price_row['min_quantity_below'];
				$price[number_pkgs]=$price_row['number_pkgs'];
			}
			return $price;
	}
	function APcheckshoppingcartfromsession()
	{
			$sql_shoppingcart_list="select s.id,s.quantity,s.attributes_id,s.sku_code,s.producttype,d.additional_charge from pm_shopping_cart s,pm_products_sku_description d where s.sku_code=d.sku_code and s.user_type='$_SESSION[user_type]' and s.shopping_save='N' and s.session_id='".mysql_real_escape_string(session_id())."'";
			//print $sql_shoppingcart_list;
			$shoppingcart_result=mysql_query($sql_shoppingcart_list);
			while($shoppingcart_row=mysql_fetch_array($shoppingcart_result))
			{
			   $shoppingcartinfo[]=$shoppingcart_row;
			}	
			return $shoppingcartinfo;
	}
	function APinsertintoshoppingcart($product,$skucode,$price,$last_price,$totalprice,$last_total,$quantity_frompage)
	{
		$weight=$price[weight]*$quantity_frompage;
		$pkgs=$price[number_pkgs]*$quantity_frompage;
		$dimcharges=$price[dim_charges]*$quantity_frompage;			
		if($product[ez_pipe_markers]=='Y')
		{
		  $sql_insert_shoppingcart="insert into pm_shopping_cart(customers_id,session_id,user_type,producttype,products_id,stock_custom,attributes_id,background_color,sku_id,sku_code,sku_name,shoppingcart_image,price,new_price,total,new_total,customer_price,customer_total,ez_pipe_markers,ab_tape_sku_id,ab_tape_class,ab_tape,ab_tape_status,ez_arrow_sku_id,ez_arrow_class,ez_arrow,ez_arrow_status,freight_shipping,weight,number_pkgs,dim_weight,dim_charges,quantity,ip,created_date,last_modified) values('$_SESSION[CID]','".mysql_real_escape_string(session_id())."','$_SESSION[user_type]','$price[producttype]','$product[products_id]','$product[stock_custom]','$skucode[material_code]','$product[background_color]','$skucode[sku_id]','$skucode[sku_code]','$skucode[material_description]','$skucode[shoppingcart_image]',$last_price,$price[price],$last_total,$totalprice,$last_price,$last_total,'Y','$skucode[ab_sku_code]','$skucode[ab_tape_class]','$skucode[ab_tape]','Y','$skucode[ez_sku_code]','$skucode[ez_arrow_class]','$skucode[ez_arrow]','Y','$skucode[freight_shipping]','$weight','$pkgs','$price[dim_weight]','$dimcharges',".mysql_real_escape_string($quantity_frompage).",'".$_SERVER['REMOTE_ADDR']."',NOW(),NOW())";						
		}
		else
		{
		  $sql_insert_shoppingcart="insert into pm_shopping_cart(customers_id,session_id,user_type,producttype,products_id,stock_custom,attributes_id,background_color,sku_id,sku_code,sku_name,shoppingcart_image,price,new_price,total,new_total,customer_price,customer_total,freight_shipping,weight,dim_weight,number_pkgs,dim_charges,quantity,ip,created_date,last_modified) values('$_SESSION[CID]','".mysql_real_escape_string(session_id())."','$_SESSION[user_type]','$price[producttype]','$product[products_id]','$product[stock_custom]','$skucode[material_code]','$product[background_color]','$skucode[sku_id]','$skucode[sku_code]','$skucode[material_description]','$skucode[shoppingcart_image]',$last_price,$price[price],$last_total,$totalprice,$last_price,$last_total,'$skucode[freight_shipping]','$weight','$pkgs','$price[dim_weight]','$dimcharges',".mysql_real_escape_string($quantity_frompage).",'".$_SERVER['REMOTE_ADDR']."',NOW(),NOW())";	
		}		
		  //print $sql_insert_shoppingcart;
		  mysql_query($sql_insert_shoppingcart);
		  if($_SESSION[user_type]=='R')
			  $this->ResetCustomerListDiscountNew();			  
	}
	function APShoppingCardProductCount()
	{
	if($_REQUEST[cart_name])
	{
	$condition=" and cart_name='".mysql_real_escape_string($_REQUEST['cart_name'])."' and shopping_save='Y'";
	}
	else
	{
	$condition=" and session_id='".mysql_real_escape_string(session_id())."' and shopping_save='N'";
	}
	
	$sql_count="select session_id from pm_shopping_cart where 1 $condition ";
	$count_result=mysql_query($sql_count);
	$itemcount=mysql_num_rows($count_result);
	return $itemcount;
	}
	function insertaccesoriesfixed()
	{
		$outputquantitymessage="please enter require field";
		$quantity_array=array();
		$itemnumber_array=array();
		$image_array=array();
		$requestaccessoryproductno=$_REQUEST["productnofromaccessory"];			
		$product=$this->APcheckfromproducttoinsert($requestaccessoryproductno);				
		$shoppingcartinfo=$this->APcheckshoppingcartfromsession();//check for the current amount before adding any of this accessory's products			
		$requestmaterialcodefrompage=$_REQUEST["productmaterialcode"];//material_code
		$requestquantityfrompage=$_REQUEST["accessoryquantityinput"];
		$quantitytype=$this->APquantitytypefromprice($requestmaterialcodefrompage);				
		$quantitycount=count($quantitytype);
		if($quantitycount>0)
		{
			$q=0;
			foreach($quantitytype as $key => $quantitytype_data)
			{	
				$quantitygroup[$q]=$quantitytype_data['quantity'];	 
				$pricegroup[$q]=$quantitytype_data['price'];	
				$producttype=$quantitytype_data['producttype'];
				$q++;
			}	
		}
		if($requestquantityfrompage!=0&&$requestquantityfrompage!=""&&is_numeric($requestquantityfrompage))
		{
			if(strpos($requestquantityfrompage,'.'))
			{
				$separate=explode('.',$requestquantityfrompage);
				if((int)$separate[1]==0)
					$digitok='Y';
				else
					$digitok='N';
			}
			else
				$digitok='Y';
			$requestquantityfrompage=(int)$requestquantityfrompage;
			if($requestquantityfrompage>0&&$digitok=='Y')
			{
				$addquantityfromthisaccessory=$requestquantityfrompage;
				$u=0;
				$updateid=array();
				$updateids_materialcode=array();
				$updateids_quantity=array();							
				if(count($shoppingcartinfo)>0)
				{
					foreach($shoppingcartinfo as $key => $shoppingcart_data)
					{
						$id_shopping[$u]=$shoppingcart_data['id'];
						$quantity_shopping[$u]=$shoppingcart_data['quantity'];
						$materialcode_shopping[$u]=$shoppingcart_data['attributes_id'];
						$producttype_shopping[$u]=$shoppingcart_data['producttype'];
						if($producttype==$producttype_shopping[$u])
						{
							$addquantityfromthisaccessory=$addquantityfromthisaccessory+$quantity_shopping[$u];	
							array_push($updateid,$id_shopping[$u]);	
							array_push($updateids_materialcode,$materialcode_shopping[$u]);
							array_push($updateids_quantity,$quantity_shopping[$u]);											
						}
						$u++;
					}			
				}
				if($addquantityfromthisaccessory>=$quantitygroup[0])
				{ 
					$k=0;
					while($k<$quantitycount)
					{
						if($addquantityfromthisaccessory>=$quantitygroup[$k]&&$addquantityfromthisaccessory<$quantitygroup[$k+1])
						{
							break;
						}
						$k++;
					}
					if($k==$quantitycount)	
						$k=$k-1;
						
					$quantity=$quantitygroup[$k];				
					if($_SESSION[user_type]=='R')
					{
						$list_price=$pricegroup[$k];
					}
					else
					{
						$list_price=$pricegroup[0];
					}
					$price=$this->APgetinfofromprice($requestmaterialcodefrompage,$quantity);				  
					$messageacce="OK";
				}
				$updateamount=count($updateid);
				if($updateamount>0)
				{
					for($w=0;$w<$updateamount;$w++)
					{
						$this->APupdateshopppingcartrecords_accessory($updateid[$w],$updateids_materialcode[$w],$updateids_quantity[$w],$addquantityfromthisaccessory);
					}
				}
				if($messageacce=="OK")
				{				
					$requestskucodefrompage=$_REQUEST["productskucodefromdes"];					
					$list_price=$this->numberround($list_price,4);
					$displaylistprice=$this->numberround($list_price,2);
					$price[price]=$this->numberround($price[price],4);
					$displayprice=$this->numberround($price[price],2);
					$list_total=$displaylistprice*$requestquantityfrompage;
					$totalprice=$displayprice*$requestquantityfrompage;							
					$skucode=$this->APcheckdescriptiontable($requestskucodefrompage);
					$quantity_array=array($requestquantityfrompage);
					$itemnumber_array=array($requestskucodefrompage);
					$image_array=array($product[image2]);
					$outputquantitymessage="";					
					//array_push($quantity_array,$requestquantityfrompage);							
					//array_push($itemnumber_array,$requestskucodefrompage);
					//array_push($image_array,$product[image2]);
					$this->APinsertintoshoppingcart($product,$skucode,$price,$list_price,$totalprice,$list_total,$requestquantityfrompage);																	
				}
			}
		}
		$num=$this->APShoppingCardProductCount();
					$item_added = array(
						quanity => $quantity_array,
						item_number => $itemnumber_array,

						outputquantitymessage => $outputquantitymessage,
						item_thumbnail => $image_array,
						current_item_number => $num,
					);
				$json = json_encode($item_added);
				echo $json;	
	}	
	
	/*function insertaccesoriesfixed()
	{
		$outputquantitymessage="";
		$quantity_array=array();
		$itemnumber_array=array();
		$image_array=array();
		$i=$_REQUEST["i"];
		$j=$_REQUEST["j"];
		$requestaccessoryproductno=$_REQUEST["productnofromaccessory".$i];			
		$product=$this->APcheckfromproducttoinsert($requestaccessoryproductno);				
		$shoppingcartinfo=$this->APcheckshoppingcartfromsession();//check for the current amount before adding any of this accessory's products			
		$requestmaterialcodefrompage=$_REQUEST["productmaterialcode"];//material_code
		$requestquantityfrompage=$_REQUEST["accessory-quantity-input".$i."-".$j];
		$quantitytype=$this->APquantitytypefromprice($requestmaterialcodefrompage);				
		$quantitycount=count($quantitytype);
		if($quantitycount>0)
		{
			$q=0;
			foreach($quantitytype as $key => $quantitytype_data)
			{	
				$quantitygroup[$q]=$quantitytype_data['quantity'];	
				$pricegroup[$q]=$quantitytype_data['price'];	
				$producttype=$quantitytype_data['producttype'];
				$q++;
			}	
		}
		if($requestquantityfrompage!=0&&$requestquantityfrompage!=""&&is_numeric($requestquantityfrompage))
		{
			if(strpos($requestquantityfrompage,'.'))
			{
				$separate=explode('.',$requestquantityfrompage);
				if((int)$separate[1]==0)
					$digitok='Y';
				else
					$digitok='N';
			}
			else
				$digitok='Y';
			$requestquantityfrompage=(int)$requestquantityfrompage;
			if($requestquantityfrompage>0&&$digitok=='Y')
			{
				$addquantityfromthisaccessory=$requestquantityfrompage;
				$u=0;
				$updateid=array();
				$updateids_materialcode=array();
				$updateids_quantity=array();							
				if(count($shoppingcartinfo)>0)
				{
					foreach($shoppingcartinfo as $key => $shoppingcart_data)
					{
						$id_shopping[$u]=$shoppingcart_data['id'];
						$quantity_shopping[$u]=$shoppingcart_data['quantity'];
						$materialcode_shopping[$u]=$shoppingcart_data['attributes_id'];
						$producttype_shopping[$u]=$shoppingcart_data['producttype'];
						if($producttype==$producttype_shopping[$u])
						{
							$addquantityfromthisaccessory=$addquantityfromthisaccessory+$quantity_shopping[$u];	
							array_push($updateid,$id_shopping[$u]);	
							array_push($updateids_materialcode,$materialcode_shopping[$u]);
							array_push($updateids_quantity,$quantity_shopping[$u]);											
						}
						$u++;
					}			
				}
				if($addquantityfromthisaccessory<$quantitygroup[0])
				{
					$messageacce='NoMatch';
				}
				else
				{ 
					$k=0;
					while($k<$quantitycount)
					{
						if($addquantityfromthisaccessory>=$quantitygroup[$k]&&$addquantityfromthisaccessory<$quantitygroup[$k+1])
						{
							break;
						}
						$k++;
					}
					if($k==$quantitycount)	
						$k=$k-1;
						
					$quantity=$quantitygroup[$k];				
					if($_SESSION[user_type]=='R')
					{
						$list_price=$pricegroup[$k];
					}
					else
					{
						$list_price=$pricegroup[0];
					}
					$price=$this->APgetinfofromprice($requestmaterialcodefrompage,$quantity);				  
					$messageacce="OK";
				}
				$updateamount=count($updateid);
				if($updateamount>0)
				{
					for($w=0;$w<$updateamount;$w++)
					{
						$this->APupdateshopppingcartrecords_accessory($updateid[$w],$updateids_materialcode[$w],$updateids_quantity[$w],$addquantityfromthisaccessory);
					}
				}
				if($messageacce=="OK")
				{				
					$requestskucodefrompage=$_REQUEST["skucode"];					
					$list_price=$this->numberround($list_price,4);
					$displaylistprice=$this->numberround($list_price,2);
					$price[price]=$this->numberround($price[price],4);
					$displayprice=$this->numberround($price[price],2);
					$list_total=$displaylistprice*$requestquantityfrompage;
					$totalprice=$displayprice*$requestquantityfrompage;							
					$skucode=$this->APcheckdescriptiontable($requestskucodefrompage);
					array_push($quantity_array,$requestquantityfrompage);							
					array_push($itemnumber_array,$requestskucodefrompage);
					array_push($image_array,$product[image2]);
					$this->APinsertintoshoppingcart($product,$skucode,$price,$list_price,$totalprice,$list_total,$requestquantityfrompage);																	
				}
			}
		}
		$num=$this->APShoppingCardProductCount();
					$item_added = array(
						quanity => $quantity_array,
						item_number => $itemnumber_array,
						outputquantitymessage => $outputquantitymessage,
						item_thumbnail => $image_array,
						current_item_number => $num,
					);
				$json = json_encode($item_added);
				echo $json;	
	}*/	
	function getproductsbyaccesoriesfixed($productno)
	{
		$sql="select fixed_product_nickname from pm_products_accessories where fixed_product_number='".$productno."' and fixed_active='Y' order by fixed_position";
		//print $sql;
		$fixed_product_nickname_result=mysql_query($sql);
		while($fixed_product_nickname_row=mysql_fetch_array($fixed_product_nickname_result))
		{
			$resultfixed_product_nickname[]=$fixed_product_nickname_row;
		}		
		return $resultfixed_product_nickname;				
	}
	function getproductsdetailsfixed($fixed_product_nickname)
	{
		$sql_products_list="select s.material_code,p.product_number,p.image1_thumbnail,p.product_nickname,p.accessories_description from pm_products_sku_description s,pm_products p where p.product_nickname='$fixed_product_nickname' and s.product_number=p.product_number group by s.material_code";	//accessories products details  not write show_fixed_accessories =='Y' we already have the value
		$products_result=mysql_query($sql_products_list);
		//print $sql_products_list;
		while($products_row=mysql_fetch_array($products_result))
		{
			$productsdetail[]=$products_row;
		}
		//print count($productsdetail).'count';
		return $productsdetail;
	}
	function APupdateshopppingcartrecords_accessory($updateid,$updateids_materialcode,$updateids_quantity,$addquantity)
	{
		$quantitytype=$this->APquantitytypefromprice($updateids_materialcode);		
		$i=0;	
		$quantitycount=count($quantitytype);
		if($quantitycount>0)
		{
			foreach($quantitytype as $key => $quantitytype_data)
			{	
				$quantitygroup[$i]=$quantitytype_data['quantity'];		
				$pricegroup[$i]=$quantitytype_data['price'];
				$i++;
			}	
		}
		$k=0;
		while($k<$quantitycount)
		{
			if($addquantity>=$quantitygroup[$k]&&$addquantity<$quantitygroup[$k+1])
			{
				break;
			}
			$k++;
		}
		if($k==$quantitycount)	
			$k=$k-1;
			
		$quantity=$quantitygroup[$k];
		
		if($_SESSION[user_type]=='R')
		{
			$currentprice=$pricegroup[$k]*(100-$_SESSION['discount_data'])/100;
			$list_price=$pricegroup[$k];		
			$displaylistprice=$this->numberround($list_price,2);	
			$listtotal=$displaylistprice*$updateids_quantity;							
		}
		else
		{
			$currentprice=$pricegroup[$k];
		}
		$currentprice=$this->numberround($currentprice,4);
		$displayprice=$this->numberround($currentprice,2);		
		$new_total=$displayprice*$updateids_quantity;		
		if($_SESSION[user_type]=='R')
			$sql_update_shoppingcart="update pm_shopping_cart set price=".$list_price.",total=".$listtotal.",customer_price=".$list_price.",customer_total=".$listtotal.",new_price=".$currentprice.",new_total=".$new_total." where id=$updateid";
		else
			$sql_update_shoppingcart="update pm_shopping_cart set new_price=".$currentprice.",new_total=".$new_total." where id=$updateid";
		mysql_query($sql_update_shoppingcart);
	}
	function APinsert_custom_nameplate_product($product,$skucode,$price,$last_price,$totalprice,$last_total,$quantity_frompage,$color,$mounting_option,$make_fit,$comments,$combine_product,$addtionalcharge)
	{
		//$uploadfile=$_REQUEST['uploadfilename'];
		$uploadfileid=$_REQUEST['uploadfileid'];
		$weight=$price[weight]*$quantity_frompage;
		$pkgs=$price[number_pkgs]*$quantity_frompage;
		$dimcharges=$price[dim_charges]*$quantity_frompage;			
		if($product[ez_pipe_markers]=='Y')
		{
		  $sql_insert_shoppingcart="insert into pm_shopping_cart(customers_id,session_id,user_type,producttype,products_id,stock_custom,attributes_id,sku_id,sku_code,sku_name,shoppingcart_image,price,new_price,total,new_total,customer_price,customer_total,ez_pipe_markers,ab_tape_sku_id,ab_tape_class,ab_tape,ab_tape_status,ez_arrow_sku_id,ez_arrow_class,ez_arrow,ez_arrow_status,freight_shipping,weight,	number_pkgs,dim_weight,dim_charges,quantity,ip,created_date,background_color,mounting_option,make_fit,comments,custom_status,custom_color_status,last_modified,combine_product,additional_charges) values('$_SESSION[CID]','".mysql_real_escape_string(session_id())."','$_SESSION[user_type]','$price[producttype]','$product[products_id]','$product[stock_custom]','$skucode[material_code]','$skucode[sku_id]','$skucode[sku_code]','$skucode[material_description]','$skucode[shoppingcart_image]',$last_price,$price[price],$last_total,$totalprice,$last_price,$last_total,'Y','$skucode[ab_sku_code]','$skucode[ab_tape_class]','$skucode[ab_tape]','Y','$skucode[ez_sku_code]','$skucode[ez_arrow_class]','$skucode[ez_arrow]','Y','$skucode[freight_shipping]','$weight','$pkgs','$price[dim_weight]','$dimcharges',".mysql_real_escape_string($quantity_frompage).",'".$_SERVER['REMOTE_ADDR']."',NOW(),'$color','$mounting_option','$make_fit','$comments','Y','Y',NOW(),'$combine_product','$addtionalcharge')";						
		}
		else
		{
		  $sql_insert_shoppingcart="insert into pm_shopping_cart(customers_id,session_id,user_type,producttype,products_id,stock_custom,attributes_id,sku_id,sku_code,sku_name,shoppingcart_image,price,new_price,total,new_total,customer_price,customer_total,freight_shipping,weight,	number_pkgs,dim_weight,dim_charges,quantity,ip,created_date,background_color,mounting_option,make_fit,comments,custom_status,custom_color_status,last_modified,combine_product,additional_charges) values('$_SESSION[CID]','".mysql_real_escape_string(session_id())."','$_SESSION[user_type]','$price[producttype]','$product[products_id]','$product[stock_custom]','$skucode[material_code]','$skucode[sku_id]','$skucode[sku_code]','$skucode[material_description]','$skucode[shoppingcart_image]',$last_price,$price[price],$last_total,$totalprice,$last_price,$last_total,'$skucode[freight_shipping]','$weight','$pkgs','$price[dim_weight]','$dimcharges',".mysql_real_escape_string($quantity_frompage).",'".$_SERVER['REMOTE_ADDR']."',NOW(),'$color','$mounting_option','$make_fit','$comments','Y','Y',NOW(),'$combine_product','$addtionalcharge')";	
		}
		  //print $sql_insert_shoppingcart;
		  mysql_query($sql_insert_shoppingcart);		  
		  $ID = mysql_insert_id();
		  if($uploadfileid!='')
		  {
			  $find_file_database_sql="select s_id,customer_id,username,file_name,file_size,file_type,export_brimar from pm_customer_file_upload where id='$uploadfileid'";
			  $find_file_result=mysql_query($find_file_database_sql);
			  while($findfile_row=mysql_fetch_array($find_file_result))
			  {
				  $findfile[s_id]=$findfile_row['s_id'];
				  $findfile[customer_id]=$findfile_row['customer_id'];
				  $findfile[username]=$findfile_row['username'];
				  $findfile[file_name]=$findfile_row['file_name'];
				  $findfile[file_size]=$findfile_row['file_size'];
				  $findfile[file_type]=$findfile_row['file_type'];
				  $findfile[export_brimar]=$findfile_row['export_brimar'];
			  }
			  if(!$findfile[s_id])
			  {
				  
				 $sql_update_uploadfile="update pm_customer_file_upload set s_id='$ID' where id='$uploadfileid'";
				 mysql_query($sql_update_uploadfile);
			  }
			  else
			  {
			  	 $sql_insert_filedata="insert into pm_customer_file_upload (s_id,customer_id,username,file_name,file_size,file_type,export_brimar,create_date) values('$ID','$findfile[customer_id]','$findfile[username]','$findfile[file_name]','$findfile[file_size]','$findfile[file_type]','$findfile[export_brimar]',NOW())";
				 mysql_query($sql_insert_filedata);
			  }
		  }
		  $textline_count=$_REQUEST['nooftextlines'];
		  $textsizelabel=Textsize_Label;
		  $textcontentlabel=Textcustomcopy_Label;
		  $textarrangementlabel=Textarrangement_Label;
		  $textpositionlabel=Textposition_Label;
		  $output=array();
		  $output[quantity]=$quantity_frompage;
		  $output[mounting_option]=$mounting_option;
		  $output[color]=$color;
		  $thickness_sepa=split('"',$skucode[material_description]);
		  $thickness=$thickness_sepa[0].'"';
		  $output[thickness]=$thickness;
		  $output[sh_id]=$ID;
		  $text_detail_array=array();
		  $r=0;
		  if($textline_count>0)
		  {
			  for($p=$textline_count;$p>0;$p--)
			  {
				  $textlinecontent=$_REQUEST['line_'.$p];
			  	  if($textlinecontent!='')
				  { 
					  break;
				  }
				  else
				  {
					  $r++;
				  }
			  }			  
			  for($i=1;$i<=($textline_count-$r);$i++)
			  {
				  $textlinecontent=$_REQUEST['line_'.$i];
				  $textlinecontent=strtoupper($textlinecontent);
				  $textsizeinput=$_REQUEST['select_text_size_line_'.$i].'"';
				  if(isset($_REQUEST["sku_id"]))//custom ceiling markers
				  {
				  	$sql_insert_shopping_detail="insert into pm_shopping_cart_attributes(s_id,option_label1,option_value1,option_label2,option_value2,option_label3,option_value3,created_date,text_heading,compression_rate) values('$ID','$textpositionlabel','$i','$textsizelabel','$textsizeinput','$textcontentlabel','".mysql_real_escape_string($textlinecontent)."',NOW(),'$skucode[addtocart_heading]','$text_compression')";
				  }
				  else
				  {
				  	$textorientation=$_REQUEST['text-orientation_line_'.$i];
					$sql_insert_shopping_detail="insert into pm_shopping_cart_attributes(s_id,option_label1,option_value1,option_label2,option_value2,option_label3,option_value3,option_label4,option_value4,created_date,text_heading,compression_rate) values('$ID','$textpositionlabel','$i','$textsizelabel','$textsizeinput','$textcontentlabel','".mysql_real_escape_string($textlinecontent)."','$textarrangementlabel','$textorientation',NOW(),'$skucode[addtocart_heading]','$text_compression')";
				  }
				  $text_compression=$_REQUEST['line_'.$i.'_compression'];
				  //print $sql_insert_shopping_detail;
				  mysql_query($sql_insert_shopping_detail);
				  $text_detail_array[$i][text_content]=$textlinecontent;
				  $text_detail_array[$i][text_size]=$textsizeinput;
				  $text_detail_array[$i][text_align]=$textorientation;
				  $text_detail_array[$i][text_compression]=$text_compression;
			  }
		  }
		  /* if($textline_count==1&&$_REQUEST['line_1']==''&&$make_fit=='Y')
		  {
		  	$textlinecontent=$_REQUEST['copy_to_fit'];
			$textlinecontent=strtoupper($textlinecontent);
			$textsizeinput='copytofit';
			$sql_insert_shopping_detail="insert into pm_shopping_cart_attributes(s_id,option_label2,option_value2,option_label3,option_value3,created_date,text_heading) values($ID,'$textsizelabel','$textsizeinput','$textcontentlabel','".mysql_real_escape_string($textlinecontent)."',NOW(),'$skucode[addtocart_heading]')";
				  //print $sql_insert_shopping_detail;
				  mysql_query($sql_insert_shopping_detail);
		  }*/  
		  if($_SESSION[user_type]=='R')
			  $this->ResetCustomerListDiscountNew();			  
		  $custom_image=$this->APGetSearchCustomColorImage($product[product_number],$skucode[sku_code],$color);
		  $imagelink=WebSite.PathImgProductSkuShoppingCart.$custom_image; 
		  $num=$this->APShoppingCardProductCount();
		  $output[text_detail]=$text_detail_array;
		  $output[current_item_number]=$num;
		  $output[product_number]=$skucode[sku_code];
		  $output[image]=$imagelink;
		  $json = json_encode($output);
		  echo $json;	  
	}
	function APinsert_custom_normal_product($product,$skucode,$price,$last_price,$totalprice,$last_total,$quantity_frompage,$color,$mounting_option,$make_fit,$comments,$parameters_one,$combine_product,$addtionalcharge)
	{
		//$uploadfile=$_REQUEST['uploadfilename'];
		$uploadfileid=$_REQUEST['uploadfileid'];
		$weight=$price[weight]*$quantity_frompage;
		$pkgs=$price[number_pkgs]*$quantity_frompage;
		$dimcharges=$price[dim_charges]*$quantity_frompage;			
		if(isset($_REQUEST['largeitem_scale']))
		{
		 	$largeitem_scale=$_REQUEST['largeitem_scale'];
		}
		if($color!='')
			$custom_color_status="Y";
		else
			$custom_color_status="N";
		if(isset($_REQUEST['waive_maximum']))
		{
			$waiver=$_REQUEST['waive_maximum'];
		}
		if($product[ez_pipe_markers]=='Y')
		{
		  $sql_insert_shoppingcart="insert into pm_shopping_cart(customers_id,session_id,user_type,producttype,products_id,stock_custom,attributes_id,sku_id,sku_code,sku_name,shoppingcart_image,price,new_price,total,new_total,customer_price,customer_total,ez_pipe_markers,ab_tape_sku_id,ab_tape_class,ab_tape,ab_tape_status,ez_arrow_sku_id,ez_arrow_class,ez_arrow,ez_arrow_status,freight_shipping,weight,	number_pkgs,dim_weight,dim_charges,quantity,ip,created_date,background_color,mounting_option,make_fit,comments,largeitem_scale,custom_status,custom_color_status,parameters_one,last_modified,waiver,combine_product,additional_charges) values('$_SESSION[CID]','".mysql_real_escape_string(session_id())."','$_SESSION[user_type]','$price[producttype]','$product[products_id]','$product[stock_custom]','$skucode[material_code]','$skucode[sku_id]','$skucode[sku_code]','$skucode[material_description]','$skucode[shoppingcart_image]',$last_price,$price[price],$last_total,$totalprice,$last_price,$last_total,'Y','$skucode[ab_sku_code]','$skucode[ab_tape_class]','$skucode[ab_tape]','Y','$skucode[ez_sku_code]','$skucode[ez_arrow_class]','$skucode[ez_arrow]','Y','$skucode[freight_shipping]','$weight','$pkgs','$price[dim_weight]','$dimcharges',".mysql_real_escape_string($quantity_frompage).",'".$_SERVER['REMOTE_ADDR']."',NOW(),'$color','$mounting_option','$make_fit','$comments','$largeitem_scale','Y','$custom_color_status','$parameters_one',NOW(),'$waiver','$combine_product','$addtionalcharge')";						
		}
		else
		{
		  $sql_insert_shoppingcart="insert into pm_shopping_cart(customers_id,session_id,user_type,producttype,products_id,stock_custom,attributes_id,sku_id,sku_code,sku_name,shoppingcart_image,price,new_price,total,new_total,customer_price,customer_total,freight_shipping,weight,	number_pkgs,dim_weight,dim_charges,quantity,ip,created_date,background_color,mounting_option,make_fit,comments,largeitem_scale,custom_status,custom_color_status,parameters_one,last_modified,waiver,combine_product,additional_charges) values('$_SESSION[CID]','".mysql_real_escape_string(session_id())."','$_SESSION[user_type]','$price[producttype]','$product[products_id]','$product[stock_custom]','$skucode[material_code]','$skucode[sku_id]','$skucode[sku_code]','$skucode[material_description]','$skucode[shoppingcart_image]',$last_price,$price[price],$last_total,$totalprice,$last_price,$last_total,'$skucode[freight_shipping]','$weight','$pkgs','$price[dim_weight]','$dimcharges',".mysql_real_escape_string($quantity_frompage).",'".$_SERVER['REMOTE_ADDR']."',NOW(),'$color','$mounting_option','$make_fit','$comments','$largeitem_scale','Y','$custom_color_status','$parameters_one',NOW(),'$waiver','$combine_product','$addtionalcharge')";	
		}
		  //print $sql_insert_shoppingcart;
		  mysql_query($sql_insert_shoppingcart);	
		  $ID = mysql_insert_id();	
		  if($uploadfileid!='')
		  {
			  $find_file_database_sql="select s_id,customer_id,username,file_name,file_size,file_type,export_brimar from pm_customer_file_upload where id='$uploadfileid'";
			  $find_file_result=mysql_query($find_file_database_sql);
			  while($findfile_row=mysql_fetch_array($find_file_result))
			  {
				  $findfile[s_id]=$findfile_row['s_id'];
				  $findfile[customer_id]=$findfile_row['customer_id'];
				  $findfile[username]=$findfile_row['username'];
				  $findfile[file_name]=$findfile_row['file_name'];
				  $findfile[file_size]=$findfile_row['file_size'];
				  $findfile[file_type]=$findfile_row['file_type'];
				  $findfile[export_brimar]=$findfile_row['export_brimar'];
			  }
			  if(!$findfile[s_id])
			  {
				  
				 $sql_update_uploadfile="update pm_customer_file_upload set s_id='$ID' where id='$uploadfileid'";
				 mysql_query($sql_update_uploadfile);
			  }
			  else
			  {
			  	 $sql_insert_filedata="insert into pm_customer_file_upload (s_id,customer_id,username,file_name,file_size,file_type,export_brimar,create_date) values('$ID','$findfile[customer_id]','$findfile[username]','$findfile[file_name]','$findfile[file_size]','$findfile[file_type]','$findfile[export_brimar]',NOW())";
				 mysql_query($sql_insert_filedata);
			  }
		  }
		  $textcontentlabel=Textcustomcopy_Label;
		  $output=array();
		  $output[quantity]=$quantity_frompage;
		  
		  $output[sh_id]=$ID;
		  $text_detail_array=array();
		  $textlinecontent=$_REQUEST['line_1'];
		  $textlinecontent=strtoupper($textlinecontent);
		  $text_compression=$_REQUEST['line_1_compression'];
		  
		  /*if($product[template]=='customceilingmarkers')
		  {
			 $textsizeinput=$_REQUEST['select_text_size_line_1'].'"';
			 $textsizelabel=Textsize_Label;
			 $sql_insert_shopping_detail="insert into pm_shopping_cart_attributes(s_id,option_label1,option_value1,option_label2,option_value2,created_date,text_heading,compression_rate) values('$ID','$textcontentlabel','".mysql_real_escape_string($textlinecontent)."','$textsizelabel','$textsizeinput',NOW(),'$skucode[addtocart_heading]','$text_compression')";			
		  }*/
		  if(isset($_REQUEST['select_text_size_line_1']))
		  {
		  	$textsizeinput=$_REQUEST['select_text_size_line_1'].'"';
			$textsizelabel=Textsize_Label;
			$sql_insert_shopping_detail="insert into pm_shopping_cart_attributes(s_id,option_label1,option_value1,option_label2,option_value2,created_date,text_heading,compression_rate) values('$ID','$textsizelabel','$textsizeinput','$textcontentlabel','".mysql_real_escape_string($textlinecontent)."',NOW(),'$skucode[addtocart_heading]','$text_compression')";			
		  }
		  else
		  {
			 $sql_insert_shopping_detail="insert into pm_shopping_cart_attributes(s_id,option_label1,option_value1,created_date,text_heading,compression_rate) values('$ID','$textcontentlabel','".mysql_real_escape_string($textlinecontent)."',NOW(),'$skucode[addtocart_heading]','$text_compression')";			
		  }
  
		  /*if(isset($_REQUEST['stencil_layout']))
		  {
			 $third_label=Layout_Label;
			 $third_value=$_REQUEST['stencil_layout'];
			 $output[color]=$third_value;
			 $findimagecolor=$third_value;
		  }
		  else if(isset($_REQUEST['select_band']))
		  {
			 $third_label=Band_Label; 
			 $third_value=$_REQUEST['select_band'];
			 $output[color]=$third_value;
			 $findimagecolor=$third_value;
		  }
		  else
		  {
		  	 $output[color]=$color;
			 $findimagecolor=$color;
		  }*/	  
		  //print $sql_insert_shopping_detail;
		  mysql_query($sql_insert_shopping_detail);
		  $output[color]=$color; 
		  $text_detail_array[$i][text_content]=$textlinecontent;
		  $text_detail_array[$i][text_size]=$textsizeinput;
		  $text_detail_array[$i][text_compression]=$text_compression;//print $skucode[material_code].'material_code';
		  if($_SESSION[user_type]=='R')
			  $this->ResetCustomerListDiscountNew();		  
		  $custom_image=$this->APGetSearchCustomColorImage($product[product_number],$skucode[sku_code],$color);
		  $imagelink=WebSite.PathImgProductSkuShoppingCart.$custom_image; 		  
		  $num=$this->APShoppingCardProductCount();
		  $output[text_detail]=$text_detail_array;
		  $output[current_item_number]=$num;
		  $output[product_number]=$skucode[sku_code];
		  $output[image]=$imagelink;
		  $json = json_encode($output);
		  echo $json;	  
	}
	function APinsert_custom_ammonia_product_csv($product,$skucode,$price,$last_price,$totalprice,$last_total,$quantity_frompage,$color,$mounting_option,$make_fit,$textalignment,$textcontent,$textposition,$textsizeinput,$comments)
	{
		$weight=$price[weight]*$quantity_frompage;
		$pkgs=$price[number_pkgs]*$quantity_frompage;
		$dimcharges=$price[dim_charges]*$quantity_frompage;			
		$price[price]=round(10000*$price[price])/10000;
		$price[price] = number_format ($price[price], 4, ".", "");
		$last_total=round(10000*$last_total)/10000;
		$last_total = number_format ($last_total, 4, ".", "");		
		$totalprice=round(10000*$totalprice)/10000;
		$totalprice = number_format ($totalprice, 4, ".", "");	
		if($product[ez_pipe_markers]=='Y')
		{
		  $sql_insert_shoppingcart="insert into pm_shopping_cart(customers_id,session_id,user_type,producttype,products_id,stock_custom,attributes_id,sku_id,sku_code,sku_name,shoppingcart_image,price,new_price,total,new_total,customer_price,customer_total,ez_pipe_markers,ab_tape_sku_id,ab_tape_class,ab_tape,ab_tape_status,ez_arrow_sku_id,ez_arrow_class,ez_arrow,ez_arrow_status,freight_shipping,weight,	number_pkgs,dim_weight,dim_charges,quantity,ip,created_date,background_color,mounting_option,make_fit,comments) values('$_SESSION[CID]','".mysql_real_escape_string(session_id())."','$_SESSION[user_type]','$price[producttype]','$product[products_id]','$product[stock_custom]','$skucode[material_code]','$skucode[sku_id]','$skucode[sku_code]','$skucode[material_description]','$skucode[shoppingcart_image]',$last_price,$price[price],$last_total,$totalprice,$last_price,$last_total,'Y','$skucode[ab_sku_code]','$skucode[ab_tape_class]','$skucode[ab_tape]','Y','$skucode[ez_sku_code]','$skucode[ez_arrow_class]','$skucode[ez_arrow]','Y','$skucode[freight_shipping]','$weight','$pkgs','$price[dim_weight]','$dimcharges',".mysql_real_escape_string($quantity_frompage).",'".$_SERVER['REMOTE_ADDR']."',NOW(),'$color','$mounting_option','$make_fit','$comments')";						
		}
		else
		{
		  $sql_insert_shoppingcart="insert into pm_shopping_cart(customers_id,session_id,user_type,producttype,products_id,stock_custom,attributes_id,sku_id,sku_code,sku_name,shoppingcart_image,price,new_price,total,new_total,customer_price,customer_total,freight_shipping,weight,	number_pkgs,dim_weight,dim_charges,quantity,ip,created_date,background_color,mounting_option,make_fit,comments) values('$_SESSION[CID]','".mysql_real_escape_string(session_id())."','$_SESSION[user_type]','$price[producttype]','$product[products_id]','$product[stock_custom]','$skucode[material_code]','$skucode[sku_id]','$skucode[sku_code]','$skucode[material_description]','$skucode[shoppingcart_image]',$last_price,$price[price],$last_total,$totalprice,$last_price,$last_total,'$skucode[freight_shipping]','$weight','$pkgs','$price[dim_weight]','$dimcharges',".mysql_real_escape_string($quantity_frompage).",'".$_SERVER['REMOTE_ADDR']."',NOW(),'$color','$mounting_option','$make_fit','$comments')";	
		}
		//print $sql_insert_shoppingcart;
		mysql_query($sql_insert_shoppingcart);	
		$ID = mysql_insert_id();
		$textline_count=count($textcontent);
		$textsizelabel=Textsize_Label;
		$textcontentlabel=Textcustomcopy_Label;
		$bandslabel=Band_Label;	
		$textpositionlabel=Textposition_Label;		
		if($textline_count>0)
		{
			for($i=0;$i<$textline_count;$i++)
			{
				$textlinecontent=$textcontent[$i];
				$text_position=$textposition[$i];				
				$sql_insert_shopping_detail="insert into pm_shopping_cart_attributes(s_id,option_label1,option_value1,option_label2,option_value2,option_label3,option_value3,option_label4,option_value4,created_date,text_heading) values($ID,'$textsizelabel','$textsizeinput','$textcontentlabel','".mysql_real_escape_string($textlinecontent)."','$bandslabel','$textalignment','$textpositionlabel','$text_position',NOW(),'$skucode[addtocart_heading]')";			  
				  //print $sql_insert_shopping_detail;
				mysql_query($sql_insert_shopping_detail);	
			}
		}
		print "<script>location.href='".WebSite."shoppingcart.php"."'</script>"; 		
		$_SESSION['csvMsg'] = "<p>Successfully imported.</p>";
	}	
	function APinsert_custom_stencil_product_csv($product,$skucode,$price,$last_price,$totalprice,$last_total,$quantity_frompage,$color,$mounting_option,$make_fit,$textalignment,$textcontent,$textposition,$textsizeinput,$comments)
	{
		$weight=$price[weight]*$quantity_frompage;
		$pkgs=$price[number_pkgs]*$quantity_frompage;
		$dimcharges=$price[dim_charges]*$quantity_frompage;			
		$price[price]=round(10000*$price[price])/10000;
		$price[price] = number_format ($price[price], 4, ".", "");
		$last_total=round(10000*$last_total)/10000;
		$last_total = number_format ($last_total, 4, ".", "");		
		$totalprice=round(10000*$totalprice)/10000;
		$totalprice = number_format ($totalprice, 4, ".", "");	
		if($product[ez_pipe_markers]=='Y')
		{
		  $sql_insert_shoppingcart="insert into pm_shopping_cart(customers_id,session_id,user_type,producttype,products_id,stock_custom,attributes_id,sku_id,sku_code,sku_name,shoppingcart_image,price,new_price,total,new_total,customer_price,customer_total,ez_pipe_markers,ab_tape_sku_id,ab_tape_class,ab_tape,ab_tape_status,ez_arrow_sku_id,ez_arrow_class,ez_arrow,ez_arrow_status,freight_shipping,weight,	number_pkgs,dim_weight,dim_charges,quantity,ip,created_date,background_color,mounting_option,make_fit,comments) values('$_SESSION[CID]','".mysql_real_escape_string(session_id())."','$_SESSION[user_type]','$price[producttype]','$product[products_id]','$product[stock_custom]','$skucode[material_code]','$skucode[sku_id]','$skucode[sku_code]','$skucode[material_description]','$skucode[shoppingcart_image]',$last_price,$price[price],$last_total,$totalprice,$last_price,$last_total,'Y','$skucode[ab_sku_code]','$skucode[ab_tape_class]','$skucode[ab_tape]','Y','$skucode[ez_sku_code]','$skucode[ez_arrow_class]','$skucode[ez_arrow]','Y','$skucode[freight_shipping]','$weight','$pkgs','$price[dim_weight]','$dimcharges',".mysql_real_escape_string($quantity_frompage).",'".$_SERVER['REMOTE_ADDR']."',NOW(),'$color','$mounting_option','$make_fit','$comments')";						
		}
		else
		{
		  $sql_insert_shoppingcart="insert into pm_shopping_cart(customers_id,session_id,user_type,producttype,products_id,stock_custom,attributes_id,sku_id,sku_code,sku_name,shoppingcart_image,price,new_price,total,new_total,customer_price,customer_total,freight_shipping,weight,	number_pkgs,dim_weight,dim_charges,quantity,ip,created_date,background_color,mounting_option,make_fit,comments) values('$_SESSION[CID]','".mysql_real_escape_string(session_id())."','$_SESSION[user_type]','$price[producttype]','$product[products_id]','$product[stock_custom]','$skucode[material_code]','$skucode[sku_id]','$skucode[sku_code]','$skucode[material_description]','$skucode[shoppingcart_image]',$last_price,$price[price],$last_total,$totalprice,$last_price,$last_total,'$skucode[freight_shipping]','$weight','$pkgs','$price[dim_weight]','$dimcharges',".mysql_real_escape_string($quantity_frompage).",'".$_SERVER['REMOTE_ADDR']."',NOW(),'$color','$mounting_option','$make_fit','$comments')";	
		}
		//print $sql_insert_shoppingcart;
		mysql_query($sql_insert_shoppingcart);	
		$ID = mysql_insert_id();
		$textline_count=count($textcontent);
		$textsizelabel=Textsize_Label;
		$textcontentlabel=Textcustomcopy_Label;
		$layoutlabel=Layout_Label;	
		$textpositionlabel=Textposition_Label;	

		if($textline_count>0)
		{
			for($i=0;$i<$textline_count;$i++)
			{
				$textlinecontent=$textcontent[$i];
				$text_position=$textposition[$i];				
				$sql_insert_shopping_detail="insert into pm_shopping_cart_attributes(s_id,option_label1,option_value1,option_label2,option_value2,option_label3,option_value3,option_label4,option_value4,created_date,text_heading) values($ID,'$textsizelabel','$textsizeinput','$textcontentlabel','".mysql_real_escape_string($textlinecontent)."','$layoutlabel','$textalignment','$textpositionlabel','$text_position',NOW(),'$skucode[addtocart_heading]')";			  
				  //print $sql_insert_shopping_detail;
				mysql_query($sql_insert_shopping_detail);	
			}
		}
		print "<script>location.href='".WebSite."shoppingcart.php"."'</script>"; 		
		$_SESSION['csvMsg'] = "<p>Successfully imported.</p>";
	}	
	function APinsert_custom_nameplate_product_csv($product,$skucode,$price,$last_price,$totalprice,$last_total,$quantity_frompage,$color,$mounting_option,$make_fit,$textalignment,$textcontent,$textposition,$textsizeinput,$comments)
	{
		$weight=$price[weight]*$quantity_frompage;
		$pkgs=$price[number_pkgs]*$quantity_frompage;
		$dimcharges=$price[dim_charges]*$quantity_frompage;				
		$price[price]=round(10000*$price[price])/10000;
		$price[price] = number_format ($price[price], 4, ".", "");
		$last_total=round(10000*$last_total)/10000;
		$last_total = number_format ($last_total, 4, ".", "");		
		$totalprice=round(10000*$totalprice)/10000;
		$totalprice = number_format ($totalprice, 4, ".", "");	
		if($product[ez_pipe_markers]=='Y')
		{
		  $sql_insert_shoppingcart="insert into pm_shopping_cart(customers_id,session_id,user_type,producttype,products_id,stock_custom,attributes_id,sku_id,sku_code,sku_name,shoppingcart_image,price,new_price,total,new_total,customer_price,customer_total,ez_pipe_markers,ab_tape_sku_id,ab_tape_class,ab_tape,ab_tape_status,ez_arrow_sku_id,ez_arrow_class,ez_arrow,ez_arrow_status,freight_shipping,weight,number_pkgs,dim_weight,dim_charges,quantity,ip,created_date,background_color,mounting_option,make_fit,comments) values('$_SESSION[CID]','".mysql_real_escape_string(session_id())."','$_SESSION[user_type]','$price[producttype]','$product[products_id]','$product[stock_custom]','$skucode[material_code]','$skucode[sku_id]','$skucode[sku_code]','$skucode[material_description]','$skucode[shoppingcart_image]',$last_price,$price[price],$last_total,$totalprice,$last_price,$last_total,'Y','$skucode[ab_sku_code]','$skucode[ab_tape_class]','$skucode[ab_tape]','Y','$skucode[ez_sku_code]','$skucode[ez_arrow_class]','$skucode[ez_arrow]','Y','$skucode[freight_shipping]','$weight','$pkgs','$price[dim_weight]','$dimcharges',".mysql_real_escape_string($quantity_frompage).",'".$_SERVER['REMOTE_ADDR']."',NOW(),'$color','$mounting_option','$make_fit','$comments')";						
		}
		else
		{
		  $sql_insert_shoppingcart="insert into pm_shopping_cart(customers_id,session_id,user_type,producttype,products_id,stock_custom,attributes_id,sku_id,sku_code,sku_name,shoppingcart_image,price,new_price,total,new_total,customer_price,customer_total,freight_shipping,weight,number_pkgs,dim_weight,dim_charges,quantity,ip,created_date,background_color,mounting_option,make_fit,comments) values('$_SESSION[CID]','".mysql_real_escape_string(session_id())."','$_SESSION[user_type]','$price[producttype]','$product[products_id]','$product[stock_custom]','$skucode[material_code]','$skucode[sku_id]','$skucode[sku_code]','$skucode[material_description]','$skucode[shoppingcart_image]',$last_price,$price[price],$last_total,$totalprice,$last_price,$last_total,'$skucode[freight_shipping]','$weight','$pkgs','$price[dim_weight]','$dimcharges',".mysql_real_escape_string($quantity_frompage).",'".$_SERVER['REMOTE_ADDR']."',NOW(),'$color','$mounting_option','$make_fit','$comments')";	
		}
		//print $sql_insert_shoppingcart;
		mysql_query($sql_insert_shoppingcart);	
		$ID = mysql_insert_id();
		$textline_count=count($textcontent);
		$textsizelabel=Textsize_Label;
		$textcontentlabel=Textcustomcopy_Label;
		$textarrangementlabel=Textarrangement_Label;
		$textpositionlabel=Textposition_Label;		
		if($textline_count>0)
		{
			for($i=0;$i<$textline_count;$i++)
			{
				$textlinecontent=$textcontent[$i];
				$text_position=$textposition[$i];				
				$sql_insert_shopping_detail="insert into pm_shopping_cart_attributes(s_id,option_label1,option_value1,option_label2,option_value2,option_label3,option_value3,option_label4,option_value4,created_date,text_heading) values($ID,'$textsizelabel','$textsizeinput','$textcontentlabel','".mysql_real_escape_string($textlinecontent)."','$textarrangementlabel','$textalignment','$textpositionlabel','$text_position',NOW(),'$skucode[addtocart_heading]')";			  
				//print $sql_insert_shopping_detail;
				mysql_query($sql_insert_shopping_detail);	
			}
		}
		print "<script>location.href='".WebSite."shoppingcart.php"."'</script>"; 		
		$_SESSION['csvMsg'] = "<p>Successfully imported.</p>";
	}
	function APinsert_custom_nameplate_productNonSequentialValve_csv($product,$skucode,$price,$last_price,$totalprice,$last_total,$quantity_frompage,$color,$mounting_option,$make_fit,$textcontent,$textposition,$textsizeinput,$comments)
	{
		$weight=$price[weight]*$quantity_frompage;
		$pkgs=$price[number_pkgs]*$quantity_frompage;
		$dimcharges=$price[dim_charges]*$quantity_frompage;			
		$price[price]=round(10000*$price[price])/10000;
		$price[price] = number_format ($price[price], 4, ".", "");
		$last_total=round(10000*$last_total)/10000;
		$last_total = number_format ($last_total, 4, ".", "");		
		$totalprice=round(10000*$totalprice)/10000;
		$totalprice = number_format ($totalprice, 4, ".", "");	
		if($product[ez_pipe_markers]=='Y')
		{
		  $sql_insert_shoppingcart="insert into pm_shopping_cart(customers_id,session_id,user_type,producttype,products_id,stock_custom,attributes_id,sku_id,sku_code,sku_name,shoppingcart_image,price,new_price,total,new_total,customer_price,customer_total,ez_pipe_markers,ab_tape_sku_id,ab_tape_class,ab_tape,ab_tape_status,ez_arrow_sku_id,ez_arrow_class,ez_arrow,ez_arrow_status,freight_shipping,weight,number_pkgs,dim_weight,dim_charges,quantity,ip,created_date,background_color,mounting_option,make_fit,comments) values('$_SESSION[CID]','".mysql_real_escape_string(session_id())."','$_SESSION[user_type]','$price[producttype]','$product[products_id]','$product[stock_custom]','$skucode[material_code]','$skucode[sku_id]','$skucode[sku_code]','$skucode[material_description]','$skucode[shoppingcart_image]',$last_price,$price[price],$last_total,$totalprice,$last_price,$last_total,'Y','$skucode[ab_sku_code]','$skucode[ab_tape_class]','$skucode[ab_tape]','Y','$skucode[ez_sku_code]','$skucode[ez_arrow_class]','$skucode[ez_arrow]','Y','$skucode[freight_shipping]','$weight','$pkgs','$price[dim_weight]','$dimcharges',".mysql_real_escape_string($quantity_frompage).",'".$_SERVER['REMOTE_ADDR']."',NOW(),'$color','$mounting_option','$make_fit','$comments')";						
		}
		else
		{
		  $sql_insert_shoppingcart="insert into pm_shopping_cart(customers_id,session_id,user_type,producttype,products_id,stock_custom,attributes_id,sku_id,sku_code,sku_name,shoppingcart_image,price,new_price,total,new_total,customer_price,customer_total,freight_shipping,weight,number_pkgs,dim_weight,dim_charges,quantity,ip,created_date,background_color,mounting_option,make_fit,comments) values('$_SESSION[CID]','".mysql_real_escape_string(session_id())."','$_SESSION[user_type]','$price[producttype]','$product[products_id]','$product[stock_custom]','$skucode[material_code]','$skucode[sku_id]','$skucode[sku_code]','$skucode[material_description]','$skucode[shoppingcart_image]',$last_price,$price[price],$last_total,$totalprice,$last_price,$last_total,'$skucode[freight_shipping]','$weight','$weight','$pkgs','$dimcharges',".mysql_real_escape_string($quantity_frompage).",'".$_SERVER['REMOTE_ADDR']."',NOW(),'$color','$mounting_option','$make_fit','$comments')";	
		}
		  //print $sql_insert_shoppingcart;
		  mysql_query($sql_insert_shoppingcart);	
		  $ID = mysql_insert_id();
		  $textline_count=count($textcontent);
		  $textsizelabel=Textsize_Label;
		  $textcontentlabel=Textcustomcopy_Label;
		  $textarrangementlabel=Textarrangement_Label;
		  $textpositionlabel=Textposition_Label;				  
		  if($textline_count>0)
		  {
			  for($i=0;$i<$textline_count;$i++)
			  {
				  $textlinecontent=$textcontent[$i];
				  $text_position=$textposition[$i];
				  $text_sizeinput=$textsizeinput[$i];
				  $sql_insert_shopping_detail="insert into pm_shopping_cart_attributes(s_id,option_label1,option_value1,option_label2,option_value2,option_label3,option_value3,option_label4,option_value4,created_date,text_heading) values($ID,'$textsizelabel','$text_sizeinput','$textcontentlabel','".mysql_real_escape_string($textlinecontent)."','$textarrangementlabel','','$textpositionlabel','$text_position',NOW(),'$skucode[addtocart_heading]')";
				  //print $sql_insert_shopping_detail;
				  mysql_query($sql_insert_shopping_detail);	
			  }
		  }	
		   print "<script>location.href='".WebSite."shoppingcart.php"."'</script>"; 
		   $_SESSION['csvMsg'] = "<p>Successfully imported.</p>";
	}	
	function APinsert_custom_nameplate_product_csv_valvetag($product,$skucode,$price,$last_price,$totalprice,$last_total,$quantity_frompage,$make_fit,$textcontent,$textsizeinput,$start_number,$end_number,$comments)
	{
		$weight=$price[weight]*$quantity_frompage;
		$pkgs=$price[number_pkgs]*$quantity_frompage;
		$dimcharges=$price[dim_charges]*$quantity_frompage;			
		$price[price]=round(10000*$price[price])/10000;
		$price[price] = number_format ($price[price], 4, ".", "");
		$last_total=round(10000*$last_total)/10000;
		$last_total = number_format ($last_total, 4, ".", "");		
		$totalprice=round(10000*$totalprice)/10000;
		$totalprice = number_format ($totalprice, 4, ".", "");	
		if($product[ez_pipe_markers]=='Y')
		{
		  $sql_insert_shoppingcart="insert into pm_shopping_cart(customers_id,session_id,user_type,producttype,products_id,stock_custom,attributes_id,sku_id,sku_code,sku_name,shoppingcart_image,price,new_price,total,new_total,customer_price,customer_total,ez_pipe_markers,ab_tape_sku_id,ab_tape_class,ab_tape,ab_tape_status,ez_arrow_sku_id,ez_arrow_class,ez_arrow,ez_arrow_status,freight_shipping,weight,number_pkgs,dim_weight,dim_charges,quantity,ip,created_date,background_color,mounting_option,make_fit,comments) values('$_SESSION[CID]','".mysql_real_escape_string(session_id())."','$_SESSION[user_type]','$price[producttype]','$product[products_id]','$product[stock_custom]','$skucode[material_code]','$skucode[sku_id]','$skucode[sku_code]','$skucode[material_description]','$skucode[shoppingcart_image]',$last_price,$price[price],$last_total,$totalprice,$last_price,$last_total,'Y','$skucode[ab_sku_code]','$skucode[ab_tape_class]','$skucode[ab_tape]','Y','$skucode[ez_sku_code]','$skucode[ez_arrow_class]','$skucode[ez_arrow]','Y','$skucode[freight_shipping]','$weight','$pkgs','$price[dim_weight]','$dimcharges',".mysql_real_escape_string($quantity_frompage).",'".$_SERVER['REMOTE_ADDR']."',NOW(),'$color','$mounting_option','$make_fit','$comments')";						
		}
		else
		{
		  $sql_insert_shoppingcart="insert into pm_shopping_cart(customers_id,session_id,user_type,producttype,products_id,stock_custom,attributes_id,sku_id,sku_code,sku_name,shoppingcart_image,price,new_price,total,new_total,customer_price,customer_total,freight_shipping,weight,number_pkgs,dim_weight,dim_charges,quantity,ip,created_date,background_color,mounting_option,make_fit,comments) values('$_SESSION[CID]','".mysql_real_escape_string(session_id())."','$_SESSION[user_type]','$price[producttype]','$product[products_id]','$product[stock_custom]','$skucode[material_code]','$skucode[sku_id]','$skucode[sku_code]','$skucode[material_description]','$skucode[shoppingcart_image]',$last_price,$price[price],$last_total,$totalprice,$last_price,$last_total,'$skucode[freight_shipping]','$weight','$pkgs','$price[dim_weight]','$dimcharges',".mysql_real_escape_string($quantity_frompage).",'".$_SERVER['REMOTE_ADDR']."',NOW(),'$color','$mounting_option','$make_fit','$comments')";	
		}
		 //print $sql_insert_shoppingcart;
		  mysql_query($sql_insert_shoppingcart);	
		  $ID = mysql_insert_id();
		  $textline_count=count($textcontent);
		  $textsizelabel=Textsize_Label;
		  $textcontentlabel=Textcustomcopy_Label;
		  $startnumberlabel=Startnumber_Label;
		  $endnumberlabel=Endnumber_Label;
		  if($textline_count>0)
		  {
			  for($i=0;$i<$textline_count;$i++)
			  {	
			  	  $textlinecontent=$textcontent[$i];
				  if($textlinecontent!=''||$textlinecontent==''&&$start_number!='')
				  {
					  $sql_insert_shopping_detail="insert into pm_shopping_cart_attributes(s_id,option_label1,option_value1,option_label2,option_value2,option_label3,option_value3,option_label4,option_value4,created_date,text_heading) values($ID,'$textsizelabel','$textsizeinput','$textcontentlabel','".mysql_real_escape_string($textlinecontent)."','$startnumberlabel','$start_number','$endnumberlabel','$end_number',NOW(),'$skucode[addtocart_heading]')";//put position 0 for custom valve tag to distingush in shoppingcart.php display
					  //print $sql_insert_shopping_detail;
					  mysql_query($sql_insert_shopping_detail);	
				  }
			  }
		  }
		   print "<script>location.href='".WebSite."shoppingcart.php"."'</script>";
		   $_SESSION['csvMsg'] = "<p>Successfully imported.</p>";
	}
	function APupdateCustomshopppingcartrecords($shoppingcartid,$currentprice,$listprice,$newcolor,$new_mounting_option,$new_make_fit,$new_quantity,$comments,$new_total,$listtotal,$addtionalcharge)//sku code doesn't change
	{
		/*$displayprice=$this->numberround($currentprice,2);
		$displaylistprice=$this->numberround($listprice,2);
		if($min_quantity_below&&($new_quantity<$min_quantity_below))
		{
			$new_total=$displayprice*$new_quantity+$min_quantity_charge+$additional_charge;
			$listtotal=$displaylistprice*$new_quantity+$min_quantity_charge+$additional_charge;			
		}
		else
		{
			$new_total=$displayprice*$new_quantity+$additional_charge;
			$listtotal=$displaylistprice*$new_quantity+$additional_charge;
		}*/	
		$uploadfile=$_REQUEST['uploadfilename'];
		$uploadfileid=$_REQUEST['uploadfileid'];
		$org_filename=$this->GetCustomFileName($shoppingcartid);
		if($org_filename[file_name]!=''&&$uploadfile=='')
		{
			$fileatpath='../upload/'.$filename;
			$sql_deletefile="delete from pm_customer_file_upload where id='$uploadfileid'";
			mysql_query($sql_deletefile);
			unlink($fileatpath);			
		}
		else if($org_filename[file_name]!=''&&$uploadfile!='')
		{
			$sql_emptysid="update pm_customer_file_upload set s_id='' where s_id='$shoppingcartid'";
			mysql_query($sql_emptysid);	
			$sql_updatefile="update pm_customer_file_upload set s_id='$shoppingcartid' where id='$uploadfileid'";
			mysql_query($sql_updatefile);		
		}
		else if($org_filename[file_name]==''&&$uploadfile!='')
		{
			$sql_updatefilesid="update pm_customer_file_upload set s_id='$shoppingcartid' where id='$uploadfileid'";
			mysql_query($sql_updatefilesid);			
		}
		if($_SESSION[user_type]=='R')//list price would change because it is the closest price to the current
		{
			$sql_update_shoppingcart="update pm_shopping_cart set price=".$listprice.",total=".$listtotal.",customer_price=".$listprice.",customer_total=".$listtotal.",new_price=".$currentprice.",new_total=".$new_total.",additional_charges='".$addtionalcharge."',background_color='$newcolor' ,mounting_option='$new_mounting_option',make_fit='$new_make_fit',quantity='$new_quantity',comments='$comments',last_modified=NOW() where id=$shoppingcartid and session_id='".mysql_real_escape_string(session_id())."'";
			$this->ResetCustomerListDiscountNew();
		}
		else//list price does not change because it is the first price
			$sql_update_shoppingcart="update pm_shopping_cart set new_price=".$currentprice.",new_total=".$new_total." ,additional_charges='".$addtionalcharge."',background_color='$newcolor' ,mounting_option='$new_mounting_option',make_fit='$new_make_fit',quantity='$new_quantity',comments='$comments',last_modified=NOW() where id=$shoppingcartid and session_id='".mysql_real_escape_string(session_id())."'";
		mysql_query($sql_update_shoppingcart);
		//print $sql_update_shoppingcart;
		$sql_orgtextlinecount="select count(option_value3) as count,text_heading from pm_shopping_cart_attributes where s_id=$shoppingcartid";
		$orgcount_result=mysql_query($sql_orgtextlinecount);
		while($orgcount_row=mysql_fetch_array($orgcount_result))
		{
		   $orgcount=$orgcount_row['count'];
		   $orgtextheading=$orgcount_row['text_heading'];
		}			
		$r=0;		
		$textline_count_new=$_REQUEST['nooftextlines'];		
		for($p=$textline_count_new;$p>0;$p--)
		{
			$textlinecontent=$_REQUEST['line_'.$p];
			if($textlinecontent!='')
			{ 
				break;
			}
			else
			{
				$r++;
			}
		}
		$textline_count_new=$textline_count_new-$r;
		
		if($textline_count_new<=$orgcount)//may be smaller delete some lines
		{
			if($textline_count_new>0)
			{
				for($i=1;$i<=$textline_count_new;$i++)
				{
					$textlinecontent=$_REQUEST['line_'.$i];
					$textlinecontent=strtoupper($textlinecontent);
					$textsizeinput=$_REQUEST['select_text_size_line_'.$i].'"';
					$text_compression=$_REQUEST['line_'.$i.'_compression'];
					if(isset($_REQUEST["sku_id"]))
					{
						$sql_update_shoppingcartdetail="update pm_shopping_cart_attributes set option_value2='$textsizeinput',option_value3='".mysql_real_escape_string($textlinecontent)."',compression_rate='$text_compression' where s_id=$shoppingcartid and option_value1='$i'";
					}
					else
					{
						$textorientation=$_REQUEST['text-orientation_line_'.$i];
						$sql_update_shoppingcartdetail="update pm_shopping_cart_attributes set option_value2='$textsizeinput',option_value3='".mysql_real_escape_string($textlinecontent)."',option_value4='$textorientation',compression_rate='$text_compression' where s_id=$shoppingcartid and option_value1='$i'";
					}
					mysql_query($sql_update_shoppingcartdetail);
					//print $sql_update_shoppingcartdetail;
				}
			}
			if($textline_count_new<$orgcount)
			{
				for($d=$orgcount;$d>$textline_count_new;$d--)
				{
					$sql_delete_shoppingcartdetail="delete from pm_shopping_cart_attributes where s_id=$shoppingcartid and option_value1='$d'";
					//print $sql_delete_shoppingcartdetail;
					mysql_query($sql_delete_shoppingcartdetail);
				}
			}
		}
		else if($textline_count_new>$orgcount)
		{
			if($orgcount>0)
			{
				for($i=1;$i<=$orgcount;$i++)
				{
					$textlinecontent=$_REQUEST['line_'.$i];
					$textlinecontent=strtoupper($textlinecontent);
					$textsizeinput=$_REQUEST['select_text_size_line_'.$i].'"';					
					$text_compression=$_REQUEST['line_'.$i.'_compression'];
					if(isset($_REQUEST["sku_id"]))
					{
						$sql_update_shoppingcartdetail="update pm_shopping_cart_attributes set option_value2='$textsizeinput',option_value3='".mysql_real_escape_string($textlinecontent)."',compression_rate='$text_compression' where s_id=$shoppingcartid and option_value1='$i'";
					}
					else
					{
						$textorientation=$_REQUEST['text-orientation_line_'.$i];
						$sql_update_shoppingcartdetail="update pm_shopping_cart_attributes set option_value2='$textsizeinput',option_value3='".mysql_real_escape_string($textlinecontent)."',option_value4='$textorientation',compression_rate='$text_compression' where s_id=$shoppingcartid and option_value1='$i'";
					}
					mysql_query($sql_update_shoppingcartdetail);
					//print $sql_update_shoppingcartdetail;
				}
			}
			$textsizelabel=Textsize_Label;
			$textcontentlabel=Textcustomcopy_Label;
			$textarrangementlabel=Textarrangement_Label;
			$textpositionlabel=Textposition_Label;
			$text_compression=$_REQUEST['line_'.$i.'_compression'];
			for($n=($orgcount+1);$n<=$textline_count_new;$n++)
			{
				$textlinecontent=$_REQUEST['line_'.$n];
				$textlinecontent=strtoupper($textlinecontent);
				$textsizeinput=$_REQUEST['select_text_size_line_'.$n].'"';			
				$text_compression=$_REQUEST['line_'.$i.'_compression'];
				if(isset($_REQUEST["sku_id"]))
				{
					$sql_insert_shopping_detail="insert into pm_shopping_cart_attributes(s_id,option_label1,option_value1,option_label2,option_value2,option_label3,option_value3,created_date,text_heading,compression_rate) values('$shoppingcartid','$textpositionlabel','$n','$textsizelabel','$textsizeinput','$textcontentlabel','".mysql_real_escape_string($textlinecontent)."',NOW(),'$orgtextheading','$text_compression')";
				}
				else
				{
					$textorientation=$_REQUEST['text-orientation_line_'.$n];
					$sql_insert_shopping_detail="insert into pm_shopping_cart_attributes(s_id,option_label1,option_value1,option_label2,option_value2,option_label3,option_value3,option_label4,option_value4,created_date,text_heading,compression_rate) values('$shoppingcartid','$textpositionlabel','$n','$textsizelabel','$textsizeinput','$textcontentlabel','".mysql_real_escape_string($textlinecontent)."','$textarrangementlabel','$textorientation',NOW(),'$orgtextheading','$text_compression')";
				}
				//print $sql_insert_shopping_detail;
				mysql_query($sql_insert_shopping_detail);			
			}
		}
		  $output='successupdate';
		  $json = json_encode($output);
		  echo $json;				
	}
	function APupdateCustomNormalshopppingcartrecords($shoppingcartid,$currentprice,$listprice,$newcolor,$new_mounting_option,$new_make_fit,$new_quantity,$comments,$parameters_one,$new_total,$listtotal,$addtionalcharge)//sku code doesn't change
	{
		$uploadfile=$_REQUEST['uploadfilename'];
		$uploadfileid=$_REQUEST['uploadfileid'];
		$org_filename=$this->GetCustomFileName($shoppingcartid);
		if($org_filename[file_name]!=''&&$uploadfile=='')
		{
			$fileatpath='../upload/'.$filename;
			$sql_deletefile="delete from pm_customer_file_upload where id='$uploadfileid'";
			mysql_query($sql_deletefile);
			unlink($fileatpath);			
		}
		else if($org_filename[file_name]!=''&&$uploadfile!='')
		{
			$sql_emptysid="update pm_customer_file_upload set s_id='' where s_id='$shoppingcartid'";
			mysql_query($sql_emptysid);	
			$sql_updatefile="update pm_customer_file_upload set s_id='$shoppingcartid' where id='$uploadfileid'";
			mysql_query($sql_updatefile);			
		}
		else if($org_filename[file_name]==''&&$uploadfile!='')
		{
			$sql_updatefilesid="update pm_customer_file_upload set s_id='$shoppingcartid' where id='$uploadfileid'";
			mysql_query($sql_updatefilesid);			
		}		
		/*$displayprice=$this->numberround($currentprice,2);
		$displaylistprice=$this->numberround($listprice,2);
		if($min_quantity_below&&($new_quantity<$min_quantity_below))
		{
			$new_total=$displayprice*$new_quantity+$min_quantity_charge+$additional_charge;
			$listtotal=$displaylistprice*$new_quantity+$min_quantity_charge+$additional_charge;			
		}
		else
		{
			$new_total=$displayprice*$new_quantity+$additional_charge;
			$listtotal=$displaylistprice*$new_quantity+$additional_charge;
		}*/		
		if(isset($_REQUEST['largeitem_scale']))
		{
		 	$largeitem_scale=$_REQUEST['largeitem_scale'];
			$sql_shoppingcart=",largeitem_scale='$largeitem_scale'";
		}
		if(isset($_REQUEST['waive_maximum']))
		{
			$waiver=$_REQUEST['waive_maximum'];
		}
		else
		{
			$waiver='';
		}
		if($_SESSION[user_type]=='R')//list price would change because it is the closest price to the current
		{
			$sql_update_shoppingcart="update pm_shopping_cart set price=".$listprice.",total=".$listtotal.",customer_price=".$listprice.",customer_total=".$listtotal.",new_price=".$currentprice.",new_total=".$new_total.",additional_charges='".$addtionalcharge."',background_color='$newcolor' ,mounting_option='$new_mounting_option',make_fit='$new_make_fit',quantity='$new_quantity',comments='$comments',parameters_one='$parameters_one',last_modified=NOW(),waiver='$waiver'".$sql_shoppingcart." where id=$shoppingcartid and session_id='".mysql_real_escape_string(session_id())."'";
			$this->ResetCustomerListDiscountNew();	
		}
		else//list price does not change because it is the first price
			$sql_update_shoppingcart="update pm_shopping_cart set new_price=".$currentprice.",new_total=".$new_total." ,additional_charges='".$addtionalcharge."',background_color='$newcolor' ,mounting_option='$new_mounting_option',make_fit='$new_make_fit',quantity='$new_quantity',comments='$comments',parameters_one='$parameters_one',last_modified=NOW(),waiver='$waiver'".$sql_shoppingcart." where id=$shoppingcartid and session_id='".mysql_real_escape_string(session_id())."'";
		mysql_query($sql_update_shoppingcart);
		//print $sql_update_shoppingcart;
		$sql_orgtextlinecount="select text_heading from pm_shopping_cart_attributes where s_id=$shoppingcartid";
		$orgcount_result=mysql_query($sql_orgtextlinecount);
		while($orgcount_row=mysql_fetch_array($orgcount_result))
		{
		   $orgtextheading=$orgcount_row['text_heading'];
		}					
		$textlinecontent=$_REQUEST['line_1'];
		$textlinecontent=strtoupper($textlinecontent);
		/*if($template=='customceilingmarkers')
		{
			$textsizeinput=$_REQUEST['select_text_size_line_1'].'"';
			$sql_update_shoppingcartdetail="update pm_shopping_cart_attributes set option_value1='".mysql_real_escape_string($textlinecontent)."',option_value2='$textsizeinput',compression_rate='$text_compression' where s_id=$shoppingcartid";
		}
		else */if(isset($_REQUEST['select_text_size_line_1']))
		{
			$textsizeinput=$_REQUEST['select_text_size_line_1'].'"';
			$sql_update_shoppingcartdetail="update pm_shopping_cart_attributes set option_value1='$textsizeinput',option_value2='".mysql_real_escape_string($textlinecontent)."',compression_rate='$text_compression' where s_id=$shoppingcartid";
		}
		else
		{
			$sql_update_shoppingcartdetail="update pm_shopping_cart_attributes set option_value1='".mysql_real_escape_string($textlinecontent)."',compression_rate='$text_compression' where s_id=$shoppingcartid";
		}
		$text_compression=$_REQUEST['line_1_compression'];
		/*if(isset($_REQUEST['stencil_layout']))
		{
			$update_sql=",option_value3='".$_REQUEST['stencil_layout']."'";
		}
		else if(isset($_REQUEST['select_band']))
		{
			$update_sql=",option_value3='".$_REQUEST['select_band']."'";
		}*/		
		
		mysql_query($sql_update_shoppingcartdetail);
		//print $sql_update_shoppingcartdetail;


		  $output='successupdate';
		  $json = json_encode($output);
		  echo $json;				
	}
	function APcheckshoppingcartfromsession_UpdateCase()
	{
		    $ID=$_REQUEST['sh_id'];
			$sql_shoppingcart_list="select s.id,s.quantity,s.attributes_id,s.sku_code,s.producttype,d.additional_charge from pm_shopping_cart s,pm_products_sku_description d where s.session_id='".mysql_real_escape_string(session_id())."' and s.id<>$ID and s.sku_code=d.sku_code and s.user_type='$_SESSION[user_type]' and s.shopping_save='N'";
			//print $sql_shoppingcart_list;
			$shoppingcart_result=mysql_query($sql_shoppingcart_list);
			while($shoppingcart_row=mysql_fetch_array($shoppingcart_result))
			{
			   $shoppingcartinfo[]=$shoppingcart_row;
			}	
			return $shoppingcartinfo;
	}		
	function APupdateCustomshopppingcartrecords_newskucode($shoppingcartid,$product_ez_pipe_markers,$skucode,$currentprice,$listprice,$newcolor,$new_mounting_option,$new_make_fit,$new_quantity,$comments,$new_total,$listtotal,$addtionalcharge)
	{
		/*$displayprice=$this->numberround($currentprice,2);
		$displaylistprice=$this->numberround($listprice,2);
		if($min_quantity_below&&($new_quantity<$min_quantity_below))
		{
			$new_total=$displayprice*$new_quantity+$min_quantity_charge+$additional_charge;
			$listtotal=$displaylistprice*$new_quantity+$min_quantity_charge+$additional_charge;			
		}
		else
		{
			$new_total=$displayprice*$new_quantity+$additional_charge;
			$listtotal=$displaylistprice*$new_quantity+$additional_charge;
		}*/	
		$uploadfile=$_REQUEST['uploadfilename'];
		$uploadfileid=$_REQUEST['uploadfileid'];
		$org_filename=$this->GetCustomFileName($shoppingcartid);
		if($org_filename[file_name]!=''&&$uploadfile=='')
		{
			$fileatpath='../upload/'.$filename;
			$sql_deletefile="delete from pm_customer_file_upload where id='$uploadfileid'";
			mysql_query($sql_deletefile);
			unlink($fileatpath);			
		}
		else if($org_filename[file_name]!=''&&$uploadfile!='')
		{
			$sql_emptysid="update pm_customer_file_upload set s_id='' where s_id='$shoppingcartid'";
			mysql_query($sql_emptysid);	
			$sql_updatefile="update pm_customer_file_upload set s_id='$shoppingcartid' where id='$uploadfileid'";
			mysql_query($sql_updatefile);		
		}
		else if($org_filename[file_name]==''&&$uploadfile!='')
		{
			$sql_updatefilesid="update pm_customer_file_upload set s_id='$shoppingcartid' where id='$uploadfileid'";
			mysql_query($sql_updatefilesid);			
		}		
		if($product_ez_pipe_markers=='Y')
		{
			if($_SESSION[user_type]=='R')
			{
				$sql_update_shoppingcart="update pm_shopping_cart set attributes_id='$skucode[material_code]',sku_id='$skucode[sku_id]',sku_code='$skucode[sku_code]',sku_name='$skucode[material_description]',shoppingcart_image='$skucode[shoppingcart_image]',ez_pipe_markers='Y',ab_tape_sku_id='$skucode[ab_sku_code]',ab_tape_class='$skucode[ab_tape_class]',ab_tape='$skucode[ab_tape]',ab_tape_status='N',ez_arrow_sku_id='$skucode[ez_sku_code]',ez_arrow_class='$skucode[ez_arrow_class]',ez_arrow='$skucode[ez_arrow]',ez_arrow_status='N',freight_shipping='$skucode[freight_shipping]',price=".$listprice.",total=".$listtotal.",customer_price=".$listprice.",customer_total=".$listtotal.",new_price=".$currentprice.",new_total=".$new_total.",additional_charges='".$addtionalcharge."',background_color='$newcolor' ,mounting_option='$new_mounting_option',make_fit='$new_make_fit',quantity='$new_quantity',comments='$comments',last_modified=NOW() where id=$shoppingcartid and session_id='".mysql_real_escape_string(session_id())."'";
				$this->ResetCustomerListDiscountNew();	
			}
			else
				$sql_update_shoppingcart="update pm_shopping_cart set attributes_id='$skucode[material_code]',sku_id='$skucode[sku_id]',sku_code='$skucode[sku_code]',sku_name='$skucode[material_description]',shoppingcart_image='$skucode[shoppingcart_image]',ez_pipe_markers='Y',ab_tape_sku_id='$skucode[ab_sku_code]',ab_tape_class='$skucode[ab_tape_class]',ab_tape='$skucode[ab_tape]',ab_tape_status='N',ez_arrow_sku_id='$skucode[ez_sku_code]',ez_arrow_class='$skucode[ez_arrow_class]',ez_arrow='$skucode[ez_arrow]',ez_arrow_status='N',freight_shipping='$skucode[freight_shipping]',new_price=".$currentprice.",new_total=".$new_total.",additional_charges='".$addtionalcharge."',background_color='$newcolor' ,mounting_option='$new_mounting_option',make_fit='$new_make_fit',quantity='$new_quantity',comments='$comments',last_modified=NOW() where id=$shoppingcartid and session_id='".mysql_real_escape_string(session_id())."'";		
		}
		else
		{
			if($_SESSION[user_type]=='R')
				$sql_update_shoppingcart="update pm_shopping_cart set attributes_id='$skucode[material_code]',sku_id='$skucode[sku_id]',sku_code='$skucode[sku_code]',sku_name='$skucode[material_description]',shoppingcart_image='$skucode[shoppingcart_image]',freight_shipping='$skucode[freight_shipping]',price=".$listprice.",total=".$listtotal.",customer_price=".$listprice.",customer_total=".$listtotal.",new_price=".$currentprice.",new_total=".$new_total.",additional_charges='".$addtionalcharge."',background_color='$newcolor' ,mounting_option='$new_mounting_option',make_fit='$new_make_fit',quantity='$new_quantity',comments='$comments',last_modified=NOW() where id=$shoppingcartid and session_id='".mysql_real_escape_string(session_id())."'";
			else
				$sql_update_shoppingcart="update pm_shopping_cart set attributes_id='$skucode[material_code]',sku_id='$skucode[sku_id]',sku_code='$skucode[sku_code]',sku_name='$skucode[material_description]',shoppingcart_image='$skucode[shoppingcart_image]',freight_shipping='$skucode[freight_shipping]',new_price=".$currentprice.",new_total=".$new_total.",additional_charges='".$addtionalcharge."',background_color='$newcolor' ,mounting_option='$new_mounting_option',make_fit='$new_make_fit',quantity='$new_quantity',comments='$comments',last_modified=NOW() where id=$shoppingcartid and session_id='".mysql_real_escape_string(session_id())."'";
		}
		mysql_query($sql_update_shoppingcart);					
		//print $sql_update_shoppingcart;
		$sql_orgtextlinecount="select count(option_value3) as count from pm_shopping_cart_attributes where s_id=$shoppingcartid";
		$orgcount_result=mysql_query($sql_orgtextlinecount);
		while($orgcount_row=mysql_fetch_array($orgcount_result))
		{
		   $orgcount=$orgcount_row['count'];
		}
		$r=0;		
		$textline_count_new=$_REQUEST['nooftextlines'];		
		for($p=$textline_count_new;$p>0;$p--)
		{
			$textlinecontent=$_REQUEST['line_'.$p];
			if($textlinecontent!='')
			{ 
				break;
			}
			else
			{
				$r++;
			}
		}
		$textline_count_new=$textline_count_new-$r;
		
		if($textline_count_new<=$orgcount)//may be smaller delete some lines
		{
			if($textline_count_new>0)
			{
				for($i=1;$i<=$textline_count_new;$i++)
				{
					$textlinecontent=$_REQUEST['line_'.$i];
					$textlinecontent=strtoupper($textlinecontent);
					$textsizeinput=$_REQUEST['select_text_size_line_'.$i].'"';		
					$text_compression=$_REQUEST['line_'.$i.'_compression'];
					if(isset($_REQUEST["sku_id"]))
					{
						$sql_update_shoppingcartdetail="update pm_shopping_cart_attributes set option_value2='$textsizeinput',option_value3='".mysql_real_escape_string($textlinecontent)."',text_heading='$skucode[addtocart_heading]',compression_rate='$text_compression' where s_id=$shoppingcartid and option_value1='$i'";
					}			   
				    else
					{
						$textorientation=$_REQUEST['text-orientation_line_'.$i];
						$sql_update_shoppingcartdetail="update pm_shopping_cart_attributes set option_value2='$textsizeinput',option_value3='".mysql_real_escape_string($textlinecontent)."',option_value4='$textorientation',text_heading='$skucode[addtocart_heading]',compression_rate='$text_compression' where s_id=$shoppingcartid and option_value1='$i'";
					}
					mysql_query($sql_update_shoppingcartdetail);
					//print $sql_update_shoppingcartdetail;
				}
			}
			if($textline_count_new<$orgcount)
			{
				for($d=$orgcount;$d>$textline_count_new;$d--)
				{
					$sql_delete_shoppingcartdetail="delete from pm_shopping_cart_attributes where s_id=$shoppingcartid and option_value1='$d'";
					mysql_query($sql_delete_shoppingcartdetail);
				}
			}
		}
		else if($textline_count_new>$orgcount)
		{
			if($orgcount>0)
			{
				for($i=1;$i<=$orgcount;$i++)
				{
					$textlinecontent=$_REQUEST['line_'.$i];
					$textlinecontent=strtoupper($textlinecontent);
					$textsizeinput=$_REQUEST['select_text_size_line_'.$i].'"';
					
					$text_compression=$_REQUEST['line_'.$i.'_compression'];
					if(isset($_REQUEST["sku_id"]))
					{
						$sql_update_shoppingcartdetail="update pm_shopping_cart_attributes set option_value2='$textsizeinput',option_value3='".mysql_real_escape_string($textlinecontent)."',text_heading='$skucode[addtocart_heading]',compression_rate='$text_compression' where s_id=$shoppingcartid and option_value1='$i'";
					}
					else
					{
						$textorientation=$_REQUEST['text-orientation_line_'.$i];
						$sql_update_shoppingcartdetail="update pm_shopping_cart_attributes set option_value2='$textsizeinput',option_value3='".mysql_real_escape_string($textlinecontent)."',option_value4='$textorientation',text_heading='$skucode[addtocart_heading]',compression_rate='$text_compression' where s_id=$shoppingcartid and option_value1='$i'";
					}
					mysql_query($sql_update_shoppingcartdetail);
					//print $sql_update_shoppingcartdetail;
				}
			}
			$textsizelabel=Textsize_Label;
			$textcontentlabel=Textcustomcopy_Label;
			$textarrangementlabel=Textarrangement_Label;
			$textpositionlabel=Textposition_Label;					
			for($n=($orgcount+1);$n<=$textline_count_new;$n++)
			{
				$textlinecontent=$_REQUEST['line_'.$n];
				$textlinecontent=strtoupper($textlinecontent);
				$textsizeinput=$_REQUEST['select_text_size_line_'.$n].'"';			
				$text_compression=$_REQUEST['line_'.$i.'_compression'];
				//$sql_insert_shopping_detail="insert into pm_shopping_cart_attributes(s_id,option_label1,option_value1,option_label2,option_value2,option_label3,option_value3,option_label4,option_value4,created_date,text_heading,compression_rate) values($shoppingcartid,'$textsizelabel','$textsizeinput','$textcontentlabel','".mysql_real_escape_string($textlinecontent)."','$textarrangementlabel','$textorientation','$textpositionlabel','$n',NOW(),'$skucode[addtocart_heading]','$text_compression')";
				if(isset($_REQUEST["sku_id"]))
				{
					$sql_insert_shopping_detail="insert into pm_shopping_cart_attributes(s_id,option_label1,option_value1,option_label2,option_value2,option_label3,option_value3,created_date,text_heading,compression_rate) values('$shoppingcartid','$textpositionlabel','$n','$textsizelabel','$textsizeinput','$textcontentlabel','".mysql_real_escape_string($textlinecontent)."',NOW(),'$skucode[addtocart_heading]','$text_compression')";
				}
				else
				{
					$textorientation=$_REQUEST['text-orientation_line_'.$n];
					$sql_insert_shopping_detail="insert into pm_shopping_cart_attributes(s_id,option_label1,option_value1,option_label2,option_value2,option_label3,option_value3,option_label4,option_value4,created_date,text_heading,compression_rate) values('$shoppingcartid','$textpositionlabel','$n','$textsizelabel','$textsizeinput','$textcontentlabel','".mysql_real_escape_string($textlinecontent)."','$textarrangementlabel','$textorientation',NOW(),'$skucode[addtocart_heading]','$text_compression')";
				}
				mysql_query($sql_insert_shopping_detail);			
			}
		}
		  $output='successupdate';
		  $json = json_encode($output);
		  echo $json;						
	}
	function APupdateCustomNormalshopppingcartrecords_newskucode($shoppingcartid,$product_ez_pipe_markers,$skucode,$currentprice,$listprice,$newcolor,$new_mounting_option,$new_make_fit,$new_quantity,$comments,$min_quantity_below,$min_quantity_charge,$additional_charge,$parameters_one,$new_total,$listtotal,$addtionalcharge)
	{
		$uploadfile=$_REQUEST['uploadfilename'];
		$uploadfileid=$_REQUEST['uploadfileid'];
		$org_filename=$this->GetCustomFileName($shoppingcartid);
		if($org_filename[file_name]!=''&&$uploadfile=='')
		{
			$fileatpath='../upload/'.$filename;
			$sql_deletefile="delete from pm_customer_file_upload where id='$uploadfileid'";
			mysql_query($sql_deletefile);
			unlink($fileatpath);			
		}
		else if($org_filename[file_name]!=''&&$uploadfile!='')
		{
			$sql_emptysid="update pm_customer_file_upload set s_id='' where s_id='$shoppingcartid'";
			mysql_query($sql_emptysid);	
			$sql_updatefile="update pm_customer_file_upload set s_id='$shoppingcartid' where id='$uploadfileid'";
			mysql_query($sql_updatefile);		
		}
		else if($org_filename[file_name]==''&&$uploadfile!='')
		{
			$sql_updatefilesid="update pm_customer_file_upload set s_id='$shoppingcartid' where id='$uploadfileid'";
			mysql_query($sql_updatefilesid);			
		}		
		/*$displayprice=$this->numberround($currentprice,2);
		$displaylistprice=$this->numberround($listprice,2);
		if($min_quantity_below&&($new_quantity<$min_quantity_below))
		{
			$new_total=$displayprice*$new_quantity+$min_quantity_charge+$additional_charge;
			$listtotal=$displaylistprice*$new_quantity+$min_quantity_charge+$additional_charge;			
		}
		else
		{
			$new_total=$displayprice*$new_quantity+$additional_charge;
			$listtotal=$displaylistprice*$new_quantity+$additional_charge;
		}*/		
		if(isset($_REQUEST['largeitem_scale']))
		{
		 	$largeitem_scale=$_REQUEST['largeitem_scale'];
			$sql_shoppingcart=",largeitem_scale='$largeitem_scale'";
		}
		if(isset($_REQUEST['waive_maximum']))
		{
			$waiver=$_REQUEST['waive_maximum'];
		}
		else
		{
			$waiver='';
		}		
		if($product_ez_pipe_markers=='Y')
		{
			if($_SESSION[user_type]=='R')
			{
				$sql_update_shoppingcart="update pm_shopping_cart set attributes_id='$skucode[material_code]',sku_id='$skucode[sku_id]',sku_code='$skucode[sku_code]',sku_name='$skucode[material_description]',shoppingcart_image='$skucode[shoppingcart_image]',ez_pipe_markers='Y',ab_tape_sku_id='$skucode[ab_sku_code]',ab_tape_class='$skucode[ab_tape_class]',ab_tape='$skucode[ab_tape]',ab_tape_status='N',ez_arrow_sku_id='$skucode[ez_sku_code]',ez_arrow_class='$skucode[ez_arrow_class]',ez_arrow='$skucode[ez_arrow]',ez_arrow_status='N',freight_shipping='$skucode[freight_shipping]',price=".$listprice.",total=".$listtotal.",customer_price=".$listprice.",customer_total=".$listtotal.",new_price=".$currentprice.",new_total=".$new_total.",additional_charges='".$addtionalcharge."',background_color='$newcolor' ,mounting_option='$new_mounting_option',make_fit='$new_make_fit',quantity='$new_quantity',comments='$comments',parameters_one='$parameters_one',last_modified=NOW(),waiver='$waiver'".$sql_shoppingcart." where id=$shoppingcartid and session_id='".mysql_real_escape_string(session_id())."'";
				$this->ResetCustomerListDiscountNew();	
			}
			else
				$sql_update_shoppingcart="update pm_shopping_cart set attributes_id='$skucode[material_code]',sku_id='$skucode[sku_id]',sku_code='$skucode[sku_code]',sku_name='$skucode[material_description]',shoppingcart_image='$skucode[shoppingcart_image]',ez_pipe_markers='Y',ab_tape_sku_id='$skucode[ab_sku_code]',ab_tape_class='$skucode[ab_tape_class]',ab_tape='$skucode[ab_tape]',ab_tape_status='N',ez_arrow_sku_id='$skucode[ez_sku_code]',ez_arrow_class='$skucode[ez_arrow_class]',ez_arrow='$skucode[ez_arrow]',ez_arrow_status='N',freight_shipping='$skucode[freight_shipping]',new_price=".$currentprice.",new_total=".$new_total.",additional_charges='".$addtionalcharge."',background_color='$newcolor' ,mounting_option='$new_mounting_option',make_fit='$new_make_fit',quantity='$new_quantity',comments='$comments',parameters_one='$parameters_one',last_modified=NOW(),waiver='$waiver'".$sql_shoppingcart." where id=$shoppingcartid and session_id='".mysql_real_escape_string(session_id())."'";		
		}
		else
		{
			if($_SESSION[user_type]=='R')
				$sql_update_shoppingcart="update pm_shopping_cart set attributes_id='$skucode[material_code]',sku_id='$skucode[sku_id]',sku_code='$skucode[sku_code]',sku_name='$skucode[material_description]',shoppingcart_image='$skucode[shoppingcart_image]',freight_shipping='$skucode[freight_shipping]',price=".$listprice.",total=".$listtotal.",customer_price=".$listprice.",customer_total=".$listtotal.",new_price=".$currentprice.",new_total=".$new_total.",additional_charges='".$addtionalcharge."',background_color='$newcolor' ,mounting_option='$new_mounting_option',make_fit='$new_make_fit',quantity='$new_quantity',comments='$comments',parameters_one='$parameters_one',last_modified=NOW(),waiver='$waiver'".$sql_shoppingcart." where id=$shoppingcartid and session_id='".mysql_real_escape_string(session_id())."'";
			else
				$sql_update_shoppingcart="update pm_shopping_cart set attributes_id='$skucode[material_code]',sku_id='$skucode[sku_id]',sku_code='$skucode[sku_code]',sku_name='$skucode[material_description]',shoppingcart_image='$skucode[shoppingcart_image]',freight_shipping='$skucode[freight_shipping]',new_price=".$currentprice.",new_total=".$new_total.",additional_charges='".$addtionalcharge."',background_color='$newcolor' ,mounting_option='$new_mounting_option',make_fit='$new_make_fit',quantity='$new_quantity',comments='$comments',parameters_one='$parameters_one',last_modified=NOW(),waiver='$waiver'".$sql_shoppingcart." where id=$shoppingcartid and session_id='".mysql_real_escape_string(session_id())."'";
		}
		mysql_query($sql_update_shoppingcart);					
		//print $sql_update_shoppingcart;	
		$textlinecontent=$_REQUEST['line_1'];
		$textlinecontent=strtoupper($textlinecontent);
		/*if($template=='customceilingmarkers')
		{
			$textsizeinput=$_REQUEST['select_text_size_line_1'];
			$sql_update_shoppingcartdetail="update pm_shopping_cart_attributes set option_value1='".mysql_real_escape_string($textlinecontent)."',option_value2='$textsizeinput',text_heading='$skucode[addtocart_heading]',compression_rate='$text_compression' where s_id=$shoppingcartid";
		}
		else */if(isset($_REQUEST['select_text_size_line_1']))
		{
			$textsizeinput=$_REQUEST['select_text_size_line_1'];
			$sql_update_shoppingcartdetail="update pm_shopping_cart_attributes set option_value1='$textsizeinput',option_value2='".mysql_real_escape_string($textlinecontent)."',text_heading='$skucode[addtocart_heading]',compression_rate='$text_compression' where s_id=$shoppingcartid";
		}
		else
		{
			$sql_update_shoppingcartdetail="update pm_shopping_cart_attributes set option_value1='".mysql_real_escape_string($textlinecontent)."',text_heading='$skucode[addtocart_heading]',compression_rate='$text_compression' where s_id=$shoppingcartid";
		}
		$text_compression=$_REQUEST['line_1_compression'];
		/*if(isset($_REQUEST['stencil_layout']))
		{
			$update_sql=",option_value3='".$_REQUEST['stencil_layout']."'";
		}
		else if(isset($_REQUEST['select_band']))
		{
			$update_sql=",option_value3='".$_REQUEST['select_band']."'";
		}*/		
		
		mysql_query($sql_update_shoppingcartdetail);
		//print $sql_update_shoppingcartdetail;
		$output='successupdate';
		$json = json_encode($output);
		echo $json;						
	}
	function APcheckfromproductinsertNameplate($productno)
	{
		if(isset($_REQUEST['category']))		
			$sql_product_list="select products_id,stock_custom,product_number,ez_pipe_markers,template from pm_products where product_number='".$productno."' and active='Y' and category_name='".$_REQUEST['category']."'";//one record
		else
			$sql_product_list="select products_id,stock_custom,product_number,ez_pipe_markers,template from pm_products where product_number='".$productno."' and active='Y' order by products_id asc";//csv import
		 //print $sql_product_list;
		 $product_result=mysql_query($sql_product_list);
		 while($product_row=mysql_fetch_array($product_result))
		 {
			 $product[products_id]=$product_row['products_id'];
			 $product[stock_custom]=$product_row['stock_custom'];
			 $product[product_number]=$product_row['product_number'];
			 $product[ez_pipe_markers]=$product_row['ez_pipe_markers'];
			 $product[template]=$product_row['template'];
			 break;
		 }
		 return $product;	
	}
	function savecustomnameplate_product()//need to add detect combine price or not
	{
		$productno=$_REQUEST['productno'];
		if(isset($_REQUEST["material_thickness"]))//($_REQUEST['category']=='Nameplates'||$_REQUEST['category']=='Custom Products'&&$_REQUEST['subcategory']=='Custom Nameplates') nameplate promark shouldn't have material_thickness
		{	
			if(isset($_REQUEST["sku_id"]))//custom ceiling markers
				$requestskuidfrompage=$_REQUEST["sku_id"];
			else
				$requestskuidfrompage=$_REQUEST["material_thickness"];
			$product=$this->APcheckfromproductinsertNameplate($productno);
			$skucode=$this->APcheckdescriptiontablebySkuId($requestskuidfrompage);
			$quantitytype=$this->Nameplategetpricedetailsfrommaterial($skucode[material_code]);
			$quantitycount=count($quantitytype);
			$i=0;
			if($quantitycount>0)
			{
				foreach($quantitytype as $key => $quantitytype_data)
				{	
					$quantitygroup[$i]=$quantitytype_data['quantity'];
					$pricegroup[$i]=$quantitytype_data['price'];
					$producttype=$quantitytype_data['producttype'];
					$combine_product=$quantitytype_data['combine_product'];
					$i++;
				}	
			}
			$addquantity=$_REQUEST['quanity'];
			if($_REQUEST['sh_id']=='Insert')//to be check
			{
				if($combine_product=='Y')
					$shoppingcartinfo=$this->APcheckshoppingcartfromsession();
			}
			else//update case
			{
				$original_result=$this->APGetOrgSkucodeFromShopping_UpdateCase();
				if($combine_product=='Y')
					$shoppingcartinfo=$this->APcheckshoppingcartfromsession_UpdateCase();//quantity is going to change, so remove
			}
			if($combine_product=='Y')
			{
				if(count($shoppingcartinfo)>0)
				{
					$j=0;
					$updateid=array();
					$updateids_materialcode=array();
					$updateids_addcharge=array();
					$updateids_quantity=array();					
					foreach($shoppingcartinfo as $key => $shoppingcart_data)
					{
						$id_shopping[$j]=$shoppingcart_data['id'];
						$quantity_shopping[$j]=$shoppingcart_data['quantity'];
						$producttype_shopping[$j]=$shoppingcart_data['producttype'];
						$materialcode_shopping[$j]=$shoppingcart_data['attributes_id'];
						$addcharge_shopping[$j]=$shoppingcart_data['additional_charge'];
						if($producttype==$producttype_shopping[$j])
						{
							$addquantity=$addquantity+$quantity_shopping[$j];	
							array_push($updateid,$id_shopping[$j]);		
							array_push($updateids_materialcode,$materialcode_shopping[$j]);
							array_push($updateids_addcharge,$addcharge_shopping[$j]);
							array_push($updateids_quantity,$quantity_shopping[$j]);								
						}
						$j++;
					}			
				}
			}
			$k=0;
			while($k<$quantitycount)
			{
				if($addquantity>=$quantitygroup[$k]&&$addquantity<$quantitygroup[$k+1])
				{
					break;
				}
				$k++;
			}
			if($k==$quantitycount)	
				$k=$k-1;
				
			$quantity=$quantitygroup[$k];
			if($_SESSION[user_type]=='R')
			{
				$last_price=$pricegroup[$k];//$currentprice=0.7*$pricegroup[$k];
			}
			else
			{
				$last_price=$pricegroup[0];//$currentprice=$pricegroup[$k];
			}			
			$price=$this->APgetinfofromprice($skucode[material_code],$quantity);
			$price[price]=$this->numberround($price[price],4);
			$displayprice=$this->numberround($price[price],2);
			$last_price=$this->numberround($last_price,4);
			$displaylistprice=$this->numberround($last_price,2);			
			if($price[min_quantity_below]&&($_REQUEST['quanity']<$price[min_quantity_below]))
			{
				$last_total=$displaylistprice*$_REQUEST['quanity']+$price[min_quantity_charge]+$skucode[additional_charge];				
				$totalprice=$displayprice*$_REQUEST['quanity']+$price[min_quantity_charge]+$skucode[additional_charge];
				$addtionalcharge=$price[min_quantity_charge]+$skucode[additional_charge];
			}
			else
			{
				$last_total=$displaylistprice*$_REQUEST['quanity']+$skucode[additional_charge];				
				$totalprice=$displayprice*$_REQUEST['quanity']+$skucode[additional_charge];	
				$addtionalcharge=$skucode[additional_charge];
			}				
			$color=$_REQUEST['nameplate_color'];
			if(isset($_REQUEST['mounting_options']))//custom normal nameplates
				$mounting_option=$_REQUEST['mounting_options'];				
			if(isset($_REQUEST['special_comment']))//to be check;later rollback
				$comments=$_REQUEST['special_comment'];
			$make_fit=$_REQUEST['customer_text_style'];
			if($make_fit=='copytofit')
				$make_fit='Y';
			else
				$make_fit='N';		

			if($_REQUEST['sh_id']=='Insert')//insert new product case
			{
				$this->APinsert_custom_nameplate_product($product,$skucode,$price,$last_price,$totalprice,$last_total,$_REQUEST['quanity'],$color,$mounting_option,$make_fit,$comments,$combine_product,$addtionalcharge);	
			}
			else//update case
			{
				if($skucode[sku_code]==$original_result[sku_code])
				{
					$this->APupdateCustomshopppingcartrecords($_REQUEST['sh_id'],$price[price],$last_price,$color,$mounting_option,$make_fit,$_REQUEST['quanity'],$comments,$totalprice,$last_total,$addtionalcharge);//$price[price] is current price

				}
				else
				{
					$this->APupdateCustomshopppingcartrecords_newskucode($_REQUEST['sh_id'],$product[ez_pipe_markers],$skucode,$price[price],$last_price,$color,$mounting_option,$make_fit,$_REQUEST['quanity'],$comments,$totalprice,$last_total,$addtionalcharge);//$price[price] is current price
				}
			}
			if($combine_product=='Y')
			{
				$updateamount=count($updateid);
				if($updateamount>0)
				{
					for($w=0;$w<$updateamount;$w++)
					{   
						$this->APupdateshopppingcartrecords($updateid[$w],$updateids_materialcode[$w],$updateids_addcharge[$w],$updateids_quantity[$w],$addquantity);
					}
				}
			}
		}
		else //if($_REQUEST['category']=='Pipe Markers'&&$_REQUEST['subcategory']=='Custom Markers'||$_REQUEST['category']=='Custom Products'&&$_REQUEST['subcategory']=='Custom Pipe Markers'||$_REQUEST['category']=='Custom Products'&&$_REQUEST['subcategory']=='Custom Duct Markers'||$_REQUEST['category']=='Custom Products'&&$_REQUEST['subcategory']=='Custom Underground Tape'||$_REQUEST['category']=='Custom Products'&&$_REQUEST['subcategory']=='Custom Ammonia Markers'||$_REQUEST['category']=='Custom Products'&&$_REQUEST['subcategory']=='Custom Stencils')//duct and pipemarker ammonia underground(product_size is material) stencil nameplatess
		{
			if(isset($_REQUEST["product_size"]))
				$requestskuidfrompage=$_REQUEST["product_size"];
			else if(isset($_REQUEST["sku_id"]))
				$requestskuidfrompage=$_REQUEST["sku_id"];
			$product=$this->APcheckfromproductinsertNameplate($productno);
			if(isset($_REQUEST["ez_pipe_skucode"])&&$_REQUEST["ez_pipe_skucode"]!='')//for custom ez pipe marker products
				$skucode=$this->APcheckdescriptiontablebySkuCode($_REQUEST["ez_pipe_skucode"]);
			else
				$skucode=$this->APcheckdescriptiontablebySkuId($requestskuidfrompage);
			$quantitytype=$this->Nameplategetpricedetailsfrommaterial($skucode[material_code]);
			$quantitycount=count($quantitytype);
			$i=0;
			if($quantitycount>0)
			{
				foreach($quantitytype as $key => $quantitytype_data)
				{	
					$quantitygroup[$i]=$quantitytype_data['quantity'];
					$pricegroup[$i]=$quantitytype_data['price'];	
					$producttype=$quantitytype_data['producttype'];
					$combine_product=$quantitytype_data['combine_product'];
					$i++;
				}	
			}
			$addquantity=$_REQUEST['quanity'];
			if($_REQUEST['sh_id']=='Insert')
			{
				if($combine_product=='Y')
					$shoppingcartinfo=$this->APcheckshoppingcartfromsession();
			}
			else//update case
			{
				$original_result=$this->APGetOrgSkucodeFromShopping_UpdateCase();					
				if($combine_product=='Y')
					$shoppingcartinfo=$this->APcheckshoppingcartfromsession_UpdateCase();
			}
			if($combine_product=='Y')
			{
				if(count($shoppingcartinfo)>0)
				{
					$j=0;
					$updateid=array();
					$updateids_materialcode=array();
					$updateids_addcharge=array();
					$updateids_quantity=array();					
					foreach($shoppingcartinfo as $key => $shoppingcart_data)
					{
						$id_shopping[$j]=$shoppingcart_data['id'];
						$quantity_shopping[$j]=$shoppingcart_data['quantity'];
						$producttype_shopping[$j]=$shoppingcart_data['producttype'];
						$materialcode_shopping[$j]=$shoppingcart_data['attributes_id'];
						$addcharge_shopping[$j]=$shoppingcart_data['additional_charge'];
						if($producttype==$producttype_shopping[$j])
						{
							$addquantity=$addquantity+$quantity_shopping[$j];	
							array_push($updateid,$id_shopping[$j]);		
							array_push($updateids_materialcode,$materialcode_shopping[$j]);
							array_push($updateids_addcharge,$addcharge_shopping[$j]);
							array_push($updateids_quantity,$quantity_shopping[$j]);								
						}
						$j++;
					}			
				}	
			}
			$k=0;
			while($k<$quantitycount)
			{
				if($addquantity>=$quantitygroup[$k]&&$addquantity<$quantitygroup[$k+1])
				{
					break;
				}
				$k++;
			}
			if($k==$quantitycount)	
				$k=$k-1;

			$quantity=$quantitygroup[$k];
			if($_SESSION[user_type]=='R')
			{
				$last_price=$pricegroup[$k];//$currentprice=0.7*$pricegroup[$k];
			}
			else
			{
				$last_price=$pricegroup[0];//$currentprice=$pricegroup[$k];
			}				
			$price=$this->APgetinfofromprice($skucode[material_code],$quantity);//$price[price] is current price
			$price[price]=$this->numberround($price[price],4);
			$displayprice=$this->numberround($price[price],2);
			$last_price=$this->numberround($last_price,4);
			$displaylistprice=$this->numberround($last_price,2);
			if($price[min_quantity_below]&&($_REQUEST['quanity']<$price[min_quantity_below]))
			{
				$last_total=$displaylistprice*$_REQUEST['quanity']+$price[min_quantity_charge]+$skucode[additional_charge];				
				$totalprice=$displayprice*$_REQUEST['quanity']+$price[min_quantity_charge]+$skucode[additional_charge];
				$addtionalcharge=$price[min_quantity_charge]+$skucode[additional_charge];
			}
			else
			{
				$last_total=$displaylistprice*$_REQUEST['quanity']+$skucode[additional_charge];				
				$totalprice=$displayprice*$_REQUEST['quanity']+$skucode[additional_charge];
				$addtionalcharge=$skucode[additional_charge];
			}
			if(isset($_REQUEST['nameplate_color']))
			   $color=$_REQUEST['nameplate_color'];
			else if(isset($_REQUEST['stencil_layout']))
			{
			   $parameters_one=$this->APgetParametersone($product[product_number],$_REQUEST['stencil_layout']);
			   $color=$_REQUEST['stencil_layout'];
			}
			else if(isset($_REQUEST['select_band']))
			{
			   $parameters_one=$this->APgetParametersone($product[product_number],$_REQUEST['select_band']);
			   $color=$_REQUEST['select_band'];			
			}
			if(isset($_REQUEST['special_comment']))//to be check;later rollback
				$comments=$_REQUEST['special_comment'];
			if($_REQUEST['sh_id']=='Insert')//insert new product case
			{
				$this->APinsert_custom_normal_product($product,$skucode,$price,$last_price,$totalprice,$last_total,$_REQUEST['quanity'],$color,'','',$comments,$parameters_one,$combine_product,$addtionalcharge);//$price[price] is current price	
			}
			else//update case
			{
				if($skucode[sku_code]==$original_result[sku_code])
				{
					$this->APupdateCustomNormalshopppingcartrecords($_REQUEST['sh_id'],$price[price],$last_price,$color,'','',$_REQUEST['quanity'],$comments,$parameters_one,$totalprice,$last_total,$addtionalcharge);//$price[price] is current price
				}
				else
				{
					$this->APupdateCustomNormalshopppingcartrecords_newskucode($_REQUEST['sh_id'],$product[ez_pipe_markers],$skucode,$price[price],$last_price,$color,'','',$_REQUEST['quanity'],$comments,$parameters_one,$totalprice,$last_total,$addtionalcharge);
				}
			}
			if($combine_product=='Y')
			{
				$updateamount=count($updateid);
				if($updateamount>0)
				{
					for($w=0;$w<$updateamount;$w++)
					{   
						$this->APupdateshopppingcartrecords($updateid[$w],$updateids_materialcode[$w],$updateids_addcharge[$w],$updateids_quantity[$w],$addquantity);
					}
				}
			}
		}
	}
	function LoadCustomNameplate()
	{
		$sql_load="select c.sku_code,s.attributes_id,c.material_description,c.size,s.background_color,s.mounting_option,s.quantity,s.make_fit,c.material,s.comments,s.largeitem_scale,s.waiver from pm_shopping_cart s, pm_products_sku_description c where s.id=".$_REQUEST['sh_id']." and s.sku_code=c.sku_code";
		$loadCustom_result=mysql_query($sql_load);
		//print $sql_load;
		while($loadCustom_row=mysql_fetch_array($loadCustom_result))
		{
			$material_description=split('"', $loadCustom_row['material_description']);
			$loadCustom_product[thickness]=$material_description[0];
			$loadCustom_product[size]=$loadCustom_row['size'];
			$loadCustom_product[color]=$loadCustom_row['background_color'];
			$loadCustom_product[mounting_option]=$loadCustom_row['mounting_option'];
			$loadCustom_product[sku_code]=$loadCustom_row['sku_code'];
			$loadCustom_product[quantity]=$loadCustom_row['quantity'];
			$loadCustom_product[make_fit]=$loadCustom_row['make_fit'];
			$loadCustom_product[material_code]=$loadCustom_row['attributes_id'];
			$loadCustom_product[material]=$loadCustom_row['material'];
			$loadCustom_product[comments]=$loadCustom_row['comments'];
			$loadCustom_product[largeitem_scale]=$loadCustom_row['largeitem_scale'];
			$loadCustom_product[waiver]=$loadCustom_row['waiver'];
		}		
		return $loadCustom_product;	
	}
	function LoadCustomNameplateDetails($shoppingcartid)
	{
		if(isset($_REQUEST['sh_id']))
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
	function Getcustomnameplate_textSizefromdes($sku_code)
	{
		$sql_textsize_detail="select text_size,max_lines,max_chars_upper,max_chars_mixed,copytofit_textsize,copytofit_maxline,copytofit_maxchar,absolute_maximum from pm_custom_nameplate_spec where sku_code='$sku_code' and active='Y' group by text_size order by textsize_position";
		//print $sql_textsize_detail;
		$textsize_result=mysql_query($sql_textsize_detail);
		while($textsize_row=mysql_fetch_array($textsize_result))
		{
			$textsize[]=$textsize_row;
		}		
		return $textsize;			
	}
	function GetMaxCharData_nameplate($sku_code,$textsize)
	{
		$sql_maxchar="select max_chars_upper,max_chars_mixed,max_lines from pm_custom_nameplate_spec where sku_code='$sku_code' and text_size='$textsize' ";
		$maxchar_result=mysql_query($sql_maxchar);
		while($maxchar_row=mysql_fetch_array($maxchar_result))
		{
			$maxchar[max_chars_upper]=$maxchar_row['max_chars_upper'];
			$maxchar[max_chars_mixed]=$maxchar_row['max_chars_mixed'];
			$maxchar[max_lines]=$maxchar_row['max_lines'];
		}		
		return $maxchar;			
	}
	function GetMountaing_Optionsfromdes($sku_code)
	{
		$sql_mountingoption="select attribute_option from pm_custom_products_attributes where sku_code='$sku_code' and active='Y' order by position";
		//print $sql_mountingoption;
		$mountingoption_result=mysql_query($sql_mountingoption);
		while($mountingoption_row=mysql_fetch_array($mountingoption_result))
		{
			$mountingoption_value[]=$mountingoption_row;
		}
		return $mountingoption_value;			
	}
	function Nameplategetpricedetailsfrommaterial($material_code)
	{
		if($_SESSION[user_type]=='R')
			$sql_price_list="select min_quantity,price,quantity,min_quantity_charge,min_quantity_below,producttype,combine_product from pm_products_price where material_code='$material_code' and user_type='$_SESSION[user_type]' and rep_special='$_SESSION[rep_special]' and active='Y' order by quantity asc";	
		else
		    $sql_price_list="select min_quantity,price,quantity,min_quantity_charge,min_quantity_below,producttype,combine_product from pm_products_price where material_code='$material_code' and user_type='$_SESSION[user_type]' and active='Y' order by quantity asc";	//select material_code, sku_code too
		  $price_result=mysql_query($sql_price_list);

		  //print $sql_price_list;
		  while($price_row=mysql_fetch_array($price_result))
		  {
			  $pricedetails[]=$price_row;
		  }
		  return $pricedetails;
	}
	function getpricedetailsfrommaterial($material_code)
	{
		if($_SESSION[user_type]=='R')
			$sql_price_list="select min_quantity,price,quantity,min_quantity_charge,min_quantity_below,producttype,combine_product from pm_products_price where material_code='$material_code' and user_type='$_SESSION[user_type]' and rep_special='$_SESSION[rep_special]' and active='Y' order by quantity asc";	
		else
		    $sql_price_list="select min_quantity,price,quantity,min_quantity_charge,min_quantity_below,producttype,combine_product from pm_products_price where material_code='$material_code' and user_type='$_SESSION[user_type]' and active='Y' order by quantity asc";	//select material_code, sku_code too
		  $price_result=mysql_query($sql_price_list);

		  //print $sql_price_list;
		  while($price_row=mysql_fetch_array($price_result))
		  {
			  $pricedetails[]=$price_row;
		  }
		  return $pricedetails;
	}	
	function APcheckfromdescription()
	{
		$sql_materialcode="select material_code,sku_code from pm_products_sku_description where product_number='".$_REQUEST['productno']."' and active='Y' order by sku_id asc";
		//print $sql_materialcode;
		$materialcode_result=mysql_query($sql_materialcode);
		while($materialcode_row=mysql_fetch_array($materialcode_result))
		{
			$materialcode[]=$materialcode_row;
		}
		return $materialcode;			
	}
	function GetcustomnameplateSkuCodefromdes()
	{
		$sql_skucode="select sku_code,sku_id,material_code,size,material_description from pm_products_sku_description where product_number='".$_REQUEST['productno']."' and active='Y' order by sku_id asc";
		$skucode_result=mysql_query($sql_skucode);
		//print $sql_skucode;
		$pre_thickness='1/16';
		$i=0;
		while($skucode_row=mysql_fetch_array($skucode_result))
		{
			$material_des=$skucode_row['material_description'];
			$thickness_sepa=split('"',$material_des);
			$thickness=$thickness_sepa[0];
			if($thickness==$pre_thickness)
			{
				$skucode[$i][sku_code]=$skucode_row['sku_code'];
				$skucode[$i][sku_id]=$skucode_row['sku_id'];
				$skucode[$i][size]=$skucode_row['size'];
				$skucode[$i][material_code][0]=$skucode_row['material_code'];
				$skucode[$i][thickness][0]=$thickness;
				$i++;
			}
			else
			{	
				$i--;
				$skucode[$i][material_code][1]=$skucode_row['material_code'];
				$skucode[$i][thickness][1]=$thickness;
			}
		}
		//print count($skucode);
		return $skucode;	
	}
	function GetcustomnameplateSkuCodefromdes_templatepage()
	{
		$sql_skucode="select sku_code,sku_id,material_code,size,material_description from pm_products_sku_description where product_number='".$_REQUEST['productno']."' and active='Y' order by sku_id asc";
		$skucode_result=mysql_query($sql_skucode);
		//print $sql_skucode;
		$i=0;
		while($skucode_row=mysql_fetch_array($skucode_result))
		{
			$material_des=$skucode_row['material_description'];
			$thickness_sepa=split('"',$material_des);
			$thickness=$thickness_sepa[0];
				$skucode[$i][sku_code]=$skucode_row['sku_code'];
				$skucode[$i][sku_id]=$skucode_row['sku_id'];
				$skucode[$i][size]=$skucode_row['size'];
				$skucode[$i][material_code]=$skucode_row['material_code'];
				$skucode[$i][thickness]=$thickness;
				$i++;
		}
		return $skucode;	
	}	
	function GetAvailableColorNameplate()
	{
		$sql_color="select color,color_class from pm_product_custom_color where product_number ='".$_REQUEST['productno']."' and active='Y' order by position";
		$color_result=mysql_query($sql_color);
		//print $sql_color;
		while($color_row=mysql_fetch_array($color_result))
		{
			$color[]=$color_row;
		}		
		return $color;		
	}
	function GetMaterialcodeFromSku($sku_code)
	{
		$sql_material_code="select material_code from pm_products_sku_description where sku_code='$sku_code' and product_number='".$_REQUEST['productno']."' and active='Y'";
		//print $sql_material_code;
		$material_code_result=mysql_query($sql_material_code);
		while($material_code_row=mysql_fetch_array($material_code_result))
		{
			$material_code[]=$material_code_row;
		}
		return $material_code;	
	}
	/*function Getthicknessfromsku($sku_code)
	{
		$sql_thickness="select material_description from pm_products_sku_description where sku_code='$sku_code' and active='Y'";
		$thickness_result=mysql_query($sql_thickness);
		while($thickness_row=mysql_fetch_array($thickness_result))
		{
			$thickness_separa=split('"',$thickness_row['material_description']);
			if($thickness_separa[0][1]=='/')
				$thickness=$thickness_separa[0].'"';
			else
				$thickness='';
		}
		return $thickness;		
	}*/
	function GettextsizefromSku($sku_code)
	{
		$sql_textsize="select text_size,max_chars_upper,max_chars_mixed from pm_custom_nameplate_spec where sku_code='$sku_code' order by textsize_position";
		$textsize_result=mysql_query($sql_textsize);
		while($textsize_row=mysql_fetch_array($textsize_result))
		{
			$textsize[]=$textsize_row;
		}
		return $textsize;		
	}
	function APGetOrgSkucodeFromShopping_UpdateCase()
	{
		$ID=$_REQUEST['sh_id']; 
 		$sql_material_code="select sku_code from pm_shopping_cart where id=$ID";
		$material_code_result=mysql_query($sql_material_code);
		while($material_code_row=mysql_fetch_array($material_code_result))
		{
			$org_ressult[sku_code]=$material_code_row['sku_code'];
		}
		return $org_ressult;   	
	}
	function CustomProductsList()
	{
 		$sql_customproducts="select id,custom_product_name,position,instruction from pm_custom_products where active='Y' order by position";
		$customproducts_result=mysql_query($sql_customproducts);
		while($customproducts_row=mysql_fetch_array($customproducts_result))
		{
			$custom_product_result[]=$customproducts_row;
		}
		return $custom_product_result;   		
	}
	function UploadCustomCsvFileSubmit()
	{
		if(isset($_REQUEST['btsubmitcsv']))
		{
			if($_REQUEST['btsubmitcsv']=='Upload');
			{
				$selecttemplate=$_REQUEST['product_customddl'];
				switch($selecttemplate)
				{
					case 0:
					{
						print 'Please select a template from dropdown list.';
						break;
					}
					case 1://Custom EZ Markers to be check : add largeitem_scale value
					{
						$filetype=$_FILES["importcsvfile"]["type"];	
						$filename=$_FILES['importcsvfile']['name'];
						$uploadFilePath=PathTemplatesShoppingCart.'importcsv/'.$filename;
						$csvcomment=$_REQUEST['csv_comment'];
						$typelength=strlen($filetype);
						if($filename=='')
							print 'Please upload a file.';
						else if($filetype!='application/vnd.ms-excel'&&$filetype!='text/csv')
							print 'Only csv file is allowed';
						else
						{
							if (file_exists($uploadFilePath))
							{
							   $purefilename=substr($filename,0,-$typelength);
							   $random_digit=rand(0000,9999);
							   $filename=$purefilename.$random_digit.date('Ynjhis').".".'csv';
							   $uploadFilePath=PathTemplatesShoppingCart.'importcsv/'.$filename;
							}
							copy($_FILES['importcsvfile']['tmp_name'], $uploadFilePath);
							$arrLines = file($uploadFilePath);
							$count=3;
							$thereiserror='N';
							while($arrLines[$count])
							{
								$field = array();							
								$field= explode( ',', $arrLines[$count]);
								if(!is_numeric($field[0]))
									$validatequantity[0]=' Quantity is not valid.';	
								else
								{
									$qtyconverttoint = (int)($field[0]);
									if($qtyconverttoint<1||(string)$qtyconverttoint!=$field[0])
										$validatequantity[0]=' Quantity is not valid.';
									else
										$validatequantity[0]='';
								}
								if(substr($field[1],0,1)=='"'&&substr($field[1],-1,1)=='"')
								{
									$field[1]=substr($field[1],1);
									$field[1]=substr($field[1],0,-1);
								}		
								$field[1]=str_replace('""','"',$field[1]);
								$validmaterialtype=$this->APcsvvalidateMaterialtypeDescription($field[1]);

								$validcolor[0]='';
								$validtextchara='';
								if($validmaterialtype[0]=='')
								{
									if($validmaterialtype[2]!='Custom EZ Markers')
									{
										$validateproduct="The product is not 'Custom EZ Markers'";	
									}
									else
									{
										$validateproduct='';
										if($validatequantity[0]=='')
											$validatequantity=$this->APValidateGetMinimunQuantity($validmaterialtype[5],$qtyconverttoint);
										$validcolor=$this->APcsvvalidateColor($validmaterialtype[2],$field[2]);

										$fieldcount=count($field);
										$text_content="";
										if($fieldcount==4)
										{
											$field[3]=substr($field[3],0,-2);
											if(substr($field[3],0,1)=='"'&&substr($field[3],-1,1)=='"')
											{
												$field[3]=substr($field[3],1);
												$field[3]=substr($field[3],0,-1);
											}											
											$text_content=str_replace('""','"',$field[3]);								
										}
										else if($fieldcount>4)
										{

											$field[3]=substr($field[3],1);	
											$text_initialcontent=str_replace('""','"',$field[3]);									
											for($c=4;$c<$fieldcount;$c++)
											{	
												if($c==($fieldcount-1))
												{
													$field[$c]=substr($field[$c],0,-3);//remove \r and "
												}
												$fieldcontent=str_replace('""','"',$field[$c]);
												$text_content=$text_content.",".$fieldcontent;
											}
											$text_content=$text_initialcontent.$text_content;
										}
										$max_result=$this->APcsvvalidateMaxCharNormal($validmaterialtype[1]);
										if(strlen($text_content)>$max_result[max_chars_upper])
										{
											$validtextchara='Text content is over the maximum '.$max_result[max_chars_upper].' allowed characters';
										}
										else
										{
											$validtextchara='';											
										}
									}
								}
								if($validatequantity[0]!=''||$validmaterialtype[0]!=''||$validcolor[0]!=''||$validtextchara!=''||$validateproduct!='')
								{
									echo 'row'.($count-2).$validatequantity[0].' '.$validmaterialtype[0].' '.$validcolor[0].' '.$validtextchara.' '.$validateproduct.'<br/>';
									if($thereiserror!='Y')
										$thereiserror='Y';
								}
								else
								{
									$csvdata[quantity][$count]=$validatequantity[1];
									$csvdata[productno][$count]=$validmaterialtype[2];
									$csvdata[color][$count]=$validcolor[1];
									$csvdata[skucode][$count]=$validmaterialtype[1];
									$csvdata[textcontent][$count][0]=$text_content;
									//$csvdata[textsize][$count]=$max_result[text_size];
								}							
								$count++;
							}
							if($csvcomment!=''&&strlen($csvcomment)>255)
							{
								echo 'Comment is over 255 the max allowed characters';
								if($thereiserror!='Y')
									$thereiserror='Y';
							}
							if($thereiserror=='N')
							{	
								for($l=3;$l<$count;$l++)
								{
									$product=$this->APcheckfromproductinsertNameplate($csvdata[productno][$l]);
									$skucode=$this->APcheckdescriptiontable($csvdata[skucode][$l]);
									$quantitytype=$this->Nameplategetpricedetailsfrommaterial($skucode[material_code]);
									$quantitycount=count($quantitytype);
									$i=0;
									if($quantitycount>0)
									{
										foreach($quantitytype as $key => $quantitytype_data)
										{	
											$quantitygroup[$i]=$quantitytype_data['quantity'];
											$pricegroup[$i]=$quantitytype_data['price'];
											$i++;
										}	
									}
									$addquantity=$csvdata[quantity][$l];
									//$addquantity is the current total of the existing shopping cart of the product with the same material code
									$k=0;
									while($k<$quantitycount)
									{
										if($addquantity>=$quantitygroup[$k]&&$addquantity<$quantitygroup[$k+1])
										{
											break;
										}
										$k++;
									}
									if($k==$quantitycount)	
										$k=$k-1;	
									$quantity=$quantitygroup[$k];
									
									if($_SESSION[user_type]=='R')
									{
										$currentprice=$pricegroup[$k]*(100-$_SESSION['discount_data'])/100;
										$last_price=$pricegroup[$k];
									}
									else
									{
										$currentprice=$pricegroup[$k];
										$last_price=$pricegroup[0];
									}
									$price=$this->APgetinfofromprice($skucode[material_code],$quantity);
									if($price[min_quantity_below]&&($csvdata[quantity][$l]<$price[min_quantity_below]))
									{
										$last_total=$last_price*$csvdata[quantity][$l]+$price[min_quantity_charge]+$skucode[additional_charge];									
										$totalprice=$price[price]*$csvdata[quantity][$l]+$price[min_quantity_charge]+$skucode[additional_charge];									
									}
									else
									{
										$last_total=$last_price*$csvdata[quantity][$l]+$skucode[additional_charge];									
										$totalprice=$price[price]*$csvdata[quantity][$l]+$skucode[additional_charge];
									}
									$this->APinsert_custom_nameplate_product_csv($product,$skucode,$price,$last_price,$totalprice,$last_total,$csvdata[quantity][$l],$csvdata[color][$l],'','','',$csvdata[textcontent][$l],'','',$csvcomment);							
									
								}
								if($csvcomment!='')
								{								
									$this->APInsertCsvComment($csvcomment,$filename);
								}
							}
							else
								unlink($uploadFilePath);					
						}						
						break;
					}
					case 2://Custom System #1
					{
						$filetype=$_FILES["importcsvfile"]["type"];	
						$filename=$_FILES['importcsvfile']['name'];
						$uploadFilePath=PathTemplatesShoppingCart.'importcsv/'.$filename;
						$csvcomment=$_REQUEST['csv_comment'];
						if($filename=='')
							print 'Please upload a file.';
						else if($filetype!='application/vnd.ms-excel'&&$filetype!='text/csv')
							print 'Only csv file is allowed';					
						else
						{
							if (file_exists($uploadFilePath))
							{
							   $purefilename=substr($filename,0,-$typelength);
							   $random_digit=rand(0000,9999);
							   $filename=$purefilename.$random_digit.date('Ynjhis').".".'csv';
							   $uploadFilePath=PathTemplatesShoppingCart.'importcsv/'.$filename;
							}
							copy($_FILES['importcsvfile']['tmp_name'], $uploadFilePath);
							$arrLines = file($uploadFilePath);
							$count=3;
							$thereiserror='N';
							while($arrLines[$count])
							{
								$field = array();							
								$field= explode( ',', $arrLines[$count]);
								if(!is_numeric($field[0]))
									$validatequantity[0]=' Quantity is not valid.';	
								else
								{
									$qtyconverttoint = (int)($field[0]);
									if($qtyconverttoint<1||(string)$qtyconverttoint!=$field[0])
										$validatequantity[0]=' Quantity is not valid.';
									else
										$validatequantity[0]='';
								}
								if(substr($field[1],0,1)=='"'&&substr($field[1],-1,1)=='"')
								{
									$field[1]=substr($field[1],1);
									$field[1]=substr($field[1],0,-1);
								}		
								$field[1]=str_replace('""','"',$field[1]);
								$validcolor[0]='';
								$validtextchara='';
								$validmaterialtype=$this->APcsvvalidateMaterialtypeDescription($field[1]);
								if($validmaterialtype[0]=='')
								{
									if($validmaterialtype[2]!='Custom System 1')
									{
										$validateproduct="The product is not 'Custom System #1'";	
									}
									else
									{
										$validateproduct='';
										if($validatequantity[0]=='')
											$validatequantity=$this->APValidateGetMinimunQuantity($validmaterialtype[5],$qtyconverttoint);
										$validcolor=$this->APcsvvalidateColor($validmaterialtype[2],$field[2]);
										$fieldcount=count($field);
										$text_content="";
										if($fieldcount==4)
										{
											$field[3]=substr($field[3],0,-2);
											if(substr($field[3],0,1)=='"'&&substr($field[3],-1,1)=='"')
											{
												$field[3]=substr($field[3],1);
												$field[3]=substr($field[3],0,-1);
											}											
											$text_content=str_replace('""','"',$field[3]);						
										}
										else if($fieldcount>4)
										{	
											$field[3]=substr($field[3],1);	
											$text_initialcontent=str_replace('""','"',$field[3]);								
											for($c=4;$c<$fieldcount;$c++)
											{	
												if($c==($fieldcount-1))
												{
													$field[$c]=substr($field[$c],0,-3);//remove \r and "
												}
												$fieldcontent=str_replace('""','"',$field[$c]);
												$text_content=$text_content.",".$fieldcontent;
											}
											$text_content=$text_initialcontent.$text_content;
										}
										$max_result=$this->APcsvvalidateMaxCharNormal($validmaterialtype[1]);
										if(strlen($text_content)>$max_result[max_chars_upper])
										{
											$validtextchara='Text content is over the maximum '.$max_result[max_chars_upper].' allowed characters';
										}
										else
										{
											$validtextchara='';											
										}

											
									}
								}
								if($validatequantity[0]!=''||$validmaterialtype[0]!=''||$validcolor[0]!=''||$validtextchara!=''||$validateproduct!='')
								{
									echo 'row'.($count-2).$validatequantity[0].' '.$validmaterialtype[0].' '.$validcolor[0].' '.$validtextchara.' '.$validateproduct.'<br/>';
									if($thereiserror!='Y')
										$thereiserror='Y';
								}
								else
								{
									$csvdata[quantity][$count]=$validatequantity[1];
									$csvdata[productno][$count]=$validmaterialtype[2];
									$csvdata[color][$count]=$validcolor[1];
									$csvdata[skucode][$count]=$validmaterialtype[1];
									$csvdata[textcontent][$count][0]=$text_content;
									//$csvdata[textsize][$count]=$max_result[text_size];
								}
								$count++;
							}
							if($csvcomment!=''&&strlen($csvcomment)>255)
							{
								echo 'Comment is over 255 the max allowed characters';
								if($thereiserror!='Y')
									$thereiserror='Y';
							}							
							if($thereiserror=='N')
							{	
								for($l=3;$l<$count;$l++)
								{
									$product=$this->APcheckfromproductinsertNameplate($csvdata[productno][$l]);
									$skucode=$this->APcheckdescriptiontable($csvdata[skucode][$l]);
									$quantitytype=$this->Nameplategetpricedetailsfrommaterial($skucode[material_code]);
									$quantitycount=count($quantitytype);
									$i=0;
									if($quantitycount>0)
									{
										foreach($quantitytype as $key => $quantitytype_data)
										{	
											$quantitygroup[$i]=$quantitytype_data['quantity'];
											$pricegroup[$i]=$quantitytype_data['price'];
											$i++;
										}	
									}
									$addquantity=$csvdata[quantity][$l];
	
									//$addquantity is the current total of the existing shopping cart of the product with the same material code
	
									$k=0;
									while($k<$quantitycount)
									{
										if($addquantity>=$quantitygroup[$k]&&$addquantity<$quantitygroup[$k+1])
										{
											break;
										}
										$k++;
									}
									if($k==$quantitycount)	
										$k=$k-1;	
									$quantity=$quantitygroup[$k];
									
									if($_SESSION[user_type]=='R')
									{
										$currentprice=$pricegroup[$k]*(100-$_SESSION['discount_data'])/100;
										$last_price=$pricegroup[$k];
									}
									else
									{
										$currentprice=$pricegroup[$k];
										$last_price=$pricegroup[0];
									}
									$price=$this->APgetinfofromprice($skucode[material_code],$quantity);
									if($price[min_quantity_below]&&($csvdata[quantity][$l]<$price[min_quantity_below]))
									{
										$last_total=$last_price*$csvdata[quantity][$l]+$price[min_quantity_charge]+$skucode[additional_charge];									
										$totalprice=$price[price]*$csvdata[quantity][$l]+$price[min_quantity_charge]+$skucode[additional_charge];									
									}
									else
									{
										$last_total=$last_price*$csvdata[quantity][$l]+$skucode[additional_charge];									
										$totalprice=$price[price]*$csvdata[quantity][$l]+$skucode[additional_charge];
									}									
									$this->APinsert_custom_nameplate_product_csv($product,$skucode,$price,$last_price,$totalprice,$last_total,$csvdata[quantity][$l],$csvdata[color][$l],'','','',$csvdata[textcontent][$l],'','',$csvcomment);							
									
								}
								if($csvcomment!='')
									$this->APInsertCsvComment($csvcomment,$filename);							
							}
							else
								unlink($uploadFilePath);							
						}							
						break;
					}
					case 3://Custom System #2 and #3
					{
						$filetype=$_FILES["importcsvfile"]["type"];	
						$filename=$_FILES['importcsvfile']['name'];
						$uploadFilePath=PathTemplatesShoppingCart.'importcsv/'.$filename;
						$csvcomment=$_REQUEST['csv_comment'];
						if($filename=='')
							print 'Please upload a file.';
						else if($filetype!='application/vnd.ms-excel'&&$filetype!='text/csv')
							print 'Only csv file is allowed';					
						else
						{
							if (file_exists($uploadFilePath))
							{
							   $purefilename=substr($filename,0,-$typelength);
							   $random_digit=rand(0000,9999);
							   $filename=$purefilename.$random_digit.date('Ynjhis').".".'csv';
							   $uploadFilePath=PathTemplatesShoppingCart.'importcsv/'.$filename;
							}
							copy($_FILES['importcsvfile']['tmp_name'], $uploadFilePath);
							$arrLines = file($uploadFilePath);
							$count=3;
							$thereiserror='N';
							while($arrLines[$count])
							{
								$field = array();							
								$field= explode( ',', $arrLines[$count]);
								if(!is_numeric($field[0]))
									$validatequantity[0]=' Quantity is not valid.';	
								else
								{
									$qtyconverttoint = (int)($field[0]);
									if($qtyconverttoint<1||(string)$qtyconverttoint!=$field[0])
										$validatequantity[0]=' Quantity is not valid.';
									else
										$validatequantity[0]='';
								}	
								if(substr($field[1],0,1)=='"'&&substr($field[1],-1,1)=='"')
								{
									$field[1]=substr($field[1],1);
									$field[1]=substr($field[1],0,-1);
								}		
								$field[1]=str_replace('""','"',$field[1]);
								$validcolor[0]='';
								$validtextchara='';
								$validmaterialtype=$this->APcsvvalidateMaterialtypeDescription($field[1]);
								if($validmaterialtype[0]=='')
								{
									if($validmaterialtype[2]!='Custom System 2'&&$validmaterialtype[2]!='Custom System 3')
									{
										$validateproduct="The product is not 'Custom System #2' or 'Custom System #3'";	
									}
									else
									{	
										$validateproduct='';
										if($validatequantity[0]=='')
											$validatequantity=$this->APValidateGetMinimunQuantity($validmaterialtype[5],$qtyconverttoint);									
										$validcolor=$this->APcsvvalidateColor($validmaterialtype[2],$field[2]);
										$fieldcount=count($field);
										$text_content="";
										if($fieldcount==4)
										{
											$field[3]=substr($field[3],0,-2);
											if(substr($field[3],0,1)=='"'&&substr($field[3],-1,1)=='"')
											{
												$field[3]=substr($field[3],1);
												$field[3]=substr($field[3],0,-1);
											}											
											$text_content=str_replace('""','"',$field[3]);								
										}
										else if($fieldcount>4)
										{	
											$field[3]=substr($field[3],1);	
											$text_initialcontent=str_replace('""','"',$field[3]);									
											for($c=4;$c<$fieldcount;$c++)
											{	
												if($c==($fieldcount-1))
												{
													$field[$c]=substr($field[$c],0,-3);//remove \r and "
												}
												$fieldcontent=str_replace('""','"',$field[$c]);		
												$text_content=$text_content.",".$fieldcontent;
											}
											$text_content=$text_initialcontent.$text_content;
										}
										$max_result=$this->APcsvvalidateMaxCharNormal($validmaterialtype[1]);
										if(strlen($text_content)>$max_result[max_chars_upper])
										{
											$validtextchara='Text content is over the maximum '.$max_result[max_chars_upper].' allowed characters';
										}
										else
										{
											$validtextchara='';											
										}
									}
								}
								if($validatequantity[0]!=''||$validmaterialtype[0]!=''||$validcolor[0]!=''||$validtextchara!=''||$validateproduct!='')
								{
									echo 'row'.($count-2).$validatequantity[0].' '.$validmaterialtype[0].' '.$validcolor[0].' '.$validtextchara.' '.$validateproduct.'<br/>';
									if($thereiserror!='Y')
										$thereiserror='Y';
								}
								else
								{
									$csvdata[quantity][$count]=$validatequantity[1];
									$csvdata[productno][$count]=$validmaterialtype[2];
									$csvdata[color][$count]=$validcolor[1];
									$csvdata[skucode][$count]=$validmaterialtype[1];
									$csvdata[textcontent][$count][0]=$text_content;
									//$csvdata[textsize][$count]=$max_result[text_size];
								}	
								$count++;
							}
							if($csvcomment!=''&&strlen($csvcomment)>255)
							{
								echo 'Comment is over 255 the max allowed characters';
								if($thereiserror!='Y')
									$thereiserror='Y';
							}										
							if($thereiserror=='N')
							{	
								for($l=3;$l<$count;$l++)
								{
									$product=$this->APcheckfromproductinsertNameplate($csvdata[productno][$l]);
									$skucode=$this->APcheckdescriptiontable($csvdata[skucode][$l]);
									$quantitytype=$this->Nameplategetpricedetailsfrommaterial($skucode[material_code]);
									$quantitycount=count($quantitytype);
									$i=0;
									if($quantitycount>0)
									{
										foreach($quantitytype as $key => $quantitytype_data)
										{	
											$quantitygroup[$i]=$quantitytype_data['quantity'];
											$pricegroup[$i]=$quantitytype_data['price'];
											$i++;
										}	
									}
									$addquantity=$csvdata[quantity][$l];
	
									//$addquantity is the current total of the existing shopping cart of the product with the same material code
	
									$k=0;
									while($k<$quantitycount)
									{
										if($addquantity>=$quantitygroup[$k]&&$addquantity<$quantitygroup[$k+1])
										{
											break;
										}
										$k++;
									}
									if($k==$quantitycount)	
										$k=$k-1;	
									$quantity=$quantitygroup[$k];
									
									if($_SESSION[user_type]=='R')
									{
										$currentprice=$pricegroup[$k]*(100-$_SESSION['discount_data'])/100;
										$last_price=$pricegroup[$k];
									}
									else
									{
										$currentprice=$pricegroup[$k];
										$last_price=$pricegroup[0];
									}
									$price=$this->APgetinfofromprice($skucode[material_code],$quantity);
									if($price[min_quantity_below]&&($csvdata[quantity][$l]<$price[min_quantity_below]))
									{
										$last_total=$last_price*$csvdata[quantity][$l]+$price[min_quantity_charge]+$skucode[additional_charge];									
										$totalprice=$price[price]*$csvdata[quantity][$l]+$price[min_quantity_charge]+$skucode[additional_charge];									
									}
									else
									{
										$last_total=$last_price*$csvdata[quantity][$l]+$skucode[additional_charge];									
										$totalprice=$price[price]*$csvdata[quantity][$l]+$skucode[additional_charge];
									}									
									$this->APinsert_custom_nameplate_product_csv($product,$skucode,$price,$last_price,$totalprice,$last_total,$csvdata[quantity][$l],$csvdata[color][$l],'','','',$csvdata[textcontent][$l],'','',$csvcomment);																	
								}
								if($csvcomment!='')
									$this->APInsertCsvComment($csvcomment,$filename);							
							}
							else
								unlink($uploadFilePath);							
						}							
						break;
					}
					case 4://Custom System #4
					{
						$filetype=$_FILES["importcsvfile"]["type"];	
						$filename=$_FILES['importcsvfile']['name'];
						$uploadFilePath=PathTemplatesShoppingCart.'importcsv/'.$filename;
						$csvcomment=$_REQUEST['csv_comment'];
						if($filename=='')
							print 'Please upload a file.';
						else if($filetype!='application/vnd.ms-excel'&&$filetype!='text/csv')
							print 'Only csv file is allowed';					
						else
						{
							if (file_exists($uploadFilePath))
							{
							   $purefilename=substr($filename,0,-$typelength);
							   $random_digit=rand(0000,9999);
							   $filename=$purefilename.$random_digit.date('Ynjhis').".".'csv';
							   $uploadFilePath=PathTemplatesShoppingCart.'importcsv/'.$filename;
							}
							copy($_FILES['importcsvfile']['tmp_name'], $uploadFilePath);
							$arrLines = file($uploadFilePath);
							$count=3;
							$thereiserror='N';
							while($arrLines[$count])
							{
								$field = array();							
								$field= explode( ',', $arrLines[$count]);
								if(!is_numeric($field[0]))
									$validatequantity[0]=' Quantity is not valid.';	
								else
								{
									$qtyconverttoint = (int)($field[0]);
									if($qtyconverttoint<1||(string)$qtyconverttoint!=$field[0])
										$validatequantity[0]=' Quantity is not valid.';
									else
										$validatequantity[0]='';
								}
								if(substr($field[1],0,1)=='"'&&substr($field[1],-1,1)=='"')
								{
									$field[1]=substr($field[1],1);
									$field[1]=substr($field[1],0,-1);
								}		
								$field[1]=str_replace('""','"',$field[1]);	
								$validcolor[0]='';
								$validtextchara='';
								$validmaterialtype=$this->APcsvvalidateMaterialtypeDescription($field[1]);
								if($validmaterialtype[0]=='')
								{
									if($validmaterialtype[2]!='Custom System 4')
									{
										$validateproduct="The product is not 'Custom System #4'";	
									}
									else
									{
										$validateproduct='';
										if($validatequantity[0]=='')
											$validatequantity=$this->APValidateGetMinimunQuantity($validmaterialtype[5],$qtyconverttoint);									
										$validcolor=$this->APcsvvalidateColor($validmaterialtype[2],$field[2]);
										$fieldcount=count($field);
										$text_content="";
										if($fieldcount==4)
										{
											$field[3]=substr($field[3],0,-2);
											if(substr($field[3],0,1)=='"'&&substr($field[3],-1,1)=='"')
											{
												$field[3]=substr($field[3],1);
												$field[3]=substr($field[3],0,-1);
											}											
											$text_content=str_replace('""','"',$field[3]);								
										}
										else if($fieldcount>4)
										{	
											$field[3]=substr($field[3],1);	
											$text_initialcontent=str_replace('""','"',$field[3]);									
											for($c=4;$c<$fieldcount;$c++)
											{	
												if($c==($fieldcount-1))
												{
													$field[$c]=substr($field[$c],0,-3);//remove \r and "
												}
												$fieldcontent=str_replace('""','"',$field[$c]);		
												$text_content=$text_content.",".$fieldcontent;
											}
											$text_content=$text_initialcontent.$text_content;
										}									
										$max_result=$this->APcsvvalidateMaxCharNormal($validmaterialtype[1]);
										if(strlen($text_content)>$max_result[max_chars_upper])
										{
											$validtextchara='Text content is over the maximum '.$max_result[max_chars_upper].' allowed characters';
										}
										else
										{
											$validtextchara='';											
										}	
									}
								}
								if($validatequantity[0]!=''||$validmaterialtype[0]!=''||$validcolor[0]!=''||$validtextchara!=''||$validateproduct!='')
								{
									echo 'row'.($count-2).$validatequantity[0].' '.$validmaterialtype[0].' '.$validcolor[0].' '.$validtextchara.' '.$validateproduct.'<br/>';
									if($thereiserror!='Y')
										$thereiserror='Y';
								}
								else
								{
									$csvdata[quantity][$count]=$validatequantity[1];
									$csvdata[productno][$count]=$validmaterialtype[2];
									$csvdata[color][$count]=$validcolor[1];
									$csvdata[skucode][$count]=$validmaterialtype[1];
									$csvdata[textcontent][$count][0]=$text_content;
									//$csvdata[textsize][$count]=$max_result[text_size];
								}
								$count++;
							}
							if($csvcomment!=''&&strlen($csvcomment)>255)
							{
								echo 'Comment is over 255 the max allowed characters';
								if($thereiserror!='Y')
									$thereiserror='Y';
							}										
							if($thereiserror=='N')
							{	
								for($l=3;$l<$count;$l++)
								{
									$product=$this->APcheckfromproductinsertNameplate($csvdata[productno][$l]);
									$skucode=$this->APcheckdescriptiontable($csvdata[skucode][$l]);
									$quantitytype=$this->Nameplategetpricedetailsfrommaterial($skucode[material_code]);
									$quantitycount=count($quantitytype);
									$i=0;
									if($quantitycount>0)
									{
										foreach($quantitytype as $key => $quantitytype_data)
										{	
											$quantitygroup[$i]=$quantitytype_data['quantity'];
											$pricegroup[$i]=$quantitytype_data['price'];
											$i++;
										}	
									}
									
									$addquantity=$csvdata[quantity][$l];
									//$addquantity is the current total of the existing shopping cart of the product with the same material code
									$k=0;
									while($k<$quantitycount)
									{
										if($addquantity>=$quantitygroup[$k]&&$addquantity<$quantitygroup[$k+1])
										{
											break;
										}
										$k++;
									}
									if($k==$quantitycount)	
										$k=$k-1;	
									$quantity=$quantitygroup[$k];
									
									if($_SESSION[user_type]=='R')
									{
										$currentprice=$pricegroup[$k]*(100-$_SESSION['discount_data'])/100;
										$last_price=$pricegroup[$k];
									}
									else
									{
										$currentprice=$pricegroup[$k];
										$last_price=$pricegroup[0];

									}
									$price=$this->APgetinfofromprice($skucode[material_code],$quantity);
									if($price[min_quantity_below]&&($csvdata[quantity][$l]<$price[min_quantity_below]))
									{
										$last_total=$last_price*$csvdata[quantity][$l]+$price[min_quantity_charge]+$skucode[additional_charge];									
										$totalprice=$price[price]*$csvdata[quantity][$l]+$price[min_quantity_charge]+$skucode[additional_charge];									
									}
									else
									{
										$last_total=$last_price*$csvdata[quantity][$l]+$skucode[additional_charge];									
										$totalprice=$price[price]*$csvdata[quantity][$l]+$skucode[additional_charge];
									}						
									$this->APinsert_custom_nameplate_product_csv($product,$skucode,$price,$last_price,$totalprice,$last_total,$csvdata[quantity][$l],$csvdata[color][$l],'','','',$csvdata[textcontent][$l],'','',$csvcomment);							
	
								}
								if($csvcomment!='')
									$this->APInsertCsvComment($csvcomment,$filename);							
							}
							else
								unlink($uploadFilePath);							
						}							
						break;
					}
					case 5://Cust Med Gas Cards   system1 to here the same
					{
						$filetype=$_FILES["importcsvfile"]["type"];	
						$filename=$_FILES['importcsvfile']['name'];
						$uploadFilePath=PathTemplatesShoppingCart.'importcsv/'.$filename;
						$csvcomment=$_REQUEST['csv_comment'];
						if($filename=='')
							print 'Please upload a file.';
						else if($filetype!='application/vnd.ms-excel'&&$filetype!='text/csv')
							print 'Only csv file is allowed';					
						else
						{
							if (file_exists($uploadFilePath))
							{
							   $purefilename=substr($filename,0,-$typelength);
							   $random_digit=rand(0000,9999);
							   $filename=$purefilename.$random_digit.date('Ynjhis').".".'csv';
							   $uploadFilePath=PathTemplatesShoppingCart.'importcsv/'.$filename;
							}
							copy($_FILES['importcsvfile']['tmp_name'], $uploadFilePath);
							$arrLines = file($uploadFilePath);
							$count=3;
							$thereiserror='N';
							while($arrLines[$count])
							{
								$field = array();							
								$field= explode( ',', $arrLines[$count]);
								if(!is_numeric($field[0]))
									$validatequantity[0]=' Quantity is not valid.';	
								else
								{
									$qtyconverttoint = (int)($field[0]);
									if($qtyconverttoint<1||(string)$qtyconverttoint!=$field[0])
										$validatequantity[0]=' Quantity is not valid.';
									else
										$validatequantity[0]='';
								}
								if(substr($field[1],0,1)=='"'&&substr($field[1],-1,1)=='"')
								{
									$field[1]=substr($field[1],1);
									$field[1]=substr($field[1],0,-1);
								}		
								$field[1]=str_replace('""','"',$field[1]);	
								$validcolor[0]='';
								$validtextchara='';
								$validmaterialtype=$this->APcsvvalidateMaterialtypeDescription($field[1]);
								if($validmaterialtype[0]=='')
								{
									if($validmaterialtype[2]!='Cust Med Gas Cards')
									{
										$validateproduct="The product is not 'Cust Med Gas Cards'";	
									}
									else
									{
										$validateproduct='';
										if($validatequantity[0]=='')
											$validatequantity=$this->APValidateGetMinimunQuantity($validmaterialtype[5],$qtyconverttoint);									
										$validcolor=$this->APcsvvalidateColor($validmaterialtype[2],$field[2]);
										$fieldcount=count($field);
										$text_content="";
										if($fieldcount==4)
										{
											$field[3]=substr($field[3],0,-2);
											if(substr($field[3],0,1)=='"'&&substr($field[3],-1,1)=='"')
											{
												$field[3]=substr($field[3],1);
												$field[3]=substr($field[3],0,-1);
											}											
											$text_content=str_replace('""','"',$field[3]);								

										}
										else if($fieldcount>4)
										{	
											$field[3]=substr($field[3],1);	
											$text_initialcontent=str_replace('""','"',$field[3]);
											
											for($c=4;$c<$fieldcount;$c++)
											{	
												if($c==($fieldcount-1))
												{
													$field[$c]=substr($field[$c],0,-3);//remove \r and "
												}
												$fieldcontent=str_replace('""','"',$field[$c]);		
												$text_content=$text_content.",".$fieldcontent;
											}
											$text_content=$text_initialcontent.$text_content;
										}
										$max_result=$this->APcsvvalidateMaxCharNormal($validmaterialtype[1]);
										if(strlen($text_content)>$max_result[max_chars_upper])
										{
											$validtextchara='Text content is over the maximum '.$max_result[max_chars_upper].' allowed characters';
										}
										else
										{
											$validtextchara='';											
										}											
									}
								}
								if($validatequantity[0]!=''||$validmaterialtype[0]!=''||$validcolor[0]!=''||$validtextchara!=''||$validateproduct!='')
								{
									echo 'row'.($count-2).$validatequantity[0].' '.$validmaterialtype[0].' '.$validcolor[0].' '.$validtextchara.' '.$validateproduct.'<br/>';
									if($thereiserror!='Y')
										$thereiserror='Y';
								}
								else
								{
									$csvdata[quantity][$count]=$validatequantity[1];
									$csvdata[productno][$count]=$validmaterialtype[2];
									$csvdata[color][$count]=$validcolor[1];
									$csvdata[skucode][$count]=$validmaterialtype[1];
									$csvdata[textcontent][$count][0]=$text_content;
									//$csvdata[textsize][$count]=$max_result[text_size];

								}
								$count++;
							}
							if($csvcomment!=''&&strlen($csvcomment)>255)
							{
								echo 'Comment is over 255 the max allowed characters';
								if($thereiserror!='Y')
									$thereiserror='Y';
							}									
							if($thereiserror=='N')
							{	
								for($l=3;$l<$count;$l++)
								{
									$product=$this->APcheckfromproductinsertNameplate($csvdata[productno][$l]);
									$skucode=$this->APcheckdescriptiontable($csvdata[skucode][$l]);
									$quantitytype=$this->Nameplategetpricedetailsfrommaterial($skucode[material_code]);
									$quantitycount=count($quantitytype);
									$i=0;
									if($quantitycount>0)
									{
										foreach($quantitytype as $key => $quantitytype_data)
										{	
											$quantitygroup[$i]=$quantitytype_data['quantity'];
											$pricegroup[$i]=$quantitytype_data['price'];
											$i++;
										}	
									}
									$addquantity=$csvdata[quantity][$l];
									//$addquantity is the current total of the existing shopping cart of the product with the same material code
	
									$k=0;
									while($k<$quantitycount)
									{
										if($addquantity>=$quantitygroup[$k]&&$addquantity<$quantitygroup[$k+1])
										{
											break;
										}
										$k++;
									}
									if($k==$quantitycount)	
										$k=$k-1;	
									$quantity=$quantitygroup[$k];
									
									if($_SESSION[user_type]=='R')
									{
										$currentprice=$pricegroup[$k]*(100-$_SESSION['discount_data'])/100;
										$last_price=$pricegroup[$k];
									}
									else
									{
										$currentprice=$pricegroup[$k];
										$last_price=$pricegroup[0];
									}
									$price=$this->APgetinfofromprice($skucode[material_code],$quantity);
									if($price[min_quantity_below]&&($csvdata[quantity][$l]<$price[min_quantity_below]))
									{
										$last_total=$last_price*$csvdata[quantity][$l]+$price[min_quantity_charge]+$skucode[additional_charge];									
										$totalprice=$price[price]*$csvdata[quantity][$l]+$price[min_quantity_charge]+$skucode[additional_charge];									
									}
									else
									{
										$last_total=$last_price*$csvdata[quantity][$l]+$skucode[additional_charge];									
										$totalprice=$price[price]*$csvdata[quantity][$l]+$skucode[additional_charge];
									}	
									$this->APinsert_custom_nameplate_product_csv($product,$skucode,$price,$last_price,$totalprice,$last_total,$csvdata[quantity][$l],$csvdata[color][$l],'','','',$csvdata[textcontent][$l],'','',$csvcomment);							
									
								}
								if($csvcomment!='')
									$this->APInsertCsvComment($csvcomment,$filename);							
							}
							else
								unlink($uploadFilePath);							
						}							
						break;
					}
					case 6://Sequential Tags   (no copy to fit case)
					{
						$filetype=$_FILES["importcsvfile"]["type"];	

						$filename=$_FILES['importcsvfile']['name'];
						$uploadFilePath=PathTemplatesShoppingCart.'importcsv/'.$filename;
						$csvcomment=$_REQUEST['csv_comment'];
						if($filename=='')
							print 'Please upload a file.';
						else if($filetype!='application/vnd.ms-excel'&&$filetype!='text/csv')
							print 'Only csv file is allowed';				
						else
						{
							if (file_exists($uploadFilePath))
							{
							   $purefilename=substr($filename,0,-$typelength);
							   $random_digit=rand(0000,9999);
							   $filename=$purefilename.$random_digit.date('Ynjhis').".".'csv';
							   $uploadFilePath=PathTemplatesShoppingCart.'importcsv/'.$filename;
							}
							copy($_FILES['importcsvfile']['tmp_name'], $uploadFilePath);
							$arrLines = file($uploadFilePath);
							$count=3;
							$thereiserror='N';
							while($arrLines[$count])
							{
								$field = array();							
								$field= explode( ',', $arrLines[$count]);
								if(!is_numeric($field[0]))
									$validatequantity[0]=' Quantity is not valid.';	
								else
								{
									$qtyconverttoint = (int)($field[0]);
									if($qtyconverttoint<1||(string)$qtyconverttoint!=$field[0])
										$validatequantity[0]=' Quantity is not valid.';
									else
										$validatequantity[0]='';
								}
								if(substr($field[1],0,1)=='"'&&substr($field[1],-1,1)=='"')
								{
									$field[1]=substr($field[1],1);
									$field[1]=substr($field[1],0,-1);
								}		
								$field[1]=str_replace('""','"',$field[1]);
								$validateshape[0]='';
								$validatesize[0]='';
								$validatetextsize='';
								$validatefilledarea='';
								$validstartnumber='';
								$validendnumber='';
								$validtextchara='';
								$validtextchara_start='';
								$validtextchara_end='';								
								$validmaterialtype=$this->APcsvvalidateMaterialtypeDescription($field[1]);
								if($validmaterialtype[0]=='')
								{
									if($validmaterialtype[2]!='Sequential Tags')//to be check
									{
										$validateproduct="The product is not 'Sequential Valve Tags'";	
									}
									else
									{
										$validateproduct='';
										$validateshape=$this->APcsvvalidateShape($field[2],$field[1]);
										if($validateshape[0]=='')
										{
											$size=str_replace("'","",$field[3]);
											$validatesize=$this->APcsvvalidatesizefromMaterial($field[1],$field[2],$size);
											if($validatesize[0]=='')
											{
												if($validatequantity[0]=='')
												{
													$validatequantity=$this->APValidateGetMinimunQuantity($validatesize[3],$qtyconverttoint);
													if($qtyconverttoint%25!=0)
														$validatequantity[0].=' Quantity must be a multiple of 25.';
												}
												$field[4]=strtolower($field[4]);
												$field[4]=str_replace("'","",$field[4]);
												$field[4]=str_replace('"','',$field[4]);
												$fieldcount=count($field);
												$field[$fieldcount-1]=substr($field[$fieldcount-1],0,-2);//remove \r								
												$text_content="";									
												if($fieldcount==8)
												{
													if(substr($field[5],0,1)=='"'&&substr($field[5],-1,1)=='"')
													{
														$field[5]=substr($field[5],1);
														$field[5]=substr($field[5],0,-1);
													}											
													$text_content=str_replace('""','"',$field[5]);								
												}
												else if($fieldcount>8)
												{	
													$field[5]=substr($field[5],1);	
													$text_initialcontent=str_replace('""','"',$field[5]);								
													for($c=6;$c<($fieldcount-2);$c++)
													{	
														if($c==($fieldcount-3))
														{
															$field[$c]=substr($field[$c],0,-1);//remove "
														}
														$fieldcontent=str_replace('""','"',$field[$c]);
														$text_content=$text_content.",".$fieldcontent;
													}
													$text_content=$text_initialcontent.$text_content;
												}
												if($field[4]=='1/4 top')
												{
													$validatetextsize_top=$this->APcsvvalidateTextsizeValvetag($validatesize[2],'1/4"');
													if($validatetextsize_top!='')
														$validatetextsize='Top text size is not valid.';
													else
													{
														$field[4]='1/4" top';
														$validatetextsize='';
														if($text_content=='')
														{
															$validatefilledarea='Top line should not be empty.';
														}
														else
														{
															$validatefilledarea='';
															$GetMaxtextcharacter=$this->APcsvvalidateTextmaxresultFromSku($validatesize[2],'1/4"');											
															$chracternumber=strlen($text_content);
															if($GetMaxtextcharacter[max_chars_upper]<$chracternumber)
																$validtextchara="Top line's characters are over ".$GetMaxtextcharacter[max_chars_upper]." ,the max allowed characters.";
															else
																$validtextchara='';												
														}
													}
													if($field[$fieldcount-2]!='')
													{
														$validatefilledarea.='Start number should be empty.';
													}
													if($field[$fieldcount-1]!='')
													{
														$validatefilledarea.='End number should be empty.';
													}											
												}
												else if($field[4]=='1/2 bottom')
												{									
													$validatetextsize_bottom=$this->APcsvvalidateTextsizeValvetag($validatesize[2],'1/2"');
													if($validatetextsize_bottom!='')
														$validatetextsize='Bottom text size is not valid.';
													else
													{
														$field[4]='1/2" bottom';
														$validatetextsize='';
														if($text_content!='')
														{
															$validatefilledarea='Top line should be empty.';
														}												
														if($field[$fieldcount-2]==''&&$field[$fieldcount-1]=='')//if start number empty, end number not, then end number will be start number
														{
															$validatefilledarea.='Start number should not be empty.';
														}											
													}
												}
												else if($field[4]=='1/4 top & 1/2 bottom')
												{
													$validatetextsize=$this->APcsvvalidateTextsizeValvetagCheckboth($validatesize[2],'1/2"','1/4"');
													if($validatetextsize=='')
													{
														$field[4]='1/4" top & 1/2" bottom';
														$validatefilledarea='';
														if($text_content=='')
														{
															$validatefilledarea='Top line should not be empty.';
														}
														if($field[$fieldcount-2]==''&&$field[$fieldcount-1]=='')
														{
															$validatefilledarea.='Start number should not be empty.';
														}
													}
												}
												else
												{
													$validatetextsize='Text size option is not valid.';
													$field[4]='';
												}
												$GetMaxtextcharacter_num=$this->APcsvvalidateTextmaxresultFromSku($validatesize[2],'1/2"');
												$start_number='';
												$end_number='';
												if($field[$fieldcount-2]!='')
												{
													if(!is_numeric($field[$fieldcount-2]))
														$validstartnumber='Start number is not valid.';
													else

													{
														$start_number = (int)($field[$fieldcount-2]);
														if($start_number<1||(string)$start_number!=$field[$fieldcount-2])
															$validstartnumber='Start number is not valid.';
														else
														{
															$validstartnumber='';
															$chracternumber_start=strlen($start_number);
															if($GetMaxtextcharacter_num[max_chars_upper]<$chracternumber_start)
																$validtextchara_start="Start number's characters are over ".$GetMaxtextcharacter_num[max_chars_upper]." ,the max allowed characters.";
															else
																$validtextchara_start='';													
														}
													}										
												}
												if($field[$fieldcount-1]!='')
												{
													if(!is_numeric($field[$fieldcount-1]))
														$validendnumber='End number is not valid.';
													else
													{
														$end_number = (int)($field[$fieldcount-1]);
														if($end_number<1||(string)$end_number!=$field[$fieldcount-1])
														{
															$validendnumber='End number is not valid.';
														}
														else if($end_number<=$start_number)
														{
															$validendnumber='End number should be bigger than start number.';
														}
														else
														{
															$validendnumber='';
															$chracternumber_end=strlen($end_number);
															if($GetMaxtextcharacter_num[max_chars_upper]<$chracternumber_end)
																$validtextchara_end="End number's characters are over ".$GetMaxtextcharacter_num[max_chars_upper]." ,the max allowed characters.";
															else
																$validtextchara_end='';													
														}
													}										
												}
											}
										}
									}
								}
								if($validatequantity[0]!=''||$validmaterialtype[0]!=''||$validateshape[0]!=''||$validatesize[0]!=''||$validatetextsize!=''||$validtextchara!=''||$validatefilledarea!=''||$validstartnumber!=''||$validendnumber!=''||$validtextchara_start!=''||$validtextchara_end!=''||$validateproduct!='')
								{
									echo 'row'.($count-2).$validatequantity[0].' '.$validmaterialtype[0].' '.$validateshape[0].' '.$validatesize[0].' '.$validatetextsize.' '.$validtextchara.' '.$validatefilledarea.' '.$validstartnumber.' '.$validendnumber.' '.$validtextchara_start.' '.$validtextchara_end.' '.$validateproduct.'<br/>';
									if($thereiserror!='Y')
										$thereiserror='Y';
								}
								else
								{
									$csvdata[quantity][$count]=$validatequantity[1];
									$csvdata[productno][$count]=$validmaterialtype[2];
									$csvdata[size][$count]=$validatesize[1];
									$csvdata[skucode][$count]=$validatesize[2];
									$csvdata[textcontent][$count][0]=$text_content;
									if($field[$fieldcount-2]==''&&$field[$fieldcount-1]!='')
									{
										$csvdata[start_number][$count]=$end_number;
										$csvdata[end_number][$count]='';
									}
									else 
									{
										$csvdata[start_number][$count]=$start_number;
										$csvdata[end_number][$count]=$end_number;
									}
									$csvdata[textsize][$count]=$field[4];
								}
								$count++;
							}
							if($csvcomment!=''&&strlen($csvcomment)>255)
							{
								echo 'Comment is over 255 the max allowed characters';
								if($thereiserror!='Y')
									$thereiserror='Y';
							}									
							if($thereiserror=='N')
							{	
								for($l=3;$l<$count;$l++)
								{
									$product=$this->APcheckfromproductinsertNameplate($csvdata[productno][$l]);
									$skucode=$this->APcheckdescriptiontable($csvdata[skucode][$l]);
									$quantitytype=$this->Nameplategetpricedetailsfrommaterial($skucode[material_code]);
									$quantitycount=count($quantitytype);
									$i=0;
									if($quantitycount>0)
									{
										foreach($quantitytype as $key => $quantitytype_data)
										{	
											$quantitygroup[$i]=$quantitytype_data['quantity'];
											$pricegroup[$i]=$quantitytype_data['price'];
											$i++;
										}	
									}
									$addquantity=$csvdata[quantity][$l];
									//$addquantity is the current total of the existing shopping cart of the product with the same material code
	
									$k=0;
									while($k<$quantitycount)
									{
										if($addquantity>=$quantitygroup[$k]&&$addquantity<$quantitygroup[$k+1])
										{
											break;
										}
										$k++;
									}
									if($k==$quantitycount)	
										$k=$k-1;	
									$quantity=$quantitygroup[$k];
									
									if($_SESSION[user_type]=='R')
									{
										$currentprice=$pricegroup[$k]*(100-$_SESSION['discount_data'])/100;
										$last_price=$pricegroup[$k];
									}
									else
									{
										$currentprice=$pricegroup[$k];
										$last_price=$pricegroup[0];
									}
									$price=$this->APgetinfofromprice($skucode[material_code],$quantity);
									if($price[min_quantity_below]&&($csvdata[quantity][$l]<$price[min_quantity_below]))
									{
										$last_total=$last_price*$csvdata[quantity][$l]+$price[min_quantity_charge]+$skucode[additional_charge];									
										$totalprice=$price[price]*$csvdata[quantity][$l]+$price[min_quantity_charge]+$skucode[additional_charge];									
									}
									else
									{
										$last_total=$last_price*$csvdata[quantity][$l]+$skucode[additional_charge];									
										$totalprice=$price[price]*$csvdata[quantity][$l]+$skucode[additional_charge];
									}
									$this->APinsert_custom_nameplate_product_csv_valvetag($product,$skucode,$price,$last_price,$totalprice,$last_total,$csvdata[quantity][$l],'',$csvdata[textcontent][$l],$csvdata[textsize][$l],$csvdata[start_number][$l],$csvdata[end_number][$l],$csvcomment);	//put text position 0 for summary display distinguish						
									
								}
								if($csvcomment!='')
									$this->APInsertCsvComment($csvcomment,$filename);							
							}
							else
								unlink($uploadFilePath);							
						}							
						break;
					}
					case 7://Non Sequential  no copy to fit to be check max line and max character    to be conntinued
					{
						$filetype=$_FILES["importcsvfile"]["type"];	
						$filename=$_FILES['importcsvfile']['name'];
						$uploadFilePath=PathTemplatesShoppingCart.'importcsv/'.$filename;
						$csvcomment=$_REQUEST['csv_comment'];
						if($filename=='')
							print 'Please upload a file.';
						else if($filetype!='application/vnd.ms-excel'&&$filetype!='text/csv')
							print 'Only csv file is allowed';					
						else
						{
							if (file_exists($uploadFilePath))
							{
							   $purefilename=substr($filename,0,-$typelength);
							   $random_digit=rand(0000,9999);
							   $filename=$purefilename.$random_digit.date('Ynjhis').".".'csv';
							   $uploadFilePath=PathTemplatesShoppingCart.'importcsv/'.$filename;
							}							
							copy($_FILES['importcsvfile']['tmp_name'], $uploadFilePath);

							$file = fopen($uploadFilePath,"r");
							$count=0;
							$thereiserror='N';
							while(!feof($file))
							{
								$field = fgetcsv($file, 1024,",");
								if($field!=FALSE&&$count>2)
								{
									if(!is_numeric($field[0]))
										$validatequantity[$count][0]=' Quantity is not valid.';	
									else
									{
										$qtyconverttoint = (int)($field[0]);
										if($qtyconverttoint<1||(string)$qtyconverttoint!=$field[0])
											$validatequantity[$count][0]=' Quantity is not valid.';
										else
											$validatequantity[$count][0]='';
									}																		
									$validmaterialtype[$count]=$this->APcsvvalidateMaterialtypeDescription($field[1]);
									if($validmaterialtype[$count][0]=='')
									{
										if($validmaterialtype[$count][2]!='Non Sequential'&&$validmaterialtype[$count][2]!='Non Sequential1')
										{
											$validateproduct[$count]="The product is not 'Non Sequential Valve Tags'";	
										}
										else
										{
											$validateshape[$count]=$this->APcsvvalidateShape($field[2],$field[1]);
											if($validateshape[$count][0]=='')
											{
												$size=str_replace("'","",$field[3]);
												$validatesize[$count]=$this->APcsvvalidatesizefromMaterial($field[1],$field[2],$size);
												if($validatesize[$count][0]=='')
												{
													if($validatequantity[$count][0]=='')
														$validatequantity[$count]=$this->APValidateGetMinimunQuantity($validatesize[$count][3],$qtyconverttoint);										
													$field[4]=strtolower($field[4]);
													$field[4]=str_replace("'","",$field[4]);
													$field[4]=str_replace('"','',$field[4]);
													if($field[4]=="1/4")
													{
														$textsize[$count]=$field[4];									
														$validatetextsize[$count]=$this->APcsvvalidateTextsizeValvetag($validatesize[$count][2],'1/4');
														if($validatetextsize[$count]=='')
														{
															$GetMaxtextcharacter=$this->APcsvvalidateTextmaxresultFromSku($validatesize[$count][2],'1/4');
															$csvdata[maxchar][$count][0]=$GetMaxtextcharacter[max_chars_upper];											
															$commacount[$count][0]=substr_count($field[5], ",");
															$commacount[$count][1]=substr_count($field[6], ",");
															$commacount[$count][2]=substr_count($field[7], ",");											
														}                                            
													}
													else if($field[4]=="1/2")
													{
														$textsize[$count]=$field[4];
														$validatetextsize[$count]=$this->APcsvvalidateTextsizeValvetag($validatesize[$count][2],'1/2');							
														if($validatetextsize[$count]=='')
														{
															$GetMaxtextcharacter=$this->APcsvvalidateTextmaxresultFromSku($validatesize[$count][2],'1/2');
															$csvdata[maxchar][$count][0]=$GetMaxtextcharacter[max_chars_upper];												
															$commacount[$count][0]=substr_count($field[5], ",");																																
														}
													}
													else if($field[4]=="1/4 top & 1/2 bottom")
													{
														$textsize[$count]=$field[4];
														$validatetextsize[$count]=$this->APcsvvalidateTextsizeValvetagCheckboth($validatesize[$count][2],'1/2','1/4');
														if($validatetextsize[$count]=='')
														{
															$GetMaxtextcharacter=$this->APcsvvalidateTextmaxresultFromSku($validatesize[$count][2],'1/4');
															$csvdata[maxchar][$count][0]=$GetMaxtextcharacter[max_chars_upper];	
															$GetMaxtextcharacter2=$this->APcsvvalidateTextmaxresultFromSku($validatesize[$count][2],'1/2"');	
															$csvdata[maxchar][$count][1]=$GetMaxtextcharacter2[max_chars_upper];													
															$commacount[$count][0]=substr_count($field[5], ",");
															$commacount[$count][1]=substr_count($field[6], ","); 																		
														}
													}
													else
													{
														$validatetextsize[$count]='Text size option is not valid.';
													}
												}
											}
										}
									}
								}
								$count++;
							}
							fclose($file);
							$arrLines = file($uploadFilePath);
							$rowcount=3;
							$thereiserror='N';
							while($arrLines[$rowcount])
							{
								$textfield = array();							
								$textfield= explode( ',', $arrLines[$rowcount]);
								$fieldcount=count($textfield);
								$textfield[$fieldcount-1]=substr($textfield[$fieldcount-1],0,-2);
								if($validatetextsize[$rowcount]==''&&$validateproduct[$rowcount]==''&&$validmaterialtype[$rowcount][0]==''&&$validateshape[$rowcount][0]==''&&$validatesize[$rowcount][0]=='')//make sure text size and product number is valid first 
								{
									for($columnline=0;$columnline<3;$columnline++)
									{
										 $index=5+$columnline+$commacount[$rowcount][$columnline-1]+$commacount[$rowcount][$columnline-2];
										 if($commacount[$rowcount][$columnline]==0)
										 {
											if(substr($textfield[$index],0,1)=='"'&&substr($textfield[$index],-1,1)=='"')
											{
												$textfield[$index]=substr($textfield[$index],1);
												$textfield[$index]=substr($textfield[$index],0,-1);
											}											
											$text_line[$columnline]=str_replace('""','"',$textfield[$index]);
										 }
										 else
										 {										 
											$textfield[$index]=substr($textfield[$index],1);	
											$text_initialcontent=str_replace('""','"',$textfield[$index]);																			
											$text_content="";
											for($c=($index+1);$c<=($index+$commacount[$rowcount][$columnline]);$c++)
											{	
												if($c==($index+$commacount[$rowcount][$columnline]))
												{
													$textfield[$c]=substr($textfield[$c],0,-1);//remove "
												}												
												$fieldcontent=str_replace('""','"',$textfield[$c]);
												$text_content=$text_content.",".$fieldcontent;
											}
											$text_line[$columnline]=$text_initialcontent.$text_content;	
										}
									}
									if($textsize[$rowcount]=="1/4")
									{
										if($text_line[0]=='')
										{
											$validfilledarea[$rowcount]='Line1 should not be empty';
										}
										else
										{
											$chracternumber=strlen($text_line[0]);												
											if($csvdata[maxchar][$rowcount][0]<$chracternumber)
											{
												$validtextchara[$rowcount]="Line1's characters are over ".$csvdata[maxchar][$rowcount][0]." ,the max allowed characters.";
											}
											else
											{
												$csvdata[textcontent][$rowcount][0]=$text_line[0];
												$csvdata[textposition][$rowcount][0]=1;
												$csvdata[textsize][$rowcount][0]='1/4"';
											}	
										}
										if($text_line[1]!='')
										{
											$chracternumber=strlen($text_line[1]);												

											if($csvdata[maxchar][$rowcount][0]<$chracternumber)
											{
												$validtextchara[$rowcount].="Line2's characters are over ".$csvdata[maxchar][$rowcount][0]." ,the max allowed characters.";
											}
											else
											{
												$csvdata[textcontent][$rowcount][1]=$text_line[1];
												$csvdata[textposition][$rowcount][1]=2;
												$csvdata[textsize][$rowcount][1]='1/4"';
											}
											if($text_line[2]!='')
											{
												$chracternumber=strlen($text_content[2]);												
												if($csvdata[maxchar][$rowcount][0]<$chracternumber)
												{
													$validtextchara[$rowcount].="Line3's characters are over ".$csvdata[maxchar][$rowcount][0]." ,the max allowed characters.";
												}
												else
												{
													$csvdata[textcontent][$rowcount][2]=$text_line[2];
													$csvdata[textposition][$rowcount][2]=3;
													$csvdata[textsize][$rowcount][2]='1/4"';
												}
											}												
										}
										else if($text_line[2]!='')
										{
											$chracternumber=strlen($text_line[2]);												
											if($csvdata[maxchar][$rowcount][0]<$chracternumber)
											{
												$validtextchara[$rowcount].="Line3's characters are over ".$csvdata[maxchar][$rowcount][0]." ,the max allowed characters.";
											}
											else
											{
												$csvdata[textcontent][$rowcount][1]='';
												$csvdata[textposition][$rowcount][1]=2;
												$csvdata[textsize][$rowcount][1]='1/4"';
												$csvdata[textcontent][$rowcount][2]=$text_line[2];
												$csvdata[textposition][$rowcount][2]=3;
												$csvdata[textsize][$rowcount][2]='1/4"';												
											}										
										}									
									}
									else if($textsize[$rowcount]=="1/2")
									{
										if($text_line[0]=='')
										{
											$validfilledarea[$rowcount]='Line1 should not be empty';
										}
										else
										{
											$chracternumber=strlen($text_line[0]);												
											if($csvdata[maxchar][$rowcount][0]<$chracternumber)
											{
												$validtextchara[$rowcount]="Line1's characters are over ".$csvdata[maxchar][$rowcount][0]." ,the max allowed characters.";
											}
											else
											{
												$csvdata[textcontent][$rowcount][0]=$text_line[0];
												$csvdata[textposition][$rowcount][0]=1;
												$csvdata[textsize][$rowcount][0]='1/2"';
											}	
										}
										if($text_line[1]!='')
										{
											$validfilledarea[$rowcount].='Line2 should be empty';
										}
										if($text_line[2]!='')
										{
											$validfilledarea[$rowcount].='Line3 should be empty';
										}																						
									}
									else if($textsize[$rowcount]=="1/4 top & 1/2 bottom")
									{
										if($text_line[0]=='')
										{
											$validfilledarea[$rowcount]='Line1 should not be empty';
										}
										else
										{
											$chracternumber=strlen($text_content[0]);												
											if($csvdata[maxchar][$rowcount][0]<$chracternumber)
											{
												$validtextchara[$rowcount]="Line1's characters are over ".$csvdata[maxchar][$rowcount][0]." ,the max allowed characters.";
											}
											else
											{
												$csvdata[textcontent][$rowcount][0]=$text_line[0];

												$csvdata[textposition][$rowcount][0]=1;
												$csvdata[textsize][$rowcount][0]='1/4"';
											}	
										}
										if($text_line[1]=='')
										{
											$validfilledarea[$rowcount].='Line2 should not be empty';
										}
										else

										{
											$chracternumber=strlen($text_line[1]);												
											if($csvdata[maxchar][$rowcount][1]<$chracternumber)
											{
												$validtextchara[$rowcount].="Line2's characters are over ".$csvdata[maxchar][$rowcount][1]." ,the max allowed characters.";
											}
											else
											{
												$csvdata[textcontent][$rowcount][1]=$text_line[1];
												$csvdata[textposition][$rowcount][1]=2;
												$csvdata[textsize][$rowcount][1]='1/2"';
											}
										}
										if($text_line[2]!='')
										{
											$validfilledarea[$rowcount].='Line3 should be empty';
										}													
									}									
								}
								if($validatequantity[$rowcount][0]!=''||$validmaterialtype[$rowcount][0]!=''||$validateshape[$rowcount][0]!=''||$validatesize[$rowcount][0]!=''||$validatetextsize[$rowcount]!=''||$validfilledarea[$rowcount]!=''||$validtextchara[$rowcount]!=''||$validateproduct[$rowcount]!='')									
								{
									echo 'row'.($rowcount-2).$validatequantity[$rowcount][0].' '.$validmaterialtype[$rowcount][0].' '.$validateshape[$rowcount][0].' '.$validatesize[$rowcount][0].' '.$validatetextsize[$rowcount].' '.$validfilledarea[$rowcount].' '.$validtextchara[$rowcount].' '.$validateproduct[$rowcount].'<br/>';
									if($thereiserror!='Y')
										$thereiserror='Y';
								}
								else
								{
									$csvdata[quantity][$rowcount]=$validatequantity[$rowcount][1];

									$csvdata[productno][$rowcount]=$validmaterialtype[$rowcount][2];
									$csvdata[size][$rowcount]=$validatesize[$rowcount][1];
									$csvdata[skucode][$rowcount]=$validatesize[$rowcount][2];
								}									
								$rowcount++;
							}
							if($csvcomment!=''&&strlen($csvcomment)>255)
							{
								echo 'Comment is over 255 the max allowed characters';
								if($thereiserror!='Y')
									$thereiserror='Y';
							}									
							if($thereiserror=='N')
							{
								for($l=3;$l<$count;$l++)
								{
									$product=$this->APcheckfromproductinsertNameplate($csvdata[productno][$l]);
									$skucode=$this->APcheckdescriptiontable($csvdata[skucode][$l]);
									$quantitytype=$this->Nameplategetpricedetailsfrommaterial($skucode[material_code]);
									$quantitycount=count($quantitytype);
									$i=0;
									if($quantitycount>0)
									{
										foreach($quantitytype as $key => $quantitytype_data)
										{	
											$quantitygroup[$i]=$quantitytype_data['quantity'];
											$pricegroup[$i]=$quantitytype_data['price'];
											$i++;
										}	
									}
									$addquantity=$csvdata[quantity][$l];
									//$addquantity is the current total of the existing shopping cart of the product with the same material code
	
									$k=0;
									while($k<$quantitycount)
									{
										if($addquantity>=$quantitygroup[$k]&&$addquantity<$quantitygroup[$k+1])
										{
											break;
										}
										$k++;
									}
									if($k==$quantitycount)	
										$k=$k-1;	
									$quantity=$quantitygroup[$k];
									
									if($_SESSION[user_type]=='R')
									{
										$currentprice=$pricegroup[$k]*(100-$_SESSION['discount_data'])/100;
										$last_price=$pricegroup[$k];
									}
									else
									{
										$currentprice=$pricegroup[$k];
										$last_price=$pricegroup[0];
									}
									$price=$this->APgetinfofromprice($skucode[material_code],$quantity);
									if($price[min_quantity_below]&&($csvdata[quantity][$l]<$price[min_quantity_below]))
									{
										$last_total=$last_price*$csvdata[quantity][$l]+$price[min_quantity_charge]+$skucode[additional_charge];									
										$totalprice=$price[price]*$csvdata[quantity][$l]+$price[min_quantity_charge]+$skucode[additional_charge];									
									}
									else
									{
										$last_total=$last_price*$csvdata[quantity][$l]+$skucode[additional_charge];									
										$totalprice=$price[price]*$csvdata[quantity][$l]+$skucode[additional_charge];
									}
									$this->APinsert_custom_nameplate_productNonSequentialValve_csv($product,$skucode,$price,$last_price,$totalprice,$last_total,$csvdata[quantity][$l],'','','',$csvdata[textcontent][$l],$csvdata[textposition][$l],$csvdata[textsize][$l],$csvcomment);															
								}
								if($csvcomment!='')
									$this->APInsertCsvComment($csvcomment,$filename);							
							}
							else
								unlink($uploadFilePath);
						}							
						break;
					}
					case 8://Engraved Valve Tags
					{
						$filetype=$_FILES["importcsvfile"]["type"];	
						$filename=$_FILES['importcsvfile']['name'];
						$csvcomment=$_REQUEST['csv_comment'];
						$uploadFilePath=PathTemplatesShoppingCart.'importcsv/'.$filename;
						if($filename=='')
							print 'Please upload a file.';
						else if($filetype!='application/vnd.ms-excel'&&$filetype!='text/csv')
							print 'Only csv file is allowed';					
						else
						{
							if (file_exists($uploadFilePath))
							{
							   $purefilename=substr($filename,0,-$typelength);
							   $random_digit=rand(0000,9999);
							   $filename=$purefilename.$random_digit.date('Ynjhis').".".'csv';
							   $uploadFilePath=PathTemplatesShoppingCart.'importcsv/'.$filename;
							}
							copy($_FILES['importcsvfile']['tmp_name'], $uploadFilePath);
							$file = fopen($uploadFilePath,"r");
							$count=0;
							$thereiserror='N';
							while(!feof($file))
							{
								$field = fgetcsv($file, 1024,",");
								if($field!=FALSE&&$count>2)
								{
									if(!is_numeric($field[0]))
										$validatequantity[$count][0]=' Quantity is not valid.';	
									else
									{
										$qtyconverttoint = (int)($field[0]);
										if($qtyconverttoint<1||(string)$qtyconverttoint!=$field[0])
											$validatequantity[$count][0]=' Quantity is not valid.';
										else
											$validatequantity[$count][0]='';
									}											
									$validmaterialtype[$count]=$this->APcsvvalidateMaterialtypeDescription($field[1]);
									if($validmaterialtype[$count][0]=='')
									{
										if($validmaterialtype[$count][2]!='Engraved Plastic VT'&&$validmaterialtype[$count][2]!='Engraved Aluminum VT')
										{
											$validateproduct[$count]="The product is not 'Engraved Valve Tags'";	
										}
										else
										{
											$field[2]=str_replace("'","",$field[2]);
											$validthickness[$count]=$this->APcsvvalidateThickness($field[1],$field[2]);
											$size=str_replace("'","",$field[3]);
											$validsize[$count]=$this->APcsvvalidateSize($field[1],$size);
											$validshape[$count]=$this->APcsvvalidateShapeEngravedValveTag($field[4],$field[1],$size);										
											$field[5]=str_replace(" ","",$field[5]);//remove space
											$validcolor[$count]=$this->APcsvvalidateColor($validmaterialtype[$count][2],$field[5]);	
											if($validshape[$count][0]=='')
											{
												if($validatequantity[$count][0]=='')
													$validatequantity[$count]=$this->APValidateGetMinimunQuantity($validshape[$count][3],$qtyconverttoint);													
												$field[6]=strtolower($field[6]);
												if($field[6]!='copy to fit')
												{
													$field[6]=str_replace('"','',$field[6]);    
													$field[6]=str_replace("'","",$field[6]);      
												}                              
												$validatetextsize[$count]=$this->APcsvvalidateTextsize($validshape[$count][2],$field[6]);//sku_code					
												$maxline[$count]=$validatetextsize[$count][2];														
												$maxchar_upper[$count]=$validatetextsize[$count][3];										
												for($c=0;$c<4;$c++)
												{	
													$commacount[$count][$c]=substr_count($field[$c+7], ",");									
												}
											}
										}
									}
								}							
								$count++;
							}
							fclose($file);
							$arrLines = file($uploadFilePath);
							$rowcount=3;
							$thereiserror='N';
							while($arrLines[$rowcount])
							{
								$textfield = array();							

								$textfield= explode( ',', $arrLines[$rowcount]);
								$fieldcount=count($textfield);
								$textfield[$fieldcount-1]=substr($textfield[$fieldcount-1],0,-2);
								if($validatetextsize[$rowcount][0]==''&&$validateproduct[$rowcount]==''&&$validmaterialtype[$rowcount][0]==''&&$validshape[$rowcount][0]=='')//make sure text size is valid first
								{
									for($columnline=0;$columnline<4;$columnline++)
									{
										 $index=7+$columnline+$commacount[$rowcount][$columnline-1]+$commacount[$rowcount][$columnline-2]+$commacount[$rowcount][$columnline-3];
										 if($commacount[$rowcount][$columnline]==0)
										 {
											if(substr($textfield[$index],0,1)=='"'&&substr($textfield[$index],-1,1)=='"')
											{
												$textfield[$index]=substr($textfield[$index],1);
												$textfield[$index]=substr($textfield[$index],0,-1);
											}											
											$text_line[$columnline]=str_replace('""','"',$textfield[$index]);
										 }
										 else
										 {										 
											$textfield[$index]=substr($textfield[$index],1);	
											$text_initialcontent=str_replace('""','"',$textfield[$index]);																			

											$text_content="";
											for($c=($index+1);$c<=($index+$commacount[$rowcount][$columnline]);$c++)
											{	
												if($c==($index+$commacount[$rowcount][$columnline]))
												{
													$textfield[$c]=substr($textfield[$c],0,-1);//remove "
												}												
												$fieldcontent=str_replace('""','"',$textfield[$c]);
												$text_content=$text_content.",".$fieldcontent;
											}
											$text_line[$columnline]=$text_initialcontent.$text_content;	
										}
									}
									$addcolumn=0;										
									if($text_line[$addcolumn]=='')
									{
										$validfilledarea[$rowcount]='Line1 should not be empty';
									}
									else
									{
										$chracternumber=strlen($text_line[$addcolumn]);												
										if($maxchar_upper[$rowcount]<$chracternumber)
										{
											$validtextmaxchar[$rowcount]="Line1's characters are over ".$maxchar_upper[$rowcount]." ,the max allowed characters.";
										}
										else
										{
											$csvdata[textcontent][$rowcount][$addcolumn]=$text_line[$addcolumn];
											$csvdata[textposition][$rowcount][$addcolumn]=1;
											$csvdata[textsize][$rowcount][$addcolumn]=$validatetextsize[$rowcount][1];
										}											
									}
									if($validatetextsize[$rowcount][1]=='copy to fit')
									{
										$textconlumn=0;
										for($addcolumn=1;$addcolumn<4;$addcolumn++)
										{
											if($maxline[$rowcount]<($addcolumn+1)&&$text_line[$addcolumn]!='')
											{
												$validtextmaxline[$rowcount]='Text lines are over '.$maxline[$rowcount].', the maximum allowed lines.';
											}
											if($text_line[$addcolumn]!='')
											{
												$textconlumn=$textconlumn+1;//treat empty as nothing for copy to fit (just skip it)
												$chracternumber=strlen($text_line[$addcolumn]);			
												if($maxchar_upper[$rowcount]<$chracternumber)
												{
													$validtextmaxchar[$rowcount].="Line".($addcolumn+1)."'s characters are over ".$maxchar_upper[$rowcount]." ,the max allowed characters.";
												}
												else
												{
													$csvdata[textcontent][$rowcount][$textconlumn]=$text_line[$addcolumn];
													$csvdata[textposition][$rowcount][$textconlumn]=$textconlumn+1;
													$csvdata[textsize][$rowcount][$textconlumn]=$validatetextsize[$rowcount][1];														
												}
											}
										}
									}
									else//not ccpy to fit
									{
										$r=0;
										for($p=3;$p>0;$p--)
										{
											if($text_line[$p]!='')
											{ 
												break;
											}
											else
											{
												$r++;
											}
										}
										if($maxline[$rowcount]<(4-$r))
										{
											$validtextmaxline[$rowcount]='Text lines are over '.$maxline[$rowcount].', the maximum allowed lines.';
										}										
										for($addcolumn=1;$addcolumn<(4-$r);$addcolumn++)
										{
											$chracternumber=strlen($text_line[$addcolumn]);			
											if($maxchar_upper[$rowcount]<$chracternumber)
											{
												$validtextmaxchar[$rowcount].="Line".($addcolumn+1)."'s characters are over ".$maxchar_upper[$rowcount]." ,the max allowed characters.";
											}
											else
											{
												$csvdata[textcontent][$rowcount][$addcolumn]=$text_line[$addcolumn];
												$csvdata[textposition][$rowcount][$addcolumn]=$addcolumn+1;
												$csvdata[textsize][$rowcount][$addcolumn]=$validatetextsize[$rowcount][1];														
											}										
										}										
									}
								}
								if($validatequantity[$rowcount][0]!=''||$validmaterialtype[$rowcount][0]!=''||$validthickness[$rowcount][0]!=''||$validsize[$rowcount][0]!=''||$validshape[$rowcount][0]!=''||$validcolor[$rowcount][0]!=''||$validatetextsize[$rowcount][0]!=''||$validtextmaxline[$rowcount]!=''||$validtextmaxchar[$rowcount]!=''||$validfilledarea[$rowcount]!=''||$validateproduct[$rowcount]!='')

								{
									echo 'row'.($rowcount-2).$validatequantity[$rowcount][0].' '.$validmaterialtype[$rowcount][0].' '.$validthickness[$rowcount][0].' '.$validsize[$rowcount][0].' '.$validshape[$rowcount][0].' '.$validcolor[$rowcount][0].' '.$validatetextsize[$rowcount][0].' '.$validtextmaxline[$rowcount].' '.$validtextmaxchar[$rowcount].' '.$validfilledarea[$rowcount].' '.$validateproduct[$rowcount].'<br/>';
									if($thereiserror!='Y')
										$thereiserror='Y';
								}
								else
								{
									$csvdata[quantity][$rowcount]=$validatequantity[$rowcount][1];
									$csvdata[productno][$rowcount]=$validmaterialtype[$rowcount][2];
									$csvdata[size][$rowcount]=$validsize[$rowcount][1];
									$csvdata[sku_code][$rowcount]=$validshape[$rowcount][2];//sku_code
									$csvdata[color][$rowcount]=$validcolor[$rowcount][1];
									$csvdata[textsize][$rowcount]=$validatetextsize[$rowcount][1];
								}									
								$rowcount++;
							}
							if($csvcomment!=''&&strlen($csvcomment)>255)
							{
								echo 'Comment is over 255 the max allowed characters';
								if($thereiserror!='Y')
									$thereiserror='Y';
							}								
							if($thereiserror=='N')
							{	
								for($l=3;$l<$count;$l++)
								{
									$product=$this->APcheckfromproductinsertNameplate($csvdata[productno][$l]);
									$skucode=$this->APcheckdescriptiontableCsvupload($csvdata[sku_code][$l]);
									$quantitytype=$this->Nameplategetpricedetailsfrommaterial($skucode[material_code]);
									$quantitycount=count($quantitytype);
									$i=0;
									if($quantitycount>0)
									{
										foreach($quantitytype as $key => $quantitytype_data)
										{	
											$quantitygroup[$i]=$quantitytype_data['quantity'];
											$pricegroup[$i]=$quantitytype_data['price'];
											$i++;
										}	
									}
									$addquantity=$csvdata[quantity][$l];
									//$addquantity is the current total of the existing shopping cart of the product with the same material code
									$k=0;
									while($k<$quantitycount)
									{
										if($addquantity>=$quantitygroup[$k]&&$addquantity<$quantitygroup[$k+1])
										{
											break;
										}
										$k++;
									}
									if($k==$quantitycount)	
										$k=$k-1;	
									$quantity=$quantitygroup[$k];
									
									if($_SESSION[user_type]=='R')
									{
										$currentprice=$pricegroup[$k]*(100-$_SESSION['discount_data'])/100;
										$last_price=$pricegroup[$k];
									}
									else
									{
										$currentprice=$pricegroup[$k];
										$last_price=$pricegroup[0];
									}
									$price=$this->APgetinfofromprice($skucode[material_code],$quantity);
									if($price[min_quantity_below]&&($csvdata[quantity][$l]<$price[min_quantity_below]))
									{
										$last_total=$last_price*$csvdata[quantity][$l]+$price[min_quantity_charge]+$skucode[additional_charge];									
										$totalprice=$price[price]*$csvdata[quantity][$l]+$price[min_quantity_charge]+$skucode[additional_charge];									
									}
									else
									{
										$last_total=$last_price*$csvdata[quantity][$l]+$skucode[additional_charge];									
										$totalprice=$price[price]*$csvdata[quantity][$l]+$skucode[additional_charge];
									}								
									if($csvdata[textsize][$l]=='copy to fit')
										$makefit='Y';
									else
										$makefit='N';
									$this->APinsert_custom_nameplate_product_csv($product,$skucode,$price,$last_price,$totalprice,$last_total,$csvdata[quantity][$l],$csvdata[color][$l],'',$makefit,'',$csvdata[textcontent][$l],$csvdata[textposition][$l],$csvdata[textsize][$l],$csvcomment);									
								}
								if($csvcomment!='')
									$this->APInsertCsvComment($csvcomment,$filename);							
							}
							else
								unlink($uploadFilePath);					
						}						
						break;
					}
					case 9://Nameplate
					{				
						$filetype=$_FILES["importcsvfile"]["type"];	
						$filename=$_FILES['importcsvfile']['name'];
						$csvcomment=$_REQUEST['csv_comment'];
						$uploadFilePath=PathTemplatesShoppingCart.'importcsv/'.$filename;		
						if($filename=='')
							print 'Please upload a file.';
						else if($filetype!='application/vnd.ms-excel'&&$filetype!='text/csv')
							print 'Only csv file is allowed';					
						else
						{
							if (file_exists($uploadFilePath))
							{
							   $purefilename=substr($filename,0,-$typelength);
							   $random_digit=rand(0000,9999);
							   $filename=$purefilename.$random_digit.date('Ynjhis').".".'csv';
							   $uploadFilePath=PathTemplatesShoppingCart.'importcsv/'.$filename;
							}
							copy($_FILES['importcsvfile']['tmp_name'], $uploadFilePath);
							$file = fopen($uploadFilePath,"r");
							$count=0;
							$thereiserror='N';
							while(!feof($file))
							{

								$field = fgetcsv($file, 1024,",");
								if($field!=FALSE&&$count>2)
								{
									if(!is_numeric($field[0]))
										$validatequantity[$count][0]=' Quantity is not valid.';	
									else
									{
										$qtyconverttoint = (int)($field[0]);
										if($qtyconverttoint<1||(string)$qtyconverttoint!=$field[0])
											$validatequantity[$count][0]=' Quantity is not valid.';
										else
											$validatequantity[$count][0]='';
									}		
									$validmaterialtype[$count]=$this->APcsvvalidateMaterialtypeDescription($field[1]);
									if($validmaterialtype[$count][0]=='')
									{
										if($validmaterialtype[$count][2]!='Engraved Phenolic NP'&&$validmaterialtype[$count][2]!='Engraved Plastic NP'&&$validmaterialtype[$count][2]!='Engraved Aluminum NP')
										{
											$validateproduct[$count]="The product is not 'Nameplate'";	
										}
										else
										{
											$field[2]=str_replace("'","",$field[2]);										
											$validthickness[$count]=$this->APcsvvalidateThickness($field[1],$field[2]);
											$size=str_replace("'","",$field[3]);
											$size=str_replace(" ","",$field[3]);	
											if(strpos($size,'x'))
											{
												$size_separate=split("x",$size);
												$width=$size_separate[0];
												$height=$size_separate[1];
												$width=$width.'"';
												$height=$height.'"';
												$size=$width.' x '.$height;
												$validsize[$count]=$this->APcsvvalidateSize($field[1],$size);//to be check   material and size will be able to determine material_code
											}
											else
												$validsize[$count][0]='Size is not valid';
											$field[6]=strtolower($field[6]);	
											$validtextalignment[$count]=$this->APcsvvalidateTextalignment($field[6]);	
											$field[4]=str_replace(' ','',$field[4]);//remove space
											$validcolor[$count]=$this->APcsvvalidateColor($validmaterialtype[$count][2],$field[4]);												

											if($validsize[$count][0]=='')
											{

												$validmountingoption[$count]=$this->APcsvvalidateMountingoption($field[1],$field[2],$size,$field[5]);
												if($validatequantity[$count][0]=='')
													$validatequantity[$count]=$this->APValidateGetMinimunQuantity($validsize[2],$qtyconverttoint);												
												$field[7]=strtolower($field[7]);
												if($field[7]!='copy to fit')
												{
													$field[7]=str_replace(" ","",$field[7]);    
													$field[7]=str_replace("'","",$field[7]);      
												}												
												$validtextsize[$count]=$this->APcsvvalidateTextsize($validsize[$count][3],$field[7]);//sku_code	
												$maxline[$count]=$validtextsize[$count][2];	
												$maxchar_upper[$count]=$validtextsize[$count][3];
												$maxchar_mixed[$count]=$validtextsize[$count][4];
												for($c=0;$c<9;$c++)
												{	
													$commacount[$count][$c]=substr_count($field[$c+8], ",");							
												}	
											}
										}
									}
								}
								$count++;
							}
							fclose($file);
							
							$arrLines = file($uploadFilePath);
							$rowcount=3;
							$thereiserror='N';
							while($arrLines[$rowcount])
							{
								$textfield = array();							
								$textfield= explode( ',', $arrLines[$rowcount]);
								$fieldcount=count($textfield);
								$textfield[$fieldcount-1]=substr($textfield[$fieldcount-1],0,-2);
								if($validtextsize[$rowcount][0]==''&&$validateproduct[$rowcount]==''&&$validmaterialtype[$rowcount][0]==''&&$validsize[$rowcount][0]=='')//make sure text size is valid first
								{
									for($columnline=0;$columnline<9;$columnline++)
									{
										 $index=8+$columnline+$commacount[$rowcount][$columnline-1]+$commacount[$rowcount][$columnline-2]+$commacount[$rowcount][$columnline-3]+$commacount[$rowcount][$columnline-4]+$commacount[$rowcount][$columnline-5]+$commacount[$rowcount][$columnline-6]+$commacount[$rowcount][$columnline-7]+$commacount[$rowcount][$columnline-8];
										 if($commacount[$rowcount][$columnline]==0)
										 {
											if(substr($textfield[$index],0,1)=='"'&&substr($textfield[$index],-1,1)=='"')
											{
												$textfield[$index]=substr($textfield[$index],1);
												$textfield[$index]=substr($textfield[$index],0,-1);
											}											
											$text_line[$columnline]=str_replace('""','"',$textfield[$index]);
										 }
										 else
										 {										 
											$textfield[$index]=substr($textfield[$index],1);	
											$text_initialcontent=str_replace('""','"',$textfield[$index]);																			
											$text_content="";
											for($c=($index+1);$c<=($index+$commacount[$rowcount][$columnline]);$c++)
											{	
												if($c==($index+$commacount[$rowcount][$columnline]))
												{
													$textfield[$c]=substr($textfield[$c],0,-1);//remove "
												}												
												$fieldcontent=str_replace('""','"',$textfield[$c]);
												$text_content=$text_content.",".$fieldcontent;
											}
											$text_line[$columnline]=$text_initialcontent.$text_content;	
										}
									}
									$addcolumn=0;										
									if($text_line[$addcolumn]=='')
									{
										$validfilledarea[$rowcount]='Line1 should not be empty';
									}
									else
									{
										$chracternumber=strlen($text_line[$addcolumn]);												
										if($maxchar_upper[$rowcount]<$chracternumber)
										{
											$validtextmaxchar[$rowcount]="Line1's characters are over ".$maxchar_upper[$rowcount]." ,the max allowed characters.";
										}
										else
										{
											$csvdata[textcontent][$rowcount][$addcolumn]=$text_line[$addcolumn];
											$csvdata[textposition][$rowcount][$addcolumn]=1;
											$csvdata[textsize][$rowcount][$addcolumn]=$validatetextsize[$rowcount][1];
										}											
									}
									if($validtextsize[$rowcount][1]=='copy to fit')
									{
										$textconlumn=0;
										for($addcolumn=1;$addcolumn<9;$addcolumn++)
										{
											if($maxline[$rowcount]<($addcolumn+1)&&$text_line[$addcolumn]!='')
											{
												$validtextmaxline[$rowcount]='Text lines are over '.$maxline[$rowcount].', the maximum allowed lines.';
											}
											if($text_line[$addcolumn]!='')
											{
												$textconlumn=$textconlumn+1;//treat empty as nothing for copy to fit (just skip it)
												$chracternumber=strlen($text_line[$addcolumn]);			
												if($maxchar_upper[$rowcount]<$chracternumber)
												{
													$validtextmaxchar[$rowcount].="Line".($addcolumn+1)."'s characters are over ".$maxchar_upper[$rowcount]." ,the max allowed characters.";
												}
												else
												{
													$csvdata[textcontent][$rowcount][$textconlumn]=$text_line[$addcolumn];
													$csvdata[textposition][$rowcount][$textconlumn]=$textconlumn+1;
													$csvdata[textsize][$rowcount][$textconlumn]=$validatetextsize[$rowcount][1];

												}
											}
										}	
									}
									else
									{
										$r=0;
										for($p=8;$p>0;$p--)
										{
											if($text_line[$p]!='')
											{ 
												break;
											}
											else
											{
												$r++;
											}
										}
										if($maxline[$rowcount]<(9-$r))
										{
											$validtextmaxline[$rowcount]='Text lines are over '.$maxline[$rowcount].', the maximum allowed lines.';
										}										
										for($addcolumn=1;$addcolumn<(9-$r);$addcolumn++)
										{
											$chracternumber=strlen($text_line[$addcolumn]);			
											if($maxchar_upper[$rowcount]<$chracternumber)
											{
												$validtextmaxchar[$rowcount].="Line".($addcolumn+1)."'s characters are over ".$maxchar_upper[$rowcount]." ,the max allowed characters.";
											}
											else
											{
												$csvdata[textcontent][$rowcount][$addcolumn]=$text_line[$addcolumn];
												$csvdata[textposition][$rowcount][$addcolumn]=$addcolumn+1;
												$csvdata[textsize][$rowcount][$addcolumn]=$validatetextsize[$rowcount][1].'"';														
											}										
										}											
									}
								}
								if($validatequantity[$rowcount][0]!=''||$validmaterialtype[$rowcount][0]!=''||$validthickness[$rowcount][0]!=''||$validsize[$rowcount][0]!=''||$validcolor[$rowcount][0]!=''||$validmountingoption[$rowcount][0]!=''||$validtextsize[$rowcount][0]!=''||$validtextalignment[$rowcount][0]!=''||$validtextmaxline[$rowcount]!=''||$validtextmaxchar[$rowcount]!=''||$validateproduct[$rowcount]!='')
								{
									echo 'row'.($rowcount-2).$validatequantity[$rowcount][0].' '.$validmaterialtype[$rowcount][0].' '.$validthickness[$rowcount][0].' '.$validsize[$rowcount][0].' '.$validcolor[$rowcount][0].' '.$validmountingoption[$rowcount][0].' '.$validtextsize[$rowcount][0].' '.$validtextalignment[$rowcount][0].' '.$validtextmaxline[$rowcount].' '.$validtextmaxchar[$rowcount].' '.$validateproduct[$rowcount].'<br/>';
									if($thereiserror!='Y')
										$thereiserror='Y';
								}
								else
								{
									$csvdata[quantity][$rowcount]=$validatequantity[$rowcount][1];
									$csvdata[productno][$rowcount]=$validmaterialtype[$rowcount][2];
									$csvdata[size][$rowcount]=$validsize[$rowcount][1];
									$csvdata[sku_code][$rowcount]=$validsize[$rowcount][3];//sku_code
									$csvdata[color][$rowcount]=$validcolor[$rowcount][1];
									$csvdata[mountingoption][$rowcount]=$validmountingoption[$rowcount][1];
									$csvdata[textsize][$rowcount]=$validtextsize[$rowcount][1];
									$csvdata[textalignment][$rowcount]=$validtextalignment[$rowcount][1];
								}									
								$rowcount++;
							}
							if($csvcomment!=''&&strlen($csvcomment)>255)
							{
								echo 'Comment is over 255 the max allowed characters';
								if($thereiserror!='Y')
									$thereiserror='Y';
							}								
							if($thereiserror=='N')
							{	
								for($l=3;$l<$count;$l++)
								{
									$product=$this->APcheckfromproductinsertNameplate($csvdata[productno][$l]);
									$skucode=$this->APcheckdescriptiontableCsvupload($csvdata[sku_code][$l]);
									$quantitytype=$this->Nameplategetpricedetailsfrommaterial($skucode[material_code]);
									$quantitycount=count($quantitytype);
									$i=0;
									if($quantitycount>0)
									{
										foreach($quantitytype as $key => $quantitytype_data)
										{	
											$quantitygroup[$i]=$quantitytype_data['quantity'];
											$pricegroup[$i]=$quantitytype_data['price'];
											$i++;
										}	
									}
									$addquantity=$csvdata[quantity][$l];
									//$addquantity is the current total of the existing shopping cart of the product with the same material code
									$k=0;
									while($k<$quantitycount)
									{
										if($addquantity>=$quantitygroup[$k]&&$addquantity<$quantitygroup[$k+1])
										{
											break;
										}
										$k++;
									}
									if($k==$quantitycount)	
										$k=$k-1;	
									$quantity=$quantitygroup[$k];
									
									if($_SESSION[user_type]=='R')
									{
										$currentprice=$pricegroup[$k]*(100-$_SESSION['discount_data'])/100;
										$last_price=$pricegroup[$k];
									}
									else
									{
										$currentprice=$pricegroup[$k];
										$last_price=$pricegroup[0];
									}
									$price=$this->APgetinfofromprice($skucode[material_code],$quantity);
									if($price[min_quantity_below]&&($csvdata[quantity][$l]<$price[min_quantity_below]))
									{
										$last_total=$last_price*$csvdata[quantity][$l]+$price[min_quantity_charge]+$skucode[additional_charge];									
										$totalprice=$price[price]*$csvdata[quantity][$l]+$price[min_quantity_charge]+$skucode[additional_charge];									
									}
									else
									{
										$last_total=$last_price*$csvdata[quantity][$l]+$skucode[additional_charge];									
										$totalprice=$price[price]*$csvdata[quantity][$l]+$skucode[additional_charge];
									}								
									if($csvdata[textsize][$l]=='copy to fit')
										$makefit='Y';
									else
										$makefit='N';							
									/*$Gettemplatesize=$this->APcountTempltaeSize($csvdata[size][$l]);
									$color_sepa=split('/',$csvdata[color][$l]);
									$colorcode_background=$this->APCreateImgGetColorCode($color_sepa[0]);
									$colorcode_text=$this->APCreateImgGetColorCode($color_sepa[1]);
									$im = imagecreate($Gettemplatesize[0], $Gettemplatesize[1]);
									$background_color = imagecolorallocate( $im, $colorcode_background[0], $colorcode_background[1], $colorcode_background[2] );
									$text_color = imagecolorallocate($im, $colorcode_text[0], $colorcode_text[1], $colorcode_text[2]);//red
									for($t=0;$t<count($csvdata[textcontent][$l]);$t++)
									{
										imagestring($im, 3, 5, 5+$t*10,  $csvdata[textcontent][$l][$t], $text_color);
									}
									imagecolordeallocate($background_color);
									$imageindex=$l-3;
									//$imagepath=PathImgCustomProductsmall.$filename.$l.'.jpg';
									//$imagepath=PathImgCustomProductsmall.'nameplate'.$imageindex.'.jpg';
									
									$imagepath='simpletext'.$imageindex.'.jpg';
									imagejpeg($im, $imagepath);*/
									$this->APinsert_custom_nameplate_product_csv($product,$skucode,$price,$last_price,$totalprice,$last_total,$csvdata[quantity][$l],$csvdata[color][$l],$csvdata[mountingoption][$l],$makefit,$csvdata[textalignment][$l],$csvdata[textcontent][$l],$csvdata[textposition][$l],$csvdata[textsize][$l],$csvcomment);							
	
								}
								if($csvcomment!='')
									$this->APInsertCsvComment($csvcomment,$filename);					
							}
							else
								unlink($uploadFilePath);					
						}						
						break;
					}
					case 10://Custom Duct Markers
					{
						$filetype=$_FILES["importcsvfile"]["type"];	
						$filename=$_FILES['importcsvfile']['name'];
						$uploadFilePath=PathTemplatesShoppingCart.'importcsv/'.$filename;
						$csvcomment=$_REQUEST['csv_comment'];
						if($filename=='')
							print 'Please upload a file.';
						else if($filetype!='application/vnd.ms-excel'&&$filetype!='text/csv')
							print 'Only csv file is allowed';
						else
						{
							if (file_exists($uploadFilePath))
							{
							   $purefilename=substr($filename,0,-$typelength);
							   $random_digit=rand(0000,9999);
							   $filename=$purefilename.$random_digit.date('Ynjhis').".".'csv';
							   $uploadFilePath=PathTemplatesShoppingCart.'importcsv/'.$filename;
							}
							copy($_FILES['importcsvfile']['tmp_name'], $uploadFilePath);
							$arrLines = file($uploadFilePath);
							$count=3;
							$thereiserror='N';
							while($arrLines[$count])
							{
								$field = array();							
								$field= explode( ',', $arrLines[$count]);
								if(!is_numeric($field[0]))
									$validatequantity[0]=' Quantity is not valid.';	
								else
								{
									$qtyconverttoint = (int)($field[0]);
									if($qtyconverttoint<1||(string)$qtyconverttoint!=$field[0])
										$validatequantity[0]=' Quantity is not valid.';
									else
										$validatequantity[0]='';
								}
								if(substr($field[1],0,1)=='"'&&substr($field[1],-1,1)=='"')
								{
									$field[1]=substr($field[1],1);
									$field[1]=substr($field[1],0,-1);
								}	
								$field[1]=str_replace('""','"',$field[1]);
								$validcolor[0]='';
								$validtextchara='';
								$validmaterialtype=$this->APcsvvalidateMaterialtypeDescription($field[1]);
								if($validmaterialtype[0]=='')
								{
									if($validmaterialtype[2]!='Custom Duct Markers')
									{
										$validateproduct="The product is not 'Custom Duct Markers'";	
									}
									else
									{
										$validateproduct='';
										if($validatequantity[0]=='')
											$validatequantity=$this->APValidateGetMinimunQuantity($validmaterialtype[5],$qtyconverttoint);
										$validcolor=$this->APcsvvalidateColor($validmaterialtype[2],$field[2]);
										$fieldcount=count($field);
										$text_content="";
										if($fieldcount==4)
										{
											$field[3]=substr($field[3],0,-2);
											if(substr($field[3],0,1)=='"'&&substr($field[3],-1,1)=='"')
											{
												$field[3]=substr($field[3],1);
												$field[3]=substr($field[3],0,-1);
											}											
											$text_content=str_replace('""','"',$field[3]);								
										}
										else if($fieldcount>4)
										{	
											$field[3]=substr($field[3],1);	
											$text_initialcontent=str_replace('""','"',$field[3]);
											
											for($c=4;$c<$fieldcount;$c++)
											{	
												if($c==($fieldcount-1))

												{
													$field[$c]=substr($field[$c],0,-3);//remove \r and "
												}
												$fieldcontent=str_replace('""','"',$field[$c]);		
												$text_content=$text_content.",".$fieldcontent;
											}
											$text_content=$text_initialcontent.$text_content;
										}									
										$max_result=$this->APcsvvalidateMaxCharNormal($validmaterialtype[1]);
										if(strlen($text_content)>$max_result[max_chars_upper])
										{
											$validtextchara='Text content is over the maximum '.$max_result[max_chars_upper].' allowed characters';
										}
										else
										{
											$validtextchara='';											
										}	
									}
								}
								if($validatequantity[0]!=''||$validmaterialtype[0]!=''||$validcolor[0]!=''||$validtextchara!=''||$validateproduct!='')
								{
									echo 'row'.($count-2).$validatequantity[0].' '.$validmaterialtype[0].' '.$validcolor[0].' '.$validtextchara.' '.$validateproduct.'<br/>';
									if($thereiserror!='Y')
										$thereiserror='Y';
								}
								else
								{
									$csvdata[quantity][$count]=$validatequantity[1];
									$csvdata[productno][$count]=$validmaterialtype[2];
									$csvdata[color][$count]=$validcolor[1];
									$csvdata[skucode][$count]=$validmaterialtype[1];
									$csvdata[textcontent][$count][0]=$text_content;
									//$csvdata[textsize][$count]=$max_result[text_size];
								}
								$count++;
							}
							if($csvcomment!=''&&strlen($csvcomment)>255)
							{
								echo 'Comment is over 255 the max allowed characters';
								if($thereiserror!='Y')
									$thereiserror='Y';
							}								
							if($thereiserror=='N')
							{	
								for($l=3;$l<$count;$l++)
								{
									$product=$this->APcheckfromproductinsertNameplate($csvdata[productno][$l]);
									$skucode=$this->APcheckdescriptiontable($csvdata[skucode][$l]);
									$quantitytype=$this->Nameplategetpricedetailsfrommaterial($skucode[material_code]);
									$quantitycount=count($quantitytype);
									$i=0;
									if($quantitycount>0)
									{
										foreach($quantitytype as $key => $quantitytype_data)
										{	
											$quantitygroup[$i]=$quantitytype_data['quantity'];
											$pricegroup[$i]=$quantitytype_data['price'];
											$i++;
										}	
									}
									$addquantity=$csvdata[quantity][$l];
									//$addquantity is the current total of the existing shopping cart of the product with the same material code
									$k=0;
									while($k<$quantitycount)
									{
										if($addquantity>=$quantitygroup[$k]&&$addquantity<$quantitygroup[$k+1])
										{
											break;
										}
										$k++;
									}
									if($k==$quantitycount)	
										$k=$k-1;	
									$quantity=$quantitygroup[$k];
									
									if($_SESSION[user_type]=='R')
									{
										$currentprice=$pricegroup[$k]*(100-$_SESSION['discount_data'])/100;
										$last_price=$pricegroup[$k];
									}
									else
									{
										$currentprice=$pricegroup[$k];
										$last_price=$pricegroup[0];
									}
									$price=$this->APgetinfofromprice($skucode[material_code],$quantity);
									if($price[min_quantity_below]&&($csvdata[quantity][$l]<$price[min_quantity_below]))
									{

										$last_total=$last_price*$csvdata[quantity][$l]+$price[min_quantity_charge]+$skucode[additional_charge];									
										$totalprice=$price[price]*$csvdata[quantity][$l]+$price[min_quantity_charge]+$skucode[additional_charge];									
									}
									else
									{
										$last_total=$last_price*$csvdata[quantity][$l]+$skucode[additional_charge];									
										$totalprice=$price[price]*$csvdata[quantity][$l]+$skucode[additional_charge];
									}
									$this->APinsert_custom_nameplate_product_csv($product,$skucode,$price,$last_price,$totalprice,$last_total,$csvdata[quantity][$l],$csvdata[color][$l],'','','',$csvdata[textcontent][$l],'','',$csvcomment);							
									
								}
								if($csvcomment!='')
									$this->APInsertCsvComment($csvcomment,$filename);
							}
							else
								unlink($uploadFilePath);							
						}							
						break;
					}
					case 11://Custom System 4-1
					{
						$filetype=$_FILES["importcsvfile"]["type"];	
						$filename=$_FILES['importcsvfile']['name'];
						$uploadFilePath=PathTemplatesShoppingCart.'importcsv/'.$filename;
						$csvcomment=$_REQUEST['csv_comment'];
						if($filename=='')
							print 'Please upload a file.';
						else if($filetype!='application/vnd.ms-excel'&&$filetype!='text/csv')
							print 'Only csv file is allowed';					
						else
						{
							if (file_exists($uploadFilePath))
							{
							   $purefilename=substr($filename,0,-$typelength);
							   $random_digit=rand(0000,9999);
							   $filename=$purefilename.$random_digit.date('Ynjhis').".".'csv';
							   $uploadFilePath=PathTemplatesShoppingCart.'importcsv/'.$filename;
							}
							copy($_FILES['importcsvfile']['tmp_name'], $uploadFilePath);
							$arrLines = file($uploadFilePath);
							$count=3;
							$thereiserror='N';
							while($arrLines[$count])

							{
								$field = array();							
								$field= explode( ',', $arrLines[$count]);
								if(!is_numeric($field[0]))
									$validatequantity[0]=' Quantity is not valid.';	
								else
								{
									$qtyconverttoint = (int)($field[0]);
									if($qtyconverttoint<1||(string)$qtyconverttoint!=$field[0])
										$validatequantity[0]=' Quantity is not valid.';
									else
										$validatequantity[0]='';
								}
								if(substr($field[1],0,1)=='"'&&substr($field[1],-1,1)=='"')
								{
									$field[1]=substr($field[1],1);
									$field[1]=substr($field[1],0,-1);
								}	
								$field[1]=str_replace('""','"',$field[1]);
								$validband[0]='';
								$validtextchara='';
								$validmaterialtype=$this->APcsvvalidateMaterialtypeDescription($field[1]);
								if($validmaterialtype[0]=='')
								{
									if($validmaterialtype[2]!='Custom System 4-1')
									{
										$validateproduct="The product is not 'Custom Ammonia SYS 4'";	
									}
									else
									{
										$validateproduct='';
										if($validatequantity[0]=='')
											$validatequantity=$this->APValidateGetMinimunQuantity($validmaterialtype[5],$qtyconverttoint);									
										if(strpos($field[2],'/'))
											$field[2]=str_replace(" ", "", $field[2]);
										$validband=$this->APcsvvalidateColor($validmaterialtype[2],$field[2]);//product number
										if($validband[0]!='')
											$validband[0]='Band is not valid';
										$fieldcount=count($field);
										$text_content="";									
										if($fieldcount==4)
										{
											$field[3]=substr($field[3],0,-2);
											if(substr($field[3],0,1)=='"'&&substr($field[3],-1,1)=='"')
											{
												$field[3]=substr($field[3],1);
												$field[3]=substr($field[3],0,-1);
											}											
											$text_content=str_replace('""','"',$field[3]);								
										}
										else if($fieldcount>4)
										{	
											$field[3]=substr($field[3],1);	
											$text_initialcontent=str_replace('""','"',$field[3]);
											
											for($c=4;$c<$fieldcount;$c++)
											{	

												if($c==($fieldcount-1))
												{
													$field[$c]=substr($field[$c],0,-3);//remove \r and "
												}
												$fieldcontent=str_replace('""','"',$field[$c]);		
												$text_content=$text_content.",".$fieldcontent;
											}
											$text_content=$text_initialcontent.$text_content;
										}
										$max_result=$this->APcsvvalidateMaxCharNormal($validmaterialtype[1]);
										if(strlen($text_content)>$max_result[max_chars_upper])
										{
											$validtextchara='Abbreviation is over the maximum '.$max_result[max_chars_upper].' allowed characters';
										}
										else
										{
											$validtextchara='';											
										}										
									}
								}
								if($validatequantity[0]!=''||$validmaterialtype[0]!=''||$validband[0]!=''||$validtextchara!=''||$validateproduct!='')
								{
									echo 'row'.($count-2).$validatequantity[0].' '.$validmaterialtype[0].' '.$validband[0].' '.$validtextchara.' '.$validateproduct.'<br/>';
									if($thereiserror!='Y')
										$thereiserror='Y';
								}
								else
								{
									$csvdata[quantity][$count]=$validatequantity[1];
									$csvdata[productno][$count]=$validmaterialtype[2];
									$csvdata[band][$count]=$validband[1];
									$csvdata[skucode][$count]=$validmaterialtype[1];
									$csvdata[textcontent][$count][0]=$text_content;
									//$csvdata[textsize][$count]=$max_result[text_size];
								}										
								$count++;
							}
							if($csvcomment!=''&&strlen($csvcomment)>255)
							{
								echo 'Comment is over 255 the max allowed characters';
								if($thereiserror!='Y')
									$thereiserror='Y';
							}									
							if($thereiserror=='N')
							{	
								for($l=3;$l<$count;$l++)
								{
									$product=$this->APcheckfromproductinsertNameplate($csvdata[productno][$l]);
									$skucode=$this->APcheckdescriptiontable($csvdata[skucode][$l]);
									$quantitytype=$this->Nameplategetpricedetailsfrommaterial($skucode[material_code]);
									$quantitycount=count($quantitytype);
									$i=0;
									if($quantitycount>0)
									{
										foreach($quantitytype as $key => $quantitytype_data)
										{	
											$quantitygroup[$i]=$quantitytype_data['quantity'];
											$pricegroup[$i]=$quantitytype_data['price'];
											$i++;
										}	
									}
									$addquantity=$csvdata[quantity][$l];
									//$addquantity is the current total of the existing shopping cart of the product with the same material code
	
									$k=0;
									while($k<$quantitycount)
									{
										if($addquantity>=$quantitygroup[$k]&&$addquantity<$quantitygroup[$k+1])
										{
											break;
										}
										$k++;
									}
									if($k==$quantitycount)	
										$k=$k-1;	
									$quantity=$quantitygroup[$k];
									
									if($_SESSION[user_type]=='R')
									{
										$currentprice=$pricegroup[$k]*(100-$_SESSION['discount_data'])/100;
										$last_price=$pricegroup[$k];
									}
									else
									{
										$currentprice=$pricegroup[$k];
										$last_price=$pricegroup[0];
									}
									$price=$this->APgetinfofromprice($skucode[material_code],$quantity);
									if($price[min_quantity_below]&&($csvdata[quantity][$l]<$price[min_quantity_below]))
									{
										$last_total=$last_price*$csvdata[quantity][$l]+$price[min_quantity_charge]+$skucode[additional_charge];									
										$totalprice=$price[price]*$csvdata[quantity][$l]+$price[min_quantity_charge]+$skucode[additional_charge];									
									}
									else
									{
										$last_total=$last_price*$csvdata[quantity][$l]+$skucode[additional_charge];									
										$totalprice=$price[price]*$csvdata[quantity][$l]+$skucode[additional_charge];
									}						
									$this->APinsert_custom_ammonia_product_csv($product,$skucode,$price,$last_price,$totalprice,$last_total,$csvdata[quantity][$l],'','','',$csvdata[band][$l],$csvdata[textcontent][$l],'','',$csvcomment);//make to fit set to N for shoppingcart.php summary show amoonia band details heading							
									
								}
								if($csvcomment!='')
									$this->APInsertCsvComment($csvcomment,$filename);							
							}
							else
								unlink($uploadFilePath);							
						}						
						break;
					}
					case 12://Custom EZ Ammonia
					{
						$filetype=$_FILES["importcsvfile"]["type"];	
						$filename=$_FILES['importcsvfile']['name'];
						$uploadFilePath=PathTemplatesShoppingCart.'importcsv/'.$filename;
						$csvcomment=$_REQUEST['csv_comment'];
						if($filename=='')
							print 'Please upload a file.';
						else if($filetype!='application/vnd.ms-excel'&&$filetype!='text/csv')
							print 'Only csv file is allowed';					
						else
						{
							if (file_exists($uploadFilePath))
							{
							   $purefilename=substr($filename,0,-$typelength);
							   $random_digit=rand(0000,9999);
							   $filename=$purefilename.$random_digit.date('Ynjhis').".".'csv';
							   $uploadFilePath=PathTemplatesShoppingCart.'importcsv/'.$filename;
							}
							copy($_FILES['importcsvfile']['tmp_name'], $uploadFilePath);
							$arrLines = file($uploadFilePath);
							$count=3;
							$thereiserror='N';
							while($arrLines[$count])
							{
								$field = array();							
								$field= explode( ',',$arrLines[$count]);
								if(!is_numeric($field[0]))
									$validatequantity[0]=' Quantity is not valid.';	
								else
								{
									$qtyconverttoint = (int)($field[0]);
									if($qtyconverttoint<1||(string)$qtyconverttoint!=$field[0])
										$validatequantity[0]=' Quantity is not valid.';
									else
										$validatequantity[0]='';
								}
								if(substr($field[1],0,1)=='"'&&substr($field[1],-1,1)=='"')
								{
									$field[1]=substr($field[1],1);
									$field[1]=substr($field[1],0,-1);
								}	
								$field[1]=str_replace('""','"',$field[1]);		
								$validband[0]='';
								$validtextchara='';
								$validmaterialtype=$this->APcsvvalidateMaterialtypeDescription($field[1]);
								if($validmaterialtype[0]=='')
								{
									if($validmaterialtype[2]!='Custom EZ Ammonia')
									{
										$validateproduct="The product is not 'Custom EZ Ammonia'";	
									}
									else
									{
										$validateproduct='';

										if($validatequantity[0]=='')
											$validatequantity=$this->APValidateGetMinimunQuantity($validmaterialtype[5],$qtyconverttoint);									
										if(strpos($field[2],'/'))
											$field[2]=str_replace(" ", "", $field[2]);
										$validband=$this->APcsvvalidateColor($validmaterialtype[2],$field[2]);//product number
										if($validband[0]!='')
											$validband[0]='Band is not valid';
										$fieldcount=count($field);
										$text_content="";									
										if($fieldcount==4)
										{
											$field[3]=substr($field[3],0,-2);
											if(substr($field[3],0,1)=='"'&&substr($field[3],-1,1)=='"')
											{
												$field[3]=substr($field[3],1);
												$field[3]=substr($field[3],0,-1);
											}											
											$text_content=str_replace('""','"',$field[3]);								
										}
										else if($fieldcount>4)
										{	
											$field[3]=substr($field[3],1);	
											$text_initialcontent=str_replace('""','"',$field[3]);
											
											for($c=4;$c<$fieldcount;$c++)
											{	
												if($c==($fieldcount-1))
												{
													$field[$c]=substr($field[$c],0,-3);//remove \r and "
												}
												$fieldcontent=str_replace('""','"',$field[$c]);		
												$text_content=$text_content.",".$fieldcontent;
											}
											$text_content=$text_initialcontent.$text_content;
										}										
										$max_result=$this->APcsvvalidateMaxCharNormal($validmaterialtype[1]);
										if(strlen($text_content)>$max_result[max_chars_upper])
										{
											$validtextchara='Abbreviation is over the maximum '.$max_result[max_chars_upper].' allowed characters';
										}
										else
										{
											$validtextchara='';											
										}	
									}
								}
								if($validatequantity[0]!=''||$validmaterialtype[0]!=''||$validband[0]!=''||$validtextchara!=''||$validateproduct!='')
								{
									echo 'row'.($count-2).$validatequantity[0].' '.$validmaterialtype[0].' '.$validband[0].' '.$validtextchara.' '.$validateproduct.'<br/>';
									if($thereiserror!='Y')
										$thereiserror='Y';
								}
								else
								{
									$csvdata[quantity][$count]=$field[0];
									$csvdata[productno][$count]=$validmaterialtype[2];
									$csvdata[band][$count]=$validband[1];
									$csvdata[skucode][$count]=$validmaterialtype[1];
									$csvdata[textcontent][$count][0]=$text_content;
									//$csvdata[textsize][$count]=$max_result[text_size];
								}																			
								$count++;						
							}
							if($csvcomment!=''&&strlen($csvcomment)>255)
							{
								echo 'Comment is over 255 the max allowed characters';
								if($thereiserror!='Y')
									$thereiserror='Y';
							}								
							if($thereiserror=='N')
							{	
								for($l=3;$l<$count;$l++)
								{
									$product=$this->APcheckfromproductinsertNameplate($csvdata[productno][$l]);
									$skucode=$this->APcheckdescriptiontable($csvdata[skucode][$l]);
									$quantitytype=$this->Nameplategetpricedetailsfrommaterial($skucode[material_code]);
									$quantitycount=count($quantitytype);
									$i=0;
									if($quantitycount>0)
									{
										foreach($quantitytype as $key => $quantitytype_data)
										{	
											$quantitygroup[$i]=$quantitytype_data['quantity'];
											$pricegroup[$i]=$quantitytype_data['price'];
											$i++;
										}	
									}
									$addquantity=$csvdata[quantity][$l];
									//$addquantity is the current total of the existing shopping cart of the product with the same material code
	
									$k=0;
									while($k<$quantitycount)
									{
										if($addquantity>=$quantitygroup[$k]&&$addquantity<$quantitygroup[$k+1])
										{
											break;
										}
										$k++;
									}
								   
									if($k==$quantitycount)	
										$k=$k-1;	
									$quantity=$quantitygroup[$k];
									if($_SESSION[user_type]=='R')
									{
										$currentprice=$pricegroup[$k]*(100-$_SESSION['discount_data'])/100;
										$last_price=$pricegroup[$k];
									}
									else
									{
										$currentprice=$pricegroup[$k];
										$last_price=$pricegroup[0];
									}
									$price=$this->APgetinfofromprice($skucode[material_code],$quantity);
									if($price[min_quantity_below]&&($csvdata[quantity][$l]<$price[min_quantity_below]))
									{
										$last_total=$last_price*$csvdata[quantity][$l]+$price[min_quantity_charge]+$skucode[additional_charge];									
										$totalprice=$price[price]*$csvdata[quantity][$l]+$price[min_quantity_charge]+$skucode[additional_charge];									
									}
									else
									{
										$last_total=$last_price*$csvdata[quantity][$l]+$skucode[additional_charge];									
										$totalprice=$price[price]*$csvdata[quantity][$l]+$skucode[additional_charge];
									}						
									$this->APinsert_custom_ammonia_product_csv($product,$skucode,$price,$last_price,$totalprice,$last_total,$csvdata[quantity][$l],'','','',$csvdata[band][$l],$csvdata[textcontent][$l],'','',$csvcomment);//make to fit set to N for shoppingcart.php summary show amoonia band details heading								
									
								}
								if($csvcomment!='')
									$this->APInsertCsvComment($csvcomment,$filename);							
							}
							else
								unlink($uploadFilePath);							
						}						
						break;
					}
					case 13://Custom Stencils
					{
						$filetype=$_FILES["importcsvfile"]["type"];	
						$filename=$_FILES['importcsvfile']['name'];
						$uploadFilePath=PathTemplatesShoppingCart.'importcsv/'.$filename;
						$csvcomment=$_REQUEST['csv_comment'];
						if($filename=='')
							print 'Please upload a file.';
						else if($filetype!='application/vnd.ms-excel'&&$filetype!='text/csv')
							print 'Only csv file is allowed';					
						else
						{
							if (file_exists($uploadFilePath))
							{
							   $purefilename=substr($filename,0,-$typelength);
							   $random_digit=rand(0000,9999);
							   $filename=$purefilename.$random_digit.date('Ynjhis').".".'csv';
							   $uploadFilePath=PathTemplatesShoppingCart.'importcsv/'.$filename;
							}
							copy($_FILES['importcsvfile']['tmp_name'], $uploadFilePath);
							$arrLines = file($uploadFilePath);
							$count=3;
							$thereiserror='N';
							while($arrLines[$count])
							{
								$field = array();							
								$field= explode( ',',$arrLines[$count]);
								if(!is_numeric($field[0]))
									$validatequantity[0]=' Quantity is not valid.';	
								else
								{
									$qtyconverttoint = (int)($field[0]);
									if($qtyconverttoint<1||(string)$qtyconverttoint!=$field[0])
										$validatequantity[0]=' Quantity is not valid.';
									else
										$validatequantity[0]='';
								}
								if(substr($field[1],0,1)=='"'&&substr($field[1],-1,1)=='"')
								{
									$field[1]=substr($field[1],1);
									$field[1]=substr($field[1],0,-1);
								}
								$field[1]=str_replace('""','"',$field[1]);
								$validatesize[0]='';
								$validtextchara='';
								$validatearrow[0]='';
								$validmaterialtype=$this->APcsvvalidateMaterialtypeDescription($field[1]);
								if($validmaterialtype[0]=='')
								{
									if($validmaterialtype[2]!='Stencils')
									{
										$validateproduct="The product is not 'Stencils'";	
									}
									else
									{
										$validateproduct='';
										$field[2]=str_replace("''",'"',$field[2]);
										if(!strpos($field[2],'"'))
											$field[2]=$field[2].'"';//text size should be the same as database to prevent 2-1/2" this kind of case when using like%
										$validatesize=$this->APcsvvalidateTextSizeStencil($field[1],$field[2]);
										if($validatesize[0]=='')
										{
											if($validatequantity[0]=='')
												$validatequantity=$this->APValidateGetMinimunQuantity($validatesize[2],$qtyconverttoint);									
											$fieldcount=count($field);
											$arrow=substr($field[$fieldcount-1],0,-2);
											$validatearrow=$this->APcsvvalidatecolor($validmaterialtype[2],$arrow);
											if($validatearrow[0]!='')
												$validatearrow[0]='Arrow is not valid.';									
											$text_content="";									
											if($fieldcount==5)
											{
												if(substr($field[3],0,1)=='"'&&substr($field[3],-1,1)=='"')
												{
													$field[3]=substr($field[3],1);
													$field[3]=substr($field[3],0,-1);
												}											
												$text_content=str_replace('""','"',$field[3]);								
											}
											else if($fieldcount>5)
											{	
												$field[3]=substr($field[3],1);	
												$text_initialcontent=str_replace('""','"',$field[3]);								
												for($c=4;$c<($fieldcount-1);$c++)
												{	
													if($c==($fieldcount-2))
													{
														$field[$c]=substr($field[$c],0,-1);//remove "
													}
													$fieldcontent=str_replace('""','"',$field[$c]);		
													$text_content=$text_content.",".$fieldcontent;
												}
												$text_content=$text_initialcontent.$text_content;
											}
											$validtextchara=$this->APcsvvalidateTextMaxCharNormal($text_content);//'Characters are over the maximum 20.If you want legend longer than 20 characters, please contact customer service.';//to be check										
										}
									}
								}
								if($validatequantity[0]!=''||$validmaterialtype[0]!=''||$validatesize[0]!=''||$validtextchara!=''||$validatearrow[0]!=''||$validateproduct!='')
								{
									echo 'row'.($count-2).$validatequantity[0].' '.$validmaterialtype[0].' '.$validatesize[0].' '.$validtextchara.' '.$validatearrow[0].' '.$validateproduct.'<br/>';
									if($thereiserror!='Y')
										$thereiserror='Y';
								}
								else
								{
									$csvdata[quantity][$count]=$field[0];
									$csvdata[productno][$count]=$validmaterialtype[2];
									$csvdata[arrow][$count]=$validatearrow[1];
									$csvdata[skucode][$count]=$validatesize[1];
									$csvdata[textcontent][$count][0]=$text_content;
									$csvdata[textsize][$count]=$validatesize[3];//only one type of text size
								}																
								$count++;						
							}
							if($csvcomment!=''&&strlen($csvcomment)>255)
							{
								echo 'Comment is over 255 the max allowed characters';
								if($thereiserror!='Y')
									$thereiserror='Y';
							}									
							if($thereiserror=='N')
							{	
								for($l=3;$l<$count;$l++)
								{
									$product=$this->APcheckfromproductinsertNameplate($csvdata[productno][$l]);
									$skucode=$this->APcheckdescriptiontable($csvdata[skucode][$l]);
									$quantitytype=$this->Nameplategetpricedetailsfrommaterial($skucode[material_code]);
									$quantitycount=count($quantitytype);
									$i=0;
									if($quantitycount>0)
									{
										foreach($quantitytype as $key => $quantitytype_data)
										{	
											$quantitygroup[$i]=$quantitytype_data['quantity'];
											$pricegroup[$i]=$quantitytype_data['price'];
											$i++;
										}	
									}
									$addquantity=$csvdata[quantity][$l];
									//$addquantity is the current total of the existing shopping cart of the product with the same material code
	
									$k=0;
									while($k<$quantitycount)
									{
										if($addquantity>=$quantitygroup[$k]&&$addquantity<$quantitygroup[$k+1])
										{
											break;
										}
										$k++;
									}
								   
									if($k==$quantitycount)	
										$k=$k-1;	
									$quantity=$quantitygroup[$k];
									if($_SESSION[user_type]=='R')
									{
										$currentprice=$pricegroup[$k]*(100-$_SESSION['discount_data'])/100;
										$last_price=$pricegroup[$k];
									}
									else
									{
										$currentprice=$pricegroup[$k];
										$last_price=$pricegroup[0];
									}
									$price=$this->APgetinfofromprice($skucode[material_code],$quantity);
									if($price[min_quantity_below]&&($csvdata[quantity][$l]<$price[min_quantity_below]))
									{
										$last_total=$last_price*$csvdata[quantity][$l]+$price[min_quantity_charge]+$skucode[additional_charge];									
										$totalprice=$price[price]*$csvdata[quantity][$l]+$price[min_quantity_charge]+$skucode[additional_charge];									
									}
									else
									{
										$last_total=$last_price*$csvdata[quantity][$l]+$skucode[additional_charge];									
										$totalprice=$price[price]*$csvdata[quantity][$l]+$skucode[additional_charge];
									}						
									$this->APinsert_custom_stencil_product_csv($product,$skucode,$price,$last_price,$totalprice,$last_total,$csvdata[quantity][$l],'','','',$csvdata[arrow][$l],$csvdata[textcontent][$l],'',$csvdata[textsize][$l],$csvcomment);							
									
								}
								if($csvcomment!='')
									$this->APInsertCsvComment($csvcomment,$filename);							
							}
							else
								unlink($uploadFilePath);						
						}						
						break;
					}	
					case 14://Custom Underground Tape
					{
						$filetype=$_FILES["importcsvfile"]["type"];	
						$filename=$_FILES['importcsvfile']['name'];
						$uploadFilePath=PathTemplatesShoppingCart.'importcsv/'.$filename;
						$csvcomment=$_REQUEST['csv_comment'];
						if($filename=='')
							print 'Please upload a file.';
						else if($filetype!='application/vnd.ms-excel'&&$filetype!='text/csv')
							print 'Only csv file is allowed';				
						else
						{
							if (file_exists($uploadFilePath))
							{
							   $purefilename=substr($filename,0,-$typelength);
							   $random_digit=rand(0000,9999);
							   $filename=$purefilename.$random_digit.date('Ynjhis').".".'csv';
							   $uploadFilePath=PathTemplatesShoppingCart.'importcsv/'.$filename;
							}
							copy($_FILES['importcsvfile']['tmp_name'], $uploadFilePath);
							$arrLines = file($uploadFilePath);
							$count=3;
							$thereiserror='N';
							while($arrLines[$count])
							{
								$field = array();							
								$field= explode( ',',$arrLines[$count]);
								if(!is_numeric($field[0]))
									$validatequantity[0]=' Quantity is not valid.';	
								else
								{
									$qtyconverttoint = (int)($field[0]);
									if($qtyconverttoint<1||(string)$qtyconverttoint!=$field[0])
										$validatequantity[0]=' Quantity is not valid.';
									else
										$validatequantity[0]='';
								}
								if(substr($field[1],0,1)=='"'&&substr($field[1],-1,1)=='"')
								{

									$field[1]=substr($field[1],1);
									$field[1]=substr($field[1],0,-1);
								}		
								$field[1]=str_replace('""','"',$field[1]);	
								$validcolor[0]='';
								$validtextchara='';
								$validmaterialtype=$this->APcsvvalidateMaterialtypeDescription($field[1]);
								if($validmaterialtype[0]=='')
								{
									if($validmaterialtype[2]!='Underground Tape')
									{
										$validateproduct="The product is not 'Underground Tape'";	
									}
									else
									{
										$validateproduct='';
										if($validatequantity[0]=='')
											$validatequantity=$this->APValidateGetMinimunQuantity($validmaterialtype[5],$qtyconverttoint);	
										$field[2]=strtolower($field[2]);
										$field[2]=str_replace(" ", "", $field[2]);
										$field[2]=str_replace("bkgd", " bkgd", $field[2]);
										$field[2]=str_replace("text", " text", $field[2]);
										$validcolor=$this->APcsvvalidateColor($validmaterialtype[2],$field[2]);									
										$fieldcount=count($field);
										$text_content="";									
										if($fieldcount==4)
										{
											$field[3]=substr($field[3],0,-2);
											if(substr($field[3],0,1)=='"'&&substr($field[3],-1,1)=='"')
											{
												$field[3]=substr($field[3],1);
												$field[3]=substr($field[3],0,-1);
											}											
											$text_content=str_replace('""','"',$field[3]);								
										}
										else if($fieldcount>4)
										{	
											$field[3]=substr($field[3],1);	
											$text_initialcontent=str_replace('""','"',$field[3]);
											
											for($c=4;$c<$fieldcount;$c++)
											{	
												if($c==($fieldcount-1))
												{
													$field[$c]=substr($field[$c],0,-3);//remove \r and "
												}
												$fieldcontent=str_replace('""','"',$field[$c]);		
												$text_content=$text_content.",".$fieldcontent;
											}
											$text_content=$text_initialcontent.$text_content;
										}
										$max_result=$this->APcsvvalidateMaxCharNormal($validmaterialtype[1]);
										if(strlen($text_content)>$max_result[max_chars_upper])
										{
											$validtextchara='Text content is over the maximum '.$max_result[max_chars_upper].' allowed characters';
										}
										else
										{
											$validtextchara='';											
										}										
									}
								}
								if($validatequantity[0]!=''||$validmaterialtype[0]!=''||$validcolor[0]!=''||$validtextchara!=''||$validateproduct!='')
								{
									echo 'row'.($count-2).$validatequantity[0].' '.$validmaterialtype[0].' '.$validcolor[0].' '.$validtextchara.' '.$validateproduct.'<br/>';
									if($thereiserror!='Y')
										$thereiserror='Y';
								}
								else
								{
									$csvdata[quantity][$count]=$field[0];
									$csvdata[productno][$count]=$validmaterialtype[2];
									$csvdata[color][$count]=$validcolor[1];
									$csvdata[skucode][$count]=$validmaterialtype[1];
									$csvdata[textcontent][$count][0]=$text_content;
									//$csvdata[textsize][$count]=$max_result[text_size];
								}
								$count++;
							}

							if($csvcomment!=''&&strlen($csvcomment)>255)
							{
								echo 'Comment is over 255 the max allowed characters';
								if($thereiserror!='Y')
									$thereiserror='Y';
							}								
							if($thereiserror=='N')
							{	
								for($l=3;$l<$count;$l++)
								{
									$product=$this->APcheckfromproductinsertNameplate($csvdata[productno][$l]);
									$skucode=$this->APcheckdescriptiontable($csvdata[skucode][$l]);
									$quantitytype=$this->Nameplategetpricedetailsfrommaterial($skucode[material_code]);
									$quantitycount=count($quantitytype);
									$i=0;
									if($quantitycount>0)
									{
										foreach($quantitytype as $key => $quantitytype_data)
										{	
											$quantitygroup[$i]=$quantitytype_data['quantity'];
											$pricegroup[$i]=$quantitytype_data['price'];
											$i++;
										}	
									}
									
									$addquantity=$csvdata[quantity][$l];
									//$addquantity is the current total of the existing shopping cart of the product with the same material code
									$k=0;
									while($k<$quantitycount)
									{
										if($addquantity>=$quantitygroup[$k]&&$addquantity<$quantitygroup[$k+1])
										{
											break;
										}
										$k++;
									}
									if($k==$quantitycount)	
										$k=$k-1;	
									$quantity=$quantitygroup[$k];
									
									if($_SESSION[user_type]=='R')
									{
										$currentprice=$pricegroup[$k]*(100-$_SESSION['discount_data'])/100;
										$last_price=$pricegroup[$k];
									}
									else
									{
										$currentprice=$pricegroup[$k];
										$last_price=$pricegroup[0];
									}
									$price=$this->APgetinfofromprice($skucode[material_code],$quantity);
									if($price[min_quantity_below]&&($csvdata[quantity][$l]<$price[min_quantity_below]))
									{
										$last_total=$last_price*$csvdata[quantity][$l]+$price[min_quantity_charge]+$skucode[additional_charge];									
										$totalprice=$price[price]*$csvdata[quantity][$l]+$price[min_quantity_charge]+$skucode[additional_charge];									
									}
									else
									{
										$last_total=$last_price*$csvdata[quantity][$l]+$skucode[additional_charge];									
										$totalprice=$price[price]*$csvdata[quantity][$l]+$skucode[additional_charge];
									}					
									$this->APinsert_custom_nameplate_product_csv($product,$skucode,$price,$last_price,$totalprice,$last_total,$csvdata[quantity][$l],$csvdata[color][$l],'','','',$csvdata[textcontent][$l],'','',$csvcomment);							
								}
								if($csvcomment!='')
									$this->APInsertCsvComment($csvcomment,$filename);							
							}
							else
								unlink($uploadFilePath);							
						}							
						break;
					}					
				}
			}
		}
	}
	function APcheckdescriptiontableCsvupload($sku_code)
	{
		  $sql_skucode_list="select sku_id,sku_code,product_number,material_code,material_description,freight_shipping,shoppingcart_image,ab_tape_class,ab_tape,ab_sku_code,ez_arrow_class,ez_arrow,ez_sku_code,addtocart_heading from pm_products_sku_description where sku_code='$sku_code' and active='Y'";  
		  //print $sql_skucode_list;
		  $skucode_result=mysql_query($sql_skucode_list);//only one records
		  
		  if(mysql_num_rows($skucode_result)>0)
		  {
			  while($skucode_row=mysql_fetch_array($skucode_result))
			  {
				  $skucodeget[sku_id]=$skucode_row['sku_id'];
				  $skucodeget[product_number]=$skucode_row['product_number'];
				  $skucodeget[sku_code]=$skucode_row['sku_code'];
				  $skucodeget[material_code]=$skucode_row['material_code'];
				  $skucodeget[freight_shipping]=$skucode_row['freight_shipping'];
				  $skucodeget[shoppingcart_image]=$skucode_row['shoppingcart_image'];
				  $skucodeget[material_description]=$skucode_row['material_description'];
				  $skucodeget[ab_tape_class]=$skucode_row['ab_tape_class'];
				  $skucodeget[ab_tape]=$skucode_row['ab_tape'];
				  $skucodeget[ab_sku_code]=$skucode_row['ab_sku_code'];
				  $skucodeget[ez_arrow_class]=$skucode_row['ez_arrow_class'];
				  $skucodeget[ez_arrow]=$skucode_row['ez_arrow'];
				  $skucodeget[ez_sku_code]=$skucode_row['ez_sku_code'];
                  $skucodeget[addtocart_heading]=$skucode_row['addtocart_heading'];
			  }
		  }
		  return $skucodeget;
	}	
	function APcsvvalidateMaterialtype($product_number)
	{

		$sql_textsize="select product_number from pm_products where product_number='$product_number' and active='Y'";		
		$textsize_result=mysql_query($sql_textsize);
		if(mysql_num_rows($textsize_result)>0)
		{
			//$csvdata[productno][$row]=$product_number;
			$returnvalue[0]='';
			$returnvalue[1]=$product_number;
		}
		else
		{
			$returnvalue[0]='Material type is not valid';
		}
		return $returnvalue;
	}
	function APcsvvalidateThickness($material,$thickness)
	{
		//$sql_textsize="select material_description from pm_products_sku_description where material_description like '$thickness%' and material='$material' and active='Y'";	
        $sql_textsize="select material_description from pm_products_sku_description where material_description like '$thickness%' and material='$material' and active='Y'";
		//print $sql_textsize;
		$textsize_result=mysql_query($sql_textsize);
		if(mysql_num_rows($textsize_result)>0)
		{
			$returnvalue[1]=$thickness.'"';
			$returnvalue[0]='';
		}
		else
			$returnvalue[0]='Thickness is not valid';
		return $returnvalue;	
	}
	function APcsvvalidateSize($material,$size)
	{
		if(!strpos($size,'"'))
			$size=$size.'"';
		$sql_textsize="select sku_code,material_code from pm_products_sku_description where material='$material' and size='$size' and active='Y'";	
		//print $sql_textsize;
        $textsize_result=mysql_query($sql_textsize);
		if(mysql_num_rows($textsize_result)>0)
		{
			while($skucode_row=mysql_fetch_array($textsize_result))
			{
				$material_code=$skucode_row['material_code'];
				$sku_code=$skucode_row['sku_code'];
			}	
			$returnvalue[0]='';
			$returnvalue[1]=$size.'"';
			$returnvalue[2]=$material_code;
			$returnvalue[3]=$sku_code;
		}
		else
			$returnvalue[0]='Size is not valid';
	    return $returnvalue;	
	}
	function APcsvvalidatecolor($product_number,$color)
	{
		if(strpos($color,'_'))
			$color=str_replace("_", "/", $color);
		$sql_textsize="select color from pm_product_custom_color where product_number='$product_number' and color='$color' and active='Y'";		//print $sql_textsize;
		$textsize_result=mysql_query($sql_textsize);
		//print $sql_textsize;
		if(mysql_num_rows($textsize_result)>0)
		{
			while($skucode_row=mysql_fetch_array($textsize_result))
			{
				$color_result=$skucode_row['color'];
			}				
			$returnvalue[0]='';
			$returnvalue[1]=$color_result;
		}
		else
			$returnvalue[0]='Color is not valid';
		return $returnvalue;		
	}
	function APcsvvalidateMountingoption($material,$thickness,$size,$mounting_option)
	{
		//$sql_textsize="select o.mounting_option from pm_custom_products_attributes o,pm_products_sku_description s where o.mounting_option='$mounting_option' and o.active='Y' and s.size like '$size%' and s.product_number='$product_number' and s.active='Y' and s._sku_code=o.sku_code";
		$sql_textsize="select s.sku_code from pm_custom_products_attributes a,pm_products_sku_description s where a.attribute_option='$mounting_option' and a.active='Y' and s.active='Y' and s.material='$material' and s.material_description like '$thickness%' and s.size like '$size%' and s.sku_code=a.sku_code";        		
		$textsize_result=mysql_query($sql_textsize);
        //print $sql_textsize;
		if(mysql_num_rows($textsize_result)>0)
		{		
			$returnvalue[0]='';
			$returnvalue[1]=$mounting_option;
		}
		else
			$returnvalue[0]='Mounting option is not valid';	
		return $returnvalue;		
	}
	function APcsvvalidateTextalignment($textalignment)
	{
		if($textalignment!='center'&&$textalignment!='left'&&$textalignment!='right')
			$returnvalue[0]='Text alignment is not valid';
		else
		{
			$returnvalue[0]='';
			$returnvalue[1]=$textalignment;			
		}
		return $returnvalue;		
	}
	function APcsvvalidateTextsize($sku_code,$text_size)// to be check
	{
		if($text_size=='copy to fit')
		{
			$sql_textsize="select copytofit_maxline,copytofit_maxchar from pm_custom_nameplate_spec where sku_code='$sku_code' and active='Y' group by sku_code";		
			$textsize_result=mysql_query($sql_textsize);		
			if(mysql_num_rows($textsize_result)>0)
			{
				while($textsize_row=mysql_fetch_array($textsize_result))
				{
					$max_result[copytofit_maxline]=$textsize_row['copytofit_maxline'];
					$max_result[copytofit_maxchar]=$textsize_row['copytofit_maxchar'];
				}		
				$returnvalue[0]='';
				$returnvalue[1]=$text_size;
				$returnvalue[2]=$max_result[copytofit_maxline];//max_line
				$returnvalue[3]=$max_result[copytofit_maxchar];//max_upper
				$returnvalue[4]=$max_result[copytofit_maxchar];	//max_mixed		

			}
			else
				$returnvalue[0]='Text size is not valid';				
		}
		else
		{
			$sql_textsize="select text_size,max_lines,max_chars_upper,max_chars_mixed from pm_custom_nameplate_spec where text_size like '$text_size%' and sku_code='$sku_code' and active='Y' group by text_size";		
			$textsize_result=mysql_query($sql_textsize);
			//print $sql_textsize;
			if(mysql_num_rows($textsize_result)>0)

			{
				while($textsize_row=mysql_fetch_array($textsize_result))
				{
					$textsize=$textsize_row['text_size'];
					$max_result[max_line]=$textsize_row['max_lines'];
					$max_result[max_upper]=$textsize_row['max_chars_upper'];
					$max_result[max_mixed]=$textsize_row['max_chars_mixed'];
				}		
				$returnvalue[0]='';
				$returnvalue[1]=$textsize;
				$returnvalue[2]=$max_result[max_line];//max_line
				$returnvalue[3]=$max_result[max_upper];//max_upper
				$returnvalue[4]=$max_result[max_mixed];	//max_mixed		
			}
			else
				$returnvalue[0]='Text size is not valid';			
		}
		return $returnvalue;
	}
	function APcsvvalidateMaterialtypeDescription($material)
	{
		$material=str_replace("''",'"',$material);
		$sql_textsize="select sku_code,product_number,value_tag_end_range,value_tag_start_range,material_code from pm_products_sku_description where material='$material' and active='Y' group by product_number";		
		$textsize_result=mysql_query($sql_textsize);
		//print $sql_textsize;
		if(mysql_num_rows($textsize_result)>0)
		{
			while($maxchar_row=mysql_fetch_array($textsize_result))
			{
				$skucode=$maxchar_row['sku_code'];
				$productno=$maxchar_row['product_number'];
				$endno=$maxchar_row['value_tag_end_range'];
				$startno=$maxchar_row['value_tag_start_range'];
				$material_code=$maxchar_row['material_code'];
			}			
			$returnvalue[0]='';
			$returnvalue[1]=$skucode;
			$returnvalue[2]=$productno;
			$returnvalue[3]=$startno;
			$returnvalue[4]=$endno;
			$returnvalue[5]=$material_code;
		}
		else
		{
			$returnvalue[0]='Material type is not valid';

		}
		return $returnvalue;	
	}
	function APcsvvalidateTextMaxCharNormal($textcontent)
	{
		if(strlen($textcontent)>60)
		{
			$returnvalue='Text should be under 60 chatacters';
		}
		else
		{
			$returnvalue='';
		}
		return $returnvalue;
	}
	function APcsvvalidateMaxCharNormal($sku_code)//for max spec based on sku_code only
	{
		$sql_textsize="select max_chars_upper from pm_custom_nameplate_spec where sku_code='$sku_code' and active='Y'";        		
		$textsize_result=mysql_query($sql_textsize);
		while($maxchar_row=mysql_fetch_array($textsize_result))
		{
			$max_result[max_chars_upper]=$maxchar_row['max_chars_upper'];
		}
		return $max_result;
	}	
	function APInsertCsvComment($csvcomment,$file_name)
	{	
		$sql_textsize="insert into pm_importcsv_instruction(s_id,special_comment,file_name,create_date) values('".mysql_real_escape_string(session_id())."','$csvcomment','$file_name',NOW())";		
		$textsize_result=mysql_query($sql_textsize);
	}
	function APcsvvalidateShape($shape,$material)
	{
		$sql_textsize="select material_description from pm_products_sku_description where material_description like '%$shape%' and material='$material' and active='Y'";        		
		$textsize_result=mysql_query($sql_textsize);
        //print $sql_textsize;
		if(mysql_num_rows($textsize_result)>0)
		{
			$returnvalue[0]='';
			$returnvalue[1]=$shape;
		}
		else
			$returnvalue[0]='Shape option is not valid';	
		return $returnvalue;		
	}
	function APcsvvalidatesizefromMaterial($material,$shape,$size)
	{
		if(!strpos($size,'"'))
			$size=$size.'"';
		$sql_textsize="select sku_code,material_code from pm_products_sku_description where size ='$size' and material='$material' and material_description like '%$shape%' and active='Y'";        		
		$textsize_result=mysql_query($sql_textsize);
        //print $sql_textsize;
		if(mysql_num_rows($textsize_result)>0)
		{
			while($maxchar_row=mysql_fetch_array($textsize_result))
			{
				$skucode=$maxchar_row['sku_code'];
				$material_code=$maxchar_row['material_code'];
			}				
			$returnvalue[0]='';
			$returnvalue[1]=$size.'"';
			$returnvalue[2]=$skucode;
			$returnvalue[3]=$material_code;
		}
		else
			$returnvalue[0]='Size option is not valid';	
		return $returnvalue;		
	}
	function APcsvvalidateTextsizeValvetag($sku_code,$textsize)//how to know text size limit
	{
		$sql_textsize="select text_size,max_lines,max_chars_upper,max_chars_mixed from pm_custom_nameplate_spec where sku_code='$sku_code' and active='Y' and text_size like '$textsize%'";        		
		$textsize_result=mysql_query($sql_textsize);
        //print $sql_textsize;
		if(mysql_num_rows($textsize_result)>0)
		{			
			$returnvalue='';
		}

		else
			$returnvalue='Text size option is not valid';	
		return $returnvalue;	
	}
	function APcsvvalidateTextmaxresultFromSku($sku_code,$text_size)//to be check copy to fit
	{
		if($text_size=='copy to fit')
		{
			$max_result[max_line]=4;
			$max_result[max_chars_upper]=8;
			$max_result[max_chars_mixed]=8;		
		}
		else
		{
			$sql_textsize="select max_lines,max_chars_upper,max_chars_mixed from pm_custom_nameplate_spec where text_size like '$text_size%' and sku_code='$sku_code' and active='Y' ";		
			//print $sql_textsize;
			$textsize_result=mysql_query($sql_textsize);
			while($maxchar_row=mysql_fetch_array($textsize_result))
			{
				$max_result[max_line]=$maxchar_row['max_lines'];
				$max_result[max_chars_upper]=$maxchar_row['max_chars_upper'];
				$max_result[max_chars_mixed]=$maxchar_row['max_chars_mixed'];
			}
		}
		return $max_result;		
	}
	function APValidateGetMinimunQuantity($material_code,$quantity)
	{
		if($_SESSION[user_type]=='R')
			$sql_textsize="select min_quantity from pm_products_price where material_code='$material_code' and user_type='$_SESSION[user_type]' and rep_special='$_SESSION[rep_special]' and active='Y'";		
		else
			$sql_textsize="select min_quantity from pm_products_price where material_code='$material_code' and user_type='$_SESSION[user_type]' and active='Y'";		
		//print $sql_textsize;
		$textsize_result=mysql_query($sql_textsize);
		while($maxchar_row=mysql_fetch_array($textsize_result))
		{
			$minquantity=$maxchar_row['min_quantity'];
		}
		if($quantity>=$minquantity)
		{
			$returnvalue[0]='';
			$returnvalue[1]=$quantity;
		}
		else
			$returnvalue[0]='Quantity should be above the minimum'.$minquantity;
		return $returnvalue;
	}
	function APcsvvalidateTextSizeStencil($material,$size)
	{		
		$sql_textsize="select sku_code,material_code,size from pm_products_sku_description where material='$material' and size='$size' and active='Y'";	
		$textsize_result=mysql_query($sql_textsize);
		//print $sql_textsize;
		if(mysql_num_rows($textsize_result)>0)
		{
			while($size_row=mysql_fetch_array($textsize_result))
			{
				$skucode=$size_row['sku_code'];
				$materialcode=$size_row['material_code'];
				$textsize=$size_row['size'];
			}			
			$returnvalue[0]='';
			$returnvalue[1]=$skucode;
			$returnvalue[2]=$materialcode;
			$returnvalue[3]=$textsize;
		}
		else
			$returnvalue[0]='Text size is not valid';
	    return $returnvalue;	
	}
	function APcsvvalidateTextsizeValvetagCheckboth($sku_code,$textsize1,$textsize2)
	{
		$sql_textsize="select text_size,max_lines,max_chars_upper,max_chars_mixed from pm_custom_nameplate_spec where sku_code='$sku_code' and active='Y' and text_size like '$textsize1%' or text_size like '$textsize2%'";        		
		$textsize_result=mysql_query($sql_textsize);
        //print $sql_textsize;
		if(mysql_num_rows($textsize_result)>1)
		{			
			$returnvalue='';
		}
		else
			$returnvalue='Text size option is not valid';	
		return $returnvalue;	
	}
	function APcsvvalidateShapeEngravedValveTag($shape,$material,$size)
	{
		$sql_textsize="select sku_code,material_code from pm_products_sku_description where material_description like '%$shape%' and material='$material' and size like '$size%' and active='Y'";        		
		$textsize_result=mysql_query($sql_textsize);
        //print $sql_textsize;
		if(mysql_num_rows($textsize_result)>0)
		{
			while($skucode_row=mysql_fetch_array($textsize_result))
			{
				$skucode=$skucode_row['sku_code'];
				$material_code=$skucode_row['material_code'];
			}			
			$returnvalue[0]='';
			$returnvalue[1]=$shape;
			$returnvalue[2]=$skucode;
			$returnvalue[3]=$material_code;
		}
		else
			$returnvalue[0]='Shape option is not valid';	
		return $returnvalue;		
	}
	function APProductShoppingCartImage($id)
	{
		$sql_product="select products_id,image1_thumbnail,product_number,product_nickname,
		category_name,subcategory_name 
		from pm_products 

		where products_id='".mysql_real_escape_string($id)."' and active='Y'";
		$product_result=mysql_query($sql_product);
		$product_data=mysql_fetch_array($product_result);
		$product_image['products_id']=$product_data['products_id'];
		$product_image['image1_thumbnail']=$product_data['image1_thumbnail'];
		$product_image['product_number']=$product_data['product_number'];
		$product_image['product_nickname']=$product_data['product_nickname'];
		$product_image['category_name']=$product_data['category_name'];		
		$product_image['subcategory_name']=$product_data['subcategory_name'];
		
		return $product_image;
	}	
	function APCreateImgGetColorCode($color)
	{
		switch($color)
		{
			case 'red':
			{
				$colorcode=array(251, 37, 0);
				break;
			}
			case 'blue':
			{
				$colorcode=array(0, 0, 255);
				break;
			}
			case 'green':
			{
				$colorcode=array(74, 146, 10);
				break;
			}
			case 'yellow':
			{
				$colorcode=array(247, 250, 35);
				break;
			}
			case 'gold':
			{
				$colorcode=array(247, 250, 35);
				break;
			}				
			case 'white':
			{
				$colorcode=array(255, 255, 255);
				break;
			}
			case 'black':
			{
				$colorcode=array(0, 0, 0);
				break;
			}
		}
		return $colorcode;
	}
	function APcountTempltaeSize($template_size)
	{
		$templatesize=str_replace('"', '', $template_size);
		$templatesize=str_replace(' ', '', $templatesize);//remove space
		$templatesize_sepa=split('x',$templatesize);	
		if(strpos($templatesize_sepa[0],'-'))
		{
			$template_width_sepa=split('-',$templatesize_sepa[0]);
			$template_width_fraction_part=split('/',$template_width_sepa[1]);
			$template_width_fraction=((int)$template_width_fraction_part[0])/((int)$template_width_fraction_part[1]);
			$template_width=$template_width_fraction+(float) $templatesize_sepa[0];
		}
		else if(strpos($templatesize_sepa[0],'/'))
		{
			$template_width_fraction_part=split('/',$templatesize_sepa[0]);
			$template_width=((int)$template_width_fraction_part[0])/((int)$template_width_fraction_part[1]);								
		}
		else
		{
			$template_width=(float) $templatesize_sepa[0];	
		}
		$template_width=$template_width*100;
		if(strpos($templatesize_sepa[1],'-'))
		{
			$template_height_sepa=split('-',$templatesize_sepa[1]);
			$template_height_fraction_part=split('/',$template_height_sepa[1]);
			$template_height_fraction=((int)$template_height_fraction_part[0])/((int)$template_height_fraction_part[1]);
			$template_height=$template_height_fraction+(float) $templatesize_sepa[1];
		}
		else if(strpos($templatesize_sepa[1],'/'))
		{
			$template_height_fraction_part=split('/',$templatesize_sepa[1]);
			$template_height=((int)$template_height_fraction_part[0])/((int)$template_height_fraction_part[1]);							
		}
		else
		{
			$template_height=(float) $templatesize_sepa[1];		
		}
		$template_height=$template_height*100;	
		return array($template_width,$template_height);
	}
	function APgetnewstringfromcell($oldstring)
	{
		$newarray=array();
		$characterlength=strlen($oldstring);
		for($t=0;$t<$characterlength;$t++)
		{
			array_push($newarray,$oldstring[$t]);	
		}							
		for($h=0;$h<$characterlength;$h++)
		{
			if($newarray[$h]=='"')
			{
				array_splice($newarray, $h, 1);
				while($newarray[$h]=='"')
				{
					$h=$h+1;
				}
				$h=$h-1;												
			}
		}

		$newstring="";
		for($r=0;$r<$characterlength;$r++)
		{
			$newstring.=$newarray[$r];
		}
		return $newstring;
	}
	/*function APGetNameplateJson()
	{
		$output=array(array());
		$sku_code=$this->GetcustomnameplateSkuCodefromdes_templatepage();
		foreach($sku_code as $key => $sku_data)
		{
			$mountingoption=$this->GetMountaing_Optionsfromdes($sku_data['sku_code']);
			$mounting_array=array();
			foreach($mountingoption as $key => $mounting_data)
			{
				array_push($mounting_array,$mounting_data['attribute_option']);		
			}
			$text_size=$this->Getcustomnameplate_textSizefromdes($sku_data['sku_code']);
			$textsize_array=array();
			foreach($text_size as $key => $textsize_data)
			{				
				$textsize_array[$textsize_data['text_size']]=array($textsize_data['text_size']);
				//array_push($textsize_array,$textsize_data['text_size']);		
			}				
			$maxdata=$this->GetMaxCharData_nameplate_all($sku_data['sku_code']);
			$maxcharaupper_array=array();
			$maxcharamixed_array=array();
			$maxline_array=array();
			foreach($maxdata as $key => $max_data)
			{
				array_push($maxline_array,$max_data['max_lines']);		
				array_push($maxcharaupper_array,$max_data['max_chars_upper']);
				array_push($maxcharamixed_array,$max_data['max_chars_mixed']);	
			}				
			$output[$sku_data['sku_code']][material_code]=$sku_data['material_code'];
			$output[$sku_data['sku_code']][thickness]=$sku_data['thickness'];
			$output[$sku_data['sku_code']][size]=$sku_data['size'];
			$output[$sku_data['sku_code']][sku_id]=$sku_data['sku_id'];
			$output[$sku_data['sku_code']][textsize]=$textsize_array;
			$output[$sku_data['sku_code']][max_line]=$maxline_array;
			$output[$sku_data['sku_code']][max_upper_chara]=$maxcharaupper_array;
			$output[$sku_data['sku_code']][max_mixed_chara]=$maxcharamixed_array;
			$output[$sku_data['sku_code']][mounting_option]=$mounting_array;
		}
				$json = json_encode($output);
				echo $json;			
	}*/
	function GetcustomnameplateSkuCodefromdes_templatepage_bysize()//to be check
	{

		$sql_skucode="select sku_code,sku_id,size from pm_products_sku_description where product_number='".$_REQUEST['productno']."' and active='Y' group by size order by position asc";
		$skucode_result=mysql_query($sql_skucode);
		//print $sql_skucode;
		while($skucode_row=mysql_fetch_array($skucode_result))
		{
				$skucode[]=$skucode_row;
		}
		return $skucode;	
	}
	function Getmaterialcode_by_size($size)
	{
		$sql_skucode="select material_code,material_description,sku_id from pm_products_sku_description where size='$size' and product_number='".$_REQUEST['productno']."' and active='Y' order by position";// to be check
		$skucode_result=mysql_query($sql_skucode);
		//print $sql_skucode;
		$i=0;
		while($skucode_row=mysql_fetch_array($skucode_result))
		{
			$material_des=$skucode_row['material_description'];
			$des_sepa=split(' - ',$material_des);
			if(strpos($des_sepa[1],"''"))
				$thickness_sepa=split("''",$des_sepa[1]);
			else
				$thickness_sepa=split('"',$des_sepa[1]);
			$thickness=$thickness_sepa[0];
			$skucode[$i][material_code]=$skucode_row['material_code'];
			$skucode[$i][sku_id]=$skucode_row['sku_id'];
			$skucode[$i][thickness]=$thickness;
			$i++;
		}
		return $skucode;	
	}
	function APGetNameplateJsonbysize()
	{
		$output=array();
		$instruction=utf8_encode($this->AP_GetCustomProductInstruction($_REQUEST['productno']));
		if($_REQUEST['category']=='Nameplates'||$_REQUEST['category']=='Custom Products'&&$_REQUEST['subcategory']=='Custom Nameplates')
		{
			if($_REQUEST['productno']!='CME')
			{
				$sku_code=$this->GetcustomnameplateSkuCodefromdes_templatepage_bysize();
				if(count($sku_code)>0)
				{
					foreach($sku_code as $key => $sku_data)
					{
						$mountingoption=$this->GetMountaing_Optionsfromdes($sku_data['sku_code']);
						if(count($mountingoption)>0)
						{
							$mounting_array=array();					
							foreach($mountingoption as $key => $mounting_data)
							{
								array_push($mounting_array,$mounting_data['attribute_option']);		
							}
						}
						$text_size=$this->Getcustomnameplate_textSizefromdes($sku_data['sku_code']);
						$textsize_array=array();				
						if(count($text_size)>0)
						{
							foreach($text_size as $key => $textsize_data)
							{
								$textsize=str_replace('"','',$textsize_data['text_size']);
								$textsize_array[$textsize]=array($textsize_data['max_chars_upper'],$textsize_data['max_chars_mixed'],$textsize_data['max_lines']);
								$copytofit_textsize=$textsize_data['copytofit_textsize'];
								$copytofit_maxline=$textsize_data['copytofit_maxline'];
								$copytofit_maxchar=$textsize_data['copytofit_maxchar'];
							}
						}
						$materialcode=$this->Getmaterialcode_by_size($sku_data['size']);
						$copytofit_array[copytofit_textsize]=$copytofit_textsize;
						$copytofit_array[copytofit_maxline]=$copytofit_maxline;
						$copytofit_array[copytofit_maxchar]=$copytofit_maxchar;
						$materialcodedata_array=array();
						if(count($materialcode)>0)
						{
							$thicknesstype=count($materialcode);
							$i=0;
							foreach($materialcode as $key => $materialcode_data)
							{
								$price=$this->Nameplategetpricedetailsfrommaterial($materialcode_data['material_code']);
								$price_array=array();
								if(count($price)>0)
								{
									foreach($price as $key => $price_data)
									{	
										$price_array[$price_data['quantity']]=$price_data['price'];
										$min_quantity=$price_data['min_quantity'];
									}
								}
								$materialcodedata_array[$i][material_code]=$materialcode_data['material_code'];
								$materialcodedata_array[$i][sku_id]=$materialcode_data['sku_id'];
								$materialcodedata_array[$i][price]=$price_array;
								if($thicknesstype>1)
									$materialcodedata_array[$i][thickness]=$materialcode_data['thickness'];
								else
									$materialcodedata_array[$i][thickness]="";
								$i++;
							}
						}
						$output[product][$sku_data['sku_code']][materialcode_data]=$materialcodedata_array;
						$output[product][$sku_data['sku_code']][size]=$sku_data['size'];
						$output[product][$sku_data['sku_code']][textsize]=$textsize_array;
						$output[product][$sku_data['sku_code']][mounting_option]=$mounting_array;
						$output[product][$sku_data['sku_code']][copy_to_fit]=$copytofit_array;
						$output[product][$sku_data['sku_code']][min_quantity]=$min_quantity;
					}
				}
				$color=$this->GetAvailableColorNameplate();
				$color_arrary=array();
				if(count($color)>0)
				{
					foreach($color as $key => $color_data)
					{
						array_push($color_arrary,$color_data['color']);	
					}
				}
				$output[color]=$color_arrary;
				$output[notes]=$instruction;
				$selected_load_array=array();
				if(isset($_REQUEST['sh_id']))
				{
					 $load_customnameplate=$this->LoadCustomNameplate();
					 $load_customnameplate_detail=$this->LoadCustomNameplateDetails();
					 if(count($load_customnameplate)>0)
					 {
						  $selected_load_array[productid]=$this->APgetrepresentIDbySize($load_customnameplate[size]);//not sku_code
						  $selected_load_array[material_code]=$load_customnameplate[material_code];
						  $selected_load_array[color]=$load_customnameplate[color];
						  $selected_load_array[mounting_option]=$load_customnameplate[mounting_option];
						  $selected_load_array[quantity]=$load_customnameplate[quantity];
						  if($load_customnameplate[make_fit]=='Y')
							  $selected_load_array[copytofit]='copytofit';
						  else 
							  $selected_load_array[copytofit]='linebyline';
						  $selected_load_array[special_comment]=$load_customnameplate[comments];
						  $textdetail_array=array();
						  if(count($load_customnameplate_detail)>0)
						  {
							  $p=1;
							  foreach($load_customnameplate_detail as $key => $detail_data) 
							  {
								  $textdetail_array[$p][text_size]=str_replace('"','',$detail_data['option_value2']);
								  $textdetail_array[$p][text_content]=utf8_encode($detail_data['option_value3']);
								  $textdetail_array[$p][text_align]=$detail_data['option_value4'];
								  $textdetail_array[$p][compression_rate]=$detail_data['compression_rate'];
								  $p++;
							  }
						  }
						  $selected_load_array[text_detail]=$textdetail_array;
					 }
				}
				$output[custom_selected]=$selected_load_array;
			}
			else//custom ceiling markers
			{
				$sku_code=$this->GetcustomSkuCodeNormal();
				if(count($sku_code)>0)
				{
					foreach($sku_code as $key => $sku_data)
					{	

						$maximum_character=$this->Getcustomnameplate_textSizefromdes($sku_data['sku_code']);
						$textsize_array=array();				
						if(count($maximum_character)>0)
						{
							foreach($maximum_character as $key => $textsize_data)
							{
								$textsize_array[max_character]=$textsize_data['copytofit_maxchar'];	
								$textsize_array[max_line]=$textsize_data['copytofit_maxline'];	
							}
						}
						$material_separate=split(' ',$sku_data['material']);
						$color_re=$material_separate[0];
						$price=$this->Nameplategetpricedetailsfrommaterial($sku_data['material_code']);
						$price_array=array();
						if(count($price)>0)
						{
							foreach($price as $key => $price_data)
							{	
								$price_array[$price_data['quantity']]=$price_data['price'];	
								$min_quantity=$price_data['min_quantity'];	
							}
						}
						$output[product][$sku_data['sku_code']][sku_id]=$sku_data['sku_id'];
						$output[product][$sku_data['sku_code']][price]=$price_array;
						$output[product][$sku_data['sku_code']][text_size]=$textsize_array;
						$output[product][$sku_data['sku_code']][min_quantity]=$min_quantity;
						$output[product][$sku_data['sku_code']][color]=$color_re;
					}
				}
				$color=$this->GetAvailableColorNameplate();
				$color_arrary=array();
				if(count($color)>0)
				{
					foreach($color as $key => $color_data)
					{
						array_push($color_arrary,$color_data['color']);	
					}
				}		
				$output[color]=$color_arrary;
				$output[notes]=$instruction;
				$selected_load_array=array();
				
				if(isset($_REQUEST['sh_id']))
				{
					 $load_customnameplate=$this->LoadCustomNameplate();
					 $load_customnameplate_detail=$this->LoadCustomNameplateDetails();
					 if(count($load_customnameplate)>0)
					 {
						  $selected_load_array[productid]=$load_customnameplate[sku_code];
						  $selected_load_array[quantity]=$load_customnameplate[quantity];
						  $selected_load_array[special_comment]=$load_customnameplate[comments];
						  $textdetail_array=array();
						  if(count($load_customnameplate_detail)>0)
						  {	  
						  	  $p=1;
							  foreach($load_customnameplate_detail as $key => $detail_data) //actually there is only one record
							  {
								  $textdetail_array[$p][text_size]=str_replace('"','',$detail_data['option_value2']);
								  $textdetail_array[$p][text_content]=str_replace('"','',$detail_data['option_value3']);
								  $compression_rate[$p]=$detail_data['compression_rate'];
								  $p++;
							  }
						  }
						  $selected_load_array[text_detail]=$textdetail_array;
						  $selected_load_array[color]=$load_customnameplate[color];					  
					 }
				}
				$output[custom_selected]=$selected_load_array;	
			}
		}
		else if($_REQUEST['subcategory']=='Custom Pipe Markers'||$_REQUEST['subcategory']=='Custom Duct Markers'||$_REQUEST['subcategory']=='Custom Medical Gas Markers')//duct and pipemarker
		{
			if($_REQUEST['productno']=='Custom EZ Markers')
			{
				$sku_code=$this->GetcustomSkuCodeNormal();
				if(count($sku_code)>0)
				{
					foreach($sku_code as $key => $sku_data)
					{	
						$separate_skucode=split('-',$sku_data['sku_code']);
						$represent_skucode=$separate_skucode[0].'-'.$separate_skucode[1].'-'.$separate_skucode[2];
						$text_size=$this->Getcustomnameplate_textSizefromdes($sku_data['sku_code']);
						$textsize_array=array();				
						if(count($text_size)>0)
						{
							foreach($text_size as $key => $textsize_data)
							{
								$textsize=str_replace('"','',$textsize_data['text_size']);
								$textsize_array[$textsize]=$textsize_data['max_chars_upper'];	
								$absolute_maximum=$textsize_data['absolute_maximum'];	
							}
						}												
						$price=$this->Nameplategetpricedetailsfrommaterial($sku_data['material_code']);
						$price_array=array();
						$materialcodedata_array=array();
						if(count($price)>0)
						{
							foreach($price as $key => $price_data)
							{	
								$price_array[$price_data['quantity']]=$price_data['price'];	
								$min_quantity=$price_data['min_quantity'];	
							}
						}
						$output[product][$represent_skucode][sku_id]=$sku_data['sku_id'];
						$output[product][$represent_skucode][style]=$sku_data['material'];
						$output[product][$represent_skucode][price]=$price_array;
						$output[product][$represent_skucode][size]=$sku_data['size'];
						$output[product][$represent_skucode][text_size]=$textsize_array;
						$output[product][$represent_skucode][min_quantity]=$min_quantity;
						$output[product][$represent_skucode][absolute_max]=$absolute_maximum;
					}
				}
				$color=$this->GetAvailableColorNameplate();
				$color_arrary=array();
				$c=0;
				if(count($color)>0)
				{
					foreach($color as $key => $color_data)
					{
						//array_push($color_arrary,$color_data['color']);
						$color_arrary[$c]=array($color_data['color'],$color_data['color_class']);
						$c++;
					}
				}
				$separate_category=split(' ',$_REQUEST['subcategory']);
				$category='';
				for ($l=1;$l<count($separate_category);$l++)
				{
					if($l==(count($separate_category)-1))
						$category.=$separate_category[$l];
					else 
						$category.=$separate_category[$l].' ';
				}
				//$subcategory='EZ Pipe Markers';
				$by_legend=$this->APGetRelatedByLegend($category);
				$legend_array=array();
				if(count($by_legend)>0)
				{
					foreach($by_legend as $key => $legend_data)
					{
						array_push($legend_array,$legend_data['by_legend']);	
					}
				}
				$output[color]=$color_arrary;
				$output[notes]=$instruction;
				$output[markerLegend]=$legend_array;
				$selected_load_array=array();
				if(isset($_REQUEST['sh_id']))
				{
					 $load_customnameplate=$this->LoadCustomNameplate();
					 $load_customnameplate_detail=$this->LoadCustomNameplateDetails();
					 if(count($load_customnameplate)>0)
					 {
						  $separate_skucode=split('-',$load_customnameplate[sku_code]);
						  $represendtskucode=$separate_skucode[0].'-'.$separate_skucode[1].'-'.$separate_skucode[2];//for custom ez pipemarker
						  $selected_load_array[productid]=$represendtskucode;
						  $selected_load_array[quantity]=$load_customnameplate[quantity];
						  $selected_load_array[color]=$load_customnameplate[color];
						  $selected_load_array[special_comment]=$load_customnameplate[comments];					  
						  if(count($load_customnameplate_detail)>0)
						  {
							  foreach($load_customnameplate_detail as $key => $detail_data) //actually there is only one record
							  {
								  $text_content=$detail_data['option_value1'];
								  $compression_rate=$detail_data['compression_rate'];
							  }
						  }
						  $selected_load_array[text_content]=utf8_encode($text_content);
						  $selected_load_array[compression_rate]=$compression_rate;
						  $selected_load_array[waive_maximum]=$load_customnameplate[waiver];
					 }
				}
				$output[custom_selected]=$selected_load_array;					
			}
			else
			{
				$sku_code=$this->GetcustomSkuCodeNormal();
				if(count($sku_code)>0)
				{
					foreach($sku_code as $key => $sku_data)
					{	
						$text_size=$this->Getcustomnameplate_textSizefromdes($sku_data['sku_code']);
						$textsize_array=array();				
						if(count($text_size)>0)
						{
							foreach($text_size as $key => $textsize_data)
							{
								$textsize=str_replace('"','',$textsize_data['text_size']);
								$textsize_array[$textsize]=$textsize_data['max_chars_upper'];	
								$absolute_maximum=$textsize_data['absolute_maximum'];	
							}
						}												
						$price=$this->Nameplategetpricedetailsfrommaterial($sku_data['material_code']);
						$price_array=array();
						$materialcodedata_array=array();
						if(count($price)>0)
						{
							foreach($price as $key => $price_data)
							{	
								$price_array[$price_data['quantity']]=$price_data['price'];	
								$min_quantity=$price_data['min_quantity'];	
							}
						}
						$output[product][$sku_data['sku_code']][sku_id]=$sku_data['sku_id'];
						$output[product][$sku_data['sku_code']][style]=$sku_data['material'];
						$output[product][$sku_data['sku_code']][price]=$price_array;
						$output[product][$sku_data['sku_code']][size]=$sku_data['size'];
						$output[product][$sku_data['sku_code']][text_size]=$textsize_array;
						$output[product][$sku_data['sku_code']][min_quantity]=$min_quantity;
						$output[product][$sku_data['sku_code']][absolute_max]=$absolute_maximum;
					}
				}
				$color=$this->GetAvailableColorNameplate();
				$color_arrary=array();
				if(count($color)>0)
				{
					foreach($color as $key => $color_data)
					{
						array_push($color_arrary,$color_data['color']);	
					}
				}
				$separate_category=split(' ',$_REQUEST['subcategory']);
				$category='';
				for ($l=1;$l<count($separate_category);$l++)
				{
					if($l==(count($separate_category)-1))
						$category.=$separate_category[$l];
					else 
						$category.=$separate_category[$l].' ';
				}
				$by_legend=$this->APGetRelatedByLegend($category);
				$legend_array=array();
				if(count($by_legend)>0)
				{
					foreach($by_legend as $key => $legend_data)
					{
						array_push($legend_array,$legend_data['by_legend']);	
					}
				}				
				$output[color]=$color_arrary;
				$output[notes]=$instruction;
				$output[markerLegend]=$legend_array;
				$selected_load_array=array();
				if(isset($_REQUEST['sh_id']))
				{
					 $load_customnameplate=$this->LoadCustomNameplate();
					 $load_customnameplate_detail=$this->LoadCustomNameplateDetails();
					 if(count($load_customnameplate)>0)
					 {
						  $selected_load_array[productid]=$load_customnameplate[sku_code];
						  $selected_load_array[quantity]=$load_customnameplate[quantity];
						  $selected_load_array[color]=$load_customnameplate[color];
						  $selected_load_array[special_comment]=$load_customnameplate[comments];					  
						  if(count($load_customnameplate_detail)>0)
						  {
							  foreach($load_customnameplate_detail as $key => $detail_data) //actually there is only one record
							  {
								  $text_content=$detail_data['option_value1'];
								  $compression_rate=$detail_data['compression_rate'];
							  }
						  }
						  $selected_load_array[text_content]=utf8_encode($text_content);
						  $selected_load_array[compression_rate]=$compression_rate;
						  $selected_load_array[waive_maximum]=$load_customnameplate[waiver];
					 }
				}
				$output[custom_selected]=$selected_load_array;	
			}
		}
		else if($_REQUEST['productno']=='Stencils')//change custom stencils's subcategory name
		{
			$sku_code=$this->GetcustomstencilSkuCodefromdes_templatepage_bymaterial();
			if(count($sku_code)>0)
			{
				foreach($sku_code as $key => $sku_data)
				{			
					$materialcode=$this->StencilsGetmaterialcode_by_material($sku_data['material']);
					$materialcodedata_array=array();
					
					if(count($materialcode)>0)
					{
						$i=0;
						foreach($materialcode as $key => $materialcode_data)
						{
							$textsize=str_replace('"','',$materialcode_data['size']);
							$textsize_array=array();
							$maxcharacter=$this->GetMaxCharData_nameplate($materialcode_data['sku_code'],$materialcode_data['size']);
							$textsize_array[$textsize]=$maxcharacter[max_chars_upper];	//to be check max characters									
							$price=$this->Nameplategetpricedetailsfrommaterial($materialcode_data['material_code']);
							$price_array=array();
							if(count($price)>0)
							{
								foreach($price as $key => $price_data)
								{	
									$price_array[$price_data['quantity']]=$price_data['price'];
									$min_quantity=$price_data['min_quantity'];
								}
							}
							$materialcodedata_array[$i][material_code]=$materialcode_data['material_code'];
							$materialcodedata_array[$i][sku_id]=$materialcode_data['sku_id'];
							$materialcodedata_array[$i][price]=$price_array;
							$materialcodedata_array[$i][text_size]=$textsize_array;
							$i++;
						}
					}
					$output[product][$sku_data['sku_code']][material]=$sku_data['material'];
					$output[product][$sku_data['sku_code']][stencil_textsize]=$materialcodedata_array;
					$output[product][$sku_data['sku_code']][min_quantity]=$min_quantity;
				}
			}
			$color=$this->GetAvailableColorNameplate();
			$color_arrary=array();
			if(count($color)>0)
			{
				foreach($color as $key => $color_data)
				{
					array_push($color_arrary,$color_data['color']);	
				}
			}
			$output[layout]=$color_arrary;
			$output[notes]=$instruction;
			$selected_load_array=array();
			if(isset($_REQUEST['sh_id']))
			{
				 $load_customnameplate=$this->LoadCustomNameplate();
				 $load_customnameplate_detail=$this->LoadCustomNameplateDetails();
				 if(count($load_customnameplate)>0)
				 {
					  $selected_load_array[productid]=$this-> APgetrepresentIDbyMaterial($load_customnameplate[material]);//not sku_code
					  $selected_load_array[material_code]=$load_customnameplate[material_code];
					  $selected_load_array[quantity]=$load_customnameplate[quantity];
					  $selected_load_array[special_comment]=$load_customnameplate[comments];			
					  $textdetail_array=array();
					  if(count($load_customnameplate_detail)>0)
					  {
						  foreach($load_customnameplate_detail as $key => $detail_data) //actually there is only one record
						  {
							  $textdetail_array[text_size]=$detail_data['option_value1'];
							  $textdetail_array[text_content]=utf8_encode($detail_data['option_value2']);
							  $textdetail_array[compression_rate]=$detail_data['compression_rate'];
							  //$layout=$detail_data['option_value3'];
						  }
					  }
					  $textdetail_array[layout]=$load_customnameplate[color];
					  $selected_load_array[text_detail]=$textdetail_array;
				 }
			}
			$output[custom_selected]=$selected_load_array;			
		}
		else if(/*$_REQUEST['category']=='Custom Products'&&*/$_REQUEST['subcategory']=='Custom Ammonia Markers')
		{
			if($_REQUEST['productno']!='ACM')
			{
				$sku_code=$this->GetcustomSkuCodeNormal();
				if(count($sku_code)>0)
				{
					foreach($sku_code as $key => $sku_data)
					{	
						$text_size=$this->Getcustomnameplate_textSizefromdes($sku_data['sku_code']);
						$textsize_array=array();				
						if(count($text_size)>0)
						{
							foreach($text_size as $key => $textsize_data)
							{
								$textsize=str_replace('"','',$textsize_data['text_size']);
								$textsize_array[$textsize]=$textsize_data['max_chars_upper'];	
							}
						}												
						$price=$this->Nameplategetpricedetailsfrommaterial($sku_data['material_code']);
						$price_array=array();
						$materialcodedata_array=array();
						if(count($price)>0)
						{
							foreach($price as $key => $price_data)
							{	
								$price_array[$price_data['quantity']]=$price_data['price'];					
							}
						}
						$output[product][$sku_data['sku_code']][sku_id]=$sku_data['sku_id'];
						$output[product][$sku_data['sku_code']][style]=$sku_data['material'];
						$output[product][$sku_data['sku_code']][price]=$price_array;
						$output[product][$sku_data['sku_code']][size]=$sku_data['size'];
						$output[product][$sku_data['sku_code']][text_size]=$textsize_array;
					}
				}
				$color=$this->GetAvailableColorNameplate();
				$color_arrary=array();
				if(count($color)>0)
				{
					foreach($color as $key => $color_data)
					{
						array_push($color_arrary,$color_data['color']);	
					}
				}
				$separate_category=split(' ',$_REQUEST['subcategory']);
				$category='';
				for ($l=1;$l<count($separate_category);$l++)
				{
					if($l==(count($separate_category)-1))
						$category.=$separate_category[$l];
					else 
						$category.=$separate_category[$l].' ';
				}
				$by_legend=$this->APGetRelatedByLegend($category);
				$legend_array=array();
				if(count($by_legend)>0)
				{
					foreach($by_legend as $key => $legend_data)
					{
						$initial='';
						if(strpos($legend_data['by_legend'],' / '))
							$legend_data['by_legend']=str_replace(' / ',' ',$legend_data['by_legend']);
						if(strpos($legend_data['by_legend'],'-'))
							$legend_data['by_legend']=str_replace('-','',$legend_data['by_legend']);
						if(strpos($legend_data['by_legend'],' '))
						{
							$separate_legend=split(' ',$legend_data['by_legend']);
							for($n=0;$n<count($separate_legend);$n++)
							{
								/*if(strpos($separate_legend[$n],'-'))
								{
									$separate_legend[$n]=str_replace('-','',$separate_legend[$n]);
									$addbrief=substr($separate_legend[$n],0,1);
								}
								else if(strpos($separate_legend[$n],'/'))
								{
									$addbrief='';
								}
								else*/
								$addbrief=substr($separate_legend[$n],0,1);
								$initial.=$addbrief;
							}
						}
						else
							$initial=substr($legend_data['by_legend'],0,1);
						array_push($legend_array,$initial);	
					}
				}	
				$output[band]=$color_arrary;
				$output[notes]=$instruction;
				$output[markerLegend]=$legend_array;
				$selected_load_array=array();
				if(isset($_REQUEST['sh_id']))
				{
					 $load_customnameplate=$this->LoadCustomNameplate();
					 $load_customnameplate_detail=$this->LoadCustomNameplateDetails();
					 if(count($load_customnameplate)>0)
					 {
						  $selected_load_array[productid]=$load_customnameplate[sku_code];
						  $selected_load_array[quantity]=$load_customnameplate[quantity];
						  //$selected_load_array[color]=$load_customnameplate[color];
						  $selected_load_array[special_comment]=$load_customnameplate[comments];			
						  if(count($load_customnameplate_detail)>0)
						  {
							  foreach($load_customnameplate_detail as $key => $detail_data) //actually there is only one record
							  {
								  $text_content=$detail_data['option_value1'];
								  //$band=$detail_data['option_value3'];
								  $compression_rate=$detail_data['compression_rate'];
							  }
						  }
						  $selected_load_array[text_content]=utf8_encode($text_content);
						  $selected_load_array[compression_rate]=$compression_rate;
						  $selected_load_array[waive_maximum]=$load_customnameplate[waiver];
						  $selected_load_array[band]=$load_customnameplate[color];
					 }
				}
				$output[custom_selected]=$selected_load_array;	
			}
			else
			{
				$sku_code=$this->GetcustomSkuCodeNormal();
				if(count($sku_code)>0)
				{
					foreach($sku_code as $key => $sku_data)
					{	
						$text_size=$this->Getcustomnameplate_textSizefromdes($sku_data['sku_code']);
						$textsize_array=array();				
						if(count($text_size)>0)
						{
							foreach($text_size as $key => $textsize_data)
							{
								$textsize=str_replace('"','',$textsize_data['text_size']);
								$textsize_array[$textsize]=$textsize_data['max_chars_upper'];
								$absolute_maximum=$textsize_data['absolute_maximum'];
							}
						}	
						$material_separate=split(' ',$sku_data['material']);
						$band_re=$material_separate[0].' '.$material_separate[1];
						$price=$this->Nameplategetpricedetailsfrommaterial($sku_data['material_code']);
						$price_array=array();
						if(count($price)>0)
						{
							foreach($price as $key => $price_data)
							{	
								$price_array[$price_data['quantity']]=$price_data['price'];	
								$min_quantity=$price_data['min_quantity'];	
							}
						}
						$output[product][$sku_data['sku_code']][sku_id]=$sku_data['sku_id'];
						$output[product][$sku_data['sku_code']][price]=$price_array;
						$output[product][$sku_data['sku_code']][text_size]=$textsize_array;
						$output[product][$sku_data['sku_code']][min_quantity]=$min_quantity;
						$output[product][$sku_data['sku_code']][band]=$band_re;
						$output[product][$sku_data['sku_code']][absolute_max]=$absolute_maximum;
					}
				}
				$color=$this->GetAvailableColorNameplate();
				$color_arrary=array();
				if(count($color)>0)
				{
					foreach($color as $key => $color_data)
					{
						array_push($color_arrary,$color_data['color']);	
					}
				}		
				$output[band]=$color_arrary;
				$output[notes]=$instruction;
				$selected_load_array=array();
				if(isset($_REQUEST['sh_id']))
				{
					 $load_customnameplate=$this->LoadCustomNameplate();
					 $load_customnameplate_detail=$this->LoadCustomNameplateDetails();
					 if(count($load_customnameplate)>0)
					 {
						  $selected_load_array[productid]=$load_customnameplate[sku_code];
						  $selected_load_array[quantity]=$load_customnameplate[quantity];
						  $selected_load_array[band]=$load_customnameplate[color];
						  $selected_load_array[special_comment]=$load_customnameplate[comments];					  
						  if(count($load_customnameplate_detail)>0)
						  {
							  foreach($load_customnameplate_detail as $key => $detail_data) //actually there is only one record
							  {
								  $text_content=$detail_data['option_value1'];
								  $compression_rate=$detail_data['compression_rate'];
							  }
						  }
						  $selected_load_array[text_content]=utf8_encode($text_content);
						  $selected_load_array[compression_rate]=$compression_rate;
						  $selected_load_array[waive_maximum]=$load_customnameplate[waiver];
					 }
				}
				$output[custom_selected]=$selected_load_array;				
			}
		}
		else if($_REQUEST['subcategory']=='Custom Underground Tape')//to be check
		{
			$sku_code=$this->GetcustomSkuCodeNormal();
			if(count($sku_code)>0)
			{
				foreach($sku_code as $key => $sku_data)
				{	
					$text_size=$this->Getcustomnameplate_textSizefromdes($sku_data['sku_code']);
					$textsize_array=array();				
					if(count($text_size)>0)
					{
						foreach($text_size as $key => $textsize_data)
						{
							$textsize=str_replace('"','',$textsize_data['text_size']);
							$textsize_array[$textsize]=$textsize_data['max_chars_upper'];	
						}
					}												
					$price=$this->Nameplategetpricedetailsfrommaterial($sku_data['material_code']);
					$price_array=array();
					$materialcodedata_array=array();
					if(count($price)>0)
					{
						foreach($price as $key => $price_data)
						{	
							$price_array[$price_data['quantity']]=$price_data['price'];					
						}
					}
					$output[product][$sku_data['sku_code']][sku_id]=$sku_data['sku_id'];
					$output[product][$sku_data['sku_code']][price]=$price_array;
					$output[product][$sku_data['sku_code']][size]=$sku_data['material'];//for custom underground it is from material
					$output[product][$sku_data['sku_code']][text_size]=$textsize_array;
				}
			}
			$color=$this->GetAvailableColorNameplate();
			$color_arrary=array();
			if(count($color)>0)
			{
				foreach($color as $key => $color_data)
				{
					array_push($color_arrary,$color_data['color']);	
				}
			}
			/*$separate_category=split(' ',$_REQUEST['subcategory']);
			$category='';
			for ($l=1;$l<count($separate_category);$l++)
			{
				if($l==(count($separate_category)-1))
					$category.=$separate_category[$l];
				else 
					$category.=$separate_category[$l].' ';
			}
			$by_legend=$this->APGetRelatedByLegend($category);
			$legend_array=array();
			if(count($by_legend)>0)
			{
				foreach($by_legend as $key => $legend_data)
				{
					array_push($legend_array,$legend_data['by_legend']);	
				}
			}*/						
			$output[color]=$color_arrary;
			$output[notes]=$instruction;
			//$output[markerLegend]=$legend_array;
			$selected_load_array=array();
			if(isset($_REQUEST['sh_id']))
			{
				 $load_customnameplate=$this->LoadCustomNameplate();
				 $load_customnameplate_detail=$this->LoadCustomNameplateDetails();
				 if(count($load_customnameplate)>0)
				 {
					  $selected_load_array[productid]=$load_customnameplate[sku_code];
					  $selected_load_array[quantity]=$load_customnameplate[quantity];
					  $selected_load_array[color]=$load_customnameplate[color];
					  $selected_load_array[special_comment]=$load_customnameplate[comments];					  
					  if(count($load_customnameplate_detail)>0)
					  {
						  foreach($load_customnameplate_detail as $key => $detail_data) //actually there is only one record
						  {
							  $text_content=$detail_data['option_value1'];
							  $compression_rate=$detail_data['compression_rate'];
						  }
					  }
					  $selected_load_array[text_content]=utf8_encode($text_content);
					  $selected_load_array[compression_rate]=$compression_rate;
				 }
			}
			$output[custom_selected]=$selected_load_array;					
		}
		else//custom voltage markers
		{
			$sku_code=$this->GetcustomSkuCodeNormal();
			if(count($sku_code)>0)
			{
				foreach($sku_code as $key => $sku_data)
				{	
					$text_size=$this->Getcustomnameplate_textSizefromdes($sku_data['sku_code']);
					$textsize_array=array();				
					if(count($text_size)>0)
					{
						foreach($text_size as $key => $textsize_data)
						{
							$textsize=str_replace('"','',$textsize_data['text_size']);
							$textsize_array[$textsize]=$textsize_data['max_chars_upper'];	
							$absolute_maximum=$textsize_data['absolute_maximum'];	
						}
					}												
					$price=$this->Nameplategetpricedetailsfrommaterial($sku_data['material_code']);
					$price_array=array();
					$materialcodedata_array=array();
					if(count($price)>0)
					{
						foreach($price as $key => $price_data)
						{	
							$price_array[$price_data['quantity']]=$price_data['price'];	
							$min_quantity=$price_data['min_quantity'];	
						}
					}
					$output[product][$sku_data['sku_code']][sku_id]=$sku_data['sku_id'];
					$output[product][$sku_data['sku_code']][style]=$sku_data['material'];
					$output[product][$sku_data['sku_code']][price]=$price_array;
					$output[product][$sku_data['sku_code']][size]=$sku_data['size'];
					$output[product][$sku_data['sku_code']][text_size]=$textsize_array;
					$output[product][$sku_data['sku_code']][min_quantity]=$min_quantity;
					$output[product][$sku_data['sku_code']][absolute_max]=$absolute_maximum;
				}
			}
			$separate_category=split(' ',$_REQUEST['subcategory']);
			$category='';
			for ($l=1;$l<count($separate_category);$l++)
			{
				if($l==(count($separate_category)-1))
					$category.=$separate_category[$l];
				else 
					$category.=$separate_category[$l].' ';
			}
			$by_legend=$this->APGetRelatedByLegend($category);
			$legend_array=array();
			if(count($by_legend)>0)
			{
				foreach($by_legend as $key => $legend_data)
				{
					array_push($legend_array,$legend_data['by_legend']);	
				}
			}				
			$output[notes]=$instruction;

			$output[markerLegend]=$legend_array;
			$selected_load_array=array();
			if(isset($_REQUEST['sh_id']))
			{
				 $load_customnameplate=$this->LoadCustomNameplate();
				 $load_customnameplate_detail=$this->LoadCustomNameplateDetails();
				 if(count($load_customnameplate)>0)
				 {
					  $selected_load_array[productid]=$load_customnameplate[sku_code];
					  $selected_load_array[quantity]=$load_customnameplate[quantity];
					  $selected_load_array[special_comment]=$load_customnameplate[comments];					  
					  if(count($load_customnameplate_detail)>0)
					  {
						  foreach($load_customnameplate_detail as $key => $detail_data) //actually there is only one record
						  {
							  $text_content=$detail_data['option_value1'];
							  $compression_rate=$detail_data['compression_rate'];
						  }
					  }
					  $selected_load_array[text_content]=utf8_encode($text_content);
					  $selected_load_array[compression_rate]=$compression_rate;
					  $selected_load_array[waive_maximum]=$load_customnameplate[waiver];
				 }
			}
			$output[custom_selected]=$selected_load_array;								
		}
		$json = json_encode($output);
		echo $json;
	}
	function APGetinstruction($position)
	{
		$sql_textsize="select instruction from pm_custom_products where position='$position' and active='Y'";        		
		$textsize_result=mysql_query($sql_textsize);
		while($skucode_row=mysql_fetch_array($textsize_result))
		{
			$instruction=$skucode_row['instruction'];
		}			
		return $instruction;		
	}
	function APShowInstructions()
	{
		$q=$_GET["q"];
		if($q!='0')
		{
			$instruction=$this->APGetinstruction($q);
			echo $instruction;
		}
	}
	function APcheckdescriptiontablebySkuId($skuidinput)
	{
		  $sql_skucode_list="select sku_id,sku_code,product_number,material_code,material_description,freight_shipping,shoppingcart_image,ab_tape_class,ab_tape,ab_sku_code,ez_arrow_class,ez_arrow,ez_sku_code,addtocart_heading,additional_charge from pm_products_sku_description where sku_id = '$skuidinput' and active='Y'";  
		  //print $sql_skucode_list;
		  $skucode_result=mysql_query($sql_skucode_list);//only one records
		  
		  if(mysql_num_rows($skucode_result)>0)
		  {
			  while($skucode_row=mysql_fetch_array($skucode_result))
			  {
				  $skucodeget[sku_id]=$skucode_row['sku_id'];
				  $skucodeget[product_number]=$skucode_row['product_number'];
				  $skucodeget[sku_code]=$skucode_row['sku_code'];
				  $skucodeget[material_code]=$skucode_row['material_code'];
				  $skucodeget[freight_shipping]=$skucode_row['freight_shipping'];
				  $skucodeget[shoppingcart_image]=$skucode_row['shoppingcart_image'];
				  $skucodeget[material_description]=$skucode_row['material_description'];
				  $skucodeget[ab_tape_class]=$skucode_row['ab_tape_class'];
				  $skucodeget[ab_tape]=$skucode_row['ab_tape'];
				  $skucodeget[ab_sku_code]=$skucode_row['ab_sku_code'];
				  $skucodeget[ez_arrow_class]=$skucode_row['ez_arrow_class'];
				  $skucodeget[ez_arrow]=$skucode_row['ez_arrow'];
				  $skucodeget[ez_sku_code]=$skucode_row['ez_sku_code'];
				  $skucodeget[addtocart_heading]=$skucode_row['addtocart_heading'];
				  $skucodeget[additional_charge]=$skucode_row['additional_charge'];
			  }
		  }
		  return $skucodeget;
	}
	function APcheckdescriptiontablebySkuCode($skucodeinput)
	{
		  $sql_skucode_list="select sku_id,sku_code,product_number,material_code,material_description,freight_shipping,shoppingcart_image,ab_tape_class,ab_tape,ab_sku_code,ez_arrow_class,ez_arrow,ez_sku_code,addtocart_heading,additional_charge from pm_products_sku_description where sku_code = '$skucodeinput' and active='Y'";  
		  //print $sql_skucode_list;
		  $skucode_result=mysql_query($sql_skucode_list);//only one records
		  
		  if(mysql_num_rows($skucode_result)>0)
		  {
			  while($skucode_row=mysql_fetch_array($skucode_result))
			  {
				  $skucodeget[sku_id]=$skucode_row['sku_id'];
				  $skucodeget[product_number]=$skucode_row['product_number'];
				  $skucodeget[sku_code]=$skucode_row['sku_code'];
				  $skucodeget[material_code]=$skucode_row['material_code'];
				  $skucodeget[freight_shipping]=$skucode_row['freight_shipping'];
				  $skucodeget[shoppingcart_image]=$skucode_row['shoppingcart_image'];
				  $skucodeget[material_description]=$skucode_row['material_description'];
				  $skucodeget[ab_tape_class]=$skucode_row['ab_tape_class'];
				  $skucodeget[ab_tape]=$skucode_row['ab_tape'];
				  $skucodeget[ab_sku_code]=$skucode_row['ab_sku_code'];
				  $skucodeget[ez_arrow_class]=$skucode_row['ez_arrow_class'];
				  $skucodeget[ez_arrow]=$skucode_row['ez_arrow'];
				  $skucodeget[ez_sku_code]=$skucode_row['ez_sku_code'];
				  $skucodeget[addtocart_heading]=$skucode_row['addtocart_heading'];
				  $skucodeget[additional_charge]=$skucode_row['additional_charge'];
			  }
		  }
		  return $skucodeget;
	}	
	function APGetCustomProductSize($sku_code)
	{
		  $sql_skucode_list="select size from pm_products_sku_description where sku_code = '$sku_code' and active='Y'";  
		  //print $sql_skucode_list;
		  $skucode_result=mysql_query($sql_skucode_list);//only one records
		  
		  if(mysql_num_rows($skucode_result)>0)
		  {
			  while($skucode_row=mysql_fetch_array($skucode_result))
			  {
				  $sizeget=$skucode_row['size'];
			  }
		  }
		  $sizeget=str_replace('"','',$sizeget);

		  $sizeget=str_replace(' ','',$sizeget);
		  return $sizeget;		
	}
	function APgetrepresentIDbySize($size)
	{
		  $sql_skucode_list="select sku_code,material_description from pm_products_sku_description where size = '$size' and active='Y' and product_number='".$_REQUEST['productno']."'";  
		  $skucode_result=mysql_query($sql_skucode_list);//only one records
		  $i=0;
		  while($skucode_row=mysql_fetch_array($skucode_result))
		  {
			  $material_des=$skucode_row['material_description'];
			  $thickness_sepa=split('"',$material_des);
			  $thickness=$thickness_sepa[0];
			  $skucode[$i][thickness]=$thickness;
			  $skucode[$i][sku_code]=$skucode_row['sku_code'];
			  $i++;		  
		  }
		  if($i>1)//order by thickness value
		  {
			  for($c=0;$c<$i;$c++)			
			  {
				  $sepa_thickness=split('/',$skucode[$c][thickness]);
				  $numerator=(int)$sepa_thickness[0];
				  $denominator=(int)$sepa_thickness[1];
				  $thickness_value[$c]==$numerator/$denominator;
			  }
			  if($thickness_value[0]>$thickness_value[1])
				  $representID=$skucode[1][sku_code];		
			  else
			  	  $representID=$skucode[0][sku_code];		
		  }
		  else
			  $representID=$skucode[0][sku_code];		
		  return $representID;		
	}	
	function GetcustomstencilSkuCodefromdes_templatepage_bymaterial()
	{
		$sql_skucode="select sku_code,material from pm_products_sku_description where product_number='".$_REQUEST['productno']."' and active='Y' group by material order by position asc";
		$skucode_result=mysql_query($sql_skucode);
		//print $sql_skucode;
		while($skucode_row=mysql_fetch_array($skucode_result))
		{
			$skucode[]=$skucode_row;
		}
		return $skucode;	
	}
	function Getcustomstencils_textSizefromdes($sku_code)
	{
		$sql_textsize_detail="select size from pm_products_sku_description where sku_code='$sku_code' and active='Y' group by size order by position";
		$textsize_result=mysql_query($sql_textsize_detail);
		while($textsize_row=mysql_fetch_array($textsize_result))
		{
			$textsize[]=$textsize_row;
		}		
		return $textsize;			
	}
	function StencilsGetmaterialcode_by_material($material)
	{
		$sql_textsize_detail="select sku_code,sku_id,material_code,size from pm_products_sku_description where material='$material' and active='Y' group by size order by position";
		//print $sql_textsize_detail;
		$textsize_result=mysql_query($sql_textsize_detail);
		while($textsize_row=mysql_fetch_array($textsize_result))
		{
			$textsize[]=$textsize_row;
		}		
		return $textsize;		
	}
	function APgetrepresentIDbyMaterial($material)
	{
		  $sql_skucode_list="select sku_code from pm_products_sku_description where material = '$material' and active='Y' and product_number='".$_REQUEST['productno']."' order by position";  
		  $skucode_result=mysql_query($sql_skucode_list);//only one records
		  while($skucode_row=mysql_fetch_array($skucode_result))
		  {
			  $representID=$skucode_row['sku_code'];
			  break;		  
		  }		
		  return $representID;		
	}
	function GetcustomSkuCodeNormal()
	{
		$sql_skucode="select sku_code,sku_id,material_code,size,material from pm_products_sku_description where product_number='".$_REQUEST['productno']."' and active='Y' group by material order by position asc";
		$skucode_result=mysql_query($sql_skucode);
		//print $sql_skucode;
		while($skucode_row=mysql_fetch_array($skucode_result))
		{
			$skucode[]=$skucode_row;
		}
		return $skucode;	
	}
	function AP_GetCustomProductInstruction($product_number)
	{
		$sql_skucode="select product_description from pm_products_description where product_number='$product_number' and active='Y'";
		$skucode_result=mysql_query($sql_skucode);
		//print $sql_skucode;
		while($skucode_row=mysql_fetch_array($skucode_result))
		{
			$instruction=$skucode_row['product_description'];
		}
		return $instruction;			
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
	function APGetSearchCustomColorImage($product_no,$sku_code,$color)
	{
	$sql_custom_image="select custom_image from pm_product_custom_color_images 
	where product_number='".mysql_real_escape_string($product_no)."' and
	sku_code='".mysql_real_escape_string($sku_code)."' and
	color='".mysql_real_escape_string($color)."'";
	//print $sql_custom_image;
	$custom_result=mysql_query($sql_custom_image);
	$custom_image_new=mysql_fetch_array($custom_result);
	$custom_image=$custom_image_new[custom_image];
	return $custom_image;
	}
	function APgetParametersone($product_number,$color)
	{
		$sql_skucode="select parameters_one from pm_product_custom_color where product_number='$product_number' and color='$color' and active='Y'";
		$skucode_result=mysql_query($sql_skucode);
		//print $sql_skucode;
		while($skucode_row=mysql_fetch_array($skucode_result))
		{
			$parameters_one=$skucode_row['parameters_one'];
		}
		return $parameters_one;			
	}
	function APGetRelatedByLegend($category)
	{
		$sql_skucode="select by_legend from pm_products where category_name='$category' and active='Y' group by by_legend order by position";
		$skucode_result=mysql_query($sql_skucode);
		//print $sql_skucode;
		while($skucode_row=mysql_fetch_array($skucode_result))
		{
			$by_legend[]=$skucode_row;
		}
		return $by_legend;			
	}
	function ResetCustomerListDiscountNew()
	{
		$ObjShoppingCard=new BS_ShoppingCard();
		$shopping_card=$ObjShoppingCard->ShoppingCardList();
		foreach($shopping_card as $key => $values) 
		{ 
			$ObjShoppingCard->ResetCustomerListDiscountByID($values[price],$values[total],$values[id]);
		}//end foreach loop
	}
	function APupdateshopppingcartrecords($updateid,$updateids_materialcode,$updateids_addcharge,$updateids_quantity,$addquantity)
	{
		$quantitytype=$this->APquantitytypefromprice($updateids_materialcode);		
		$i=0;	
		$quantitycount=count($quantitytype);
		if($quantitycount>0)
		{
			foreach($quantitytype as $key => $quantitytype_data)
			{	
				$quantitygroup[$i] = $quantitytype_data['quantity'];		
				$pricegroup[$i]= $quantitytype_data['price'];
				$min_quantity_charge = $quantitytype_data['min_quantity_charge'];
				$min_quantity_below = $quantitytype_data['min_quantity_below'];
				$i++;
			}	
		}
		$k=0;
		while($k<$quantitycount)
		{
			if($addquantity>=$quantitygroup[$k]&&$addquantity<$quantitygroup[$k+1])
			{
				break;
			}
			$k++;
		}
		if($k==$quantitycount)	
			$k=$k-1;
			
		$quantity=$quantitygroup[$k];
		
		if($_SESSION[user_type]=='R')
		{
			$currentprice=$pricegroup[$k]*(100-$_SESSION['discount_data'])/100;
			$list_price=$pricegroup[$k];			
		}
		else
		{
			$currentprice=$pricegroup[$k];
			$list_price=$pricegroup[0];
		}
		$displaylistprice=$this->numberround($list_price,2);
		if($min_quantity_below&&($updateids_quantity<$min_quantity_below))
			$listtotal=$displaylistprice*$updateids_quantity+$min_quantity_charge+$updateids_addcharge;//to be check 0
		else
			$listtotal=$displaylistprice*$updateids_quantity+$updateids_addcharge;		
		$currentprice=$this->numberround($currentprice,4);
		$displayprice=$this->numberround($currentprice,2);
		if($min_quantity_below&&($updateids_quantity<$min_quantity_below))			
			$new_total=$displayprice*$updateids_quantity+$min_quantity_charge+$updateids_addcharge;						
		else			
			$new_total=$displayprice*$updateids_quantity+$updateids_addcharge;								
		if($_SESSION[user_type]=='R')
			$sql_update_shoppingcart="update pm_shopping_cart set price=".$list_price.",total=".$listtotal.",customer_price=".$list_price.",customer_total=".$listtotal.",new_price=".$currentprice.",new_total=".$new_total." where id=$updateid";
		else
			$sql_update_shoppingcart="update pm_shopping_cart set total=".$listtotal.",new_price=".$currentprice.",new_total=".$new_total." where id=$updateid";
		//print $sql_update_shoppingcart;
		mysql_query($sql_update_shoppingcart);
	}
	function uploadcustomfile()
	{
		$message="";
		$previous_file=$_REQUEST['previousfilename'];
		$previous_file_ID=$_REQUEST['previousfileid'];
		$filetype=$_FILES["importcustomfile"]["type"];	
		$filename=$_FILES['importcustomfile']['name'];
		$filesize=$_FILES["importcustomfile"]["size"];
		//$extension = substr($filename, strpos($filename,'.'), strlen($filename)-1);
		$extension=end(explode(".",strtolower($filename)));
		$uploadFilePath='upload/'.$filename;		
		if($filename=='')
			$message= $previous_file_ID.'|  Please select a file.|'.$previous_file;
		else if($extension!='csv'&&$extension!='pdf'&&$extension!='doc'&&$extension!='docx'&&$extension!='xlsx'&&$extension!='xls')
		/*else if($filetype!='application/vnd.ms-excel'&&$filetype!='text/csv'&&$filetype!='application/pdf'&&$filetype!='application/vnd.openxmlformats-officedocument.wordprocessingml.document'&&$filetype!='application/msword')*/
			$message= $previous_file_ID.'|  Only excel,word,pdf,and csv files are allowed.|'.$previous_file;
		else
		{
			if (file_exists($uploadFilePath))
			{
			   $typelength=strlen($extension)+1;
			   $purefilename=substr($filename,0,-$typelength);
			   $random_digit=rand(0000,9999);
			   $filename=$purefilename.$random_digit.date('Ynjhis').".".$extension;
			   $uploadFilePath='upload/'.$filename;
			}	
			copy($_FILES['importcustomfile']['tmp_name'], $uploadFilePath);	
			$username=$this->GetCustomerUsername();
			$sql_import_file="insert into pm_customer_file_upload(customer_id,username,file_name,file_size,file_type,export_brimar,create_date) values('$_SESSION[CID]','$username','$filename','$filesize','$filetype','0',NOW())";
			mysql_query($sql_import_file);
			$ID = mysql_insert_id();
			$message= $ID.'|  Your file is uploaded.|'.$filename;
		}
		return $message;
	}
	function GetCustomerUsername()
	{
		$get_username="";
		$sql_username="select username from pm_customers where customers_id='$_SESSION[CID]'";
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
		$sh_id=$_REQUEST['sh_id'];
		$fileatpath='../upload/'.$filename;
		if($sh_id=='Insert')
			$sql_delete="delete from pm_customer_file_upload where id='$fileid' and s_id=''";	
		else
			$sql_delete="delete from pm_customer_file_upload where id='$fileid'";
		mysql_query($sql_delete);
		$needunlink=$this->check_need_unlink($filename);
		if($needunlink=='Y')
			unlink($fileatpath);
	}
	function check_need_unlink($filename)
	{
		$needunlink='Y';
		$check_file_use_sql="select s_id from pm_customer_file_upload where file_name='$filename'";
		$check_file_result=mysql_query($check_file_use_sql);
		while($check_file_row=mysql_fetch_array($check_file_result))
		{
			if($check_file_row['s_id']!="")
			{
				$needunlink="N";
				return $needunlink;
			}
		}
		return $needunlink;
	}
	function GetCustomFileName($shoppingcartid)
	{
		$filename[id]="";
		$filename[file_name]="";
		if(isset($_REQUEST['sh_id']))
			$shid=$_REQUEST['sh_id'];
		else
			$shid=$shoppingcartid;
		$sql_username="select id,file_name from pm_customer_file_upload where s_id='$shid'";
		$username_result=mysql_query($sql_username);
		while($username_row=mysql_fetch_array($username_result))
		{
			$filename[id]=$username_row['id'];
			$filename[file_name]=$username_row['file_name'];
		}
		return $filename;
	}
}
?>
