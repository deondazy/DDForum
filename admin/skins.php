<?php

/** Load admin **/
require_once( dirname( __FILE__ ) . '/admin.php' );

$title = 'Choose Skin';
$file = 'skins.php';
$parent_menu = 'skins.php';

$the_skin = isset( $_GET['skin'] ) ? $_GET['skin'] : '';

require_once( DDFPATH . 'admin/admin-header.php' );

define( 'SKINDIR', DDFPATH . 'skins/' );

$skins_dir = scandir( SKINDIR );

switch ( $the_skin ) {
  case '': ?>
    <div class="skins">
    <h3 class="feature-notice">Notice: Skin feature is a work in progress and not functional yet, do not use.</h3>

  <?php

  foreach ( $skins_dir as $skin ) {

    $skin_folder = SKINDIR . $skin;
    $skin_info_file = SKINDIR . $skin . '/.skin';
    $skin_screenshot = file_exists(SKINDIR . $skin . '/screenshot.png') ? '<img src="' . home_url() . '/skins/' . $skin . '/screenshot.png" height="100" width="100">' : '';

    if ( file_exists($skin_info_file) ) {

      $skin_info = file($skin_info_file);

      foreach ($skin_info as $line_num => $line) {
        if ( 'name =' == substr( $line, 0, 6 )) {
          $skin_f[0]['name'] = substr($line, 7);
        }

        if ( 'description =' == substr( $line, 0, 13 ) ) {
          $skin_f[0]['desc'] = substr($line, 14);
        }

        if ( 'author =' == substr($line, 0, 8) ) {
          $skin_f[0]['author'] = substr($line, 9);
        }
      }

      $skin_f[0]['screenshot']  = $skin_screenshot;

      foreach ( $skin_f as $v ) { ?>

        <div class="skin">
          <div class="skin-active-button">Activate</div>
          <a href="<?php echo admin_url( 'skins.php' ); ?>?skin=<?php echo $v['name']; ?>"><div class="screenshot"><?php echo $v['screenshot']; ?></div>
          <div class="skin-name-author"><?php echo $v['name']; ?>
          <div class="skin-author">By - <?php echo $v['author']; ?></div></div></a>
        </div>

        <?php
      }

    }
  }
  ?>
</div>
<?php
    break;
}
include( DDFPATH . 'admin/admin-footer.php' );
