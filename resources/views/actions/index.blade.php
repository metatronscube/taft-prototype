@extends('layouts.app')

@section('content')

        <!-- Bootstrap Boilerplate... -->

<div class="panel-body">
    <!-- Display Validation Errors -->
    @include('common.errors')

            <!-- New Action Form -->
    <form action="/action" method="POST" class="form-horizontal">
        {{ csrf_field() }}

                <!-- Action Name -->
        <div class="form-group row">
            <label for="action" class="col-sm-3 control-label">Action name</label>
            <div class="col-sm-6">
                <input type="text" name="name" id="action-name" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label for="action-description" class="col-sm-3 control-label">Description</label>
            <div class="col-sm-6">
                <input type="text" name="description" id="action-description" class="form-control">
            </div>
        </div>

        <!-- Add Action Button -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Add Action
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Current Actions -->
@if (count($actions) > 0)
    <div class="panel panel-default">
        <div class="panel-heading">
            Current Actions
        </div>

        <div class="panel-body">
            <table class="table table-striped action-table">

                <!-- Table Headings -->
                <thead>
                <th>Action</th>
                <th>Description</th>
                <th>Created by</th>
                </thead>

                <!-- Table Body -->
                <tbody>
                @foreach ($actions as $action)
                    <tr>
                        <!-- Action Name -->
                        <td class="table-text">
                            <div>{{ $action->name }}</div>
                        </td>
                        <!-- Action Description -->
                        <td class="table-text">
                            <div>{{ $action->description }}</div>
                        </td>
                        <!-- User Name -->
                        <td class="table-text">
                            <div>{{ $action->user->name }}</div>
                        </td>

                        <!-- Delete Button -->
                        <td>
                            <form action="/action/{{ $action->id }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button>Delete Action</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif

@endsection