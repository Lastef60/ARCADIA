//variables et constantes :
  //index.php

  //administateur.php
    const lienimg = document.getElementsByClassName('js_admin_bddimg')
    const lienuser = document.getElementsByClassName('js_admin_bdduser')
    const lienservice = document.getElementsByClassName('js_admin_bddservice')
    const lienhabitat = document.getElementsByClassName('js_admin_bddhabitat')
    const lienanimal = document.getElementsByClassName('js_admin_bddanimal')
    const services = document.getElementsByClassName('js_services')




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
    window.location.href = 'compteUtilisateur.php'
  })
  lienservice.addEventListener('click', () => {
    //envoi vers compteService.html
    window.location.href = 'compteService.html'
  })
  lienhabitat.addEventListener('click', () => {
    //envoi vers compteService.html
    window.location.href = 'compteHabitat.html'
  })
  lienanimal.addEventListener('click', () => {
    //envoi vers compteService.html
    window.location.href = 'compteAnimal.html'
  })

  services.addEventListener('click', () => {
    //envoi vers service.php
    window.location.href = 'service.php'
  })
})


