var contactsArray;
var editingContactId;

var restApiCall = new app.RestApiCall();


var contactList = new app.ContactsCollection();



$(document).ready(function() {

    fetch_data();

    $('#add_button').click(function() {
        $('input[name="tag1"]').attr('checked', false);
        $('input[name="tag2"]').attr('checked', false);
        $('input[name="tag3"]').attr('checked', false);
        $('#user_form')[0].reset();
        $('.modal-title').text("Add Contact");
        $('#action').val('Add');
        $('#userModal').modal('show');
    });

    $('#action').click(function() {
        if ($('#action').val() == 'Add') {
            addContact();
        } else if ($('#action').val() == 'Edit') {
            editContact();
        }
    });
});

function fetch_data() {
    contactList.reset();
    restApiCall.fetch({
        async: false,
        success: function(data) {
            console.log(data.attributes.contacts);
            contactsArray = data.attributes.contacts;

            for (i = 0; i < contactsArray.length; i++) {
                var tags = '';

                for (y = 0; y < contactsArray[i].contactTags.length; y++) {
                    tags += contactsArray[i].contactTags[y] + " ,";
                }

                var contact = new app.SingleContact({
                    contactId: contactsArray[i].contactId,
                    contactName: contactsArray[i].contactName,
                    contactEmail: contactsArray[i].contactEmail,
                    contactTelephoneNo: contactsArray[i].contactTelephoneNo,
                    contactTags: tags
                });

                contactList.add(contact);
            }

            var contactsListView = new app.AllContactsView({ model: contactList });

            $("#contact-table").html(contactsListView.render().el);

            $('#contact-table').append("<thead><tr><th>Name</th><th>Telephone No</th><th>Email</th><th>Tags</th><th>Edit</th><th>Delete</th></tr></thead>");
        }
    });
}



function editContactPopUp(id) {
    $('input[name="tag1"]').attr('checked', false);
    $('input[name="tag2"]').attr('checked', false);
    $('input[name="tag3"]').attr('checked', false);
    var userName;
    var email;
    var telephoneNo;

    editingContactId = id;
    for (i = 0; i < contactsArray.length; i++) {

        if (contactsArray[i].contactId == id) {
            userName = contactsArray[i].contactName;
            email = contactsArray[i].contactEmail;
            telephoneNo = contactsArray[i].contactTelephoneNo;

            for (y = 0; y < contactsArray[i].contactTags.length; y++) {
                if (contactsArray[i].contactTags[y] == 'Friends') {
                    $('input[name="tag1"]').attr('checked', true);
                }

                if (contactsArray[i].contactTags[y] == 'Work') {
                    $('input[name="tag2"]').attr('checked', true);
                }

                if (contactsArray[i].contactTags[y] == 'Family') {
                    $('input[name="tag3"]').attr('checked', true);
                }
            }
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

    var isFriendChecked = null;
    var isWorkChecked = null;
    var isFamilyChecked = null;

    if ($('input[name="tag1"]:checked').length > 0) {
        isFriendChecked = 'Friends';
    }

    if ($('input[name="tag2"]:checked').length > 0) {
        isWorkChecked = 'Work';
    }

    if ($('input[name="tag3"]:checked').length > 0) {
        isFamilyChecked = 'Family';
    }

    if (!(name == "" || email == "" || telephoneNo == "")) {
        if (isFriendChecked == null && isWorkChecked == null && isFamilyChecked == null) {
            $('#message').html('Please add tags for the contact');
            $('#message').show().fadeOut(2000);
        } else {
            if (Number.isInteger(telephoneNo)) {
                var contactDetails = {
                    'name': name,
                    'email': email,
                    'telephoneNo': telephoneNo,
                    'tags': {
                        'friends': isFriendChecked,
                        'work': isWorkChecked,
                        'family': isFamilyChecked
                    }
                }




                restApiCall.save(contactDetails, {
                    async: false,
                    success: function(data) {
                        fetch_data();
                        console.log(data);
                        $('#user_form')[0].reset();
                        $('#message').html(data.attributes.response);
                        $('#message').show().fadeOut(2000);
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            } else {
                $('#message').html('Your telephone number is wrong');
                $('#message').show().fadeOut(2000);
            }
        }
    } else {
        $('#message').html('Fields are empty');
        $('#message').show().fadeOut(2000);
    }
}

function editContact() {
    var name = $("input#name").val();
    var email = $("input#email_address").val();
    var telephoneNo = parseInt($("input#telephone_no").val());

    var isFriendChecked = null;
    var isWorkChecked = null;
    var isFamilyChecked = null;

    if ($('input[name="tag1"]:checked').length > 0) {
        isFriendChecked = 'Friends';
    }

    if ($('input[name="tag2"]:checked').length > 0) {
        isWorkChecked = 'Work';
    }

    if ($('input[name="tag3"]:checked').length > 0) {
        isFamilyChecked = 'Family';
    }

    if (!(name == "" || email == "" || telephoneNo == "")) {
        if (isFriendChecked == null && isWorkChecked == null && isFamilyChecked == null) {
            $('#message').html('Please add tags for the contact');
            $('#message').show().fadeOut(2000);
        } else {
            if (Number.isInteger(telephoneNo)) {
                var editContactDetails = {
                    'contactId': editingContactId,
                    'name': name,
                    'email': email,
                    'telephoneNo': telephoneNo,
                    'tags': {
                        'friends': isFriendChecked,
                        'work': isWorkChecked,
                        'family': isFamilyChecked
                    }
                }

                // restApiCall.set('urlRoot', baseUrl + "index.php/ContactListController/contacts/" + editingContactId);

                console.log('this' + restApiCall);

                restApiCall.save(editContactDetails, {
                    type: 'PUT',
                    async: false,
                    success: function(data) {
                        fetch_data();
                        console.log(data);
                        $('#message').html(data.attributes.response);
                        $('#message').show().fadeOut(2000);
                    },
                    error: function(error) {
                        console.log(error);
                        $('#message').html('Failed to update the contact');
                        $('#message').show().fadeOut(4000);
                    }
                });
            } else {
                $('#message').html('Your telephone number is wrong');
                $('#message').show().fadeOut(2000);
            }
        }
    } else {
        $('#message').html('Fields are empty');
        $('#message').show().fadeOut(2000);
    }
}