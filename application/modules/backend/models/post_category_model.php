<?php

class Post_category_model extends Backend_model
{

    protected $table = 'post_category';
    protected $select = array('id', 'name', 'status', 'level');
    protected $set_created = FALSE;
    protected $set_modified = FALSE;

    protected $soft_deletes = TRUE;

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $arrData = explode('::', $this->getAllFormatString());

        array_pop($arrData);

        $result = array();

        foreach ($arrData as $v)
        {
            $arrItem = explode('_', $v);

            $data = array();

            $t = 0;

            foreach ($this->select as $selectVl)
            {
                $data[$selectVl] = $arrItem[$t];

                $t++;
            }

            $result[] = $data;
        }
        return $result;
    }

    public function getAllFormatString($parent = 0, $level = 0, &$data = null)
    {
        $query = $this->db->get_where($this->table, array('parent' => $parent, 'deleted' => 0));

        if ($query->num_rows() > 0)
        {
            foreach ($query->result_array() as $v)
            {
                foreach ($this->select as $selectVl)
                {
                    if ($selectVl != 'level')
                        $data .= $v[trim($selectVl)] . '_';
                }
                $data .= $level . '::';

                $query_sub = $this->db->get_where($this->table, array('parent' => $v['id']));

                if ($query_sub->num_rows() > 0)
                {
                    $this->getAllFormatString($v['id'], $level + 1, $data);
                }
            }
        }

        return $data;
    }
    
    public function delete($id)
    {
        $query_category = $this->db->get_where($this->table, array('id' => $id));
        
        $category = $query_category->row_array();
        
        $query_child = $this->db->get_where($this->table, array('parent' => $id));
        
        $child = $query_child->result_array();
        
        $query_parent = $this->db->get_where($this->table, array('id' => $category['parent']));
        
        $parent = $query_parent->row_array();
                
        $this->db->trans_start();
        
        //$this->db->query('DELETE FROM ' . $this->table . ' WHERE id = ' . $id);

        $this->db->query('UPDATE ' . $this->table . ' SET deleted = 1 WHERE id = ' . $id);
        
        $parent_update = 0;
        
        if (!empty($parent))
        {
            $parent_update = $parent['id'];
        }
        if (!empty($child))
        {
            foreach($child as $v)
            {
                $this->db->query('UPDATE ' . $this->table . ' SET parent = ' . $parent_update . ' WHERE id =' . $v['id']);
            }
        }
        $this->db->trans_complete();
    }

}
