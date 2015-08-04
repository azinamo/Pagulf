@extends('app')

@section('content')
<div class="container">
    <table width="100%" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Position</th>
                <th>Name</th>
                <th>Members</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(count($stokvel) > 0)
                <tr>
                    @foreach($stokvel->users as $stokvel_user)
                        <td>{{ $stokvel_user->position  }}</td>
                        <td>{{ $stokvel_user->pivot->first_name  }}</td>
                        <td>{{ $stokvel_user->id  }}</td>
                        <td></td>
                    @endforeach
                </tr>
           @else
                <tr>
                    <td colspan="6">There are no stokvel users available</td>
                </tr>
           @endif
        </tbody>
    </table>
    <a href="{{ URL::to('stokvels/create') }}" class="btn btn-primary">Generate Order</a>

</div>
@endsection
