<?php
class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('query_model');
        $this->load->model('pdf_model');
        $this->load->model('blog_model');
        $this->load->model('user_model');

    }

    public function login($username, $password, $remember)
    {
        $result = $this->db->get_where('member', array('username' => $username, 'password' => md5($password), 'status' => 'ACTIVE'))->row_array();

        if (empty($result)) {
            $this->session->set_flashdata('error', 'Incorrect User Credentials');
            redirect('user/login');
        } else {
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
            $this->session->set_flashdata('success', 'Welcome, you have logged in successfully.');
            redirect('users/blogList');
        }
    }

    public function set_user_login_session($user)
    {
        unset($user['password']);
        $this->session->set_userdata($user);

    }

    public function insertData($table, $data)
    {
        $this->db->insert($table, $data);
        $last_id = $this->db->insert_id();
        return $last_id;
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

    public function get_where($id)
    {
        return $this->db->get_where('blog', array('id' => $id))->row_array();
    }

    public function updateData($table, $data, $col, $val)
    {
        $this->db->where($col, $val);
        $this->db->update($table, $data);
        return true;
    }

    public function get_table_data($table)
    {
        $query = $this->db->get($table);
        return $query->result_array();
    }

    public function viewInDetail()
    {
        $this->db->select('*');
        $this->db->from('blog');
        $this->db->join('blog_img', 'blog_img.blog_id = blog.id', 'left');
        return $this->db->get()->result_array();

    }

    public function getAllusersAjaxCount($searchVal = '', $id)
    {

        $this->db->select('count(users.id) as CountRows');
        $this->db->from('users');
        $this->db->where(array('users.user_type' => 'USER'));
        if (strlen($searchVal)) {
            $searchCondition = "(
                    users.username like '%$searchVal%' or
                    users.email like '%$searchVal%' or
                    users.phone_no like '%$searchVal%' or
                    users.added_on like '%$searchVal%' or
                    users.status like '%$searchVal%'
                )";
            $this->db->where($searchCondition);
        }
        $query = $this->db->get()->row_array();
        //echo $this->db->last_query();exit;
        return $query['CountRows'];
    }

    protected $registerusrDT_column = array(

        'users.id',
        'users.username',
        'users.email',
        'users.phone_no',
        'users.added_on',
        'users.status',
        '',
    );

    public function getAllusersAjax($searchVal = '', $sortColIndex = 0, $sortBy = 'DESC', $limit = 0, $offset = 0, $id)
    {
        $this->db->select('users.*');
        $this->db->from('users');
        $this->db->where(array('users.user_type' => 'USER'));
        if (strlen($searchVal)) {
            $searchCondition = "(
                users.username like '%$searchVal%' or
                users.email like '%$searchVal%' or
                users.phone_no like '%$searchVal%' or
                users.added_on like '%$searchVal%' or
                users.status like '%$searchVal%'

            )";
            $this->db->where($searchCondition);
        }
        $this->db->limit($limit, $offset);
        $this->db->order_by($this->registerusrDT_column[$sortColIndex], $sortBy);
        $query = $this->db->get();
        $av = $this->db->last_query();
        return $query->result_array();
        pr($query->result_array());
    }

    public function getAlluploadAjaxCount($searchVal = '', $id)
    {

        $this->db->select('count(images.id) as CountRows');
        $this->db->from('images');
        $this->db->join('categories', 'categories.id=images.img_category', 'desc');
        $this->db->where('images.user_id', $this->session->id);
        if (strlen($searchVal)) {
            $searchCondition = "(
                    categories.name like '%$searchVal%' or
                    images.created_date like '%$searchVal%'
                )";
            $this->db->where($searchCondition);
        }
        $query = $this->db->get()->row_array();
        return $query['CountRows'];
    }

    protected $imagesDT_column = array(

        'images.id',
        'images.path',
        'categories.name',
        'images.created_date',
    );

    public function getAlluploadAjax($searchVal = '', $sortColIndex = 0, $sortBy = 'DESC', $limit = 0, $offset = 0, $id)
    {
        $this->db->select('images.*,categories.name');
        $this->db->from('images');
        $this->db->join('categories', 'categories.id=images.img_category', 'desc');
        $this->db->where('images.user_id', $this->session->id);
        if (strlen($searchVal)) {
            $searchCondition = "(
                categories.name like '%$searchVal%' or
                images.created_date like '%$searchVal%'

            )";
            $this->db->where($searchCondition);
        }
        $this->db->limit($limit, $offset);
        $this->db->order_by($this->imagesDT_column[$sortColIndex], $sortBy);
        $query = $this->db->get();
        $av = $this->db->last_query();
        return $query->result_array();
    }

    public function getAllnotificationajaxCount($searchVal = '', $id)
    {

        $this->db->select('count(notification.id) as CountRows');
        $this->db->from('notification');
        if (strlen($searchVal)) {
            $searchCondition = "(
                    notification.title like '%$searchVal%' or
                    notification.user_id like '%$searchVal%' or
                    notification.added_on like '%$searchVal%'
                  )";
            $this->db->where($searchCondition);
        }
        $query = $this->db->get()->row_array();
        return $query['CountRows'];
    }

    protected $notificationDT_column = array(

        'notification.id',
        'notification.title',
        'notification.user_id',
        'notification.added_on',
        '',
    );

    public function getAllnotificationAjax($searchVal = '', $sortColIndex = 0, $sortBy = 'DESC', $limit = 0, $offset = 0, $id)
    {
        $this->db->select('notification.*');
        $this->db->from('notification');
        if (strlen($searchVal)) {
            $searchCondition = "(
                notification.title like '%$searchVal%' or
                notification.user_id like '%$searchVal%' or
                notification.added_on like '%$searchVal%'

            )";
            $this->db->where($searchCondition);
        }
        $this->db->limit($limit, $offset);
        $this->db->order_by($this->notificationDT_column[$sortColIndex], $sortBy);
        $query = $this->db->get();
        $av = $this->db->last_query();
        return $query->result_array();
    }

    public function getAllblogListajaxCount($searchVal = '', $id)
    {

        $this->db->select('count(blog.id) as CountRows');
        $this->db->from('blog');
        $this->db->where('blog.user_id', $this->session->id);
        $this->db->where('blog.is_publish', 'DRAFT');
        //   $this->db->where(array("blog.user_id" => $this->session->userdata("id")));
        if (strlen($searchVal)) {
            $searchCondition = "(
                    blog.title like '%$searchVal%' or
                    blog.date like '%$searchVal%' or
                    blog.update_date like '%$searchVal%'
                  )";
            $this->db->where($searchCondition);
        }
        $query = $this->db->get()->row_array();
        //echo $this->db->last_query();exit;
        return $query['CountRows'];
    }

    protected $blogListDT_column = array(

        'blog.id',
        'blog.title',
        'blog.date',
        'blog.update_date',
        '',
    );

    public function getAllblogListAjax($searchVal = '', $sortColIndex = 0, $sortBy = 'DESC', $limit = 0, $offset = 0, $id)
    {
        $this->db->select('blog.*');
        $this->db->from('blog');
        $this->db->where('blog.user_id', $this->session->id);
        $this->db->where('blog.is_publish', 'DRAFT');
        // $this->db->where(array("user_id" => $this->session->userdata("id")));
        if (strlen($searchVal)) {
            $searchCondition = "(
                blog.title like '%$searchVal%' or
                blog.date like '%$searchVal%' or
                blog.update_date like '%$searchVal%'

            )";
            $this->db->where($searchCondition);
        }
        $this->db->limit($limit, $offset);
        $this->db->order_by($this->blogListDT_column[$sortColIndex], $sortBy);
        $query = $this->db->get();
        $av = $this->db->last_query();
        return $query->result_array();
    }

    //publish blog list
    public function getAllpublishajaxCount($searchVal = '', $id)
    {

        $this->db->select('count(blog.id) as CountRows');
        $this->db->from('blog');
        $this->db->where('blog.user_id', $this->session->id);
        $this->db->where('blog.is_publish', 'PUBLISH');
        if (strlen($searchVal)) {
            $searchCondition = "(
                    blog.title like '%$searchVal%' or
                    blog.date like '%$searchVal%'
                  )";
            $this->db->where($searchCondition);
        }
        $query = $this->db->get()->row_array();
        //echo $this->db->last_query();exit;
        return $query['CountRows'];
    }

    protected $publishDT_column = array(

        'blog.id',
        'blog.title',
        'blog.date',
        '',
    );

    public function getAllpublishAjax($searchVal = '', $sortColIndex = 0, $sortBy = 'DESC', $limit = 0, $offset = 0, $id)
    {
        $this->db->select('blog.*');
        $this->db->from('blog');
        $this->db->where('blog.user_id', $this->session->id);
        $this->db->where('blog.is_publish', 'PUBLISH');
        if (strlen($searchVal)) {
            $searchCondition = "(
                blog.title like '%$searchVal%' or
                blog.date like '%$searchVal%'

            )";
            $this->db->where($searchCondition);
        }
        $this->db->limit($limit, $offset);
        $this->db->order_by($this->publishDT_column[$sortColIndex], $sortBy);
        $query = $this->db->get();
        $av = $this->db->last_query();
        return $query->result_array();
    }

    //unpublish blog list
    public function getAllunpublishajaxCount($searchVal = '', $id)
    {

        $this->db->select('count(blog.id) as CountRows');
        $this->db->from('blog');
        $this->db->where('blog.user_id', $this->session->id);
        $this->db->where('blog.is_publish', 'UNPUBLISH');
        if (strlen($searchVal)) {
            $searchCondition = "(
                    blog.title like '%$searchVal%' or
                    blog.date like '%$searchVal%'
                  )";
            $this->db->where($searchCondition);
        }
        $query = $this->db->get()->row_array();
        //echo $this->db->last_query();exit;
        return $query['CountRows'];
    }

    protected $unpublishDT_column = array(

        'blog.id',
        'blog.title',
        'blog.date',    
        '',
    );

    public function getAllunpublishAjax($searchVal = '', $sortColIndex = 0, $sortBy = 'DESC', $limit = 0, $offset = 0, $id)
    {
        $this->db->select('blog.*');
        $this->db->from('blog');
        $this->db->where('blog.user_id', $this->session->id);
        $this->db->where('blog.is_publish', 'UNPUBLISH');
        if (strlen($searchVal)) {
            $searchCondition = "(
                blog.title like '%$searchVal%' or
                blog.date like '%$searchVal%'

            )";
            $this->db->where($searchCondition);
        }
        $this->db->limit($limit, $offset);
        $this->db->order_by($this->unpublishDT_column[$sortColIndex], $sortBy);
        $query = $this->db->get();
        $av = $this->db->last_query();
        return $query->result_array();
    }

    public function Categories()
    {
        // return $this->db->order_by("id", "desc")->get('images')->result_array();
        $this->db->select('*,categories.id AS cat_id');
        $this->db->from('images');
        $this->db->join('categories', 'images.img_category = categories.id');
        $this->db->where('images.user_id', $this->session->userdata['id']);
        $this->db->order_by("categories.id", "desc");
        $query = $this->db->get()->result_array();
        return ($query);

    }

    public function category($data)
    {
        // img_category user_id
        $this->db->select('id,path,user_id,img_category');
        $this->db->where('user_id', $this->session->userdata['id']);
        if ($data['category'] != 0) {
            $this->db->where('img_category', $data['category']);
        }
        return $this->db->get('images')->result_array();

    }

    public function registration($data)
    {
       if(!empty($data['referral_id']))
       {
             $referred = explode("=",$data['referral_id']);
             $referral_id  = $referred[1];
             
       }
       else
       {
          
           $referral_id  = '';
       }
        
        // $users_id = array();
        $resisterdata['username'] = $data['username'];
        $resisterdata['first_name'] = $data['first_name'];
        $ref = $data['referral_link'];
        $resisterdata['referralLlink'] = $resisterdata['username'].$ref;
        $referredBy = $referral_id;
        $resisterdata['referredBy'] = $referredBy;
        $resisterdata['last_name'] = $data['last_name'];
        $resisterdata['email'] = $data['email'];
        $resisterdata['password'] = md5($data['password']);
        $resisterdata['phone_no'] = $data['phone_no'];
        $resisterdata['added_on'] = date('y-m-d H:i:s');
        $resisterdata['status'] = 'ACTIVE';
        $last_id = $this->query_model->insertData('users', $resisterdata);
        $this->admin_model->registrationNotifyEmail($last_id);
        $result = $this->db->get_where('users', array('id' => $last_id))->row_array();
        // After successful registration they get notification via email
        $from_email = "sanjeev.m@infiny.in";
        $to_email = $result['email'];
        $sub = 'Registration is successful.';
        $msg = ' Hello,<br/><br/>
            Welcome in Blogging.com,<br/><br/>
            Enjoy Unlimited bloging and also Make Money By Referring Your Friends, Who did the successful registration.<br/><br/>
            <a href="'.base_url().'login">Sign in Here</a><br/><br/>
            To stay signed-in,<br/>
            Team Blogging!';
        //Load email library
        $msg1 = array('subject' => $sub, 'message' => $msg);
        $mail = email($to_email, $from_email, $msg1);
        $emailstatus = false;
        //Send mail
        if ($mail) {
            // echo "s$this->input->post(uccess";
            $this->session->set_flashdata('success', 'Registration successfully.');
            $emailstatus = true;

        } else {
            // echo "failed";
            $this->session->set_flashdata('failure', 'something went wrong.');

        }
        $user_id = $this->query_model->usersId('users', $referredBy);
        $userParent_referrallink = $this->query_model->parentlink('users', $user_id);
        if (!empty($userParent_referrallink)) {
            $userParent_id = $this->query_model->parentId('users', $userParent_referrallink);
        }
        if (!empty($referredBy)) {
            $transaction = array();
            $transaction['user_id'] = $user_id;
            $transaction['amount'] = (10 * 20 / 100) / 12;
            $transaction['date_on'] = date('Y-m-d H:i:s');
            $transaction['settle_date'] = date('Y-m-d H:i:s', strtotime('+1 month', strtotime($transaction['date_on'])));
            for ($i = 0; $i < 12; $i++) {
                $result = $this->query_model->insertTransaction('transaction', $transaction);
                $transaction['date_on'] = date('Y-m-d H:i:s', strtotime('+1 month', strtotime($transaction['date_on'])));
                $transaction['settle_date'] = date('Y-m-d H:i:s', strtotime('+1 month', strtotime($transaction['settle_date'])));
            }
            if (!empty($userParent_id)) {
                $transaction = array();
                $transaction['user_id'] = $userParent_id;
                $transaction['amount'] = (10 * 20 / 100) / 12;
                $transaction['date_on'] = date('Y-m-d H:i:s');
                $transaction['settle_date'] = date('Y-m-d H:i:s', strtotime('+1 month', strtotime($transaction['date_on'])));
                for ($i = 0; $i < 12; $i++) {
                    $result = $this->query_model->insertTransaction('transaction', $transaction);
                    $transaction['date_on'] = date('Y-m-d H:i:s', strtotime('+1 month', strtotime($transaction['date_on'])));
                    $transaction['settle_date'] = date('Y-m-d H:i:s', strtotime('+1 month', strtotime($transaction['settle_date'])));
                }
            }
        }
        return $last_id;
    }
    
    public function createusers($data)
    {
        $createdata = array();
        $createdata['name'] = $data['uname'];
        $createdata['lastname'] = $data['lastname'];
        $createdata['email'] = $data['email'];
        $createdata['phone_no'] = $data['phone_no'];
        $createdata['added_on'] = date('y-m-d H:i:s');
        $createdata = $this->query_model->create($createdata);
        $this->session->set_flashdata('success', 'Record Added successfully');
    }

    public function editusers($data)
    {
        $createdata = array();
        $createdata['username'] = strtolower($data['username']);
        $createdata['first_name'] = $data['first_name'];
        $createdata['last_name'] = $data['last_name'];
        $createdata['email'] = $data['email'];
        $createdata['phone_no'] = $data['phone_no'];
        $this->query_model->updateData('users', $createdata, 'id', $this->input->post('id'));
        $this->session->set_flashdata('success', 'Record Updated successfully');
    }

    public function edituserprofile($data)
    {   
        if(!empty($data['image'])){
			if(!empty($data['unlinkprofile_image']))
            {
                unlink("assets/images/users/".$data['unlinkprofile_image']);
            }
        }
        $createdata = array();
        if (!strlen($data['image']) == 0) {
            $image_array = explode(",", $data['image']);
            $image = base64_decode($image_array[1]);
            $imageName = $data['username'] . date('d-m-y-h-m-s') . '.jpg';
            file_put_contents('./assets/images/users/' .$imageName, $image);
            $createdata['profile_img'] = $imageName;

        }
        $createdata['about_me'] = $data['about_me'];
        $createdata['username'] = strtolower($data['username']);
        $createdata['first_name'] = $data['first_name'];
        $createdata['last_name'] = $data['last_name'];
        $createdata['email'] = $data['email'];
        $createdata['phone_no'] = $data['phone_no'];
        if ($this->query_model->updateData('users', $createdata, 'id', $this->input->post('id'))) {
            $detail = $this->db->get_where('users', array('id' => $this->input->post('id')))->row_array();
            $this->session->set_userdata($detail);
        }
        $this->session->set_flashdata('success', 'Record Updated successfully');
    }

    //changeUserPassword users.
    public function changeUserPassword($data)
    {$createdata = array();
        $createdata['password'] = md5($data['new_password']);
        $this->query_model->updateData('users', $createdata, 'id', $this->session->id);
        $this->session->set_flashdata('success', 'Record Updated successfully');

    }

    public function acDetailsInsert($data)
    {
        $acdata = array();
        $acdata['user_id'] = $this->session->id;
        $acdata['ac_holder_name'] = $data['holdername'];
        $acdata['ac_no'] = $data['acnumber'];
        $acdata['ifsc_code'] = $data['ifsc'];
        $acdata = $this->admin_model->insertData('accountDetails', $acdata);
        $this->session->set_flashdata('success', 'Record Added successfully');
    }

    public function EditAcDetails($data)
    {
       
        $acdata = array();
        $acdata['ac_holder_name'] = $data['holdername'];
        $acdata['ac_no'] = $data['acnumber'];
        $acdata['ifsc_code'] = $data['ifsc'];
        $this->query_model->updateData('accountDetails', $acdata, 'user_id', $this->input->post('id'));
        
    }

    public function addBlog($data)
    {
        $datas = array();
        $datas['title'] = $data['title'];
        $datas['category_id'] = $data['crole'];
        $datas['blog_type'] = $data['blog_type'];
        $datas['detail'] = $data['detail'];
        $datas['user_id'] = $this->session->userdata("id");
        $datas['content'] = $data['mce_0'];
        if($this->session->user_type == 'ADMIN')
        {
            $datas['redirect_url'] = $data['redirect'];
        }
        $urlData = $data['url'];
        $lastArrayData = explode("/",$urlData);
        $datas['url'] = end($lastArrayData);
        if(!empty($data['is_publish'])){
            $datas['is_publish'] = $data['is_publish'];
        }
        $blog_id = $this->user_model->insertData('blog', $datas);
        if($blog_id > 0)
        {
          $result =  $this->admin_model->newBlogNotifyEmail($blog_id);
          $returnValue = true;
        }

        // get email(admin) from users they post new blog
        // $this->db->select('id,email');
        // $this->db->from('users');
        // $email = $this->db->where('user_type','ADMIN')->get()->row_array();
        // $username = $this->session->userdata['username'];
        // $emailContent = "This is new blog title is ".$datas['title']."  posted by <strong> ".$username."</strong>"; 
        // $msg1 = array('subject' => $data['title'], 'message' => $emailContent);
        // email($email['email'], 'sanjeev.m@infiny.in', $msg1);
        // if ($this->user_model->insertData('blog', $datas)) {
        //     $notifData = array();
        //     $notifData['title'] = $username." added new blog,title is ".$data['title'];
        //     $notifData['description'] = $data['detail'];
        //     $notifData['user_id'] = $email['id'];
        //     $notifData['added_on'] = date('y-m-d H:i:s');
        //     $notify =$this->admin_model->insertData('notification', $notifData);
        //     $this->admin_model->insertData('notification_status',array('user_id' => $email['id'],'notification_id' => $notify,'status' => 0 ));
        //     return true;
        // }
        
        return $returnValue;
    }

    // update data for blog edit
    public function updateBlog($data)
    {
        $datas['title'] = $data['title'];
        $datas['category_id'] = $data['crole'];
        $datas['blog_type'] = $data['blog_type'];
        $datas['detail'] = $data['detail'];
        // $datas['user_id'] = $this->session->userdata("id");
        $datas['content'] = $data['mce_0'];
        $datas['update_date'] = date('y-m-d H:i:s');
        if($data['is_publish']=='DRAFT'){
            $datas['is_publish'] = $data['is_publish'];
        }else{
            $datas['is_publish'] = 'UNPUBLISH';
        }
        $lastArrayData = explode("/",$data['url']);
        $datas['url'] = end($lastArrayData);
        $id = $data['id'];
        return $this->user_model->updateData('blog', $datas, 'id', $id);
    }

    // razorpay checkout
    public function razorPaySuccess($data)
    {
        $payments = [
            'user_id' => $data['user_id'],
            'payment_id' => $data['razorpay_payment_id'],
            'razorpay_order_id' => $data['razorpay_order_id'],
            'amount' => $data['totalAmount'],
            'product_id' => $this->input->post('product_id'),
            'created_date' => date('y-m-d H:i:s'),
        ];
        $paymentInsert = $this->admin_model->insertData('payments', $payments);
        if (count($paymentInsert) > 0) {
            $user = $this->db->get_where('users', array('id' => $payments['user_id']))->row_array();
            $notifData = array();
            $notifData['title'] = ''.ucfirst($user['username']).' has paid Rs. 1000.';
            $notifData['description'] = 'Thank you for your purchase. We have received your payment. Enjoy Unlimited Free Private or Public Blogging and also get every month Cashback from your referrals.';
            $notifData['user_id'] = $data['user_id'];
            $notifData['added_on'] = date('y-m-d H:i:s');
            $this->admin_model->insertData('notification', $notifData);
            $active = $this->admin_model->updateData('users', array('status' => 'ACTIVE'), 'id', $data['user_id']);
            $arr = array('msg' => 'Payment successfully credited', 'status' => true, 'pay_id' => $paymentInsert, 'log_id' => $payments['user_id']);
            if ($active) {
                $login = $this->db->get_where('users', array('id' => $payments['user_id']))->row_array();
                $this->admin_model->set_user_login_session($login);
            }
        } else {
            $arr = array('msg' => 'Something went wrong', 'status' => false);
        }
        return $arr;
    }

    // add new category
    public function createCategories($data)
    {
        $createdata = array();
        $createdata['name'] = $data['Categoryname'];
        $createdata['isPublic'] = $data['isPublic'];
        // $createcategoryId = $this->admin_model->create($createdata);
         $createcategoryId =  $this->admin_model->insertData('categories', $createdata);
        //  if($createcategoryId > 0)
        //  {
        //     $createcategoryId =  $this->admin_model->newCategoryNotifyEmail($createcategoryId);
        //  }
         
        $this->session->set_flashdata('success', 'Record Added successfully');
    }

    //update category.
    public function editCategories($data)
    {
        $createdata = array();
        $createdata['name'] = $data['Categoryname'];
        $createdata['isPublic'] = $data['isPublic'];
        $oldName = $this->admin_model->get_single_row('categories', 'id,name', array('id' => $data['id']));
        $this->query_model->updateData('categories', $createdata, 'id', $data['id']);
        $newName = $this->admin_model->get_single_row('categories', 'id,name', array('id' => $data['id']));
        $this->admin_model->updateCategoryNotifyEmail($data['id'],$oldName, $newName);

        $this->session->set_flashdata('success', 'Record Updated successfully');
    }

    public function userDetail($id)
    {
        $detail = $this->db->get_where('users', array('id' => $id))->row_array();
        if ($detail) {
            $data['username'] = $detail['username'];
            $data['id'] = $detail['id'];
            $data['email'] = $detail['email'];
            $data['contact'] = $detail['phone_no'];
            $data['status'] = 1;
        } else {
            $data['error'] = "something went wrong";
            $data['status'] = 0;
        }
        return $data;
    }

    public function imageData()
    {
        $this->db->select('images.*,categories.name');
        $this->db->from('images');
        $this->db->join('categories', 'categories.id=images.img_category', 'desc');
        $this->db->where('images.user_id', $this->session->id);
        $this->db->order_by("images.id", 'DESC');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    public function settlementPending()
    {
        $this->db->select('transaction.*,users.username');
        $this->db->from('transaction');
        $this->db->join('users', 'users.id=transaction.user_id');
        $this->db->where('transaction.status', 'PENDING');
        // $this->db->order_by("transaction.id",'DESC');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    public function settlementSuccess()
    {
        $this->db->select('transaction.*,users.username');
        $this->db->from('transaction');
        $this->db->join('users', 'users.id=transaction.user_id');
        $this->db->where('transaction.status', 'SUCCESS');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    public function referralList($id)
    {
        // Sub Query
        $this->db->select('referralLlink')->from('users');
        $this->db->where('id', $id);
        $subQuery = $this->db->get()->row_array();
        // Main Query
        $result = $this->db->select('*')
            ->from('users')
            ->where('referredBy', $subQuery['referralLlink'])
            ->get()
            ->result_array();
        return $result;
    }

    // notification list in data table
    public function notification()
    {
        $this->db->select('*');
        $this->db->from('notification');
        $this->db->order_by("notification.id", "desc");
        $this->db->join('users', 'users.id = notification.user_id');
        return $this->db->get()->result_array();

    }

    public function AdminNotification($user_id,$title,$description,$type)
    {
        $url = '';
        if($type == 'publish' || $type == 'remove' || $type == 'reject')
        {
            $url = 'users/blogList';
        }
        $notifData = array();
        $notifData['title'] = $title;
        $notifData['description'] = $description;
        $notifData['user_id'] = $user_id;
        $notifData['added_on'] = date('y-m-d H:i:s');
        $notifData['url'] = $url;
        $result = $this->admin_model->insertData('notification', $notifData);
    }

     public function signUpWithGoogle($data)
     {
        
         $uniqueEmail= $this->db->get_where('users', array('email' => $data['email']))->row_array();
         if(!empty($uniqueEmail))
         {
            $this->session->set_flashdata('error', 'Email already exists');
             $msg = array('error' =>400 ,'msg' => 'Email already exists','url' => base_url()."login" );
         }else
         {
            $resisterdata['username'] = $data['username'].uniqid();
            $resisterdata['first_name'] = $data['username'];
            $ref = $data['username'].uniqid();
            $resisterdata['referralLlink'] = $ref;
            // $resisterdata['referredBy'] = $referredBy;
            $resisterdata['last_name'] = $data['last_name'];
            $resisterdata['email'] = $data['email'];
            $resisterdata['password'] = md5($data['username'].'123');
            $resisterdata['added_on'] = date('y-m-d H:i:s');
            $resisterdata['status'] = 'ACTIVE';
            $last_id = $this->query_model->insertData('users', $resisterdata);
            $msg = array('error' =>0 ,'msg' => 'Sign up successfully','url' => base_url()."users/draftList");
            
         }
         return $msg;

     }
     
     public function signUpWithFacebook($data)
     {
         $uniqueEmail= $this->db->get_where('users', array('email' => $data['email']))->row_array();
         if(!empty($uniqueEmail))
         {
            $this->session->set_flashdata('error', 'Email already exists');
             $msg = array('error' =>400 ,'msg' => 'Email already exists','url' => base_url()."login" );
         }else
         {
            $resisterdata['username'] = $data['username'].uniqid();
            $resisterdata['first_name'] = $data['username'];
            $ref = $data['username'].uniqid();
            $resisterdata['referralLlink'] = $ref;
            // $resisterdata['referredBy'] = $referredBy;
            $resisterdata['last_name'] = $data['last_name'];
            $resisterdata['email'] = $data['email'];
            $resisterdata['password'] = md5($data['username'].'123');
            $resisterdata['added_on'] = date('y-m-d H:i:s');
            $resisterdata['status'] = 'ACTIVE';
            $last_id = $this->query_model->insertData('users', $resisterdata);
            $msg = array('error' =>0 ,'msg' => 'Sign up successfully','url' => base_url()."users/draftList");
         }
         return $msg;
     }
    public function commentNotification($blog_id,$comment,$comment_id)
    {
        $notifData = array();
        $user_result =  $this->db->get_where('blog', array('id' => $blog_id))->row_array();
        $url = "blog/detail/$blog_id";
        $notifData['title'] = $comment;
        $notifData['description'] = $comment;
        $notifData['user_id'] = $user_result['user_id'];
        $notifData['added_on'] = date('y-m-d H:i:s');
        $notifData['url'] = $url;
        $result = $this->admin_model->insertData('notification', $notifData);    
    }


    // add new notification
    public function addNotification($data)
    {
       
        $notifData = array();
        $notifData['title'] = $data['title'];
        $notifData['description'] = $data['description'];
        $notifData['user_id'] = 'ALL';
        $notifData['added_on'] = date('y-m-d H:i:s');
        $result = $this->admin_model->insertData('notification', $notifData);
        $allUserID = $this->admin_model->get_where_in_arr('users','id',array('status' => 'ACTIVE','user_type' => 'USER'));
        if($result > 0)
        {
            foreach ($allUserID as $key => $value) {
                $this->admin_model->insertData('notification_status',array('user_id' => $value['id'],'notification_id' => $result,'status' => 1 ));
            }
        }
        return $result;
    }
    // add new notification for payment Done


    public function userNotificationCount()
    {
        $id = $this->session->id;
        $this->db->select('count(notification.user_id) AS count');
        $this->db->from('notification');
        $this->db->join('notification_status', 'notification_status.notification_id = notification.id');
        $where = array('notification_status.user_id' => $id,'notification_status.status' => 1);
        $result = $this->db->where($where)->get()->row_array();
        $a =  $this->userNotification();
        foreach ($a as $key => $value) {
            $a[$key]['newnotifycount'] = $result['count'];
        }
        return $a;
    }





    public function userNotification()
    {
        $id = $this->session->id;
        $this->db->select('notification.*,notification_status.status AS status');
        $this->db->from('notification');
        $this->db->join('notification_status', 'notification_status.notification_id = notification.id');
        if($this->session->user_type == 'ADMIN')
        {
           
                        $this->db->where('notification.user_id !=', 'ALL');
                        $this->db->or_where('notification.user_id !=', $id);
        }
        else
        {
            $this->db->where('notification.user_id', 'ALL');
            // $where = array('notification.user_id'=>'ALL');
        }


        $query =$this->db->order_by('notification.id','desc')->get()->result_array();
        return $query;

    }

}
