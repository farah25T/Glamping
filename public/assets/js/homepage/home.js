// Get all the elements with the "hidden" class
const hiddenElements = document.querySelectorAll(".hidden");

// Define a function to check if an element is in the viewport
function isInViewport(element) {
  const rect = element.getBoundingClientRect();
  return (
    rect.top >= 0 &&
    rect.top <= (window.innerHeight || document.documentElement.clientHeight)
  );
}
// Define a function to reveal the element
function revealElement(element) {
  element.classList.add("revealed");
}

// Check if the hidden elements are in the viewport when the page loads and on scroll
window.addEventListener("scroll", () => {
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
