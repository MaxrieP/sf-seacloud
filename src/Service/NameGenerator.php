<?php


namespace App\Service;

use App\Entity\Server;
use App\Entity\DataCenter;
use Symfony\Component\String\UnicodeString;

class NameGenerator
{
    public function generate(Server $server): void
    {
        $location->server->getlocation();
        $datacode->datacenter->getcode();

        $distribution->server->getdistribution();
        $distribcode->distribution->getcode();

        $string = 'SC-'$datacode-$distribcode-$server->getid();

        $string = new UnicodeString($string);			//permet d'enlever les accents

        $slug = (string) $string->snake()->replace('_', '-');

        $server->setSlug($slug);
    }
}