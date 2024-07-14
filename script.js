//variables et constantes :
  //index.php

  //administateur.php
    const lienimg = document.getElementsByClassName('js_admin_bddimg')
    const lienuser = document.getElementsByClassName('js_admin_bdduser')
    const lienservice = document.getElementsByClassName('js_admin_bddservice')




//script index.php


//script administrateur
//verif que DOM est entièrement chargé
document.addEventListener('DOMContentLoaded', () => {
  lienimg.addEventlistener('click', () => {
    //envoi vers upload.html
    window.location.href = 'upload.html'
  })
  lienuser.addEventListener('click', () => {
    //envoi vers compteUtilisateur.html
    window.location.href = 'compteUtilisateur.html'
  })
  lienservice.addEventListener('click', () => {
    //envoi vers compteService.html
    window.location.href = 'compteService.html'
  })
})
