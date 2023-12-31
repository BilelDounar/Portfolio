AOS.init({
    startEvent: 'DOMContentLoaded'
});

let blanc10 = '#ffffff10';
let blanc = '#fff';

document.addEventListener('DOMContentLoaded', function () {
    // Le DOM est prêt, mais certaines ressources peuvent encore être en cours de chargement
    console.log('DOM prêt');

    // Ajouter un gestionnaire d'événement pour l'événement onload de la fenêtre
    window.onload = function () {
        // Tout le contenu de la page, y compris les ressources externes, est chargé
        console.log('Toute la page est chargée');

        // Ajouter un délai de 2 secondes avant de masquer l'écran de chargement
        setTimeout(function () {
            var loadingScreen = document.getElementById('loading-screen');
            loadingScreen.style.display = 'none';
        }, 2000);
    };
});


function contracteSidebar(event) {
    event.preventDefault();
    var sidebar = document.querySelector('.sidebar');
    var aside = document.querySelector('.section_sidebar');
    var icon = document.getElementById('sidebarIcon');
    var spans = document.querySelectorAll('li span');
    var logoSpan = document.querySelector('.logo_sidebar');
    var box_icon = document.querySelector('.button_footer_sidebar');


    if (icon.classList.contains('fa-angles-left')) {
        icon.classList.remove('fa-angles-left');
        icon.classList.add('fa-angles-right');
        sidebar.style.width = '7vw';
        aside.style.marginLeft = '5rem';
        box_icon.style.flexDirection = 'column-reverse';
        box_icon.style.gap = '1rem';

        spans.forEach(function (span) {
            span.style.display = 'none';
        });

        logoSpan.textContent = 'B.';

    } else {
        icon.classList.remove('fa-angles-right');
        icon.classList.add('fa-angles-left');
        sidebar.style.width = '20vw';
        aside.style.marginLeft = '16rem';

        spans.forEach(function (span) {
            span.style.display = 'flex';
        });
        box_icon.style.flexDirection = 'row';
        box_icon.style.gap = '0';

        logoSpan.textContent = 'Bilel Dounar';
    }
}

function parameter(event) {
    event.preventDefault();
    modal_parameter.style.display = 'block';
}

function leaveModal() {
    modal_parameter.style.display = 'none';
}





function toggleTheme() {
    // Fermer le modal_parameter si ouvert
    var modal_parameter = document.getElementById('modal_parameter');

    blanc = '#000';
    blanc10 = '#00000010';

    var root = document.documentElement;
    var currentPrimaryColor = getComputedStyle(root).getPropertyValue('--primary').trim();
    var currentSecondaryColor = getComputedStyle(root).getPropertyValue('--secondary').trim();

    // Basculer entre les couleurs primaires claires et sombres
    var newPrimaryColor = currentPrimaryColor === '#000000' ? '#ffffff' : '#000000';
    var newSecondaryColor = currentSecondaryColor === '#f5f5f5' ? '#000000' : '#ffffff';

    // Modifier les variables dans :root
    root.style.setProperty('--primary', newPrimaryColor);
    root.style.setProperty('--secondary', newSecondaryColor);

    // Modifier la couleur du texte et du hover directement
    var elementsWithWhiteText = document.querySelectorAll('.dark\\:text-white');

    elementsWithWhiteText.forEach(function (element) {
        if (newPrimaryColor === '#ffffff') {
            // Si la couleur primaire est blanche, le texte devient noir
            element.style.color = 'black';

            // Modifier la couleur au survol en blanc
            element.addEventListener('mouseover', function () {
                element.style.color = 'white';
            });

            // Revenir à la couleur originale après le survol
            element.addEventListener('mouseout', function () {
                element.style.color = 'black';
            });

        } else {
            // Sinon, le texte devient blanc
            element.style.color = 'white';

            // Modifier la couleur au survol en blanc
            element.addEventListener('mouseover', function () {
                element.style.color = 'black';
            });

            // Revenir à la couleur originale après le survol
            element.addEventListener('mouseout', function () {
                element.style.color = 'white';
            });
        }
    });

    // Mettre à jour les options du graphique avec les nouvelles couleurs
    options.scales.y.grid.color = blanc10;
    options.scales.y.ticks.color = blanc;
    options.scales.x.ticks.color = blanc;

    // Mettre à jour le graphique
    myChart.update();
}

