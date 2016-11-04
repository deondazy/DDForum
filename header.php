<?php
/**
 * DDForum Front-end header.
 */
use DDForum\Core\Site;
use DDForum\Core\User;
use DDForum\Core\Forum;
use DDForum\Core\Topic;
use DDForum\Core\Reply;

$siteUrl = Site::url();
?><!DOCTYPE html>
<html>
    <head>
        <title><?php echo Site::title(); ?></title>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <link rel="stylesheet" href="<?php echo "{$siteUrl}/inc/css/dist/production.css" ?>">
        <script src="<?php echo "{$siteUrl}/inc/js/jquery.js" ?>"></script>
        <script src="<?php echo "{$siteUrl}/inc/js/functions.js" ?>"></script>
        <?php if (Site::isProfilePage()) : ?>
            <script src="<?php echo "{$siteUrl}/inc/js/user.js" ?>"></script>
        <?php endif; ?>
        <?php if (Site::isEditorPage() || Site::isHomePage()) : ?>
            <script src="<?php echo "{$siteUrl}/ext/tinymce/js/tinymce/tinymce.min.js" ?>"></script>
            <script src="<?php echo "{$siteUrl}/inc/js/front-editor.js" ?>"></script>
        <?php endif; ?>
    </head>
    <body>
        <div id="wrapper" class="site-wrap container">
            <header id="header" class="site-header">
                <h1 id="masthead" class="site-title">
                    <a rel="home" href="<?php echo $siteUrl ?>"><?php echo $option->get('site_name'); ?></a>
                </h1>
                <nav id="navigation" class="site-navigation clearfix">
                    <?php if ($user->isLogged()) : ?>
                        <div class="navigation-top  clearfix">
                            <div class="site-navigation-welcome-text pull-left">
                                Welcome <strong>
                                <a href="<?php echo "{$siteUrl}/user/{$user->get('username')}"; ?>">
                                    <?php echo $user->get('display_name'); ?></strong>
                                </a>
                            </div>
                            <ul class="pull-left">
                                <li class="site-navigation-link"><a href="<?php echo $siteUrl; ?>/"><b>Home</b></a></li>
                                <!--<li class="site-navigation-link"><a href="<?php echo $siteUrl; ?>/edit-profile/">Edit Profile</a></li>-->
                                <li class="site-navigation-link"><a href="<?php echo $siteUrl; ?>/logout/">Logout</a></li>
                                <!--<li class="site-navigation-link">
                                    <a href="<?php echo $siteUrl; ?>/notifications/">Notifications (<?php echo $notif->count(); ?>)</a>
                                </li>-->
                                <?php if ($user->isAdmin()) : ?>
                                    <li class="site-navigation-link"><a href="<?php echo Site::adminUrl(); ?>/">Dashboard</a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    <?php else : ?>
                        <div class="navigation-top clearfix">
                            <div class="site-navigation-welcome-text pull-left">Welcome <strong>Guest</strong></div>
                            <ul class="pull-left">
                                <li class="site-navigation-link"><a href="<?php echo $siteUrl; ?>/"><b>Home</b></a></li>
                                <li class="site-navigation-link"><a href="<?php echo $siteUrl; ?>/register/"><b>Register</b></a></li>
                                <li class="site-navigation-link"><a href="<?php echo $siteUrl; ?>/login/">Login</a></li>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php if (Site::isHomePage()) : ?>
                        <h3 class="section-title sectioner-top">Forum Listing</h3>
                        <div class="main-navigation">
                            <?php
                            $categories = $forum->getAll("type = 'category'");
                            $allForums = $forum->getAll("type = 'forum'");
                            foreach ($categories as $cat) : ?>
                                <ul class="category-section">
                                    <a class="the-category" href="<?php echo "{$siteUrl}/category/{$cat->slug}"; ?>">
                                        <?php echo $cat->name . ':'; ?>
                                    </a>

                                    <?php foreach ($allForums as $theForum) :
                                        if ($cat->id == $theForum->parent) : ?>
                                            <li class="child-forum-list">
                                                <a class="the-forum" href="<?php echo "{$siteUrl}/forum/{$theForum->slug}"; ?>">
                                                    <?php echo $theForum->name; ?>
                                                </a>
                                            </li>
                                        <?php endif;
                                    endforeach; ?>
                                </ul>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </nav>
            </header>
            <div id="main" class="site-main">
                <?php
                function active($page, $active)
                {
                    return ($page == $active) ? 'selected' : '';
                }
                if (Site::isHomePage()) :
                    $sort = isset($_GET['sort']) ? $_GET['sort'] : '';
                    switch ($sort) {
                        case 'recent':
                            $topics = $topic->getRecent();
                            break;
                        case 'trending':
                            $topics = $topic->getTrending();
                            break;
                        case 'all':
                            $topics = $topic->getAll();
                            break;
                        default:
                            $sort = 'pinned';
                            $topics = $topic->getPinned();
                            break;
                    }
                    ?>
                    <div class="sort-view sectioner clearfix">
                        <ul class="view pull-left">
                            <li class="sort-item <?php echo active($sort, 'pinned'); ?>">
                                <a href="<?php echo $siteUrl; ?>/">Pinned</a>
                            </li>
                            <li class="sort-item <?php echo active($sort, 'recent'); ?>">
                                <a href="<?php echo $siteUrl; ?>/topics/recent/">Recent</a>
                            </li>
                            <li class="sort-item <?php echo active($sort, 'trending'); ?>">
                                <a href="<?php echo $siteUrl; ?>/topics/trending/">Trending</a>
                            </li>
                            <li class="sort-item <?php echo active($sort, 'all'); ?>">
                                <a href="<?php echo $siteUrl; ?>/topics/all/">All</a>
                            </li>
                        </ul>
                        <?php if ($user->isLogged()) : ?>
                            <a class="secondary-button open-editor new-topic pull-right" href="<?php echo $siteUrl; ?>/topic/new/">
                                New Topic
                            </a>
                        <?php endif; ?>
                    </div>
                    <?php
                endif;
