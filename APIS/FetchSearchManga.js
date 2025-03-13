var manga = {
    estado: null,
    id: null,
};

function inicializar() {

    document.getElementById('leido').addEventListener('click', function() {
        obtenerId('Leido');
    });

    document.getElementById('leyendo').addEventListener('click', function() {
        obtenerId('Leyendo');
    });

    document.getElementById('favorito').addEventListener('click', function() {
        obtenerId('Favorito');
    });

    document.getElementById('pendiente').addEventListener('click', function() {
        obtenerId('Pendiente');
    });
}

(async () => {
    // Obtener el valor del parámetro "id" de la URL
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');
    manga.id = id;

    // Verificar si el valor de "id" está presente y no es null
    if (id === null) {
        console.log("No se encontró un ID válido en la URL.");
        return;
    }

    const url = 'https://mangaverse-api.p.rapidapi.com/manga?id=' + id;
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

            // Crear el div para la imagen del manga
            const mangaPreviewContainer = document.createElement('div');
            mangaPreviewContainer.className = 'manga';
            const mangaImg = document.createElement('img');
            mangaImg.className = 'manga-preview';
            mangaImg.src = item.thumb;

            mangaPreviewContainer.appendChild(mangaImg);

            // Insertar el div de la imagen al principio del primer row-container
            const rowContainer = document.querySelector('.top-manga .row-container');
            const firstChild = rowContainer.firstChild;
            rowContainer.insertBefore(mangaPreviewContainer, firstChild);

            // Crear el div para el título y la sinopsis
            const mangaDescContainer = document.createElement('div');
            mangaDescContainer.className = 'manga-desc';
            const mangaTitle = document.createElement('h1');
            mangaTitle.textContent = item.title;

            mangaDescContainer.appendChild(mangaTitle);
            const mangaSummary = document.createElement('p');
            mangaSummary.textContent = item.summary;
            mangaDescContainer.appendChild(mangaSummary);

            // Insertar el div del título y la sinopsis al principio del segundo row-container
            const rowContainer2 = document.querySelector('.top-manga .row-container .row-container .mainmanga');
            const firstChild2 = rowContainer2.firstChild;
            rowContainer2.insertBefore(mangaDescContainer, firstChild2);

            // Crear el div para los géneros
            const mangaGenresContainer = document.createElement('div');
            mangaGenresContainer.style = 'justify-content: center'
            mangaGenresContainer.className = 'genero';


            // Iterar sobre cada género y crear un elemento <p> para cada uno
            item.genres.forEach(genre => {
                const genreElement = document.createElement('div');
                genreElement.className = "genero1";
                const genreText = document.createElement('p');
                genreText.textContent = genre;
                genreElement.appendChild(genreText)
                mangaGenresContainer.appendChild(genreElement);
            });

            // Insertar el div de géneros al principio del segundo row-container
            rowContainer2.insertBefore(mangaGenresContainer, firstChild2);

            const spaces = document.createElement('br');
            rowContainer2.insertBefore(spaces, firstChild2);


            const Status = document.createElement('div');
            var StatusText = document.createElement('p');
            StatusText.textContent = "STATUS: " + item.status.toUpperCase();
            Status.appendChild(StatusText);

            rowContainer2.insertBefore(Status, firstChild2);
            rowContainer2.insertBefore(spaces, firstChild2);

            const authors = document.createElement('p');        

            authors.textContent = "AUTHORS: " + item.authors;

            rowContainer2.insertBefore(authors, firstChild2);

            mangaList(item.title);            
        } else {
            console.log("No se pudo obtener la información del manga.");
        }
    } catch (error) {
        console.error(error);
    }        
})();

document.addEventListener('DOMContentLoaded', function() {
    inicializar();
    const dialog = document.getElementById("MessageDialog");
    dialog.addEventListener("click", ()=> dialog.close());
});


function obtenerId(estado) {   
    manga.estado = estado;
    // Convertir el objeto a formato JSON
    var jsonData = JSON.stringify(manga);

    // Configurar los datos a enviar
    var data = new FormData();
    data.append('manga', jsonData);

    // Enviar la solicitud con fetch
    fetch('db/userList.php', {
        method: 'POST',
        body: data
    }).then(response => response.text()).then(data => {
        const dialog = document.getElementById("MessageDialog");
        
        dialog.innerHTML = '<h2 class = "modal-title">'+data+'</h2>';

        // Agregar la clase para aplicar la animación
        dialog.classList.add('fadeIn');
        dialog.showModal();

        
    }).catch(error => {
        console.error('Error:', error);
        const dialog = document.getElementById("MessageDialog");
        dialog.innerHTML = '<h2 class = "modal-title">Hubo un error al agregar el manga a su lista: '+manga.estado+'</h2>';
        dialog.classList.add('fadeIn');
        dialog.showModal();
    });
}






