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
                    <div class="h5"><?php echo $firstName ?>'s favourite genres</div>
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
                    <li class="list-group-item">
                        <form>
                            <?php if (!$isFollowing) { ?>
                                <div class="h6 following-title"><a href="<?php echo site_url('UserProfileController/followUser/' . $userId) ?>"><button type="button" class="btn btn-primary btn-lg btn-block">Follow</button></a></div>
                            <?php } else if ($isFollowing && $isFriend) { ?>
                                <button type="button" class="btn btn-secondary btn-lg btn-block">Friends</button>
                            <?php } else if ($isFollowing) { ?>
                                <button type="button" class="btn btn-secondary btn-lg btn-block">Following</button>
                            <?php } ?>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-6 gedf-main">
            <?php if (sizeof($userPosts) > 0) { ?>
                <?php for ($x = 0; $x < sizeof($userPosts); $x++) { ?>
                    <!--- \\\\\\\Post-->
                    <div class="card gedf-card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-2">
                                        <img class="rounded-circle" width="45" src="<?php echo base_url($userPosts[$x]['creatorProfilePicture']) ?>" alt="">
                                    </div>
                                    <div class="ml-2">
                                        <div class="h5 m-0"><?php echo $userPosts[$x]['creatorFirstName'] . " " . $userPosts[$x]['creatorLastName'] ?></div>
                                        <div class="h7 text-muted"><?php echo $userPosts[$x]['creatorEmail'] ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i> <?php echo $userPosts[$x]['postTimeStamp'] ?></div>
                            <h5 class="card-title"><?php echo $userPosts[$x]['postContent'] ?></h5>
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
                <h1 class="no-post-message">No Posts to show in <?php echo $firstName?>'s Timeline</h1>
            <?php } ?>
        </div>
        <div class="col-md-3">
            <div class="card gedf-card">
                <div class="card-body">
                    <h5 class="card-title">Quick Access</h5>
                    <hr />
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('UserProfileController/sendToYourProfile') ?>"> Your Profile</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>