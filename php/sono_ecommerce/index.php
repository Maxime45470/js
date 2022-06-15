<?php

include('template/header.php');
?>
<main>
    <h1>Accueil</h1>

    
    <div class="container-fluid">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <a href="pages\eclairage.php">
                    <div class="carousel-item active">
                        <img src="https://media.istockphoto.com/photos/free-stage-with-lights-lighting-devices-picture-id1136864059?k=20&m=1136864059&s=612x612&w=0&h=Y-X1N2fz1Td5iaOisZnVzNNWHCktfv8mPEECUduDtX4="
                            class="d-block w-100 " alt="...">
                </a>
                <div class="carousel-caption d-none d-md-block">
                    <h5>Eclairages</h5>
                    <p>Visiter la section éclairage</p>
                </div>
            </div>
            <div class="carousel-item">
                <a href="pages\hifi.php">
                    <img src="https://media.istockphoto.com/photos/home-theater-system-hd-projector-large-screen-hifi-sound-system-picture-id183808724?k=20&m=183808724&s=612x612&w=0&h=jCkdhU8y1riKN7-vA3YoPbN3LOYGQ29H8krEZTvBqDI="
                        class="d-block w-100 " alt="..."> </a>
                <div class="carousel-caption d-none d-md-block">
                    <h5>Hifi et Vidéo</h5>
                    <p>Visiter la section Hifi/Vidéo</p>
                </div>
            </div>
            <div class="carousel-item">
                <a href="pages\sono.php">
                    <img src="https://media.istockphoto.com/photos/wireless-audio-speaker-and-smartphone-picture-id1219175931?k=20&m=1219175931&s=612x612&w=0&h=HWl-Bs_M_1BguCm95OiU_Y5jMwf4aTAD7PkS8aPFrLs="
                        class="d-block w-100 " alt="..."> </a>
                <div class="carousel-caption d-none d-md-block">
                    <h5>Sono portable</h5>
                    <p>Visiter la section nomade</p>
                </div>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon visually-hidden" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon visually-hidden" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>


</main>


<?php

include('template/footer.php');

?>