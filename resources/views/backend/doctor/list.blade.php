@extends('layouts.dashboard')
@section('dashboard_content')
@section('top_css')
<link rel="stylesheet" href="{{ asset('dashboard') }}/assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('dashboard') }}/assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('dashboard') }}/assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('dashboard') }}/assets/vendor/table-dragger/table-dragger.min.css">
@endsection
@section('doctor_active')
	active
@endsection
@section('doctor_list_active')
	active
@endsection

<div class="block-header">
    <div class="row">
        <div class="col-lg-6 col-md-8 col-sm-12">
            <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> All Doctors</h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                <li class="breadcrumb-item">Doctors</li>
                <li class="breadcrumb-item active">All Doctors</li>
            </ul>
        </div>            
        <div class="col-lg-6 col-md-4 col-sm-12 text-right">
            <div class="bh_chart hidden-xs">
                <div class="float-left m-r-15">
                    <small>Visitors</small>
                    <h6 class="mb-0 mt-1"><i class="icon-user"></i> 1,784</h6>
                </div>
            </div>
        </div>
    </div>
</div>   
<div class="row">
	<div class="col-lg-12">
        <div class="card">
            <div class="header">
                <a href="{{ url('doctors/add') }}" class="btn btn-info btn-sm"><i class="fa fa-plus-circle"></i> Add Doctors</a>    

                @if (session('success_status'))
                    <div class="alert alert-success alert-dismissible fade show mt-2 mb-0" role="alert">
                      <strong class="text-primary">Success! &#128521;</strong> {{ session('success_status') }}
                    </div>
                @endif
                @if (session('delete_status'))
                    <div class="alert alert-success alert-dismissible fade show mt-2 mb-0" role="alert">
                      <strong class="text-primary">Success! &#128521;</strong> {{ session('delete_status') }}
                    </div>
                @endif  
                @if (session('update_status'))
                    <div class="alert alert-success alert-dismissible fade show mt-2 mb-0" role="alert">
                      <strong class="text-primary">Success! &#128521;</strong> {{ session('update_status') }}
                    </div>
                @endif                       
            </div>
            <div class="body">
                <table id="table-dragger" class="table table-bordered table-striped table-hover dataTable js-exportable">
                    <thead>
                        <tr>
                            <th>SL.NO</th>
                            <th>Image</th>
                            <th>Name<i class="table-dragger-handle"></i></th>
                            <th>E-mail</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Mobile</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>SL.NO</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Mobile</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($doctors as $doctor)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    <img style="max-width: 50px" src="{{ asset('dashboard/photo/doctor_image') }}/{{ $doctor->image }}" class="img-fluid" alt="">
                                </td>
                                <td>{{ $doctor->first_name }}</th>
                                <td>{{ $doctor->email }}</th>
                                <td>{{ $doctor->department }}</th>
                                <td>{{ $doctor->designation }}</th>
                                <td>{{ $doctor->mobile }}</th>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a class="btn btn-warning btn-sm" href="{{ route('department.show', $doctor->id) }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form method="POST" action="{{ route('department.destroy', $doctor->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_top_script')
<script src="{{ asset('dashboard') }}/light/assets/bundles/datatablescripts.bundle.js"></script>
<script src="{{ asset('dashboard') }}/assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="{{ asset('dashboard') }}/assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('dashboard') }}/assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="{{ asset('dashboard') }}/assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="{{ asset('dashboard') }}/assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>
<script src="{{ asset('dashboard') }}/assets/vendor/table-dragger/table-dragger.min.js"></script>
@endsection
@section('footer_bottom_script')
<script src="{{ asset('dashboard') }}/light/assets/js/pages/tables/jquery-datatable.js"></script>
<script>
    tableDragger(document.querySelector("#table-dragger"));
</script>
@endsection