(async () => {

    // Obtener el valor del parámetro "id" de la URL
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');
    const MangaTitle = urlParams.get('title');
    const chapter = urlParams.get('chapter');


    // Verificar si el valor de "id" está presente y no es null
    if (id === null) {
        console.log("No se encontró un ID válido en la URL.");
        return;
    }

    const url = 'https://mangaverse-api.p.rapidapi.com/manga/image?id=' + id;
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
                chapter: item.chapter,
                manga: item.manga,
                index: item.index,
                link: item.link,
            }));

            const Chapterheader = document.querySelector('.main-container');

            const BttnContainer = document.createElement('div')
            BttnContainer.id = 'chapter'
            BttnContainer.style = "display: flex; flex-direction: row;"

            var Bttn = document.createElement('button');
            Bttn.textContent = "Previous Chapter";
            Bttn.className = "btn btn-light"
            Bttn.style = "margin-right: 333px;"
            Bttn.addEventListener('click', function() {
                const item = dataArray[0];
                window.location.href = `manga.php?id=${encodeURIComponent(item.manga)}&chapter=${encodeURIComponent(item.chapter)}&action=${encodeURIComponent('previous')}`;
            });


            BttnContainer.appendChild(Bttn);

            Bttn = document.createElement('button');
            Bttn.textContent = "Next Chapter";
            Bttn.className = "btn btn-light"
            Bttn.addEventListener('click', function() {

                const item = dataArray[0];
                window.location.href = `manga.php?id=${encodeURIComponent(item.manga)}&chapter=${encodeURIComponent(item.chapter)}&action=${encodeURIComponent('next')}`;
            });

            BttnContainer.appendChild(Bttn);

            Chapterheader.appendChild(BttnContainer);

            Bttn = document.createElement('button');
            Bttn.textContent = "Back";
            Bttn.className = "btn btn-light"
            Bttn.addEventListener('click', function() {

                const item = dataArray[0]
                window.location.href = `manga.php?id=${encodeURIComponent(item.manga)}`;
            });

            Chapterheader.appendChild(Bttn);

            const ChapterImages = document.createElement("div");
            ChapterImages.className = "main-container";

            dataArray.forEach((element, index) => {

            const item = dataArray[index];

            const Images = document.createElement('img');
            Images.className = 'manga-read';
            Images.src = item.link;

            ChapterImages.appendChild(Images);
            });

            const firstChild = Chapterheader.firstChild

            Chapterheader.insertBefore(ChapterImages, firstChild);

            const headerInfo = document.createElement('div');
            headerInfo.className = 'manga-info';
            headerInfo.innerText = MangaTitle + ': ' + chapter;

            const firstChild2 = Chapterheader.firstChild

            Chapterheader.insertBefore(headerInfo, firstChild2);


        } else {
            console.error('La respuesta de la API no contiene un arreglo de datos:', responseData);
        }
    } catch (error) {
        console.error(error);
    }
})();
