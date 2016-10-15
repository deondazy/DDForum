<?php
/**
 * DDForum Installation Script
 *
 * We're installing DDForum, using the config.sample.php file
 * to create the config.php then setup the databse tables
 * from the config file provided details
 */

use DDForum\Core\Database;
use DDForum\Core\Config;
use DDForum\Core\Installer;
use DDForum\Core\Exception\DatabaseException;
use DDForum\Core\Site;
use DDForum\Core\User;
use DDForum\Core\Util;

define('DDFPATH', dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR);

// Compare PHP versions against our required 5.6
if (!version_compare(PHP_VERSION, '5.6', '>=')) {
    die('PHP 5.6 or higher is required to run DDForum, you currently have PHP ' . PHP_VERSION);
}

// Autoload classes
require DDFPATH . 'vendor/autoload.php';

$step = isset($_GET['step']) ? (int)$_GET['step'] : 1;

/**
 * Create config.php file header
 *
 * @ignore
 */
function createConfigHeader($title)
{
    header('Content-Type: text/html; charset=utf-8');
    ?><!DOCTYPE html>
    <html>
    <head>
        <meta name="viewport" content="width=device-width" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>DDForum &rsaquo; Installation &rsaquo; <?php echo $title; ?></title>
        <link rel="stylesheet" href="css/install.css" />
    </head>
    <body>
        <div class="wrap">
            <h2 class="logo"><a title="DDForum" href="https://github.com/deondazy/ddforum.git">DDForum</a></h2>
            <div class="ddf-ui">
  <?php
} // End function create_config_header

