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
                borderColor: "#2563eb",
                backgroundColor: "#2563eb",
                showLine: true,
                fill: false,

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
                    position: "top"
                },
                tooltip: {
                    mode: "nearest",
                    intersect: false
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
                        font: {
                            size: 14,
                            weight: "bold"
                        }
                    },

                    grid: {
                        display: true
                    },

                    ticks: {
                        autoSkip: true,
                        maxRotation: 0
                    }
                },

                y: {
                    type: "linear",

                    title: {
                        display: true,
                        text: yLabel,
                        font: {
                            size: 14,
                            weight: "bold"
                        }
                    },

                    grid: {
                        display: true
                    },

                    ticks: {
                        autoSkip: true
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
