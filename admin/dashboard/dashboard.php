<main class="content">
  <div class="container-fluid p-0">
    <!-- Static -->
    <div class="row">
      <div class="col-12 col-sm-6 col-xl d-flex">
        <div class="card flex-fill">
          <div class="card-body py-4">
            <div class="media">
              <div class="d-inline-block mt-2 mr-3">
                <i class="feather-lg text-primary" data-feather="shopping-cart"></i>
              </div>
              <div class="media-body">
                <h3 class="mb-2"><?= $totalSales ?></h3>
                <div class="mb-0">Total Solded</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-xl d-flex">
        <div class="card flex-fill">
          <div class="card-body py-4">
            <div class="media">
              <div class="d-inline-block mt-2 mr-3">
                <i class="feather-lg text-warning" data-feather="folder"></i>
              </div>
              <div class="media-body">
                <h3 class="mb-2"><?= $totalProducts ?></h3>
                <div class="mb-0">Products</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-xl d-flex">
        <div class="card flex-fill">
          <div class="card-body py-4">
            <div class="media">
              <div class="d-inline-block mt-2 mr-3">
                <i class="feather-lg text-danger" data-feather="shopping-bag"></i>
              </div>
              <div class="media-body">
                <h3 class="mb-2"><?= $totalPendingOrder ?></h3>
                <div class="mb-0">Pending Orders</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-xl d-none d-xxl-flex">
        <div class="card flex-fill">
          <div class="card-body py-4">
            <div class="media">
              <div class="d-inline-block mt-2 mr-3">
                <i class="feather-lg text-info" data-feather="shopping-bag"></i>
              </div>
              <div class="media-body">
                <h3 class="mb-2"><?= $totalOrder ?></h3>
                <div class="mb-0">Total Orders</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-xl d-flex">
        <div class="card flex-fill">
          <div class="card-body py-4">
            <div class="media">
              <div class="d-inline-block mt-2 mr-3">
                <i class="feather-lg text-success" data-feather="dollar-sign"></i>
              </div>
              <div class="media-body">
                <h3 class="mb-2"><?= round((float)$totalEarning, 3) ?></h3>
                <div class="mb-0">Total Earnings</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12 col-lg-6 col-xl-8 d-flex">
        <div class="card flex-fill">
          <div class="card-header">
            <h5 class="card-title mb-0">New Orders</h5>
          </div>
          <table id="datatables-dashboard-projects" class="table table-striped my-0">
            <thead>
              <tr>
                <th>Category ID</th>
                <th>Name Category</th>
                <th class="d-none d-xl-table-cell">Sold_Product</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($categorySolds as $category) : ?>
                <?php extract($category) ?>
                <tr>
                  <td><?= $category_id ?></td>
                  <td class="d-none d-xl-table-cell"><?= $category_name ?></td>
                  <td class="d-none d-xl-table-cell"><?= $sold_count ?></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-12 col-xl-4 d-none d-xl-flex">
        <div class="card flex-fill w-100">
          <div class="card-header">

            <h5 class="card-title mb-0"> Number of products sold in the category</h5>
          </div>
          <div class="card-body d-flex">
            <div class="align-self-center w-100">
              <div class="py-3">
                <div class="chart chart-xs">
                  <canvas id="myPieChart" width="400" height="400"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</main>

<script src="./js/app.js"></script>
<!-- Pie chart -->
<!-- <script>

  $(function() {
    // Pie chart
    new Chart(document.getElementById('chartjs-dashboard-pie'), {
      type: 'pie',
      data: {
        labels: ['Direct', 'Affiliate', 'E-mail', 'Other'],
        datasets: [{
          data: [2602, 1253, 541, 1465],
          backgroundColor: [
            window.theme.primary,
            window.theme.warning,
            window.theme.danger,
            '#E8EAED',
          ],
          borderColor: 'transparent',
        }, ],
      },
      options: {
        responsive: !window.MSInputMethodContext,
        maintainAspectRatio: false,
        legend: {
          display: false,
        },
      },
    });
  });
</script> -->
<script>
  // Dữ liệu danh sách mảng các danh mục và số lượng sản phẩm đã bán
  var categories = <?php echo json_encode(array_column($categorySoldsProduct, 'category_name')); ?>;
  var solds = <?php echo json_encode(array_column($categorySoldsProduct, 'sold_products')); ?>;
  var products = <?php echo json_encode(array_column($categorySoldsProduct, 'product_name')); ?>;

  // Lấy đối tượng canvas và ngữ cảnh 2D
  var ctx = document.getElementById('myPieChart').getContext('2d');

  // Tạo biểu đồ tròn
  var myPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
      datasets: [{
        data: solds,
        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50', '#FF8C00', '#9966FF'],
      }],
      labels: categories,
    },
    options: {
      plugins: {
        tooltip: {
          callbacks: {
            label: function(context) {
              var index = context.dataIndex;
              var label = categories[index];
              var value = solds[index];
              var total = context.dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                return previousValue + currentValue;
              });
              var percentage = Math.floor((value / total) * 100 + 0.5);
              return label + ': ' + value + ' sold products (' + percentage + '%)';
            },
          },
        },
      },
      legend: {
        position: 'bottom', // Di chuyển danh mục xuống phía dưới biểu đồ
      },
    },
  });
</script>

<!-- Data table -->
<script>
  $(function() {
    $('#datatables-dashboard-projects').DataTable({
      pageLength: 6,
      lengthChange: false,
      bFilter: false,
      autoWidth: false,
    });
  });
</script>