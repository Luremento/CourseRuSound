@extends('layouts.app')
@section('title')
    ruSound - Статистика
@endsection

@section('content')
    <div class="card border rounded-xl mb-4">
        <div class="grid grid-cols-1 gap-8 p-5 lg:grid-cols-2 xl:grid-cols-4">
            <div>
                <h2 class="px-5 pt-3 font-bold">Пользователи</h2>
                <div class="mx-5 mb-3 max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                    <div class="flex justify-between">
                        <div>
                            <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">
                                {{ $users_lastMonth }}
                            </h5>
                            <p class="text-base font-normal text-gray-500 dark:text-gray-400">Пользователей за последний
                                месяц
                            </p>
                        </div>
                        <div
                            class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-center">
                            {{ round($percentage_change, 2) }}%
                            <svg class="w-3 h-3 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 10 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 13V1m0 0L1 5m4-4 4 4" />
                            </svg>
                        </div>
                    </div>
                    <div id="area-chart"></div>
                    <div
                        class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                        <div class="flex justify-between items-center pt-5">
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <h2 class="px-5 pt-3 font-bold">Треки</h2>
                <div class="mx-5 mb-3 max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                    <div class="flex justify-between">
                        <div>
                            <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">
                                {{ $tracks_lastMonth }}
                            </h5>
                            <p class="text-base font-normal text-gray-500 dark:text-gray-400">Новых треков за последний
                                месяц
                            </p>
                        </div>
                        <div
                            class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-center">
                            {{ round($tracks_percentage_change, 2) }}%
                            <svg class="w-3 h-3 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 10 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 13V1m0 0L1 5m4-4 4 4" />
                            </svg>
                        </div>
                    </div>
                    <div id="track-chart"></div>
                    <div
                        class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                        <div class="flex justify-between items-center pt-5">
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <h2 class="px-5 pt-3 font-bold">Альбомы</h2>
                <div class="mx-5 mb-3 max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                    <div class="flex justify-between">
                        <div>
                            <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">
                                {{ $albums_lastMonth }}
                            </h5>
                            <p class="text-base font-normal text-gray-500 dark:text-gray-400">Новых альбомов за последний
                                месяц
                            </p>
                        </div>
                        <div
                            class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-center">
                            {{ round($albums_percentage_change, 2) }}%
                            <svg class="w-3 h-3 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 10 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 13V1m0 0L1 5m4-4 4 4" />
                            </svg>
                        </div>
                    </div>
                    <div id="album-chart"></div>
                    <div
                        class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                        <div class="flex justify-between items-center pt-5">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        const userData = @json($userData);
        const trackData = @json($trackData);
        const albumData = @json($albumData);

        const options = {
            chart: {
                height: "100%",
                maxWidth: "100%",
                type: "area",
                fontFamily: "Inter, sans-serif",
                dropShadow: {
                    enabled: false,
                },
                toolbar: {
                    show: false,
                },
            },
            tooltip: {
                enabled: true,
                x: {
                    show: false,
                },
            },
            fill: {
                type: "gradient",
                gradient: {
                    opacityFrom: 0.55,
                    opacityTo: 0,
                    shade: "#1C64F2",
                    gradientToColors: ["#1C64F2"],
                },
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                width: 6,
            },
            grid: {
                show: false,
                strokeDashArray: 4,
                padding: {
                    left: 2,
                    right: 2,
                    top: 0
                },
            },
            series: [{
                name: "Новых пользователей",
                data: userData.map(item => item.count),
                color: "#1A56DB",
            }],
            xaxis: {
                categories: userData.map(item => item.date),
                labels: {
                    show: false,
                },
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                },
            },
            yaxis: {
                show: false,
            },
        }

        const trackOptions = {
            chart: {
                height: "100%",
                maxWidth: "100%",
                type: "area",
                fontFamily: "Inter, sans-serif",
                dropShadow: {
                    enabled: false,
                },
                toolbar: {
                    show: false,
                },
            },
            tooltip: {
                enabled: true,
                x: {
                    show: false,
                },
            },
            fill: {
                type: "gradient",
                gradient: {
                    opacityFrom: 0.55,
                    opacityTo: 0,
                    shade: "#1C64F2",
                    gradientToColors: ["#1C64F2"],
                },
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                width: 6,
            },
            grid: {
                show: false,
                strokeDashArray: 4,
                padding: {
                    left: 2,
                    right: 2,
                    top: 0
                },
            },
            series: [{
                name: "Новых треков",
                data: trackData.map(item => item.count),
                color: "#1A56DB",
            }],
            xaxis: {
                categories: trackData.map(item => item.date),
                labels: {
                    show: false,
                },
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                },
            },
            yaxis: {
                show: false,
            },
        }

        const albumOptions = {
            chart: {
                height: "100%",
                maxWidth: "100%",
                type: "area",
                fontFamily: "Inter, sans-serif",
                dropShadow: {
                    enabled: false,
                },
                toolbar: {
                    show: false,
                },
            },
            tooltip: {
                enabled: true,
                x: {
                    show: false,
                },
            },
            fill: {
                type: "gradient",
                gradient: {
                    opacityFrom: 0.55,
                    opacityTo: 0,
                    shade: "#1C64F2",
                    gradientToColors: ["#1C64F2"],
                },
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                width: 6,
            },
            grid: {
                show: false,
                strokeDashArray: 4,
                padding: {
                    left: 2,
                    right: 2,
                    top: 0
                },
            },
            series: [{
                name: "Новых альбомов",
                data: albumData.map(item => item.count),
                color: "#1A56DB",
            }],
            xaxis: {
                categories: albumData.map(item => item.date),
                labels: {
                    show: false,
                },
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                },
            },
            yaxis: {
                show: false,
            },
        }

        if (document.getElementById("area-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("area-chart"), options);
            chart.render();
        }

        if (document.getElementById("track-chart") && typeof ApexCharts !== 'undefined') {
            const trackChart = new ApexCharts(document.getElementById("track-chart"), trackOptions);
            trackChart.render();
        }

        if (document.getElementById("album-chart") && typeof ApexCharts !== 'undefined') {
            const albumChart = new ApexCharts(document.getElementById("album-chart"), albumOptions);
            albumChart.render();
        }
    </script>
@endsection
