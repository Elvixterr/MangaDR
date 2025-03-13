(async () => {
    const urlParams = new URLSearchParams(window.location.search);
    const idSection = urlParams.get('id');
    const type = urlParams.get('type');
    const keyword = urlParams.get('keyword');

    let url;

    if(idSection)
    {
        switch(idSection)
        {
            case '1': url = 'https://mangaverse-api.p.rapidapi.com/manga/latest?page=1%2C2&nsfw=false&type=all';
            break;
            case '2': url = 'https://mangaverse-api.p.rapidapi.com/manga/fetch?page=5&nsfw=false&type=all';
            break;
            case '3': url = 'https://mangaverse-api.p.rapidapi.com/manga/fetch?page=6&nsfw=false&type=all';
            break;
            default: url = 'https://mangaverse-api.p.rapidapi.com/manga/fetch?page=10&nsfw=false&type=all'
            break;
        }
    }
    else
    {
        if (keyword)
        {
            url = 'https://mangaverse-api.p.rapidapi.com/manga/search?text=' + keyword + '&nsfw=true&type=all';
        }
        else
        {
            if (type) {
                url = 'https://mangaverse-api.p.rapidapi.com/manga/fetch?page=1&nsfw=false&type=' + type;
            } else {
                url = 'https://mangaverse-api.p.rapidapi.com/manga/fetch?page=1&nsfw=false&type=all';
            }
        }
    }

    const options = {
        method: 'GET',
        headers: {
            'X-RapidAPI-Key': '01efbb1ef6msh12ba49696c688e1p1195b0jsn0ce0f7b28829',
            'X-RapidAPI-Host': 'mangaverse-api.p.rapidapi.com'
        }
    };

    try {
        const response = await fetch(url, options);
        const responseData = await response.json();

        if (Array.isArray(responseData.data)) {
            const dataArray = responseData.data.map(item => ({
                id: item.id,
                title: item.title,
                subTitle: item.sub_title,
                status: item.status,
                thumb: item.thumb,
                summary: item.summary,
                authors: item.authors.length > 0 ? item.authors.join(', ') : 'Unknown',
                genres: item.genres.length > 0 ? item.genres.join(', ') : 'Unknown',
                nsfw: item.nsfw,
                type: item.type,
                totalChapter: item.total_chapter,
                createAt: item.create_at,
                updateAt: item.update_at
            }));

            const mangaContainers1 = document.querySelector('.top-manga');

            mangaContainers1.innerHTML = ''; // Para vaciar su contenido

            var Organizer = redondearHaciaArriba(dataArray.length/ 5);
            for (let i = 0; i < Organizer; i++) {
                const mangaContainer = document.createElement('div');
                mangaContainer.className = 'row-container';
                mangaContainers1.appendChild(mangaContainer);
            }

            const mangaContainers = document.querySelectorAll('.top-manga .row-container');
            mangaContainers.forEach(container => {
                for (let i = 0; i < 4; i++) {
                    const mangaDiv = document.createElement('div');
                    mangaDiv.className = 'manga';
                    container.appendChild(mangaDiv);
                }
            });

            const mangaPreviews = document.querySelectorAll('.top-manga .row-container .manga');
            mangaPreviews.forEach((mangaPreviews, index) => {

                if(dataArray[index])
                {
                    const item = dataArray[index];
                    const mangaImg = document.createElement('img');
                    mangaImg.className = 'manga-preview'
                    mangaImg.id = item.id;
                    mangaImg.src = item.thumb;
                    mangaPreviews.appendChild(mangaImg);

                    const mangaTitle = document.createElement('p');
                    mangaTitle.innerText = item.title;
                    mangaPreviews.appendChild(mangaTitle);

                    mangaPreviews.addEventListener('click', function() {
                        window.location.href = `manga.php?id=${encodeURIComponent(mangaImg.id)}`;
                    });
                }
            });
        } else {
            console.error('La respuesta de la API no contiene un arreglo de datos:', responseData);
        }
    } catch (error) {
        console.error(error);
    }
})();

function redondearHaciaArriba(numero) {
    if (numero % 1 !== 0) { // Verificar si tiene parte decimal
        return Math.ceil(numero); // Redondear hacia arriba si tiene parte decimal
    } else {
        return numero; // Devolver el número sin cambios si no tiene parte decimal
    }
}


