<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class FinanceChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->type('pie');
        $this->labels([]);
        $this->dataset('Budget Spent by Club', 'pie', []);
    }
}
