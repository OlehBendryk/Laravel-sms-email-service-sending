@extends('layouts.master')

@section('content')
    <div class="container">

        <div class="row pt-3 pb-3 mb-3 border-bottom">
            <div class="col-6">
                <a href="{{route('template.index')}}" class="nav-link ">
                    <h5>Email Template</h5>
                </a>
            </div>
            <div class="col-6 text-right">
                <a href="{{route('template.create')}}" class="btn btn-primary">
                    <i class="fa fa-plus"></i>Create Email Template
                </a>
            </div>
        </div>

        <div class="card">
                <div class="card-header">Send Message </div>
                <div class="card-body">
                    {{ Form::open([
                             'route' => 'sending.store',
                             'method' => 'post',
                             'role' => 'form',
                             'enctype' => 'multipart/form-data',
                         ]) }}
                    @csrf
                    <div class="form-group row">

                        {{ Form::label('group_id', 'Recipients', ['class' => 'col-4 text-md-right']) }}
                        {{ Form::select('group_id', $recipients, null, ['class' => "form-control col-8 mb-2" .  ($errors->has('group_id') ? 'is-invalid' : ''), 'placeholder'=> 'Select Group'], ['required']) }}
                        @if($errors->has('group_id'))
                            <span class="invalid-feedback" role="alert"></span>
                            <strong> {{ $errors->first('group_id') }}</strong>
                        @endif

                        {{ Form::label('msg_template', 'Message template', ['class' => 'col-4 text-md-right']) }}
                        {{ Form::select('msg_template', $msg_templates, null, ['class' => "form-control col-8 mb-2" .  ($errors->has('msg_template') ? 'is-invalid' : ''), 'placeholder'=> 'Select Message Template'], ['required']) }}
                        @if($errors->has('msg_template'))
                            <span class="invalid-feedback" role="alert"></span>
                            <strong> {{ $errors->first('msg_template') }}</strong>
                        @endif

                        {{ Form::label('send_at', 'Time sending', ['class' => 'col-4 text-md-right']) }}
                        {{ Form::text('send_at', null, ['class' => "form-control col-8" .  ($errors->has('send_at') ? 'is-invalid' : ''), 'placeholder'=>'Year-month-day hour:minute (2021-12-31 10:00)'], 'required') }}

                    </div>

                    <div class="form-group mt-3 ">
                        {{ Form::submit('Send Message', ['class' => 'btn btn-primary']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>

    </div>

@endsection
