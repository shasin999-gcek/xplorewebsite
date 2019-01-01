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
                    <i class="fa fa-calendar"></i> <a href="{{ route('admin.events.index') }}">Events</a>
                </li>
                <li class="active">
                    {{ $event->name }}
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="well">
                <a href="{{ route('display_event', ['category' => $event->category->short_name, 'slug' => $event->slug]) }}">{{ route('display_event', ['category' => $event->category->short_name, 'slug' => $event->slug]) }}</a>
                <div class="pull-right">
                    <a href="{{ route('admin.events.edit', ['id' => $event->id]) }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                    <button id="delete_event" class="btn btn-sm btn-danger"> <i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                    <form id="delete_event_form" action="{{ route('admin.events.destroy', $event->id) }}" method="POST" style="display: none;">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
            <div class="panel panel-info">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    {{ $event->name }}
                </div>

                <div class="panel-body">

                    <form class="form-horizontal">

                        <div class="form-group">
                            <label for="name" class="col-md-2 control-label">Event Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control"  value="{{ $event->name }}" readonly>


                            </div>
                        </div>

                        <div class="form-group">
                            <label for="category_id" class="col-md-2 control-label">Event Category</label>

                            <div class="col-md-6">
                                <select class="form-control" readonly>
                                    <option value="{{ $event->category->name }}">{{ $event->category->name }}</option>
                                </select>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="type" class="col-md-2 control-label">Event Type</label>

                            <div class="col-md-6">
                                <select class="form-control" readonly>
                                    <option value="{{ $event->type }}" selected>{{ $event->type }}</option>

                                </select>


                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-2 control-label">Event Description</label>

                            <div class="col-md-6">
                                <textarea id="description" readonly>{{ $event->description }}</textarea>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="reg_fee" class="col-md-2 control-label">Reg Fee</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-addon">Rs</div>
                                    <input type="number" class="form-control" value="{{ $event->reg_fee }}" readonly>
                                    <div class="input-group-addon">.000</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="f_price" class="col-md-2 control-label">First Prize</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-addon">Rs</div>
                                    <input type="number" class="form-control" value="{{ $event->f_price_money }}" readonly>
                                    <div class="input-group-addon">.000</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="s_price" class="col-md-2 control-label">Second Prize</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-addon">Rs</div>
                                    <input type="number" class="form-control" value="{{ $event->s_price_money }}" readonly>
                                    <div class="input-group-addon">.000</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="t_price" class="col-md-2 control-label">Third Prize</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-addon">Rs</div>
                                    <input type="number" class="form-control" value="{{ $event->t_price_money }}" readonly>
                                    <div class="input-group-addon">.000</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="poster_image" class="col-md-2 control-label">Poster</label>

                            <div class="col-md-6">
                                <img src="{{ asset('storage/' . $event->poster_image) }}" alt="..." class="img-thumbnail">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="thumbnail_image" class="col-md-2 control-label">Thumbnail</label>

                            <div class="col-md-6">
                                <img src="{{ asset('storage/' . $event->thumbnail_image) }}" alt="..." class="img-thumbnail">
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

            $('#description').summernote('disable');

            $('#delete_event').on('click', function (e) {
                e.preventDefault();
                var answer = confirm("Are you sure to delete this event, this operation cannot be undone");
                if(answer) {
                    $('#delete_event_form').submit();
                }
            })
        });
    </script>
@endsection