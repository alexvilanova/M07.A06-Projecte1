<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Sobre Nosaltres
        </h2>
    </x-slot>

    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Arial', sans-serif;
        }

        .container {
            position: relative;
            max-width: 30%;
            margin: 0 auto;
            overflow: hidden;
            cursor: pointer;
        }

        #serious-img,
        #funny-img {
            width: 100%;
            height: auto;
            max-height: 100%;
            object-fit: cover;
            border-radius: 8px;
            transition: transform 0.3s ease-in-out;
        }

        #serious-img {
            filter: grayscale(100%);
        }

        #funny-img {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
        }

        .container:hover #serious-img {
            transform: scaleX(-1);
        }

        .container:hover #funny-img {
            opacity: 1;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
        }

        #video-modal {
            width: 100%;
            height: 100%;
            border-radius: 8px;
        }

        .overlay {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            color: #fff;
            padding: 1rem;
            background: rgba(0, 0, 0, 0.7);
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .audio-container {
            display: none;
        }

        .center-btn {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 10vh; 
        }
    </style>

    <div class="container relative" data-twe-modal x-on:click="openModal()">
        <div class="video-container">
            <img id="serious-img" src="image/hombre.jpg" alt="Serious Image">
            <img id="funny-img" src="image/dog.jpg" alt="Funny Image">
        </div>
        <div class="overlay" id="member-overlay">
            <p class="text-xl font-bold" id="member-name">Younes El Hajji</p>
            <p class="text-sm" id="member-description">CEO</p>
        </div>
    </div>

    <div id="modal" class="modal" data-twe-modal x-on:click="closeModal()">
        <div class="modal-content">
            <div class="video-responsive">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/ykGRYEX0n60" frameborder="0" allowfullscreen></iframe>
            </div>
            
            <div class="center-btn mt-4">
                <a href="{{ route('about.younes')}}" class="text-white bg-blue-500 hover:bg-blue-600 py-2 px-4 rounded-md mt-4 transition duration-300 ease-in-out">
                    Volver atrás
                </a>
            </div>
        </div>
    </div>

    <div class="audio-container">
        <audio id="audio" src="image/MORAD.mp3"></audio>
    </div>

    <div class="center-btn mt-4">
        <a href="{{ route('about.index')}}" class=" text-white bg-blue-500 hover:bg-blue-600 py-2 px-4 rounded-md mt-4 transition duration-300 ease-in-out">
            Volver atrás
        </a>
    </div>

    <script>
        let audio = document.getElementById('audio');
        let modal = document.getElementById('modal');
        let memberName = document.getElementById('member-name');
        let memberDescription = document.getElementById('member-description');
        let memberOverlay = document.getElementById('member-overlay');
        let videoContainer = document.querySelector('.video-container');
        let audioContainer = document.querySelector('.audio-container');

        memberOverlay.addEventListener('mouseover', function () {
            document.getElementById('serious-img').style.opacity = 0;
            document.getElementById('funny-img').style.opacity = 1;
            audio.play();
            memberName.textContent = 'Younes El Hajji';
            memberDescription.textContent = 'Fútbol';
        });

        memberOverlay.addEventListener('mouseout', function () {
            document.getElementById('serious-img').style.opacity = 1;
            document.getElementById('funny-img').style.opacity = 0;
            audio.pause();
            audio.currentTime = 0;
            memberDescription.textContent = 'CEO';
        });

        videoContainer.addEventListener('click', function (event) {
            event.stopPropagation();
            modal.style.display = 'flex';
        });

        function openModal() {
            modal.style.display = 'flex';
        }

        function closeModal() {
            modal.style.display = 'none';
        }
    </script>
</x-app-layout>