    @extends('layouts.app')

    @section('content')
<div class="container">
    <div class="flex-center position-ref full-height">

        <div class="content">
            <div class="title m-b-md">
                The Task
            </div>

            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>

            @endif

            @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{Session::get('error')}}
                </div>
            @endif


            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">task</th>
                    <th scope="col">operation</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($tasks) && $tasks -> count() > 0)
                    @foreach($tasks as $task)
                        <tr>
                            <th scope="row">{{$task -> id}}</th>

                            <td style="text-decoration: {{$task->type == 1 ? $s= 'line-through':''}}">{{$task-> name}}</td>
                            <td><a href="{{route('task.edit',$task -> id)}}" type="button" class="btn btn-info">update</a>
                                <a href="{{route('task.delete',$task -> id)}}"  class="delete_btn   btn btn-danger">Delete</a>
                                <form style="display: inline;" method="post" action="{{route('send.type',$task->id)}}">
                                    @csrf
                                    <button  type="submit" class="btn btn-warning">State</button>
                                </form>
                            </td>


                        </tr>



                    @endforeach
                @endif
                </tbody>
            </table>
            <a href="{{route('task.create')}}" type="button" class="btn btn-success">Adding</a>
        </div>
    </div>
</div>
@endsection
