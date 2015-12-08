@extends('layouts.app')

@section('content')

        <!-- Bootstrap Boilerplate... -->

<div class="panel-body">
    <!-- Display Validation Errors -->
    @include('common.errors')

            <!-- New Zone Form -->
    <form action="/zone" method="POST" class="form-horizontal">
        {{ csrf_field() }}

                <!-- Zone Name -->
        <div class="form-group row">
            <label for="zone" class="col-sm-3 control-label">Zone name</label>
            <div class="col-sm-6">
                <input type="text" name="name" id="zone-name" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label for="zone-description" class="col-sm-3 control-label">Description</label>
            <div class="col-sm-6">
                <input type="text" name="description" id="zone-description" class="form-control">
            </div>
        </div>

        <!-- Add Zone Button -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Add Zone
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Current Zones -->
@if (count($zones) > 0)
    <div class="panel panel-default">
        <div class="panel-heading">
            Current Zones
        </div>

        <div class="panel-body">
            <table class="table table-striped zone-table">

                <!-- Table Headings -->
                <thead>
                <th>Zone</th>
                <th>Description</th>
                <th>Created by</th>
                </thead>

                <!-- Table Body -->
                <tbody>
                @foreach ($zones as $zone)
                    <tr>
                        <!-- Zone Name -->
                        <td class="table-text">
                            <div>{{ $zone->name }}</div>
                        </td>
                        <!-- Zone Description -->
                        <td class="table-text">
                            <div>{{ $zone->description }}</div>
                        </td>
                        <!-- User Name -->
                        <td class="table-text">
                            <div>{{ $zone->user->name }}</div>
                        </td>

                        <!-- Delete Button -->
                        <td>
                            <form action="/zone/{{ $zone->id }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button>Delete Zone</button>
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