<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer extends CI_Controller{

	function __construct(){
		parent::__construct();

		//used for facebook login
		$this->load->model('user');
		$this->load->model('customermodel');
		$this->load->library('form_validation');
	}

	
	public function index($param = array()){

		if(empty($param['searchedText'])){
			$param = $param + array('searchedText' => 'all');
		}

		if(empty($param['sort'])){
			$param = $param + array('sort' => 'nosort');
		}	

		if(empty($param['brand'])){
			$param = $param + array('brand' => 'all');
		}

		if(empty($param['priceFrom'])){
			$param = $param + array('priceFrom' => '0');
		}		

		if(empty($param['priceTo'])){
			$param = $param + array('priceTo' => '100000');
		}	
		
		$this->customer($param);
	}

	public function customer($param = ''){
		
		$paginationData = array(
				'rows'        => count($this->customermodel->getCusProducts($param)),
				'base_url'    => base_url('customer/searchedText/').$param['searchedText'].'/'.$param['sort'].'/'.$param['brand'].'/'.$param['priceFrom'].'/'.$param['priceTo'],
				'uri_segment' => 8,
				'model'       => 'customermodel',
				'method'      => 'getCusProducts'
			);

		$paginationData = $paginationData + $param;
		
		$pageData['products']    = paginate($paginationData);

		$pageData['brands']      = $this->customermodel->brands();
		$pageData['sort']        = $param['sort'];
		$pageData['slBrand']     = $param['brand'];
		$pageData['priceFrom']   = $param['priceFrom'];
		$pageData['priceTo']     = $param['priceTo'];
		$pageData['pageTitle']   = 'Silicon - Buy and Sell your product';
		$pageData['pageHeading'] = 'Products';

		$this->load->view('customer/index', $pageData);
	}

	public function searchedText($searchedText = null, $sort = null, $brand = null, $priceFrom = null, $priceTo = null){

		$param = [];

		if($this->input->post('searchedText') && is_null($searchedText)){
			$param = [
				'searchedText' => $this->input->post('searchedText')
			];
		}else if(!is_null($searchedText)){
			$param = [
				'searchedText' => $searchedText
			];
		}

		if($this->input->post('brand') && is_null($brand)){
			$param = $param + array('brand' => $this->input->post('brand'));
		}else if(!is_null($brand)){
			$param = $param + array('brand' => $brand);
		}

		if($this->input->post('sort') && is_null($sort)){
			$param = $param + array('sort' => $this->input->post('sort'));
		}else if(!is_null($sort)){
			$param = $param + array('sort' => $sort);
		}else{
			$param = $param + array('sort' => 'nosort');
		}

		if($this->input->post('min') && is_null($priceFrom)){
			$param = $param + array('priceFrom' => $this->input->post('min'));
		}else if(!is_null($priceFrom)){
			$param = $param + array('priceFrom' => $priceFrom);
		}

		if($this->input->post('max') && is_null($priceTo)){
			$param = $param + array('priceTo' => $this->input->post('max'));
		}else if(!is_null($priceTo)){
			$param = $param + array('priceTo' => $priceTo);
		}
		

		$this->index($param);
	}

	public function productDetails($productId = ''){

		$pageData['productDetails'] = $this->customermodel->productDetails($productId);
		$pageData['productExists']  = $this->customermodel->existsInCart($productId);
		$pageData['existsInWishlist']  = $this->customermodel->existsInWishlist($productId);
		$pageData['giveRating']     = $this->customermodel->giveRating();

		$pageData['pageTitle']   = 'Product Details';
		$pageData['pageHeading'] = 'Product Details';
		$this->load->view('customer/productDetails/index', $pageData);
	}

	public function addToCart(){
		$cartAmount = $this->customermodel->addToCart();
		echo json_encode($cartAmount);
	}

	public function myCart(){

		$pageData['carts'] = $this->customermodel->getCart();
		$pageData['totalCartAmount'] = $this->customermodel->totalCartAmount();

		$pageData['pageTitle']   = 'Your Cart';
		$pageData['pageHeading'] = 'Products';
		$this->load->view('cart/index', $pageData);
	}

	public function removeFromCart(){
		$result = $this->customermodel->removeFromCart();
		echo json_encode($result);
	}

	public function updateCart(){
		$this->customermodel->updateCart();
	}

	public function addToWishlist(){
		$this->customermodel->addToWishlist();
	}

	public function wishList(){
		$pageData['wishList'] = $this->customermodel->getWishList();
		$pageData['pageTitle']   = 'Your wishes';
		$this->load->view('wishlist/index', $pageData);
	}

	public function deletewish(){
		$this->customermodel->deletewish();
	}

	public function order(){
		$pageData['carts'] = $this->customermodel->getCart();
		$pageData['paymentMethods'] = $this->customermodel->paymentMethods();
		$pageData['pageTitle']   = 'Confirm Order';
		$this->load->view('order/index', $pageData);
	}

	public function confirm_order_validation(){

		if($this->input->post('auth_user_name_ordered')){
			$name = $this->input->post('auth_user_name_ordered');
			$this->form_validation->set_rules('auth_user_name_ordered', 'Name', 'trim|required');
		}else{
			$this->form_validation->set_rules('firstName', 'First Name', 'required|trim');
			$this->form_validation->set_rules('lastName', 'Last Name', 'required|trim');
		}

		if($this->input->post('auth_user_email_ordered')){
			$email = $this->input->post('auth_user_email_ordered');
			$this->form_validation->set_rules('auth_user_email_ordered', 'Email', 'trim|required');
		}else{
			$this->form_validation->set_rules('email_ordered', 'Email', 'required|trim|valid_email');
		}

		if($this->input->post('auth_user_address_ordered')){
			$address = $this->input->post('auth_user_address_ordered');
			$this->form_validation->set_rules('auth_user_address_ordered', 'Address', 'trim|required');
		}else{
			$this->form_validation->set_rules('shipping_address', 'Address', 'required|trim');
		}

		if($this->input->post('auth_user_mobile_ordered')){
			$mobile = $this->input->post('auth_user_mobile_ordered');
			$this->form_validation->set_rules('auth_user_mobile_ordered', 'Mobile', 'trim|required');
		}else{
			$this->form_validation->set_rules('mobile_ordered', 'Mobile', 'required|trim');
		}

		$this->form_validation->set_rules('payment_method', 'Payment Method', 'trim|required');

		if($this->form_validation->run()){
			if(!isset($email))
				$email = $this->input->post('email_ordered');
			if(!isset($address))
				$address = $this->input->post('shipping_address');
			if(!isset($mobile))
				$mobile = $this->input->post('mobile_ordered');

			if(isset($name)){
				$userId = $this->session->userdata('componentId');
				$orderData['userId'] = $userId;
				$userInfo = $this->db->get_where('users', array('componentId' => $userId))->row_array();
				$firstName = $userInfo['firstName'];
				$lastName  = $userInfo['lastName'];
			}else{
				$firstName = $this->input->post('firstName');
				$lastName  = $this->input->post('lastName');
			}
			$payment_method = $this->input->post('payment_method');

			$orderData['firstName']       = $firstName;
			$orderData['lastName']        = $lastName;
			$orderData['email']           = $email;
			$orderData['mobile']          = $mobile;
			$orderData['shippingAddress'] = $address;
			$orderData['payment_method']  = $payment_method;
			$orderData['payment_status']  = 2;
			$orderData['shippingStatus']  = 1;
			$orderData['createDate']      = date('Y-m-d H:i:s');

			$this->db->insert('order', $orderData);
			$order_id = $this->db->insert_id();

			$this->db->select('c.*, p.price');
			$this->db->from('cart c');
			$this->db->join('product p', 'c.productId = p.componentId', 'inner');
			$this->db->where('sessionId', $this->input->cookie('not_logged_in_user'));
			$order_details = $this->db->get()->result_array();

			foreach ($order_details as $key => $order) {
				$detailData['orderId']   = $order_id;
				$detailData['productId'] = $order['productId'];
				$detailData['price']     = $order['price'];
				$detailData['quantity']  = $order['quantity'];

				$this->db->insert('order_details', $detailData);
			}

			$this->db->where('sessionId', $this->input->cookie('not_logged_in_user'));
			$this->db->delete('cart');

			//Mailing order id
			$config = array(
			    'protocol'  => 'smtp',
			    'smtp_host' => 'ssl://smtp.googlemail.com',
			    'smtp_port' => 465,
			    'smtp_user' => 'brown.php11@gmail.com',
			    'smtp_pass' => '11grandprime',
			    'mailtype'  => 'html',
			    'charset'   => 'utf-8'
			);
			$this->email->initialize($config);
			$this->email->set_mailtype("html");
			$this->email->set_newline("\r\n");

			//Email content
			$htmlContent = '<h1>Thank you for being with us</h1>';
			$htmlContent .= "<p>Your Order Id is ".$order_id." . You can know your order details using this order id in myorder section</p>";

			$this->email->to($email);
			$this->email->from('brown.php11@gmail.com','Silicon');
			$this->email->subject('Order confirmation');
			$this->email->message($htmlContent);

			//Send email
			$this->email->send();
			redirect('customer/myorders');
		}else{
			$pageData['carts'] = $this->customermodel->getCart();
			$pageData['paymentMethods'] = $this->customermodel->paymentMethods();
			$pageData['pageTitle']   = 'Confirm Order';
			$this->load->view('order/index', $pageData);
		}
	}

	// public function myorders(){
	// 	$pageData['my_orders'] = $this->customermodel->my_orders();
		
	// 	$pageData['pageTitle']   = 'My Orders';
	// 	$this->load->view('order/myorders/index', $pageData);
	// }

	public function myorders($searchedText = null){
		$param = array();

		if($this->input->post('searchedText') && is_null($searchedText)){
			$param['searchedText'] = $this->input->post('searchedText');
		}else if($searchedText && empty($this->input->post('searchedText'))){
			$param['searchedText'] = $searchedText;
		}else if(is_null($searchedText)){
			$param['searchedText'] = 'all';
		}
		

		$paginationData = array(
				'rows'        => count($this->customermodel->my_orders($param)),
				'base_url'    => base_url('customer/myorders/').$param['searchedText'],
				'uri_segment' => 4,
				'model'       => 'customermodel',
				'method'      => 'my_orders'
			);

		$paginationData = $paginationData + $param;
		$data['my_orders']    = paginate($paginationData);

		$data['searchedText'] = $param['searchedText'];

		$data['pageTitle']   = 'My Orders';
	 	$this->load->view('order/myorders/index', $data);
	}

	public function buyWithBkash($orderId = null, $paymentId = null){
		$data['total'] = $this->customermodel->orderDetailsPaypal($orderId);
		$data['rules'] = $this->customermodel->paymentRule($paymentId);
		$data['orderId'] = $orderId;
		$data['pageTitle']   = 'Payment';
		
		$this->load->view('payments/bkash/index', $data);
	}

	public function saveTransaction(){
		$this->customermodel->saveTransaction();
		redirect('customer/myorders');
	}

	//For buying by paypal
	function buy($id){
        //Set variables for paypal form
        $returnURL = base_url().'paypal/success'; //payment success url
        $cancelURL = base_url().'paypal/cancel'; //payment cancel url
        $notifyURL = base_url().'paypal/ipn'; //ipn url
        //get particular product data
        $product = $this->customermodel->orderDetailsPaypal($id);
        $userID = $this->session->userdata('componentId'); //current user id
        $logo = base_url().'assets/images/4a.jpg';
        
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('item_name', $product[0]['price']);
        $this->paypal_lib->add_field('custom', $userID);
        $this->paypal_lib->add_field('item_number',  $id);
        $this->paypal_lib->add_field('amount',  $product[0]['price']);        
        $this->paypal_lib->image($logo);
        
        $this->paypal_lib->paypal_auto_form();
    }

	public function removeOrder($orderId = ''){
		$this->customermodel->removeOrder($orderId);
	}

	public function order_details($orderId = ''){
		$pageData['order_details'] = $this->customermodel->order_details($orderId);

		$pageData['pageTitle']   = 'Order Details';
		$this->load->view('order/order_details/index', $pageData);
	}

	public function filterByCat($catId = ''){

		$param = [
			'catId' => $catId
		];
		$paginationData = array(
			'rows'        => count($this->customermodel->filterByCat($param)),
			'base_url'    => base_url('customer/filterByCat/').$catId,
			'model'       => 'customermodel',
			'method'      => 'filterByCat',
			'catId'       => $catId,		
			'uri_segment' => 4
		);
		

		$pageData['products'] = $this->paginate($paginationData);

			//$pageData['products'] = $this->customermodel->filterByCat($catId);
			$pageData['pageTitle']   = 'Silicon - Buy and Sell your product';
			$pageData['pageHeading'] = 'Products';
			$this->load->view('customer/index', $pageData);
	}

	public function filterBySubCat($subCatId = ''){

			$param = [
				'subCatId' => $subCatId
			];
			$paginationData = array(
				'rows'        => count($this->customermodel->filterBySubCat($param)),
				'base_url'    => base_url('customer/filterBySubCat/').$subCatId,
				'model'       => 'customermodel',
				'method'      => 'filterBySubCat',
				'subCatId'    => $subCatId,		
				'uri_segment' => 4
			);
			$pageData['products'] = $this->paginate($paginationData);
			//$pageData['products'] = $this->customermodel->filterBySubCat($subCatId);
			$pageData['pageTitle']   = 'Silicon - Buy and Sell your product';
			$pageData['pageHeading'] = 'Products';
			$this->load->view('customer/index', $pageData);
	}

	public function filterBySpecificCat($specificCatId = ''){
			$param = [
				'specificCatId' => $specificCatId
			];
			$paginationData = array(
				'rows'        => count($this->customermodel->filterBySpecificCat($param)),
				'base_url'    => base_url('customer/filterBySpecificCat/').$specificCatId,
				'model'       => 'customermodel',
				'method'      => 'filterBySpecificCat',
				'specificCatId'    => $specificCatId,		
				'uri_segment' => 4
			);
			$pageData['products'] = $this->paginate($paginationData);

			$pageData['pageTitle']   = 'Silicon - Buy and Sell your product';
			$pageData['pageHeading'] = 'Products';
			$this->load->view('customer/index', $pageData);
	}

	public function signup(){
		if($this->session->userdata('is_logged_in')){
			redirect('customer/customer');
		}else{
			$pageData['pageTitle'] = 'Create New Account';
			$this->load->view('customer/signup', $pageData);
		}
	}

	public function signup_validation(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'trim|is_unique[users.username]');
		$this->form_validation->set_rules('subscriptionType', 'Subscription Type', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[password]');

		$this->form_validation->set_message('is_unique', 'Exists');

		if($this->form_validation->run()){
			$this->load->library('email', array('mailtype' => 'html'));
			$this->email->from('mahmudul.ruet12@gmail.com', 'Mahmud');
			$this->email->to($this->input->post('email'));
			$this->email->subject('Email Confirmation');
			$key = md5(uniqid());
			$message = "<p><a href='".base_url()."index.php/customer/signupConfirm/$key'>Click Here</a> To confirm you account</p>";
			$this->email->message($message);

			$this->load->model('customermodel');
			if($this->customermodel->add_user($key)){
				if($this->email->send()){

					$titleData['pageTitle'] = 'Email Sent';
					$this->load->view('templates/customer/header2', $titleData);

					$pageData['mailsent'] = "Email has been sent";
					$pageData['clickhere'] =  "<p><a href='".base_url()."customer/signupConfirm/$key'>Click Here</a> To confirm the registration</p>";
					$pageData['complete'] = 0;

					$this->load->view('customer/userInfo/signupemailsent', $pageData);
					$this->load->view('templates/customer/footer2');
				}else{
					echo "Failed";
				}
			}
		}else{
			$pageData['pageTitle'] = 'Create New Account';
			$this->load->view('customer/signup', $pageData);
		}
	}

	public function signupConfirm($key){
		$this->load->model('customermodel');
		if($this->customermodel->signupConfirm($key)){
			$titleData['pageTitle'] = 'Successfully registered';
			$this->load->view('templates/customer/header2', $titleData);

			$pageData['success'] = "Successfully registered<br><br>";
			$pageData['loginLink'] = "<p><a href='".base_url()."customer/login'>Click here</a> to login</p>";
			$pageData['complete'] = 1;
			
			$this->load->view('customer/userInfo/signupemailsent', $pageData);

			$this->load->view('templates/customer/footer2');

		}else{
			echo "Failed";
		}
	}


	public function login(){
		if($this->session->userdata('is_logged_in')){
			redirect('customer/customer');
		}



//facebook function starts

		$userData = array();

        // Check if user is logged in
        if($this->facebook->is_authenticated()){
            // Get user facebook profile details
            $userProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture');

            // Preparing data for database insertion
            $userData['oauth_provider'] = 'facebook';
            $userData['oauth_uid'] = $userProfile['id'];
            $userData['firstName'] = $userProfile['first_name'];
            $userData['lastName'] = $userProfile['last_name'];
            $userData['email'] = $userProfile['email'];
            $userData['status'] = 1;
            $userData['signupKey'] = md5(uniqid());
            //$userData['gender'] = $userProfile['gender'];
            //$userData['locale'] = $userProfile['locale'];
            //$userData['profile_url'] = 'https://www.facebook.com/'.$userProfile['id'];
            //$userData['picture_url'] = $userProfile['picture']['data']['url'];
            // Insert or update user data
            $userID = $this->user->checkUser($userData);



            $userData['componentId'] = $userID;
            $userData['is_logged_in'] = 1;

            // Check user data insert or update status
            if(!empty($userID)){
                $data['userData'] = $userData;
                $this->session->set_userdata($userData);
            }else{
               $data['userData'] = array();
            }

            // Get logout URL
            $data['logoutUrl'] = $this->facebook->logout_url();
        }else{
            $fbuser = '';

            // Get login URL
            $data['authUrl'] =  $this->facebook->login_url();
        }
        	$data['pageTitle'] = 'Login';
			$this->load->view('customer/login', $data);
		
		
	}

	public function login_validation(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email', 'required|trim|callback_validation_credentials');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		if($this->form_validation->run()){
			$this->load->model('customermodel');
			$userInfo = $this->customermodel->user_info();

			$data = array();
			foreach ($userInfo as $row) {
				$data['componentId']  = $row['componentId'];
				$data['email']        = $row['email'];
				$data['firstName']    = $row['firstName'];
				$data['is_logged_in'] = 1;
			}

			$this->session->set_userdata($data);
			redirect('customer/index');
		}else{
			$this->load->view('customer/login');
		}
	}

	public function validation_credentials(){
		$this->load->model('customermodel');
		if($this->customermodel->can_log_in()){
			return true;
		}else{
			$this->form_validation->set_message('validation_credentials', 'Email/Password Incorrect please recover your password');
			return false;
		}

	}

	public function forgot_password(){
		if(!$this->session->userdata('is_logged_in')){
			$pageData['pageTitle'] = 'Recover Password';
			$this->load->view('customer/forgot_password_index', $pageData);
		}else{
			redirect('customer/customer');
		}
	}

	public function forgot_password_validation(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|callback_is_email_present');


		if($this->form_validation->run()){
			$this->load->library('email', array('mailtype' => 'html'));
			$this->email->from('mahmudul.ruet12@gmail.com', 'Mahmud');
			$this->email->to($this->input->post('email'));
			$this->email->subject('Recover Password');
			$key = md5(uniqid());
			$message = "<p><a href='".base_url()."index.php/customer/set_new_password/$key'>Click Here</a> to set new password<p>";
			$this->email->message($message);
			
				$this->load->model('customermodel');
				if($this->customermodel->update_key($key)){
					if($this->email->send()){

						$titleData['pageTitle'] = 'Check mail';
						$this->load->view('templates/customer/header2', $titleData);
						$pageData['mailsent'] = "Email has been sent<br><br>";
						$pageData['clickhere']= "<p><a href='".base_url()."customer/set_new_password/$key'>Click Here</a> to set new password<p>";
						$pageData['complete'] = 'recover_incomplete';

						$this->load->view('customer/userInfo/signupemailsent', $pageData);
						$this->load->view('templates/customer/footer2');
					}else{
						echo "Cannot send email";
					}
			}
			}else{
				$this->load->view('customer/forgot_password_index');
			}
	}

	public function is_email_present(){
		$this->load->model('customermodel');
		if($this->customermodel->is_email_present()){
			return true;
		}else{
			$this->form_validation->set_message('is_email_present', 'You are not a registered user');
			return false;
		}
	}

	public function recovery_email(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|callback_is_mail_absent');
		$this->form_validation->set_message('is_mail_absent', 'You are not a registered member');

		if($this->form_validation->run()){
			$this->load->library('email');
			$this->email->from('mahmudul.ruet12@gmail.com', 'Mahmud');
			$this->email->to($this->input->post('email'));
			$this->email->subject('Password recovery');
			$key = md5(uniqid());
			$message = "<p><a href='".base_url()."index.php/customer/set_new_password/$key'>Click here</a> to set new password</p>";

			$this->load->model('customermodel');

			if($this->customermodel->update_key($key)){
				if($this->mail->send()){
					echo "Mail has been sent";
					echo "<p><a href='".base_url()."index.php/customer/set_new_password/$key'>Click here</a> to set new password</p>";
				}
				
			}else{
				echo "key is not updated";
			}

			$this->email->message($message);
		}
	}

	public function set_new_password($key){
		if($this->session->userdata('is_logged_in')){
			redirect('customer/customer');
		}else{
			$data['key'] = $key;
			$data['pageTitle'] = 'Set New Password';

			$this->load->view('customer/set_new_password_index', $data);
		}
	}

	public function new_password_validation(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[password]');

		if($this->form_validation->run()){
			$this->load->model('customermodel');
			if($this->customermodel->update_password()){
				echo "<script>alert('Password updated successfully');</script>";
				$this->load->view('customer/login');
			}else{
				echo "Password could not be updated";
			}
		}else{
			$this->load->view('customer/set_new_password_index');
		}
	}



	public function is_mail_absent(){
		$this->load->model('customermodel');
		if($this->customermodel->is_mail_absent()){
			return true;
		}else{
			return false;
		}
	}

	public function userInfo(){
		if(!$this->session->userdata('is_logged_in')){
			redirect('customer/login');
		}

			//redirect('customer/login');
		$componentId = $this->session->userdata('componentId');
		$userInfo = $this->customermodel->userInfo($componentId);

		$pageData = array();
		foreach ($userInfo as $row) {
			$pageData['componentId'] = $componentId;
			$pageData['firstName'] = $row['firstName'];
			$pageData['lastName'] = $row['lastName'];
			$pageData['username'] = $row['username'];
			$pageData['subscriptionType'] = $row['subscriptionType'];
			$pageData['mobile'] = $row['mobile'];
			$pageData['presentAddress'] = $row['presentAddress'];
			$pageData['permanentAddress'] = $row['permanentAddress'];
			$pageData['email'] = $row['email'];
			$pageData['activeTab'] = 'userInfo';
			$pageData['pageTitle'] = 'User Control Panel';

		}
		
		$this->load->view('customer/userInfo/index', $pageData);
	}

	public function updateInfoValidation(){
		$this->form_validation->set_rules('firstName', 'First Name', 'required|alpha');
		$this->form_validation->set_message('alpha', 'Invalid {field}. Only alphabatical characters are allowed');

		$this->form_validation->set_rules('lastName', 'Last Name', 'required|alpha');
		$this->form_validation->set_message('alpha', 'Invalid {field}. Only alphabatical characters are allowed');

		$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[5]|max_length[12]|callback_isUserUnique');
		$this->form_validation->set_message('isUserUnique', '{field} exists');

		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric');

		$this->form_validation->set_rules('presentAddress', 'Present Address', 'trim');
		$this->form_validation->set_rules('permanentAddress', 'Permanent Address', 'trim');


		if($this->form_validation->run()){
			if($this->customermodel->updateUserInfo()){
				$this->session->set_flashdata('updateMsg' , 'Information Updated Successfully');
				
				redirect(base_url() . 'customer/userInfo', 'refresh');
			}else{
				echo "could not update";
			}
		}else{
			$pageData = array();
			$pageData['pageTitle'] = 'Update Information';
			$pageData['activeTab'] = 'userInfo';
			$this->load->view("customer/userInfo/index", $pageData);
		}
	}

	public function isUserUnique(){
		if($this->customermodel->isUserUnique()){
			return true;
		}else{
			return false;
		}
	}

	public function changePasswordValidation(){
		$this->form_validation->set_rules('curPassword', 'Current Password', 'trim|required|callback_curPasswordCorrect');
		$this->form_validation->set_message('curPasswordCorrect', '{field} is incorrect.');

		$this->form_validation->set_rules('newPassword', 'New Password', 'trim|required');
		$this->form_validation->set_rules('conPassword', 'Confirm Password', 'trim|required|matches[newPassword]');

		if($this->form_validation->run()){
			if($this->customermodel->changePassword()){
				$pageData = array();
				$pageData['activeTab'] = 'changePassword';
				$pageData['success']   = 'Password changed successfully';
				$this->load->view('customer/userInfo/index', $pageData);

			}else{
				echo "Password change error";
			}
		}else{
			$pageData = array();
			$pageData['activeTab'] = 'changePassword';
			$this->load->view('customer/userInfo/index', $pageData);
		}
	}

	public function curPasswordCorrect(){
		if($this->customermodel->curPasswordCorrect()){
			return true;
		}else{
			return false;
		}
	}

	public function manageProduct(){
		if($this->session->userdata('is_logged_in') != 1)
			redirect(base_url());

		if($this->customermodel->getProducts()){
			$pageData['products'] = $this->customermodel->getProducts();
			$pageData['productOptions'] = $this->customermodel->categories();
			
			$pageData['pageTitle'] = 'Manage Product';
			$this->load->view('manageProduct/manageProductIndex', $pageData);
		}else{
			echo "Failed";
		}
	}
	

	public function editProduct(){
		$pageData['products'] = $this->customermodel->editProduct();
		$pageData['pageTitle'] = 'Edit Product';
		$this->load->view('manageProduct/productEditIndex', $pageData);
	}

	public function editProductValidation(){

			$this->form_validation->set_rules('brandName', 'Brand Name', 'trim|required');
			$this->form_validation->set_rules('model', 'Product Model', 'trim|required');
			$this->form_validation->set_rules('price', 'Price', 'trim|required|numeric');
			$this->form_validation->set_rules('keyFeatures', 'Key Features', 'trim|required');
			$this->form_validation->set_rules('myimage', 'Image', 'trim|callback_imageValidation');

			if($this->form_validation->run()){

				$imagePaths = $this->doUpload();

				if($this->customermodel->updateProduct($imagePaths)){
					redirect('customer/manageProduct', 'refresh');
				}else{
					echo "Updating Failed";
				}
			}else{

				$pageData['products'] = $this->customermodel->productById();
				$pageData['pageTitle'] = 'Edit Product';
				$this->load->view('manageProduct/productEditIndex', $pageData);
			}
	}

	public function deleteImage(){
		if($this->customermodel->deleteImage()){
			$data['msg'] = 'true';
			echo json_encode($data);
		}
	}

	public function deleteProduct(){
		if($this->customermodel->deleteProduct()){
			$data['msg'] = 'true';
			echo json_encode($data);
		}
		//echo json_encode($productId);
	}

	public function postAdd(){
		if(!$this->session->userdata('is_logged_in'))
			redirect('customer/customer');

		$cats = $this->customermodel->getCat();
		$pageData['cats'] = $cats;
		$pageData['pageTitle'] = 'Post your add';
		$this->load->view('postAdd/index', $pageData);
	}

	public function addProductValidation(){
		$this->form_validation->set_rules('brandName', 'Brand Name', 'trim|required');
		$this->form_validation->set_rules('model', 'Product Model', 'trim|required');
		$this->form_validation->set_rules('price', 'Price', 'trim|required|numeric');
		$this->form_validation->set_rules('keyFeatures', 'Key Features', 'trim|required');
		$this->form_validation->set_rules('myimage', 'Image', 'trim|callback_imageValidation');

		if($this->form_validation->run()){

			$imagePaths = $this->doUpload();

			$this->customermodel->addProduct($imagePaths);

			redirect('customer/manageProduct', 'refresh');
		}else{
			$pageData['productOptions'] = $this->customermodel->categories();
			$pageData['pageTitle'] = 'Add Product';
			$this->load->view('postAdd/addFormIndex', $pageData);
		}
	}

	public function imageValidation(){

		$fileName = $_FILES['myimage']['name'];
		foreach ($fileName as $key=>$imageName) {
			if($imageName == '')
				continue;
			$imageName = explode('.', $imageName);
			$imageExtension = $imageName[count($imageName)-1];
			$imageExtension = strtolower($imageExtension);
			$permitted = array('png', 'jpg', 'jpeg');

			$formatValidity = in_array($imageExtension, $permitted);
			if($formatValidity){
				return true;
			}else{
				$this->form_validation->set_message('imageValidation', 'Valid format jpg, png, jpeg');
				return false;
			}

		}

		return true;
	}

	public function doUpload(){

		$fileName = $_FILES['myimage']['name'];

		$imagePaths = array();
		foreach ($fileName as $key=>$imageName) {
			if($imageName == '')
				continue;
			$imageName = explode('.', $imageName);
			$imageExtension = $imageName[count($imageName)-1];
			$imageExtension = strtolower($imageExtension);
			$permitted = array('png', 'jpg', 'jpeg');

			$formatValidity = in_array($imageExtension, $permitted);
			if($formatValidity){
				if(is_uploaded_file( $_FILES['myimage']['tmp_name'][$key] )){
					$newPath = "assets/images/product/".uniqid(time()).".".$imageExtension;
					if(move_uploaded_file( $_FILES['myimage']['tmp_name'][$key], $newPath )){
						
						array_push($imagePaths, $newPath);

					}else{
						echo "Failed";
					}
				}
			}else{
				
				echo "Failed";
			}

		}

		return $imagePaths;
}
	public function getSubcat(){
		$subCats = $this->customermodel->getSubcat();
		echo json_encode($subCats);
	}

	public function getSpecificCat(){
		$specificCats = $this->customermodel->getSpecificCat();
		echo json_encode($specificCats);
	}

	public function categories(){

		if(count($this->customermodel->categories()) == 0)
			redirect('customer/postAdd');

		$productOptions = $this->customermodel->categories();
		$pageData['productOptions'] = $productOptions;

		$pageData['pageTitle'] = 'Add product Features';
		$this->load->view('postAdd/addFormIndex', $pageData);
	}

	public function logout(){

		// Remove local Facebook session
        $this->facebook->destroy_session();

        // Remove user data from session
        $this->session->unset_userdata('userData');

		$this->session->sess_destroy();


		setcookie('not_logged_in_user', "", time() - 3600, "/");

		redirect('customer/login');
	}
}