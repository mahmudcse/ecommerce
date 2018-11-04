
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( ".accordion" ).accordion({
      collapsible: true
    });
  } );
  </script>
</head>
 
<div class="accordion">

  <?php $cats = $this->db->get('category')->result_array(); ?>
  <?php foreach ($cats as $cat) { ?>
    
      <h3><?php echo $cat['catName']; ?></h3>

      <div>
      <li>
        <a href="<?php echo base_url('customer/filterByCat/').$cat['componentId']; ?>">
          <?php echo $cat['catName']; ?>
        </a>
      </li>
        
        <?php $subCats = $this->db->get_where('subcategory', array('catId' => $cat['componentId']))->result_array(); ?>

      <?php foreach ($subCats as $subCat) { ?>
        <li style="margin-left: 25px;">
          <a href="<?php echo base_url('customer/filterBySubCat/').$subCat['componentId']; ?>">
            <?php echo $subCat['subCatName']; ?>
          </a>
        </li>
  
        <?php $specificCats = $this->db->get_where('specificcat', array('subcatId' => $subCat['componentId']))->result_array(); ?>
        <?php foreach ($specificCats as $specificCat) { ?>
            <li style="margin-left: 50px;">
              <a href="<?php echo base_url('customer/filterBySpecificCat/').$specificCat['componentId']; ?>">
                <?php echo $specificCat['specificCatName'] ; ?>
              </a>
            </li>
        <?php } ?>

      <?php } ?>

    </div>
  <?php } ?>
  
</div>
