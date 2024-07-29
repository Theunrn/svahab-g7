<template>
  <div class="contact-section w-full bg-white shadow-lg text-black">
    <div class="contact-header relative text-center text-white">
      <img src="../../assets/contact-piture/pixelcut-export.jpeg" alt="Football" class="header-image w-full h-[95vh] md:h-[70vh] lg:h-[95vh] object-cover" />
      <div class="header-text absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-center w-[90%] md:w-[80%] lg:w-[60%]">
        <h1 class="text-4xl font-bold">Contact Information</h1>
        <p class="text-lg mt-5">
          We would love to hear from you! Whether you have questions, or feedback, or need assistance, our team is here to help. You can reach us via phone, or email Connect with us on social media for the latest updates and news. We strive to respond to all inquiries promptly and look forward to assisting you.
        </p>
        <button class="bg-gradient-to-r from-[#AA9A97] to-[#8F504B] hover:bg-gradient-to-r text-white font-bold py-2 px-4 mt-4 rounded-md w-40 border border-white">Contact us</button>
      </div>
    </div>
    <div class="contact-body flex flex-col gap-4 md:flex-row mt-5 px-4 md:px-10 lg:px-20">
      <div class="contact-form w-full md:w-1/2 lg:w-1/2 p-4">
        <form class="bg-white mb-5 p-8 rounded-md shadow-lg bg-gradient-to-r from-[#F5F5F5] to-[#E5E4E2]">
          <h2 class="text-2xl font-bold mb-4 text-center">Give us your feedback</h2>
          <div class="mb-3">
            <input type="text" id="name" name="name" placeholder="Name:" class="border border-gray-300 rounded-md py-2 px-3 w-full focus:outline-none focus:ring focus:ring-[#2F539B]" required>
          </div>
          <div class="mb-3">
            <input type="email" id="email" name="email" placeholder="Email address:" class="border border-gray-300 rounded-md py-2 px-3 w-full focus:outline-none focus:ring focus:ring-[#2F539B]" required>
          </div>
          <div class="mb-3">
            <input type="tel" id="phone" name="phone" placeholder="Phone number:" class="border border-gray-300 rounded-md py-2 px-3 w-full focus:outline-none focus:ring focus:ring-[#2F539B]" required>
          </div>
          <div class="mb-3">
            <input type="text" id="subject" name="subject" placeholder="Subject:" class="border border-gray-300 rounded-md py-2 px-3 w-full focus:outline-none focus:ring focus:ring-[#2F539B]" required>
          </div>
          <div class="mb-3">
            <textarea id="message" name="message" rows="4" placeholder="Message:" class="border border-gray-300 rounded-md py-2 px-3 w-full focus:outline-none focus:ring focus:ring-[#2F539B]" required></textarea>
          </div>
          <div class="flex justify-start">
            <button type="submit" class="bg-[#1E90FF] hover:bg-[#2F539B] text-white font-bold py-2 px-4 rounded-md focus:ring focus:ring-[#2F539B]">Submit</button>
          </div>
        </form>
      </div>
      <div class="contact-details w-full md:w-1/2 lg:w-1/2 ">
        <div class="details text-start">
          <h2 class="text-center text-3xl font-bold mb-2">Get in touch</h2>
          <p class="mt-1 text-base">
            We'd love to hear from you! If you have any questions, feedback, or need support, please don't hesitate to reach out. Follow us on social media to stay updated with the latest news and updates. Your satisfaction is our priority, and we are committed to providing you with the best service possible.          </p>
          <div class="contact-type flex flex-col md:flex-row justify-between mt-5">
            <div class="left-side w-full md:w-1/2">
              <div class="flex items-center mb-2">
                <img src="../../assets/contact-piture/phone.jpg" alt="phone" class="w-10 h-10 rounded-full mr-2" />
                <p class="flex flex-col ml-3">
                  <span class="font-bold mr-2">Phone number</span>
                  <span>855-66879337</span>
                </p>
              </div>
              <div class="flex items-center mb-2 mt-4">
                <img src="../../assets/contact-piture/email.jpg" alt="email" class="w-10 h-10 rounded-full mr-2" />
                <p class="flex flex-col ml-3">
                  <span class="font-bold mr-2">Email address</span>
                  <span>entheun71@gmail.com</span>
                </p>
              </div>
            </div>
            <div class="right-side w-full md:w-1/2">
              <div class="flex items-center mb-2">
                <img src="../../assets/contact-piture/website.jpg" alt="website" class="w-10 h-10 rounded-full mr-2" />
                <p class="flex flex-col ml-3">
                  <span class="font-bold mr-2">Website</span>
                  <span>svaahapfootball.com</span>
                </p>
              </div>
              <div class="flex items-center mb-2 mt-2">
                <img src="../../assets/contact-piture/location.jpg" alt="location" class="w-10 h-10 rounded-full mr-2" />
                <p class="flex flex-col ml-3 flex-wrap ">
                  <span class="font-bold mr-2">Location</span>
                  <span class="mr-10">Street 371, Borey Solar, Phnom Penh</span>
                </p>
              </div>
            </div>
          </div>
          <p class="paragraph text-yellow-500 mt-3">Follow us on</p>
          <div class="social-media flex gap-2 mt-3">
            <a href="#" class="hover:transform hover:scale-105 transition-transform"><img src="../../assets/contact-piture/facebook.jpg" alt="Facebook" class="w-10 h-10 shadow-lg rounded-full" /></a>
            <a href="#" class="hover:transform hover:scale-105 transition-transform"> <img src="../../assets/contact-piture/instagram.jpg" alt="Instagram" class="w-10 h-10 rounded-full" /> </a>
            <a href="#" class="hover:transform hover:scale-105 transition-transform"> <img src="../../assets/contact-piture/twiter.jpg" alt="Twitter" class="w-10 h-10 rounded-full" /> </a>
            <a href="#" class="hover:transform hover:scale-105 transition-transform"> <img src="../../assets/contact-piture/telegram.jpg" alt="Telegram" class="w-10 h-10 rounded-full" /> </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<style scoped>
  @media (max-width: 640px) {
    .header-image {
      height: 60vh;
    }
    .contact-body {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }
    .details {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
    }
    .ight-side img {
      width: 30px;
      height: 30px;
    }
  }
</style>
