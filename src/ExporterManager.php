<?php

/*
 * This file is part of the Export project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\Exporter;

/**
 * @package ActiveCollab\Exporter
 */
class ExporterManager implements ExporterManagerInterface
{

    /**
     * @var ExporterFactoryInterface $exporter_factory
     */
    private $exporter_factory;

    /**
     * ExporterManager constructor.
     * @param ExporterFactoryInterface $exporter_factory
     */
    public function __construct(ExporterFactoryInterface $exporter_factory)
    {
        $this->exporter_factory = $exporter_factory;
    }

    /**
     * Get export.
     *
     * @param  ExportableInterface $object
     * @param  string              $type
     * @param  string              $format
     * @return string
     */
    public function export(ExportableInterface $object, string $type, string $format): string
    {
        $exporter = $this->exporter_factory->getExporterFor($type, $format);

        return $exporter->export($object, $object->getExportPath($format));
    }
}
