<?php
use Carbon\Carbon;

class Links extends CI_Model
{
    const NO_ADS_TEXT = false;

    function __construct()
    {
        parent::__construct();
    }

    public function get_referrals()
    {
        $query = $this->db->get('allowed_referrals');
        return $query->result();
    }

    public function get_link_by_hash($hash)
    {
        $where['hash'] = $hash;
        $query = $this->db->get_where('links', $where, 1);
        $details = $query->result();

        if (isset($details[0])) {
            //exist
            $details[0]->blocked = $this->is_blocked($details[0]->id);

            return $details[0];
        } else {
            return false;
        }
    }

    public function is_blocked($id)
    {
        $where['link_id'] = $id;
        $query = $this->db->get_where('links_blocked', $where, 1);
        $details = $query->result();

        return count($details) > 0;
    }

    public function inc_views($id, $user_id)
    {
        if (isset($id)) {
            try {
                $this->increment_views_hourly_statics($id, $user_id);
            } catch (Exception $ex) {
            }

            $this->db->set('views', 'views+1', false);
            $this->db->where('id', $id);
            $this->db->update('links');
            return true;
        } else {
            return false;
        }
    }

    public function increment_views_hourly_statics($link_id, $user_id)
    {
        $dt = Carbon::now();
        $data = array(
            'link_id' => $link_id,
            'year' => $dt->year,
            'month' => $dt->month,
            'day' => $dt->day,
            'hour' => $dt->hour,
            'user_id' => $user_id
        );

        $query = $this->db->get_where('links_views', $data);

        if (count($query->result()) > 0) {
            // exist, just update
            $this->db->set('views', 'views+1', false);
            $this->db->where($data);
            $this->db->update('links_views');
        } else {
            // not exist, create it
            $data['views'] = 1;
            $this->db->insert('links_views', $data);
        }
    }

    public function get_box_1($user_id)
    {
        $ok = $this->user->check_user_id_exist($user_id);
        if (!$ok) {
            return self::NO_ADS_TEXT;
        }

        $where['user_id'] = $user_id;

        $query = $this->db->get_where('adsense_units_user', $where, 1);
        $result = $query->result();

        if (count($result) == 0) {
            return self::NO_ADS_TEXT;
        }

        $ad_id = $result[0]->ad_id;
        $where = [];
        $where['ad_unit_code'] = $ad_id;
        $query = $this->db->get_where('adsense_ads_code', $where, 1);
        $result = $query->result();

        return $result[0]->ad_code;
    }

    public function get_box_2($user_id)
    {
        $ok = $this->user->check_user_id_exist($user_id);

        if ($ok === false) {
            $user_id = '1111'; //admin
        }

        $where['user_id'] = $user_id;
        $where['order'] = 2;

        $query = $this->db->get_where('adsense_units_user', $where, 1);
        $result = $query->result();

        $ad_id = $result[0]->ad_id;

        $where = [];
        $where['ad_unit_code'] = $ad_id;
        $query = $this->db->get_where('adsense_ads_code', $where, 1);
        $result = $query->result();

        return $result[0]->ad_code;
    }

    public function get_random_tematic_text()
    {
        $query = $this->db->get('tematics');
        $res = $query->result();

        $cant = count($res);

        $n = rand(0, $cant - 1);

        $text = [];
        $text['title'] = $res[$n]->title;
        $text['text'] = $res[$n]->text;

        return $text;
    }

    public function get_tematic_text_by_id($id)
    {
        $where['id'] = $id;
        $query = $this->db->get_where('tematics', $where, 1);
        $res = $query->result();

        if (count($res)) {
            $text = [];
            $text['title'] = $res[0]->title;
            $text['text'] = $res[0]->text;

            return $text;
        } else {
            return false;
        }
    }
}
