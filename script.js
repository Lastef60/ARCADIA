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
  const diapos = document.querySelectorAll('.carrousel_diapo .diapo')
  const diapoContainer = document.querySelector('.carrousel_diapo')

  
  if (index_P_Habitat) {
    index_P_Habitat.style.visibility = 'hidden'
  }

  // ajout écouteur sur chaque élément image de js_services
  Array.from(services).forEach(service => {
    service.addEventListener('click', () => {
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
      window.location.href = 'upload.html'
    })
  })

  Array.from(lienuser).forEach(element => {
    element.addEventListener('click', () => {
      window.location.href = 'compteUtilisateur.php'
    })
  })

  Array.from(lienservice).forEach(element => {
    element.addEventListener('click', () => {
      window.location.href = 'compteService.php'
    })
  })

  Array.from(lienhabitat).forEach(element => {
    element.addEventListener('click', () => {
      window.location.href = 'compteHabitat.php'
    })
  })

  Array.from(lienanimal).forEach(element => {
    element.addEventListener('click', () => {
      window.location.href = 'compteAnimal.php'
    })
  })

  //script index.php
  // affichage carrousel avis
  if (document.body.id === 'js_index_page') {
    let currentIndex = 0

    function showNextDiapo() {
      if (diapoContainer && diapos.length > 0) {  // Vérifiez que diapoContainer et diapos existent
        currentIndex++
        if (currentIndex >= diapos.length) {
          currentIndex = 0
        }
        diapoContainer.style.transform = `translateX(-${currentIndex * 100}%)`//transition des diapos
      } else {
        console.error('diapoContainer ou diapos sont introuvables.')
      }
    }

    setInterval(showNextDiapo, 4000); // Change de diapo toutes les 4s
  }

  //script habitat.php + incrementation BDD arcadia_mongoDB
  // Initialiseation des affichages à 'none'
  document.querySelectorAll('.js_habitat_animals .js_animal').forEach(animal => animal.style.display = 'none')
  document.querySelectorAll('.js_animal_description').forEach(description => description.style.display = 'none')

  // gestionnaires d'événements pour les images des habitats
  document.querySelectorAll('.js_habitat_img').forEach(img => {
    img.addEventListener('click', () => {
      const habitat = img.dataset.habitat
      toggleAnimalsDisplay(habitat)
    })
  })

  // Ajouter des gestionnaires d'événements pour les images des animaux
  animalImages.forEach(img => {
    img.addEventListener('click', function () {
      const animalName = this.dataset.animal

      // Basculer l'affichage de la description de l'animal
      toggleAnimalDescription(animalName);

      // Requête POST au serveur pour incrémenter le compteur dans MongoDB
      fetch('compteAnimal.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ nom: animalName })
      })
        .then(response => response.json())  // Convertir la réponse en JSON
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

  function toggleAnimalsDisplay(habitat) {
    console.log(`Toggling animals display for habitat: ${habitat}`)

    const animals = document.querySelectorAll(`.js_habitat_animals[data-habitat="${habitat}"] .js_animal`)
    const descriptions = document.querySelectorAll(`.js_habitat_animals[data-habitat="${habitat}"] .js_animal_description`)

    if (animals.length === 0) {
      console.log('Pas d\'animal trouvé pour cet habitat.')
    }
    if (descriptions.length === 0) {
      console.log('Pas de description trouvée pour cet habitat.')
    }

    animals.forEach(animal => {
      animal.style.display = (animal.style.display === 'none' || animal.style.display === '') ? 'block' : 'none'
    })

    descriptions.forEach(description => {
      description.style.display = 'none'
    })
  }

  function toggleAnimalDescription(animalName) {
    console.log(`Toggling description for animal: ${animalName}`);
  
    // Masquer toutes les descriptions d'animaux avant d'en afficher une
    document.querySelectorAll('.js_animal_description').forEach(description => {
      description.style.display = 'none';
    });
  
    // Afficher la description de l'animal cliqué
    const description = document.querySelector(`.js_animal_description[data-animal="${animalName}"]`);
    if (description) {
      description.style.display = 'block';
    }
  }
})

