<br><br><br>
<br><br><br>
  <ul class="nav nav-pills">
    <li  
    class="<?php 
    		if(isset($active))
    			if($active == 'report') echo "active" 
    	?>">
    	<a href="<?php echo base_url('admin/events'); ?>">List</a>
    </li>

    <li  class="
    	<?php 
    		if(isset($active))
    			if($active == 'add' || $active == 'edit') echo "active" 
    	?>"
    >
        <?php if($active == 'edit'){ ?>
            <a>Edit</a>
        <?php }else{ ?>
            <a href="<?php echo base_url('admin/eventAdd'); ?>">Add</a>
        <?php } ?>
    </li>
  </ul>

   <?php if(isset($active)): ?>
	<?php if($active == 'report'): ?>
        <?php include 'report.php'; ?>
	<?php endif; ?>
  <?php endif; ?>

  <?php if(isset($active)): ?>
	<?php if($active == 'add' || $active == 'edit'): ?>
		<div class="form-w3layouts">
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <?php 
                                if($active == 'add'){
                                    echo "Add";
                                }else if($active == 'edit'){
                                    echo "Edit";
                                }

                            ?>
                             Events
                        </header>
                        <div class="panel-body">
                            <!-- <form role="form" class="form-horizontal "> -->

                            <?php 
                                $form_data = array(
                                    'role' => 'form',
                                    'class' => 'form-horizontal'
                                );
                            ?>

                            <?php if($active == 'add'){ ?>
                                <?php echo form_open('admin/eventSave', $form_data); ?>
                            <?php }else if($active == 'edit'){ ?>
                                <?php echo form_open('admin/eventModify/'.$event[0]['componentId'], $form_data); ?>
                            <?php } ?>                         
                            
                                <div class="form-group">
                                    <label for="name" class="col-lg-3 control-label">Name</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="name"
                                            
                                        <?php if($active == 'edit'){ ?>
                                            value="<?php echo $event[0]['name'] ?>"
                                        <?php } ?>
                                        id="name" class="form-control" required>
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="caption" class="col-lg-3 control-label">Caption</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="caption"
                                            
                                        <?php if($active == 'edit'){ ?>
                                            value="<?php echo $event[0]['caption'] ?>"
                                        <?php } ?>
                                        id="caption" class="form-control">
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="status" class="col-lg-3 control-label">Status</label>
                                    <div class="col-lg-6">
                                        <select name="status" class="form-control">
                                            <option value="1"
                                                <?php if($active == 'edit'){ 
                                                 echo ($event[0]['status'] == 1)?'selected':''; 
                                                  } ?>
                                            >Active</option>
                                            <option value="2"
                                                <?php if($active == 'edit'){ 
                                                 echo ($event[0]['status'] == 2)?'selected':''; 
                                                  } ?>
                                            >Inactive</option>
                                        </select>
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>


                            <div id="buttons">
                                <div class="form-group">
                                    <div class="col-lg-offset-3 col-lg-6">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        <?php echo form_close(); ?> 
                        </div>
                    </section>
                </div>
            </div>
	<?php endif; ?>
  <?php endif; ?>

  <script>


  </script>
  
