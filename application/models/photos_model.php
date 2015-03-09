<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class photos_model extends CI_Model
{
   public function getimagephoto($id)
   {
       $query=$this->db->query("SELECT`image` FROM  `reliance_photos` WHERE `id`='$id'")->row();
       return $query;
       
   }
        public function getphotoalbumdropdown()
    {
       	$query=$this->db->query("SELECT * FROM  `reliance_photoalbum`")->result();
		$return=array(
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
	  return $return;
    }
public function create($name,$order,$image,$photoalbum)
{
$data=array("name" => $name,"order" => $order,"image" => $image,"photoalbum" => $photoalbum);
$query=$this->db->insert( "reliance_photos", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("reliance_photos")->row();
return $query;
}
function getsinglephotos($id){
$this->db->where("id",$id);
$query=$this->db->get("reliance_photos")->row();
return $query;
}
public function edit($id,$name,$order,$image,$photoalbum)
{
$data=array("name" => $name,"order" => $order,"image" => $image,"photoalbum" => $photoalbum);
$this->db->where( "id", $id );
$query=$this->db->update( "reliance_photos", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `reliance_photos` WHERE `id`='$id'");
return $query;
}
}
?>
