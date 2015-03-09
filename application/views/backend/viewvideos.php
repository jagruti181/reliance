<div class="row" style="padding:1% 0">
    <div class="col-md-12">
        <a class="btn btn-primary pull-right" href="<?php echo site_url("site/createvideos?id=").$this->input->get('id');?>"><i class="icon-plus"></i>Create </a> &nbsp;
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                videos Details
            </header>
            <div class="drawchintantable">
                <?php $this->chintantable->createsearch("videos List");?>
                <table class="table table-striped table-hover" id="" cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th data-field="id">id</th>
                            <th data-field="name">name</th>
                            <th data-field="order">order</th>
                            <th data-field="photoalbum">photoalbum</th>
                            <th data-field="url">url</th>
                            <!--<th data-field="videoid">videoid</th>-->
                            <th data-field="Action">Action</th>
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

                return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.name + "</td><td>" + resultrow.order + "</td><td>" + resultrow.photoalbum + "</td><td>" + resultrow.url + "</td><td><a class='btn btn-primary btn-xs' href='<?php echo site_url('site/editvideos?id=');?>" + resultrow.id + "'><i class='icon-pencil'></i></a><a class='btn btn-danger btn-xs' href='<?php echo site_url('site/deletevideos?id='); ?>" + resultrow.id + "&videoid=" + resultrow.videoid + "'><i class='icon-trash '></i></a></td></tr>";
            }
            generatejquery("<?php echo $base_url;?>");
        </script>
    </div>
</div>
