@extends('layouts.admin')

@section('title')
    <title>Trang chủ</title>

@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- /.content-header -->
        @include('partials.content-header', ['name' => 'Category', 'key' => 'Add'])
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6" >
                        <form action="{{route('categories.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Tên danh mục</label>
                                <input type="text" class="form-control" name="name" placeholder="Nhập tên danh mục">
                            </div>

                            <div class="form-group">
                                <label>Chọn danh mục</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0">Chọn danh mục cha</option>
                                    {!! $htmlOption !!}
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit </button>

                        </form>
                    </div>

                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>

@endsection
