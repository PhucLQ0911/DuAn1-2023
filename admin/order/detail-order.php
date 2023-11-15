<main class="content">
  <div class="container-fluid p-0">

    <h1 class="h3 mb-3">Detail order</h1>

    <div class="row">
      <div class="col-12">
        <div class="card">

          <!-- Header -->
          <div class="card-header d-flex ">
            <div>
              <h5 class="card-title">Responsive Table</h5>
              <h6 class="card-subtitle text-muted">
                Highly flexible tool that many advanced features to any HTML table.
              </h6>
            </div>
            <div class="ml-auto">
              <a href="?act=order" class="btn btn-primary">List order</a>
            </div>
          </div>

          <!-- Data -->
          <div class="card-body">
            <table id="datatables-basic" class="table table-striped" style="width:100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Product name</th>
                  <th>Size</th>
                  <th>Color</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
                </tr>
              </thead>

              <tbody>
                <tr>
                  <td>1</td>
                  <td>1</td>
                  <td>1</td>
                  <td>Smartphone</td>
                  <td>Smartphone</td>
                  <td><img src="" alt="...image cate"></td>
                  <td>10</td>

                </tr>
                <tr>
                  <td>2</td>
                  <td>2</td>
                  <td>2</td>
                  <td>T-Shirt</td>
                  <td>T-Shirt</td>
                  <td><img src="" alt="...image cate"></td>
                  <td>Show</td>

                </tr>

                <tr>
                  <td>3</td>
                  <td>3</td>
                  <td>3</td>
                  <td>Dress</td>
                  <td>total</td>
                  <td><img src="" alt="...image cate"></td>
                  <td>Show</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</main>


<script>
  $(function() {
    // Datatables basic
    $("#datatables-basic").DataTable({
      responsive: true
    });
  });
</script>