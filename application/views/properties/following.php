<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<link rel="stylesheet" href="<?php echo base_url('assets/css/searchResult.css'); ?>" />

<nav class="navbar navbar-light bg-white">
    <a class="navbar-brand" href="<?php echo site_url('UserManagementController/sendingToHomePage') ?>">SharedGroove</a>

</nav>
<div class="container">
    <div class="top">
        <h2><?php echo sizeof($followingUserResults) ?> Following</h2>
    </div>
    <div class="row">
        <div class="shadow">
            <?php
            for ($x = 0; $x < sizeof($followingUserResults); $x++) {
                ?>
                <div class="col-sm-12">
                    <div class="col-sm-2">
                        <img src="<?php echo base_url($followingUserResults[$x]['profilePicture']); ?>" class="img-circle" width="60px" height="60px">
                    </div>
                    <div class="col-sm-8">
                        <h4><a class="search-result-username" href="<?php echo site_url('FollowersManagementController/sendingToFollowerProfilePage/' . $followingUserResults[$x]['userId']) ?>"><?php echo $followingUserResults[$x]['firstName'] . " " . $followingUserResults[$x]['lastName'] ?></a></h4>
                    </div>
                    <?php if ($followingUserResults[$x]['isFriend']) { ?>
                        <div class="col-sm-follow">
                            <a class="btn-follow" href="#">Friends</a>
                        </div>
                    <?php } else { ?>
                        <div class="col-sm-follow">
                            <a class="btn-follow" href="#">Following</a>
                        </div>
                    <?php } ?>
                </div>
                <div class="clearfix"></div>
                <hr />
            <?php } ?>
        </div>
    </div>
</div>