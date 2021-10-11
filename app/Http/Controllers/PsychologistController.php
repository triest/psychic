<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestInputNumber;
use App\Service\PsychologistService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PsychologistController extends Controller
{
    private $psychoticService=null;



    //

    /**
     * PsychologistController constructor.
     * @param null $psychoticService
     */
    public function __construct()
    {
        $this->psychoticService = new PsychologistService();
    }

    public function guessNumber(){

         $guesses=$this->psychoticService->getGuesses();


        if(Session::has('input_history')){
            $input_history=Session::get('input_history');
        }else{
            $input_history=null;
        }

        if(Session::has('guesses_history')){
            $guesses_history=Session::get('guesses_history');
        }else{
            $guesses_history=[];
        }


        return view('gusses')->with(compact('guesses','input_history','guesses_history'));
    }

    public function makeInput(RequestInputNumber $requestInputNumber){
         $this->psychoticService->setNumber($requestInputNumber->number);

        return redirect(config('app.base_url'));
    }
}
