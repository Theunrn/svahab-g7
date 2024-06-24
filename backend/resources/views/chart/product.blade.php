<div class="bg-white rounded-lg shadow-md mt-8 py-3" style="width: 450px; height: 350px; margin: 10 auto;">
  <canvas id="revenueChart"></canvas>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var ctx = document.getElementById('revenueChart').getContext('2d');
      var revenueChart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: ['Equipment', 'Apparel', 'Accessories', 'Tickets'],
          datasets: [{
            label: 'Revenue Distribution',
            data: [45, 30, 15, 10], // Example data, percentages of revenue from each category
            backgroundColor: [
              'rgba(255, 99, 132, 0.6)',
              'rgba(54, 162, 235, 0.6)',
              'rgba(255, 205, 86, 0.6)',
              'rgba(75, 192, 192, 0.6)'
            ],
            borderColor: [
              'rgba(255, 99, 132, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 205, 86, 1)',
              'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'bottom', // Place legend at the bottom
            },
            tooltip: {
              callbacks: {
                label: function(tooltipItem) {
                  return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';
                }
              }
            }
          }
        }
      });
    });
  </script>
</div>
