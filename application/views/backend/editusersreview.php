<section class="panel">
    <header class="panel-heading">
        photoalbum Details
    </header>
    <div class="panel-body">
        <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/editusersreviewsubmit");?>' enctype='multipart/form-data'>

            <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">name</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="name" value='<?php echo set_value(' name ',$before->name);?>' disabled>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Email</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="email" value='<?php echo set_value(' order ',$before->email);?> ' disabled>
                </div>
            </div>
            <div class=" form-group">
                <label class="col-sm-2 control-label" for="normal-field">Phone</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="phone" value='<?php echo set_value(' order ',$before->phone);?>' disabled>
                </div>
            </div>
                <div class=" form-group">
                <label class="col-sm-2 control-label" for="normal-field">Message</label>
                <div class="col-sm-4">
                   <img src="<?php echo $before->message?>" alt="" disabled>
                </div>
            </div>
                            <div class=" form-group">
                <label class="col-sm-2 control-label" for="normal-field">dots</label>
                <div class="col-sm-4">
                  <input type="text" id="normal-field" class="form-control" name="phone" value='<?php echo set_value(' order ',$before->dots);?>' disabled>
                </div>
            </div>

                                    <div class=" form-group">
                <label class="col-sm-2 control-label" for="normal-field">jerseyscore</label>
                <div class="col-sm-4">
                  <input type="text" id="normal-field" class="form-control" name="phone" value='<?php echo set_value(' order ',$before->jerseyscore);?>' disabled>
                </div>
            </div>
            
            
                                    <div class=" form-group">
                <label class="col-sm-2 control-label" for="normal-field">testtime</label>
                <div class="col-sm-4">
                   <input type="text" id="normal-field" class="form-control" name="phone" value='<?php echo set_value(' order ',$before->testtime);?>' disabled>
                </div>
            </div>
            
                                                <div class=" form-group">
                <label class="col-sm-2 control-label" for="normal-field">certificate</label>
                <div class="col-sm-4">
                <input type="text" id="normal-field" class="form-control" name="phone" value='<?php echo set_value(' order ',$before->certificate);?>' disabled>
                </div>
            </div>
        </form>
    </div>
</section>
