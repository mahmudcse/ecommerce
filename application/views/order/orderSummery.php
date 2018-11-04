<div>
              <table class="table table-bordered table-responsive">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Brand</th>
                      <th>Model</th>
                      <th>Image</th>
                      <th>Quantity</th>
                      <th>Price (Tk.)</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $total_price = 0; ?>
                  <?php foreach ($carts as $key => $cart): ?>
                    <tr id="<?php echo $cart['cartId']; ?>">
                      <td><?php echo ($key+1); ?></td>
                      <td><?php echo $cart['brandName']; ?></td>
                      <td><?php echo $cart['model']; ?></td>
                      <td>
                        <img src="<?php echo base_url().$cart['image']; ?>" class="img-thumbnail" width="100" height="100">
                      </td>
                      <td>
                        <?php echo $cart['quantity']; ?>
                      </td>
                      <td class="<?php echo $cart['cartId']; ?> rowPrice">

                        <?php 
                          echo $cart['price']*$cart['quantity']; 
                          $total_price += $cart['price']*$cart['quantity']; 
                        ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                    <tr>
                      <td colspan="5" align="center">Total Amount: </td>
                      <td id="totalAmount">
                        <?php echo $total_price; ?>
                      </td>
                      <td>&nbsp;</td>
                    </tr>
                  </tbody>
                </table>
            </div>