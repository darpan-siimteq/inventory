<?php include('db.php');

$shapes = "SELECT attribute_name FROM attributes where attribute_type = 'Shape'";
$result = mysqli_query($mysqli, $shapes);
$counter =0;
if (mysqli_num_rows($result) > 0) {
    foreach ($result as $shape) {
        $shpkey = 'tab-' . md5($shape['attribute_name']); ?>
        <li class="nav-item" role="presentation">
            <a class="nav-link <?php echo $counter == 0 ? 'active' : '' ?>" id="<?php echo $shpkey; ?>-tab"
               data-toggle="tab" href="#<?php echo $shpkey; ?>" role="tab" aria-controls="<?php echo $shpkey; ?>"
               aria-selected="true"><?php echo $shape['attribute_name']; ?></a>
        </li>
        <?php $counter++; }
} ?>