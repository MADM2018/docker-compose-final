<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Share extends CI_Controller
{
    const LOG_FILE = 'user_agents.txt';
    const SERVER_DATA = array('HTTP_USER_AGENT');
    const SKIP_USER_AGENTS = array();
    //'facebookexternalhit',
    //'Facebot', 'Googlebot', 'Twitterbot');
    // Facebot, developers.google.com, Googlebot
    // www.google.com/webmasters/tools/richsnippets
    // Twitterbot
    // Twitter, FBAN, FBDV, FBAV, FBID
    // FB_IAB/FB4A;FBAV

    function __construct()
    {
        parent::__construct();

        $this->logged_in = $this->session->logged_in ? true : false;
        $this->login_user_id = $this->session->login_user_id ? $this->session->login_user_id : '';
        $this->login_email = $this->session->login_email ? $this->session->login_email : '';
        $this->login_nickname = $this->session->login_nickname ? $this->session->login_nickname : '';
        $this->login_user_type = $this->session->login_user_type ? $this->session->login_user_type : '';
    }

    public function load_link($hash = "", $category = "")
    {
        $this->output->set_header('X-FRAME-OPTIONS: SAMEORIGIN');

        $info = $this->links->get_link_by_hash($hash);

        if ($info == false) {
            return redirect('/');
        }

        $detector = new \Detection\MobileDetect();
        if ($detector->is("Bot")) {
            return redirect($info->url);
        }

        if ($this->agent->is_mobile() == false) {
            return redirect($info->url);
        }

        if ($this->agent->is_robot()) {
            return redirect($info->url);
        }

        if ($this->is_allowed_referrals() == false) {
            return redirect($info->url);
        }

        if ($category == $info->category && !$info->blocked && !$info->deleted == 1) {
            $this->links->inc_views($info->id, $info->user_id);

            $data['active'] = $info->category;
            $data['link'] = true;
            $data['user_id'] = $info->user_id;

            $data['siteurl'] = $info->site_url;

            $data['id'] = $info->id;
            $data['hash'] = $info->hash;

            $data['action'] = $info->action;
            $data['views'] = $info->views;
            $data['summary'] = $info->summary;
            $data['url'] = $info->url;

            $data['category'] = $this->articles->get_category_str($info->category);
            $data['a_date'] = date('d M, Y', $info->date);

            /* meta tags */
            $data['og_type'] = "article";
            $data['og_description'] = $info->og_description != '' ? $info->og_description : '';
            $data['og_url'] = $info->site_url;
            $data['og_image'] = $info->og_image != '' ? $info->og_image : '';
            $data['title'] = $info->title;
            $data['og_title'] = $info->og_title != '' ? $info->og_title : $info->title;
            $data['short_url'] = $info->short_url;

            $data['tematic_text_id'] = $info->tematic_text_id;

            $data['footer_one_id'] = $info->footer_one_id;
            $data['footer_two_id'] = $info->footer_two_id;
            $data['footer_three_id'] = $info->footer_three_id;

            $this->_load_layout('link.php', $data);
        } else {
            return redirect($info->url);
        }
    }

    public function log_server_data()
    {
        try {
            $handle = fopen(self::LOG_FILE, 'a');
            $data = '';

            foreach (self::SERVER_DATA as $field) {
                if (!array_key_exists($field, $_SERVER)) {
                    continue;
                }

                $data = $data . ' ' . $field . ':' . $_SERVER[$field];
            }

            fwrite($handle, $data . "\n");
            fclose($handle);
        } catch (Exception $ex) {
        }
    }

    public function is_allowed_referrals()
    {
        $referrals = $this->links->get_referrals();

        $domain = $this->agent->referrer();

        foreach ($referrals as $referral) {
            if (strpos($domain, $referral->domain) !== false) {
                return true;
            }
        }

        return false;
    }

    public function is_allowed_user_agent()
    {
        if (!array_key_exists('HTTP_USER_AGENT', $_SERVER)) {
            return false;
        }

        foreach (self::SKIP_USER_AGENTS as $user_agent) {
            if (strpos($_SERVER["HTTP_USER_AGENT"], $user_agent) !== false) {
                return false;
            }
        }

        return true;
    }

    public function safeText($str)
    {
        $str = str_replace('"', ' ', $str);
        $str = str_replace("''", ' ', $str);
        return $str;
    }

    private function _load_layout($name, $data = [])
    {
        $this->load->view('templates/link/header.php', $data);
        $this->load->view($name, $data);
        $this->load->view('templates/link/footer.php', $data);
    }
}
