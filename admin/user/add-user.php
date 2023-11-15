<main class="content">
  <div class="container-fluid p-0">
    <h1 class="h3 mb-3">Add user</h1>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title mb-0">User</h5>
          </div>
          <div class="card-body">
            <form id="validation-form">
              <div class="form-group">
                <label class="form-label">User name</label>
                <input type="text" class="form-control" name="validation-user-name" placeholder="User name">
              </div>

              <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="validation-user-password" placeholder="Password">
              </div>

              <div class="form-group">
                <label class="form-label">Confirm password</label>
                <input type="password" class="form-control" name="validation-user-password-confirmation" placeholder="Confirm password">
              </div>

              <div class="form-group">
                <label class="form-label">Phone</label>
                <input type="text" class="form-control" name="validation-user-phone" placeholder="Phone">
              </div>

              <div class="form-group">
                <label class="form-label">Email</label>
                <input type="text" class="form-control" name="validation-user-email" placeholder="Email">
              </div>


              <div class="form-group">
                <label class="form-label">File</label>
                <div>
                  <input type="file" class="validation-file" name="validation-user-file">
                </div>
              </div>

              <div class="form-group">
                <label class="form-label">Address</label>
                <input type="text" class="form-control" name="validation-user-address" placeholder="Address">
              </div>

              <div class="d-flex mt-5 justify-content-center align-item-center">
                <button type="submit" class="btn btn-primary" id="toastr-show">Add user</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</main>


<script>
  $(function() {
    // Trigger validation on tagsinput change
    $("input[name=\"validation-bs-tagsinput\"]").on("itemAdded itemRemoved", function() {
      $(this).valid();
    });
    // Initialize validation
    $("#validation-form").validate({
      rules: {
        "validation-user-email": {
          required: true,
          email: true
        },
        "validation-user-password": {
          required: true,
          minlength: 6,
          maxlength: 20
        },
        "validation-user-password-confirmation": {
          required: true,
          equalTo: "input[name=\"validation-password\"]"
        },
        "validation-user-name": {
          required: true
        },
        "validation-user-phone": {
          required: true,
          maxlength: 11
        },
        "validation-user-address": {
          required: true
        },
        "validation-user-file": {
          required: true
        }
      },
      messages: {
        "validation-user-email": {
          required: "Do not leave the email blank."
        },
        "validation-user-password": {
          required: "Do not leave the password blank.",
        },
        "validation-user-password-confirmation": {
          required: "Do not leave the re-password blank."
        },
        "validation-user-name": {
          required: "Do not leave the user name blank."
        },
        "validation-user-phone": {
          required: "Do not leave the phone number blank."
        },
        "validation-user-address": {
          required: "Do not leave the address blank."
        },
        "validation-user-file": {
          required: "Do not leave the image blank."
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

<!-- Show notification -->
<script>
  // Toastr
  $(function() {
    var currentMessageIndex = -1;
    $('#toastr-show').click(function() {
      var message = "Category";
      var title = "Add user success";
      var type = "success";

      toastr[type](message, title, {
        positionClass: 'toast-top-right',
        closeButton: 'checked',
        progressBar: 'checked',
        newestOnTop: 'checked',
        rtl: $('body').attr('dir') === 'rtl' ||
          $('html').attr('dir') === 'rtl',
        timeOut: 5000,
      });
    });

    $('#toastr-clear').on('click', function() {
      toastr.clear();
    });
  });
</script>