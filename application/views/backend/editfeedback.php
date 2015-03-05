<section class="panel">
<header class="panel-heading">
feedback Details
</header>
<div class="panel-body">
<form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/editfeedbacksubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">timestamp</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="timestamp" value='<?php echo set_value('timestamp',$before->timestamp);?>'>
</div>
</div>
<div class=" form-group">
<label class="col-sm-2 control-label" for="normal-field">salutation</label>
<div class="col-sm-4">
<?php echo form_dropdown("salutation",$salutation,set_value('salutation',$before->salutation),"class='chzn-select form-control'");?>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">firstname</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="firstname" value='<?php echo set_value('firstname',$before->firstname);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">lastname</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="lastname" value='<?php echo set_value('lastname',$before->lastname);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">middlename</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="middlename" value='<?php echo set_value('middlename',$before->middlename);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">email</label>
<div class="col-sm-4">
<input type="email" id="normal-field" class="form-control" name="email" value='<?php echo set_value('email',$before->email);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">contact</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="contact" value='<?php echo set_value('contact',$before->contact);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
<div class="col-sm-4">
<button type="submit" class="btn btn-primary">Save</button>
<a href='<?php echo site_url("site/viewpage"); ?>' class='btn btn-secondary'>Cancel</a>
</div>
</div>
</form>
</div>
</section>
