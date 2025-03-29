<!-- Footer -->
<footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
        <div class="mb-2 mb-md-0">
            © <?= APP_NAME ?>
            <script>
                document.write(new Date().getFullYear());
            </script>
            , made with ❤️ by
            <a href="https://vesencomuting.com" target="_blank" class="footer-link fw-bolder">Vesen Computing</a>
        </div>
       
    </div>
</footer>
<!-- / Footer -->

<div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
</div>
<!-- / Layout page -->
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>

<!-- Drag Target Area To SlideIn Menu On Small Screens -->
<div class="drag-target"></div>
</div>
<!-- / Layout wrapper -->

<script src="<?= admin_url ?>assets/js/extended-ui-sweetalert2.js"></script>
<!-- Core JS -->
<!-- build:js <?= admin_url ?>assets/vendor/js/core.js -->
<script src="<?= admin_url ?>assets/vendor/libs/popper/popper.js"></script>
<script src="<?= admin_url ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="<?= admin_url ?>assets/vendor/libs/i18n/i18n.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="<?= admin_url ?>assets/vendor/libs/apex-charts/apexcharts.js"></script>
<script>
    function image_preview(my_img, img_loader) {
        $(function() {
            $(my_img).change(function(event) {
                let img = URL.createObjectURL(event.target.files[0]);
                $(img_loader).attr("src", img);
                console.log(event);
            });
        });
    }

    image_preview("#my_img", "#img_loader");
    image_preview("#my_image", "#image_loader");
    image_preview("#my_image2", "#image_loader2");
    image_preview("#my_vid", "#vid_loader");
    image_preview("#menu", "#menu_loader");
    image_preview("#upload", "#uploadedAvatar");
</script>

<!-- Core JS -->
<!-- build:js <?= admin_url ?>assets/vendor/js/core.js -->
<script src="<?= admin_url ?>assets/vendor/libs/jquery/jquery.js"></script>
<script src="<?= admin_url ?>assets/vendor/js/bootstrap.js"></script>
<script src="<?= admin_url ?>assets/vendor/libs/hammer/hammer.js"></script>
<script src="<?= admin_url ?>assets/vendor/libs/typeahead-js/typeahead.js"></script>

<script src="<?= admin_url ?>assets/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="<?= admin_url ?>assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
<script src="<?= admin_url ?>assets/vendor/libs/select2/select2.js"></script>
<script src="<?= admin_url ?>assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>
<script src="<?= admin_url ?>assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
<script src="<?= admin_url ?>assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>
<script src="<?= admin_url ?>assets/vendor/libs/cleavejs/cleave.js"></script>
<script src="<?= admin_url ?>assets/vendor/libs/cleavejs/cleave-phone.js"></script>
<script src="<?= admin_url ?>assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
<!-- Flat Picker -->
<script src="<?= admin_url ?>assets/vendor/libs/moment/moment.js"></script>
<script src="<?= admin_url ?>assets/vendor/libs/flatpickr/flatpickr.js"></script>
<!-- Form Validation -->

<!-- Main JS -->
<script src="<?= admin_url ?>assets/js/main.js"></script>

<!-- Page JS -->
<script src="<?= admin_url ?>assets/js/tables-datatables-basic.js"></script>
<script src="<?= admin_url ?>assets/js/form-layouts.js"></script>
<script src="<?= admin_url ?>assets/js/pages-account-settings-security.js"></script>
<script src="<?= admin_url ?>assets/js/modal-enable-otp.js"></script>
<script src="<?= admin_url ?>assets/js/pages-profile.js"></script>
<script src="<?= admin_url ?>assets/js/dashboards-analytics.js"></script>
<script src="<?= admin_url ?>assets/js/dashboards-crm.js"></script>
<script src="<?= admin_url ?>assets/js/pages-account-settings-account.js"></script>

<script>
    $(document).ready(function() {
        <?php
        if (!empty($_SESSION['error'])) {
            foreach ($_SESSION['error'] as $err) {
                error_message(ERROR_DEFINITION[$err]) . PHP_EOL;
            }
        }

        if (!empty($_SESSION['success'])) {
            foreach ($_SESSION['success'] as $success) {
                success_message(SUCCESS_DEFINITION[$success]) . PHP_EOL;
            }
        }

        if (!empty($_SESSION['warning'])) {
            foreach ($_SESSION['warning'] as $warning) {
                warning_message(WARNING_DEFINITION[$warning]) . PHP_EOL;
            }
        }

        unset_session_error();
        unset_session_success();
        unset_session_warning();
        ?>


    })
</script>

