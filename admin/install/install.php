<?php
/**
 * DDForum Installation Script
 *
 * We're installing DDForum, using the config.sample.php file
 * to create the config.php then setup the databse tables
 * from the config file provided details
 */

use DDForum\Core\Database;
use DDForum\Core\Site;
use DDForum\Core\User;
use DDForum\Core\Util;

define('DDFPATH', dirname(dirname( dirname( __FILE__ ) ) ) . DIRECTORY_SEPARATOR);

/** Load DDForum Startup **/
require_once(DDFPATH . 'startup.php');

// Check for the config.sample.php file
if (file_exists(DDFPATH . 'config.sample.php')) {

  $config_file = file(DDFPATH . 'config.sample.php');

} else {

  create_config_header('Error');

  Site::info("Unable to find <code>config.sample.php</code> file, I need this file to work with. Please re-upload the <code>config.sample.php</code> file in your DDForum install.", true, true);
}

$step = isset( $_GET['step'] ) ? (int) $_GET['step'] : 1;

/**
 * Create config.php file header
 *
 * @ignore
 */
function create_config_header( $title ) {
  header( 'Content-Type: text/html; charset=utf-8' );
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>DDForum &rsaquo; Installation &rsaquo; <?php echo $title; ?></title>
  <link rel="stylesheet" href="css/install.css">
</head>
<body>
  <div class="wrap">
    <h2 class="logo"><a title="DDForum" href="https://github.com/deondazy/ddforum.git">DDForum</a></h2>
    <div class="ddf-ui">

<?php
} // End function create_config_header

function install_step( $step ) {
  echo '<ul class="install-steps">';
  $steps['database'] =  'Database Setup';
  $steps['config']   = 'Config. File';
  $steps['tables']   = 'Create Tables';
  $steps['site']     = 'Site Config.';

  foreach ($steps as $key => $value) {
    if ( $step == $key ) {
      echo '<li class="step-item active">' . $value . '</li>';
    } else {
      echo '<li class="step-item">' . $value . '</li>';
    }
  }

  echo '</ul>';
}


