function getChartColorsArray(e) {
    if (null !== document.getElementById(e)) {
        var t = document.getElementById(e).getAttribute("data-colors");
        if (t) return (t = JSON.parse(t)).map(function (e) {
            var t = e.replace(" ", "");
            return -1 === t.indexOf(",") ? getComputedStyle(document.documentElement).getPropertyValue(t) || t : 2 == (e = e.split(",")).length ? "rgba(" + getComputedStyle(document.documentElement).getPropertyValue(e[0]) + "," + e[1] + ")" : t
        });
        console.warn("data-colors Attribute not found on:", e)
    }
}

var options, chart, donutchartportfolioColors = getChartColorsArray("portfolio_donut_charts"),
    MarketchartColors = (donutchartportfolioColors && (options = {
        series: [12, 4],
        labels: ["ggg", "fff", "Litecoin"],
        chart: {type: "donut", height: 224},
        plotOptions: {
            pie: {
                size: 100,
                offsetX: 0,
                offsetY: 0,
                donut: {
                    size: "86%",
                    labels: {
                        show: !0,
                        name: {show: !0, fontSize: "18px", offsetY: -5},
                        value: {
                            show: !0,
                            fontSize: "20px",
                            color: "#343a40",
                            fontWeight: 500,
                            offsetY: 5,
                            formatter: function (e) {
                                return "$" + e
                            }
                        },
                        total: {
                            show: !0,
                            fontSize: "13px",
                            label: "Correct",
                            color: "#9599ad",
                            fontWeight: 500,
                            formatter: function (e) {
                                return "$" + e.globals.seriesTotals.reduce(function (e, t) {
                                    // return e + t
                                    return '10';
                                }, 0)
                            }
                        }
                    }
                }
            }
        },
        dataLabels: {enabled: !1},
        legend: {show: !1},
        yaxis: {
            labels: {
                formatter: function (e) {
                    return "$" + e
                }
            }
        },
        stroke: {lineCap: "round", width: 2},
        colors: donutchartportfolioColors
    }, (chart = new ApexCharts(document.querySelector("#qbank_charts"), options)).render()), getChartColorsArray("Market_chart")),
    areachartbitcoinColors = (MarketchartColors && (options = {
            series: [{
                data: []
            }],
            chart: {type: "candlestick", height: 294, toolbar: {show: !1}},
            plotOptions: {candlestick: {colors: {upward: MarketchartColors[0], downward: MarketchartColors[1]}}},
            xaxis: {type: "datetime"},
            yaxis: {

            },

        }
    ));


    var options, chart, donutchartportfolioColors = getChartColorsArray("portfolio_donut_charts"),
    MarketchartColors = (donutchartportfolioColors && (options = {
        series: [12, 4],
        labels: ["Bitcoin2", "Ethereum2", "Litecoin2S"],
        chart: {type: "donut", height: 224},
        plotOptions: {
            pie: {
                size: 100,
                offsetX: 0,
                offsetY: 0,
                donut: {
                    size: "86%",
                    labels: {
                        show: !0,
                        name: {show: !0, fontSize: "18px", offsetY: -5},
                        value: {
                            show: !0,
                            fontSize: "20px",
                            color: "#343a40",
                            fontWeight: 500,
                            offsetY: 5,
                            formatter: function (e) {
                                return "$" + e
                            }
                        },
                        total: {
                            show: !0,
                            fontSize: "13px",
                            label: "Correct",
                            color: "#9599ad",
                            fontWeight: 500,
                            formatter: function (e) {
                                return "$" + e.globals.seriesTotals.reduce(function (e, t) {
                                    // return e + t
                                    return '10';
                                }, 0)
                            }
                        }
                    }
                }
            }
        },
        dataLabels: {enabled: !1},
        legend: {show: !1},
        yaxis: {
            labels: {
                formatter: function (e) {
                    return "$" + e
                }
            }
        },
        stroke: {lineCap: "round", width: 2},
        colors: donutchartportfolioColors
    }, (chart = new ApexCharts(document.querySelector("#qbank_charts2"), options)).render()), getChartColorsArray("Market_chart")),
    areachartbitcoinColors = (MarketchartColors && (options = {
            series: [{
                data: []
            }],
            chart: {type: "candlestick", height: 294, toolbar: {show: !1}},
            plotOptions: {candlestick: {colors: {upward: MarketchartColors[0], downward: MarketchartColors[1]}}},
            xaxis: {type: "datetime"},
            yaxis: {

            },

        }
    ));
