<?php

namespace App\Http\Controllers;

use App\BL\CreateDiaryEntries;
use App\ExDiary;
use App\ExPlan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        if ( $user->isAdmin()) {
            return redirect('/AdminDashboard');
        } else {
            return redirect('/UserDashboard');
        }
    }

    public function adminhome() {
        $user = Auth::user();
        $pageTitle = "Admin Dashboard";

        $queryRolesPivot = DB::table(config('roles.roleUserTable'));
        $users = [];
        $queryRolesPivot->where('role_id', '=', '2');
        $pivots = $queryRolesPivot->get();
        if ($pivots->count() > 0) {
            foreach ($pivots as $pivot) {
                $users[] = User::find($pivot->user_id);
            }
        }

        $listOfUsers = [];
        foreach( $users as $user ) {

            $plans = ExPlan::where('userid', '=', $user->id)
                ->orderBy('repeatnum', 'desc')
                ->get();

            $numWeeks = $this->getNumWeeks($user);

            $entries = ExDiary::where('userid', '=', $user->id)
                ->where('week', '<=', $numWeeks + 1)
                ->orderBy('week', 'desc')
                ->get();

            $completed = 0;
            $notdone = 0;
            $partials = 0;
            $missing = 0;



            foreach( $entries as $dd ) {
                if ( $dd->stretchingdone == -1 && $dd->strengtheningdone == -1 ) {
                    $missing++;
                } else if ($dd->stretchingdone == 0 && $dd->strengtheningdone == 0 ) {
                    $notdone++;
                } else if ($dd->stretchingdone == 0 || $dd->strengtheningdone == 0 ) {
                    $partials++;
                } else {
                    $completed++;
                }
            }


            $uArray = [
                'randonum' => $user->randonum,
                'currentweek' => $numWeeks + 1,
                'numplans' => count($plans),
                'completed' => $completed,
                'expected' => count($entries),
                'partials' => $partials,
                'missing' => $missing,
                'notdone' => $notdone
            ];

            $listOfUsers[] = $uArray;
        }


        return view('home.admin.index')
            ->with('users', $listOfUsers)
            ->with('pageTitle', $pageTitle);
    }

    public function userhome() {
        $user = Auth::user();
        $pageTitle = "User Dashboard";
        $plans = ExPlan::where('userid', '=', $user->id)
                 ->orderBy('repeatnum', 'desc')
                 ->get();

        $numWeeks = $this->getNumWeeks($user);

        $diaryData = $this->getDiaryEntries($user, $numWeeks);

        $userid = $user->id;
        $lastgoal = '(Not set)';

        if ( count($plans) > 0 ) {
            $lastgoal = '(' . $plans[0]->smartgoal . ')';
        }

        return view('home.users.index')
            ->with('username', "Duncan")
            ->with('plans', $plans)
            ->with('numweeks', $numWeeks)
            ->with('userid', $userid)
            ->with('lastgoal', $lastgoal)
            ->with('diaryData', $diaryData)
            ->with('pageTitle', $pageTitle);
    }

    public function getNumWeeks(User $user ) {
        $today = new \DateTime('NOW');
        $startDate = new \DateTime( $user->created_at );
        $numWeeks = floor($startDate->diff($today)->days / 7);
        return $numWeeks;
    }

    public function getDiaryEntries(User $user, int $numWeeks) {
        $today = new \DateTime('NOW');
        $startDate = new \DateTime( $user->created_at );

        $entries = ExDiary::where('userid', '=', $user->id)
            ->where('week', '<=', $numWeeks + 1)
            ->orderBy('week', 'desc')
            ->get();

        if ( count( $entries) == 0 ) {
            $creator = new CreateDiaryEntries();
            $creator->Create($user->id, $user->created_at);
        }

        $maxdaysLastWeek = 7;
        $allowedNumEntries = (int)($startDate->diff($today)->format('%r%a')) + 1;

        if ( $allowedNumEntries > 84) {
            $allowedNumEntries = 84;
        } else {
            $maxdaysLastWeek = $allowedNumEntries % 7;
        }

        $maxd = 7;

        for ( $i = 1; $i <= $numWeeks+1; $i++ ) {
            if ( $i == ($numWeeks+1) ) {
                $maxd = $maxdaysLastWeek;
            } else {
                $maxd = 7;
            }

            for ($j = 1; $j <= $maxd; $j++) {
                foreach( $entries as $ent ) {
                    if ( $ent->week == $i && $ent->day == $j ) {
                        $diaryData[$i][$j] = $ent;
                    }
                }
            }
        }

        krsort($diaryData);

        return $diaryData;

    }

    public function userAddPlan(Request $request) {
        if ( $request['id'] == 0) {
            $task = new ExPlan();
            $input = $request->all();
            unset( $input['_token'] );
            if ( is_null($input['physioname']) ) { $input['physioname'] = "";}
            if ( is_null($input['ltgoal']) ) { $input['ltgoal'] = "";}
            $task->fill($input);
            $task->save();
        }
        return redirect('/UserDashboard');
    }

    public function userAddDiary(Request $request) {
        if ( $request['id'] != 0) {
            $task = ExDiary::find($request['id']);
            if (!is_null($task)) {
                $input = $request->all();
                unset($input['_token']);
                if (is_null($input['notes'])) {
                    $input['notes'] = "";
                }
                if (is_null($input['stretchingdone'])) {
                    $input['stretchingdone'] = "-1";
                }
                if (is_null($input['strengtheningdone'])) {
                    $input['strengtheningdone'] = "-1";
                }
                $task->fill($input);
                $task->save();
            }
        }
        return redirect('/UserDashboard');
    }
}
