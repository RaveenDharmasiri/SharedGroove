// console.log(baseUrl);

$(document).ready(function () {

    function fetch_data() {
        $.ajax({
            method: "GET",
            url: baseUrl + "index.php/ContactListController/contacts",
            dataType: "JSON",
            cache: false,
            success: function (data) {
                console.log(data.contacts);
            }
        });
    }

    fetch_data();

    $('#add_button').click(function () {
        $('#user_form')[0].reset();
        $('.modal-title').text("Add Contact");
        $('#action').val('Add');
        $('#data_action').val("Insert");
        $('#userModal').modal('show');



        // $.ajax({
        //     method: "POST",
        //     url: baseUrl + "index.php/ContactListController/contact",
        //     dataType: "JSON",
        //     cache: false,
        //     data: {
        //         name: 'Clark Kent',
        //         email: 'anjala@email.com',
        //         telephoneNo: '0711234565'
        //     },
        //     success: function (data) {
        //         console.log(data.response);
        //     }
        // });
        // return false;

    });



    $('#action').click(function () {
        var name = $("input#name").val();
        var address = $("input#emai_address").val();
        var telephoneNo = $("input#telephone_no").val();

        if (!(name == "" || address == "" || telephoneNo == "")) {
            $.ajax({
                method: "POST",
                url: baseUrl + "index.php/ContactListController/contact",
                dataType: "JSON",
                cache: false,
                data: {
                    name: name,
                    email: address,
                    telephoneNo: telephoneNo
                },
                success: function (data) {
                    console.log(data.response);
                    $('#user_form')[0].reset();
                    $('#message').html(data.response);
                    $('#message').show().fadeOut(4000);
                }
            });
            return false;
        }
    });

    // $("#addContact").click(function () {
    //     event.preventDefault();
    //     $.ajax({
    //         method: "POST",
    //         url: baseUrl + "index.php/ContactListController/contact",
    //         dataType: "JSON",
    //         cache: false,
    //         data: {
    //             name: 'Clark Kent',
    //             email: 'anjala@email.com',
    //             telephoneNo: '0711234565'
    //         },
    //         success: function (data) {
    //             console.log(data.response);
    //         }
    //     });
    //     return false;
    // });
});