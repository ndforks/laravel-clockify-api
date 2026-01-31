<?php

namespace Sourceboat\LaravelClockifyApi\Repositories;

use Sourceboat\LaravelClockifyApi\Reports\ClockifyDetailedReport;
use Sourceboat\LaravelClockifyApi\Reports\ClockifySummaryReport;

class ClockifyRepository
{

    public static function makeSummaryReport(): ClockifySummaryReport
    {
        return ClockifySummaryReport::make();
    }

    public static function makeDetailedReport(): ClockifyDetailedReport
    {
        return ClockifyDetailedReport::make();
    }

}
