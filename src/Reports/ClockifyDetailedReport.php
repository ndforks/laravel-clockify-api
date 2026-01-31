<?php

namespace Sourceboat\LaravelClockifyApi\Reports;

class ClockifyDetailedReport extends ClockifyReport
{

    protected string $reportEndpoint = '/detailed';

    private int $page = 1;

    private int $pageSize = 50;

    public function get(): mixed
    {
        return json_decode($this->executeApiCall()->body());
    }

    public function page(int $page): self
    {
        if ($page < 1) {
            throw new \InvalidArgumentException('Parameter $page must be greater than or equal to 1.');
        }
        $this->page = $page;
        return $this;
    }

    public function pageSize(int $pageSize): self
    {
        if ($pageSize < 1 || $pageSize > 250) {
            throw new \InvalidArgumentException('Parameter $pageSize must be between 1 and 250.');
        }
        $this->pageSize = $pageSize;
        return $this;
    }

    protected function requestData(): array
    {
        return $this->filter((array) [
            'dateRangeStart' => $this->dateRangeStart,
            'dateRangeEnd' => $this->dateRangeEnd,
            'detailedFilter' => [
                'page' => $this->page,
                'pageSize' => $this->pageSize,
                'sortColumn' => 'DATE',
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

    public static function make(): static
    {
        return new static;
    }

}
