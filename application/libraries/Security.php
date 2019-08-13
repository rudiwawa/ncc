<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Exenstion File Uploading Class
 */
		
class Security  {
    protected $Security;
    public function __construct()
        {
                // Assign the CodeIgniter super-object
                $this->Security =& get_instance();
        }

    public function akses_laman_admin (){
        if (!isset($this->session->email_admin)) {
            session_destroy();
            redirect(site_url('admin/login'));
        }
    }
}
?>