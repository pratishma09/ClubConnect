<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Charts\FinanceChart;
use App\Models\Club;
use App\Models\Event;
use App\Models\User;
use Exception;

use Illuminate\Http\Request;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showFinance()
    {
        try {
            $totalBudget = 25000;
            $user = auth()->user();
            $events = Event::where('user_id', $user->id)
                ->orWhere('collaborators', 'LIKE', '%' . $user->name . '%')
                ->with('clubs')
                ->get();
            
            $eventsWithAmountSpent = $events->map(function ($event) use ($user) {
                $club = Club::where('name', $user->name)->first();
    
                if (!$club) {
                    return null; 
                }
    
                $clubEvent = $event->clubs()->where('club_id', $club->id)->first();
    
                if ($clubEvent) {
                    $event->amount_spent = $clubEvent->pivot->amount_spent;
                } else {
                    $event->amount_spent = 0;
                }
    
                return $event;
            })->filter();
    
            $totalSpent = $eventsWithAmountSpent->sum('amount_spent');
            $unspentBudget = $totalBudget - $totalSpent;
    
            $chartData = $eventsWithAmountSpent->map(function ($event) {
                return [
                    'label' => $event->title,
                    'value' => $event->amount_spent,
                ];
            });
            $chartData->push([
                'label' => 'Unspent Budget',
                'value' => $unspentBudget,
            ]);
    
            $labels = $chartData->pluck('label')->toArray();
            $values = $chartData->pluck('value')->toArray();
    
            // Custom colors for the pie chart
            $colors = [
                '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#FFCD56'
            ];
    
            // Ensure the colors array matches the number of events + unspent budget
            if (count($colors) < count($labels)) {
                $additionalColors = array_slice($colors, 0, count($labels) - count($colors));
                $colors = array_merge($colors, $additionalColors);
            }
    
            $chart = new FinanceChart;
            // $chart->labels($labels);
            $chart->dataset('Budget Spent by Club', 'pie', $values)->backgroundColor($colors);
    
            return view('clubs.finance.showFinance', compact('eventsWithAmountSpent', 'chart', 'colors', 'labels'));
        } catch (Exception $e) {
            return back()->with('error', 'Something went wrong!');
        }
    }
    

public function updateBudget(Request $request, Event $event)
{
    $validatedData = $request->validate([
        'amount_spent' => 'required|integer|min:0',
    ]);

    $user = Auth::user();
    $club = Club::where('name', $user->name)->first();

    if (!$club) {
        return redirect()->back()->with('error', 'Club not found or you are not authorized.');
    }

    $existingEntry = $event->clubs()->where('club_id', $club->id)->first();
    $oldAmountSpent = $existingEntry ? $existingEntry->pivot->amount_spent : 0;

    $totalAmountSpent = $event->clubs()->sum('amount_spent') - $oldAmountSpent + $validatedData['amount_spent'];

    if ($totalAmountSpent > $event->budget) {
        return redirect()->back()->with('error', 'Total budget used exceeds the event budget.');
    }

    $newBudget = $club->initial_budget + $oldAmountSpent - $validatedData['amount_spent'];
    if ($newBudget < 0) {
        return redirect()->back()->with('error', "You don't have enough budget.");
    }

    $club->initial_budget = $newBudget;
    $club->save();

    $event->clubs()->syncWithoutDetaching([
        $club->id => ['amount_spent' => $validatedData['amount_spent']],
    ]);

    return redirect()->back()->with('success', 'Budget utilization updated successfully.');
}


    public function updateBudgetShow(Event $event)
    {
        $user = auth()->user();
        $club = Club::where('name', $user->name)->first();
        return view('clubs.finance.budgetForm')->with(compact('event', 'club'));
    }
    
    public function adminShow()
{
    try {
        $events = Event::with('clubs')->get();

        $eventData = $events->map(function ($event) {
            $totalAmountSpent = $event->clubs()->sum('amount_spent');
            return [
                'event' => $event->title,
                'total_spent' => (int) $totalAmountSpent,
            ];
        });

        $sortedEvents = $eventData->sortByDesc('total_spent')->values();
        return view('admin.finance.showFinance', compact('sortedEvents'));
    } catch (Exception $e) {
        return back()->with('error', 'Something went wrong!');
    }
}


}
