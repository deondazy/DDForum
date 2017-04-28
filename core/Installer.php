<?php

namespace DDForum\Core;

// TODO: Remove all hard dependencies

class Installer
{
    public static function guessUrl()
    {
        $abspath_fix = str_replace('\\', '/', DDFPATH);
        $script_filename_dir = dirname($_SERVER['SCRIPT_FILENAME']);

        // The request is for the Admin or the Login page
        if (strpos($_SERVER['REQUEST_URI'], 'admin') !== false || strpos($_SERVER['REQUEST_URI'], 'login.php') !== false) {
            // Remove the Admin or the Login page from the path
            $path = preg_replace('#/(admin/.*|login.php)#i', '', $_SERVER['REQUEST_URI']);
            // The request is for a file in DDFPATH
        } elseif ($script_filename_dir.'/' == $abspath_fix) {
            // Strip off any file/query params in the path
            $path = preg_replace('#/[^/]*$#i', '', $_SERVER['PHP_SELF']);
        } else {
            if (false !== strpos($_SERVER['SCRIPT_FILENAME'], $abspath_fix)) {
                // Request is hitting a file inside DDFPATH
                $directory = str_replace(DDFPATH, '', $script_filename_dir);
                // Strip off the sub directory, and any file/query paramss
                $path = preg_replace('#/'.preg_quote($directory, '#').'/[^/]*$#i', '', $_SERVER['REQUEST_URI']);
            } elseif (false !== strpos($abspath_fix, $script_filename_dir)) {
                // Request is hitting a file above DDFPATH
                $subdirectory = substr($abspath_fix, strpos($abspath_fix, $script_filename_dir) + strlen($script_filename_dir));
                // Strip off any file/query params from the path, appending the sub directory to the install
                $path = preg_replace('#/[^/]*$#i', '', $_SERVER['REQUEST_URI']).$subdirectory;
            } else {
                $path = $_SERVER['REQUEST_URI'];
            }
        }

        $schema = Site::ssl() ? 'https://' : 'http://'; // set_url_scheme() is not defined yet
        $url = $schema.$_SERVER['HTTP_HOST'].$path;

        return rtrim($url, '/');
    }
    
    public static function init()
    {
        $installPath = self::guessUrl() . '/admin/install/index.php';

        // Redirect to install.php
        if (false === strpos($_SERVER['REQUEST_URI'], 'install')) {
            header('Location: ' . $installPath);
            exit();
        }
    }

    public static function step($step)
    {
        $steps = [];
        $output = '<ul class="install-steps">';

        $steps['database'] =  'Database Setup';
        $steps['config']   =  'Config. File';
        $steps['tables']   =  'Create Tables';
        $steps['site']     =  'Site Config.';

        foreach ($steps as $key => $value) {
            if ($step == $key) {
                $output .= "<li class='step-item active'>{$value}</li>";
            } else {
                $output .= "<li class='step-item'>{$value}</li>";
            }
        }

        $output .= '</ul>';

        echo $output;
    }

    /**
     * Install DDForum
     */
    public static function install()
    {
        $queries = self::getSqlQueries();

        try {
            Database::instance()->beginTransaction();

            foreach ($queries as $query) {
                Database::instance()->query($query);
                Database::instance()->execute();
            }

            Database::instance()->endTransaction();

            return true;

        } catch (\PDOException $e) {
            Database::instance()->cancelTransaction();

            return false;
        }
    }

    private static function getSqlQueries()
    {
        $schemaPath = DDFPATH .'admin/install/schema.sql';

        $schemaSql = trim(file_get_contents($schemaPath), "\r\n ");
        $schemaSql = str_replace('{$prefix}', Config::get('db_connection')->table_prefix, $schemaSql);

        $queries = preg_split("/(\\r\\n|\\r|\\n)\\1/", $schemaSql);

        return $queries;
    }

    public static function createSampleCategory()
    {
        $sample = new SampleBuilder('Forum');
        $sample->build($sampleCategory);
    }

    public static function createDefaults()
    {
        $sampleCategory = [
            'id'             => 1,
            'name'           => 'Default Category',
            'slug'           => 'default-category',
            'description'    => 'This is the Default Category, edit or delete it.',
            'type'           => 'category',
            'creator'        => 1,
            'create_date'    => date('Y-m-d H:i:s'),
            'last_post_date' => date('Y-m-d H:i:s'),
        ];

        $sampleForum = [
            'id'             => 2,
            'name'           => 'Default Forum',
            'slug'           => 'default-forum',
            'description'    => 'This is the Default Forum, edit or delete it.',
            'creator'        => 1,
            'parent'         => 1,
            'create_date'    => date('Y-m-d H:i:s'),
            'last_post_date' => date('Y-m-d H:i:s'),
        ];

        $sampleTopic = [
            'id'             => 1,
            'subject'        => 'Sample Topic',
            'slug'           => 'sample-topic',
            'message'        => 'Welcome to DDForum PHP forum software application, hope you\'d enjoy our effort',
            'create_date'    => date('Y-m-d H:i:s'),
            'last_post_date' => date('Y-m-d H:i:s'),
            'poster'         => 1,
            'last_poster'    => 1,
            'pinned'         => 1
        ];

        $sampleReply = [
            'id'          => 10,
            'forum'       => 2,
            'topic'       => 1,
            'message'     => 'Sample reply... Delete this from admin.',
            'poster'      => 1,
            'create_date' => date('Y-m-d H:i:s'),
        ];

        $forum = new Forum();
        $topic = new Topic();
        $reply = new Reply();

        if (
            $forum->create($sampleCategory) &&
            $forum->create($sampleForum) &&
            $topic->create($sampleTopic) &&
            $reply->create($sampleReply)
        ) {
            return true;
        }

        return false;
    }

