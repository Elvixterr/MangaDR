function mangaList(MangaTitle) {
    (async () => {

        // Obtener el valor de los parametros en la url
        const urlParams = new URLSearchParams(window.location.search);
        const id = urlParams.get('id');
        const chapter = urlParams.get('chapter');
        const action = urlParams.get('action');

        // Verificar si los valores de la url estan presentes
        if (id === null) {
            console.log("No se encontró un ID válido en la URL.");
            return;
        }

        const url = 'https://mangaverse-api.p.rapidapi.com/manga/chapter?id=' + id;
        const options = {
            method: 'GET',
            headers: {
                'X-RapidAPI-Key': '01efbb1ef6msh12ba49696c688e1p1195b0jsn0ce0f7b28829',
                'X-RapidAPI-Host': 'mangaverse-api.p.rapidapi.com'
            }
        };

        if (chapter === null) {
            try {
                const response = await fetch(url, options);
                const responseData = await response.json();

                if (Array.isArray(responseData.data)) {

                    const dataArray = responseData.data.map(item => ({
                        id: item.id,
                        manga: item.manga,
                        title: item.title,
                        createAt: item.create_at,
                        updateAt: item.update_at
                    }));

                    const mangaList = document.getElementById('ListaCapitulos')
                    const ListBody = document.createElement('tbody')

                    dataArray.forEach((element, index) => {

                        const item = dataArray[index];

                        const ChapterCont = document.createElement('tr');
                        ChapterCont.style = 'cursor: pointer';
                        ChapterCont.id = item.id;


                        ChapterCont.addEventListener('click', function () {
                            window.location.href = `reader.php?id=${encodeURIComponent(ChapterCont.id)}&title=${encodeURIComponent(MangaTitle)}&chapter=${encodeURIComponent(item.title)}`;
                        });

                        var ChapterCont2 = document.createElement('td');
                        ChapterCont2.style = 'cursor: pointer';
                        ChapterCont2.innerText = index + 1;  //Numero del capitulo
                        ChapterCont.appendChild(ChapterCont2);

                        ChapterCont2 = document.createElement('td');
                        ChapterCont2.style = 'cursor: pointer';
                        ChapterCont2.innerText = item.title;   //Titulo del capitulo
                        ChapterCont.appendChild(ChapterCont2);

                        //Poniendo en formato la fecha del capitulo

                        // Convertir el timestamp en milisegundos a una fecha
                        var fecha = moment(item.createAt);

                        // Formatear la fecha en DD/MM/YYYY
                        var FormattedDate = fecha.format('DD/MM/YYYY HH:mm:ss');

                        ChapterCont2 = document.createElement('td');
                        ChapterCont2.style = 'cursor: pointer';
                        ChapterCont2.innerText = FormattedDate;
                        ChapterCont.appendChild(ChapterCont2);

                        ListBody.appendChild(ChapterCont);
                    });
                    mangaList.appendChild(ListBody);
                } else {
                    console.error('La respuesta de la API no contiene un arreglo de datos:', responseData);
                }
            } catch (error) {
                console.error(error);
            }
        } else {
            try {
                const response = await fetch(url, options);
                const responseData = await response.json();

                if (Array.isArray(responseData.data)) {

                    const dataArray = responseData.data.map(item => ({
                        id: item.id,
                        manga: item.manga,
                        title: item.title,
                        createAt: item.create_at,
                        updateAt: item.update_at
                    }));

                    dataArray.forEach((element, index) => {

                        if (dataArray[index].id === chapter) {
                            if (action === 'next') {
                                window.location.href = `reader.php?id=${encodeURIComponent(dataArray[index + 1].id)}&title=${encodeURIComponent(MangaTitle)}&chapter=${encodeURIComponent(dataArray[index + 1].title)}`;
                            } else {
                                window.location.href = `reader.php?id=${encodeURIComponent(dataArray[index - 1].id)}&title=${encodeURIComponent(MangaTitle)}&chapter=${encodeURIComponent(dataArray[index - 1].title)}`;
                            }
                        }
                    });
                } else {
                    console.error('La respuesta de la API no contiene un arreglo de datos:', responseData);
                }

            } catch (error) {
                console.error(error);
            }
        }
    })();
}
