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
    var icon = document.getElementById('sidebarIcon');
    var spans = document.querySelectorAll('li span');
    var logoSpan = document.querySelector('.logo_sidebar');
    var box_icon = document.querySelector('.button_footer_sidebar');

    if (icon.classList.contains('fa-angles-left')) {
        icon.classList.remove('fa-angles-left');
        icon.classList.add('fa-angles-right');
        sidebar.style.width = '7vw';
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
    var newSecondaryColor = currentSecondaryColor === '#f5f5f5' ? '#000000' : '#f5f5f5';

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
    labels: ['HTML', 'CSS', 'PHP', 'SQL', 'JS'],
    datasets: [{
        label: 'Savoir /100%',
        data: [90, 75, 70, 80, 60],
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
