<?php

declare(strict_types=1);

use ShipMonk\ComposerDependencyAnalyser\Config\Configuration;

return (new Configuration())
    ->ignoreErrorsOnPackages([
        'thecodingmachine/safe',
    ], ['unused-dependency']);
