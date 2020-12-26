<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2 style="padding-left: 30px;padding-top: 20px;">Diamonds Inventory</h2>
    <ul class="nav nav-pills" style="padding-left: 20px;padding-top: 20px;">

        <li><a data-toggle="pill" href="#menu1">Status</a></li>
        <li><a data-toggle="pill" href="#menu2">Location</a></li>
        <li><a data-toggle="pill" href="#menu3">Certified</a></li>
    </ul>

    <div class="tab-content">

        <div id="menu1" class="tab-pane fade in active">
            <h3 style="padding-top: 50px;padding-left: 20px;">Status</h3>
            <?php require_once('status.php') ?>
        </div>
        <div id="menu2" class="tab-pane fade">
            <h3 style="padding-top: 50px;padding-left: 20px;">Location</h3>
            <?php require_once('diamond.php') ?>
        </div>
        <div id="menu3" class="tab-pane fade">
            <h3 style="padding-top: 50px;padding-left: 20px;">Certified Diamonds</h3>
            <?php require_once('index.php') ?>
        </div>
    </div>
</div>

</body>
</html>
