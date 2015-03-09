<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class relianceuser_model extends CI_Model
{

    
public function create($name,$order,$status)
{
$data=array("name" => $name,"order" => $order,"status" => $status);
$query=$this->db->insert( "reliance_photoalbum", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
    
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("users")->row();
return $query;
}
public function beforeedit1($id)
{
$this->db->where("id",$id);
$query=$this->db->get("reviews")->result();
return $query;
}

}
?>
