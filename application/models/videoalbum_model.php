<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class videoalbum_model extends CI_Model
{
public function create($order,$status,$name)
{
$data=array("order" => $order,"status" => $status,"name" => $name);
$query=$this->db->insert( "reliance_videoalbum", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("reliance_videoalbum")->row();
return $query;
}
function getsinglevideoalbum($id){
$this->db->where("id",$id);
$query=$this->db->get("reliance_videoalbum")->row();
return $query;
}
public function edit($id,$order,$status,$name)
{
$data=array("order" => $order,"status" => $status,"name" => $name);
$this->db->where( "id", $id );
$query=$this->db->update( "reliance_videoalbum", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `reliance_videoalbum` WHERE `id`='$id'");
return $query;
}
}
?>
