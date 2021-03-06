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

            <!--- \\\\\\\Post-->
            <div class="card publication-card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">Make
                                a publication</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="images-tab" data-toggle="tab" role="tab" aria-controls="images" aria-selected="false" href="#images">Genre Search</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                            <form action="<?php echo base_url('/index.php/HomeManagementController/setPost') ?>" method="POST">
                                <div class="form-group">
                                    <label class="sr-only" for="message">post</label>
                                    <textarea class="form-control" id="userPost" name="userPost" rows="3" placeholder="What are you thinking?"></textarea>
                                </div>

                                <div class="btn-toolbar justify-content-between">
                                    <div class="btn-group">
                                        <button type="submit" class="btn btn-primary">Share</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                            <div class="card-body">
                                <h5 class="card-title">Search user by genre</h5>
                                <ul class="nav nav-pills flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo site_url('GenreSearchController/findSearchResults/Jazz') ?>">Jazz</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo site_url('GenreSearchController/findSearchResults/Instrumental') ?>">Instrumental</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo site_url('GenreSearchController/findSearchResults/Techno') ?>">Techno</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo site_url('GenreSearchController/findSearchResults/Disco') ?>">Disco</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo site_url('GenreSearchController/findSearchResults/Rock') ?>">Rock</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Post /////-->
            <?php if (sizeof($homePosts) > 0) { ?>
                <?php for ($x = 0; $x < sizeof($homePosts); $x++) { ?>
                    <!--- \\\\\\\Post-->
                    <div class="card gedf-card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-2">
                                        <img class="rounded-circle" width="45" src="<?php echo base_url($homePosts[$x]['creatorProfilePicture']); ?>" alt="">
                                    </div>
                                    <div class="ml-2">
                                        <div class="h5 m-0"><?php echo $homePosts[$x]['creatorFirstName'] . " " . $homePosts[$x]['creatorLastName'] ?></div>
                                        <div class="h7 text-muted"><?php echo $homePosts[$x]['creatorEmail'] ?></div>
                                    </div>
                                </div>
                                <div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i> <?php echo $homePosts[$x]['postTimeStamp'] ?></div>
                            <h5 class="card-title"><?php echo $homePosts[$x]['postContent'] ?></h5>
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
                <h1 class="no-post-message">No Posts to show</h1>
            <?php } ?>
        </div>
        <div class="col-md-3">
            <div class="card gedf-card">
                <div class="card-body">
                    <h5 class="card-title">Quick Access</h5>
                    <hr />
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('HomeManagementController/sendingToYourProfilePage/') ?>">Your Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('HomeManagementController/sendingToFollowersPage') ?>"><?php echo $followerCount ?> Followers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('HomeManagementController/sendingToFollowingPage') ?>"><?php echo $followingCount ?> Following </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('HomeManagementController/sendingToFriendsPage') ?>"><?php echo $friendsCount ?> Friends</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>