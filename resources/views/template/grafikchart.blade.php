<div id="chartElection"></div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    Highcharts.chart('chartElection', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Total Election'
        },
        xAxis: {
            categories: [
                @foreach($monthlyElections as $month => $total)
                    '{{ date("F", mktime(0, 0, 0, $month, 1)) }}',
                @endforeach
            ]
        },
        yAxis: {
            title: {
                text: 'Total Election'
            }
        },
        series: [{
            name: 'Total Election',
            data: [
                @foreach($monthlyElections as $month => $total)
                    {{ $total }},
                @endforeach
            ]
        }]
    });
</script>

        <script>
            Highcharts.chart('chartCandidate', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Total Candidate'
        },
        xAxis: {
            categories: ['Male', 'Female']
        },
        yAxis: {
            title: {
                text: 'Total Candidates'
            }
        },
        series: [{
            name: 'Candidates',
            data: [{{ $maleCount }}, {{ $femaleCount }}]
        }]
    });
        </script>
        <script>
            Highcharts.chart('chartVote', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'Total Votes by Days'
                },
                xAxis: {
                    categories: [
                        @foreach($daysArray as $day)
                            '{{ str_pad($day, 2, '0', STR_PAD_LEFT) }}',
                        @endforeach
                    ]
                },
                yAxis: {
                    title: {
                        text: 'Total Votes'
                    }
                },
                series: [{
                    name: 'Total Votes',
                    data: [
                        @foreach($daysArray as $day)
                            {{ $monthlyVotes[$day] ?? 0 }}, // Total vote untuk setiap tanggal, jika tidak ada data, gunakan 0
                        @endforeach
                    ]
                }]
            });
        </script>