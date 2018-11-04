<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
* 
*/
class Admin extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('AdminModel');
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	public function index(){
		if($this->session->userdata('admin_logged_in') == 1)
			$this->load->view('admin/dashboardIndex');

		$this->load->view('admin/login/loginIndex');
	}

	public function loginValidation(){

		$this->form_validation->set_rules('psw', 'User Name', 'trim');
		$this->form_validation->set_rules('uname', 'User Name', 'trim|callback_canLogIn');
		

		if($this->form_validation->run()){
			redirect('admin', 'refresh');
		}else{
			$this->load->view('admin/login/loginIndex');
		}
	}

	public function canLogIn(){
		if($this->AdminModel->canLogIn()){
			return true;
		}else{
			$this->form_validation->set_message('canLogIn', 'Username or Password Invalid!');
			return false;
		}
	}

	public function logout(){
		//$this->prntArr($this->session->userdata);
		$this->session->unset_userdata('admin_logged_in');
		$this->session->unset_userdata('adminFirstName');
		$this->session->unset_userdata('componentId');
		$this->session->sess_destroy();
		redirect('admin', 'refresh');
	}

	public function manageCategory(){

		if($this->session->userdata('admin_logged_in') != 1)
			redirect('admin', 'refresh');

		$pageData['categories'] = $this->AdminModel->getCategories();
		$this->load->view('admin/menuManagement/categoryIndex', $pageData);
	}

	public function manageSubCat(){

		if($this->session->userdata('admin_logged_in') != 1)
			redirect('admin', 'refresh');

		$pageData['subCats'] = $this->AdminModel->getSubCats();
		$pageData['cats'] = $this->AdminModel->getCategories();
		$this->load->view('admin/menuManagement/subcategoryIndex', $pageData);
	}

	public function manageSpecificCat(){

		if($this->session->userdata('admin_logged_in') != 1)
			redirect('admin', 'refresh');

		$pageData['specificCats'] = $this->AdminModel->getSpecificCats();
		$pageData['cats'] = $this->AdminModel->getCategories();
		$this->load->view('admin/menuManagement/specificCatIndex', $pageData);
	}

	

	public function deleteCat(){
		$deleted['msg'] = $this->AdminModel->deleteCat();
		echo json_encode($deleted);
	}

	public function deleteSubCat(){
		$deleted['msg'] = $this->AdminModel->deleteSubCat();
		echo json_encode($deleted);
	}

	public function deleteSpecificCat(){
		$deleted['msg'] = $this->AdminModel->deleteSpecificCat();
		echo json_encode($deleted);
	}

	public function addCat(){
		if($this->AdminModel->addCat()){
			redirect('admin/manageCategory');
		}
	}

	public function addSubCat(){
		if($this->AdminModel->addSubCat()){
			redirect('admin/manageSubCat');
		}
	}

	public function addSpecificCat(){
		if($this->AdminModel->addSpecificCat()){
			$this->session->set_flashdata('flash_message' , 'Data Added');
		}else{
			$this->session->set_flashdata('flash_message' , 'Drop Downs Can not be empty');
		}
		redirect('admin/manageSpecificCat');
	}

	
	public function getCat(){
		$data = $this->AdminModel->getCat();

		echo json_encode($data);
	}

	public function getSubCat(){
		$data = $this->AdminModel->getSubCat();

		echo json_encode($data);
	}

	public function updateCat(){
		$data = $this->AdminModel->updateCat();
			echo json_encode($data);
	}

	public function updateSubCat(){
		$data = $this->AdminModel->updateSubCat();
			echo json_encode($data);
	}

	public function updateSpecificCat(){
		$data = $this->AdminModel->updateSpecificCat();
			echo json_encode($data);
	}

	public function getSubCatByCatId(){
		$data = $this->AdminModel->getSubCatByCatId();
		echo json_encode($data);
	}

	public function getSpecificCatsBySubCatId(){
		$data = $this->AdminModel->getSpecificCatsBySubCatId();
		echo json_encode($data);
	}

	public function getSpecificCat(){
		$data = $this->AdminModel->getSpecificCat();
		echo json_encode($data);
	}

	public function orders($orderId = null, $customerName = null, $orderStatus = null, $transaction = null, $paymentstatus = null){

		$param = array();

		if($this->input->post('orderId') && is_null($orderId)){
			$param['orderId'] = $this->input->post('orderId');
		}else if($orderId && empty($this->input->post('orderId'))){
			$param['orderId'] = $orderId;
		}else if(is_null($orderId)){
			$param['orderId'] = 'all';
		}

		if($this->input->post('customerName') && is_null($customerName)){
			$param['customerName'] = $this->input->post('customerName');
		}else if($customerName && empty($this->input->post('customerName'))){
			$param['customerName'] = $customerName;
		}else if(is_null($customerName)){
			$param['customerName'] = 'all';
		}

		if($this->input->post('orderStatus') && is_null($orderStatus)){
			$param['orderStatus'] = $this->input->post('orderStatus');
		}else if($orderStatus && empty($this->input->post('orderStatus'))){
			$param['orderStatus'] = $orderStatus;
		}else if(is_null($orderStatus)){
			$param['orderStatus'] = 'all';
		}

		if($this->input->post('transaction') && is_null($transaction)){
			$param['transaction'] = $this->input->post('transaction');
		}else if($transaction && empty($this->input->post('transaction'))){
			$param['transaction'] = $transaction;
		}else if(is_null($transaction)){
			$param['transaction'] = 'all';
		}

		if($this->input->post('paymentstatus') && is_null($paymentstatus)){
			$param['paymentstatus'] = $this->input->post('paymentstatus');
		}else if($paymentstatus && empty($this->input->post('paymentstatus'))){
			$param['paymentstatus'] = $paymentstatus;
		}else if(is_null($paymentstatus)){
			$param['paymentstatus'] = 'all';
		}

		$paginationData = array(
				'rows'        => count($this->AdminModel->getOrders($param)),
				'base_url'    => base_url('admin/orders/').$param['orderId'].'/'.$param['customerName'].'/'.$param['orderStatus'].'/'.$param['transaction'].'/'.$param['paymentstatus'],
				'uri_segment' => 8,
				'model'       => 'AdminModel',
				'method'      => 'getOrders'
			);

		$paginationData = $paginationData + $param;

		$pageData['paymentStatuses'] = $this->AdminModel->paymentStatuses();
		$pageData['orderStatuses'] = $this->AdminModel->orderStatuses();
		
		$pageData['orders']    = paginate($paginationData);

		$pageData['orderId']      = $param['orderId'];
		$pageData['customerName'] = $param['customerName'];
		$pageData['orderStatus']  = $param['orderStatus'];
		$pageData['transaction']  = $param['transaction'];
		$pageData['paymentstatus']  = $param['paymentstatus'];


		$this->load->view('admin/orders/index', $pageData);
	}

	public function changeShippingStatus($orderStatus = '', $orderId = ''){
		$updated = $this->AdminModel->changeShippingStatus($orderStatus, $orderId);
		echo json_encode($updated);
	}

	public function removeOrder($orderId = ''){
		$deleted = $this->AdminModel->removeOrder($orderId);
		echo json_encode($deleted);
	}

	public function changePaymentStatus($paymentStatus = '', $orderId = ''){
		$updated = $this->AdminModel->changePaymentStatus($paymentStatus, $orderId);
		echo json_encode($updated);
	}

	public function orderDetails($orderId = ''){
		$data['detailedOrder'] = $this->AdminModel->orderDetails($orderId);

		$this->load->view('admin/orders/indexDetails', $data);
	}

	public function changeQuantity($quantity = '', $detailId = ''){
		$updated = $this->AdminModel->changeQuantity($quantity = '', $detailId = '');
		echo json_encode($updated);
	}

	public function previousQuantity($detailId = ''){
		$quantity = $this->AdminModel->previousQuantity($detailId);
		echo json_encode($quantity);
	}

	public function removeOrderRow($detailId = ''){
		$removed = $this->AdminModel->removeOrderRow($detailId);
		echo json_encode($removed);
	}

	public function customers($NME = null, $condition = null){
		//NME = name, mobile, email
		$param = array();

		if($this->input->post('NME') && is_null($NME)){
			$param['NME'] = $this->input->post('NME');
		}else if($NME && empty($this->input->post('NME'))){
			$param['NME'] = $NME;
		}else if(is_null($NME)){
			$param['NME'] = 'all';
		}

		if($this->input->post('condition') && is_null($condition)){
			$param['condition'] = $this->input->post('condition');
		}else if($condition && empty($this->input->post('condition'))){
			$param['condition'] = $condition;
		}else if(is_null($condition)){
			$param['condition'] = 'all';
		}

		$paginationData = array(
				'rows'        => count($this->AdminModel->getCustomers($param)),
				'base_url'    => base_url('admin/customers/').$param['NME'].'/'.$param['condition'],
				'uri_segment' => 5,
				'model'       => 'AdminModel',
				'method'      => 'getCustomers'
			);

		$paginationData = $paginationData + $param;

		
		$pageData['customers']    = paginate($paginationData);

		$pageData['NME']        = $param['NME'];
		$pageData['condition']  = $param['condition'];

		$this->load->view('admin/customers/index', $pageData);
	}

	public function changeCustomerCondition($condition = null, $customerId = null){
		$updated = $this->AdminModel->changeCustomerCondition($condition, $customerId);
		echo json_encode($updated);
	}

	public function removeCustomer($customerId = null){
		$deleted = $this->AdminModel->removeCustomer($customerId);
		echo json_encode($deleted);
	}

	public function products($productName = null, $user = null, $status = null, $hot = null){
		$param = array();

		if($this->input->post('productName') && is_null($productName)){
			$param['productName'] = $this->input->post('productName');
		}else if($productName && empty($this->input->post('productName'))){
			$param['productName'] = $productName;
		}else if(is_null($productName)){
			$param['productName'] = 'all';
		}

		if($this->input->post('user') && is_null($user)){
			$param['user'] = $this->input->post('user');
		}else if($user && empty($this->input->post('user'))){
			$param['user'] = $user;
		}else if(is_null($user)){
			$param['user'] = 'all';
		}

		if($this->input->post('status') && is_null($status)){
			$param['status'] = $this->input->post('status');
		}else if($status && empty($this->input->post('status'))){
			$param['status'] = $status;
		}else if(is_null($status)){
			$param['status'] = 'all';
		}

		if($this->input->post('hot') && is_null($hot)){
			$param['hot'] = $this->input->post('hot');
		}else if($hot && empty($this->input->post('hot'))){
			$param['hot'] = $hot;
		}else if(is_null($hot)){
			$param['hot'] = 'all';
		}

		$paginationData = array(
				'rows'        => count($this->AdminModel->getProducts($param)),
				'base_url'    => base_url('admin/products/').$param['productName'].'/'.$param['user'].'/'.$param['status'].'/'.$param['hot'],
				'uri_segment' => 7,
				'model'       => 'AdminModel',
				'method'      => 'getProducts'
			);

		$paginationData = $paginationData + $param;
		
		$pageData['products']    = paginate($paginationData);


		if($this->uri->segment($paginationData['uri_segment'])){
			$pageNumber = $this->uri->segment($paginationData['uri_segment']);
		}else{
			$pageNumber = 1;
		}
		$per_page = $this->pagination->per_page;

		$pageData['count_from'] = $per_page * ($pageNumber - 1);

		$pageData['productName']  = $param['productName'];
		$pageData['user']         = $param['user'];
		$pageData['status']       = $param['status'];
		$pageData['hot']          = $param['hot'];
		$pageData['events']       = json_encode($this->AdminModel->getEvents());
		

		$this->load->view('admin/products/index', $pageData);
	}

	public function changeStatus($productId = null, $status = null){
		$updated = $this->AdminModel->changeStatus($productId, $status);
		echo json_encode($updated);
	}

	public function changehot($productId = null, $hot = null){
		$updated = $this->AdminModel->changehot($productId, $hot);
		echo json_encode($updated);
	}

	public function deleteProduct($productId = null){
		$deleted = $this->AdminModel->deleteProduct($productId);
		echo json_encode($deleted);
	}

	public function payments(){
		$data['payments'] = $this->AdminModel->payments();
		$this->load->view('admin/payments/mobile/index', $data);
	}
	public function paymentEdit($paymentId = null){
		$data['payment'] = $this->AdminModel->paymentEdit($paymentId);
		$data['paymentId'] = $paymentId;
		$this->load->view('admin/payments/mobile/editIndex', $data);
	}
	public function paymentModify(){
		$updated = $this->AdminModel->paymentModify();
		redirect('admin/payments');
	}

	public function transactionNo($transactionNo = null, $used = null, $dateFrom = null, $dateTo = null){
		$param = array();

		if($this->input->post('transactionNo') && is_null($transactionNo)){
			$param['transactionNo'] = $this->input->post('transactionNo');
		}else if($transactionNo && empty($this->input->post('transactionNo'))){
			$param['transactionNo'] = $transactionNo;
		}else if(is_null($transactionNo)){
			$param['transactionNo'] = 'all';
		}

		if($this->input->post('used') && is_null($used)){
			$param['used'] = $this->input->post('used');
		}else if($used && empty($this->input->post('used'))){
			$param['used'] = $used;
		}else if(is_null($used)){
			$param['used'] = 'all';
		}

		if($this->input->post('dateFrom') && is_null($dateFrom)){
			$param['dateFrom'] = $this->input->post('dateFrom');
		}else if($dateFrom && empty($this->input->post('dateFrom'))){
			$param['dateFrom'] = $dateFrom;
		}else if(is_null($dateFrom)){
			$param['dateFrom'] = date('Y-m-d', strtotime('-7 days'));
		}

		if($this->input->post('dateTo') && is_null($dateTo)){
			$param['dateTo'] = $this->input->post('dateTo');
		}else if($dateTo && empty($this->input->post('dateTo'))){
			$param['dateTo'] = $dateTo;
		}else if(is_null($dateTo)){
			$param['dateTo'] = date('Y-m-d', strtotime('+1 day'));
		}

		$paginationData = array(
				'rows'        => count($this->AdminModel->transactionNo($param)),
				'base_url'    => base_url('admin/transactionNo/').$param['transactionNo'].'/'.$param['used'].'/'.$param['dateFrom'].'/'.$param['dateTo'],
				'uri_segment' => 7,
				'model'       => 'AdminModel',
				'method'      => 'transactionNo'
			);

		$paginationData = $paginationData + $param;
		
		$pageData['transactions']    = paginate($paginationData);

		if($this->uri->segment($paginationData['uri_segment'])){
			$pageNumber = $this->uri->segment($paginationData['uri_segment']);
		}else{
			$pageNumber = 1;
		}
		$per_page = $this->pagination->per_page;

		$pageData['count_from'] = $per_page * ($pageNumber - 1);

		$pageData['transactionNo']  = $param['transactionNo'];
		$pageData['used']           = $param['used'];
		$pageData['dateFrom']       = $param['dateFrom'];
		$pageData['dateTo']         = $param['dateTo'];
		$pageData['active']         = 'report';


		$this->load->view('admin/transactions/index', $pageData);
	}

	public function transactionNoAdd(){
		$data['active'] = 'add';
		$this->load->view('admin/transactions/index', $data);
	}
	public function transactionSave(){
		if($this->AdminModel->transactionSave()){
			redirect('admin/transactionNo');
		}
	}

	public function transactionEdit($transactionId = null){
		$data['transaction'] = $this->AdminModel->transactionEdit($transactionId);
		$data['active'] = 'edit';
		$this->load->view('admin/transactions/index', $data);
	}

	public function transactionModify($transactionId = null){
		$updated = $this->AdminModel->transactionModify($transactionId);
		if($updated){
			redirect('admin/transactionNo');
		}
		
	}
	public function transactionDelete($transactionId = null){
		$deleted = $this->AdminModel->transactionDelete($transactionId);
		echo json_encode($deleted);
	}

	public function events($name = null, $status = null){
		$param = array();

		if($this->input->post('name') && is_null($name)){
			$param['name'] = $this->input->post('name');
		}else if($name && empty($this->input->post('name'))){
			$param['name'] = $name;
		}else if(is_null($name)){
			$param['name'] = 'all';
		}

		if($this->input->post('status') && is_null($status)){
			$param['status'] = $this->input->post('status');
		}else if($status && empty($this->input->post('status'))){
			$param['status'] = $status;
		}else if(is_null($status)){
			$param['status'] = 'all';
		}

		$paginationData = array(
				'rows'        => count($this->AdminModel->events($param)),
				'base_url'    => base_url('admin/events/').$param['name'].'/'.$param['status'],
				'uri_segment' => 5,
				'model'       => 'AdminModel',
				'method'      => 'events'
			);

		$paginationData = $paginationData + $param;
		
		$pageData['events']    = paginate($paginationData);

		if($this->uri->segment($paginationData['uri_segment'])){
			$pageNumber = $this->uri->segment($paginationData['uri_segment']);
		}else{
			$pageNumber = 1;
		}
		$per_page = $this->pagination->per_page;

		$pageData['count_from'] = $per_page * ($pageNumber - 1);

		$pageData['name']   = $param['name'];
		$pageData['status'] = $param['status'];

		$pageData['active'] = 'report';


		$this->load->view('admin/events/index', $pageData);
	}
	public function eventAdd(){
		$data['active'] = 'add';
		$this->load->view('admin/events/index', $data);
	}
	public function eventSave(){
		if($this->AdminModel->eventSave()){
			redirect('admin/events');
		}
	}

	public function eventEdit($eventId = null){
		$data['event'] = $this->AdminModel->eventEdit($eventId);
		$data['active'] = 'edit';
		$this->load->view('admin/events/index', $data);
	}

	public function eventModify($eventId = null){
		$updated = $this->AdminModel->eventModify($eventId);
		if($updated){
			redirect('admin/events');
		}
		
	}
	public function eventDelete($eventId = null){
		$deleted = $this->AdminModel->eventDelete($eventId);
		echo json_encode($deleted);
	}

	public function getEvents(){
		$events = $this->AdminModel->getEvents();
		echo json_encode($events);
	}

	public function addProductToEvent($productId = null, $eventId = null){
		$inserted = $this->AdminModel->addProductToEvent($productId, $eventId);
		echo json_encode($inserted);
	}
}