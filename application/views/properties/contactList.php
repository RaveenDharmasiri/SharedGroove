<html>

<head>
    <title>SharedGroove - Contacts</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.0.0/backbone-min.js"></script> -->

    <script src="<?php echo base_url('assets/js/libs/underscore.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/libs/backbone.js'); ?>"></script>

    <script>
        var baseUrl = "<?php echo base_url() ?>"
    </script>

    <script src="<?php echo base_url('assets/js/models/restApiCallModel.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/models/singleContactModel.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/views/singleContactView.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/views/allContactsView.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/collections/contactsCollection.js'); ?>"></script>

    <script src="<?php echo base_url('assets/js/contactList.js'); ?>"></script>

    <link rel="stylesheet" href="<?php echo base_url('assets/css/home.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/contactList.css'); ?>" />
</head>

<body>
    <nav class="navbar navbar-light bg-white">
        <a class="navbar-brand" href="<?php echo site_url('UserManagementController/sendingToHomePage') ?>">SharedGroove</a>
    </nav>

    <div class="container">
        <br />
        <h3 align="center">Contacts</h3>
        <br />
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                        <!-- <h3 class="panel-title">Contacts</h3> -->
                    </div>
                    <div class="col-md-6" align="right">
                        <button type="button" id="load_all_contacts" class="btn btn-info btn-xs">Load All Contacts</button>
                        <button type="button" id="search_contact" class="btn btn-info btn-xs">Search Contact</button>
                        <button type="button" id="add_button" class="btn btn-info btn-xs">Add Contact</button>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <span id="success_message"></span>
                <table id="contact-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Telephone No</th>
                            <th>Email</th>
                            <th>Tags</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>


    <script id="contactElement" type="text/template">
        <td><%= contactName %></td>
        <td><%= contactEmail %></td>
        <td><%= contactTelephoneNo %></td>
        <td><%= contactTags %></td>
        <td><input type="button" class="btn-edit" onclick="editContactPopUp(<%= contactId %>)" value="Edit" /></td>
        <td><input type="button" class="btn-delete" value="Delete" /></td>
    </script>
</body>

</html>

<div id="userModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="user_form">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Contact</h4>
                </div>
                <div class="modal-body">
                    <label>Enter Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                    <span id="first_name_error" class="text-danger"></span>
                    <br />
                    <label>Enter Email Address</label>
                    <input type="email" name="email_address" id="email_address" class="form-control" required>
                    <span id="email_address_error" class="text-danger"></span>
                    <br />
                    <label>Enter Telephone Number</label>
                    <input type="text" name="telephone_no" id="telephone_no" class="form-control" maxlength="10" required>
                    <span id="telephone_no_error" class="text-danger"></span>
                    <br />
                </div>
                <div class="modal-body">
                    <label>Select the contact tag or tags</label>
                    <br>
                    <input type="checkbox" name="tag1" value="Friend"> Friends<br>
                    <input type="checkbox" name="tag2" value="Work"> Work<br>
                    <input type="checkbox" name="tag3" value="Family"> Family<br><br>
                </div>
                <div class="modal-footer">
                    <input type="button" name="action" id="action" class="btn btn-success" value="Add" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>

                <p id="message" style="text-align:center;"></p>
            </div>
        </form>
    </div>
</div>

<div id="deleteContact" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Deleting Contact</h4>
            </div>
            <div class="modal-body">
                <label>Are you sure you want to delete this contact?</label>
            </div>
            <div class="modal-footer">
                <input type="button" name="action" id="action-delete-contact" class="btn btn-success" value="Yes" />
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>

            <p id="delete-message" style="text-align:center;"></p>
        </div>
    </div>
</div>

<div id="searchContact" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="search_form">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Contact</h4>
                </div>
                <div class="modal-body">
                    <label>Search contacts by name</label>
                    <input type="text" name="name" id="search-name" class="form-control" required>
                    <span id="first_name_error" class="text-danger"></span>
                    <br />
                </div>
                <div class="modal-body">
                    <label>Search contacts by tags</label>
                    <br>
                    <input type="checkbox" name="tag1" value="Friend"> Friends<br>
                    <input type="checkbox" name="tag2" value="Work"> Work<br>
                    <input type="checkbox" name="tag3" value="Family"> Family<br><br>
                </div>
                <div class="modal-footer">
                    <input type="button" name="action" id="action-search-contact" class="btn btn-success" value="Search" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>

                <p id="search-message" style="text-align:center;"></p>
            </div>
        </form>
    </div>
</div>