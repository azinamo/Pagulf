@extends('app')

@section('content')
<div class="container">
    <h1>{{ $stokvel->name  }}</h1>
    <table width="100%" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Position</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @if($user_stokvel->count())
                @foreach($user_stokvel as $stokvel_user)
                    <tr>
                        <td>{{ $stokvel_user->position  }}</td>
                        <td>{{ $stokvel_user->user->name  }}</td>
                    </tr>
                @endforeach
           @else
                <tr>
                    <td colspan="6">There are no stokvel users available</td>
                </tr>
           @endif
        </tbody>
    </table>
    @if($user_stokvel->count() && !$stokvel->has_payment_order)
        <a href="{{ URL::to('stokvels/generate/'.$stokvel->id) }}" class="btn btn-success">Generate Order</a>
    @endif

</div>
@endsection
