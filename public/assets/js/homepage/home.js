// Get all the elements with the "hidden" class
const hiddenElements = document.querySelectorAll(".hidden");

// Define a function to check if an element is in the viewport
function isInViewport(element) {
  const rect = element.getBoundingClientRect();
  return (
    rect.top >= 0 &&
    rect.left >= 0 &&
    rect.bottom <=
      (window.innerHeight || document.documentElement.clientHeight) &&
    rect.right <= (window.innerWidth || document.documentElement.clientWidth)
  );
}

// Define a function to reveal the element
function revealElement(element) {
  element.classList.add("revealed");
}

// Check if the hidden elements are in the viewport when the page loads and on scroll
window.addEventListener("load", () => {
  hiddenElements.forEach((element) => {
    if (isInViewport(element)) {
      revealElement(element);
    }
  });
});

window.addEventListener("scroll", () => {
  hiddenElements.forEach((element) => {
    if (isInViewport(element)) {
      revealElement(element);
    }
  });
});
