@extends('main.layouts.main')

@section('content')
    @if (session('info'))
        <div class="alert alert-info" role="alert">
            {{ session('info') }}
        </div>
    @endif

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card border-0 w-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-md-flex justify-content-between align-items-center">
                            <h3>{{ $poll->title }}</h3>
                            <p class="text-secondary">
                                <span>Deadline: {{ $poll->deadline }}</span>
                                &nbsp; | &nbsp;
                                <span>Creator: {{ $creator->name }}</span>
                            </p>
                        </div>
                        <p class="text-secondary">{{ $poll->description }}</p>
                        <div>
                            <form action="/poll/{{ $poll->id }}" method="post">
                                @csrf
                                @foreach ($poll->choices as $choice)
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="choice_id"
                                            id="flexRadioDefault{{ $choice->id }}" value="{{ $choice->id }}">
                                        <label class="form-check-label" for="flexRadioDefault{{ $choice->id }}">
                                            {{ $choice->choice }}
                                        </label>
                                    </div>
                                @endforeach
                                <div>
                                    <button type="submit" class="btn btn-primary btn-sm px-3">
                                        Vote
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if ($results !== null)
                <div class="card mt-3">
                    <div class="card-body">
                        <h4 class="mb-3">Hasil:</h4>
                        @foreach ($poll->choices as $key => $choice)
                            <p>
                                <span>{{ $choice->choice }}</span>
                                &nbsp;-&nbsp;
                                @foreach ($results as $result)
                                    @if ($choice->id == $result->id)
                                        <span class="text-primary">{{ ($result->total_votes / $totalPoint) * 100 }}%</span>
                                    @endif
                                @endforeach
                            </p>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
