console.log("all_concession");

$(document).ready(function () {
    loadConcessionTable();

});

let concessionTable;
function loadConcessionTable(){
    
    if ($.fn.DataTable.isDataTable("#tableConcessions")) {
        concessionTable.destroy();
    }

    concessionTable = $("#tableConcessions").DataTable({
        processing: true,
        "scrollX": true,
        ajax: {
            url: "/get_all_concessions",
            type: "GET",
            data: {},
            dataSrc: function(response) {
                return response.data || response;
            },
        },
        columns: [
            { "data": "id" },
            {
                data: "image_path",
                render: function (data) {
                    return `<img src="${data}" height="50" />`;
                }
            },
            { "data": "name" },
            { "data": "price" },
        
            {
                data: 'id',
                render: function (data) {
                    return `
                        <button onclick="edit(${data})" class="btn btn-primary btn-sm">Edit</button>
                        <button onclick="_delete(${data})" class="btn btn-danger btn-sm">Delete</button>
                    `;
                }
            }
        ],
        columnDefs: [{ className: "text-center",
                        targets: [0, 1, 2, 3, 4] },
        { "width": "15%", "targets": [0, 1, 2, 3, 4] }
        ],
        pageLength: 10,
        "order": [[ 0, "asc" ]]
        
        
    });

}

function _delete(id) {
    if (confirm("Are you sure you want to delete this record?")) {
        $.ajax({
            type: "DELETE",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/delete_concession/" + id,

            success: function (response) {
                console.log(response);
                if (response.status === "success") {
                    loadConcessionTable();
                } else {
                    alert("Failed to delete: " + (response.message || "Unknown error"));
                }
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                alert("An error occurred while deleting the concession.");
            },
        });
    } else {
        loadConcessionTable();
    }
}