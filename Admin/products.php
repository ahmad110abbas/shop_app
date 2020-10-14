<?php 
	include 'header.php';
	include 'sidebar.php';
	include 'config.php';
	$errors=array();
	$message='';
	$category_id;

	if (isset($_POST['product_name'])) {
		$product_name=isset($_POST['product_name'])?$_POST['product_name']:'';
		$product_price=isset($_POST['product_price'])?$_POST['product_price']:'';
		$product_image=isset($_POST['product_image'])?$_POST['product_image']:'';
		$category=isset($_POST['dropdown'])?$_POST['dropdown']:'';
		$description=isset($_POST['description'])?$_POST['description']:'';
	}

	// if (isset($_POST['submit'])) {
	// 	foreach ($_POST as $key => $value) {
	// 		if ($value=='on') {
	// 				$all_tags=$key.",".$all_tags;
	// 		}
	// 	}
	// }
	if (isset($_POST['product_name'])) {
		switch ($category) {
			case 'men':
				$category_id=1;
				break;
		
			case 'women':
				$category_id=2;
				break;

			case 'kids':
				$category_id=3;
				break;

			case 'electronics':
				$category_id=4;
				break;

			case 'sports':
				$category_id=5;
				break;
		}
	}

if (isset($_POST['product_name'])) {
	$sql = "INSERT INTO products (category_id, name, price, image, description) VALUES ('".$category_id."', '".$product_name."' , '".$product_price."','".$product_image."','".$description."')";
	if ($conn->query($sql) === true) {
		echo "Record Added";
	} else{
		$errors[]=array('input'=>'form','msg'=>$conn->error);
		print_r($errors);
		print_r($category_id);
		die();
	}
	// $conn->close();
}
 ?>
		
		<div id="main-content"> <!-- Main Content Section with everything -->
			
			<noscript> <!-- Show a notification if the user has disabled javascript -->
				<div class="notification error png_bg">
					<div>
						Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
					</div>
				</div>
			</noscript>
			
			<!-- Page Head -->
<!-- 			<h2>Welcome John</h2>
			<p id="page-intro">What would you like to do?</p> -->
			
			<div class="clear"></div> <!-- End .clear -->
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
					
					<h3>Products</h3>
					
					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">Manage</a></li> <!-- href must be unique and match the id of target div -->
						<li><a href="#tab2">Add</a></li>
					</ul>
					
					<div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content">
					
					<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
						
<!-- 						<div class="notification attention png_bg">
							<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
							<div>
								This is a Content Box. You can put whatever you want in it. By the way, you can close this notification with the top-right cross.
							</div>
						</div> -->
						
						<table>
							
							<thead>
								<tr>
								   <th><input class="check-all" type="checkbox" /></th>
								   <th>Product Id</th>
								   <th>Product Name</th>
								   <th>Price</th>
								   <th>Category</th>
								   <th>Action</th>
								</tr>
								
							</thead>
						 
							<tfoot>
								<tr>
									<td colspan="6">
										<div class="bulk-actions align-left">
											<select name="dropdown">
												<option value="option1">Choose an action...</option>
												<option value="option2">Edit</option>
												<option value="option3">Delete</option>
											</select>
											<a class="button" href="#">Apply to selected</a>
										</div>
										
										<div class="pagination">
											<a href="#" title="First Page">&laquo; First</a><a href="#" title="Previous Page">&laquo; Previous</a>
											<a href="#" class="number" title="1">1</a>
											<a href="#" class="number" title="2">2</a>
											<a href="#" class="number current" title="3">3</a>
											<a href="#" class="number" title="4">4</a>
											<a href="#" title="Next Page">Next &raquo;</a><a href="#" title="Last Page">Last &raquo;</a>
										</div> <!-- End .pagination -->
										<div class="clear"></div>
									</td>
								</tr>
							</tfoot>
						
							<?php  

								$sql = "SELECT product_id,category_id,name,price,image,description FROM products";
								$result = $conn->query($sql);
								echo "<tbody>";
								if ($result->num_rows > 0) {
									while ($row = $result->fetch_assoc()) {

										// print_r($row['product_id']);
										// print_r($row['category_id']);
										// print_r($row['name']);
										// print_r($row['price']);
										// print_r($row['image']);
										// print_r($row['description']);
										// echo "<br>";
										echo "<tr>";
										echo '<td><input type="checkbox" /></td>';
										echo "<td>",$row['product_id'],"</td>";
										echo '<td><a href="#" title="title">',$row['name'],'t</a></td>';
										echo "<td>",$row['price'],"</td>";
										echo "<td>",$row['category_id'],"</td>";
										echo '<td><a href="#" title="Edit"><img src="resources/images/icons/pencil.png" alt="Edit" /></a><a href="#" title="Delete"><img src="resources/images/icons/cross.png" alt="Delete" /></a><a href="#" title="Edit Meta"><img src="resources/images/icons/hammer_screwdriver.png" alt="Edit Meta" /></a></td></tr>';
									}
								}
								echo "</tbody>";
							?>
						</table>
						
					</div> <!-- End #tab1 -->
					
					<div class="tab-content" id="tab2">
					
						<form action="products.php" method="post">
							
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								
								<p>
									<label>Name</label>
										<input class="text-input medium-input" type="text" id="medium-input" name="product_name" /> <!-- <span class="input-notification success png_bg">Successful message</span> Classes for input-notification: success, error, information, attention
										<br /><small>A small description of the field</small> -->
								</p>
								
								<p>
									<label>Price</label>
									<input class="text-input small-input datepicker" type="text" id="small-input" name="product_price" /> <!-- <span class="input-notification error png_bg">Error message</span> -->
								</p>

								<p>
									<label>Image</label>
									<input type="file" id="myfile" name="product_image"><br><br>
								</p>
								


								<p>
									<label>Tags</label>
									<input type="checkbox" name="fashion" /> Fashion 
									<input type="checkbox" name="ecommerce" /> Ecommerce
									<input type="checkbox" name="shop" /> Shop
									<input type="checkbox" name="handbag" /> Hand Bag
									<input type="checkbox" name="laptop" /> Laptop
									<input type="checkbox" name="headphone" /> Headphone
								</p>
								

								
								<p>
									<label>Category</label>              
									<select name="dropdown" class="small-input">
										<option value="men">Men</option>
										<option value="women">Women</option>
										<option value="kids">Kids</option>
										<option value="electronics">Electronics</option>
										<option value="sports">Sports</option>
									</select> 
								</p>
								
								<p>
									<label>Description</label>
									<textarea class="text-input textarea wysiwyg" id="textarea" name="description" cols="79" rows="15"></textarea>
								</p>
								
								<p>
									<input class="button" type="submit" value="Submit" />
								</p>
								
							</fieldset>
							
							<div class="clear"></div><!-- End .clear -->
							
						</form>
						
					</div> <!-- End #tab2 -->        
					
				</div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box -->
			
			<div class="clear"></div>
			
			
			<!-- Start Notifications -->
			
<!-- 			<div class="notification attention png_bg">
				<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					Attention notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero. 
				</div>
			</div>
			
			<div class="notification information png_bg">
				<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					Information notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
				</div>
			</div>
			
			<div class="notification success png_bg">
				<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					Success notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
				</div>
			</div>
			
			<div class="notification error png_bg">
				<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					Error notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
				</div>
			</div> -->
			
			<!-- End Notifications -->
<?php 
	include 'footer.php';
 ?>