<script>
    $(document).ready(function() {
        // datatable (jquery)

        console.log(<?= json_encode($column_defs) ?>);
        $(function() {
            var dt_basic_table = $('.datatables-basic');
            if (dt_basic_table.length) {
                dt_basic = dt_basic_table.DataTable({
                    columns: <?= json_encode($column_defs) ?>,
                    columnDefs: [{
                            // For Responsive
                            className: 'control',
                            orderable: false,
                            searchable: false,
                            responsivePriority: 2,
                            targets: 0,
                            render: function(data, type, full, meta) {
                                return '';
                            }
                        },


                        {
                            responsivePriority: 1
                        }
                    ],
                    dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                    displayLength: 7,
                    lengthMenu: [7, 10, 25, 50, 75, 100],
                    
                    buttons: [{   
                            extend: 'collection',
                            className: 'btn btn-label-primary dropdown-toggle me-2',
                            text: '<i class="bx bx-export me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
                            buttons: [{
                                    extend: 'print',
                                    text: '<i class="bx bx-printer me-1" ></i>Print',
                                    className: 'dropdown-item',
                                    exportOptions: {
                                        columns: <?php echo json_encode($column_indexes) ?>
                                    },
                                    customize: function(win) {
                                        //customize print view for dark
                                        $(win.document.body)
                                            .css('color', config.colors.headingColor)
                                            .css('border-color', config.colors.borderColor)
                                            .css('background-color', config.colors.bodyBg);
                                        $(win.document.body)
                                            .find('table')
                                            .addClass('compact')
                                            .css('color', 'inherit')
                                            .css('border-color', 'inherit')
                                            .css('background-color', 'inherit');
                                    }
                                },
                                {
                                    extend: 'csv',
                                    text: '<i class="bx bx-file me-1" ></i>Csv',
                                    className: 'dropdown-item',
                                    exportOptions: {
                                        columns: <?php echo json_encode($column_indexes) ?>
                                    }
                                },
                                {
                                    extend: 'excel',
                                    text: '<i class="bx bxs-file-export me-1"></i>Excel',
                                    className: 'dropdown-item',
                                    exportOptions: {
                                        columns: <?php echo json_encode($column_indexes) ?>
                                    }
                                },
                                {
                                    extend: 'pdf',
                                    text: '<i class="bx bxs-file-pdf me-1"></i>Pdf',
                                    className: 'dropdown-item',
                                    exportOptions: {
                                        columns: [3, 4, 5, 6, 7],
                                        // prevent avatar to be display
                                        format: {
                                            body: function(inner, coldex, rowdex) {
                                                if (inner.length <= 0) return inner;
                                                var el = $.parseHTML(inner);
                                                var result = '';
                                                $.each(el, function(index, item) {
                                                    if (item.classList !== undefined && item.classList.contains('user-name')) {
                                                        result = result + item.lastChild.firstChild.textContent;
                                                    } else if (item.innerText === undefined) {
                                                        result = result + item.textContent;
                                                    } else result = result + item.innerText;
                                                });
                                                return result;
                                            }
                                        }
                                    }
                                },
                                {
                                    extend: 'copy',
                                    text: '<i class="bx bx-copy me-1" ></i>Copy',
                                    className: 'dropdown-item',
                                    exportOptions: {
                                        columns: [3, 4, 5, 6, 7],
                                        // prevent avatar to be display
                                        format: {
                                            body: function(inner, coldex, rowdex) {
                                                if (inner.length <= 0) return inner;
                                                var el = $.parseHTML(inner);
                                                var result = '';
                                                $.each(el, function(index, item) {
                                                    if (item.classList !== undefined && item.classList.contains('user-name')) {
                                                        result = result + item.lastChild.firstChild.textContent;
                                                    } else if (item.innerText === undefined) {
                                                        result = result + item.textContent;
                                                    } else result = result + item.innerText;
                                                });
                                                return result;
                                            }
                                        }
                                    }
                                }
                            ]
                        }
                    ],
                    responsive: {
                        details: {
                            display: $.fn.dataTable.Responsive.display.modal({
                                header: function(row) {
                                    var data = row.data();
                                    return 'Details of ' + data['full_name'];
                                }
                            }),
                            type: 'column',
                            renderer: function(api, rowIdx, columns) {
                                var data = $.map(columns, function(col, i) {
                                    return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                                        ?
                                        '<tr data-dt-row="' +
                                        col.rowIndex +
                                        '" data-dt-column="' +
                                        col.columnIndex +
                                        '">' +
                                        '<td>' +
                                        col.title +
                                        ':' +
                                        '</td> ' +
                                        '<td>' +
                                        col.data +
                                        '</td>' +
                                        '</tr>' :
                                        '';
                                }).join('');

                                return data ? $('<table class="table"/><tbody />').append(data) : false;
                            }
                        }
                    }
                });
            }

            // Filter form control to default size
            // ? setTimeout used for multilingual table initialization
            setTimeout(() => {
                $('.dataTables_filter .form-control').removeClass('form-control-sm');
                $('.dataTables_length .form-select').removeClass('form-select-sm');
            }, 300);
        });

    });
</script>

</body>

</html>