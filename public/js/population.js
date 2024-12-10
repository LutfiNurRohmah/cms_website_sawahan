document.addEventListener("DOMContentLoaded", function () {
const ctx3 = document.getElementById('populationChart');

const labels = population[0];
const values = population[1];

const data2 = {
  labels: labels,
  datasets: [
    {
      label: 'Populasi Penduduk',
      data: values,
      backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'],
    },
  ]
};

const options2 = {
  plugins: {
    legend: {
      position: 'bottom'
    }
  }
};

const populationChart = new Chart(ctx3, {
  type: 'pie',
  data: data2,
  options: options2
});

});
