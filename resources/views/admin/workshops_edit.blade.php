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
                <li >
                     <a href="{{ route('admin.workshops.show', $workshop->id) }}">{{ $workshop->name }}</a>
                </li>
                <li class="active">
                    <i class="fa fa-pencil"></i> Edit
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-info">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    Edit Workshop
                </div>

                <div class="panel-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('admin.workshops.update', ['workshop' => $workshop->id]) }}" enctype="multipart/form-data">

                        {{ method_field('PUT') }}

                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-2 control-label">Workshop Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $workshop->name) }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                            <label for="category_id" class="col-md-2 control-label">Workshop Category</label>

                            <div class="col-md-6">
                                <select class="form-control" id="category_id" name="category_id" required>
                                    @if(@categories)
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('category_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-2 control-label">Workshop Description</label>

                            <div class="col-md-6">
                                <textarea id="description" name="description" rows="5" cols="35" required autofocus>{{ old('description', $workshop->description) }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('reg_fee') ? ' has-error' : '' }}">
                            <label for="reg_fee" class="col-md-2 control-label">Reg Fee</label>

                            <div class="col-md-6">
                                <input type="number" class="form-control" id="reg_fee" name="reg_fee" value="{{ old('reg_fee', $workshop->reg_fee) }}" required autofocus>

                                @if ($errors->has('reg_fee'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reg_fee') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       
                       <div class="form-group{{ $errors->has('starts_on') ? ' has-error' : '' }}">
                            <label for="starts_on" class="col-md-2 control-label">Starts on</label>

                            <div class="col-md-6">
                                <input type="datetime-local" class="form-control" id="starts_on" name="starts_on"  value="{{ old('starts_on', $workshop->starts_on) }}" required>

                                @if ($errors->has('starts_on'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('starts_on') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ends_on') ? ' has-error' : '' }}">
                            <label for="ends_on" class="col-md-2 control-label">Ends on</label>

                            <div class="col-md-6">
                                <input type="datetime-local" class="form-control" id="ends_on" name="ends_on"  value="{{ old('starts_on', $workshop->ends_on) }}" required>

                                @if ($errors->has('ends_on'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ends_on') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('poster_image') ? ' has-error' : '' }}">
                            <label for="poster_image" class="col-md-2 control-label">Upload Poster</label>

                            <div class="col-md-6">
                                <input type="file" class="form-control" id="poster_image" name="poster_image" value="{{ old('poster_image') }}" required autofocus>

                                @if ($errors->has('poster_image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('poster_image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('thumbnail_image') ? ' has-error' : '' }}">
                            <label for="thumbnail_image" class="col-md-2 control-label">Upload Poster</label>

                            <div class="col-md-6">
                                <input type="file" class="form-control" id="thumbnail_image" name="thumbnail_image" value="{{ old('thumbnail_image') }}" required autofocus>

                                @if ($errors->has('thumbnail_image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('thumbnail_image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('pdf_file') ? ' has-error' : '' }}">
                            <label for="pdf_file" class="col-md-2 control-label">Upload PDF</label>

                            <div class="col-md-6">
                                <input type="file" class="form-control" id="pdf_file" name="pdf_file" value="{{ old('pdf_file') }}" required autofocus>

                                @if ($errors->has('pdf_file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pdf_file') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
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
            jQuery('#category_id').select2().select2('val', '{{ old('category_id', $workshop->category_id) }}' );
            jQuery('#type').select2();

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
        });
    </script>
@endsection