<div class="row" style="padding:1% 0">
<div class="col-md-12">
<a class="btn btn-primary pull-right"  href="<?php echo site_url("site/createevents"); ?>"><i class="icon-plus"></i>Create </a> &nbsp; 
</div>
</div>
<div class="row">
<div class="col-lg-12">
<section class="panel">
<header class="panel-heading">
events Details
</header>
<div class="drawchintantable">
<?php $this->chintantable->createsearch("events List");?>
<table class="table table-striped table-hover" id="" cellpadding="0" cellspacing="0" >
<thead>
<tr>
<th data-field="id">id</th>
<th data-field="name">name</th>
<th data-field="image">image</th>
<th data-field="venue">venue</th>
<th data-field="description">description</th>
<th data-field="photoalbum">photoalbum</th>
<th data-field="videoalbum">videoalbum</th>
</tr>
</thead>
<tbody>
</tbody>
</table>
<?php $this->chintantable->createpagination();?>
</div>
</section>
<script>
function drawtable(resultrow) {
return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.name + "</td><td>" + resultrow.image + "</td><td>" + resultrow.venue + "</td><td>" + resultrow.description + "</td><td>" + resultrow.photoalbum + "</td><td>" + resultrow.videoalbum + "</td><td><a class='btn btn-primary btn-xs' href='<?php echo site_url('site/editevents?id=');?>"+resultrow.id+"'><i class='icon-pencil'></i></a><a class='btn btn-danger btn-xs' href='<?php echo site_url('site/deleteevents?id='); ?>"+resultrow.id+"'><i class='icon-trash '></i></a></td></tr>";
}
generatejquery("<?php echo $base_url;?>");
</script>
</div>
</div>
