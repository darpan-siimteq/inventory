<?php include('db.php');
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <title>Fetch Diamonds</title>

</head>
<body>
<div class="container">
    <h2>Certified Diamonds</h2>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <?php
            $shapes = "SELECT attribute_name FROM attributes where attribute_type = 'Shape'";
            $result = mysqli_query($mysqli, $shapes);
            if (mysqli_num_rows($result) > 0) {
                foreach ($result as $shape) {
                    ?>
                    <a class="nav-item nav-link active tabwisedata" id="<?php echo $shape['attribute_name'] ?>" data-shape="<?php echo $shape['attribute_name'] ?>" data-toggle="tab" href="#<?php echo $shape['attribute_name']?>" role="tab" aria-controls="nav-home" aria-selected="true"><?php echo $shape['attribute_name'] ?></a>
                <?php  }
            } ?>
        </div>
    </nav>
    <nav>
        <div id="selection" style="padding-top: 15px;">
            <select name='user' class='filterElements' data-cell-to-filter="c3" id="shape_filter">
                <option value="Select Diamond Name">Select Diamond Name</option>
                <?php
                $shapes = "SELECT attribute_name FROM attributes where attribute_type = 'Shape' ";
                $result = mysqli_query($mysqli, $shapes);
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $shape) {
                        ?>
                        <option  value="<?php echo $shape['attribute_name']; ?>"> <?php echo $shape['attribute_name']; ?></option> <?php  }
                } ?>
            </select>
        </div>
    </nav>

    <div style="padding-bottom: 10px;padding-top: 10px;" align="right">
        <input type="search" class="light-table-filter" data-table="table-info" placeholder="Search">
    </div>
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
        <tbody  id="table">
        <?php
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
            /* $c = 0;*/
            foreach($result as $row) {
                ?>

                <tr ng-repeat="x in data">
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
                    <td><?php echo round($row['diamond_meas3'],2); ?></td>
                    <td><?php echo $row['diamond_status']; ?></td>
                </tr>
            <?php } } ?>

        </tbody>
    </table>
</div>
<script type="text/javascript">

    (function(document) {
        'use strict';

        var TableFilter = (function(Arr) {
            var _input;
            function _onInputEvent(e) {
                _input = e.target;
                var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
                Arr.forEach.call(tables, function(table) {
                    Arr.forEach.call(table.tBodies, function(tbody) {
                        Arr.forEach.call(tbody.rows, _filter);
                    });
                });
            }
            function _filter(row) {
                var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
                row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
            }
            return {
                init: function() {
                    var inputs = document.getElementsByClassName('light-table-filter');
                    Arr.forEach.call(inputs, function(input) {
                        input.oninput = _onInputEvent;
                    });
                }
            };
        })(Array.prototype);
        document.addEventListener('readystatechange', function() {
            if (document.readyState === 'complete') {
                TableFilter.init();
            }
        });
    })(document);

    $(function() {
        $('#table').filterRowsByValue( $('.filterElements') );
        $('.tabwisedata').on('click',function(){
            let shape = $(this).attr('data-shape');
            $('#shape_filter').val(shape);
            $('#shape_filter').trigger('change');
        });
        // $('.filterElements').change(); // uncomment to start with blank table
    });

    jQuery.fn.filterRowsByValue = function(masterSelects) {
        return this.each(function() {
            var table = this;
            var rows = [];
            $(table).find('tr').each(function() {
                var cells={};
                $(this).find('td').each (function(i, e) {
                    cells['c'+i] = $(this).html();
                });
                rows.push(cells);
            });
            $(table).data('tr', rows);

            masterSelects.bind('change', function() {
                var cur=this;
                masterSelects.each(function(i,e){
                    if( e != cur ){
                        $(e).val("0");
                    }
                });
                var rows = $(table).empty().scrollTop(0).data('tr');

                var search = '^'+$.trim($(this).val())+'$';
                var regex = new RegExp(search,'gi');
                var cel = $(this).data( "cell-to-filter" );
                $.each(rows, function(i,e) {
                    var row = rows[i];
                    if(row[cel].match(regex) !== null) {
                        var cellArr=[];
                        for (var curCell in row) {
                            if(row.hasOwnProperty(cel)){
                                cellArr.push('<td>'+row[curCell]+'</td>');
                            }
                        }
                        $(table).append( '<tr>'+cellArr.join('')+'</tr>' );
                    }
                });
            });

        });
    };
</script>


</body>
</html>