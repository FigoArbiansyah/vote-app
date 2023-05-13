@extends('main.layouts.main')

@section('content')
    <div class="row mt-5">
        @if (session('info'))
            <div class="alert alert-info" role="alert">
                {{ session('info') }}
            </div>
        @endif
        <div class="col">
            <div class="d-flex justify-content-between align-items-center mb-md-0 mb-3">
                <h1 class="font-bold">Pilihaken!</h1>
                @if (auth()->user()->role == 'admin')
                    <a href="/poll/create" class="btn btn-primary">+ Poll Baru</a>
                @endif
            </div>
            <p class="text-secondary">Adalah platform untuk melakukan voting secara digital.</p>
        </div>
    </div>
    <div class="row mt-3">
        @foreach ($polls as $poll)
            <div class="col-md-5 mb-3">
                <div class="card w-100" style="min-height: 10rem">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between align-items-center">
                                <h3>{{ $poll->title }}</h3>
                                @if (auth()->user()->role == 'admin')
                                    <form action="/poll/{{ $poll->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-default" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $poll->id }}">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                            <p class="text-secondary">{{ $poll->description }}</p>
                        </div>
                        <div>
                            <a href="/poll/{{ $poll->id }}" class="btn btn-primary btn-sm px-3">
                                Vote
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- MODAL DELETE --}}
            <div class="modal fade" id="delete{{ $poll->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Poll</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Yakin ingin menghapus polling <b>{{ $poll->title }}</b>?</p>
                        </div>
                        <div class="modal-footer">
                            <form action="/poll/{{ $poll->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Yakin!!!!</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
