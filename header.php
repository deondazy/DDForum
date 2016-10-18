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

        <!--<link rel="stylesheet" href="<?php //grunt watchhhhhhffecho Site::url().'/inc/css/font-awesome.css'; ?>">-->
        <link rel="stylesheet" href="<?php echo "{$siteUrl}/inc/css/dist/production.css" ?>">

        <script src="<?php echo "{$siteUrl}/inc/js/jquery.js" ?>"></script>
        <!--<script src="<?php // echo Site::url().'/inc/js/editor.js' ?>"></script>-->
        <script src="<?php echo "{$siteUrl}/inc/js/functions.js" ?>"></script>

        <?php if (Site::isProfilePage()) : ?>
            <script src="<?php echo "{$siteUrl}/inc/js/user.js" ?>"></script>
        <?php endif; ?>

        <?php if (Site::isEditorPage() || Site::isHomePage()) : ?>
            <script src="<?php echo "{$siteUrl}/inc/js/tinymce/js/tinymce/tinymce.js" ?>"></script>
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
                    <?php if (User::isLogged()) : ?>
                        <div class="site-navigation-welcome-text pull-left">
                            Welcome <strong><?php echo User::get('display_name'); ?></strong>
                        </div>

                        <ul class="pull-left">
                            <li class="site-navigation-link"><a href="<?php echo $siteUrl; ?>/"><b>Home</b></a></li>
                            <li class="site-navigation-link"><a href="<?php echo $siteUrl; ?>/edit-profile/">Edit Profile</a></li>
                            <li class="site-navigation-link"><a href="<?php echo $siteUrl; ?>/logout/">Logout</a></li>
                            <li class="site-navigation-link"><a href="<?php echo $siteUrl; ?>/forum/all/">Forums</a></li>
                            <?php if (User::isAdmin()) : ?>
                                <li class="site-navigation-link"><a href="<?php echo Site::adminUrl(); ?>/">Dashboard</a></li>
                            <?php endif; ?>
                        </ul>
                    <?php else : ?>
                        <div class="site-navigation-welcome-text pull-left">Welcome <strong>Guest</strong></div>

                        <ul class="pull-left">
                            <li class="site-navigation-link"><a href="<?php echo $siteUrl; ?>/"><b>Home</b></a></li>
                            <li class="site-navigation-link"><a href="<?php echo $siteUrl; ?>/register/"><b>Register</b></a></li>
                            <li class="site-navigation-link"><a href="<?php echo $siteUrl; ?>/login/">Login</a></li>
                            <li class="site-navigation-link"><a href="<?php echo $siteUrl; ?>/forum/all/">Forums</a></li>
                        </ul>
                    <?php endif; ?>
                </nav>
            </header>

            <div id="main" class="site-main">
                <?php
                function active($page, $active)
                {
                    return ($page == $active) ? 'selected' : '';
                }

                if (Site::isHomePage() || Site::isForumPage()) :
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
                            //$sort = 'pinned';
                            $topics = $topic->getPinned();
                            break;
                    }
                    ?>

                    <div class="sort-view clearfix">
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

                        <?php if (User::isLogged()) : ?>
                            <a class="secondary-button open-editor new-topic pull-right" href="<?php echo $siteUrl; ?>/topic/new/">
                                New Topic
                            </a>
                        <?php endif; ?>
                    </div>
                    <?php
                endif;
