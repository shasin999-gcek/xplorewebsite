@extends('admin.layouts.master')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Workshop
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li>
                    <i class="fa fa-calendar"></i> <a href="{{ route('admin.workshops.index') }}">Workshop</a>
                </li>
                <li class="active">
                    {{ $workshop->name }}
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="well">
                <a href="{{ url('/workshop/' . $workshop->slug) }}">{{ url('/workshops/' . $workshop->slug) }}</a>
                <div class="pull-right">
                    <a href="{{ route('admin.workshops.edit', ['id' => $workshop->id]) }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                    <button id="delete_workshop" class="btn btn-sm btn-danger"> <i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                    <form id="delete_workshop_form" action="{{ route('admin.workshops.destroy', $workshop->id) }}" method="POST" style="display: none;">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
            <div class="panel panel-info">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    {{ $workshop->name }}
                </div>

                <div class="panel-body">

                    <form class="form-horizontal">

                        <div class="form-group">
                            <label for="name" class="col-md-2 control-label">Workshop Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control"  value="{{ $workshop->name }}" readonly>


                            </div>
                        </div>

                        <div class="form-group">
                            <label for="category_id" class="col-md-2 control-label">Workshop Category</label>

                            <div class="col-md-6">
                                <select class="form-control" readonly>
                                    <option value="{{ $workshop->category->name }}">{{ $workshop->category->name }}</option>
                                </select>

                            </div>
                        </div>

                       

                        <div class="form-group">
                            <label for="name" class="col-md-2 control-label">Workshop Description</label>

                            <div class="col-md-6">
                                <textarea id="description" rows="5" cols="35" readonly>{{ $workshop->description }}</textarea>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="reg_fee" class="col-md-2 control-label">Reg Fee</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-addon">Rs</div>
                                    <input type="number" class="form-control" value="{{ $workshop->reg_fee }}" readonly>
                                    <div class="input-group-addon">.000</div>
                                </div>
                            </div>
                        </div>

                         <div class="form-group">
                            <label for="starts_on" class="col-md-2 control-label">Starts on</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" value="{{ $workshop->starts_on->toDayDateTimeString() }}" readonly>

                
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ends_on" class="col-md-2 control-label">Ends on</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control"  value="{{ $workshop->ends_on->toDayDateTimeString() }}" readonly>

                            </div>
                        </div>

                       
                        <div class="form-group">
                            <label for="poster_image" class="col-md-2 control-label">Poster</label>

                            <div class="col-md-6">
                                <img src="{{ asset('storage/' . $workshop->poster_image) }}" alt="..." class="img-thumbnail">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="thumbnail_image" class="col-md-2 control-label">Thumbnail</label>

                            <div class="col-md-6">
                                <img src="{{ asset('storage/' . $workshop->thumbnail_image) }}" alt="..." class="img-thumbnail">
                            </div>
                        </div>

                         <div class="form-group">
                            <label for="pdf_file" class="col-md-2 control-label">More Details</label>

                            <div class="col-md-6">
                                <a href="{{ asset('storage/' . $workshop->pdf_path) }}" alt="..." class="btn btn-primary">View</a>
                            </div>
                        </div>

                    </form>
                </div>

            </div>


        </div>
    </div>
@endsection

@section('scripts')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
    <script>
        jQuery(document).ready(function () {
            // jQuery('#description').summernote({
            //     toolbar: [
            //         // [groupName, [list of button]]
            //         ['style', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
            //         ['font', ['hr', 'undo', 'redo']],
            //         ['fontsize', ['fontsize']],
            //         ['color', ['color']],
            //         ['para', ['ul', 'ol', 'paragraph']],
            //     ],
            //     placeholder: 'write description...',
            //     height: 200,
            //     minHeight: 200,
            //     maxHeight: 200,
            //     focus: false
            // });

          //  $('#description').summernote('disable');

            $('#delete_workshop').on('click', function (e) {
                e.preventDefault();
                var answer = confirm("Are you sure to delete this workshop, this operation cannot be undone");
                if(answer) {
                    $('#delete_workshop_form').submit();
                }
            })
        });
    </script>
@endsection