<?php require_once('db.php');?>
<?php

$sql="SELECT diamond_status,count(*)as count,sum(diamond_size)as diamond_size from diamonds where diamond_status 
Not in('Invoiced','Deleted','Inactive') and diamond_type='Certified' GROUP BY diamond_status";

$result = mysqli_query($mysqli, $sql);
?>
<div class="container">
    <table class="table table-bordered table-info" >
        <th>Serial Number</th>
        <th>Status</th>
        <th>Carat</th>
        <th>Count</th>
        <tbody>
        <?php $count=1; ?>
        <?php if ($result->num_rows > 0):?>
            <?php foreach($result as $row ):?>
                <tr>
                    <td><?php echo $count++; ?></td>
                    <td><?php echo $row['diamond_status']; ?></td>
                    <td><?php echo $row['diamond_size']; ?></td>
                    <td><?php echo $row['count']?> </td>

                </tr>
            <?php endforeach;?>
        <?php endif;?>



        </tbody>
    </table>
</div>