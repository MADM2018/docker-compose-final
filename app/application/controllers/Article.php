<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->logged_in = $this->session->logged_in ? TRUE : FALSE;
        $this->login_user_id = $this->session->login_user_id ? $this->session->login_user_id : '';
        $this->login_email = $this->session->login_email ? $this->session->login_email : '';
        $this->login_nickname = $this->session->login_nickname ? $this->session->login_nickname : '';
        $this->login_user_type = $this->session->login_user_type ? $this->session->login_user_type : '';
    }

    public function index()
    {
        $this->load->view('index');
    }

    public function load_article($uri = "")
    {
        $info = $this->articles->get_article_by_uri($uri);

        if ($info !== FALSE)
        {
            $this->articles->inc_views($uri);

            $data['active'] = $info->category;
            $data['article'] = true;

            $data['id'] = $info->id;
            $data['title'] = $info->title;
            $data['text'] = $info->text;
            $data['views'] = $info->views;
            $data['picture'] = $info->picture;
            $data['category'] = $this->articles->get_category_str($info->category);
            $data['a_date'] = date('d M, Y',$info->date);

            $data['og_type'] = "article";
            $data['og_description'] = $this->safeText($info->summary);
            $data['og_url'] = site_url($info->uri);
            $data['og_image'] = assets_url('images/articles/'.$info->picture);

            $this->_load_layout('article.php', $data);
        }
        else
        {
            echo "not found".$uri;
        }
    }

    public function add_article()
    {
        if ($this->logged_in === FALSE || $this->login_user_type !== 'admin')
        {
            echo "forbidden";
            return ;
        }

        if( isset($_POST) )
        {
            $title = $this->input->post('_title');
            $summary = $this->input->post('_summary');
            $text = $this->input->post('_text');
            $category = $this->input->post('_category');

            /* validation process */
            $ok = TRUE;
            if ($title == "") $ok = FALSE;
            if ($summary == "") $ok = FALSE;
            if ($text == "") $ok = FALSE;
            if ($category == "none") $ok = FALSE;

            $response = "true";

            if ($ok === FALSE)
            {
                $response = "Revise bien la información del artículo. :'(";
            }
            else
            {
                $info = [];

                $info['title'] = $title;
                $info['date'] = strtotime('now');
                $info['author'] = $this->login_nickname;
                $info['category'] = $category;
                $info['views'] = 0;
                $info['text'] = $text;
                $info['summary'] = $summary;
                $info['uri'] = $this->getUri($title);
                $info['picture'] = $this->getImgName();


                $config['upload_path'] = "assets/images/articles";
                $config['allowed_types'] = 'jpg|jpeg';

                $config['max_size']  = 2048;
                $config['max_width']  = 700;
                $config['max_height']  = 440;

                $config['file_name'] = $info['picture'];

                $this->load->library('upload', $config);

                if (! $this->upload->do_upload('_picture'))
                {
                    $response = "Error subiendo la foto.";
                }
                else
                {
                    $add_ok = $this->articles->add_new_article($info);
                    if ($add_ok === FALSE)
                    {
                        $response = "El articulo ya existe.";
                    }
                }
            }

            header('Content-type: application/html; charset=utf-8');
            echo $response;
        }
        else
        {
            die("Error");
        }
    }

    public function delete_article()    //OK
    {
        if ($this->logged_in === FALSE || $this->login_user_type !== 'admin')
        {
            echo "forbidden";
            return ;
        }

        if( isset($_GET) )
        {
            $id = $this->input->get('_id');

            $success = $this->articles->delete_article($id);

            $jsondata = array();

            if ($success === TRUE)
            {
                $jsondata["success"] = true;
            }
            else
            {
                $jsondata["success"] = false;
            }
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($jsondata, JSON_FORCE_OBJECT);
        }
        else
        {
            die("Solicitud no válida.");
        }
    }

    public function edit_article_info()
    {
        if ($this->logged_in === FALSE || $this->login_user_type !== 'admin')
        {
            echo "forbidden";
            return ;
        }

        if( isset($_POST) )
        {
            $id = $this->input->post('_edit_id');
            $title = $this->input->post('_edit_title');
            $summary = $this->input->post('_edit_summary');
            $text = $this->input->post('_edit_text');
            $category = $this->input->post('_edit_category');

            /* validation process */
            $ok = TRUE;
            if ($id == "") $ok = FALSE;
            if ($title == "") $ok = FALSE;
            if ($summary == "") $ok = FALSE;
            if ($text == "") $ok = FALSE;

            $current = $this->articles->get_article_by_id($id);
            if ($current === FALSE) $ok = FALSE;

            $response = "true";
            if ($ok !== TRUE)
            {
                $response = "Revise bien la información del artículo. :'(".var_dump($current);
            }
            else
            {
                $info = [];

                $info['id'] = $id;
                $info['title'] = $title;
                $info['date'] = $current->date;
                $info['author'] = $current->author;
                $info['category'] = ($category != 'none') ? $category : $current->category;
                $info['views'] = $current->views;
                $info['text'] = $text;
                $info['summary'] = $summary;
                $info['uri'] = $current->uri;   //for compatibility with previous links
                $info['picture'] = $this->getImgName();


                $config['upload_path'] = "assets/images/articles";
                $config['allowed_types'] = 'jpg|jpeg';
                $config['overwrite'] = 'true';

                $config['max_size']  = 2048;
                $config['max_width']  = 700;
                $config['max_height']  = 440;

                $config['file_name'] = $info['picture'];

                $this->load->library('upload', $config);

                $this->upload->do_upload('_edit_picture');

                $this->articles->update_article_info($id,$info);
            }

            header('Content-type: application/html; charset=utf-8');
            echo $response;
        }
        else
        {
            die("Error");
        }
    }

    public function edit_article_html()
    {
        if ($this->logged_in === FALSE || $this->login_user_type !== 'admin')
        {
            echo "forbidden";
            return ;
        }

        if( isset($_GET) )
        {
            $id = $this->input->get('id');
            $article = $this->articles->get_article_by_id($id);

            $jsondata = array();

            if ($article === FALSE)
            {
                $jsondata["title"] = false;
            }
            else
            {
                $jsondata["title"] = $article->title;

                $jsondata["summary"] = $article->summary;

                $jsondata["text"] = $article->text;
            }

            header('Content-type: application/json; charset=utf-8');
            echo json_encode($jsondata, JSON_FORCE_OBJECT);
        }
        else
        {
            die("Error");
        }
    }

    private function getUri($str = '')
    {
        $str = strip_tags($str);
        $str = preg_replace('/[\r\n\t ]+/', ' ', $str);
        $str = preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', ' ', $str);
        $str = strtolower($str);
        $str = html_entity_decode($str, ENT_QUOTES, "utf-8");
        $str = htmlentities($str, ENT_QUOTES, "utf-8");
        $str = preg_replace("/(&)([a-z])([a-z]+;)/i", '$2', $str);
        $str = str_replace(' ', '-', $str);
        $str = rawurlencode($str);
        $str = str_replace('%', '-', $str);
        return $str;
    }

    public function safeText($str)
    {
        $str = str_replace('"',' ',$str);
        $str = str_replace("''",' ',$str);
        $str = strip_tags($str);
        return $str;
    }

    private function getImgName()
    {
        $len = 10;
        $str = "";
        for ($i=0; $i<$len; $i++) {
            $d=rand(1,30) % 3;

            switch ($d) {
                case 0:
                    $str = $str . chr(rand(65,90));
                    break;
                case 1:
                    $str = $str . chr(rand(48,57));
                    break;
                case 2:
                    $str = $str . chr(rand(97,122));
                    break;
            }
        }
        return $str.".jpeg";
    }

    private function _load_layout($name, $data = [])
    {
        $this->load->view('templates/header.php', $data);
        $this->load->view($name, $data);
        $this->load->view('templates/footer.php', $data);
    }
}
