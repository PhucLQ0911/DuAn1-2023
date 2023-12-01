<div class="container-fluid p-5">
  <h1 class="h3 mb-3">List order</h1>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <table class="table table-striped" style="width:100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>Category name</th>
              <th>Image</th>
              <th>Status</th>
              <th>
                <div class="text-center">Action</div>
              </th>
            </tr>
          </thead>

          <tbody>
            <?php foreach ($categories as $key => $category) : ?>
              <?php extract($category) ?>
              <tr>
                <td><?= $key + 1 ?></td>
                <td><?= $name ?></td>
                <td>
                  <img src="../uploads/<?= $image ?>" alt="...image cate" width="100px" height="100px">
                </td>
                <td>
                  <span class="badge text-white badge-warning rounded">In progress</span>
                  <span class="badge badge-danger rounded">Cancelled</span>
                  <span class="badge badge-success rounded">Done</span>
                </td>
                <td>
                  <div class="d-flex flex-row justify-content-center">
                    <a href="?act=updateCategory&idCategory=<?= $id ?>" class="btn btn-warning text-white  rounded">
                      Update
                    </a>

                    <button type="button" class="btn btn-danger deleteCategory ml-2 rounded" data-toggle="modal" data-target="#defaultModalDanger" data-ds-status="<?= $status ?>" data-ds-name="<?= $name ?>" data-ds-id="<?= $id ?>">
                      <?= ($status == 0) ? "Delete" : "Restore" ?>
                    </button>
                  </div>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>