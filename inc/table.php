<?php include('db.php');
$count = 1;
$sql =  "SELECT diamond_lot_no,diamond_cert,diamond_size,diamond_meas1,diamond_meas2,diamond_meas3,diamond_status,
       shape.attribute_name as shape,lab.attribute_name as lab,clr.attribute_name as Clr , cla.attribute_name as Cla From diamonds 
                    LEFT JOIN attributes as shape ON diamonds.diamond_shape_id = shape.attribute_id
                    LEFT JOIN attributes as lab ON diamonds.diamond_lab_id = lab.attribute_id
                     LEFT JOIN attributes as clr ON diamonds.diamond_clr_id = clr.attribute_id
                     LEFT JOIN attributes as cla ON diamonds.diamond_cla_id = cla.attribute_id
                    where  diamond_status ='Available' and diamond_type = 'Certified'
                    Order BY shape.attribute_order ASC,diamonds.diamond_size DESC;
                 ";

$result = mysqli_query($mysqli, $sql);
if (mysqli_num_rows($result) > 0) {
    foreach($result as $row) {
        ?>
        <tr">
            <td><?php echo $count++; ?></td>
            <td><?php echo $row['diamond_lot_no']; ?></td>
            <td><?php echo $row['diamond_cert']; ?></td>
            <td><?php echo $row['shape']; ?></td>
            <td><?php echo $row['lab']; ?></td>
            <td><?php echo $row['Clr']; ?></td>
            <td><?php echo $row['Cla']; ?></td>
            <td><?php echo round($row['diamond_size'],2); ?></td>
            <td><?php echo round($row['diamond_meas1'],2); ?></td>
            <td><?php echo round($row['diamond_meas2'],2); ?></td>
            <td><?php echo round($row['diamond_meas2'],2); ?></td>
            <td><?php echo $row['diamond_status']; ?></td>
        </tr>
    <?php } } ?>