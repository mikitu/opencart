<?php
namespace App\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DemoCommand extends BaseCommand
{

    protected function configure()
    {
        $this
            ->setName('demo:demo')
            ->setDescription('Demo load model')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->oc_loader->model('setting/setting');
        $settings = $this->model_setting_setting->getSetting('config');
        foreach($settings as $key => $val) {
            $output->writeln($key . ' => ' . $val);
        }
    }
}