    public static function createOptions($site_name, $email)
    {
        $options = [
            'site_name'             => $site_name,
            'site_url'              => self::guessUrl(),
            'site_description'      => 'DDForum PHP based forum site',
            'admin_email'           => $email,
            'enable_pm'             => 1,
            'enable_credits'        => 1,
            'enable_ads'            => 1,
            'enable_downloads'      => 1,
            'enable_notifications'  => 1,
            'enable_likes'          => 1,
            'users_can_upload'      => 0,
            'allow_reports'         => 1,
            'allow_credit_transfer' => 1,
        ];

        $option = new Option();

        foreach ($options as $option_name => $value) {
            $addOptions = $option->add($option_name, $value);
        }

        if ($addOptions) {
            return true;
        }

        return false;
    }

    public static function modRewrite()
    {
        $url = parse_url(self::guessUrl());
        if (isset($url['path'])) {
            $root = rtrim($url['path'], '/\\').'/';
        } else {
            $root = '/';
        }

        $htaccess = <<<EOF
<IfModule mod_rewrite.c>
RewriteEngine on
RewriteBase {$root}

RewriteCond %{REQUEST_URI} /+[^\.]+$
RewriteRule ^(.+[^/])$ %{REQUEST_URI}/ [R=301,L]

RewriteCond %{SCRIPT_FILENAME} !-d
RewriteCond %{SCRIPT_FILENAME} !-f

RewriteRule ^category/([a-z0-9-]+)/*$ ./category.php?s=$1
RewriteRule ^forum/([a-z0-9-]+)/*$ ./forum.php?s=$1
RewriteRule ^forum/([a-z0-9-]+)/page=([0-9]+)/*$ ./forum.php?s=$1&page=$2 [L]

# Display single forum,new forum and edit forum
RewriteRule ^forum/all/*$ ./forum-all.php
RewriteRule ^forum/([a-z0-9-]+)/([0-9]+)/*$ ./forum.php?s=$1&id=$2
RewriteRule ^forums/new*$ ./forum-new.php
RewriteRule ^forums/(\d+)*$ ./forum.php?id=$1
RewriteRule ^forums/(\d+)/edit*$ ./forum-edit.php?id=$1

RewriteRule ^notifications/*$ ./notifications.php

# Display newtopic, single topic and edit topic
RewriteRule ^topic/new/*$ ./topic-new.php
#RewriteRule ^topics/(#[a-z]-[1-9]+)/(\d+)*$ ./topic.php?$1/id=$2
RewriteRule ^topics/(\d+)/edit*$ ./topic-edit.php?id=$1

RewriteRule ^topics/([a-z]+)/*$ ./index.php?sort=$1

RewriteRule ^users/new*$ ./user-new.php
RewriteRule ^user/([a-zA-Z0-9]+)/*$ ./user.php?u=$1
RewriteRule ^users/(\d+)/edit*$ ./user-edit.php?id=$1

RewriteRule ^login/$ ./login.php
RewriteRule ^logout/*$ ./logout.php
RewriteRule ^register/*$ ./register.php
RewriteRule ^forgot-password/*$ ./forgot-password.php

RewriteRule ^topic/([a-z0-9-]+)/*$ ./topic.php?s=$1
RewriteRule ^topic/([a-z0-9-]+)/page=([0-9]+)/*$ ./topic.php?s=$1&page=$2 [L]

# Replying to posts
RewriteRule ^topic/([a-z0-9-]+)/([0-9]+)/replytopost=([0-9]+)/*$ ./topic.php?s=$1&id=$2&replytopost=$3 [L]
RewriteRule ^topic/([a-z0-9-]+)/([0-9]+)/page=([0-9]+)/replytopost=([0-9]+)/*$ ./topic.php?s=$1&id=$2&page=$3&replytopost=$4 [L]

RewriteRule ^edit-profile/$ ./edit-profile.php
</IfModule>

EOF;

    $pathToFile = DDFPATH.'.htaccess';
    $handle = fopen($pathToFile, 'w');
    fwrite($handle, $htaccess);
    fclose($handle);
    chmod($pathToFile, 0666);

    }

    public static function headAdminForm() {
        echo '<form method="post" action="?step=4">
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
}
