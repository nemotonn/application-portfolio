

// ナビ　トグル
const humIcon = document.querySelector('.hum-icon');
humIcon.addEventListener('click', e =>{

  //タブレット以下の場合　ナビ
  if (window.matchMedia( "(max-width: 1023px)" ).matches) {
    const mobileNav = document.querySelector('.mobile-nav');
    const mobileNavBox = document.querySelector('.mobile-nav-box');

    mobileNav.classList.toggle('mobile-nav-bg-in');
    mobileNavBox.classList.toggle('mobile-nav-in');


  }else{　//PCナビ
    const navIn = document.querySelector('.pc-side-nav');
    navIn.classList.toggle('nav-toggle');
  }
});

//ナビクローズ
const closeButton = document.querySelector('.nav-close-button');
closeButton.addEventListener('click', e=>{
  
  const mobileNav = document.querySelector('.mobile-nav');
  const mobileNavBox = document.querySelector('.mobile-nav-box');

  mobileNav.classList.remove('mobile-nav-bg-in');
  mobileNavBox.classList.remove('mobile-nav-in');
});


//ログアウトボックス　トグル
const userIcon = document.querySelector('.user-icon');
userIcon.addEventListener('click', e =>{
  const toggle = document.querySelector('.logout-box');
  toggle.classList.toggle('logout-toggle');
});
