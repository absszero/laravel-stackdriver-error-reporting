<?php

use Absszero\MetadataProvider;
use PHPUnit\Framework\TestCase;

class MetadataProviderTest extends TestCase
{
    /** @test */
    public function testConstruct()
    {
        $projectId = 'project';
        $serviceId = 'service';
        $versionId = '1.0';
        $labels = [
            'label' => 'label'
        ];

        $provider = new MetadataProvider($projectId, $serviceId, $versionId, $labels);

        $this->assertEquals(['type' => MetadataProvider::RESOURCE_TYPE], $provider->monitoredResource());
        $this->assertEquals($projectId, $provider->projectId());
        $this->assertEquals($serviceId, $provider->serviceId());
        $this->assertEquals($versionId, $provider->versionId());
        $this->assertEquals($labels, $provider->labels());
    }
}
