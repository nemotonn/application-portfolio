
//終了日　プルダウンで日付選択でボックス表示
const enddaySelect = document.querySelector('#enddaySelect');
enddaySelect.addEventListener('change', e=>{
  const dateBox = document.querySelector('#enddayDateBox');
  dateBox.classList.add('form-togglein');
});


const formItems = [
  '#cycleWeekRadio',
  '#cycleDateRadio',
  '#everyYear',
  '#everyMonth',
];

const clickElements = formItems.map(id => document.querySelector(id));
console.log(clickElements);

clickElements.forEach(clickElement =>{
  clickElement.addEventListener('click', e =>{


    if(e.currentTarget.id == 'cycleWeekRadio'){
      const dateBox = document.querySelector('#cycleDateBox');
      dateBox.classList.remove('form-togglein');

      const weekBox = document.querySelector('#cycleWeekBox');
      weekBox.classList.add('form-togglein');
    }

    if(e.currentTarget.id == 'cycleDateRadio'){
      //削除
      const weekBox = document.querySelector('#cycleWeekBox');
      weekBox.classList.remove('form-togglein');

      //追加
      const dateBox = document.querySelector('#cycleDateBox');
      dateBox.classList.add('form-togglein');

    }

    //毎月、毎年クリックで詳細設定・曜日ボックス消す
    if(e.currentTarget.id == 'everyYear' || e.currentTarget.id == 'everyMonth'){
      const weekBox = document.querySelector('#cycleWeekBox');
      weekBox.classList.remove('form-togglein');

      const dateBox = document.querySelector('#cycleDateBox');
      dateBox.classList.remove('form-togglein');

    }



  });
});
