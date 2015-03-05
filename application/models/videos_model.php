<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class videos_model extends CI_Model
{
public function create($name,$order,$photoalbum,$url)
{
$data=array("name" => $name,"order" => $order,"photoalbum" => $photoalbum,"url" => $url);
$query=$this->db->insert( "reliance_videos", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("reliance_videos")->row();
return $query;
}
function getsinglevideos($id){
$this->db->where("id",$id);
$query=$this->db->get("reliance_videos")->row();
return $query;
}
public function edit($id,$name,$order,$photoalbum,$url)
{
$data=array("name" => $name,"order" => $order,"photoalbum" => $photoalbum,"url" => $url);
$this->db->where( "id", $id );
$query=$this->db->update( "reliance_videos", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `reliance_videos` WHERE `id`='$id'");
return $query;
}
}
?>
