<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class photoalbum_model extends CI_Model
{
         public function getstatusdropdown()
    {
       	$query=$this->db->query("SELECT * FROM  `status`")->result();
		$return=array(
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
	  return $return;
    }
    
    
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
$query=$this->db->get("reliance_photoalbum")->row();
return $query;
}
function getsinglephotoalbum($id){
$this->db->where("id",$id);
$query=$this->db->get("reliance_photoalbum")->row();
return $query;
}
public function edit($id,$name,$order,$status)
{
$data=array("name" => $name,"order" => $order,"status" => $status);
$this->db->where( "id", $id );
$query=$this->db->update( "reliance_photoalbum", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `reliance_photoalbum` WHERE `id`='$id'");
return $query;
}
}
?>
