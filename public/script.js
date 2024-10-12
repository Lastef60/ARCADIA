document.addEventListener('DOMContentLoaded', () => {
  // Variables et constantes
  const lienimg = document.getElementsByClassName('js_admin_bddimg')
  const lienuser = document.getElementsByClassName('js_admin_bdduser')
  const lienservice = document.getElementsByClassName('js_admin_bddservice')
  const lienhabitat = document.getElementsByClassName('js_admin_bddhabitat')
  const lienanimal = document.getElementsByClassName('js_admin_bddanimal')
  const services = document.getElementsByClassName('js_services')
  const index_P_Habitat = document.getElementById('js_commentaireHabitat')
  const animalImages = document.querySelectorAll('.js_animal')
  const diapos = document.querySelectorAll('.estompe_diapo')

  if (index_P_Habitat) {
    index_P_Habitat.style.visibility = 'hidden'
  }

  // Burger du nav
  document.querySelector('.js_header_menu_button').addEventListener('click', () => {
    let nav = document.querySelector('.js_header_div_nav')
    nav.classList.toggle('css_header_div_nav_active')
  })

  // Script index
  Array.from(services).forEach(service => {
    service.addEventListener('click', () => {
      window.location.href = 'services.php' // Chemin mis à jour
    })
  })

  Array.from(document.getElementsByClassName('js_habitat')).forEach(habitat => {
    habitat.addEventListener('mouseover', () => {
      index_P_Habitat.style.visibility = 'visible'
    })
    habitat.addEventListener('mouseout', () => {
      index_P_Habitat.style.visibility = 'hidden'
    });
    habitat.addEventListener('click', () => {
      window.location.href = 'habitats.php' // Chemin mis à jour
    })
  })

  // Initialisation des images des animaux à 'none'
  document.querySelectorAll('.js_animal').forEach(animal => {
    animal.style.display = 'none'
  })

  document.querySelectorAll('.js_habitat_animals .js_animal_description').forEach(description => {
    description.style.display = 'none'
  })

  // Gestionnaires d'événements pour les images des habitats
  document.querySelectorAll('.js_habitat_img').forEach(img => {
    img.addEventListener('click', () => {
      const habitat = img.dataset.habitat
      toggleAnimalsDisplay(habitat)
    })
  })

  // événements pour les img des animaux
  animalImages.forEach(img => {
    img.addEventListener('click', function () {
      const animalName = this.dataset.animal // reprend l'animal qui a été cliqué
      toggleAnimalDescription(animalName) // fonction qui gère affichage de la description de l'animal

      fetch('compteAnimal.php', { // Envoi d'une requête
        method: 'POST', // en méthode POST
        headers: {
          'Content-Type': 'application/json' // requête contient un objet JSON
        },
        body: JSON.stringify({ nom: animalName }) // la clé = nom de l'animal
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          console.log(`Incrémentation réussie pour ${animalName}`)
        } else {
          console.error(`Échec de l'incrémentation pour ${animalName}`)
        }
      })
      .catch(error => {
        console.error('Erreur:', error)
      })
    })
  })

  function toggleAnimalsDisplay(habitat) { // reprend id habitat pour affecter les animaux au bon habitat
    const animals = document.querySelectorAll(`.js_habitat_animals[data-habitat="${habitat}"] .js_animal`)
    animals.forEach(animal => {
      animal.style.display = (animal.style.display === 'none' || animal.style.display === '') ? 'block' : 'none'
    })

    // reprend les éléments de la description de l'animal
    const descriptions = document.querySelectorAll(`.js_habitat_animals[data-habitat="${habitat}"] .js_animal_description`)
    descriptions.forEach(description => {
      description.style.display = 'none'
    })
  }

  function toggleAnimalDescription(animalName) { // fonction pour afficher ou non la description
    document.querySelectorAll('.js_animal_description').forEach(description => {
      description.style.display = 'none'
    })

    const description = document.querySelector(`.js_animal_description[data-animal="${animalName}"]`)
    if (description) {
      description.style.display = 'block'
    }
  }

  // Affichage du carrousel
  let currentIndex = 0
  const delay = 4000

  function showNextDiapo() {
    if (diapos[currentIndex]) { // Vérifie que diapos[currentIndex] existe avant d'utiliser classList
      diapos[currentIndex].classList.remove('active')
    }
    currentIndex = (currentIndex + 1) % diapos.length;
    if (diapos[currentIndex]) { // Vérifie que diapos[currentIndex] existe avant d'utiliser classList
      diapos[currentIndex].classList.add('active')
    }
  }

  if (diapos.length > 0) { // Vérifie que diapos n'est pas vide avant de démarrer le carrousel
    diapos[currentIndex].classList.add('active')
    setInterval(showNextDiapo, delay)
  }

  // Script administrateur (mise en place des liens de direction vers les autres pages)
  Array.from(lienimg).forEach(element => {
    element.addEventListener('click', () => {
      window.location.href = 'avis/list.php' // Chemin mis à jour
    })
  })

  Array.from(lienservice).forEach(element => {
    element.addEventListener('click', () => {
      window.location.href = 'services.php' // Chemin mis à jour
    })
  })

  Array.from(lienhabitat).forEach(element => {
    element.addEventListener('click', () => {
      window.location.href = 'habitat/list.php' // Chemin mis à jour
    })
  })

  Array.from(lienanimal).forEach(element => {
    element.addEventListener('click', () => {
      window.location.href = 'animal/list.php' // Chemin mis à jour
    })
  })
})
