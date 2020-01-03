var contactsArray;

$(document).ready(function () {
    function fetch_data() {
        var Contact = Backbone.Model.extend({
            urlRoot: baseUrl + "index.php/ContactListController/contacts",
            idAttribute: 'id',
        });

        var c = new Contact();

        c.fetch({
            async: false,
            success: function (data) {
                console.log(data.attributes.contacts);
                contactsArray = data.attributes.contacts;
            }
        });
    }

    fetch_data();

    $('#add_button').click(function () {
        $('#user_form')[0].reset();
        $('.modal-title').text("Add Contact");
        $('#action').val('Add');
        $('#userModal').modal('show');
    });

    $('#action').click(function () {
        if ($('#action').val() == 'Add') {
            addContact();
        } else if ($('#action').val() == 'Edit') {
            editContact();
        }
    });
});

function editContactPopUp(id) {
    var userName;
    var email;
    var telephoneNo;
    for (i = 0; i < contactsArray.length; i++) {

        if (contactsArray[i].contactId == id) {
            userName = contactsArray[i].contactName;
            email = contactsArray[i].contactEmail;
            telephoneNo = contactsArray[i].contactTelephoneNo;
        }
        $('#user_form')[0].reset();
        $('.modal-title').text("Edit Contact");
        $("input#name").val(userName);
        $("input#email_address").val(email);
        $("input#telephone_no").val(telephoneNo);
        $('#action').val('Edit');
        $('#userModal').modal('show');
    }
}

function addContact() {
    var name = $("input#name").val();
    var email = $("input#email_address").val();
    var telephoneNo = parseInt($("input#telephone_no").val());

    console.log(telephoneNo);

    if (!(name == "" || email == "" || telephoneNo == "")) {
        if (Number.isInteger(telephoneNo)) {
            var Contact = Backbone.Model.extend({
                urlRoot: baseUrl + "index.php/ContactListController/addContact",
                idAttribute: 'id',
            });

            var c = new Contact();

            var contactDetails = {
                'name': name,
                'email': email,
                'telephoneNo': telephoneNo
            }

            c.save(contactDetails, {
                async: false,
                success: function (data) {
                    console.log(data);
                    $('#user_form')[0].reset();
                    $('#message').html(data.attributes.response);
                    $('#message').show().fadeOut(4000);
                }
            });
        } else {
            $('#message').html('Your telephone number is wrong');
            $('#message').show().fadeOut(4000);
        }
    } else {
        $('#message').html('Fields are empty');
        $('#message').show().fadeOut(4000);
    }
}

function editContact() {
    var name = $("input#name").val();
    var email = $("input#email_address").val();
    var telephoneNo = parseInt($("input#telephone_no").val());
}