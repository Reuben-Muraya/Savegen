(function($) {
    //    "use strict";

    /*  Data Table
    -------------*/

    $("#bootstrap-data-table").DataTable({
        lengthMenu: [
            [10, 20, 50, -1],
            [10, 20, 50, "All"]
        ]
    });

    $("#bootstrap-data-table-export").DataTable({
        dom: "lBfrtip",
        // dom: "Blfrtip",
        buttons: [
            {
                extend: "excel",
                text: "Excel",
                className: "btn btn-success",
                style: "padding: 0px"
            },
            {
                extend: "pdf",
                text: "PDF",
                className: "btn btn-danger"
            },
            {
                extend: "print",
                text: "Print",
                className: "btn btn-info"
            },
            {
                extend: "colvis",
                text: "Column Select",
                className: "btn btn-primary"
            }
        ]
    });

    $("#row-select").DataTable({
        initComplete: function() {
            this.api()
                .columns()
                .every(function() {
                    var column = this;
                    var select = $(
                        '<select class="form-control"><option value=""></option></select>'
                    )
                        .appendTo($(column.footer()).empty())
                        .on("change", function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search(val ? "^" + val + "$" : "", true, false)
                                .draw();
                        });

                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function(d, j) {
                            select.append(
                                '<option value="' + d + '">' + d + "</option>"
                            );
                        });
                });
        }
    });
})(jQuery);