var data = {
    labels: ['HTML', 'CSS', 'PHP', 'SQL', 'JS', 'Git', 'Figma'],
    datasets: [{
        label: 'Maitrise sur 100',
        data: [90, 75, 70, 80, 60, 90, 65],
        backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(255, 159, 64, 0.2)', 'rgba(255, 205, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(54, 162, 235, 0.2)'], // Couleur de fond pour chaque barre
        borderColor: ['rgba(255, 99, 132, 1)', 'rgba(255, 159, 64, 1)', 'rgba(255, 205, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(54, 162, 235, 1)'], // Couleur de la bordure pour chaque barre
        borderWidth: 1,

    }]
};


var options = {
    scales: {
        y: {
            min: 0,
            max: 100,
            beginAtZero: true,
            grid: {
                color: blanc10 // Couleur de la grille de l'axe Y
            },
            ticks: {
                color: blanc // Couleur du texte de l'axe Y
            }
        },
        x: {
            ticks: {
                color: blanc // Couleur du texte de l'axe Y
            }
        }
    },
    animation: {
        onComplete: function (animation) {
            // Marquer l'animation comme complète après l'apparition de la dernière barre
            myChart.options.animation.onComplete = null;
        },
        delay: function (context) {
            // Ajouter un délai pour chaque barre basé sur son index
            return context.dataIndex * 100;
        }
    },
    plugins: {
        legend: {
            display: false
        }
    },
    hover: {
        mode: 'nearest',
        intersect: true
    },
    onClick: function (event, elements) {
        // Gérer le clic sur une barre
        if (elements.length > 0) {
            var index = elements[0].index;
            console.log('Barre cliquée :', data.labels[index], data.datasets[0].data[index]);
        }
    }
};



var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: options
});


document.addEventListener('DOMContentLoaded', function () {
    var socialIcons = document.querySelectorAll('.reseaux .fa-brands,.reseaux .fa-solid ');

    // Ajouter la classe lors du survol pour chaque icône
    socialIcons.forEach(function (icon) {
        icon.addEventListener('mouseover', function () {
            // Ajoutez la classe fa-bounce à votre élément <i>
            icon.classList.add('fa-bounce');
        });

        // Supprimer la classe lorsqu'on quitte le survol
        icon.addEventListener('mouseout', function () {
            // Retirez la classe fa-bounce de votre élément <i>
            icon.classList.remove('fa-bounce');
        });
    });
});



//MODAL PROJETS

var titre_projet = document.querySelector('.modal_projets_text h2');
var span_projet = document.querySelector('.modal_projets_text span');
var descri_projet = document.querySelector('.modal_projets_content p');
var link = document.querySelector('.modal_projets_content a');

let projets = {
    "projetOnlyvax": {
        "titre": "ONLYVAX",
        "description": "Carnet de vaccination",
        "paragraphe": "Onlyvax, un projet de groupe conçu dans le cadre de ma première année de formation en développement web, propose un site intuitif dédié à la gestion des vaccins et des rappels pour ses utilisateurs.",
        "image_url": "asset/img/green_theme.jpg",
        "github_url": "https://github.com/BilelDounar/ONLYVAX"
    },
    "agGrid": {
        "titre": "AG-GRID",
        "description": "Gestion d’info. utilisateur",
        "paragraphe": "Ici, vous trouverez un projet d'application web utilisant AG-Grid pour la gestion d'informations utilisateur. <br><br> Celui-ci a été réalisé lors d'un stage de deux mois à l'étranger.",
        "image_url": "asset/img/orange_theme.jpg",
        "github_url": "https://github.com/BilelDounar/AG-Grid"
    },
    "portfolio": {
        "titre": "PORTFOLIO",
        "description": "Mon Portfolio",
        "paragraphe": "Vous trouverez ici mon portfolio sur lequel vous êtes actuellement. <br><br> Celui-ci a été créé en HTML/CSS, PHP et JavaScript avec de légères inspirations d’un site très connu.",
        "image_url": "asset/img/blue_theme.jpg",
        "github_url": "https://github.com/BilelDounar/Portfolio"
    }
};

