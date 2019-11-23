<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.11/css/bootstrap-select.min.css" integrity="sha256-xX+DsGeZhhgAtFGlA5iy4tpVy7wgoXKcFu13+B1qh7k=" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.11/js/bootstrap-select.min.js" integrity="sha256-49+cFFN14Ib7A61zjYlhc4UnmbAPQ0uImp4Sj4JO8TU=" crossorigin="anonymous"></script>

<link rel="stylesheet" href="<?php echo base_url('assets/css/editProfile.css'); ?>" />
<script type="text/javascript" src="<?php echo base_url('assets/js/scripts.js'); ?>"></script>

<h1 class="h3 mb-3 font-weight-sitename">Edit Profile</h1>
<div class="container">
    <div class="row flex-lg-nowrap">
        <div class="col-12 col-lg-auto mb-3" style="width: 200px;">
        </div>
        <div class="col">
            <div class="row">
                <div class="col mb-3">
                    <div class="card">
                        <div class="image-error-message">
                            <?php
                            if (isset($error)) {
                                echo "<p>" . $error . "</p>";
                            }
                            ?>
                        </div>

                        <div class="card-body">
                            <form class="e-profile" action='<?php echo base_url('/index.php/UserManagementController/editProfileInfoUpdate'); ?>' enctype='multipart/form-data' method='POST'>
                                <div class="row">
                                    <div class="col-12 col-sm-auto mb-3">
                                        <div class="mx-auto" style="width: 140px;">
                                            <img src="<?php 
                                            if (isset($relativeImagePath)) {
                                                echo base_url($relativeImagePath);
                                            } else {
                                                echo base_url('assets/images/profileimage-placeholder.png');
                                            }
                                            ?>"
                                            id="profileDisplay">
                                            
                                            <input type="file" id="profileImage" name="profileImage" onchange="displayImage(this)" />

                                        </div>
                                    </div>

                                    <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                        <div class="text-center text-sm-left mb-2 mb-sm-0">
                                            <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?php echo $firstName ." ". $lastName; ?></h4>
                                            <div class="mt-2">
                                                <button for="profileImageUpload" class="btn btn-primary" type="button" onclick="triggerClick()">
                                                    <i class="fa fa-fw fa-camera"></i>
                                                    <span>Change Photo</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <ul class="nav nav-tabs" hidden>
                                    <li class="nav-item"><a href="" class="active nav-link"></a></li>
                                </ul>
                                <div class="tab-content pt-3">
                                    <div class="tab-pane active">
                                        <div class="form" novalidate="">
                                            <input type="hidden" name="userEmail" value=<?php echo $email; ?>>
                                            <input type="hidden" name="firstName" value=<?php echo $firstName; ?>>
                                            <input type="hidden" name="lastName" value=<?php echo $lastName; ?>>

                                            <div class="row">
                                                <div class="col-12 col-sm-6 mb-3">
                                                    <label class="select-menu-title">Select your favourite Genres</label>
                                                    
                                                    <select multiple data-style="bg-white rounded-pill px-4 py-3 shadow-sm " class="selectpicker w-100" name="genres[]" required>
                                                        <option name="CountryMusic" value="Jazz">Jazz</option>
                                                        <option name="ClassicalMusic" value="Instrumental">Instrumental</option>
                                                        <option name="PopMusic" value="Techno">Techno</option>
                                                        <option name="Disco" value="Disco">Disco</option>
                                                        <option name="Rock" value="Rock">Rock</option>
                                                    </select><!-- End -->
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col d-flex justify-content-end">
                                                    <button class="btn btn-primary" type="submit">Save Changes</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-3 mb-3">
                </div>
            </div>
        </div>
    </div>
</div>