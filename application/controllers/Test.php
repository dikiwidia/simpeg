<?php

class Test extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
        }

        public function index()
        {
                $this->load->view('test/test', array('error' => ' ' ));
        }

        public function do_upload()
        {
                $config['upload_path']          = './upload/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        $this->load->view('test/test', $error);
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());

                        $this->load->view('test/test2', $data);
                }
        }
        public function resize(){
            $config['image_library'] = 'gd2';
            $config['source_image'] = './upload/3x4.jpg';
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = FALSE;
            $config['width']         = 256;
            $config['height']       = 256;
            
            $this->load->library('image_lib', $config);
            
            $this->image_lib->resize();
            echo $this->image_lib->display_errors();
        }
}
?>