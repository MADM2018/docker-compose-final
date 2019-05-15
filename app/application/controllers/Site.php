<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

	function __construct()
    {
        parent::__construct();

        $this->logged_in = $this->session->logged_in ? TRUE : FALSE;
        $this->login_user_id = $this->session->login_user_id ? $this->session->login_user_id : '';
        $this->login_email = $this->session->login_email ? $this->session->login_email : '';
        $this->login_nickname = $this->session->login_nickname ? $this->session->login_nickname : '';
        $this->login_user_type = $this->session->login_user_type ? $this->session->login_user_type : '';

        $this->load->library('form_validation');
    }

    public function update()
    {
    	$this->articles->upd();

    }

	public function index()
	{
        $data['title'] = "NotiFresh.com - El mejor contenido de la red";
        $data['active'] = "index";

        $data['og_type'] = "website";
        $data['og_description'] = "El mejor contenido de la red";
        $data['og_url'] = site_url('site/index');
        $data['og_image'] = base_url('assets/images/logo.png');

		$this->_load_layout('index.php',$data);
	}

    public function science()
    {
        $data['title'] = "Ciencia";
        $data['active'] = "science";

        $data['og_type'] = "website";
        $data['og_description'] = "El mejor contenido de la red";
        $data['og_url'] = site_url('site/science');
        $data['og_image'] = base_url('assets/images/logo.png');

        $data['articles'] = $this->articles->get_articles_by_category("science");

        $this->_load_article_list($data);
    }

    public function curiosity()
    {
        $data['title'] = "Curiosidades";
        $data['active'] = "curiosity";

        $data['og_type'] = "website";
        $data['og_description'] = "El mejor contenido de la red";
        $data['og_url'] = site_url('site/curiosity');
        $data['og_image'] = base_url('assets/images/logo.png');

        $data['articles'] = $this->articles->get_articles_by_category("curiosity");

        $this->_load_article_list($data);
    }

    public function health()
    {
        $data['title'] = "Salud";
        $data['active'] = "health";

        $data['og_type'] = "website";
        $data['og_description'] = "El mejor contenido de la red";
        $data['og_url'] = site_url('site/health');
        $data['og_image'] = base_url('assets/images/logo.png');

        $data['articles'] = $this->articles->get_articles_by_category("health");

        $this->_load_article_list($data);
    }

    public function videos()
    {
        $data['title'] = "Videos";
        $data['active'] = "videos";

        $data['og_type'] = "website";
        $data['og_description'] = "El mejor contenido de la red";
        $data['og_url'] = site_url('site/videos');
        $data['og_image'] = base_url('assets/images/logo.png');

        $data['articles'] = $this->articles->get_articles_by_category("videos");

        $this->_load_article_list($data);
    }

    public function tech()
    {
        $data['title'] = "Tecnología";
        $data['active'] = "tech";

        $data['og_type'] = "website";
        $data['og_description'] = "El mejor contenido de la red";
        $data['og_url'] = site_url('site/tech');
        $data['og_image'] = base_url('assets/images/logo.png');

        $data['articles'] = $this->articles->get_articles_by_category("tech");

        $this->_load_article_list($data);
    }

    public function unusual()
    {
        $data['title'] = "Insólito";
        $data['active'] = "unusual";

        $data['og_type'] = "website";
        $data['og_description'] = "El mejor contenido de la red";
        $data['og_url'] = site_url('site/unusual');
        $data['og_image'] = base_url('assets/images/logo.png');

        $data['articles'] = $this->articles->get_articles_by_category("unusual");

        $this->_load_article_list($data);
    }

    public function articles($id=0)
    {
        $data['title'] = "LOL";
        $this->_load_layout('article.php', $data);
    }

    public function aboutus()
    {
        $data['title'] = "Acerca de esta web";
        $data['active'] = "none";

        $data['og_type'] = "website";
        $data['og_description'] = "El mejor contenido de la red";
        $data['og_url'] = site_url('aboutus');
        $data['og_image'] = base_url('assets/images/logo.png');

        $this->_load_layout('about.php',$data);
    }

    public function privacity()
    {
        $data['title'] = "Política de privacidad";
        $data['active'] = "none";

        $data['og_type'] = "website";
        $data['og_description'] = "El mejor contenido de la red";
        $data['og_url'] = site_url('privacity');
        $data['og_image'] = base_url('assets/images/logo.png');

        $this->_load_layout('privacity.php',$data);
    }

    public function login()     //load login view
    {
        if ($this->logged_in === TRUE)
        {
            redirect('site/index');
        }
        else
        {
            $this->load->view('login.php');
        }
    }

    public function login_action()
    {
        $user_data = $this->user->get_user_data($this->input->post('email'));
        $password = $user_data ? $user_data[0]->password : '';

        $pass = md5($this->input->post('password'));

        if ($user_data !== FALSE && $pass === $password)
        {
            /* set session's variables */
            $this->session->logged_in = TRUE;
            $this->session->login_user_id = $user_data[0]->id;
            $this->session->login_email = $user_data[0]->email;
            $this->session->login_nickname = $user_data[0]->username;
            $this->session->login_user_type = $user_data[0]->type;
            redirect('site/index');
        } else {
            $this->session->logged_in = FALSE;
            $this->session->login_user_id = '';
            $this->session->login_email = '';
            $this->session->login_nickname = '';
            $this->session->login_user_type = '';

            /* reload login view as failed */
            $data['login_failed'] = TRUE;
            $this->load->view('login.php',$data);
        }
    }

    public function logout()
    {
        $this->session->logged_in = FALSE;
        $this->session->login_user_id = '';
        $this->session->login_email = '';
        $this->session->login_nickname = '';
        $this->session->login_user_type = '';

        redirect('site/login');
    }


    private function _load_article_list($data)
    {
        $data['og_type'] = "website";

        $this->_load_layout('article_list.php',$data);
    }

    private function _load_layout($name, $data = [])
    {
        $this->load->view('templates/header.php', $data);
        $this->load->view($name, $data);
        $this->load->view('templates/footer.php', $data);
    }
}
