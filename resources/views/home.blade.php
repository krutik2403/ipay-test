@extends('layouts.app')
@section('css')
<style>
    svg{width:30px !important;}
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in as') }} {{auth()->user()->role()}}
                </div>
            </div>
        </div>
    </div>
    <br/>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Students') }}</div>
                <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#createstudent">Add Student</button>
                <div class="card-body">
                   <table class="table table-striped">
                       <thead>
                           <tr>
                               <th>First Name</th>
                               <th>Last Name</th>
                               <th>Address</th>
                               <th>Action</th>
                           </tr>
                       </thead>
                       <tbody>
                           @forelse($students as $student)
                           <tr>
                               <td>{{$student->first_name}}</td>
                               <td>{{$student->last_name}}</td>
                               <td>{{$student->address}}</td>
                               <td><a href="{{route('students.edit',['id'=>$student->id])}}">Edit</a>
                                <a href="{{route('students.destroy',['id'=>$student->id])}}">Delete</a>
                                </td>
                           </tr>
                           @empty
                           <tr><td colspan="4">No Data.</td></tr>
                           @endforelse
                       </tbody>
                   </table>
                   {{$students->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="createstudent" tabindex="-1" role="dialog" aria-labelledby="createstudentLabel" aria-hidden="true">
<form method="POST" action="{{ (isset($student_edit)) ?route('students.update',['id'=>$student_edit->id]) :route('students.store') }}" enctype="multipart/form-data">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                @csrf
            
                <div class="form-group row">
                    <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                    <div class="col-md-6">
                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name"  required autocomplete="first_name" autofocus value="{{(isset($student_edit)) ? $student_edit->first_name : old('first_name')}}">

                        @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                    <div class="col-md-6">
                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{(isset($student_edit)) ? $student_edit->last_name : old('last_name')}}" required autocomplete="last_name" autofocus>

                        @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                    <div class="col-md-6">
                        <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address">{{(isset($student_edit)) ? $student_edit->address : old('address')}}</textarea>
                         @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</form>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(function(){

    @if(isset($student_edit) || $errors->any())
    $('#createstudent').modal('show'); 
    @endif
    });
</script>
@endsection
