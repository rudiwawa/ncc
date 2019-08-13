<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->library('form_validation');
        $this->load->view('template/header', [
                'bootstrap'=>true, 
                'home_page'=>true,
                'style'=>true,
                'colorBlue'=>true,
                'jquery'=>true,
                'morris'=>false,
                'style'=>false,
                'font_awesome_brand'=>true,
                'font_awesome_solid'=>true]);
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin//index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin//index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin//index.html';
            $config['first_url'] = base_url() . 'admin//index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Admin_model->total_rows($q);
        $admin = $this->Admin_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'admin_data' => $admin,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('admin//admin_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Admin_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_admin' => $row->id_admin,
		'nama_admin' => $row->nama_admin,
		'email_admin' => $row->email_admin,
		'password_admin' => $row->password_admin,
		'time_update' => date('Y-m-d'),
	    );
            $this->load->view('admin//admin_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin//create_action'),
	    'id_admin' => set_value('id_admin'),
	    'nama_admin' => set_value('nama_admin'),
	    'email_admin' => set_value('email_admin'),
	    'password_admin' => set_value('password_admin'),
	    'time_update' => date('Y-m-d'),
	);
        $this->load->view('admin//admin_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_admin' => $this->input->post('nama_admin',TRUE),
		'email_admin' => $this->input->post('email_admin',TRUE),
		'password_admin' => $this->input->post('password_admin',TRUE),
		'time_update' => date('Y-m-d'),
	    );

            $this->Admin_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Admin_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin//update_action'),
		'id_admin' => set_value('id_admin', $row->id_admin),
		'nama_admin' => set_value('nama_admin', $row->nama_admin),
		'email_admin' => set_value('email_admin', $row->email_admin),
		'password_admin' => set_value('password_admin', $row->password_admin),
		'time_update' => set_value('time_update', $row->time_update),
	    );
            $this->load->view('admin//admin_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_admin', TRUE));
        } else {
            $data = array(
		'nama_admin' => $this->input->post('nama_admin',TRUE),
		'email_admin' => $this->input->post('email_admin',TRUE),
		'password_admin' => $this->input->post('password_admin',TRUE),
		'time_update' => date('Y-m-d'),
	    );

            $this->Admin_model->update($this->input->post('id_admin', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Admin_model->get_by_id($id);

        if ($row) {
            $this->Admin_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_admin', 'nama admin', 'trim|required');
	$this->form_validation->set_rules('email_admin', 'email admin', 'trim|required');
	$this->form_validation->set_rules('password_admin', 'password admin', 'trim|required');

	$this->form_validation->set_rules('id_admin', 'id_admin', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

