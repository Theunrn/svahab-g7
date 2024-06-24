<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Field Booking Frequency Chart</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    #fieldBookingChart {
      width: 100%;
      max-width: 1000px; /* Adjust maximum width as needed */
      height: 200px; /* Adjust height as needed */
      margin: auto; /* Center the chart horizontally */
    }
  </style>
</head>
<body>
  <div class="container mx-auto px-6 py-5 bg-white m-5 rounded-lg shadow-md">
    <h1 class="text-2xl fs-2 font-bold mb-4">Field Booking Frequency</h1>
    <div>
      <canvas id="fieldBookingChart"></canvas>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var ctx = document.getElementById('fieldBookingChart').getContext('2d');
      var fieldBookingChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
          datasets: [{
            label: 'Field Booking Frequency',
            data: [30, 45, 55, 50, 65, 70, 60], // Replace with your actual booking frequency data
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
          }]
        },
        options: {
          scales: {
            x: {
              display: true,
              title: {
                display: true,
                text: 'Days of the Week'
              }
            },
            y: {
              display: true,
              title: {
                display: true,
                text: 'Number of Bookings'
              },
              suggestedMin: 0
            }
          }
        }
      });
    });
  </script>
</body>
</html>
