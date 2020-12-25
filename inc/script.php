<script>
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

  /*  $(function() {
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
    };*/
</script>