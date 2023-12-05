<x-app-layout>
    <div class="mx-auto bg-white p-6 flex flex-col items-center justify-center">
        <div class="max-w-5xl mx-auto flex mb-8 rounded-md">
            <div class="flex-shrink-0 mr-8">
                <img src="{{ asset ('image/usuario.png')}}" alt="Image" class="original w-32 h-32 rounded-full">
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
            </div>

        </div>
        <div class="mt-4">
        <a href="{{ route('about.index')}}" class="text-white bg-blue-500 hover:bg-blue-600 py-2 px-4 rounded-md mt-4 transition duration-300 ease-in-out">
                Volver atrás
            </a>
        </div>
</div>
<style>
 img:nth-child(1) {
    transition: transform 0.5s ease-in-out;
}
img:nth-child(2) {
    displa
}


img:hover:nth-child(1) {
    transform: scaleY(-1);
    z-index: 1; 
}


</style>
</x-app-layout>
