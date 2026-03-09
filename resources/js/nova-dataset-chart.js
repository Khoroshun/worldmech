function initChart() {

    const canvas = document.getElementById("datasetChart");

    if (!canvas) return;

    if (canvas.dataset.chartInitialized) return;

    canvas.dataset.chartInitialized = "1";

    const points = JSON.parse(canvas.dataset.points);

    const labels = points.map(p => p.x_value);
    const values = points.map(p => p.y_value);

    const ctx = canvas.getContext("2d");

    new Chart(ctx, {
        type: "line",
        data: {
            labels: labels,
            datasets: [{
                label: "Dataset",
                data: values,
                borderColor: "#2563eb",
                fill: false
            }]
        }
    });

}

setInterval(initChart, 500);
