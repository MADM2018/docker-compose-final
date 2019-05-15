<?php


class Articles extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function get_article_list()
    {
        $query = $this->db->get('articles');
        return $query->result();
    }

    public function get_articles_by_category($cat)
    {
        $where['category'] = $cat;
        $this->db->order_by('date', 'DESC');
        $query = $this->db->get_where('articles', $where);
        return $query->result();
    }

    public function get_recent_articles($cant = 0,$cat = "")
    {
        $this->db->order_by('date', 'DESC');

        if ($cant > 0)
            $this->db->limit($cant);

        if ($cat != "")
        {
            $where['category'] = $cat;
            $this->db->where_not_in('category', 'hidden');
            $query = $this->db->get_where('articles',$where);
        }
        else
        {
            $this->db->where_not_in('category', 'hidden');
            $query = $this->db->get('articles');
        }
        return $query->result();
    }

    public function get_popular_articles($cant = 0,$cat = "")
    {
        $this->db->order_by('views', 'DESC');
        if ($cant > 0)
            $this->db->limit($cant);

        if ($cat != "")
        {
            $where['category'] = $cat;
            $this->db->where_not_in('category', 'hidden');
            $query = $this->db->get_where('articles',$where);
        }
        else {
            $this->db->where_not_in('category', 'hidden');
            $query = $this->db->get('articles');
        }
        return $query->result();
    }

    public function get_random_first_article($first)
    {
        $this->db->limit($first);
        $this->db->order_by('date', 'DESC');
        $query = $this->db->get('articles');
        $res = $query->result();
        $n = rand(0,$first-1);
        return $res[$n];
    }

    public function get_footer_three($id)
    {
        $res = [];
        $cant = 0;

        while ($cant != 3)
        {
            $art = $this->get_random_first_article(10);
            if ($art->id != $id) {
                $i = 0;
                $ok = TRUE;
                while ($i < $cant) {
                    if ($res[$i]->id == $art->id) {
                        $ok = FALSE;
                        break;
                    }
                    $i++;
                }
                if ($ok === TRUE)
                {
                    $res[$cant++] = $art;
                }
            }
        }

        return $res;
    }



    public function get_total_articles()
    {
        return $this->db->count_all_results('articles');
    }

    public function get_article_by_uri($uri)
    {
        $where['uri'] = $uri;
        $query = $this->db->get_where('articles', $where, 1);
        $details = $query->result();

        if (isset($details[0]))
        {
            //exist
            return $details[0];
        }
        else
        {
            return FALSE;
        }
    }

    public function get_article_by_id($id)
    {
        $where['id'] = $id;
        $query = $this->db->get_where('articles', $where, 1);
        $details = $query->result();

        if (isset($details[0]))
        {
            //exist
            return $details[0];
        }
        else
        {
            return FALSE;
        }
    }

    public function get_article_by_author($id)
    {
        $where['author'] = $id;
        $query = $this->db->get_where('articles', $where);
        return $query->result();
    }

    public function add_new_article($info)
    {
        if ($this->article_title_exist($info['title']) === TRUE) {
            return FALSE;
        } else {
            $this->db->insert('articles', $info);
            return TRUE;
        }
    }

    public function article_title_exist($title)
    {
        $where['title'] = $title;

        $query = $this->db->get_where('articles', $where);

        return (count($query->result()) >= 1) ? TRUE : FALSE;
    }

    public function get_category_list()
    {
        $query = $this->db->get('category');
        return $query->result();
    }

    public function get_category_str($id)
    {
        $where['id'] = $id;
        $query = $this->db->get_where('category', $where);
        $details = $query->result();
        return $details[0]->name;
    }

    public function inc_views($uri)
    {
        if ( isset($uri) )
        {
            $this->db->set('views', 'views+1', FALSE);
            $this->db->where('uri', $uri);
            $this->db->update('articles');
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function delete_article($article_id) //OK
    {
        $where['id'] = $article_id;
        $query = $this->db->get_where('articles', $where, 1);
        $details = $query->result();
        if ( isset($details[0]) )
        {
            /* delete picture */
            $ppath = 'assets/images/articles/'.$details[0]->picture;
            unlink($ppath);

            $this->db->delete('articles', array('id' => $article_id));
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function update_article_info($article_id,$article_info)
    {
        $this->db->where('id', $article_id);
        $this->db->delete('articles');
        $this->db->insert('articles', $article_info);
    }
}
