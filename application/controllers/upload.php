<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Upload extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library("aws_sdk");
        $this->load->library('upload');
    }

    public function index()
    {
        $this->load->view('upload_form', array('error' => ' '));
    }

    public function do_upload()
    {
        $upload_file = $_FILES['userfile'];
        $file_key = basename($upload_file['name']);
        echo var_dump($upload_file);
        $this->aws_sdk->saveObjectInBucket(
            array(
                "Bucket" => uniqid(),
                "Prefix" => "mytest",
                "Key" => $file_key,
                "Body" => $upload_file,
            ));
    }

}
