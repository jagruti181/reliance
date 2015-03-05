<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Json extends CI_Controller 
{function getallevents()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`reliance_events`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`reliance_events`.`name`";
$elements[1]->sort="1";
$elements[1]->header="name";
$elements[1]->alias="name";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`reliance_events`.`image`";
$elements[2]->sort="1";
$elements[2]->header="image";
$elements[2]->alias="image";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`reliance_events`.`venue`";
$elements[3]->sort="1";
$elements[3]->header="venue";
$elements[3]->alias="venue";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`reliance_events`.`description`";
$elements[4]->sort="1";
$elements[4]->header="description";
$elements[4]->alias="description";

$elements=array();
$elements[5]=new stdClass();
$elements[5]->field="`reliance_events`.`photoalbum`";
$elements[5]->sort="1";
$elements[5]->header="photoalbum";
$elements[5]->alias="photoalbum";

$elements=array();
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
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `reliance_events`");
$this->load->view("json",$data);
}
public function getsingleevents()
{
$id=$this->input->get_post("id");
$data["message"]=$this->events_model->getsingleevents($id);
$this->load->view("json",$data);
}
function getallphotoalbum()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`reliance_photoalbum`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`reliance_photoalbum`.`name`";
$elements[1]->sort="1";
$elements[1]->header="name";
$elements[1]->alias="name";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`reliance_photoalbum`.`order`";
$elements[2]->sort="1";
$elements[2]->header="order";
$elements[2]->alias="order";

$elements=array();
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
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `reliance_photoalbum`");
$this->load->view("json",$data);
}
public function getsinglephotoalbum()
{
$id=$this->input->get_post("id");
$data["message"]=$this->photoalbum_model->getsinglephotoalbum($id);
$this->load->view("json",$data);
}
function getallphotos()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`reliance_photos`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`reliance_photos`.`name`";
$elements[1]->sort="1";
$elements[1]->header="name";
$elements[1]->alias="name";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`reliance_photos`.`order`";
$elements[2]->sort="1";
$elements[2]->header="order";
$elements[2]->alias="order";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`reliance_photos`.`image`";
$elements[3]->sort="1";
$elements[3]->header="image";
$elements[3]->alias="image";

$elements=array();
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
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `reliance_photos`");
$this->load->view("json",$data);
}
public function getsinglephotos()
{
$id=$this->input->get_post("id");
$data["message"]=$this->photos_model->getsinglephotos($id);
$this->load->view("json",$data);
}
function getallvideoalbum()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`reliance_videoalbum`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`reliance_videoalbum`.`order`";
$elements[1]->sort="1";
$elements[1]->header="order";
$elements[1]->alias="order";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`reliance_videoalbum`.`status`";
$elements[2]->sort="1";
$elements[2]->header="status";
$elements[2]->alias="status";

$elements=array();
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
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `reliance_videoalbum`");
$this->load->view("json",$data);
}
public function getsinglevideoalbum()
{
$id=$this->input->get_post("id");
$data["message"]=$this->videoalbum_model->getsinglevideoalbum($id);
$this->load->view("json",$data);
}
function getallvideos()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`reliance_videos`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`reliance_videos`.`name`";
$elements[1]->sort="1";
$elements[1]->header="name";
$elements[1]->alias="name";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`reliance_videos`.`order`";
$elements[2]->sort="1";
$elements[2]->header="order";
$elements[2]->alias="order";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`reliance_videos`.`photoalbum`";
$elements[3]->sort="1";
$elements[3]->header="photoalbum";
$elements[3]->alias="photoalbum";

$elements=array();
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
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `reliance_videos`");
$this->load->view("json",$data);
}
public function getsinglevideos()
{
$id=$this->input->get_post("id");
$data["message"]=$this->videos_model->getsinglevideos($id);
$this->load->view("json",$data);
}
function getallfeedback()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`reliance_feedback`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`reliance_feedback`.`timestamp`";
$elements[1]->sort="1";
$elements[1]->header="timestamp";
$elements[1]->alias="timestamp";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`reliance_feedback`.`salutation`";
$elements[2]->sort="1";
$elements[2]->header="salutation";
$elements[2]->alias="salutation";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`reliance_feedback`.`firstname`";
$elements[3]->sort="1";
$elements[3]->header="firstname";
$elements[3]->alias="firstname";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`reliance_feedback`.`lastname`";
$elements[4]->sort="1";
$elements[4]->header="lastname";
$elements[4]->alias="lastname";

$elements=array();
$elements[5]=new stdClass();
$elements[5]->field="`reliance_feedback`.`middlename`";
$elements[5]->sort="1";
$elements[5]->header="middlename";
$elements[5]->alias="middlename";

$elements=array();
$elements[6]=new stdClass();
$elements[6]->field="`reliance_feedback`.`email`";
$elements[6]->sort="1";
$elements[6]->header="email";
$elements[6]->alias="email";

$elements=array();
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
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `reliance_feedback`");
$this->load->view("json",$data);
}
public function getsinglefeedback()
{
$id=$this->input->get_post("id");
$data["message"]=$this->feedback_model->getsinglefeedback($id);
$this->load->view("json",$data);
}
} ?>