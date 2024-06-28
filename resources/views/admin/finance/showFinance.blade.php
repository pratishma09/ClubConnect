@extends('layout.admin')

@section('content')
<div class="relative overflow-x-auto shadow-md">
    <h1 class="text-xl font-semibold text-gray-900 m-5">Finance Details - Total Budget Spent by Event</h1>

    <div id="google-chart" class="m-5" style="height: 400px;"></div>

    <table class="w-full text-sm text-left mt-10 rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Event Name</th>
                <th scope="col" class="px-6 py-3">Total Amount Spent</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sortedEvents as $event)
            <tr class="bg-white dark:border-gray-700">
                <td class="px-6 py-4">{{ $event['event'] }}</td>
                <td class="px-6 py-4">{{ $event['total_spent'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Event Name');
        data.addColumn('number', 'Total Amount Spent');

        var chartData = [
            @foreach ($sortedEvents as $event)
                ['{{ $event['event'] }}', {{ $event['total_spent'] }}],
            @endforeach
        ];

        data.addRows(chartData);

        var options = {
            title: 'Total Budget Spent by Event',
            curveType: 'function',
            legend: { position: 'bottom' },
            chartArea: {width: '70%', height: '70%'},
            hAxis: {
                title: 'Event Name',
            },
            vAxis: {
                title: 'Total Amount Spent',
                minValue: 0,
            },
            colors: ['#800080']
        };

        var chart = new google.visualization.LineChart(document.getElementById('google-chart'));
        chart.draw(data, options);
    }
</script>

@endsection
