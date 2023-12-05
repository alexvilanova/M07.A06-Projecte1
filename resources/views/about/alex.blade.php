<x-app-layout>
    <div class="mx-auto bg-white p-6 flex flex-col items-center justify-center">
        <!-- ITEM 1 -->
        <div class="max-w-5xl mx-auto flex mb-8 rounded-md">
            <div class="flex-shrink-0 mr-8">
                <div class="image-container">
                    <img src="{{ asset ('image/usuario.png')}}" alt="Image" class="original rounded-full">
                    <img src="{{ asset ('image/usuario-modified.png')}}" alt="Image" class="hovered rounded-full">
                </div>  
                <audio src="{{ asset('audio/electrico.mp3')}}" type="audio/mpeg"></audio>
            </div>

            <div class="m-4">
                <h2 class="text-2xl font-bold mb-4">Alex Gonzalez</h2>
                <h3 class="text-xl font-bold">Sobre mi</h3>
                <p class="text-gray-700 mb-4">Ingeniero de software apasionado por la resolución creativa de problemas. Amante de la música clásica y pianista en sus momentos libres.
                Con más de 5 años de experiencia en desarrollo de software, he liderado proyectos innovadores que han impactado positivamente en la eficiencia y productividad. Mi enfoque va más allá del código, siempre buscando soluciones que mejoren la experiencia del usuario y aporten un valor real.
                En mi tiempo libre, disfruto explorando nuevas tecnologías, contribuyendo a proyectos de código abierto y compartiendo conocimientos a través de mi blog. Creo en el aprendizaje continuo y en la importancia de construir comunidades colaborativas en el mundo de la tecnología.</p>
                <hr class="my-3">
                <h3 class="text-xl font-bold">Habilidades</h3>
                <ul class="list-disc pl-6">
                        <li>Desarrollo de software ágil</li>
                        <li>Arquitectura de sistemas</li>
                        <li>Interfaz de usuario (UI) y experiencia de usuario (UX)</li>
                        <li>Colaboración en equipo y liderazgo técnico</li>
                    </ul>
                <div class="video-container hidden">
                    <video id="profile-video" controls autoplay muted width="800" height="600">
                        <source src="{{asset('video/alex.mp4') }}" type="video/mp4">
                    </video>
            </div>
        </div>

        </div>
        <div class="mt-4">
        <a href="{{ route('about.index')}}" class="text-white bg-blue-500 hover:bg-blue-600 py-2 px-4 rounded-md mt-4 transition duration-300 ease-in-out">
                Volver atrás
            </a>
        </div>
</div>
<style>
        .image-container {
            position: relative;
        }

        .original,
        .hovered {
            width: 150px; 
            height: 150px;
            object-fit: cover;
            transition: transform 0.5s ease-in-out;
            border-radius: 50%;
        }

        .hovered {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            transform: scaleY(-1);
        }

        .image-container:hover .original {
            opacity: 0;
        }

        .image-container:hover .hovered {
            opacity: 1;
        }

        .video-container {
            padding
        }

        .hidden {
            display: none;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var audio = document.querySelector('audio');
            var videoContainer = document.querySelector('.video-container');
            var video = document.getElementById('profile-video');

            var imageContainer = document.querySelector('.image-container');

            imageContainer.addEventListener('mouseover', function () {
                audio.play();
            });

            imageContainer.addEventListener('mouseout', function () {
                audio.pause();
            });

            imageContainer.addEventListener('click', function () {
                    videoContainer.classList.remove('hidden');
                    video.play();
            });
        });
    </script>
</x-app-layout>