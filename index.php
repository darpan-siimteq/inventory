<?php include('db.php');
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Inventory Diamonds</title>
</head>
<body>
<div class="container">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <?php require_once('./inc/tabs.php') ?>
        </ul>
        <div style="padding-bottom: 10px;padding-top: 10px;" align="right">
            <input type="search" class="light-table-filter" data-table="table-info" placeholder="Search">
        </div>
        <div class="tab-content" id="myTabContent">
            <?php require_once('./inc/tab_pane.php') ?>
        </div>

             <?php require_once('status.php') ?>

            <?php require_once('diamond.php') ?>




</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<?php require_once('./inc/script.php') ?>
</body>
</html>