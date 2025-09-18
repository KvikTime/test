document.addEventListener("DOMContentLoaded", () => {
  const RECOVERY = document.querySelector(".form__link");
  const MODAL_SELECTOR = document.querySelector(".modal__selector");
  const FORMS_REG = document.querySelector(".form--register");
  const FORMS_ENTR = document.querySelector(".form--entrance");
  const ACTIVE_ENTRANCE = document.querySelector(".form--entrance-active");

  const MODAL = document.querySelector(".modal")
  const BTN_CLOSE = document.querySelector(".modal__btn")
  


  RECOVERY.addEventListener('click',(e)=>{
    e.preventDefault();
    MODAL_SELECTOR.style.display = 'none';
    FORMS_REG.style.display = 'none';
    FORMS_ENTR.style.display = 'none';
    ACTIVE_ENTRANCE.style.display = 'flex'
  })

  BTN_CLOSE.addEventListener('click',()=>{
    MODAL.style.display = 'none';
  })
});
