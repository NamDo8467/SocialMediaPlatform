const phoneContentContainer = document.querySelector(
  ".phone-content-container"
);
const createImages = async () => {
  let numberImage = Math.floor(Math.random() * (11 - 1) + 1);

  for (let i = 1; i < 5; i++) {
    let phoneContent = document.createElement("img");
    phoneContent.className = "phone-content";
    phoneContent.src = `./images/instagram_phone${numberImage}.png`;
    phoneContent.alt = "instagram phone content";

    phoneContentContainer.appendChild(phoneContent);
    let randomNumber = [numberImage];
    while (randomNumber.includes(numberImage)) {
      numberImage = Math.floor(Math.random() * (11 - 1) + 1);
    }
    randomNumber.push(numberImage);
  }
};

const delay = (millisecond) => {
  return new Promise((resolve) => {
    setTimeout(() => {
      resolve();
    }, millisecond);
  });
};

const phoneContent = phoneContentContainer.children;

const startChangingContent = async () => {
  //start losing opacity
  await delay(1000);
  phoneContent[3].style.opacity = 0;
  phoneContent[3].style.transition = "opacity 1s";
  await delay(2000);

  phoneContent[2].style.opacity = 0;
  phoneContent[2].style.transition = "opacity 1s";
  await delay(2000);

  phoneContent[1].style.opacity = 0;
  phoneContent[1].style.transition = "opacity 1s";
  await delay(2000);

  //start getting opacity back
  phoneContent[1].style.opacity = 1;
  phoneContent[1].style.transition = "opacity 1s";
  await delay(2000);

  phoneContent[2].style.opacity = 1;
  phoneContent[2].style.transition = "opacity 1s";
  await delay(2000);

  phoneContent[3].style.opacity = 1;
  phoneContent[3].style.transition = "opacity 1s";
};

createImages();
startChangingContent();
