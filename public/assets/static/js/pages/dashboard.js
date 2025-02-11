var areaOptions = {
    series: [
        {
            name: "Penjualan",
            data: [],
        },
    ],
    chart: {
        height: 250,
        type: "area",
        events: {
            mounted: function (chartContext, config) {
                fetch("/chart-data")
                    .then((response) => response.json())
                    .then((data) => {
                        chartContext.updateSeries([
                            {
                                name: "Penjualan",
                                data: data.map((item) => item.total),
                            },
                        ]);
                        chartContext.updateOptions({
                            xaxis: {
                                categories: data.map((item) => item.month),
                            },
                        });
                    });
            },
        },
    },
    dataLabels: {
        enabled: false,
    },
    stroke: {
        curve: "smooth",
    },
    xaxis: {
        type: "string",
        categories: [],
    },
    tooltip: {
        x: {
            formatter: function (val) {
                return val;
            },
        },
    },
};

let optionsGalonYangDiantar = {
    series: [],
    labels: ["Ya", "Tidak"],
    colors: ["#435ebe", "#55c6e8"],
    chart: {
        type: "donut",
        width: "100%",
        height: "350px",
        events: {
            mounted: function (chartContext, config) {
                fetch("/galon-antar-data")
                    .then((response) => response.json())
                    .then((data) => {
                        chartContext.updateSeries([data.ya, data.tidak]);
                    });
            },
        },
    },
    legend: {
        position: "bottom",
    },
    plotOptions: {
        pie: {
            donut: {
                size: "30%",
            },
        },
    },
};

var chartTransaksiGalonAntar = new ApexCharts(
    document.getElementById("pengantaran-galon"),
    optionsGalonYangDiantar
);
var area = new ApexCharts(document.querySelector("#area"), areaOptions);

area.render();
chartTransaksiGalonAntar.render();
