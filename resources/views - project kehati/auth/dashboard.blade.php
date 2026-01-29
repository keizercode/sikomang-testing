<?php
    $cardData = $dashboardData['cardData'];
    $tableData = $dashboardData['tableData'];
    $pieData = $dashboardData['pieData'];
    $barData = $dashboardData['barData'];
?>
@extends('layouts.master')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0 font-weight-bold">{{ @$title }}</h5>
        </div>

        <div class="card-body">
            <!-- Filter Tahun Inventory -->
            <div class="row justify-content-end mb-4">
                <div class="col-md-2">
                    <x-inventory-year-select :selected-year="$inventoryYear" />
                </div>
            </div>

            <!-- Cards -->
            <div class="row justify-content-center">
                <div class="col-lg-2 col-md-4 mb-4">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="card-title text-muted">Total Emisi</h6>
                            <p class="card-text" style="font-size: 20px;" id="totalEmisi">
                                {{ getFormattedValue(@$cardData['totalEmisi'], 2) }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-4">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="card-title text-muted">Emisi Sektor Energi</h6>
                            <p class="card-text" style="font-size: 20px;" id="emisiEnergi">
                                {{ getFormattedValue(@$cardData['emisiEnergi'], 2) }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-4">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="card-title text-muted">Emisi Sektor Pertanian</h6>
                            <p class="card-text" style="font-size: 20px;" id="emisiPertanian">
                                {{ getFormattedValue(@$cardData['emisiPertanian'], 2) }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-4">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="card-title text-muted">Emisi Sektor Lahan</h6>
                            <p class="card-text" style="font-size: 20px;" id="emisiLahan">
                                {{ getFormattedValue(@$cardData['emisiLahan'], 2) }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-4">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="card-title text-muted">Emisi Sektor Limbah</h6>
                            <p class="card-text" style="font-size: 20px;" id="emisiLimbah">
                                {{ getFormattedValue(@$cardData['emisiLimbah'], 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <br />

            <!-- Charts Row -->
            <div class="row mb-4">
                <!-- Bar Chart -->
                <div class="col-lg-6 mb-4">
                    <canvas id="barEmissionChart" height="160"></canvas>
                </div>

                <!-- Pie Chart -->
                <div class="col-lg-6 mb-4">
                    <canvas id="pieEmissionChart" height="80"></canvas>
                </div>
            </div>

            <!-- Emissions Table -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-info text-center">
                                <tr>
                                    <th style="width: 10px;"></th>
                                    <th class="align-middle">Emissions</th>
                                    <th width="120">CO<sub>2</sub> Eq<br>(Gg)</th>
                                    <th width="120">CO<sub>2</sub><br>(Gg)</th>
                                    <th width="120">CH<sub>4</sub><br>(Gg)</th>
                                    <th width="120">N<sub>2</sub>O<br>(Gg)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalCo2eq = 0;
                                    $totalCo2 = 0;
                                    $totalCh4 = 0;
                                    $totalN2o = 0;
                                    $no = 1;
                                @endphp
                                @if(@$tableData)
                                    @foreach ($tableData as $sector => $emissions)
                                        @php
                                            $totalCo2eq += $emissions['co2eq'];
                                            $totalCo2 += $emissions['co2'];
                                            $totalCh4 += $emissions['ch4'];
                                            $totalN2o += $emissions['n2o'];
                                        @endphp
                                        <tr class="text-right">
                                            <td class="text-left">{{ $no++ }}</td>
                                            <td class="text-left">{{ $sector }}</td>
                                            <td>{{ getFormattedValue($emissions['co2eq'], 2) }}</td>
                                            <td>{{ getFormattedValue($emissions['co2'], 2) }}</td>
                                            <td>{{ getFormattedValue($emissions['ch4'], 2) }}</td>
                                            <td>{{ getFormattedValue($emissions['n2o'], 2) }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                <tr class="text-right">
                                    <td class="text-left"></td>
                                    <td class="text-left"><strong>TOTAL</strong></td>
                                    <td><strong>{{ getFormattedValue($totalCo2eq, 2) }}</strong></td>
                                    <td><strong>{{ getFormattedValue($totalCo2, 2) }}</strong></td>
                                    <td><strong>{{ getFormattedValue($totalCh4, 2) }}</strong></td>
                                    <td><strong>{{ getFormattedValue($totalN2o, 2) }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script>
        $(document).ready(function() {
            $('#inventoryYear').select2({
                placeholder: 'Pilih Tahun',
                width: '100%'
            });

            $('#inventoryYear').on('change', function() {
                var selectedYear = $(this).val();
                window.location.href = '{{ url()->current() }}?year=' + selectedYear;
            });

            // Define color palette
            function getColor(index) {
                const colors = [
                    'rgba(255, 99, 132, 0.6)', // Red
                    'rgba(54, 162, 235, 0.6)', // Blue
                    'rgba(255, 206, 86, 0.6)', // Yellow
                    'rgba(75, 192, 192, 0.6)', // Green
                    'rgba(153, 102, 255, 0.6)', // Purple
                    'rgba(205, 159, 64, 0.6)', // Orange
                    'rgba(199, 199, 199, 0.6)', // Gray
                    'rgba(0, 255, 0, 0.6)', // Light Green
                    'rgba(83, 102, 120, 0.6)', // Dark Gray

                ];
                return colors[index % colors.length];
            }

            // Prepare data for the bar chart
            var emissionsByYear = @json(@$barData);

            var labels = emissionsByYear.map(function(e) {
                return e.year;
            });

            var data = {
                labels: labels,
                datasets: []
            };

            var yearTotalMap = {};
            emissionsByYear.forEach(function(yearData) {
                yearTotalMap[yearData.year] = yearData.total;
            });

            // Collecting sector keys (categories) for chart labels
            var sectorKeys = Object.keys(emissionsByYear[0].emisi);

            sectorKeys.forEach(function(key, index) {
                var sectorData = emissionsByYear.map(function(e) {
                    return e.emisi[key] || 0;
                });

                data.datasets.push({
                    label: key.charAt(0).toUpperCase() + key.slice(1),
                    data: sectorData,
                    backgroundColor: getColor(index),
                    borderColor: getColor(index).replace('0.6', '1'),
                    borderWidth: 1
                });
            });

            var ctx = document.getElementById('barEmissionChart').getContext('2d');
            var barChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    scales: {
                        x: {
                            stacked: true,
                        },
                        y: {
                            stacked: true,
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                title: function(tooltipItems) {
                                    // Use the first tooltip item to get the year
                                    return 'Year: ' + tooltipItems[0].label;
                                },
                                label: function(context) {
                                    var label = context.dataset.label || '';
                                    var value = context.raw.toFixed(2);
                                    var year = labels[context.dataIndex];
                                    var total = yearTotalMap[year].toFixed(2);

                                    return [
                                        label + ': ' + value + ' Gg CO2',
                                        'Total: ' + total + ' Gg CO2'
                                    ];
                                }
                            }
                        },
                        legend: {
                            position: 'top',
                            align: 'start',
                            usePointStyle: true,
                            labels: {
                                boxWidth: 20,
                            },
                        },

                    },
                    responsive: true,
                    layout: {
                        padding: {
                            left: 40 // Adjust this value to create space above the chart to avoid overlap with y-axis labels
                        }
                    },
                    // maintainAspectRatio: false
                }
            });

            var pieEmissions = @json(@$pieData);

            var pieData = {
                labels: Object.keys(pieEmissions),
                datasets: [{
                    data: Object.values(pieEmissions),
                    backgroundColor: Object.keys(pieEmissions).map((_, index) => getColor(index)),
                    borderColor: Object.keys(pieEmissions).map((_, index) => getColor(index).replace(
                        '0.6', '1')),
                    borderWidth: 1
                }]
            };

            var pieCtx = document.getElementById('pieEmissionChart').getContext('2d');
            var pieChart = new Chart(pieCtx, {
                type: 'doughnut',
                data: pieData,
                // plugins: [ChartDataLabels],
                options: {
                    plugins: {
                        // datalabels: {
                        //     formatter: (value, context) => {
                        //         var total = context.chart.data.datasets[0].data.reduce((acc, cur) =>
                        //             acc + cur, 0);
                        //         var percentage = ((value / total) * 100).toFixed(2) + '%';
                        //         return percentage;
                        //     },
                        //     color: '#000', // Set the text color
                        //     font: {
                        //         weight: 'bold',
                        //         size: 10
                        //     },
                        //     anchor: 'center', // Position the label in the center of the slice
                        //     align: 'center' // Align the label to the middle of the slice
                        // },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    var label = context.label || '';
                                    var value = context.raw.toFixed(2);
                                    var total = Object.values(pieEmissions).reduce((acc, cur) => acc +
                                        cur, 0).toFixed(2);
                                    var percentage = ((context.raw / total) * 100).toFixed(2);

                                    return [
                                        label + ': ' + value + ' Gg CO2 (' + percentage + '%)',
                                        'Total: ' + total + ' Gg CO2'
                                    ];
                                }
                            }
                        },
                        legend: {
                            position: 'right',
                            labels: {
                                boxWidth: 20,
                                usePointStyle: true,
                            }
                        }
                    },
                    layout: {
                        padding: {
                            right: 40 // Adjust this value to create space above the chart to avoid overlap with y-axis labels
                        }
                    },
                    cutout: '50%',
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        });
    </script>
@endsection
