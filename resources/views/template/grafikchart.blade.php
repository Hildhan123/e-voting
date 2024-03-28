 <!-- Link Grafik Chrat-->
 <script src="https://code.highcharts.com/highcharts.js"></script>

 <script>
            Highcharts.chart('chartElection', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Total Election'
        },
        xAxis: {
            categories: [
                'Laki-Laki',
                'Perempuan',
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Status',
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
            categories: [
                'FTIK',
                'FH',
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Jenis Kelamin',
        }]
        });
        </script>
        <script>
            Highcharts.chart('chartVote', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Total Vote'
        },
        xAxis: {
            categories: [
                '1 SKS',
                '2 SKS',
                '3 SKS',
                '4 SKS',
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Jenis Kelamin',
        }]
    });
        </script>