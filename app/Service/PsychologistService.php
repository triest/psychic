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
        if (Session::has('gusses')) {
            $gusses = Session::get('gusses');
        } else {
            $psychologists = Psychic::select(['*'])->limit(rand(2, $this->maxPsychologist))->get();
            foreach ($psychologists as $psychologist) {
                $temp_gusses=$psychologist->gusses();
                $gusses[] = [
                        'id' => $psychologist->id,
                        'psychologist' => $psychologist->name,
                        'gusses' => $temp_gusses,
                        'level' => $psychologist->level
                ];

                /*
                 * сохраняем история догадог
                 * */
                if(Session::has('gusses_history')){
                    $gusses_history=Session::get('gusses_history');
                }else{
                    $gusses_history=[];
                }

                $gusses_history[$psychologist->id]['name']=$psychologist->name;
                $gusses_history[$psychologist->id]['gusses']=$temp_gusses;
                Session::put('gusses_history',$gusses_history);

            }
            Session::put('gusses', $gusses);
        }


        return $gusses;
    }


    public function setNumber(int $number)
    {
        //
        if (!Session::has('gusses')) {
            return false;
        }
        $gusses = Session::get('gusses');

        foreach ($gusses as $key => $item) {
            if ($item['gusses'] === $number) {
                $gusses[$key]['level'] = $item['level'] + 1;
            } else {
                $gusses[$key]['level'] = $item['level'] - 1;
            }
        }

        //историй введенных пользователем чисед
        if (!Session::has('input_history')) {
            $input_history=[];
        }else{
            $input_history= Session::get('input_history');
            $input_history[]=$number;
        }


        Session::put('input_history',$input_history); //история введенных чисел
        Session::put('results', $gusses); //результаты
        Session::put('gusses', $gusses); //догадки.


        return $gusses;
    }
}
