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
        $this->load->helper(array('form', 'url'));
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

    public function viewProduct($id)
    {
        $this->load->helper(array('form', 'url'));

        $data ['title'] = "Edit Product";
        //load the products model
        $this->load->model('Products_model');
        //fetch the product using the id provided in the parameter
        $data['product'] = $this->Products_model->getProduct($id);

        //is for checking if the view is edit or view item
        $data ['edit'] = false;
        $this->load->view('include/header_view', $data);
        $this->load->view('edit_product_view', $data);
        $this->load->view('include/footer_view');
    }
    


    public function processEditProduct($id)
    {
        $this->load->helper(array('form', 'url'));
        //includes the form validation library.
        $this->load->library('form_validation');
        //load database. 
        $this->load->database();
        //set form validation rules.
        $this->form_validation->set_rules('prod_name', 'Product_Name', 'required');
        $this->form_validation->set_rules('prod_description', 'Product description', 'required');
        //prod price has a numeric in the rule section of the set_rules()
        $this->form_validation->set_rules('prod_price', 'Product Price', 'required|numeric');
    
        //Run form validation
        if($this->form_validation->run() == FALSE){
            $this->editProduct($id);
        } else {
            $data = array(
                'prod_name' => $this->input->post('prod_name'),
                'prod_description' => $this->input->post('prod_description'),
                'prod_price' => $this->input->post('prod_price')
            );
            //loads hte product model
            //kaya natin dito nilagay kasi dito lang gagamitin.
            $this->load->model('Products_model');
            $this->Products_model->editProduct($id, $data);
            redirect('home,view_products');
        }
    }

    public function processDelete($id)
    {
        $this->load->helper('url');
        //loads hte product model
            //kaya natin dito nilagay kasi dito lang gagamitin.
            $this->load->model('Products_model');
            $this->Products_model->deleteProduct($id);
            redirect('home,view_products');
    }
}
