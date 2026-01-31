<?php

namespace Sourceboat\LaravelClockifyApi\Reports;

class ClockifySummaryReport extends ClockifyReport
{

    protected string $reportEndpoint = '/summary';

    private array $filterGroups = [
        'USER',
        'PROJECT',
        'TIMEENTRY',
    ];

    public function get(): mixed
    {
        return json_decode($this->executeApiCall()->body());
    }

    protected function requestData(): array
    {
        return $this->filter((array) [
            'dateRangeStart' => $this->dateRangeStart,
            'dateRangeEnd' => $this->dateRangeEnd,
            'summaryFilter' => [
                'groups' => $this->filterGroups,
            ],
            $this->mergeWhen($this->sortOrder !== '', [
                'sortOrder' => $this->sortOrder,
            ]),
            $this->mergeWhen(!is_null($this->userIds), [
                'users' => [
                    'ids' => $this->userIds,
                    'contains' => 'CONTAINS',
                    'status' => 'ALL',
                ],
            ]),
            $this->mergeWhen(!is_null($this->tagIds), [
                'tags' => [
                    'ids' => $this->tagIds,
                    'containedInTimeentry' => $this->tagsContainedInTimeentry,
                    'status' => 'ALL',
                ],
            ]),
            $this->mergeWhen(!is_null($this->taskIds), [
                'tasks' => [
                    'ids' => $this->taskIds,
                    'status' => 'ALL',
                ],
            ]),
        ]);
    }

    public function filterGroups(array $filterGroups): self
    {
        $this->filterGroups = $filterGroups;
        return $this;
    }

    public static function make(): static
    {
        return new static;
    }

}
