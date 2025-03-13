**MangaDR**

MangaDR es una plataforma web para la gestión y seguimiento de mangas, permitiendo a los usuarios comentar, dar like a comentarios y organizar sus mangas leídos, favoritos y pendientes. Utiliza tecnologías web modernas como JavaScript, PHP y MySQL, junto con 
Bootstrap para una mejor experiencia de usuario.

**Características**

    Gestión de Mangas: Los usuarios pueden buscar, ver y administrar su lista de mangas.
    
    Sección de Comentarios: Se permite agregar, visualizar y dar like a comentarios sobre mangas específicos.
    
    Sistema de Likes: Cada usuario puede dar o quitar su like a un comentario.
    
    Autenticación de Usuarios: Los comentarios y likes solo están disponibles para usuarios registrados.
    
    Base de Datos MySQL: Maneja usuarios, mangas y comentarios con una estructura optimizada.

**Tecnologías Utilizadas**

    Frontend: JavaScript (Fetch API), HTML5, CSS3, Bootstrap 4.
    
    Backend: PHP con manejo de sesiones.
    
    Base de Datos: MySQL (manejada a través de phpMyAdmin).
    
    APIs Externas: API de manga para obtener información en tiempo real.

**Instalación y Configuración**

Requisitos Previos

    Servidor Apache con PHP (Ejemplo: XAMPP, LAMP, MAMP, WAMP).
    
    MySQL o MariaDB instalado.
    
    phpMyAdmin para la gestión de la base de datos.

**Pasos de Instalación**

Clona el repositorio o descarga el código fuente

    git clone https://github.com/usuario/MangaDR.git
    cd MangaDR

Configura la base de datos

    Importa el archivo mangadb.sql en tu servidor MySQL.
    
    Asegúrate de configurar las credenciales correctas en connectDB.php.

Configura el servidor local

    Copia el proyecto en la carpeta htdocs (para XAMPP/WAMP) o en el directorio raíz de tu servidor Apache.
    
    Inicia Apache y MySQL desde el panel de control de XAMPP/WAMP.

Ejecuta el Proyecto

Abre el navegador y accede a: http://localhost/ProyectoFinalWeb2/

**Uso de la Aplicación**

Registro e Inicio de Sesión:

    Los usuarios pueden registrarse y acceder con su cuenta.
    
    Si un usuario no está registrado, no podrá comentar ni dar likes.

Exploración de Mangas:

    Los usuarios pueden buscar mangas y ver sus capítulos.
    
    Cada capítulo tiene una sección de comentarios.

Gestión de Comentarios:

    Los usuarios pueden agregar comentarios y visualizar los existentes.
    
    Cada comentario tiene un botón de "like", que puede ser agregado o removido por el usuario.

Manejo de Likes:

    Si el usuario ya ha dado like a un comentario, volver a hacer clic lo eliminará.
    
    Los likes se actualizan dinámicamente sin recargar la página.

Base de Datos

    El archivo **mangadb.sql** contiene la estructura y datos necesarios para la base de datos. Algunas tablas importantes son:
    
    cuenta (id, username, password, avatar)
    
    mangas (id, titulo, descripcion, imagen_url)
    
    comentarios (id_row, comentario, manga_id, user_id, likes, chapter)
    
    likes (id, user_id, comment_id)
