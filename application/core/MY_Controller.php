<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

  protected $_accessable;
  protected $_csrf;

  public function __construct()
  {
    parent::__construct();

    $this->load->library('ion_auth');
  }

  public function _remap($method, $param=array())
  {
    if (method_exists($this, $method)) {
      if ($this->ion_auth->logged_in() || $this->_accessable || $this->ion_auth->is_admin()) {
        return call_user_func_array(array($this, $method), $param);
      }else{
        $this->go('auth');
      }
    }else{
      show_404();
    }
  }

    /**
     * Berfungsi untuk melakukan redirect
     * @param $link = alamat tujuan
     */
    protected function go($link)
    {
      redirect(site_url($link));
    }

    /**
     * Berfungsi untuk mengeksekusi view
     */
    protected function render($view, $data = array())
    {
      $data['csrf'] = $this->_csrf;
      $this->blade->render($view, $data);
    }

    /**
     * Berfungsi untuk menampilkan membuat input csrf tipe hidden
     *
     * @return string
     */
    protected function generateCsrf()
    {
      return $this->_csrf = "<input type='hidden' name='". $this->security->get_csrf_token_name() ."' value='". $this->security->get_csrf_hash() ."'>";
    }

    /**
     * Berfungsi untuk menampilkan pesan
     *
     * @param string $msg = isi pesan
     * @param string $typ = tipe pesan (default, primary, success, warning, danger)
     */
    protected function message($msg = 'pesan', $typ = 'info')
    {
      $this->session->set_flashdata('message', array($msg, $typ));
    }

    /**
     * @param $table - Table Name
     * @param $title - Field as reference for slug
     */
    protected function slug_config($table, $title){
      $config = array(
        'table' => $table,
        'id' => 'id',
        'field' => 'slug',
        'title' => $title,
      'replacement' => 'dash' // Either dash or underscore
      );
      $this->slug->set_config($config);
    }
  }