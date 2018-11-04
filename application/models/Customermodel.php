<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customermodel extends MY_Model {

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->tableName = 'customer';
	}

	public function can_log_in(){
		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));

		$this->db->where('email', $email);
		$this->db->where('password', $password);
		$this->db->where('status', 1);
		$query = $this->db->get('users');

		if($query->num_rows() == 1){
			return true;
		}else{
			return false;
		}
	}

	public function productDetails($productId = ''){

		$this->db->select('p.componentId productId,
					p.sku,
					p.brandName,
					p.model,
					p.price,
					p.keyFeatures,
					p.createDate,
					im.componentId,
					im.image');
		$this->db->from('product p');
		$this->db->join('productimages im', 'p.componentId = im.productId', 'inner');
		$this->db->where('p.componentId', $productId);
		$this->db->group_by('p.componentId');
		return $this->db->get()->row_array();
		
	}

	public function brands(){
		$this->db->select('distinct(brandName)');
		$this->db->from('product');
		return $this->db->get()->result_array();
	}

	public function addToCart(){



		$cartData['productId'] = $this->input->post('productId');
		$cartData['quantity']  = 1;
		$cartData['sessionId'] = $this->input->cookie('not_logged_in_user') ? $this->input->cookie('not_logged_in_user') : session_id();



		$this->db->insert('cart', $cartData);

		if(!$this->input->cookie('not_logged_in_user')){
			setcookie('not_logged_in_user', $cartData['sessionId'], time() + (86400 * 30), "/");
		}
		
		
		$cartAmount = $this->db->get_where('cart', array('sessionId' => $cartData['sessionId']))->result_array();
		$cartAmount = count($cartAmount);
		return "Cart (".$cartAmount.")";
		
	}

	public function getCart(){
		$sessionId = $this->input->cookie('not_logged_in_user');
		$this->db->select('c.componentId cartId,
							c.productId,
							c.createDate,
							c.productId,
							c.quantity,
							p.brandName,
							p.model,
							p.price,
							im.image');
		$this->db->from('cart c');
		$this->db->join('product p', 'c.productId = p.componentId', 'inner');
		$this->db->join('productimages im', 'p.componentId = im.productId', 'inner');
		$this->db->where('c.sessionId', $sessionId);
		$this->db->group_by('c.componentId');
		return $this->db->get()->result_array();
		//echo $this->db->get_compiled_select();
	}

	public function my_orders($param = array()){

		$searchedText = ($param['searchedText'] == 'all')?'':$param['searchedText'];

		$this->db->select('o.componentId, o.userId, o.createDate, o.payment_status, pm.componentId payment_methodId, pm.name, ps.status, os.status shipping_status');
		$this->db->from('order o');
		$this->db->join('payment_methods pm', 'pm.componentId = o.payment_method', 'inner');
		$this->db->join('payment_status ps', 'o.payment_status = ps.componentId', 'inner');
		$this->db->join('order_status os', 'o.shippingStatus = os.componentId', 'inner');

		if($this->session->userdata('componentId')){
			$this->db->where('o.userId', $this->session->userdata('componentId'));
			$this->db->like('o.componentId', $searchedText);
		}else{
			$this->db->where('o.componentId', $searchedText);
		}

		if(isset($param['limit']) && !isset($param['offset'])){
			$limit = $param['limit'];
			$this->db->limit($limit);
		}else if(isset($param['limit']) && isset($param['offset'])){
			$offset = $param['offset'];
			$limit  = $param['limit'];
			$offset = $limit * ($offset-1);
			$this->db->limit($limit, $offset);
		}
		
		//echo $this->db->get_compiled_select();
		//exit();
		$my_orders = $this->db->get()->result_array();

		return $my_orders;
	}

	public function order_details($orderId = ''){
		
		$this->db->select('p.componentId productId,
						p.brandName,
						p.model,
						od.price,
						od.quantity,
						pimg.componentId imageId,
						pimg.image');
		$this->db->from('order o');
		$this->db->join('order_details od', 'od.orderId = o.componentId', 'inner');
		$this->db->join('product p', 'od.productId = p.componentId', 'inner');
		$this->db->join('productimages pimg', 'pimg.productId = p.componentId', 'inner');
		$this->db->where('o.componentId', $orderId);
		$this->db->order_by('p.brandName', 'asc');
		$detail_info = $this->db->get()->result_array();
		return $detail_info;
	}

	public function giveRating(){
		return $this->db->get('rating')->result_array();
	}

	public function removeOrder($orderId = ''){
		$this->db->where('componentId', $orderId);
		$this->db->delete('Order');

		$this->db->where('orderId', $orderId);
		$this->db->delete('order_details');
	}

	public function totalCartAmount(){
		$sessionId = $this->input->cookie('not_logged_in_user');

		$this->db->select_sum('p.price', 'cartPrice');
		$this->db->from('cart c');
		$this->db->join('product p', 'c.productId = p.componentId', 'inner');
		$this->db->where('c.sessionId', $sessionId);
		$this->db->group_by('c.sessionId');
		return $this->db->get()->row();
	}

	public function updateCart(){
		$updateData['quantity']    = $this->input->post('quantity');
		$updateData['componentId'] = $this->input->post('cartId');

		$this->db->where('componentId', $updateData['componentId']);
		$this->db->update('cart', $updateData);
	}


	public function existsInCart($productId = ''){
		$this->db->select('*');
		$this->db->from('cart');
		$this->db->where('sessionId', $this->input->cookie('not_logged_in_user'));
		$this->db->where('productId', $productId);
		$products = $this->db->get()->result_array();
		return count($products);
	}

	public function existsInWishlist($productId = ''){
		$userId = $this->session->userdata('componentId');
		$this->db->select('*');
		$this->db->from('wishlist');
		$this->db->where('productId', $productId);
		$this->db->where('userId', $userId);
		$products = $this->db->get()->result_array();
		return count($products);
	}
	public function getWishList(){
		$userId = $this->session->userdata('componentId');
		$cookie = $this->input->cookie('not_logged_in_user');
		$this->db->select('w.componentId wishId,
							c.componentId cartId,
							w.userId,
							w.productId,
							p.brandName,
							p.model,
							p.price,
							im.componentId imageId,
							im.image');
		$this->db->from('wishlist w');
		$this->db->join('product p', 'w.productId = p.componentId', 'inner');
		$this->db->join('productimages im', 'w.productId = im.productId', 'inner');
		$this->db->join('cart c', "c.productId = w.productId and c.sessionId = '$cookie'", 'left');
		$this->db->where('w.userId', $userId);
		$this->db->group_by('w.componentId');
		$wishList = $this->db->get()->result_array();
		return $wishList;
	}
	public function deletewish(){
		$wishId = $this->input->post('wishId');
		$this->db->where('componentId', $wishId);
		$this->db->delete('wishlist');
	}	

	public function removeFromCart(){
		$cartId = $this->input->post('CartId');
		$this->db->where('componentId', $cartId);
		$deleted = $this->db->delete('cart');
		if($deleted){
			$sessionId = $this->input->cookie('not_logged_in_user');
			$this->db->where('sessionId', $sessionId);
			$cartNumber = $this->db->get('cart')->num_rows();
			return "Cart (".$cartNumber.")";
		}else{
			return false;
		}
	}

	public function userInfo($componentId){
		$userInfo = $this->db->get_where('users', array('componentId' => $componentId))->result_array();
		return $userInfo;
	}

	public function isUserUnique(){
		$componentId = $this->session->userdata('componentId');
		$username    = $this->input->post('username');
		
		$query = "SELECT * 
					FROM users
					WHERE componentId NOT IN($componentId) AND username = '$username'";
		$usernameEntries = $this->db->query($query)->result_array();

		if(count($usernameEntries) > 0){
			return false;
		}else{
			return true;
		}
	}

	public function curPasswordCorrect(){
		$componentId = $this->session->userdata('componentId');
		$password = md5($this->input->post('curPassword'));
		
		$query = "SELECT * FROM users
					WHERE componentId = '$componentId'
					AND password = '$password'";
		$curPasswordCorrect = $this->db->query($query)->result_array();

		if(count($curPasswordCorrect) == 1){
			return true;
		}else{
			return false;
		}
	}

	public function changePassword(){
		$newPassword = md5($this->input->post('newPassword'));
		$componentId = $this->session->userdata('componentId');

		$updateData = array();
		$updateData['password'] = $newPassword;

		$this->db->where('componentId', $componentId);
		$updated = $this->db->update('users', $updateData);
		if($updated){
			return true;
		}else{
			return false;
		}
	}

	public function prntArr($data){
		echo "<pre>";
		print_r($data);
		echo "<pre>";
		//exit();
	}

	public function updateUserInfo(){
		$componentId = $this->session->userdata('componentId');
		$data = array();
		$data['firstName']        = $this->input->post('firstName');
		$data['lastName']         = $this->input->post('lastName');
		$data['username']         = $this->input->post('username');
		$data['mobile']           = $this->input->post('mobile');
		$data['presentAddress']   = $this->input->post('presentAddress');
		$data['permanentAddress'] = $this->input->post('permanentAddress');
		$data['subscriptionType'] = $this->input->post('subscriptionType');

		$this->db->where('componentId', $componentId);
		$updated = $this->db->update('users', $data);
		if($updated){
			$userdata['firstName'] = $data['firstName'];
			$this->session->set_userdata($userdata);

			return true;

		}else{
			return false;
		}
		
	}

	public function user_info(){
		$email = $this->input->post('email');
		$this->db->where('email', $email);
		return $this->db->get('users')->result_array();
	}

	public function add_user($key){
		$email = $this->input->post('email');
		$data = array(
				'email' 	   => $email,
				'signupKey'   => $key,
				'password'     => md5($this->input->post('password')),
				'status'       => 0,
				'firstName'   => $this->input->post('firstName'),
				'lastName'   => $this->input->post('lastName'),
				'subscriptionType'   => $this->input->post('subscriptionType'),
				'username'   => $this->input->post('username'),
				'mobile'   => $this->input->post('mobile'),
				'presentAddress'   => $this->input->post('presentAddress'),
				'permanentAddress'   => $this->input->post('permanentAddress'),
				'createDate' => date('Y-m-d')
			);

		$insert = $this->db->insert('users', $data);
			if($insert){
				return true;
			}else{
				return false;
			}
	}

	public function signupConfirm($key){

		$this->db->where('signupKey', $key);
		$keyExists = $this->db->get('users')->result_array();

		
		if(count($keyExists) == 1){
			$id = $keyExists[0]['componentId'];
			$data = array(
					'status' => 1
				);

			$this->db->where('componentId', $id);
			$updated = $this->db->update('users', $data);
			if($updated){
				return true;
			}else{
				return false;
			}
		}

		
	}

	public function is_email_present(){
		$email = $this->input->post('email');
		$this->db->where('email', $email);
		$is_present = $this->db->get('users')->result_array();
		if(count($is_present) == 1){
			return true;
		}else{
			return false;
		}
	}

	public function update_key($key){
		$email = $this->input->post('email');
		$data = array(
				'signupKey' => $key,
				'status'     => 0
 			);

		$this->db->where('email', $email);
		$updated = $this->db->update('users', $data);
		if($updated){
			return true;
		}else{
			return false;
		}
	}

	public function update_password(){
		$key = $this->input->post('key');
		$password = md5($this->input->post('password'));

		$data = array(
				'password' => $password,
				'status'   => 1
			);

		$this->db->where('signupKey', $key);
		$updated = $this->db->update('users', $data);
		if($updated){
			return true;
		}else{
			return false;
		}
	}

	public function getCat(){
		$cats = $this->db->get('category')->result_array();
		return $cats;
	}

	public function getSubcat(){
		$catId = $this->input->get('catId');
		$subcats = $this->db->get_where('subcategory', array('catId' => $catId))->result_array();
		return $subcats;
	}

	public function getSpecificCat(){
		$subCatId = $this->input->get('subCatId');
		$specificCats = $this->db->get_where('specificcat', array('subcatId' => $subCatId))->result_array();
		return $specificCats;
	}

	public function categories(){
		$data = array();
		if($this->input->post('category') != ''){
			$data['catId'] 		   = $this->input->post('category');
			$data['catName'] 		   = $this->db->get_where('category', array('componentId' => $data['catId']))->row()->catName;
		}
		

		if($this->input->post('subCat') != ''){
			$data['subCatId'] 	     = $this->input->post('subCat');
			$data['subCatName'] 		   = $this->db->get_where('subcategory', array('componentId' => $data['subCatId']))->row()->subCatName;
		}

		if($this->input->post('specificCat') != ''){
			$data['specificCatId'] = $this->input->post('specificCat');
			$data['specificCatName'] 		   = $this->db->get_where('specificcat', array('componentId' => $data['specificCatId']))->row()->specificCatName;
		}
		return $data;
	}

	public function addProduct($imagePaths = array()){

		$productData = array();
		$productData['catId'] 			= $this->input->post('category');
		$productData['subCatId']        = $this->input->post('subCat');
		$productData['specificCatId']   = $this->input->post('specificCat');
		$productData['userId']          = $this->session->userdata('componentId');
		$productData['brandName']       = $this->input->post('brandName');
		$productData['model']           = $this->input->post('model');
		$productData['price']           = $this->input->post('price');
		$productData['keyFeatures']     = $this->input->post('keyFeatures');
		$productData['createDate']      = date("Y-m-d H:i:s");
		$productData['updateDate']      = date("Y-m-d H:i:s");


		$this->db->insert('product', $productData);

		$productId = $this->db->insert_id();
		
		foreach ($imagePaths as $path) {

			$productData = array();

			$productData['productId']       = $productId;
			$productData['userId']          = $this->session->userdata('componentId');
			$productData['image']           = $path;

			$this->db->insert('productImages', $productData);
		}
	}

	public function getProducts(){
		$userId = $this->session->userdata('componentId');
		$products = "SELECT p.componentId, p.userId, p.brandName, p.model, im.image FROM product p
						LEFT JOIN productimages im ON p.componentId = im.productId
						WHERE p.userId = '$userId'
						GROUP BY p.brandName, p.model
						ORDER BY p.brandName DESC";
		$products = $this->db->query($products)->result_array();

		if(count($products) > 0){
			return $products;
		}else{
			return true;
		}
	}



	public function getCusProducts($param = array()){

		if(!$this->input->cookie('not_logged_in_user')){
			$cookieId = session_id();
			setcookie('not_logged_in_user', $cookieId, time() + (86400 * 30), "/");
		}else{
			$cookieId = $this->input->cookie('not_logged_in_user');
		}

		$userId = $this->session->userdata('componentId');

		if($param['searchedText'] == 'all'){
			$searchedText = '';
		}else{
			$searchedText = $param['searchedText'];
		}

		if($param['sort'] == 'nosort'){
			$sortCondition = 'p.brandName asc';
		}else if($param['sort'] == 'namea'){
			$sortCondition = 'p.brandName asc';
		}else if($param['sort'] == 'namez'){
			$sortCondition = 'p.brandName desc';
		}else if($param['sort'] == 'pricel'){
			$sortCondition = 'p.price asc';
		}else if($param['sort'] == 'priceh'){
			$sortCondition = 'p.price desc';
		}else if($param['sort'] == 'datea'){
			$sortCondition = 'p.createDate asc';
		}else if($param['sort'] == 'dated'){
			$sortCondition = 'p.createDate desc';
		}

		if($param['brand'] == 'all'){
			$brand = '';
		}else{
			$brand = $param['brand'];
		}

		$priceFrom = $param['priceFrom'];
		$priceTo   = $param['priceTo'];


		if(isset($param['limit'])){
			$limit  = $param['limit'];
		}
		
		
		$this->db->select('p.componentId,
				p.brandName,
				p.model,
				p.price,
				p.keyFeatures,
				im.image,
				c.componentId cartId,
				w.componentId wishlistId'
				);
		$this->db->from('product p');
		$this->db->join('productimages im', 'p.componentId = im.productId', 'inner');
		$this->db->join("cart c", "p.componentId = c.productId AND c.sessionId = '$cookieId'", "left");
		$this->db->join('wishlist w', "p.componentId = w.productId AND w.userId = '$userId'", 'left');
		if(isset($param['searchedText'])){
			$condition = "(`p`.`brandName` LIKE '%$searchedText%' ESCAPE '!' OR `p`.`model` LIKE '%$searchedText%' ESCAPE '!' )";
			$this->db->like($condition, NULL, FALSE);
		}
		$this->db->like('p.brandName', $brand);
		$this->db->where("p.price BETWEEN $priceFrom AND $priceTo", NULL, FALSE);
		$this->db->group_by('p.componentId');
		//$this->db->order_by('p.updateDate', 'desc');
		$this->db->order_by($sortCondition);

		if(isset($param['limit']) && isset($param['offset'])){
			$offset = $param['offset'];
			$offset = $limit * ($offset-1);
			$this->db->limit($limit, $offset);
		}else if(isset($param['limit']) && empty($param['offset'])){
			$this->db->limit($limit);
		}
		//echo $this->db->get_compiled_select();
		$products = $this->db->get()->result_array();


		if(count($products) > 0){
			return $products;
		}
	}

	public function filterByCat($param = ''){
			$catId = $param['catId'];
			if(isset($param['limit'])){
				$limit  = $param['limit'];
			}
			$this->db->select('p.componentId,
								p.brandName,
								p.model,
								p.price,
								p.keyFeatures,
								im.image');
			$this->db->from('product p');
			$this->db->join('productimages im', 'p.componentId = im.productId', 'inner');
			$this->db->where('p.catId', $catId);
			$this->db->group_by('p.componentId');
			$this->db->order_by('p.updateDate', 'desc');

			if(isset($param['limit']) && isset($param['offset'])){
				$offset = $param['offset'];
				$offset = $limit * ($offset-1);
				$this->db->limit($limit, $offset);
			}else if(isset($param['limit']) && empty($param['offset'])){
				$this->db->limit($limit);
			}

			return $this->db->get()->result_array();

	}

	public function filterBySubCat($param = ''){
		$subCatId = $param['subCatId'];
		if(isset($param['limit'])){
			$limit  = $param['limit'];
		}

		$this->db->select('p.componentId,
							p.brandName,
							p.model,
							p.price,
							p.keyFeatures,
							im.image');
		$this->db->from('product p');
		$this->db->join('productimages im', 'p.componentId = im.productId', 'inner');
		$this->db->where('p.subCatId', $subCatId);
		$this->db->group_by('p.componentId');
		$this->db->order_by('p.updateDate', 'desc');

		if(isset($param['limit']) && isset($param['offset'])){
			$offset = $param['offset'];
			$offset = $limit * ($offset-1);

			$this->db->limit($limit, $offset);
		}else if(isset($param['limit']) && empty($param['offset'])){
			$this->db->limit($limit);
		}

		return $this->db->get()->result_array();
	}

	public function addToWishlist(){
		$wishlistData['productId'] = $this->input->post('productId');
		$wishlistData['userId']    = $this->session->userdata('componentId');
		$wishlistData['createDate']= date("Y-m-d H:i:s");

		$this->db->insert('wishlist', $wishlistData);
	}

	public function filterBySpecificCat($param = ''){
		$specificCatId = $param['specificCatId'];
		if(isset($param['limit'])){
			$limit  = $param['limit'];
		}

		$this->db->select('p.componentId,
							p.brandName,
							p.model,
							p.price,
							p.keyFeatures,
							im.image');
		$this->db->from('product p');
		$this->db->join('productimages im', 'p.componentId = im.productId', 'inner');
		$this->db->where('p.specificCatId', $specificCatId);
		$this->db->group_by('p.componentId');
		$this->db->order_by('p.updateDate', 'desc');

		if(isset($param['limit']) && isset($param['offset'])){
			$offset = $param['offset'];
			$offset = $limit * ($offset-1);

			$this->db->limit($limit, $offset);
		}else if(isset($param['limit']) && empty($param['offset'])){
			$this->db->limit($limit);
		}

		return $this->db->get()->result_array();
	}

	public function editProduct(){
		$productId = $this->input->post('productId');
		$products = "SELECT  
					p.componentId productId,
					p.brandName, p.model, p.price, p.keyFeatures,
					im.componentId imageId,
					im.image
					FROM product p
					INNER JOIN productimages im ON im.productId = p.componentId
					WHERE p.componentId = '$productId'";
		$products = $this->db->query($products)->result_array();
		return $products;
	}

	public function updateProduct($imagePaths){
		$updateData = array();
		$productId = $this->input->post('productId');
		$updateData['brandName']   = $this->input->post('brandName');
		$updateData['model']       = $this->input->post('model');
		$updateData['price']       = $this->input->post('price');
		$updateData['keyFeatures'] = $this->input->post('keyFeatures');
		$updateData['updateDate']  = date("Y-m-d H:i:s");

		$this->db->where('componentId', $productId);
		$updated = $this->db->update('product', $updateData);
		
		foreach ($imagePaths as $path) {
			$updateData = array();

			$updateData['productId'] = $productId;
			$updateData['userId']    = $this->session->userdata('componentId');
			$updateData['image']     = $path;

			$this->db->insert('productimages', $updateData);
		}

		return true;
	}

	public function deleteProduct(){
		$productId = $this->input->post('productId');

		$images = $this->db->get_where('productimages', array('productId' => $productId))->result_array();

		foreach ($images as $image) {
			$imgsource = './'.$image['image'];
			if(file_exists($imgsource)){
				unlink($imgsource);
			}
		}

		$this->db->where('productId', $productId);
		$this->db->delete('productimages');

		$this->db->where('componentId', $productId);
		$this->db->delete('product');

		return true;
	}

	public function deleteImage(){
		$imageId = $this->input->post('imageId');
		$imagePath = $this->db->get_where('productimages', array('componentId' => $imageId))->row()->image;

		$imageSource = "./".$imagePath;

		if(file_exists($imageSource)){
			if(unlink($imageSource)){
				$this->db->where('componentId', $imageId);
				$this->db->delete('productimages');
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function productById(){
		$productId = $this->input->post('productId');
		$images = "SELECT
					im.componentId imageId,
					im.image
					FROM productimages im
					WHERE im.productId = '$productId'";
		$images = $this->db->query($images)->result_array();
		if($images){
			return $images;
		}
		exit();
	}

	public function paymentMethods(){
		$this->db->select('*');
		$this->db->from('payment_methods');
		$this->db->order_by('name');
		return $this->db->get()->result_array();
	}

	public function orderDetailsPaypal($id = null){
		$this->db->select('SUM(od.price * od.quantity) price, o.transaction_no');
		$this->db->from('order o');
		$this->db->join('order_details od', 'o.componentId = od.orderId', 'inner');
		$this->db->where('o.componentId', $id);
		return $this->db->get()->result_array();
	}

	public function paymentRule($paymentId = null){
		return $this->db->get_where('payment_methods', array('componentId' => $paymentId))->row()->Rules;
	}

	public function saveTransaction(){
		$orderId = $this->input->post('orderId');
		$data['transaction_no'] = $this->input->post('transactionNo');
		$data['transaction_no_updated'] = date("Y-m-d H:i:s");
		$this->db->where('componentId', $orderId);
		$updated = $this->db->update('order', $data);
		return $updated?true:false;
	}




}
?>
