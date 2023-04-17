<?php
class Products extends CI_Controller 
{
    public function __construct()
    {
        //never load libraries or models in here
        parent::__construct();
    }
	public function index()
	{
		//load the helper
		$this->load->helper(array('form', 'url'));
		
		$data['title'] = "Add Product";
		$this->load->view('include/header_view', $data);
		$this->load->view('include/add_product_view');
		$this->load->view('include/footer_view', $data);
	}
	public function processAddProduct()
    {
        //includes the form validation library.
        $this->load->library('form_validation');
        //load database. 
        $this->load->database();
        //set form validation rules.
        $this->form_validation->set_rules('prod_name', 'Product_Name', 'required|is_unique[tblproducts.prod_name]', array('is_unique' => 'Product name already exist'));
        $this->form_validation->set_rules('prod_description', 'Product description', 'required');
        //prod price has a numeric in the rule section of the set_rules()
        $this->form_validation->set_rules('prod_price', 'Product Price', 'required|numeric');
    
        //Run form validation
        if($this->form_validation->run() == FALSE){
            $this->index();
        } else {
            $data = array(
                'prod_name' => $this->input->post('prod_name'),
                'prod_description' => $this->input->post('prod_description'),
                'prod_price' => $this->input->post('prod_price')
            );
            //loads hte product model
            //kaya natin dito nilagay kasi dito lang gagamitin.
            $this->load->model('Products_model');
            $this->Products_model->saveProduct($data);
            redirect('home,view_products');
        }
    
    }
}
