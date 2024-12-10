document.addEventListener("DOMContentLoaded", function () {
    const ctx2 = document.getElementById('populationPyramid');

    const labels = infografis[0];
    const maleData = infografis[1];
    const femaleData = infografis[2];

    const data = {
      labels: labels.reverse(),
      datasets: [
        {
          label: 'Laki-Laki',
          data: maleData.reverse(), // Negative values for left side
          backgroundColor: 'rgba(54, 162, 235, 0.7)',
        },
        {
          label: 'Perempuan',
          data: femaleData.reverse(),// Positive values for right side
          backgroundColor: 'rgba(255, 99, 132, 0.7)',
        }
      ]
    };
    const options = {
      indexAxis: 'y', // Flip the axis
      scales: {
        x: {
          ticks: {
            callback: function(value) {
              return Math.abs(value); // Show absolute values on x-axis
            }
          },
        },
        y: {
          stacked: true, // Ensure the bars align properly
          barPercentage: 0.8, // Adjust the bar thickness (default: 0.9)
          categoryPercentage: 0.7 // Adjust spacing between bars
        }
      },
      plugins: {
        legend: {
          position: 'bottom'
        }
      }
    };

    const populationPyramid = new Chart(ctx2, {
      type: 'bar',
      data: data,
      options: options
    });

});
