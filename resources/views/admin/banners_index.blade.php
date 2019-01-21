@extends('admin.layouts.master')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Banners
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-calender"></i> Banners
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
           <div class="well">
               <kbd>API LINK</kbd>
               <a href="{{ secure_url('/').'/api/banners' }}">{{ secure_url('/').'/api/banners' }}</a> 
            </div>
            <div class="panel panel-info">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    Added Banners
                    <span class="pull-right">
                        <a href="{{ route('admin.banners.create') }}" class="btn btn-xs btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add Banner
                        </a>
                    </span>
                </div>

                <div class="panel-body">
                    <table id="example" class="table table-striped table-bordered" width="100%">
                        <thead>
                        <tr>
                            <th>Banner Image link</th>
                            <th>Page link</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($banners as $banner)
                                <tr>
                                    <td><img src="{{ asset('storage/' . $banner->banner_image) }}" class="img-thumbnail"></td>
                                    <td><a href="{{ $banner->e_w_page_link}}">{{ $banner->e_w_page_link}}</a></td>
                                    <td class="text-center">
                                        <button class="btn btn-block btn-danger" onclick="event.preventDefault(); confirmAndDelete('delete_banner_{{$banner->id}}')"><i class="fa fa-trash"></i> Delete</button>
                                        <form id="delete_banner_{{ $banner->id }}" action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" style="display: none;">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                        </form> 
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Banner Image link</th>
                            <th>Page link</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>

            </div>


        </div>
    </div>

    <div id="alert_modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"> <i class="fa fa-facebook-official" aria-hidden="true"></i> Error in Sharing</h4>
                </div>
                <div id="error_from_faceboook" class="modal-body">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function confirmAndDelete(formId) {
            if(confirm('Are you sure you want to delete this ..?')) {
                document.getElementById(formId).submit();
            }
        }

        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endsection