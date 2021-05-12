@extends('layouts.admin.master')
@section('main')
    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Rooms</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="text-center card-title">Create a new room type</h5>
                @if ($errors->any())
                    <div class="alert alert-danger text-small">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success text-small">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="col-md-6 mx-auto">
                    <form action="/admin/room_types" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <input type="radio" name="vicinity" value="on">On Campus
                            <input type="radio" name="vicinity" value="off">Off Campus
                        </div>

                        <input type="text" name="type" class="form-control mb-3" placeholder="Add Room Type">
                        <input type="submit" value="Create LodgeSpot" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <div class="col-md-6 mx-auto">
                    <h5 class="text-center">All LodgeSpot Locations</h5>
                    <div class="list-group-flush">
                        @foreach($rooms as $room)
                            <div class="list-group-item">
                                <span class="font-weight-bold">Vicitnity:</span>
                                {{ $room->vicinity }} campus<br/>
                                <span class="font-weight-bold">Room Type:</span>
                                {{ $room->type }}
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-danger" onclick="remove({{ $room->id }})"><i class="fas fa-remove"></i></button>
                                    <form action="/admin/room_types/{{ $room->id }}" id="remove{{ $room->id }}" method="post" style="display: none;">
                                        {{ method_field('DELETE') }}
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        {{ $rooms->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function remove(id){
            if (confirm("Do you want to remove this room") == true){
                document.getElementById("remove"+id).submit();
            }else {
                return;
            }
        }
    </script>
@endsection