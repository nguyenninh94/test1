@extends('layouts.app')

@section('content')
    
    <div class="container">
    	<div class="col-lg-4">
    		<div class="panel panel-default">
    			<div class="panel-heading text-center">
    				{{ $user->name }}
    			</div>

    			<div class="panel panel-body text-center">
    				<img src="{{ $user->avatar }}" width="140px" height="140px" style="border-radius:50%;" alt="">
                    <p>
                        {{ $user->profile->location }}
                    </p>
    				<p>
    					@if(Auth::id() == $user->id)
                           <a href="{{ route('profile.edit') }}" class="btn btn-lg btn-info">Update Your Profile</a>
    					@endif
    				</p>
    			</div>
    		</div>
            
            @if(Auth::id() !== $user->id)
            <div class="panel panel-default">
                <div class="body" id="app">
                    <friend :profile_user_id="{{ $user->id }}"></friend>
                </div>
            </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    About me
                </div>

                <div class="panel panel-body text-center">
                     {{ $user->profile->about }}
                </div>
            </div>
    	</div>
    </div>

@stop