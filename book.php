<?php

/**
 * Plugin Name:     Books
 * Plugin URI:      https://www.veronalabs.com
 * Plugin Prefix:   book
 * Description:     This is test plugin
 * Author:          Ali Atashinbar
 * Author URI:      https://google.com
 * Text Domain:     book
 * Domain Path:     /languages
 * Version:         0.2
 */

if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require dirname(__FILE__) . '/vendor/autoload.php';
}

use Rabbit\Application;
use Rabbit\Utils\Singleton;
use League\Container\Container;
use BookPlugin\ServiceProvider;
use BookPlugin\PostTypes\Book;

/**
 * Class BookPluginInit
 * @package BookPluginInit
 */
class BookPluginInit extends Singleton
{
    /**
     * @var Container
     */
    private $application;

    /**
     * @var Custom Provider
     */
    private $custom_provider;

    /**
     * BookPluginInit constructor.
     */
    public function __construct()
    {
        $this->application = Application::get()->loadPlugin(__DIR__, __FILE__, 'config');
        $this->init();
    }

    public function init()
    {
        try {
            /**
             * Activation hooks
             */
            $this->application->onActivation(function () {
                $db_name = $this->application->config('db_name');

                global $wpdb;
                $table_name = $wpdb->prefix . $db_name;
                $charset_collate = $wpdb->get_charset_collate();

                $sql = "CREATE TABLE IF NOT EXISTS $table_name (
                    id mediumint(9) NOT NULL AUTO_INCREMENT,
                    post_id bigint(20) UNSIGNED NOT NULL,
                    isbn varchar(255) DEFAULT '' NOT NULL,
                    PRIMARY KEY  (id)
                ) $charset_collate;";

                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
                dbDelta($sql);
            });

            $this->application->boot(function ($plugin) {
                $plugin->loadPluginTextDomain();

                // include files
                $plugin->includes(__DIR__ . '/src'); // It should be changed in Rabbit Framework Docs
                $this->custom_provider = new ServiceProvider();

                $this->custom_provider->register(new Book());

                // Boot services
                $this->custom_provider->boot();
            });
        } catch (Exception $e) {
            /**
             * Print the exception message to admin notice area
             */
            add_action('admin_notices', function () use ($e) {
                AdminNotice::permanent(['type' => 'error', 'message' => $e->getMessage()]);
            });

            /**
             * Log the exception to file
             */
            add_action('init', function () use ($e) {
                if ($this->application->has('logger')) {
                    $this->application->get('logger')->warning($e->getMessage());
                }
            });
        }
    }


    /**
     * @return Container
     */
    public function getApplication()
    {
        return $this->application;
    }
}

/**
 * Returns the main instance of BookPluginInit.
 *
 * @return BookPluginInit
 */
function bookPlugin()
{
    return BookPluginInit::get();
}

bookPlugin();
