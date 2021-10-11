<?php


namespace App\Service;


use App\Models\Psychic;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Integer;

class PsychologistService
{
    /**
     * @var int
     */
    private $maxPsychologist = 5;

    /**
     * @return array
     */
    public function getGuesses()
    {
        if(Session::has('gusses')){
            $gusses = Session::get('gusses');
        }


        if(!isset($gusses) || empty($gusses))
        {
             $psychologists = Psychic::select(['*'])->limit(rand(2, $this->maxPsychologist))->get();

             $gusses=[];

            foreach ($psychologists as $psychologist){
                $gusses[]['psychologist']=$psychologist;
            }
        }


        foreach ($gusses as $key=>$guss){
            $gusses[$key]['gus']=$guss['psychologist']->getGusses();
        }



        Session::put('gusses', $gusses);



        return $gusses;
    }


    public function setNumber(int $number)
    {
        //
        if (!Session::has('gusses')) {
            return false;
        }
        $gusses = Session::get('gusses');

        if(Session::has('input_history')){
            $input_history=Session::get('input_history');
        }else{
            $input_history=[];
        }

        $input_history[]=$number;
        Session::put('input_history',$input_history);

        if(Session::has('guesses_history')){
            $guesses_history=Session::get('guesses_history');
        }else{
            $guesses_history=[];
        }


        foreach ($gusses as $key => $item) {
            if ($item['gus'] === $number) {
                $gusses[$key]['psychologist']->level = $item['psychologist']->level + 1;
                $guesses_history[$item['psychologist']->id]['name']=$item['psychologist']->name;
                $guesses_history[$item['psychologist']->id]['history'][]=$number;
            } else {
                $gusses[$key]['psychologist']->level = $item['psychologist']->level - 1;
            }
        }

        Session::put('gusses',$gusses);

        Session::put('guesses_history',$guesses_history);

    }
}
