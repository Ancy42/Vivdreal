@extends('admin.layouts.main')
@section('content')
<style>
.h-100 {
    height: 45% !important;
}
</style>
<div class="content-body">
    <div class="container-fluid">
        <div class="authincation h-100">
            <div class="container h-100">
                <div class="row justify-content-center h-100 align-items-center">
                    <div class="col-md-12">
                        <div class="authincation-content">
                            <div class="row no-gutters">
                                <div class="col-xl-12">
                                    <div class="auth-form">
                                        <h4 class="text-center mb-4">Change Admin Password</h4>
                                        <form id="changePasswordForm">
                                            <div class="form-group">
                                                <label><strong>New Password</strong></label>
                                                <input type="password" class="form-control" placeholder="Enter New Password" name="password">
                                            </div>
                                            <div class="form-group">
                                                <label><strong>Confirm Password</strong></label>
                                                <input type="password" class="form-control" placeholder="Re-Enter Password" name="confirm_password">
                                            </div>
                                            <div class="text-center mt-4">
                                                <button type="submit" class="btn btn-primary btn-block" id="changePasswordBtn">Change</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script>
$(function () {
  $('#changePasswordBtn').click(function(e) {
      e.preventDefault();
      $(this).html('Sending..');
      $(document).find("span.textdanger").remove();

      $.ajax({
        data: $('#changePasswordForm').serialize(),
        url: "{{ route('update.password') }}",
        type: "POST",
        dataType: 'json',
         success: function(data) {
            $('#changePasswordForm').trigger("reset");
            Swal.fire({
               icon: 'success',
               title: 'Success',
               text: 'Successfully Registered!',
               confirmButtonColor: '#0ab99d',
            }).then((result) => {
               if (result.isConfirmed) {
                  location.reload();
               }
            });
         },
        error: function(data) {
            console.log('Error:', data);
            $('#validation-errors').html('');
            $.each(data.responseJSON.errors, function(field_name, error) {
            $(document).find('[name=' + field_name + ']').after(
                  '<span class="text-strong textdanger" style="color:red;">' +
                  error + '</span>')
            })
        }
      });
  });
});
</script>

