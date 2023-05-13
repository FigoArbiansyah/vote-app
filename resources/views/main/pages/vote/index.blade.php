@extends('main.layouts.main')

@section('content')
    <div class="row mt-5">
        @if (session('info'))
            <div class="alert alert-info" role="alert">
                {{ session('info') }}
            </div>
        @endif
        <div class="col">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User</th>
                        <th>Poll</th>
                        <th>Choice</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($votes as $key => $vote)
                        <tr>
                            <td>{{ $key += 1 }}</td>
                            <td>{{ $vote->name }}</td>
                            <td>{{ $vote->title }}</td>
                            <td>{{ $vote->choice }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
