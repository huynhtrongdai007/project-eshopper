@extends('admin.master_layout')
@section('title','Tạo Menu')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Create Menu</h3>
        </div>
        <div class="card-body">
            @php
                $message = Session::get('message');  
            @endphp
            @if (isset($message))
                <div class="alert alert-success">{{$message}}</div>               
            @endif
            <form action="{{ route('admin.menu.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label  class="form-label">Name Menu</label>
                  <input type="text" name="name" class="form-control" placeholder="Enter name Menu">
                </div>
                <div class="mb-3">
                    <label>Chọn Menu Parent</label>
                    <select name="parent_id" class="form-control">
                      <option value="0">Menu Cha</option>
                        {!! $optionSelect !!}
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
        <div class="card-footer">

        </div>
    </div>
@endsection
