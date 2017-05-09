<?php

/*
 * This file is part of the Active Collab Export project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\ShepherdJobsConsumer\Test;

use ActiveCollab\Exporter\ExportAsTableInterface;
use ActiveCollab\Exporter\ExporterFactory;
use ActiveCollab\Exporter\Exporters\CsvExporterInterface;
use ActiveCollab\Exporter\Exporters\Table\CsvTableExporterInterface;
use ActiveCollab\Exporter\Exporters\Table\XlsxTableExporterInterface;
use ActiveCollab\Exporter\Exporters\XlsxExporterInterface;
use ActiveCollab\Exporter\Test\TestCase;

final class ExporterFactoryTest extends TestCase
{
    /**
     * @dataProvider provideDataForFactoryTest
     * @param string $type
     * @param string $format
     * @param string $expected_instance_of
     */
    public function testFactoryReturnsExporterForTypeAndFormat(
        string $type,
        string $format,
        string $expected_instance_of
    )
    {
        $this->assertInstanceOf(
            $expected_instance_of,
            (new ExporterFactory())->getExporterFor($type, $format)
        );
    }

    public function provideDataForFactoryTest(): array
    {
        return [
            [
                ExportAsTableInterface::EXPORT_TYPE,
                CsvExporterInterface::EXPORT_FORMAT,
                CsvTableExporterInterface::class,
            ],
            [
                ExportAsTableInterface::EXPORT_TYPE,
                XlsxExporterInterface::EXPORT_FORMAT,
                XlsxTableExporterInterface::class,
            ],
        ];
    }
}
