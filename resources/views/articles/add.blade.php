@extends('layouts.app')
@section('content')

    <div class="container">

        @if ($errors->any())

            <div class="alert alert-warning">
                <ol>
                    @foreach ($errors->all() as $error)

                        <li>{{$error}}</li>
                        
                    @endforeach
                </ol>
            </div>
            
        @endif

        <form action="{{ url('/articles/add') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title">
            </div>
            <div class="mb-3">
                <label for="body">Body</label>
               <textarea name="body" id="body" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="category">Category</label>
                <select name="category_id" id="category">
                    @foreach ($categories as $category)
                        <option value="{{$category['id']}}">
                            {{$category['name']}}
                        </option>
                    @endforeach
                </select>
            </div>
            <input type="submit" value="Add Article" class="btn btn-primary">
        </form>
    </div>
    
@endsection