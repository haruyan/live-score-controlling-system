@extends('layouts.app', ['activePage' => 'match-live', 'titlePage' => __('Match Live')])

@if(Auth::user()->role == 'admin')
  @include('app.match-live.index.admin')
@elseif(Auth::user()->role == 'arbitre')
  @include('app.match-live.index.arbitre')
@endif