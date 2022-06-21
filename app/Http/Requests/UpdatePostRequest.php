<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
          'startday' => 'required',
          'endday' => 'required|after:startday',
          'placename' => 'required|string',

          'numOfCycles' => 'nullable|required_with:cycle|numeric|max:31|required_if:quickcycle.quick,detail-date',
          'cycle' => 'nullable|required_with:numOfCycles|
            required_unless:quickcycle.quick,every-month,every-year,every-week',

          //quickボタンがweekの場合は weekチェックボックス選択必要
          'quickcycle.quick' => 'required|required_with:quickcycle.week',
          'quickcycle.week' => 'nullable|required_if:quickcycle.quick,every-month',


        ];
    }

    public function messages()
    {
        return [
          'endday.after' => '開始日以降を指定してください',
          'placename.required' => '入力してください',
          'placename.string' => '文字で入力してください',

          'numOfCycles.required_with' => '入力してください',
          'numOfCycles.required_if' => '入力してください',
          'cycle.required_with' => '選択してください',
          'quickcycle.quick.required' => 'どれか1つを選択してください',
          'quickcycle.week.required_if' => '曜日を選択してください',




        ];
    }


    public function passedValidation() //バリデ済みを加工してからコントローラに送る
    {

      $quickCycleData = $this->input('quickcycle.quick');
      $detailCycleData = $this->input('cycle');
      $detailNumData = $this->input('numOfCycles');
      $quickWeekData = $this->input('quickcycle.week');


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
