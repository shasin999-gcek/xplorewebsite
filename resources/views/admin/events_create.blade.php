@extends('admin.layouts.master')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Events
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li>
                    <i class="fa fa-calender"></i> <a href="{{ route('admin.events.index') }}">Events</a>
                </li>
                <li class="active">
                    <i class="fa fa-calender"></i> Add
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-info">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    Add New Event
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

                    <form class="form-horizontal" method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-2 control-label">Event Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                            <label for="category_id" class="col-md-2 control-label">Event Category</label>

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

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-2 control-label">Event Type</label>

                            <div class="col-md-6">
                                <select class="form-control" id="type" name="type"  required>
                                    <option value="Individual" {{ old('type') == 'Individual' ? 'selected': '' }} >Individual</option>
                                    <option value="Team"  {{ old('type') == 'Team' ? 'selected': '' }}>Team</option>
                                </select>

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-2 control-label">Event Description</label>

                            <div class="col-md-6">
                                <textarea id="description" name="description"  required autofocus>{{ old('description') }}</textarea>

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
                                <div class="input-group">
                                    <div class="input-group-addon">Rs</div>
                                    <input type="number" class="form-control" id="reg_fee" name="reg_fee" value="{{ old('reg_fee') }}" required autofocus>
                                </div>
                                @if ($errors->has('reg_fee'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reg_fee') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('f_price') ? ' has-error' : '' }}">
                            <label for="f_price" class="col-md-2 control-label">First Prize</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-addon">Rs</div>
                                    <input type="number" class="form-control" id="f_price" name="f_price" value="{{ old('f_price') }}" required autofocus>
                                </div>
                                @if ($errors->has('f_price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('f_price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('s_price') ? ' has-error' : '' }}">
                            <label for="s_price" class="col-md-2 control-label">Second Prize</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-addon">Rs</div>
                                    <input type="number" class="form-control" id="s_price" name="s_price" value="{{ old('s_price') }}" required autofocus>
                                </div>
                                @if ($errors->has('s_price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('s_price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('t_price') ? ' has-error' : '' }}">
                            <label for="t_price" class="col-md-2 control-label">Third Prize</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-addon">Rs</div>
                                    <input type="number" class="form-control" id="t_price" name="t_price" value="{{ old('t_price') }}" required autofocus>
                                </div>
                                @if ($errors->has('t_price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('t_price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('datetime') ? ' has-error' : '' }}">
                            <label for="datetime" class="col-md-2 control-label">Date & Time</label>

                            <div class="col-md-6">
                                <input type="datetime-local" class="form-control" id="datetime" name="datetime"  required disabled>

                                @if ($errors->has('datetime'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('datetime') }}</strong>
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
                            <label for="thumbnail_image" class="col-md-2 control-label">Upload Thumbnail</label>

                            <div class="col-md-6">
                                <input type="file" class="form-control" id="thumbnail_image" name="thumbnail_image" value="{{ old('thumbnail_image') }}" required autofocus>

                                @if ($errors->has('thumbnail_image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('thumbnail_image') }}</strong>
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
            jQuery('#category_id').select2().select2('val', '{{ old('category_id') }}' );
            jQuery('#type').select2();
            jQuery('#description').summernote({
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                    ['font', ['hr', 'undo', 'redo']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                ],
                placeholder: 'write description...',
                height: 200,
                minHeight: 200,
                maxHeight: 200,
                focus: false
            });
        });
    </script>
@endsection