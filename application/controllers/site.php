<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Site extends CI_Controller 
{
	public function __construct( )
	{
		parent::__construct();
		
		$this->is_logged_in();
	}
	function is_logged_in( )
	{
		$is_logged_in = $this->session->userdata( 'logged_in' );
		if ( $is_logged_in !== 'true' || !isset( $is_logged_in ) ) {
			redirect( base_url() . 'index.php/login', 'refresh' );
		} //$is_logged_in !== 'true' || !isset( $is_logged_in )
	}
	function checkaccess($access)
	{
		$accesslevel=$this->session->userdata('accesslevel');
		if(!in_array($accesslevel,$access))
			redirect( base_url() . 'index.php/site?alerterror=You do not have access to this page. ', 'refresh' );
	}
	public function index()
	{
		$access = array("1","2");
		$this->checkaccess($access);
		$data[ 'page' ] = 'dashboard';
		$data[ 'title' ] = 'Welcome';
		$this->load->view( 'template', $data );	
	}
	public function createuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
//        $data['category']=$this->category_model->getcategorydropdown();
		$data[ 'page' ] = 'createuser';
		$data[ 'title' ] = 'Create User';
		$this->load->view( 'template', $data );	
	}
	function createusersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|required|matches[password]');
		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('socialid','Socialid','trim');
		$this->form_validation->set_rules('logintype','logintype','trim');
		$this->form_validation->set_rules('json','json','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'status' ] =$this->user_model->getstatusdropdown();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
            $data['category']=$this->category_model->getcategorydropdown();
            $data[ 'page' ] = 'createuser';
            $data[ 'title' ] = 'Create User';
            $this->load->view( 'template', $data );	
		}
		else
		{
            $name=$this->input->post('name');
            $email=$this->input->post('email');
            $password=$this->input->post('password');
            $accesslevel=$this->input->post('accesslevel');
            $status=$this->input->post('status');
            $socialid=$this->input->post('socialid');
            $logintype=$this->input->post('logintype');
            $json=$this->input->post('json');
//            $category=$this->input->post('category');
            
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
			if($this->user_model->create($name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json)==0)
			$data['alerterror']="New user could not be created.";
			else
			$data['alertsuccess']="User created Successfully.";
			$data['redirect']="site/viewusers";
			$this->load->view("redirect",$data);
		}
	}
    function viewusers()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['page']='viewusers';
        $data['base_url'] = site_url("site/viewusersjson");
        
		$data['title']='View Users';
		$this->load->view('template',$data);
	} 
    function viewusersjson()
	{
		$access = array("1");
		$this->checkaccess($access);
        
        
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`user`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        
        
        $elements[1]=new stdClass();
        $elements[1]->field="`user`.`name`";
        $elements[1]->sort="1";
        $elements[1]->header="Name";
        $elements[1]->alias="name";
        
        $elements[2]=new stdClass();
        $elements[2]->field="`user`.`email`";
        $elements[2]->sort="1";
        $elements[2]->header="Email";
        $elements[2]->alias="email";
        
        $elements[3]=new stdClass();
        $elements[3]->field="`user`.`socialid`";
        $elements[3]->sort="1";
        $elements[3]->header="SocialId";
        $elements[3]->alias="socialid";
        
        $elements[4]=new stdClass();
        $elements[4]->field="`logintype`.`name`";
        $elements[4]->sort="1";
        $elements[4]->header="Logintype";
        $elements[4]->alias="logintype";
        
        $elements[5]=new stdClass();
        $elements[5]->field="`user`.`json`";
        $elements[5]->sort="1";
        $elements[5]->header="Json";
        $elements[5]->alias="json";
       
        $elements[6]=new stdClass();
        $elements[6]->field="`accesslevel`.`name`";
        $elements[6]->sort="1";
        $elements[6]->header="Accesslevel";
        $elements[6]->alias="accesslevelname";
       
        $elements[7]=new stdClass();
        $elements[7]->field="`statuses`.`name`";
        $elements[7]->sort="1";
        $elements[7]->header="Status";
        $elements[7]->alias="status";
       
        
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
       
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `user` LEFT OUTER JOIN `logintype` ON `logintype`.`id`=`user`.`logintype` LEFT OUTER JOIN `accesslevel` ON `accesslevel`.`id`=`user`.`accesslevel` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`user`.`status`");
        
		$this->load->view("json",$data);
	} 
    
    
	function edituser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
		$data['before']=$this->user_model->beforeedit($this->input->get('id'));
		$data['page']='edituser';
		$data['page2']='block/userblock';
		$data['title']='Edit User';
		$this->load->view('template',$data);
	}
	function editusersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		
		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('password','Password','trim|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|matches[password]');
		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('socialid','Socialid','trim');
		$this->form_validation->set_rules('logintype','logintype','trim');
		$this->form_validation->set_rules('json','json','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->user_model->getstatusdropdown();
			$data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
			$data['before']=$this->user_model->beforeedit($this->input->post('id'));
			$data['page']='edituser';
//			$data['page2']='block/userblock';
			$data['title']='Edit User';
			$this->load->view('template',$data);
		}
		else
		{
            
            $id=$this->input->get_post('id');
            $name=$this->input->get_post('name');
            $email=$this->input->get_post('email');
            $password=$this->input->get_post('password');
            $accesslevel=$this->input->get_post('accesslevel');
            $status=$this->input->get_post('status');
            $socialid=$this->input->get_post('socialid');
            $logintype=$this->input->get_post('logintype');
            $json=$this->input->get_post('json');
//            $category=$this->input->get_post('category');
            
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            if($image=="")
            {
            $image=$this->user_model->getuserimagebyid($id);
               // print_r($image);
                $image=$image->image;
            }
            
			if($this->user_model->edit($id,$name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json)==0)
			$data['alerterror']="User Editing was unsuccesful";
			else
			$data['alertsuccess']="User edited Successfully.";
			
			$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			
		}
	}
	
	function deleteuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->deleteuser($this->input->get('id'));
