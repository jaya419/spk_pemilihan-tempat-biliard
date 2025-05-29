<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\Criterion;
use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function index()
    {
        $alternatives = Alternative::all();
        $criterias = Criterion::all();
        $scores = Score::all()->keyBy(function ($item) {
            return $item->alternative_id . '-' . $item->criterion_id;
        });

        return view('score.index', compact('alternatives', 'criterias', 'scores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alternative_ids' => 'required|array',
            'alternative_ids.*' => 'exists:alternatives,id',
            'value' => 'required|array',
            'value.*' => 'array',
            'value.*.*' => 'required|numeric|min:0|max:100',
        ]);

        foreach ($request->alternative_ids as $alternative_id) {
            foreach ($request->value[$alternative_id] as $criterion_id => $val) {
                Score::updateOrCreate(
                    [
                        'alternative_id' => $alternative_id,
                        'criterion_id' => $criterion_id,
                    ],
                    [
                        'value' => $val,
                    ]
                );
            }
        }

        return redirect()->route('score.index')->with('success', 'Penilaian berhasil disimpan.');
    }

    public function calculateSAW()
{
    $alternatives = Alternative::all();
    $criterias    = Criterion::all();

    if ($alternatives->isEmpty() || $criterias->isEmpty() || Score::count() === 0) {
        $results = [];                       // kosong
        return view('result.index', compact('results'));
    }

    $results = [];

    foreach ($alternatives as $alternative) {
        $total = 0;

        foreach ($criterias as $criterion) {
            $score = Score::where('alternative_id', $alternative->id)
                          ->where('criterion_id', $criterion->id)
                          ->first();

            $value = $score ? $score->value : 0;

            if ($criterion->type === 'benefit') {
                $max = Score::where('criterion_id', $criterion->id)->max('value') ?: 1;
                $normalized = $max > 0 ? $value / $max : 0;
            } else {                                            // type == cost
                $min = Score::where('criterion_id', $criterion->id)->min('value') ?: 1;
                $normalized = $value > 0 ? $min / $value : 0;
            }

            $weight = $criterion->weight / 100;
            $total += $normalized * $weight;
        }

        $results[] = [
            'alternative' => $alternative->name,
            'score'       => round($total * 100, 2),
        ];
    }

    usort($results, fn ($a, $b) => $b['score'] <=> $a['score']);

    return view('result.index', compact('results'));
}


    public function dashboard()
    {
        $alternativeCount = Alternative::count();
        $criterionCount = Criterion::count();
        $scoreCount = Score::count();

        $latestScore = Score::latest()->first();
        $latestCriterion = Criterion::latest()->first();
        $latestAlternative = Alternative::latest()->first();

        $alternatives = Alternative::all();
        $criterias = Criterion::all();
        $sawResults = [];

        if ($alternatives->isNotEmpty() && $criterias->isNotEmpty()) {
            foreach ($alternatives as $alternative) {
                $total = 0;
                foreach ($criterias as $criterion) {
                    $score = Score::where('alternative_id', $alternative->id)
                                   ->where('criterion_id', $criterion->id)
                                   ->first();
                    $value = $score ? $score->value : 0;

                    $max = Score::where('criterion_id', $criterion->id)->max('value') ?: 1;
                    $min = Score::where('criterion_id', $criterion->id)->min('value') ?: 1;

                    if ($criterion->type === 'benefit') {
                        $normalized = $max > 0 ? $value / $max : 0;
                    } else {
                        $normalized = $value > 0 ? $min / $value : 0;
                    }

                    $weight = $criterion->weight / 100;
                    $total += $normalized * $weight;
                }
                $sawResults[] = [
                    'alternative' => $alternative->name,
                    'score' => round($total * 100, 2),
                ];
            }
            usort($sawResults, fn($a, $b) => $b['score'] <=> $a['score']);
        }
        $top3RankedAlternatives = array_slice($sawResults, 0, 3);

        $newlyAddedAlternatives = Alternative::latest()->take(3)->get();
        return view('dashboard.index', compact(
            'alternativeCount', 'criterionCount', 'scoreCount',
            'latestScore', 'latestCriterion', 'latestAlternative',
            'top3RankedAlternatives', 'newlyAddedAlternatives'
        ));
    }
}