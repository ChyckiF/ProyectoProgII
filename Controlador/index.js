// Si tocamos el button home, nos lleva a la vista de inicio
document.getElementById('btn-home').addEventListener('click', () => {
    window.location.href = 'index.html'; // Redirige a la página de inicio
});
// Si tocamos el imgen logo, nos lleva a la vista de inicio
document.querySelector('img[alt="Imagen Logo"]').addEventListener('click', () => { // Selecciona la imagen por su atributo alt
    window.location.href = 'index.html'; // Redirige a la página de inicio
});


// Buscamos el json de peliculas
fetch('../Base_Datos/movies.json')
.then(response => {
    if (!response.ok) {
        throw new Error('Error al cargar el archivo JSON');
    }
    return response.json();
})

.then(DataMovies => {
    const peliculas = DataMovies.peliculas; // Accedemos al array de películas
    const total = peliculas.length; // Obtenemos el total de películas

    if (total < 4) { // Verificamos que haya al menos 4 películas
        throw new Error('No hay suficientes películas para mostrar.'); // Si no, lanzamos un error
    }
    const indicesRandom = []; // Array para guardar los índices aleatorios
    const usadas = new Set(); // Conjunto para rastrear índices ya usados
    while (indicesRandom.length < 4) { // Mientras no tengamos 4 índices
        const randomIndex = Math.floor(Math.random() * total); // Generamos un índice aleatorio
        if (!usadas.has(randomIndex)) { // Si no hemos usado este índice antes 
            usadas.add(randomIndex); // Lo marcamos como usado
            indicesRandom.push(randomIndex); // Y lo añadimos al array
        }
    } 


    const pelisRandom = indicesRandom.map(i => peliculas[i]);
    const boxs = ['box1', 'box2', 'box3', 'box4']; // IDs de las cajas en el HTML


    pelisRandom.forEach((pelicula, index) => { // Iteramos sobre las peliculas
        const boxId = boxs[index]; // Obtenemos el ID de la caja correspondiente
        const boxElement = document.getElementById(boxId); // Obtenemos el elemento del DOM
        const RightBtn = document.getElementById("btn-der");

        boxElement.innerHTML = ` 
        <img src="${pelicula.portada}" alt="${pelicula.titulo} Poster"
        style="width:86%; height:86%; border-radius:10px; image-rendering: crisp-edges; object-fit: cover;"/>
        `;

        //Etilos para el box
        // Creamos un frame cuando el mouse pasa por encima que muestre info
        const infoFrame = document.createElement('div'); // Creamos un div para el frame de info
        infoFrame.style.position = 'absolute'; // Posicionamiento absoluto
        infoFrame.style.top = '6.4%'; // Posición desde arriba
        infoFrame.style.left = '6.4%'; // Posición desde la izquierda
        infoFrame.style.width = '78%'; // Ancho del frame
        infoFrame.style.height = '80.4%'; // Alto del frame
        infoFrame.style.backgroundColor = 'rgba(0, 0, 0, 0.7)'; // Fondo semi-transparente
        infoFrame.style.color = 'white'; // Color del texto
        infoFrame.style.padding = '10px'; // Relleno interno
        infoFrame.style.borderRadius = '10px'; // Bordes redondeados
        infoFrame.style.display = 'none'; // Oculto por defecto
        infoFrame.innerHTML = ` 
            <h3>${pelicula.titulo}</h3> <style> h3 { color: White;
            font-family:'Franklin Gothic Medium','Arial Narrow',Arial,sans-serif;
            margin-top; } </style>
             <style> p { font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
             font-size: 14px; } </style>
            <p><strong>   Género:</strong> ${pelicula.genero.join(', ')}</p>
            <p><strong>🕑 Duración:</strong> ${pelicula.duracion_minutos} minutos</p>
            <p><strong>⭐ Calificación:</strong> ${pelicula.calificacion}/10</p>
        `; // Contenido del frame
        // Añadimos el frame al box sin blur
        boxElement.appendChild(infoFrame); // Añadimos el frame al box

        // Mostramos el frame al pasar el mouse
        boxElement.addEventListener('mouseover', () => { // Evento mouseover (hover)
            infoFrame.style.display = 'block'; // Mostramos el frame
        });
        // Ocultamos el frame al quitar el mouse
        boxElement.addEventListener('mouseout', () => { // Evento mouseout
            infoFrame.style.display = 'none'; // Ocultamos el frame
        });
        // Efecto blur en la imagen al pasar el mouse
        boxElement.addEventListener('mouseover', () => { // Evento mouseover (hover)
            const img = boxElement.querySelector('img'); // Seleccionamos la imagen dentro del box
            img.style.filter = 'blur(2.4px)'; // Aplicamos el filtro blur
        });
        boxElement.addEventListener('mouseout', () => { // Evento mouseout
            const img = boxElement.querySelector('img'); // Seleccionamos la imagen dentro del box
            img.style.filter = 'none'; // Quitamos el filtro blur
        });        
    });


})

.catch(error => {
  console.error('Error', error);
  // Pone mensaje rojo en las cajas
});