//		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="User Deleted Successfully";
		$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
		$this->load->view("redirect",$data);
	}
	function changeuserstatus()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->changestatus($this->input->get('id'));
		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="Status Changed Successfully";
		$data['redirect']="site/viewusers";
        $data['other']="template=$template";
        $this->load->view("redirect",$data);
	}
    
    
    
    public function viewevents()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewevents";
$data["base_url"]=site_url("site/vieweventsjson");
$data["title"]="View events";
$this->load->view("template",$data);
}
function vieweventsjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`reliance_events`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`reliance_events`.`name`";
$elements[1]->sort="1";
$elements[1]->header="name";
$elements[1]->alias="name";
$elements[2]=new stdClass();
$elements[2]->field="`reliance_events`.`image`";
$elements[2]->sort="1";
$elements[2]->header="image";
$elements[2]->alias="image";
$elements[3]=new stdClass();
$elements[3]->field="`reliance_events`.`venue`";
$elements[3]->sort="1";
$elements[3]->header="venue";
$elements[3]->alias="venue";
$elements[4]=new stdClass();
$elements[4]->field="`reliance_events`.`description`";
$elements[4]->sort="1";
$elements[4]->header="description";
$elements[4]->alias="description";
$elements[5]=new stdClass();
$elements[5]->field="`reliance_events`.`photoalbum`";
$elements[5]->sort="1";
$elements[5]->header="photoalbum";
$elements[5]->alias="photoalbum";
$elements[6]=new stdClass();
$elements[6]->field="`reliance_events`.`videoalbum`";
$elements[6]->sort="1";
$elements[6]->header="videoalbum";
$elements[6]->alias="videoalbum";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `reliance_events`");
$this->load->view("json",$data);
}

