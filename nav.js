const switchWord = document.getElementById("switchWord");
const words = ["medicine donation", "medicine requests"];
let i = 0;

setInterval(() => {
    switchWord.style.opacity = "0";

    setTimeout(() => {
        i = (i + 1) % words.length;
        switchWord.textContent = words[i];
        switchWord.style.opacity = "1";
    }, 400);

}, 2500);

const doctorImg = document.getElementById("doctor-img");



    // Step 2: array of image filenames

const images = [
    "christmas-gingerbread-female-hands-top-view.jpg",
    "some-heart-inside-male-hands-with-wooden-blocks-white.jpg",
    "people-preparing-box-with-food-donation.jpg",
    "5536797.jpg"
];
  

  // Step 3: start from first image
  let index = 0;

  // Step 4: change image every 3 seconds
 setInterval(() => {
  doctorImg.style.opacity = 0;

  setTimeout(() => {
    index = (index + 1) % images.length;
    doctorImg.src = images[index];
    doctorImg.style.opacity = 1;
  }, 300);
}, 3000);


