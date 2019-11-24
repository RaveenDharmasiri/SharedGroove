<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<link rel="stylesheet" href="<?php echo base_url('assets/css/home.css'); ?>" />

<nav class="navbar navbar-light bg-white">
    <a class="navbar-brand" href="<?php echo site_url('UserManagementController/sendingToHomePage') ?>">SharedGroove</a>
</nav>

<div class="container-fluid gedf-wrapper">
    <div class="row">
        <div class="col-md-3">
            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-auto mb-3">
                            <div class="mx-auto" style="width: 140px;">
                                <img src="<?php echo base_url($profilePicture); ?>" id="profileDisplay" width="160px">
                            </div>
                        </div>
                    </div>
                    <div class="h7 full-name"><?php echo $firstName . " " . $lastName ?></div>
                    <div class="h5">My favourite genres</div>
                    <div class="h7 genre-list">
                        <?php
                        for ($x = 0; $x < sizeof($userGenres) - 1; $x++) {
                            echo $userGenres[$x] . ", ";
                        }

                        echo $userGenres[sizeof($userGenres) - 1];
                        ?>
                    </div>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="h6 followers-title">Followers</div>
                        <div class="h5 follower-count"><?php echo $followerCount ?></div>
                    </li>
                    <li class="list-group-item">
                        <div class="h6 following-title">Following</div>
                        <div class="h5 following-count"><?php echo $followingCount ?></div>
                    </li>
                    <li class="list-group-item">
                        <div class="h6 following-title">Friends</div>
                        <div class="h5 following-count"><?php echo $friendsCount ?></div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-6 gedf-main">
            <?php if (sizeof($yourPosts) > 0) { ?>
                <?php for ($x = 0; $x < sizeof($yourPosts); $x++) { ?>
                    <!--- \\\\\\\Post-->
                    <div class="card gedf-card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-2">
                                        <img class="rounded-circle" width="45" src="<?php echo base_url($yourPosts[$x]['creatorProfilePicture']) ?>" alt="">
                                    </div>
                                    <div class="ml-2">
                                        <div class="h5 m-0"><?php echo $yourPosts[$x]['creatorFirstName'] . " " . $yourPosts[$x]['creatorLastName'] ?></div>
                                        <div class="h7 text-muted"><?php echo $yourPosts[$x]['creatorEmail'] ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i> <?php echo $yourPosts[$x]['postTimeStamp'] ?></div>
                            <h5 class="card-title"><?php echo $yourPosts[$x]['postContent'] ?></h5>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="card-link"><i class="fa fa-gittip"></i> Like</a>
                            <a href="#" class="card-link"><i class="fa fa-comment"></i> Comment</a>
                            <a href="#" class="card-link"><i class="fa fa-mail-forward"></i> Share</a>
                        </div>
                    </div>
                    <!-- Post /////-->
                <?php } ?>
            <?php } else { ?>
                <h1 class="no-post-message">No Posts to show in your Timeline</h1>
            <?php } ?>
        </div>
        <div class="col-md-3">
            <div class="card gedf-card">
                <div class="card-body">
                    <h5 class="card-title">Quick Access</h5>
                    <hr />
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('YourProfileController/sendingToFollowersPage') ?>"><?php echo $followerCount ?> Followers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('YourProfileController/sendingToFollowingPage') ?>"><?php echo $followingCount ?> Following</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('YourProfileController/sendingToFriendsPage') ?>"><?php echo $friendsCount ?> Friends</a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('YourProfileController/sendingToFriendsPage') ?>">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>