public function createevents()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createevents";
$data["title"]="Create events";
$this->load->view("template",$data);
}
public function createeventssubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("name","name","trim");
$this->form_validation->set_rules("image","image","trim");
$this->form_validation->set_rules("venue","venue","trim");
$this->form_validation->set_rules("description","description","trim");
$this->form_validation->set_rules("photoalbum","photoalbum","trim");
$this->form_validation->set_rules("videoalbum","videoalbum","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createevents";
$data["title"]="Create events";
$this->load->view("template",$data);
}
else
{
$name=$this->input->get_post("name");
$image=$this->input->get_post("image");
$venue=$this->input->get_post("venue");
$description=$this->input->get_post("description");
$photoalbum=$this->input->get_post("photoalbum");
$videoalbum=$this->input->get_post("videoalbum");
if($this->events_model->create($name,$image,$venue,$description,$photoalbum,$videoalbum)==0)
$data["alerterror"]="New events could not be created.";
else
$data["alertsuccess"]="events created Successfully.";
$data["redirect"]="site/viewevents";
$this->load->view("redirect",$data);
}
}
public function editevents()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editevents";
$data["title"]="Edit events";
$data["before"]=$this->events_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editeventssubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","id","trim");
$this->form_validation->set_rules("name","name","trim");
$this->form_validation->set_rules("image","image","trim");
$this->form_validation->set_rules("venue","venue","trim");
$this->form_validation->set_rules("description","description","trim");
$this->form_validation->set_rules("photoalbum","photoalbum","trim");
$this->form_validation->set_rules("videoalbum","videoalbum","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editevents";
$data["title"]="Edit events";
$data["before"]=$this->events_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$image=$this->input->get_post("image");
$venue=$this->input->get_post("venue");
$description=$this->input->get_post("description");
$photoalbum=$this->input->get_post("photoalbum");
$videoalbum=$this->input->get_post("videoalbum");
if($this->events_model->edit($id,$name,$image,$venue,$description,$photoalbum,$videoalbum)==0)
$data["alerterror"]="New events could not be Updated.";
else
$data["alertsuccess"]="events Updated Successfully.";
$data["redirect"]="site/viewevents";
$this->load->view("redirect",$data);
}
}
public function deleteevents()
{
$access=array("1");
$this->checkaccess($access);
$this->events_model->delete($this->input->get("id"));
$data["redirect"]="site/viewevents";
$this->load->view("redirect",$data);
}
public function viewphotoalbum()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewphotoalbum";
$data["base_url"]=site_url("site/viewphotoalbumjson");
$data["title"]="View photoalbum";
$this->load->view("template",$data);
}
function viewphotoalbumjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`reliance_photoalbum`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`reliance_photoalbum`.`name`";
$elements[1]->sort="1";
$elements[1]->header="name";
$elements[1]->alias="name";
$elements[2]=new stdClass();
$elements[2]->field="`reliance_photoalbum`.`order`";
$elements[2]->sort="1";
$elements[2]->header="order";
$elements[2]->alias="order";
$elements[3]=new stdClass();
$elements[3]->field="`reliance_photoalbum`.`status`";
$elements[3]->sort="1";
$elements[3]->header="status";
$elements[3]->alias="status";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `reliance_photoalbum`");
$this->load->view("json",$data);
}

public function createphotoalbum()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createphotoalbum";
$data["title"]="Create photoalbum";
$this->load->view("template",$data);
}
public function createphotoalbumsubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("name","name","trim");
$this->form_validation->set_rules("order","order","trim");
$this->form_validation->set_rules("status","status","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createphotoalbum";
$data["title"]="Create photoalbum";
$this->load->view("template",$data);
}
else
{
$name=$this->input->get_post("name");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
if($this->photoalbum_model->create($name,$order,$status)==0)
$data["alerterror"]="New photoalbum could not be created.";
else
$data["alertsuccess"]="photoalbum created Successfully.";
$data["redirect"]="site/viewphotoalbum";
$this->load->view("redirect",$data);
}
}
public function editphotoalbum()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editphotoalbum";
$data["title"]="Edit photoalbum";
$data["before"]=$this->photoalbum_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editphotoalbumsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","id","trim");
$this->form_validation->set_rules("name","name","trim");
$this->form_validation->set_rules("order","order","trim");
$this->form_validation->set_rules("status","status","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editphotoalbum";
$data["title"]="Edit photoalbum";
$data["before"]=$this->photoalbum_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
if($this->photoalbum_model->edit($id,$name,$order,$status)==0)
$data["alerterror"]="New photoalbum could not be Updated.";
else
$data["alertsuccess"]="photoalbum Updated Successfully.";
$data["redirect"]="site/viewphotoalbum";
$this->load->view("redirect",$data);
}
}
public function deletephotoalbum()
{
$access=array("1");
$this->checkaccess($access);
$this->photoalbum_model->delete($this->input->get("id"));
$data["redirect"]="site/viewphotoalbum";
$this->load->view("redirect",$data);
}
public function viewphotos()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewphotos";
$data["base_url"]=site_url("site/viewphotosjson");
$data["title"]="View photos";
$this->load->view("template",$data);
}
function viewphotosjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`reliance_photos`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`reliance_photos`.`name`";
$elements[1]->sort="1";
$elements[1]->header="name";
$elements[1]->alias="name";
$elements[2]=new stdClass();
$elements[2]->field="`reliance_photos`.`order`";
$elements[2]->sort="1";
$elements[2]->header="order";
$elements[2]->alias="order";
$elements[3]=new stdClass();
$elements[3]->field="`reliance_photos`.`image`";
$elements[3]->sort="1";
$elements[3]->header="image";
$elements[3]->alias="image";
$elements[4]=new stdClass();
$elements[4]->field="`reliance_photos`.`photoalbum`";
$elements[4]->sort="1";
$elements[4]->header="photoalbum";
$elements[4]->alias="photoalbum";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `reliance_photos`");
$this->load->view("json",$data);
}

