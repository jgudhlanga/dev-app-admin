/*
 |--------------------------------------------------------------------------
 | DataTable Buttons
 |--------------------------------------------------------------------------
 | Build the array of DdataTable buttons for CSV, Excel etc
 */
function getDatatableButtons()
{
    return [
        {
            text: 'CSV',
            className: 'btn btn-default m-b-10 m-l-5',
            exportOptions: {
                modifier: {
                    page: 'current'
                }
            }
        },
        {
            extend: 'copy',
            text: 'Copy',
            className: 'btn btn-default m-b-10 m-l-5',
            exportOptions: {
                modifier: {
                    page: 'current'
                }
            }
        },
        {
            extend: 'pdf',
            text: 'PDF',
            className: 'btn btn-default m-b-10 m-l-5',
            exportOptions: {
                modifier: {
                    page: 'current'
                }
            }
        },
        {
            extend: 'excel',
            text: 'Excel',
            className: 'btn btn-default m-b-10 m-l-5',
            exportOptions: {
                modifier: {
                    page: 'current'
                }
            }
        },
        {
            text: 'Reload',
            className: 'btn btn-primary',
            action: function (e, dt) {
                dt.ajax.reload();
            }
        }
    ];
}

// Search footer boxes
function searchHeaderBox( gridName, excludeColumn, searchText )
{
    $('#' + gridName + ' thead th').not(excludeColumn).each( function () {
        var title = $('#' + gridName + ' thead th').eq( $(this).index() ).text();
        $(this).html( title + '<input type="text" onclick="stopPropagation(event);" placeholder="' + searchText + '" style="width:80px;font-size: 12px;" />' );
    } );
}

// Search footer boxes
function searchFooterBox( gridName, excludeColumn, searchText )
{
    $('#' + gridName + ' tfoot th').not(excludeColumn).each( function () {
        $(this).html( '<input type="text" onclick="stopPropagation(event);" placeholder="' + searchText + '" style="width:80px;font-size: 12px;" />' );
    } );
}

// Set the action that the search boxes must do
function initComplete( gridName )
{
    return gridName.columns().every(function () {
        var that = this;
        $('input', this.footer()).on('keyup change', function () {
            that.search(this.value).draw();
        });
        $('input', this.header()).on('keyup change', function () {
            that.search(this.value).draw();
        });
    });
}

// When a row is created we set the class
function createdRowStatus( row, data )
{
    if ( $.inArray( parseInt(data.status_id), [2,4,5,8]) !== -1) {
        $(row).addClass( 'danger' );
    }
    if ( $.inArray( parseInt(data['status_id']), [3]) !== -1 ) {
        $(row).addClass( 'default' );
    }
    // if ( $.inArray( parseInt(data['status_id']), [19]) !== -1 ) {
    //     $(row).addClass( 'warning' );
    // }
    if (typeof data.pay_for !== 'undefined' && data.pay_for !== null) {
        $(row).addClass( 'info' );
    }
}

function setLanguage( language )
{
    return {
        url: '/api/tools/lang/datatable/' + language
    }
}

function getDatatableRefreshButton()
{
    return [
        {
            text: 'Herlaai',
            className: 'btn btn-primary m-b-10 m-l-5',
            action: function (e, dt) {
                dt.ajax.reload();
            }
        }
    ];
}

function getTableLengths()
{
    return [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]];
}