@extends('errors::minimal')

@section('title', __($exception->getMessage()))
@section('code', '419')
@section('message', __($exception->getMessage()))
