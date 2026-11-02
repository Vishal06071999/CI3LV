<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

<!-- Bootstrap Icons -->

<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<!-- DataTables -->

<link
    rel="stylesheet"
    href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.min.css">

<!-- DataTables Buttons -->

<link
    rel="stylesheet"
    href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.bootstrap5.min.css">
      <link href="<?php echo base_url('AppAjax/notify.css'); ?>" rel="stylesheet">

<style>
    /* =========================================================
           Export Dropdown
        ========================================================= */

    .custom-export-dropdown {
        position: relative;
        display: inline-block;
    }

    .custom-export-menu {
        display: none;
        position: absolute;
        top: calc(100% + 6px);
        right: 0;
        min-width: 190px;

        background: #ffffff;

        border: 1px solid #dee2e6;
        border-radius: 8px;

        padding: 6px 0;

        box-shadow:
            0 8px 25px rgba(0, 0, 0, 0.12);

        z-index: 99999;
    }

    .custom-export-menu.show {
        display: block;
    }

    .custom-export-menu button {

        width: 100%;

        display: flex;
        align-items: center;

        border: 0;

        background: transparent;

        padding: 10px 15px;

        text-align: left;

        font-size: 14px;

        color: #212529;

        cursor: pointer;
    }

    .custom-export-menu button:hover {
        background-color: #f5f5f5;
    }

    /* =========================================================
           Table
        ========================================================= */

    #dataTable th {
        white-space: nowrap;
    }

    #dataTable td {
        vertical-align: middle;
    }

    .table-card {
        overflow: visible;
    }

    /* =========================================================
           Hide DataTables Buttons
        ========================================================= */

    .dt-buttons {
        position: absolute !important;

        left: -99999px !important;
        top: -99999px !important;

        width: 1px !important;
        height: 1px !important;

        overflow: hidden !important;
    }

    /* =========================================================
           Length
        ========================================================= */

    .dt-length select {
        min-width: 75px;
    }

    .dt-paging .pagination {
        margin-bottom: 0;
    }

    /* =========================================================
           Mobile
        ========================================================= */

    @media (max-width: 767px) {

        .custom-export-menu {
            right: 0;
            left: auto;
        }

    }
</style>

</head>


