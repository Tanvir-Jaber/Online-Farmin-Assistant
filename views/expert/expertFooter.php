    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="../../dist/js/bappi.js"></script>
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../../plugins/jszip/jszip.min.js"></script>
    <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="../../dist/js/demo.js"></script>

    <script src="https://code.responsivevoice.org/responsivevoice.js?key=uJPD9KjL"></script>

    <script>

        $(function () {
            $("#toast-container").fadeOut(3000)
            $("#example1").DataTable({
                "ordering": false,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "paging": true,
                "info": true,
                buttons: [
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [0,1,2,3,4,5]
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [0,1,2,3,4,5]
                        }

                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0,1,2,3,4,5]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0,1,2,3,4,5]
                        }
                    }
                ]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

        $(".removeNotice").click(function () {
            var value = $(this).attr('data-id')
            var removeNotice = " "
            var result = confirm("Do you want to delete?");
            if (result) {
                $.ajax({
                    type: "POST",
                    url: "../process/data-process.php",
                    data: {
                        value: value,
                        removeNotice :removeNotice
                    },
                    success: function(data)
                    {
                        location.reload();
                    }
                });
            }

        });
        var txt = "আপনার গুরুত্বপূর্ণ নোটিশ লিখুন ";
        var timeOut;
        var txtLen = txt.length;
        var char = 0;
        $('.main-search').attr('placeholder', '|');
        (function typeIt() {
            var humanize = Math.round(Math.random() * (200 - 30)) + 30;
            timeOut = setTimeout(function () {
                char++;
                var type = txt.substring(0, char);
                $('.main-search').attr('placeholder', type + '|');
                typeIt();

                if (char == txtLen) {
                    $('.main-search').attr('placeholder', $('.main-search').attr('placeholder').slice(0, -1)) // remove the '|'
                    clearTimeout(timeOut);
                }

            }, humanize);
        }());
    </script>
    </body>
    </html>

