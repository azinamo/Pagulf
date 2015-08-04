@extends('app')

@section('content')
    <div class="container">
        <h1>Invite someone to join {{ $stokvel->name }}</h1>

        <!-- if there are creation errors, they will show here -->
        {!! HTML::ul($errors->all()) !!}

        {!! Form::open(array('url' => 'stokvels/invite/'.$stokvel->id)) !!}

        <div class="form-group">
            {!! Form::label('email_address', 'Enter email address') !!}
            {!! Form::text('email_address', Input::old('email_address'), array('class' => 'form-control')) !!}
        </div>

        {!! Form::submit('Send Invite', array('class' => 'btn btn-primary')) !!}

        {!! Form::close() !!}

    </div>

@endsection