@extends('layouts.admin')

@section('title')
    <title>Add product</title>

@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header',['name' => 'product', 'key' => 'List'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href=" " class="btn btn-success float-right m-2">Add</a>
                    </div>
                    <div class="col-md-12">

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Hinh ảnh</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col"><Acti></Acti>on</th>
                            </tr>
                            </thead>
                            <tbody>


{{--                            @foreach($categories as $category)--}}
                                <tr>
                                    <th scope="row">1</th>
                                    <td>ip10</td>
                                    <td>2.33333.333</td>
                                    <td>
                                        <img src="">
                                    </td>
                                    <td>Dien thoai</td>
                                    <td>
                                        <a href="" class="btn btn-default">Edit</a>
                                        <a href="" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
{{--                            @endforeach--}}

                            </tbody>
                        </table>

                    </div>
                    <div class="col-md-12">
{{--                        {{ $categories->links() }}--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
