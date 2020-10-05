<?php
class Admin_Model extends CI_Model
{


    public function login($username,$password)
    {
        $result = $this->db->get_where('users', array('username' => $username, 'password' => md5($password),'user_type'=>'ADMIN'))->row_array();
        if ($result['status'] == 'ACTIVE') {
            if ($remember = 1) {
                $cookie = array(
                    'name' => 'remember_me',
                    'value' => $result['id'],
                    'expire' => '1209600', // Two weeks
                    'domain' => '',
                    'path' => '/',
                );
                set_cookie($cookie);
            }
            $this->set_user_login_session($result);
        }
        return $result;
    }

    public function loginFacebookGoogle($username, $password, $remember)
    {
        $result = $this->db->get_where('users', array('username' => $username, 'password' => $password))->row_array();

        if ($result['status'] == 'ACTIVE') {
            if ($remember = 1) {
                $cookie = array(
                    'name' => 'remember_me',
                    'value' => $result['id'],
                    'expire' => '1209600', // Two weeks
                    'domain' => '',
                    'path' => '/',
                );
                set_cookie($cookie);

            }
            $this->set_user_login_session($result);
        }
        return $result;
    }

    public function set_user_login_session($user)
    {
        unset($user['password']);
        $this->session->set_userdata($user);
    }

    public function create($createdata)
    {

        $this->db->insert('categories', $createdata);

    }

    public function insertRegister($resisterdata)
    {

        $this->db->insert('users', $resisterdata);

    }

    public function all()
    {
        $this->load->database();
        return $displayData = $this->db->get('categories')->result_array();

    }

    public function getuser($userId)
    {
        $this->db->where('id', $userId);
        return $user = $this->db->get('categories')->row_array();
    }

    public function updateuser($userId, $createdata)
    {

        $this->db->where('id', $userId);
        $this->db->update('categories', $createdata);
    }

    public function deleteCategories($userid)
    {
        $this->db->where('id', $userid);
        $this->db->delete('categories');
    }

    public function get_count()
    {
        return $this->db->count_all('categories');
    }

    public function get_users($limit, $start)
    {
        $query = $this->db->get('categories');
        return $query->result_array();
    }

    // Check Password
    public function checkPassword($postArray)
    {
        $check = $this->db->get_where('users', array('id' => $this->session->userdata('id'), 'password' => md5($postArray['current_password'])))->row_array();
        if (empty($check)) {
            return false;
        } else {
            return true;
        }
    }
    // Change Password
    public function changePassword($postArray)
    {
        return $this->db->update('users', array('password' => md5($postArray['new_password'])), array('id' => $this->session->userdata('id')));
    }

