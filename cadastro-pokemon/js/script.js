function toggleMenu() {
  const menu = document.getElementById("menuLateral");
  menu.classList.toggle("ativo");
}

document.addEventListener("click", function(event) {
  const menu = document.getElementById("menuLateral");
  const botao = document.querySelector(".hamburguer");

  if (menu.classList.contains("ativo") && !menu.contains(event.target) && !botao.contains(event.target)) {
    menu.classList.remove("ativo");
  }
});