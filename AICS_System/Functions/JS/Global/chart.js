import { getCSSVar } from "./root.js";

let myChartInstance = null;

export function getChartContainer(chartContainerId) {
  const canvasElement = document.getElementById(chartContainerId);
  if (canvasElement) {
    return canvasElement.getContext("2d");
  } else {
    console.error(`Chart container with ID '${chartContainerId}' not found.`);
    return null;
  }
}

export function chart(canvasContext) {
  if (myChartInstance) {
    myChartInstance.destroy();
  }

  myChartInstance = new Chart(canvasContext, {
    data: {
      labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
      datasets: [
        {
          type: "bar",
          label: "Amount-B",
          data: [12, 19, 11, 26, 30, 45, 38, 40, 42, 44, 48, 50],
          borderColor: getCSSVar("--sfont"),
          backgroundColor: getCSSVar("--tbg"),
          borderWidth: 0,
          order: 1,
          barThickness: 6,
        },
        {
          type: "line",
          label: "Amount-L",
          data: [12, 19, 11, 26, 30, 45, 38, 40, 42, 44, 48, 50],
          borderColor: getCSSVar("--sfont"),
          backgroundColor: getCSSVar("--sfont"),
          tension: 0.4,
          pointRadius: 6,
          pointHoverRadius: 8,
          pointBorderWidth: 2,
          pointBackgroundColor: getCSSVar("--bg"),
          pointBorderColor: getCSSVar("--font"),
          order: 2,
        },
      ],
    },
    type: "bar",
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          labels: {
            color: getCSSVar("--font"),
          },
        },
        tooltip: {
          backgroundColor: getCSSVar("--sbg"),
          titleColor: getCSSVar("--sfont"),
          bodyColor: getCSSVar("--obg"),
        },
      },
      scales: {
        x: {
          title: {
            display: true,
            text: "Month",
            color: getCSSVar("--font"),
            font: {
              size: 14,
              weight: "bold",
            },
          },
          ticks: {
            color: getCSSVar("--font"),
          },
          grid: {
            color: getCSSVar("--sfont"),
          },
        },
        y: {
          min: 0,
          max: 60,
          title: {
            display: true,
            text: "Applications",
            color: getCSSVar("--font"),
            font: {
              size: 14,
              weight: "bold",
            },
          },
          ticks: {
            color: getCSSVar("--font"),
          },
          grid: {
            color: getCSSVar("--sfont"),
          },
        },
      },
    },
  });
}