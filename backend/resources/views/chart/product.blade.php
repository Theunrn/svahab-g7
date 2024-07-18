<div class="bg-white p-4 rounded-lg shadow-md mt-8" style="width: 550px; height: 350px;">
  <h2 class="font-bold mb-4 text-2xl text-gray-800">Top 5 Products</h2>
  <div class="flex justify-center">
      <canvas id="revenueChart" style="width: 275px; height: 275px;"></canvas>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
      document.addEventListener('DOMContentLoaded', function () {
          var ctx = document.getElementById('revenueChart').getContext('2d');
          var productData = @json($productData); // Assuming you're passing data from Laravel to JavaScript
          var totalOrders = @json($totalOrders);

          if (totalOrders === 0) {
              var labels = ['No Orders Yet'];
              var data = [100];
              var backgroundColors = ['rgba(75, 192, 192, 0.6)'];
              var borderColors = ['rgba(75, 192, 192, 1)'];
          } else {
              var labels = productData.map(item => item.name + ' %');
              var data = productData.map(item => item.percentage);
              var backgroundColors = [
                  'rgba(255, 99, 132, 0.6)',
                  'rgba(54, 162, 235, 0.6)',
                  'rgba(255, 205, 86, 0.6)',
                  'rgba(75, 192, 192, 0.6)',
                  'rgba(153, 102, 255, 0.6)'
              ];
              var borderColors = [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 205, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)'
              ];
          }

          var revenueChart = new Chart(ctx, {
              type: 'pie',
              data: {
                  labels: labels,
                  datasets: [{
                      label: 'Product Order Distribution',
                      data: data,
                      backgroundColor: backgroundColors,
                      borderColor: borderColors,
                      borderWidth: 1
                  }]
              },
              options: {
                  responsive: true,
                  maintainAspectRatio: false,
                  plugins: {
                      legend: {
                          position: 'bottom',
                          align: 'start',
                          top: 2,
                          labels: {
                              usePointStyle: true
                          },
                          display: true,
                          flexWrap: true
                      },
                      tooltip: {
                          callbacks: {
                              label: function (tooltipItem) {
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
