const root = document.documentElement;
const modeChanger = document.getElementById("modeChanger");
const ctx = document.getElementById('futuristicChart').getContext('2d');
const highStats = document.getElementById('highlightStatistics');
let myChart;

function getCSSVar(name) {
  return getComputedStyle(document.documentElement).getPropertyValue(name).trim();
}

function createChart() {
  if (myChart) {
    myChart.destroy();
  }

  myChart = new Chart(ctx, {
    data: {
      labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
      datasets: [
        {
          type: 'bar',
          label: 'Amount-B',
          data: [12, 19, 11, 26, 30, 45, 38, 40, 42, 44, 48, 50],
          backgroundColor: getCSSVar('--tbg'),
          borderWidth: 0,
          order: 1,
          barThickness: 6
        },
        // {
        //   type: 'line',
        //   label: 'Amount-L',
        //   data: [2, 9, 1, 6, 0, 5, 8, 4, 2, 4, 8, 5],
        //   borderColor: getCSSVar('--sfont'),
        //   backgroundColor: getCSSVar('--sfont'),
        //   tension: 0.4,
        //   pointRadius: 6,
        //   pointHoverRadius: 8,
        //   pointBorderWidth: 2,
        //   pointBackgroundColor: getCSSVar('--bg'),
        //   pointBorderColor: getCSSVar('--font'),
        //   order: 2
        // },
        {
          type: 'line',
          label: 'Amount-L',
          data: [12, 19, 11, 26, 30, 45, 38, 40, 42, 44, 48, 50],
          borderColor: getCSSVar('--sfont'),
          backgroundColor: getCSSVar('--sfont'),
          tension: 0.4,
          pointRadius: 6,
          pointHoverRadius: 8,
          pointBorderWidth: 2,
          pointBackgroundColor: getCSSVar('--bg'),
          pointBorderColor: getCSSVar('--font'),
          order: 2
        }
      ]
    },
    type: 'bar',
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          labels: {
            color: getCSSVar('--font')
          }
        },
        tooltip: {
          backgroundColor: getCSSVar('--sbg'),
          titleColor: getCSSVar('--sfont'),
          bodyColor: getCSSVar('--obg')
        }
      },
      scales: {
        x: {
          title: {
            display: true,
            text: 'Month',
            color: getCSSVar('--font'),
            font: {
              size: 14,
              weight: 'bold'
            }
          },
          ticks: {
            color: getCSSVar('--font')
          },
          grid: {
            color: getCSSVar('--sfont')
          }
        },
        y: {
          min: 0,
          max: 60,
          title: {
            display: true,
            text: 'Applications',
            color: getCSSVar('--font'),
            font: {
              size: 14,
              weight: 'bold'
            }
          },
          ticks: {
            color: getCSSVar('--font')
          },
          grid: {
            color: getCSSVar('--sfont')
          }
        }
      }
    }
  });
}

if (ctx) {
  createChart();
}

if (modeChanger) {
  modeChanger.addEventListener("click", function () {
    root.classList.toggle("darkness");

    if (modeChanger.textContent !== "Light Mode") {
      modeChanger.textContent = "Light Mode";
    } else {
      modeChanger.textContent = "Dark Mode";
    }

    setTimeout(() => {
      createChart();
    }, 50);
  });
}

if (highStats) {
  highStats.addEventListener("click", function () {
    const stats = document.getElementById('statistics');

    if (stats) {
      stats.style.boxShadow = '0 0 8px var(--sfont), 0 0 16px var(--font)';
      stats.style.animation = 'highlightChart 3s ease';
      setTimeout(() => {
        stats.style.boxShadow = '0 0 2px var(--sfont), 0 0 4px var(--font)';
        stats.style.animation = '';
        stats.style.transition = '.5s ease';
      }, 3000);
    }
  });
}