    public function forgotPass($postArray)
    {
        $where = array();
        if (trim($postArray['username']) != '') {
            $where['username'] = trim($postArray['username']);
        }
        if (trim($postArray['email']) != '') {
            $where['email'] = trim($postArray['email']);
        }

        $userArray = $this->db->get_where('users', $where)->row_array();

        if (empty($userArray)) {

            $userArray = $this->db->get_where('users', $where)->row_array();

        }

        if (empty($userArray)) {
            return false;
        } else {
            $change_password_token = md5($userArray['id'] . '_' . generateRandomString());
            $userArray['link'] = base_url() . 'Login/resetPassword/' . $change_password_token;

            if ($userArray['user_type'] == 'ADMIN') {
                $this->db->update('users', array('change_password_token' => $change_password_token), array('id' => $userArray['id']));
            } else {
                $this->db->update('users', array('change_password_token' => $change_password_token), array('id' => $userArray['id']));
            }
            $userArray['user_type'] = ucwords(str_replace('_', ' ', strtolower($userArray['user_type'])));
            $emailContent = array('subject' => 'Recover your Blogging Account Password!', 'message' => '
                Hello,<br/><br/>

                If you have forgotten your password, you can click on the link below to set a new one.<br/><br/>

                ' . $userArray['link'] . '<br/><br/>

                To stay signed-in,<br/>
                Team Blogging!', );
            return email($userArray['email'], 'sanjeev.m@infiny.in', $emailContent);
        }
    }

    //token in email
    public function getUserByToken($token = '')
    {
        $result = $this->db->get_where('users', array('change_password_token' => trim($token)))->row_array();

        if ($result <= 0) {
            return $this->db->get_where('users', array('change_password_token' => trim($token)))->row_array();
        } else {
            return $result;
        }
    }

    // Reset password after forgot password
    public function resetPassword($postArray)
    {
        $query = $this->db->get_where('users', array('username' => trim($postArray["username"]), 'email' => trim($postArray["email"])))->row_array();
        if (empty($query)) {
            return $this->db->update('users', array('password' => md5($postArray['new_password']), 'change_password_token' => ''), array('change_password_token' => $postArray['token']));
        }
    }

    public function get_table_data($table)
    {
        $query = $this->db->get($table);
        return $query->result();
    }
    public function get_select($table, $select, $wheres = array(), $order_col = '', $order = '')
    {
        $this->db->select($select);
        $this->db->from($table);
        if (!empty($wheres)) {
            foreach ($wheres as $key => $where) {
                $this->db->where($key, $where);
            }
        }
        if (!empty($order)) {
            $this->db->order_by($order_col, $order);
        }
        $query = $this->db->get();

        return $query->result();
    }
    public function get_select_arr($table, $select, $wheres = array(), $order_col = '', $order = '')
    {
        $this->db->select($select);
        $this->db->from($table);
        if (!empty($wheres)) {
            foreach ($wheres as $key => $where) {
                $this->db->where($key, $where);
            }
        }
        if (!empty($order)) {
            $this->db->order_by($order_col, $order);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insertData($table, $data)
    {
        $this->db->insert($table, $data);
        $last_id = $this->db->insert_id();
        return $last_id;
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

    public function get_where_in($table, $select, $wheres = array())
    {
        $this->db->select($select);
        $this->db->from($table);
        if (!empty($wheres)) {
            foreach ($wheres as $key => $where) {
                $this->db->where_in($key, $where);
            }
        }
        $query = $this->db->get();

        return $query->result();
    }
    public function get_where_in_arr($table, $select, $wheres = array())
    {
        $this->db->select($select);
        $this->db->from($table);
        if (!empty($wheres)) {
            foreach ($wheres as $key => $where) {
                $this->db->where_in($key, $where);
            }
        }
        $query = $this->db->get();
        return $query->result_array();
    }
    public function flattenArray($arrayToFlatten)
    {
        $flatArray = array();
        foreach ($arrayToFlatten as $element) {
            if (is_array($element)) {
                $flatArray = array_merge($flatArray, $this->flattenArray($element));
            } else {
                $flatArray[] = $element;
            }
        }
        return $flatArray;
    }

    public function get_table_count($table = '')
    {
        $query = $this->db->get($table);
        return $query->num_rows();
    }

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

    // email and notification part

    public function commentNotifyEmail($commentId)
    {
        $commnetedUserDetail = $this->admin_model->get_single_row('comment', '*', array('id' => $commentId));
        $userDetail = $this->admin_model->get_single_row('users', 'username', array('id' => $commnetedUserDetail['user_id']));
        $blogerId = $this->admin_model->get_single_row('blog', 'user_id,title', array('id' => $commnetedUserDetail['blog_id']));
        $blogerDetail = $this->admin_model->get_single_row('users', 'email,first_name,last_name,username', array('id' => $blogerId['user_id']));
        $notification['title'] = $userDetail['username'] . ' commented on your  blog';
        $notification['description'] = $commnetedUserDetail['detail'];
        $notification['url'] = 'blog/detail/' . $commnetedUserDetail['blog_id'];
        $notification['added_on'] = $commnetedUserDetail['date'];
        $notification['user_id'] = $blogerId['user_id'];
        $notificationId = $this->admin_model->insertData('notification', $notification);
        if ($this->db->insert('notification_status', array('notification_id' => $notificationId, 'user_id' => $blogerId['user_id'], 'status' => 0))) {
            $emailContent = "Hello " . $blogerDetail['username'] . ",<br><br> See below comment, <br>" . $commnetedUserDetail['detail'] . ",<br> commented by " . $userDetail['username'] . ".";
            $msg1 = array('subject' => $userDetail['username'] . " commented on your blog, title is " . $blogerId['title'], 'message' => $emailContent);
            email($blogerDetail['email'], 'sanjeev.m@infiny.in', $msg1);
        }

    }

    public function newBlogNotifyEmail($blogId)
    {
        $email = $this->db->select('id,email')->from('users')->where('user_type','ADMIN')->get()->result_array();
        // pr( $email);exit;
        $data = $this->admin_model->get_single_row('blog', 'title,detail', array('id' => $blogId));
        $username = $this->session->userdata['username'];
        $emailContent = "This is new blog title is " . $data['title'] . "  posted by <strong> " . $username . "</strong>";
        $msg1 = array('subject' => $data['title'], 'message' => $emailContent);
            $notifData['title'] = $username . " added new blog,title is " . $data['title'];
            $notifData['description'] = $data['detail'];
            $notifData['added_on'] = date('y-m-d H:i:s');
            $notifData['url'] = 'blog/unpublishblogList';
            foreach ($email as $key => $value) {
                email($value['email'], 'sanjeev.m@infiny.in', $msg1);
                $notifData['user_id'] = $value['id'];
                $notifyId = $this->admin_model->insertData('notification', $notifData);
                if ($notifyId > 0) {
                $this->db->insert('notification_status', array('notification_id' => $notifyId, 'user_id' => $value['id'], 'status' => 0)) ;
                }
            }
    }

    public function BlogReportNotifyEmail($blogReportId)
    {
        $username = $this->session->userdata['username'];
        $admin = $this->db->select('id,email')->from('users')->where('user_type','ADMIN')->get()->result_array();
        $blogReportDetail = $this->admin_model->get_single_row('blog_report', '*', array('id' => $blogReportId));
        $blogDetail = $this->admin_model->get_single_row('blog', 'title,detail', array('id' => $blogReportDetail['blog_id']));
        $notifData['title'] = $username . " reported on blog, title is " . $blogDetail['title'];
        $notifData['description'] = $blogReportDetail['description'];
        $notifData['added_on'] = $blogReportDetail['report_date'];
        $notifData['url'] = 'blog/blogReportListAdmin';
        $emailContent = $blogReportDetail['description'] . ",<br> Reported by " . $username . ".";
                $msg1 = array('subject' => $username . " reported on blog, title is " . $blogDetail['title'], 'message' => $emailContent);
        foreach ($admin as $key => $value) {
            $notifData['user_id'] = $value['id'];
            $notifyId = $this->admin_model->insertData('notification', $notifData);
            if ($notifyId > 0) {
                $this->db->insert('notification_status', array('notification_id' => $notifyId, 'user_id' => $value['id'], 'status' => 0));
                email($value['email'], 'sanjeev.m@infiny.in', $msg1);
            }
        }
    }
    
    public function updateCategoryNotifyEmail($categoryId,$oldName, $newName)
    {
            $categorydetail = $this->admin_model->get_single_row('categories', 'id,name', array('id' => $categoryId));
            $allUsers = $this->admin_model->get_where_in_arr('users', 'id,email,username', array('user_type' => 'USER'));
            $notifData['title'] = $categorydetail['name']." updated category of blog.";
            $notifData['description'] = 'This is to inform you that we have recently updated '.$categorydetail['name'].'category of blog. Please go through it in order to stay updated.';
            $notifData['user_id'] = 'ALL';
            $notifData['added_on'] = date('y-m-d H:i:s');
            $notifData['url'] = 'blog/index';
            $notifyId = $this->admin_model->insertData('notification', $notifData);
            if($notifyId > 0)
            {
                        foreach ($allUsers as $key => $value) {
                        $this->db->insert('notification_status', array('notification_id' => $notifyId, 'user_id' => $value['id'],   'status' => 0));
                            $to_email = $value['email'];
                            $sub = 'Updated category of blog!';
                            $msg = 'Hello '.ucfirst($value['username']).',<br/><br/>
                                This is to inform you that we have recently updated our '.$categorydetail['name'].' category of blog. Please go through it in order to stay updated. ,<br/><br/>
                                To stay signed-in,<br/>
                                Team Blogging!';
                //Load email library
                         $msg1 = array('subject' => $sub, 'message' => $msg);
                         $mail = email($to_email,'sanjeev.m@infiny.in', $msg1);
                    }
                
            }

    }

    public function BlogNotifyEmail($id,$status)
    {
        $blogDetail = $this->admin_model->get_single_row('blog', 'user_id,title', array('id' => $id));
        $userDetail = $this->admin_model->get_single_row('users', 'username,first_name,last_name,email', array('id' => $id));
        switch ($status) {
            case "UNPUBLISH":
                $notifData['title'] = " Your blog has been unpublished";
                $notifData['description'] = "This is to inform you that your blog '".$blogDetail['title'] ."' has been unpublished";
                $notifData['user_id'] = $blogDetail['user_id'];
                $notifData['added_on'] = date('y-m-d H:i:s');
                $notifData['url'] = 'users/blogList';
                $sub = ' Your blog   has been unpublished';
                            $msg = 'Hello '.ucfirst($userDetail['username']).',<br/><br/>
                            This is to inform you that your blog '.$blogDetail['title'] .' has been unpublished. Please go through it in order to stay updated. ,<br/><br/>
                                To stay signed-in,<br/>
                                Team Blogging!';
              break;
            case "PUBLISH":
                $notifData['title'] = " Your blog   has been published";
                $notifData['description'] = "This is to inform you that your blog '".$blogDetail['title'] ."' has been published";
                $notifData['user_id'] = $blogDetail['user_id'];
                $notifData['added_on'] = date('y-m-d H:i:s');
                $notifData['url'] = 'users/blogList';
                $sub = ' Your blog   has been published';
                            $msg = 'Hello '.ucfirst($userDetail['username']).',<br/><br/>
                            This is to inform you that your blog '.$blogDetail['title'] .' has been published. Please go through it in order to stay updated. ,<br/><br/>
                                To stay signed-in,<br/>
                                Team Blogging!';
              break;
            case "REJECT":
                $notifData['title'] = " Your blog   has been rejected";
                $notifData['description'] = "This is to inform you that your blog '".$blogDetail['title'] ."' has been rejected";
                $notifData['user_id'] = $blogDetail['user_id'];
                $notifData['added_on'] = date('y-m-d H:i:s');
                $notifData['url'] = 'users/blogList';
                $sub = ' Your blog   has been rejected';
                            $msg = 'Hello '.ucfirst($userDetail['username']).',<br/><br/>
                            This is to inform you that your blog '.$blogDetail['title'] .' has been rejected. Please go through it in order to stay updated. ,<br/><br/>
                                To stay signed-in,<br/>
                                Team Blogging!';
              break;
          case "BLOCK":
                $notifData['title'] = " Your blog   has been removed";
                $notifData['description'] = "This is to inform you that your blog '".$blogDetail['title'] ."' has been removed";
                $notifData['user_id'] = $blogDetail['user_id'];
                $notifData['added_on'] = date('y-m-d H:i:s');
                $notifData['url'] = 'users/blogList';
                $sub = ' Your blog   has been removed';
                            $msg = 'Hello '.ucfirst($userDetail['username']).',<br/><br/>
                            This is to inform you that your blog '.$blogDetail['title'] .' has been removed. Please go through it in order to stay updated. ,<br/><br/>
                                To stay signed-in,<br/>
                                Team Blogging!';
              break;
          }
            $notifyId = $this->admin_model->insertData('notification', $notifData);
            if($notifyId > 0)
            {
                $this->db->insert('notification_status', array('notification_id' => $notifyId, 'user_id' => $blogDetail['user_id'],   'status' => 0));
                $to_email = $userDetail['email'];
                //Load email library
                         $msg1 = array('subject' => $sub, 'message' => $msg);
                         $mail = email($to_email,'sanjeev.m@infiny.in', $msg1);

            }
          

    }

    public function BlogNotifyFollower($id)
    {
        echo $id;exit;
    }

    public function registrationNotifyEmail($id)
    {
        // echo $id;
        return true;
    }



}
