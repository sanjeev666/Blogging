<?php
class Query_Model extends CI_Model
{

    public function get_single_row($table, $select, $wheres = array())
    {
        $this->db->select($select);
        $this->db->from($table);
        if (!empty($wheres)) {
            foreach ($wheres as $key => $where) {
                $this->db->where($key, $where);
            }
        }
        $query = $this->db->get();
        return $query->row_array();
    }

    public function updateData($table, $data, $col, $val)
    {
        $this->db->where($col, $val);
        $this->db->update($table, $data);
        return true;
    }

    public function delete($table, $col, $id)
    {
        $this->db->where($col, $id);
        $this->db->delete($table);
        return true;
    }

    public function create($createdata)
    {
        $this->db->insert('users', $createdata);
    }

    public function insertData($table, $data)
    {
        $this->db->insert($table, $data);
        $last_id = $this->db->insert_id();
        $result = $this->db->get_where('users', array('id' => $last_id))->row_array();
        $this->set_user_login_session($result);
        return $last_id;
    }

    public function registration($table, $data)
    {
        $this->db->insert($table, $data);
        $last_id = $this->db->insert_id();
        return  $last_id;
    }

    //insert details of payments
    public function insertPayments($table, $data)
    {
        $this->db->insert($table, $data);
        return true;

    }

    // get usersId for referredBy or not
    public function usersId($table, $data)
    {
        $query = $this->db->select('id')->from($table)->where('referralLlink', $data)->get();
        return $query->row()->id;
    }

    // get usersId of parent 
    public function parentlink($table, $data)
    {
        $query = $this->db->select('referredBy')->from($table)->where('id', $data)->get();
        return $query->row()->referredBy;
    }

    public function parentId($table, $data)
    {
        $query = $this->db->select('id')->from($table)->where('referralLlink', $data)->get();
        return $query->row()->id;
    }

    public function insertTransaction($table, $data)
    {
        $this->db->insert($table, $data);

    }

    public function gallery()
    {
        $this->db->select('path');
        return $this->db->order_by("id", "desc")->get('images')->result_array();
    }

    public function login($username, $password, $remember)
    {
        $result = $this->db->get_where('users', array('username' => $username, 'password' => md5($password), 'status' => 'ACTIVE'))->row_array();
        if (empty($result)) {
            $this->session->set_flashdata('error', 'Incorrect User Credentials');
            redirect('Login/login');
        } else {
            if ($remember = 1) {
                $cookie = array(
                    'name' => 'remember_me',
                    'value' => $result['id'],
                    'expire' => '1209600', // Two weeks 1209600
                    'domain' => '',
                    'path' => '/',
                );
                set_cookie($cookie);
            }
            $this->set_user_login_session($result);
            $this->session->set_flashdata('success', 'Welcome, you have logged in successfully.');
            redirect('admin/dashboard');
        }
    }

    public function set_user_login_session($user)
    {
        unset($user['password']);
        $this->session->set_userdata($user);
    }

    public function curl()
    {   
        $query = $this->db->query("SELECT `id`,`user_id` FROM transaction where MONTH(`settle_date`) = MONTH(CURRENT_DATE()) AND YEAR(`settle_date`) = YEAR(CURRENT_DATE())")->result_array();

          foreach ($query as $key => $value) {
            $this->db->set('status','SUCCESS');
            $this->db->where('id',$value['id']);
            $query1 = $this->db->update('transaction');
        }
        return $query1;
    }

}
