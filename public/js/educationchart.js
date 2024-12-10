document.addEventListener("DOMContentLoaded", function () {
    const ctx3 = document.getElementById('educationChart');

    const labels = education[0];
    const values = education[1];

    const data2 = {
      labels: labels,
      datasets: [
        {
          label: 'Persebaran Penduduk Berdasarkan Pendidikan',
          data: values,
          backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'],
        },
      ]
    };

    const options2 = {
        scales: {
            y: {
              beginAtZero: true
            }
          },
      plugins: {
        legend: {
          position: 'bottom'
        }
      }
    };

    const educationChart = new Chart(ctx3, {
      type: 'bar',
      data: data2,
      options: options2
    });

    });
