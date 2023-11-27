<style>
  .cat-img{
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .img-flui{
    max-width: 100%;
    height: 270px;
  }
</style>
<!-- Categories Start -->
<div class="container-fluid pt-5">
  <div class="row px-xl-5 pb-3">
    <?php foreach($categories as $all) :?>
      <?php extract($all) ?>
    <div class="col-lg-4 col-md-6 pb-1">
      <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px">
        <p class="text-right"><?=productCountByCategory($id)?> Products</p>
        <a href="" class="cat-img position-relative overflow-hidden mb-3">
          <img class="img-flui" src="../uploads/<?=$image?>" alt="" />
        </a>
        <h5 class="font-weight-semi-bold m-0"><?=$name?></h5>
      </div>
    </div>
    <?php endforeach ?>
  </div>
</div>
<!-- Categories End -->