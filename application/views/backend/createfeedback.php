<div class="row" style="padding:1% 0">
    <div class="col-md-12">
        <div class="pull-right">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                feedback Details
            </header>
            <div class="panel-body">
                <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/createfeedbacksubmit");?>' enctype='multipart/form-data'>
                    <div class="panel-body">
                        <div class=" form-group">
                            <label class="col-sm-2 control-label" for="normal-field">salutation</label>
                            <div class="col-sm-4">
                                <?php echo form_dropdown( "salutation",$salutation,set_value( 'salutation'), "class='chzn-select form-control'");?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">firstname</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="firstname" value='<?php echo set_value(' firstname ');?>'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">lastname</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="lastname" value='<?php echo set_value(' lastname ');?>'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">middlename</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="middlename" value='<?php echo set_value(' middlename ');?>'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">email</label>
                            <div class="col-sm-4">
                                <input type="email" id="normal-field" class="form-control" name="email" value='<?php echo set_value(' email ');?>'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">contact</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="contact" value='<?php echo set_value(' contact ');?>'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="<?php echo site_url(" site/viewpage "); ?>" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                </form>
                </div>
        </section>
        </div>
    </div>
