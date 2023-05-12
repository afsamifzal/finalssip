@extends('layout.template')
        <!-- START DATA -->
        @section('content')
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <!-- FORM PENCARIAN -->
            <div class="pb-3">
              <form class="d-flex" action="{{url('player')}}" method="get">
                  <input class="form-control me-1" type="search" name="keyword" value="{{ Request::get('keyword') }}" placeholder="Enter the keyword" aria-label="Search">
                  <button class="btn btn-secondary" type="submit">Search</button>
              </form>
            </div>
            
            <!-- TOMBOL TAMBAH DATA -->
            <div class="pb-3">
              <a href='{{url('player/create')}}' class="btn btn-primary">+ Tambah Data</a>
            </div>
      
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-3">Player ID</th>
                        <th class="col-md-4">Name</th>
                        <th class="col-md-2">Team</th>
                        <th class="col-md-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = $data->firstItem() ?>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$item->playerid}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->team}}</td>
                        <td>
                            <a href='{{url('player/'.$item->playerid.'/edit')}}' class="btn btn-warning btn-sm">Edit</a>
                            <form onsubmit="return confirm('Do you really want to delete this data?')" class='d-inline' action="{{url('player/'.$item->playerid)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" name="submit"  class="btn btn-danger btn-sm">Del</button>
                            </form>
                        </td>
                    </tr>
                    <?php $i++ ?>
                    @endforeach
                </tbody>
            </table>
           {{$data->withQueryString()->links()}}
      </div>
      <!-- AKHIR DATA -->
     @endsection
        
    