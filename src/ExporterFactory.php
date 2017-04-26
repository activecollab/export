<?php
/*
 * This file is part of the Shepherd Jobs project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\Exporter;

use ActiveCollab\Exporter\Exporters\ExporterInterface;
use Doctrine\Common\Inflector\Inflector;
use Exception;

/**
 * @package ActiveCollab\Exporter
 */

class ExporterFactory implements ExporterFactoryInterface
{
    const EXPORTER_NAMESPACE = 'ActiveCollab\\Exporter\\Exporters\\';

    /**
     * Get exporter for.
     *
     * @param string $type
     * @param string $format
     * @return ExporterInterface
     * @throws Exception
     */
    public function getExporterFor(string $type, string $format): ExporterInterface
    {
        $class_name = self::EXPORTER_NAMESPACE . Inflector::classify("{$format}_{$type}_exporter");

        if (class_exists($class_name)) {
            return new $class_name;
        } else {
            throw new Exception("Exporter doesn't exists for type:{$type} and formant:{$format}");
        }
    }
}