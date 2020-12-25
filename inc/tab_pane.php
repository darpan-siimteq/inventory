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
$count = 1;
$data = [];
if (mysqli_num_rows($result) > 0) {
    foreach($result as $row) {
        $data[$row['shape']][$count]['diamond_lot_no'] = $row['diamond_lot_no'];
        $data[$row['shape']][$count]['diamond_cert'] = $row['diamond_cert'];
        $data[$row['shape']][$count]['shape'] = $row['shape'];
        $data[$row['shape']][$count]['lab'] = $row['lab'];
        $data[$row['shape']][$count]['Clr'] = $row['Clr'];
        $data[$row['shape']][$count]['Cla'] = $row['Cla'];
        $data[$row['shape']][$count]['diamond_size'] = round($row['diamond_size'],2);;
        $data[$row['shape']][$count]['diamond_meas1'] = round($row['diamond_meas1'],2);;
        $data[$row['shape']][$count]['diamond_meas2'] = round($row['diamond_meas2'],2);;
        $data[$row['shape']][$count]['diamond_meas3'] = round($row['diamond_meas3'],2);;
        $data[$row['shape']][$count]['diamond_status'] = $row['diamond_status'];
        $count++;
    }
}
$counter_1 = 0;
?>

<?php  foreach ($data as $key=>$diamonds)
{
    $shpkeypan = 'tab-'.md5($key); ?>
    <div class="tab-pane fade <?php echo $counter_1 == 0 ? 'show active' : '' ?>" id="<?php echo $shpkeypan; ?>"
         role="tabpanel" aria-labelledby="<?php echo $shpkeypan; ?>-tab">

        <table class="table table-striped table-info" >
            <thead>
            <tr>
                <th>SR No</th>
                <th>Lot Number</th>
                <th>Certificate</th>
                <th>Shape</th>
                <th>Lab</th>
                <th>Clr</th>
                <th>Cla</th>
                <th>Size</th>
                <th>Measurement 1</th>
                <th>Measurement 2</th>
                <th>Measurement 3</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sr = 1;
            foreach ($diamonds as $key=>$row){
                ?>
                <tr>
                    <td><?php echo $sr++; ?></td>
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
                <?php
            }  ?>
            </tbody>
        </table>
    </div>
    <?php
    $counter_1++;
}
?>


