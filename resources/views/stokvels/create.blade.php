@extends('app')

@section('content')
    <div class="container">
        <h1>Create a Stokvel</h1>

        <!-- if there are creation errors, they will show here -->
        {!! HTML::ul($errors->all()) !!}

        {!! Form::open(array('url' => 'stokvels')) !!}

        <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', Input::old('name'), array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('amount', 'Amount') !!}
            {!! Form::text('amount', Input::old('amount'), array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('start_end_date', 'Start and End Date') !!}
            <div class="input-daterange input-group" id="datepicker">
                {!! Form::text('start_date', Input::old('start_date'), array('class' => 'form-control input-sm')) !!}
                <span class="input-group-addon">to</span>
                {!! Form::text('end_date', Input::old('end_date'), array('class' => 'form-control input-sm')) !!}
            </div>
        </div>

        {{--<div class="form-group">--}}

            {{--<div class="input-group date">--}}
                {{--{!! Form::text('start_date', Input::old('start_date'), array('class' => 'form-control datepicker')) !!}--}}
                {{--<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
            {{--{!! Form::label('end_date', 'End Date') !!}--}}
            {{--<div class="input-group date">--}}
                {{--{!! Form::text('end_date', Input::old('end_date'), array('class' => 'form-control datepicker')) !!}--}}
                {{--<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="form-group">
            {!! Form::label('is_active', 'Active') !!}
            {!! Form::checkbox('is_active', Input::old('is_active'), array('class' => 'form-control')) !!}
        </div>


        {!! Form::submit('Create the Stokvel!', array('class' => 'btn btn-primary')) !!}

        {!! Form::close() !!}

    </div>

@endsection