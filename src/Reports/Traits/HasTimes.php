<?php

namespace Sourceboat\LaravelClockifyApi\Reports\Traits;

use Carbon\Carbon;

trait HasTimes
{

    protected Carbon $dateRangeStart;

    protected Carbon $dateRangeEnd;

    public function from(Carbon $fromDate): self
    {
        $this->dateRangeStart = $fromDate;
        return $this;
    }

    public function to(Carbon $endDate): self
    {
        $this->dateRangeEnd = $endDate;
        return $this;
    }

}
