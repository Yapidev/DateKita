<div>
    <div class="card">
        <div class="card-body">
            <div class="mb-2">
                <h5>Grafik Pengeluaran</h5>
            </div>
            <div class="chart-spline">
                <div id="myChart"></div>
            </div>
        </div>
    </div>

    @script
        <script>
            $(function() {
                var options = {
                    series: [{
                        name: 'Pengeluaran',
                        data: @json(array_values($monthlyExpenses))
                    }],
                    chart: {
                        fontFamily: "DM Sans, sans-serif",
                        height: 350,
                        type: "area",
                        toolbar: {
                            show: false,
                        },
                    },
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov',
                            'Des'
                        ],
                    },
                    yaxis: {
                        title: {
                            text: 'Pengeluaran'
                        },
                        labels: {
                            formatter: function(value) {
                                return 'Rp. ' + value.toLocaleString('id-ID');
                            }
                        }
                    },
                    colors: ["#615dff"],
                    tooltip: {
                        theme: "dark",
                    },
                };

                var chart = new ApexCharts(document.querySelector("#myChart"), options);
                chart.render();
            });
        </script>
    @endscript
</div>
