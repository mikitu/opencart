<?php
namespace App\Console\Command;
use Symfony\Component\Console\Command\Command;

class BaseCommand  extends Command
{
    protected $registry;

    protected $oc_loader;

    public function __get($key) {
        return $this->registry->get($key);
    }

    public function __set($key, $value) {
        $this->registry->set($key, $value);
    }

    public function __construct($name = null)
    {
        parent::__construct($name);
        // Registry
        $this->registry = new \Registry();
        // Loader
        $loader = new \Loader($this->registry);
        $this->registry->set('load', $loader);

        // Config
        $config = new \Config();
        $config->load('default');
        $config->load('catalog');
        $this->registry->set('config', $config);

        // Event
        $event = new \Event($this->registry);
        $this->registry->set('event', $event);

        // Database
        $db = new \DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        $this->registry->set('db', $db);
        $this->oc_loader = $loader;

    }
}