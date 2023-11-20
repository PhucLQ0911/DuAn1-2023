<main class="content">
  <div class="container-fluid p-0">
    <h1 class="h3 mb-3">Update category</h1>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title mb-0">Category</h5>
          </div>
          <div class="card-body">
            <form id="validation-form" method="post" enctype="multipart/form-data">
              <input type="hidden" name="idCategory" value="<?= $_GET['idCategory'] ?>">
              <div class="form-group">
                <label class="form-label">Name category</label>
                <input type="text" class="form-control" name="validation-category-name" placeholder="Name category" value="<?= $category['name'] ?>">
              </div>
              <div class="form-group">
                <label class="form-label">Image</label>
                <div>
                  <input type="hidden" name="oldImage" value="<?= $category['image'] ?>">
                  <input type="file" class="validation-file" name="validation-category-file">
                </div>
              </div>

              <div class="d-flex mt-5 justify-content-center align-item-center">
                <button type="submit" class="btn btn-lg btn-primary" id="toastr-show" name="updateCategory">
                  Update Category
                </button>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>

  </div>
</main>

<!-- Validation -->
<script>
  // Trigger validation on tagsinput change
  $("input[name=\"validation-bs-tagsinput\"]").on("itemAdded itemRemoved", function() {
    $(this).valid();
  });

  $(function() {
    $("#validation-form").validate({
      rules: {
        "validation-category-name": {
          required: true,
        },
        "validation-category-file": {
          extension: "jpg|jpeg|png"
        }
      },
      messages: {
        "validation-category-name": {
          required: "Do not leave the name category blank."
        },
        "validation-category-file": {
          extension: "Please upload file in these format only (jpg, jpeg, png)."
        }
      },
      // Errors
      errorPlacement: function errorPlacement(error, element) {
        var $parent = $(element).parents(".form-group");
        // Do not duplicate errors
        if ($parent.find(".jquery-validation-error").length) {
          return;
        }
        $parent.append(
          error.addClass("jquery-validation-error small form-text invalid-feedback")
        );
      },
      highlight: function(element) {
        var $el = $(element);
        var $parent = $el.parents(".form-group");
        $el.addClass("is-invalid");
      },
      unhighlight: function(element) {
        $(element).parents(".form-group").find(".is-invalid").removeClass("is-invalid");
      }
    });
  });
</script>