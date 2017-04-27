<?php

/*
 * This file is part of the Active Collab Export project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\Exporter;

class ExportManager implements ExportManagerInterface
{
    private $exporter_factory;

    public function __construct(ExporterFactoryInterface $exporter_factory)
    {
        $this->exporter_factory = $exporter_factory;
    }

    public function export(ExportableInterface $object, string $type, string $format): string
    {
        $exporter = $this->exporter_factory->getExporterFor($type, $format);

        return $exporter->export($object, $object->getExportPath($format));
    }
}
