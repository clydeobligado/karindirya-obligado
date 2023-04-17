<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


	public function index()
	{
		//load the helper
		$this->load->helper('url');
		//set the title for the header view
		$data['title'] = "Home";
		$this->load->view('include/header_view', $data);
		$this->load->view('home_view');
		$this->load->view('include/footer_view');

        
	}
	public function view_products()
	{
		//load the helper
		$this->load->helper('url');
		$this->load->model('Products_model');
		//fetch all the products from the database
		$data['products'] = $this->Products_model->getAllProducts();
		//set the title for the header view
		$data['title'] = "View All Products";
		$this->load->view('include/header_view', $data);
		$this->load->view('include/products_view', $data);
		$this->load->view('include/footer_view');
	}
}