public function createphotos()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createphotos";
$data["title"]="Create photos";
$this->load->view("template",$data);
}
public function createphotossubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("name","name","trim");
$this->form_validation->set_rules("order","order","trim");
$this->form_validation->set_rules("image","image","trim");
$this->form_validation->set_rules("photoalbum","photoalbum","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createphotos";
$data["title"]="Create photos";
$this->load->view("template",$data);
}
else
{
$name=$this->input->get_post("name");
$order=$this->input->get_post("order");
$image=$this->input->get_post("image");
$photoalbum=$this->input->get_post("photoalbum");
if($this->photos_model->create($name,$order,$image,$photoalbum)==0)
$data["alerterror"]="New photos could not be created.";
else
$data["alertsuccess"]="photos created Successfully.";
$data["redirect"]="site/viewphotos";
$this->load->view("redirect",$data);
}
}
public function editphotos()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editphotos";
$data["title"]="Edit photos";
$data["before"]=$this->photos_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editphotossubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","id","trim");
$this->form_validation->set_rules("name","name","trim");
$this->form_validation->set_rules("order","order","trim");
$this->form_validation->set_rules("image","image","trim");
$this->form_validation->set_rules("photoalbum","photoalbum","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editphotos";
$data["title"]="Edit photos";
$data["before"]=$this->photos_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$order=$this->input->get_post("order");
$image=$this->input->get_post("image");
$photoalbum=$this->input->get_post("photoalbum");
if($this->photos_model->edit($id,$name,$order,$image,$photoalbum)==0)
$data["alerterror"]="New photos could not be Updated.";
else
$data["alertsuccess"]="photos Updated Successfully.";
$data["redirect"]="site/viewphotos";
$this->load->view("redirect",$data);
}
}
public function deletephotos()
{
$access=array("1");
$this->checkaccess($access);
$this->photos_model->delete($this->input->get("id"));
$data["redirect"]="site/viewphotos";
$this->load->view("redirect",$data);
}
public function viewvideoalbum()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewvideoalbum";
$data["base_url"]=site_url("site/viewvideoalbumjson");
$data["title"]="View videoalbum";
$this->load->view("template",$data);
}
function viewvideoalbumjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`reliance_videoalbum`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`reliance_videoalbum`.`order`";
$elements[1]->sort="1";
$elements[1]->header="order";
$elements[1]->alias="order";
$elements[2]=new stdClass();
$elements[2]->field="`reliance_videoalbum`.`status`";
$elements[2]->sort="1";
$elements[2]->header="status";
$elements[2]->alias="status";
$elements[3]=new stdClass();
$elements[3]->field="`reliance_videoalbum`.`name`";
$elements[3]->sort="1";
$elements[3]->header="name";
$elements[3]->alias="name";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `reliance_videoalbum`");
$this->load->view("json",$data);
}

