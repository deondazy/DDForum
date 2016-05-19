<?php
/**
 * DDForum Front-end header
 *
 * @package DDForum
 */

use DDForum\Core\Site;
use DDForum\Core\Option;
use DDForum\Core\User;
use DDForum\Core\Topic;

?><!DOCTYPE html>
<html>
  <head>
    <title><?php echo isset($title) ? $title : Option::get('site_name'); ?></title>

    <meta charset="utf8">
    <meta content="width=device-width, initial-scale=1" name="viewport">

    <link rel="stylesheet" href="<?php echo Site::url() . '/inc/css/font-awesome.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo Site::url() . '/inc/css/dist/production.min.css'; ?>">

    <script src="<?php echo Site::url() . '/inc/js/jquery.js'; ?>"></script>
    <script src="<?php echo Site::url() . '/inc/js/tinymce/js/tinymce/tinymce.js' ?>"></script>
    <script src="<?php echo Site::url() . '/inc/js/editor.js' ?>"></script>
    <script src="<?php echo Site::url() . '/inc/js/functions.js' ?>"></script>

    <?php if (Site::isProfilePage()) : ?>
      <script src="<?php echo Site::url() . '/inc/js/user.js' ?>"></script>
    <?php endif; ?>

    <?php if (Site::isEditorPage() || Site::isHomePage()) : ?>
      <script src="<?php echo Site::url() . '/inc/js/front-editor.js' ?>"></script>
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
              Welcome <strong><?php echo User::get('display_name', 'current_user'); ?>:</strong>
            </div>

            <ul class="pull-left">
              <li class="site-navigation-link"><a href="<?php echo Site::url(); ?>/edit-profile">Edit Profile</a></li>
              <li class="site-navigation-link"><a href="<?php echo Site::url(); ?>/logout">Logout</a></li>
            </ul>
          <?php else : ?>
            <div class="site-navigation-welcome-text pull-left">Welcome <strong>Guest:</strong></div>

            <ul class="pull-left">
              <li class="site-navigation-link"><a href="<?php echo Site::url(); ?>/register"><b>Register</b></a></li>
              <li class="site-navigation-link"><a href="<?php echo Site::url(); ?>/login">Login</a></li>
            </ul>
          <?php endif; ?>
        </nav>

        <!--<div class="site-search">
          <form method="get" action="search.php">
            <input type="text" name="s">
            <input type="submit" value="search">
          </form>
        </div>-->
      </header>

      <div id="main" class="site-main">

        <?php if (Site::isHomePage() || Site::isForumPage()) :

          $sort = isset($_GET['sort']) ? $_GET['sort'] : '';

          switch ($sort) {
            case 'today':
              $topics = Topic::getToday();
            break;

            case 'trending':
              $topics = Topic::getTrending();
            break;

            case 'all':
              $topics = Topic::getAll();
            break;

            default:
              $topics = Topic::getPinned();
            break;
          }
        ?>

          <div class="sort-view clearfix">

            <ul class="view pull-left">
              <li class="sort-item"><a href="<?php echo Site::url(); ?>">Pinned</a></li>
              <li class="sort-item"><a href="<?php echo Site::url(); ?>/topics/today">Today</a></li>
              <li class="sort-item"><a href="<?php echo Site::url(); ?>/topics/trending">Trending</a></li>
              <li class="sort-item"><a href="<?php echo Site::url(); ?>/forums">Forums</a></li>
              <li class="sort-item"><a href="<?php echo Site::url(); ?>/topics/all">All</a></li>
            </ul>

            <a class="secondary-button open-editor new-topic pull-right" href="topics/new">New Topic</a>
          </div>
        <?php endif; ?>
