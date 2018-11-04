<br><br><br>
<br><br><br>
  <ul class="nav nav-pills">
    <li  
    class="<?php 
    		if(isset($active))
    			if($active == 'report') echo "active" 
    	?>">
    	<a href="<?php echo base_url('admin/transactionNo'); ?>">List</a>
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
            <a href="<?php echo base_url('admin/transactionNoAdd'); ?>">Add</a>
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
                             Transaction Number
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
                                <?php echo form_open('admin/transactionSave', $form_data); ?>
                            <?php }else if($active == 'edit'){ ?>
                                <?php echo form_open('admin/transactionModify/'.$transaction[0]['componentId'], $form_data); ?>
                            <?php } ?>                         
                            
                                <div class="form-group">
                                    <label for="transactionNO" class="col-lg-3 control-label">Transaction No</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="transactionNO"
                                            
                                        <?php if($active == 'edit'){ ?>
                                            value="<?php echo $transaction[0]['transactionNO'] ?>"
                                        <?php } ?>
                                        id="transactionNO" class="form-control" required>
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="bank" class="col-lg-3 control-label">Bank</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="bank"
                                            
                                        <?php if($active == 'edit'){ ?>
                                            value="<?php echo $transaction[0]['bank'] ?>"
                                        <?php } ?>
                                        id="bank" class="form-control">
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="amount" class="col-lg-3 control-label">Amount</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="amount"
                                            
                                        <?php if($active == 'edit'){ ?>
                                            value="<?php echo $transaction[0]['amount'] ?>"
                                        <?php } ?>
                                        id="amount" class="form-control" required>
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="used" class="col-lg-3 control-label">Used or Not</label>
                                    <div class="col-lg-6">
                                        <select name="used" class="form-control">
                                            <option value="1"
                                                <?php if($active == 'edit'){ 
                                                 echo ($transaction[0]['used'] == 1)?'selected':''; 
                                                  } ?>
                                            >Used</option>
                                            <option value="2"
                                                <?php if($active == 'edit'){ 
                                                 echo ($transaction[0]['used'] == 2)?'selected':''; 
                                                  } ?>
                                            >Not Used</option>
                                        </select>
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="orderId" class="col-lg-3 control-label">orderId</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="orderId"
                                            
                                        <?php if($active == 'edit'){ ?>
                                            value="<?php echo $transaction[0]['orderId'] ?>"
                                        <?php } ?>
                                        id="orderId" class="form-control">
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
  
