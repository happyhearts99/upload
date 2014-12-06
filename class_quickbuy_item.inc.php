<?php 

class QuickBuyItem
{
	function checkskucodedropdown($sh)//need to modify
	{	
		if($sh=='header')
		{
			$sql_productnumber_list="select s.product_number from pm_products_sku_description s,pm_products p where s.sku_code like '%".mysql_real_escape_string($_REQUEST['quickorder-item-number'])."%' and s.active='Y' and p.active='Y' and p.stock_custom='S' and s.product_number=p.product_number group by s.sku_code order by s.sku_id";
		}
		else
		{
			$sql_productnumber_list="select s.product_number from pm_products_sku_description s,pm_products p where s.sku_code like '%".mysql_real_escape_string($_REQUEST['quickorder-item-number_sh'])."%' and s.active='Y' and p.active='Y' and p.stock_custom='S' and s.product_number=p.product_number group by s.sku_code order by s.sku_id";
		}
		 //$sql_productnumber_list="select product_number from pm_products_sku_description where sku_code like '$_REQUEST[itemskucode]%'";  		
		//print $sql_productnumber_list;
		$productnumber_result=mysql_query($sql_productnumber_list);
		while($productnumber_row=mysql_fetch_array($productnumber_result))
		{
			$productnumber[]=$productnumber_row;
		}
		//print count($productnumber)."ppp";
		if(count($productnumber)!=0)
		{
			  foreach($productnumber as $key => $product_data)
			  {
				  $productnumberlist[0]= $product_data['product_number'];
				  break;
			  }
			  $product=$this->checkproductlist($productnumberlist[0]);			  
		}
		else
		{
			if($sh=='header')
			{
				$sql_productnumber_list_legent="select s.product_number from pm_products_sku_description s,pm_products p where s.search_by_legend like '%".mysql_real_escape_string($_REQUEST['quickorder-item-number'])."%' and s.active='Y' and p.active='Y' and p.stock_custom='S' and s.product_number=p.product_number group by s.sku_code order by s.sku_id";
			}
			else
			{
				$sql_productnumber_list_legent="select s.product_number from pm_products_sku_description s,pm_products p where s.search_by_legend like '%".mysql_real_escape_string($_REQUEST['quickorder-item-number_sh'])."%' and s.active='Y' and p.active='Y' and p.stock_custom='S' and s.product_number=p.product_number group by s.sku_code order by s.sku_id";
			}
			$productnumber_legend_result=mysql_query($sql_productnumber_list_legent);
			while($productnumber_legend_row=mysql_fetch_array($productnumber_legend_result))
			{
				$productnumber_legend[]=$productnumber_legend_row;
			}			
			if(count($productnumber_legend)!=0)
			{
				  foreach($productnumber_legend as $key => $product_legend_data)
				  {
					  $productnumber_legendlist[0]= $product_legend_data['product_number'];
					  break;
				  }
				  $product=$this->checkproductlist($productnumber_legendlist[0]);			  
			}
			else
				$product=array();
		}
  		return $product;
	}
	function checkproductlist($product_number)
	{
		$sql_product_list="select products_id,product_number,category_name,subcategory_name from pm_products where product_number='".$product_number."' order by products_id asc";
		$product_result=mysql_query($sql_product_list);
		while($product_row=mysql_fetch_array($product_result))
		{
		   $product[]=$product_row;
		   break;
		}		
		return $product;
	}
	function checkdescriptiontable($sh)
	{
		  if($sh=='header')
			  $sql_skucode_list="select sku_id,sku_code,product_number,material_code,material_description,freight_shipping,shoppingcart_image,ab_tape_class,ab_tape,ab_sku_code,ez_arrow_class,ez_arrow,ez_sku_code,additional_charge from pm_products_sku_description where sku_code = '".mysql_real_escape_string($_REQUEST['quickorder-item-number'])."' and active='Y'";
		  else
		  	$sql_skucode_list="select sku_id,sku_code,product_number,material_code,material_description,freight_shipping,shoppingcart_image,ab_tape_class,ab_tape,ab_sku_code,ez_arrow_class,ez_arrow,ez_sku_code from pm_products_sku_description where sku_code = '".mysql_real_escape_string($_REQUEST['quickorder-item-number_sh'])."' and active='Y'";
		  //print $sql_skucode_list;
		  $skucode_result=mysql_query($sql_skucode_list);
		  
		  if(mysql_num_rows($skucode_result)>0)
		  {
			  while($skucode_row=mysql_fetch_array($skucode_result))
			  {
				  $skucode[sku_id]=$skucode_row['sku_id'];
				  $skucode[product_number]=$skucode_row['product_number'];
				  $skucode[sku_code]=$skucode_row['sku_code'];
				  $skucode[material_code]=$skucode_row['material_code'];
				  $skucode[freight_shipping]=$skucode_row['freight_shipping'];
				  $skucode[shoppingcart_image]=$skucode_row['shoppingcart_image'];
				  $skucode[material_description]=$skucode_row['material_description'];
				  $skucode[ab_tape_class]=$skucode_row['ab_tape_class'];
				  $skucode[ab_tape]=$skucode_row['ab_tape'];
				  $skucode[ab_sku_code]=$skucode_row['ab_sku_code'];
				  $skucode[ez_arrow_class]=$skucode_row['ez_arrow_class'];
				  $skucode[ez_arrow]=$skucode_row['ez_arrow'];
				  $skucode[ez_sku_code]=$skucode_row['ez_sku_code'];
				  $skucode[additional_charge]=$skucode_row['additional_charge'];//to be check
				  $skucode[selectdropdownlist]=1;
			  }
		  }
		  else
		  {
			  if($sh=='header')
				  $sql_partcheck_list="select sku_id,sku_code,product_number,material_code,material_description,freight_shipping,shoppingcart_image,ab_tape_class,ab_tape,ab_sku_code,ez_arrow_class,ez_arrow,ez_sku_code from pm_products_sku_description where (sku_code like '%".mysql_real_escape_string($_REQUEST['quickorder-item-number'])."%' or search_by_legend like '".mysql_real_escape_string($_REQUEST['quickorder-item-number'])."%') and active='Y'";  
			  else
				  $sql_partcheck_list="select sku_id,sku_code,product_number,material_code,material_description,freight_shipping,shoppingcart_image,ab_tape_class,ab_tape,ab_sku_code,ez_arrow_class,ez_arrow,ez_sku_code from pm_products_sku_description where (sku_code like '%".mysql_real_escape_string($_REQUEST['quickorder-item-number_sh'])."%' or search_by_legend like '".mysql_real_escape_string($_REQUEST['quickorder-item-number_sh'])."%') and active='Y'";   
			  $part_result=mysql_query($sql_partcheck_list);
			  while($skucode_row=mysql_fetch_array($part_result))
			  {
				  $skucode[sku_id]=$skucode_row['sku_id'];
				  $skucode[product_number]=$skucode_row['product_number'];
				  $skucode[sku_code]=$skucode_row['sku_code'];
				  $skucode[material_code]=$skucode_row['material_code'];				  
				  $skucode[freight_shipping]=$skucode_row['freight_shipping'];
				  $skucode[shoppingcart_image]=$skucode_row['shoppingcart_image'];
				  $skucode[material_description]=$skucode_row['material_description'];
				  $skucode[ab_tape_class]=$skucode_row['ab_tape_class'];
				  $skucode[ab_tape]=$skucode_row['ab_tape'];
				  $skucode[ab_sku_code]=$skucode_row['ab_sku_code'];
				  $skucode[ez_arrow_class]=$skucode_row['ez_arrow_class'];
				  $skucode[ez_arrow]=$skucode_row['ez_arrow'];
				  $skucode[ez_sku_code]=$skucode_row['ez_sku_code'];
				  $skucode[additional_charge]=$skucode_row['additional_charge'];
				  $skucode[selectdropdownlist]=0;
			  }			  
		  }	  
		  return $skucode;
	}
	function addtocartcheckexact($sh)
	{
		if($sh=='header')
			$sql_productnumber_list="select product_number from pm_products_sku_description where sku_code= '".mysql_real_escape_string($_REQUEST['quickorder-item-number'])."' and active='Y'"; 
		else
			$sql_productnumber_list="select product_number from pm_products_sku_description where sku_code= '".mysql_real_escape_string($_REQUEST['quickorder-item-number_sh'])."' and active='Y'"; 
		//print $sql_productnumber_list;
		$productnumber_result=mysql_query($sql_productnumber_list);
		while($productnumber_row=mysql_fetch_array($productnumber_result))
		{
			$productnumber[product_number]=$productnumber_row['product_number'];
		}		
		return $productnumber[product_number];		
	}
	function checkfromproducttoinsert($product_number)
	{
		$sql_product_list="select products_id,stock_custom,product_number,ez_pipe_markers,background_color from pm_products where product_number='".$product_number."' LIMIT 0, 1";
	   	 // print $sql_product_list;
		 $product_result=mysql_query($sql_product_list);
		  while($product_row=mysql_fetch_array($product_result))
		  {
			  $product[products_id]=$product_row['products_id'];
			  $product[stock_custom]=$product_row['stock_custom'];
			  $product[product_number]=$product_row['product_number'];
			  $product[ez_pipe_markers]=$product_row['ez_pipe_markers'];
			  $product[background_color]=$product_row['background_color'];
		  }
		  return $product;
	}
	function quantitytypefromprice($material_code)
	{
		if($_SESSION[user_type]=='R')
			$sql_pricequantitytype_list="select producttype,quantity, price from pm_products_price where material_code='$material_code' and user_type='$_SESSION[user_type]' and rep_special='$_SESSION[rep_special]' and active='Y' group by quantity";
		else
		    $sql_pricequantitytype_list="select producttype,quantity, price from pm_products_price where material_code='$material_code' and user_type='$_SESSION[user_type]' and active='Y' group by quantity";
		  //print $sql_pricequantitytype_list;
		  $pricequantitytype_result=mysql_query($sql_pricequantitytype_list);
		  while($quantitytype_row=mysql_fetch_array($pricequantitytype_result))
		  {
			  $quantitytype[]=$quantitytype_row;
		  }
		  return $quantitytype;
	}
	function getinfofromprice($material_code,$quantity)
	{
		if($_SESSION[user_type]=='R')
		   $sql_price_list="select user_type,price,producttype,weight,dim_weight,dim_charges from pm_products_price where material_code='$material_code' and user_type='$_SESSION[user_type]' and rep_special='$_SESSION[rep_special]' and quantity=$quantity and active='Y'";
		else
			$sql_price_list="select user_type,price,producttype,weight,dim_weight,dim_charges from pm_products_price where material_code='$material_code' and user_type='$_SESSION[user_type]' and quantity=$quantity and active='Y'";
		 // print $sql_price_list;
			$price_result=mysql_query($sql_price_list);
			while($price_row=mysql_fetch_array($price_result))
			{					  
				if($_SESSION[user_type]=='R')
				{
					$price[price]=$price_row['price']*(100-$_SESSION['discount_data'])/100;
					//$price[price]=$price_row['price']*0.7;
				}
				else
				{
					$price[price]=$price_row['price'];
				}
				$price[producttype]=$price_row['producttype'];
				$price[weight]=$price_row['weight'];
				$price[dim_weight]=$price_row['dim_weight'];
				$price[dim_charges]=$price_row['dim_charges'];
			}
			return $price;
	}
	function insertintoshoppingcart($product,$skucode,$price,$last_price,$totalprice,$last_total,$quantityfrompage)
	{
		$weight=$price[weight]*$quantityfrompage;
		$pkgs=$price[number_pkgs]*$quantityfrompage;
		$dimcharges=$price[dim_charges]*$quantityfrompage;				
		if($product[ez_pipe_markers]=='Y')
		  {
			$sql_insert_shoppingcart="insert into pm_shopping_cart(customers_id,session_id,user_type,producttype,products_id,stock_custom,attributes_id,background_color,sku_id,sku_code,sku_name,shoppingcart_image,price,new_price,total,new_total,customer_price,customer_total,ez_pipe_markers,ab_tape_sku_id,ab_tape_class,ab_tape,ab_tape_status,ez_arrow_sku_id,ez_arrow_class,ez_arrow,ez_arrow_status,freight_shipping,weight,number_pkgs,dim_weight,dim_charges,quantity,ip,created_date,last_modified) values('$_SESSION[CID]','".mysql_real_escape_string(session_id())."','$_SESSION[user_type]','$price[producttype]','$product[products_id]','$product[stock_custom]','$skucode[material_code]','$product[background_color]','$skucode[sku_id]','$skucode[sku_code]','$skucode[material_description]','$skucode[shoppingcart_image]',$last_price,$price[price],$last_total,$totalprice,$last_price,$last_total,'Y','$skucode[ab_sku_code]','$skucode[ab_tape_class]','$skucode[ab_tape]','Y','$skucode[ez_sku_code]','$skucode[ez_arrow_class]','$skucode[ez_arrow]','Y','$skucode[freight_shipping]','$weight','$pkgs','$price[dim_weight]','$dimcharges',".mysql_real_escape_string($quantityfrompage).",'".$_SERVER['REMOTE_ADDR']."',NOW(),NOW())";
		  }
		  else
		  {
			$sql_insert_shoppingcart="insert into pm_shopping_cart(customers_id,session_id,user_type,producttype,products_id,stock_custom,attributes_id,background_color,sku_id,sku_code,sku_name,shoppingcart_image,price,new_price,total,new_total,customer_price,customer_total,freight_shipping,weight,number_pkgs,dim_weight,dim_charges,quantity,ip,created_date,last_modified) values('$_SESSION[CID]','".mysql_real_escape_string(session_id())."','$_SESSION[user_type]','$price[producttype]','$product[products_id]','$product[stock_custom]','$skucode[material_code]','$product[background_color]','$skucode[sku_id]','$skucode[sku_code]','$skucode[material_description]','$skucode[shoppingcart_image]',$last_price,$price[price],$last_total,$totalprice,$last_price,$last_total,'$skucode[freight_shipping]','$weight','$pkgs','$price[dim_weight]','$dimcharges',".mysql_real_escape_string($quantityfrompage).",'".$_SERVER['REMOTE_ADDR']."',NOW(),NOW())";	
		  }		  
		  //print $sql_insert_shoppingcart;
		  mysql_query($sql_insert_shoppingcart);
			if($_SESSION[user_type]=='R')
				$this->ResetCustomerListDiscountNew();		  
	}
	function updateshopppingcartrecords($updateid,$updateids_materialcode,$updateids_quantity,$addquantity)
	{
		$quantitytype=$this->quantitytypefromprice($updateids_materialcode);		
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
			//$currentprice=0.7*$pricegroup[$k];
			$list_price=$pricegroup[$k];
			//$list_price=$this->numberround($list_price,4);			
			$displaylistprice=$this->numberround($list_price,2);	
			$listtotal=$displaylistprice*$updateids_quantity;							
		}
		else
		{
			$currentprice=$pricegroup[$k];
			//$list_price=$pricegroup[0];
		}
		$currentprice=$this->numberround($currentprice,4);
		$displayprice=$this->numberround($currentprice,2);
		$new_total=$displayprice*$updateids_quantity;
		if($_SESSION[user_type]=='R')
			$sql_update_shoppingcart="update pm_shopping_cart set price=".$list_price.",total=".$listtotal.",customer_price=".$list_price.",customer_total=".$listtotal.",new_price=".$currentprice.",new_total=".$new_total." where id=$updateid";
		else
			$sql_update_shoppingcart="update pm_shopping_cart set new_price=".$currentprice.",new_total=".$new_total." where id=$updateid";
		//print $sql_update_shoppingcart;
		mysql_query($sql_update_shoppingcart);
	}
	function checkshoppingcartfromsession()
	{
			$sql_shoppingcart_list="select id,quantity,attributes_id,producttype from pm_shopping_cart where user_type='$_SESSION[user_type]' and session_id='".mysql_real_escape_string(session_id())."' and shopping_save='N'";
				//print $sql_shoppingcart_list;
			$shoppingcart_result=mysql_query($sql_shoppingcart_list);
			while($shoppingcart_row=mysql_fetch_array($shoppingcart_result))
			{
			   $shoppingcartinfo[]=$shoppingcart_row;
			}	
			return $shoppingcartinfo;
	}
	function AddToCart($sh)
	{
		  $exactselect=$this->addtocartcheckexact($sh);
		  if(count($exactselect)!=0)
		  	  $product=$this->checkproductlist($exactselect);
		  else
			  $product=$this->checkskucodedropdown($sh);	//choose the first row shown on the drop down list		  
		  return $product;			
	}
	function AddToShoppingCart($sh)
	{
		$skucode=$this->checkdescriptiontable($sh);		  
		if(count($skucode)==0)
		{
			$product='NoMatch';
		}
		else  
		{
			if($skucode[selectdropdownlist]==0)
			{
				$product='PleaseSelect';
		    }
			else 
			{
				$product=$this->checkfromproducttoinsert($skucode[product_number]);
	
				$quantitytype=$this->quantitytypefromprice($skucode[material_code]);
				
				$i=0;
				
				$quantitycount=count($quantitytype);
				if($quantitycount>0)
				{
					foreach($quantitytype as $key => $quantitytype_data)
					{	
						$quantitygroup[$i]=$quantitytype_data['quantity'];
						
						$pricegroup[$i]=$quantitytype_data['price'];
						$producttype=$quantitytype_data['producttype'];
						$i++;
					}	
				}
				$shoppingcartinfo=$this->checkshoppingcartfromsession();
				/*$sql_shoppingcart_list="select id,quantity,attributes_id from pm_shopping_cart where session_id='".mysql_real_escape_string(session_id())."'";
				//print $sql_shoppingcart_list;
				$shoppingcart_result=mysql_query($sql_shoppingcart_list);
				while($shoppingcart_row=mysql_fetch_array($shoppingcart_result))
				{
				   $shoppingcartinfo[]=$shoppingcart_row;
				}*/
				if($sh=='header')
					$quantityfrompage=$_REQUEST['quickorder-quanity'];
				else
					$quantityfrompage=$_REQUEST['quickorder-quanity_sh'];
				$addquantity=$quantityfrompage;
				$j=0;
				$updateid=array();
				$updateids_materialcode=array();
				$updateids_quantity=array();
				if(count($shoppingcartinfo)>0)
				{
					foreach($shoppingcartinfo as $key => $shoppingcart_data)
					{
						$id_shopping[$j]=$shoppingcart_data['id'];
						$quantity_shopping[$j]=$shoppingcart_data['quantity'];
						$producttype_shopping[$j]=$shoppingcart_data['producttype'];
						$materialcode_shopping[$j]=$shoppingcart_data['attributes_id'];
						//print $quantity_shopping[$j].";;;";
						if($producttype==$producttype_shopping[$j])
						{
							$addquantity=$addquantity+$quantity_shopping[$j];	
							//print 'totalnumber'.$addquantity;
							array_push($updateid,$id_shopping[$j]);	
							array_push($updateids_materialcode,$materialcode_shopping[$j]);
							array_push($updateids_quantity,$quantity_shopping[$j]);	
						}
						$j++;
					}			
				}
				if($addquantity<$quantitygroup[0])
				{
					$product=$quantitygroup[0];
				}
				else
				{ 
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
						//$currentprice=0.7*$pricegroup[$k];
						$list_price=$pricegroup[$k];
					}
					else
					{
						//$currentprice=$pricegroup[$k];
						$list_price=$pricegroup[0];
					}
					//$currentprice=$this->numberround($currentpric,4);
					$list_price=$this->numberround($list_price,4);
					$price = $this->getinfofromprice($skucode[material_code],$quantity);
					$price[price]=$this->numberround($price[price],4);
					$displayprice=$this->numberround($price[price],2);
					$displaylistprice=$this->numberround($list_price,2);					
					$list_total=$displaylistprice*$quantityfrompage;
					$totalprice=$displayprice*$quantityfrompage;				
					$this->insertintoshoppingcart($product,$skucode,$price,$list_price,$totalprice,$list_total,$quantityfrompage);
					$product="OK";
				}
				$updateamount=count($updateid);
				if($updateamount>0)
				{
					for($w=0;$w<$updateamount;$w++)
					{
						$this->updateshopppingcartrecords($updateid[$w],$updateids_materialcode[$w],$updateids_quantity[$w],$addquantity);
					}
				}
			}
		}
		return $product;	
	}
	function getskucodeinfolist($q)
	{
		  $q=str_replace('_','[_]',$q);
		  $q=str_replace('%','[%]',$q);		
		  $sql_skucode_list="select s.sku_code,s.search_by_legend,s.search_by_image from pm_products_sku_description s,pm_products p where s.sku_code like '%".mysql_real_escape_string($q)."%' and s.active='Y' and p.active='Y' and p.product_number=s.product_number and p.stock_custom='S' group by s.sku_code order by s.sku_id";
		  //print $sql_skucode_list;
		  $skucode_result=mysql_query($sql_skucode_list);		  
		  while($skucode_row=mysql_fetch_array($skucode_result))
		  {
			  $skucode[]=$skucode_row;
		  }	
		  return $skucode;
	}
	function getskucodesearchbylegend($q)
	{
		  $q=str_replace('_','[_]',$q);
		  $q=str_replace('%','[%]',$q);				
		  $sql_legend_list="select s.sku_code,s.search_by_legend,s.search_by_image from pm_products_sku_description s,pm_products p where s.search_by_legend like '%$q%' and s.active='Y' and p.active='Y' and s.product_number=p.product_number and p.stock_custom='S' group by s.sku_code order by s.sku_id";  
		  $legend_result=mysql_query($sql_legend_list);
		  
		  //print  $sql_legend_list;
		  while($legend_row=mysql_fetch_array($legend_result))
		  {
			  $legend[]=$legend_row;
		  }	
		  return $legend;
	}
	function processquickbuyitemtextinput()
	{
		$q=$_GET["q"];
		$sh=$_GET["sh"];
		if($q!='')
		{
			if($sh=='header')
			{
				$produce_class='selectedautoropdownlist';
				$produce_id='chosendropdownlist';
			}
			else
			{
				$produce_class='selectedautoropdownlist_sh';
				$produce_id='chosendropdownlistsh';
			}
			/*$q=str_replace('_','[_]',$q);
			$q=str_replace('%','[%]',$q);
				  $sql_skucode_list="select sku_code,search_by_legend,search_by_image from pm_products_sku_description where sku_code like '%".mysql_real_escape_string($q)."%'";  
			
				  $skucode_result=mysql_query($sql_skucode_list);
				  
				  while($skucode_row=mysql_fetch_array($skucode_result))
				  {
					  $skucode[]=$skucode_row;
				  }*/
				  $skucode=$this->getskucodeinfolist($q);
				  $countrow=count($skucode);
		
				  if($countrow>0)
				  {		
					$searchresult="<p id='searchresults'>"; 
					$i=0;					
					foreach($skucode as $key => $skucode_data)
					{
						$i++;
						//$image=PathImgProductSkuSearch.$skucode_data['search_by_image'];
						$image=WebSite.PathImgProductSkuSearch.$skucode_data['search_by_image'];
						//$existspath='../'.$image;
						/*list($width, $height) = getimagesize($image);
						if($height>22)
						{
							$new_height=22;
							$new_width=$width*22/$height;
							if($new_width>90)
							{
								$pre_new_width=$new_width;
								$new_width=90;
								$new_height=$new_height*90/$pre_new_width;
							}
						}
						else if($width>90)
						{
							$new_width=90;
							$new_height=$height*90/$width;					
						}
						else 
						{
							$new_height=$height;
							$new_width=$width;					
						}*/
						//if($skucode_data['search_by_image']!='')
						{
							//if(file_exists($existspath))
							{
		$searchresult=$searchresult."<a href='#' class='".$produce_class."' id='".$produce_id.$i."'><span class='searchheading' id='span".$i."' width='160px' style='display:block;'>".$skucode_data['sku_code']." -- ".$skucode_data['search_by_legend']."
		<img alt='' src='".$image."' style='float:right; max-height:25px; max-width:100px; padding: 2px 0px ' border='0'/></span></a>";
							} 
							/*else
							{
		$searchresult=$searchresult."<a href='#' class='".$produce_class."' id='".$produce_id.$i."'><span class='searchheading' id='span".$i."' width='160px' style='display:block;'>".$skucode_data['sku_code']." -- ".$skucode_data['search_by_legend']."</span></a>";							
							}*/
						}
						/*else
						{
						$searchresult=$searchresult."<a href='#' class='".$produce_class."' id='".$produce_id.$i."'><span class='searchheading' id='span".$i."' width='160px' style='display:block;'>".$skucode_data['sku_code']." -- ".$skucode_data['search_by_legend']."</span></a>";				
						}*/				
					}
					$searchresult.="</p>";
				  }
				  else if($countrow==0)
				  {			 
					  /*$sql_legend_list="select sku_code,search_by_legend,search_by_image from pm_products_sku_description where search_by_legend like '%$q%'";  
					  $legend_result=mysql_query($sql_legend_list);
					  
					  //print  $sql_legend_list;
					  while($legend_row=mysql_fetch_array($legend_result))
					  {
						  $legend[]=$legend_row;
					  }*/
					  $legend=$this->getskucodesearchbylegend($q);
					  $i=0;
					  if(count($legend)>0)
					  {
						   $searchresult="<p id='searchresults'>"; 
							foreach($legend as $key => $legend_data)
							{
								$i++;
								$image=WebSite.PathImgProductSkuSearch.$legend_data['search_by_image'];
								//$image=PathImgProductSkuSearch.$legend_data['search_by_image'];
								//$existspath='../'.$image;
								/*list($width, $height) = getimagesize($image);
								
								if($height>25)
								{
									$new_height=25;
									$new_width=$width*25/$height;
									if($new_width>90)
									{
										$pre_new_width=$new_width;
										$new_width=90;
										$new_height=$new_height*90/$pre_new_width;
									}
								}
								else if($width>90)
								{
									$new_width=90;
									$new_height=$height*90/$width;					
								}
								else 
								{
									$new_height=$height;
									$new_width=$width;					
								}*/
								//if($legend_data['search_by_image']!='')
								{
									//if(file_exists($existspath))
									{
								/*$searchresult=$searchresult."<a href='#' onclick='selectddl(".$i.")'><span class='searchheading' id='span".$i."' width='160px' style='display:block;'>".$legend_data['sku_code']." - ".$legend_data['search_by_legend']."
				</span><img alt='' src='".$image."' width='".$new_width."' height='".$new_height."' border='0' style='float:right;'/></a>";*/
		$searchresult=$searchresult."<a href='#' class='".$produce_class."' id='".$produce_id.$i."'><span class='searchheading' id='span".$i."' width='160px' style='display:block;'>".$legend_data['sku_code']." -- ".$legend_data['search_by_legend']."
		<img alt='' src='".$image."' style='float:right; max-height:25px; max-width:100px; padding: 2px 0px ' border='0'/></span></a>";	
									}
									/*else
									{
		$searchresult=$searchresult."<a href='#' class='".$produce_class."' id='".$produce_id.$i."'><span class='searchheading' id='span".$i."' width='160px' style='display:block;'>".$legend_data['sku_code']." -- ".$legend_data['search_by_legend']."</span></a>";										
									}*/
								}
								/*else
								{
								$searchresult=$searchresult."<a href='#' class='".$produce_class."' id='".$produce_id.$i."'><span class='searchheading' id='span".$i."' width='160px' style='display:block;'>".$legend_data['sku_code']." -- ".$legend_data['search_by_legend']."</span></a>";				
								}*/
						
							}
							$searchresult.="</p>";			  	  
					  }
					  else
					  {
						   $searchresult='';
					  }
				  }
		}
		else
		{
		$searchresult='';
		}
		echo $searchresult;
	}
	function searchmaincategpry()
	{
		  $sql_title_list="select name from pm_main_category where name<>'' and active='Y' group by name order by position asc";
		  
		  $title_result=mysql_query($sql_title_list);
		  while($title_row=mysql_fetch_array($title_result))
		  {
			  $maintitle[]=$title_row;
		  }
		  return $maintitle;
	}
	
	function searchsubcategpry($maintitle)
	{
		  $sql_content_list="select name from pm_category where main_category='".$maintitle."' and active='Y' order by position";
		  $content_result=mysql_query($sql_content_list);
		  while($content_row=mysql_fetch_array($content_result))
		  {
			  $content[]=$content_row;
		  }
		  return $content;		  
	}
	function getnamefrommain($q)
	{
			$sql_title_list="select name from pm_main_category where name='$q' and active='Y'";
			//print $sql_title_list;
			$title_result=mysql_query($sql_title_list);
			while($title_row=mysql_fetch_array($title_result))
			{
				$maintitle=$title_row['name'];
				//print $maintitle[$i]."$i"."||";
			}
			return $maintitle;
	}
	function getallnamefrommain()
	{
		  $sql_title_list="select name from pm_main_category where name<>'' and active='Y' group by name order by position asc";	  
		  $title_result=mysql_query($sql_title_list);
		  while($title_row=mysql_fetch_array($title_result))
		  {
			  $maintitle[]=$title_row;
		  }
		  return $maintitle;
	}
	function getnamefromcategory($maintitle)
	{
		  $sql_sub_list="select name from pm_category where main_category='$maintitle' and active='Y' and name<>'' order by position";
		  $sub_list_result=mysql_query($sql_sub_list);
		  while($sublist_row=mysql_fetch_array($sub_list_result))
		  {
			  $subtitlename[]=$sublist_row;
		  }
		  return $subtitlename;
	}
	function process_product_index()
	{
		$q=$_GET["q"];					
		if($q!='-1'&&$q!='0')
		{	
			$mainurl=urlencode($q);	
			echo "<div class='grid_4 help-summary product-container append-bottom-10'><a href='".WebSite.$mainurl.".html'><h4>".$q."</h4></a>";
			
			$subname=$this->getnamefromcategory($q);
			if(count($subname)>0)
			{
				foreach($subname as $key => $detail_row)
				{
					$sub_title=$detail_row['name'];
					$suburl=urlencode($sub_title);
					echo "<a href='".WebSite.$mainurl.'/'.$suburl.".html'><div>".$sub_title."</div></a>";
				}
			}
			echo "</div>";
		}
		else
		{			
			$main_result=$this->getallnamefrommain();
			if(count($main_result)>0)
			{
				$i=0;
				foreach($main_result as $key => $detail_data)
				{
					$maintitle=$detail_data['name'];
					$mainurl=urlencode($maintitle);	
					echo "<div class='grid_4 help-summary product-container append-bottom-10'><a href='".WebSite.$mainurl.".html'><h4>".$maintitle."</h4></a>";
	
					$subresult=$this->getnamefromcategory($maintitle);
					if(count($subresult)>0)
					{
						foreach($subresult as $key => $sub_row)				
						{
							$sub_title=$sub_row['name'];
							$suburl=urlencode($sub_title);							
							echo "<a href='".WebSite.$mainurl.'/'.$suburl.".html'><div>".$sub_title."</div></a>";
						}
					}
					$i++;
					echo "</div>"; 
					//if(($i+1)%4==0)
						//echo "<div></div>";   
				}
			}
		}
	}
	function process_submitquickbuy()
	{
		$redirecturl='';
		if($_REQUEST['quickorder-item-number']=='')
		{
			$errormessage="<br/>Please input a valid item# or quantity.<br/>We Recommend the following:<br/>1. Please double check item number and try again.<br/>2. Browse our <a href='product_index.php'>Product Index.</a><br/>3. Browse thru our Customer items page to look for and create the product you are looking for.<br/><a href='#customize-it' class='button dark action-button'>Create A Custom Pipe Marker <span class='icon-set'>C</span></a>";
			
			//$lowertext="2. Browse our <a href='product_index.php'>Product Index.</a><br/>3. Browse thru our Customer items page to look for and create the product you are looking for.";
			$successmessage="";
		}		
		else
		{ 
			if($_REQUEST['quickorder-quanity']==''||$_REQUEST['quickorder-quanity']==0||!ctype_digit($_REQUEST['quickorder-quanity']))
			{
				$addtocartpage=$this->AddToCart();
				if(count($addtocartpage)==0)
				{
					$errormessage="<br/>We apologize but no results for '".$_REQUEST['quickorder-item-number']."'can be found.<br/>We Recommend the following:<br/>1. Please double check item number and try again.<br/>2. Browse our <a href='product_index.php'>Product Index.</a><br/>3. Browse thru our Customer items page to look for and create the product you are looking for.<br/><a href='#customize-it' class='button dark action-button'>Create A Custom Pipe Marker <span class='icon-set'>C</span></a>";
					$successmessage="";
				}
				else
				{
					$errormessage='';
					$successmessage='';
					 foreach($addtocartpage as $key => $product_data)
					 {
						 $pid=urlencode($product_data['products_id']);
						 $productno=urlencode($product_data['product_number']);
						 $category=urlencode($product_data['category_name']);
						 $subcategory=urlencode($product_data['subcategory_name']);
						 $redirecturl=WebSite.$category."/".$subcategory."/".$productno."/".$pid.".html";
						 //$url="addtocart.php?category=".$category."&subcategory=".$subcategory."&productno=".$productno."&pid=".$pid;
						 //$lowertext="products_id:".$product_data['products_id']."<br/>product_number:".$product_data['product_number'];
						
						//print "<script>location.href='".WebSite.$category."/".$subcategory."/".$productno."/".$pid.".html'";
					 }						
				}
			}
			else
			{
				 $addtoshoppingpage=$this->AddToShoppingCart();		 
				 if($addtoshoppingpage=='NoMatch')
				 {
					$errormessage="<br/>We apologize but no results for '".$_REQUEST['quickorder-item-number']."'can be found.<br/>We Recommend the following:<br/>1. Please double check item number and try again.<br/>2. Browse our <a href='product_index.php'>Product Index.</a><br/>3. Browse thru our Customer items page to look for and create the product you are looking for.<br/><a href='#customize-it' class='button dark action-button'>Create A Custom Pipe Marker <span class='icon-set'>C</span></a>";
					$successmessage="";
				 }
				 else if($addtoshoppingpage=='PleaseSelect')
				 {
					$errormessage="<br/>Please Select an item # from the list.<br/>We Recommend the following:<br/>1. Please double check item number and try again.<br/>2. Browse our Product Index.<a href='product_index.php'>Product Index.</a><br/>3. Browse thru our Customer items page to look for and create the product you are looking for.<br/><a href='#customize-it' class='button dark action-button'>Create A Custom Pipe Marker <span class='icon-set'>C</span></a>";
					$successmessage="";	
				 }
				 else if($addtoshoppingpage=='OK')
				 {
					$errormessage='';
					$successmessage='product '.$_REQUEST['quickorder-item-number'].' has successfully added to shopping cart';
				 }
				 else//quantity should be above the minimum quantity.
				 {
					$errormessage="<br/>The minimum quantity for '".$_REQUEST['quickorder-item-number']."' is ".$addtoshoppingpage." .Please input a quantity greater than the minimum quantity";
					$successmessage="";					 
				 }
			}
		}
		$objproductcustomtool =new Pm_ProductCustomeTools();
		$num=$objproductcustomtool->APShoppingCardProductCount();
		  $quickbuyitem_added = array(
			  error_msg => $errormessage,
			  success_msg => $successmessage,
			  redirect_msg => $redirecturl,
			  current_item_count => $num,
		  );
	    $json = json_encode($quickbuyitem_added);
	    echo $json;		
	}
	function quotequickbuyprocess()//for the header
	{
		$errormessage="";
		//if($_REQUEST['AddToCart']=='Add to Cart')
		{
			if($_REQUEST['quickorder-item-number']=='')
			{
				$errormessage="<br/>Please input a valid item# or quantity.<br/>We Recommend the following:<br/>1. Please double check item number and try again.<br/>2. Browse our <a href='product_index.php'>Product Index.</a><br/>3. Browse thru our Customer items page to look for and create the product you are looking for.";
			}
			else
			{ 
				if($_REQUEST['quickorder-quanity']==''||$_REQUEST['quickorder-quanity']==0||!ctype_digit($_REQUEST['quickorder-quanity']))
				{
					$addtocartpage=$this->AddToCart('header');
					if(count($addtocartpage)==0)
					{
						$errormessage="<br/>We apologize but no results for '".$_REQUEST['quickorder-item-number']."'can be found.<br/>We Recommend the following:<br/>1. Please double check item number and try again.<br/>2. Browse our <a href='product_index.php'>Product Index.</a><br/>3. Browse thru our Customer items page to look for and create the product you are looking for.";
					}
					else
					{
						$errormessage='';
						 foreach($addtocartpage as $key => $product_data)
						 {
							 $pid=urlencode($product_data['products_id']);
							 $productno=urlencode($product_data['product_number']);
							 $category=urlencode($product_data['category_name']);
							 $subcategory=urlencode($product_data['subcategory_name']);
							print "<script>location.href='".WebSite.$category."/".$subcategory."/".$productno."/".$pid.".html'</script>"; 
						 }						
					}
				}
				else
				{
					 $addtoshoppingpage=$this->AddToShoppingCart('header');		 
					 if($addtoshoppingpage=='NoMatch')
					 {
						$errormessage="<br/>We apologize but no results for '".$_REQUEST['quickorder-item-number']."'can be found.<br/>We Recommend the following:<br/>1. Please double check item number and try again.<br/>2. Browse our <a href='product_index.php'>Product Index.</a><br/>3. Browse thru our Customer items page to look for and create the product you are looking for.";
					 }
					 else if($addtoshoppingpage=='PleaseSelect')
					 {
						$errormessage="<br/>Please Select an item # from the list.<br/>We Recommend the following:<br/>1. Please double check item number and try again.<br/>2. Browse our <a href='product_index.php'>Product Index.</a><br/>3. Browse thru our Customer items page to look for and create the product you are looking for.";
					 }
					 else if($addtoshoppingpage=='OK')
					 {
						$errormessage='OK';
					 }
					 else//quantity should be above the minimum quantity.
					 {
						$errormessage="<br/>The minimum quantity for '".$_REQUEST['quickorder-item-number']."' is ".$addtoshoppingpage." .Please input a quantity greater than the minimum quantity";
						$successmessage="";					 
					 }					 
				}
			}	
		}
		return $errormessage;
	}
	function quotequickbuyprocess_sh()
	{
		$errormessage="";	
		//if($_REQUEST['AddToCart']=='Add to Cart sh')
		{
			if($_REQUEST['quickorder-item-number_sh']=='')
			{
				$errormessage="<br/>Please input a valid item# or quantity.<br/>We Recommend the following:<br/>1. Please double check item number and try again.<br/>2. Browse our <a href='product_index.php'>Product Index.</a><br/>3. Browse thru our Customer items page to look for and create the product you are looking for.";
			}
			else
			{ 
				if($_REQUEST['quickorder-quanity_sh']==''||$_REQUEST['quickorder-quanity_sh']==0||!ctype_digit($_REQUEST['quickorder-quanity_sh']))
				{
					$addtocartpage=$this->AddToCart('sh');
					if(count($addtocartpage)==0)
					{
						$errormessage="<br/>We apologize but no results for '".$_REQUEST['quickorder-item-number_sh']."'can be found.<br/>We Recommend the following:<br/>1. Please double check item number and try again.<br/>2. Browse our <a href='product_index.php'>Product Index.</a><br/>3. Browse thru our Customer items page to look for and create the product you are looking for.";
					}
					else
					{
						$errormessage='';
						 foreach($addtocartpage as $key => $product_data)
						 {
							 $pid=urlencode($product_data['products_id']);
							 $productno=urlencode($product_data['product_number']);
							 $category=urlencode($product_data['category_name']);
							 $subcategory=urlencode($product_data['subcategory_name']);
							 print "<script>location.href='".WebSite.$category."/".$subcategory."/".$productno."/".$pid.".html'</script>"; 
						 }						
					}
				}
				else
				{
					 $addtoshoppingpage=$this->AddToShoppingCart('sh');		 
					 if($addtoshoppingpage=='NoMatch')
					 {
						$errormessage="<br/>We apologize but no results for '".$_REQUEST['quickorder-item-number_sh']."'can be found.<br/>We Recommend the following:<br/>1. Please double check item number and try again.<br/>2. Browse our <a href='product_index.php'>Product Index.</a><br/>3. Browse thru our Customer items page to look for and create the product you are looking for.";
					 }
					 else if($addtoshoppingpage=='PleaseSelect')
					 {
						$errormessage="<br/>Please Select an item # from the list.<br/>We Recommend the following:<br/>1. Please double check item number and try again.<br/>2. Browse our <a href='product_index.php'>Product Index.</a><br/>3. Browse thru our Customer items page to look for and create the product you are looking for.";
					 }
					 else if($addtoshoppingpage=='OK')
					 {
						$errormessage='OK';
					 }
					 else//quantity should be above the minimum quantity.
					 {
						$errormessage="<br/>The minimum quantity for '".$_REQUEST['quickorder-item-number']."' is ".$addtoshoppingpage." .Please input a quantity greater than the minimum quantity";
						$successmessage="";					 
					 }						 
				}
			}	
		}
		return $errormessage;
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
	function ResetCustomerListDiscountNew()
	{
		$ObjShoppingCard=new BS_ShoppingCard();
		$shopping_card=$ObjShoppingCard->ShoppingCardList();
		foreach($shopping_card as $key => $values) 
		{ 
			$ObjShoppingCard->ResetCustomerListDiscountByID($values[price],$values[total],$values[id]);
		}//end foreach loop
	}	
} //end of class
?>
