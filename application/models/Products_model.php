<?php
class Products_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        //loads the database when model is loaded
        $this->load->database();
    }
        
    public function getAllProducts()
    {
        //get all the records
        $query = $this->db->get('tblproducts');
        $result = $query->result();
        return $result;
    }
    public function saveProduct($data)
    {
       //saves the product into the database.
       $this->db->insert('tblproducts', $data); 
    }
    public function getProduct($id)
    {
        //lodas the database
        $this->load->database();
        //makes the query using CI's query builder
        $query = $this->db->get_where('tblproducts', array('prod_id' => $id));
        // runs the query then returns the row
        $product = $query->row();
        //returns the product info from the datbase
        return $product;
    }

    public function editProduct($id, $data)
    {
        $this->load->database();
        $this->db->where('prod_id', $id);
        $this->db->update('tblproducts', $data);
    }
    public function deleteProduct($id)
    {
        //load DB
        $this->load->database();
        //where prod id is equals to the id in the parameter
        $this->db->where('prod_id', $id);
        //delete the product
        $this->db->delete('tblproducts');
    }
}