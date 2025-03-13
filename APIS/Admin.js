document.addEventListener('DOMContentLoaded', function() {
    
    fetch(`db/AdminData.php`)
    .then(response => {
        console.log(response.status);
        return response.json();
    })
    .then(data => {

            const TableDiv = document.getElementById("AdminTable");
            const ListBody = document.createElement("tbody");

                const ChapterCont = document.createElement('tr');

                var ChapterCont2 = document.createElement('td');
                ChapterCont2.innerText = data.TotalCuentas;
                ChapterCont.appendChild(ChapterCont2);

                var ChapterCont2 = document.createElement('td');
                ChapterCont2.innerText = data.TotalLeido;
                ChapterCont.appendChild(ChapterCont2);

                var ChapterCont2 = document.createElement('td');
                ChapterCont2.innerText = data.TotalLeyendo;
                ChapterCont.appendChild(ChapterCont2);

                var ChapterCont2 = document.createElement('td');
                ChapterCont2.innerText = data.TotalFav;
                ChapterCont.appendChild(ChapterCont2);

                var ChapterCont2 = document.createElement('td');
                ChapterCont2.innerText = data.TotalPendiente;
                ChapterCont.appendChild(ChapterCont2);

                var ChapterCont2 = document.createElement('td');
                ChapterCont2.innerText = data.TotalMangas;
                ChapterCont.appendChild(ChapterCont2);

                ListBody.appendChild(ChapterCont);
                TableDiv.appendChild(ListBody);


    })
    .catch(error => {
        console.error('Error:', error);
    });

});