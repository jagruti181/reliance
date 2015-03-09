<?php foreach($before as $row){?>
   <div class="panel-body">
                        <div class="form-group">
 <label class="col-sm-2 control-label" for="normal-field">name</label>
     <div class="col-sm-4">
                             <input type="text" id="normal-field" class="form-control" name="name" value="<?php echo $row->id;?>"
        </div>
          </div>
             </div>
                <div class="panel-body">
                        <div class="form-group">
 <label class="col-sm-2 control-label" for="normal-field">flexibility</label>
     <div class="col-sm-4">
                             <input type="text" id="normal-field" class="form-control" name="name" value="<?php echo $row->flexibility;?>"
        </div>
          </div>
             </div>

<?php }?>