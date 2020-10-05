/*
 * DataTables - Tables
 */
$(function() {
    // Simple Data Table
    $('#data-table-simple').DataTable({
        "responsive": true,
    });
    // Row Grouping Table
    var table = $('#data-table-row-grouping').DataTable({
        "responsive": true,
        "columnDefs": [{
            "visible": false,
            "targets": 2
        }],
        "order": [
            [2, 'asc']
        ],
        "displayLength": 25,
        "drawCallback": function(settings) {
            var api = this.api();
            var rows = api.rows({
                page: 'current'
            }).nodes();
            var last = null;
            api.column(2, {
                page: 'current'
            }).data().each(function(group, i) {
                if (last !== group) {
                    $(rows).eq(i).before(
                        '<tr class="group"><td colspan="5">' + group + '</td></tr>'
                    );
                    last = group;
                }
            });
        }
    });
    // Page Length Option Table
    $('#page-length-option').DataTable({
        "responsive": true,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        "columnDefs": [{
            "targets": [-1], //last column
            "orderable": false, //set not orderable
        }, ]
    });


    // Page Length Option Table for usersListing
    $('#page-length-option1').DataTable({
        "responsive": true,
        "searching": true,
        "bProcessing": true,
        "bServerSide": true,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        order: [
            [0, "desc"]
        ],
        ajax: {
            url: BASE_URL + 'users/usersajax/',
            type: 'POST',
            dataSrc: 'data'
        },
        "columnDefs": [{
            "targets": [-1], //last column
            "orderable": false, //set not orderable
        }, ]
    });

    // Page Length Option Table for imagesListing
    $('#page-length-option2').DataTable({
        "responsive": true,
        "searching": true,
        "bProcessing": true,
        "bServerSide": true,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        order: [
            [0, "desc"]
        ],
        ajax: {
            url: BASE_URL + 'image/uploadajax/',
            type: 'POST',
            dataSrc: 'data'
        },
        "columnDefs": [{
            "targets": [-1], //last column
            "orderable": false, //set not orderable
        }, ]
    });

    // Page Length Option Table for reportListing
    $('#page-length-option3').DataTable({
        "responsive": true,
        "searching": true,
        "bProcessing": true,
        "bServerSide": true,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        order: [
            [0, "desc"]
        ],
        ajax: {
            url: BASE_URL + 'blog/blogReportajax',
            type: 'POST',
            dataSrc: 'data'
        },
        "columnDefs": [{
            "targets": [-1], //last column
            "orderable": false, //set not orderable
        }, ]
    });

    $('#page-length-option34').DataTable({
        "responsive": true,
        "searching": true,
        "bProcessing": true,
        "bServerSide": true,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        order: [
            [0, "desc"]
        ],
        ajax: {
            url: BASE_URL + 'blog/blogReportajax',
            type: 'POST',
            dataSrc: 'data'
        },
        "columnDefs": [{
            "targets": [-1], //last column
            "orderable": false, //set not orderable
        }, ]
    });


    // Page Length Option Table for unpublish blogListing for approval
    $('#page-length-option10').DataTable({
        "responsive": true,
        "searching": true,
        "bProcessing": true,
        "bServerSide": true,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        order: [
            [0, "desc"]
        ],
        //  "displayLength": 25,
        ajax: {
            url: BASE_URL + 'blog/unpublishblogListajax/',
            type: 'POST',
            dataSrc: 'data'
        },
        "columnDefs": [{
            "targets": [-1], //last column
            "orderable": false, //set not orderable
        }, ]
    });

    // Page Length Option Table for publish blogListing for approval
    $('#page-length-option11').DataTable({
        "responsive": true,
        "searching": true,
        "bProcessing": true,
        "bServerSide": true,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        order: [
            [0, "desc"]
        ],
        //  "displayLength": 25,
        ajax: {
            url: BASE_URL + 'blog/blogListAdminajax/',
            type: 'POST',
            dataSrc: 'data'
        },
        "columnDefs": [{
            "targets": [-1], //last column
            "orderable": false, //set not orderable
        }, ]
    });

    // Page Length Option Table for reject blogListing for approval
    $('#page-length-option12').DataTable({
        "responsive": true,
        "searching": true,
        "bProcessing": true,
        "bServerSide": true,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        order: [
            [0, "desc"]
        ],
        //  "displayLength": 25,
        ajax: {
            url: BASE_URL + 'blog/rejectblogListajax/',
            type: 'POST',
            dataSrc: 'data'
        },
        "columnDefs": [{
            "targets": [-1], //last column
            "orderable": false, //set not orderable
        }, ]
    });

    // Page Length Option Table for BLOCKED blogListing for approval
    $('#page-length-option13').DataTable({
        "responsive": true,
        "searching": true,
        "bProcessing": true,
        "bServerSide": true,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        order: [
            [0, "desc"]
        ],
        //  "displayLength": 25,
        ajax: {
            url: BASE_URL + 'blog/blockblogListajax/',
            type: 'POST',
            dataSrc: 'data'
        },
        "columnDefs": [{
            "targets": [-1], //last column
            "orderable": false, //set not orderable
        }, ]
    });

    // Page Length Option Table for CategoryListing
    $('#page-length-option5').DataTable({
        "responsive": true,
        "searching": true,
        "bProcessing": true,
        "bServerSide": true,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        order: [
            [0, "desc"]
        ],
        ajax: {
            url: BASE_URL + 'category/categoriesajax/',
            type: 'POST',
            dataSrc: 'data'
        },
        "columnDefs": [{
            "targets": [-1], //last column
            "orderable": false, //set not orderable
        }, ]
    });

    // Page Length Option Table for notificationListing
    $('#page-length-option6').DataTable({
        "responsive": true,
        "searching": true,
        "bProcessing": true,
        "bServerSide": true,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        order: [
            [0, "desc"]
        ],
        ajax: {
            url: BASE_URL + 'users/notificationajax/',
            type: 'POST',
            dataSrc: 'data'
        },
        "columnDefs": [{
            "targets": [-1], //last column
            "orderable": false, //set not orderable
        }, ]
    });

    // Page Length Option Table for blogListing
    $('#page-length-option7').DataTable({
        "responsive": true,
        "searching": true,
        "bProcessing": true,
        "bServerSide": true,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        order: [
            [0, "desc"]
        ],
        ajax: {
            url: BASE_URL + 'users/draftListajax/',
            type: 'POST',
            dataSrc: 'data'
        },
        "columnDefs": [{
            "targets": [-1], //last column
            "orderable": false, //set not orderable
        }, ]
    });

    // Page Length Option Table for Publish list
    $('#page-length-option8').DataTable({
        "responsive": true,
        "searching": true,
        "bProcessing": true,
        "bServerSide": true,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        order: [
            [0, "desc"]
        ],
        ajax: {
            url: BASE_URL + 'users/publishajax/',
            type: 'POST',
            dataSrc: 'data'
        },
        "columnDefs": [{
            "targets": [-1], //last column
            "orderable": false, //set not orderable
        }, ]
    });

    // Page Length Option Table for Unpublish list
    $('#page-length-option9').DataTable({
        "responsive": true,
        "searching": true,
        "bProcessing": true,
        "bServerSide": true,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        order: [
            [0, "desc"]
        ],
        ajax: {
            url: BASE_URL + 'users/unpublishajax/',
            type: 'POST',
            dataSrc: 'data'
        },
        "columnDefs": [{
            "targets": [-1], //last column
            "orderable": false, //set not orderable
        }, ]
    });


    // Dynmaic Scroll table
    $('#scroll-dynamic').DataTable({
            "responsive": true,
            scrollY: '50vh',
            scrollCollapse: true,
            paging: false
        })
        // Horizontal And Vertical Scroll Table
    $('#scroll-vert-hor').DataTable({
            "scrollY": 200,
            "scrollX": true
        })
        // Multi Select Table
    $('#multi-select').DataTable({
        responsive: true,
        "paging": true,
        "ordering": false,
        "info": false,
        "columnDefs": [{
            "visible": false,
            "targets": 2
        }],
    });
});
// Datatable click on select issue fix
$(window).on('load', function() {
    $(".dropdown-content.select-dropdown li").on("click", function() {
        var that = this;
        setTimeout(function() {
            if ($(that).parent().parent().find('.select-dropdown').hasClass('active')) {
                // $(that).parent().removeClass('active');
                $(that).parent().parent().find('.select-dropdown').removeClass('active');
                $(that).parent().hide();
            }
        }, 100);
    });
});
var checkbox = $('#multi-select tbody tr th input')
var selectAll = $('#multi-select .select-all')
    // Select A Row Function
$(document).ready(function() {
    checkbox.on('click', function() {
        $(this).parent().parent().parent().toggleClass('selected');
    })
    checkbox.on('click', function() {
            if ($(this).attr("checked")) {
                $(this).attr('checked', false);
            } else {
                $(this).attr('checked', true);
            }
        })
        // Select Every Row 
    selectAll.on('click', function() {
        $(this).toggleClass('clicked');
        if (selectAll.hasClass('clicked')) {
            $('#multi-select tbody tr').addClass('selected');
        } else {
            $('#multi-select tbody tr').removeClass('selected');
        }
        if ($('#multi-select tbody tr').hasClass('selected')) {
            checkbox.prop('checked', true);
        } else {
            checkbox.prop('checked', false);
        }
    })
})