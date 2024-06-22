<template>
  <div id="carouselExampleFade" class="carousel slide carousel-fade">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="../../assets/contact-piture/pixelcut-export.jpeg" class="d-block w-full h-[95vh] md:h-[95vh] lg:h-[95vh] header-image object-cover" alt="...">
        <div class="carousel-caption">
          <h1>Kick Off Your Shopping Spree!</h1>
          <p>Explore our wide range of football gear and accessories to elevate your game.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="../../assets/ShopImage/soccer-jersey.jpg.webp" class="d-block w-full h-[95vh] md:h-[80vh] lg:h-[95vh] header-image object-cover" alt="...">
        <div class="carousel-caption">
          <h1>Suit Up for the Big Game</h1>
          <p>Find the perfect jersey, shorts, and more to show off your team spirit.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="../../assets/ShopImage/P1280309-768x432.jpg" class="d-block w-full h-[95vh] md:h-[80vh] lg:h-[95vh] header-image object-cover" alt="...">
        <div class="carousel-caption">
          <h1>Elevate Your Football Experience</h1>
          <p>Discover the latest football gear and accessories to enhance your performance and style.</p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</template>

<script>
export default {
  setup() {
  },
}
</script>

<style scoped>
.carousel-caption{
  position: absolute;
  top: 60%;
  left: 50%;
  transform: translate(-50%);
  text-align: center;
  color: #fff;
  background-color: rgba(0, 0, 0, 0.5);
  width: 100%;
  border-radius: 10px;
  font-size: 1.2rem;
  text-shadow: 0 0 10px #000;

}
.carousel-caption h1{
  font-size: 4rem;
  font-weight: 600;
  text-shadow: 0 0 10px #000;
}

</style>