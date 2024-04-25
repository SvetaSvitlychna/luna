@extends('layouts.admin')
@section('title')
 {{$title}}
@endsection
@section('content')
<div class="row" style="margin-bottom: 50px;">
<div class="col-lg-12" style="width:5px;height:5px"> 
  <div><strong>{{$subtitle}}</strong></div>
  <div>
  <a href="{{route('tags.create')}}" class="btn btn-success float-right">Add tag</a>
  <a class="btn btn-danger float-right" href="{{route('tags.trashed')}}"> Trashed Post</a>
  <a href="{{url('admin')}}" class="btn btn-success float-left">Back</a></div></div></div>

    <div class="card">
      <div class="card-header">
        Tags list
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
      @foreach($tags as $tag)
      <tr data-enty-id="{{$tag->id}}"></tr>
       <td style="text-align: center;"width="50">{{$tag->id ?? ''}}</td>
    
    <td style="text-align: center;"width="150">{{$tag->name ?? ''}}</td>
    
    <td style="text-align: center;" width="150">{{$tag->created_at ?? ''}}</td>
<td style="text-align: center;" width="150" >
  <a href="{{route('tags.show',$tag->id)}}" class="btn btn-info ">Show</a>
  <a href="{{route('tags.edit',$tag->id)}}" class="btn btn-primary ">Edit</a>
  {{-- <form action="{{route('tag.destroy', $tag->id)}}" method="POST" style="display: inline-block" onsubmit="return confirm('Are you sure?');" >

    @csrf
    @method("DELETE")
<input type="submit" class="btn btn-xs btn-danger" value="Delete">
</form> --}}
<form method='POST' action="{{route('tags.delete', $tag->id)}}" 
                                style="display:inline;-block;" onsubmit="return confirm('Are you sure?');">
                          
                                @csrf
                            @method('DELETE')
                          
                            <input type='submit' class="btn btn-xs btn-danger" value="Delete">
                            </form> 
</td></tr>
@endforeach   
</tbody>
        
</table>
{{$tags->links()}}
        </div>
      </div>
    </div>
    
 
@endsection

  