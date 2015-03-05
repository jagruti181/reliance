<div class="row" style="padding:1% 0">
<div class="col-md-12">
<a class="btn btn-primary pull-right"  href="<?php echo site_url("site/createfeedback"); ?>"><i class="icon-plus"></i>Create </a> &nbsp; 
</div>
</div>
<div class="row">
<div class="col-lg-12">
<section class="panel">
<header class="panel-heading">
feedback Details
</header>
<div class="drawchintantable">
<?php $this->chintantable->createsearch("feedback List");?>
<table class="table table-striped table-hover" id="" cellpadding="0" cellspacing="0" >
<thead>
<tr>
<th data-field="id">id</th>
<th data-field="timestamp">timestamp</th>
<th data-field="salutation">salutation</th>
<th data-field="firstname">firstname</th>
<th data-field="lastname">lastname</th>
<th data-field="middlename">middlename</th>
<th data-field="email">email</th>
<th data-field="contact">contact</th>
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
return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.timestamp + "</td><td>" + resultrow.salutation + "</td><td>" + resultrow.firstname + "</td><td>" + resultrow.lastname + "</td><td>" + resultrow.middlename + "</td><td>" + resultrow.email + "</td><td>" + resultrow.contact + "</td><td><a class='btn btn-primary btn-xs' href='<?php echo site_url('site/editfeedback?id=');?>"+resultrow.id+"'><i class='icon-pencil'></i></a><a class='btn btn-danger btn-xs' href='<?php echo site_url('site/deletefeedback?id='); ?>"+resultrow.id+"'><i class='icon-trash '></i></a></td></tr>";
}
generatejquery("<?php echo $base_url;?>");
</script>
</div>
</div>
