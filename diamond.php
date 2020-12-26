<?php require_once('db.php');?>
<?php

$sql="SELECT offices.office_name,count(*)as count,sum(diamond_size)as diamond_size from diamonds LEFT JOIN offices on
diamonds.office_id=offices.office_id where diamond_status Not in ('Invoiced','Deleted','Inactive')
and diamond_type='Certified'
GROUP BY offices.office_name ";

$result = mysqli_query($mysqli, $sql);
?>
<div class="container">
    <table class="table table-bordered table-info" >
        <th>Serial Number</th>
        <th>Office Location</th>
        <th>Diamond Count</th>
        <th>Diamond Carat</th>
        <tbody>
        <?php $count=1; ?>
        <?php if ($result->num_rows > 0):?>
            <?php foreach($result as $row ):?>
                <tr>
                    <td><?php echo $count++; ?></td>
                    <td><?php echo $row['office_name']; ?></td>
                    <td><?php echo $row['count']?> </td>
                    <td><?php echo $row['diamond_size']?> </td>
                </tr>
            <?php endforeach;?>
        <?php endif;?>
        </tbody>
    </table>
</div>
