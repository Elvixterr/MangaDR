const resultBox = document.querySelector(".result-box");
const inputBox = document.getElementById("input-box");


// Agregar un event listener al botón
inputBox.addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
    // Obtener el valor del input
    const searchTerm = inputBox.value.trim();

    window.location.href = `index.php?keyword=` + searchTerm;
    }
});

/* Función de búsqueda
async function searchFunction(searchTerm) {
    const url = 'https://mangaverse-api.p.rapidapi.com/manga/search?text=' + searchTerm + '&nsfw=true&type=all';
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
            }));

            const content = dataArray.map((item) => {
                return "<li id =" + item.id + ">" + item.title + "</li>";
            }).join("");

            resultBox.innerHTML = "<ul class='SearchResult'>" + content + "</ul>";

        } else {
            resultBox.innerHTML = "<ul class='SearchResult'>No hemos encontrado nada parecido a: " + searchTerm + "</ul>";
        }

    } catch (error) {
        console.error(error);
    }
}
*/
