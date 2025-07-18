@extends('admin.master_layout')
@section('title','Tạo Thể Loại')
@section('content')
    <div class="card">
        <div class="card-body">
            @php
                $message = Session::get('message');  
            @endphp
            @if (isset($message))
                <div class="alert alert-success">{{$message}}</div>               
            @endif
            <form action="{{ route('admin.category.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label  class="form-label">Name Category</label>
                  <input type="text" name="name" class="form-control" placeholder="Enter name category">
                </div>
                <div class="mb-3">
                    <label>Chọn Category Parent</label>
                    <select name="parent_id" class="form-control">
                      <option value="0">Danh Mục Cha</option>
                        {!!$htmlOption!!}
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
        <div class="card-footer">

        </div>
    </div>
@endsection
