@extends('layouts.admin')
@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Text</th>
                    <th>Date</th>
                    <th>Product</th>
                    <th>Approve</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reviews as $review)
                    <tr>
                        <td>{{$review->id}}</td>
                        <td>{{$review->name}}</td>
                        <td>{{$review->text}}</td>
                        <td>{{(new DateTime($review->created_at))->format('d.m.Y H:i')}}</td>
                        <td>{{$review->productName()}}</td>
                        <td>
                            @if($review->isApproved)
                                <p class="alert alert-success">Approved</p>
                            @else
                                {{ Form::open(['url' => '/admin/reviews/'. $review->id, 'method' => 'POST', 'class' => "w-commerce-commercecheckoutcolumn"]) }}
                                <button type="submit" class="btn btn-success">Approve</button>
                                {{ Form::close() }}
                            @endif
                        </td>
                        <td>
                            {{ Form::open(['url' => '/admin/reviews/'. $review->id .'', 'method' => 'POST', 'class' => "w-commerce-commercecheckoutcolumn"]) }}
                            <button type="submit" class="btn btn-danger">Delete</button>
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection
