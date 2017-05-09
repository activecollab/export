<?php

/*
 * This file is part of the Active Collab Export project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\Exporter;

use ActiveCollab\Exporter\Exporter\ExporterInterface;
use Doctrine\Common\Inflector\Inflector;
use Exception;

class ExporterFactory implements ExporterFactoryInterface
{
    const EXPORTER_NAMESPACE = 'ActiveCollab\\Exporter\\Exporter';

    public function getExporterFor(string $type, string $format): ExporterInterface
    {
        $class_name = $this->getExporterClassName($type, $format);

        if (class_exists($class_name)) {
            return new $class_name;
        } else {
            throw new Exception("Exporter doesn't exists for type '{$type}' and format '{$format}'.");
        }
    }

    private function getExporterClassName(string $type, string $format)
    {
        return implode(
            '\\',
            [
                self::EXPORTER_NAMESPACE,
                Inflector::classify($type),
                Inflector::classify("{$format}_{$type}_exporter"),
            ]
        );
    }
}
