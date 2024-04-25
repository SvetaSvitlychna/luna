@extends('layouts.admin')
@section('title')
 {{$title}}
@endsection
@section('content')
<div class="row" style="margin-bottom: 50px;">
<div class="col-lg-12" style="width:5px;height:5px"> 
  <div><strong>{{$subtitle}}</strong></div>
  <div>
  <a href="{{route('post.create')}}" class="btn btn-success float-right">Add category</a>
  <a class="btn btn-danger float-right" href="{{route('post.trashed')}}"> Trashed Post</a>
  <a href="{{url('admin')}}" class="btn btn-success float-left">Back</a></div></div></div>

    <div class="card">
      <div class="card-header">
        Posts list
      </div>
      <div class="card-body">
        <div class="table-responsive">
<table class="table table-bordered table-striped table-hover">
  <thead>
    <tr>
        <th width="50" >#</th>
        <th width="150">name</th>
        <th width="150">created_at</th>
        <th width="150">actions</th>
    </tr></thead> 
    <tbody>
      @foreach($posts as $post)
      <tr data-enty-id="{{$post->id}}"></tr>
       <td style="text-align: center;"width="50">{{$post->id ?? ''}}</td>
    
    <td style="text-align: center;"width="150">{{$post->title ?? ''}}</td>
    
    <td style="text-align: center;" width="150">{{$post->created_at ?? ''}}</td>
<td style="text-align: center;" width="150" >
  <a href="{{route('post.show',$post->id)}}" class="btn btn-info ">Show</a>
  <a href="{{route('post.edit',$post->id)}}" class="btn btn-primary ">Edit</a>
  <form method='POST' action="{{route('post.delete', $post->id)}}" 
                                style="display:inline;-block;" onsubmit="return confirm('Are you sure?');">
                          
                                @csrf
                            @method('DELETE')
                          
                            <input type='submit' class="btn btn-xs btn-danger" value="Delete">
                            </form> 
</td></tr>
@endforeach   
</tbody>
        
</table>
{{$posts->links()}}
        </div>
      </div>
    </div>
    
 
@endsection
@section('scripts')
@parent
<script src="{{ asset('js/select2.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $('.select2').select2();
    });
</script>
@endsection
  