var modal_projets = document.querySelector('#modal_projets')
var modal_bk_filter = document.querySelector('#modal_bk_filter')

function modalProjets(event, id) {
    event.preventDefault();

    // Vérifiez si l'ID spécifié existe dans les projets
    if (projets.hasOwnProperty(id)) {
        var projet = projets[id];

        // Affichez les informations du projet spécifique
        titre_projet.innerHTML = projet.titre;
        span_projet.innerHTML = projet.description;
        descri_projet.innerHTML = projet.paragraphe;
        link.href = projet.github_url;

        modal_bk_filter.style.display = 'block';
        modal_projets.style.display = 'block';
        modal_projets.style.backgroundImage = `url("${projet.image_url}")`;
        modal_projets.style.backgroundColor = `var(--tertiary)`;
        modal_projets.style.backgroundPosition = `50%`;
        modal_projets.style.backgroundSize = `cover`;
        modal_projets.style.backgroundRepeat = `no-repeat`;
    } else {
        console.error('Le projet spécifié n\'existe pas dans le fichier JSON.');
    }
}


function leaveModalProjets() {
    modal_projets.style.display = 'none';
}
const closemenu = document.querySelector('.leave_sidebar');
var sidebar = document.querySelector('.sidebar');



function burgerOpen() {
    const sidebarHidden = document.querySelector('.sm\\:translate-x-0');


    sidebarHidden.classList.toggle('hidden');
    sidebarHidden.style.width = '0px';
    sidebar.style.width = '70vw';
    closemenu.style.display = 'block'
}

console.log(window.innerWidth);
function burgerClose() {
    const sidebarHidden = document.querySelector('.sm\\:translate-x-0');


    var sidebar = document.querySelector('.sidebar');
    sidebarHidden.classList.toggle('hidden');

    if (window.innerWidth >= 1050) {
        sidebar.style.display = 'flex';
        sidebarHidden.style.width = '0';
        sidebar.style.width = '22vw';
        location.reload();
    } else {
        sidebar.style.width = '0vw';
        sidebarHidden.style.width = '20vw';


    }
    closemenu.style.display = 'none'
}


document.addEventListener("DOMContentLoaded", function () {
    const changingText = document.getElementById("changing-text");
    const texts = [" Etudiant", " Développeur", " Alternant?"];

    let index = 0;
    let charIndex = 0;

    function type() {
        if (charIndex < texts[index].length) {
            changingText.textContent += texts[index].charAt(charIndex);
            charIndex++;
            setTimeout(type, 100); // Adjust the typing speed here
        } else {
            setTimeout(erase, 2000); // Adjust the time before erasing here
        }
    }

    function erase() {
        if (charIndex > 0) {
            changingText.textContent = texts[index].substring(0, charIndex - 1);
            charIndex--;
            setTimeout(erase, 50); // Adjust the erasing speed here
        } else {
            index++;
            if (index >= texts.length) {
                index = 0;
            }
            setTimeout(type, 1000); // Adjust the time before typing the next text here
        }
    }

    type(); // Start the typing animation
});



function desactiverBouton() {
    var bouton = document.getElementById('submitBtn');
    setTimeout(function() {
        bouton.disabled = true;
    }, 1000); 

    setTimeout(function() {
        bouton.disabled = false;
    }, 5000); 
}