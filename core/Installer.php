<?php

namespace DDForum\Core;

class Installer
{
    public static function init()
    {
        $installPath = Site::adminUrl('install/index.php');

        // Redirect to install.php
        if (false === strpos($_SERVER['REQUEST_URI'], 'install')) {
          header('Location: ' . $installPath);
          die();
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

        $forum = new Forum();
        $topic = new Topic();

        if (
            $forum->create($sampleCategory) &&
            $forum->create($sampleForum) &&
            $topic->create($sampleTopic)
        ) {
            return true;
        }

        return false;
    }

    public static function createOptions($site_name, $email)
    {
        $options = [
            'site_name'             => $site_name,
            'site_url'              => Site::url(),
            'site_description'      => '',
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

        foreach ($options as $option_name => $value) {
            $addOptions = Option::add($option_name, $value);
        }

        if ($addOptions) {
            return true;
        }

        return false;
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
