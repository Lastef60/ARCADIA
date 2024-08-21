document.addEventListener('DOMContentLoaded', () => {

  // Variables et constantes
  const lienimg = document.getElementsByClassName('js_admin_bddimg')
  const lienuser = document.getElementsByClassName('js_admin_bdduser')
  const lienservice = document.getElementsByClassName('js_admin_bddservice')
  const lienhabitat = document.getElementsByClassName('js_admin_bddhabitat')
  const lienanimal = document.getElementsByClassName('js_admin_bddanimal')
  const services = document.getElementsByClassName('js_services')
  const index_P_Habitat = document.getElementById('js_commentaireHabitat')
  const resetForm = document.getElementById('js_reinitialisation')

  if (index_P_Habitat) {
    index_P_Habitat.style.visibility = 'hidden'
  }

  // script index.php

    // ajout écouteur sur chaque élément image de js_services
  Array.from(services).forEach(service => {
    service.addEventListener('click', () => {
    // envoi vers service.php
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
    habitat.addEventListener('click', () => {
      window.location.href = 'habitats.php'
    })
  })

// script administrateur

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
      // envoi vers compteHabitat.php
      window.location.href = 'compteHabitat.php'
    })
    })

  Array.from(lienanimal).forEach(element => {
    element.addEventListener('click', () => {
      // envoi vers compteAnimal.php
      window.location.href = 'compteAnimal.php'
    })
  })

// script pour habitats.php

  // Fonction pour basculer l'affichage des animaux et leurs descriptions
  function toggleAnimalsDisplay(habitat) {
    console.log(`Toggling animals display for habitat: ${habitat}`)
  
    // Sélectionner tous les animaux et descriptions dans l'habitat spécifié
    const animals = document.querySelectorAll(`.js_habitat_animals[data-habitat="${habitat}"] .js_animal`)
    const descriptions = document.querySelectorAll(`.js_habitat_animals[data-habitat="${habitat}"] .js_animal_description`)
  
    // Vérifier si les éléments sont trouvés
    if (animals.length === 0) {
      console.log('pas d\'animal trouvé pour cet habitat.')
    }
    if (descriptions.length === 0) {
      console.log('pas de description trouvé pour cet habitat.')
    }

    // Basculer l'affichage des animaux
    animals.forEach(animal => {
      animal.style.display = (animal.style.display === 'none' || animal.style.display === '') ? 'block' : 'none'
    })
  
    // Masquer toutes les descriptions d'animaux pour l'habitat spécifié
    descriptions.forEach(description => {
      description.style.display = 'none'
    })
  }

  // Fonction pour basculer l'affichage de la description d'un animal
  function toggleAnimalDescription(animal) {
    console.log(`Toggling description for animal: ${animal}`)
  
    const description = document.querySelector(`.js_animal_description[data-animal="${animal}"]`)
    if (description) {
      description.style.display = (description.style.display === 'none' || description.style.display === '') ? 'block' : 'none'
    }
  }

  // Initialiseation des affichages à 'none'
  document.querySelectorAll('.js_habitat_animals .js_animal').forEach(animal => animal.style.display = 'none')
  document.querySelectorAll('.js_animal_description').forEach(description => description.style.display = 'none')

  //  gestionnaires d'événements pour les images des habitats
  document.querySelectorAll('.js_habitat_img').forEach(img => {
    img.addEventListener('click', () => {
      const habitat = img.dataset.habitat
      toggleAnimalsDisplay(habitat)
    })
  })

  // Ajouter des gestionnaires d'événements pour les images des animaux
  document.querySelectorAll('.js_animal').forEach(img => {
    img.addEventListener('click', () => {
      const animal = img.dataset.animal
      toggleAnimalDescription(animal)
    })
  })

  // script pour contact.php

})