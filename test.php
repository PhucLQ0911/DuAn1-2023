<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pie Chart Example</title>
  <!-- Include Chart.js library -->
  
</head>
<body>

<!-- HTML canvas element where Chart.js will render the chart -->
<canvas id="myPieChart" width="400" height="400"></canvas>

<script>
// Sample data for the pie chart
const data = {
  labels: ['Category 1', 'Category 2', 'Category 3', 'Category 4'],
  datasets: [{
    data: [30, 20, 25, 25],
    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'],
    borderColor: 'white',
    borderWidth: 2,
  }],
};

// Configuration options
const options = {
  responsive: true,
  maintainAspectRatio: false,
  legend: {
    display: true,
    position: 'bottom',
    labels: {
      generateLabels: function(chart) {
        var data = chart.data;
        if (data.labels.length && data.datasets.length) {
          return data.labels.map(function(label, i) {
            var meta = chart.getDatasetMeta(0);
            var ds = data.datasets[0];
            var arc = meta.data[i];
            var value = ds.data[i];
            var percent = ((value / ds._meta[0].total) * 100).toFixed(1);
            return {
              text: label + ' (' + percent + '%)',
              fillStyle: ds.backgroundColor[i],
              hidden: isNaN(ds.data[i]) || meta.data[i].hidden,
              index: i,
            };
          });
        }
        return [];
      },
    },
  },
  tooltips: {
    callbacks: {
      label: function(tooltipItem, data) {
        var dataset = data.datasets[tooltipItem.datasetIndex];
        var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
          return previousValue + currentValue;
        });
        var currentValue = dataset.data[tooltipItem.index];
        var percent = ((currentValue / total) * 100).toFixed(1);
        return dataset.labels[tooltipItem.index] + ': ' + percent + '%';
      },
    },
  },
};

// Get the canvas element
const ctx = document.getElementById('myPieChart').getContext('2d');

// Create the pie chart
new Chart(ctx, {
  type: 'pie',
  data: data,
  options: options,
});
</script>

</body>
</html>