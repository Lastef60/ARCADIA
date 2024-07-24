//variables et constantes :
//index.php

//administateur.php
const lienimg = document.getElementsByClassName('js_admin_bddimg')
const lienuser = document.getElementsByClassName('js_admin_bdduser')
const lienservice = document.getElementsByClassName('js_admin_bddservice')
const lienhabitat = document.getElementsByClassName('js_admin_bddhabitat')
const lienanimal = document.getElementsByClassName('js_admin_bddanimal')
const services = document.getElementsByClassName('js_services')
const habitat = document.getElementsByClassName('js_habitat')
const index_P_Habitat = document.getElementById('js_commentaireHabitat')


index_P_Habitat.style.visibility = 'hidden'

// script index.php
document.addEventListener('DOMContentLoaded', () => {
  // ajout écouteur sur chaque élément image de js_services
  Array.from(services).forEach(service => {
    service.addEventListener('click', () => {
      //envoi vers service.php
      window.location.href = 'services.php'
    })
  })
  Array.from(document.getElementsByClassName('js_habitat')).forEach(habitat => {
    habitat.addEventListener('mouseover', () => {
       index_P_Habitat.style.visibility = 'visible'
    })
    habitat.addEventListener('mouseout', () => {
      index_P_Habitat.style.visibility = 'hidden'
    })
  }) 

  Array.from(document.getElementsByClassName('js_habitat')).forEach(habitat => {
    habitat.addEventListener('click', () => {
      window.location.href = 'habitats.php'
    })
  })
})

// script administrateur
document.addEventListener('DOMContentLoaded', () => {
  Array.from(lienimg).forEach(element => {
    element.addEventListener('click', () => {
      // envoi vers upload.html
      window.location.href = 'upload.html'
    })
  })

  Array.from(lienuser).forEach(element => {
    element.addEventListener('click', () => {
      // envoi vers compteUtilisateur.php
      window.location.href = 'compteUtilisateur.php'
    })
  })

  Array.from(lienservice).forEach(element => {
    element.addEventListener('click', () => {
      // envoi vers compteService.php
      window.location.href = 'compteService.php'
    })
  })

  Array.from(lienhabitat).forEach(element => {
    element.addEventListener('click', () => {
      // envoi vers compteHabitat.html
      window.location.href = 'compteHabitat.html'
    })
  })

  Array.from(lienanimal).forEach(element => {
    element.addEventListener('click', () => {
      // envoi vers compteAnimal.html
      window.location.href = 'compteAnimal.html'
    })
  })
})
