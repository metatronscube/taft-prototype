@extends('layouts.app')

@section('content')

        <!-- Bootstrap Boilerplate... -->

<div class="panel-body">
    <!-- Display Validation Errors -->
    @include('common.errors')

            <!-- New Item Form -->
    <form action="/item" method="POST" class="form-horizontal">
        {{ csrf_field() }}

                <!-- Item Name -->
        <div class="form-group">
            <label for="item" class="col-sm-3 control-label">Item</label>

            <div class="col-sm-6">
                <input type="text" name="name" id="item-name" class="form-control">
            </div>
        </div>

        <!-- Add Item Button -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Add Item
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Current Items -->
@if (count($items) > 0)
    <div class="panel panel-default">
        <div class="panel-heading">
            Current Items
        </div>

        <div class="panel-body">
            <table class="table table-striped item-table">

                <!-- Table Headings -->
                <thead>
                <th>Item</th>
                <th>Created by</th>
                </thead>

                <!-- Table Body -->
                <tbody>
                @foreach ($items as $item)
                    <tr>
                        <!-- Item Name -->
                        <td class="table-text">
                            <div>{{ $item->name }}</div>
                        </td>
                        <!-- User Name -->
                        <td class="table-text">
                            <div>{{ $item->user->name }}</div>
                        </td>

                        <!-- Delete Button -->
                        <td>
                            <form action="/item/{{ $item->id }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button>Delete Item</button>
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