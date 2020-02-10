@extends('layouts.app', ['activePage' => 'match-all', 'titlePage' => __('Match Management')])

@if(Auth::user()->role == 'admin')
  @include('app.match.index.admin')
@elseif(Auth::user()->role == 'arbitre')
  @include('app.match.index.arbitre')
@endif