public function createvideoalbum()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createvideoalbum";
$data["title"]="Create videoalbum";
$this->load->view("template",$data);
}
public function createvideoalbumsubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("order","order","trim");
$this->form_validation->set_rules("status","status","trim");
$this->form_validation->set_rules("name","name","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createvideoalbum";
$data["title"]="Create videoalbum";
$this->load->view("template",$data);
}
else
{
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$name=$this->input->get_post("name");
if($this->videoalbum_model->create($order,$status,$name)==0)
$data["alerterror"]="New videoalbum could not be created.";
else
$data["alertsuccess"]="videoalbum created Successfully.";
$data["redirect"]="site/viewvideoalbum";
$this->load->view("redirect",$data);
}
}
public function editvideoalbum()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editvideoalbum";
$data["title"]="Edit videoalbum";
$data["before"]=$this->videoalbum_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editvideoalbumsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","id","trim");
$this->form_validation->set_rules("order","order","trim");
$this->form_validation->set_rules("status","status","trim");
$this->form_validation->set_rules("name","name","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editvideoalbum";
$data["title"]="Edit videoalbum";
$data["before"]=$this->videoalbum_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$name=$this->input->get_post("name");
if($this->videoalbum_model->edit($id,$order,$status,$name)==0)
$data["alerterror"]="New videoalbum could not be Updated.";
else
$data["alertsuccess"]="videoalbum Updated Successfully.";
$data["redirect"]="site/viewvideoalbum";
$this->load->view("redirect",$data);
}
}
public function deletevideoalbum()
{
$access=array("1");
$this->checkaccess($access);
$this->videoalbum_model->delete($this->input->get("id"));
$data["redirect"]="site/viewvideoalbum";
$this->load->view("redirect",$data);
}
public function viewvideos()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewvideos";
$data["base_url"]=site_url("site/viewvideosjson");
$data["title"]="View videos";
$this->load->view("template",$data);
}
function viewvideosjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`reliance_videos`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`reliance_videos`.`name`";
$elements[1]->sort="1";
$elements[1]->header="name";
$elements[1]->alias="name";
$elements[2]=new stdClass();
$elements[2]->field="`reliance_videos`.`order`";
$elements[2]->sort="1";
$elements[2]->header="order";
$elements[2]->alias="order";
$elements[3]=new stdClass();
$elements[3]->field="`reliance_videos`.`photoalbum`";
$elements[3]->sort="1";
$elements[3]->header="photoalbum";
$elements[3]->alias="photoalbum";
$elements[4]=new stdClass();
$elements[4]->field="`reliance_videos`.`url`";
$elements[4]->sort="1";
$elements[4]->header="url";
$elements[4]->alias="url";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `reliance_videos`");
$this->load->view("json",$data);
}

public function createvideos()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createvideos";
$data["title"]="Create videos";
$this->load->view("template",$data);
}
public function createvideossubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("name","name","trim");
$this->form_validation->set_rules("order","order","trim");
$this->form_validation->set_rules("photoalbum","photoalbum","trim");
$this->form_validation->set_rules("url","url","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createvideos";
$data["title"]="Create videos";
$this->load->view("template",$data);
}
else
{
$name=$this->input->get_post("name");
$order=$this->input->get_post("order");
$photoalbum=$this->input->get_post("photoalbum");
$url=$this->input->get_post("url");
if($this->videos_model->create($name,$order,$photoalbum,$url)==0)
$data["alerterror"]="New videos could not be created.";
else
$data["alertsuccess"]="videos created Successfully.";
$data["redirect"]="site/viewvideos";
$this->load->view("redirect",$data);
}
}
public function editvideos()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editvideos";
$data["title"]="Edit videos";
$data["before"]=$this->videos_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editvideossubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","id","trim");
$this->form_validation->set_rules("name","name","trim");
$this->form_validation->set_rules("order","order","trim");
$this->form_validation->set_rules("photoalbum","photoalbum","trim");
$this->form_validation->set_rules("url","url","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editvideos";
$data["title"]="Edit videos";
$data["before"]=$this->videos_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$order=$this->input->get_post("order");
$photoalbum=$this->input->get_post("photoalbum");
$url=$this->input->get_post("url");
if($this->videos_model->edit($id,$name,$order,$photoalbum,$url)==0)
$data["alerterror"]="New videos could not be Updated.";
else
$data["alertsuccess"]="videos Updated Successfully.";
$data["redirect"]="site/viewvideos";
$this->load->view("redirect",$data);
}
}
public function deletevideos()
{
$access=array("1");
$this->checkaccess($access);
$this->videos_model->delete($this->input->get("id"));
$data["redirect"]="site/viewvideos";
$this->load->view("redirect",$data);
}
public function viewfeedback()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewfeedback";
$data["base_url"]=site_url("site/viewfeedbackjson");
$data["title"]="View feedback";
$this->load->view("template",$data);
}
function viewfeedbackjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`reliance_feedback`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`reliance_feedback`.`timestamp`";
$elements[1]->sort="1";
$elements[1]->header="timestamp";
$elements[1]->alias="timestamp";
$elements[2]=new stdClass();
$elements[2]->field="`reliance_feedback`.`salutation`";
$elements[2]->sort="1";
$elements[2]->header="salutation";
$elements[2]->alias="salutation";
$elements[3]=new stdClass();
$elements[3]->field="`reliance_feedback`.`firstname`";
$elements[3]->sort="1";
$elements[3]->header="firstname";
$elements[3]->alias="firstname";
$elements[4]=new stdClass();
$elements[4]->field="`reliance_feedback`.`lastname`";
$elements[4]->sort="1";
$elements[4]->header="lastname";
$elements[4]->alias="lastname";
$elements[5]=new stdClass();
$elements[5]->field="`reliance_feedback`.`middlename`";
$elements[5]->sort="1";
$elements[5]->header="middlename";
$elements[5]->alias="middlename";
$elements[6]=new stdClass();
$elements[6]->field="`reliance_feedback`.`email`";
$elements[6]->sort="1";
$elements[6]->header="email";
$elements[6]->alias="email";
$elements[7]=new stdClass();
$elements[7]->field="`reliance_feedback`.`contact`";
$elements[7]->sort="1";
$elements[7]->header="contact";
$elements[7]->alias="contact";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `reliance_feedback`");
$this->load->view("json",$data);
}

