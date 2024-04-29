@extends('admin.layouts.main')
@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hi, Welcome Admin!</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Companies</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Companies List</h4>
                        <button type="button" class="btn btn-primary addCompany">Add <span class="btn-icon-right"><i class="fa fa-plus"></i></span></button>
                    </div>
                    
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="companiesList" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Company Name</th>
                                        <th>Email</th>
                                        <th>Website</th>
                                        <th>Logo</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="companyModel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="companyModelHeading"></h4>
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <div class="modal-body">
                <form id="companyForm" name="companyForm" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Company Name</label>
                                <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter Company Name">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Company Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email Id">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Company Website</label>
                                <input type="text" class="form-control" id="website" name="website" placeholder="Enter Website url">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Company Logo</label>
                                <input type="file" class="form-control" id="company_logo"  name="company_logo">
                            </div>
                        </div>
                        <input type="hidden" name="company_id" id="company_id">
                        <input type="hidden" name="old_company_logo" id="old_company_logo" required>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <button type="submit" class="btn btn-primary" id="saveCompanyBtn" value="create">Submit</button>
                            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewCompanyModel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="viewCompanyModelHeading">View Company Details</h4>
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <div class="modal-body">
                <form id="viewCompanyForm" name="viewCompanyForm" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Company Name</label>
                                <span type="text" class="form-control" id="company_name_view" name="company_name_view"></h6>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Company Email</label>
                                <span type="text" class="form-control" id="email_view" name="email_view"></h6>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Company Website</label>
                                <input type="text" class="form-control" id="website_view" name="website_view" placeholder="Enter Website url">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Company Logo</label>
                                <img src="" alt="" id="company_logo_view"  name="company_logo_view">
                            </div>
                        </div>
                        <input type="hidden" name="company_id" id="company_id">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>

<script type="text/javascript">
$(function () {
    var table = $('#companiesList').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "{{ route('companies.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'company_name', name: 'company_name'},
            {data: 'email', name: 'email'},
            {data: 'website', name: 'website'},
            {data: 'company_logo', name: 'company_logo'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('.addCompany').click(function () {
        $('#saveCompanyBtn').val("create-company");
        $('#company_id').val('');
        $('#companyForm').trigger("reset");
        $('#companyModelHeading').html("Create New Company");
        $('#companyModel').modal('show');
    });

    $('body').on('click', '.editCompany', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{ route('companies.index') }}" +'/' + id +'/edit',
            type: "get",
            dataType: 'json',
            data: { id: id },

            success: function(data) {
                $('#companyModelHeading').html("Edit Company Details");
                $('#saveCompanyBtn').val("edit-data");
                $('#companyModel').modal('show');
                $('#company_id').val(data.id);

                $("#company_name").val(data.company_name);
                $('#email').val(data.email);
                $('#website').val(data.website);
                $('#old_company_logo').val(data.company_logo);
                $('#company_logo').val(data.company_logo);
            },
        });
    });

    $('#saveCompanyBtn').click(function(e) {
        e.preventDefault();
        $(this).html('Sending..');
        $(document).find("span.textdanger").remove();
        var prgmForm = new FormData(document.getElementById("companyForm"));

        $.ajax({
            data: prgmForm,
            url: "{{ route('companies.store') }}",
            type: "POST",
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                    $('#companyForm').trigger("reset");
                    $('#companyModel').modal('hide');
                    $('#companiesList').DataTable().draw();
                    Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Saved Successfully!',
                    })
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

    $('body').on('click', '.viewCompany', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{ route('companies.index') }}" +'/' + id +'/edit',
            type: "get",
            dataType: 'json',
            data: { id: id },

            success: function(data) {
                $('#viewCompanyModel').modal('show');
                $('#company_id').val(data.id);

                $("#company_name_view").html(data.company_name);
                $('#email_view').html(data.email);
                $('#website_view').val(data.website);
                var imageUrl = '{{ asset("storage/Company/") }}' + '/' + data.company_logo;
                $('#company_logo_view').attr('src', imageUrl);
            },
        });
    });

    $('body').on('click', '.deleteCompany', function() {
        var company_id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('companies.store') }}" + '/' + company_id,
                    type: "DELETE",
                    success: (response) => {
                        Swal.fire({
                            title: "Deleted",
                            text: "This Company Details has been deleted!"
                        }).then(function() {
                            window.location.reload();
                        })
                    },
                });
            }
        })
    });

});
</script>