<body>


    <div class="p-4">


        <!-- =========================================================
         Top Controls
    ========================================================= -->

        <div class="row g-3 mb-4 align-items-center">


            <!-- Search -->

            <div class="col-md-4">

                <div class="input-group">

                    <span class="input-group-text">

                        <i class="bi bi-search"></i>

                    </span>

                    <input
                        type="text"
                        id="tableSearch"
                        class="form-control"
                        placeholder="Search..."
                        autocomplete="off">

                </div>

            </div>


            <!-- Export -->

            <div class="col-md-auto ms-auto">

                <div class="custom-export-dropdown">
                    <?php if(!empty($export) && $export == true){ ?>

                    <button
                        type="button"
                        class="btn btn-primary"
                        id="exportDropdown">

                        <i class="bi bi-download me-1"></i>

                        Export

                        <i
                            class="bi bi-chevron-down ms-1"
                            id="exportArrow"></i>

                    </button>
                    <?php } ?>


                    <!-- Export Menu -->

                    <div
                        class="custom-export-menu"
                        id="exportMenu">

                        <button
                            type="button"
                            id="exportCopy">

                            <i class="bi bi-clipboard me-2"></i>

                            Copy

                        </button>


                        <button
                            type="button"
                            id="exportExcel">

                            <i class="bi bi-file-earmark-excel me-2"></i>

                            Excel

                        </button>


                        <button
                            type="button"
                            id="exportCsv">

                            <i class="bi bi-filetype-csv me-2"></i>

                            CSV

                        </button>


                        <button
                            type="button"
                            id="exportPdf">

                            <i class="bi bi-file-earmark-pdf me-2"></i>

                            PDF

                        </button>


                        <button
                            type="button"
                            id="exportPrint">

                            <i class="bi bi-printer me-2"></i>

                            Print

                        </button>

                    </div>

                </div>

            </div>

        </div>



        <!-- =========================================================
         Table
    ========================================================= -->

        <div class="card border-0 shadow-sm rounded-4 table-card">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table
                        id="dataTable"
                        class="table table-hover mb-0 align-middle"
                        style="width:100%;">

                        <thead>

                            <tr>

                                <?php foreach ($th as $heading): ?>

                                    <th>
                                        <?= htmlspecialchars($heading); ?>
                                    </th>

                                <?php endforeach; ?>

                            </tr>

                        </thead>


                        <tbody>

                            <?php
                            $i = 1;
                            foreach ($td as $row): 
                            array_unshift($row,$i);  
                            ?>
                                <tr>
                                    <?= implode('', array_map(function ($value) {
                                        return '
                                        <td class="fw-medium">'.($value). '</td>';}, $row));
                                   
                                    ?>
                                </tr>

                            <?php 
                         $i++;
                        endforeach; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>



    <!-- =============================================================
     jQuery
============================================================= -->

    <script
        src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <script src="<?php echo base_url('AppAjax/notify.js') ?>"> </script>
  <script src="<?php echo base_url('AppAjax/ajax.js') ?>"></script>

    <!-- =============================================================
     DataTables
============================================================= -->

    <script
        src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>

    <script
        src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.min.js"></script>


    <!-- =============================================================
     DataTables Buttons
============================================================= -->

    <script
        src="https://cdn.datatables.net/buttons/3.1.2/js/dataTables.buttons.min.js"></script>

    <script
        src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.bootstrap5.min.js"></script>


    <!-- =============================================================
     JSZip
============================================================= -->

    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>


    <!-- =============================================================
     PDFMake
============================================================= -->

    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>

    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>


    <!-- =============================================================
     HTML5 Export
============================================================= -->

    <script
        src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.html5.min.js"></script>


    <!-- =============================================================
     Print
============================================================= -->

    <script
        src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.print.min.js"></script>



    <script>
        $(document).ready(function() {


            /* =========================================================
               Dynamic Export Title
            ========================================================= */

            const exportTitle = '<?php echo (!empty($header) ?  $header : '');  ?>';



            /* =========================================================
               DataTable
            ========================================================= */

            const table = $('#dataTable').DataTable({

                pageLength: 10,

                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, 'All']
                ],

                order: [],

                searching: true,

                responsive: true,


                /* =====================================================
                   DataTables Layout
                ===================================================== */

                layout: {

                    topStart: 'pageLength',

                    topEnd: null,

                    bottomStart: 'info',

                    bottomEnd: 'paging'

                },


                /* =====================================================
                   Language
                ===================================================== */

                language: {

                    lengthMenu: '_MENU_ records per page',

                    info: 'Showing _START_ to _END_ of _TOTAL_ records',

                    infoEmpty: 'No records available',

                    zeroRecords: 'No matching records found',

                    emptyTable: 'No records found',

                    paginate: {

                        previous: 'Previous',

                        next: 'Next'

                    }

                },


                /* =====================================================
                   IMPORTANT:
                   Register Buttons directly inside DataTable
                ===================================================== */

                buttons: [

                    {
                        extend: 'copyHtml5',

                        title: exportTitle,

                        exportOptions: {
                            columns: ':visible'
                        }
                    },


                    {
                        extend: 'excelHtml5',

                        title: exportTitle,

                        exportOptions: {
                            columns: ':visible'
                        }
                    },


                    {
                        extend: 'csvHtml5',

                        title: exportTitle,

                        exportOptions: {
                            columns: ':visible'
                        }
                    },


                    {
                        extend: 'pdfHtml5',

                        title: exportTitle,

                        orientation: 'landscape',

                        pageSize: 'A4',

                        exportOptions: {
                            columns: ':visible'
                        }
                    },


                    {
                        extend: 'print',

                        title: exportTitle,

                        exportOptions: {
                            columns: ':visible'
                        }
                    }

                ]

            });



            /* =========================================================
               Search
            ========================================================= */

            $('#tableSearch').on('keyup', function() {

                table
                    .search(this.value)
                    .draw();

            });



            /* =========================================================
               Export Dropdown
            ========================================================= */

            const exportMenu = $('#exportMenu');

            const exportArrow = $('#exportArrow');



            function closeExportMenu() {

                exportMenu.removeClass('show');

                exportArrow
                    .removeClass('bi-chevron-up')
                    .addClass('bi-chevron-down');

            }



            /* =========================================================
               Toggle Export Menu
            ========================================================= */

            $('#exportDropdown').on('click', function(e) {

                e.preventDefault();

                e.stopPropagation();


                exportMenu.toggleClass('show');


                exportArrow.toggleClass(
                    'bi-chevron-down bi-chevron-up'
                );

            });



            /* =========================================================
               Close Outside Click
            ========================================================= */

            $(document).on('click', function(e) {

                if (
                    !$(e.target)
                    .closest('.custom-export-dropdown')
                    .length
                ) {

                    closeExportMenu();

                }

            });



            /* =========================================================
               IMPORTANT:
               Get DataTables Button instances
            ========================================================= */

            const buttons = table.buttons();



            /* =========================================================
               Copy
            ========================================================= */

            $('#exportCopy').on('click', function() {

                buttons
                    .button(0)
                    .trigger();

                closeExportMenu();

            });



            /* =========================================================
               Excel
            ========================================================= */

            $('#exportExcel').on('click', function() {

                buttons
                    .button(1)
                    .trigger();

                closeExportMenu();

            });



            /* =========================================================
               CSV
            ========================================================= */

            $('#exportCsv').on('click', function() {

                buttons
                    .button(2)
                    .trigger();

                closeExportMenu();

            });



            /* =========================================================
               PDF
            ========================================================= */

            $('#exportPdf').on('click', function() {

                buttons
                    .button(3)
                    .trigger();

                closeExportMenu();

            });



            /* =========================================================
               Print
            ========================================================= */

            $('#exportPrint').on('click', function() {

                buttons
                    .button(4)
                    .trigger();

                closeExportMenu();

            });


        });
    </script>