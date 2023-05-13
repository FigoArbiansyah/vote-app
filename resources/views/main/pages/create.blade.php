@extends('main.layouts.main')

@section('content')
    <div class="row mt-5 pb-5">
        @if (session('danger'))
            <div class="alert alert-danger mb-3" role="alert">
                {{ session('danger') }}
            </div>
        @endif

        <div class="col">
            <h1 class="font-bold">Pilihaken!</h1>
            <p class="text-secondary">Buat poll baru.</p>
            <div>
                <form action="/poll" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="">Judul</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Deskripsi</label>
                        <textarea type="text" class="form-control" name="description">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Deadline</label>
                        <input type="datetime-local" class="form-control" name="deadline" value="{{ old('deadline') }}">
                    </div>
                    <div id="choices_wrapper">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <label for="">Choices</label>
                                <br>
                                <small class="text-muted">Masukkan choice minimal 2</small>
                            </div>
                            <button type="button" id="add_choice" class="btn btn-default my-3">Add Choice</button>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control choice" name="choices[]" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-danger remove-choice" type="button">&times;</button>
                            </div>
                        </div>
                    </div>
                    <div class="text-end"><button type="submit" class="btn btn-primary px-4">Submit</button></div>
                </form>
            </div>
        </div>
    </div>
@endsection
