$(document).ready(function () {


    let categoryDataTable = $('#categoryDataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "category",
        columns: [
            { data: 'name', name: 'name' },
            { data: 'cars_count', name: 'cars_count' },
            { data: 'date_added', name: 'date_added' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });

    let brandDataTable = $('#brandDataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "brand",
        columns: [
            { data: 'name', name: 'name' },
            { data: 'cars_count', name: 'cars_count' },
            { data: 'date_added', name: 'date_added' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });


});