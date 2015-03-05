<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class feedback_model extends CI_Model
{
public function create($timestamp,$salutation,$firstname,$lastname,$middlename,$email,$contact)
{
$data=array("timestamp" => $timestamp,"salutation" => $salutation,"firstname" => $firstname,"lastname" => $lastname,"middlename" => $middlename,"email" => $email,"contact" => $contact);
$query=$this->db->insert( "reliance_feedback", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("reliance_feedback")->row();
return $query;
}
function getsinglefeedback($id){
$this->db->where("id",$id);
$query=$this->db->get("reliance_feedback")->row();
return $query;
}
public function edit($id,$timestamp,$salutation,$firstname,$lastname,$middlename,$email,$contact)
{
$data=array("timestamp" => $timestamp,"salutation" => $salutation,"firstname" => $firstname,"lastname" => $lastname,"middlename" => $middlename,"email" => $email,"contact" => $contact);
$this->db->where( "id", $id );
$query=$this->db->update( "reliance_feedback", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `reliance_feedback` WHERE `id`='$id'");
return $query;
}
}
?>