switch ($step) {
    case 1:
        createConfigHeader('Database');
        // Check installation
        if (file_exists(DDFPATH .'config.php')) {
            include DDFPATH .'config.php';
            $db = Config::get('db_connection');
            Database::instance()->connect($db->string, $db->user, $db->password);

            if (Database::instance()->checkTables()) {
                Site::info('Seems you have already installed DDForum, to reinstall clear the database tables and try again', true, true);
            }
        }

        Installer::step('database');
    ?>
    <form method="post" action="?step=2" class="install-form">
        <p>Enter your database connection details below. Contact your host if you are not sure of any value.</p>

        <table class="form-table">
            <tr>
                <th scope="row"><label for="dbhost">Host</label></th>
                <td><input name="dbhost" id="dbhost" type="text" size="25" value="<?php echo htmlspecialchars('localhost', ENT_QUOTES); ?>" class="text-input" /></td>
                <td><p class="description">MySQL host, usually <code>localhost</code></p></td>
            </tr>
            <tr>
                <th scope="row"><label for="dbname">Database</label></th>
                <td><input name="dbname" id="dbname" type="text" size="25" value="<?php echo htmlspecialchars('ddforum', ENT_QUOTES); ?>" class="text-input" /></td>
                <td><p class="description">Name of the database to install DDForum in.</p></td>
            </tr>
            <tr>
                <th scope="row"><label for="uname">Username</label></th>
                <td><input name="uname" id="uname" type="text" size="25" value="<?php echo htmlspecialchars('username', ENT_QUOTES); ?>" class="text-input" /></td>
                <td><p class="description">MySQL username</p></td>
            </tr>
            <tr>
                <th scope="row"><label for="pwd">Password</label></th>
                <td><input name="pwd" id="pwd" type="password" size="25" value="<?php echo htmlspecialchars('password', ENT_QUOTES); ?>" autocomplete="off" class="text-input" /></td>
                <td><p class="description">MySQL password</p></td>
            </tr>
            <tr>
                <th scope="row"><label for="prefix">Table Prefix</label></th>
                <td><input name="prefix" id="prefix" type="text" value="<?php echo htmlspecialchars('ddf_', ENT_QUOTES); ?>" size="25" class="text-input" /></td>
                <td><p class="description">You can have multiple installation of DDForum in one database with different table prefix.</td>
            </tr>
        </table>
        <p><input name="submit" type="submit" value="<?php echo htmlspecialchars('Next', ENT_QUOTES); ?>" class="button-secondary" /></p>
        </form>
        </div><!-- .ddf-ui -->
        </div><!-- .wrap -->
        </body>
        </html>
        <?php
    break;

    case 2:
        $dbname = trim(stripslashes($_POST['dbname']));
        $dbuser = trim(stripslashes($_POST['uname']));
        $dbpass = trim(stripslashes($_POST['pwd']));
        $dbhost = trim(stripslashes($_POST['dbhost']));
        $prefix = trim(stripslashes($_POST['prefix']));

        $step_1 = '?step=1';
        $retryLink = "<p class='step'><a href='{$step_1}' onclick='javascript:history.go(-1);return false;' class='button-secondary'>Try again</a>";

        if (empty($prefix)) {
            createConfigHeader('Error');
            Site::info("<strong>ERROR</strong>: Table Prefix must not be empty. {$retryLink}", true, true);
        }

        // Validate $prefix: it can only contain letters, numbers and underscores.
        if (preg_match('|[^a-z0-9_]|i', $prefix)) {
            createConfigHeader('Error');
            Site::info("<strong>ERROR</strong>: Table Prefix can only contain numbers, letters, and underscores {$retryLink}", true, true);
        }

        try {
            $pdo = new \PDO("mysql:host={$dbhost};dname={$dbname}", $dbuser, $dbpass);
            Database::instance()->connect($pdo);

            createConfigHeader('Config, file');
            Installer::step('config');

            Site::info("Connection Successful");

            $pathToConfig = DDFPATH . 'config.php';

            $handle = fopen($pathToConfig, 'w');

            $line = "<?php\nDDForum\Core\Config::set('db_connection', [\n\t'string' => 'mysql:host={$dbhost};dbname={$dbname}',\n\t'dbname' => '{$dbname}',\n\t'dbhost' => '{$dbhost}',\n\t'user' => '{$dbuser}',\n\t'password' => '{$dbpass}',\n\t'table_prefix' => '{$prefix}'\n]);";

            fwrite($handle, $line);
            fclose($handle);

            chmod($pathToConfig, 0666);

            Site::info("Config file created");

            echo "<p class='step'><a href='?step=3' class='button-secondary'>Next</a></p>";
            die();
        } catch (Exception $e) {
            createConfigHeader('Error');
            Site::info(
                "<h1>ERROR: Unable to connect to database</h1>
                <p>The database details is either incorrect or we are unable to contact the database server at <code>{$dbhost}</code>.
                You should contact your host and make sure:</p>
                <ul>
                    <li>You typed the correct username and password.</li>
                    <li>You typed the correct hostname.</li>
                    <li>You typed the correct database name and your database server is running.</li>
                </ul>
                <p>If you are unsure of what to do next, feel free to <a href='mailto:deondazy@gmail.com'>contact us</a> for assistance.</p> {$retryLink}", true, true
            );
        }
    break;

    case 3:

        // We should have a config.php at this point
        if (file_exists(DDFPATH.'config.php')) {
            include(DDFPATH . 'config.php');
        } else {
            // For whatever reason the config.php isn't there
            Site::info("The <code>config.php</code> is missing, please restart installation", true, true);
        }

        createConfigHeader('Create Tables');
        Installer::step('tables');

        $db = Config::get('db_connection');

        // Connect to database
        Database::instance()->connect(new \PDO($db->string, $db->user, $db->password));

        // Check if there's any table
        if (Database::instance()->checkTables()) {
            // One or more table exist
            Site::info("One or more tables already exist, drop all tables and refresh this page", true, true);
        } else {
            if (Installer::install()) {
                echo "Tables Created";
                echo "<p class='step'><a href='?step=4' class='button-secondary'>Next</a></p>";
            } else {
                Site::info("Unable to create tables", true, true);
            }
        }

    break;

    case 4:
        // We should have a config.php at this point
        if (file_exists(DDFPATH . 'config.php')) {
            include(DDFPATH . 'config.php');
        } else {
            // For whatever reason the config.php isn't there
            Site::info("The <code>config.php</code> is missing, please restart installation", true, true);
        }

        createConfigHeader('Site Configuration');
        Installer::step('site');

        if ('POST' == $_SERVER['REQUEST_METHOD']) {
            $siteName  = $_POST['site-name'];
            $username  = $_POST['username'];
            $password  = $_POST['password'];
            $password2 = $_POST['password2'];
            $email     = $_POST['email'];

            if (!empty($username)) {
                if (!empty($password)) {
                    if (!empty($password2)) {
                        if ($password == $password2) {
                            if (!empty($email)) {
                                if (Util::isEmail($email)) {
                                    $password = password_hash($password, PASSWORD_DEFAULT);

                                    $dataAdmin = [
                                        'id'            => 1,
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

                                    $db = Config::get('db_connection');

                                    // Connect to database
                                    Database::instance()->connect(new \PDO($db->string, $db->user, $db->password));

                                    $insert = User::create($dataAdmin);

                                    Installer::createOptions($siteName, $email);
                                    Installer::createDefaults();

                                    echo 'Installation Complete <p class="step"><a href="' . Site::url() . '/login" class="button-secondary">Login</a></p>';
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

            if (isset($err)) {
                Site::info($err, true);
                Installer::headAdminForm();
            }
        }

        Installer::headAdminForm();

    break;
}
