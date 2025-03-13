var globalFlag = false;

document.addEventListener('DOMContentLoaded', function() {
    let isFileDialogOpen = false; // Variable de control

    inicializar();

    const dialog = document.getElementById("MessageDialog");
    dialog.addEventListener("click", function() {
    dialog.close();
        
        if(globalFlag)
        {
            window.location.href = 'user.php';
        }
        
    });

    document.getElementById('fileInput').addEventListener('change', function() {
        const file = this.files[0];
        OpenExplorer(file);
    });
});

function inicializar() {
    document.getElementById('leido').addEventListener('click', function() {
        Filter('Leido');
    });

    document.getElementById('leyendo').addEventListener('click', function() {
        Filter('Leyendo');
    });

    document.getElementById('favorito').addEventListener('click', function() {
        Filter('Favorito');
    });

    document.getElementById('pendiente').addEventListener('click', function() {
        Filter('Pendiente');
    });
}

function Filter(estado) {
    fetch(`db/UserMangas.php`)
    .then(response => {
        console.log(response.status);
        return response.json();
    })
    .then(data => {
        if (Array.isArray(data)) {
            console.log(data);
            const dataArray = data.map(item => ({
                status: item.estado,               
                id: item.id,
            }));

            const mangaContainers = document.querySelector('.top-manga');

            mangaContainers.innerHTML = ''; // Para vaciar su contenido

            var Organizer = redondearHaciaArriba(dataArray.length/ 5);
            for (let i = 0; i < Organizer; i++) {
                const mangaContainer = document.createElement('div');
                mangaContainer.className = 'row-container';
                mangaContainers.appendChild(mangaContainer);
            }

            const rowContainer = document.querySelectorAll('.top-manga .row-container');
            rowContainer.forEach(container => {
                for (let i = 0; i < 5; i++) {
                    const mangaDiv = document.createElement('div');
                    mangaDiv.className = 'manga';
                    container.appendChild(mangaDiv);
                }
            });

            const arrayFilted = [];
            var loop = 0;

            for (let i = 0; i < dataArray.length; i++)
            {
                if(dataArray[i].status === estado)
                {
                    arrayFilted[loop] = dataArray[i];
                    loop++;
                }

            }

            const mangaPreviews = document.querySelectorAll('.top-manga .row-container .manga');
            mangaPreviews.forEach((mangaPreviews, index) => {
                if(arrayFilted[index] && arrayFilted[index].status === estado)
                {
                    (async () => {                        
                        const url = 'https://mangaverse-api.p.rapidapi.com/manga?id=' + arrayFilted[index].id;
                        const options = {
                            method: 'GET',
                            headers: {
                                'X-RapidAPI-Key': '01efbb1ef6msh12ba49696c688e1p1195b0jsn0ce0f7b28829',
                                'X-RapidAPI-Host': 'mangaverse-api.p.rapidapi.com'
                            }
                        };
                        
                        try {
                            const response = await fetch(url, options);
                            const result = await response.json(); 
                        
                            if (result.code === 200 && result.data) {
                                const item = result.data;                        
                                const mangaImg = document.createElement('img');
                                mangaImg.className = 'manga-preview';
                                mangaImg.id = item.id;
                                mangaImg.src = item.thumb;
                                mangaPreviews.appendChild(mangaImg);
    
                                const mangaTitle = document.createElement('p');
                                mangaTitle.innerText = item.title;
                                mangaTitle.style = "color: black;"
                                mangaPreviews.appendChild(mangaTitle);

                                mangaPreviews.addEventListener('click', function() {
                                    window.location.href = `manga.php?id=${encodeURIComponent(arrayFilted[index].id)}`;
                                });
                              
                            } else {
                                console.log("No se pudo obtener la información del manga.");
                            }
                        } catch (error) {
                            console.error(error);
                        }        
                    })();    
                }
            });
        }
        else
        {
            console.log(data);

            const dialog = document.getElementById("MessageDialog");
        
            dialog.innerHTML = '<h2 class = "modal-title">'+data+'</h2>';
            dialog.classList.add('fadeIn');
            
            dialog.showModal();
        };
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function redondearHaciaArriba(numero) {
    if (numero % 1 !== 0) { // Verificar si tiene parte decimal
        return Math.ceil(numero); // Redondear hacia arriba si tiene parte decimal
    } else {
        return numero; // Devolver el número sin cambios si no tiene parte decimal
    }
}

function OpenExplorer(file) {
    const formData = new FormData();
    formData.append('file', file);
  
    fetch('db/SubirAvatar.php', {
      method: 'POST',
      body: formData
    })
    .then(response => {
        console.log(response.status);
        return response.json();
    })
    .then(data => {
        console.log(data);

        const dialog = document.getElementById("MessageDialog");
    
        dialog.innerHTML = '<h2 class = "modal-title">Your profile picture has been updated!</h2>';
        globalFlag = true;
        dialog.classList.add('fadeIn');
        dialog.showModal();

    })
    .catch(error => {
        console.error('Error: ' + error);
        const dialog = document.getElementById("MessageDialog");
    
        dialog.innerHTML = '<h2 class = "modal-title">Your image is over 1MB</h2>';
        dialog.classList.add('fadeIn');
        
        dialog.showModal();
    });
}
