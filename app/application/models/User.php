<?php


class User extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function check_user_data($email,$pass)
    {
        $query = $this->db->query("SELECT * FROM users where email = '{$email}' AND password = '{$pass}'");

        $row = $query->row();

        if (isset($row))
        {
            return $row;
        }
        else
        {
            return FALSE;
        }
    }

    public function check_user_id_exist($user_id)
    {
        $where['id'] = $user_id;

        $query = $this->db->get_where('users', $where);

        return (count($query->result()) > 0) ? TRUE : FALSE;
    }


    public function check_user_name_exist($user_name)
    {
        $where['user'] = $user_name;

        $query = $this->db->get_where('users', $where);

        return (count($query->result()) > 0) ? TRUE : FALSE;
    }

    public function check_user_email_exist($user_email)
    {
        $where['email'] = $user_email;

        $query = $this->db->get_where('users', $where);

        return (count($query->result()) > 0) ? TRUE : FALSE;
    }

    public function get_user_data($email)
    {
        $where['email'] = $email;
        $query = $this->db->get_where('users', $where, 1);

        if ($this->db->count_all_results())
        {
            return $query->result();
        }
        else
            return FALSE;
    }

    public function add_new_user($user_data)
    {
        $u = $this->check_user_name_exist($user_data['user']);
        $e = $this->check_user_email_exist($user_data['email']);

        if ($u === TRUE) return "The user name already exist";
        if ($e === TRUE) return "The user email already exist";

        $this->db->insert('users',$user_data);
        return TRUE;
    }

    public function get_user_rank($user_id)
    {
        $where['id'] = $user_id;
        $query = $this->db->get_where('user_groups', $where);
        $data = $query->result();

        $rank = 0;
        foreach ($data as $group)
        {
            $id = $group->group_id;
            $info = $this->groups->get_group_details($id);
            $rank += $info->followers;
        }

        return $rank;
    }
}
