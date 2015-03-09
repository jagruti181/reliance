<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class events_model extends CI_Model
{
   public function getimage($id)
   {
       $query=$this->db->query("SELECT `image` FROM `reliance_events` WHERE `id`='$id'")->row();
		return $query;
   }
public function create($name,$image,$venue,$description,$photoalbum,$videoalbum)
{
$data=array("name" => $name,"image" => $image,"venue" => $venue,"description" => $description,"photoalbum" => $photoalbum,"videoalbum" => $videoalbum);
$query=$this->db->insert( "reliance_events", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("reliance_events")->row();
return $query;
}
function getsingleevents($id){
$this->db->where("id",$id);
$query=$this->db->get("reliance_events")->row();
return $query;
}
public function edit($id,$name,$image,$venue,$description,$photoalbum,$videoalbum)
{
$data=array("name" => $name,"image" => $image,"venue" => $venue,"description" => $description,"photoalbum" => $photoalbum,"videoalbum" => $videoalbum);
$this->db->where( "id", $id );
$query=$this->db->update( "reliance_events", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `reliance_events` WHERE `id`='$id'");
return $query;
}
}
?>
