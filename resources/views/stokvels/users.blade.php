@extends('app')

@section('content')
<div class="container">
    <table width="100%" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Position</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @if($stokvel->users()->count())
                <tr>
                    @foreach($stokvel->users as $stokvel_user)
                        <td>{{ $stokvel_user->position  }}</td>
                        <td>{{ $stokvel_user->email  }}</td>
                    @endforeach
                </tr>
           @else
                <tr>
                    <td colspan="6">There are no stokvel users available</td>
                </tr>
           @endif
        </tbody>
    </table>
    @if($stokvel->users()->count())
        <a href="{{ URL::to('stokvels/create') }}" class="btn btn-success">Generate Order</a>
    @endif

</div>
@endsection
