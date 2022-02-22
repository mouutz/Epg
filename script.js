 function filter() {
  let input = document.querySelector('.search').value //<-- Changed to querySelector
  input = input.toLowerCase();
  let cards = document.querySelectorAll('.channel-card'); //<-- Changed to querySelectorAll with '.card' selector.

  //loop over cards and compare search with title.
  cards.forEach((el) => {
    let title = el.querySelector('.name').textContent.toLowerCase();
    el.style.display = title.includes(input) ? "list-item" : "none";
  });
}

const clearIcon = document.querySelector(".clear-icon");
const searchBar = document.querySelector(".search");

searchBar.addEventListener("keyup", () => {
  if(searchBar.value && clearIcon.style.visibility != "visible"){
    clearIcon.style.visibility = "visible";
  } else if(!searchBar.value) {
    clearIcon.style.visibility = "hidden";
  }
});

clearIcon.addEventListener("click", () => {
  searchBar.value = "";
  clearIcon.style.visibility = "hidden";
})