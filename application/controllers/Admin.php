<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('session');
        $this->load->model('Admin_model');
        $this->load->library('form_validation');
        $this->load->view('template/header', [
            'bootstrap' => true,
            'home_page' => true,
            'style' => true,
            'colorBlue' => true,
            'jquery' => true,
            'morris' => false,
            'style' => false,
            'font_awesome_brand' => true,
            'font_awesome_solid' => true]);
    }

    public function index()
    {
        redirect(site_url('admin_panel'));
    }

    public function login()
    {
        if (isset($this->session->email_admin)) {
            redirect(site_url('admin_panel'));
        } else {
            $data = array(
                'button' => 'Login',
                'action' => site_url('admin//login_action'),
                'id_admin' => set_value('id_admin'),
                'nama_admin' => set_value('nama_admin'),
                'email_admin' => set_value('email_admin'),
                'password_admin' => set_value('password_admin'),
                'time_update' => date('Y-m-d h:i:sa'),
            );
            $this->load->view('admin//admin_login', $data);
        }
    }
    public function login_action()
    {
        $this->_rules_login();

        if ($this->form_validation->run() == false) {
            $this->login();
        } else {
            $data = array(
                'email_admin' => $this->input->post('email_admin', true),
                'password_admin' => $this->input->post('password_admin', true),
            );
            $row = $this->Admin_model->get_by_email($data['email_admin']);
            $hash = $row->password_admin;
            // var_dump($hash);
            // var_dump($data['password_admin']);

            // var_dump(password_verify($data['password_admin'], $hash));
            if (password_verify($data['password_admin'], $hash)) {
                $_SESSION['email_admin'] = $data['email_admin'];
                $_SESSION['nama_admin'] = $row->nama_admin;
                var_dump($_SESSION['email_admin']);
                redirect(site_url("admin_panel"));
            } else {
                $this->login();
                echo 'Invalid password.';
            }

            // $this->Admin_model->insert($data);
            // $this->session->set_flashdata('message', 'Create Record Success');
            // redirect(site_url('admin'));
        }
    }

    public function logout()
    {
        session_destroy();
        redirect(site_url("admin/login"));
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
                'time_update' => date('Y-m-d h:i:sa'),
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
            'time_update' => date('Y-m-d h:i:sa'),
        );
        $this->load->view('admin//admin_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->create();
        } else {
            $data = array(
                'nama_admin' => $this->input->post('nama_admin', true),
                'email_admin' => $this->input->post('email_admin', true),
                'password_admin' => password_hash($this->input->post('password_admin', true), PASSWORD_DEFAULT),
                'time_update' => date('Y-m-d h:i:sa'),
            );

            $this->Admin_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin'));
        }
    }

    public function update()
    {
        if (!isset($this->session->email_admin)) {
            redirect(site_url('admin_panel'));
        } else {
            $row = $this->Admin_model->get_by_email($this->session->email_admin);

            if ($row) {
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('admin//update_action'),
                    'id_admin' => set_value('id_admin', $row->id_admin),
                    'nama_admin' => set_value('nama_admin', $row->nama_admin),
                    'email_admin' => set_value('email_admin', $row->email_admin),
                    'password_admin' => set_value(''),
                    'time_update' => set_value('time_update', $row->time_update),
                );
                $this->load->view('admin//admin_form', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('admin'));
            }
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->update($this->input->post('id_admin', true));
        } else {
            $data = array(
                'nama_admin' => $this->input->post('nama_admin', true),
                'email_admin' => $this->input->post('email_admin', true),
                'password_admin' => password_hash($this->input->post('password_admin', true), PASSWORD_DEFAULT),
                'time_update' => date('Y-m-d h:i:sa'),
            );

            $this->Admin_model->update($this->input->post('id_admin', true), $data);
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
        $this->form_validation->set_rules('email_admin', 'email admin', 'trim|required|valid_email');
        $this->form_validation->set_rules('password_admin', 'password admin', 'trim|required');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password_admin]');
        $this->form_validation->set_rules('id_admin', 'id_admin', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    public function _rules_login()
    {
        $this->form_validation->set_rules('email_admin', 'email admin', 'trim|required|valid_email');
        $this->form_validation->set_rules('password_admin', 'password admin', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