public function createfeedback()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createfeedback";
$data["title"]="Create feedback";
$this->load->view("template",$data);
}
public function createfeedbacksubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("timestamp","timestamp","trim");
$this->form_validation->set_rules("salutation","salutation","trim");
$this->form_validation->set_rules("firstname","firstname","trim");
$this->form_validation->set_rules("lastname","lastname","trim");
$this->form_validation->set_rules("middlename","middlename","trim");
$this->form_validation->set_rules("email","email","trim");
$this->form_validation->set_rules("contact","contact","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createfeedback";
$data["title"]="Create feedback";
$this->load->view("template",$data);
}
else
{
$timestamp=$this->input->get_post("timestamp");
$salutation=$this->input->get_post("salutation");
$firstname=$this->input->get_post("firstname");
$lastname=$this->input->get_post("lastname");
$middlename=$this->input->get_post("middlename");
$email=$this->input->get_post("email");
$contact=$this->input->get_post("contact");
if($this->feedback_model->create($timestamp,$salutation,$firstname,$lastname,$middlename,$email,$contact)==0)
$data["alerterror"]="New feedback could not be created.";
else
$data["alertsuccess"]="feedback created Successfully.";
$data["redirect"]="site/viewfeedback";
$this->load->view("redirect",$data);
}
}
public function editfeedback()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editfeedback";
$data["title"]="Edit feedback";
$data["before"]=$this->feedback_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editfeedbacksubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","id","trim");
$this->form_validation->set_rules("timestamp","timestamp","trim");
$this->form_validation->set_rules("salutation","salutation","trim");
$this->form_validation->set_rules("firstname","firstname","trim");
$this->form_validation->set_rules("lastname","lastname","trim");
$this->form_validation->set_rules("middlename","middlename","trim");
$this->form_validation->set_rules("email","email","trim");
$this->form_validation->set_rules("contact","contact","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editfeedback";
$data["title"]="Edit feedback";
$data["before"]=$this->feedback_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$timestamp=$this->input->get_post("timestamp");
$salutation=$this->input->get_post("salutation");
$firstname=$this->input->get_post("firstname");
$lastname=$this->input->get_post("lastname");
$middlename=$this->input->get_post("middlename");
$email=$this->input->get_post("email");
$contact=$this->input->get_post("contact");
if($this->feedback_model->edit($id,$timestamp,$salutation,$firstname,$lastname,$middlename,$email,$contact)==0)
$data["alerterror"]="New feedback could not be Updated.";
else
$data["alertsuccess"]="feedback Updated Successfully.";
$data["redirect"]="site/viewfeedback";
$this->load->view("redirect",$data);
}
}
public function deletefeedback()
{
$access=array("1");
$this->checkaccess($access);
$this->feedback_model->delete($this->input->get("id"));
$data["redirect"]="site/viewfeedback";
$this->load->view("redirect",$data);
}

}
?>
