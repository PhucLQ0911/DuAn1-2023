<!-- Checkout Start -->
<div class="container-fluid pt-5">
  <form id="validation-form" action="?act=orderDetail" method="post">
    <div class="container mt-4">
      <h2 class="text-center">Order detail</h2>
      <div class=" row d-flex mt-5">
        <div class="col-9">
          <input class="form-control" name="idOrder" type="text" placeholder="Enter order id" />
        </div>
        <div class="col-3">
          <button type="submit" name="searchOrder" class="btn btn-primary">
            Search Order
          </button>
        </div>
      </div>
    </div>
  </form>
  
  <!-- Order -->
  <div class="container-fluid pt-5 d-flex justify-content-center">
    <div>
      <?php if(!empty($showOrder)) :?>
      <?php foreach($showOrder as $show) :?>
          <?php extract($show)?>
         <?php if ($order_status == 0) : ?>
          <?php $order_status = 'In progress'; ?>
        <?php elseif ($order_status == 1) : ?>
          <?php $order_status = 'Cancelled'; ?>
        <?php elseif ($order_status == 2) : ?>
          <?php $order_status = ' Done'; ?>
         
        <?php endif; ?>
      <input type="text" value="<?=$fullname?>" disabled>
      <input type="text" value="<?=$address?>" disabled>
      <input type="text" value="<?=$total_payment?>" disabled>
      <input type="text" value="<?=$order_status ?>" disabled>
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
            <td><?=$name?></td>
            <td><?=$price?></td>
            <td><?=$quantity?></td>
            <td><?=$total_payment?></td>
            <td>5</td>
          </tr>
        </tbody>
      </table>

      <?php endforeach ?>
      <?php else :?>
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
            <td><??></td>
            <td>2</td>
            <td>3</td>
            <td>4</td>
            <td>5</td>
          </tr>
        </tbody>
      </table>
      <?php endif ?>
    </div>
  </div>

</div>
<!-- Checkout End -->