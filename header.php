<?php
/**
 * DDForum Front-end header.
 */
use DDForum\Core\Site;
use DDForum\Core\Option;
use DDForum\Core\User;
use DDForum\Core\Forum;
use DDForum\Core\Topic;
use DDForum\Core\Reply;

?><!DOCTYPE html>
<html>
    <head>
        <title><?php echo Site::title(); ?></title>

        <meta charset="utf8">
        <meta content="width=device-width, initial-scale=1" name="viewport">

        <!--<link rel="stylesheet" href="<?php //grunt watchhhhhhffecho Site::url().'/inc/css/font-awesome.css'; ?>">-->
        <link rel="stylesheet" href="<?php echo Site::url().'/inc/css/dist/production.css'; ?>">

        <script src="<?php echo Site::url().'/inc/js/jquery.js'; ?>"></script>
        <!--<script src="<?php // echo Site::url().'/inc/js/editor.js' ?>"></script>-->
        <script src="<?php echo Site::url().'/inc/js/functions.js' ?>"></script>

        <?php if (Site::isProfilePage()) : ?>
            <script src="<?php echo Site::url().'/inc/js/user.js' ?>"></script>
        <?php endif; ?>

        <?php if (Site::isEditorPage() || Site::isHomePage()) : ?>
            <script src="<?php echo Site::url().'/inc/js/tinymce/js/tinymce/tinymce.js' ?>"></script>
            <script src="<?php echo Site::url().'/inc/js/front-editor.js' ?>"></script>
        <?php endif; ?>
    </head>

    <body>
        <div id="wrapper" class="site-wrap container">

            <header id="header" class="site-header">
                <h1 id="masthead" class="site-title">
                    <a rel="home" href="<?php echo Site::url(); ?>"><?php echo Option::get('site_name'); ?></a>
                </h1>

                <nav id="navigation" class="site-navigation clearfix">
                    <?php if (User::isLogged()) : ?>
                        <div class="site-navigation-welcome-text pull-left">
                            Welcome <strong><?php echo User::get('display_name'); ?></strong>
                        </div>

                        <ul class="pull-left">
                            <li class="site-navigation-link"><a href="<?php echo Site::url(); ?>/"><b>Home</b></a></li>
                            <li class="site-navigation-link"><a href="<?php echo Site::url(); ?>/edit-profile/">Edit Profile</a></li>
                            <li class="site-navigation-link"><a href="<?php echo Site::url(); ?>/logout/">Logout</a></li>
                            <li class="site-navigation-link"><a href="<?php echo Site::url(); ?>/forums/">Forums</a></li>
                        </ul>
                    <?php else : ?>
                        <div class="site-navigation-welcome-text pull-left">Welcome <strong>Guest</strong></div>

                        <ul class="pull-left">
                            <li class="site-navigation-link"><a href="<?php echo Site::url(); ?>"><b>Home</b></a></li>
                            <li class="site-navigation-link"><a href="<?php echo Site::url(); ?>/register/"><b>Register</b></a></li>
                            <li class="site-navigation-link"><a href="<?php echo Site::url(); ?>/login/">Login</a></li>
                            <li class="site-navigation-link"><a href="<?php echo Site::url(); ?>/forums/">Forums</a></li>
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
                    $Forum = new Forum();
                    $Topic = new Topic();
                    $Reply = new Reply();

                    $sort = isset($_GET['sort']) ? $_GET['sort'] : '';

                    switch ($sort) {
                        case 'recent':
                            $topics = $Topic->getRecent();
                            break;

                        case 'trending':
                            $topics = $Topic->getTrending();
                            break;

                        case 'all':
                            $topics = $Topic->getAll();
                            break;

                        default:
                            $sort = 'pinned';
                            $topics = $Topic->getPinned();
                            break;
                    }
                    ?>

                    <div class="sort-view clearfix">
                        <ul class="view pull-left">
                            <li class="sort-item <?php echo active($sort, 'pinned'); ?>">
                                <a href="<?php echo Site::url(); ?>">Pinned</a>
                            </li>
                            <li class="sort-item <?php echo active($sort, 'recent'); ?>">
                                <a href="<?php echo Site::url(); ?>/topics/recent">Recent</a>
                            </li>
                            <li class="sort-item <?php echo active($sort, 'trending'); ?>">
                                <a href="<?php echo Site::url(); ?>/topics/trending">Trending</a>
                            </li>
                            <li class="sort-item <?php echo active($sort, 'all'); ?>">
                                <a href="<?php echo Site::url(); ?>/topics/all">All</a>
                            </li>
                        </ul>

                        <?php if (User::isLogged()) : ?>
                            <a class="secondary-button open-editor new-topic pull-right" href="<?php echo Site::url(); ?>/topic/new">
                                New Topic
                            </a>
                        <?php endif; ?>
                    </div>
                    <?php
                endif;
