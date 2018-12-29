@extends('admin.layouts.master')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Workshops
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-calender"></i> Workshops
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-info">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    Added Workshops
                    <span class="pull-right">
                        <a href="{{ route('admin.workshops.create') }}" class="btn btn-xs btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add Workshop
                        </a>
                    </span>
                </div>

                <div class="panel-body">
                    <table id="example" class="table table-striped table-bordered" style="width:100%;">
                        <thead>
                        <tr>
                            <th>Workshop Name</th>
                            <th>Workshop Category</th>
                            <th>Share On FB</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($workshops as $workshop)
                                <tr>
                                    <td>{{ $workshop->name }}</td>
                                    <td>{{ $workshop->category->name }}</td>
                                    <td class="text-center">
                                      <div class="fb-share-button" 
                                        data-href="{{ route('display_workshop', $workshop->slug) }}" 
                                        data-layout="button_count">
                                      </div>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.workshops.show', ['workshop' => $workshop->id ]) }}" class="btn btn-xs btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                                        <a href="{{ route('display_workshop', $workshop->slug) }}" class="btn btn-xs btn-primary"><i class="fa fa-external-link" aria-hidden="true"></i> View on website</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Workshop Name</th>
                            <th>Workshop Category</th>
                            <th>Share On FB</th>
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
        // function shareOnFB(eventId) {
        //     var base_uri = '{{ url('') }}';
        //     var share_btn = document.getElementById(`share_btn_id_${eventId}`);
        //     share_btn.disabled = true;
        //     share_btn.lastElementChild.textContent = 'Sharing...';
        //     axios.post(`${base_uri}/admin/events/share/${eventId}`)
        //         .then(res => {
        //             if(res.data.shared_post_url) {
        //                 share_btn.style.display = 'none';
        //                 var link = document.createElement('a');
        //                 link.href = res.data.shared_post_url;
        //                 link.target = '_blank';
        //                 link.textContent = 'View Post';
        //                 share_btn.parentElement.appendChild(link);
        //             } else {
        //                 var error_display_div = document.getElementById('error_from_faceboook');
        //                 error_display_div.textContent = res.data.error_msg;
        //                 $('#alert_modal').modal('show');
        //                 share_btn.disabled = false;
        //                 share_btn.lastElementChild.textContent = 'Share';
        //             }
        //         }).catch((e) => console.error(e));
        // }

        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
@endsection