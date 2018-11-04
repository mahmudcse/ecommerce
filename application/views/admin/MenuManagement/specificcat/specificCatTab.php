<br><br>
<br><br>
<br><br>
<br><br>
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<div class="container">

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">List</a></li>
    <li><a data-toggle="tab" href="#menu1">Add</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <?php include 'specificCat.php'; ?>
    </div>
    <div id="menu1" class="tab-pane fade">
      <?php include 'addSpecificCat.php'; ?>
    </div>
  </div>
</div>
