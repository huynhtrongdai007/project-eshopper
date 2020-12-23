@extends('admin.master_layout')
@section('title','Tạo Permission')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Create Permission</h3>
        </div>
        <div class="card-body">
            @php
                $message = Session::get('message');  
            @endphp
            @if (isset($message))
                <div class="alert alert-success">{{$message}}</div>               
            @endif
            <form action="{{ route('admin.permission.store') }}" method="POST">
                @csrf
               <div class="mb-3">
                    <div class="form-group">
                        <label for="">Chọn menu cha</label>
                        <select class="form-control" name="module_parent">
                            <option value="">Module</option>
                            @foreach (config('permissions.table_module') as $moduleItem)
                            <option value="{{$moduleItem}}">{{$moduleItem}}</option>
                            @endforeach
                            
                        </select>
                    </div>
               </div>
               <div class="mb-3">
               <div class="container">
                <div class="row">
                    @foreach (config('permissions.module_chidrent') as $moduleChidrentItem)
                    <div class="col-md-3">
                        <input type="checkbox" name="module_chidrent[]" value="{{$moduleChidrentItem}}">
                        {{$moduleChidrentItem}} 
                    </div>
                   
                    @endforeach
                 
                </div>
               </div>
               </div>
           
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    </div>
@endsection