switch ( $step ) {

  case 1:
    create_config_header( 'Database' );
    install_step( 'database' );
?>
<form method="post" action="install.php?step=2" class="install-form">
  <p>Enter your database connection details below. Contact your host if you&#8217;re not sure about any of these values.</p>

  <table class="form-table">
    <tr>
      <th scope="row"><label for="dbhost">Host</label></th>
      <td><input name="dbhost" id="dbhost" type="text" size="25" value="localhost" class="text-input" /></td>
      <td><p class="description">MySQL host, usually <code>localhost</code></p></td>
    </tr>

    <tr>
      <th scope="row"><label for="dbname">Database</label></th>
      <td><input name="dbname" id="dbname" type="text" size="25" value="ddforum" class="text-input" /></td>
      <td><p class="description">Name of the database to install DDForum in.</p></td>
    </tr>

    <tr>
      <th scope="row"><label for="uname">Username</label></th>
      <td><input name="uname" id="uname" type="text" size="25" value="<?php echo htmlspecialchars( 'username', ENT_QUOTES ); ?>" class="text-input" /></td>
      <td><p class="description">MySQL username</p></td>
    </tr>

    <tr>
      <th scope="row"><label for="pwd">Password</label></th>
      <td><input name="pwd" id="pwd" type="text" size="25" value="<?php echo htmlspecialchars( 'password', ENT_QUOTES ); ?>" autocomplete="off" class="text-input" /></td>
      <td><p class="description">MySQL password</p></td>
    </tr>

    <tr>
      <th scope="row"><label for="prefix">Table Prefix</label></th>
      <td><input name="prefix" id="prefix" type="text" value="ddf_" size="25" class="text-input" /></td>
      <td><p class="description">You can have multiple installation of DDForum in one database with different table prefix.</td>
    </tr>
  </table>
  <p class="step pull-right"><input name="submit" type="submit" value="<?php echo htmlspecialchars( 'Next', ENT_QUOTES ); ?>" class="button-secondary" /></p>
</form>
</div>
</div>
</body>
</html>
<?php
  break;

  case 2:

    // Check if config.php file has been created
    if ( file_exists( DDFPATH . 'config.php' ) )
      Site::info( '<code>config.php</code> file already exists. If you want to change any of the values, delete the file and refresh this page.', true, true);

    $dbname = trim( stripslashes( $_POST[ 'dbname' ] ) );
    $uname  = trim( stripslashes( $_POST[ 'uname' ] ) );
    $pwd    = trim( stripslashes( $_POST[ 'pwd' ] ) );
    $dbhost = trim( stripslashes( $_POST[ 'dbhost' ] ) );
    $prefix = trim( stripslashes( $_POST[ 'prefix' ] ) );

    $step_1 = 'install.php?step=1';

    $retry_link = '<p class="step"><a href="' . $step_1 . '" onclick="javascript:history.go(-1);return false;" class="button-secondary">Try again</a>';

    if ( empty( $prefix ) ) {
      Site::info('<strong>ERROR</strong>: "Table Prefix" must not be empty.' . $retry_link, true);
    }

    // Validate $prefix: it can only contain letters, numbers and underscores.
    if ( preg_match( '|[^a-z0-9_]|i', $prefix ) ) {
      Site::info( '<strong>ERROR</strong>: "Table Prefix" can only contain numbers, letters, and underscores.' . $retry_link, true);
    }

    // Test the db connection.
    /**#@+
    * @ignore
    */
    define('DB_NAME', $dbname);
    define('DB_USER', $uname);
    define('DB_PASSWORD', $pwd);
    define('DB_HOST', $dbhost);
    define('TABLE_PREFIX', $prefix);
    /**#@-*/

    // Re-construct $ddf_db with these new values.
    Database::connect();

    if (Database::$error) {
      Site::info('<h1>ERROR: Unable to connect to database</h1>
        <p>The database details in <code>config.php</code> is either incorrect or we are unable to contact the database server at <code>' . DB_HOST. '</code>. You should contact your host and make sure:</p>
        <ul>
          <li>You typed the correct username and password.</li>
          <li>You typed the correct hostname.</li>
          <li>You typed the correct database name and your database server is running.</li>
        </ul>
        <p>If you are unsure of what to do next, feel free to <a href="mailto:deondazy@gmail.com">contact us</a> for assistance.</p>' . $retry_link, true, true);
    }

    // Not a PHP5-style by-reference foreach, as this file must be parseable by PHP4.
    foreach ($config_file as $line_num => $line) {

      if (!preg_match('/^define\(\'([A-Z_]+)\',([ ]+)/', $line, $match))
        continue;

      $constant = $match[1];
      $padding  = $match[2];

      switch ($constant) {
        case 'DB_NAME'     :
        case 'DB_USER'     :
        case 'DB_PASSWORD' :
        case 'DB_HOST'     :
        case 'TABLE_PREFIX':

        $config_file[$line_num] = "define('" . $constant . "'," . $padding . "'" . addcslashes( constant( $constant ), "\\'" ) . "');\r\n";
        break;
      }
    }

    unset( $line );

    if ( ! is_writable(DDFPATH) ) :
      create_config_header( 'Config. File' );
      install_step( 'config' );
      ?>
      <p>Sorry, writing the <code>config.php</code> file didn&#8217;t work.</p>
      <p>You can create the <code>config.php</code> file manually, copy and paste the following text into it.</p>
      <textarea id="config-file" cols="98" rows="15" class="code" readonly="readonly"><?php
      foreach( $config_file as $line ) {
        echo htmlentities($line, ENT_COMPAT, 'UTF-8');
      }?></textarea>
      <p>After you&#8217;ve done that, click &#8220;Install.&#8221;</p>
      <p class="step"><a href="<?php echo $install; ?>" class="button-secondary">Install</a></p>

      <?php
    else :

      if ( file_exists( DDFPATH . 'config.sample.php' ) )
        $path_to_config = DDFPATH . 'config.php';

      $handle = fopen( $path_to_config, 'w' );
      foreach( $config_file as $line ) {
        fwrite( $handle, $line );
      }
      fclose( $handle );
      chmod( $path_to_config, 0666 );
      create_config_header( 'Config. File' );
      install_step( 'config' );
      ?>
      <p>All good! The <code>config.php</code> file is in place and the Database connection is OK. Next we need to create the Database Tables. Click Next when you&#8217;re ready.</p>

      <p class="step"><a href="<?php echo 'install.php?step=3' ?>" class="button-secondary">Next</a></p>
      <?php
    endif;
  break;


  case 3:

    create_config_header( 'Create Tables' );

    install_step( 'tables' );

    // Check if there's any table
    foreach (Database::tables() as $table) {
      Database::query('DESCRIBE ' .$table);
      Database::execute();

      $table_exist[] = Database::fetchAll();
    }

    if ( in_array(true, $table_exist) ) {
      // One or more table exist, suggest a tables fix.
      Site::info("One or more tables already exist, drop all tables and refresh this page", true);
    } else {

      if (Site::install()) {

        $install = 'install.php';
        echo "Tables Created";
        echo "<p class='step'><a href='install.php?step=4' class='button-secondary'>Next</a></p>";
      } else {
        Site::info("Unable to create tables", true);
      }
    }

  break;

  case 4:
  function display_form() {
    echo '<form method="post" action="install.php?step=4">
      <p>Fill the form below to setup your site and create the Forum Head Administrator account.</p>

      <table class="form-table">
        <tr>
          <th scope="row"><label for="site-name">Site name</label></th>
          <td><input name="site-name" id="site-name" type="text" size="25"  class="text-input" /></td>
        </tr>
        <tr>
          <th scope="row"><label for="username">Username</label></th>
          <td><input name="username" id="username" type="text" size="25"  class="text-input" /></td>
        </tr>
        <tr>
          <th scope="row"><label for="password">Password</label></th>
          <td><input name="password" id="password" type="password" size="25"  class="text-input" /></td>
        </tr>
        <tr>
          <th scope="row"><label for="password2">Confirm Password</label></th>
          <td><input name="password2" id="password2" type="password" size="25"  autocomplete="off" class="text-input" /></td>
        </tr>
        <tr>
          <th scope="row"><label for="email">Email</label></th>
          <td><input name="email" id="email" type="text" size="25"  class="text-input" /></td>
        </tr>
      </table>
      <p class="step"><input name="submit" type="submit" value="' . htmlspecialchars( "Submit", ENT_QUOTES ) . '" class="button-secondary" /></p>
    </form>';
  }

  create_config_header( 'Site Configuration');
  install_step( 'site' );

  if (isset($_POST['submit'])) {
    $site_name = $_POST['site-name'];
    $username  = $_POST['username'];
    $password  = $_POST['password'];
    $password2 = $_POST['password2'];
    $email     = $_POST['email'];

    if ( !empty( $username) ) {
      if ( !empty( $password ) ) {
        if ( !empty( $password2) ) {
          if ( $password == $password2 ) {
            if ( !empty( $email ) ) {
              if ( Util::isEmail( $email) ) {
                $password = md5( $password );

                $data_admin = [
                  'username'      => $username,
                  'display_name'  => $username,
                  'password'      => $password,
                  'email'         => $email,
                  'register_date' => date('Y-m-d'),
                  'last_seen'     => date('Y-m-d h:i:s'),
                  'level'         => 1,
                  'credit'        => 100,
                  'avatar'        => User::defaultAvatar()
                ];

                $insert = User::create($data_admin);

                Site::createOptions($site_name, $email);
                Site::CreateDefaults();

                if ( $insert ) {
                  echo 'Installation Complete <p class="step"><a href="' . Site::url() . '/login" class="button-secondary">Login</a></p>';
                }
              } else {
                $err[] = "Email is invalid, email looks like name@example.com";
              }
            } else {
              $err[] ="Email address is required";
            }
          } else {
            $err[] = "Passwords do not match";
          }
        } else {
          $err[] = "Confirm your password";
        }
      } else {
        $err[] = "Password is required";
      }
    } else {
      $err[] = "Username is required";
    }

    if ( isset( $err ) ) {
      Site::info($err, true);
      display_form();
    }
  } else {
    display_form();
  }

  break;
}
