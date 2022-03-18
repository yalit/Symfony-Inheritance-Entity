<?php

declare(strict_types=1);

namespace App\Twig\Extensions;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class InstanceOfExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('instanceof', [$this, 'instanceOf'])
        ];
    }

    public function instanceOf(Object $object): string
    {
        if (!is_object($object)) {
            throw new \Exception(sprintf('The input of instanceof must be an object'));
        }

        return $object::class;
    }
}
