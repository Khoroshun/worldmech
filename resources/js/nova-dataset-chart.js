console.log('nova-dataset-chart.js loaded');

function initDatasetChart() {

    const canvas = document.getElementById("datasetChart");

    if (!canvas) return;

    // Nova может сначала отрисовать canvas без data-chart
    if (!canvas.dataset.chart) return;

    // чтобы график не создавался повторно
    if (canvas.dataset.chartInitialized) return;

    canvas.dataset.chartInitialized = "1";

    const chartData = JSON.parse(canvas.dataset.chart);

    const points = chartData.points || [];

    const xLabel = chartData.x_unit
        ? `${chartData.x_label} (${chartData.x_unit})`
        : chartData.x_label;

    const yLabel = chartData.y_unit
        ? `${chartData.y_label} (${chartData.y_unit})`
        : chartData.y_label;

    const scaleType = chartData.scale_type === 'log' ? 'logarithmic' : 'linear';

    const ctx = canvas.getContext("2d");
    const datasetPoints = points.map(p => ({
        x: p.x_value,
        y: p.y_value
    }));
    new Chart(ctx, {
        type: "scatter",
        data: {
            datasets: [{
                label: chartData.y_label,
                data: datasetPoints,

                borderColor: "#0ea5e9",
                backgroundColor: "#0ea5e9",

                showLine: true,
                fill: false,

                borderWidth: 2,

                pointRadius: 4,
                pointBackgroundColor: "#0ea5e9",

                cubicInterpolationMode: "monotone",
                tension: 0.35
            }]
        },
        options: {

            responsive: true,
            maintainAspectRatio: false,

            layout: {
                padding: {
                    left: 30,
                    right: 20,
                    top: 10,
                    bottom: 30
                }
            },

            plugins: {
                legend: {
                    display: true,
                    position: "top",
                    labels: {
                        color: "#000",
                        font: {
                            size: 16,
                            weight: "bold"
                        }
                    }
                },
                tooltip: {
                    mode: "nearest",
                    intersect: false,
                    titleFont: {
                        size: 14,
                        weight: "bold"
                    },
                    bodyFont: {
                        size: 13
                    }
                }
            },

            interaction: {
                mode: "nearest",
                intersect: false
            },

            scales: {

                x: {
                    type: scaleType,
                    position: "bottom",

                    title: {
                        display: true,
                        text: xLabel,
                        color: "#000",
                        font: {
                            size: 24,
                            weight: "bold"
                        }
                    },

                    grid: {
                        display: true,
                        color: "#000",
                        lineWidth: 0.5
                    },

                    ticks: {
                        autoSkip: true,
                        maxRotation: 0,
                        color: "#000",
                        font: {
                            size: 18,
                            weight: "bold"
                        }
                    }
                },

                y: {
                    type: scaleType,

                    title: {
                        display: true,
                        text: yLabel,
                        color: "#000",
                        font: {
                            size: 18,
                            weight: "bold"
                        }
                    },

                    grid: {
                        display: true,
                        color: "#000",
                        lineWidth: 0.5
                    },

                    ticks: {
                        autoSkip: true,
                        color: "#000",
                        font: {
                            size: 18,
                            weight: "bold"
                        }
                    }
                }

            }
        }
    });

    console.log("Dataset chart built");
    console.log(Chart.version)

}

// Nova SPA → ждём появления canvas и данных
setInterval(initDatasetChart, 400);
