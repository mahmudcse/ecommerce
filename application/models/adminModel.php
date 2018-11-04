<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class AdminModel extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function canLogIn(){
		$username = $this->input->post('uname');
		$attemptPassword = $this->input->post('psw');

		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('username', $username);
		$this->db->or_where('emailAddress', $username);
		$userPassword = $this->db->get()->row_array();

		if(password_verify($attemptPassword, $userPassword['password'])){
			$adminData = array();
			$adminData = array(
					'admin_logged_in' => '1',
					'adminFirstName'    => $userPassword['firstName'],
					'componentId'  => $userPassword['componentId']
				);
			$this->session->set_userdata($adminData);
			return true;
		}else{
			return false;
		}
	}


	public function getCategories(){
		return $this->db->get('category')->result_array();
	}

	public function getSubCats(){
		return $this->db->get('subcategory')->result_array();
	}

	public function getSpecificCats(){
		return $this->db->get('specificcat')->result_array();
	}

	public function deleteCat(){
		$catId = $this->input->post('catId');

		$this->db->where('componentId', $catId);
		$this->db->delete('category');

		$this->db->where('catId', $catId);
		$this->db->delete('subcategory');

		$this->db->where('catId', $catId);
		$this->db->delete('specificcat');

		return true;
	}

	public function deleteSubCat(){
		$subCatId = $this->input->post('subCatId');

		$this->db->where('componentId', $subCatId);
		$this->db->delete('subcategory');

		$this->db->where('subcatId', $subCatId);
		$this->db->delete('specificcat');

		return true;
	}

	public function deleteSpecificCat(){
		$specificCatId = $this->input->post('specificCatId');

		$this->db->where('componentId', $specificCatId);
		$this->db->delete('specificcat');

		return true;
	}

	public function addCat(){
		$data = array();
		$data['catName'] = $this->input->post('cat');

		if($this->db->insert('category', $data)){
			return true;
		}
	}

	public function addSubCat(){
		$data = array();
		$data['subCatName'] = $this->input->post('subCat');
		$data['catId'] = $this->input->post('catId');

		if($this->db->insert('subcategory', $data)){
			return true;
		}
	}

	public function addSpecificCat(){
		$data = array();
		$data['specificCatName'] = $this->input->post('specificCatName');
		$data['catId'] 			 = $this->input->post('catId');
		$data['subcatId'] 		 = $this->input->post('subCatId');

		if($data['catId'] != '' && $data['subcatId'] != ''){
			if($this->db->insert('specificcat', $data)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function getCat(){
		$catId = $this->input->get('catId');
		return $this->db->get_where('category', array('componentId' => $catId))->row_array();
	}

	public function getSubCat(){
		$subCatId = $this->input->get('subCatId');
		return $this->db->get_where('subcategory', array('componentId' => $subCatId))->row_array();
	}

	public function updateCat(){
		$catId = $this->input->post('catId');

		$data = array();
		$data['catName'] = $this->input->post('catName');

		if($data['catName'] == ''){
			return false;
		}

		$this->db->where('componentId', $catId);
		$this->db->update('category', $data);

		return true;
	}

	public function updateSubCat(){
		$subCatId = $this->input->post('subCatId');

		$data = array();
		$data['subCatName'] = $this->input->post('subCat');

		$this->db->where('componentId', $subCatId);
		$this->db->update('subcategory', $data);

		return true;
	}

	public function updateSpecificCat(){
		$specificCatId = $this->input->post('specificCatId');

		$data = array();
		$data['specificCatName'] = $this->input->post('specificCatName');

		$this->db->where('componentId', $specificCatId);
		$this->db->update('specificcat', $data);

		return true;
	}

	public function getSubCatByCatId(){
		$catId = $this->input->get('catId');
		return $this->db->get_where('subcategory', array('catId' => $catId))->result_array();
	}

	public function getSpecificCatsBySubCatId(){
		$subCatId = $this->input->get('subCatId');
		return $this->db->get_where('specificcat', array('subcatId' => $subCatId))->result_array();
	}

	public function getSpecificCat(){
		$specificCatId = $this->input->get('specificCatId');
		return $this->db->get_where('specificcat', array('componentId' => $specificCatId))->row_array();
	}

	public function getOrders($param = array()){
		$orderId      = ($param['orderId'] == 'all')?'':$param['orderId'];
		$customerName = ($param['customerName'] == 'all')?'':$param['customerName'];
		$orderStatus  = ($param['orderStatus'] == 'all')?'':$param['orderStatus'];
		$transaction  = $param['transaction'];
		$paymentstatus  = ($param['paymentstatus'] == 'all')?'':$param['paymentstatus'];

		$this->db->select('`o`.`componentId`, 
						`o`.`userId`, 
						sum(od.price * od.quantity) total,
						o.firstName,
						o.lastName,
						o.mobile,
						`o`.`createDate`, 
						`o`.`payment_status`, 
						o.transaction_no,
						o.shippingStatus,
						`pm`.`name`, 
						`ps`.`status`, 
						ps.componentId pstatusId,
						`os`.`status` `shipping_status`');
		$this->db->from('`order` `o`');
		$this->db->join('order_details od', 'o.componentId = od.orderId', 'inner');
		$this->db->join('`payment_methods` `pm`', '`pm`.`componentId` = `o`.`payment_method`', 'inner');
		$this->db->join('payment_status` `ps`', '`o`.`payment_status` = `ps`.`componentId`', 'inner');
		$this->db->join('`order_status` os', '`o`.`shippingStatus` = `os`.`componentId`', 'inner');
		//$this->db->join('users u', 'o.userId = u.componentId', 'inner');
		$this->db->like('o.componentId', $orderId);
		$this->db->like('o.firstName', $customerName);
		$this->db->like('o.lastName', $customerName);

		if($orderStatus == ''){
			$this->db->like('o.shippingStatus', $orderStatus);
		}else{
			$this->db->where('o.shippingStatus', $orderStatus);
		}

		if($transaction == 'all'){
			$this->db->like('o.transaction_no', '');
		}else if($transaction == 1){
			$this->db->where('o.transaction_no', '');
		}else{
			$this->db->where('o.transaction_no !=', '');
		}

		if($paymentstatus == ''){
			$this->db->like('o.payment_status', $paymentstatus);
		}else{
			$this->db->where('o.payment_status', $paymentstatus);
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

		$this->db->group_by('o.componentId');

		//echo $this->db->get_compiled_select();
		//exit();
		return $this->db->get()->result_array();
	}

	public function getCustomers($param = array()){
		$NME       = ($param['NME'] == 'all')?'':$param['NME'];
		$condition = ($param['condition'] == 'all')?'':$param['condition'];

		$this->db->select('u.componentId,
							u.status,
							u.firstName,
							u.lastName,
							u.mobile,
							u.email');
		$this->db->from('users u');
		$likeCondition = "(u.firstName like '%".$NME."%' or u.lastName like '%".$NME."%' or u.mobile like '%".$NME."%' or u.email like '%".$NME."%' )";
		$this->db->where($likeCondition, NULL, FALSE);

		if($condition == ''){
			$this->db->like('u.status', $condition);
		}else{
			$this->db->where('u.status', $condition);
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
		return $this->db->get()->result_array();
	}

	public function changeCustomerCondition($condition = null, $customerId = null){

		$data['status'] = $condition;

		$this->db->where('componentId', $customerId);
		$updated = $this->db->update('users', $data);
		if($updated){
			return true;
		}else{
			return false;
		}
	}

	public function removeCustomer($customerId = null){
		$this->db->where('componentId', $customerId);
		$deleted = $this->db->delete('users');
		return $deleted?true:false;
	}

	public function paymentStatuses(){
		$this->db->select('*');
		$this->db->from('payment_status');
		$this->db->order_by('status', 'asc');
		return $this->db->get()->result_array();
	}

	public function orderStatuses(){
		$this->db->select('*');
		$this->db->from('order_status');
		$this->db->order_by('status', 'asc');
		return $this->db->get()->result_array();
	}

	public function changeShippingStatus($orderStatus = '', $orderId = ''){

		$data['shippingStatus'] = $orderStatus;
		$this->db->where('componentId', $orderId);
		$updated = $this->db->update('order', $data);

		if($updated){
			return true;
		}else{
			return false;
		}


	}

	public function removeOrder($orderId = ''){
		$this->db->where('componentId', $orderId);
		$deleted = $this->db->delete('order');
		if($deleted){
			return true;
		}else{
			return false;
		}
	}

	public function changePaymentStatus($paymentStatus = '', $orderId = ''){

		$data['payment_status'] = $paymentStatus;
		$this->db->where('componentId', $orderId);
		$updated = $this->db->update('order', $data);

		if($updated){
			return true;
		}else{
			return false;
		}
	}

	public function orderDetails($orderId = ''){

		$this->db->select('od.componentId,
						p.componentId productId,
						p.brandName,
						p.model,
						od.quantity');
		$this->db->from('order_details od');
		$this->db->join('`order` o', 'od.orderId = o.componentId', 'inner');
		$this->db->join('product p', 'od.productId = p.componentId', 'inner');
		$this->db->where('o.componentId', $orderId);
		return $this->db->get()->result_array();
		
	}

	public function changeQuantity($quantity = '', $detailId = ''){
		$data['quantity'] = $quantity;
		$this->db->where('componentId', $detailId);
		$updated = $this->db->update('order_details', $data);
		return $updated?true:false;
	}

	public function previousQuantity($detailId = ''){
		return $this->db->get_where('order_details', array('componentId' => $detailId))->row()->quantity;
	}

	public function removeOrderRow($detailId = ''){
		$this->db->where('componentId', $detailId);
		$deleted = $this->db->delete('order_details');
		if($deleted){
			return true;
		}else{
			return false;
		}
	}


	public function getProducts($param = array()){

		$productName = ($param['productName'] == 'all') ? '' : $param['productName'];
		$user        = ($param['user'] == 'all') ? '' : $param['user'];
		$status      = ($param['status'] == 'all') ? '' : $param['status'];
		$hot         = ($param['hot'] == 'all') ? '' : $param['hot'];
		

		$this->db->select('p.componentId, 
					p.userId, 
					p.brandName, 
					p.model, 
					p.status,
					p.hot,
					im.image, 
					u.firstName, 
					u.lastName, 
					u.mobile, 
					u.componentId userId');
		$this->db->from('product p');
		$this->db->join('users u', 'p.userId = u.componentId', 'inner');
		$this->db->join('productimages im', 'p.componentId = im.productId', 'left');

		$productCondition = "(p.brandName like '%".$productName."%' or p.model like '%".$productName."%')";
		$userCondition = "(u.firstName like '%".$user."%' or u.lastName like '%".$user."%')";

		$this->db->where($productCondition, NULL, FALSE);
		$this->db->where($userCondition, NULL, FALSE);

		if($status == ''){
			$this->db->like('p.status', $status);
		}else{
			$this->db->where('p.status', $status);
		}

		if($hot == ''){
			$this->db->like('p.hot', $hot);
		}else{
			$this->db->where('p.hot', $hot);
		}

		$this->db->group_by('p.brandName, p.model');

		if(isset($param['limit'])){
			$limit  = $param['limit'];
		}

		if(isset($param['limit']) && isset($param['offset'])){
			$offset = $param['offset'];
			$offset = $limit * ($offset-1);

			$this->db->limit($limit, $offset);
		}else if(isset($param['limit']) && empty($param['offset'])){
			$this->db->limit($limit);
		}

		$this->db->order_by('p.brandName', 'desc');



		//echo $this->db->get_compiled_select();
		//exit();
		$products = $this->db->get()->result_array();
		return (count($products) > 0) ? $products : false;
	}

	public function changeStatus($productId = null, $status = null){
		$data['status'] = $status;
		$this->db->where('componentId', $productId);
		$updated = $this->db->update('product', $data);
		return $updated?true:false;
	}

	public function changehot($productId = null, $hot = null){
		$data['hot'] = $hot;
		$this->db->where('componentId', $productId);
		$updated = $this->db->update('product', $data);
		return $updated?true:false;
	}

	public function deleteProduct($productId = null){
		$this->db->where('componentId', $productId);
		$deleted = $this->db->delete('product');
		return $deleted?true:false;
	}

	public function payments(){
		return $this->db->get('payment_methods')->result_array();
	}

	public function paymentEdit($paymentId = null){
		return $this->db->get('payment_methods', array('componentId' => $paymentId))->result_array();
	}
	public function paymentModify(){
		$paymentId = $this->input->post('paymentId');
		$data['Rules'] = nl2br($this->input->post('rules'));
		$this->db->where('componentId', $paymentId);
		$updated = $this->db->update('payment_methods', $data);
		return $updated?true:false;
	}

	public function transactionNo($param = array()){

		$transactionNo = ($param['transactionNo'] == 'all') ? '' : $param['transactionNo'];
		$used          = ($param['used'] == 'all') ? '' : $param['used'];
		$dateFrom      = $param['dateFrom'];
		$dateTo        = $param['dateTo'];
		
		$this->db->select('*');
		$this->db->from('transactionno');

		$this->db->like('transaction_no', $transactionNo);
		$this->db->like('used', $used);
		$this->db->where('updated_at > ', $dateFrom);
		$this->db->where('updated_at < ', $dateTo);

		if(isset($param['limit'])){
			$limit  = $param['limit'];
		}

		if(isset($param['limit']) && isset($param['offset'])){
			$offset = $param['offset'];
			$offset = $limit * ($offset-1);

			$this->db->limit($limit, $offset);
		}else if(isset($param['limit']) && empty($param['offset'])){
			$this->db->limit($limit);
		}

		$this->db->order_by('amount', 'asc');



		//echo $this->db->get_compiled_select();
		//exit();
		return $this->db->get()->result_array();
		//return (count($transactions) > 0) ? $transactions : false;
	}

	public function transactionSave(){
		$data['transaction_no'] = $this->input->post('transactionNO');
		$data['bank'] = $this->input->post('bank');
		$data['amount'] = $this->input->post('amount');
		$data['used'] = $this->input->post('used');
		$data['orderId'] = $this->input->post('orderId');
		$data['updated_at'] = date('Y-m-d H:i:s');

		return $this->db->insert('transactionno', $data);
	}

	public function transactionEdit($transactionId = null){

		$this->db->select('componentId, transaction_no transactionNO, bank, amount, used, orderId');
		$this->db->from('transactionno');
		$this->db->where('componentId', $transactionId);

		return $this->db->get()->result_array();
	}

	public function transactionModify($transactionId = null){
		$data['transaction_no'] = $this->input->post('transactionNO');
		$data['bank'] = $this->input->post('bank');
		$data['amount'] = $this->input->post('amount');
		$data['used'] = $this->input->post('used');
		$data['orderId'] = $this->input->post('orderId');
		$data['updated_at'] = date('Y-m-d H:i:s');

		$this->db->where('componentId', $transactionId);
		return $this->db->update('transactionno', $data);
	}
	public function transactionDelete($transactionId = null){
		$this->db->where('componentId', $transactionId);
		return $this->db->delete('transactionno');
	}

	public function events($param = array()){
		$name       = ($param['name'] == 'all')?'':$param['name'];
		$status     = ($param['status'] == 'all')?'':$param['status'];

		$this->db->select('*');
		$this->db->from('events');

		$this->db->like('name', $name);

		if($status == ''){
			$this->db->like('status', $status);
		}else{
			$this->db->where('status', $status);
		}

		$this->db->order_by('name', 'asc');

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
		return $this->db->get()->result_array();
	}

	public function eventSave(){
		$data['name'] = $this->input->post('name');
		$data['caption'] = $this->input->post('caption');
		$data['status'] = $this->input->post('status');

		return $this->db->insert('events', $data);
	}

	public function eventEdit($eventId = null){

		$this->db->select('*');
		$this->db->from('events');
		$this->db->where('componentId', $eventId);

		return $this->db->get()->result_array();
	}

	public function eventModify($eventId = null){
		$data['name'] = $this->input->post('name');
		$data['caption'] = $this->input->post('caption');
		$data['status'] = $this->input->post('status');

		$this->db->where('componentId', $eventId);
		return $this->db->update('events', $data);
	}

	public function eventDelete($eventId = null){
		$this->db->where('componentId', $eventId);
		return $this->db->delete('events');
	}

	public function getEvents(){
		$this->db->select('*');
		$this->db->from('events');
		$this->db->order_by('name', 'asc');
		return $this->db->get()->result();
	}

	public function addProductToEvent($productId = null, $eventId = null){

		$isProductExists = $this->db->get_where('products_for_event', array('eventId' => $eventId, 'productId' => $productId))->result_array();
		if(count($isProductExists) > 0){
			$data['productExists'] = true;
			return $data;
		}

		$data['productId'] = $productId;
		$data['eventId'] = $eventId;
		return $this->db->insert('products_for_event', $data);
	}
}