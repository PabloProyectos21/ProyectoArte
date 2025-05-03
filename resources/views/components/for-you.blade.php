<?php
@foreach ($usuarios as $user)
    @include('components.user-card', [
        'user' => $user,
        'isFollowing' => auth()->user()->following->contains($user->id)
    ])
@endforeach
