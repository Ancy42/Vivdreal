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
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Employees</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Employees List</h4>
                        <button type="button" class="btn btn-primary addEmployee">Add <span class="btn-icon-right"><i class="fa fa-plus"></i></span></button>
                    </div>
                    
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="employeesList" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Employee Name</th>
                                        <th>Email Id</th>
                                        <th>Phone No.</th>
                                        <th>Company Name</th>
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

<div class="modal fade" id="employeeModel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="employeeModelHeading"></h4>
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <div class="modal-body">
                <form id="employeeForm" name="employeeForm">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Email ID</label>
                                <input type="text" class="form-control" id="email_id" name="email_id" placeholder="Enter Email Id">
                            </div>
                        </div>
                       
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Mobile No.</label>
                                <input type="text" class="form-control" id="phone"  name="phone">
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Choose Company</label>
                                <select type="text" class="form-control" id="company_id"  name="company_id">
                                    <option value="">--Select--</option>
                                    @foreach($company as $comp)
                                        <option value="{{$comp->id}}">{{$comp->company_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <input type="hidden" name="emp_id" id="emp_id">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <button type="submit" class="btn btn-primary" id="saveEmployeeBtn" value="create">Submit</button>
                            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        </div>
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
    var table = $('#employeesList').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "{{ route('employee.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'employee_name', name: 'employee_name'},
            {data: 'email_id', name: 'email_id'},
            {data: 'phone', name: 'phone'},
            {data: 'company_name', name: 'company_name'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('.addEmployee').click(function () {
        $('#saveEmployeeBtn').val("create-employee");
        $('#emp_id').val('');
        $('#employeeForm').trigger("reset");
        $('#employeeModelHeading').html("Create New Employee");
        $('#employeeModel').modal('show');
    });

    $('body').on('click', '.editEmployee', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{ route('employee.index') }}" +'/' + id +'/edit',
            type: "get",
            dataType: 'json',
            data: { id: id },

            success: function(data) {
                $('#employeeModelHeading').html("Edit Employee Details");
                $('#saveEmployeeBtn').val("edit-data");
                $('#employeeModel').modal('show');
                $('#emp_id').val(data.id);

                $("#first_name").val(data.first_name);
                $('#email_id').val(data.email_id);
                $('#last_name').val(data.last_name);
                $('#company_id').val(data.company_id);
                $('#phone').val(data.phone);
            },
        });
    });

    $('#saveEmployeeBtn').click(function(e) {
        e.preventDefault();
        $(this).html('Sending..');
        $(document).find("span.textdanger").remove();
        var prgmForm = new FormData(document.getElementById("employeeForm"));

        $.ajax({
            data: prgmForm,
            url: "{{ route('employee.store') }}",
            type: "POST",
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                    $('#employeeForm').trigger("reset");
                    $('#employeeModel').modal('hide');
                    $('#employeesList').DataTable().draw();
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

    $('body').on('click', '.deleteEmployee', function() {
        var emp_id = $(this).data('id');
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
                    url: "{{ route('employee.store') }}" + '/' + emp_id,
                    type: "DELETE",
                    success: (response) => {
                        Swal.fire({
                            title: "Deleted",
                            text: "This Employee Details has been deleted!"
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
