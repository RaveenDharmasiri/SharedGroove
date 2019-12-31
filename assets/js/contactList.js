console.log(baseUrl);

$(document).ready(function () {
    $('#add_button').click(function () {
        $('#user_form')[0].reset();
        $('.modal-title').text("Add Contact");
        $('#action').val('Add');
        $('#data_action').val("Insert");
        $('#userModal').modal('show');
    });

    $("#create").click(function () {
        event.preventDefault();
        $.ajax({
            method: "GET",
            url: baseUrl + "index.php/ContactListController/contacts",
            dataType: "JSON",
            cache: false,
            data: {
                name: 'Raveen',
            },
            success: function (data) {
                console.log(data);
            }
        });
        return false;
    });
});

