
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>Brand Name</th>
        <th>Model Name</th>
        <th>Image</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>

<?php if($products == 1){ ?>
    <tr>
      
      <td colspan="5">Empty</td>
      
    </tr>
<?php }else{ ?>
    <?php foreach ($products as $key=>$product) { ?>

        <tr id="<?php echo $product['componentId']; ?>">

            <td><?php echo $key+1; ?></td>
            <td><?php echo $product['brandName']; ?></td>
            <td><?php echo $product['model']; ?></td>
            <td>
              <img src="<?php echo base_url().$product['image'] ?>" class="img-thumbnail" width="80" height="80">
            </td>
            <td>
                <?php echo form_open('customer/editProduct'); ?>
                  <input type="hidden" name="productId" value="<?php echo $product['componentId']; ?>">
                  <input type="submit" class="btn btn-info btn-sm" name="edit" id="edit" value="Edit">
                <?php echo form_close(); ?>
                <br>
                  <a href="javascript:;" class="btn btn-danger btn-sm deleteProduct" value="<?php echo $product['componentId']; ?>">Delete</a>

            </td>

        </tr>
   <?php } ?>
<?php } ?>
    </tbody>
  </table>
  </div>


  <script>
    $('.deleteProduct').on('click', function(){
        var productId = $(this).attr('value');
        url = "<?php echo base_url('customer/deleteProduct'); ?>";

        if(confirm('Sure To Delete')){
          $.ajax({
              type: 'ajax',
              async: false,
              method: 'POST',
              url: url,
              data: {productId, productId},
              dataType: 'json',
              success: function(response){
                  $('tbody tr#'+productId).fadeOut();
              },
              error: function(){
                  alert('Failed');
              }
          });
        }else{
          return false;
        }

        
    });
  </script>
