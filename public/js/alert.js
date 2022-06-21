
const demo = document.querySelector('#alert-demo');
demo.addEventListener('click', e =>{

  const form = document.myform;
  e.preventDefault();


  swal({
    title: "本当に削除しますか？",
    text: "作成されたスケジュール、お掃除率も削除されます",

    buttons: {
      can:{
        text: "キャンセル",
        value: null,
      },
      delete: {
        text: "削除",
        value: true,
      },
    },
  })
  .then(willdelete => {
    if (willdelete) {
      form.submit();
    }
  });



});
