@extends('admin.master_layout')
@section('title','Danh Sách Thể Loại')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Create Category</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.category.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label  class="form-label">Name Category</label>
                  <input type="text" name="name" class="form-control" placeholder="Enter name category">
                </div>
                <div class="mb-3">
                    <label>Chọn Category Parent</label>
                    <select name="parent_id" class="form-control">
                        <option value="">Danh Mục Cha</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
        <div class="card-footer">

        </div>
    </div>
@endsection
