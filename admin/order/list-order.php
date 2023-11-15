<main class="content">
  <div class="container-fluid p-0">

    <h1 class="h3 mb-3">List order</h1>

    <div class="row">
      <div class="col-12">
        <div class="card">

          <!-- Header -->
          <div class="card-header">
            <h5 class="card-title">Responsive Table</h5>
            <h6 class="card-subtitle text-muted">
              Highly flexible tool that many advanced features to any HTML table.
            </h6>
          </div>

          <!-- Data -->
          <div class="card-body">
            <table id="datatables-basic" class="table table-striped" style="width:100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Full name</th>
                  <th>Address</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Payment</th>
                  <th>Date order</th>
                  <th>Total amount</th>
                  <th>Order status</th>
                  <th>
                    <div class="text-center">
                      Action
                    </div>
                  </th>
                </tr>
              </thead>

              <tbody>
                <tr>
                  <td>1</td>
                  <td>name</td>
                  <td>address</td>
                  <td>phone</td>
                  <td>email</td>
                  <td>payment</td>
                  <td>date</td>
                  <td>Total amount</td>
                  <td><span class="badge badge-danger">Cancelled</span></td>
                  <td>
                    <div class="text-center">
                      <a href="?act=detailOrder" class="btn btn-primary">
                        Detail
                      </a>

                      <button type="button" class="btn btn-success confirmOrder" data-toggle="modal" data-target="#defaultModalConfirm" data-ds-id="1">
                        Confirm
                      </button>

                      <button type="button" class="btn btn-danger refuseOrder" data-toggle="modal" data-target="#defaultModalRefuse" data-ds-id="1">
                        Refuse
                      </button>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>2</td>
                  <td>2</td>
                  <td>2</td>
                  <td>2</td>
                  <td>T-Shirt</td>
                  <td><img src="" alt="...image cate"></td>
                  <td>Total amount</td>
                  <td><span class="badge badge-warning">In progress</span></td>
                  <td>
                    <div class="text-center">
                      <a href="?act=detailOrder" class="btn btn-primary">
                        Detail
                      </a>

                      <button type="button" class="btn btn-success confirmOrder" data-toggle="modal" data-target="#defaultModalConfirm" data-ds-id="2">
                        Confirm
                      </button>

                      <button type="button" class="btn btn-danger refuseOrder" data-toggle="modal" data-target="#defaultModalRefuse" data-ds-id="2">
                        Refuse
                      </button>
                    </div>
                  </td>
                </tr>

                <tr>
                  <td>3</td>
                  <td>3</td>
                  <td>3</td>
                  <td>3</td>
                  <td>3</td>
                  <td>Dress</td>
                  <td><img src="" alt="...image cate"></td>
                  <td>Total amount</td>
                  <td><span class="badge badge-success">Done</span></td>
                  <td>
                    <div class="text-center">
                      <a href="?act=detailOrder" class="btn btn-primary">
                        Detail
                      </a>

                      <button type="button" class="btn btn-success confirmOrder" data-toggle="modal" data-target="#defaultModalConfirm" data-ds-id="3">
                        Confirm
                      </button>

                      <button type="button" class="btn btn-danger refuseOrder" data-toggle="modal" data-target="#defaultModalRefuse" data-ds-id="3">
                        Refuse
                      </button>
                    </div>
                  </td>
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

<!-- Confirm order -->
<div class="modal fade" id="defaultModalConfirm" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body m-3">
        <p class="mb-0">
          Do you want to confirm order ?
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          Close
        </button>
        <a href="" class="btn btn-danger" id="btn-success">
          Confirm
        </a>
      </div>
    </div>
  </div>
</div>
<script>
  $('.confirmOrder').on('click', function() {
    var id = $(this).data('ds-id');
    console.log(id);
    var link = `?act=confirmOrder&idOrder=${id}`
    document.getElementById("btn-success").setAttribute("href", link)
  });
</script>

<!-- Refuse order -->
<div class="modal fade" id="defaultModalRefuse" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body m-3">
        <p class="mb-0">
          Do you want to refuse order ?
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          Close
        </button>
        <a href="" class="btn btn-danger" id="btn-delete">
          Confirm
        </a>
      </div>
    </div>
  </div>
</div>
<script>
  $('.refuseOrder').on('click', function() {
    var id = $(this).data('ds-id');
    console.log(id);
    var link = `?act=refuseOrder&idOrder=${id}`
    document.getElementById("btn-delete").setAttribute("href", link)
  });
</script>