// console.log(baseUrl);

$(document).ready(function() {

    function fetch_data() {
        $.ajax({
            method: "GET",
            url: baseUrl + "index.php/ContactListController/contacts",
            dataType: "JSON",
            cache: false,
            success: function(data) {
                console.log(data.contacts);
            }
        });
    }

    fetch_data();

    $('#add_button').click(function() {
        $('#user_form')[0].reset();
        $('.modal-title').text("Add Contact");
        $('#action').val('Add');
        $('#data_action').val("Insert");
        $('#userModal').modal('show');
    });

    $("#addContact").click(function() {
        event.preventDefault();
        $.ajax({
            method: "POST",
            url: baseUrl + "index.php/ContactListController/contact",
            dataType: "JSON",
            cache: false,
            data: {
                name: 'Clark Kent',
                email: 'anjala@email.com',
                telephoneNo: '0711234565'
            },
            success: function(data) {
                console.log(data.response);
            }
        });
        return false;
    });
});