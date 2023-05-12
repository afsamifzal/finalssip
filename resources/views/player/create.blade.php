@extends('layout.template')
 <!-- START FORM -->
 @section('content')



 <form action='{{url('player')}}' method='post'>
@csrf   
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <a href='{{url('player')}}' class="btn btn-secondary">Back</a>
        <div class="mb-3 row">
            <label for="playerid" class="col-sm-2 col-form-label">Player ID</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='playerid' value="{{Session::get('playerid')}}" id="playerid">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='name' value="{{Session::get('name')}}" id="name">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="team" class="col-sm-2 col-form-label">Team</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='team' value="{{Session::get('team')}}" id="team">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="team" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SAVE</button></div>
        </div>
      
    </div>
    </form>
    <!-- AKHIR FORM -->
 @endsection
 