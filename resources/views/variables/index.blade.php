@extends('layouts.app')

@section('content')

        <!-- Bootstrap Boilerplate... -->

<div class="panel-body">
    <!-- Display Validation Errors -->
    @include('common.errors')

            <!-- New Variable Form -->
    <form action="/variable" method="POST" class="form-horizontal">
        {{ csrf_field() }}

                <!-- Variable Name -->
        <div class="form-group row">
            <label for="variable" class="col-sm-3 control-label">Variable name</label>
            <div class="col-sm-6">
                <input type="text" name="name" id="variable-name" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label for="variable-description" class="col-sm-3 control-label">Description</label>
            <div class="col-sm-6">
                <input type="text" name="description" id="variable-description" class="form-control">
            </div>
        </div>

        <!-- Add Variable Button -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Add Variable
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Current Variables -->
@if (count($variables) > 0)
    <div class="panel panel-default">
        <div class="panel-heading">
            Current Variables
        </div>

        <div class="panel-body">
            <table class="table table-striped variable-table">

                <!-- Table Headings -->
                <thead>
                <th>Variable</th>
                <th>Description</th>
                <th>Created by</th>
                </thead>

                <!-- Table Body -->
                <tbody>
                @foreach ($variables as $variable)
                    <tr>
                        <!-- Variable Name -->
                        <td class="table-text">
                            <div>{{ $variable->name }}</div>
                        </td>
                        <!-- Variable Description -->
                        <td class="table-text">
                            <div>{{ $variable->description }}</div>
                        </td>
                        <!-- User Name -->
                        <td class="table-text">
                            <div>{{ $variable->user->name }}</div>
                        </td>

                        <!-- Delete Button -->
                        <td>
                            <form action="/variable/{{ $variable->id }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button>Delete Variable</button>
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