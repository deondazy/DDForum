<?php
/**
 * Administration Header
 *
 * @package DDForum
 * @subpackage Administration
 */

use DDForum\Core\Site;
use DDForum\Core\User;

?><!DOCTYPE html>
<html>
  <head>
    <title><?php echo $title ?> &lsaquo; DDForum</title>
    <meta charset="utf8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo Site::url() . '/inc/css/bootstrap.css'; ?>">
    <link rel="stylesheet" href="<?php echo Site::adminUrl('css/admin.css'); ?>">
    <link rel="stylesheet" href="<?php echo Site::url() . '/inc/css/font-awesome.css'; ?>">

    <script src="<?php echo Site::url() . '/inc/js/jquery.js'; ?>"></script>
    <script src="<?php echo Site::url() . '/inc/js/tinymce/js/tinymce/tinymce.js' ?>"></script>
    <script src="<?php echo Site::url() . '/inc/js/editor.js' ?>"></script>
    <script src="<?php echo Site::adminUrl('js/functions.js') ?>"></script>
    <script src="<?php echo Site::adminUrl('js/uploader.js') ?>"></script>
  </head>

  <body>
    <div class="wrap">

      <?php include DDFPATH . 'admin/inc/admin-menu.php'; ?>

      <div id="admin-content">

        <?php include DDFPATH . 'inc/admin-bar.php'; ?>

        <div id="admin-body">

          <header class="admin-header"><h2><?php echo $title; ?></h2></header>

          <div id="main" class="container clearfix">
