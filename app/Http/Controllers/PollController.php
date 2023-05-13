<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use App\Models\Poll;
use App\Models\User;
use App\Models\Vote;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PollController extends Controller
{
    public function index() {
        $polls = Poll::all();
        return view("main.pages.index", [
            "polls" => $polls
        ]);
    }

    public function detailPoll($poll_id) {
        $now = Carbon::now()->format("Y-m-d H:i:s");
        $cekUserVote = Vote::where("poll_id", $poll_id)->where("user_id", auth()->user()->id)->count();
        $poll = Poll::with("choices")->where("id", $poll_id)->get(); 
        $creator = User::where("id", $poll[0]->created_by)->get();
        $totalPoint = Vote::where("poll_id", $poll_id)->count();
        $results = DB::table('votes')
        ->join('choices', 'votes.choice_id', '=', 'choices.id')
        ->select('choices.id', 'choices.choice', DB::raw('count(*) as total_votes'))
        ->where('votes.poll_id', $poll_id)
        ->groupBy('choices.id', 'choices.choice')
        ->get();

        return view("main.pages.detail", [
            "poll" => $poll[0],
            "creator" => $creator[0],
            "totalPoint" => $totalPoint,
            "results" => $cekUserVote >= 1 || auth()->user()->role == 'admin' || $now > $poll[0]->deadline ? $results : null,
            "cekUserVote" => $cekUserVote
        ]);
    }

    public function makeAVote(Request $request, $poll_id) {
        if (auth()->user()->role == "admin") {
            return redirect("poll/".$poll_id)->withInfo("Voting tidak boleh dilakukan oleh admin!");
        }
        
        $cekUserVote = Vote::where("poll_id", $poll_id)->where("user_id", auth()->user()->id)->count();
        if ($cekUserVote >= 1) {
            return redirect("poll/".$poll_id)->withInfo("Voting hanya bisa dilakukan sekali per poll!");
        }

        $now = Carbon::now()->format("Y-m-d H:i:s");
        $deadline = Poll::where("id", $poll_id)->pluck("deadline")[0];
        if($now > $deadline) {
            return redirect("poll/".$poll_id)->withInfo("Sudah mencapai deadline!");
        }

        $vote = new Vote;
        $vote->user_id = auth()->user()->id;
        $vote->poll_id = $poll_id;
        $vote->choice_id = $request->choice_id;
        $vote->save();
        return redirect("poll/".$poll_id)->withInfo("Berhasil melakukan vote!");
    }

    public function create() {
        return view("main.pages.create");
    }

    public function submitPoll(Request $request) {
        $this->validate($request, [
            "title" => "required",
            "description" => "required",
            "deadline" => "required"
        ]);

        if (count($request->choices) <= 1) {
            return redirect("/poll/create")->withDanger("Masukkan pilihan minimal 2");
        }

        $max = Poll::max("id");
        $poll_id = $max == 0 ? 1 : $max += 1;

        $poll = new Poll;
        $poll->id = $poll_id;
        $poll->title = $request->title;
        $poll->description = $request->description;
        $poll->deadline = $request->deadline;
        $poll->created_by = auth()->user()->id;

        foreach ($request->choices as $choice) {
            $choices = new Choice;
            $choices->poll_id = $poll_id;
            $choices->choice = $choice;
            $poll->save();
            $choices->save();
        }
        return redirect("/")->withInfo("Berhasil menambahkan poll baru!");
    }

    public function deletePoll($poll_id) {
        Poll::findOrFail($poll_id)->delete();
        return redirect("/")->withInfo("Berhasil menghapus poll!");
    }
}
