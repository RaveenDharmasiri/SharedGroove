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
                        <button type="button" id="add_button" class="btn btn-info btn-xs">Add Contact</button>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <span id="success_message"></span>
                <table class="table table-bordered table-striped">
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
                    <tbody>
                        <tr>
                            <td>Raveen Dharmasiri</td>
                            <td>0711090637</td>
                            <td>raveen.dharmasiri@gmail.com</td>
                            <td>Friend, Work</td>
                            <td><input type="button" onclick="editContactPopUp(28)" value="Edit" /></td>
                            <td><button>Delete</button></td>
                        </tr>
                        <tr>
                            <td>Raveen Dharmasiri</td>
                            <td>0711090637</td>
                            <td>raveen.dharmasiri@gmail.com</td>
                            <td>Friend, Work</td>
                            <td><input type="button" onclick="editContactPopUp(31)" value="Edit" /></td>
                            <td><button>Delete</button></td>
                        </tr>
                        <tr>
                            <td>Raveen Dharmasiri</td>
                            <td>0711090637</td>
                            <td>raveen.dharmasiri@gmail.com</td>
                            <td>Friend, Work</td>
                            <td><input type="button" onclick="editContactPopUp(29)" value="Edit" /></td>
                            <td><button>Delete</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <a href="<?php echo site_url('TestController/contact_post') ?>">Add Contact</a>
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
                    <input type="text" name="telephone_no" id="telephone_no" class="form-control" required>
                    <span id="telephone_no_error" class="text-danger"></span>
                    <br />
                </div>
                <div>
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

<!-- <script type="text/javascript" language="javascript">
    $(document).ready(function() {

        function fetch_data()
        {
            $.ajax({
                url:"<?php echo base_url(); ?>test_api/action",
                method:"POST",
                data:{data_action:'fetch_all'},
                success:function(data)
                {
                    $('tbody').html(data);
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

        $(document).on('submit', '#user_form', function(event){
            event.preventDefault();
            $.ajax({
                url:"<?php echo base_url() . 'test_api/action' ?>",
                method:"POST",
                data:$(this).serialize(),
                dataType:"json",
                success:function(data)
                {
                    if(data.success)
                    {
                        $('#user_form')[0].reset();
                        $('#userModal').modal('hide');
                        fetch_data();
                        if($('#data_action').val() == "Insert")
                        {
                            $('#success_message').html('<div class="alert alert-success">Data Inserted</div>');
                        }
                    }

                    if(data.error)
                    {
                        $('#first_name_error').html(data.first_name_error);
                        $('#last_name_error').html(data.last_name_error);
                    }
                }
            })
        });

        $(document).on('click', '.edit', function(){
            var user_id = $(this).attr('id');
            $.ajax({
                url:"<?php echo base_url(); ?>test_api/action",
                method:"POST",
                data:{user_id:user_id, data_action:'fetch_single'},
                dataType:"json",
                success:function(data)
                {
                    $('#userModal').modal('show');
                    $('#first_name').val(data.first_name);
                    $('#last_name').val(data.last_name);
                    $('.modal-title').text('Edit User');
                    $('#user_id').val(user_id);
                    $('#action').val('Edit');
                    $('#data_action').val('Edit');
                }
            })
        });

        $(document).on('click', '.delete', function(){
            var user_id = $(this).attr('id');
            if(confirm("Are you sure you want to delete this?"))
            {
                $.ajax({
                    url:"<?php echo base_url(); ?>test_api/action",
                    method:"POST",
                    data:{user_id:user_id, data_action:'Delete'},
                    dataType:"JSON",
                    success:function(data)
                    {
                        if(data.success)
                        {
                            $('#success_message').html('<div class="alert alert-success">Data Deleted</div>');
                            fetch_data();
                        }
                    }
                })
            }
        });
    });
</script> -->