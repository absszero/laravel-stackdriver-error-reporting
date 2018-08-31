<?php

namespace Absszero;

use Google\Cloud\Core\Report\MetadataProviderInterface;

class MetadataProvider implements MetadataProviderInterface
{
    const RESOURCE_TYPE = 'global';

    private $data;

    public function __construct($projectId, $serviceId, $versionId, $labels = [])
    {
        $this->data = [
            'resource' => [
                'type' => self::RESOURCE_TYPE,
            ],
            'projectId' => $projectId,
            'serviceId' => $serviceId,
            'versionId' => $versionId,
            'labels' => $labels
        ];
    }

    /**
     * Return an array representing MonitoredResource.
     * {@see https://cloud.google.com/logging/docs/reference/v2/rest/v2/MonitoredResource}
     *
     * @return array
     */
    public function monitoredResource()
    {
        return $this->data['resource'];
    }

    /**
     * Return the project id.
     * @return string
     */
    public function projectId()
    {
        return $this->data['projectId'];
    }

    /**
     * Return the service id.
     * @return string
     */
    public function serviceId()
    {
        return $this->data['serviceId'];
    }

    /**
     * Return the version id.
     * @return string
     */
    public function versionId()
    {
        return $this->data['versionId'];
    }

    /**
     * Return the labels. We need to evaluate $_SERVER for each request.
     * @return array
     */
    public function labels()
    {
        return $this->data['labels'];
    }
}
