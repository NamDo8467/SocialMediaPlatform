const avatar = document.querySelector(".avatar img");
const followInformationContainer = document.querySelector(
  ".follow-information-container"
);

const usernameContainer = document.querySelector(".username-container");
const firstSection = document.querySelector(".first-section");
const newFollowInformationContainer =
  followInformationContainer.cloneNode(true);

window.addEventListener("resize", () => {
  if (window.innerWidth < 768) {
    avatar.classList.add("w-75");
    avatar.classList.add("h-50");
    followInformationContainer.remove();
    newFollowInformationContainer.classList.add("text-center");
    firstSection.appendChild(newFollowInformationContainer);
  } else {
    newFollowInformationContainer.classList.remove("text-center");

    usernameContainer.insertAdjacentElement(
      "afterend",
      newFollowInformationContainer
    );
    avatar.classList.remove("w-75");

    avatar.classList.remove("h-50");
  }
});
