 <div id="upload_custom_file" class="shopping-cart-overlay large-overlay">
	<form id="uploadcustom" name="uploadcustom" class="uploadform" action="<? print WebSite.'addtocart.php?category='.urlencode($_REQUEST['category']).'&subcategory='.urlencode($_REQUEST['subcategory']).'&productno='.urlencode($_REQUEST['productno']).'&pid='.urlencode($_REQUEST['pid']); if(isset($_REQUEST['sh_id'])) print '&sh_id='.urlencode($_REQUEST['sh_id']); ?>" method="post" enctype="multipart/form-data">
			<h4>Please select a file</h4>
            <a class="button orange-x close">Cancel</a>
			<div id="enter-your-name-input" class="grid_6 for-selecting-an-address">
				<input id="importcustomfile" name="importcustomfile" type="file"/>
                <input name="previousfilename" id="previousfilename" value="<? print $file_name; ?>" type="hidden"/>
                <input name="previousfileid" id="previousfileid" value="<? print $file_id; ?>" type="hidden"/>    
                <input type="submit" value="Upload File" name="btupload" class="button submit">
			</div>
	</form>
</div>  
