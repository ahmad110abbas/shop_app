<?php 
	include 'header.php';
	include 'sidebar.php';
	require 'config.php';
	$errors=array();
	$message='';
	$category_id=0;
	// $product_name='';
	// $product_price=0;
	// $product_image='';
	// $category='';
	// $description='';


	if (isset($_POST['submit'])) {
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
	if (isset($_POST['submit'])) {
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
	// print_r($category_id);
	// print_r($product_name);
	// print_r($product_price);
	// print_r($product_image);
	// print_r($description);
	// die();
if (isset($_POST['submit'])) {
	$sql = "INSERT INTO shop_admin (category_id, name, price, image, description) VALUES ('".$category_id."', '".$product_name."' , '".$product_price."','".$product_image."','".$description."')";
	if ($conn->query($sql)===true) {
		echo "Record Added";
	} else{
		$errors[]=array('input'=>'form','msg'=>$conn->error);
		print_r($errors);
	}
	$conn->close();
}
 ?>