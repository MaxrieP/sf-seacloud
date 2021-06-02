<?php


namespace App\Service;

use App\Entity\Server;

class NameGenerator
{
    public function generate(Server $server): void
    {
        $location = $server->getlocation()->getcode();

        $distribution = $server->getdistribution()->getcode();

        $random = rand(1, 500);

        $name = 'SC-'.$location. '-'. $distribution. '-' . $random;

        $server->setName($name);
    }
}