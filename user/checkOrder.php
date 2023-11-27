<!-- Checkout Start -->
<div class="container-fluid pt-5">
  <form id="validation-form" method="post">
    <div class="container mt-4">
      <h2 class="text-center">Order detail</h2>
      <div class=" row d-flex mt-5">
        <div class="col-9">
          <input class="form-control" name="idOrder" type="text" placeholder="Enter order id" />
        </div>
        <div class="col-3">
          <button type="submit" class="btn btn-primary">
            Search Order
          </button>
        </div>
      </div>
    </div>
  </form>

  <!-- Order -->
  <div class="container-fluid pt-5 d-flex justify-content-center">
    <div>
      <input type="text" value="Fullname" disabled>
      <input type="text" value="Address" disabled>
      <input type="text" value="Total payment" disabled>
      <input type="text" value="Status" disabled>
      <p class="mt-3">Order Detail</p>
      <table class="table table-bordered text-center mb-0 mt-1">
        <thead class="bg-secondary text-dark">
          <tr>
            <th>Products</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Remove</th>
          </tr>
        </thead>
        <tbody id="itemCarts" class="align-middle">
          <tr>
            <td>1</td>
            <td>2</td>
            <td>3</td>
            <td>4</td>
            <td>5</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</div>
<!-- Checkout End -->