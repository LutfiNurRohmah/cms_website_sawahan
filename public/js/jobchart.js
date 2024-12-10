document.addEventListener("DOMContentLoaded", function () {
    const ctx3 = document.getElementById('jobChart');

    const labels = job[0];
    const values = job[1];

    const data2 = {
      labels: labels,
      datasets: [
        {
          label: 'Persebaran Penduduk Berdasarkan Pekerjaan',
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

    const jobChart = new Chart(ctx3, {
      type: 'bar',
      data: data2,
      options: options2
    });

    });
