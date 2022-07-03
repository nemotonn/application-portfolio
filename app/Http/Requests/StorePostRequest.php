<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      return [


          //下元-----------------------------------
          'startday' => 'required',
          'endday' => 'required|after:startday',
          'placename' => 'required|string',

          //詳細設定フォーム お互いのフィールドが存在していればOK、クイックdetail-date選択必要
          'cycle.numOfCycles' => 'nullable|required_with:cycle.cycle|numeric|max:31|required_if:cycle.quick,detail-date',
          'cycle.cycle' => 'nullable|required_with:cycle.numOfCycles',


          //毎週クイック,お互いのフィールドに存在していれば認証
          'cycle.quick' => 'required|required_with:cycle.week',
          'cycle.week' => 'nullable|required_if:cycle.quick,every-week',

        ];

    }

    public function messages(){
        return [


          //下元-------------------------------
          'endday.after' => '開始日以降を指定してください',
          'placename.required' => '入力してください',
          'placename.string' => '文字で入力してください',

          'cycle.numOfCycles.required_with' => '数値を入力してください',
          'cycle.cycle.required_with' => '周期を選択してください',

          'cycle.quick.required' => 'どれか1つを選択してください',
          'cycle.week.required_if' => '曜日を選択してください',



        ];
    }

    public function passedValidation() //バリデ済みを加工してからコントローラに送る
    {

      $quickCycleData = $this->input('cycle.quick');
      $detailCycleData = $this->input('cycle.cycle');
      $detailNumData = $this->input('cycle.numOfCycles');
      $quickWeekData = $this->input('cycle.week');


      if($quickCycleData == 'detail-date'){
        $this->merge([
          'numOfCycles' => $detailNumData,
          'cycle' => $detailCycleData,
          'quickcycle' => null,
        ]);
      }

      //クイック　毎年or毎月
      if($quickCycleData == 'every-year' || $quickCycleData == 'every-month'){
        $this->merge([
          'numOfCycles' => null,
          'cycle' => null,
          'quickcycle' => $quickCycleData,
        ]);
      }

      //クイック　毎週
      if($quickCycleData == 'every-week'){
        $this->merge([
          'numOfCycles' => null,
          'cycle' => null,
          'quickcycle' => $quickWeekData,
        ]);
      }



    }


}
