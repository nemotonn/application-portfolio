
//ios 画面いっぱいheight
const setFillHeight = () => {
  const vh = window.innerHeight * 0.01;
  document.documentElement.style.setProperty('--vh', `${vh}px`);
}
// 画面のサイズ変動があった時に高さを再計算する
window.addEventListener('resize', setFillHeight);

// 初期化
setFillHeight();




//アクティブリンク
function currentLink(e){
  const navlinks = document.querySelectorAll('.nav-list a');

  navlinks.forEach(link => {
    const url = link.getAttribute('href');
    //パス/で分割し配列化
    const path = url.split('/');

    //現在のurl取得し分割
    const currentPath = location.href.split('/');

    //分割したパスの4番目のパスが一致する場合にクラスadd
    if(currentPath[4] == path[4]){
      const li = link.parentElement;
      //取得urlの親ノード(li)取得
      li.classList.add('active-nav');
    }else{
      const li = link.parentElement;
      li.classList.remove('active-nav');
    }


    //editパスでeditlistアクティブにする
    editlinks = document.querySelectorAll('.editlist-table td a');
    if(currentPath[4] == 'edit'){

      const referrer = document.referrer.split('/'); //前のURL取得

      const navlinks = document.querySelectorAll('.nav-list a');
      navlinks.forEach(navlink => {
        const url = navlink.getAttribute('href');
        const path = url.split('/');

        if(path[4] == referrer[4]){
          const li = navlink.parentElement;
          li.classList.add('active-nav');
        }
      });
    }


    //index カレンダーdateパスが追加されてもindexアクティブ
    if(!isNaN(currentPath[4])){ //数値であれば

      const navlinks = document.querySelectorAll('.nav-list a');
      navlinks.forEach(navlink => {
        const url = navlink.getAttribute('href');
        const path = url.split('/');

        if(path[4] == null){
          const li = navlink.parentElement;
          li.classList.add('active-nav');
        }
      });
    }
  });

};

if (window.matchMedia( "(min-width: 1023px)" ).matches) {
  window.addEventListener('load', currentLink);
}
